<?PHP
//-------------------------------------------
//検査結果ファイル作成
//
//
//
//
//
//-------------------------------------------

ini_set('display_errors', 1);


require './vendor/vendor/autoload.php';

require_once("./lib/include_cusDown.php");
require_once("./lib/include_wt.php");
require_once("./lib/include_AAP.php");


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;


$obj = new cusDownMethod();
$objw = new wtMethod();


// スプレッドシート作成
//$spreadsheet = new Spreadsheet();
$dir = D_PATH_HOME . "/excelTemp8/";
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($dir . 'template8.xlsx');
$sheet = $spreadsheet->getActiveSheet();

$where = array();
$where['test_id'] = $sec;
$where['customer_id'] = $id;
$where['partner_id'] = $ptid;
if ($third == "complete") $where['complete_flg'] = 1;

$tdatlist = $obj->getUserDataParts($where);

$exl = [];
$exl['id'] = $sec;
$excel_type = $obj->getExceltype($exl);
//ログデータ登録
$d = [];
$d['id'] = $_SESSION['id'];
$parent = $db->getParentData($d);
$set = array();
$set['company_name'] = $_SESSION['base_site_name'];
$set['company_name_target'] = $_SESSION['name'];
$set['testname'] = $tdatlist[0]['name'];
$set['worktext'] = "結果出力";
$set['detail'] = "エクセル";

$db->setUserData("log", $set);
$weight = 1;
//重み付けチェック
if ($tdatlist[0]['weight'] == 1) {
	$weight = false;
}

foreach ($tdatlist as $k => $v) {
	$tdat[0]['w1'] += $v['w1'];
	$tdat[0]['w2'] += $v['w2'];
	$tdat[0]['w3'] += $v['w3'];
	$tdat[0]['w4'] += $v['w4'];
	$tdat[0]['w5'] += $v['w5'];
	$tdat[0]['w6'] += $v['w6'];
	$tdat[0]['w7'] += $v['w7'];
	$tdat[0]['w8'] += $v['w8'];
	$tdat[0]['w9'] += $v['w9'];
	$tdat[0]['w10'] += $v['w10'];
	$tdat[0]['w11'] += $v['w11'];
	$tdat[0]['w12'] += $v['w12'];
	$typelist[$v['type']] = "on";
}

$download_excel = $tdatlist[0]['download_excel'];



//行動価値検査を選択しているときは
//受検者情報を取得するさいに
//typeを優先的に指定
$moveFlg = "";
if ($typelist[1] || $typelist[2] || $typelist[8] || $typelist[12] || $typelist[41] || $typelist[54] || $typelist[72] || $typelist[82] || $typelist[91]) {
	$moveFlg = 1;
}
if ($typelist[57]) {
	//aap検査データ取得
	$app = new aapClass();
	$tests = array();
	$tests  = $app->getDownPdfList($where, $third);
} else {
	$tests = $obj->getUserDataExcel($where, $moveFlg);
}

if (
	$typelist[12]
	|| $typelist[54]
	|| $typelist[72]
	|| $typelist[73]
	|| $typelist[82]
	|| $typelist[91]
) {
	$where = array();
	$where['testgrp_id'] = $sec;
	if ($typelist[82]) {
		$where['type'] = 82;
	} else
	if ($typelist[72]) {
		$where['type'] = 72;
	} else
	if ($typelist[73]) {
		$where['type'] = 73;
	} else
	if ($typelist[91]) {
		$where['type'] = 91;
	} else
	if ($typelist[54]) {
		$where['type'] = 54;
	} else {
		$where['type'] = 12;
	}
	$where['customer_id'] = $id;
	$where['partner_id'] = $ptid;
	if ($third == "complete") $where['complete_flg'] = 1;
	//マスタ重みを取得したときは再度計算しなおす
	if ($_REQUEST['wk']) {
		include_once(D_PATH_HOME . "/lib/keisan/functionBA12.php");
		include_once(D_PATH_HOME . "/init/rowData/raw_data_ta3.php");
		include_once(D_PATH_HOME . "/init/rowData/dev_data_ta3.php");
		$parts = "exam_date";
		for ($q = 1; $q <= 36; $q++) {
			$parts .= ",q" . $q;
		}
		$mv1 = [];
		if ($typelist[72] || $typelist[82] || $typelist[91]) {
			$mv1 = $obj->getUserDataExcelPFS($where);
		} else {
			$mv1 = $obj->getUserDataExcelBj($where, $parts);
		}
		//重みデータ取得
		$where = array();
		$where['id'] = $_REQUEST['wk'];
		$wtm  = $obj->getWeightMaster($where);
		$tdat = array();
		//重み付け色変更チェック直し
		$tdat[0]['w1'] = $wtm['w1'];
		$tdat[0]['w2'] = $wtm['w2'];
		$tdat[0]['w3'] = $wtm['w3'];
		$tdat[0]['w4'] = $wtm['w4'];
		$tdat[0]['w5'] = $wtm['w5'];
		$tdat[0]['w6'] = $wtm['w6'];
		$tdat[0]['w7'] = $wtm['w7'];
		$tdat[0]['w8'] = $wtm['w8'];
		$tdat[0]['w9'] = $wtm['w9'];
		$tdat[0]['w10'] = $wtm['w10'];
		$tdat[0]['w11'] = $wtm['w11'];
		$tdat[0]['w12'] = $wtm['w12'];
		foreach ($mv1 as $key => $val) {
			if ($val['exam_date']) {
				$rowdata = array();
				list($rowdata, $lv, $standard_score, $dev_number) = BA12($val, $wtm, $raw_data, $dev_data);
				$tests[$key]['exam_date'] = $c['exam_date'];
				$tests[$key]['dev1'] = $rowdata['dev1'];
				$tests[$key]['dev2'] = $rowdata['dev2'];
				$tests[$key]['dev3'] = $rowdata['dev3'];
				$tests[$key]['dev4'] = $rowdata['dev4'];
				$tests[$key]['dev5'] = $rowdata['dev5'];
				$tests[$key]['dev6'] = $rowdata['dev6'];
				$tests[$key]['dev7'] = $rowdata['dev7'];
				$tests[$key]['dev8'] = $rowdata['dev8'];
				$tests[$key]['dev9'] = $rowdata['dev9'];
				$tests[$key]['dev10'] = $rowdata['dev10'];
				$tests[$key]['dev11'] = $rowdata['dev11'];
				$tests[$key]['dev12'] = $rowdata['dev12'];
				$tests[$key]['soyo'] = $dev_number;
				$tests[$key]['level'] = $lv;
				$tests[$key]['score'] = $standard_score;
				$tests[$key]['sougo'] = $val['sougo'];
				$tests[$key]['personal'] = $val['personal'];
				$tests[$key]['state'] = $val['state'];
				$tests[$key]['job'] = $val['job'];
				$tests[$key]['image'] = $val['image'];
				$tests[$key]['positive'] = $val['positive'];
				$tests[$key]['self'] = $val['self'];
			}
		}
	} else {

		$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo,level,score";
		//$mv1 = $obj->getUserDataExcelBj($where,$parts);

		if ($typelist[72] || $typelist[82] || $typelist[91]) {
			$mv1 = $obj->getUserDataExcelPFS($where);
		} else {
			$mv1 = $obj->getUserDataExcelBj($where, $parts);
		}

		if (count($mv1)) {
			foreach ($mv1 as $key => $val) {
				$tests[$key]['exam_date'] = $val['exam_date'];
				$tests[$key]['dev1'] = $val['dev1'];
				$tests[$key]['dev2'] = $val['dev2'];
				$tests[$key]['dev3'] = $val['dev3'];
				$tests[$key]['dev4'] = $val['dev4'];
				$tests[$key]['dev5'] = $val['dev5'];
				$tests[$key]['dev6'] = $val['dev6'];
				$tests[$key]['dev7'] = $val['dev7'];
				$tests[$key]['dev8'] = $val['dev8'];
				$tests[$key]['dev9'] = $val['dev9'];
				$tests[$key]['dev10'] = $val['dev10'];
				$tests[$key]['dev11'] = $val['dev11'];
				$tests[$key]['dev12'] = $val['dev12'];
				$tests[$key]['soyo'] = $val['soyo'];
				$tests[$key]['level'] = $val['level'];
				$tests[$key]['score'] = $val['score'];
				$tests[$key]['sougo'] = $val['sougo'];
				$tests[$key]['personal'] = $val['personal'];
				$tests[$key]['state'] = $val['state'];
				$tests[$key]['job'] = $val['job'];
				$tests[$key]['image'] = $val['image'];
				$tests[$key]['positive'] = $val['positive'];
				$tests[$key]['self'] = $val['self'];
			}
		}
	}
}


if ($typelist[7] || $typelist[47] || $typelist[66] || $typelist[74]) {
	//感情能力検査【社会人版】
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	if ($typelist[7]) {
		$paper['type'] = 7;
	}
	if ($typelist[47]) {
		$paper['type'] = 47;
	}
	if ($typelist[66]) {
		$paper['type'] = 66;
	}
	if ($typelist[74]) {
		$paper['type'] = 74;
	}
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$rs = $obj->getTestRsData($paper, $order);

	if (count($rs)) {
		foreach ($rs as $key => $val) {
			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$tests[$key]['exam_date'] = $val['exam_date'];
			}
			if ($val['sougo']) {
				$tests[$key]['sougo'] = round($val['sougo'], 1);
			} else {
				$tests[$key]['sougo'] = "";
			}
			if ($val['yomitori']) {
				$tests[$key]['yomitori'] = round($val['yomitori'], 1);
			} else {
				$tests[$key]['yomitori'] = "";
			}
			if ($val['rikai']) {
				$tests[$key]['rikai'] = round($val['rikai'], 1);
			} else {
				$tests[$key]['rikai'] = "";
			}
			if ($val['sentaku']) {
				$tests[$key]['sentaku'] = round($val['sentaku'], 1);
			} else {
				$tests[$key]['sentaku'] = "";
			}
			if ($val['kirikae']) {
				$tests[$key]['kirikae'] = round($val['kirikae'], 1);
			} else {
				$tests[$key]['kirikae'] = "";
			}
			if ($val['jyoho']) {
				$tests[$key]['jyoho'] = round($val['jyoho'], 1);
			} else {
				$tests[$key]['jyoho'] = "";
			}
		}
	}
}


//var_dump($tests);

session_start();
//$company_name = mb_convert_encoding($_SESSION["_authsession"][ 'data' ][ 'name' ],'EUC-JP','UTF-8');
$company_name = $_SESSION['name'];
$test_name    =  $tdatlist[0]['name'];

//var_dump($test_name);
$sheet->setCellValue('C1', $company_name);
$sheet->setCellValue('I1', $test_name);
$sheet1 = $spreadsheet->getSheet(1);

