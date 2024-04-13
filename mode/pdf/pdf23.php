<?PHP
$name = mb_convert_encoding($math[0][ 'name' ],"sjis-win","utf-8");
//----------------------------------------------
//棒グラフ画像作成
//----------------------------------------------
$sogo_yoso = sprintf("%0.1f",round($math[0][ 'sogo_score' ],1));
$img1 = "./images/pdf/img_bms_".$id.".jpg";
$st_score2 = substr($sogo_yoso, 1, 4) * 9.2;
if($sogo_yoso >= 80){
	$wid = 552;
}elseif($sogo_yoso >= 70){
	$wid = $st_score2 + 461.3;
}elseif($sogo_yoso >= 60){
	$wid = $st_score2 + 370.8;
}elseif($sogo_yoso >= 50){
	$wid = $st_score2 + 279.75;
}elseif($sogo_yoso >= 40){
	$wid = $st_score2 + 188.8;
}elseif($sogo_yoso >= 30){
	$wid = $st_score2 + 94.8;
}elseif($sogo_yoso >= 20){
	$wid = $st_score2 + 1;
}else{
	$wid = 1;
}

$sogolv = getLevel($sogo_yoso);

$im        = imagecreatetruecolor($wid, 10);
$img_color = imagecolorallocate($im, 1, 101, 255);
$gray      = imagecolorallocate($im, 169, 169, 169);

imagefill($im , 0 , 0 , $gray);
imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

$text_color = imagecolorallocate($im, 255, 0, 0);
imagestring($im, 1, 5, 5,  "", $text_color);
imagejpeg($im, $img1);
imagedestroy($im);


$haku_yoso = sprintf("%0.1f",round($math[0][ 'haku_hensa' ],1),1);
$img2 = "./images/pdf/img2_".$id.".jpg";
$st_score2 = substr($haku_yoso, 1, 4) * 9.2;
if($haku_yoso >= 80){
	$wid = 552;
}elseif($haku_yoso >= 70){
	$wid = $st_score2 + 461.3;
}elseif($haku_yoso >= 60){
	$wid = $st_score2 + 370.8;
}elseif($haku_yoso >= 50){
	$wid = $st_score2 + 279.75;
}elseif($haku_yoso >= 40){
	$wid = $st_score2 + 188.8;
}elseif($haku_yoso >= 30){
	$wid = $st_score2 + 94.8;
}elseif($haku_yoso >= 20){
	$wid = $st_score2 + 1;
}else{
	$wid = 1;
}
$hakulv = getLevel($haku_yoso);

$im        = imagecreatetruecolor($wid, 10);
$img_color = imagecolorallocate($im, 1, 101, 255);
$gray      = imagecolorallocate($im, 169, 169, 169);

imagefill($im , 0 , 0 , $gray);
imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

$text_color = imagecolorallocate($im, 255, 0, 0);
imagestring($im, 1, 5, 5,  "", $text_color);
imagejpeg($im, $img2);
imagedestroy($im);


$bunseki_hensa = sprintf("%0.1f",round($math[0][ 'bunseki_hensa' ],1));
$img3 = "./images/pdf/img3_".$id.".jpg";
$st_score2 = substr($bunseki_hensa, 1, 4) * 9.2;
if($bunseki_hensa >= 80){
	$wid = 552;
}elseif($bunseki_hensa >= 70){
	$wid = $st_score2 + 461.3;
}elseif($bunseki_hensa >= 60){
	$wid = $st_score2 + 370.8;
}elseif($bunseki_hensa >= 50){
	$wid = $st_score2 + 279.75;
}elseif($bunseki_hensa >= 40){
	$wid = $st_score2 + 188.8;
}elseif($bunseki_hensa >= 30){
	$wid = $st_score2 + 94.8;
}elseif($bunseki_hensa >= 20){
	$wid = $st_score2 + 1;
}else{
	$wid = 1;
}
$bunsekilv = getLevel($bunseki_hensa);

$im        = imagecreatetruecolor($wid, 10);
$img_color = imagecolorallocate($im, 1, 101, 255);
$gray      = imagecolorallocate($im, 169, 169, 169);

imagefill($im , 0 , 0 , $gray);
imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

$text_color = imagecolorallocate($im, 255, 0, 0);
imagestring($im, 1, 5, 5,  "", $text_color);
imagejpeg($im, $img3);
imagedestroy($im);



