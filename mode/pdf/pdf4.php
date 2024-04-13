<?PHP
$pdf->setSourceFile('./pdfTemplates/temp_pdf4.pdf');
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
$pdf->SetXY(28, 28);
$temp = explode(" ", $testdata['exam_dates']);
$temp = explode("-", $temp[0]);
$exam = $temp[0] . "/" . $temp[1] . "/" . $temp[2];
$pdf->Write(0, $exam);

$pdf->SetXY(61, 28);
$pdf->MultiCell(23, 4, $testdata['exam_id'], 0, "C");

$pdf->SetXY(95, 28);
$pdf->MultiCell(76, 4, $testdata['name'] . '(' . $testdata['kana'] . ')', 0, "C");

$age = getAgeCalc($testdata['birth'], $testdata['exam_dates']);
$pdf->SetXY(184.5, 28);
$pdf->Write(0, $age);

function getAgeCalc($birth, $regdate)
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
$rs = $obj->getPdfDataRs($where);

$sougo     = sprintf("%.1f", round($rs[0]['sougo'], 1));
$yomitori  = sprintf("%.1f", round($rs[0]['yomitori'], 1));
$rikai     = sprintf("%.1f", round($rs[0]['rikai'], 1));
$sentaku   = sprintf("%.1f", round($rs[0]['sentaku'], 1));
$kirikae   = sprintf("%.1f", round($rs[0]['kirikae'], 1));
//コメント配列読み込み
require_once("./mode/pdf/pdf4_comment.php");

//総合
$rssougoimg = "./images/pdf/img" . $id . "_rssougo.jpg";
setBarImage($sougo, $rssougoimg, 'yellow');
$pdf->SetXY(45, 82.3);
$pdf->Cell(26, 3, $sougo, 0, 0, 'C');
$pdf->SetXY(71.4, 82);
$pdf->Cell(17, 3, echoLevel($sougo), 0, 0, 'C');
$pdf->Image($rssougoimg, 88, 82);

//読み取り力
$rsyomitoriimg = "./images/pdf/img" . $id . "_rsyomitori.jpg";
setBarImage($yomitori, $rsyomitoriimg);
$pdf->SetXY(45, 88.4);
$pdf->Cell(26, 3, $yomitori, 0, 0, 'C');
$pdf->SetXY(71.4, 88);
$pdf->Cell(17, 3, echoLevel($yomitori), 0, 0, 'C');
$pdf->Image($rsyomitoriimg, 88, 88);

//理解
$rsrikaiimg = "./images/pdf/img" . $id . "_rsrikai.jpg";
setBarImage($rikai, $rsrikaiimg);
$pdf->SetXY(45, 94.6);
$pdf->Cell(26, 3, $rikai, 0, 0, 'C');
$pdf->SetXY(71.4, 94);
$pdf->Cell(17, 3, echoLevel($rikai), 0, 0, 'C');
$pdf->Image($rsrikaiimg, 88, 94);

//選択
$rssentakuimg = "./images/pdf/img" . $id . "_rssentaku.jpg";
setBarImage($sentaku, $rssentakuimg);
$pdf->SetXY(45, 101.1);
$pdf->Cell(26, 3, $sentaku, 0, 0, 'C');
$pdf->SetXY(71.4, 100.5);
$pdf->Cell(17, 3, echoLevel($sentaku), 0, 0, 'C');
$pdf->Image($rssentakuimg, 88, 100.2);

//切り替え
$rskirikaeimg = "./images/pdf/img" . $id . "_rskirikae.jpg";
setBarImage($kirikae, $rskirikaeimg);
$pdf->SetXY(45, 107.7);
$pdf->Cell(26, 3, $kirikae, 0, 0, 'C');
$pdf->SetXY(71.4, 106.4);
$pdf->Cell(17, 3, echoLevel($kirikae), 0, 0, 'C');
$pdf->Image($rskirikaeimg, 88, 106.2);

//スコアからメッセージを選定する
$rsAll = array(
	"1" => $yomitori,
	"2" => $rikai,
	"3" => $sentaku,
	"4" => $kirikae,
);
$rsmax = max($rsAll);


if ($rsmax >= 0 && $rsmax < 45) {
	$rsmaxid = "1";
} elseif ($rsmax >= 45 && $rsmax < 56) {
	$rsmaxid = "2";
} else {
	$rsmaxid = "3";
}