$row = 6;
$alpha = [];
for ($col = 'A'; $col != 'GI'; $col++) {
	if ($col != 'A') {
		$alpha[] = $col;
	}
}
if($weight){
	$sheet->setCellValue('O1', '行動価値で青枠になっているのは御社で重要な素養です');
	$sheet->duplicateStyle($sheet1->getStyleByColumnAndRow(15, 1),  'O1');
	$sheet->duplicateStyle($sheet1->getStyleByColumnAndRow(15, 1),  'P1');
	$sheet->duplicateStyle($sheet1->getStyleByColumnAndRow(15, 1),  'Q1');
	$sheet->mergeCells('O1:Q1');
}
$col = 10;
if (
	$typelist[1] ||
	$typelist[12] ||
	$typelist[72] ||
	$typelist[73]
) {
	// タイトル
	$style = $sheet1->getStyleByColumnAndRow(2, 11);
	$style2 = $sheet1->getStyleByColumnAndRow(15, 11);
	$sheet->setCellValue($alpha[$col] . '3', ' ');

	if($weight){
		$sheet->mergeCells($alpha[$col] . '3:' . $alpha[$col + 15] . '3');
		for ($i = $col; $i <= $col + 15; $i++) {
			if ($col + 15 == $i) {
				$sheet->duplicateStyle($style2, $alpha[$i] . '3');
			} else {
				$sheet->duplicateStyle($style, $alpha[$i] . '3');
			}
		}
	}else{
		for ($i = $col; $i <= $col + 13; $i++) {
			if ($col + 13 == $i) {
				$sheet->duplicateStyle($style2, $alpha[$i] . '3');
			} else {
				$sheet->duplicateStyle($style, $alpha[$i] . '3');
			}
		}
		$sheet->mergeCells($alpha[$col] . '3:' . $alpha[$col + 13] . '3');
	}

	$sheet->setCellValue($alpha[$col] . '3', '行動価値');
	$sheet->getStyle($alpha[$col] . '3')->getAlignment()->setHorizontal('center');
	$style3 = $sheet1->getStyleByColumnAndRow(2, 12);
	$style4 = $sheet1->getStyleByColumnAndRow(3, 12);
	$style5 = $sheet1->getStyleByColumnAndRow(18, 19);

	$sheet->setCellValue($alpha[$col] . '4', 'ストレス共生');
	$sheet->mergeCells($alpha[$col] . '4:' . $alpha[$col + 1] . '4');
	$sheet->duplicateStyle($style3, $alpha[$col] . '4');
	$sheet->duplicateStyle($style3, $alpha[$col + 1] . '4');
	$sheet->getStyle($alpha[$col] . '4')->getAlignment()->setHorizontal('center');

	$sheet->setCellValue($alpha[$col] . '5', 'レベル');
	$sheet->duplicateStyle($style3, $alpha[$col] . '5');

	$sheet->setCellValue($alpha[$col + 1] . '5', 'スコア');
	$sheet->duplicateStyle($style4, $alpha[$col + 1] . '5');

	if($weight){
		$sheet->mergeCells($alpha[$col + 2] . '4:' . $alpha[$col + 2] . '5');
		$sheet->setCellValue($alpha[$col+2] . '4', '適合レベル');
		$sheet->duplicateStyle($style5, $alpha[$col+2] . '4');
		$sheet->duplicateStyle($style5, $alpha[$col+2] . '5');

		$sheet->mergeCells($alpha[$col + 3] . '4:' . $alpha[$col + 3] . '5');		
		$sheet->setCellValue($alpha[$col + 3] . '4', '適合スコア');
		$sheet->duplicateStyle($style5, $alpha[$col + 3] . '4');
		$sheet->duplicateStyle($style5, $alpha[$col + 3] . '5');

		$col = $col + 2;
	}

	$sheet->setCellValue($alpha[$col + 2] . '4', '自分を適切に処理できているか');
	$grayStyle = $sheet1->getStyleByColumnAndRow(4, 7);
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 2] . '4');
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 3] . '4');
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 4] . '4');

	$sheet->mergeCells($alpha[$col + 2] . '4:' . $alpha[$col + 4] . '4');


	$sheet->setCellValue($alpha[$col + 5] . '4', '自分の感情をコントロールしているか');
	$grayStyle = $sheet1->getStyleByColumnAndRow(4, 7);
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 5] . '4');
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 6] . '4');
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 7] . '4');
	$sheet->mergeCells($alpha[$col + 5] . '4:' . $alpha[$col + 7] . '4');

	$sheet->setCellValue($alpha[$col + 8] . '4', '相手の状況を適切に認識できているか');
	$grayStyle = $sheet1->getStyleByColumnAndRow(4, 7);
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 8] . '4');
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 9] . '4');
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 10] . '4');
	$sheet->mergeCells($alpha[$col + 8] . '4:' . $alpha[$col + 10] . '4');

	$sheet->setCellValue($alpha[$col + 11] . '4', '相手に適切に働きかけているか');
	$grayStyle = $sheet1->getStyleByColumnAndRow(4, 7);
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 11] . '4');
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 12] . '4');
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 13] . '4');
	$sheet->mergeCells($alpha[$col + 11] . '4:' . $alpha[$col + 13] . '4');


	$sheet->getColumnDimension($alpha[$col + 2])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 3])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 4])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 5])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 6])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 7])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 8])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 9])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 10])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 11])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 12])->setWidth(24);
	$sheet->getColumnDimension($alpha[$col + 13])->setWidth(24);


	$sheet->setCellValue($alpha[$col + 2] . '5', '自己感情モニタリング力
	自分の感情を認識できるか');

	$grayStyle = $sheet1->getStyleByColumnAndRow(4, 13);
	if ($tdat[0]['w1'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(19, 13);
	}
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 2] . '5');


	$sheet->setCellValue($alpha[$col + 3] . '5', '客観的自己評価力
	自分を客観的に評価できるか');


	$grayStyle = $sheet1->getStyleByColumnAndRow(5, 13);
	if ($tdat[0]['w2'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(20, 13);
	}

	$sheet->duplicateStyle($grayStyle, $alpha[$col + 3] . '5');
	$sheet->setCellValue($alpha[$col + 4] . '5', '自己肯定力
	自分を価値ある存在として評価できるか');


	$grayStyle = $sheet1->getStyleByColumnAndRow(6, 13);
	if ($tdat[0]['w3'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(21, 13);
	}
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 4] . '5');
	$sheet->setCellValue($alpha[$col + 5] . '5', 'コントロール＆アチーブメント力
	自己をコントロールし、目標を達成できるか');

	$grayStyle = $sheet1->getStyleByColumnAndRow(7, 13);
	if ($tdat[0]['w4'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(22, 13);
	}
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 5] . '5');
	$sheet->setCellValue($alpha[$col + 6] . '5', 'ビジョン創出力
	達成するべき目標を設定することができるか');

	$grayStyle = $sheet1->getStyleByColumnAndRow(8, 13);
	if ($tdat[0]['w5'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(23, 13);
	}
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 6] . '5');
	$sheet->setCellValue($alpha[$col + 7] . '5', 'ポジティブ思考力
	周囲の状況を柔軟に捉え、適応できるか');

	$grayStyle = $sheet1->getStyleByColumnAndRow(9, 13);
	if ($tdat[0]['w6'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(24, 13);
	}
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 7] . '5');


	$sheet->setCellValue($alpha[$col + 8] . '5', '対人共感力
	相手に共感できるか');

	$grayStyle = $sheet1->getStyleByColumnAndRow(10, 13);
	if ($tdat[0]['w7'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(25, 13);
	}
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 8] . '5');


	$sheet->setCellValue($alpha[$col + 9] . '5', '状況察知力
	職場の雰囲気を読み取ることができるか');

	$grayStyle = $sheet1->getStyleByColumnAndRow(11, 13);
	if ($tdat[0]['w8'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(26, 13);
	}
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 9] . '5');



	$sheet->setCellValue($alpha[$col + 10] . '5', 'ホスピタリティ発揮力
	相手のして欲しいことを積極的にできるか');

	$grayStyle = $sheet1->getStyleByColumnAndRow(12, 13);
	if ($tdat[0]['w9'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(27, 13);
	}

	$sheet->duplicateStyle($grayStyle, $alpha[$col + 10] . '5');


	$sheet->setCellValue($alpha[$col + 11] . '5', 'リーダーシップ発揮力
	集団を目標達成するために積極的に行動できるか');

	$grayStyle = $sheet1->getStyleByColumnAndRow(13, 13);
	if ($tdat[0]['w10'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(28, 13);
	}

	$sheet->duplicateStyle($grayStyle, $alpha[$col + 11] . '5');



	$sheet->setCellValue($alpha[$col + 12] . '5', 'アサーション発揮力
	相手のことを考慮しながら自分の考えを主張できるか');
	$grayStyle = $sheet1->getStyleByColumnAndRow(14, 13);
	if ($tdat[0]['w11'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(29, 13);
	}

	$sheet->duplicateStyle($grayStyle, $alpha[$col + 12] . '5');


	$sheet->setCellValue($alpha[$col + 13] . '5', '集団適応力
	人に興味があり、仲間との良好な関係を保つことができるか');
	$grayStyle = $sheet1->getStyleByColumnAndRow(15, 13);
	if ($tdat[0]['w12'] != 0) {
		$grayStyle = $sheet1->getStyleByColumnAndRow(30, 13);
	}
	$sheet->duplicateStyle($grayStyle, $alpha[$col + 13] . '5');
	$col = $col + 13;
}

if($col == 23 || $col == 21) $col = $col+1;
if (
	$typelist[7] ||
	$typelist[47] ||
	$typelist[74]
) {
	if($weight){
		$col = $col+1;
	}
	$sheet->setCellValue($alpha[$col] . '3', '感情能力');
	$sheet->mergeCells($alpha[$col] . '3:' . $alpha[$col + 4] . '4');
	$style1 = $sheet1->getStyleByColumnAndRow(2, 18);
	$style2 = $sheet1->getStyleByColumnAndRow(3, 18);
	$style3 = $sheet1->getStyleByColumnAndRow(4, 18);


	$sheet->duplicateStyle($style1, $alpha[$col] . '3');
	$sheet->duplicateStyle($style2, $alpha[$col + 1] . '3');
	$sheet->duplicateStyle($style2, $alpha[$col + 2] . '3');
	$sheet->duplicateStyle($style2, $alpha[$col + 3] . '3');
	$style3 = $sheet1->getStyleByColumnAndRow(6, 18);
	$sheet->duplicateStyle($style3, $alpha[$col + 4] . '3');
	$style3 = $sheet1->getStyleByColumnAndRow(6, 19);
	$sheet->duplicateStyle($style3, $alpha[$col + 4] . '4');



	$sheet->setCellValue($alpha[$col + 5] . '3', '情報のとらえ方');
	$sheet->mergeCells($alpha[$col + 5] . '3:' . $alpha[$col + 5] . '5');
	$style3 = $sheet1->getStyleByColumnAndRow(4, 18);
	$sheet->duplicateStyle($style3, $alpha[$col + 5] . '3');
	$style3 = $sheet1->getStyleByColumnAndRow(4, 19);
	$sheet->duplicateStyle($style3, $alpha[$col + 5] . '4');
	$style3 = $sheet1->getStyleByColumnAndRow(7, 21);
	$sheet->duplicateStyle($style3, $alpha[$col + 5] . '5');

	$sheet->setCellValue($alpha[$col] . '5', '総合');
	$style = $sheet1->getStyleByColumnAndRow(2, 21);
	$sheet->duplicateStyle($style, $alpha[$col] . '5');
	$sheet->setCellValue($alpha[$col + 1] . '5', '読み取り力');
	$style = $sheet1->getStyleByColumnAndRow(3, 21);
	$sheet->duplicateStyle($style, $alpha[$col + 1] . '5');

	$sheet->setCellValue($alpha[$col + 2] . '5', '理解力');
	$style = $sheet1->getStyleByColumnAndRow(4, 21);
	$sheet->duplicateStyle($style, $alpha[$col + 2] . '5');

	$sheet->setCellValue($alpha[$col + 3] . '5', '選択力');
	$style = $sheet1->getStyleByColumnAndRow(4, 21);
	$sheet->duplicateStyle($style, $alpha[$col + 3] . '5');

	$sheet->setCellValue($alpha[$col + 4] . '5', '切り替え力');
	$style = $sheet1->getStyleByColumnAndRow(4, 21);
	$sheet->duplicateStyle($style, $alpha[$col + 4] . '5');

	$col = $col + 4;
}


if ($typelist[72]) {
	$col = $col + 1;
	$sheet->setCellValue($alpha[$col] . '3', 'PFS結果');
	$style = $sheet1->getStyleByColumnAndRow(2, 25);
	$sheet->mergeCells($alpha[$col] . '3' . ':' . $alpha[$col + 6] . '3');
	$sheet->duplicateStyle($style, $alpha[$col] . '3');
	$style = $sheet1->getStyleByColumnAndRow(3, 25);
	$sheet->duplicateStyle($style, $alpha[$col + 1] . '3');
	$style = $sheet1->getStyleByColumnAndRow(4, 25);
	$sheet->duplicateStyle($style, $alpha[$col + 2] . '3');
	$sheet->duplicateStyle($style, $alpha[$col + 3] . '3');
	$sheet->duplicateStyle($style, $alpha[$col + 4] . '3');
	$sheet->duplicateStyle($style, $alpha[$col + 5] . '3');
	$style = $sheet1->getStyleByColumnAndRow(8, 25);
	$sheet->duplicateStyle($style, $alpha[$col + 6] . '3');

	$sheet->setCellValue($alpha[$col] . '4', '結合');
	$style = $sheet1->getStyleByColumnAndRow(3, 26);
	$sheet->duplicateStyle($style, $alpha[$col] . '4');
	$sheet->mergeCells($alpha[$col] . '4' . ':' . $alpha[$col] . '5');
	$style = $sheet1->getStyleByColumnAndRow(4, 26);
	$sheet->duplicateStyle($style, $alpha[$col] . '4');
	$style = $sheet1->getStyleByColumnAndRow(4, 27);
	$sheet->duplicateStyle($style, $alpha[$col] . '5');

	$sheet->setCellValue($alpha[$col + 1] . '4', 'モニタリング領域');
	$style = $sheet1->getStyleByColumnAndRow(3, 26);
	$sheet->duplicateStyle($style, $alpha[$col + 1] . '4');
	$sheet->duplicateStyle($style, $alpha[$col + 2] . '4');
	$sheet->duplicateStyle($style, $alpha[$col + 3] . '4');
	$sheet->mergeCells($alpha[$col + 1] . '4' . ':' . $alpha[$col + 3] . '4');


	$sheet->setCellValue($alpha[$col + 4] . '4', 'セルフマネジメント領域');
	$style = $sheet1->getStyleByColumnAndRow(6, 26);
	$sheet->duplicateStyle($style, $alpha[$col + 4] . '4');
	$style = $sheet1->getStyleByColumnAndRow(7, 26);
	$sheet->duplicateStyle($style, $alpha[$col + 5] . '4');
	$style = $sheet1->getStyleByColumnAndRow(8, 26);
	$sheet->duplicateStyle($style, $alpha[$col + 6] . '4');
	$sheet->mergeCells($alpha[$col + 4] . '4' . ':' . $alpha[$col + 6] . '4');


	$sheet->setCellValue($alpha[$col + 1] . '5', '対人共感リスク');
	$style = $sheet1->getStyleByColumnAndRow(3, 27);
	$sheet->duplicateStyle($style, $alpha[$col + 1] . '5');

	$sheet->setCellValue($alpha[$col + 2] . '5', '状況察知リスク');
	$style = $sheet1->getStyleByColumnAndRow(4, 27);
	$sheet->duplicateStyle($style, $alpha[$col + 2] . '5');

	$sheet->setCellValue($alpha[$col + 3] . '5', '業務分担リスク');
	$style = $sheet1->getStyleByColumnAndRow(5, 27);
	$sheet->duplicateStyle($style, $alpha[$col + 3] . '5');

	$sheet->setCellValue($alpha[$col + 4] . '5', '感情コントロールリスク');
	$style = $sheet1->getStyleByColumnAndRow(6, 27);
	$sheet->duplicateStyle($style, $alpha[$col + 4] . '5');

	$sheet->setCellValue($alpha[$col + 5] . '5', 'ポジティブ思考リスク');
	$style = $sheet1->getStyleByColumnAndRow(7, 27);
	$sheet->duplicateStyle($style, $alpha[$col + 5] . '5');

	$sheet->setCellValue($alpha[$col + 6] . '5', '自己肯定リスク');
	$style = $sheet1->getStyleByColumnAndRow(8, 27);
	$sheet->duplicateStyle($style, $alpha[$col + 6] . '5');
}

// var_dump($tests);
// exit();
foreach ($tests as $value) {
	$col = 0;
	$style = $sheet1->getStyleByColumnAndRow(2, 2);
	$sheet->setCellValue($alpha[$col] . $row, $value['exam_id']);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$exam_state = "未受検";
	if ($value['exam_state'] == 1) {
		$exam_state = "受検中";
	} elseif ($value['exam_state'] == 2 && $value['complete_flg'] == 0) {
		$exam_state = "受検中";
	} elseif ($value['exam_state'] == 2) {
		$exam_state = "受検済み";
	}
	$style = $sheet1->getStyleByColumnAndRow(3, 2);
	$col++;
	$sheet->setCellValue($alpha[$col] . $row, $exam_state);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$col++;
	$style = $sheet1->getStyleByColumnAndRow(3, 6);
	$sheet->setCellValue($alpha[$col] . $row, $value['name']);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$col++;
	$sheet->setCellValue($alpha[$col] . $row, $value['kana']);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$col++;
	$sheet->setCellValue($alpha[$col] . $row, $value['birth']);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$birth = preg_replace("/\//", "", $value['birth']);
	$exam_date = preg_replace("/\//", "", $value['exam_date']);
	$age = floor(((int)$exam_date - (int)$birth) / 10000);
	if ($age < 1) {
		$age = "";
	}

	$col++;
	$sheet->setCellValue($alpha[$col] . $row, $age);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$col++;
	$sheet->setCellValue($alpha[$col] . $row, $value['exam_date']);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$col++;
	$sheet->setCellValue($alpha[$col] . $row, $value['pass']);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$col++;
	$sheet->setCellValue($alpha[$col] . $row, $value['memo1']);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	$style = $sheet1->getStyleByColumnAndRow(4, 6);
	$col++;
	$sheet->setCellValue($alpha[$col] . $row, $value['memo2']);
	$sheet->duplicateStyle($style, $alpha[$col] . $row);

	if (
		$typelist[1] ||
		$typelist[12] ||
		$typelist[72] ||
		$typelist[73]
	) {
		if ($row == 6) {
			$style = $sheet1->getStyleByColumnAndRow(6, 7);
		} else {
			$style = $sheet1->getStyleByColumnAndRow(6, 8);
		}
		$col++;
		if (($value['dev1'] && $value['dev2'])) {
			list($st_level, $st_score) = $db->getStress($value['dev1'], $value['dev2']);
		} else {
			$st_level = "";
			$st_score = "";
		}
		$sheet->setCellValue($alpha[$col] . $row, $st_level);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);


		if ($row == 6) {
			$style = $sheet1->getStyleByColumnAndRow(7, 7);
		} else {
			$style = $sheet1->getStyleByColumnAndRow(7, 8);
		}



		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $st_score);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);

		if($weight){
			$col++;
			$sheet->setCellValue($alpha[$col] . $row, $value['level']);
			if ($row == 6) {
				$sheet->duplicateStyle($sheet1->getStyleByColumnAndRow(6, 7), $alpha[$col] . $row);
			}else{
				$sheet->duplicateStyle($sheet1->getStyleByColumnAndRow(6, 8), $alpha[$col] . $row);
			}
			
			$col++;
			$sheet->setCellValue($alpha[$col] . $row, $value['score']);
			$sheet->duplicateStyle($style, $alpha[$col] . $row);


		}

		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev1']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev2']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev3']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev4']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev5']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev6']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev7']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev8']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev9']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev10']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev11']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['dev12']);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
	}


	if (
		$typelist[7] ||
		$typelist[47] ||
		$typelist[74]
	) {

		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['sougo']);
		$style = $sheet1->getStyleByColumnAndRow(7, 8);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['yomitori']);
		$style = $sheet1->getStyleByColumnAndRow(7, 8);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['rikai']);
		$style = $sheet1->getStyleByColumnAndRow(7, 8);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['sentaku']);
		$style = $sheet1->getStyleByColumnAndRow(7, 8);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['kirikae']);
		$style = $sheet1->getStyleByColumnAndRow(7, 8);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
		$col++;
		$sheet->setCellValue($alpha[$col] . $row, $value['jyoho']);
		$style = $sheet1->getStyleByColumnAndRow(11, 4);
		$sheet->duplicateStyle($style, $alpha[$col] . $row);
	}

	if ($typelist[72]) {

		$col++;

		if ($value['sougo']) {
			if ($value['sougo'] > 8) {
				$sheet->setCellValue($alpha[$col] . $row, $value['sougo']);
				if ($row == 6) {
					$style = $sheet1->getStyleByColumnAndRow(2, 32);
				} else {
					$style = $sheet1->getStyleByColumnAndRow(2, 33);
				}
				$sheet->duplicateStyle($style, $alpha[$col] . $row);
			} else {
				$sheet->setCellValue($alpha[$col] . $row, $value['sougo']);

				if ($row == 6) {
					$style = $sheet1->getStyleByColumnAndRow(2, 30);
				} else {
					$style = $sheet1->getStyleByColumnAndRow(2, 31);
				}

				$sheet->duplicateStyle($style, $alpha[$col] . $row);
			}
		} else {
			$sheet->setCellValue($alpha[$col] . $row, '');
			if ($row == 6) {
				$style = $sheet1->getStyleByColumnAndRow(2, 28);
			} else {
				$style = $sheet1->getStyleByColumnAndRow(2, 29);
			}
			$sheet->duplicateStyle($style, $alpha[$col] . $row);
		}
		settingPoint72($value, 'personal', $sheet, $sheet1, $alpha, $col, $row, 3);
		$col++;
		settingPoint72($value, 'state', $sheet, $sheet1, $alpha, $col, $row, 4);
		$col++;
		settingPoint72($value, 'job', $sheet, $sheet1, $alpha, $col, $row, 5);
		$col++;
		settingPoint72($value, 'image', $sheet, $sheet1, $alpha, $col, $row, 6);
		$col++;
		settingPoint72($value, 'positive', $sheet, $sheet1, $alpha, $col, $row, 7);
		$col++;
		settingPoint72($value, 'self', $sheet, $sheet1, $alpha, $col, $row, 8);
	}

	$row++;
}

function settingPoint72($value, $key, $sheet, $sheet1, $alpha, $col, $row, $line)
{
	if ($value[$key]) {

		if ($value[$key] >= 60) {
			$sheet->setCellValue($alpha[$col + 1] . $row, $value[$key]);
			if ($row == 6) {
				$style = $sheet1->getStyleByColumnAndRow($line, 32);
			} else {
				$style = $sheet1->getStyleByColumnAndRow($line, 33);
			}
			$sheet->duplicateStyle($style, $alpha[$col + 1] . $row);
		} elseif ($value[$key] >= 52) {

			$sheet->setCellValue($alpha[$col + 1] . $row, $value[$key]);

			if ($row == 6) {
				$style = $sheet1->getStyleByColumnAndRow($line, 30);
			} else {
				$style = $sheet1->getStyleByColumnAndRow($line, 31);
			}

			$sheet->duplicateStyle($style, $alpha[$col + 1] . $row);
		} else {
			$sheet->setCellValue($alpha[$col + 1] . $row, $value[$key]);
			if ($row == 6) {
				$style = $sheet1->getStyleByColumnAndRow($line, 28);
			} else {
				$style = $sheet1->getStyleByColumnAndRow($line, 29);
			}
			$sheet->duplicateStyle($style, $alpha[$col + 1] . $row);
		}
	} else {
		$sheet->setCellValue($alpha[$col + 1] . $row, '');
		if ($row == 6) {
			$style = $sheet1->getStyleByColumnAndRow($line, 28);
		} else {
			$style = $sheet1->getStyleByColumnAndRow($line, 29);
		}
		$sheet->duplicateStyle($style, $alpha[$col + 1] . $row);
	}
}



$sel_index = $spreadsheet->getIndex($spreadsheet->getSheetByName('base')); //シート番号を取得
$spreadsheet->removeSheetByIndex($sel_index);
$sel_index = $spreadsheet->getIndex($spreadsheet->getSheetByName('pdf1')); //シート番号を取得
$spreadsheet->removeSheetByIndex($sel_index);

$sheet->setSelectedCells('A1');

// Excelファイル書き出し
$writer = new Xls($spreadsheet);
$filename = date("YmdHis") . "_" . $id . ".xls";
echo $filename;
//$writer->save($dir . $id . '-' . $sec . '.xls');
$writer->save($dir . $filename);

// $dl_file_name = date("YMDHIS") . "_score.xls";
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;');
// header('Content-Disposition: attachment; filename="' . $dl_file_name . '"');
// header('Cache-Control: max-age=0');
// $writer = new Xls($spreadsheet);

// $writer->save('php://output');
exit();










































include_once("./lib/reviser.php");
$where = array();
$where['test_id'] = $sec;
$where['customer_id'] = $id;
$where['partner_id'] = $ptid;
if ($third == "complete") $where['complete_flg'] = 1;

$tdatlist = $obj->getUserDataParts($where);

$exl = [];
$exl['id'] = $sec;
$excel_type = $obj->getExceltype($exl);



//ログデータ登録
$d = [];
$d['id'] = $_SESSION['id'];
$parent = $db->getParentData($d);
$set = array();
$set['company_name'] = $_SESSION['base_site_name'];
$set['company_name_target'] = $_SESSION['name'];
$set['testname'] = $tdatlist[0]['name'];
$set['worktext'] = "結果出力";
$set['detail'] = "エクセル";

$db->setUserData("log", $set);


$weight = 1;
//重み付けチェック
if ($tdatlist[0]['weight'] == 1) {
	$weight = false;
}

foreach ($tdatlist as $k => $v) {
	$tdat[0]['w1'] += $v['w1'];
	$tdat[0]['w2'] += $v['w2'];
	$tdat[0]['w3'] += $v['w3'];
	$tdat[0]['w4'] += $v['w4'];
	$tdat[0]['w5'] += $v['w5'];
	$tdat[0]['w6'] += $v['w6'];
	$tdat[0]['w7'] += $v['w7'];
	$tdat[0]['w8'] += $v['w8'];
	$tdat[0]['w9'] += $v['w9'];
	$tdat[0]['w10'] += $v['w10'];
	$tdat[0]['w11'] += $v['w11'];
	$tdat[0]['w12'] += $v['w12'];
	$typelist[$v['type']] = "on";
}

$download_excel = $tdatlist[0]['download_excel'];

//行動価値検査を選択しているときは
//受検者情報を取得するさいに
//typeを優先的に指定
$moveFlg = "";
if ($typelist[1] || $typelist[2] || $typelist[8] || $typelist[12] || $typelist[41] || $typelist[54] || $typelist[72] || $typelist[82] || $typelist[91]) {
	$moveFlg = 1;
}
if ($typelist[57]) {
	//aap検査データ取得
	$app = new aapClass();
	$tests = array();
	$tests  = $app->getDownPdfList($where, $third);
} else {
	$tests = $obj->getUserDataExcel($where, $moveFlg);
}

//ファイル選択用フラグ
if ($typelist[1] || $typelist[2] || $typelist[8] || $typelist[12]  || $typelist[41] || $typelist[54]) {
	$delAction = 1;
}
if ($typelist[72]) {
	$delAction = "PFS";
}
if ($typelist[91]) {
	$delAction = "PFS";
}
if ($typelist[82]) {
	$delAction = "PFS2";
}
if ($typelist[3]) {
	$delFS = 2;
}
if ($typelist[4] || $typelist[9] || $typelist[33]) {
	$delVF = 3;
}
if ($typelist[5] || $typelist[7]  || $typelist[31] || $typelist[47] || $typelist[66] || $typelist[74]) {
	$delDP = 4;
}

if ($typelist[6] || $typelist[37]) {
	$delMV = 5;
}

if ($typelist[11]) {
	$delIq = 6;
}
if ($typelist[13] || $typelist[35] || $typelist[42]) {
	$delmath = 7;
}

if ($typelist[36]) {
	$delnl2 = 8;
}
if ($typelist[61]) {
	$delnl2 = 8;
}
if ($typelist[40]) {
	$delmet = 9;
}
if ($typelist[46]) {
	$delMMS = 10;
}
if ($typelist[49]) {
	$delELAN = 11;
}
if ($typelist[53]) {
	$delELAN = 11;
}
if ($typelist[69]) {
	$delELAN = 11;
}
if ($typelist[71]) {
	$delELAN = 11;
}
if ($typelist[58]) {
	$delELAN = 11;
}
if ($typelist[59]) {
	$delELAN = 11;
}
if ($typelist[65]) {
	$delELAN = 11;
}
if ($typelist[81]) {
	$delELAN = 11;
}
if ($typelist[84]) {
	$delELAN = 11;
}
if ($typelist[88]) {
	$delELAN = 11;
}
if ($typelist[50]) {
	$delMEA = 12;
}
if ($typelist[51]) {
	$delBSA = "Bsa";
}
if ($typelist[56]) {
	$aac = "13";
}
if ($typelist[57]) {
	$aap = "aap";
}
if ($typelist[83]) {
	$amp = "amp";
}
if (
	$typelist[77]
	|| $typelist[78]
	|| $typelist[79]
	|| $typelist[80]

) {
	$nspe = "_nspe";
}

