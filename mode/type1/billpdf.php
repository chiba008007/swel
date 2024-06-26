<?PHP
ini_set('display_errors', "On");
require_once("./lib/include_billpdf.php");
$obj = new billpdfMethod();

if (
	preg_match("/ewel7/", $_SERVER['HTTP_HOST'])
	||
	preg_match("/s-wel/", $_SERVER['HTTP_HOST'])

) {
	require_once('./TCPDF-main/tcpdf.php');
	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false, false);
	$pdf->setPrintHeader(false);

	$pdf->AddPage();
	$pdf->setFont('kozgopromedium', '', 10);
} else {
	define('FPDF_FONTPATH', './font/');
	require('./mbfpdf.php');
	$pdf = new MBFPDF('P', 'mm', 'A4');
	$pdf->AddPage();
	$pdf->AddMBFont(MINCHO, 'SJIS');
	$pdf->SetFont(MINCHO, '', 8);
	//右へ移動
	$x = $pdf->getX();
	$y = $pdf->getY();
}

$pdf->SetXY(90.0, 9.0);
$pdf->SetFontSize(18);
$pdf->Write(1, '御請求書');


$pdf->SetXY(150, 25);
$pdf->SetFontSize(11);
$pdf->Write(1, '請求No.' . $_REQUEST['billnumber']);
//$pdf->Rect(150, 28, 48, 'D');

