<?PHP
//-------------------------------------------
//納品書作成
//
//
//
//
//
//-------------------------------------------

require_once './lib/PHPExcel.php';
require_once './lib/PHPExcel/IOFactory.php';
require_once("./lib/include_billEx.php");

$oex = new billexMethod();


//請求書データ
$where = array();
$where['id'] =$sec;

$row = $oex->getBillData($where);

//請求書詳細

$where = array();
$where['t_bill_id'] =$sec;
$detail = $oex->getBillDetail($where);


$testid = $row[0][ 'testid' ];
$list[ 'testgrp_id'  ] = $testid;
$list[ 'partner_id'  ] = $row[0][ 'partner_id'  ];
$list[ 'customer_id' ] = $row[0][ 'customer_id' ];
$list[ 'bill_term_date_from' ] = $row[0][ 'bill_term_date_from' ];
$list[ 'bill_term_date_to'   ] = $row[0][ 'bill_term_date_to'   ];

$lists = $oex->getBillDataDetail($list);
$excel = new PHPExcel();  
// シートの設定  
$excel->setActiveSheetIndex(0);  
$sheet = $excel->getActiveSheet();  
$sheet->setTitle('sheet name');  
// セルに値を入れる
$name = $row[0][ 'name' ];
$sheet->getStyleByColumnAndRow(0, 1)->getFont()->setSize(16);

$sheet->setCellValue('A1', $name."　御中");
$sheet->mergeCells('A1:J7');
$sheet->setCellValue('M1', "送付日：");
$date = date('Y')."年".date("m")."月".date("d")."日";
$sheet->setCellValue('O1', $date);

$sheet->getStyleByColumnAndRow(2, 11)->getFont()->setSize(22);
$sheet->setCellValue('C11', "納品書（兼受領書）");
$sheet->setCellValue('K11', $row[0][ 'company_name' ]);
$sheet->setCellValue('K12', "〒".$row[0][ 'company_post1' ]."-".$row[0][ 'company_post2' ]);
$sheet->setCellValue('K13', $row[0][ 'company_address' ]);

$sheet->setCellValue('K14', "Tel:".$a_company[8]."　FAX:".$a_company[9]);

$sheet->setCellValue('A16', "下記の通り納品させて頂きました。");


$sheet->setCellValue('A18', "No");
$sheet->setCellValue('C18', "品名");
$sheet->setCellValue('I18', "数量・詳細内容");



// 文字を水平方向に中央寄せにする
$sheet->getStyleByColumnAndRow(0, 1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// 文字を垂直方向に中央寄せにする
$sheet->getStyleByColumnAndRow(0, 1)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


$sheet->mergeCells('A18:B18');
$sheet->mergeCells('C18:H18');
$sheet->mergeCells('I18:Q18');

//色の設定
$excel->getActiveSheet()->getStyle('A18')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$excel->getActiveSheet()->getStyle('A18')->getFill()->getStartColor()->setARGB('FF999999');

$excel->getActiveSheet()->getStyle('C18')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$excel->getActiveSheet()->getStyle('C18')->getFill()->getStartColor()->setARGB('FF999999');

$excel->getActiveSheet()->getStyle('I18')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$excel->getActiveSheet()->getStyle('I18')->getFill()->getStartColor()->setARGB('FF999999');

$sheet->getStyleByColumnAndRow(0, 18)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$sheet->getStyleByColumnAndRow(2, 18)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$sheet->getStyleByColumnAndRow(8, 18)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);


$sheet->getStyleByColumnAndRow(0, 18)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyleByColumnAndRow(2, 18)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyleByColumnAndRow(8, 18)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);





//カラムの幅を設定します
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(5.25);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(5.25);

$excel->getActiveSheet()->getColumnDimension('K')->setWidth(4);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(4);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(3);

$excel->getActiveSheet()->getColumnDimension('N')->setWidth(8);
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(3);
$excel->getActiveSheet()->getColumnDimension('P')->setWidth(3);
$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(3);


//罫線