$rs1 = $rsmax - $rsAll['1'];
$rs2 = $rsmax - $rsAll['2'];
$rs3 = $rsmax - $rsAll['3'];
$rs4 = $rsmax - $rsAll['4'];

$today = "2015-08-03";
if ($testdata['exam_dates'] < $today) {
	//修正前間違ったデータ

	if ($rs1 >= 10 && $rs1 < 20) {
		$rs1id = "1";
	} elseif ($rs1 >= 20) {
		$rs1id = "2";
	} else {
		$rs1id = "3";
	}

	if ($rs2 >= 10 && $rs2 < 20) {
		$rs2id = "1";
	} elseif ($rs2 >= 20) {
		$rs2id = "2";
	} else {
		$rs2id = "3";
	}

	if ($rs3 >= 10 && $rs3 < 20) {
		$rs3id = "1";
	} elseif ($rs3 >= 20) {
		$rs3id = "2";
	} else {
		$rs3id = "3";
	}

	if ($rs4 >= 10 && $rs4 < 20) {
		$rs4id = "1";
	} elseif ($rs4 >= 20) {
		$rs4id = "2";
	} else {
		$rs4id = "3";
	}
} else {
	//修正後処理
	if ($rs1 >= 10 && $rs1 < 20) {
		$rs1id = "2";
	} elseif ($rs1 >= 20) {
		$rs1id = "1";
	} else {
		$rs1id = "3";
	}

	if ($rs2 >= 10 && $rs2 < 20) {
		$rs2id = "2";
	} elseif ($rs2 >= 20) {
		$rs2id = "1";
	} else {
		$rs2id = "3";
	}

	if ($rs3 >= 10 && $rs3 < 20) {
		$rs3id = "2";
	} elseif ($rs3 >= 20) {
		$rs3id = "1";
	} else {
		$rs3id = "3";
	}

	if ($rs4 >= 10 && $rs4 < 20) {
		$rs4id = "2";
	} elseif ($rs4 >= 20) {
		$rs4id = "1";
	} else {
		$rs4id = "3";
	}
}
if ($yomitori <= 35 && $rikai <= 35 && $sentaku <= 35 && $kirikae <= 35) {
	$rsid = "1111";
} elseif ($yomitori <= 40 && $rikai <= 40 && $sentaku <= 40 && $kirikae <= 40) {
	$rsid = "2222";
} elseif ($yomitori >= 65 && $rikai >= 65 && $sentaku >= 65 && $kirikae >= 65) {
	$rsid = "4444";
} else {
	$rsid = $rs1id . $rs2id . $rs3id . $rs4id . $rsmaxid;
}


//情報の捉え方のコメントを選定する
if ($rs[0]['jyoho'] < 36) {
	$jyohomsgNo = "1";
} elseif ($rs[0]['jyoho'] >= 36 && $rs[0]['jyoho'] < 43) {
	$jyohomsgNo = "2";
} elseif ($rs[0]['jyoho'] >= 43 && $rs[0]['jyoho'] < 57) {
	$jyohomsgNo = "3";
} elseif ($rs[0]['jyoho'] >= 57 && $rs[0]['jyoho'] < 65) {
	$jyohomsgNo = "4";
} else {
	$jyohomsgNo = "5";
}

//★を出力する位置を選定する
if ($rs[0]['jyoho'] == 20) {
	$star1 = "★";
} elseif ($rs[0]['jyoho'] >= 20 && $rs[0]['jyoho'] < 31) {
	$star1 = "★";
	$star1p = "C";
} elseif ($rs[0]['jyoho'] >= 31 && $rs[0]['jyoho'] < 42) {
	$star2 = "★";
} elseif ($rs[0]['jyoho'] >= 42 && $rs[0]['jyoho'] < 43) {
	$star3 = "★";
} elseif ($rs[0]['jyoho'] >= 43 && $rs[0]['jyoho'] < 47) {
	$star4 = "★";
} elseif ($rs[0]['jyoho'] >= 47 && $rs[0]['jyoho'] < 51) {
	$star5 = "★";
} elseif ($rs[0]['jyoho'] >= 51 && $rs[0]['jyoho'] < 57) {
	$star6 = "★";
} elseif ($rs[0]['jyoho'] >= 57 && $rs[0]['jyoho'] < 68.5) {
	$star7 = "★";
} elseif ($rs[0]['jyoho'] >= 68.5 && $rs[0]['jyoho'] < 74.25) {
	$star8 = "★";
} else {
	$star9 = "★";
}
if (!$star1p) {
	$star1p = "L";
}

