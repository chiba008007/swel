<?PHP
//-------------------------------------------
//PDFダウンロード
//
//
//
//
//
//-------------------------------------------
ini_set("display_errors", "On");
require_once("./lib/include_pdf.php");
require_once("./lib/include_makePDF.php");
require_once("./lib/include_cusDown.php");

require_once('./lib/jpgraph4/src/jpgraph.php');
require_once('./lib/jpgraph4/src/jpgraph_bar.php');




error_log("[" . date('Y-m-d H:i:s') . "]" . "PDF出力しましたテスト。\n", 3, D_PATH_HOME . "/logs/debugPDF.log");

$obj = new pdfMethod();
$objw = new cusDownMethod();


//-------------------------------------
//PDFログ登録
//-------------------------------------
$set = [];

$set['company_name'] = $_SESSION['base_site_name'];
$set['company_name_target'] = $_SESSION['name'];
$set['testname'] = $testdata['testname'];

$set['worktext'] = "結果出力";
$set['detail'] = "pdf";

$db->setUserData("log", $set);


$set = array();
$set['exam_id'] = $third;
$set['partner_id'] = $ptid;
$set['customer_id'] = $id;
$set['test_name'] = $test_name;
$set['exam_name'] = $name;
$set['test_id'] = $sec;
$set['test_id'] = $sec;
$set['pdf_type'] = $testdata['pdfdownload'];
$set['pdf_auth'] = $basetype;
$set['ip'] =  $_SERVER["REMOTE_ADDR"];
$obj->setPdfLog($set);


//elementデータの取得
$ewhere = array();
$ewhere['uid'] = $ptid;
$elem = $obj->getElementLists($ewhere);
if (!$elem) {
	$elem = [];
	foreach ($a_element2 as $key => $value) {
		$elem[$key] = $value;
	}
}


require_once('./TCPDF-main/tcpdf.php');
require_once('./FPDI-2.3.7/src/autoload.php');

use setasign\Fpdi\TcpdfFpdi;

if ($_REQUEST['code']) {
	$pdf = new TcpdfFpdi('L');
} else {
	$pdf = new TcpdfFpdi();
}

//$pdf = new TCPDF('P', 'mm', 'A4',true, 'UTF-8',false,false);
$pdf->SetAutoPageBreak(false);
$pdf->setPrintHeader(false);
$pdf->AddPage();
$pdf->setFont('msgothic', '', 10);
$pdf->SetMargins(0, 0, 0);


//パートナーデータ取得
$where['id'] = $ptid;
$user = $obj->getUser($where);

$make = new makePDF($user[0]['login_id']);


$where = array();
$where['testgrp_id'] = $sec;
$where['exam_id'] = $third;
$where['partner_id'] = $ptid;
$where['customer_id'] = $id;
//受検データ取得
$testdata  = $obj->getTestData($where);

$testline = $obj->getTestLine($where, $a_test_type);

$pdfcount = (int)$testdata['pdf_output_count'];

//PDF出力数
$getpdf = $obj->getPdfLog($sec);
$todaylimit = date("Y-m-d");


$testdata['exam_id'] = $third;
$stsflg = $testdata['stress_flg'];

$test_name = $testdata['testname'];
$test_name = mb_convert_encoding($testdata['testname'], "SJIS", "UTF-8");
$name = mb_convert_encoding($testdata['name'], "SJIS", "UTF-8");

$pdfline = explode(":", $testdata['pdfdownload']);
// 証明書の時はpdflineにから配列を渡す
if ($_REQUEST['code'] == 'lisence' || $_REQUEST['code'] == 'PDF') {
	$pdfline = [];
}