$pdf->SetXY(166, 30);
$pdf->SetFontSize(11);
$pdf->Write(1, '' . $_REQUEST['year'] . "年");
$pdf->Write(1, '' . $_REQUEST['month'] . "月");
$pdf->Write(1, '' . $_REQUEST['day'] . "日");
/*
$pdf->SetXY(126, 40);
$pdf->SetFontSize(11);

$pdf->Write(1, '' . mb_convert_encoding($_REQUEST['tekikaku'], "SJIS", "utf-8"));


$pdf->SetXY(135, 58);
if ($_REQUEST['syahan'] == 'on') {
	$pdf->Image('./images/innovation.gif', 175, 50, 25, 25);
}
$pdf->Write(1, '〒' . $_REQUEST['post1'] . "-" . $_REQUEST['post2']);
$pdf->SetXY(135, 63);


$address = mb_convert_encoding($_REQUEST['address'], 'SJIS', 'UTF-8');
$address2 = mb_convert_encoding($_REQUEST['address2'], 'SJIS', 'UTF-8');
$pdf->Write(1, '' . $address);
$pdf->SetXY(135, 68);
$pdf->Write(1, '' . $address2);
$pdf->SetXY(135, 73);
$company = mb_convert_encoding($_REQUEST['company'], 'SJIS', 'UTF-8');
$pdf->Write(1, '' . $company);
$pdf->SetXY(135, 79);
$telnumber = mb_convert_encoding($_REQUEST['telnumber'], 'SJIS', 'UTF-8');
$pdf->Write(1, 'TEL:' . $telnumber);
$pdf->SetFontSize(8);
$pdf->SetXY(179, 91);
$pdf->Cell(20, 6, "担当者", 1, 1, 'C', 0);
$pdf->SetXY(179, 97);
if ($_REQUEST['tantohan'] == 'on') {
	$pdf->Image('./images/sasaki.gif', 183, 99, 12, 12);
}
$pdf->Cell(20, 15, "　", 1, 1, 'C', 0);


$address2 = mb_convert_encoding($_REQUEST['cus_address2'], 'SJIS', 'UTF-8');
if ($address2 == "ビル名等を入力してください") {
	$address2 = "";
}

$pdf->SetXY(170, 30);
$cus_name = mb_convert_encoding($_REQUEST['cus_name'], 'SJIS', 'UTF-8') . " ";

$pdf->SetXY(10, 15);
$pdf->SetFontSize(11);
$cus_post = "〒" . $_REQUEST['cus_post1'] . "-" . $_REQUEST['cus_post2'];
$pdf->Write(1, $cus_post);
$pdf->Ln(3);

$add = explode(" ", $_REQUEST['cus_address']);

foreach ($add as $key => $val) {
	if ($val) {
		$address = mb_convert_encoding($val, 'SJIS', 'UTF-8');
		//	$pdf->Ln(1);
	}
}
$pdf->MultiCell(90, 5, $address);
$pdf->Ln(1);
$pdf->MultiCell(90, 5, $address2);


$pdf->SetXY(10, 34);
//$pdf->SetFontSize(14);
$pdf->Write(1, $cus_name);

$pdf->SetXY(10, 43);
$cus_busyo = mb_convert_encoding($_REQUEST['cus_busyo'], 'SJIS', 'UTF-8');
if ($cus_busyo == "部署名を入力してください") {
	$cus_busyo = "";
}
if ($cus_busyo) $cus_busyo = $cus_busyo . "　";
$post = trim(mb_convert_encoding($_REQUEST['post'], 'SJIS', 'UTF-8') . "");
if ($post == "役職名を入力してください") {
	$post = "";
}
if ($post) {
	$post = $post . "　";
} else {
	$post = "";
}

$cus_tanto = mb_convert_encoding($_REQUEST['cus_tanto'], 'SJIS', 'UTF-8') . "　様";
$pdf->SetFontSize(11);
$pdf->Write(1, $cus_busyo);
$pdf->Ln(5);

$pdf->Write(1, $post . $cus_tanto);
$pdf->Rect(10, 53, 80, 'D');

$pdf->SetFontSize(10);
$pdf->SetXY(10, 70);
$pdf->Write(1, "下記の通りご請求申し上げます。");
$pdf->SetXY(10, 78);
$pdf->SetFont(MINCHO, 'B', 10);
$pdf->Write(1, "請求金額");
$pdf->SetFontSize(15);
$pdf->SetXY(50, 78);
$money = "\\" . number_format($_REQUEST['money']) . "-";
$pdf->Write(1, $money);
$pdf->SetXY(80, 78);
$pdf->SetFontSize(6);
$pdf->Write(1, "※消費税込");
$pdf->Rect(10, 81, 70, 'D');


$pdf->SetFont(MINCHO, '', 10);
$pdf->SetFontSize(10);
$pdf->SetXY(10, 84);
$billtitle = mb_convert_encoding($_REQUEST['billtitle'], 'SJIS', 'UTF-8');
$pdf->Write(1, "件　　名：" . $billtitle);
$pdf->Rect(10, 87, 100, 'D');

$pdf->SetXY(10, 90);
$pay_date = $_REQUEST['pay_year'] . "年 " . $_REQUEST['pay_month'] . "月 " . $_REQUEST['pay_day'] . "日";
$pdf->Write(1, "御支払日：" . $pay_date);
$pdf->Rect(10, 93, 100, 'D');

$pdf->SetXY(10, 96);
$bank = mb_convert_encoding($_REQUEST['bank'], 'SJIS', 'UTF-8');
$bank_no = mb_convert_encoding($_REQUEST['bank_no'], 'SJIS', 'UTF-8');
$pdf->Write(1, "御振込先：" . $bank . " (口座番号)" . $bank_no);
$pdf->Rect(10, 99, 100, 'D');


$pdf->SetXY(10, 102);
$kouza = mb_convert_encoding($_REQUEST['kouza'], 'SJIS', 'UTF-8');
$pdf->Write(1, "口座名義：" . $kouza);
$pdf->Rect(10, 105, 100, 'D');

$pdf->SetXY(10, 108);
$pdf->Write(1, "※振込手数料は、貴社負担にてお願い申し上げます。");

$pdf->SetXY(10, 120);

$pdf->SetFontSize(8);
$pdf->SetFillColor(204, 204, 255);
$pdf->Cell(6, 6, "No", 1, 0, 'C', 1);
$pdf->Cell(68, 6, "品名", 1, 0, 'C', 1);
$pdf->Cell(25, 6, "銘柄", 1, 0, 'C', 1);
$pdf->Cell(30, 6, "規格", 1, 0, 'C', 1);
$pdf->Cell(10, 6, "数量", 1, 0, 'C', 1);
$pdf->Cell(10, 6, "単位", 1, 0, 'C', 1);
$pdf->Cell(15, 6, "単価", 1, 0, 'C', 1);
$pdf->Cell(25, 6, "金額", 1, 1, 'C', 1);

$i = 1;
if (count($_REQUEST['bill'])) {
	foreach ($_REQUEST['bill'] as $key => $val) {
		if ($i % 2) {
			$pdf->SetFillColor(255, 255, 255);
		} else {
			$pdf->SetFillColor(204, 204, 255);
		}

		if ($val['price']) {
			$pdf->Cell(6, 6, $i, 1, 0, 'L', 1);
		} else {
			$pdf->Cell(6, 6, '', 1, 0, 'L', 1);
		}

		$leng = mb_strlen($val['article']);
		if ($leng >= 20) {
			$pdf->SetFontSize(6);
		} else {
			$pdf->SetFontSize(8);
		}

		$pdf->Cell(68, 6, mb_convert_encoding($val['article'], "SJIS", "UTF-8"), 1, 0, 'L', 1);

		$pdf->SetFontSize(8);
		$pdf->Cell(25, 6, mb_convert_encoding($val['brand'], "SJIS", "UTF-8"), 1, 0, 'L', 1);
		$pdf->Cell(30, 6, mb_convert_encoding($val['standard'], "SJIS", "UTF-8"), 1, 0, 'L', 1);
		$pdf->Cell(10, 6, mb_convert_encoding($val['number'], "SJIS", "UTF-8"), 1, 0, 'R', 1);
		$pdf->Cell(10, 6, mb_convert_encoding($val['unit'], "SJIS", "UTF-8"), 1, 0, 'R', 1);
		if ($val['unitprice']) {
			$pdf->Cell(15, 6, number_format($val['unitprice']), 1, 0, 'R', 1);
		} else {
			$pdf->Cell(15, 6, '', 1, 0, 'R', 1);
		}
		if ($val['price']) {
			$pdf->Cell(25, 6, number_format($val['price']), 1, 1, 'R', 1);
		} else {
			$pdf->Cell(25, 6, '', 1, 1, 'R', 1);
		}
		$total += $val['price'];
		$i++;
	}


	//空行追加
	if ($i <= 18) {

		do {
			if ($i % 2) {
				$pdf->SetFillColor(255, 255, 255);
			} else {
				$pdf->SetFillColor(204, 204, 255);
			}

			$pdf->Cell(6, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(68, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(25, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(30, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(15, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(25, 6, "", 1, 1, 'C', 1);

			$i++;
			if ($i > 10) {
				$flg = false;
			} else {
				$flg = true;
			}
		} while ($flg);
	}

	if ($i % 2) {
		$pdf->SetFillColor(255, 255, 255);
		$i++;
	} else {
		$pdf->SetFillColor(204, 204, 255);
		$i++;
	}
}

$pdf->SetFontSize(9);
$pdf->Cell(164, 6, "10%対象合計", 1, 0, 'R', 1);
$pdf->Cell(25, 6, number_format($total), 1, 1, 'R', 1);

if ($i % 2) {
	$pdf->SetFillColor(255, 255, 255);
	$i++;
} else {
	$pdf->SetFillColor(204, 204, 255);
	$i++;
}

$tax = $_REQUEST['money'] - $total;
$pdf->SetFontSize(9);
$pdf->Cell(164, 6, "消費税(10%)", 1, 0, 'R', 1);
$pdf->Cell(25, 6, number_format($tax), 1, 1, 'R', 1);

if ($i % 2) {
	$pdf->SetFillColor(255, 255, 255);
	$i++;
} else {
	$pdf->SetFillColor(204, 204, 255);
	$i++;
}

$tax = $_REQUEST['money'] - $total;
$pdf->SetFontSize(11);
$pdf->Cell(164, 7, "合計（消費税込）", 1, 0, 'R', 1);
$pdf->Cell(25, 7,  number_format($_REQUEST['money']), 1, 0, 'R', 1);


$pdf->SetFontSize(9);
$pdf->Ln(10);
$pdf->Write(1, "※備考");
$pdf->Ln(5);
$other = mb_convert_encoding($_REQUEST['other'], 'SJIS', 'UTF-8');
$pdf->MultiCell(200, 5, $other);
$pdf->SetFont(MINCHO, '', 8);

//出力データをDBに登録

$edit['bill_num'] = $_REQUEST['billnumber'];
$edit['testid'] = $_REQUEST['tid'];
$edit['partner_id'] = $_REQUEST['pid'];
$edit['customer_id'] = $_REQUEST['cid'];
$edit['send_status'] = $_REQUEST['send_status'];
$edit['money_total'] = $_REQUEST['money'];
$edit['name'] = $_REQUEST['cus_name'];
$edit['title'] = $_REQUEST['billtitle'];
$edit['pay_date'] = sprintf(
	"%04d-%02d-%02d",
	$_REQUEST['pay_year'],
	$_REQUEST['pay_month'],
	$_REQUEST['pay_day']
);
$edit['pay_bank'] = $_REQUEST['bank'];
$edit['pay_num'] = $_REQUEST['bank_no'];
$edit['pay_name'] = $_REQUEST['kouza'];
$edit['post1'] = $_REQUEST['cus_post1'];
$edit['post2'] = $_REQUEST['cus_post2'];
$edit['address'] = $_REQUEST['cus_address'];
$edit['address2'] = $_REQUEST['cus_address2'];

$edit['busyo'] = mb_convert_encoding($cus_busyo, "UTF-8", "SJIS");
$edit['tanto'] = $_REQUEST['cus_tanto'];
$edit['registdate'] = sprintf("%02d-%02d-%02d", $_REQUEST['year'], $_REQUEST['month'], $_REQUEST['day']);
$edit['other'] = $_REQUEST['other'];
$edit['company_post1'] = $_REQUEST['post1'];
$edit['company_post2'] = $_REQUEST['post2'];
$edit['company_address'] = $_REQUEST['address'];
$edit['company_address2'] = $_REQUEST['address2'];

$edit['company_name'] = $_REQUEST['company'];
$edit['tekikaku'] = $_REQUEST['tekikaku'];
$edit['company_telnum'] = $_REQUEST['telnumber'];
$edit['download_status'] = $_REQUEST['download_status'];
$edit['bill_term_date_from'] = sprintf("%04d-%02d-%02d", $_REQUEST['year1'], $_REQUEST['month1'], $_REQUEST['day1']);
$edit['bill_term_date_to'] = sprintf("%04d-%02d-%02d", $_REQUEST['year2'], $_REQUEST['month2'], $_REQUEST['day2']);
$edit['syahan_sts'] = $_REQUEST['syahan'];
$edit['tantohan_sts'] = $_REQUEST['tantohan'];
$edit['post'] = mb_convert_encoding($post, "UTF-8", "SJIS");
*/

