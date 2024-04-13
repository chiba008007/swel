<?PHP
include_once("pdf5_comment.php");
$w1  = md5($elem['e_feel']);
$w2  = md5($elem['e_cus']);
$w3  = md5($elem['e_aff']);
$w4  = md5($elem['e_cntl']);
$w5  = md5($elem['e_vi']);
$w6  = md5($elem['e_pos']);
$w7  = md5($elem['e_symp']);
$w8  = md5($elem['e_situ']);
$w9  = md5($elem['e_hosp']);
$w10 = md5($elem['e_lead']);
$w11 = md5($elem['e_ass']);
$w12 = md5($elem['e_adap']);

if ($elem['e_feel']) {
	$msg1 = $elem['e_feel'];
	$gmsg1 = $elem['e_feel'];
} else {
	$msg1 = "自己感情モニタリング力";
	$gmsg1 = "自己感情\nモニタリング力";
}
if ($elem['e_cus']) {
	$msg2 = $elem['e_cus'];
	$gmsg2 = $elem['e_cus'];
} else {
	$msg2 = "客観的自己評価力";
	$gmsg2 = "客観的\n自己評価力";
}

if ($elem['e_aff']) {
	$msg3 = $elem['e_aff'];
	$gmsg3 = $elem['e_aff'];
} else {
	$msg3 = "自己肯定力";
	$gmsg3 = "自己肯定力";
}
if ($elem['e_cntl']) {
	$msg4 = $elem['e_cntl'];
	$gmsg4 = $elem['e_cntl'];
} else {
	$msg4 = "コントロール＆アチーブメント力";
	$gmsg4 = "コントロール＆アチ\nーブメント力";
}
if ($elem['e_vi']) {
	$msg5 = $elem['e_vi'];
	$gmsg5 = $elem['e_vi'];
} else {
	$msg5 = "ビジョン創出力";
	$gmsg5 = "ビジョン\n創出力";
}
if ($elem['e_pos']) {
	$msg6 = $elem['e_pos'];
	$gmsg6 = $elem['e_pos'];
} else {
	$msg6 = "ポジティブ思考力";
	$gmsg6 = "ポジティブ\n思考力";
}

if ($elem['e_symp']) {
	$msg7 = $elem['e_symp'];
	$gmsg7 = $elem['e_symp'];
} else {
	$msg7 = "対人共感力";
	$gmsg7 = "対人共感力";
}
if ($elem['e_situ']) {
	$msg8 = $elem['e_situ'];
	$gmsg8 = $elem['e_situ'];
} else {
	$msg8 = "状況察知力";
	$gmsg8 = "状況察知力";
}
if ($elem['e_hosp']) {
	$msg9 = $elem['e_hosp'];
	$gmsg9 = $elem['e_hosp'];
} else {
	$msg9 = "ホスピタリティ発揮力";
	$gmsg9 = "ホスピタリティ\n発揮力";
}
if ($elem['e_lead']) {
	$msg10 = $elem['e_lead'];
	$gmsg10 = $elem['e_lead'];
} else {
	$msg10 = "リーダーシップ発揮力";
	$gmsg10 = "リーダーシップ\n発揮力";
}
if ($elem['e_ass']) {
	$msg11 = $elem['e_ass'];
	$gmsg11 = $elem['e_ass'];
} else {
	$msg11 = "アサーション発揮力";
	$gmsg11 = "アサーション\n発揮力";
}
if ($elem['e_adap']) {
	$msg12 = $elem['e_adap'];
	$gmsg12 = $elem['e_adap'];
} else {
	$msg12 = "集団適応力";
	$gmsg12 = "集団適応力";
}


//pdf用質問タイトル
$a_questions = array(
	"dev1" => $msg1, "dev2" => $msg2, "dev3" => $msg3, "dev4" => $msg4, "dev5" => $msg5, "dev6" => $msg6, "dev7" => $msg7, "dev8" => $msg8, "dev9" => $msg9, "dev10" => $msg10, "dev11" => $msg11, "dev12" => $msg12

);

$gimg1 = "./images/pdf/graf" . $id . ".png";
$gimg2 = "./images/pdf/graf2" . $id . ".png";


