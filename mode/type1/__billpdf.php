<?PHP
require_once("./lib/include_billpdf.php");
$obj = new billpdfMethod();

//define('FPDF_FONTPATH','./font/');
require_once('./TCPDF-main/tcpdf.php');
$pdf = new TCPDF('P', 'mm', 'A4',true, 'UTF-8',false,false);
$pdf->setPrintHeader(false);

$pdf->AddPage();
$pdf ->setFont('kozgopromedium', '',10);
//$html = "ああああ";
//$pdf ->writeHTML($html);

$pdf->SetXY(90.0, 9.0);
$pdf->SetFontSize(18);
$pdf->Write(1,'御請求書');
$pdf->SetXY(150,25);
$pdf->SetFontSize(11);
$pdf->Write(1,'請求No. '.$_REQUEST[ 'billnumber' ]);
$style = [];
$pdf->Line( 150, 30, 200, 30, $style );
$pdf->SetXY(166,30);
$pdf->SetFontSize(11);
$pdf->Write(1,''.$_REQUEST[ 'year' ]."年");
$pdf->Write(1,''.$_REQUEST[ 'month' ]."月");
$pdf->Write(1,''.$_REQUEST[ 'day' ]."日");


$pdf->SetXY(130,38);
$pdf->SetFontSize(9);
//$tekikaku = mb_convert_encoding($_REQUEST[ 'tekikaku' ],'SJIS','UTF-8');
$pdf->Write(1,''.$_REQUEST[ 'tekikaku' ]);

$pdf->SetXY(135,58);
if($_REQUEST[ 'syahan' ] == 'on'){
	$pdf->Image('./images/innovation.gif', 175, 50, 25,25);
}
$pdf->Write(1,'〒'.$_REQUEST[ 'post1' ]."-".$_REQUEST[ 'post2' ]);
$pdf->SetXY(135,63);
$address = $_REQUEST[ 'address' ];
$address2 = $_REQUEST[ 'address2' ];
$pdf->Write(1,''.$address);
$pdf->SetXY(135,68);
$pdf->Write(1,''.$address2);
$pdf->SetXY(135,73);
$company = $_REQUEST[ 'company' ];
$pdf->Write(1,''.$company);
$pdf->SetXY(135,79);
$telnumber = $_REQUEST[ 'telnumber' ];
$pdf->Write(1,'TEL:'.$telnumber);
$pdf->SetFontSize(8);
$pdf->SetXY(179,91);
$pdf->Cell(20, 6, "担当者", 1, 1, 'C', 0);
$pdf->SetXY(179,97);
if($_REQUEST[ 'tantohan' ] == 'on'){
	$pdf->Image('./images/sasaki.gif', 183, 99, 12,12);
}
$pdf->Cell(20, 15, "　", 1, 1, 'C', 0);

$address2 = $_REQUEST[ 'cus_address2' ];
if($address2 == "ビル名等を入力してください"){
	$address2 = "";
}

$pdf->SetXY(170,30);
$cus_name = $_REQUEST[ 'cus_name' ]." ";

$pdf->SetXY(10,15);
$pdf->SetFontSize(11);
$cus_post = "〒".$_REQUEST[ 'cus_post1' ]."-".$_REQUEST[ 'cus_post2' ];
$pdf->Write(1,$cus_post);
$pdf->Ln(10);

$add = explode(" ",$_REQUEST[ 'cus_address' ]);

foreach($add as $key=>$val){
	if($val){
		$address = $val;
	//	$pdf->Ln(1);
	}
}
$pdf->MultiCell(90,5,$address);
$pdf->Ln(10);
$pdf->MultiCell(90,5,$address2);

$pdf->SetXY(10,34);
//$pdf->SetFontSize(14);
$pdf->Write(1,$cus_name);

$pdf->SetXY(10,43);
$cus_busyo = $_REQUEST[ 'cus_busyo' ];
if($cus_busyo == "部署名を入力してください"){
	$cus_busyo = "";
}
if($cus_busyo) $cus_busyo = $cus_busyo."　";
$post = trim($_REQUEST[ 'post' ]."");
if($post == "役職名を入力してください"){
	$post = "";
}
if($post){
	 $post = $post."　";
}else{
	$post = "";
}

$cus_tanto = $_REQUEST[ 'cus_tanto' ]."　様";
$pdf->SetFontSize(11);
$pdf->Write(1,$cus_busyo);
$pdf->Ln(5);

$pdf->Write(1,$post.$cus_tanto);
//$pdf->Rect(10, 53, 80, 'D');

$style = [];
$pdf->Line( 10, 53, 100, 53, $style );
$pdf->SetFontSize(10);
$pdf->SetXY(10,54);
$pdf->Write(1,"下記の通りご請求申し上げます。");
$pdf->Line( 10, 60, 100, 60, $style );
$pdf->SetXY(10,63);
// $pdf->SetFont(MINCHO, 'B', 10);
$pdf->Write(1,"請求金額");
$pdf->SetFontSize(15);
$pdf->SetXY(50,62);
$money = "￥".number_format($_REQUEST[ 'money' ])."-";
$pdf->Write(1,$money);
$pdf->SetXY(80,64);
$pdf->SetFontSize(6);
$pdf->Write(1,"※消費税込");
$pdf->Line( 10, 69, 100, 69, $style );