$edit['bill'] = $_REQUEST['bill'];

$obj->setBillData($edit);

$filename = $_REQUEST['billnumber'] . ".pdf";

$pdf->Output($filename, 'D');

exit();

/*

<?PHP


require_once("./lib/include_billpdf.php");
$obj = new billpdfMethod();

if (preg_match("/ewel7/", $_SERVER['HTTP_HOST'])) {
	require_once('./TCPDF-main/tcpdf.php');
	$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false, false);
	$pdf->setPrintHeader(false);

	$pdf->AddPage();
	$pdf->setFont('kozgopromedium', '', 10);
} else {
	define('FPDF_FONTPATH', './font/');
	require('./mbfpdf.php');
	$pdf = new MBFPDF('P', 'mm', 'A4');
	$pdf->AddPage();
	$pdf->AddMBFont(MINCHO, 'SJIS');
	$pdf->SetFont(MINCHO, '', 8);
	//�E�ֈړ�
	$x = $pdf->getX();
	$y = $pdf->getY();
}




$pdf->SetXY(90.0, 9.0);
$pdf->SetFontSize(18);
$pdf->Write(1, '�䐿����');

$pdf->SetXY(150, 25);
$pdf->SetFontSize(11);
$pdf->Write(1, '����No.' . $_REQUEST['billnumber']);
$pdf->Rect(150, 28, 48, 'D');

$pdf->SetXY(166, 30);
$pdf->SetFontSize(11);
$pdf->Write(1, '' . $_REQUEST['year'] . "�N");
$pdf->Write(1, '' . $_REQUEST['month'] . "��");
$pdf->Write(1, '' . $_REQUEST['day'] . "��");

$pdf->SetXY(116, 40);
$pdf->SetFontSize(11);

$pdf->Write(1, '' . mb_convert_encoding($_REQUEST['tekikaku'], "SJIS", "utf-8"));



$pdf->SetXY(135, 58);
if ($_REQUEST['syahan'] == 'on') {
	$pdf->Image('./images/innovation.gif', 175, 50, 25, 25);
}
$pdf->Write(1, '��' . $_REQUEST['post1'] . "-" . $_REQUEST['post2']);
$pdf->SetXY(135, 63);


$address = mb_convert_encoding($_REQUEST['address'], 'SJIS', 'UTF-8');
$address2 = mb_convert_encoding($_REQUEST['address2'], 'SJIS', 'UTF-8');
$pdf->Write(1, '' . $address);
$pdf->SetXY(135, 68);
$pdf->Write(1, '' . $address2);
$pdf->SetXY(135, 73);
$company = mb_convert_encoding($_REQUEST['company'], 'SJIS', 'UTF-8');
$pdf->Write(1, '' . $company);
$pdf->SetXY(135, 79);
$telnumber = mb_convert_encoding($_REQUEST['telnumber'], 'SJIS', 'UTF-8');
$pdf->Write(1, 'TEL:' . $telnumber);
$pdf->SetFontSize(8);
$pdf->SetXY(179, 91);
$pdf->Cell(20, 6, "�S����", 1, 1, 'C', 0);
$pdf->SetXY(179, 97);
if ($_REQUEST['tantohan'] == 'on') {
	$pdf->Image('./images/sasaki.gif', 183, 99, 12, 12);
}
$pdf->Cell(20, 15, "�@", 1, 1, 'C', 0);


$address2 = mb_convert_encoding($_REQUEST['cus_address2'], 'SJIS', 'UTF-8');
if ($address2 == "�r����������͂��Ă�������") {
	$address2 = "";
}

$pdf->SetXY(170, 30);
$cus_name = mb_convert_encoding($_REQUEST['cus_name'], 'SJIS', 'UTF-8') . " ";

$pdf->SetXY(10, 15);
$pdf->SetFontSize(11);
$cus_post = "��" . $_REQUEST['cus_post1'] . "-" . $_REQUEST['cus_post2'];
$pdf->Write(1, $cus_post);
$pdf->Ln(3);

$add = explode(" ", $_REQUEST['cus_address']);

foreach ($add as $key => $val) {
	if ($val) {
		$address = mb_convert_encoding($val, 'SJIS', 'UTF-8');
		//	$pdf->Ln(1);
	}
}
$pdf->MultiCell(90, 5, $address);
$pdf->Ln(1);
$pdf->MultiCell(90, 5, $address2);


$pdf->SetXY(10, 34);
//$pdf->SetFontSize(14);
$pdf->Write(1, $cus_name);

$pdf->SetXY(10, 43);
$cus_busyo = mb_convert_encoding($_REQUEST['cus_busyo'], 'SJIS', 'UTF-8');
if ($cus_busyo == "����������͂��Ă�������") {
	$cus_busyo = "";
}
if ($cus_busyo) $cus_busyo = $cus_busyo . "�@";
$post = trim(mb_convert_encoding($_REQUEST['post'], 'SJIS', 'UTF-8') . "");
if ($post == "��E������͂��Ă�������") {
	$post = "";
}
if ($post) {
	$post = $post . "�@";
} else {
	$post = "";
}

$cus_tanto = mb_convert_encoding($_REQUEST['cus_tanto'], 'SJIS', 'UTF-8') . "�@�l";
$pdf->SetFontSize(11);
$pdf->Write(1, $cus_busyo);
$pdf->Ln(5);

$pdf->Write(1, $post . $cus_tanto);
$pdf->Rect(10, 53, 80, 'D');

$pdf->SetFontSize(10);
$pdf->SetXY(10, 70);
$pdf->Write(1, "���L�̒ʂ育�����\���グ�܂��B");
$pdf->SetXY(10, 78);
$pdf->SetFont(MINCHO, 'B', 10);
$pdf->Write(1, "�������z");
$pdf->SetFontSize(15);
$pdf->SetXY(50, 78);
$money = "\\" . number_format($_REQUEST['money']) . "-";
$pdf->Write(1, $money);
$pdf->SetXY(80, 78);
$pdf->SetFontSize(6);
$pdf->Write(1, "������ō�");
$pdf->Rect(10, 81, 70, 'D');


$pdf->SetFont(MINCHO, '', 10);
$pdf->SetFontSize(10);
$pdf->SetXY(10, 84);
$billtitle = mb_convert_encoding($_REQUEST['billtitle'], 'SJIS', 'UTF-8');
$pdf->Write(1, "���@�@���F" . $billtitle);
$pdf->Rect(10, 87, 100, 'D');

$pdf->SetXY(10, 90);
$pay_date = $_REQUEST['pay_year'] . "�N " . $_REQUEST['pay_month'] . "�� " . $_REQUEST['pay_day'] . "��";
$pdf->Write(1, "��x�����F" . $pay_date);
$pdf->Rect(10, 93, 100, 'D');

$pdf->SetXY(10, 96);
$bank = mb_convert_encoding($_REQUEST['bank'], 'SJIS', 'UTF-8');
$bank_no = mb_convert_encoding($_REQUEST['bank_no'], 'SJIS', 'UTF-8');
$pdf->Write(1, "��U����F" . $bank . " (�����ԍ�)" . $bank_no);
$pdf->Rect(10, 99, 100, 'D');


$pdf->SetXY(10, 102);
$kouza = mb_convert_encoding($_REQUEST['kouza'], 'SJIS', 'UTF-8');
$pdf->Write(1, "�������`�F" . $kouza);
$pdf->Rect(10, 105, 100, 'D');

$pdf->SetXY(10, 108);
$pdf->Write(1, "���U���萔���́A�M�Е��S�ɂĂ��肢�\���グ�܂��B");

$pdf->SetXY(10, 120);

$pdf->SetFontSize(8);
$pdf->SetFillColor(204, 204, 255);
$pdf->Cell(6, 6, "No", 1, 0, 'C', 1);
$pdf->Cell(68, 6, "�i��", 1, 0, 'C', 1);
$pdf->Cell(25, 6, "����", 1, 0, 'C', 1);
$pdf->Cell(30, 6, "�K�i", 1, 0, 'C', 1);
$pdf->Cell(10, 6, "����", 1, 0, 'C', 1);
$pdf->Cell(10, 6, "�P��", 1, 0, 'C', 1);
$pdf->Cell(15, 6, "�P��", 1, 0, 'C', 1);
$pdf->Cell(25, 6, "���z", 1, 1, 'C', 1);

$i = 1;
if (count($_REQUEST['bill'])) {
	foreach ($_REQUEST['bill'] as $key => $val) {
		if ($i % 2) {
			$pdf->SetFillColor(255, 255, 255);
		} else {
			$pdf->SetFillColor(204, 204, 255);
		}

		if ($val['price']) {
			$pdf->Cell(6, 6, $i, 1, 0, 'L', 1);
		} else {
			$pdf->Cell(6, 6, '', 1, 0, 'L', 1);
		}

		$leng = mb_strlen($val['article']);
		if ($leng >= 20) {
			$pdf->SetFontSize(6);
		} else {
			$pdf->SetFontSize(8);
		}

		$pdf->Cell(68, 6, mb_convert_encoding($val['article'], "SJIS", "UTF-8"), 1, 0, 'L', 1);

		$pdf->SetFontSize(8);
		$pdf->Cell(25, 6, mb_convert_encoding($val['brand'], "SJIS", "UTF-8"), 1, 0, 'L', 1);
		$pdf->Cell(30, 6, mb_convert_encoding($val['standard'], "SJIS", "UTF-8"), 1, 0, 'L', 1);
		$pdf->Cell(10, 6, mb_convert_encoding($val['number'], "SJIS", "UTF-8"), 1, 0, 'R', 1);
		$pdf->Cell(10, 6, mb_convert_encoding($val['unit'], "SJIS", "UTF-8"), 1, 0, 'R', 1);
		if ($val['unitprice']) {
			$pdf->Cell(15, 6, number_format($val['unitprice']), 1, 0, 'R', 1);
		} else {
			$pdf->Cell(15, 6, '', 1, 0, 'R', 1);
		}
		if ($val['price']) {
			$pdf->Cell(25, 6, number_format($val['price']), 1, 1, 'R', 1);
		} else {
			$pdf->Cell(25, 6, '', 1, 1, 'R', 1);
		}
		$total += $val['price'];
		$i++;
	}


	//��s�ǉ�
	if ($i <= 18) {

		do {
			if ($i % 2) {
				$pdf->SetFillColor(255, 255, 255);
			} else {
				$pdf->SetFillColor(204, 204, 255);
			}

			$pdf->Cell(6, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(68, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(25, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(30, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(15, 6, "", 1, 0, 'C', 1);
			$pdf->Cell(25, 6, "", 1, 1, 'C', 1);

			$i++;
			if ($i > 10) {
				$flg = false;
			} else {
				$flg = true;
			}
		} while ($flg);
	}

	if ($i % 2) {
		$pdf->SetFillColor(255, 255, 255);
		$i++;
	} else {
		$pdf->SetFillColor(204, 204, 255);
		$i++;
	}
}

$pdf->SetFontSize(9);
$pdf->Cell(164, 6, "10%�Ώۍ��v", 1, 0, 'R', 1);
$pdf->Cell(25, 6, number_format($total), 1, 1, 'R', 1);

if ($i % 2) {
	$pdf->SetFillColor(255, 255, 255);
	$i++;
} else {
	$pdf->SetFillColor(204, 204, 255);
	$i++;
}

$tax = $_REQUEST['money'] - $total;
$pdf->SetFontSize(9);
$pdf->Cell(164, 6, "�����(10%)", 1, 0, 'R', 1);
$pdf->Cell(25, 6, number_format($tax), 1, 1, 'R', 1);

if ($i % 2) {
	$pdf->SetFillColor(255, 255, 255);
	$i++;
} else {
	$pdf->SetFillColor(204, 204, 255);
	$i++;
}

$tax = $_REQUEST['money'] - $total;
$pdf->SetFontSize(11);
$pdf->Cell(164, 7, "���v�i����ō��j", 1, 0, 'R', 1);
$pdf->Cell(25, 7,  number_format($_REQUEST['money']), 1, 0, 'R', 1);


$pdf->SetFontSize(9);
$pdf->Ln(10);
$pdf->Write(1, "�����l");
$pdf->Ln(5);
$other = mb_convert_encoding($_REQUEST['other'], 'SJIS', 'UTF-8');
$pdf->MultiCell(200, 5, $other);
$pdf->SetFont(MINCHO, '', 8);

//�o�̓f�[�^��DB�ɓo�^

$edit['bill_num'] = $_REQUEST['billnumber'];
$edit['testid'] = $_REQUEST['tid'];
$edit['partner_id'] = $_REQUEST['pid'];
$edit['customer_id'] = $_REQUEST['cid'];
$edit['send_status'] = $_REQUEST['send_status'];
$edit['money_total'] = $_REQUEST['money'];
$edit['name'] = $_REQUEST['cus_name'];
$edit['title'] = $_REQUEST['billtitle'];
$edit['pay_date'] = sprintf(
	"%04d-%02d-%02d",
	$_REQUEST['pay_year'],
	$_REQUEST['pay_month'],
	$_REQUEST['pay_day']
);
$edit['pay_bank'] = $_REQUEST['bank'];
$edit['pay_num'] = $_REQUEST['bank_no'];
$edit['pay_name'] = $_REQUEST['kouza'];
$edit['post1'] = $_REQUEST['cus_post1'];
$edit['post2'] = $_REQUEST['cus_post2'];
$edit['address'] = $_REQUEST['cus_address'];
$edit['address2'] = $_REQUEST['cus_address2'];

$edit['busyo'] = mb_convert_encoding($cus_busyo, "UTF-8", "SJIS");
$edit['tanto'] = $_REQUEST['cus_tanto'];
$edit['registdate'] = sprintf("%02d-%02d-%02d", $_REQUEST['year'], $_REQUEST['month'], $_REQUEST['day']);
$edit['other'] = $_REQUEST['other'];
$edit['company_post1'] = $_REQUEST['post1'];
$edit['company_post2'] = $_REQUEST['post2'];
$edit['company_address'] = $_REQUEST['address'];
$edit['company_address2'] = $_REQUEST['address2'];

$edit['company_name'] = $_REQUEST['company'];
$edit['tekikaku'] = $_REQUEST['tekikaku'];
$edit['company_telnum'] = $_REQUEST['telnumber'];
$edit['download_status'] = $_REQUEST['download_status'];
$edit['bill_term_date_from'] = sprintf("%04d-%02d-%02d", $_REQUEST['year1'], $_REQUEST['month1'], $_REQUEST['day1']);
$edit['bill_term_date_to'] = sprintf("%04d-%02d-%02d", $_REQUEST['year2'], $_REQUEST['month2'], $_REQUEST['day2']);
$edit['syahan_sts'] = $_REQUEST['syahan'];
$edit['tantohan_sts'] = $_REQUEST['tantohan'];
$edit['post'] = mb_convert_encoding($post, "UTF-8", "SJIS");


$edit['bill'] = $_REQUEST['bill'];

$obj->setBillData($edit);

$filename = $_REQUEST['billnumber'] . ".pdf";

$pdf->Output($filename, 'D');

exit();
*/