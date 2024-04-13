<?PHP

//----------------------------------------------
//　棒グラフ
//----------------------------------------------
$img1_bar = "./images/pdf/score_bar_" . $id . ".jpg";
createBarImagePDF2($testdata['score'], $img1_bar);
$img2_bar = "./images/pdf/stress_bar_" . $id . ".jpg";
createBarImagePDF2($st_score, $img2_bar);

function createBarImagePDF2($st_score, $img1_bar)
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

	$im        = imagecreatetruecolor($wid, 10);
	$img_color = imagecolorallocate($im, 1, 101, 255);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im, 0, 0, $gray);
	imagefilledrectangle($im, 1, 1, $wid - 2, 8, $img_color);

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

//include ("./lib/jpgraph4/src/jpgraph_radar.php");
// 表のサイズ
$graph = new RadarGraph(600, 500, "auto");
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
$graph->axis->SetColor("#000000"); // 軸の色

// 中心から放射状に伸びる線の太さ
$graph->axis->SetWeight(3);

// ラインの設定
$graph->grid->SetLineStyle("solid");
$graph->grid->SetColor("black");
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

$file1 = "./images/pdf/temp_" . $id . ".png";
$file2 = "./images/en01.gif";

// And output the graph
$graph->Stroke($file1);

$img1 = new Imagick($file1);
$img1->thumbnailImage(600, 500); //作成する画像のサイズを指定
$img2 = new Imagick($file2);
$img2->setBackgroundColor(new ImagickPixel('transparent')); //透過処理を有効にする
$img2->thumbnailImage(450, 450); //画像1と高さを合わせてリサイズ
$img1->compositeImage($img2, $img2->getImageCompose(), 80, 27); //画像を重ねる
$img1->writeImage($gimg1); //画像をファイルに保存

$img1->clear();
$img1->destroy();
$img2->clear();
$img2->destroy();



$pdf->setSourceFile('./pdfTemplates/temp_pdf2.pdf');
$pdf->useTemplate($pdf->importPage(1));

$logo = "./img/pdflogo/pl_" . $user[0]['login_id'] . ".jpg";


$pdf->SetXY(28, 30);
if (file_exists($logo)) {
	$pdf->Image($logo, 10, 5, 50, 18);
} else {
	$pdf->Image("./images/welcome.jpg", 10, 5, 50, 25);
}

$pdf->SetFontSize(12);
$pdf->SetXY(28, 28);
$pdf->Write(0, $testdata['cusname']);

$pdf->SetFontSize(8);
$pdf->SetXY(32, 35.5);
$temp = explode(" ", $testdata['exam_dates']);
$temp = explode("-", $temp[0]);
$exam = $temp[0] . "/" . $temp[1] . "/" . $temp[2];
$pdf->Write(0, $exam);

$pdf->SetXY(73, 35.5);
$pdf->Write(0, $testdata['exam_id']);

$pdf->SetXY(112, 35.5);
$pdf->Write(0, $testdata['name']);

$age = getAgeCalcPDF2($testdata['birth'], $testdata['exam_dates']);

function getAgeCalcPDF2($birth, $regdate)
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

$pdf->SetXY(190, 35.5);
$pdf->Write(0, $age);

$pdf->SetXY(10, 52);
$pdf->Write(0, "行動価値適合度");
$pdf->SetXY(33, 52);
$pdf->Write(0, sprintf("%.1f", $testdata['score']));
$pdf->SetXY(45.5, 52);
$pdf->Write(0, $testdata['level']);
if ($testdata['score'] != 20) {
	$pdf->Image($img1_bar, 52, 52);
}

$pdf->SetXY(10, 58.5);
$pdf->Write(0, "ストレス共生力");
$pdf->SetXY(33, 58.5);
$pdf->Write(0, sprintf("%.1f", $st_score));
$pdf->SetXY(45.5, 58.5);
$pdf->Write(0, $st_level);
$pdf->Image($img2_bar, 52, 58.5);


