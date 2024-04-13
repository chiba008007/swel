<?php


$blue = array(255, 127, 80);
$pdf->setLineWidth(0.4);
$pdf->SetDrawColor(255, 127, 80);
$pdf->RoundedRect(10, 10, 280, 190, 2, '1111', 'D', null, $blue);


$pdf->SetFontSize(30);
$pdf->SetXY(100, 30);
$pdf->Write(0, "受　検　証　明　書");

$pdf->SetFontSize(18);
$y = 65;
$x = 50;
$pdf->SetXY($x, $y);
$pdf->Write(0, "受検番号：" . $third);
if ($name && $test["input_not_name"] != 1) {
    $y = $y + 20;
    $pdf->SetXY($x, $y);
    $pdf->Write(0, "氏名：" . mb_convert_encoding($name, "UTF-8", "SJIS") . ' 様');
}

$y = $y + 20;
$pdf->SetXY($x, $y);
$pdf->Write(0, "下記の検査が完了したことを証明します。");


$y = $y + 20;
$pdf->SetXY($x, $y);
$pdf->Write(0, "■ 検査名");
$y = $y + 10;
$testnames = [];
foreach ($testline as $value) {
    $testnames[] = $value['testname'];
}
sort($testnames);
$pdf->SetFontSize(14);
foreach ($testnames as $value) {
    $pdf->SetXY($x, $y);
    $pdf->Write(0, $value);
    $y = $y + 12;
}
$pdf->SetFontSize(18);
$pdf->SetXY($x, $y);
$pdf->Write(0, "■ 完了日：" . date("Y年m月d日", strtotime($testdata['findate'])));

$y = $y + 20;
$pdf->SetXY($x + 50, $y);
$pdf->Write(0, $testdata['cusname']);


$pdf->SetFontSize(16);
$y = $y + 20;
$x = 20;
$pdf->SetXY($x, $y);
$pdf->Write(0, "受検証明書番号：" . $sec . "-" . $third . "-" . strtotime($testdata['exam_dates']));
