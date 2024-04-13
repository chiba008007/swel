<?PHP
//-------------------------------------------
//パートナー情報一覧表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_ptnList.php");

$oplist = new ptnListMethod();

require("./lib/PHPMailer/class.phpmailer.php");
$mail = new PHPMailer();
$offset = 30;


$where = array();
$where['id'] = $id;
$where['basetype'] = $basetype;
$limit = array();
//$row = $oplist->getUserDataPartner($limit, $where, "row");
$row = $oplist->getUserRow( $where );
$offset = 30;
$ceil = ceil($row / $offset) - 1;


//パートナー用データ
$where = array();
$where['id'] = $id;
$pdata = $db->getUser($where);
$ptTestBtn = $pdata[0]['ptTestBtn'];
$lastyear = date("Y-m-d H:i:s",strtotime("-1 year"));
/*
if($_SESSION[ 'explain' ] != "on"){
    header("Location:/index/explain/");
    exit();
}
*/

//-------------------------------------------
//企業認証処理
//-------------------------------------------
//する

if ($_REQUEST['attFlg'] == "on") {

	$uid = $_REQUEST['id'];
	$table = "t_user";
	$edit['where']['partner_id'] = $id;
	$edit['where']['id'] = $uid;
	$edit['edit']['user_status'] = 1;
	$oplist->editUserData($table, $edit);

	//重み付けデータ取得
	$tblw = "t_user_weight";
	$wheres['uid'] = $id;
	$weight = $oplist->getWeight($wheres);

	$w1  = $weight["w1"];
	$w2  = $weight["w2"];
	$w3  = $weight["w3"];
	$w4  = $weight["w4"];
	$w5  = $weight["w5"];
	$w6  = $weight["w6"];
	$w7  = $weight["w7"];
	$w8  = $weight["w8"];
	$w9  = $weight["w9"];
	$w10 = $weight["w10"];
	$w11 = $weight["w11"];
	$w12 = $weight["w12"];
	$ave = $weight["ave"];
	$sd  = $weight["sd"];
	$pdfdownload = $weight['pdfline'];
	if (!$weight) {
		$pdfline = "";
	} else {
		$pdfline = $w1 + $w2 + $w3 + $w4 + $w5 + $w6 + $w7 + $w8 + $w9 + $w10 + $w11 + $w12;
	}

	//テストデータ登録------------------------------------
	$set = array();
	$tbl   = "t_test";
	$set['partner_id'] = $id;
	$set['customer_id'] = $uid;
	$set['test_id'] = 0;
	$set['name'] = "検査トライアルテスト";
	$set['period_from'] = sprintf("%04d/%02d/%02d", date('Y'), date('m'), date('d'));
	$set['period_to'] = sprintf(
		"%04d/%02d/%02d",
		date('Y', strtotime("+1 month")),
		date('m', strtotime("+1 month")),
		date('d', strtotime("+1 month"))
	);
	$set['number'] = 3;
	$set['temp_flg'] = 1;
	$set['enabled'] = 1;
	do {
		$where = array();
		$str = $db->getRandomString(5);
		$where['dir'] = $str;
		$key = $oplist->getUserDatas($tbl, $where);
		if (!$key) {
			$flg = false;
		} else {
			$flg = true;
		}
	} while ($flg);
	$set['dir'] = $str;
	$cry  = $str;
	$codeurl = base64_encode($cry);

	$set['fin_disp'] = 0;
	$set['type'] = 0;
	if ($pdfdownload) {
		$set['pdfdownload'] = $pdfdownload;
	} else
	if ($pdfline) {
		$set['pdfdownload'] = "2:5";
	} else {
		$set['pdfdownload'] = "1:5";
	}
	//テスト親データ
	$db->setUserData($tbl, $set);
	$testid = $db->lastid;

	$set['test_id'] = $testid;
	$set['type'] = 2;
	$set['w1'] = $w1;
	$set['w2'] = $w2;
	$set['w3'] = $w3;
	$set['w4'] = $w4;
	$set['w5'] = $w5;
	$set['w6'] = $w6;
	$set['w7'] = $w7;
	$set['w8'] = $w8;
	$set['w9'] = $w9;
	$set['w10'] = $w10;
	$set['w11'] = $w11;
	$set['w12'] = $w12;
	$set['ave'] = $ave;
	$set['sd'] = $sd;
	if ($pdfline) {
		$set['weight'] = 0;
	} else {
		$set['weight'] = 1;
	}
	//テスト子供データ
	$db->setUserData($tbl, $set);
	$tid = $db->lastid;
	//-----------------------------------------------------
	$tbl = "t_testpaper";
	for ($i = 1; $i <= 3; $i++) {
		$set = array();
		$set['number'] = $i;
		$set['partner_id'] = $id;
		$set['customer_id'] = $uid;
		$set['test_id'] = $tid;
		$set['testgrp_id'] = $testid;
		do {
			$where = array();
			$str = $db->getRandomString(3);
			$idstr[$i] = $str;
			$where['exam_id'] = $str;
			$key = $oplist->getUserDatas($tbl, $where);
			if (!$key) {
				$flg = false;
			} else {
				$flg = true;
			}
		} while ($flg);
		$set['exam_id'] = $str;
		$set['type'] = 2;
		$set['temp_flg'] = 1;
		$db->setUserData($tbl, $set);
	}
	//ユーザデータ取得
	$where = array();
	$where['id'] = $uid;
	$user = $db->getUser($where);
	$idpw = $user[0]['login_id'];
	//パートナーデータ取得
	$where = array();
	$where['id'] = $id;
	$pt = $db->getUser($where);
	//認証なし
	//メールの送信
	mb_language("japanese");
	mb_internal_encoding("UTF-8");
	$mailto = $user[0]['rep_email'];

	if ($_SERVER['SERVER_NAME'] == "abc.under.jp") {
		$url = "http://abc.under.jp/t/?k=" . $codeurl;
	} else {
		$url = "http://test.e-wel.com/?k=" . $codeurl;
	}

	$subject = "【重要】受検方法および結果確認方法のご案内";

	$mailfrom = $pt[0]['rep_email'];
	$fromname = "サポートセンター";

	$mail->CharSet = "iso-2022-jp";
	$mail->Encoding = "7bit";


	//---------------------------------------
	//検査結果の説明用マニュアル送信日指定
	//3日後配信処理
	//----------------------------------------

	if ($pt[0]['sendDayStatus'] == 1) {

		//３日後に配信処理内容登録
		$three = "t_afterSend";
		$sets = array();
		$sets['send_date'] =  date("Y-m-d", strtotime("+3 day"));
		$sets['partner_id'] = $pt[0]['id'];
		$sets['login_id'] = $idpw;
		$sets['login_pw'] = $idpw;
		$sets['regist_ts'] = date("Y-m-d");

		$db->setUserData($three, $sets);


		$subject = "【重要】トライアル受検方法のご案内";
		$content = "
" . $user[0]['name'] . " " . $user[0]['rep_name'] . "様\n
" . $pt[0]['name'] . "サポートデスクです。\n
貴社におかれましてはますますご清祥のこととお喜び申し上げます
この度は、トライアル検査受検登録頂き、ありがとうございます。
システムへの企業情報登録が完了致しましたので、ご連絡致します。
下記の【受検情報】 を参考の上、トライアル受検をお願い致します。
結果の見方については、3日後に【結果の確認方法】をご連絡させて頂きます。
※分かりにくい場合には、弊社までお問い合わせください。
担当連絡先：" . $pt[0]['rep_email'] . " / " . $pt[0]['rep_email2'] . "


＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
【受検情報】
１．下記、URLにアクセスしてください。（携帯電話でも可能です）
下記、URLをクリックするか、または、コピーしてお使いのブラウザーに貼り付けてください。
受検用URL：" . $url . "

２．アクセス後、下記IDと生年月日を入力し、受検を始めてください。
１人１IDを使って受検をお願いします。
受検ID：" . $idstr[1] . "
受検ID：" . $idstr[2] . "
受検ID：" . $idstr[3] . "

【受検時の３つのご注意点】
１．受検環境について
受検される際には、下記の条件を満たしている環境で受検して頂けますようお願いいたします。
PC受検の場合：オペレーションシステム：Windows XP以上
携帯受検の場合：特に指定はありません
２．検査は１つのパート（１つの検査）から成り立っております。
受検時間の目安は１０分程度
問題数は、36問です。
制限時間はありません。
３．途中終了の場合
なるべく、一度に受検を完了させてください。
やむ得ない場合は、途中終了して頂くことが可能です。
その場合は、次回ログイン時に前回の回答途中から受検を開始して頂くことが可能です。
＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊
宜しくお願い申し上げます。";

		$attachfile = './manual/' . $id . '/system-manual.pdf';
		$mail->AddAddress($mailto);
		$mail->From = $mailfrom;
		$mail->FromName = mb_encode_mimeheader(mb_convert_encoding($fromname, "JIS", "UTF-8"));
		$mail->Subject = mb_encode_mimeheader($subject, 'ISO-2022-JP');
		$mail->Body  = mb_convert_encoding($content, "JIS", "UTF-8");

		/*
		//添付ファイル追加
		if(file_exists($attachfile)){
			$mail->AddAttachment($attachfile);
		}else{
			//添付がない時
			$base_manual = D_PATH_HOME.'manual/system-manual.pdf';
			$mail->AddAttachment($base_manual);
		}
*/

		$mailbcc = D_FROM_MAIL;
		//BCCに登録
		$mail->addBcc($mailbcc);
		$mail->Send(); //メール送信
	} else {

		//---------------------------------------
		//通常配信
		//----------------------------------------

		$content = $user[0]['name'] . " " . $user[0]['rep_name'] . "様\n\n";
		$content .= $pt[0]['name'] . "サポートデスクです。\n\n";
		$content .= "貴社におかれましてはますますご清祥のことと お喜び申し上げます。 \n";
		$content .= "この度は、トライアル検査受検登録頂き、ありがとうございます。\n";
		$content .= "\n";
		$content .= "システムへの企業情報登録が完了致しました。\n";
		$content .= "\n";
		$content .= "下記の【受検情報】 を参考の上、トライアル受検をお願い致します。\n";
		$content .= "受検終了後、結果の見方については、\n【受検情報】の下部にある【結果の確認方法】をご参照ください。\n";
		$content .= "\n";
		$content .= "※分かりにくい場合には、本メールに添付されておりますマニュアルを\n参考にして頂くか、弊社までお問い合わせください。\n";
		$content .= "担当連絡先：" . $pt[0]['rep_email'] . " / " . $pt[0]['rep_email2'] . "\n";
		$content .= "\n";
		$content .= "＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊\n";
		$content .= "【受検情報】\n";
		$content .= "１．下記、URLにアクセスしてください。（携帯電話でも可能です）\n";
		$content .= "下記、URLをクリックするか、または、コピーしてお使いのブラウザーに貼り付けてください。\n";
		$content .= "受検用URL：" . $url . "\n";
		$content .= "\n";
		$content .= "２．アクセス後、下記IDと生年月日を入力し、受検を始めてください。\n";
		$content .= "１人１IDを使って受検をお願いします。\n";
		$content .= "受検ID：" . $idstr[1] . "\n";
		$content .= "受検ID：" . $idstr[2] . "\n";
		$content .= "受検ID：" . $idstr[3] . "\n";
		$content .= "\n";
		$content .= "【受検時の３つのご注意点】\n";
		$content .= "１．受検環境について\n";
		$content .= "受検される際には、下記の条件を満たしている環境で受検して頂けますようお願いいたします。\n";
		$content .= "PC受検の場合：オペレーションシステム：Windows XP以上\n携帯受検の場合：特に指定はありません\n";
		$content .= "\n";
		$content .= "２．検査は１つのパート（１つの検査）から成り立っております。\n";
		$content .= "受検時間の目安は１０分程度\n";
		$content .= "問題数は、36問です。\n";
		$content .= "制限時間はありません。\n";
		$content .= "\n";
		$content .= "３．途中終了の場合\n";
		$content .= "なるべく、一度に受検を完了させてください。\n";
		$content .= "やむ得ない場合は、途中終了して頂くことが可能です。\n";
		$content .= "その場合は、次回ログイン時に前回の回答途中から受検を開始して頂くことが可能です。\n";
		$content .= "＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊\n";
		$content .= "\n";
		$content .= "-------------------------------------------------------------------\n";
		$content .= "【結果の確認方法】\n";
		$content .= "１．下記のURLにアクセスして頂き、ID・PWを入力後、ログインをします。\n";
		$content .= "URL：" . D_URLS_HOME . "\n";
		$content .= "(ID:" . $idpw . "　：　PW:" . $idpw . ")\n";
		$content .= "\n";
		$content .= "２．開いた画面に登録されている検査一覧が表示されています。\n";
		$content .= "検査名：トライアルテストをクリックしてください。\n";
		$content .= "\n";
		$content .= "３．受検者の一覧が表示されています。\n";
		$content .= "こちらの画面で、受検状況が確認できます。\n";
		$content .= "画面下部にある「結果検査ダウンロード」ボタンを押すと、\n";
		$content .= "検査結果のエクセルファイルがダウンロードできます。\n";
		$content .= "\n";
		$content .= "また、受検終了している方であれば、その方の行の機能の欄に\n";
		$content .= "「PDF」ボタンが表示されています。\n";
		$content .= "そのPDFボタンを押してください。\n";

		$content .= "\n";
		$content .= "４．PDFボタンを押すと、結果のPDFファイルがダウンロードできます。\n";
		$content .= "保存場所をご指定頂き、結果をご確認ください。\n";
		$content .= "（※）管理システムの利用方法については、添付の資料をご確認ください。\n";
		$content .= "ダウンロードした検査結果の見方については、添付ファイルをご参照ください。\n";
		$content .= "＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊\n";

		$attachfile = './manual/' . $id . '/system-manual.pdf';
		$attachfile2 = './manual/' . $id . '/output-manual.pdf';

		$mail->AddAddress($mailto);
		$mail->From = $mailfrom;
		$mail->FromName = mb_encode_mimeheader(mb_convert_encoding($fromname, "JIS", "UTF-8"));


		$mail->Subject = mb_encode_mimeheader($subject, 'ISO-2022-JP');

		$mail->Body  = mb_convert_encoding($content, "JIS", "UTF-8");

		//添付ファイル追加
		if (file_exists($attachfile)) {
			$mail->AddAttachment($attachfile);
		} else {
			//添付がない時
			$base_manual = D_PATH_HOME . 'manual/system-manual.pdf';
			$mail->AddAttachment($base_manual);
		}
		if (file_exists($attachfile2)) {
			$mail->AddAttachment($attachfile2);
		} else {
			//添付がない時
			$base_status = D_PATH_HOME . 'manual/output-manual.pdf';
			$mail->AddAttachment($base_status);
		}
		$mailbcc = D_FROM_MAIL;
		//BCCに登録
		$mail->addBcc($mailbcc);
		$mail->Send(); //メール送信
	}

	exit();
}
//しない
if ($_REQUEST['attFlg'] == "off") {
	$uid = $_REQUEST['id'];
	$where = array();
	$where['partner_id'] = $id;
	$where['id'] = $uid;
	$oplist->deleteTbl($where);
	exit();
}
//web申込件数
$where = array();
$where['pid'] = $id;
$webCount = getWebCount($where, $oplist);