$pdf->SetFontSize(10);
$pdf->SetXY(10,72);
$billtitle = $_REQUEST[ 'billtitle' ];
$pdf->Write(1,"件　　名：".$billtitle);
$pdf->Line( 10, 78, 100, 78, $style );

$pdf->SetXY(10,81);
$pay_date = $_REQUEST[ 'pay_year' ]."年 ".$_REQUEST[ 'pay_month' ]."月 ".$_REQUEST[ 'pay_day' ]."日";
$pdf->Write(1,"御支払日：".$pay_date);
$pdf->Line( 10, 87, 100, 87, $style );

$pdf->SetXY(10,90);
$bank = $_REQUEST[ 'bank' ];
$bank_no = $_REQUEST[ 'bank_no' ];
$pdf->Write(1,"御振込先：".$bank." (口座番号)".$bank_no);
$pdf->Line( 10, 96, 100, 96, $style );

$pdf->SetXY(10,99);
$kouza = $_REQUEST[ 'kouza' ];
$pdf->Write(1,"口座名義：".$kouza);
$pdf->Line( 10, 105, 100, 105, $style );
$pdf->SetXY(10,108);
$pdf->Write(1,"※振込手数料は、貴社負担にてお願い申し上げます。");

$pdf->SetXY(10,120);

$pdf->SetFontSize(8);
$pdf->SetFillColor(204, 204, 255);
$pdf->Cell( 6, 6, "No"  , 1, 0, 'C', 1);
$pdf->Cell(68, 6, "品名", 1, 0, 'C', 1);
$pdf->Cell(25, 6, "銘柄", 1, 0, 'C', 1);
$pdf->Cell(30, 6, "規格", 1, 0, 'C', 1);
$pdf->Cell(10, 6, "数量", 1, 0, 'C', 1);
$pdf->Cell(10, 6, "単位", 1, 0, 'C', 1);
$pdf->Cell(15, 6, "単価", 1, 0, 'C', 1);
$pdf->Cell(25, 6, "金額", 1, 1, 'C', 1);

