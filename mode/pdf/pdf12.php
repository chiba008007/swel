<?PHP


$pdf->setSourceFile('./pdfTemplates/temp_pdf12.pdf');
$pdf->useTemplate($pdf->importPage(1));

$logo = "./img/pdflogo/pl_" . $user[0]['login_id'] . ".jpg";


$pdf->SetXY(28, 30);
if (file_exists($logo)) {
	$pdf->Image($logo, 10, 5, 50, 18);
} else {
	$pdf->Image("./images/welcome.jpg", 10, 5, 50, 25);
}

$pdf->SetFontSize(9);
$pdf->SetXY(25, 23);
$pdf->Write(0, $testdata['cusname']);

$pdf->SetFontSize(8);
$pdf->SetXY(30, 28.5);
$temp = explode(" ", $testdata['exam_dates']);
$temp = explode("-", $temp[0]);
$exam = $temp[0] . "/" . $temp[1] . "/" . $temp[2];
$pdf->Write(0, $exam);

$pdf->SetXY(68.5, 28.5);
$pdf->Write(0, $testdata['exam_id']);

$pdf->SetXY(105.5, 28.5);
$pdf->Write(0, $testdata['name']);

$age = getAgeCalcPDF12($testdata['birth'], $testdata['exam_dates']);

$pdf->SetXY(190.5, 28.5);
$pdf->Write(0, $age);

function getAgeCalcPDF12($birth, $regdate)
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

$pdf->SetXY(58.0, 35.5);
$pdf->Write(0, $array_dev[$dlist[1]['key']][0]);
$pdf->SetXY(58.0, 40.0);
$pdf->Write(0, $array_dev[$dlist[1]['key']][1]);
$pdf->SetXY(58.0, 45.0);
$pdf->MultiCell(140,3.5,$array_dev[$dlist[1]['key']][2],0);

$pdf->SetXY(39.0, 69.0);
$pdf->MultiCell(158,4,$array_dev[$dlist[1]['key']][3],1);
$pdf->SetXY(39.0, 84.3);
$pdf->MultiCell(158,4,$array_dev[$dlist[1]['key']][4],1);
$pdf->SetXY(39.0, 98.6);
$pdf->MultiCell(158,4,$array_dev[$dlist[1]['key']][5],1);
$pdf->SetXY(39.0, 112.8);
$pdf->MultiCell(158,4,$array_dev[$dlist[1]['key']][6],1);

$handan = preg_replace("/ /","",$array_dev[$dlist[1]['key']][8])."\n";
$handan .= preg_replace("/ /","",$array_dev[$dlist[1]['key']][9])."\n";
$handan .= preg_replace("/ /","",$array_dev[$dlist[1]['key']][10]);
$pdf->SetXY(39.0, 127.5);
$pdf->MultiCell(158,4,$handan);


$pdf->SetXY(58.0, 158.5);
$pdf->Cell(142,5,$array_dev[$dlist[2]['key']][0],0,0);
$pdf->SetXY(58.0, 163.5);
$pdf->Cell(142,5,$array_dev[$dlist[2]['key']][1],0);
$pdf->SetXY(58.0, 168.5);
$pdf->MultiCell(140,3.5,$array_dev[$dlist[2]['key']][2],0);
$pdf->SetXY(39.0, 193.0);
$pdf->MultiCell(160,4,$array_dev[$dlist[2]['key']][3],0);
$pdf->SetXY(39.0, 207.0);
$pdf->MultiCell(160,4,$array_dev[$dlist[2]['key']][4],0);
$pdf->SetXY(39.0, 222.0);
$pdf->MultiCell(160,4,$array_dev[$dlist[2]['key']][5],0);
$pdf->SetXY(39.0, 236.2);
$pdf->MultiCell(160,4,$array_dev[$dlist[2]['key']][6],0);

$handan = preg_replace("/ /","",$array_dev[$dlist[2]['key']][8])."\n";
$handan .= preg_replace("/ /","",$array_dev[$dlist[2]['key']][9])."\n";
$handan .= preg_replace("/ /","",$array_dev[$dlist[2]['key']][10]);

$pdf->SetXY(39.0, 251.0);
$pdf->MultiCell(160,4,$handan,0);

?>