$pdf->SetXY(10.5, 77);
$pdf->Write(0, $elem['e_feel']);
$pdf->SetXY(48.5, 77);
$pdf->Write(0, round($testdata['type']['dev1'], 1));

$pdf->SetXY(10.5, 82);
$pdf->Write(0, $elem['e_cus']);
$pdf->SetXY(48.5, 82);
$pdf->Write(0, round($testdata['type']['dev2'], 1));

$pdf->SetXY(10.5, 87);
$pdf->Write(0, $elem['e_aff']);
$pdf->SetXY(48.5, 87);
$pdf->Write(0, round($testdata['type']['dev3'], 1));

$pdf->SetXY(56, 77);
$pdf->Write(0, $elem['e_cntl']);
$pdf->SetXY(101, 77);
$pdf->Write(0, round($testdata['type']['dev4'], 1));

$pdf->SetXY(56, 82);
$pdf->Write(0, $elem['e_vi']);
$pdf->SetXY(101, 82);
$pdf->Write(0, round($testdata['type']['dev5'], 1));

$pdf->SetXY(56, 87);
$pdf->Write(0, $elem['e_pos']);
$pdf->SetXY(101, 87);
$pdf->Write(0, round($testdata['type']['dev6'], 1));



$pdf->SetXY(109, 77);
$pdf->Write(0, $elem['e_symp']);
$pdf->SetXY(147.5, 77);
$pdf->Write(0, round($testdata['type']['dev7'], 1));

$pdf->SetXY(109, 82);
$pdf->Write(0, $elem['e_situ']);
$pdf->SetXY(147.5, 82);
$pdf->Write(0, round($testdata['type']['dev8'], 1));

$pdf->SetXY(109, 87);
$pdf->Write(0, $elem['e_hosp']);
$pdf->SetXY(147.5, 87);
$pdf->Write(0, round($testdata['type']['dev9'], 1));




$pdf->SetXY(156, 77);
$pdf->Write(0, $elem['e_lead']);
$pdf->SetXY(194, 77);
$pdf->Write(0, round($testdata['type']['dev10'], 1));

$pdf->SetXY(156, 82);
$pdf->Write(0, $elem['e_ass']);
$pdf->SetXY(194, 82);
$pdf->Write(0, round($testdata['type']['dev11'], 1));

$pdf->SetXY(156, 87);
$pdf->Write(0, $elem['e_adap']);
$pdf->SetXY(194, 87);
$pdf->Write(0, round($testdata['type']['dev12'], 1));

// グラフ画像
$pdf->Image($gimg1, 35, 95, 136);

$pdf->SetXY(83, 98);

