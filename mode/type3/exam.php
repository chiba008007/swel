<?PHP
//-------------------------------------------
//検査申込
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_exam.php");
require_once("./lib/PHPMailer/class.phpmailer.php");

$obj = new examMethod();

define('FPDF_FONTPATH','./font/');
require('./mbfpdf.php');
$pdf = new MBFPDF('P','mm','A4');



$where[ 'customer_id' ] = $id;
$where[ 'temp_flg'    ] = 0;
$where[ 'test_id'     ] = 0;
$sel = $obj->getSelect($where);

global $array_pdf_money;

if($_REQUEST[ 'application' ] == 2 && $_REQUEST[ 'stid' ]){
	$where[ 'stid' ] = $_REQUEST[ 'stid' ];
	$pdfmny = $obj->getPdfMoney($where);
}

//金額変更用データ取得
$chg = array();
$chg[ 'ptid' ] = $ptid;
$changes = $obj->getChangeMoney($chg);
//var_dump($changes);
//金額表示
if($_REQUEST[ 'flg' ] == "money"){
	
	if($_REQUEST[ 'application' ] == 1){
	//	$money = $a_test_money[ '12' ];
	//1000円固定の仕様
	$money = 1000;
	//金額変更用のデータがあればそちらを利用(baj固定の為１を指定)
	if($changes[1][ 'dispmoney' ]){
		$money = $changes[1][ 'dispmoney' ];
	}
	}elseif($_REQUEST[ 'application' ] == 2){
		$where[ 'stid' ] = $_REQUEST[ 'stid' ];
		$mny = $obj->getSelectMoney($where);
		foreach($mny as $key=>$val){
			$money += $a_test_money[$val[ 'type' ]];
			$type = $val[ 'type' ];
		}
		//1000円固定の仕様
		$money = 1000;
		//金額変更用のデータがあればそちらを利用
		if($changes[$type][ 'dispmoney' ]){
			$money = $changes[$type][ 'dispmoney' ];
		}

	}
	echo $money;
	exit();
}



$array_application = array(
						1=>"新規申込"
						,2=>"追加申込"
						);