$sentaku_hensa = sprintf("%0.1f",round($math[0][ 'sentaku_hensa' ],1),1);
$img4 = "./images/pdf/img4_".$id.".jpg";
$st_score2 = substr($sentaku_hensa, 1, 4) * 9.2;
if($sentaku_hensa >= 80){
	$wid = 552;
}elseif($sentaku_hensa >= 70){
	$wid = $st_score2 + 461.3;
}elseif($sentaku_hensa >= 60){
	$wid = $st_score2 + 370.8;
}elseif($sentaku_hensa >= 50){
	$wid = $st_score2 + 279.75;
}elseif($sentaku_hensa >= 40){
	$wid = $st_score2 + 188.8;
}elseif($sentaku_hensa >= 30){
	$wid = $st_score2 + 94.8;
}elseif($sentaku_hensa >= 20){
	$wid = $st_score2 + 1;
}else{
	$wid = 1;
}
$sentakulv = getLevel($sentaku_hensa);

$im        = imagecreatetruecolor($wid, 10);
$img_color = imagecolorallocate($im, 1, 101, 255);
$gray      = imagecolorallocate($im, 169, 169, 169);

imagefill($im , 0 , 0 , $gray);
imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

$text_color = imagecolorallocate($im, 255, 0, 0);
imagestring($im, 1, 5, 5,  "", $text_color);
imagejpeg($im, $img4);
imagedestroy($im);



$yosoku_hensa = sprintf("%0.1f",round($math[0][ 'yosoku_hensa' ],1),1);
$img5 = "./images/pdf/img5_".$id.".jpg";
$st_score2 = substr($yosoku_hensa, 1, 4) * 9.2;
if($yosoku_hensa >= 80){
	$wid = 552;
}elseif($yosoku_hensa >= 70){
	$wid = $st_score2 + 461.3;
}elseif($yosoku_hensa >= 60){
	$wid = $st_score2 + 370.8;
}elseif($yosoku_hensa >= 50){
	$wid = $st_score2 + 279.75;
}elseif($yosoku_hensa >= 40){
	$wid = $st_score2 + 188.8;
}elseif($yosoku_hensa >= 30){
	$wid = $st_score2 + 94.8;
}elseif($yosoku_hensa >= 20){
	$wid = $st_score2 + 1;
}else{
	$wid = 1;
}
$yosokulv = getLevel($yosoku_hensa);

$im        = imagecreatetruecolor($wid, 10);
$img_color = imagecolorallocate($im, 1, 101, 255);
$gray      = imagecolorallocate($im, 169, 169, 169);

imagefill($im , 0 , 0 , $gray);
imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

$text_color = imagecolorallocate($im, 255, 0, 0);
imagestring($im, 1, 5, 5,  "", $text_color);
imagejpeg($im, $img5);
imagedestroy($im);


$hyogen_hensa = sprintf("%0.1f",round($math[0][ 'hyogen_hensa' ],1),1);
$img6 = "./images/pdf/img6_".$id.".jpg";
$st_score2 = substr($hyogen_hensa, 1, 4) * 9.2;
if($hyogen_hensa >= 80){
	$wid = 552;
}elseif($hyogen_hensa >= 70){
	$wid = $st_score2 + 461.3;
}elseif($hyogen_hensa >= 60){
	$wid = $st_score2 + 370.8;
}elseif($hyogen_hensa >= 50){
	$wid = $st_score2 + 279.75;
}elseif($hyogen_hensa >= 40){
	$wid = $st_score2 + 188.8;
}elseif($hyogen_hensa >= 30){
	$wid = $st_score2 + 94.8;
}elseif($hyogen_hensa >= 20){
	$wid = $st_score2 + 1;
}else{
	$wid = 1;
}
$hyogenlv = getLevel($hyogen_hensa);

$im        = imagecreatetruecolor($wid, 10);
$img_color = imagecolorallocate($im, 1, 101, 255);
$gray      = imagecolorallocate($im, 169, 169, 169);

imagefill($im , 0 , 0 , $gray);
imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

$text_color = imagecolorallocate($im, 255, 0, 0);
imagestring($im, 1, 5, 5,  "", $text_color);
imagejpeg($im, $img6);
imagedestroy($im);



//----------------------------------------------
//棒グラフ画像作成終わり
//----------------------------------------------


//--------------------------------
//PDF出力
//--------------------------------
//PDF個人情報入力
$make->makePdfKozin($pdf,$testdata,23);

$pdf->Ln(2);
$pdf->Cell(100, 5, '[1]BMSで測定していること', 0, 1, 'L', 1);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(192,4, $a_math_one, 1);

$pdf->Ln(5);
$pdf->Cell(100, 5, '[2]ビジネス数学力の5つの要素スコアとレベル', 0, 1, 'L', 1);

