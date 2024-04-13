<?PHP
	//----------------------------------------------
	//総合評価のレベル
	//----------------------------------------------
	//行動価値適合度
	$sc = round($testdata[ 'score' ],1);
	//総合
	$sougoLv = 2;
	if($sc >=60 && $sougo >=60){
		$sougoLv = 5;
	}elseif($sc >=50 && $sougo >=50){
		$sougoLv = 4;
	}elseif($sc >=40 && $sougo >=40){
		$sougoLv = 3;
	}elseif($sc < 40 && $sougo < 40){
		$sougoLv = 1;
	}


	//感情能力LV
	if($sougo >=65){
		$imageLv = 5;
	}else
	if($sougo >=55){
		$imageLv = 4;
	}else
	if($sougo >=45){
		$imageLv = 3;
	}else
	if($sougo >=35){
		$imageLv = 2;
	}else{
		$imageLv = 1;
	}

	//行動能力適合度LV
	
	if($testdata[ 'score' ] >=65){
		$mvLv = 5;
	}else
	if($testdata[ 'score' ] >=55){
		$mvLv = 4;
	}else
	if($testdata[ 'score' ] >=45){
		$mvLv = 3;
	}else
	if($testdata[ 'score' ] >=35){
		$mvLv = 2;
	}else{
		$mvLv = 1;
	}


	$intell = ($iqdata[0][ 'language_score' ]+$iqdata[0][ 'math_score' ])/2;
	$intell = sprintf("%2.1f",$intell);

	//感情能力LV
	if($intell >=65){
		$intellLv = 5;
	}else
	if($intell >=55){
		$intellLv = 4;
	}else
	if($intell >=45){
		$intellLv = 3;
	}else
	if($intell >=35){
		$intellLv = 2;
	}else{
		$intellLv = 1;
	}

	$mathmatic = ($iqdata[0][ 'math_score' ]+$iqdata[0][ 'math_score' ])/2;
	$mathmatic = sprintf("%2.1f",$mathmatic);

	//感情能力LV
	if($mathmatic >=65){
		$mathLv = 5;
	}else
	if($mathmatic >=55){
		$mathLv = 4;
	}else
	if($mathmatic >=45){
		$mathLv = 3;
	}else
	if($mathmatic >=35){
		$mathLv = 2;
	}else{
		$mathLv = 1;
	}


	//----------------------------------------------
	//棒グラフ画像作成
	//----------------------------------------------
	//感情能力
	$img1 = "./images/pdf/22_1img".$id.".jpg";
	$st_score = $sougo;
	$st_score2 = substr($st_score, 1, 4) * 9.8;
	if($st_score >= 80){
		$wid = 552;
	}elseif($st_score >= 70){
		$wid = $st_score2 + 461.3;
	}elseif($st_score >= 60){
		$wid = $st_score2 + 370.8;
	}elseif($st_score >= 50){
		$wid = $st_score2 + 279.75;
	}elseif($st_score >= 40){
		$wid = $st_score2 + 188.8;
	}elseif($st_score >= 30){
		$wid = $st_score + 68.8;
	}elseif($st_score >= 20){
		$wid = $st_score2 + 1;
	}else{
		$wid = 1;
	}
	
	$im        = imagecreatetruecolor($wid, 10);
	$img_color = imagecolorallocate($im, 1, 101, 255);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img1);
	imagedestroy($im);
	
	//行動価値適合度
	$img2 = "./images/pdf/22_2img".$id.".jpg";
	$st_score = $testdata[ 'score' ];
	$st_score2 = substr($st_score, 1, 4) * 9.8;
	if($st_score >= 80){
		$wid = 552;
	}elseif($st_score >= 70){
		$wid = $st_score2 + 461.3;
	}elseif($st_score >= 60){
		$wid = $st_score2 + 370.8;
	}elseif($st_score >= 50){
		$wid = $st_score2 + 279.75;
	}elseif($st_score >= 40){
		$wid = $st_score2 + 188.8;
	}elseif($st_score >= 30){
		$wid = $st_score + 68.8;
	}elseif($st_score >= 20){
		$wid = $st_score2 + 1;
	}else{
		$wid = 1;
	}
	
	$im        = imagecreatetruecolor($wid, 10);
	$img_color = imagecolorallocate($im, 1, 101, 255);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img2);
	imagedestroy($im);


	//知的能力総合
	$img3 = "./images/pdf/22_3img".$id.".jpg";
	$st_score = $intell;
	$st_score2 = substr($st_score, 1, 4) * 9.8;
	if($st_score >= 80){
		$wid = 552;
	}elseif($st_score >= 70){
		$wid = $st_score2 + 461.3;
	}elseif($st_score >= 60){
		$wid = $st_score2 + 370.8;
	}elseif($st_score >= 50){
		$wid = $st_score2 + 279.75;
	}elseif($st_score >= 40){
		$wid = $st_score2 + 188.8;
	}elseif($st_score >= 30){
		$wid = $st_score + 68.8;
	}elseif($st_score >= 20){
		$wid = $st_score2 + 1;
	}else{
		$wid = 1;
	}
	
	$im        = imagecreatetruecolor($wid, 10);
	$img_color = imagecolorallocate($im, 1, 101, 255);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img3);
	imagedestroy($im);


	//-----------------
	//知的能力
	//-----------------
	//1.言語・論理
	$img1_1 = "./images/pdf/lang_img".$id.".jpg";
	$st_score = $iqdata[0][ 'language_score' ];
	$st_score2 = substr($st_score, 1, 4) * 9.8;
	if($st_score >= 80){
		$wid = 552;
	}elseif($st_score >= 70){
		$wid = $st_score2 + 461.3;
	}elseif($st_score >= 60){
		$wid = $st_score2 + 370.8;
	}elseif($st_score >= 50){
		$wid = $st_score2 + 279.75;
	}elseif($st_score >= 40){
		$wid = $st_score2 + 188.8;
	}elseif($st_score >= 30){
		$wid = $st_score + 68.8;
	}elseif($st_score >= 20){
		$wid = $st_score2 + 1;
	}else{
		$wid = 1;
	}
	
	$im        = imagecreatetruecolor($wid, 15);
	$img_color = imagecolorallocate($im, 255, 0, 51);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, 13, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img1_1);
	imagedestroy($im);


	//2.数理・推論
	$img1_2 = "./images/pdf/m_img".$id.".jpg";
	$st_score = $iqdata[0][ 'math_score' ];
	$st_score2 = substr($st_score, 1, 4) * 9.8;
	if($st_score >= 80){
		$wid = 552;
	}elseif($st_score >= 70){
		$wid = $st_score2 + 461.3;
	}elseif($st_score >= 60){
		$wid = $st_score2 + 370.8;
	}elseif($st_score >= 50){
		$wid = $st_score2 + 279.75;
	}elseif($st_score >= 40){
		$wid = $st_score2 + 188.8;
	}elseif($st_score >= 30){
		$wid = $st_score + 68.8;
	}elseif($st_score >= 20){
		$wid = $st_score2 + 1;
	}else{
		$wid = 1;
	}
	
	$im        = imagecreatetruecolor($wid, 15);
	$img_color = imagecolorallocate($im, 255, 0, 51);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, 13, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img1_2);
	imagedestroy($im);