if($_REQUEST[ 'exam2' ]){
	if(!$_REQUEST[ 'application' ]){
		$errmsg = "検査申込形式を選択してください。";
	}
	
	if($errmsg){
		$html = "exam";
	}else{
		$html = "exam2";
	}
}
if($_REQUEST[ 'exam3' ]){
	if(!$_REQUEST[ 'addcount' ] || !preg_match("/^[0-9]+$/",$_REQUEST[ 'addcount' ])){
		$errmsg = "申込件数は半角数字で入力してください。";
	}
	if($_REQUEST[ 'application' ] == 1){
		if(!$_REQUEST[ 'examname' ]){
			$errmsg = "検査名を入力してください。";
		}
	}
	
	if($errmsg){
		$html = "exam2";
	}else{
		//料金の計算
		if($_REQUEST[ 'application' ] == 1){
			$money = $a_test_money[ '12' ];
		}elseif($_REQUEST[ 'application' ] == 2){
			$mwhere = array();
			$mwhere[ 'stid' ] = $_REQUEST[ 'stid' ];
			$mny = $obj->getSelectMoney($mwhere);
			foreach($mny as $key=>$val){
				$money += $a_test_money[$val[ 'type' ]];
				$type = $val[ 'type' ];
			}
		}
		//$money = $money*$_REQUEST[ 'addcount' ]+$pdfmny['mny']*$_REQUEST[ 'addcount' ];

		if($_REQUEST[ 'application' ] == 1){
			$money = (1000*$_REQUEST[ 'addcount' ]);
			if($changes[1][ 'dispmoney' ]){
				$money = $changes[1][ 'dispmoney' ]*$_REQUEST[ 'addcount' ];
			}
		}elseif($_REQUEST[ 'application' ] == 2){
			$money = (1000*$_REQUEST[ 'addcount' ]);
			//金額変更用のデータがあればそちらを利用
			if($changes[$type][ 'dispmoney' ]){
				$money = $changes[$type][ 'dispmoney' ]*$_REQUEST[ 'addcount' ];
			}
		}
		$html = "exam3";
	}
}
if($_REQUEST[ 'back2' ]){
	$html = "exam2";
}
if($_REQUEST[ 'exam4' ]){
	//データ登録
/*
	var_dump($ptid);
	var_dump($id);
	var_dump($_REQUEST);
*/
	$tanka = 1000;
	if($_REQUEST[ 'application' ] == 1){
		$money = $tanka*$_REQUEST[ 'addcount' ];
		if($changes[1][ 'dispmoney' ]){
			$money = $changes[1][ 'dispmoney' ];
		}
	}elseif($_REQUEST[ 'application' ] == 2){
		$mwhere = array();
		$mwhere[ 'stid' ] = $_REQUEST[ 'stid' ];
		$mny = $obj->getSelectMoney($mwhere);
		foreach($mny as $key=>$val){
			$type = $val[ 'type' ];
		}
		$money = $tanka*$_REQUEST[ 'addcount' ];
		if($changes[$type][ 'dispmoney' ]){
			$money = $changes[$type][ 'dispmoney' ];
		}
	}
	$total = $money*$a_tax;


	//顧客データ取得
	$where[ 'id' ] = $id;
	$cdata = $db->getUser($where);
	//パートナーデータ取得
	
	$where[ 'id' ] = $cdata[0][ 'partner_id' ];
	$pdata = $db->getUser($where);

	$cus_company_post = $cdata[0][ 'post1' ]."-".$cdata[0][ 'post2' ];
	$cus_company_address = $cdata[0][ 'prefecture' ].$cdata[0][ 'address1' ];
	$cus_company_address2 = $cdata[0][ 'address2' ];
	$cus_company_name = $cdata[0][ 'name' ];
	$cus_company_tel = $cdata[0][ 'tel' ];
	
	$set = array();
	$set[ 'pid'  ] = $ptid;
	$set[ 'cid'  ] = $id;
	$set[ 'type' ] = $_REQUEST[ 'application' ];
	$set[ 'tid'  ] = $_REQUEST[ 'stid' ];
	$set[ 'examname'  ] = $_REQUEST[ 'examname' ];
	$set[ 'addcount' ] = $_REQUEST[ 'addcount' ];
	$set[ 'status' ] = 0;
	$table = "t_application";
	$db->setUserData($table,$set);

	$application_id  = $db->lastid;
	//注文番号取得
	$order_no = $obj->getOrderNo();
	$order_no = sprintf("%06d",$order_no);
	//料金の計算
//	if($_REQUEST[ 'application' ] == 1){
		//$money = $a_test_money[ '12' ];
		if($_REQUEST[ 'application' ] == 2 && $changes[$type][ 'dispname' ]){
			$testlist[0][ 'name' ] = $changes[$type][ 'dispname' ];
		}else{
			$testlist[0][ 'name' ] = "行動価値検査";
		}
		$testlist[0][ 'meigara' ] = "BAJ";
		$testlist[0][ 'suryo'  ] = $_REQUEST[ 'addcount' ];
		//$testlist[0][ 'price'  ] = $a_test_money[ '12' ];
		//$testlist[0][ 'total'  ] = $a_test_money[ '12' ] * $_REQUEST[ 'addcount' ];
		$testlist[0][ 'price'  ] = $tanka;
		$testlist[0][ 'total'  ] = $money;

/*
	}elseif($_REQUEST[ 'application' ] == 2){
		$where[ 'stid' ] = $_REQUEST[ 'stid' ];
		$mny = $obj->getSelectMoney($where);
		$i = 0;
		foreach($mny as $key=>$val){
			$money += $a_test_money[$val[ 'type' ]];
			
			$testlist[$i][ 'name'    ] = $a_test_JP[ $val[ 'type' ]];
			$testlist[$i][ 'meigara' ] = $a_test_type[ $val[ 'type' ]];
			$testlist[$i][ 'suryo'  ] = $_REQUEST[ 'addcount' ];
			$testlist[$i][ 'price'  ] = $a_test_money[ $val[ 'type' ] ];
			$testlist[$i][ 'total'  ] = $a_test_money[ $val[ 'type' ] ] * $_REQUEST[ 'addcount' ];
			$i++;
		}
	}
*/
//	$money = ($money*$a_tax)+($pdfmny['mny']*$a_tax);
	

//とりあえずPDFの処理はいらないらしい
/*
	$ex = explode(":",$pdfmny[ 'pdf' ]);
	
	foreach($ex as $key=>$val){
		$testlist[$i][ 'name'    ] = $array_pdf[ $val];
		$testlist[$i][ 'meigara' ] = "pdf";
		$testlist[$i][ 'suryo'   ] = $_REQUEST[ 'addcount' ];
		$testlist[$i][ 'price'   ] = $array_pdf_money[ $val ];
		$testlist[$i][ 'total'   ] = $array_pdf_money[ $val ] * $_REQUEST[ 'addcount' ];
		$i++;
	}
*/
	
	
	//PDF作成---------------------------------------
	//PDF保存
	$pdf->AddPage();
	$pdf->AddMBFont(MINCHO ,'SJIS');
	$pdf->SetFont(MINCHO, '', 8);
	//右へ移動
	$x = $pdf->getX();
	$y = $pdf->getY();

	$pdf->SetXY(90.0, 10.0);
	$pdf->SetFontSize(18);
	$str = mb_convert_encoding("注文書控え","sjis-win","utf-8");
	$pdf->Write(1,$str);

	$pdf->SetFontSize(12);
	$pdf->SetXY(10.0, 30.0);
	$str = mb_convert_encoding($a_company[0]."御中","sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->Line(10.0, 34.0, 90.0, 34.0);

	$pdf->SetFontSize(9);
	$pdf->SetXY(10.0, 36.0);
	$str = mb_convert_encoding("下記の通り注文致します","sjis","utf-8");
	$pdf->Write(1,$str);

	$pdf->SetFontSize(16);
	$pdf->SetXY(10.0, 50.0);
	$str = mb_convert_encoding("注文金額：".number_format($total)."円","sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->Line(10.0, 54.0, 130.0, 54.0);
	
	$pdf->SetFontSize(9);
	$pdf->SetXY(80.0, 50.0);
	$str = mb_convert_encoding("税込","sjis-win","utf-8");
	$pdf->Write(1,$str);

	
	$pdf->SetFontSize(12);
	$pdf->SetXY(10.0, 58.0);

	if($_REQUEST[ 'application' ] == 1){
		$str = "「".$_REQUEST[ 'examname' ]."」へのID登録費用";
	}else{
		$str = "「".$sel[$_REQUEST[ 'stid' ]][ 'name' ]."」へのID追加費用";
	}
	$subject = $str;
	$str = mb_convert_encoding("件　名：".$str,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->Line(10.0, 62.0, 130.0, 62.0);
	
	
	$pdf->SetXY(10.0, 66.0);
	$str = date('Y年m月d日', mktime(0, 0, 0, date('m') + 2, 0, date('Y')));
	$str = mb_convert_encoding("支払条件：".$str,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->Line(10.0, 70.0, 130.0, 70.0);

	$pdf->SetXY(10.0, 74.0);
	$str = date('Y年m月d日', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));
	$str = mb_convert_encoding("納入期限：".$str,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->Line(10.0, 78.0, 130.0, 78.0);


/*
	$pdf->SetFontSize(9);
	$pdf->SetXY(160.0, 25.0);
	$str = mb_convert_encoding("注文No ".$order_no,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->Line(160.0, 28.0, 200.0, 28.0);
*/
	$pdf->SetFontSize(8);
	$pdf->SetXY(174.0, 30.0);
	$y = date('Y')-1988;
	$m = date("m");
	$d = date("d");
	$str = mb_convert_encoding("平成".$y."年".$m."月".$d."日","sjis-win","utf-8");
	$pdf->Write(1,$str);

	$pdf->SetXY(150.0, 45.0);
	$str = mb_convert_encoding("〒".$cus_company_post,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->SetXY(150.0, 49.0);
	$str = mb_convert_encoding($cus_company_address,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->SetXY(150.0, 52.0);
	$str = mb_convert_encoding($cus_company_address2,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->SetXY(150.0, 56.0);
	$str = mb_convert_encoding($cus_company_name,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	$pdf->SetXY(150.0, 60.0);
	$str = mb_convert_encoding("TEL ".$cus_company_tel,"sjis-win","utf-8");
	$pdf->Write(1,$str);
	

	$pdf->SetXY(10,90);

	$pdf->SetFontSize(8);
	$pdf->SetFillColor(204, 204, 255);
	$pdf->Cell( 6, 6, "No"  , 1, 0, 'C', 1);
	$pdf->Cell(68, 6, mb_convert_encoding("品名","sjis","utf-8"), 1, 0, 'C', 1);
	$pdf->Cell(25, 6, mb_convert_encoding("銘柄","sjis","utf-8"), 1, 0, 'C', 1);
	$pdf->Cell(30, 6, mb_convert_encoding("規格","sjis","utf-8"), 1, 0, 'C', 1);
	$pdf->Cell(10, 6, mb_convert_encoding("数量","sjis","utf-8"), 1, 0, 'C', 1);
	$pdf->Cell(10, 6, mb_convert_encoding("単位","sjis","utf-8"), 1, 0, 'C', 1);
	$pdf->Cell(15, 6, mb_convert_encoding("単価","sjis","utf-8"), 1, 0, 'C', 1);
	$pdf->Cell(25, 6, mb_convert_encoding("金額","sjis","utf-8"), 1, 1, 'C', 1);
	
	$pdf->SetFillColor(255, 255, 255);
	for($i=0;$i<25;$i++){
		$no = $i+1;
		$pdf->Cell( 6, 6, $no, 1, 0, 'L', 1);
		$pdf->Cell(68, 6, mb_convert_encoding($testlist[$i][ 'name' ],"sjis","utf-8"), 1, 0, 'C', 1);
		$pdf->Cell(25, 6, mb_convert_encoding($testlist[$i][ 'meigara' ],"sjis","utf-8"), 1, 0, 'C', 1);
		$pdf->Cell(30, 6, mb_convert_encoding("","sjis","utf-8"), 1, 0, 'C', 1);
		$pdf->Cell(10, 6, mb_convert_encoding($testlist[$i][ 'suryo' ],"sjis","utf-8"), 1, 0, 'C', 1);
		if($testlist[$i][ 'name' ]){
			$pdf->Cell(10, 6, mb_convert_encoding("件","sjis","utf-8"), 1, 0, 'C', 1);
		}else{
			$pdf->Cell(10, 6, mb_convert_encoding("","sjis","utf-8"), 1, 0, 'C', 1);
		}
		$pdf->Cell(15, 6, mb_convert_encoding($testlist[$i][ 'price' ],"sjis","utf-8"), 1, 0, 'C', 1);
		if($testlist[$i][ 'name' ]){
			$pdf->Cell(25, 6, mb_convert_encoding(number_format($testlist[$i][ 'total' ])."","sjis","utf-8"), 1, 1, 'C', 1);
		}else{
			$pdf->Cell(25, 6, mb_convert_encoding("","sjis","utf-8"), 1, 1, 'C', 1);
		}
		$totals += $testlist[$i][ 'total' ];
	}

	$pdf->Cell( 6, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(68, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(25, 6, mb_convert_encoding("小計","sjis","utf-8"), 1, 0, 'C', 1);
	$pdf->Cell(30, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(15, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(25, 6, mb_convert_encoding(number_format($totals),"sjis","utf-8"), 1, 1, 'C', 1);
	$pdf->Cell( 6, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(68, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(25, 6, mb_convert_encoding("消費税","sjis","utf-8"), 1, 0, 'C', 1);
	$pdf->Cell(30, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(10, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(15, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(25, 6, mb_convert_encoding(number_format($totals*0.08),"sjis","utf-8"), 1, 1, 'C', 1);


	$dirpdf = D_PATH_HOME."pdfDownload/order".$id."/";
	if(!file_exists($dirpdf)){
		mkdir($dirpdf);
	}
	if($_REQUEST[ 'application' ]){
		$filename = $dirpdf."order_".$_REQUEST[ 'application' ]."_".date('Ymd').".pdf";
	}else{
		$filename = $dirpdf."order_".$_REQUEST[ 'application' ]."_".$_REQUEST[ 'stid' ]."_".date('Ymd').".pdf";
	}
	//ファイルとして保存
	$pdf->Output($filename, 'F');
	//ダウンロード
//	$pdf->Output($filename, 'D');
	//作成データ登録
	$table = "t_order";
	$set = array();
	$set[ 'order_no'            ] = $order_no;
	$set[ 'money'               ] = $money;
	$set[ 'subject'             ] = $subject;
	$set[ 'date'                ] = date("Y-m-d");
	$set[ 'cus_company_post'    ] = $cus_company_post;
	$set[ 'cus_company_address' ] = $cus_company_address;
	$set[ 'cus_company_name'    ] = $cus_company_name;
	$set[ 'cus_company_tel'     ] = $cus_company_tel;
	$set[ 'application_id'      ] = $application_id;
	$set[ 'order_data'          ] = json_encode($testlist);
	$set[ 'pdfname'             ] = $filename;
	$set[ 'regist_ts'           ] = date('Y-m-d H:i:s');

	$db->setUserData($table,$set);
	//メール配信
	mb_language("japanese");
	mb_internal_encoding("UTF-8");

	//日本語添付メールを送る
	$msubject = "検査注文の件"; //題名
	$content=
$cdata[0][ 'name' ]."
".$cdata[0][ 'rep_name' ]."様


".$pdata[0][ 'name' ]."
".$pdata[0][ 'rep_name' ]."です


このたびは検査ご注文いただきましてありがとうございました。
つきましては下記のとおりご依頼いただきましたので、検査追加処理をさせていただきます。
追加処理後、再度ご連絡させていただきますので、少々お待ちください。

***********************************************
品名:".$subject." 
数量:".$_REQUEST[ 'addcount' ]."件
単価:".number_format($money)."円  
*********************************************** 
なお添付のＰＤＦに注文内容を記載させていただきますので、合わせてご確認よろしくお願いいたします。



 ------------------------------------------------------ 
".$pdata[0][ 'name' ]."
".$pdata[0][ 'rep_name' ]."
〒".$pdata[0][ 'post1' ]."-".$pdata[0][ 'post2' ]."
".$pdata[0][ 'prefecture' ]."".$pdata[0][ 'address1' ]."".$pdata[0][ 'address2' ]."
 TEL：".$pdata[0][ 'tel' ]." FAX：".$pdata[0][ 'fax' ]."
 ------------------------------------------------------ 
";
	$from = D_FROM_MAIL; //送り主
	$attachfile = $filename; //添付ファイルパス
	
	$mail = new PHPMailer();
	$mailto = $cdata[0][ 'rep_email' ];
	$fromname = "サポートセンター";
	$mail->CharSet = "iso-2022-jp";
	$mail->Encoding = "7bit";
	$mail->AddAddress($mailto);
	$mail->addBcc($pdata[0][ 'rep_email' ]);
	$mail->From = D_FROM_MAIL;
	$mail->FromName = mb_encode_mimeheader($fromname);
	$mail->Subject = mb_encode_mimeheader($msubject,'ISO-2022-JP');
	$mail->Body  = mb_convert_encoding($content,"ISO-2022-JP","UTF-8");


	if(file_exists($attachfile)){
		$mail->AddAttachment($attachfile);
	}

	$mailbcc = D_FROM_MAIL;
	//BCCに登録
	$mail->addBcc($mailbcc);
	$mail->Send(); //メール送信
	
	
	$html = "examFin";
}
?>