if ($typelist[1]) {
	$where = array();
	$where['testgrp_id'] = $sec;
	$where['type'] = 1;
	$where['customer_id'] = $id;
	$where['partner_id'] = $ptid;
	if ($third == "complete") $where['complete_flg'] = 1;
	//マスタ重みを取得したときは再度計算しなおす
	if ($_REQUEST['wk']) {
		include_once(D_PATH_HOME . "/lib/keisan/functionBA.php");
		include_once(D_PATH_HOME . "/init/rowData/raw_data_ta.php");
		include_once(D_PATH_HOME . "/init/rowData/dev_data_ta.php");
		$parts = "exam_date";
		for ($q = 1; $q <= 36; $q++) {
			$parts .= ",q" . $q;
		}
		$mv1 = $obj->getUserDataExcelBj($where, $parts);
		//重みデータ取得
		$where = array();
		$where['id'] = $_REQUEST['wk'];
		$wtm  = $obj->getWeightMaster($where);
		$tdat = array();
		//重み付け色変更チェック直し
		$tdat[0]['w1'] = $wtm['w1'];
		$tdat[0]['w2'] = $wtm['w2'];
		$tdat[0]['w3'] = $wtm['w3'];
		$tdat[0]['w4'] = $wtm['w4'];
		$tdat[0]['w5'] = $wtm['w5'];
		$tdat[0]['w6'] = $wtm['w6'];
		$tdat[0]['w7'] = $wtm['w7'];
		$tdat[0]['w8'] = $wtm['w8'];
		$tdat[0]['w9'] = $wtm['w9'];
		$tdat[0]['w10'] = $wtm['w10'];
		$tdat[0]['w11'] = $wtm['w11'];
		$tdat[0]['w12'] = $wtm['w12'];

		foreach ($mv1 as $key => $val) {
			if ($val['exam_date']) {
				$rowdata = array();
				list($rowdata, $lv, $standard_score, $dev_number) = BA($val, $wtm, $raw_data, $dev_data, 1);
				$tests[$key]['exam_date'] = $val['exam_date'];
				$tests[$key]['dev1'] = $rowdata['dev1'];
				$tests[$key]['dev2'] = $rowdata['dev2'];
				$tests[$key]['dev3'] = $rowdata['dev3'];
				$tests[$key]['dev4'] = $rowdata['dev4'];
				$tests[$key]['dev5'] = $rowdata['dev5'];
				$tests[$key]['dev6'] = $rowdata['dev6'];
				$tests[$key]['dev7'] = $rowdata['dev7'];
				$tests[$key]['dev8'] = $rowdata['dev8'];
				$tests[$key]['dev9'] = $rowdata['dev9'];
				$tests[$key]['dev10'] = $rowdata['dev10'];
				$tests[$key]['dev11'] = $rowdata['dev11'];
				$tests[$key]['dev12'] = $rowdata['dev12'];
				$tests[$key]['soyo'] = $dev_number;
				$tests[$key]['level'] = $lv;
				$tests[$key]['score'] = $standard_score;
			}
		}
	} else {
		$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo";
		$mv1 = $obj->getUserDataExcelBj($where, $parts);
		if (count($mv1)) {
			foreach ($mv1 as $key => $val) {
				$tests[$key]['exam_date'] = $val['exam_date'];
				$tests[$key]['dev1'] = $val['dev1'];
				$tests[$key]['dev2'] = $val['dev2'];
				$tests[$key]['dev3'] = $val['dev3'];
				$tests[$key]['dev4'] = $val['dev4'];
				$tests[$key]['dev5'] = $val['dev5'];
				$tests[$key]['dev6'] = $val['dev6'];
				$tests[$key]['dev7'] = $val['dev7'];
				$tests[$key]['dev8'] = $val['dev8'];
				$tests[$key]['dev9'] = $val['dev9'];
				$tests[$key]['dev10'] = $val['dev10'];
				$tests[$key]['dev11'] = $val['dev11'];
				$tests[$key]['dev12'] = $val['dev12'];
				$tests[$key]['soyo'] = $val['soyo'];
			}
		}
	}
}


if ($typelist[2]) {
	$where = array();
	$where['testgrp_id'] = $sec;
	$where['type'] = 2;
	$where['customer_id'] = $id;
	$where['partner_id'] = $ptid;
	if ($third == "complete") $where['complete_flg'] = 1;

	//マスタ重みを取得したときは再度計算しなおす
	if ($_REQUEST['wk']) {
		include_once(D_PATH_HOME . "/lib/keisan/functionBA2.php");
		include_once(D_PATH_HOME . "/init/rowData/raw_data_tb.php");
		include_once(D_PATH_HOME . "/init/rowData/dev_data_tb.php");
		$parts = "exam_date";
		for ($q = 1; $q <= 36; $q++) {
			$parts .= ",q" . $q;
		}
		$mv1 = $obj->getUserDataExcelBj($where, $parts);
		//重みデータ取得
		$where = array();
		$where['id'] = $_REQUEST['wk'];
		$wtm  = $obj->getWeightMaster($where);
		$tdat = array();
		//重み付け色変更チェック直し
		$tdat[0]['w1'] = $wtm['w1'];
		$tdat[0]['w2'] = $wtm['w2'];
		$tdat[0]['w3'] = $wtm['w3'];
		$tdat[0]['w4'] = $wtm['w4'];
		$tdat[0]['w5'] = $wtm['w5'];
		$tdat[0]['w6'] = $wtm['w6'];
		$tdat[0]['w7'] = $wtm['w7'];
		$tdat[0]['w8'] = $wtm['w8'];
		$tdat[0]['w9'] = $wtm['w9'];
		$tdat[0]['w10'] = $wtm['w10'];
		$tdat[0]['w11'] = $wtm['w11'];
		$tdat[0]['w12'] = $wtm['w12'];

		foreach ($mv1 as $key => $val) {
			if ($val['exam_date']) {
				$rowdata = array();
				list($rowdata, $lv, $standard_score, $dev_number) = BA2($val, $wtm, $raw_data, $dev_data, 1);
				$tests[$key]['exam_date'] = $val['exam_date'];
				$tests[$key]['dev1'] = $rowdata['dev1'];
				$tests[$key]['dev2'] = $rowdata['dev2'];
				$tests[$key]['dev3'] = $rowdata['dev3'];
				$tests[$key]['dev4'] = $rowdata['dev4'];
				$tests[$key]['dev5'] = $rowdata['dev5'];
				$tests[$key]['dev6'] = $rowdata['dev6'];
				$tests[$key]['dev7'] = $rowdata['dev7'];
				$tests[$key]['dev8'] = $rowdata['dev8'];
				$tests[$key]['dev9'] = $rowdata['dev9'];
				$tests[$key]['dev10'] = $rowdata['dev10'];
				$tests[$key]['dev11'] = $rowdata['dev11'];
				$tests[$key]['dev12'] = $rowdata['dev12'];
				$tests[$key]['soyo'] = $dev_number;
				$tests[$key]['level'] = $lv;
				$tests[$key]['score'] = $standard_score;
			}
		}
	} else {

		$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo,level,score";
		$mv1 = $obj->getUserDataExcelBj($where, $parts);

		if (count($mv1)) {
			foreach ($mv1 as $key => $val) {
				$tests[$key]['dev1'] = $val['dev1'];
				$tests[$key]['dev2'] = $val['dev2'];
				$tests[$key]['dev3'] = $val['dev3'];
				$tests[$key]['dev4'] = $val['dev4'];
				$tests[$key]['dev5'] = $val['dev5'];
				$tests[$key]['dev6'] = $val['dev6'];
				$tests[$key]['dev7'] = $val['dev7'];
				$tests[$key]['dev8'] = $val['dev8'];
				$tests[$key]['dev9'] = $val['dev9'];
				$tests[$key]['dev10'] = $val['dev10'];
				$tests[$key]['dev11'] = $val['dev11'];
				$tests[$key]['dev12'] = $val['dev12'];
				$tests[$key]['soyo'] = $val['soyo'];
			}
		}
	}
}

if (
	$typelist[12]
	|| $typelist[54]
	|| $typelist[72]
	|| $typelist[82]
	|| $typelist[91]
) {
	$where = array();
	$where['testgrp_id'] = $sec;
	if ($typelist[82]) {
		$where['type'] = 82;
	} else
	if ($typelist[72]) {
		$where['type'] = 72;
	} else
	if ($typelist[91]) {
		$where['type'] = 91;
	} else
	if ($typelist[54]) {
		$where['type'] = 54;
	} else {
		$where['type'] = 12;
	}
	$where['customer_id'] = $id;
	$where['partner_id'] = $ptid;
	if ($third == "complete") $where['complete_flg'] = 1;
	//マスタ重みを取得したときは再度計算しなおす
	if ($_REQUEST['wk']) {
		include_once(D_PATH_HOME . "/lib/keisan/functionBA12.php");
		include_once(D_PATH_HOME . "/init/rowData/raw_data_ta3.php");
		include_once(D_PATH_HOME . "/init/rowData/dev_data_ta3.php");
		$parts = "exam_date";
		for ($q = 1; $q <= 36; $q++) {
			$parts .= ",q" . $q;
		}
		$mv1 = [];
		if ($typelist[72] || $typelist[82] || $typelist[91]) {
			$mv1 = $obj->getUserDataExcelPFS($where);
		} else {
			$mv1 = $obj->getUserDataExcelBj($where, $parts);
		}
		//重みデータ取得
		$where = array();
		$where['id'] = $_REQUEST['wk'];
		$wtm  = $obj->getWeightMaster($where);
		$tdat = array();
		//重み付け色変更チェック直し
		$tdat[0]['w1'] = $wtm['w1'];
		$tdat[0]['w2'] = $wtm['w2'];
		$tdat[0]['w3'] = $wtm['w3'];
		$tdat[0]['w4'] = $wtm['w4'];
		$tdat[0]['w5'] = $wtm['w5'];
		$tdat[0]['w6'] = $wtm['w6'];
		$tdat[0]['w7'] = $wtm['w7'];
		$tdat[0]['w8'] = $wtm['w8'];
		$tdat[0]['w9'] = $wtm['w9'];
		$tdat[0]['w10'] = $wtm['w10'];
		$tdat[0]['w11'] = $wtm['w11'];
		$tdat[0]['w12'] = $wtm['w12'];
		foreach ($mv1 as $key => $val) {
			if ($val['exam_date']) {
				$rowdata = array();
				list($rowdata, $lv, $standard_score, $dev_number) = BA12($val, $wtm, $raw_data, $dev_data);
				$tests[$key]['exam_date'] = $c['exam_date'];
				$tests[$key]['dev1'] = $rowdata['dev1'];
				$tests[$key]['dev2'] = $rowdata['dev2'];
				$tests[$key]['dev3'] = $rowdata['dev3'];
				$tests[$key]['dev4'] = $rowdata['dev4'];
				$tests[$key]['dev5'] = $rowdata['dev5'];
				$tests[$key]['dev6'] = $rowdata['dev6'];
				$tests[$key]['dev7'] = $rowdata['dev7'];
				$tests[$key]['dev8'] = $rowdata['dev8'];
				$tests[$key]['dev9'] = $rowdata['dev9'];
				$tests[$key]['dev10'] = $rowdata['dev10'];
				$tests[$key]['dev11'] = $rowdata['dev11'];
				$tests[$key]['dev12'] = $rowdata['dev12'];
				$tests[$key]['soyo'] = $dev_number;
				$tests[$key]['level'] = $lv;
				$tests[$key]['score'] = $standard_score;
				$tests[$key]['sougo'] = $val['sougo'];
				$tests[$key]['personal'] = $val['personal'];
				$tests[$key]['state'] = $val['state'];
				$tests[$key]['job'] = $val['job'];
				$tests[$key]['image'] = $val['image'];
				$tests[$key]['positive'] = $val['positive'];
				$tests[$key]['self'] = $val['self'];
			}
		}
	} else {

		$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo,level,score";
		//$mv1 = $obj->getUserDataExcelBj($where,$parts);

		if ($typelist[72] || $typelist[82] || $typelist[91]) {
			$mv1 = $obj->getUserDataExcelPFS($where);
		} else {
			$mv1 = $obj->getUserDataExcelBj($where, $parts);
		}

		if (count($mv1)) {
			foreach ($mv1 as $key => $val) {
				$tests[$key]['exam_date'] = $val['exam_date'];
				$tests[$key]['dev1'] = $val['dev1'];
				$tests[$key]['dev2'] = $val['dev2'];
				$tests[$key]['dev3'] = $val['dev3'];
				$tests[$key]['dev4'] = $val['dev4'];
				$tests[$key]['dev5'] = $val['dev5'];
				$tests[$key]['dev6'] = $val['dev6'];
				$tests[$key]['dev7'] = $val['dev7'];
				$tests[$key]['dev8'] = $val['dev8'];
				$tests[$key]['dev9'] = $val['dev9'];
				$tests[$key]['dev10'] = $val['dev10'];
				$tests[$key]['dev11'] = $val['dev11'];
				$tests[$key]['dev12'] = $val['dev12'];
				$tests[$key]['soyo'] = $val['soyo'];
				$tests[$key]['level'] = $val['level'];
				$tests[$key]['score'] = $val['score'];
				$tests[$key]['sougo'] = $val['sougo'];
				$tests[$key]['personal'] = $val['personal'];
				$tests[$key]['state'] = $val['state'];
				$tests[$key]['job'] = $val['job'];
				$tests[$key]['image'] = $val['image'];
				$tests[$key]['positive'] = $val['positive'];
				$tests[$key]['self'] = $val['self'];
			}
		}
	}
}

if ($typelist[56]) {
	$where = array();
	$where['testgrp_id'] = $sec;
	$where['type'] = 56;
	$where['customer_id'] = $id;
	$where['partner_id'] = $ptid;
	if ($third == "complete") $where['complete_flg'] = 1;
	//データ取得
	$tests = array();
	$tests = $obj->getAccData($where);
}


if ($typelist[41]) {
	$where = array();
	$where['testgrp_id'] = $sec;
	$where['type'] = 41;
	$where['customer_id'] = $id;
	$where['partner_id'] = $ptid;
	if ($third == "complete") $where['complete_flg'] = 1;
	$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo,level,score";
	$mv1 = $obj->getUserDataExcelBj($where, $parts);

	if (count($mv1)) {
		foreach ($mv1 as $key => $val) {
			$tests[$key]['exam_date'] = $val['exam_date'];
			$tests[$key]['dev1'] = $val['dev1'];
			$tests[$key]['dev2'] = $val['dev2'];
			$tests[$key]['dev3'] = $val['dev3'];
			$tests[$key]['dev4'] = $val['dev4'];
			$tests[$key]['dev5'] = $val['dev5'];
			$tests[$key]['dev6'] = $val['dev6'];
			$tests[$key]['dev7'] = $val['dev7'];
			$tests[$key]['dev8'] = $val['dev8'];
			$tests[$key]['dev9'] = $val['dev9'];
			$tests[$key]['dev10'] = $val['dev10'];
			$tests[$key]['dev11'] = $val['dev11'];
			$tests[$key]['dev12'] = $val['dev12'];
			$tests[$key]['soyo'] = $val['soyo'];
			$tests[$key]['level'] = $val['level'];
			$tests[$key]['score'] = $val['score'];
		}
	}
}

if ($typelist[3]) {
	//welcome(FS)
	$where = array();
	$where['testgrp_id'] = $sec;
	$where['type'] = 3;
	$where['customer_id'] = $id;
	$where['partner_id'] = $ptid;
	if ($third == "complete") $where['complete_flg'] = 1;
	$parts = "exam_state,exam_id,exam_state,number,exam_date,score";
	$fs = $obj->getUserDataExcelBj($where, $parts);

	if (count($fs)) {
		foreach ($fs as $key => $val) {
			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$tests[$key]['exam_date'] = $val['exam_date'];
			}

			$tests[$key]['fs_score'] = $val['score'];
		}
	}
}

if ($typelist[4]) {
	//採用基準検査
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	$paper['type'] = 4;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$vf = $obj->getTestVF4Data($paper, $order);
	if (count($vf)) {
		foreach ($vf as $key => $val) {

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$tests[$key]['exam_date'] = $val['exam_date'];
			}
			$tests[$key]['vf_w1'] = $val['w1'];
			$tests[$key]['vf_w2'] = $val['w2'];
			$tests[$key]['vf_w3'] = $val['w3'];
			$tests[$key]['vf_w4'] = $val['w4'];
			$tests[$key]['vf_w5'] = $val['w5'];
			$tests[$key]['vf_w6'] = $val['w6'];
			$tests[$key]['vf_w7'] = $val['w7'];
			$tests[$key]['vf_w8'] = $val['w8'];
			$tests[$key]['vf_w9'] = $val['w9'];
			$tests[$key]['vf_w9'] = $val['w9'];
			$tests[$key]['vf_w10'] = $val['w10'];
			$tests[$key]['vf_w11'] = $val['w11'];
			$tests[$key]['vf_w12'] = $val['w12'];

			$tests[$key]['vf_dev1'] = $val['dev1'];
			$tests[$key]['vf_dev2'] = $val['dev2'];
			$tests[$key]['vf_dev3'] = $val['dev3'];
			$tests[$key]['vf_dev4'] = $val['dev4'];
			$tests[$key]['vf_dev5'] = $val['dev5'];
			$tests[$key]['vf_dev6'] = $val['dev6'];
			$tests[$key]['vf_dev7'] = $val['dev7'];
			$tests[$key]['vf_dev8'] = $val['dev8'];
			$tests[$key]['vf_dev9'] = $val['dev9'];
			$tests[$key]['vf_dev9'] = $val['dev9'];
			$tests[$key]['vf_dev10'] = $val['dev10'];
			$tests[$key]['vf_dev11'] = $val['dev11'];
			$tests[$key]['vf_dev12'] = $val['dev12'];
			$tests[$key]['vf_avg'] = $val['avg'];
			$tests[$key]['vf_std'] = $val['std'];
		}
	}
}

if ($typelist[33]) {
	//採用基準検査
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	$paper['type'] = 33;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$vf = $obj->getTestVF2Data($paper, $order, $limit);
	if (count($vf)) {
		foreach ($vf as $key => $val) {

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				//$tests[ $key ][ 'vf_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				//if($fdate == "0000/00/00"){
				$fdate = $val['exam_date'];
				//}
				$tests[$key]['exam_date'] = $fdate;
			}
			$tests[$key]['vf_w1'] = $val['w1'];
			$tests[$key]['vf_w2'] = $val['w2'];
			$tests[$key]['vf_w3'] = $val['w3'];
			$tests[$key]['vf_w4'] = $val['w4'];
			$tests[$key]['vf_w5'] = $val['w5'];
			$tests[$key]['vf_w6'] = $val['w6'];
			$tests[$key]['vf_w7'] = $val['w7'];
			$tests[$key]['vf_w8'] = $val['w8'];
			$tests[$key]['vf_w9'] = $val['w9'];
			$tests[$key]['vf_w9'] = $val['w9'];
			$tests[$key]['vf_w10'] = $val['w10'];
			$tests[$key]['vf_w11'] = $val['w11'];
			$tests[$key]['vf_w12'] = $val['w12'];

			$tests[$key]['vf_dev1'] = $val['dev1'];
			$tests[$key]['vf_dev2'] = $val['dev2'];
			$tests[$key]['vf_dev3'] = $val['dev3'];
			$tests[$key]['vf_dev4'] = $val['dev4'];
			$tests[$key]['vf_dev5'] = $val['dev5'];
			$tests[$key]['vf_dev6'] = $val['dev6'];
			$tests[$key]['vf_dev7'] = $val['dev7'];
			$tests[$key]['vf_dev8'] = $val['dev8'];
			$tests[$key]['vf_dev9'] = $val['dev9'];
			$tests[$key]['vf_dev9'] = $val['dev9'];
			$tests[$key]['vf_dev10'] = $val['dev10'];
			$tests[$key]['vf_dev11'] = $val['dev11'];
			$tests[$key]['vf_dev12'] = $val['dev12'];
			$tests[$key]['vf_avg'] = $val['avg'];
			$tests[$key]['vf_std'] = $val['std'];
		}
	}
}

