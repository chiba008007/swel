<?PHP

//----------------------------------------------
//　棒グラフ
//----------------------------------------------
$img1_bar = "./images/pdf/score_bar_" . $id . ".jpg";
createBarImage($testdata['score'], $img1_bar);
$img2_bar = "./images/pdf/stress_bar_" . $id . ".jpg";
createBarImage($st_score, $img2_bar);

function createBarImage($st_score, $img1_bar)
{
	define("ST", 20);
	define("DIFF", 37);
	// 調整の値
	$adjust = 0;
	if ($st_score >= 80) {
		$adjust = 30;
	} else
		if ($st_score >= 70) {
		$adjust = 24;
	} else
		if ($st_score >= 60) {
		$adjust = 18;
	} else
		if ($st_score >= 50) {
		$adjust = 10;
	} else
		if ($st_score >= 40) {
		$adjust = 5;
	}
	$counts = ($st_score - ST) / 5;
	$wid = DIFF * $counts - $adjust;
	if ($wid == 0) $wid = 1;

	$im        = imagecreatetruecolor($wid, 6);
	$img_color = imagecolorallocate($im, 1, 101, 255);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im, 0, 0, $gray);
	imagefilledrectangle($im, 1, 1, $wid - 2, 6, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img1_bar);
	imagedestroy($im);
}

//----------------------------------------------
//棒グラフ終わり
//----------------------------------------------
//----------------------------------------------
//レーダーチャート
//----------------------------------------------

$gimg1 = "./images/pdf/graf" . $id . ".png";

// レーダーチャートの作成

// 表のサイズ
$graph = new RadarGraph(400, 400, "auto");
$graph->img->SetAntiAliasing();
$graph->SetFrame(false);


// バックカラー
$graph->SetColor("white");
// 影
//$graph->SetShadow();

// レーダーチャートの位置
$graph->SetCenter(0.5, 0.5);
$graph->SetPos(0.51, 0.5);
// グラフの最大数設定　lin, minpos, maxpos
$graph->SetScale('lin', 20, 80);
// グラフのメモリ (刻み、?) 
$graph->yscale->ticks->Set(10, 5);

// 軸の日本語化と色設定
$graph->axis->SetFont(FF_GOTHIC);
$graph->axis->title->SetFont(FF_GOTHIC);
$graph->axis->SetColor("#666"); // 軸の色

// 中心から放射状に伸びる線の太さ
$graph->axis->SetWeight(3);

// ラインの設定
$graph->grid->SetLineStyle("solid");
$graph->grid->SetColor("gray");
$graph->grid->Show();
$graph->HideTickMarks();

// タイトル 
// $title = '結果レポート';
// $graph->title->Set($title);
// $graph->title->SetFont(FF_GOTHIC);

// タイトルと値の入れ方は反時計回りの仕様
$titles = [
	"",
	"",
	"",
	"",
	"",
	"",
	"",
	"",
	"",
	"",
	"",
	"",
	"",
];
$points = [
	$testdata['type']['dev1'],
	$testdata['type']['dev12'],
	$testdata['type']['dev11'],
	$testdata['type']['dev10'],
	$testdata['type']['dev9'],
	$testdata['type']['dev8'],
	$testdata['type']['dev7'],
	$testdata['type']['dev6'],
	$testdata['type']['dev5'],
	$testdata['type']['dev4'],
	$testdata['type']['dev3'],
	$testdata['type']['dev2'],

];

$graph->SetTitles($titles);
//$graph->SetTitles(array("One","Two","Three","Four","Five","Sex","Seven","Eight","Nine","Ten",'aa'));
// Create the first radar plot
//$plot = new RadarPlot(array(40,80,40,40,40,40,40,40,40,40,40,40));
$plot = new RadarPlot($points);
//$average = '平均値';
//$plot->SetLegend($average);
$plot->SetLineWeight(2);
//$plot->SetColor('blue', 'lightblue');

$plot->SetColor('blue@1.0');


$plot->SetFill(false);


// Create the second radar plot
//$plot2 = new RadarPlot(array(70,40,30,80,30,50,10));