$pdf->SetFillColor(204,255,204);
$pdf->Cell(22, 3, "　", 'LT', 0, 'C', 1);
$pdf->Cell(10, 6.5, "レベル", 'LT', 0, 'C', 1);
$pdf->Cell(10, 6.5, "スコア", 'LTR', 0, 'C', 1);
$pdf->SetFontSize(7);
$pdf->Cell(38, 3, "1", 'TL', 0, 'C', 1);
$pdf->Cell(24.5, 3, "2", 'TL', 0, 'C', 1);
$pdf->Cell(23.5, 3, "3", 'TL', 0, 'C', 1);
$pdf->Cell(24.5, 3, "4", 'TL', 0, 'C', 1);
$pdf->Cell(39.5, 3, "5", 'TLR', 1, 'C', 1);

$pdf->Cell(22, 3, "　", 'LRB', 0, 'C', 1);
$pdf->Cell(10, 0, " ",  '',    0, 'C', 1);
$pdf->Cell(10, 0, " ",  '',    0, 'C', 1);

$pdf->Cell(24, 3, "20", 'TBL', 0, 'L', 1);
$pdf->Cell(24, 3, "30", 'TB', 0, 'L', 1);
$pdf->Cell(24, 3, "40", 'TB', 0, 'L', 1);
$pdf->Cell(24, 3, "50", 'TB', 0, 'L', 1);
$pdf->Cell(24, 3, "60", 'TB', 0, 'L', 1);
$pdf->Cell(24, 3, "70", 'TB', 0, 'L', 1);
$pdf->Cell(6,  3, "80", 'TRB', 1, 'L', 1);
$pdf->SetFillColor(255,255,255);
$pdf->SetFontSize(8);
$pdf->Cell(22, 6, "総合", 1, 0, 'L', 1);
//スコアを出力する
$pdf->Cell(10, 6, $sogolv." ", 1, 0, 'C', 1);
//レベルを出力する
$pdf->Cell(10, 6, $sogo_yoso, 1, 0, 'L', 1);
$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(4,  6, "", 1, 1, 'C', 1);
//第二引数x 第三引数y
//棒グラフの表示
$pdf->Image($img1, 52, 76.7);


$pdf->Cell(22, 6, "把握力", 1, 0, 'L', 1);
//スコアを出力する
$pdf->Cell(10, 6, $hakulv." ", 1, 0, 'C', 1);
//レベルを出力する
$pdf->Cell(10, 6, $haku_yoso, 1, 0, 'L', 1);
$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(4,  6, "", 1, 1, 'C', 1);
//第二引数x 第三引数y
//棒グラフの表示
$pdf->Image($img2, 52, 82.7);

$pdf->Cell(22, 6, "分析力", 1, 0, 'L', 1);
//スコアを出力する
$pdf->Cell(10, 6, $bunsekilv." ", 1, 0, 'C', 1);
//レベルを出力する
$pdf->Cell(10, 6, $bunseki_hensa, 1, 0, 'L', 1);
$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(4,  6, "", 1, 1, 'C', 1);
//第二引数x 第三引数y
//棒グラフの表示
$pdf->Image($img3, 52, 88.7);


$pdf->Cell(22, 6, "選択力", 1, 0, 'L', 1);
//スコアを出力する
$pdf->Cell(10, 6, $sentakulv." ", 1, 0, 'C', 1);
//レベルを出力する
$pdf->Cell(10, 6, $sentaku_hensa, 1, 0, 'L', 1);
$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(4,  6, "", 1, 1, 'C', 1);
//第二引数x 第三引数y
//棒グラフの表示
$pdf->Image($img4, 52, 94.7);


$pdf->Cell(22, 6, "予測力", 1, 0, 'L', 1);
//スコアを出力する
$pdf->Cell(10, 6, $yosokulv." ", 1, 0, 'C', 1);
//レベルを出力する
$pdf->Cell(10, 6, $yosoku_hensa, 1, 0, 'L', 1);
$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(4,  6, "", 1, 1, 'C', 1);
//第二引数x 第三引数y
//棒グラフの表示
$pdf->Image($img5, 52, 100.7);


$pdf->Cell(22, 6, "表現力", 1, 0, 'L', 1);
//スコアを出力する
$pdf->Cell(10, 6, $hyogenlv." ", 1, 0, 'C', 1);
//レベルを出力する
$pdf->Cell(10, 6, $hyogen_hensa, 1, 0, 'L', 1);
$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
$pdf->Cell(4,  6, "", 1, 1, 'C', 1);
//第二引数x 第三引数y
//棒グラフの表示
$pdf->Image($img6, 52, 106.7);

