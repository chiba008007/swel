<?PHP
//-------------------------------------------
//パートナー情報変更
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_ptnNew.php");
$obj = new ptnNewMethod();
//顧客表示用配列
$array_customer_display = [];
$array_customer_display[1] = '表示';
$array_customer_display[0] = '非表示';
//$array_customer_display = ['非表示', '表示'];

//パートナー用データ
$where = array();
$where['id'] = $id;
$pdata = $db->getUser($where);
$ptTestBtn = $pdata[0]['ptTestBtn'];

//--------------------
//idの重複チェック
//--------------------
if ($_REQUEST['lists'] == "idcheck") {
	$where['login_id'] = $_REQUEST['id'];
	$row = $obj->idCheck($where);
	if ($row) {
		echo "false";
	} else {
		echo "true";
	}
	exit();
}
if ($_REQUEST['conf']) {

	//画像の真偽の確認
	$prev   = preg_replace("/\"|\\\/", "", $_REQUEST['previewImgId']);
	$fname  = basename($prev);
	$imgPath = $fname;
	$ext = pathinfo($imgPath, PATHINFO_EXTENSION);

	$prev   = preg_replace("/\"|\\\/", "", $_REQUEST['previewImgId']);
	$fname  = basename($prev);
	$prev = "<img src='/images/preview/" . $fname . "." . $_REQUEST['pv'] . "'>";
	//エラーチェック
	$where['login_id'] = $_REQUEST['login_id'];
	$row = $obj->idCheck($where);
	if ($row) {
		$alert = "すでに利用されたＩＤです。再設定をお願いします。";
		$err = 1;
	} else {
		$html = "newConf";
	}
}
if ($_REQUEST['regist']) {
	$where['login_id'] = $_REQUEST['login_id'];
	$row = $obj->idCheck($where);
	if ($row) {
		$alert = "すでに利用されたＩＤです。再設定をお願いします。";
		$err = 1;
	}

	if (!$err) {
		$set = [];

		$set['company_name'] = $_SESSION['base_site_name'];
		$set['company_name_target'] = $_REQUEST['name'];
		$set['worktext'] = "対象企業追加";
		$db->setUserData("log", $set);


		$sets['name'] = $_REQUEST['name'];
		$sets['login_id'] = $_REQUEST['login_id'];
		$sets['login_pw'] = $_REQUEST['login_pw'];
		$sets['post1'] = $_REQUEST['post1'];
		$sets['post2'] = $_REQUEST['post2'];
		$sets['prefecture'] = $_REQUEST['pref'];
		$sets['address1'] = $_REQUEST['address1'];
		$sets['address2'] = $_REQUEST['address2'];
		$sets['tel'] = $_REQUEST['tel'];
		$sets['fax'] = $_REQUEST['fax'];
		$sets['csvupload'] = $_REQUEST['csvupload'];
		$sets['pdf_button'] = $_REQUEST['pdf_button'];
		$sets['excel_master_status'] = $_REQUEST['excel_master_status'];
		$sets['pdf_master_status'] = $_REQUEST['pdf_master_status'];
		$sets['privacy_flg'] = $_REQUEST['privacy_flg'];
		$sets['rep_name'] = $_REQUEST['rep_name'];
		$sets['rep_email'] = $_REQUEST['rep_email'];
		$sets['rep_busyo'] = $_REQUEST['rep_busyo'];
		$sets['rep_tel1'] = $_REQUEST['rep_tel1'];
		$sets['rep_tel2'] = $_REQUEST['rep_tel2'];
		$sets['rep_name2'] = $_REQUEST['rep_name2'];
		$sets['rep_email2'] = $_REQUEST['rep_email2'];
		$sets['rep_email2'] = $_REQUEST['rep_email2'];
		$sets['csTestBtn'] = $_REQUEST['csTestBtn'];
		$sets['exam_pattern'] = $_REQUEST['exam_pattern'];
		$sets['ssltype'] = $_REQUEST['ssltype'];
		$sets['customer_file_upload'] = $_REQUEST['customer_file_upload'];

		$sets['regist_ts'] = date("Y-m-d H:i:s");
		$sets['type'] = 3;
		$sets['partner_id'] = $id;
		$sets['privacypolicy'] = $_REQUEST['privacypolicy'];
		$sets['privacypolicy_text'] = $_REQUEST['privacypolicy_text'];
		$sets['customer_display'] = $_REQUEST['customer_display'];
		$sets[ 'password_editdate' ] = date("Y-m-d");
		$tbl = "t_user";
		$obj->setUserData($tbl, $sets);

		//画像処理
		$filename = preg_replace("/\"|\\\'>/", "", basename($_REQUEST['prev']));

		//プレビュー画像の有無の確認
		$glob = glob("./images/preview/" . $filename);

		if ($filename && $glob[0]) {
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			//元あった画像の削除
			$base = glob("./img/" . $_REQUEST['login_id'] . ".*");
			foreach ($base as $key => $val) {
				@unlink($val);
			}
			rename("./images/preview/" . $filename, "./img/" . $_REQUEST['login_id'] . "." . $ext);
			//プレビュー画像の削除
			@unlink("./images/preview/" . $filename);
		}

		//パートナー情報取得
		$where = array();
		$where['id'] = $id;
		$pt = $obj->getUser($where);

		//------------------------------------------
		//
		//担当者にメール配信
		//
		//------------------------------------------
		$body = "";
		$body = $_REQUEST['name'] . "\n" . $_REQUEST['rep_name'] . "様\n";
		$body .= "貴社におかれましてはますますご清祥のことと\n";
		$body .= "お喜び申し上げます。\n";

		$body2 = $pt[0]['name'] . "サポートデスクです。\n";
		$body2 .= "\n";
		$body2 .= $pt[0]['logo_name'] . "管理システムへの企業情報登録が完了致しました。\n";
		$body2 .= "下記URLよりログインし、内容をご確認ください。\n";
		$body2 .= "尚、パスワードはセキュリティの関係上、別途メールにてお送り致します。\n";
		$body2 .= "URL：http://" . D_DOMAIN . "/\n";
		$body2 .= "ログインID：" . $_REQUEST['login_id'] . "\n";
		$body3 .= "----------------------------------------------\n";
		$body3 .= "■ ご登録内容についてのお問い合わせ窓口 ■\n";
		$body3 .= $pt[0]['name'] . "　担当：" . $pt[0]['rep_name'] . "\n";
		$body3 .= "e-mail：" . $pt[0]['rep_email'] . "\n";
		$body3 .= "--------------------------------------------- \n";

		$mail['to'] = $_REQUEST['rep_email'];
		$mail['subject'] = '【' . $pt[0]['name'] . '】　企業情報登録のお知らせ';
		$bodys = $body . $body2 . $body3;
		$mail['body'] = $bodys;
		$obj->sendMailer($mail);


		$body4 .= $pt[0]['name'] . "サポートデスクです。\n";
		$body4 .= "\n";
		$body4 .= $pt[0]['logo_name'] . "管理システムのログインに必要なパスワードをお知らせします。\n";
		$body4 .= "パスワード：" . $_REQUEST['login_pw'] . "\n";
		$body4 .= "尚、初回ログイン時にパスワードの変更をお勧め致します。\n";
		$body4 .= "\n";
		$body4 .= "以上、宜しくお願い致します。\n";
		$body4 .= "\n";

		$mail['to'] = $_REQUEST['rep_email'];
		$mail['subject'] = '【' . $pt[0]['name'] . '】　企業情報登録のお知らせ';
		$bodys = $body . $body4 . $body3;
		$mail['body'] = $bodys;
		$obj->sendMailer($mail);

		//------------------------------------------
		//
		//担当者にメール配信終わり
		//
		//------------------------------------------


		if ($_REQUEST['rep_email2']) {
			//------------------------------------------
			//
			//担当者2にメール配信
			//
			//------------------------------------------
			$body = "";
			$body = $_REQUEST['name'] . "\n" . $_REQUEST['rep_name2'] . "様\n";
			$body .= "貴社におかれましてはますますご清祥のことと\n";
			$body .= "お喜び申し上げます。\n";

			$mail['to'] = $_REQUEST['rep_email2'];
			$mail['subject'] = '【' . $pt[0]['name'] . '】　企業情報登録のお知らせ';
			$bodys = $body . $body2 . $body3;
			$mail['body'] = $bodys;
			$obj->sendMailer($mail);

			$mail['to'] = $_REQUEST['rep_email2'];
			$mail['subject'] = '【' . $pt[0]['name'] . '】　企業情報登録のお知らせ';
			$bodys = $body . $body4 . $body3;
			$mail['body'] = $bodys;
			$obj->sendMailer($mail);

			//------------------------------------------
			//
			//担当者2にメール配信終わり
			//
			//------------------------------------------
		}

		$html = "newRegist";
	} else {
		$html = "new";
	}
}