$i=1;
if($_REQUEST['bill'] && count($_REQUEST['bill'])){
	foreach($_REQUEST[ 'bill' ] as $key=>$val){
		if($i%2){
			$pdf->SetFillColor(255, 255, 255);
		}else{
			$pdf->SetFillColor(204, 204, 255);
		}

		if($val[ 'price' ]){
			$pdf->Cell( 6, 6, $i, 1, 0, 'L', 1);
		}else{
			$pdf->Cell( 6, 6, '', 1, 0, 'L', 1);
		}

		$leng = mb_strlen($val[ 'article' ]);
		if($leng >= 20){
			$pdf->SetFontSize(6);
		}else{
			$pdf->SetFontSize(8);
		}

		$pdf->Cell(68, 6, $val[ 'article'  ], 1, 0, 'L', 1);
		$pdf->SetFontSize(8);
		$pdf->Cell(25, 6, $val[ 'brand'    ], 1, 0, 'L', 1);
		$pdf->Cell(30, 6, $val[ 'standard' ], 1, 0, 'L', 1);
		$pdf->Cell(10, 6, $val[ 'number'   ], 1, 0, 'R', 1);
		$pdf->Cell(10, 6, $val[ 'unit'     ], 1, 0, 'R', 1);
		if($val[ 'unitprice' ]){
			$pdf->Cell(15, 6, number_format($val[ 'unitprice']), 1, 0, 'R', 1);
		}else{
			$pdf->Cell(15, 6, '', 1, 0, 'R', 1);
		}
		if($val[ 'price' ]){
			$pdf->Cell(25, 6, number_format($val[ 'price'    ]), 1, 1, 'R', 1);
		}else{
			$pdf->Cell(25, 6, '', 1, 1, 'R', 1);
		}
		$total += $val[ 'price' ];
		$i++;


	}

	//空行追加
	if($i <= 18){
		
		do{
			if($i%2){
				$pdf->SetFillColor(255, 255, 255);
			}else{
				$pdf->SetFillColor(204, 204, 255);
			}
			
			$pdf->Cell( 6, 6, ""  , 1, 0, 'C', 1);
			$pdf->Cell(68, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(25, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(30, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(15, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(25, 6, "", 1, 1, 'C', 1);
			
			$i++;
			if($i > 10){
				$flg = false;
			}else{
				$flg = true;
			}
		}while($flg);
	}

	if($i%2){
		$pdf->SetFillColor(255, 255, 255);
		$i++;
	}else{
		$pdf->SetFillColor(204, 204, 255);
		$i++;
	}


}

$pdf->SetFontSize(9);
$pdf->Cell( 6, 6, " "  , 1, 0, 'C', 1 );
$pdf->Cell(68, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(25, 6, "小計", 1, 0, 'C', 1);
$pdf->Cell(30, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(10, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(10, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(15, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(25, 6, number_format($total), 1, 1, 'R', 1);

if($i%2){
	$pdf->SetFillColor(255, 255, 255);
	$i++;
}else{
	$pdf->SetFillColor(204, 204, 255);
	$i++;
}

$tax = $_REQUEST[ 'money' ]-$total;
$pdf->SetFontSize(9);
$pdf->Cell( 6, 6, " "  , 1, 0, 'C', 1 );
$pdf->Cell(68, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(25, 6, "消費税", 1, 0, 'C', 1);
$pdf->Cell(30, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(10, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(10, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(15, 6, " ", 1, 0, 'C', 1   );
$pdf->Cell(25, 6, number_format($tax), 1, 1, 'R', 1);


if($i%2){
	$pdf->SetFillColor(255, 255, 255);
	$i++;
}else{
	$pdf->SetFillColor(204, 204, 255);
	$i++;
}

$tax = $_REQUEST[ 'money' ]-$total;
$pdf->SetFontSize(11);
$pdf->Cell( 164, 7, "合計（税込）"  , 1, 0, 'C', 1 );
$pdf->Cell( 25, 7,  number_format($_REQUEST[ 'money' ]), 1, 0, 'R', 1 );


$pdf->SetFontSize(9);
$pdf->Ln(10);
$pdf->Write(1,"※備考");
$pdf->Ln(5);
$other = $_REQUEST[ 'other' ];
$pdf->MultiCell(200,5,$other);


//出力データをDBに登録

$edit[ 'bill_num'       ] = $_REQUEST[ 'billnumber'  ];
$edit[ 'testid'         ] = $_REQUEST[ 'tid'         ];
$edit[ 'partner_id'     ] = $_REQUEST[ 'pid'         ];
$edit[ 'customer_id'    ] = $_REQUEST[ 'cid'         ];
$edit[ 'send_status'    ] = $_REQUEST[ 'send_status' ];
$edit[ 'money_total'    ] = $_REQUEST[ 'money'       ];
$edit[ 'name'           ] = $_REQUEST[ 'cus_name'    ];
$edit[ 'title'          ] = $_REQUEST[ 'billtitle'   ];
$edit[ 'pay_date'       ] = sprintf("%04d-%02d-%02d"
						,$_REQUEST[ 'pay_year' ],$_REQUEST[ 'pay_month' ],$_REQUEST[ 'pay_day' ]);
$edit[ 'pay_bank'       ] = $_REQUEST[ 'bank' ];
$edit[ 'pay_num'        ] = $_REQUEST[ 'bank_no'  ];
$edit[ 'pay_name'       ] = $_REQUEST[ 'kouza' ];
$edit[ 'post1'          ] = $_REQUEST[ 'cus_post1'   ];
$edit[ 'post2'          ] = $_REQUEST[ 'cus_post2'   ];
$edit[ 'address'        ] = $_REQUEST[ 'cus_address' ];
$edit[ 'address2'       ] = $_REQUEST[ 'cus_address2'];

$edit[ 'busyo'          ] = mb_convert_encoding($cus_busyo,"UTF-8","SJIS");
$edit[ 'tanto'          ] = $_REQUEST[ 'cus_tanto'   ];
$edit[ 'registdate'     ] = sprintf("%02d-%02d-%02d",$_REQUEST[ 'year' ],$_REQUEST[ 'month' ],$_REQUEST[ 'day' ]);
$edit[ 'other'          ] = $_REQUEST[ 'other'    ];
$edit[ 'company_post1'  ] = $_REQUEST[ 'post1'    ];
$edit[ 'company_post2'  ] = $_REQUEST[ 'post2'    ];
$edit[ 'company_address'] = $_REQUEST[ 'address'  ];
$edit[ 'company_address2'] = $_REQUEST[ 'address2'  ];

$edit[ 'company_name'   ] = $_REQUEST[ 'company'  ];
$edit[ 'company_telnum'   ] = $_REQUEST[ 'telnumber'  ];
$edit[ 'download_status'] = $_REQUEST[ 'download_status' ];
$edit[ 'bill_term_date_from' ] = sprintf("%04d-%02d-%02d",$_REQUEST[ 'year1' ],$_REQUEST[ 'month1' ],$_REQUEST[ 'day1' ]);
$edit[ 'bill_term_date_to'   ] = sprintf("%04d-%02d-%02d",$_REQUEST[ 'year2' ],$_REQUEST[ 'month2' ],$_REQUEST[ 'day2' ]);
$edit[ 'syahan_sts'          ] = $_REQUEST[ 'syahan'   ];
$edit[ 'tantohan_sts'        ] = $_REQUEST[ 'tantohan' ];
$edit[ 'post'                ] = mb_convert_encoding($post,"UTF-8","SJIS");


$edit[ 'bill'           ] = $_REQUEST[ 'bill' ];
$edit[ 'tekikaku'           ] = $_REQUEST[ 'tekikaku' ];

$obj->setBillData($edit);

$filename = $_REQUEST[ 'billnumber' ].".pdf";

$pdf->Output($filename, 'D');
exit();

?>