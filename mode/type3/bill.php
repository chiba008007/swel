<?PHP
//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusBill.php");

$obj = new cusBillMethod();
$where = array();
$where[ 'id' ] = $id;
$main = $obj->getBillData($where);


//請求書Noデータ
$row = $obj->getBillNumber();
$row = sprintf("%03d",$row+1);
$number = "s".date('y').date("m").$row;

$date[ 'y' ]   = $obj->to_wareki(date("Y"),date("m"),date("d"));
$date[ 'm' ]   = date("m");
$date[ 'd' ]   = date("t", mktime(0, 0, 0, date("m"), 1, date("Y")));


$pay_year  = date('Y', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
$pay_month = date('m', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
$pay_day   = date("t", mktime(0, 0, 0, $pay_month, 1, $pay_year));

//テスト親データ
$where = array();
$where[ 'id'          ] = $sec;
$where[ 'partner_id'  ] = $ptid;
$where[ 'customer_id' ] = $id;
$where[ 'type'        ] = 0;
$tests = $obj->getTestData($where);
$test = $tests[0];
$pdf = $test[ 'pdfdownload' ];
$exPdf = explode(":",$pdf);

//お支払日
$pay[0] = date('Y', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
$pay[1] = date('m', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
$pay[2] = date("t", mktime(0, 0, 0, $pay_month, 1, $pay_year));

$company = $a_company;


//テスト登録データ取得
$where = array();
$where[ 'test_id'     ] = $sec;
$where[ 'partner_id'  ] = $ptid;
$where[ 'customer_id' ] = $id;
$testlist = $obj->getTestList($where);
$i=1;
foreach($testlist as $key=>$val){
	$num = $val[ 'number' ];
	$detail[$i][ 'typename'     ] = $a_test_type[$val[ 'type' ]];
	$detail[$i][ 'cnt'          ] = $val[ 'number' ];
	$detail[$i][ 'money'        ] = $a_test_money[$val[ 'type' ]];
	$detail[$i][ 'price'        ] = $a_test_money[$val[ 'type' ]]*$val[ 'number' ];
	$total += $a_test_money[$val[ 'type' ]]*$val[ 'number' ];
	$i++;
}
if(count($exPdf)){
	foreach($exPdf as $key=>$val){
		if($val){
			$detail[$i][ 'typename'     ] = $array_pdf[$val];
			$detail[$i][ 'cnt'          ] = $num;
			$detail[$i][ 'money'        ] = $array_pdf_money[$val];
			$detail[$i][ 'price'        ] = $array_pdf_money[$val]*$num;
			$total += $array_pdf_money[$val]*$num;
		}
		$i++;
	}
}
$main[0][ 'money_total' ] = $total*1.08;
?>