//$person = '達成度';
$graph->legend->SetFont(FF_GOTHIC);
// ボックスのタイトル
//$plot2->SetLegend($person);
// 線の色、塗りつぶし色
//$plot2->SetColor("#215392","#cadc86");
//$plot2->SetFont(FF_GOTHIC, FS_NORMAL);

// 点を丸くする
$plot->mark->SetType(MARK_IMG_SBALL, 'navy');
// 描画
//$graph->Add($plot2);
$graph->Add($plot);

$file1 = "./images/pdf/temp1_" . $id . ".png";
$file2 = "./images/en01.gif";

// And output the graph
$graph->Stroke($file1);

$img1 = new Imagick($file1);
$img1->thumbnailImage(400, 400); //作成する画像のサイズを指定
//$img2 = new Imagick($file2);
$img1->setBackgroundColor(new ImagickPixel('transparent')); //透過処理を有効にする
//$img2->thumbnailImage(400, 400); //画像1と高さを合わせてリサイズ
//$img1->compositeImage($img2, $img2->getImageCompose(), 80, 37); //画像を重ねる
$img1->writeImage($file1); //画像をファイルに保存

$img1->clear();
$img1->destroy();
// $img2->clear();
// $img2->destroy();



$pdf->setSourceFile('./pdfTemplates/temp_pdf1.pdf');
$pdf->useTemplate($pdf->importPage(1));

$logo = "./img/pdflogo/pl_" . $user[0]['login_id'] . ".jpg";


$pdf->SetXY(28, 30);
if (file_exists($logo)) {
	$pdf->Image($logo, 10, 5, 0, 15);
} else {
	$pdf->Image("./images/welcome.jpg", 5, 5, 0, 15);
}

$pdf->SetFontSize(8);
$pdf->SetXY(20, 23.3);
$pdf->Write(0, $testdata['cusname']);

$pdf->SetFontSize(8);
$pdf->SetXY(30, 28.5);
$temp = explode(" ", $testdata['exam_dates']);
$temp = explode("-", $temp[0]);
$exam = $temp[0] . "/" . $temp[1] . "/" . $temp[2];
$pdf->Write(0, $exam);

$pdf->SetXY(68, 28.5);
$pdf->MultiCell(26, 4, $testdata['exam_id'], 0, "C");

$pdf->SetXY(105, 28.5);
$pdf->MultiCell(76, 4, $testdata['name'] . '(' . $testdata['kana'] . ')', 0, "C");

$age = getAgeCalc_1($testdata['birth'], $testdata['exam_dates']);
$pdf->SetXY(190.5, 28.5);
$pdf->Write(0, $age);

function getAgeCalc_1($birth, $regdate)
{
	$reg1 = explode(" ", $regdate);
	$reg = explode("-", $reg1[0]);

	$ty = $reg[0];
	$tm = $reg[1];
	$td = $reg[2];
	list($by, $bm, $bd) = explode('/', $birth);
	$age = $ty - $by;
	if ($tm * 100 + $td <= $bm * 100 + $bd) $age--;

	return $age;
}



// $pdf->SetXY(10, 52);
// $pdf->Write(0, "行動価値適合度");
// $pdf->SetXY(33, 52);
// $pdf->Write(0, sprintf("%.1f", $testdata['score']));
// $pdf->SetXY(45.5, 52);
// $pdf->Write(0, $testdata['level']);
// if ($testdata['score'] != 20) {
// 	$pdf->Image($img1_bar, 52, 52);
// }

$pdf->SetXY(10, 44.2);
$pdf->Write(0, "ストレス共生力");
$pdf->SetXY(33, 44.2);
$pdf->Write(0, sprintf("%.1f", $st_score));
$pdf->SetXY(45.5, 44.2);
$pdf->Write(0, $st_level);
$pdf->Image($img2_bar, 52, 44.8);

$pdf->SetFontSize(8);
$pdf->SetXY(10.5, 58.7);
$pdf->Write(0, $elem['e_feel']);
$pdf->SetXY(48.5, 63.5);
$pt = sprintf("%.1f", round($testdata['type']['dev1'], 1));
$pdf->Write(0, $pt);