/*
	//重み付け画像
	$img1w = "./images/pdf/img".$id."_w.jpg";
	$devw = $testdata[ 'score' ];
	$levelStr = $testdata[ 'level' ];
	$devw2 = substr($devw, 1, 4) * 9.2;
	if($devw >= 80){
		$wid = 552;
	}elseif($devw >= 70){
		$wid = $devw2 + 461.3;
	}elseif($devw >= 60){
		$wid = $devw2 + 370.8;
	}elseif($devw >= 50){
		$wid = $devw2 + 279.75;
	}elseif($devw >= 40){
		$wid = $devw2 + 188.8;
	}elseif($devw >= 30){
		$wid = $devw2 + 94.8;
	}elseif($devw >= 20){
		$wid = $devw2 + 1;
	}else{
		$wid = 1;
	}

	$im = imagecreatetruecolor($wid, 10);
	$img_color = imagecolorallocate($im, 64, 64, 64);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);
	
	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img1w);
	imagedestroy($im);
*/
	//----------------------------------------------
	//棒グラフ画像作成終わり
	//----------------------------------------------

	//----------------------------------------------
	//チャートグラフ画像作成
	//----------------------------------------------

	$gimg1 = "./images/pdf/graf".$id.".png";
	$gimg2 = "./images/pdf/graf2".$id.".png";
	$dev1scr  = round($testdata['type'][ 'dev1'  ]/10,1)-2;
	$dev2scr  = round($testdata['type'][ 'dev2'  ]/10,1)-2;
	$dev3scr  = round($testdata['type'][ 'dev3'  ]/10,1)-2;
	$dev4scr  = round($testdata['type'][ 'dev4'  ]/10,1)-2;
	$dev5scr  = round($testdata['type'][ 'dev5'  ]/10,1)-2;
	$dev6scr  = round($testdata['type'][ 'dev6'  ]/10,1)-2;
	$dev7scr  = round($testdata['type'][ 'dev7'  ]/10,1)-2;
	$dev8scr  = round($testdata['type'][ 'dev8'  ]/10,1)-2;
	$dev9scr  = round($testdata['type'][ 'dev9'  ]/10,1)-2;
	$dev10scr = round($testdata['type'][ 'dev10' ]/10,1)-2;
	$dev11scr = round($testdata['type'][ 'dev11' ]/10,1)-2;
	$dev12scr = round($testdata['type'][ 'dev12' ]/10,1)-2;
	$kodo_array = array(
				$dev1scr,$dev2scr,$dev3scr
				,$dev4scr,$dev5scr,$dev6scr
				,$dev7scr,$dev8scr,$dev9scr
				,$dev10scr,$dev11scr,$dev12scr
				);

	$MyData = new pData2();
	$MyData->addPoints($kodo_array,"ScoreA");  
	$MyData->setSerieDescription("ScoreA","Application A");
	$MyData->setPalette("ScoreA",array("R"=>0,"G"=>0,"B"=>255));
	$myPicture = new pImage(360,360,$MyData);
	$myPicture->setFontProperties(array("FontName"=>"./init/Fonts/Forgotte.ttf","FontSize"=>0.1,"R"=>255,"G"=>255,"B"=>255));
	$SplitChart = new pRadar();
	$myPicture->setGraphArea(10,25,360,360);
	$Options = array("FixedMax"=>6,"AxisRotation"=>-90,"Layout"=>RADAR_LAYOUT_STAR);
	$SplitChart->drawRadar($myPicture,$MyData,$Options);
	$myPicture->render($gimg1);
	//----------------------------------------------
	//チャートグラフ画像作成終わり
	//----------------------------------------------
	//----------------------------------------------
	//質問用表示箇所データ取得
	//----------------------------------------------

	$devlist = array(
					 "dev1" =>$testdata['type'][ 'dev1' ]
					,"dev2" =>$testdata['type'][ 'dev2' ]
					,"dev3" =>$testdata['type'][ 'dev3' ]
					,"dev4" =>$testdata['type'][ 'dev4' ]
					,"dev5" =>$testdata['type'][ 'dev5' ]
					,"dev6" =>$testdata['type'][ 'dev6' ]
					,"dev7" =>$testdata['type'][ 'dev7' ]
					,"dev8" =>$testdata['type'][ 'dev8' ]
					,"dev9" =>$testdata['type'][ 'dev9' ]
					,"dev10"=>$testdata['type'][ 'dev10' ]
					,"dev11"=>$testdata['type'][ 'dev11' ]
					,"dev12"=>$testdata['type'][ 'dev12' ]

					);

	asort($devlist);
	//５０以下の配列の値の上位2つを取得
	$i=0;
	foreach($devlist as $key=>$val){
		$quesans[$key] = $val;
	}
	//上位2つを取得
	arsort($devlist);
	//重みつけがある時は
	//重みつけのデータを優先にする
	$i=0;
	foreach($quesans as $key=>$val){
		$k = preg_replace("/dev/","w",$key);
		if($testweight[0][$k] > 0 ){
			$ary_weight[$key] = 1;
		}else{
			$ary_weight[$key] = 0;
		}
		$i++;
	}
	array_multisort($ary_weight, SORT_DESC,$quesans);
	$i=0;
	foreach($quesans as $k=>$v){
		$quesanslist[$k] = $v;
		if($i == 1){
			break;
		}
		$i++;
	}
	unset($quesans);
	$quesans = $quesanslist;
	

	$i=0;
	foreach($devlist as $key=>$val){
		if($i >= 2){
			break;
		}
		$strongPoint[$key] = $val;
		$i++;
	}
	//----------------------------------------------
	//質問用表示箇所データ取得終わり
	//----------------------------------------------

	$w1  = md5($elem[ 'e_feel' ]);
	$w2  = md5($elem[ 'e_cus'  ]);
	$w3  = md5($elem[ 'e_aff'  ]);
	$w4  = md5($elem[ 'e_cntl' ]);
	$w5  = md5($elem[ 'e_vi'   ]);
	$w6  = md5($elem[ 'e_pos'  ]);
	$w7  = md5($elem[ 'e_symp' ]);
	$w8  = md5($elem[ 'e_situ' ]);
	$w9  = md5($elem[ 'e_hosp' ]);
	$w10 = md5($elem[ 'e_lead' ]);
	$w11 = md5($elem[ 'e_ass'  ]);
	$w12 = md5($elem[ 'e_adap' ]);

	if($elem[ 'e_feel' ] && $w1 != "2a2d448e44531f3b896c4505e93bf458"){
		$msg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
		$gmsg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
	}else{
		$msg1 = "自己感情モニタリング力";
		$gmsg1 = "自己感情\nモニタリング力";
	}
	if($elem[ 'e_cus' ] && $w2 != "520daea0c5b2e0e3dc42b31be977865d" ){
		$msg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");
		$gmsg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");
	}else{
		$msg2 = "客観的自己評価力";
		$gmsg2 = "客観的\n自己評価力";
	}
	
	if($elem[ 'e_aff' ] && $w3 != "3921778eb523a55d1eaa5c55f31ea7da"){
		$msg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");
		$gmsg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");
	}else{
		$msg3 = "自己肯定力";
		$gmsg3 = "自己肯定力";
	}
	if($elem[ 'e_cntl' ] && $w4 != "5a2260d9155c814888a54872c350f5b0"){
		$msg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");
		$gmsg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");
	}else{
		$msg4 = "コントロール＆アチーブメント力";
		$gmsg4 = "コントロール＆アチ\nーブメント力";
	}
	if($elem[ 'e_vi' ] && $w5 != "8c0278e6e57cdcfdd8ba35af97aa646b"){
		$msg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");
		$gmsg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");
	}else{
		$msg5 = "ビジョン創出力";
		$gmsg5 = "ビジョン\n創出力";
	}
	if($elem[ 'e_pos' ] && $w6 != "4c787c0414da73909f654d0d50328301"){
		$msg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");
		$gmsg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");
	}else{
		$msg6 = "ポジティブ思考力";
		$gmsg6 = "ポジティブ\n思考力";
	}
	
	if($elem[ 'e_symp' ] && $w7 != "90cacae3ba0939ba3a2e4e7e800843c7"){
		$msg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");
		$gmsg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");
	}else{
		$msg7 = "対人共感力";
		$gmsg7 = "対人共感力";
	}
	if($elem[ 'e_situ' ] && $w8 != "43fac73af15ca6db7c86cbba8bcd781e"){
		$msg8 = mb_convert_encoding($elem[ 'e_situ' ],"SJIS","UTF-8");
		$gmsg8 = mb_convert_encoding($elem[ 'e_situ' ],"SJIS","UTF-8");
	}else{
		$msg8 = "状況察知力";
		$gmsg8 = "状況察知力";
	}
	if($elem[ 'e_hosp' ] && $w9 != "73520a4074fc9f9bee3159511ce349df"){
		$msg9 = mb_convert_encoding($elem[ 'e_hosp' ],"SJIS","UTF-8");
		$gmsg9 = mb_convert_encoding($elem[ 'e_hosp' ],"SJIS","UTF-8");
	}else{
		$msg9 = "ホスピタリティ発揮力";
		$gmsg9 = "ホスピタリティ\n発揮力";
	}
	if($elem[ 'e_lead' ] && $w10 != "ae9b08fcf03e78f01b08e779b87c508f"){
		$msg10 = mb_convert_encoding($elem[ 'e_lead' ],"SJIS","UTF-8");
		$gmsg10 = mb_convert_encoding($elem[ 'e_lead' ],"SJIS","UTF-8");
	}else{
		$msg10 = "リーダーシップ発揮力";
		$gmsg10 = "リーダーシップ\n発揮力";
	}
	if($elem[ 'e_ass' ] && $w11 != "5c3c5efdf178d3420357607f0115438b"){
		$msg11 = mb_convert_encoding($elem[ 'e_ass' ],"SJIS","UTF-8");
		$gmsg11 = mb_convert_encoding($elem[ 'e_ass' ],"SJIS","UTF-8");
	}else{
		$msg11 = "アサーション発揮力";
		$gmsg11 = "アサーション\n発揮力";
	}
	if($elem[ 'e_adap' ] && $w12 != "565c11a274c57c3d1d88d208bfd3a14e"){
		$msg12 = mb_convert_encoding($elem[ 'e_adap' ],"SJIS","UTF-8");
		$gmsg12 = mb_convert_encoding($elem[ 'e_adap' ],"SJIS","UTF-8");
	}else{
		$msg12 = "集団適応力";
		$gmsg12 = "集団適応力";
	}

	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	$make->makePdfKozin($pdf,$testdata,2);
	$pdf->Ln(2);
	$pdf->SetFillColor(51, 51, 204);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Cell(60, 5, '[1]総合評価', 1, 1, 'L', 1);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->Ln(1);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFontSize(8);
	//----------------------------------------------
	//棒グラフ表示
	//---------------------------------------------
	$pdf->Cell(22, 8, "総合評価レベル", 1, 0, 'C', 1);
	//スコアを出力する
	$pdf->SetFillColor(204,255,204);

	$pdf->Cell(20, 8,$sougoLv, 1, 0, 'C', 1);
	$pdf->SetFillColor(255,255,255);
	$pdf->MultiCell(150,4, $array_pdf22[ $sougoLv ],1,'L');
	//----------------------------------------------
	//棒グラフ表示終わり
	//---------------------------------------------
	$pdf->Ln(1);
	//↓2.行動価値　12特性のスコアとチャート↓
	$pdf->SetFillColor(51, 51, 204);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Cell(60, 5, '[2]各要素の総合レベル', 1, 1, 'L', 1);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->Ln(1);
	$pdf->SetFillColor(204, 255, 204);

	$pdf->Cell(22, 3, "　", 'LTR', 0, 'C', 1);
	$pdf->Cell(10, 6.5, "スコア", 'LTR', 0, 'C', 1);
	$pdf->Cell(10, 6.5, "レベル", 'LTR', 0, 'C', 1);
	
	$pdf->SetFontSize(7);
	$pdf->Cell(38, 3, "1", 'TL', 0, 'C', 1);
	$pdf->Cell(24.5, 3, "2", 'TL', 0, 'C', 1);
	$pdf->Cell(23.5, 3, "3", 'TL', 0, 'C', 1);
	$pdf->Cell(24.5, 3, "4", 'TL', 0, 'C', 1);
	$pdf->Cell(39.5, 3, "5", 'TLR', 1, 'C', 1);

	$pdf->Cell(22, 3, "　", 'LRB', 0, 'C', 1);
	$pdf->Cell(10, 0, " " , '',    0, 'C', 1);
	$pdf->Cell(10, 0, " " , '',    0, 'C', 1);
	
	$pdf->Cell(24, 3, "20", 'TLB', 0, 'L', 1);
	$pdf->Cell(24, 3, "30", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 3, "40", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 3, "50", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 3, "60", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 3, "70", 'TB', 0, 'L', 1);
	$pdf->Cell(6,  3, "80", 'TRB', 1, 'L', 1);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFontSize(7.5);
	//----------------------------------------------
	//棒グラフ表示
	//---------------------------------------------

	$pdf->Cell(22, 6, "1.感情能力", 1, 0, 'L', 1);
	//スコアを出力する
	$devw = sprintf("%2.1f",$sougo);
	$pdf->Cell(10, 6,$devw, 1, 0, 'C', 1);
	//レベルを出力する
	$pdf->Cell(10, 6,"    ".$imageLv,1,0,'L',1);
	$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(4,  6, "", 1, 1, 'C', 1);

	$pdf->Cell(22, 6, "2.行動能力適合度", 1, 0, 'L', 1);
	//スコアを出力する
	$devw = sprintf("%2.1f",$testdata[ 'score' ]);
	$pdf->Cell(10, 6,$devw, 1, 0, 'C', 1);
	//レベルを出力する
	$pdf->Cell(10, 6, "    ".$mvLv,1,0,'L', 1);
	$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(4,  6, "", 1, 1, 'C', 1);
	


	$pdf->Cell(22, 6, "3.知的能力", 1, 0, 'L', 1);
	//スコアを出力する
	$pdf->Cell(10, 6,"  ".$intell, 1, 0, 'L', 1);
	//レベルを出力する
	$pdf->Cell(10, 6, "    ".$intellLv,1,0,'L', 1);
	$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(4,  6, "", 1, 1, 'C', 1);

	$pdf->Ln(2);

	//50の境界線の赤線
	$pdf->SetFillColor(255,63,63);
	$pdf->Rect(125.75, 69.15, 0.5, 17.8, 'F');
	$pdf->SetFillColor(255, 255, 255);
	//第二引数x 第三引数y
	//棒グラフの表示