/*
	if($testweight[0][ 'w1' ] != 0){
		$pdf->Cell(50,8,andReplacePDF2($elem[ 'e_feel' ]),0,0,'C',false);
	}else{
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		//$pdf->Cell(横幅,縦幅,テキスト,境界線,0,位置,塗りつぶし);
		$pdf->Cell(50,8,andReplacePDF2($elem[ 'e_feel' ]),1,0,'C',true);
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
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_feel']), $border, 0, $pos, $fill);

$border = 0;
$fill = false;
$pos = "L";
if ($testweight[0]['w2'] != 0) {
	$border = 1;
	$fill = true;
	$pos = "L";
}
$w = mb_strlen($elem['e_cus']) * 4;
$pdf->SetXY(125, 109);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_cus']), $border, 0, $pos, $fill);


$border = 0;
$fill = false;
$pos = "L";
if ($testweight[0]['w3'] != 0) {
	$border = 1;
	$fill = true;
	$pos = "L";
}
$w = mb_strlen($elem['e_aff']) * 4;
$pdf->SetXY(143, 126);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_aff']), $border, 0, $pos, $fill);


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
$pdf->SetXY(148, 147);
$pdf->Cell($w, 10, "", $border, 0, $pos, $fill);
$string = andReplacePDF2($elem['e_cntl'], true);
foreach ($string as $k => $val) {
	$pdf->Text(148, 148 + 4 * $k, andReplacePDF2($val));
}




$border = 0;
$fill = false;
$pos = "L";
if ($testweight[0]['w5'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$pdf->SetXY(143, 171);
$w = mb_strlen($elem['e_vi']) * 4;
if ($w > 40) $w = 40;
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_vi']), $border, 0, $pos, $fill);



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
$pdf->SetXY(127, 189);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_pos']), $border, 0, $pos, $fill);



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
$pdf->SetXY(93, 195);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_symp']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w8'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_situ']) * 4;
$pdf->SetXY(55, 187);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_situ']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w9'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_hosp']) * 4;
$pdf->SetXY(30, 171);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_hosp']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w10'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_lead']) * 4;
$pdf->SetXY(25, 150);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_lead']), $border, 0, $pos, $fill);



$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w11'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_ass']) * 4;
$pdf->SetXY(35, 126);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_ass']), $border, 0, $pos, $fill);


$border = 0;
$fill = false;
$pos = "R";
if ($testweight[0]['w12'] != 0) {
	$border = 1;
	$fill = 1;
	$pos = "C";
}
$w = mb_strlen($elem['e_adap']) * 4;
$pdf->SetXY(62, 111);
$pdf->Cell($w, $ht, andReplacePDF2($elem['e_adap']), $border, 0, $pos, $fill);


function andReplacePDF2($str, $array = false)
{
	$str = str_replace("＆", "&", $str);
	if ($array == true) {
		$str = explode("&", $str);
	} else {

		$str = str_replace("&", "&\n", $str);
	}
	return $str;
}

$pdf->Image("./pdfTemplates/waku.png", 18, 100, 30);
$pdf->Image("./pdfTemplates/waku.png", 160, 100, 30);
$pdf->Image("./pdfTemplates/waku.png", 18, 180, 30);
$pdf->Image("./pdfTemplates/waku.png", 160, 180, 30);
$pdf->SetFontSize(11);
$pdf->SetXY(22, 102);
$pdf->Write(0, "対人影響力");
$pdf->SetXY(22, 182);
$pdf->Write(0, "対人認知力");
$pdf->SetXY(164, 102);
$pdf->Write(0, "自己認知力");
$pdf->SetXY(164, 182);
$pdf->Write(0, "自己安定力");

$pdf->SetFontSize(8);
$pdf->SetXY(140, 198);
$pdf->Cell(60, 8, '御社が重視している行動価値', '1', '1', 'C', false, '', '');
$pdf->SetXY(143, 200);
$pdf->SetFillColor(224, 255, 255);
$pdf->Cell(6, 2, ' ', '0', '0', 'C', true, '', '');


$pdf->SetXY(13, 211);
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

$pdf->MultiCell(45, 40, $a_questions[$keys[0]], "1", "C", false, 0, 10, 234, true, 0, true, 'M');
$pdf->MultiCell(38, 40, $array_pdf_question[$keys[0]][0], "1", "L", false, 0, 55, 221, true, 0, true, 'M');
$pdf->MultiCell(52, 40, $array_pdf_question[$keys[0]][1], "1", "L", false, 0, 91, 221, true, 0, true, 'M');
$pdf->MultiCell(56, 40, $array_pdf_question[$keys[0]][2], "1", "L", false, 0, 145, 221, true, 0, true, 'M');

$pdf->MultiCell(45, 0, $a_questions[$keys[1]], "1", "C", false, 0, 10, 266, true, 0, true, 'M');
$pdf->MultiCell(38, 0, $array_pdf_question[$keys[1]][0], "0", "L", false, 0, 55, 253, true, 0, true, 'M');
$pdf->MultiCell(52, 0, $array_pdf_question[$keys[1]][1], "0", "L", false, 0, 91, 253, true, 0, true, 'M');
$pdf->MultiCell(56, 0, $array_pdf_question[$keys[1]][2], "0", "L", false, 0, 145, 253, true, 0, true, 'M');