$pdf->SetFontSize(9);
$rsmsg = $array_pdf_rsbalance[$rsid];
$pdf->SetXY(10, 121);
$pdf->MultiCell(186, 4.5, $rsmsg, 0, 'L');

$pdf->SetFontSize(9);
$yomitorimsg = $array_pdf_yomitori[echoLevel($yomitori)];
$pdf->SetXY(44.5, 152);
$pdf->MultiCell(152, 4.5, $yomitorimsg, 0, 'L');

$rikaimsg = $array_pdf_rikai[echoLevel($rikai)];
$pdf->SetXY(44.5, 174);
$pdf->MultiCell(152, 4.5, $rikaimsg, 0, 'L');

$sentakumsg = $array_pdf_sentaku[echoLevel($sentaku)];
$pdf->SetXY(44.5, 196);
$pdf->MultiCell(152, 4.5, $sentakumsg, 0, 'L');

$kirikaemsg = $array_pdf_kirikae[echoLevel($kirikae)];
$pdf->SetXY(44.5, 218);
$pdf->MultiCell(152, 4.5, $kirikaemsg, 0, 'L');


$pdf->SetXY(5.5, 252);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);

$pdf->Cell(5, 5, "", 0, 0, 'L', 1);
$pdf->Cell(23, 5, $star1, 'LTB', 0, $star1p, 1);
$pdf->Cell(23, 5, $star2, 'TB', 0, 'C', 1);
$pdf->Cell(23, 5, $star3, 'TB', 0, 'R', 1);

$pdf->SetFillColor(255, 255, 128);
$pdf->Cell(16, 5, $star4, 'LTB', 0, 'L', 1);
$pdf->Cell(17, 5, $star5, 'TB', 0, 'C', 1);
$pdf->Cell(16, 5, $star6, 'TB', 0, 'R', 1);

$pdf->SetFillColor(255, 255, 255);
$pdf->Cell(23, 5, $star7, 'LTB', 0, 'L', 1);
$pdf->Cell(23, 5, $star8, 'TB', 0, 'C', 1);
$pdf->Cell(21.5, 5, $star9, 'TRB', 1, 'R', 1);

$pdf->SetXY(10, 260);
$jyohomsg = $array_pdf_jyoho[$jyohomsgNo];
$pdf->MultiCell(187, 5, $jyohomsg, 0, 'L');


function setBarImage($data, $path, $type = "red")
{
	$wid = getBarWidth($data);
	$im = imagecreatetruecolor($wid, 12);

	$img_color = ($type == "red") ? imagecolorallocate($im, 255, 0, 0) : imagecolorallocate($im, 255, 241, 0);

	imagefilledrectangle($im, 0, 0, $wid, 11, $img_color);
	imagejpeg($im, $path);
	imagedestroy($im);
}
function getBarWidth($data)
{
	$data2 = substr($data, 1, 4) * 4.5;
	if ($data >= 80) {
		$wid = $data2 + 280;
	} elseif ($data >= 70) {
		$wid = $data2 + 234.5;
	} elseif ($data >= 60) {
		$wid = $data2 + 189;
	} elseif ($data >= 50) {
		$wid = $data2 + 144.5;
	} elseif ($data >= 40) {
		$wid = $data2 + 97;
	} elseif ($data >= 30) {
		$wid = $data2 + 52;
	} elseif ($data > 20) {
		$data2 = substr($data, 1, 4) * 3.9;
		$wid = $data2 + 14;
	} else {
		$wid = 8;
	}
	return $wid;
}
function echoLevel($data)
{

	if ($data >= 0 && $data <= 35.20) {
		$sougoLv = 1;
	} elseif ($data >= 35.21 && $data <= 45.02) {
		$sougoLv = 2;
	} elseif ($data >= 45.03 && $data <= 54.96) {
		$sougoLv = 3;
	} elseif ($data >= 54.97 && $data <= 64.78) {
		$sougoLv = 4;
	} else {
		$sougoLv = 5;
	}
	return $sougoLv;
}