$dev1scr  = round($testdata['type']['dev1'] / 10, 1) - 2 - 0.18;
$dev2scr  = round($testdata['type']['dev2'] / 10, 1) - 2 - 0.18;
$dev3scr  = round($testdata['type']['dev3'] / 10, 1) - 2 - 0.18;
$dev4scr  = round($testdata['type']['dev4'] / 10, 1) - 2 - 0.18;
$dev5scr  = round($testdata['type']['dev5'] / 10, 1) - 2 - 0.18;
$dev6scr  = round($testdata['type']['dev6'] / 10, 1) - 2 - 0.18;
$dev7scr  = round($testdata['type']['dev7'] / 10, 1) - 2 - 0.18;
$dev8scr  = round($testdata['type']['dev8'] / 10, 1) - 2 - 0.18;
$dev9scr  = round($testdata['type']['dev9'] / 10, 1) - 2 - 0.18;
$dev10scr = round($testdata['type']['dev10'] / 10, 1) - 2 - 0.18;
$dev11scr = round($testdata['type']['dev11'] / 10, 1) - 2 - 0.18;
$dev12scr = round($testdata['type']['dev12'] / 10, 1) - 2 - 0.18;

$kodo_array = array(
	$dev1scr, $dev2scr, $dev3scr, $dev4scr, $dev5scr, $dev6scr, $dev7scr, $dev8scr, $dev9scr, $dev10scr, $dev11scr, $dev12scr
);

$pdf->setSourceFile('./pdfTemplates/temp_pdf5.pdf');
$pdf->useTemplate($pdf->importPage(1));

$logo = "./img/pdflogo/pl_" . $user[0]['login_id'] . ".jpg";


$pdf->SetXY(28, 30);
if (file_exists($logo)) {
	$pdf->Image($logo, 10, 5, 0, 15);
} else {
	$pdf->Image("./images/welcome.jpg", 5, 5, 0, 15);
}

// レーダーチャートの作成

//include("./lib/jpgraph4/src/jpgraph_radar.php");
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

$file1 = "./images/pdf/temp_" . $id . ".png";
$file2 = "./images/en01.gif";

// And output the graph
$graph->Stroke($file1);

$img1 = new Imagick($file1);
$img1->thumbnailImage(500, 500); //作成する画像のサイズを指定
//$img2 = new Imagick($file2);
$img1->setBackgroundColor(new ImagickPixel('transparent')); //透過処理を有効にする
//$img2->thumbnailImage(400, 400); //画像1と高さを合わせてリサイズ
//$img1->compositeImage($img2, $img2->getImageCompose(), 80, 37); //画像を重ねる
$img1->writeImage($file1); //画像をファイルに保存

$img1->clear();
$img1->destroy();
//$img2->clear();
//$img2->destroy();

// $img = imagecreatetruecolor('200', '150');
// $org_img = imagecreatefromjpeg("https://s-wel.com/images/pdf/temp_1394.png");

// $imagick = new Imagick(realpath($file1));
// $imagick->cropImage(100, 100, 50, 50);

// $ims = getimagesize($file1);
// imagecopy($img, $org_img, 0, 0, 20, 20, 200, 150);
// imagepng($img, $file1, 90);
// imagedestroy($img);


$image1 = new Imagick(); //黒の土台となる画像
$image2 = new Imagick($file1); //加工したい予め用意してある画像
//$image2->setResourceLimit(6, 1);

// $width = $image2->getImageWidth();
// $height = $image2->getImageHeight();

$image1->newImage(
	380,
	380,
	new ImagickPixel('black')
); //用意してある画像と同じサイズの黒背景の画像を作成
$image2->cropImage(380, 380, 70, 60); //切り取りたいサイズに変更
$image1->compositeImage($image2, imagick::COMPOSITE_DEFAULT, 0, 0); //画像を重ねる
$image1->writeImage($file1); //画像に名前をつけて格納



$pdf->Image(
	$file1,
	53,
	95.5,
	90
);

$pdf->Image(
	$file2,
	46.5,
	90.5,
	100
);


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

$age = getAgeCalc5($testdata['birth'], $testdata['exam_dates']);
$pdf->SetXY(190.5, 28.5);
$pdf->Write(0, $age);

$str5 = "
行動価値検査は、日々行動する中で「あなたがどのような行動を重視しているのか」について測定しており、能力を測定する検査ではありません。
この検査は12の特性から構成されており、12の特性は、「自己認知力：自己を適切に認識する力」「自己安定力：自分をコントロールする力」「対人認知力：他者の立場や感情を適切に認識する力」「対人影響力：他者を巻き込み、組織で目標を達成する力」の4つの領域に分かれています。
12の特性はスコア（偏差値）で表わされています。スコアが高い場合には、日常の行動において、その特性を重視して行動していることを表しています。各特性のスコアは下記の結果をご覧ください。
";
$pdf->SetXY(10.3, 36.0);
$pdf->MultiCell(190, 4, $str5, 0, "L");


