<?PHP
//-------------------------------------------
//請求書新規作成
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_makeBill.php");
$obj = new makeBillMethod();

$where = array();
$where['id'] = $id;
$user = $db->getUser($where);


//-------------------------
//パートナ一覧取得（非同期）
//------------------------
if ($_REQUEST['lists']) {
	$where = array();
	$where['type'] = 2;
	$list = $obj->getPartner($where);
	$html = "";
	foreach ($list as $key => $val) {
		$html .= "<div class='pRadio' id='chk_" . $val['id'] . "' >";
		$html .= "<input type='radio' name='pid' value='" . $val['id'] . "' id='p_" . $val['id'] . "' class='radio'>";
		$html .= "<label for='p_" . $val['id'] . "'>" . $val['name'] . "</label>";
		$html .= "</div>\n";
	}
	echo $html;
	exit();
}

//-------------------------
//顧客一覧取得（非同期）
//------------------------
if ($_REQUEST['listsPtn']) {
	$where = array();
	$where['type'] = 3;
	$where['pid'] = $_REQUEST['pid'];
	$list = $obj->getCustomer($where);
	$html = "";
	if ($list && count($list)) {
		foreach ($list as $key => $val) {
			$html .= "<div class='cRadio' id='chk2_" . $val['id'] . "_" . $_REQUEST['pid'] . "' >";
			$html .= "<input type='radio' name='cid' value='" . $val['id'] . "' id='c_" . $val['id'] . "_" . $_REQUEST['pid'] . "' class='radio'  >";
			$html .= "<label for='c_" . $val['id'] . "_" . $_REQUEST['pid'] . "'>" . $val['name'] . "</label>";
			$html .= "</div>\n";
		}
	}
	echo $html;
	exit();
}

//-------------------------
//テスト一覧取得（非同期）
//------------------------
if ($_REQUEST['listsCus']) {
	$where = array();
	$where['partner_id'] = $_REQUEST['pid'];
	$where['customer_id'] = $_REQUEST['cid'];
	$list = $obj->getUserDataBillList($where);
	$html = "";
	if (count($list)) {
		foreach ($list as $key => $val) {
			$html .= "<div class='tRadio' id='chk3_" . $val['id'] . "_" . $_REQUEST['pid'] . "_" . $_REQUEST['cid'] . "' >";
			$html .= "<input type='radio' name='tid' value='" . $val['id'] . "' id='t_" . $val['id'] . "_" . $_REQUEST['pid'] . "_" . $_REQUEST['cid'] . "' class='radio'  >";
			$html .= "<label for='t_" . $val['id'] . "_" . $_REQUEST['pid'] . "_" . $_REQUEST['cid'] . "'>" . $val['name'] . "</label>";
			$html .= "</div>\n";
		}
	}
	echo $html;
	exit();
}


//----------------------
//請求書新規作成
//----------------------
if ($sec == "makes") {

	//データ取得
	$send = $_REQUEST['send'];

	switch ($send) {
		case "partner":
			$id = $_REQUEST['pid'];
			break;
		case "customer":
			$id = $_REQUEST['cid'];
			break;
	}
	$where = array();
	$where['id'] = $id;
	$where['del'] = 0;
	$main = $obj->getBillData($where);



	//請求書Noデータ
	$row = $obj->getBillNumber();
	$row = sprintf("%03d", $row + 1);
	$number = "s" . date('y') . date("m") . $row;

	$date['y']   = date("Y");
	$date['m']   = date("m");
	$date['d']   = date("t", mktime(0, 0, 0, date("m"), 1, date("Y")));


	$pay_year  = date('Y', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
	$pay_month = date('m', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
	$pay_day   = date("t", mktime(0, 0, 0, $pay_month, 1, $pay_year));

	//テスト親データ
	$where = array();
	$where['id'] = $_REQUEST['tid'];
	$where['type'] = 0;
	$tests = $obj->getTestData($where);
	$test = $tests[0];

	//テスト詳細データ取得
	$date1 = explode("/", $_REQUEST['datepic']);
	$year1  = $date1[0];
	$month1 = $date1[1];
	$day1   = $date1[2];
	$date2 = explode("/", $_REQUEST['datepic2']);
	$year2  = $date2[0];
	$month2 = $date2[1];
	$day2   = $date2[2];


	$where = array();
	$where['date1'] = sprintf("%04d-%02d-%02d 00:00:00", $year1, $month1, $day1);
	$where['date2'] = sprintf("%04d-%02d-%02d 23:59:59", $year2, $month2, $day2);
	$where['testgrp_id'] = $_REQUEST['tid'];
	$detail = $obj->getTestDetailGroupBill($where);

	if ($detail && count($detail)) {
		$i = 0;
		foreach ($detail as $key => $val) {
			$detail[$i]['typename']  = $a_test_JP[$val['type']];
			$detail[$i]['money']  = $a_test_money[$val['type']];
			$detail[$i]['price']  = $a_test_money[$val['type']] * $val['cnt'];
			$i++;
		}
	}


	$atest = explode(":", $tests[0]['pdfdownload']);

	$pdfcnt = count($atest);

	if ($i && count($atest)) {
		$key = 0;
		foreach ($atest as $key => $val) {
			if ($val) {
				$detail[$i]['typename'] = $array_pdf[$val] . "【PDF】";
				$detail[$i]['money'] = $array_pdf_money[$val];
				$detail[$i]['cnt'] = $detail[$key]['cnt'];
				$detail[$i]['price'] = $array_pdf_money[$val] * $detail[$key]['cnt'];
				$i++;
				$key++;
			}
		}
	}

	if ($detail && count($detail)) {
		foreach ($detail as $key => $val) {
			$total += $val['price'];
		}
	}

	$total = $total * 1.1;

	$main[0]['money_total'] = $total;

	//お支払日
	$pay[0] = date('Y', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
	$pay[1] = date('m', mktime(0, 0, 0, date('n') + 1, date('j'), date('Y')));
	$pay[2] = date("t", mktime(0, 0, 0, $pay_month, 1, $pay_year));

	$a_company[10] = "適格請求書発行事業者番号 " . $user[0]['tekikakuNumber'];
	$company = $a_company;
	$html = "dlBill";
}