if (
	in_array("1", $pdfline)
	|| in_array("2", $pdfline)
	|| in_array("5", $pdfline)
	|| in_array("22", $pdfline)
	|| in_array("24", $pdfline)
	|| in_array("28", $pdfline)
	|| in_array("30", $pdfline)
	|| in_array("31", $pdfline)
	|| in_array("34", $pdfline)
) {
	$types = array(1, 2, 5, 12, 59, 72, 73, 82);
	$testdata['type'] = $obj->getTestPaper($where, $types);
	if ($five && $_REQUEST['code'] != "PDF") {
		//マスタデータがあるときは値の再設定

		if (in_array("2", $pdfline)) {
			//重みデータ取得
			$wtwhere = array();
			$wtwhere['id'] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
		if (in_array("28", $pdfline)) {
			//重みデータ取得
			$wtwhere = array();
			$wtwhere['id'] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}

		if (in_array("30", $pdfline)) {
			//重みデータ取得
			$wtwhere = array();
			$wtwhere['id'] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
		if (in_array("31", $pdfline)) {
			//重みデータ取得
			$wtwhere = array();
			$wtwhere['id'] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
		if (in_array("34", $pdfline)) {
			//重みデータ取得
			$wtwhere = array();
			$wtwhere['id'] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
		$masterType = array();
		foreach ($type as $k => $v) {
			$masterType[$v] = $v;
		}
		//BAJ1
		$wtwhere = array();
		$wtwhere['cid'] = $id;
		$wtwhere['pid'] = $ptid;
		$wtwhere['exam_id'] = $third;
		$wtwhere['testgrp_id'] = $sec;
		if (in_array("1", $masterType)) {
			include_once(D_PATH_HOME . "/lib/keisan/functionBA.php");
			include_once(D_PATH_HOME . "/init/rowData/raw_data_ta.php");
			include_once(D_PATH_HOME . "/init/rowData/dev_data_ta.php");
			//回答データ取得
			$wpaper = $obj->getAnswerPaper($wtwhere, 1);
			list($rowdata, $lv, $standard_score, $dev_number) = BA($wpaper, $wtm, $raw_data, $dev_data, 1);
			//取得データの書き換え
			$testdata['type']['dev1'] = round($rowdata['dev1'], 4);
			$testdata['type']['dev2'] = round($rowdata['dev2'], 4);
			$testdata['type']['dev3'] = round($rowdata['dev3'], 4);
			$testdata['type']['dev4'] = round($rowdata['dev4'], 4);
			$testdata['type']['dev5'] = round($rowdata['dev5'], 4);
			$testdata['type']['dev6'] = round($rowdata['dev6'], 4);
			$testdata['type']['dev7'] = round($rowdata['dev7'], 4);
			$testdata['type']['dev8'] = round($rowdata['dev8'], 4);
			$testdata['type']['dev9'] = round($rowdata['dev9'], 4);
			$testdata['type']['dev10'] = round($rowdata['dev10'], 4);
			$testdata['type']['dev11'] = round($rowdata['dev11'], 4);
			$testdata['type']['dev12'] = round($rowdata['dev12'], 4);
			$testdata['type']['soyo'] =  $dev_number;
			$testdata['level'] =  $lv;
			$testdata['score'] =  $standard_score;
		}
		if (in_array("59", $masterType)) {
			include_once(D_PATH_HOME . "/lib/keisan/functionBA.php");
			include_once(D_PATH_HOME . "/init/rowData/raw_data_ta.php");
			include_once(D_PATH_HOME . "/init/rowData/dev_data_ta.php");
			//回答データ取得
			$wpaper = $obj->getAnswerPaper($wtwhere, 59);
			list($rowdata, $lv, $standard_score, $dev_number) = BA($wpaper, $wtm, $raw_data, $dev_data, 1);
			//取得データの書き換え
			$testdata['type']['dev1'] = round($rowdata['dev1'], 4);
			$testdata['type']['dev2'] = round($rowdata['dev2'], 4);
			$testdata['type']['dev3'] = round($rowdata['dev3'], 4);
			$testdata['type']['dev4'] = round($rowdata['dev4'], 4);
			$testdata['type']['dev5'] = round($rowdata['dev5'], 4);
			$testdata['type']['dev6'] = round($rowdata['dev6'], 4);
			$testdata['type']['dev7'] = round($rowdata['dev7'], 4);
			$testdata['type']['dev8'] = round($rowdata['dev8'], 4);
			$testdata['type']['dev9'] = round($rowdata['dev9'], 4);
			$testdata['type']['dev10'] = round($rowdata['dev10'], 4);
			$testdata['type']['dev11'] = round($rowdata['dev11'], 4);
			$testdata['type']['dev12'] = round($rowdata['dev12'], 4);
			$testdata['type']['soyo'] =  $dev_number;
			$testdata['level'] =  $lv;
			$testdata['score'] =  $standard_score;
		}

		if (in_array("2", $masterType)) {
			include_once(D_PATH_HOME . "/lib/keisan/functionBA2.php");
			include_once(D_PATH_HOME . "/init/rowData/raw_data_tb.php");
			include_once(D_PATH_HOME . "/init/rowData/dev_data_tb.php");
			//回答データ取得
			$wpaper = $obj->getAnswerPaper($wtwhere, 2);
			list($rowdata, $lv, $standard_score, $dev_number) = BA2($wpaper, $wtm, $raw_data, $dev_data, 1);
			//取得データの書き換え
			$testdata['type']['dev1'] = round($rowdata['dev1'], 4);
			$testdata['type']['dev2'] = round($rowdata['dev2'], 4);
			$testdata['type']['dev3'] = round($rowdata['dev3'], 4);
			$testdata['type']['dev4'] = round($rowdata['dev4'], 4);
			$testdata['type']['dev5'] = round($rowdata['dev5'], 4);
			$testdata['type']['dev6'] = round($rowdata['dev6'], 4);
			$testdata['type']['dev7'] = round($rowdata['dev7'], 4);
			$testdata['type']['dev8'] = round($rowdata['dev8'], 4);
			$testdata['type']['dev9'] = round($rowdata['dev9'], 4);
			$testdata['type']['dev10'] = round($rowdata['dev10'], 4);
			$testdata['type']['dev11'] = round($rowdata['dev11'], 4);
			$testdata['type']['dev12'] = round($rowdata['dev12'], 4);
			$testdata['type']['soyo'] =  $dev_number;
			$testdata['level'] =  $lv;
			$testdata['score'] =  $standard_score;
		}
		if (in_array("12", $masterType) || in_array("72", $masterType) || in_array("82", $masterType)) {
			include_once(D_PATH_HOME . "/lib/keisan/functionBA12.php");
			include_once(D_PATH_HOME . "/init/rowData/raw_data_ta3.php");
			include_once(D_PATH_HOME . "/init/rowData/dev_data_ta3.php");
			//回答データ取得
			if (in_array("82", $masterType)) {
				$wpaper = $obj->getAnswerPaper($wtwhere, 82);
			} else if (in_array("72", $masterType)) {
				$wpaper = $obj->getAnswerPaper($wtwhere, 72);
			} else {
				$wpaper = $obj->getAnswerPaper($wtwhere, 12);
			}
			list($rowdata, $lv, $standard_score, $dev_number) = BA12($wpaper, $wtm, $raw_data, $dev_data);
			//取得データの書き換え
			$testdata['type']['dev1'] = round($rowdata['dev1'], 4);
			$testdata['type']['dev2'] = round($rowdata['dev2'], 4);
			$testdata['type']['dev3'] = round($rowdata['dev3'], 4);
			$testdata['type']['dev4'] = round($rowdata['dev4'], 4);
			$testdata['type']['dev5'] = round($rowdata['dev5'], 4);
			$testdata['type']['dev6'] = round($rowdata['dev6'], 4);
			$testdata['type']['dev7'] = round($rowdata['dev7'], 4);
			$testdata['type']['dev8'] = round($rowdata['dev8'], 4);
			$testdata['type']['dev9'] = round($rowdata['dev9'], 4);
			$testdata['type']['dev10'] = round($rowdata['dev10'], 4);
			$testdata['type']['dev11'] = round($rowdata['dev11'], 4);
			$testdata['type']['dev12'] = round($rowdata['dev12'], 4);
			$testdata['type']['soyo'] =  $dev_number;
			$testdata['level'] =  $lv;
			$testdata['score'] =  $standard_score;
		}
	}
	//ストレスレベルスコア取得
	if ($stsflg == 1) {
		list($st_level, $st_score) = $obj->getStress2($testdata['type']['dev1'], $testdata['type']['dev2'], $testdata['type']['dev6']);
	} else {
		list($st_level, $st_score) = $obj->getStress($testdata['type']['dev1'], $testdata['type']['dev2']);
	}
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する

	$testweight[0] = $obj->getWeight($where, $types);
	if ($five && $_REQUEST['code'] != "PDF") {
		//マスタデータがあるときは重みの再設定
		$testweight = array();
		$testweight[0] = $wtm;
	}
	$sum = [];
	foreach ($testweight as $key => $val) {
		if ($val) {
			$sum[$key] = array_sum($val);
		}
	}
	foreach ($sum as $key => $val) {
		if ($val != 0) {
			$testweightkey = $key;
		}
	}
	if ($testweightkey && $testweight[$testweightkey]) {
		$testweight[0] = $weight[$testweightkey];
	}

	$name = mb_convert_encoding($name, "utf-8", "sjis");
	$ques = "3." . $name . " さんへの質問例";
	$ques2 = "3." . $name . " さんの強み";
	$ques = mb_convert_encoding($ques, "sjis-win", "UTF-8");
	$ques2 = mb_convert_encoding($ques2, "sjis-win", "UTF-8");
	require_once("./mode/pdf/pdf1_2_comment.php");
}

include("./lib/jpgraph4/src/jpgraph_radar.php");

if (in_array("1", $pdfline)) {
	if ($plus) {
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf1.php");
	$plus++;
}


////------------------------------------------
//行動価値検査結果レポート（面接版適合あり）出力
//------------------------------------------
if (
	in_array("2", $pdfline)
) {
	if ($plus) {
		$pdf->AddPage();
	}

	require_once("./mode/pdf/pdf2.php");
	$plus++;
}


//-------------------------------------
//行動価値検査結果レポート（自己理解版）
//-------------------------------------
if (in_array("5", $pdfline)) {
	if ($plus) {
		$pdf->AddPage();
	}
	$pdftype = 5;
	require_once("./mode/pdf/pdf5.php");
	$plus++;
}

//-------------------------------------
//行動価値検査結果レポート（自己理解版）終わり
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート（自己理解版）
//-------------------------------------
if (in_array("24", $pdfline)) {
	if ($plus) {
		$pdf->AddPage();
	}
	$pdftype = 24;
	require_once("./mode/pdf/pdf24.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（自己理解版）終わり
//-------------------------------------

//-------------------------------------
//感情能力検査結果レポート
//-------------------------------------

if (in_array("4", $pdfline)) {
	if ($plus) {
		$pdf->AddPage();
	}
	$pdftype = 4;
	require_once("./mode/pdf/pdf4.php");
	$plus++;
}
//-------------------------------------
//感情能力検査結果レポート(終わり)
//-------------------------------------


//-------------------------------------
//感情能力検査結果レポート
//-------------------------------------
if (in_array("17", $pdfline)) {
	if ($plus) {
		$pdf->AddPage();
	}
	$pdftype = 17;
	require_once("./mode/pdf/pdf17_comment.php");
	$rs17 = $obj->getPdfDataRs($where);
	require_once("./mode/pdf/pdf17.php");
	$plus++;
}
//-------------------------------------
//感情能力検査結果レポート(終わり)
//-------------------------------------


//-------------------------------------
//行動価値検査結果レポート（面接詳細版１）
//-------------------------------------
if (in_array("12", $pdfline)) {

	require_once("./mode/pdf/pdf12_comment.php");
	$types = array(1, 2, 12, 72, 73);
	$testdata['type'] = $obj->getTestPaper($where, $types);

	foreach ($testdata['type'] as $key => $val) {
		if (preg_match("/^dev/", $key)) {
			$devlist[$key] = $val;
		}
	}
	asort($devlist);
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where, $type);
	if ($testdata['weight'] == 0) {
		//weight=0の時重みあり
		//重みのあるものを優先にする
		$weight = $testweight[0];
		foreach ($weight as $key => $val) {
			if ($key != "weight") {
				$keys = preg_replace("/w/", "dev", $key);
				if ($val == 0) {
					$wgt[$keys] = 0;
				} else {
					$wgt[$keys] = 1;
				}
			}
		}
		$i = 1;
		foreach ($devlist as $key => $val) {
			$dlists[$i]['key'] = $key;
			$dlists[$i]['value'] = $val;
			$num = preg_replace("/^dev/", "", $key);
			$dlists[$i]['num'] = $num;
			$dlists[$i]['w'] = $wgt[$key];
			$i++;
		}

		//wの降順で並び替えさらにvalueの昇順で並び替え
		foreach ($dlists as $key => $val) {
			$key_w[$key]     = $val['w'];
			$key_value[$key] = $val['value'];
		}
		array_multisort($key_w, SORT_DESC, $key_value, SORT_ASC, $dlists);

		$i = 1;

		foreach ($dlists as $key => $val) {
			if ($val['value'] <= 50) {
				$dlist[$i]['key'] = $val['key'];
				$dlist[$i]['value'] = $val['value'];
				$num = preg_replace("/^dev/", "", $val['key']);
				$dlist[$i]['num'] = $num;
				$dlist[$i]['w'] = $val['w'];
				if ($i >= 2) {
					break;
				}
				$i++;
			}
		}
	} else {
		$i = 1;
		foreach ($devlist as $key => $val) {
			if ($val <= 50) {
				$dlist[$i]['key'] = $key;
				$dlist[$i]['value'] = $val;
				$num = preg_replace("/^dev/", "", $key);
				$dlist[$i]['num'] = $num;

				if ($i >= 2) {
					break;
				}
				$i++;
			}
		}
	}


	if ($plus) {
		$pdf->AddPage();
	}

	require_once("./mode/pdf/pdf12.php");
	$plus++;
}
//-------------------------------------
//感情能力検査結果レポート(終わり)
//-------------------------------------


//-------------------------------------
//行動価値検査結果レポート（面接詳細版2）
//-------------------------------------
if (in_array("13", $pdfline)) {
	require_once("./mode/pdf/pdf13_comment.php");
	$types = array(1, 2, 12, 72, 73);
	$testdata['type'] = $obj->getTestPaper($where, $types);

	foreach ($testdata['type'] as $key => $val) {
		if (preg_match("/^dev/", $key)) {
			$devlist[$key] = $val;
		}
	}


	if ($plus) {
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf13.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（面接詳細版１）終わり
//-------------------------------------

// こちらはs-ewelでは不要
// if(in_array("31",$pdfline)){
// 	if($plus){
// 		$pdf->AddPage();
// 	}
// 	require_once("./mode/pdf/pdf31_comment.php");
// 	require_once("./mode/pdf/pdf31_1.php");

// 	$plus++;
// }

//-------------------------------------
// 働き方タイプ診断結果レポート(WTA)
//-------------------------------------

if (in_array("40", $pdfline)) {
	$types = array(92);
	$testdata['type'] = $obj->getTestPaper($where, $types);

	foreach ($testdata['type'] as $key => $val) {
		if (preg_match("/^dev/", $key)) {
			$devlist[$key] = $val;
		}
	}


	if ($plus) {
		$pdf->AddPage();
	}

	require_once("./mode/pdf/pdf40.php");
	$plus++;
}



//-----------------------------------
// 帳票証明書
//----------------------------------
if ($_REQUEST['code'] == 'lisence' || $_REQUEST['code'] == 'PDF') {
	if ($plus) {
		$pdf->AddPage();
	}
	require_once("./mode/type3/certificate.php");
	$plus++;
}


$exam_id = $third;
$test_name = mb_convert_encoding($test_name, "SJIS", "UTF-8");
//$filename = $test_name."_".$exam_id."_".date('Y').date('m').date('d').".pdf";
$filename = $sec . "_" . $exam_id . "_" . date('Y') . date('m') . date('d') . ".pdf";


/*
if($_REQUEST[ 'sp' ] == "on"){
	$pdf->Output($filename, 'I');
}else{
	$pdf->Output($filename, 'D');
}
*/

$file = "test.pdf";
$pdf->Output($filename, 'D');

exit();
