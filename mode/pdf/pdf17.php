<?PHP
$pdf->setSourceFile('./pdfTemplates/temp_pdf17.pdf');
$pdf->useTemplate($pdf->importPage(1));
$logo = "./img/pdflogo/pl_" . $user[0]['login_id'] . ".jpg";


$pdf->SetXY(28, 30);
if (file_exists($logo)) {
	$pdf->Image($logo, 10, 5, 0, 15);
} else {
	$pdf->Image("./images/welcome.jpg", 5, 5, 0, 15);
}


$pdf->SetFontSize(8);
$pdf->SetXY(20, 22.3);
$pdf->Write(0, $testdata['cusname']);

$pdf->SetFontSize(8);
$pdf->SetXY(30, 26.5);
$temp = explode(" ", $testdata['exam_dates']);
$temp = explode("-", $temp[0]);
$exam = $temp[0] . "/" . $temp[1] . "/" . $temp[2];
$pdf->Write(0, $exam);

$pdf->SetXY(72, 26.5);
$pdf->MultiCell(23, 4, $testdata['exam_id'], 0, "C");

$pdf->SetXY(95, 26.5);
$pdf->MultiCell(76, 4, $testdata['name'] . '(' . $testdata['kana'] . ')', 0, "C");

$age = getAgeCalc($testdata['birth'], $testdata['exam_dates']);
$pdf->SetXY(188, 26.5);
$pdf->Write(0, $age);



//グラフ画像の登録
//棒グラフ太さ
$BW = 4;
//棒グラフ色
$BC[0] = 153;
$BC[1] = 153;
$BC[2] = 255;

$yomitori = $rs17[0]["yomitori"];
$rikai    = $rs17[0]["rikai"];
$sentaku  = $rs17[0]["sentaku"];
$kirikae  = $rs17[0]["kirikae"];
$jyoho    = $rs17[0]["jyoho"];
//データ配列の作成
$darray[0] = $rs17[0]["yomitori"];
$darray[1] = $rs17[0]["rikai"];
$darray[2] = $rs17[0]["sentaku"];
$darray[3] = $rs17[0]["kirikae"];



//45以下の数値の数を取得
//60以下の数値の数を取得
$Cnt45 = 0;
$Cnt60 = 0;
foreach ($darray as $key => $val) {
	if ($val <= 45) {
		$Cnt45++;
	}
	if ($val >= 60) {
		$Cnt60++;
	}
}

//------------------------------------------------------------------
//4つのブランチのうち、最大値となるブランチの値 x が　x>=55　ならレベル　3
//------------------------------------------------------------------
$max = max($darray);
if ($max >= 55) {
	$yomitori = $max - $yomitori;
	$rikai    = $max - $rikai;
	$sentaku  = $max - $sentaku;
	$kirikae  = $max - $kirikae;
	//10以上の場合、そのブランチを“L”とする
	//0未満の場合、そのブランチを“H”とする
	if ($yomitori >= 10) {
		$bltypes[0] = "L";
	} else {
		$bltypes[0] = "H";
	}

	if ($rikai >= 10) {
		$bltypes[1] = "L";
	} else {
		$bltypes[1] = "H";
	}
	if ($sentaku >= 10) {
		$bltypes[2] = "L";
	} else {
		$bltypes[2] = "H";
	}
	if ($kirikae >= 10) {
		$bltypes[3] = "L";
	} else {
		$bltypes[3] = "H";
	}
}

//------------------------------------------------------------------
//4つのブランチのうち、最大値となるブランチの値 x が 55>x>=45ならレベル 2
//------------------------------------------------------------------
if ($max < 55 && $max >= 45) {
	$yomitori = $max - $yomitori;
	$rikai    = $max - $rikai;
	$sentaku  = $max - $sentaku;
	$kirikae  = $max - $kirikae;

	//5以上の場合、そのブランチを“L”とする
	//0未満の場合、そのブランチを“H”とする
	if ($yomitori >= 5) {
		$bltypes[0] = "L";
	} else {
		$bltypes[0] = "H";
	}

	if ($rikai >= 5) {
		$bltypes[1] = "L";
	} else {
		$bltypes[1] = "H";
	}
	if ($sentaku >= 5) {
		$bltypes[2] = "L";
	} else {
		$bltypes[2] = "H";
	}
	if ($kirikae >= 5) {
		$bltypes[3] = "L";
	} else {
		$bltypes[3] = "H";
	}
}