if ($typelist[7] || $typelist[47] || $typelist[66] || $typelist[74]) {
	//感情能力検査【社会人版】
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	if ($typelist[7]) {
		$paper['type'] = 7;
	}
	if ($typelist[47]) {
		$paper['type'] = 47;
	}
	if ($typelist[66]) {
		$paper['type'] = 66;
	}
	if ($typelist[74]) {
		$paper['type'] = 74;
	}
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$rs = $obj->getTestRsData($paper, $order);

	if (count($rs)) {
		foreach ($rs as $key => $val) {
			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$tests[$key]['exam_date'] = $val['exam_date'];
			}
			if ($val['sougo']) {
				$tests[$key]['sougo'] = round($val['sougo'], 1);
			} else {
				$tests[$key]['sougo'] = "";
			}
			if ($val['yomitori']) {
				$tests[$key]['yomitori'] = round($val['yomitori'], 1);
			} else {
				$tests[$key]['yomitori'] = "";
			}
			if ($val['rikai']) {
				$tests[$key]['rikai'] = round($val['rikai'], 1);
			} else {
				$tests[$key]['rikai'] = "";
			}
			if ($val['sentaku']) {
				$tests[$key]['sentaku'] = round($val['sentaku'], 1);
			} else {
				$tests[$key]['sentaku'] = "";
			}
			if ($val['kirikae']) {
				$tests[$key]['kirikae'] = round($val['kirikae'], 1);
			} else {
				$tests[$key]['kirikae'] = "";
			}
			if ($val['jyoho']) {
				$tests[$key]['jyoho'] = round($val['jyoho'], 1);
			} else {
				$tests[$key]['jyoho'] = "";
			}
		}
	}
}

if ($typelist[5]) {
	//感情能力検査【社会人版】
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	$paper['type'] = 5;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$dpdata = $obj->getTestDpData($paper, $order);
	if (count($dpdata)) {
		foreach ($dpdata as $key => $val) {
			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$tests[$key]['exam_date'] = $val['exam_date'];
			}

			if ($val['sougo']) {
				$tests[$key]['sougo'] = round($val['sougo'], 1);
			} else {
				$tests[$key]['sougo'] = "";
			}
			if ($val['yomitori']) {
				$tests[$key]['yomitori'] = round($val['yomitori'], 1);
			} else {
				$tests[$key]['yomitori'] = "";
			}
			if ($val['rikai']) {
				$tests[$key]['rikai'] = round($val['rikai'], 1);
			} else {
				$tests[$key]['rikai'] = "";
			}
			if ($val['sentaku']) {
				$tests[$key]['sentaku'] = round($val['sentaku'], 1);
			} else {
				$tests[$key]['sentaku'] = "";
			}
			if ($val['kirikae']) {
				$tests[$key]['kirikae'] = round($val['kirikae'], 1);
			} else {
				$tests[$key]['kirikae'] = "";
			}
			if ($val['jyoho']) {
				$tests[$key]['jyoho'] = round($val['jyoho'], 1);
			} else {
				$tests[$key]['jyoho'] = "";
			}
		}
	}
}


if ($typelist[31]) {
	//感情能力検査【学生版】
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	$paper['type'] = 31;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$dpdata = $obj->getTestDpSecData($paper, $order, $limit);

	if (count($dpdata)) {
		foreach ($dpdata as $key => $val) {
			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				//$tests[ $key ][ 'rs_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				if ($fdate == "0000/00/00") {
					$fdate = $val['exam_date'];
				}
				$tests[$key]['exam_date'] = $fdate;
			}

			if ($val['sougo']) {
				$tests[$key]['sougo'] = round($val['sougo'], 1);
			} else {
				$tests[$key]['sougo'] = $val['sougo'];
			}

			if ($val['yomitori']) {
				$tests[$key]['yomitori'] = round($val['yomitori'], 1);
			} else {
				$tests[$key]['yomitori'] = $val['yomitori'];
			}

			if ($val['rikai']) {
				$tests[$key]['rikai'] = round($val['rikai'], 1);
			} else {
				$tests[$key]['rikai'] = $val['rikai'];
			}

			if ($val['sentaku']) {
				$tests[$key]['sentaku'] = round($val['sentaku'], 1);
			} else {
				$tests[$key]['sentaku'] = $val['sentaku'];
			}

			if ($val['kirikae']) {
				$tests[$key]['kirikae'] = round($val['kirikae'], 1);
			} else {
				$tests[$key]['kirikae'] = $val['kirikae'];
			}

			if ($val['jyoho']) {
				$tests[$key]['jyoho'] = round($val['jyoho'], 1);
			} else {
				$tests[$key]['jyoho'] = $val['jyoho'];
			}
		}
	}
}


if ($typelist[6]) {
	//行動意識要素
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	$paper['type'] = 6;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$mv = $obj->getTestMVData($paper, $order);
	if (count($mv)) {
		foreach ($mv as $key => $val) {
			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$tests[$key]['exam_date'] = $val['exam_date'];
			}
			$tests[$key]['score1'] = $val['score1'];
			$tests[$key]['score2'] = $val['score2'];
			$tests[$key]['score3'] = $val['score3'];
			$tests[$key]['score4'] = $val['score4'];
			$tests[$key]['score5'] = $val['score5'];
			$tests[$key]['score6'] = $val['score6'];
			$tests[$key]['score7'] = $val['score7'];
			$tests[$key]['score8'] = $val['score8'];
			$tests[$key]['score9'] = $val['score9'];
			$tests[$key]['score10'] = $val['score10'];
			$tests[$key]['score11'] = $val['score11'];
			$tests[$key]['score12'] = $val['score12'];
			$tests[$key]['score13'] = $val['score13'];
			$tests[$key]['score14'] = $val['score14'];
			$tests[$key]['score15'] = $val['score15'];
			$tests[$key]['score16'] = $val['score16'];
			$tests[$key]['score17'] = $val['score17'];
			$tests[$key]['score18'] = $val['score18'];
			$tests[$key]['score19'] = $val['score19'];
			$tests[$key]['score20'] = $val['score20'];
			$tests[$key]['score21'] = $val['score21'];
			$tests[$key]['score22'] = $val['score22'];
			$tests[$key]['score23'] = $val['score23'];
			$tests[$key]['score24'] = $val['score24'];
			$tests[$key]['score25'] = $val['score25'];
		}
	}
}

if ($typelist[37]) {
	//行動意識要素
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;

	$paper['testgrp_id'] = $sec;
	$paper['type'] = 37;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$grp = " group by exam_id";

	$mv = $obj->getTestMV2Data($paper, $order, $grp, $limit);
	if (count($mv)) {
		foreach ($mv as $key => $val) {
			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				//$tests[ $key ][ 'mv_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val['exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				if ($fdate == "0000/00/00") {
					$fdate = $val['exam_date'];
				}
				$tests[$key]['exam_date'] = $fdate;
			}
			$tests[$key]['score1'] = $val['score1'];
			$tests[$key]['score2'] = $val['score2'];
			$tests[$key]['score3'] = $val['score3'];
			$tests[$key]['score4'] = $val['score4'];
			$tests[$key]['score5'] = $val['score5'];
			$tests[$key]['score6'] = $val['score6'];
			$tests[$key]['score7'] = $val['score7'];
			$tests[$key]['score8'] = $val['score8'];
			$tests[$key]['score9'] = $val['score9'];
			$tests[$key]['score10'] = $val['score10'];
			$tests[$key]['score11'] = $val['score11'];
			$tests[$key]['score12'] = $val['score12'];
			$tests[$key]['score13'] = $val['score13'];
			$tests[$key]['score14'] = $val['score14'];
			$tests[$key]['score15'] = $val['score15'];
			$tests[$key]['score16'] = $val['score16'];
			$tests[$key]['score17'] = $val['score17'];
			$tests[$key]['score18'] = $val['score18'];
			$tests[$key]['score19'] = $val['score19'];
			$tests[$key]['score20'] = $val['score20'];
			$tests[$key]['score21'] = $val['score21'];
			$tests[$key]['score22'] = $val['score22'];
			$tests[$key]['score23'] = $val['score23'];
			$tests[$key]['score24'] = $val['score24'];
			$tests[$key]['score25'] = $val['score25'];
		}
	}
}

$math = "";

if ($typelist[13] || $typelist[42]) {
	//BMS　数学検定
	$bms['customer_id'] = $id;
	$bms['partner_id'] = $ptid;
	$bms['testgrp_id'] = $sec;
	if ($typelist[42]) {
		$bms['type'] = 42;
	} else {
		$bms['type'] = 13;
	}
	if ($third == "complete") $bms['complete_flg'] = 1;
	$order = "number";
	$bmsdata = $obj->getMathData($bms, $order, $limit);

	if (count($bmsdata)) {
		foreach ($bmsdata as $key => $val) {
			$tests[$key]['math_level'] = $val['level'];
			$tests[$key]['math_score'] = $val['sogo_score'];

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$tests[$key]['exam_date'] = $val['exam_date'];
			}
			/*
			if($val[ 'haku_yoso' ] == ""){
				$tests[ $key ][ 'haku_yoso' ] = "";
			}else
			if($val[ 'haku_yoso' ] >= 15){
				$tests[ $key ][ 'haku_yoso' ] = "A";
			}else
			if($val[ 'haku_yoso' ] >= 7){
				$tests[ $key ][ 'haku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'haku_yoso' ] = "C";
			}

			if($val[ 'bunseki_yoso' ] == ""){
				$tests[ $key ][ 'bunseki_yoso' ] = "";
			}else
			if($val[ 'bunseki_yoso' ] >= 15){
				$tests[ $key ][ 'bunseki_yoso' ] = "A";
			}else
			if($val[ 'bunseki_yoso' ] >= 7){
				$tests[ $key ][ 'bunseki_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'bunseki_yoso' ] = "C";
			}



			if($val[ 'sentaku_yoso' ] == ""){
				$tests[ $key ][ 'sentaku_yoso' ] = "";
			}else
			if($val[ 'sentaku_yoso' ] >= 15){
				$tests[ $key ][ 'sentaku_yoso' ] = "A";
			}else
			if($val[ 'sentaku_yoso' ] >= 7){
				$tests[ $key ][ 'sentaku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'sentaku_yoso' ] = "C";
			}


			if($val[ 'yosoku_yoso' ] == ""){
				$tests[ $key ][ 'yosoku_yoso' ] = "";
			}else
			if($val[ 'yosoku_yoso' ] >= 15){
				$tests[ $key ][ 'yosoku_yoso' ] = "A";
			}else
			if($val[ 'yosoku_yoso' ] >= 7){
				$tests[ $key ][ 'yosoku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'yosoku_yoso' ] = "C";
			}


			if($val[ 'hyogen_yoso' ] == ""){
				$tests[ $key ][ 'hyogen_yoso' ] = "";
			}else
			if($val[ 'hyogen_yoso' ] >= 15){
				$tests[ $key ][ 'hyogen_yoso' ] = "A";
			}else
			if($val[ 'hyogen_yoso' ] >= 7){
				$tests[ $key ][ 'hyogen_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'hyogen_yoso' ] = "C";
			}
*/
			$tests[$key]['haku_yoso'] = $val['haku_hensa'];
			$tests[$key]['bunseki_yoso'] = $val['bunseki_hensa'];
			$tests[$key]['sentaku_yoso'] = $val['sentaku_hensa'];
			$tests[$key]['yosoku_yoso'] = $val['yosoku_hensa'];
			$tests[$key]['hyogen_yoso'] = $val['hyogen_hensa'];
		}
	}
	$math = "on";
}

if ($typelist[35]) {
	//BMS 数学検定
	$bms['customer_id'] = $id;
	$bms['partner_id'] = $ptid;
	$bms['testgrp_id'] = $sec;
	$bms['type'] = 35;
	if ($third == "complete") $bms['complete_flg'] = 1;
	$order = "number";
	$bmsdata = $obj->getMath2Data($bms, $order, $limit);

	if (count($bmsdata)) {
		foreach ($bmsdata as $key => $val) {
			$tests[$key]['math_level'] = $val['level'];
			$tests[$key]['math_score'] = $val['sogo_score'];

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$tests[$key]['exam_date'] = $val['exam_date'];
			}
			if ($val['haku_yoso'] == "") {
				$tests[$key]['haku_yoso'] = "";
			} else
			if ($val['haku_yoso'] >= 15) {
				$tests[$key]['haku_yoso'] = "A";
			} else
			if ($val['haku_yoso'] >= 7) {
				$tests[$key]['haku_yoso'] = "B";
			} else {
				$tests[$key]['haku_yoso'] = "C";
			}

			if ($val['bunseki_yoso'] == "") {
				$tests[$key]['bunseki_yoso'] = "";
			} else
			if ($val['bunseki_yoso'] >= 15) {
				$tests[$key]['bunseki_yoso'] = "A";
			} else
			if ($val['bunseki_yoso'] >= 7) {
				$tests[$key]['bunseki_yoso'] = "B";
			} else {
				$tests[$key]['bunseki_yoso'] = "C";
			}



			if ($val['sentaku_yoso'] == "") {
				$tests[$key]['sentaku_yoso'] = "";
			} else
			if ($val['sentaku_yoso'] >= 15) {
				$tests[$key]['sentaku_yoso'] = "A";
			} else
			if ($val['sentaku_yoso'] >= 7) {
				$tests[$key]['sentaku_yoso'] = "B";
			} else {
				$tests[$key]['sentaku_yoso'] = "C";
			}


			if ($val['yosoku_yoso'] == "") {
				$tests[$key]['yosoku_yoso'] = "";
			} else
			if ($val['yosoku_yoso'] >= 15) {
				$tests[$key]['yosoku_yoso'] = "A";
			} else
			if ($val['yosoku_yoso'] >= 7) {
				$tests[$key]['yosoku_yoso'] = "B";
			} else {
				$tests[$key]['yosoku_yoso'] = "C";
			}


			if ($val['hyogen_yoso'] == "") {
				$tests[$key]['hyogen_yoso'] = "";
			} else
			if ($val['hyogen_yoso'] >= 15) {
				$tests[$key]['hyogen_yoso'] = "A";
			} else
			if ($val['hyogen_yoso'] >= 7) {
				$tests[$key]['hyogen_yoso'] = "B";
			} else {
				$tests[$key]['hyogen_yoso'] = "C";
			}
		}
	}
	$math = "on";
}

$nl2flg = "";
$nl3flg = "";
if ($typelist[61]) {
	//NL3検査
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	$paper['type'] = 61;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$nl3 = $obj->getNl3Data($paper, $order, $limit);
	if (count($nl3)) {
		foreach ($nl3 as $key => $val) {

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				//$tests[ $key ][ 'vf_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				if ($fdate == "0000/00/00") {
					$fdate = $val['exam_date'];
				}
				$tests[$key]['exam_date'] = $fdate;
			}
			$tests[$key]['nl3_score1'] = $val['score1'];
			$tests[$key]['nl3_score2'] = $val['score2'];
			$tests[$key]['nl3_score3'] = $val['score3'];
			$tests[$key]['nl3_score4'] = $val['score4'];
			$tests[$key]['nl3_score5'] = $val['score5'];
			$tests[$key]['nl3_score6'] = $val['score6'];
			$tests[$key]['nl3_score7'] = $val['score7'];
			$tests[$key]['nl3_score8'] = $val['score8'];
			$tests[$key]['nl3_score9'] = $val['score9'];
			$tests[$key]['nl3_score10'] = $val['score10'];
			$tests[$key]['nl3_score11'] = $val['score11'];
			$tests[$key]['nl3_score12'] = $val['score12'];
			$tests[$key]['nl3_score13'] = $val['score13'];
			$tests[$key]['nl3_score14'] = $val['score14'];
			$tests[$key]['nl3_score15'] = $val['score15'];
			$tests[$key]['nl3_score16'] = $val['score16'];
			$tests[$key]['nl3_score17'] = $val['score17'];
			$tests[$key]['nl3_score18'] = $val['score18'];
			$tests[$key]['nl3_score19'] = $val['score19'];
		}
	}

	$nl3flg = "on";
}
if ($typelist[36]) {
	//NL2検査
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	$paper['type'] = 36;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$nl2 = $obj->getNl2Data($paper, $order, $limit);

	if (count($nl2)) {
		foreach ($nl2 as $key => $val) {

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				//$tests[ $key ][ 'vf_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				if ($fdate == "0000/00/00") {
					$fdate = $val['exam_date'];
				}
				$tests[$key]['exam_date'] = $fdate;
			}
			$tests[$key]['nl2_score1'] = $val['score1'];
			$tests[$key]['nl2_score2'] = $val['score2'];
			$tests[$key]['nl2_score3'] = $val['score3'];
			$tests[$key]['nl2_score4'] = $val['score4'];
			$tests[$key]['nl2_score5'] = $val['score5'];
			$tests[$key]['nl2_score6'] = $val['score6'];
			$tests[$key]['nl2_score7'] = $val['score7'];
			$tests[$key]['nl2_score8'] = $val['score8'];
			$tests[$key]['nl2_score9'] = $val['score9'];
			$tests[$key]['nl2_score10'] = $val['score10'];
			$tests[$key]['nl2_score11'] = $val['score11'];
			$tests[$key]['nl2_score12'] = $val['score12'];
			$tests[$key]['nl2_score13'] = $val['score13'];
			$tests[$key]['nl2_score14'] = $val['score14'];
			$tests[$key]['nl2_score15'] = $val['score15'];
			$tests[$key]['nl2_score16'] = $val['score16'];
			$tests[$key]['nl2_score17'] = $val['score17'];
			$tests[$key]['nl2_score18'] = $val['score18'];
			$tests[$key]['nl2_score19'] = $val['score19'];
		}
	}

	$nl2flg = "on";
}

$IQflg = "";
if ($typelist[11]) {
	//IQ検査
	$paper['customer_id'] = $id;
	$paper['partner_id'] = $ptid;
	$paper['testgrp_id'] = $sec;
	$paper['type'] = 11;
	if ($third == "complete") $paper['complete_flg'] = 1;
	$order = "number";
	$iq = $obj->getIQData($paper, $order, $limit);

	if (count($iq)) {
		foreach ($iq as $key => $val) {

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				//$tests[ $key ][ 'vf_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				//if($fdate == "0000/00/00"){
				$fdate = $val['exam_date'];
				//}
				$tests[$key]['exam_date'] = $fdate;
			}
			$tests[$key]['language_score'] = $val['language_score'];
			$tests[$key]['iq_math_score'] = $val['math_score'];
		}
	}
	$IQflg = "on";
}

$metflg = "";
if ($typelist[40]) {
	$amet['customer_id'] = $id;
	$amet['partner_id'] = $ptid;
	$amet['testgrp_id'] = $sec;
	$amet['type'] = 40;
	if ($third == "complete") $amet['complete_flg'] = 1;
	$order = "number";
	$met = $obj->getMetData($amet, $order, $limit);

	if (count($met)) {
		foreach ($met as $key => $val) {

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			$tests[$key]['std1'] = $val['std1'];
			$tests[$key]['std2'] = $val['std2'];
			$tests[$key]['std3'] = $val['std3'];
			$tests[$key]['std4'] = $val['std4'];
			$tests[$key]['std5'] = $val['std5'];
			$tests[$key]['std6'] = $val['std6'];
			$tests[$key]['std7'] = $val['std7'];
			$tests[$key]['std8'] = $val['std8'];
			$tests[$key]['std9'] = $val['std9'];
			$tests[$key]['std10'] = $val['std10'];
			$tests[$key]['std11'] = $val['std11'];
			$tests[$key]['std12'] = $val['std12'];
		}
	}

	$metflg = "on";
}

