<?PHP
//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusEditBill.php");

$obj = new cusEditBillMethod();

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

//お支払日
$pay[0] = date('Y', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
$pay[1] = date('m', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
$pay[2] = date("t", mktime(0, 0, 0, $pay_month, 1, $pay_year));

$company = $a_company;

$where[ 'id' ] = $ptid;
$main = $obj->getBillData($where);

$detail = array();
$i=1;
foreach($_REQUEST[ 'test' ] as $key=>$val){
	$detail[$i][ 'typename' ] = $a_test_type[$key];
	$detail[$i][ 'cnt'      ] = $_REQUEST[ 'RegNumber' ];
	$detail[$i][ 'money'    ] = $a_test_money[$key];
	$detail[$i][ 'price'    ] = $a_test_money[$key]*$_REQUEST[ 'RegNumber' ];
	$testsum += $a_test_money[$key]*$_REQUEST[ 'RegNumber' ];
	$i++;
}
if(count($_REQUEST[ 'pdf' ])){
	foreach($_REQUEST[ 'pdf' ] as $key=>$val){
		$detail[$i][ 'typename' ] = $array_pdf[$key];
		$detail[$i][ 'cnt'      ] = $_REQUEST[ 'RegNumber' ];
		$detail[$i][ 'money'    ] = $array_pdf_money[$key];
		$detail[$i][ 'price'    ] = $array_pdf_money[$key]*$_REQUEST[ 'RegNumber' ];
		$pdfsum += $array_pdf_money[$key]*$_REQUEST[ 'RegNumber' ];
		$i++;
	}
}
$main[0][ 'money_total' ] = ceil($testsum+$pdfsum)*1.08;

?>