//4つのブランチの偏差値が45未満（４つのブランチの最大値が45以下）の場合は、⑯LLLLタイプとする
if ($Cnt45 == 4) {
	$bltypes[0] = "L";
	$bltypes[1] = "L";
	$bltypes[2] = "L";
	$bltypes[3] = "L";
}

//４つのブランチの偏差値が60以上の場合は、①HHHHタイプ　とする
if ($Cnt60 == 4) {
	$bltypes[0] = "H";
	$bltypes[1] = "H";
	$bltypes[2] = "H";
	$bltypes[3] = "H";
}

$blkey = implode("", $bltypes);

$maru1 = "";
$maru2 = "";
$maru3 = "";
$maru4 = "";
$maruflg = "";

if ($rs17[0]['sougo'] <= 20) {
	$maru1 = "◎";
	$maruflg = 1;
} elseif ($rs17[0]['sougo'] <= 40) {
	$maru2 = "◎";
	$maruflg = 1;
} elseif ($rs17[0]['sougo'] <= 54) {
	$maru3 = "◎";
	$maruflg = 1;
} elseif ($rs17[0]['sougo'] <= 80) {
	$maru4 = "◎";
	$maruflg = 1;
}

$pdf->SetFontSize(12);
$pdf->SetTextColor(0, 0, 0);
if ($maruflg) $pdf->SetTextColor(255, 69, 0);
$pdf->SetXY(12, 78.5);
$pdf->MultiCell(48, 8, $maru1, 0, "C", 1);
$pdf->SetXY(64, 78.5);
$pdf->MultiCell(48, 8, $maru2, 1, "C", 1);
$pdf->SetXY(112, 78.5);
$pdf->MultiCell(48, 8, $maru3, 1, "C", 1);
$pdf->SetXY(160, 78.5);
$pdf->MultiCell(40, 8, $maru4, 1, "C", 1);


// 棒グラフ
$BW = 4;
//棒グラフ色
$BC[0] = 153;
$BC[1] = 153;
$BC[2] = 255;
//棒グラフの作成
$pdf->SetLineWidth($BW);

$pdf->SetDrawColor($BC[0], $BC[1], $BC[2]);
$pdf->Line(48.0, 101.0, $type17[$blkey]['0'], 101.0);
$pdf->Line(48.0, 109.5, $type17[$blkey]['1'], 109.5);
$pdf->Line(48.0, 119.0, $type17[$blkey]['2'], 119.0);
$pdf->Line(48.0, 128.0, $type17[$blkey]['3'], 128.0);


$pdf->SetFontSize(8);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(113, 97);
$pdf->MultiCell(88, 2, $type17[$blkey]['plus'], 0);

$pdf->SetXY(113, 115);
$pdf->MultiCell(88, 2, $type17[$blkey]['mainasu'], 0);

//感情能力総合に応じた各能力の特徴の比較値
$firsts[1] = 0;
$firsts[2] = 35.2099999;
$secs[1] = 35.210;
$secs[2] = 45.0299999;
$thirds[1] = 45.030;
$thirds[2] = 54.9699999;
$fours[1] = 54.970;
$fours[2] = 64.7899999;
$fives[1] = 64.790;
$fives[2] = 99.99999;

//値の組み直し
$yomitori = $rs17[0]["yomitori"];
$rikai    = $rs17[0]["rikai"];
$sentaku  = $rs17[0]["sentaku"];
$kirikae  = $rs17[0]["kirikae"];
$jyoho    = $rs17[0]["jyoho"];

if ($yomitori <= $firsts[2]) {
	$yomitoriKey = 0;
} elseif ($yomitori >= $secs[1] && $yomitori <= $secs[2]) {
	$yomitoriKey = 1;
} elseif ($yomitori >= $thirds[1] && $yomitori <= $thirds[2]) {
	$yomitoriKey = 2;
} elseif ($yomitori >= $fours[1] && $yomitori <= $fours[2]) {
	$yomitoriKey = 3;
} elseif ($yomitori >= $fives[1] && $yomitori <= $fives[2]) {
	$yomitoriKey = 4;
}