$pdf->SetXY(10.5, 63.5);
$pdf->Write(0, $elem['e_cus']);
$pdf->SetXY(48.5, 58.7);
$pt = sprintf("%.1f", round($testdata['type']['dev2'], 1));
$pdf->Write(0, $pt);

$pdf->SetXY(10.5, 67.8);
$pdf->Write(0, $elem['e_aff']);
$pdf->SetXY(48.5, 67.8);
$pt = sprintf("%.1f", round($testdata['type']['dev3'], 1));
$pdf->Write(0, $pt);



$pdf->SetFontSize(7);
$pdf->SetXY(56.5, 58.7);
$pdf->Write(0, $elem['e_cntl']);
$pdf->SetFontSize(8);
$pdf->SetXY(96, 58.7);
$pt = sprintf("%.1f", round($testdata['type']['dev4'], 1));
$pdf->Write(0, $pt);

$pdf->SetFontSize(8);
$pdf->SetXY(56.5, 63.5);
$pdf->Write(0, $elem['e_vi']);
$pdf->SetXY(96, 63.5);
$pt = sprintf("%.1f", round($testdata['type']['dev5'], 1));
$pdf->Write(0, $pt);

$pdf->SetXY(56.5, 67.8);
$pdf->Write(0, $elem['e_pos']);
$pdf->SetXY(96, 67.8);
$pt = sprintf("%.1f", round($testdata['type']['dev6'], 1));
$pdf->Write(0, $pt);



$pdf->SetXY(105, 58.7);
$pdf->Write(0, $elem['e_symp']);
$pdf->SetXY(142.5, 58.7);
$pt = sprintf("%.1f", round($testdata['type']['dev7'], 1));
$pdf->Write(0, $pt);

$pdf->SetXY(105, 63.5);
$pdf->Write(0, $elem['e_situ']);
$pdf->SetXY(142.5, 63.5);
$pt = sprintf("%.1f", round($testdata['type']['dev8'], 1));
$pdf->Write(0, $pt);

$pdf->SetXY(105, 67.8);
$pdf->Write(0, $elem['e_hosp']);
$pdf->SetXY(142.5, 67.8);
$pt = sprintf("%.1f", round($testdata['type']['dev9'], 1));
$pdf->Write(0, $pt);




$pdf->SetXY(152, 58.7);
$pdf->Write(0, $elem['e_lead']);
$pdf->SetXY(190, 58.7);
$pt = sprintf("%.1f", round($testdata['type']['dev10'], 1));
$pdf->Write(0, $pt);

$pdf->SetXY(152, 63.5);
$pdf->Write(0, $elem['e_ass']);
$pdf->SetXY(190, 63.5);
$pt = sprintf("%.1f", round($testdata['type']['dev11'], 1));
$pdf->Write(0, $pt);

$pdf->SetXY(152, 67.8);
$pdf->Write(0, $elem['e_adap']);
$pdf->SetXY(190, 67.8);
$pt = sprintf("%.1f", round($testdata['type']['dev12'], 1));
$pdf->Write(0, $pt);

// グラフ画像
$pdf->Image($file1, 42, 73, 118);
$pdf->Image($file2, 51.5, 82, 100);

// グラフを囲む枠の作成



$pdf->SetXY(83, 78);

/*
	if($testweight[0][ 'w1' ] != 0){
		$pdf->Cell(50,8,andReplace($elem[ 'e_feel' ]),0,0,'C',false);
	}else{
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		//$pdf->Cell(横幅,縦幅,テキスト,境界線,0,位置,塗りつぶし);
		$pdf->Cell(50,8,andReplace($elem[ 'e_feel' ]),1,0,'C',true);
	}
	*/