//	$pdf->Image($img1w, 52, 52.5);
	$pdf->Image($img1, 52, 70.5);
	$pdf->Image($img2, 52, 76.5);
	$pdf->Image($img3, 52, 82.5);

	$pdf->SetFillColor(51, 51, 204);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Cell(60, 5, '[3]行動価値詳細', 1, 1, 'L', 1);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFillColor(255, 255, 255);

	$pdf->Ln(1);
	//↑1.ストレス共生力ここまで↑
	//外枠を作成
	$pdf->Cell(192, 115, "",    1, 1, 'C', 1);
	$en1 = "./images/en01.gif";

	$pdf->Image($gimg1, 57, 100.5);

//	$pdf->Image($en1, 54.75, 100);


	//↓四隅の項目名を出力↓
	$pdf->SetDrawColor(204, 204, 204);
	$pdf->SetFontSize(10);
/*
	$pdf->Rect(17, 108, 25, 8, 'D');
	$pdf->Rect(18, 109, 23, 6, 'D');
	$pdf->Text(21, 113.25, "対人影響力");

	$pdf->Rect(167, 108, 25, 8, 'D');
	$pdf->Rect(168, 109, 23, 6, 'D');
	$pdf->Text(171, 113.25, "自己認知力");

	$pdf->Rect(17, 185, 25, 8, 'D');
	$pdf->Rect(18, 186, 23, 6, 'D');
	$pdf->Text(21, 190.25, "対人認知力");

	$pdf->Rect(167, 185, 25, 8, 'D');
	$pdf->Rect(168, 186, 23, 6, 'D');
	$pdf->Text(171, 190.25, "自己安定力");
*/
	//↑四隅の項目名を出力ここまで↑

	//↓レーダーの数値↓
	$pdf->SetDrawColor(0, 0, 0);
	$pdf->SetFontSize(8);

	$pdf->Text(99, 109, 80);
	$pdf->Text(99, 116.75, 70);
	$pdf->Text(99, 124.25, 60);
	$pdf->Text(99, 131.75, 50);
	$pdf->Text(99, 138, 40);
	$pdf->Text(99, 144.25, 30);
	$pdf->Text(99, 150.25, 20);
	//↑レーダーの数値ここまで↑

	$pdf->SetLineWidth(0.5);
	//自己感情モニタリング力