$mmsflg = "";
if ($typelist[46]) {
	$amms['customer_id'] = $id;
	$amms['partner_id'] = $ptid;
	$amms['testgrp_id'] = $sec;
	$amms['type'] = 46;
	if ($third == "complete") $amms['complete_flg'] = 1;
	$order = "number";
	$mms = $obj->getMmsData($amms, $order, $limit);

	if (count($mms)) {
		foreach ($mms as $key => $val) {

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			$tests[$key]['result1'] = $val['result1'];
			$tests[$key]['result2'] = $val['result2'];
			$tests[$key]['result3'] = $val['result3'];
			$tests[$key]['result4'] = $val['result4'];
			$tests[$key]['result5'] = $val['result5'];
			$tests[$key]['result6'] = $val['result6'];
			$tests[$key]['result7'] = $val['result7'];
			$tests[$key]['result8'] = $val['result8'];
			$tests[$key]['result9'] = $val['result9'];
			$tests[$key]['result10'] = $val['result10'];
		}
	}

	$mmsflg = "on";
}
$elanflg = "";
if ($typelist[49]) {
	//回答ファイル読み込み
	include_once(D_PATH_HOME . "t/php/test49/include_ELANQuestion.php");
	$aelan['customer_id'] = $id;
	$aelan['partner_id'] = $ptid;
	$aelan['testgrp_id'] = $sec;
	$aelan['type'] = 49;
	if ($third == "complete") $aelan['complete_flg'] = 1;
	$order = "number";
	$elan = $obj->getElanData($aelan, $order, $limit);

	if (count($elan)) {
		foreach ($elan as $key => $val) {
			$cnt = 0;
			if ($val['ans1'] == $array_answer['ans1']) $cnt++;
			if ($val['ans2'] == $array_answer['ans2']) $cnt++;
			if ($val['ans3'] == $array_answer['ans3']) $cnt++;
			if ($val['ans4'] == $array_answer['ans4']) $cnt++;
			if ($val['ans5'] == $array_answer['ans5']) $cnt++;
			if ($val['ans6'] == $array_answer['ans6']) $cnt++;
			if ($val['ans7'] == $array_answer['ans7']) $cnt++;
			if ($val['ans8'] == $array_answer['ans8']) $cnt++;
			if ($val['ans9'] == $array_answer['ans9']) $cnt++;
			if ($val['ans10'] == $array_answer['ans10']) $cnt++;

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			if ($val['ans1']) {
				$tests[$key]['ans1'] = ($val['ans1'] == $array_answer['ans1']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans1'] = '';
			}

			if ($val['ans2']) {
				$tests[$key]['ans2'] = ($val['ans2'] == $array_answer['ans2']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans2'] = '';
			}

			if ($val['ans3']) {
				$tests[$key]['ans3'] = ($val['ans3'] == $array_answer['ans3']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans3'] = '';
			}

			if ($val['ans4']) {
				$tests[$key]['ans4'] = ($val['ans4'] == $array_answer['ans4']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans4'] = '';
			}

			if ($val['ans5']) {
				$tests[$key]['ans5'] = ($val['ans5'] == $array_answer['ans5']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans5'] = '';
			}

			if ($val['ans6']) {
				$tests[$key]['ans6'] = ($val['ans6'] == $array_answer['ans6']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans6'] = '';
			}

			if ($val['ans7']) {
				$tests[$key]['ans7'] = ($val['ans7'] == $array_answer['ans7']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans7'] = '';
			}

			if ($val['ans8']) {
				$tests[$key]['ans8'] = ($val['ans8'] == $array_answer['ans8']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans8'] = '';
			}

			if ($val['ans9']) {
				$tests[$key]['ans9'] = ($val['ans9'] == $array_answer['ans9']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans9'] = '';
			}

			if ($val['ans10']) {
				$tests[$key]['ans10'] = ($val['ans10'] == $array_answer['ans10']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans10'] = '';
			}
			$tests[$key]['count'] = ($cnt > 0) ? $cnt : '';
		}
	}

	$elanflg = "on";
}


if ($typelist[53] || $typelist[69] || $typelist[71]) {
	//回答ファイル読み込み
	if ($typelist[71]) {
		include_once(D_PATH_HOME . "t/php/test71/include_ELANQuestion.php");
	} else
    if ($typelist[69]) {
		include_once(D_PATH_HOME . "t/php/test69/include_ELANQuestion.php");
	} else {
		include_once(D_PATH_HOME . "t/php/test53/include_ELANQuestion.php");
	}
	$aelan['customer_id'] = $id;
	$aelan['partner_id'] = $ptid;
	$aelan['testgrp_id'] = $sec;
	if ($typelist[71]) {
		$aelan['type'] = 71;
	} else
	if ($typelist[69]) {
		$aelan['type'] = 69;
	} else {
		$aelan['type'] = 53;
	}
	if ($third == "complete") $aelan['complete_flg'] = 1;
	$order = "number";
	if ($typelist[71]) {
		$elan = $obj->getElanS2Data($aelan, $order, $limit);
	} else
	if ($typelist[69]) {
		$elan = $obj->getElanSData($aelan, $order, $limit);
	} else {
		$elan = $obj->getElan2Data($aelan, $order, $limit);
	}


	if (count($elan)) {
		foreach ($elan as $key => $val) {
			$cnt = 0;
			if ($val['ans1'] == $array_answer['ans1']) $cnt++;
			if ($val['ans2'] == $array_answer['ans2']) $cnt++;
			if ($val['ans3'] == $array_answer['ans3']) $cnt++;
			if ($val['ans4'] == $array_answer['ans4']) $cnt++;
			if ($val['ans5'] == $array_answer['ans5']) $cnt++;
			if ($val['ans6'] == $array_answer['ans6']) $cnt++;
			if ($val['ans7'] == $array_answer['ans7']) $cnt++;
			if ($val['ans8'] == $array_answer['ans8']) $cnt++;
			if ($val['ans9'] == $array_answer['ans9']) $cnt++;
			if ($val['ans10'] == $array_answer['ans10']) $cnt++;

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			if ($val['ans1']) {
				$tests[$key]['ans1'] = ($val['ans1'] == $array_answer['ans1']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans1'] = '';
			}

			if ($val['ans2']) {
				$tests[$key]['ans2'] = ($val['ans2'] == $array_answer['ans2']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans2'] = '';
			}

			if ($val['ans3']) {
				$tests[$key]['ans3'] = ($val['ans3'] == $array_answer['ans3']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans3'] = '';
			}

			if ($val['ans4']) {
				$tests[$key]['ans4'] = ($val['ans4'] == $array_answer['ans4']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans4'] = '';
			}

			if ($val['ans5']) {
				$tests[$key]['ans5'] = ($val['ans5'] == $array_answer['ans5']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans5'] = '';
			}

			if ($val['ans6']) {
				$tests[$key]['ans6'] = ($val['ans6'] == $array_answer['ans6']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans6'] = '';
			}

			if ($val['ans7']) {
				$tests[$key]['ans7'] = ($val['ans7'] == $array_answer['ans7']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans7'] = '';
			}

			if ($val['ans8']) {
				$tests[$key]['ans8'] = ($val['ans8'] == $array_answer['ans8']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans8'] = '';
			}

			if ($val['ans9']) {
				$tests[$key]['ans9'] = ($val['ans9'] == $array_answer['ans9']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans9'] = '';
			}

			if ($val['ans10']) {
				$tests[$key]['ans10'] = ($val['ans10'] == $array_answer['ans10']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans10'] = '';
			}
			$tests[$key]['count'] = ($cnt > 0) ? $cnt : '';
		}
	}

	$elanflg = "on";
}



if ($typelist[58]) {
	//回答ファイル読み込み
	include_once(D_PATH_HOME . "t/php/test58/include_ELANQuestion.php");
	$aelan['customer_id'] = $id;
	$aelan['partner_id'] = $ptid;
	$aelan['testgrp_id'] = $sec;
	$aelan['type'] = 58;
	if ($third == "complete") $aelan['complete_flg'] = 1;
	$order = "number";
	$elan = $obj->getElan3Data($aelan, $order, $limit);

	if (count($elan)) {
		foreach ($elan as $key => $val) {
			$cnt = 0;
			if ($val['ans1'] == $array_answer['ans1']) $cnt++;
			if ($val['ans2'] == $array_answer['ans2']) $cnt++;
			if ($val['ans3'] == $array_answer['ans3']) $cnt++;
			if ($val['ans4'] == $array_answer['ans4']) $cnt++;
			if ($val['ans5'] == $array_answer['ans5']) $cnt++;
			if ($val['ans6'] == $array_answer['ans6']) $cnt++;
			if ($val['ans7'] == $array_answer['ans7']) $cnt++;
			if ($val['ans8'] == $array_answer['ans8']) $cnt++;
			if ($val['ans9'] == $array_answer['ans9']) $cnt++;
			if ($val['ans10'] == $array_answer['ans10']) $cnt++;

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			if ($val['ans1']) {
				$tests[$key]['ans1'] = ($val['ans1'] == $array_answer['ans1']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans1'] = '';
			}

			if ($val['ans2']) {
				$tests[$key]['ans2'] = ($val['ans2'] == $array_answer['ans2']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans2'] = '';
			}

			if ($val['ans3']) {
				$tests[$key]['ans3'] = ($val['ans3'] == $array_answer['ans3']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans3'] = '';
			}

			if ($val['ans4']) {
				$tests[$key]['ans4'] = ($val['ans4'] == $array_answer['ans4']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans4'] = '';
			}

			if ($val['ans5']) {
				$tests[$key]['ans5'] = ($val['ans5'] == $array_answer['ans5']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans5'] = '';
			}

			if ($val['ans6']) {
				$tests[$key]['ans6'] = ($val['ans6'] == $array_answer['ans6']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans6'] = '';
			}

			if ($val['ans7']) {
				$tests[$key]['ans7'] = ($val['ans7'] == $array_answer['ans7']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans7'] = '';
			}

			if ($val['ans8']) {
				$tests[$key]['ans8'] = ($val['ans8'] == $array_answer['ans8']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans8'] = '';
			}

			if ($val['ans9']) {
				$tests[$key]['ans9'] = ($val['ans9'] == $array_answer['ans9']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans9'] = '';
			}

			if ($val['ans10']) {
				$tests[$key]['ans10'] = ($val['ans10'] == $array_answer['ans10']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans10'] = '';
			}
			$tests[$key]['count'] = ($cnt > 0) ? $cnt : '';
		}
	}

	$elanflg = "on";
}

if ($typelist[59]) {
	//回答ファイル読み込み
	include_once(D_PATH_HOME . "t/php/test59/include_ELANQuestion.php");
	$aelan['customer_id'] = $id;
	$aelan['partner_id'] = $ptid;
	$aelan['testgrp_id'] = $sec;
	$aelan['type'] = 59;
	if ($third == "complete") $aelan['complete_flg'] = 1;
	$order = "number";
	$elan = $obj->getElan4Data($aelan, $order, $limit);

	if (count($elan)) {
		foreach ($elan as $key => $val) {
			$cnt = 0;
			if ($val['ans1'] == $array_answer['ans1']) $cnt++;
			if ($val['ans2'] == $array_answer['ans2']) $cnt++;
			if ($val['ans3'] == $array_answer['ans3']) $cnt++;
			if ($val['ans4'] == $array_answer['ans4']) $cnt++;
			if ($val['ans5'] == $array_answer['ans5']) $cnt++;
			if ($val['ans6'] == $array_answer['ans6']) $cnt++;
			if ($val['ans7'] == $array_answer['ans7']) $cnt++;
			if ($val['ans8'] == $array_answer['ans8']) $cnt++;
			if ($val['ans9'] == $array_answer['ans9']) $cnt++;
			if ($val['ans10'] == $array_answer['ans10']) $cnt++;

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			if ($val['ans1']) {
				$tests[$key]['ans1'] = ($val['ans1'] == $array_answer['ans1']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans1'] = '';
			}

			if ($val['ans2']) {
				$tests[$key]['ans2'] = ($val['ans2'] == $array_answer['ans2']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans2'] = '';
			}

			if ($val['ans3']) {
				$tests[$key]['ans3'] = ($val['ans3'] == $array_answer['ans3']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans3'] = '';
			}

			if ($val['ans4']) {
				$tests[$key]['ans4'] = ($val['ans4'] == $array_answer['ans4']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans4'] = '';
			}

			if ($val['ans5']) {
				$tests[$key]['ans5'] = ($val['ans5'] == $array_answer['ans5']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans5'] = '';
			}

			if ($val['ans6']) {
				$tests[$key]['ans6'] = ($val['ans6'] == $array_answer['ans6']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans6'] = '';
			}

			if ($val['ans7']) {
				$tests[$key]['ans7'] = ($val['ans7'] == $array_answer['ans7']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans7'] = '';
			}

			if ($val['ans8']) {
				$tests[$key]['ans8'] = ($val['ans8'] == $array_answer['ans8']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans8'] = '';
			}

			if ($val['ans9']) {
				$tests[$key]['ans9'] = ($val['ans9'] == $array_answer['ans9']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans9'] = '';
			}

			if ($val['ans10']) {
				$tests[$key]['ans10'] = ($val['ans10'] == $array_answer['ans10']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans10'] = '';
			}
			$tests[$key]['count'] = ($cnt > 0) ? $cnt : '';
		}
	}

	$elanflg = "on";
}

if ($typelist[65]) {
	//回答ファイル読み込み
	include_once(D_PATH_HOME . "t/php/test65/include_ELANQuestion.php");
	$aelan['customer_id'] = $id;
	$aelan['partner_id'] = $ptid;
	$aelan['testgrp_id'] = $sec;
	$aelan['type'] = 65;
	if ($third == "complete") $aelan['complete_flg'] = 1;
	$order = "number";
	$elan = $obj->getElan5Data($aelan, $order, $limit);

	if (count($elan)) {
		foreach ($elan as $key => $val) {
			$cnt = 0;
			if ($val['ans1'] == $array_answer['ans1']) $cnt++;
			if ($val['ans2'] == $array_answer['ans2']) $cnt++;
			if ($val['ans3'] == $array_answer['ans3']) $cnt++;
			if ($val['ans4'] == $array_answer['ans4']) $cnt++;
			if ($val['ans5'] == $array_answer['ans5']) $cnt++;
			if ($val['ans6'] == $array_answer['ans6']) $cnt++;
			if ($val['ans7'] == $array_answer['ans7']) $cnt++;
			if ($val['ans8'] == $array_answer['ans8']) $cnt++;
			if ($val['ans9'] == $array_answer['ans9']) $cnt++;
			if ($val['ans10'] == $array_answer['ans10']) $cnt++;

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			if ($val['ans1']) {
				$tests[$key]['ans1'] = ($val['ans1'] == $array_answer['ans1']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans1'] = '';
			}

			if ($val['ans2']) {
				$tests[$key]['ans2'] = ($val['ans2'] == $array_answer['ans2']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans2'] = '';
			}

			if ($val['ans3']) {
				$tests[$key]['ans3'] = ($val['ans3'] == $array_answer['ans3']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans3'] = '';
			}

			if ($val['ans4']) {
				$tests[$key]['ans4'] = ($val['ans4'] == $array_answer['ans4']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans4'] = '';
			}

			if ($val['ans5']) {
				$tests[$key]['ans5'] = ($val['ans5'] == $array_answer['ans5']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans5'] = '';
			}

			if ($val['ans6']) {
				$tests[$key]['ans6'] = ($val['ans6'] == $array_answer['ans6']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans6'] = '';
			}

			if ($val['ans7']) {
				$tests[$key]['ans7'] = ($val['ans7'] == $array_answer['ans7']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans7'] = '';
			}

			if ($val['ans8']) {
				$tests[$key]['ans8'] = ($val['ans8'] == $array_answer['ans8']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans8'] = '';
			}

			if ($val['ans9']) {
				$tests[$key]['ans9'] = ($val['ans9'] == $array_answer['ans9']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans9'] = '';
			}

			if ($val['ans10']) {
				$tests[$key]['ans10'] = ($val['ans10'] == $array_answer['ans10']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans10'] = '';
			}
			$tests[$key]['count'] = ($cnt > 0) ? $cnt : '';
		}
	}

	$elanflg = "on";
}
if ($typelist[81]) {
	//回答ファイル読み込み
	include_once(D_PATH_HOME . "t/php/test81/include_ELANQuestion.php");
	$aelan['customer_id'] = $id;
	$aelan['partner_id'] = $ptid;
	$aelan['testgrp_id'] = $sec;
	$aelan['type'] = 81;
	if ($third == "complete") $aelan['complete_flg'] = 1;
	$order = "number";
	$elan = $obj->getElan6Data($aelan, $order, $limit);

	if (count($elan)) {
		foreach ($elan as $key => $val) {
			$cnt = 0;
			if ($val['ans1'] == $array_answer['ans1']) $cnt++;
			if ($val['ans2'] == $array_answer['ans2']) $cnt++;
			if ($val['ans3'] == $array_answer['ans3']) $cnt++;
			if ($val['ans4'] == $array_answer['ans4']) $cnt++;
			if ($val['ans5'] == $array_answer['ans5']) $cnt++;
			if ($val['ans6'] == $array_answer['ans6']) $cnt++;
			if ($val['ans7'] == $array_answer['ans7']) $cnt++;
			if ($val['ans8'] == $array_answer['ans8']) $cnt++;
			if ($val['ans9'] == $array_answer['ans9']) $cnt++;
			if ($val['ans10'] == $array_answer['ans10']) $cnt++;

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			if ($val['ans1']) {
				$tests[$key]['ans1'] = ($val['ans1'] == $array_answer['ans1']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans1'] = '';
			}

			if ($val['ans2']) {
				$tests[$key]['ans2'] = ($val['ans2'] == $array_answer['ans2']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans2'] = '';
			}

			if ($val['ans3']) {
				$tests[$key]['ans3'] = ($val['ans3'] == $array_answer['ans3']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans3'] = '';
			}

			if ($val['ans4']) {
				$tests[$key]['ans4'] = ($val['ans4'] == $array_answer['ans4']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans4'] = '';
			}

			if ($val['ans5']) {
				$tests[$key]['ans5'] = ($val['ans5'] == $array_answer['ans5']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans5'] = '';
			}

			if ($val['ans6']) {
				$tests[$key]['ans6'] = ($val['ans6'] == $array_answer['ans6']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans6'] = '';
			}

			if ($val['ans7']) {
				$tests[$key]['ans7'] = ($val['ans7'] == $array_answer['ans7']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans7'] = '';
			}

			if ($val['ans8']) {
				$tests[$key]['ans8'] = ($val['ans8'] == $array_answer['ans8']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans8'] = '';
			}

			if ($val['ans9']) {
				$tests[$key]['ans9'] = ($val['ans9'] == $array_answer['ans9']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans9'] = '';
			}

			if ($val['ans10']) {
				$tests[$key]['ans10'] = ($val['ans10'] == $array_answer['ans10']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans10'] = '';
			}
			$tests[$key]['count'] = ($cnt > 0) ? $cnt : '';
		}
	}

	$elanflg = "on";
}
if ($typelist[84]) {
	//回答ファイル読み込み
	include_once(D_PATH_HOME . "t/php/test84/include_ELANQuestion.php");
	$aelan['customer_id'] = $id;
	$aelan['partner_id'] = $ptid;
	$aelan['testgrp_id'] = $sec;
	$aelan['type'] = 84;
	if ($third == "complete") $aelan['complete_flg'] = 1;
	$order = "number";
	$elan = $obj->getElan6Data($aelan, $order, $limit);

	if (count($elan)) {
		foreach ($elan as $key => $val) {
			$cnt = 0;
			if ($val['ans1'] == $array_answer['ans1']) $cnt++;
			if ($val['ans2'] == $array_answer['ans2']) $cnt++;
			if ($val['ans3'] == $array_answer['ans3']) $cnt++;
			if ($val['ans4'] == $array_answer['ans4']) $cnt++;
			if ($val['ans5'] == $array_answer['ans5']) $cnt++;
			if ($val['ans6'] == $array_answer['ans6']) $cnt++;
			if ($val['ans7'] == $array_answer['ans7']) $cnt++;
			if ($val['ans8'] == $array_answer['ans8']) $cnt++;
			if ($val['ans9'] == $array_answer['ans9']) $cnt++;
			if ($val['ans10'] == $array_answer['ans10']) $cnt++;

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			if ($val['ans1']) {
				$tests[$key]['ans1'] = ($val['ans1'] == $array_answer['ans1']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans1'] = '';
			}

			if ($val['ans2']) {
				$tests[$key]['ans2'] = ($val['ans2'] == $array_answer['ans2']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans2'] = '';
			}

			if ($val['ans3']) {
				$tests[$key]['ans3'] = ($val['ans3'] == $array_answer['ans3']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans3'] = '';
			}

			if ($val['ans4']) {
				$tests[$key]['ans4'] = ($val['ans4'] == $array_answer['ans4']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans4'] = '';
			}

			if ($val['ans5']) {
				$tests[$key]['ans5'] = ($val['ans5'] == $array_answer['ans5']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans5'] = '';
			}

			if ($val['ans6']) {
				$tests[$key]['ans6'] = ($val['ans6'] == $array_answer['ans6']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans6'] = '';
			}

			if ($val['ans7']) {
				$tests[$key]['ans7'] = ($val['ans7'] == $array_answer['ans7']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans7'] = '';
			}

			if ($val['ans8']) {
				$tests[$key]['ans8'] = ($val['ans8'] == $array_answer['ans8']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans8'] = '';
			}

			if ($val['ans9']) {
				$tests[$key]['ans9'] = ($val['ans9'] == $array_answer['ans9']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans9'] = '';
			}

			if ($val['ans10']) {
				$tests[$key]['ans10'] = ($val['ans10'] == $array_answer['ans10']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans10'] = '';
			}
			$tests[$key]['count'] = ($cnt > 0) ? $cnt : '';
		}
	}

	$elanflg = "on";
}
if ($typelist[88]) {
	//回答ファイル読み込み
	include_once(D_PATH_HOME . "t/php/test88/include_ELANQuestion.php");
	$aelan['customer_id'] = $id;
	$aelan['partner_id'] = $ptid;
	$aelan['testgrp_id'] = $sec;
	$aelan['type'] = 88;
	if ($third == "complete") $aelan['complete_flg'] = 1;
	$order = "number";
	$elan = $obj->getElan6Data($aelan, $order, $limit);

	if (count($elan)) {
		foreach ($elan as $key => $val) {
			$cnt = 0;
			if ($val['ans1'] == $array_answer['ans1']) $cnt++;
			if ($val['ans2'] == $array_answer['ans2']) $cnt++;
			if ($val['ans3'] == $array_answer['ans3']) $cnt++;
			if ($val['ans4'] == $array_answer['ans4']) $cnt++;
			if ($val['ans5'] == $array_answer['ans5']) $cnt++;
			if ($val['ans6'] == $array_answer['ans6']) $cnt++;
			if ($val['ans7'] == $array_answer['ans7']) $cnt++;
			if ($val['ans8'] == $array_answer['ans8']) $cnt++;
			if ($val['ans9'] == $array_answer['ans9']) $cnt++;
			if ($val['ans10'] == $array_answer['ans10']) $cnt++;

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			if ($val['ans1']) {
				$tests[$key]['ans1'] = ($val['ans1'] == $array_answer['ans1']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans1'] = '';
			}

			if ($val['ans2']) {
				$tests[$key]['ans2'] = ($val['ans2'] == $array_answer['ans2']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans2'] = '';
			}

			if ($val['ans3']) {
				$tests[$key]['ans3'] = ($val['ans3'] == $array_answer['ans3']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans3'] = '';
			}

			if ($val['ans4']) {
				$tests[$key]['ans4'] = ($val['ans4'] == $array_answer['ans4']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans4'] = '';
			}

			if ($val['ans5']) {
				$tests[$key]['ans5'] = ($val['ans5'] == $array_answer['ans5']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans5'] = '';
			}

			if ($val['ans6']) {
				$tests[$key]['ans6'] = ($val['ans6'] == $array_answer['ans6']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans6'] = '';
			}

			if ($val['ans7']) {
				$tests[$key]['ans7'] = ($val['ans7'] == $array_answer['ans7']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans7'] = '';
			}

			if ($val['ans8']) {
				$tests[$key]['ans8'] = ($val['ans8'] == $array_answer['ans8']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans8'] = '';
			}

			if ($val['ans9']) {
				$tests[$key]['ans9'] = ($val['ans9'] == $array_answer['ans9']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans9'] = '';
			}

			if ($val['ans10']) {
				$tests[$key]['ans10'] = ($val['ans10'] == $array_answer['ans10']) ? "正解" : "不正解";
			} else {
				$tests[$key]['ans10'] = '';
			}
			$tests[$key]['count'] = ($cnt > 0) ? $cnt : '';
		}
	}

	$elanflg = "on";
}


$meaflg = "";
if ($typelist[50]) {
	//回答配列の呼び出し
	//include_once(D_PATH_HOME."/t/php/test50/explain.php");
	$array_exam[1] = array(
		1 => "連続した欠勤はない", 2 => "風邪等で２、３日休む程度 ", 3 => "４日以上連続して休んだことがある", 4 => "回答を見送ります"
	);
	$array_exam[2] = array(
		1 => "ない", 2 => "ある ", 3 => "回答を見送ります "
	);

	$array_exam[3] = array(
		1 => "ない", 2 => "ある ", 3 => "回答を見送ります "
	);

	$array_exam[4] = array(
		1 => "不要", 2 => "希望する ", 3 => "回答を見送ります "
	);

	$array_exam[5] = array(
		1 => "現在会員である。", 2 => "過去1年以内まで会員であった。", 3 => "過去1年以上前に会員であった。", 4 => "会員になったことは一度もない。"
	);



	$amet['customer_id'] = $id;
	$amet['partner_id'] = $ptid;
	$amet['testgrp_id'] = $sec;
	$amet['type'] = 50;
	if ($third == "complete") $amet['complete_flg'] = 1;
	$order = "number";
	$mea = $obj->getMEAData($amet, $order, $limit);
	if (count($mea)) {
		foreach ($mea as $key => $val) {

			if ($val['exam_state'] == 1) {
				$tests[$key]['exam_date'] = mb_convert_encoding('受検中', 'EUC-JP', 'UTF-8');
			} else {
				$ex = substr($val['fin_exam_date'], 0, 10);
				$fdate = preg_replace("/\-/", "/", $ex);
				$fdate = $val['exam_date'];
				$tests[$key]['exam_date'] = $fdate;
			}
			$tests[$key]['answer1'] = $array_exam[1][$val['answer1']];
			$tests[$key]['answer1_holiday'] = $val['answer1_holiday'];
			$tests[$key]['answer1_reason'] = $val['answer1_reason'];
			$tests[$key]['answer2'] = $array_exam[2][$val['answer2']];
			$tests[$key]['answer2_year'] = $val['answer2_year'];
			$tests[$key]['answer2_month'] = $val['answer2_month'];
			$tests[$key]['answer2_disease'] = $val['answer2_disease'];
			$tests[$key]['answer3'] = $array_exam[3][$val['answer3']];
			$tests[$key]['answer3_year'] = $val['answer3_year'];
			$tests[$key]['answer3_month'] = $val['answer3_month'];
			$tests[$key]['answer3_disease'] = $val['answer3_disease'];
			$tests[$key]['answer4'] = $array_exam[4][$val['answer4']];
			$tests[$key]['answer4_disease'] = $val['answer4_disease'];
			$tests[$key]['answer5'] = $array_exam[5][$val['answer5']];
		}
	}

	$meaflg = "on";
}


if (
	$typelist[77] ||
	$typelist[78] ||
	$typelist[79] ||
	$typelist[80]
) {
	//nspeデータ取得
	//データ取得

	$nsp = [];
	$nsp['test_id'] = $sec;
	$nspe1 = $obj->getNSPE($nsp);
	$nsp = [];
	$nsp['test_id'] = $sec;
	$nspe2 = $obj->getNSPE($nsp, 2);
	$nsp = [];
	$nsp['test_id'] = $sec;
	$nspe3 = $obj->getNSPE($nsp, 3);
	$nsp = [];
	$nsp['test_id'] = $sec;
	$nspe4 = $obj->getNSPE($nsp, 4);

	//	var_dump($tests,$nspe1,$nspe2,$nspe3,$nspe4);
	$list = [];
	foreach ($tests as $k => $v) {
		if ($third == "complete") {
			if ($v['complete_flg'] == 1) {
				$list[$k] = $v;
			}
		} else {
			$list[$k] = $v;
		}
	}
	$tests = [];
	foreach ($list as $key => $value) {
		$tests[$key] = $value;
		for ($i = 1; $i <= 7; $i++) {
			$ans = "ans" . $i;
			$tests[$key]['nspe1'][$ans] = $nspe1[$value['exam_id']][$ans];
		}
		$tests[$key]['nspe1']['collect'] = $nspe1[$value['exam_id']]['collect'];

		for ($i = 1; $i <= 7; $i++) {
			$ans = "ans" . $i;
			$tests[$key]['nspe2'][$ans] = $nspe2[$value['exam_id']][$ans];
		}
		$tests[$key]['nspe2']['collect'] = $nspe2[$value['exam_id']]['collect'];
		for ($i = 1; $i <= 7; $i++) {
			$ans = "ans" . $i;
			$tests[$key]['nspe3'][$ans] = $nspe3[$value['exam_id']][$ans];
		}
		$tests[$key]['nspe3']['collect'] = $nspe3[$value['exam_id']]['collect'];
		for ($i = 1; $i <= 7; $i++) {
			$ans = "ans" . $i;
			$tests[$key]['nspe4'][$ans] = $nspe4[$value['exam_id']][$ans];
		}
		$tests[$key]['nspe4']['collect'] = $nspe4[$value['exam_id']]['collect'];
	}
}
if ($typelist[51]) {
	$wbsa['testgrp_id'] = $sec;
	$wbsa['partner_id'] = $ptid;
	$wbsa['customer_id'] = $id;
	$bsa = $obj->getBsa($wbsa);
	$bsaflg = "on";
}
$ampdata = [];
if ($typelist[83]) {
	$ampData = $obj->getAMP($where);
}
session_start();
//$company_name = mb_convert_encoding($_SESSION["_authsession"][ 'data' ][ 'name' ],'EUC-JP','UTF-8');
$company_name = mb_convert_encoding($_SESSION['name'], 'EUC-JP', 'UTF-8');
$test_name    =  mb_convert_encoding($tdatlist[0]['name'], 'EUC-JP', 'UTF-8');

$reviser = new Excel_Reviser;

$reviser->addString(0, 0, 2, $company_name);
$reviser->addString(0, 0, 8, $test_name);
if ($tdatlist[0]['weight'] == 1) {
	$reviser->rmCell(0, 0, 14);
}
if ($wtm['master_name']) {
	$wtmsg = mb_convert_encoding("行動価値で青枠になっているのは御社で重要な素養です(利用基準名：" . $wtm['master_name'] . ")", "EUC-JP", "UTF-8");
	$reviser->addString(0, 0, 15, $wtmsg);
}

$row = 5;
//重みマスタが指定してあるときは
//scoreとlevelの再設定を行う
$whereWt = array();
$whereWt['id'] = $_REQUEST['wt'];
$whereWt['uid'] = $id;
$whereWt['pid'] = $ptid;
$whereWt['limit'] = 1;
$whereWt['offset'] = 0;

$havey = $objw->getList($whereWt, 1);

foreach ($tests as $key => $val) {
	$line = 1;
	if ($val['type'] == 57) {
		//AAP検査
		$reviser->addString(0, $row, $line++, $val['exam_id'],    5, 1, 1);
		$sts = mb_convert_encoding($val['sts'], "euc-jp", "UTF-8");
		$reviser->addString(0, $row, $line++, $sts, 5, 2, 1);
		if ($val['gender'] == 1) {
			$nam = mb_convert_encoding($val['name'], "euc-jp", "UTF-8");
			$reviser->addString(0, $row, $line++, $nam,    5, 3, 1);
		} else {
			$nam = mb_convert_encoding($val['kana'], "euc-jp", "UTF-8");
			$reviser->addString(0, $row, $line++, $nam,    5, 3, 1);
		}
		$reviser->addString(0, $row, $line++, "",    5, 3, 1);

		$reviser->addString(0, $row, $line++, preg_replace("/\-/", "/", $val['birthday']),    5, 4, 1);
		$age = $app->get_age($val['birthday'], $val['start_time']);
		if ($age > 100) $age = "";
		$reviser->addString(0, $row, $line++, $age,    5, 4, 1);
		$st = preg_replace("/\-/", "/", $val['start_time']);
		$st1 = explode(" ", $st);
		$reviser->addString(0, $row, $line++,  $st1[0],    5, 4, 1);
		$gender = mb_convert_encoding($val['gendername'], "euc-jp", "UTF-8");
		$reviser->addString(0, $row, $line++,  $gender,    5, 4, 1);
		$reviser->addString(0, $row, $line++,  "",    5, 4, 1);
		$reviser->addString(0, $row, $line++,  "",    5, 4, 1);
		list($lv, $sc) = $app->getStress($val['con1'], $val['con2']);

		if ($sc <= 0) {
			$reviser->addString(0, $row, $line++, "", 8, 7, 1);
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		} else {
			if (!$lv) {
				$reviser->addString(0, $row, $line++, "", 8, 7, 1);
			} elseif ($lv == 1) {
				$reviser->addNumber(0, $row, $line++, $lv, 7, 7, 1);
			} elseif ($lv == 2) {
				$reviser->addNumber(0, $row, $line++, $lv, 6, 7, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, $lv, 8, 7, 1);
			}

			$reviser->addNumber(0, $row, $line++, $sc, 6, 8, 1);
		}
	} else {
		$exam_id = $val['exam_id'];
		if ($val['exam_state'] == 1) {
			$exam_state = "受検中";
		} elseif ($val['exam_state'] == 2 && $val['complete_flg'] == 0) {
			$exam_state = "受検中";
		} elseif ($val['exam_state'] == 2) {
			$exam_state = "受検済み";
		} else {
			$exam_state = "未受検";
		}
		$name  = mb_convert_encoding($val['name'], "eucJP-win", "UTF-8");
		$kana  = mb_convert_encoding($val['kana'], "eucJP-win", "UTF-8");
		$birth = $val['birth'];
		if ($val['birth']) {
			$age = $db->get_age($val['birth']) . "";
		} else {
			$age = "";
		}
		$exam_state = mb_convert_encoding($exam_state, "EUC-JP", "UTF-8");
		$exam_date  = $val['exam_date'];

		$pass       = mb_convert_encoding($val['pass'], "eucJP-win", "UTF-8");
		$memo1      = mb_convert_encoding($val['memo1'], "eucJP-win", "UTF-8");
		$memo2      = mb_convert_encoding($val['memo2'], "eucJP-win", "UTF-8");

		$types = $val['type'];

		//	if($types ==1 || $types == 2 || $types == 12  || $types == 41
		//		|| $typelist[1] || $typelist[2] || $typelist[12] | $typelist[41] ){
		if ($tdatlist[0]['stress_flg'] && ($val['dev1'] && $val['dev2'] && $val['dev6'])) {
			list($st_level, $st_score) = $db->getStress2($val['dev1'], $val['dev2'], $val['dev6']);
		} else
                    if (($val['dev1'] && $val['dev2'])) {

			list($st_level, $st_score) = $db->getStress($val['dev1'], $val['dev2']);
		} else {
			$st_level = "";
			$st_score = "";
		}
		//	}


		if ($tdatlist[0]['weight'] ==  1) {
			$level = "";
			$score = "";
		} else {
			$level = $val['level'];
			if ($val['score']) {
				$score = round($val['score'], 2);
			} else {
				$score = "";
			}
		}



		$dev1  = round($val['dev1'], 1);
		$dev2  = round($val['dev2'], 1);
		$dev3  = round($val['dev3'], 1);
		$dev4  = round($val['dev4'], 1);
		$dev5  = round($val['dev5'], 1);
		$dev6  = round($val['dev6'], 1);
		$dev7  = round($val['dev7'], 1);
		$dev8  = round($val['dev8'], 1);
		$dev9  = round($val['dev9'], 1);
		$dev10 = round($val['dev10'], 1);
		$dev11 = round($val['dev11'], 1);
		$dev12 = round($val['dev12'], 1);


		$reviser->addString(0, $row, $line++, $exam_id,    5, 1, 1);
		$reviser->addString(0, $row, $line++, $exam_state, 5, 2, 1);
		$reviser->addString(0, $row, $line++, $name,       5, 3, 1);
		$reviser->addString(0, $row, $line++, $kana,       5, 3, 1);

		$reviser->addString(0, $row, $line++, $birth,      5, 4, 1);
		if ($age) {
			$reviser->addNumber(0, $row, $line++, $age,        5, 4, 1);
		} else {
			$reviser->addString(0, $row, $line++, $age,        5, 4, 1);
		}
		$reviser->addString(0, $row, $line++, $exam_date,  5, 4, 1);
		$reviser->addString(0, $row, $line++, $pass,       5, 4, 1);
		$reviser->addString(0, $row, $line++, $memo1,      5, 4, 1);
		$reviser->addString(0, $row, $line++, $memo2,      5, 4, 1);
	}

	//---------------------------------------------------------------------------
	//MET検査
	//---------------------------------------------------------------------------

	if ($metflg) {
		if ($val['std1']) {
			$reviser->addNumber(0, $row, $line++, $val['std1'], 6, 7, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 7, 1);
		}
		if ($val['std2']) {
			$reviser->addNumber(0, $row, $line++, $val['std2'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std3']) {
			$reviser->addNumber(0, $row, $line++, $val['std3'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std4']) {
			$reviser->addNumber(0, $row, $line++, $val['std4'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std5']) {
			$reviser->addNumber(0, $row, $line++, $val['std5'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std6']) {
			$reviser->addNumber(0, $row, $line++, $val['std6'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std7']) {
			$reviser->addNumber(0, $row, $line++, $val['std7'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std8']) {
			$reviser->addNumber(0, $row, $line++, $val['std8'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std9']) {
			$reviser->addNumber(0, $row, $line++, $val['std9'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std10']) {
			$reviser->addNumber(0, $row, $line++, $val['std10'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std11']) {
			$reviser->addNumber(0, $row, $line++, $val['std11'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		}
		if ($val['std12']) {
			$reviser->addNumber(0, $row, $line++, $val['std12'], 5, 20, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 5, 20, 1);
		}
	}

	//---------------------------------------------------------------------------
	//MMS検査
	//---------------------------------------------------------------------------

	if ($mmsflg) {
		if ($val['result1'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result1'], 7, 9, 1);
		} elseif ($val['result1'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result1'], 6, 9, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result1'], 5, 9, 1);
		}

		if ($val['result2'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result2'], 7, 10, 1);
		} elseif ($val['result2'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result2'], 6, 10, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result2'], 5, 10, 1);
		}


		if ($val['result3'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result3'], 7, 11, 1);
		} elseif ($val['result3'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result3'], 6, 11, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result3'], 5, 11, 1);
		}



		if ($val['result4'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result4'], 7, 12, 1);
		} elseif ($val['result4'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result4'], 6, 12, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result4'], 5, 12, 1);
		}


		if ($val['result5'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result5'], 7, 13, 1);
		} elseif ($val['result5'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result5'], 6, 13, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result5'], 5, 13, 1);
		}


		if ($val['result6'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result6'], 7, 14, 1);
		} elseif ($val['result6'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result6'], 6, 14, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result6'], 5, 14, 1);
		}

		if ($val['result7'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result7'], 7, 15, 1);
		} elseif ($val['result7'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result7'], 6, 15, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result7'], 5, 15, 1);
		}


		if ($val['result8'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result8'], 7, 16, 1);
		} elseif ($val['result8'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result8'], 6, 16, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result8'], 5, 16, 1);
		}


		if ($val['result9'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result9'], 7, 17, 1);
		} elseif ($val['result9'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result9'], 6, 17, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result9'], 5, 17, 1);
		}


		if ($val['result10'] > 10) {
			$reviser->addString(0, $row, $line++, $val['result10'], 7, 18, 1);
		} elseif ($val['result10'] > 8) {
			$reviser->addString(0, $row, $line++, $val['result10'], 6, 18, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['result10'], 5, 18, 1);
		}
	}

	//---------------------------------------------------------------------------
	//elan検査
	//---------------------------------------------------------------------------
	if ($elanflg) {
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans1'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans2'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans3'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans4'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans5'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans6'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans7'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans8'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans9'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['ans10'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['count'], "EUC-JP", "UTF-8"), 5, 20, 1);
	}
	//---------------------------------------------------------------------------
	//IQ検査
	//---------------------------------------------------------------------------

	if ($IQflg) {

		$l_score = $val['language_score'];
		$m_score = $val['iq_math_score'];
		//平均値
		if ($l_score && $m_score) {
			$h_score = round(($l_score + $m_score) / 2, 1);
			$h_lv = getIQLevel($h_score);
		} else {
			$h_score = "";
			$h_lv = "";
		}
		//言語レベル
		if ($l_score) {
			$l_lv = getIQLevel($l_score);
		} else {
			$l_lv = "";
		}

		//数値レベル
		if ($m_score) {
			$m_lv = getIQLevel($m_score);
		} else {
			$m_lv = "";
		}


		if (!$h_lv) {
			$reviser->addString(0, $row, $line++, "", 8, 7, 1);
		} elseif ($h_lv == 1) {
			$reviser->addNumber(0, $row, $line++, $h_lv, 7, 7, 1);
		} elseif ($h_lv == 2) {
			$reviser->addNumber(0, $row, $line++, $h_lv, 6, 7, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $h_lv, 8, 7, 1);
		}

		if ($h_score) {
			$reviser->addNumber(0, $row, $line++, $h_score, 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $h_score, 6, 8, 1);
		}



		if (!$l_lv) {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		} elseif ($l_lv == 1) {
			$reviser->addNumber(0, $row, $line++, $l_lv, 10, 7, 1);
		} elseif ($l_lv == 2) {
			$reviser->addNumber(0, $row, $line++, $l_lv, 9, 7, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $l_lv, 11, 7, 1);
		}

		if ($l_score) {
			$reviser->addNumber(0, $row, $line++, $l_score, 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $l_score, 6, 8, 1);
		}



		if (!$m_lv) {
			$reviser->addString(0, $row, $line++, "", 6, 8, 1);
		} elseif ($m_lv == 1) {
			$reviser->addNumber(0, $row, $line++, $m_lv, 10, 7, 1);
		} elseif ($m_lv == 2) {
			$reviser->addNumber(0, $row, $line++, $m_lv, 9, 7, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $m_lv, 11, 7, 1);
		}
		if ($m_score) {
			$reviser->addNumber(0, $row, $line++, $m_score, 11, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $m_score, 11, 8, 1);
		}
	}


	if ($delAction) {

		if (!$st_level) {
			$reviser->addString(0, $row, $line++, $st_level, 8, 7, 1);
		} else
		if ($st_level <= 1) {
			$reviser->addNumber(0, $row, $line++, $st_level, 7, 7, 1);
		} elseif ($st_level == 2) {
			$reviser->addNumber(0, $row, $line++, $st_level, 6, 7, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $st_level, 8, 7, 1);
		}
		//var_dump($st_score);
		if ($st_score) {
			$reviser->addNumber(0, $row, $line++, $st_score, 5, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $st_score, 5, 8, 1);
		}
		//$weightがあるのときは重み付けがある

		if ($weight) {

			if (!$level) {
				$reviser->addString(0, $row, $line++, $level, 11, 7, 1);
			} else
			if ($level <= 1) {
				$reviser->addNumber(0, $row, $line++, $level, 10, 7, 1);
			} elseif ($level == 2) {
				$reviser->addNumber(0, $row, $line++, $level, 9, 7, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, $level, 11, 7, 1);
			}

			if (!$score) {
				$reviser->addString(0, $row, $line++, $score, 8, 8, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, $score, 8, 8, 1);
			}
		}

		if ($dev1 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 9, 1);
		} else
	    if ($dev1 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev1, 7, 9, 1);
		} elseif ($dev1 < 45) {
			$reviser->addNumber(0, $row,  $line++, $dev1, 6, 9, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev1, 5, 9, 1);
		}

		if ($dev2 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 10, 1);
		} else
		if ($dev2 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev2, 7, 10, 1);
		} elseif ($dev2 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev2, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev2, 5, 10, 1);
		}

		if ($dev3 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 11, 1);
		} else
		if ($dev3 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev3, 7, 11, 1);
		} elseif ($dev3 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev3, 6, 11, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev3, 5, 11, 1);
		}

		if ($dev4 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 12, 1);
		} else
		if ($dev4 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev4, 7, 12, 1);
		} elseif ($dev4 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev4, 6, 12, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev4, 5, 12, 1);
		}

		if ($dev5 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 13, 1);
		} else
		if ($dev5 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev5, 7, 13, 1);
		} elseif ($dev5 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev5, 6, 13, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev5, 5, 13, 1);
		}

		if ($dev6 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 14, 1);
		} else
		if ($dev6 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev6, 7, 14, 1);
		} elseif ($dev6 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev6, 6, 14, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev6, 5, 14, 1);
		}

		if ($dev7 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 15, 1);
		} else
		if ($dev7 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev7, 7, 15, 1);
		} elseif ($dev7 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev7, 6, 15, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev7, 5, 15, 1);
		}

		if ($dev8 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 16, 1);
		} else
		if ($dev8 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev8, 7, 16, 1);
		} elseif ($dev8 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev8, 6, 16, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev8, 5, 16, 1);
		}


		if ($dev9 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 17, 1);
		} else
		if ($dev9 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev9, 7, 17, 1);
		} elseif ($dev9 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev9, 6, 17, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev9, 5, 17, 1);
		}

		if ($dev10 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 18, 1);
		} else
		if ($dev10 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev10, 7, 18, 1);
		} elseif ($dev10 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev10, 6, 18, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev10, 5, 18, 1);
		}


		if ($dev11 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 19, 1);
		} else
		if ($dev11 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev11, 7, 19, 1);
		} elseif ($dev11 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev11, 6, 19, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev11, 5, 19, 1);
		}


		if ($dev12 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 5, 20, 1);
		} else
		if ($dev12 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev12, 7, 20, 1);
		} elseif ($dev12 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev12, 6, 20, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev12, 5, 20, 1);
		}

		//職種リスクのロジック
		//自己肯定力3、コントロール＆アチーブメント力4、状況察知力8 の2つ以上が40未満の場合に、１を出力します
		/*
         * ロジック）
        STEP１：該当する偏差値に重みを掛けます。
        5ビジョン創出力　×　0.005878
        6ポジティブ思考力　×　0.30688
        9ホスピタリティ発揮力　×　（-0.038331）
        12集団適応力　×　(-0.146912)

        STEP２：合計する
        ４つの値を合計する
        STEP３：下記を加える
        STEP２の値に、2.42973　を加える

        STEP４：リスクの判定
        STEP３で算出した合計が　５．６　より小さい時（合計＜５．６）、１を出力します。

         *
         */
		if ($delAction && $download_excel) {
			$jobrisk = "";
			$jobriskKey = 0;
			if ($exam_date) {
				if ($dev3 < 40) {
					$jobriskKey++;
				}
				if ($dev4 < 40) {
					$jobriskKey++;
				}
				if ($dev8 < 40) {
					$jobriskKey++;
				}
				if ($jobriskKey >= 2) {
					$jobrisk = 1;
				}
			}

			$jobrisk2 = "";
			$jobtotal  = (($dev5 * 0.005878) + ($dev6 * 0.30688) + ($dev9 * -0.038331) + ($dev12 * -0.146912)) + 2.42973;
			if ($exam_date) {
				if ($jobtotal < 5.6) $jobrisk2 = 1;
			}
			$reviser->addString(0, $row, $line++, $jobrisk, 5, 19, 1);
			$reviser->addString(0, $row, $line, $jobrisk2, 5, 20, 1);
		}
	}






	if ($delFS) {
		//welcomeFSの値記入
		$reviser->addString(0, $row, $line++, $val['fs_score'], 7, 6, 1);
	}

	if ($delVF) {
		//VF検査
		$reviser->addString(0, $row, $line++, $val['vf_w1'], 6, 7, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w2'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w3'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w4'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w5'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w6'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w7'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w8'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w9'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w10'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w11'], 7, 8, 1);
		$reviser->addString(0, $row, $line++, $val['vf_w12'], 11, 8, 1);

		if ($val['vf_dev1']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev1'], 6, 7,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 7,  1);
		}
		if ($val['vf_dev2']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev2'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev3']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev3'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev4']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev4'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev5']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev5'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev6']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev6'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev7']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev7'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev8']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev8'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev9']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev9'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev10']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev10'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev11']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev11'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_dev12']) {
			$reviser->addString(0, $row, $line++, $val['vf_dev12'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_avg']) {
			$reviser->addString(0, $row, $line++, $val['vf_avg'], 7, 8,  1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8,  1);
		}
		if ($val['vf_std']) {
			$reviser->addString(0, $row, $line++, $val['vf_std'], 11, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, '', 11, 8,  1);
		}
	}

	if ($delDP) {
		//感情能力
		if ($val['sougo']) {
			$reviser->addNumber(0, $row, $line++, $val['sougo'], 8, 7, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['sougo'], 8, 7, 1);
		}
		if ($val['yomitori']) {
			$reviser->addNumber(0, $row, $line++, $val['yomitori'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['yomitori'], 6, 8, 1);
		}
		if ($val['rikai']) {
			$reviser->addNumber(0, $row, $line++, $val['rikai'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['rikai'], 6, 8, 1);
		}
		if ($val['sentaku']) {
			$reviser->addNumber(0, $row, $line++, $val['sentaku'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['sentaku'], 6, 8, 1);
		}
		if ($val['kirikae']) {
			$reviser->addNumber(0, $row, $line++, $val['kirikae'], 6, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['kirikae'], 6, 8, 1);
		}
		if ($val['jyoho']) {
			$reviser->addNumber(0, $row, $line++, $val['jyoho'], 11, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, $val['jyoho'], 11, 8, 1);
		}
	}

	if ($delMV) {
		//行動意識
		$reviser->addString(0, $row, $line++, $val['score1'], 8, 7, 1);
		$reviser->addString(0, $row, $line++, $val['score2'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score3'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score4'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score5'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score6'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score7'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score8'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score9'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score10'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score11'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score12'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score13'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score14'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score15'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score16'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score17'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score18'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score19'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score20'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score21'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score22'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score23'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score24'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['score25'], 11, 8, 1);
	}

	if ($math) {

		//数学検定
		if ($val['math_level']) {
			$reviser->addNumber(0, $row, $line++, $val['math_level'], 12, 7, 1);
		} else {
			$reviser->addString(0, $row, $line++, '', 12, 7, 1);
		}

		if ($val['math_score']) {
			$reviser->addNumber(0, $row, $line++, $val['math_score'], 12, 8, 1);
		} else {
			$reviser->addString(0, $row, $line++, '', 6, 8, 1);
		}
		$reviser->addString(0, $row, $line++, $val['haku_yoso'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['bunseki_yoso'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['sentaku_yoso'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['yosoku_yoso'], 6, 8, 1);
		$reviser->addString(0, $row, $line++, $val['hyogen_yoso'], 11, 8, 1);
	}

	if ($nl3flg) {
		//NL2データ
		$nldata1  = round($val['nl3_score1'], 1);
		$nldata2  = round($val['nl3_score2'], 1);
		$nldata3  = round($val['nl3_score3'], 1);
		$nldata4  = round($val['nl3_score4'], 1);
		$nldata5  = round($val['nl3_score5'], 1);
		$nldata6  = round($val['nl3_score6'], 1);
		$nldata7  = round($val['nl3_score7'], 1);
		$nldata8  = round($val['nl3_score8'], 1);
		$nldata9  = round($val['nl3_score9'], 1);
		$nldata10 = round($val['nl3_score10'], 1);
		$nldata11 = round($val['nl3_score11'], 1);
		$nldata12 = round($val['nl3_score12'], 1);
		$nldata13 = round($val['nl3_score13'], 1);
		$nldata14 = round($val['nl3_score14'], 1);
		$nldata15 = round($val['nl3_score15'], 1);
		$nldata16 = round($val['nl3_score16'], 1);
		$nldata17 = round($val['nl3_score17'], 1);
		$nldata18 = round($val['nl3_score18'], 1);
		$nldata19 = round($val['nl3_score19'], 1);

		if ($nldata1 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 6, 7, 1);
		} else
	    if ($nldata1 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata1, 7, 9, 1);
		} elseif ($nldata1 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata1, 6, 9, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata1, 6, 7, 1);
		}

		if ($nldata2 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata2 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata2, 7, 10, 1);
		} elseif ($nldata2 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata2, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata2, 8, 8, 1);
		}


		if ($nldata3 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata3 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata3, 7, 10, 1);
		} elseif ($nldata3 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata3, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata3, 8, 8, 1);
		}


		if ($nldata4 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata4 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata4, 7, 10, 1);
		} elseif ($nldata4 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata4, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata4, 8, 8, 1);
		}


		if ($nldata5 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata5 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata5, 7, 10, 1);
		} elseif ($nldata5 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata5, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata5, 8, 8, 1);
		}


		if ($nldata6 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata6 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata6, 7, 10, 1);
		} elseif ($nldata6 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata6, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata6, 8, 8, 1);
		}

		if ($nldata7 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata7 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata7, 7, 10, 1);
		} elseif ($nldata7 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata7, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata7, 8, 8, 1);
		}


		if ($nldata8 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata8 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata8, 7, 10, 1);
		} elseif ($nldata8 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata8, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata8, 8, 8, 1);
		}

		if ($nldata9 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata9 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata9, 7, 10, 1);
		} elseif ($nldata9 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata9, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata9, 8, 8, 1);
		}

		if ($nldata10 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata10 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata10, 7, 10, 1);
		} elseif ($nldata10 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata10, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata10, 8, 8, 1);
		}

		if ($nldata11 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata11 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata11, 7, 10, 1);
		} elseif ($nldata11 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata11, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata11, 8, 8, 1);
		}

		if ($nldata12 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata12 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata12, 7, 10, 1);
		} elseif ($nldata12 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata12, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata12, 8, 8, 1);
		}

		if ($nldata13 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata13 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata13, 7, 10, 1);
		} elseif ($nldata13 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata13, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata13, 8, 8, 1);
		}

		if ($nldata14 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata14 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata14, 7, 10, 1);
		} elseif ($nldata14 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata14, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata14, 8, 8, 1);
		}


		if ($nldata15 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata15 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata15, 7, 10, 1);
		} elseif ($nldata15 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata15, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata15, 8, 8, 1);
		}


		if ($nldata16 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata16 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata16, 7, 10, 1);
		} elseif ($nldata16 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata16, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata16, 8, 8, 1);
		}


		if ($nldata17 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata17 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata17, 7, 10, 1);
		} elseif ($nldata17 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata17, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata17, 8, 8, 1);
		}


		if ($nldata18 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata18 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata18, 7, 10, 1);
		} elseif ($nldata18 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata18, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata18, 8, 8, 1);
		}


		if ($nldata19 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata19 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata19, 7, 10, 1);
		} elseif ($nldata19 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata19, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata19, 8, 8, 1);
		}
	}

	if ($nl2flg) {
		//NL2データ
		$nldata1  = round($val['nl2_score1'], 1);
		$nldata2  = round($val['nl2_score2'], 1);
		$nldata3  = round($val['nl2_score3'], 1);
		$nldata4  = round($val['nl2_score4'], 1);
		$nldata5  = round($val['nl2_score5'], 1);
		$nldata6  = round($val['nl2_score6'], 1);
		$nldata7  = round($val['nl2_score7'], 1);
		$nldata8  = round($val['nl2_score8'], 1);
		$nldata9  = round($val['nl2_score9'], 1);
		$nldata10 = round($val['nl2_score10'], 1);
		$nldata11 = round($val['nl2_score11'], 1);
		$nldata12 = round($val['nl2_score12'], 1);
		$nldata13 = round($val['nl2_score13'], 1);
		$nldata14 = round($val['nl2_score14'], 1);
		$nldata15 = round($val['nl2_score15'], 1);
		$nldata16 = round($val['nl2_score16'], 1);
		$nldata17 = round($val['nl2_score17'], 1);
		$nldata18 = round($val['nl2_score18'], 1);
		$nldata19 = round($val['nl2_score19'], 1);

		if ($nldata1 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 6, 7, 1);
		} else
	    if ($nldata1 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata1, 7, 9, 1);
		} elseif ($nldata1 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata1, 6, 9, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata1, 6, 7, 1);
		}

		if ($nldata2 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata2 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata2, 7, 10, 1);
		} elseif ($nldata2 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata2, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata2, 8, 8, 1);
		}


		if ($nldata3 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata3 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata3, 7, 10, 1);
		} elseif ($nldata3 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata3, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata3, 8, 8, 1);
		}


		if ($nldata4 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata4 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata4, 7, 10, 1);
		} elseif ($nldata4 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata4, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata4, 8, 8, 1);
		}


		if ($nldata5 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata5 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata5, 7, 10, 1);
		} elseif ($nldata5 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata5, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata5, 8, 8, 1);
		}


		if ($nldata6 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata6 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata6, 7, 10, 1);
		} elseif ($nldata6 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata6, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata6, 8, 8, 1);
		}

		if ($nldata7 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata7 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata7, 7, 10, 1);
		} elseif ($nldata7 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata7, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata7, 8, 8, 1);
		}


		if ($nldata8 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata8 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata8, 7, 10, 1);
		} elseif ($nldata8 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata8, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata8, 8, 8, 1);
		}

		if ($nldata9 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata9 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata9, 7, 10, 1);
		} elseif ($nldata9 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata9, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata9, 8, 8, 1);
		}

		if ($nldata10 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata10 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata10, 7, 10, 1);
		} elseif ($nldata10 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata10, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata10, 8, 8, 1);
		}

		if ($nldata11 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata11 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata11, 7, 10, 1);
		} elseif ($nldata11 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata11, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata11, 8, 8, 1);
		}

		if ($nldata12 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata12 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata12, 7, 10, 1);
		} elseif ($nldata12 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata12, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata12, 8, 8, 1);
		}

		if ($nldata13 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata13 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata13, 7, 10, 1);
		} elseif ($nldata13 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata13, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata13, 8, 8, 1);
		}

		if ($nldata14 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata14 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata14, 7, 10, 1);
		} elseif ($nldata14 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata14, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata14, 8, 8, 1);
		}


		if ($nldata15 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata15 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata15, 7, 10, 1);
		} elseif ($nldata15 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata15, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata15, 8, 8, 1);
		}


		if ($nldata16 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata16 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata16, 7, 10, 1);
		} elseif ($nldata16 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata16, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata16, 8, 8, 1);
		}


		if ($nldata17 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata17 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata17, 7, 10, 1);
		} elseif ($nldata17 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata17, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata17, 8, 8, 1);
		}


		if ($nldata18 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata18 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata18, 7, 10, 1);
		} elseif ($nldata18 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata18, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata18, 8, 8, 1);
		}


		if ($nldata19 == "0.0") {
			$reviser->addString(0, $row, $line++, " ", 8, 8, 1);
		} else
	    if ($nldata19 < 35) {
			$reviser->addNumber(0, $row, $line++, $nldata19, 7, 10, 1);
		} elseif ($nldata19 < 45) {
			$reviser->addNumber(0, $row,  $line++, $nldata19, 6, 10, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $nldata19, 8, 8, 1);
		}
	}

	//---------------------------------------------------------------------------
	//MEA検査
	//---------------------------------------------------------------------------
	if ($meaflg) {
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer1'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer1_holiday'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer1_reason'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer2'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer2_year'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer2_month'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer2_disease'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer3'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer3_year'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer3_month'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer3_disease'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer4'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer4_disease'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['answer5'], "EUC-JP", "UTF-8"), 5, 20, 1);
	}
	//---------------------------------------------------------------------------
	//ブランド検査
	//---------------------------------------------------------------------------
	if ($bsaflg) {
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score1'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score2'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score3'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score4'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score5'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score6'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score7'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score8'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score9'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($bsa[$val['exam_id']]['score10'], "EUC-JP", "UTF-8"), 5, 20, 1);
	}

	if ($ampData) {
		$array_exam[1] = [
			0 => "", 1 => "社長・取締役", 2 => "社外取・顧問", 3 => "執行役員", 4 => "部長", 5 => "マネジャー", 6 => "リーダー", 7 => "その他"
		];
		$array_exam[2] = [
			0 => "", 1 => "１−３０人", 2 => "３１−１００人", 3 => "１０１人ー５００人", 4 => "５０１人ー５０００人", 5 => "５００１以上", 6 => "非公開"
		];
		$array_exam[3] = [
			0 => "", 1 => "取締役・執行役員・事業部長クラス", 2 => "経理・財務・税務", 3 => "経営企画・事業企画", 4 => "内部統制・内部監査", 5 => "社外取締役・監査役", 6 => "事業開発・新規事業", 7 => "営業", 8 => "マーケティング", 9 => "宣伝・広告", 10 => "商品企画", 11 => "販促", 12 => "人事", 13 => "総務", 14 => "法務・知財", 15 => "広報・PR", 16 => "IR", 17 => "情報システム", 18 => "研究開発", 19 => "SCM・ロジスティクス", 20 => "その他"
		];
		$array_exam[4] = [
			0 => "", 1 => "IT・インターネット", 2 => "メーカー", 3 => "商社", 4 => "流通・小売・サービス", 5 => "コンサルティング", 6 => "マスコミ・メディア", 7 => "エンターテインメント", 8 => "金融", 9 => "建設", 10 => "不動産", 11 => "メディカル", 12 => "インフラ（電気、ガス、水道、エネルギー、鉄道、航空、石油、輸送）", 13 => "人材・研修・教育", 14 => "その他（官公庁・非営利団体）"
		];


		$q1 = $array_exam[1][$ampData[$val['exam_id']]['q1']];
		$q3 = $array_exam[2][$ampData[$val['exam_id']]['q3']];

		$q2 = explode(",", $ampData[$val['exam_id']]['q2']);
		$line2 = "";
		foreach ($q2 as $key => $value) {
			$line2 .= $array_exam[3][$value] . ",";
		}

		$q4 = $array_exam[4][$ampData[$val['exam_id']]['q4']];
		if ($ampData[$val['exam_id']]['ampdate'] === "0000-00-00") {
			$reviser->addString(0, $row, $line++, '', 5, 9, 1);
		} else {
			$reviser->addString(0, $row, $line++, preg_replace("/\-/", "/", $ampData[$val['exam_id']]['ampdate']), 5, 9, 1);
		}
		$reviser->addString(0, $row, $line++, mb_convert_encoding($q1, "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($q3, "EUC-JP", "UTF-8"), 5, 9, 1);

		$reviser->addString(0, $row, $line++, mb_convert_encoding($line2, "EUC-JP", "UTF-8"), 5, 9, 1);

		$reviser->addString(0, $row, $line++, mb_convert_encoding($q4, "EUC-JP", "UTF-8"), 5, 9, 1);
		for ($i = 1; $i <= 17; $i++) {
			if ($ampData[$val['exam_id']]['hensa' . $i] > 0) {
				$reviser->addNumber(0, $row, $line++, round($ampData[$val['exam_id']]['hensa' . $i], 2), 5, 9, 1);
			} else {
				$reviser->addString(0, $row, $line++, "", 5, 9, 1);
			}
		}
		if ($ampData[$val['exam_id']]['hensa18'] > 0) {
			$reviser->addNumber(0, $row, $line++, round($ampData[$val['exam_id']]['hensa18'], 2), 5, 20, 1);
		} else {
			$reviser->addString(0, $row, $line++, "", 5, 20, 1);
		}
	}
	//---------------------------------------------------------------------------
	//aac検査
	//---------------------------------------------------------------------------
	if ($aac) {
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev1'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev2'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev3'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev4'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev5'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev6'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev7'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev8'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev9'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev10'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev11'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev12'], "EUC-JP", "UTF-8"), 5, 9, 1);
		$reviser->addString(0, $row, $line++, mb_convert_encoding($val['dev13'], "EUC-JP", "UTF-8"), 5, 20, 1);
	}

	//---------------------------------------------------------------------------
	//aap検査
	//---------------------------------------------------------------------------
	if ($aap) {
		$dev1  = sprintf("%.1f", round($val['dev1'], 1));
		$dev2  = sprintf("%.1f", round($val['dev2'], 1));
		$dev3  = sprintf("%.1f", round($val['dev3'], 1));
		$dev4  = sprintf("%.1f", round($val['dev4'], 1));
		$dev5  = sprintf("%.1f", round($val['dev5'], 1));
		$dev6  = sprintf("%.1f", round($val['dev6'], 1));
		$dev7  = sprintf("%.1f", round($val['dev7'], 1));
		$dev8  = sprintf("%.1f", round($val['dev8'], 1));
		$dev9  = sprintf("%.1f", round($val['dev9'], 1));
		$dev10 = sprintf("%.1f", round($val['dev10'], 1));
		$dev11 = sprintf("%.1f", round($val['dev11'], 1));
		$dev12 = sprintf("%.1f", round($val['dev12'], 1));
		$con1  = sprintf("%.1f", round($val['con1'], 1));
		$con2  = sprintf("%.1f", round($val['con2'], 1));
		$con3  = sprintf("%.1f", round($val['con3'], 1));
		$con4  = sprintf("%.1f", round($val['con4'], 1));
		$con5  = sprintf("%.1f", round($val['con5'], 1));
		$con6  = sprintf("%.1f", round($val['con6'], 1));

		if ($dev1 <= 0) $dev1 = "";
		if ($dev2 <= 0) $dev2 = "";
		if ($dev3 <= 0) $dev3 = "";
		if ($dev4 <= 0) $dev4 = "";
		if ($dev5 <= 0) $dev5 = "";
		if ($dev6 <= 0) $dev6 = "";
		if ($dev7 <= 0) $dev7 = "";
		if ($dev8 <= 0) $dev8 = "";
		if ($dev9 <= 0) $dev9 = "";
		if ($dev10 <= 0) $dev10 = "";
		if ($dev11 <= 0) $dev11 = "";
		if ($dev12 <= 0) $dev12 = "";

		if ($con1 <= 0) $con1 = "";
		if ($con2 <= 0) $con2 = "";
		if ($con3 <= 0) $con3 = "";
		if ($con4 <= 0) $con4 = "";
		if ($con5 <= 0) $con5 = "";
		if ($con6 <= 0) $con6 = "";


		$reviser->addString(0, $row, $line++, $dev1, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev2, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev3, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev4, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev5, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev6, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev7, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev8, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev9, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev10, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev11, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $dev12, 5, 20, 1);


		$reviser->addString(0, $row, $line++, $con1, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $con2, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $con3, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $con4, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $con5, 5, 9, 1);
		$reviser->addString(0, $row, $line++, $con6, 5, 20, 1);
	}
	//---------------------------------------------------------------------------
	//pfs検査
	//---------------------------------------------------------------------------

	if ($val['type'] == 72 || $val['type'] == 82 || $val['type'] == 91) {
		if ($val['sougo']) {
			if ($val['sougo'] > 8) {
				$reviser->addNumber(0, $row, $line++, (string)$val['sougo'], 7, 7, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, (string)$val['sougo'], 5, 9, 1);
			}
		} else {
			$reviser->addString(0, $row, $line++, " ", 5, 9, 1);
		}
		if ($val['personal']) {
			if ($val['personal'] >= 60) {
				$reviser->addNumber(0, $row, $line++, (string)$val['personal'], 7, 9, 1);
			} elseif ($val['personal'] >= 52) {
				$reviser->addNumber(0, $row, $line++, (string)$val['personal'], 6, 9, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, (string)$val['personal'], 5, 9, 1);
			}
		} else {
			$reviser->addString(0, $row, $line++, "", 5, 9, 1);
		}


		if ($val['state']) {
			if ($val['state'] >= 60) {
				$reviser->addNumber(0, $row, $line++, (string)$val['state'], 7, 9, 1);
			} elseif ($val['state'] >= 52) {
				$reviser->addNumber(0, $row, $line++, (string)$val['state'], 6, 9, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, (string)$val['state'], 5, 9, 1);
			}
		} else {
			$reviser->addString(0, $row, $line++, "", 5, 9, 1);
		}
		if ($val['job']) {
			if ($val['job'] >= 60) {
				$reviser->addNumber(0, $row, $line++, (string)$val['job'], 7, 9, 1);
			} elseif ($val['job'] >= 52) {
				$reviser->addNumber(0, $row, $line++, (string)$val['job'], 6, 9, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, (string)$val['job'], 5, 9, 1);
			}
		} else {
			$reviser->addString(0, $row, $line++, "", 5, 9, 1);
		}
		if ($val['image']) {
			if ($val['image'] >= 60) {
				$reviser->addNumber(0, $row, $line++, (string)$val['image'], 7, 9, 1);
			} elseif ($val['image'] >= 52) {
				$reviser->addNumber(0, $row, $line++, (string)$val['image'], 6, 9, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, (string)$val['image'], 5, 9, 1);
			}
		} else {
			$reviser->addString(0, $row, $line++, "", 5, 9, 1);
		}
		if ($val['positive']) {
			if ($val['positive'] >= 60) {
				$reviser->addNumber(0, $row, $line++, (string)$val['positive'], 7, 9, 1);
			} elseif ($val['positive'] >= 52) {
				$reviser->addNumber(0, $row, $line++, (string)$val['positive'], 6, 9, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, (string)$val['positive'], 5, 9, 1);
			}
		} else {
			$reviser->addString(0, $row, $line++, "", 5, 9, 1);
		}
		if ($val['self']) {
			if ($val['self'] >= 60) {
				$reviser->addNumber(0, $row, $line++, (string)$val['self'], 11, 20, 1);
			} elseif ($val['self'] >= 52) {
				$reviser->addNumber(0, $row, $line++, (string)$val['self'], 10, 20, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, (string)$val['self'], 12, 20, 1);
			}
		} else {
			$reviser->addString(0, $row, $line++, "", 12, 20, 1);
		}
	}
	if (
		$val['type'] == 77 ||
		$val['type'] == 78 ||
		$val['type'] == 79 ||
		$val['type'] == 80
	) {
		for ($j = 1; $j <= 4; $j++) {
			$nsp = "nspe" . $j;
			$reviser->addString(0, $row, $line++, $val[$nsp]['ans1'], 11, 7, 1);
			$reviser->addString(0, $row, $line++, $val[$nsp]['ans2'], 5, 9, 1);
			$reviser->addString(0, $row, $line++, $val[$nsp]['ans3'], 5, 9, 1);
			$reviser->addString(0, $row, $line++, $val[$nsp]['ans4'], 5, 9, 1);
			$reviser->addString(0, $row, $line++, $val[$nsp]['ans5'], 5, 9, 1);
			$reviser->addString(0, $row, $line++, $val[$nsp]['ans6'], 5, 9, 1);
			$reviser->addString(0, $row, $line++, $val[$nsp]['ans7'], 5, 9, 1);
			$reviser->addString(0, $row, $line++, $val[$nsp]['collect'], 11, 8, 1);
		}
	}
	$row++;
}

