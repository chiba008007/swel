<?PHP
//-------------------------------------------
//請求書ダウンロード表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_dlBill.php");

$dl = new dlBillMethod();
$where = array();
$where['id'] = $sec;

$main = $dl->getBillData($where);
$list = $dl->getBillListData($where);


$main[0]['address1'] = $main[0]['address'];
$main[0]['address2'] = $main[0]['address2'];
$main[0]['rep_busyo'] = $main[0]['busyo'];
$main[0]['rep_name'] = $main[0]['tanto'];
$main[0]['other'] = $main[0]['other'];

$test['name'] = $main[0]['title'];
$pay            = explode("-", $main[0]['pay_date']);
$pay[0]         = sprintf("%d", $pay[0]);
$pay[1]         = sprintf("%d", $pay[1]);
$pay[2]         = sprintf("%d", $pay[2]);

$company[6]                 = $main[0]['pay_bank'];
$company[7]                 = $main[0]['pay_num'];
$company[8]                 = $main[0]['company_telnum'];
$company[0]                 = $main[0]['pay_name'];
$company[1]                 = $main[0]['company_post1'];
$company[2]                 = $main[0]['company_post2'];
$company[3]                 = $main[0]['company_address'];
$company[4]                 = $main[0]['company_address2'];
$company['company_name']  = $main[0]['company_name'];
$company[8]  = $a_company[8];

$company[10]                 = $main[0]['tekikaku'];


$number         = $main[0]['bill_num'];
$regd           = explode("-", $main[0]['registdate']);
$date['y']      = $regd[0];
$date['m']      = $regd[1];
$date['d']      = $regd[2];


//詳細
$i = 0;
if (count($list)) {
	foreach ($list as $key => $val) {
		$detail[$i]['typename'] = $val['name'];
		$detail[$i]['brand'] = $val['brand'];
		$detail[$i]['kikaku'] = $val['kikaku'];
		$detail[$i]['cnt'] = $val['count'];
		$detail[$i]['unit'] = $val['unit'];
		$detail[$i]['money'] = $val['money'];
		$detail[$i]['price'] = $val['price'];

		$i++;
	}
}

$download_status = 1;
