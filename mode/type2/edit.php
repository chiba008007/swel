<?PHP
//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusChg.php");

$obj = new cusChgMethod();
//顧客表示用配列
$array_customer_display = [];
//$array_customer_display = ['非表示', '表示'];
$array_customer_display[1] = '表示';
$array_customer_display[0] = '非表示';
//パートナー用データ
$where = array();
$where['id'] = $id;
$pdata = $db->getUser($where);

$ptTestBtn = $pdata[0]['ptTestBtn'];

//--------------
//IDチェック
//--------------
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

//登録情報取得
$where['id'] = $sec;
$data = $obj->getUser($where);
// テストデータ取得
$where = [];
$where['customer_id'] = $data['id'];
$where['partner_id'] = $data['partner_id'];
$hidecount = $obj->getTestHideCount($where);

//登録画像データ取得
$login_id = $data['login_id'];
$glob = glob("./img/" . $login_id . "*");
$logo = preg_replace("/^\./", "", $glob[0]);
//プレビュー用ディレクトリの作成
$pre = D_PATH_HOME . "images/preview/";
@mkdir($pre);

if ($_REQUEST['conf']) {
	//画像の真偽の確認
	$prev   = preg_replace("/\"|\\\/", "", $_REQUEST['previewImgId']);
	$fname  = basename($prev);
	$imgPath = $fname . "." . $_REQUEST['pv'];
	$ext = pathinfo($imgPath, PATHINFO_EXTENSION);
	//IDチェック
	if ($_REQUEST['idchk'] != $_REQUEST['login_id']) {
		$chkid['login_id'] = $_REQUEST['login_id'];
		$chk = $obj->idCheck($chkid);
		if ($chk) {
			$err = 1;
			$alert = "すでに利用されたＩＤです。再登録をお願いします。";
		}
	}
	$html = "editConf";
}