if ($rikai <= $firsts[2]) {
	$rikaiKey = 0;
} elseif ($rikai >= $secs[1] && $rikai <= $secs[2]) {
	$rikaiKey = 1;
} elseif ($rikai >= $thirds[1] && $rikai <= $thirds[2]) {
	$rikaiKey = 2;
} elseif ($rikai >= $fours[1] && $rikai <= $fours[2]) {
	$rikaiKey = 3;
} elseif ($rikai >= $fives[1] && $rikai <= $fives[2]) {
	$rikaiKey = 4;
}

if ($sentaku <= $firsts[2]) {
	$sentakuKey = 0;
} elseif ($sentaku >= $secs[1] && $sentaku <= $secs[2]) {
	$sentakuKey = 1;
} elseif ($sentaku >= $thirds[1] && $sentaku <= $thirds[2]) {
	$sentakuKey = 2;
} elseif ($sentaku >= $fours[1] && $sentaku <= $fours[2]) {
	$sentakuKey = 3;
} elseif ($sentaku >= $fives[1] && $sentaku <= $fives[2]) {
	$sentakuKey = 4;
}

if ($kirikae <= $firsts[2]) {
	$kirikaeKey = 0;
} elseif ($kirikae >= $secs[1] && $kirikae <= $secs[2]) {
	$kirikaeKey = 1;
} elseif ($kirikae >= $thirds[1] && $kirikae <= $thirds[2]) {
	$kirikaeKey = 2;
} elseif ($kirikae >= $fours[1] && $kirikae <= $fours[2]) {
	$kirikaeKey = 3;
} elseif ($kirikae >= $fives[1] && $kirikae <= $fives[2]) {
	$kirikaeKey = 4;
}

$pdf->SetFontSize(9);
$pdf->SetXY(46, 146);
$pdf->MultiCell(153, 4, $type17_read[$yomitoriKey], 0, "L", 1);

$pdf->SetXY(46, 166.5);
$pdf->MultiCell(153, 4, $type17_rikai[$rikaiKey], 0, "L", 1);

$pdf->SetXY(46, 187.5);
$pdf->MultiCell(153, 4, $type17_select[$sentakuKey], 0, "L", 1);

$pdf->SetXY(46, 207.5);
$pdf->MultiCell(153, 4, $type17_change[$kirikaeKey], 0, "L", 1);


$hosi = array();
if ($jyoho < 36) {
	$hosi[1] = "★";
	$hosiKey = 0;
} elseif ($jyoho >= 36 && $jyoho < 43) {
	$hosi[2] = "★";
	$hosiKey = 1;
} elseif ($jyoho >= 43 && $jyoho < 57) {
	$hosi[3] = "★";
	$hosiKey = 2;
} elseif ($jyoho >= 57 && $jyoho < 65) {
	$hosi[4] = "★";
	$hosiKey = 3;
} elseif ($jyoho >= 65) {
	$hosi[5] = "★";
	$hosiKey = 4;
}


$pdf->SetFontSize(11);
$pdf->SetXY(29, 237.5);
$pdf->MultiCell(10, 4, $hosi[1], 1, "L", 1);

$pdf->SetXY(72.3, 237.5);
$pdf->MultiCell(10, 4, $hosi[2], 1, "L", 1);

$pdf->SetXY(110.3, 237.5);
$pdf->MultiCell(10, 4, $hosi[3], 1, "L", 1);

$pdf->SetXY(144.3, 237.5);
$pdf->MultiCell(10, 4, $hosi[4], 1, "L", 1);

$pdf->SetXY(178.3, 237.5);
$pdf->MultiCell(10, 4, $hosi[5], 1, "L", 1);


$pdf->SetFontSize(9);
$pdf->SetXY(14.3, 248.5);
$pdf->SetFillColor(255, 255, 255);
$pdf->MultiCell(185, 5, $type17_bias[$hosiKey], 0, "L");