if ($delAction && $download_excel) {
	//baj-1の修正　行の追加
	$exCode = $excel_add_list[$id][$download_excel];

	$reviser->addString(0, 2, $line - 1, mb_convert_encoding("リスク指標", "EUC-JP", "UTF-8"), 2, 21, 1);
	$reviser->addString(0, 3, $line - 1, "", 3, 22, 1);
	$reviser->addString(0, 4, $line - 1, mb_convert_encoding($exCode[1], "EUC-JP", "UTF-8"), 4, 21, 1);
	$reviser->addString(0, 4, $line, mb_convert_encoding($exCode[2], "EUC-JP", "UTF-8"), 4, 22, 1);

	$reviser->addString(0, 2, $line, "", 2, 22, 1);
	$reviser->addString(0, 3, $line, "", 3, 22, 1);


	$reviser->setCellMerge(0, 2, 3, $line - 1, $line);
	$reviser->chgColWidth(0, $line - 1, 4000);
	$reviser->chgColWidth(0, $line, 5000);
}









//登録済み要素名取得
$element = "";
$where = array();
$where['uid'] = $ptid;
$element = $obj->getElementData($where);

$other   = "自分の感情を認識できるか";
$other2  = "自分を客観的に評価できるか";
$other3  = "自分を価値ある存在として評価できるか";
$other4  = "自己をコントロールし、目標を達成できるか";
$other5  = "達成するべき目標を設定することができるか";
$other6  = "周囲の状況を柔軟に捉え、適応できるか";
$other7  = "相手に共感できるか";
$other8  = "職場の雰囲気を読み取ることができるか";
$other9  = "相手のして欲しいことを積極的にできるか";
$other10 = "集団を目標達成するために積極的に行動できるか";
$other11 = "相手のことを考慮しながら自分の考えを主張できるか";
$other12 = "人に興味があり、仲間との良好な関係を保つことができるか";