$sheet->getStyleByColumnAndRow(0, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(1, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(2, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(3, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(4, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(5, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(6, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(7, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(8, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(9, 1)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


$sheet->getStyleByColumnAndRow(9, 1)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(9, 2)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(9, 3)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(9, 4)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(9, 5)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(9, 6)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(9, 7)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$sheet->getStyleByColumnAndRow(0, 1)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, 2)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, 3)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, 4)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, 5)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, 6)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, 7)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


$sheet->getStyleByColumnAndRow(0, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(1, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(2, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(3, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(4, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(5, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(6, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(7, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(8, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(9, 7)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


//表

for($i=0;$i<=16;$i++){
	$sheet->getStyleByColumnAndRow($i, 18)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
}

$sheet->getStyleByColumnAndRow(0, 18)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
$sheet->getStyleByColumnAndRow(16, 18)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);

for($i=0;$i<=16;$i++){
	$sheet->getStyleByColumnAndRow($i, 18)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
}
$i=19;
$no=1;
foreach($detail as $key=>$val){
	$sheet->mergeCells('A'.$i.':B'.$i);
	$sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyleByColumnAndRow(0, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	$sheet->getStyleByColumnAndRow(1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOTTED);
	$sheet->setCellValue('A'.$i, $no);

	$sheet->mergeCells('C'.$i.':H'.$i);
	$sheet->getStyleByColumnAndRow(7, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOTTED);
	//$sheet->setCellValue('C'.$i, $val[ 'name' ]);
	$sheet->setCellValue('C'.$i, $row[0][ 'title' ]);

	$sheet->mergeCells('I'.$i.':Q'.$i);
	$sheet->getStyleByColumnAndRow(16, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	$sheet->setCellValue('I'.$i, $val[ 'count' ]."アカウント");
	

	$i++;
	$no++;
}
if($no <= 12 ){
	do{
		
		$sheet->mergeCells('A'.$i.':B'.$i);
		$sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyleByColumnAndRow(0, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$sheet->getStyleByColumnAndRow(1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOTTED);
		$sheet->setCellValue('A'.$i, " ");

		$sheet->mergeCells('C'.$i.':H'.$i);
		$sheet->getStyleByColumnAndRow(7, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_DOTTED);
		$sheet->setCellValue('C'.$i, " ");

		$sheet->mergeCells('I'.$i.':Q'.$i);
		$sheet->getStyleByColumnAndRow(16, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
		$sheet->setCellValue('I'.$i, " ");

		$i++;
		$no++;
		$flg = false;
		if($no<=12){
			$flg=true;
		}
	}while($flg);
	
}

for($k=0;$k<=16;$k++){
	$sheet->getStyleByColumnAndRow($k, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
}
$i++;
$i++;

$sheet->setCellValue('A'.$i, "備");
$sheet->getStyleByColumnAndRow(0, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, $i+1)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, $i+2)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$sheet->getStyleByColumnAndRow(0, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, $i+1)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(0, $i+2)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


$sheet->getStyleByColumnAndRow(16, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(16, $i+1)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(16, $i+2)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

for($k=0;$k<=16;$k++){
	$sheet->getStyleByColumnAndRow($k, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$sheet->getStyleByColumnAndRow($k, $i+2)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

}

$i++;
$i++;
$sheet->setCellValue('A'.$i, "考");
$i++;
$i++;
$i++;

$sheet->setCellValue('A'.$i, "つきましては内容をご確認の上、");


$sheet->getStyleByColumnAndRow($k-4, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-4, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$sheet->getStyleByColumnAndRow($k-3, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-2, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


$sheet->setCellValue('N'.$i, "受領印");
$i5=$i+5;
$sheet->mergeCells('N'.$i.':Q'.$i);

$sheet->getStyleByColumnAndRow($k-4, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$i1 = $i+1;
$sheet->mergeCells('N'.$i1.':Q'.$i5);

$sheet->getStyleByColumnAndRow($k, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$i++;
$sheet->setCellValue('A'.$i, "大変お手数ですが受領印欄にご捺印頂き、");
$sheet->getStyleByColumnAndRow($k-4, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$i++;
$sheet->setCellValue('A'.$i, "データ化して、eメールにて");
$sheet->getStyleByColumnAndRow($k-4, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$i++;
$sheet->setCellValue('A'.$i, "(宛先：sasaki@innovation-gate.jp)まで、");
$sheet->getStyleByColumnAndRow($k-4, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$i++;
$sheet->setCellValue('A'.$i, "ご返送をお願い致します。");
$sheet->getStyleByColumnAndRow($k-4, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$sheet->getStyleByColumnAndRow($k-4, $i++)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$sheet->getStyleByColumnAndRow($k-4, $i++)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A'.$i, "尚、本書送付後7日以内にご返送を頂けない場合は、");
$sheet->setCellValue('N'.$i, "　年　月　日");

$sheet->getStyleByColumnAndRow($k-4, $i++)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
//$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->setCellValue('A'.$i, "受領されたものと致しますのでご了承願います。");

//$sheet->getStyleByColumnAndRow($k-4, $i++)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
//$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

//$sheet->getStyleByColumnAndRow($k-4, $i++)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$sheet->getStyleByColumnAndRow($k-4, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-3, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-2, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($k-1, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$i++;
$i++;
$i++;
$sheet->setCellValue('A'.$i, "弊社担当記入欄");
$sheet->mergeCells('A'.$i.':Q'.$i);
$sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyleByColumnAndRow(0, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
for($j=0;$j<=16;$j++){
	$sheet->getStyleByColumnAndRow($j, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$sheet->getStyleByColumnAndRow($j, $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

}
$sheet->getStyleByColumnAndRow(16, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$i++;
$sheet->mergeCells('A'.$i.':B'.$i);
$sheet->setCellValue('A'.$i, "納品月");

$sheet->mergeCells('C'.$i.':F'.$i);
$sheet->setCellValue('C'.$i, "年月");
$sheet->mergeCells('G'.$i.':H'.$i);

$sheet->setCellValue('G'.$i, "担当者");
$sheet->mergeCells('I'.$i.':M'.$i);
$sheet->setCellValue('I'.$i, "佐々木");

//$sheet->mergeCells('N'.$i);
$sheet->setCellValue('N'.$i, "備考");
$sheet->mergeCells('O'.$i.':Q'.$i);
$sheet->setCellValue('O'.$i, " ");
$sheet->getStyleByColumnAndRow(0, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(1, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(5, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(7, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(12, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow(13, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

for($j=0;$j<=16;$j++){
	$sheet->getStyleByColumnAndRow($j, $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
}
$sheet->getStyleByColumnAndRow(16, $i)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$i++;
$i++;
$sheet->setCellValue('A'.$i, "Welcome検査処理一覧");
$i++;
$i++;
$sheet->setCellValue('A'.$i, "処理ID");

$i++;
$sheet->setCellValue('A'.$i, "No");

$sheet->setCellValue('B'.$i, "ID");

$sheet->setCellValue('D'.$i, "ステータス");
$sheet->mergeCells('B'.$i.':C'.$i);
$sheet->mergeCells('D'.$i.':F'.$i);
//色の設定
$excel->getActiveSheet()->getStyle('A'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$excel->getActiveSheet()->getStyle('A'.$i)->getFill()->getStartColor()->setARGB('FFC0C0C0');
$excel->getActiveSheet()->getStyle('B'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$excel->getActiveSheet()->getStyle('B'.$i)->getFill()->getStartColor()->setARGB('FFC0C0C0');
$excel->getActiveSheet()->getStyle('D'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$excel->getActiveSheet()->getStyle('D'.$i)->getFill()->getStartColor()->setARGB('FFC0C0C0');

$sheet->getStyleByColumnAndRow(0, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
for($j=0;$j<=5;$j++){
	$sheet->getStyleByColumnAndRow($j, $i)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$sheet->getStyleByColumnAndRow($j, $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

}
$sheet->getStyleByColumnAndRow($j, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($j-3, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyleByColumnAndRow($j-5, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
if(count($lists)){
	$no=1;
	foreach($lists as $key=>$val){
		

		$i++;
		$sheet->setCellValue('A'.$i, $no);
		$sheet->setCellValue('B'.$i, $val[ 'exam_id' ]);
		$sheet->setCellValue('D'.$i, '納品済み');
		$sheet->getStyleByColumnAndRow(0, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet->getStyleByColumnAndRow(1, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet->getStyleByColumnAndRow(3, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$sheet->getStyleByColumnAndRow(6, $i)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$no++;
	}
}
for($j=0;$j<=5;$j++){
	$sheet->getStyleByColumnAndRow($j, $i)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
}




// Excel2007 形式で出力  
header('Content-Type: application/octet-stream');
$bill_num = $row[0][ 'bill_num' ];
header('Content-Disposition: attachment;filename="'.$bill_num.'.xls"');
$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');  

$writer->save('php://output');

exit();

?>