/*
	if($testweight[0][ 'w1' ] != 0){
		$pdf->SetXY(92.0, 98.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(90.0, 96.0, 35.0, 10.0, 'DF');
	}
*/
	//$pdf->Text(92, 103, $msg1);
	$pdf->SetXY(90.0, 98.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg1)){
		$ht = 3;
	}
	$gmsg1 = $gmsg1."(".round($devlist[ 'dev1' ],1).")";
	$pdf->MultiCell(35, $ht, $gmsg1,0,"C");

	
	
	//客観的自己評価力
/*
	if($testweight[0][ 'w2' ] != 0){
		$pdf->SetXY(129.0, 113.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(127.0, 108.0, 30.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(127.0, 110.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg2)){
		$ht = 3;
	}
	$gmsg2 = $gmsg2."(".round($devlist[ 'dev2' ],1).")";
	$pdf->MultiCell(30, $ht, $gmsg2,0,"C");

	//自己肯定力
/*
	if($testweight[0][ 'w3' ] != 0){
		$pdf->SetXY(144.0, 127.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(142.0, 125.0, 30.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(142.0, 128.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg3)){
		$ht = 3;
	}
	$gmsg3 = $gmsg3."(".round($devlist[ 'dev3' ],1).")";
	$pdf->MultiCell(30, $ht, $gmsg3,0,"C");

	//コントロール＆アチーブメント力
/*
	if($testweight[0][ 'w4' ] != 0){
		$pdf->SetXY(151.0, 150.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(149.0, 148.0, 32.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(149.0, 150.5);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg4)){
		$ht = 3;
	}
	$gmsg4 = $gmsg4."(".round($devlist[ 'dev4' ],1).")";
	$pdf->MultiCell(30, $ht, $gmsg4,0,"C");


	//ビジョン創出力
/*
	if($testweight[0][ 'w5' ] != 0){
		$pdf->SetXY(144.0, 175.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(142.0, 173.0, 30.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(142.0, 175.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg5)){
		$ht = 3;
	}
	$gmsg5 = $gmsg5."(".round($devlist[ 'dev5' ],1).")";
	$pdf->MultiCell(30, $ht, $gmsg5,0,"C");
	
	
	//ポジティブ思考力
/*
	if($testweight[0][ 'w6' ] != 0){
		$pdf->SetXY(129.0, 190.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(127.0, 188.0, 30.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(127.0, 190.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg6)){
		$ht = 3;
	}
	$gmsg6 = $gmsg6."(".round($devlist[ 'dev6' ],1).")";
	$pdf->MultiCell(30, $ht, $gmsg6,0,"C");

	//対人共感力
/*
	if($testweight[0][ 'w7' ] != 0){
		$pdf->SetXY(91.0, 199.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(91.0, 197.0, 30.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(91.0, 199.8);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg7)){
		$ht = 3;
	}
	$gmsg7 = $gmsg7."(".round($devlist[ 'dev7' ],1).")";
	$pdf->MultiCell(30, $ht, $gmsg7,0,"C");


/*
	//状況察知力
	if($testweight[0][ 'w8' ] != 0){
		$pdf->SetXY(59.0, 190.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(59.0, 188.0, 30.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(59.0, 190.8);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg8)){
		$ht = 3;
	}
	$gmsg8 = $gmsg8."(".round($devlist[ 'dev8' ],1).")";
	$pdf->MultiCell(30, 4, $gmsg8,0,"C");


	//ホスピタリティ発揮力
/*
	if($testweight[0][ 'w9' ] != 0){
		$pdf->SetXY(45.0, 175.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(45.0, 173.0, 32.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(45.0, 175.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg9)){
		$ht = 3;
	}
	$gmsg9 = $gmsg9."(".round($devlist[ 'dev9' ],1).")";
	$pdf->MultiCell(31.5, $ht, $gmsg9,0,"C");



	//リーダーシップ発揮力
/*
	if($testweight[0][ 'w10' ] != 0){
		$pdf->SetXY(32.0, 151.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(35.0, 148.0, 31.5, 10.0, 'DF');
	}
*/
	$pdf->SetXY(33.5, 150.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg10)){
		$ht = 3;
	}
	$gmsg10 = $gmsg10."(".round($devlist[ 'dev10' ],1).")";
	$pdf->MultiCell(31.5, $ht, $gmsg10,0,"C");

	//アサーション発揮力
