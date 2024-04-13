<?php
ini_set('display_errors', "On");
require_once("./lib/include_status.php");

require_once './lib/Classes/PHPExcel.php';
require_once './lib/Classes/PHPExcel/IOFactory.php';


$obj = new statusMethod();
$where = [];
$where['testgrp_id'] = $sec;
$ttestpaper = $obj->get($where);
$testdata = $obj->getTestdata($where);
$excel = new PHPExcel();

$reader = PHPExcel_IOFactory::createReader("Excel2007");
$excel = $reader->load("./templateExcel/status.xlsx");

$excel->setActiveSheetIndex(0);
$sheet = $excel->getActiveSheet();
//$sheet->setCellValue("A1", "検査名");
$sheet->setCellValue("B1", $testdata[0][ 'name' ]);

$alphabet = str_split('abcdefghijklmnopqrstuvwxyz');
$a_alpha = $alphabet;
foreach ($alphabet as $a1) {
    foreach ($alphabet as $a2) {
        $a_alpha[] = $a1 . $a2;
    }
}
$col = 2;
$list_type = explode(",", $ttestpaper[0][ 'list_type' ]);
foreach ($list_type as $key=>$value) {
    $sheet->setCellValue($a_alpha[$col]."3", $a_test_type[$value]);
    $sheet->getStyle($a_alpha[$col]."3")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

    $col++;
}


$row = 4;
foreach ($ttestpaper as $key=>$value) {
    $sheet->setCellValue("A".$row, $value['list_num']);
    $sheet->getStyle("A".$row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
    $sheet->setCellValue("B".$row, $value['exam_id']);
    $sheet->getStyle("B".$row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

    $col = 2;
    $list_exam_state = explode(",", $value[ 'list_exam_state' ]);
    foreach ($list_type as $k=>$val) {
        $str = "未受検";
        if ($list_exam_state[$k] == 1) {
            $str = "受検中";
        }
        if ($list_exam_state[$k] == 2) {
            $str = "受検済";
        }
        $sheet->setCellValue($a_alpha[$col].$row, $str);
        $sheet->getStyle($a_alpha[$col].$row)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        if ($list_exam_state[$k] == 0) {
            $sheet->getStyle($a_alpha[$col].$row)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('ffff00');
        }
        $col++;
    }
    $row++;
}




//出力するファイル名
$filename = "statuslist_".date('Ymd').".xlsx";

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment;filename=\"".$filename."\"");
header('Cache-Control: max-age=0');

$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
$writer->save("php://output");


exit();