if ($_REQUEST['regist']) {
	$err = "";
	//IDチェック
	if ($_REQUEST['idchk'] != $_REQUEST['login_id']) {
		$chkid['login_id'] = $_REQUEST['login_id'];
		$chk = $obj->idCheck($chkid);
		if ($chk) {
			$err = 1;
			$alert = "すでに利用されたＩＤです。再登録をお願いします。";
		}
	}
	if (!$err) {

		$set = [];

		$set['company_name'] = $_SESSION['base_site_name'];
		$set['company_name_target'] = $_REQUEST['name'];
		$set['worktext'] = "対象企業編集";
		$db->setUserData("log", $set);


		$edit['where']['id'] = $sec;
		$edit['edit']['name'] = $_REQUEST['name'];
		$edit['edit']['login_id'] = $_REQUEST['login_id'];
		$edit['edit']['login_pw'] = $_REQUEST['login_pw'];
		$edit['edit']['post1'] = $_REQUEST['post1'];
		$edit['edit']['post2'] = $_REQUEST['post2'];
		$edit['edit']['prefecture'] = $_REQUEST['pref'];
		$edit['edit']['address1'] = $_REQUEST['address1'];
		$edit['edit']['address2'] = $_REQUEST['address2'];
		$edit['edit']['tel'] = $_REQUEST['tel'];
		$edit['edit']['fax'] = $_REQUEST['fax'];
		if (strlen($_REQUEST['csvupload']) > 0) {
			$edit['edit']['csvupload'] = $_REQUEST['csvupload'];
		}
		if ($basetype == 1) {
			$edit['edit']['pdf_button'] = $_REQUEST['pdf_button'];
			$edit['edit']['pdf_master_status'] = $_REQUEST['pdf_master_status'];
			$edit['edit']['excel_master_status'] = $_REQUEST['excel_master_status'];
			$edit['edit']['exam_pattern'] = $_REQUEST['exam_pattern'];
		}
		$edit['edit']['privacy_flg'] = $_REQUEST['privacy_flg'];
		$edit['edit']['rep_name'] = $_REQUEST['rep_name'];
		$edit['edit']['rep_email'] = $_REQUEST['rep_email'];
		$edit['edit']['rep_busyo'] = $_REQUEST['rep_busyo'];
		$edit['edit']['rep_tel1'] = $_REQUEST['rep_tel1'];
		$edit['edit']['rep_tel2'] = $_REQUEST['rep_tel2'];
		$edit['edit']['rep_name2'] = $_REQUEST['rep_name2'];
		$edit['edit']['rep_email2'] = $_REQUEST['rep_email2'];
		$edit['edit']['csTestBtn'] = $_REQUEST['csTestBtn'];
		$edit['edit']['privacy_flg'] = $_REQUEST['privacy_flg'];
		$edit['edit']['ssltype'] = $_REQUEST['ssltype'];
		$edit['edit']['customer_file_upload'] = $_REQUEST['customer_file_upload'];
		$edit['edit']['privacypolicy'] = $_REQUEST['privacypolicy'];
		$edit['edit']['privacypolicy_text'] = $_REQUEST['privacypolicy_text'];
		$edit['edit']['customer_display'] = $_REQUEST['customer_display'];

		if($data[ 'login_pw' ] != $_REQUEST['login_pw']){
			$edit[ 'edit'  ][ 'password_editdate' ] = date("Y-m-d");
		}
		$table = "t_user";
		$obj->editUserData($table, $edit);

		if ($_REQUEST['logodel'] == "on") {
			$glob = glob("./img/" . $_REQUEST['idchk'] . ".*");
			if (file_exists($glob[0])) {
				@unlink($glob[0]);
			}
		} else {
			//画像処理
			if ($_REQUEST['pv']) {
				$glob = glob("./img/" . $_REQUEST['login_id'] . ".*");
				foreach ($glob as $key => $val) {
					unlink($val);
				}
				@rename("./images/preview/" . $_REQUEST['imgfilename'] . "." . $_REQUEST['pv'], "./img/" . $_REQUEST['login_id'] . "." . $_REQUEST['pv']);
				//	@unlink("./images/preview/".$_REQUEST[ 'imgfilename' ].".".$_REQUEST[ 'pv' ]);
			}
		}
		//画像ディレクトリID変更
		if ($glob[0]) {
			$exts = split("[/\\.]", $glob[0]);
			$n = count($exts) - 1;
			$ext = $exts[$n];
			@rename($glob[0], "./img/" . $_REQUEST['login_id'] . "." . $ext);
		}

		//パートナーデータの取得
		$where = array();
		$where['id'] = $sec;
		$pt = $db->getUser($where);
		//------------------------------------------------
		//メール配信処理
		//------------------------------------------------
		$mail['subject'] = '【' . $pt[0]['name'] . '】　企業情報登録のお知らせ';
		$mail['to'] = $_REQUEST['rep_email'];

		$body = "";
		$body = $_REQUEST['name'] . "\n" . $_REQUEST['rep_name'] . "様\n";
		$body .= "\n";
		$body .= $pt[0]['name'] . "サポートデスクです。\n";
		$body .= "\n";
		$body .= "貴社におかれましてはますますご清祥のことと\n";
		$body .= "お喜び申し上げます。\n";
		$body .= "\n";
		$body .= "顧客情報変更が完了致しました。\n";
		$body .= "尚、パスワードをお忘れの際はサポートデスクまでご連絡ください。 \n";
		$body .= "ログインID：" . $_REQUEST['login_id'] . "\n";
		$body .= "\n";
		$body .= "以上、宜しくお願い致します。\n";
		$body .= "\n";
		$mail['body'] = $body;
		$db->sendMailer($mail);


		if ($_REQUEST['rep_email2']) {
			//------------------------------------------------
			//メール配信処理2
			//------------------------------------------------
			$mail['subject'] = '【' . $pt[0]['name'] . '】　企業情報登録のお知らせ';
			$mail['to'] = $_REQUEST['rep_email2'];

			$body = "";
			$body = $_REQUEST['name'] . "\n" . $_REQUEST['rep_name2'] . "様\n";
			$body .= "\n";
			$body .= $pt[0]['name'] . "サポートデスクです。\n";
			$body .= "\n";
			$body .= "貴社におかれましてはますますご清祥のことと\n";
			$body .= "お喜び申し上げます。\n";
			$body .= "\n";
			$body .= "顧客情報変更が完了致しました。\n";
			$body .= "尚、パスワードをお忘れの際はサポートデスクまでご連絡ください。 \n";
			$body .= "ログインID：" . $_REQUEST['login_id'] . "\n";
			$body .= "\n";
			$body .= "以上、宜しくお願い致します。\n";
			$body .= "\n";
			$mail['body'] = $body;
			$db->sendMailer($mail);
		}
		$html = "editRegist";
	}
}