if ($_REQUEST['lists']) {
	//パートナーデータ
	$p = sprintf("%d", $_REQUEST['pages']);

	//表示件数
	if (!$_REQUEST['text']) {
		$limit['offset'] = $offset * $p;
		$limit['limit'] = $offset;
	}
	$where = array();
	$where['id'] = $id;
	$where['name'] = $_REQUEST['text'];
	$where['sort'] = $_REQUEST['sort'];
	$where['basetype'] = $basetype;
	$partner = $oplist->getUserDataPartner($limit, $where);
	$html = "";
	if (count($partner)) {
		foreach ($partner as $key => $val) {
			$color = "white";
			if($val[ 'customer_display' ] == 0){
				$color="lavender";
			}
			$html .= "<tr style='background-color:".$color."'>";
			$html .= "<td class='left'>" . $val['name'] . "";
			if ($webCount[$val['id']]) {
				$html .= "<p style='color:red;'>" . $webCount[$val['id']] . "件のweb申込がありました。</p>";
			}
			$html .= "</td>\n";
			$html .= "<td>" . number_format($val['tester']) . "</td>\n";
			$html .= "<td>" . number_format($val['syori']) . "</td>\n";
			$html .= "<td>" . number_format($val['zan']) . "</td>\n";
			$html .= "<td class='center'>";
			if ($val['user_status']) {
				if ($basetype == 2) {
					//横幅指定
					$w2 = "w2";
				}
				$html .= "<ul class='ulmenu " . $w2 . "' ><div class='auto' >\n";
				$html .= "<li><a href=\"/index/cus/" . $val['id'] . "\">顧客画面へ</a></li>\n";
				$html .= "<li><a href='/index/edit/" . $val['id'] . "'>更新</a></li>\n";
				if ($basetype == 1) {
					if (!$val['syori']) {
						$html .= "<li><a href='/index/del/" . $val['id'] . "'>削除</a></li>\n";
					} else {
						$html .= "<li class='d' >削除</li>\n";
					}
				}
				$html .= "<li><a href='/index/tmp/" . $val['id'] . "'>添付</a></li>\n";
				$html .= "</div></ul>\n";
			} else {
				$html .= "<ul class=\"ulmenu w50\" >\n";
				$html .= "<li><a href='/index/att/" . $val['id'] . "/on/' class='att' >認証する</a></li>\n";
				$html .= "<li><a href='/index/att/" . $val['id'] . "/off/' class='att' >認証しない</a></li>\n";
				$html .= "</ul>\n";
			}
			$html .= "</td>\n";
			$html .= "</tr>\n";
		}
	}
	echo $html;
	exit();
}

//パートナーデータ取得
$where['id'] = $id;
$userdata = $db->getUser($where);
$license_parts = $userdata[0]['license_parts'];

$where['id'] = $id;
$explode = explode(":", $license_parts);
$i = 1;
foreach ($explode as $k => $v) {
	$lisence_buy[$i] += $v;
	$i++;
}


$ldata = $oplist->getLicense($where, $lisence_buy);

//-----------------------
//お知らせ
//----------------------
$info = $oplist->getInfomation($id);

function getWebCount($where, $oplist)
{
	$sql = "
			SELECT 
				cid
				,COUNT(id) as cnt
			FROM
				t_application
			WHERE
				pid = " . $where['pid'] . "
				AND status = 0
			GROUP BY cid
			";

	$stmt = $oplist->db->prepare($sql);
	$stmt->execute();
	$i = 0;
	$list = array();
	while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$list[$i] = $rlt;
		$i++;
	}
	return $list;
}