if ($delAction && $element) {

	if ($IQflg && $weight == false) {
		$yoko = 19;
	} elseif ($IQflg && $weight) {
		$yoko = 20;
	} else {
		$yoko = 13;
	}

	$w1 = mb_convert_encoding($element['e_feel'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko, $w1);

	$w1 = mb_convert_encoding($element['e_cus'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other2, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 1, $w1);


	$w1 = mb_convert_encoding($element['e_aff'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other3, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 2, $w1);


	$w1 = mb_convert_encoding($element['e_cntl'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other4, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 3, $w1);

	$w1 = mb_convert_encoding($element['e_vi'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other5, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 4, $w1);

	$w1 = mb_convert_encoding($element['e_pos'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other6, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 5, $w1);

	$w1 = mb_convert_encoding($element['e_symp'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other7, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 6, $w1);

	$w1 = mb_convert_encoding($element['e_situ'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other8, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 7, $w1);

	$w1 = mb_convert_encoding($element['e_hosp'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other9, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 8, $w1);

	$w1 = mb_convert_encoding($element['e_lead'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other10, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 9, $w1);

	$w1 = mb_convert_encoding($element['e_ass'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other11, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 10, $w1);

	$w1 = mb_convert_encoding($element['e_adap'], "EUC-JP", "UTF-8");
	if ($w1) {
		$w1 .= "\n";
	}
	$w1 .= mb_convert_encoding($other12, "EUC-JP", "UTF-8");
	$reviser->addString(0, 4, $yoko + 11, $w1);
}

if ($weight) {
	if ($IQflg) {
		$wyoko = 21;
	} else {
		$wyoko = 15;
	}

	if ($element['e_feel']) {
		$w1 = $element['e_feel'];
	} else {
		$w1 = $a_element['w1'];
	}
	$str1 = mb_convert_encoding($w1 . "\n" . $other, "EUC-JP", "UTF-8");
	if ($tdat[0]['w1']) {
		$reviser->addString(0, 4, $wyoko, $str1, 4, 9, 1);
	} else {
		$reviser->addString(0, 4, $wyoko, $str1);
	}

	if ($element['e_cus']) {
		$w2 = $element['e_cus'];
	} else {
		$w2 = $a_element['w2'];
	}
	$str2 = mb_convert_encoding($w2 . "\n" . $other2, "EUC-JP", "UTF-8");

	if ($tdat[0]['w2']) {
		$reviser->addString(0, 4, $wyoko + 1, $str2,  4, 10, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 1, $str2);
	}
	if ($element['e_aff']) {
		$w2 = $element['e_aff'];
	} else {
		$w2 = $a_element['w3'];
	}
	$str3 = mb_convert_encoding($w2 . "\n" . $other3, "EUC-JP", "UTF-8");

	if ($tdat[0]['w3']) {
		$reviser->addString(0, 4, $wyoko + 2, $str3, 4, 11, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 2, $str3);
	}

	if ($element['e_cntl']) {
		$w2 = $element['e_cntl'];
	} else {
		$w2 = $a_element['w4'];
	}
	$str4 = mb_convert_encoding($w2 . "\n" . $other4, "EUC-JP", "UTF-8");
	if ($tdat[0]['w4']) {
		$reviser->addString(0, 4, $wyoko + 3, $str4, 4, 12, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 3, $str4);
	}


	if ($element['e_vi']) {
		$w2 = $element['e_vi'];
	} else {
		$w2 = $a_element['w5'];
	}
	$str5 = mb_convert_encoding($w2 . "\n" . $other5, "EUC-JP", "UTF-8");
	if ($tdat[0]['w5']) {
		$reviser->addString(0, 4, $wyoko + 4, $str5, 4, 13, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 4, $str5);
	}


	if ($element['e_pos']) {
		$w2 = $element['e_pos'];
	} else {
		$w2 = $a_element['w6'];
	}
	$str6 = mb_convert_encoding($w2 . "\n" . $other6, "EUC-JP", "UTF-8");
	if ($tdat[0]['w6']) {
		$reviser->addString(0, 4, $wyoko + 5, $str6, 4, 14, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 5, $str6);
	}

	if ($element['e_symp']) {
		$w2 = $element['e_symp'];
	} else {
		$w2 = $a_element['w7'];
	}
	$str7 = mb_convert_encoding($w2 . "\n" . $other7, "EUC-JP", "UTF-8");
	if ($tdat[0]['w7']) {
		$reviser->addString(0, 4, $wyoko + 6, $str7, 4, 15, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 6, $str7);
	}

	if ($element['e_situ']) {
		$w2 = $element['e_situ'];
	} else {
		$w2 = $a_element['w8'];
	}
	$str8 = mb_convert_encoding($w2 . "\n" . $other8, "EUC-JP", "UTF-8");
	if ($tdat[0]['w8']) {
		$reviser->addString(0, 4, $wyoko + 7, $str8, 4, 16, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 7, $str8);
	}


	if ($element['e_hosp']) {
		$w2 = $element['e_hosp'];
	} else {
		$w2 = $a_element['w9'];
	}
	$str9 = mb_convert_encoding($w2 . "\n" . $other9, "EUC-JP", "UTF-8");
	if ($tdat[0]['w9']) {
		$reviser->addString(0, 4, $wyoko + 8, $str9, 4, 17, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 8, $str9);
	}

	if ($element['e_lead']) {
		$w2 = $element['e_lead'];
	} else {
		$w2 = $a_element['w10'];
	}
	$str10 = mb_convert_encoding($w2 . "\n" . $other10, "EUC-JP", "UTF-8");
	if ($tdat[0]['w10']) {
		$reviser->addString(0, 4, $wyoko + 9, $str10, 4, 18, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 9, $str10);
	}

	if ($element['e_ass']) {
		$w2 = $element['e_ass'];
	} else {
		$w2 = $a_element['w11'];
	}
	$str11 = mb_convert_encoding($w2 . "\n" . $other11, "EUC-JP", "UTF-8");
	if ($tdat[0]['w11']) {

		$reviser->addString(0, 4, $wyoko + 10, $str11, 4, 19, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 10, $str11);
	}

	if ($element['e_adap']) {
		$w2 = $element['e_adap'];
	} else {
		$w2 = $a_element['w12'];
	}
	$str12 = mb_convert_encoding($w2 . "\n" . $other12, "EUC-JP", "UTF-8");
	if ($tdat[0]['w12']) {
		$reviser->addString(0, 4, $wyoko + 11, $str12, 4, 20, 1);
	} else {
		$reviser->addString(0, 4, $wyoko + 11, $str12);
	}
}

// シートを削除する例です。
$reviser->rmSheet(1);
if (!$weight) {
	if ($delAction) {
		$paperW = "_W";
	}
}
$exfile = "paper" . $amp . $delAction . $delFS . $delVF . $delDP . $delMV . $delmath . $delIq . $delnl2 . $delmet . $delMMS . $delELAN . $delMEA . $delBSA . $aac . $aap . $paperW . $nspe;

if ($excel_type == 2) {
	$expath = D_PATH_HOME . "templateExcel/" . $exfile . ".xls";
} else {
	$expath = D_PATH_HOME . "templateExcel/" . $exfile . ".xls";
}
$date = sprintf("%04d%02d%02d", date('Y'), date('m'), date('d'));

if ($excel_type == 2) {
	$out = "koudou_" . $date . "_" . $id . ".xls";
} else {
	$out = "koudou_" . $date . "_" . $id . ".xls";
}
$out2 = "koudou_" . $date . "_" . $id;

//$reviser->reviseFile($expath, $out);
$savepath = D_PATH_HOME . "excel/";
$reviser->reviseFile($expath, $out, $savepath);
echo $out2;
exit();

function getIQLevel($score)
{
	if ($score < 35) {
		$lv = "1";
	} elseif (35 <= $score && $score < 45) {
		$lv = "2";
	} elseif (45 <= $score && $score < 55) {
		$lv = "3";
	} elseif (55 <= $score && $score < 65) {
		$lv = "4";
	} else {
		$lv = "5";
	}
	return $lv;
}


exit();