function getAgeCalc5($birth, $regdate)
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

$pdf->SetFontSize(7);
//自己感情モニタリング力
$pdf->SetXY(10.5, 70);
$pdf->Write(0, $msg1);
$dev1 = sprintf("%2.1f", $testdata['type']['dev1']);
$pdf->SetXY(48.5, 70);
$pdf->Write(0, $dev1);

//客観的自己評価力
$pdf->SetXY(10.5, 75);
$pdf->Write(0, $msg2);
$dev2 = sprintf("%2.1f", $testdata['type']['dev2']);
$pdf->SetXY(48.5, 75);
$pdf->Write(0, $dev2);

//自己肯定力
$pdf->SetXY(10.5, 80);
$pdf->Write(0, $msg3);
$dev3 = sprintf("%2.1f", $testdata['type']['dev3']);
$pdf->SetXY(48.5, 80);
$pdf->Write(0, $dev3);

//コントロール＆アチーブメント力
$pdf->SetXY(56.5, 70);
$pdf->Write(0, $msg4);
$dev4 = sprintf("%2.1f", $testdata['type']['dev4']);
$pdf->SetXY(95.5, 70);
$pdf->Write(0, $dev4);

//ビジョン創出力
$pdf->SetXY(56.5, 75);
$pdf->Write(0, $msg5);
$dev5 = sprintf("%2.1f", $testdata['type']['dev5']);
$pdf->SetXY(95.5, 75);
$pdf->Write(0, $dev5);

//ビジョン創出力
$pdf->SetXY(56.5, 80);
$pdf->Write(0, $msg6);
$dev6 = sprintf("%2.1f", $testdata['type']['dev6']);
$pdf->SetXY(95.5, 80);
$pdf->Write(0, $dev6);


//対人共感力
$pdf->SetXY(104, 70);
$pdf->Write(0, $msg7);
$dev7 = sprintf("%2.1f", $testdata['type']['dev7']);
$pdf->SetXY(142.5, 70);
$pdf->Write(0, $dev7);

//状況察知力
$pdf->SetXY(104, 75);
$pdf->Write(0, $msg8);
$dev8 = sprintf("%2.1f", $testdata['type']['dev8']);
$pdf->SetXY(142.5, 75);
$pdf->Write(0, $dev8);

//ホスピタリティ発揮力
$pdf->SetXY(104, 80);
$pdf->Write(0, $msg9);
$dev9 = sprintf("%2.1f", $testdata['type']['dev9']);
$pdf->SetXY(142.5, 80);
$pdf->Write(0, $dev9);


//リーダーシップ発揮力
$pdf->SetXY(151, 70);
$pdf->Write(0, $msg10);
$dev10 = sprintf("%2.1f", $testdata['type']['dev10']);
$pdf->SetXY(189.5, 70);
$pdf->Write(0, $dev10);

//アサーション発揮力
$pdf->SetXY(151, 75);
$pdf->Write(0, $msg11);
$dev11 = sprintf("%2.1f", $testdata['type']['dev11']);
$pdf->SetXY(189.5, 75);
$pdf->Write(0, $dev11);

//集団適応力
$pdf->SetXY(151, 80);
$pdf->Write(0, $msg12);
$dev12 = sprintf("%2.1f", $testdata['type']['dev12']);
$pdf->SetXY(189.5, 80);
$pdf->Write(0, $dev12);


//$pdf->Image($file2, 53, 90.5, 100);

$pdf->SetDrawColor(204, 204, 204);
$pdf->SetFontSize(10);
$pdf->Rect(17, 90, 25, 8, 'D');
$pdf->Rect(18, 91, 23, 6, 'D');
$pdf->Text(20, 92, "対人影響力");

$pdf->Rect(165, 90, 25, 8, 'D');
$pdf->Rect(166, 91, 23, 6, 'D');
$pdf->Text(168, 92, "自己認知力");

$pdf->Rect(17, 188, 25, 8, 'D');
$pdf->Rect(18, 189, 23, 6, 'D');
$pdf->Text(20, 190, "対人認知力");

