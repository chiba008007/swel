<?PHP
//--------------------------------
//検査内容編集
//
//
//------------------------------------
ini_set('display_errors', "On");
include_once("./init/tensaku.php");
require_once("./lib/include_cusEdit.php");
$obj = new cusEditMethod();

$array_chg = array(
	"adds" => "の追加処理を行います。", "dels" => "の削除処理を行います。"
);
//パートナー情報取得
$where['id'] = $ptid;
$ptdata = $obj->getPtData($where);

//重みマスタデータの取得
$wt = array();
$wt['uid'] = $id;
$wt['pid'] = $ptid;
$weight = $obj->getWeightData($wt);
if (filter_input(INPUT_POST, "type") == "master") {
	$list = array();
	foreach ($weight as $key => $val) {
		if ($val['id'] == filter_input(INPUT_POST, 'id')) {
			$list['w1'] = $val['e_feel'];
			$list['w2'] = $val['e_cus'];
			$list['w3'] = $val['e_aff'];
			$list['w4'] = $val['e_cntl'];
			$list['w5'] = $val['e_vi'];
			$list['w6'] = $val['e_pos'];
			$list['w7'] = $val['e_symp'];
			$list['w8'] = $val['e_situ'];
			$list['w9'] = $val['e_hosp'];
			$list['w10'] = $val['e_lead'];
			$list['w11'] = $val['e_ass'];
			$list['w12'] = $val['e_adap'];
			$list['w13'] = $val['avg'];
			$list['w14'] = $val['hensa'];
		}
	}
	echo json_encode($list);
	exit();
}
//販売可能全体数の取得
$sell = $obj->getSellCount($where);

$i = 1;
$tamenflg = 0;
$testflg  = 0;
foreach ($sell as $key => $val) {
	if (preg_match("/^type/", $key)) {
		$ty = preg_replace("/^type/", "", $key);
		$lists[$ty] = $val;
		$i++;
	}
	//多面評価がある時
	if ($key == "type10") {
		$tamenflg = 1;
	} else {
		$testflg = 1;
	}
}
/*
if($sec == "Lists"){
	require_once("./mode/type3/regTestList.php");
	exit();
}
*/

//テストの最大キー取得
$max_key = max(array_keys($a_test_type));

//顧客情報取得
$where['id'] = $id;
$cdata = $obj->getPtData($where);
//説明データ取得
$exp['test_id'] = $sec;
$explain = $obj->getExplain($exp);

//pdfダウンロード数
$wherepdf = array();
$wherepdf['test_id'] = $sec;
$pdfcount = $obj->getPdfDLCount($wherepdf);

//テスト親データ
$where['id'] = $sec;
$where['partner_id'] = $ptid;
$where['customer_id'] = $id;
$tests = $obj->getTestData($where);
$expdf = explode(":", $tests['pdfdownload']);
if (!$_REQUEST['back']) {
	foreach ($expdf as $key => $val) {
		$pdfFlg[$val] = $val;
	}
}
$ex1 = explode("/", $tests['period_from']);
$ex2 = explode("/", $tests['period_to']);
$year1  = $ex1[0];
$month1 = $ex1[1];
$day1   = $ex1[2];
$year2  = $ex2[0];
$month2 = $ex2[1];
$day2   = $ex2[2];



//検査内容配列の修正
$other = $a_test_type;
$a_test_type = array();
foreach ($other as $key => $val) {
	if (isset($tests['type'][$key])) {
		$a_test_type[$key] = $val;
	}
}
//受検登録数・未受検数取得
$tCount = $obj->getTestCount($where, count($a_test_type));


//取得するタイプのカンマ区切り作成
$ty = implode("','", $tests['type']);
$where['tylist'] = $ty;
$detail = $obj->getTestDetail($where);
if (@count($detail)) {
	foreach ($detail as $key => $val) {
		$ta  = explode(":", $val['tamen_type']);
		$t = array();
		foreach ($ta as $k => $v) {
			$t[$v] = $v;
		}
		$detail[$key]['tamen_type'] = $t;

		//添削条件取得
		$tsk  = explode(";", $val['array_tensaku_text']);
		$t2 = array();
		foreach ($tsk as $k => $v) {
			$t2[$v] = $v;
		}
	}
	$detail[$key]['tensaku'] = $t2;
	$detail[$key]['tensaku_title'] = $val['array_tensaku_title_status'];
}