$pdf->SetFillColor(162, 199, 255);
$pdf->SetDrawColor(128, 128, 128);
$ht = 5;
$border = 0;
$fill = false;
$pos = "C";
if ($testweight[0]['w1'] != 0) {
	$border = 1;
	$fill = true;
	$pos = "C";
}
//$pdf->Cell(横幅,縦幅,テキスト,境界線,0,位置,塗りつぶし);
$w = mb_strlen($elem['e_feel']) * 4;
$pdf->Cell($w, $ht, andReplace($elem['e_feel']), $border, 0, $pos, $fill);

$border = 0;
$fill = false;
$pos = "L";
if ($testweight[0]['w2'] != 0) {
	$border = 1;
	$fill = true;
	$pos = "L";
}
$w = mb_strlen($elem['e_cus']) * 4;
$pdf->SetXY(125, 89);
$pdf->Cell($w, $ht, andReplace($elem['e_cus']), $border, 0, $pos, $fill);


$border = 0;
$fill = false;
$pos = "L";
if ($testweight[0]['w3'] != 0) {
	$border = 1;
	$fill = true;
	$pos = "L";
}
$w = mb_strlen($elem['e_aff']) * 4;
$pdf->SetXY(143, 106);
$pdf->Cell($w, $ht, andReplace($elem['e_aff']), $border, 0, $pos, $fill);