/*
	if($testweight[0][ 'w11' ] != 0){
		$pdf->SetXY(39.0, 130.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(39.0, 127.0, 30.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(39.0, 129.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg11)){
		$ht = 3;
	}
	$gmsg11 = $gmsg11."(".round($devlist[ 'dev11' ],1).")";
	$pdf->MultiCell(30, $ht, $gmsg11,0,"C");

/*
	//集団適応力
	if($testweight[0][ 'w12' ] != 0){
		$pdf->SetXY(58.0, 107.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(58.0, 105.0, 30.0, 10.0, 'DF');
	}
*/
	$pdf->SetXY(58.0, 107.8);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg12)){
		$ht = 3;
	}
	$gmsg12 = $gmsg12."(".round($devlist[ 'dev12' ],1).")";
	$pdf->MultiCell(30, $ht, $gmsg12,0,"C");


	$pdf->SetLineWidth(0.1);
/*
	$pdf->SetFontSize(9);
	$pdf->Rect(140, 200, 58, 8, 'D');
	$pdf->SetFillColor(162, 204, 255);
	$pdf->Rect(141.0, 202.0, 10.0, 4.0, 'DF');
	$pdf->Text(152, 205.25, "御社が重要視している行動価値");
*/
	$pdf->SetXY(10.0, 211.0);
	$pdf->SetFillColor(51, 51, 204);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Cell(60, 5, '[4]知的能力詳細', 1, 1, 'L', 1);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetFillColor(255, 255, 255);


	$pdf->Ln(1);
	$pdf->SetFillColor(204, 255, 204);

	$pdf->Cell(22, 3, "　", 'LTR', 0, 'C', 1);
	$pdf->Cell(10, 6.5, "スコア", 'LTR', 0, 'C', 1);
	$pdf->Cell(10, 6.5, "レベル", 'LTR', 0, 'C', 1);
	
	$pdf->SetFontSize(7);
	$pdf->Cell(38, 3, "1", 'TL', 0, 'C', 1);
	$pdf->Cell(24.5, 3, "2", 'TL', 0, 'C', 1);
	$pdf->Cell(23.5, 3, "3", 'TL', 0, 'C', 1);
	$pdf->Cell(24.5, 3, "4", 'TL', 0, 'C', 1);
	$pdf->Cell(39.5, 3, "5", 'TLR', 1, 'C', 1);

	$pdf->Cell(22, 3, "　", 'LRB', 0, 'C', 1);
	$pdf->Cell(10, 0, " " , '',    0, 'C', 1);
	$pdf->Cell(10, 0, " " , '',    0, 'C', 1);
	
	$pdf->Cell(24, 3, "20", 'TLB', 0, 'L', 1);
	$pdf->Cell(24, 3, "30", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 3, "40", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 3, "50", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 3, "60", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 3, "70", 'TB', 0, 'L', 1);
	$pdf->Cell(6,  3, "80", 'TRB', 1, 'L', 1);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFontSize(7.5);
	//----------------------------------------------
	//棒グラフ表示
	//---------------------------------------------
	
	$pdf->MultiCell(4, 2.85," 知的能力",1,"L");
	$pdf->SetXY(14.0, 223);
	$pdf->Cell(18, 9, "1.言語・論理", 1, 0, 'L', 1);
	//スコアを出力する
	$devw = sprintf("%2.1f",$iqdata[0][ 'language_score' ]);
	$pdf->Cell(10, 9,$devw, 1, 0, 'C', 1);
	//レベルを出力する
	$pdf->Cell(10, 9,"    ".$intellLv,1,0,'L',1);
	$pdf->Cell(26, 9, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 9, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 9, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 9, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 9, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 9, "", 1, 0, 'C', 1);
	$pdf->Cell(4,  9, "", 1, 1, 'C', 1);
	$pdf->SetXY(14.0, 232);
	$pdf->Cell(18, 8, "2.数理・推論", 1, 0, 'L', 1);
	//スコアを出力する
	$devw = sprintf("%2.1f",$iqdata[0][ 'math_score' ]);
	$pdf->Cell(10, 8,$devw, 1, 0, 'C', 1);
	//レベルを出力する
	$pdf->Cell(10, 8, "    ".$mathLv,1,0,'L', 1);
	$pdf->Cell(26, 8, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 8, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 8, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 8, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 8, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 8, "", 1, 0, 'C', 1);
	$pdf->Cell(4,  8, "", 1, 1, 'C', 1);

	$pdf->Ln(2);

	//50の境界線の赤線
	$pdf->SetFillColor(255,63,63);
	$pdf->Rect(125.75, 69.15, 0.5, 17.8, 'F');
	$pdf->SetFillColor(255, 255, 255);
	//第二引数x 第三引数y
	//棒グラフの表示

	$pdf->Image($img1_1, 52, 225.5);
	$pdf->Image($img1_2, 52, 233.8);



	$pdf->SetXY(10, 241);
	$pdf->SetFillColor(51, 51, 204);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Cell(60, 5, '[5] 情報の捉え方', 1, 1, 'L', 1);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetXY(10, 247);
	$pdf->Cell(38.4, 3, 'クリティカル', 0, 0, 'L',0);
	$pdf->Cell(38.4, 3, '', 0, 0, 'L',0);
	$pdf->Cell(38.4, 3, '標準', 0, 0, 'C',0);
	$pdf->Cell(38.4, 3, '', 0, 0, 'L',0);
	$pdf->Cell(38.4, 3, 'ポジティブ', 0, 0, 'R',0);
	
	$hosi = array();
	$jyoho = $rs17[0][ 'jyoho' ];
	if($jyoho < 36){
		$hosi[1] = "★";
		$hosiKey = 0;
	}elseif( $jyoho >= 36 && $jyoho < 43){
		$hosi[2] = "★";
		$hosiKey = 1;
	}elseif( $jyoho >= 43 && $jyoho < 57){
		$hosi[3] = "★";
		$hosiKey = 2;
	}elseif( $jyoho >= 57 && $jyoho < 65){
		$hosi[4] = "★";
		$hosiKey = 3;
	}elseif( $jyoho >= 65 ){
		$hosi[5] = "★";
		$hosiKey = 4;
	}
	
	
	$pdf->SetXY(10, 251);
	$pdf->SetTextColor(51, 51, 204);
	$pdf->SetFontSize(11);
	$pdf->Cell(38.4, 6, $hosi[1], 'TBL', 0, 'C',0);
	$pdf->Cell(38.4, 6, $hosi[2], 'TB', 0, 'C',0);
	$pdf->SetFillColor(204, 255, 255);
	$pdf->Cell(38.4, 6, $hosi[3], 'TB', 0, 'C',1);
	$pdf->SetFillColor(0, 0, 0);
	$pdf->Cell(38.4, 6, $hosi[4], 'TB', 0, 'C',0);
	$pdf->Cell(38.4, 6, $hosi[5], 'TRB', 0, 'C',0);
	
	//セルの点線の配置
	dotted(48.5,251,48.5,257);
	dotted(86.5,251,86.5,257);
	dotted(125.5,251,125.5,257);
	dotted(163.5,251,163.5,257);
	$pdf->SetFontSize(9.2);
	$pdf->SetXY(10, 262);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetTextColor(0, 0, 0);
	$pdf->MultiCell(192, 5, $type17_bias[ $hosiKey ], 1,"L");







	$pdf->Ln(2);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');
	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	unlink($img1);
	unlink($img2);
	unlink($img3);

	unlink($img1_1);
	unlink($img1_2);

	unlink($img1w);
	unlink($gimg1);

	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------


?>