if ($_REQUEST['conf']) {

	$countErr = 0;
	//テストの数のエラーチェック
	foreach ($_REQUEST['count'] as $key => $val) {
		$ty = "";
		$k = preg_replace("/^on/", "", $key);
		$ty = "type" . $k;
		if ($tCount['mijyuken'] < $_REQUEST['RegNumber'] && $_REQUEST['editMan'] == "dels") {
			$countErr += 1;
		}
		if ($sell[$ty] < $_REQUEST['RegNumber'] && $_REQUEST['editMan'] == "adds") {
			$countErr += 1;
		}
	}
	if ($countErr) {
		$alert = "受検者数が多すぎます。";
		$html = "edit";
	} else {
		$html = "editConf";
	}
}
if ($_REQUEST['regist']) {

	$edit['edit']['registtime'] = date('Y-m-d H:i:s');
	$edit['where']['id'] = $id;
	$table = "t_user";
	$db->editUserData($table, $edit);
	$set = [];
	$set['company_name'] = $_SESSION['base_site_name'];
	$set['company_name_target'] = $_SESSION['name'];
	$set['testname'] = $_REQUEST['test_name'];

	$set['worktext'] = "検査変更";
	$set['testcount'] = $_REQUEST['RegNumber'];
	$set['detail'] = "日付/検査数";

	$db->setUserData("log", $set);


	$countErr = 0;
	//テストの数のエラーチェック
	foreach ($_REQUEST['count'] as $key => $val) {
		$ty = "";
		$k = preg_replace("/^on/", "", $key);
		$ty = "type" . $k;
		if ($tCount['mijyuken'] < $_REQUEST['RegNumber'] && $_REQUEST['editMan'] == "dels") {
			$countErr += 1;
		}

		if ($sell[$ty] < $_REQUEST['RegNumber'] && $_REQUEST['editMan'] == "adds") {
			$countErr += 1;
		}
	}
	if ($countErr) {
		//登録エラー
		header("Location:/");
		exit();
	}

	//テストweb申込のステータスの変更
	$table = "t_application";
	$edit = array();
	$edit['where']['cid'] = $id;
	$edit['where']['pid'] = $ptid;
	$edit['where']['status'] = 0;
	$edit['where']['type'] = 2;
	$edit['edit']['status'] = 1;
	$db->editUserData($table, $edit);
	$edit = [];
	//請求書用hidden項目作成
	$hidden = "";
	if ($_REQUEST['editMan'] == "adds" && $_REQUEST['RegNumber'] > 0) {
		if (@count($_REQUEST['pdf'])) {
			foreach ($_REQUEST['pdf'] as $key => $val) {
				$hidden .= "<input type='hidden' name='pdf[" . $key . "]' value='" . $key . "' >";
			}
		}
		if (@count($_REQUEST['count'])) {
			foreach ($_REQUEST['count'] as $key => $val) {
				$ty = preg_replace("/^on/", "", $key);
				$hidden .= "<input type='hidden' name='test[" . $ty . "]' value='" . $key . "' >";
			}
		}
		$hidden .= "<input type='hidden' name='RegNumber' value=" . $_REQUEST['RegNumber'] . ">";
	}

	//登録内容編集
	$where = array();
	$where['partner_id'] = $ptid;
	$where['customer_id'] = $id;
	$where['id'] = $sec;

	//ログイン用説明文登録
	//if($_REQUEST[ 'explain' ]){

	$explain = array();
	$explain['test_id'] = $sec;
	$explain['explain'] = $_REQUEST['explain'];
	$obj->setExplain($explain);
	//}
	//受検者数合計
	$total = $_REQUEST['RegNumber'] * count($_REQUEST['count']);
	$pdf = "";
	if ($_REQUEST['pdf'] && @count($_REQUEST['pdf'])) {
		foreach ($_REQUEST['pdf'] as $key => $val) {
			$pdf .= ":" . $key;
		}
	}
	$pdfdownload = preg_replace("/^:/", "", $pdf);
	if ($_REQUEST['editMan'] == "adds") {
		$edit[0]['number'] = "+" . $total;
		$plus = "on";
	} else {
		$edit[0]['number'] = "-" . $total;
		$mainasu = "on";
	}

	$edit[0]['test_name'] = $_REQUEST['test_name'];
	$edit[0]['fin_disp'] = $_REQUEST['fin_disp'];
	if ($basetype == 1) {
		$edit[0]['enq_status'] = $_REQUEST['enq_status'];
	}
	if ($basetype == 1) {
		$edit[0]['pdf_slice'] = $_REQUEST['pdf_slice'];
	}

	$edit[0]['period_from'] = sprintf("%04d/%02d/%02d", $_REQUEST['year1'], $_REQUEST['month1'], $_REQUEST['day1']);
	$edit[0]['period_to'] = sprintf("%04d/%02d/%02d", $_REQUEST['year2'], $_REQUEST['month2'], $_REQUEST['day2']);

	$edit[0]['editMan'] = $_REQUEST['editMan'];
	$edit[0]['rest_mail_count'] = $_REQUEST['rest_mail_count'];
	$edit[0]['recommen'] = $_REQUEST['recommen'];
	$edit[0]['licensecard'] = $_REQUEST['licensecard'];
	$edit[0]['excel_type'] = $_REQUEST['excel_type'];
	$edit[0]['judge_login'] = $_REQUEST['judge_login'];
	$edit[0]['input_not_name'] = ($_REQUEST['input_not_name']) ? 1 : 0;
	$edit[0]['input_not_gender'] = ($_REQUEST['input_not_gender']) ? 1 : 0;

	$edit[0]['youtubeflag'] = $_REQUEST['youtubeflag'];
	$edit[0]['youtube'] = $_REQUEST['youtube'];
	if ($basetype == 1) {
		$edit[0]['pdfdownload'] = $pdfdownload;
		$edit[0]['pdf_output_limit'] = filter_input(INPUT_POST, "pdf_output_limit");
		$edit[0]['pdf_output_limit_from'] = preg_replace("/\//", "-", filter_input(INPUT_POST, "pdf_output_limit_from"));
		$edit[0]['pdf_output_limit_to'] = preg_replace("/\//", "-", filter_input(INPUT_POST, "pdf_output_limit_to"));
		$edit[0]['pdf_output_count'] = filter_input(INPUT_POST, "pdf_output_count");
		$edit[0]['pdf_output_limit_count'] = filter_input(INPUT_POST, "pdf_output_limit_count");


		$edit[0]['exam_download'] = ($_REQUEST['exam_download']) ? 1 : 0;
	}

	if ($basetype == 1 || $tests['enabled'] == 1) {

		$edit[0]['enabled'] = 1;
	}

	$edit[0]['test_show_hide'] = $_REQUEST['test_show_hide'];
	if ($_REQUEST['stress'] && @count($_REQUEST['stress'])) {
		$edit[0]['stress_flg'] = 1;
	} else {
		$edit[0]['stress_flg'] = 0;
	}
	//タイプ配列の作成
	foreach ($_REQUEST['count'] as $key => $val) {
		$ty = preg_replace("/^on/", "", $key);
		$typeList[$ty] = $ty;
	}
	//登録データ
	$set = array();
	$max = $obj->getNum($where);
	$set['max'] = $max['max'];
	//データ変更用ID取得
	$tidList = $obj->getTestID($where);

	foreach ($typeList as $key => $val) {
		if ($_REQUEST['RegNumber'] != 0) {
			//検査ログデータ
			$log = array();
			$log['cid'] = $id;
			$log['pid'] = $ptid;
			$log['test_id'] = $tidList[$key];
			$log['tname'] = $_REQUEST['test_name'];
			$log['number'] = $_REQUEST['RegNumber'];
			$log['type'] = $key;
			if ($_REQUEST['editMan'] == "adds") {
				$log['status'] = 1;
			} else {
				$log['status'] = 2;
			}
			$logtbl = "log_testpaper";
			$db->setUserData($logtbl, $log);
		}

		if ($plus) {
			$edit[$key]['test_name'] = $_REQUEST['test_name'];
			$edit[$key]['number'] = "+" . $_REQUEST['RegNumber'];
		} else {
			$edit[$key]['number'] = "-" . $_REQUEST['RegNumber'];
			$edit[$key]['test_name'] = $_REQUEST['test_name'];
		}

		$edit[$key]['test_show_hide'] = $_REQUEST['test_show_hide'];

		$edit[$key]['fin_disp'] = $_REQUEST['fin_disp'];
		$edit[$key]['period_from'] = sprintf(
			"%04d/%02d/%02d",
			$_REQUEST['year1'],
			$_REQUEST['month1'],
			$_REQUEST['day1']
		);
		$edit[$key]['period_to'] = sprintf(
			"%04d/%02d/%02d",
			$_REQUEST['year2'],
			$_REQUEST['month2'],
			$_REQUEST['day2']
		);
		$edit[$key]['pdfdownload'] = $pdfdownload;

		$edit[$key]['weightchecked'] = $_REQUEST['weightchecked'][$key];


		if (isset($_REQUEST['weight']) ) {
			foreach ($_REQUEST['weight'][$key] as $k => $v) {
				$edit[$key]['weight'][$k] = $v;
			}
		}
		$edit[$key]['download_excel'] = $_REQUEST['download_excel'][$key];
		$on = "on" . $key;
		$edit[$key]['minute_rest'] = $_REQUEST['minute_rest'][$on];
		$edit[$key]['vf4_object'] = $_REQUEST['vf4_object'][$key];
		$edit[$key]['rsei_type'] = $_REQUEST['rsei'][$key];
		$edit[$key]['mhq_type'] = $_REQUEST['mhq_type'][$key];



		//添削を選択した際の処理
		if (isset($_REQUEST['array_tensaku_title'])) {
			$edit[$key]['array_tensaku_title_status'] = implode(";", $_REQUEST['array_tensaku_title']);
		}
		$tensaku_line = "";
		if ($_REQUEST['array_tensaku_title'] && @count($_REQUEST['array_tensaku_title'])) {
			foreach ($_REQUEST['array_tensaku_title'] as $tk => $tv) {
				if (count($_REQUEST['tensakukey'][$tk])) {
					foreach ($_REQUEST['tensakukey'][$tk] as $tkey => $tval) {
						$tensaku_line .= ";" . $tkey;
					}
					$tensaku_line = preg_replace("/^;/", "", $tensaku_line);
					$edit[$key]['array_tensaku_text'] = $tensaku_line;
				}
			}
		}
		if ($_REQUEST['stress'][$key]) {
			$edit[$key]['stress_flg'] = 1;
		} else {
			$edit[$key]['stress_flg'] = 0;
		}
		if ($_REQUEST['tamen_type'] && @count($_REQUEST['tamen_type'])) {
			$ta = implode(":", $_REQUEST['tamen_type']);
			$edit[$key]['tamen_type'] = $ta;
		}
		//テスト詳細用データ
		$set['set'][$key]['count'] = $_REQUEST['RegNumber'];
		$set['set'][$key]['testgrp_id'] = $sec;
		$set['set'][$key]['type'] = $key;
		$set['set'][$key]['partner_id'] = $ptid;
		$set['set'][$key]['customer_id'] = $id;
		$set['set'][$key]['test_id'] = $tidList[$key];

		//添削を選択した際の処理
		if (isset($_REQUEST['array_tensaku_title'])) {
			$set[$key]['array_tensaku_title_status'] = implode(";", $_REQUEST['array_tensaku_title']);
		}
		$tensaku_line = "";
		if ($_REQUEST['array_tensaku_title'] && @count($_REQUEST['array_tensaku_title'])) {
			foreach ($_REQUEST['array_tensaku_title'] as $tk => $tv) {
				if (@count($_REQUEST['tensakukey'][$tk])) {
					foreach ($_REQUEST['tensakukey'][$tk] as $tkey => $tval) {
						$tensaku_line .= ";" . $tkey;
					}
					$tensaku_line = preg_replace("/^;/", "", $tensaku_line);
					$set[$key]['array_tensaku_text'] = $tensaku_line;
				}
			}
		}
	}


	$testCount = $obj->getCountTests($where);
	$testallCount = $testCount + $_REQUEST['RegNumber'];
	//テスト詳細用exam_id
	for ($i = 1; $i <= $_REQUEST['RegNumber']; $i++) {
		$num = $max['max'] + $i;
		$exam[$num] = $obj->getExam($where, $totalCount);
	}
	$obj->editTestData($where, $edit, $basetype);
	if ($_REQUEST['editMan'] == "adds" && $_REQUEST['RegNumber'] > 0) {
		//テスト追加処理
		$obj->setTestData($set, $exam);
	} elseif ($_REQUEST['editMan'] == "dels" && $_REQUEST['RegNumber'] > 0) {
		//テスト削除処理
		//削除件数
		$delCnt = $_REQUEST['RegNumber'];
		$obj->setTestDelete($set, $delCnt, count($a_test_type));
	}
	//enabledステータスの変更
	if ($basetype == 1 ||  $tests['enabled'] == 1) {
		$obj->editTestenabled($set);
	}


	$html = "editRegist";

	//メール配信

	//パートナーデータ取得
	$pdata = array();
	$where['id'] = $ptid;
	$pdata = $db->getUser($where);
	//顧客データ取得
	$cdata = array();
	$where['id'] = $id;
	$cdata = $db->getUser($where);


	//-----------------------------------------------
	//顧客メール配信
	//----------------------------------------------
	$body1 = "";
	$body1 = $cdata[0]['name'] . "　" . $cdata[0]['rep_name'] . "様\n\n";
	$body1 .= "サポートデスクよりお知らせです。\n\n";

	$body1 .= "検査情報を追加、更新が完了致しました。\n\n";
	$body1 .= "下記ＵＲＬよりログインして、ご確認下さい。\n";
	$body1 .= "URL：" . D_URLS_HOME . "\n";
	$body1 .= "\n";
	$body1 .= "検査名：" . $_REQUEST['test_name'] . "\n";
	$body1 .= "\n";
	$body1 .= "以上、宜しくお願い致します。\n\n";
	$mail = array();
	$mail['subject'] = "【" . $pdata[0]['name'] . "】　検査受検更新のお知らせ";
	$mail['to'] = $cdata[0]['rep_email'];
	$mail['body'] = $body1;
	$db->sendMailer($mail);

	if ($cdata[0]["rep_email2"]) {
		$body1 = "";
		$body1 = $cdata[0]['name'] . "　" . $cdata[0]['rep_name2'] . "様\n\n";
		$body1 .= "サポートデスクよりお知らせです。\n\n";

		$body1 .= "検査情報を追加、更新が完了致しました。\n\n";
		$body1 .= "下記ＵＲＬよりログインして、ご確認下さい。\n";
		$body1 .= "URL：" . D_URLS_HOME . "\n";
		$body1 .= "\n";
		$body1 .= "検査名：" . $_REQUEST['test_name'] . "\n";
		$body1 .= "\n";
		$body1 .= "以上、宜しくお願い致します。\n\n";
		$mail = array();
		$mail['subject'] = "【" . $pdata[0]['name'] . "】　検査受検更新のお知らせ";
		$mail['to'] = $cdata[0]['rep_email2'];
		$mail['body'] = $body1;
		$db->sendMailer($mail);
	}

	//-----------------------------------------------
	//管理者メール配信
	//----------------------------------------------
	$ms = $db->getMasterData($where);

	$body1 = "";
	$body1 = $cdata[0]['name'] . "　" . $cdata[0]['rep_name'] . "様\n\n";
	$body1 .= "サポートデスクよりお知らせです。\n\n";

	$body1 .= "検査情報を追加、更新が完了致しました。\n\n";
	$body1 .= "下記ＵＲＬよりログインして、ご確認下さい。\n";
	$body1 .= "URL：" . D_URLS_HOME . "\n";
	$body1 .= "\n";
	$body1 .= "検査名：" . $_REQUEST['test_name'] . "\n";
	$body1 .= "\n";
	$body1 .= "以上、宜しくお願い致します。\n\n";
	$mail = array();
	$mail['subject'] = "【" . $pdata[0]['name'] . "】検査受検更新のお知らせ";
	$mail['to'] = $ms['rep_email'];
	$mail['body'] = $body1;
	$db->sendMailer($mail);
}