$border = 0;
$fill = false;
$pos = "L";
if ($testweight[0]['w4'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_cntl']) * 4;
if ($w > 40) $w = 40;
$pdf->SetXY(148, 127);
$pdf->Cell($w, 10, "", $border, 0, $pos, $fill);
$string = andReplace($elem['e_cntl'], true);
foreach ($string as $k => $val) {
	$pdf->Text(148, 128 + 4 * $k, andReplace($val));
}




$border = 0;
$fill = false;
$pos = "L";
if ($testweight[0]['w5'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$pdf->SetXY(143, 151);
$w = mb_strlen($elem['e_vi']) * 4;
if ($w > 40) $w = 40;
$pdf->Cell($w, $ht, andReplace($elem['e_vi']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "L";
if ($testweight[0]['w6'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "L";
}
$w = mb_strlen($elem['e_pos']) * 4;
if ($w > 40) $w = 40;
$pdf->SetXY(127, 169);
$pdf->Cell($w, $ht, andReplace($elem['e_pos']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "C";
if ($testweight[0]['w7'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_symp']) * 4;
if ($w > 40) $w = 40;
$pdf->SetXY(93, 175);
$pdf->Cell($w, $ht, andReplace($elem['e_symp']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w8'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_situ']) * 4;
$pdf->SetXY(55, 167);
$pdf->Cell($w, $ht, andReplace($elem['e_situ']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w9'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_hosp']) * 4;
$pdf->SetXY(30, 151);
$pdf->Cell($w, $ht, andReplace($elem['e_hosp']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w10'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_lead']) * 4;
$pdf->SetXY(20, 130);
$pdf->Cell($w, $ht, andReplace($elem['e_lead']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w11'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_ass']) * 4;
$pdf->SetXY(30, 106);
$pdf->Cell($w, $ht, andReplace($elem['e_ass']), $border, 0, $pos, $fill);


$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w12'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_adap']) * 4;
$pdf->SetXY(58, 91);
$pdf->Cell($w, $ht, andReplace($elem['e_adap']), $border, 0, $pos, $fill);


function andReplace($str, $array = false)
{
	$str = str_replace("＆", "&", $str);
	if ($array == true) {
		$str = explode("&", $str);
	} else {

		$str = str_replace("&", "&\n", $str);
	}
	return $str;
}

$pdf->Image("./pdfTemplates/waku.png", 18, 80, 30);
$pdf->Image("./pdfTemplates/waku.png", 160, 80, 30);
$pdf->Image("./pdfTemplates/waku.png", 18, 160, 30);
$pdf->Image("./pdfTemplates/waku.png", 160, 160, 30);
$pdf->SetFontSize(11);
$pdf->SetXY(22, 82);
$pdf->Write(0, "対人影響力");
$pdf->SetXY(22, 162);
$pdf->Write(0, "対人認知力");
$pdf->SetXY(164, 82);
$pdf->Write(0, "自己認知力");
$pdf->SetXY(164, 162);
$pdf->Write(0, "自己安定力");

$pdf->SetFontSize(8);
$pdf->SetXY(137, 176);
$pdf->Cell(60, 8, '御社が重視している行動価値', '1', '1', 'C', false, '', '');
$pdf->SetXY(142, 178);
$pdf->SetFillColor(224, 255, 255);
$pdf->Cell(6, 2, ' ', '0', '0', 'C', true, '', '');

$pdf->SetXY(10, 75);

$pdf->Cell(188.5, 110, ' ', 1, '0', 'C', false, '', '');


$pdf->SetXY(13, 187);
$pdf->Write(0, $testdata['name'] . "さんへの質問例");

$devlist = array(
	"dev1" => $testdata['type']['dev1'], "dev2" => $testdata['type']['dev2'], "dev3" => $testdata['type']['dev3'], "dev4" => $testdata['type']['dev4'], "dev5" => $testdata['type']['dev5'], "dev6" => $testdata['type']['dev6'], "dev7" => $testdata['type']['dev7'], "dev8" => $testdata['type']['dev8'], "dev9" => $testdata['type']['dev9'], "dev10" => $testdata['type']['dev10'], "dev11" => $testdata['type']['dev11'], "dev12" => $testdata['type']['dev12']

);
asort($devlist);
$i = 0;
foreach ($devlist as $key => $val) {
	$quesans[$key] = $val;
}

$i = 0;
foreach ($quesans as $key => $val) {
	$k = preg_replace("/dev/", "w", $key);
	if ($testweight[0][$k] > 0) {
		$ary_weight[$key] = 1;
	} else {
		$ary_weight[$key] = 0;
	}
	$i++;
}
array_multisort($ary_weight, SORT_DESC, $quesans);
$i = 0;
foreach ($quesans as $k => $v) {
	$quesanslist[$k] = $v;
	if ($i == 1) {
		break;
	}
	$i++;
}
unset($quesans);
$quesans = $quesanslist;

$i = 0;
foreach ($devlist as $key => $val) {
	if ($i >= 2) {
		break;
	}
	$strongPoint[$key] = $val;
	$i++;
}

$a_questions = array(
	"dev1" => $elem['e_feel'], "dev2" => $elem['e_cus'], "dev3" => $elem['e_aff'], "dev4" => $elem['e_cntl'], "dev5" => $elem['e_vi'], "dev6" => $elem['e_pos'], "dev7" => $elem['e_symp'], "dev8" => $elem['e_situ'], "dev9" => $elem['e_hosp'], "dev10" => $elem['e_lead'], "dev11" => $elem['e_ass'], "dev12" => $elem['e_adap']
);
$keys = [];
foreach ($quesans as $k => $val) {
	$keys[] = $k;
}

$pdf->MultiCell(45, 40, $a_questions[$keys[0]], 0, "C", false, 0, 10, 211, true, 0, true, 'M');
$pdf->MultiCell(38, 35, $array_pdf_question[$keys[0]][0], 0, "L", false, 0, 58, 198, true, 0, true, 'M');
$pdf->MultiCell(45, 40, $array_pdf_question[$keys[0]][1], 0, "L", false, 0, 95, 198, true, 0, true, 'M');
$pdf->MultiCell(56, 40, $array_pdf_question[$keys[0]][2], 0, "L", false, 0, 142, 198, true, 0, true, 'M');

$pdf->MultiCell(45, 0, $a_questions[$keys[1]], 0, "C", false, 0, 10, 254, true, 0, true, 'M');
$pdf->MultiCell(38, 0, $array_pdf_question[$keys[1]][0], "0", "L", false, 0, 58, 235, true, 0, true, 'M');
$pdf->MultiCell(45, 0, $array_pdf_question[$keys[1]][1], "0", "L", false, 0, 95, 235, true, 0, true, 'M');
$pdf->MultiCell(56, 0, $array_pdf_question[$keys[1]][2], "0", "L", false, 0, 142, 235, true, 0, true, 'M');
