<?PHP

$pdf->setSourceFile('./pdfTemplates/temp_pdf13.pdf');
$pdf->useTemplate($pdf->importPage(1));

$logo = "./img/pdflogo/pl_" . $user[0]['login_id'] . ".jpg";


$pdf->SetXY(24, 30);
if (file_exists($logo)) {
	$pdf->Image($logo, 10, 5, 50, 18);
} else {
	$pdf->Image("./images/welcome.jpg", 10, 5, 50, 25);
}

$pdf->SetFontSize(9);
$pdf->SetXY(20, 23);
$pdf->Write(0, $testdata['cusname']);

$pdf->SetFontSize(8);
$pdf->SetXY(28, 28.5);
$temp = explode(" ", $testdata['exam_dates']);
$temp = explode("-", $temp[0]);
$exam = $temp[0] . "/" . $temp[1] . "/" . $temp[2];
$pdf->Write(0, $exam);

$pdf->SetXY(65.5, 28.5);
$pdf->Write(0, $testdata['exam_id']);

$pdf->SetXY(105.5, 28.5);
$pdf->Write(0, $testdata['name']);

$age = getAgeCalcPDF13($testdata['birth'], $testdata['exam_dates']);

$pdf->SetXY(190.5, 28.5);
$pdf->Write(0, $age);