$pdf->Rect(165, 188, 25, 8, 'D');
$pdf->Rect(166, 189, 23, 6, 'D');
$pdf->Text(168, 190, "自己安定力");


$pdf->SetFontSize(8);

function conv($string, $point = 0)
{
	if (!$point)  return $string;
	$ary = mb_str_split($string, $point);
	$str = "";
	foreach ($ary as $key => $value) {
		$n = "";
		if ($key == 0) $n = "\n";
		$str .= $value . $n;
	}
	return $str;
}

//自己感情モニタリング力
$pdf->SetXY(88.0, 90.0);
$pdf->MultiCell(30, 4, conv($gmsg1, 4), 0, "L");

$pdf->SetXY(117.0, 99.0);
$pdf->MultiCell(30, 4, conv($gmsg2, 3), 0, "L");

$pdf->SetXY(134.0, 117.0);
$pdf->MultiCell(30, 4, conv($gmsg3), 0, "L");

$pdf->SetXY(140.0, 138.0);
$pdf->MultiCell(30, 4, conv($gmsg4, 7), 0, "L");

$pdf->SetXY(134.0, 161.0);
$pdf->MultiCell(30, 4, conv($gmsg5, 4), 0, "L");

$pdf->SetXY(117.0, 180.0);
$pdf->MultiCell(30, 4, conv($gmsg6, 5), 0, "L");

$pdf->SetXY(88.0, 185.0);
$pdf->MultiCell(30, 4, conv($gmsg7), 0, "L");

$pdf->SetXY(66.0, 180.0);
$pdf->MultiCell(30, 4, conv($gmsg8), 0, "L");

$pdf->SetXY(36.0, 161.0);
$pdf->MultiCell(30, 4, conv($gmsg9, 7), 0, "L");

$pdf->SetXY(33.0, 140.0);
$pdf->MultiCell(30, 4, conv($gmsg10, 7), 0, "L");

$pdf->SetXY(40.0, 117.0);
$pdf->MultiCell(30, 4, conv($gmsg11, 6), 0, "L");

$pdf->SetXY(56.0, 103.0);
$pdf->MultiCell(30, 4, $gmsg12, 0, "L");
//$name = mb_convert_encoding($name, "SJIS-WIN", "auto");
$pdf->SetXY(14.5, 200.0);
$pdf->Write("5",  $name."さんの強み");

//質問用表示箇所データ取得
$devlist = array(
	"dev1" => $testdata['type']['dev1'], "dev2" => $testdata['type']['dev2'], "dev3" => $testdata['type']['dev3'], "dev4" => $testdata['type']['dev4'], "dev5" => $testdata['type']['dev5'], "dev6" => $testdata['type']['dev6'], "dev7" => $testdata['type']['dev7'], "dev8" => $testdata['type']['dev8'], "dev9" => $testdata['type']['dev9'], "dev10" => $testdata['type']['dev10'], "dev11" => $testdata['type']['dev11'], "dev12" => $testdata['type']['dev12']
);

asort($devlist);
//５０以下の配列の値の上位2つを取得
$i = 0;
foreach ($devlist as $key => $val) {
	$quesans[$key] = $val;
}
//上位2つを取得
arsort($devlist);

$i = 0;
foreach ($quesans as $key => $val) {
	//$devlist_w[$i][ $key ] = $val;
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
	if ($i == 1) break;
	$i++;
}
unset($quesans);
$quesans = $quesanslist;
$i = 0;
foreach ($devlist as $key => $val) {
	if ($i >= 2) break;
	$strongPoint[$key] = $val;
	$i++;
}

$first_key = key($strongPoint);
$last_key = array_key_last($strongPoint);
$firstTitle = $a_questions[$first_key];
$firstText = $array_pdf_strongPoint[$first_key];
$lastTitle = $a_questions[$last_key];
$lastText = $array_pdf_strongPoint[$last_key];
// var_dump($lastTitle);
// var_dump($lastText);
// exit();
$pdf->SetXY(11, 225);
$pdf->MultiCell(46, 4, $firstTitle, 0, 'L');
$pdf->SetXY(57.5, 211);
$pdf->MultiCell(136, 4, $firstText, 0, 'L');

$pdf->SetXY(11, 260);
$pdf->MultiCell(46, 4, $lastTitle, 0, 'L');
$pdf->SetXY(57.5, 244.5);
$pdf->MultiCell(136, 4, $lastText, 0, 'L');