//50の境界線の赤線
$pdf->SetFillColor(255,63,63);
$pdf->Rect(125.75, 75, 1, 35.75, 'F');
$pdf->SetFillColor(255, 255, 255);

$pdf->Ln(5);
$pdf->Cell(100, 5, '[3]'.$name.'さんへの質問例', 0, 1, 'L', 1);
$pdf->SetFillColor(204,255,204);
$pdf->Cell(30, 5, "要素名", 'LT', 0, 'C', 1);
$pdf->Cell(54, 5, "リスク", 'LT', 0, 'C', 1);
$pdf->Cell(54, 5, "面接時の質問例", 'LT', 0, 'C', 1);
$pdf->Cell(54, 5, "判定のポイント", 'LTR', 1, 'C', 1);
$pdf->MultiCell(30,15, "\n把握力\n\n", 1);
$pdf->SetXY(40.0, 126.0);
if($haku_yoso < 45 ){
	$risk = $a_haku[1]."\n\n\n\n";
	$men  = $a_haku[2]."\n\n\n\n\n";
	$jud  = $a_haku[3]."\n\n";
	$pdf->MultiCell(54,5, $risk, 1);
	$pdf->SetXY(94.0, 126.0);
	$pdf->MultiCell(54,5, $men, 1);
	$pdf->SetXY(148.0, 126.0);
	$pdf->MultiCell(54,5, $jud, 1);
}else{
	$pdf->MultiCell(54,15, "\n特になし\n\n", 1);
	$pdf->SetXY(94.0, 126.0);
	$pdf->MultiCell(54,15, "\n\n\n", 1);
	$pdf->SetXY(148.0, 126.0);
	$pdf->MultiCell(54,15, "\n\n\n", 1);
}


$pdf->MultiCell(30,5, "\n\n\n分析力\n選択力\n予測力\n\n\n\n", 1);
$pdf->SetXY(40.0, 171.0);

if($bunseki_hensa < 45 || $sentaku_hensa < 45 || $yosoku_hensa < 45){
	$risk = $a_bun[1]."\n\n";
	$men  = $a_bun[2]."\n\n\n\n\n\n";
	$jud  = $a_bun[3]."\n\n\n\n";
	$pdf->MultiCell(54,5, $risk, 1);
	$pdf->SetXY(94.0, 171.0);
	$pdf->MultiCell(54,5, $men, 1);
	$pdf->SetXY(148.0, 171.0);
	$pdf->MultiCell(54,5, $jud, 1);
}else{
	$pdf->MultiCell(54,15, "\n特になし\n\n", 1);
	$pdf->SetXY(94.0, 171.0);
	$pdf->MultiCell(54,15, "\n\n\n", 1);
	$pdf->SetXY(148.0, 171.0);
	$pdf->MultiCell(54,15, "\n\n\n", 1);
}

$pdf->MultiCell(30,15, "\n表現力\n\n", 1);
$pdf->SetXY(40.0, 216.0);

if($hyogen_hensa < 45 ){
	$risk = $a_disp[1]."\n\n\n";
	$men  = $a_disp[2]."\n\n\n\n\n\n";
	$jud  = $a_disp[3]."\n\n";
	$pdf->MultiCell(54,5, $risk, 1);
	$pdf->SetXY(94.0, 216.0);
	$pdf->MultiCell(54,5, $men, 1);
	$pdf->SetXY(148.0, 216.0);
	$pdf->MultiCell(54,5, $jud, 1);
}else{
	$pdf->MultiCell(54,15, "\n特になし\n\n", 1);
	$pdf->SetXY(94.0, 216.0);
	$pdf->MultiCell(54,15, "\n\n\n", 1);
	$pdf->SetXY(148.0, 216.0);
	$pdf->MultiCell(54,15, "\n\n\n", 1);
}



unlink($img1);
unlink($img2);
unlink($img3);
unlink($img4);
unlink($img5);
unlink($img6);
$pdf->SetXY(160.0, 270.0);
$pdf->Ln(5);
$pdf->SetFontSize(7);
$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');

function getLevel($pt){
	if($pt >= 65 ){
		$lv = 5;
	}elseif($pt >= 55){
		$lv = 4;
	}elseif($pt >= 45){
		$lv = 3;
	}elseif($pt >= 35){
		$lv = 2;
	}else{
		$lv = 1;
	}
	return $lv;
}
?>