function getAgeCalcPDF13($birth, $regdate)
{
	$reg1 = explode(" ", $regdate);
	$reg = explode("-", $reg1[0]);

	$ty = $reg[0];
	$tm = $reg[1];
	$td = $reg[2];
	list($by, $bm, $bd) = explode('/', $birth);
	$age = $ty - $by;
	if ($tm * 100 + $td <= $bm * 100 + $bd) $age--;

	return $age;
}


	//自己感情モニタリング力
	$e_feel = $devlist['dev1'];

	//客観的自己評価力
	$e_aff = $devlist['dev2'];

	//自己肯定力
	$e_cus = $devlist['dev3'];

	//コントロール＆アチーブメント力
	$e_cntl = $devlist['dev4'];

	//ビジョン創出力
	$e_vi = $devlist['dev5'];

	//ポジティブ思考力
	$e_pos = $devlist['dev6'];

	//対人共感力
	$e_symp = $devlist['dev7'];

	//状況察知力
	$e_situ = $devlist['dev8'];

	//ホスピタリティ発揮力
	$e_hosp = $devlist['dev9'];

	//リーダーシップ発揮力
	$e_lead = $devlist['dev10'];

	//アサーション発揮力
	$e_ass = $devlist['dev11'];

	//集団適応力
	$e_adap = $devlist['dev12'];

	//流れやすさ(no1)
	$no1 = ($e_symp + $e_situ) / 2 - ($e_ass + $e_feel) / 2;

	//リーダーシップの空回り傾向(no2)
	//調整・交渉の空回り傾向(no3)
	//思いやりの空回り傾向(no4)
	if($e_cus < 50){
		$no2 = 0;
		$no3 = 0;
		$no4 = 0;
	}elseif($e_cus >= 50){
		$no2 = $e_lead - $e_aff;
		$no3 = $e_ass - $e_aff;
		$no4 = $e_hosp - $e_aff;
	}

	//行き詰まり感(no5)
	$no5 = $e_cntl - ($e_cus + $e_pos) / 2;

	//受身になりやすさ(no6)
	$no6 = $e_adap - $e_vi;

	//空気のよめなさ(no7)
	$no7 = ($e_adap) - ($e_situ + $e_symp) / 2;

	//朝礼暮改傾向(no8)
	$no8 = ($e_situ + $e_pos) / 2 - $e_symp;

	//無茶振り傾向(no9)
	$no9 = ($e_aff + $e_cus) / 2 - ($e_ass + $e_symp) / 2;

	$no_array = array(
				'1'=>$no1,
				'2'=>$no2,
				'3'=>$no3,
				'4'=>$no4,
				'5'=>$no5,
				'6'=>$no6,
				'7'=>$no7,
				'8'=>$no8,
				'9'=>$no9,
				);


	if($no1 >= 10){
		$lv3['1'] = $no1 - 10;
	}elseif($no1 >= 3){
		$lv2['1'] = $no1 - 3;
	}elseif($no1 < 3){
		$lv1['1'] = 3 - $no1;
	}

	if($no2 >= 5){
		$lv3['2'] = $no2 - 5;
	}elseif($no2 > 0){
		$lv2['2'] = $no2;
	}elseif($no2 <= 0){
		$lv1['2'] = 0 - $no2;
	}

	if($no3 >= 6){
		$lv3['3'] = $no3 - 6;
	}elseif($no3 > 0){
		$lv2['3'] = $no3;
	}elseif($no3 <= 0){
		$lv1['3'] = 0 - $no3;
	}

	if($no4 >= 1){
		$lv3['4'] = $no4 - 1;
	}elseif($no4 > 0){
		$lv2['4'] = $no4;
	}elseif($no4 <= 0){
		$lv1['4'] = 0 - $no4;
	}

	if($no5 >= 15){
		$lv3['5'] = $no5 - 15;
	}elseif($no5 >= 5){
		$lv2['5'] = $no5 - 5;
	}elseif($no5 < 5){
		$lv1['5'] = 5 - $no5;
	}

	if($no6 >= 15){
		$lv3['6'] = $no6 - 15;
	}elseif($no6 >= 7){
		$lv2['6'] = $no6 - 7;
	}elseif($no6 < 7){
		$lv1['6'] = 7 - $no6;
	}

	if($no7 >= 15){
		$lv3['7'] = $no7 - 15;
	}elseif($no7 >= 5){
		$lv2['7'] = $no7 - 5;
	}elseif($no7 < 5){
		$lv1['7'] = 5 - $no7;
	}

	if($no8 >= 15){
		$lv3['8'] = $no8 - 15;
	}elseif($no8 >= 5){
		$lv2['8'] = $no8 - 5;
	}elseif($no8 < 5){
		$lv1['8'] = 5 - $no8;
	}

	if($no9 >= 10){
		$lv3['9'] = $no9 - 10;
	}elseif($no9 >= 4){
		$lv2['9'] = $no9 - 4;
	}elseif($no9 < 4){
		$lv1['9'] = 4 - $no9;
	}

	//lvScrの要素が3つになるまで追加する
	$i = 0;
	if($lv3 != null){
		arsort($lv3);
		foreach($lv3 as $key=>$val){
			$lvScr[$i]['val'] = $val;
			$lvScr[$i]['key'] = $key;
			$lvScr[$i]['lv'] = 3;
			$lvScr[$i]['lvstr'] = "要注意";
			$lvScr[$i]['star'] = $obj->starPlace($key,3,$no_array);
			$lvScr[$i]['starKey'] = array_keys($lvScr[$i]['star']['3']);
			$i++;
			if($i >= 3){
				break;
			}
		}
	}

	if($lv2 != null && $i < 3){
		arsort($lv2);
		foreach($lv2 as $key=>$val){
			if($i >= 3){
				break;
			}else{
				$lvScr[$i]['val'] = $val;
				$lvScr[$i]['key'] = $key;
				$lvScr[$i]['lv'] = 2;
				$lvScr[$i]['lvstr'] = "注意";
				$lvScr[$i]['star'] = $obj->starPlace($key,2,$no_array);
				$lvScr[$i]['starKey'] = array_keys($lvScr[$i]['star']['2']);
				$i++;
			}
		}
	}

	//「レベル」、「星の出力位置」の順でソートする
	if($lvScr != null){

		foreach($lvScr as $key => $val){
			$keys1[$key] = $val['lv'];
			$keys2[$key] = $val['starKey'];
		}

		array_multisort($keys1,SORT_DESC,$keys2,SORT_DESC,$lvScr);

	}

	if($lv1 != null && $i < 3){
		arsort($lv1);
		foreach($lv1 as $key=>$val){
			if($i >= 3){
				break;
			}else{
				$lvScr[$i]['val'] = $val;
				$lvScr[$i]['key'] = $key;
				$lvScr[$i]['lv'] = 1;
				$lvScr[$i]['lvstr'] = "問題なし";
				$i++;
			}
		}
	}

	$key1 = $lvScr[0]['key'];
	$lv1  = $lvScr[0]['lv'];


		if($lvScr[0]['lv'] != 1){
		if($lvScr[0]['key'] == 2){
			$substr1 = "※管理職は要注意";
		}elseif($lvScr[0]['key'] == 7){
			$substr1 = "※新卒・若手社員採用の場合は注意";
		}elseif($lvScr[0]['key'] == 8){
			$substr1 = "※管理職採用の場合は注意";
		}elseif($lvScr[0]['key'] == 9){
			$substr1 = "※管理職採用の場合は注意";
		}else{
			$substr1 = "";
		}
	}else{
		$substr1 = "";
	}

	$pdf->SetFontSize(11);
	$pdf->SetXY(15.5, 34.5);
	$pdf->Write(0, $array_comment[$key1][$lv1]['naiyo'].$sutstr1);
	$pdf->SetXY(7.5, 57.0);

	$pdf->MultiCell(55,4,$lvScr[1]['lvstr'],0,'C');

	$stars = $obj->starPlace($key1,$lv1,$no_array);

	$star11 = "";
	if($stars['1']['1']){$star11 ="★";}
	$star12 = "";
	if($stars['1']['2']){$star12 = "★";}
	$star13 = "";
	if($stars['1']['3']){$star13 = "★";}

	$star21 = "";
	if($stars['2']['1']){$star21 ="★";}
	$star22 = "";
	if($stars['2']['2']){$star22 = "★";}
	$star23 = "";
	if($stars['2']['3']){$star23 = "★";}

	$star31 = "";
	if($stars['3']['1']){$star31 ="★";}
	$star32 = "";
	if($stars['3']['2']){$star32 = "★";}
	$star33 = "";
	if($stars['3']['3']){$star33 = "★";}
	

	$pdf->SetFontSize(14);

	$pdf->SetXY(65.5, 55.9);
	$pdf->Cell(15,0,$star11,"0","0","C");
	$pdf->SetXY(81.0, 55.9);
	$pdf->Cell(15,0,$star12,"0","0","C");
	$pdf->SetXY(96.3, 55.9);
	$pdf->Cell(15,0,$star13,"0","0","C");
	
	$pdf->SetXY(112.5, 55.9);
	$pdf->Cell(15,0,$star21,"0","0","C");
	$pdf->SetXY(127.0, 55.9);
	$pdf->Cell(14,0,$star22,"0","0","C");
	$pdf->SetXY(142.3, 55.9);
	$pdf->Cell(15,0,$star23,"0","0","C");

	$pdf->SetXY(158.2, 55.9);
	$pdf->Cell(15,0,$star31,"0","0","C");
	$pdf->SetXY(174.0, 55.9);
	$pdf->Cell(14,0,$star32,"0","0","C");
	$pdf->SetXY(188.7, 55.9);
	$pdf->Cell(15,0,$star33,"0","0","C");

	$pdf->SetFontSize(8);

	$pdf->SetXY(8.5,66.5);
	$pdf->MultiCell(54,1,$array_comment[$key1][$lv1]['setsumei'],"0","0");

	$pdf->SetXY(66.5,66.5);
	$pdf->MultiCell(140,1,$array_comment[$key1][$lv1]['mensetsu'],"0","0");

	$pdf->SetXY(66.5,87.5);
	$pdf->MultiCell(140,1,$array_comment[$key1][$lv1]['shitsumon'],"0","0");


	$key2 = $lvScr[1]['key'];
	$lv2  = $lvScr[1]['lv'];

	if($lvScr[1]['lv'] != 1){
		if($lvScr[1]['key'] == 2){
			$substr2 = "※管理職は要注意";
		}elseif($lvScr[1]['key'] == 7){
			$substr2 = "※新卒・若手社員採用の場合は注意";
		}elseif($lvScr[1]['key'] == 8){
			$substr2 = "※管理職採用の場合は注意";
		}elseif($lvScr[1]['key'] == 9){
			$substr2 = "※管理職採用の場合は注意";
		}else{
			$substr2 = "";
		}
	}else{
		$substr2 = "";
	}


	$pdf->SetFontSize(11);
	$pdf->SetXY(15.5, 114.5);
	$pdf->Write(0, $array_comment[$key2][$lv2]['naiyo'].$sutstr2);

	$pdf->SetXY(7.5, 137.4);
	$pdf->MultiCell(55,4,$lvScr[1]['lvstr'],0,'C');

	//星の出力位置
	$stars = $obj->starPlace($key2,$lv2,$no_array);

	$star21 = "";
	if($stars['2']['1']){$star21 ="★";}
	$star22 = "";
	if($stars['2']['2']){$star22 = "★";}
	$star23 = "";
	if($stars['2']['3']){$star23 = "★";}

	$star31 = "";
	if($stars['3']['1']){$star31 ="★";}
	$star32 = "";
	if($stars['3']['2']){$star32 = "★";}
	$star33 = "";
	if($stars['3']['3']){$star33 = "★";}
	
	$pdf->SetFontSize(14);

	$pdf->SetXY(65.5, 136.2);
	$pdf->Cell(15,0,"","0","0","C");
	$pdf->SetXY(81.0, 136.2);
	$pdf->Cell(15,0,"","0","0","C");
	$pdf->SetXY(96.3, 136.2);
	$pdf->Cell(15,0,"","0","0","C");
	
	$pdf->SetXY(112.5, 136.2);
	$pdf->Cell(15,0,$star21,"0","0","C");
	$pdf->SetXY(127.0, 136.2);
	$pdf->Cell(14,0,$star22,"0","0","C");
	$pdf->SetXY(142.3, 136.2);
	$pdf->Cell(15,0,$star23,"0","0","C");

	$pdf->SetXY(158.2, 136.2);
	$pdf->Cell(15,0,$star31,"0","0","C");
	$pdf->SetXY(174.0, 136.2);
	$pdf->Cell(14,0,$star32,"0","0","C");
	$pdf->SetXY(188.7, 136.2);
	$pdf->Cell(15,0,$star33,"0","0","C");

	$pdf->SetFontSize(8);
	$pdf->SetXY(8.5,147.1);
	$pdf->MultiCell(54,1,$array_comment[$key2][$lv2]['setsumei'],"0","0");

	$pdf->SetXY(66.5,147.1);
	$pdf->MultiCell(140,1,$array_comment[$key2][$lv2]['mensetsu'],"0","0");

	$pdf->SetXY(66.5,167.1);
	$pdf->MultiCell(140,1,$array_comment[$key2][$lv2]['shitsumon'],"0","0");

	$key3 = $lvScr[2]['key'];
	$lv3  = $lvScr[2]['lv'];

	if($lvScr[2]['lv'] != 1){
		if($lvScr[2]['key'] == 2){
			$substr3 = "※管理職は要注意";
		}elseif($lvScr[2]['key'] == 7){
			$substr3 = "※新卒・若手社員採用の場合は注意";
		}elseif($lvScr[2]['key'] == 8){
			$substr3 = "※管理職採用の場合は注意";
		}elseif($lvScr[2]['key'] == 9){
			$substr3 = "※管理職採用の場合は注意";
		}else{
			$substr3 = "";
		}
	}else{
		$substr3 = "";
	}

	$pdf->SetFontSize(11);
	$pdf->SetXY(15.5, 195.1);
	$pdf->Write("5",$str.$array_comment[$key3][$lv3]['naiyo'].$sutstr3);

	$pdf->SetXY(7.5, 217.0);
	$pdf->MultiCell(55,4,$lvScr[2]['lvstr'],0,'C');

	//星の出力位置
	$stars = $obj->starPlace($key3,$lv3,$no_array);

	$star21 = "";
	if($stars['2']['1']){$star21 ="★";}
	$star22 = "";
	if($stars['2']['2']){$star22 = "★";}
	$star23 = "";
	if($stars['2']['3']){$star23 = "★";}

	$star31 = "";
	if($stars['3']['1']){$star31 ="★";}
	$star32 = "";
	if($stars['3']['2']){$star32 = "★";}
	$star33 = "";
	if($stars['3']['3']){$star33 = "★";}

	$pdf->SetFontSize(14);

	$pdf->SetXY(65.5, 217.0);
	$pdf->Cell(15,0,"","0","0","C");
	$pdf->SetXY(81.0, 217.0);
	$pdf->Cell(15,0,"","0","0","C");
	$pdf->SetXY(96.3, 217.0);
	$pdf->Cell(15,0,"","0","0","C");
	
	$pdf->SetXY(112.5, 217.0);
	$pdf->Cell(15,0,$star21,"0","0","C");
	$pdf->SetXY(127.0, 217.0);
	$pdf->Cell(14,0,$star22,"0","0","C");
	$pdf->SetXY(142.3, 217.0);
	$pdf->Cell(15,0,$star23,"0","0","C");

	$pdf->SetXY(158.2, 217.0);
	$pdf->Cell(15,0,$star31,"0","0","C");
	$pdf->SetXY(174.0, 217.0);
	$pdf->Cell(14,0,$star32,"0","0","C");
	$pdf->SetXY(188.7, 217.0);
	$pdf->Cell(15,0,$star33,"0","0","C");

	$pdf->SetFontSize(8);
	$pdf->SetXY(8.5,227.1);
	$pdf->MultiCell(54,1,$array_comment[$key3][$lv3]['setsumei'],"0","0");

	$pdf->SetXY(66.5,227.1);
	$pdf->MultiCell(140,1,$array_comment[$key3][$lv3]['mensetsu'],"0","0");

	$pdf->SetXY(66.5,247.1);
	$pdf->MultiCell(140,1,$array_comment[$key3][$lv3]['shitsumon'],"0","0");


?>