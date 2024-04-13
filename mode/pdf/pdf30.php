<?PHP
	//----------------------------------------------
	//棒グラフ画像作成
	//----------------------------------------------
	$img1 = "./images/pdf/img".$id.".jpg";
	$st_score2 = substr($st_score, 1, 4) * 9.2;
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
		$wid = $st_score2 + 94.8;
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

	if($elem[ 'e_feel' ] ){
		$msg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
		$gmsg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
	}else{
		$msg1 = "自己感情モニタリング力";
		$gmsg1 = "自己感情\nモニタリング力";
	}
	if($elem[ 'e_cus' ] ){
		$msg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");
		$gmsg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");
	}else{
		$msg2 = "客観的自己評価力";
		$gmsg2 = "客観的\n自己評価力";
	}
	
	if($elem[ 'e_aff' ] ){
		$msg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");
		$gmsg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");
	}else{
		$msg3 = "自己肯定力";
		$gmsg3 = "自己肯定力";
	}
	if($elem[ 'e_cntl' ] ){
		$msg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");
		$gmsg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");
	}else{
		$msg4 = "コントロール＆アチーブメント力";
		$gmsg4 = "コントロール＆アチ\nーブメント力";
	}
	if($elem[ 'e_vi' ] ){
		$msg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");
		$gmsg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");
	}else{
		$msg5 = "ビジョン創出力";
		$gmsg5 = "ビジョン\n創出力";
	}
	if($elem[ 'e_pos' ] ){
		$msg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");
		$gmsg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");
	}else{
		$msg6 = "ポジティブ思考力";
		$gmsg6 = "ポジティブ\n思考力";
	}
	
	if($elem[ 'e_symp' ] ){
		$msg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");
		$gmsg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");
	}else{
		$msg7 = "対人共感力";
		$gmsg7 = "対人共感力";
	}
	if($elem[ 'e_situ' ] ){
		$msg8 = mb_convert_encoding($elem[ 'e_situ' ],"SJIS","UTF-8");
		$gmsg8 = mb_convert_encoding($elem[ 'e_situ' ],"SJIS","UTF-8");
	}else{
		$msg8 = "状況察知力";
		$gmsg8 = "状況察知力";
	}
	if($elem[ 'e_hosp' ] ){
		$msg9 = mb_convert_encoding($elem[ 'e_hosp' ],"SJIS","UTF-8");
		$gmsg9 = mb_convert_encoding($elem[ 'e_hosp' ],"SJIS","UTF-8");
	}else{
		$msg9 = "ホスピタリティ発揮力";
		$gmsg9 = "ホスピタリティ\n発揮力";
	}
	if($elem[ 'e_lead' ] ){
		$msg10 = mb_convert_encoding($elem[ 'e_lead' ],"SJIS","UTF-8");
		$gmsg10 = mb_convert_encoding($elem[ 'e_lead' ],"SJIS","UTF-8");
	}else{
		$msg10 = "リーダーシップ発揮力";
		$gmsg10 = "リーダーシップ\n発揮力";
	}
	if($elem[ 'e_ass' ] ){
		$msg11 = mb_convert_encoding($elem[ 'e_ass' ],"SJIS","UTF-8");
		$gmsg11 = mb_convert_encoding($elem[ 'e_ass' ],"SJIS","UTF-8");
	}else{
		$msg11 = "アサーション発揮力";
		$gmsg11 = "アサーション\n発揮力";
	}
	if($elem[ 'e_adap' ] ){
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
	$pdf->Write("5","1.行動価値適合度とストレス共生力");
	

	$pdf->Ln(5);
	$pdf->SetFillColor(204,255,204);
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

	$pdf->SetFontSize(8);
	//----------------------------------------------
	//棒グラフ表示
	//---------------------------------------------
	$pdf->Cell(22, 6, "行動価値適合度", 1, 0, 'L', 1);
	//スコアを出力する
	$devw = sprintf("%2.1f",$devw);
	$pdf->Cell(10, 6, "  ".$devw, 1, 0, 'L', 1);
	//レベルを出力する
	$pdf->Cell(10, 6, "    ".$levelStr,1,0,'L',1);
	$pdf->Cell(26, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(4,  6, "", 1, 1, 'C', 1);

	$pdf->Cell(22, 6, "ストレス共生力", 1, 0, 'L', 1);
	//スコアを出力する
	$pdf->Cell(10, 6, "  ".$st_score, 1, 0, 'L', 1);
	//レベルを出力する
	$pdf->Cell(10, 6, "    ".$st_level,1,0,'L', 1);
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
	$pdf->Rect(125.75, 51.15, 1, 11.78, 'F');
	$pdf->SetFillColor(255, 255, 255);

	//第二引数x 第三引数y
	//棒グラフの表示
	$pdf->Image($img1w, 52, 52.5);
	$pdf->Image($img1, 52, 58.5);
	//----------------------------------------------
	//棒グラフ表示終わり
	//---------------------------------------------

	$pdf->Ln(3);

	//↓2.行動価値　12特性のスコアとチャート↓
	$pdf->Write("0","2.行動価値　12特性のスコアとチャート");
	$pdf->Ln(3);
	$pdf->SetFillColor(204, 255, 204);

	$pdf->Cell(38, 5, "自己認知力", 'TL', 0, 'C', 1);
	$pdf->Cell(8.5,5, "スコア"    , 'TL', 0, 'C', 1);

	$pdf->Cell(44, 5, "自己安定力", 'TL', 0, 'C', 1);
	$pdf->Cell(8.5,5, "スコア"    , 'TL', 0, 'C', 1);

	$pdf->Cell(38, 5, "対人認知力", 'TL', 0, 'C', 1);
	$pdf->Cell(8.5,5, "スコア"    , 'TL', 0, 'C', 1);

	$pdf->Cell(38, 5, "対人影響力", 'TL', 0, 'C', 1);
	$pdf->Cell(8.5,5, "スコア"    , 'TLR', 1, 'C', 1);

	$pdf->SetFillColor(255, 255, 255);
	//自己感情モニタリング力
	$pt1  = sprintf("%01.1f",round($testdata['type'][ 'dev1' ],1));
	$pdf->Cell(38, 5, $msg1, 'TL', 0, 'L', 1 );
	$pdf->Cell(8.5,5, $pt1,   'TL', 0, 'C', 1);
	//コントロール＆アチーブメント力
	$pt4  = sprintf("%01.1f",round($testdata['type'][ 'dev4' ],1));
	$pdf->Cell(44, 5, $msg4,      'TL', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt4,       'TL', 0, 'C', 1);
	//対人共感力
	$pt7  = sprintf("%01.1f",round($testdata['type'][ 'dev7' ],1));
	$pdf->Cell(38, 5, $msg7,      'TL', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt7,       'TL', 0, 'C', 1);
	//リーダーシップ発揮力
	$pt10  = sprintf("%01.1f",round($testdata['type'][ 'dev10' ],1));
	$pdf->Cell(38, 5, $msg10,      'TL', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt10,       'TLR', 1, 'C', 1);
	

	//客観的自己評価力
	$pt2  = sprintf("%01.1f",round($testdata['type'][ 'dev2' ],1));
	$pdf->Cell(38, 5, $msg2,     'TL', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt2,      'TL', 0, 'C', 1);
	//ビジョン創出力
	$pt5  = sprintf("%01.1f",round($testdata['type'][ 'dev5' ],1));
	$pdf->Cell(44, 5, $msg5,        'TL', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt5,         'TL', 0, 'C', 1);
	//状況察知力
	$pt8  = sprintf("%01.1f",round($testdata['type'][ 'dev8' ],1));
	$pdf->Cell(38, 5, $msg8,      'TL', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt8,       'TL', 0, 'C', 1);
	//アサーション発揮力
	$pt11  = sprintf("%01.1f",round($testdata['type'][ 'dev11' ],1));
	$pdf->Cell(38, 5, $msg11,       'TL', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt11,        'TLR', 1, 'C', 1);
	
	
	//自己肯定力
	$pt3  = sprintf("%01.1f",round($testdata['type'][ 'dev3' ],1));
	$pdf->Cell(38, 5, $msg3,       'TLB', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt3,        'TLB', 0, 'C', 1);
	//ポジティブ思考力
	$pt6  = sprintf("%01.1f",round($testdata['type'][ 'dev6' ],1));
	$pdf->Cell(44, 5, $msg6,       'TLB', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt6,        'TLB', 0, 'C', 1);
	//ホスピタリティ発揮力
	$pt9  = sprintf("%01.1f",round($testdata['type'][ 'dev9' ],1));
	$pdf->Cell(38, 5, $msg9,      'TLB', 0, 'L', 1);
	$pdf->Cell(8.5,5, $pt9,       'TLB', 0, 'C', 1);
	//集団適応力
	$pt12  = sprintf("%01.1f",round($testdata['type'][ 'dev12' ],1));
	$pdf->Cell(38, 5, $msg12,      'TLB', 0, 'L', 1 );
	$pdf->Cell(8.5,5, $pt12,       'TLBR', 1, 'C', 1);
	$pdf->Ln(3);
	//↑1.ストレス共生力ここまで↑
	//外枠を作成
	$pdf->Cell(192, 115, "",    1, 1, 'C', 1);
	$en1 = "./images/en01.gif";

	$pdf->Image($gimg1, 57, 100.5);

	$pdf->Image($en1, 54.75, 100);


	//↓四隅の項目名を出力↓
	$pdf->SetDrawColor(204, 204, 204);
	$pdf->SetFontSize(10);

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
	if($testweight[0][ 'w1' ] != 0){
		$pdf->SetXY(92.0, 98.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(90.0, 96.0, 35.0, 10.0, 'DF');
	}
	//$pdf->Text(92, 103, $msg1);
	$pdf->SetXY(90.0, 98.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg1)){
		$ht = 3;
	}
	$pdf->MultiCell(35, $ht, $gmsg1,0,"C");

	
	
	//客観的自己評価力
	if($testweight[0][ 'w2' ] != 0){
		$pdf->SetXY(129.0, 113.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(127.0, 108.0, 30.0, 10.0, 'DF');
	}
	$pdf->SetXY(127.0, 110.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg2)){
		$ht = 3;
	}
	$pdf->MultiCell(30, $ht, $gmsg2,0,"C");

	//自己肯定力
	if($testweight[0][ 'w3' ] != 0){
		$pdf->SetXY(144.0, 127.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(142.0, 125.0, 30.0, 10.0, 'DF');
	}
	$pdf->SetXY(142.0, 128.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg3)){
		$ht = 3;
	}
	$pdf->MultiCell(30, $ht, $gmsg3,0,"C");

	//コントロール＆アチーブメント力
	if($testweight[0][ 'w4' ] != 0){
		$pdf->SetXY(151.0, 150.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(149.0, 148.0, 32.0, 10.0, 'DF');
	}
	$pdf->SetXY(149.0, 150.5);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg4)){
		$ht = 3;
	}
	$pdf->MultiCell(30, $ht, $gmsg4,0,"C");


	//ビジョン創出力
	if($testweight[0][ 'w5' ] != 0){
		$pdf->SetXY(144.0, 175.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(142.0, 173.0, 30.0, 10.0, 'DF');
	}
	$pdf->SetXY(142.0, 175.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg5)){
		$ht = 3;
	}
	$pdf->MultiCell(30, $ht, $gmsg5,0,"C");
	
	
	//ポジティブ思考力
	if($testweight[0][ 'w6' ] != 0){
		$pdf->SetXY(129.0, 190.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(127.0, 188.0, 30.0, 10.0, 'DF');
	}
	$pdf->SetXY(127.0, 190.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg6)){
		$ht = 3;
	}
	$pdf->MultiCell(30, $ht, $gmsg6,0,"C");

	//対人共感力
	if($testweight[0][ 'w7' ] != 0){
		$pdf->SetXY(91.0, 199.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(91.0, 197.0, 30.0, 10.0, 'DF');
	}
	$pdf->SetXY(91.0, 199.8);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg7)){
		$ht = 3;
	}
	$pdf->MultiCell(30, $ht, $gmsg7,0,"C");



	//状況察知力
	if($testweight[0][ 'w8' ] != 0){
		$pdf->SetXY(59.0, 190.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(59.0, 188.0, 30.0, 10.0, 'DF');
	}
	$pdf->SetXY(59.0, 190.8);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg8)){
		$ht = 3;
	}

	$pdf->MultiCell(30, 4, $gmsg8,0,"C");


	//ホスピタリティ発揮力

	if($testweight[0][ 'w9' ] != 0){
		$pdf->SetXY(45.0, 175.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(45.0, 173.0, 32.0, 10.0, 'DF');
	}
	$pdf->SetXY(45.0, 175.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg9)){
		$ht = 3;
	}

	$pdf->MultiCell(31.5, $ht, $gmsg9,0,"C");



	//リーダーシップ発揮力
	if($testweight[0][ 'w10' ] != 0){
		$pdf->SetXY(32.0, 151.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(35.0, 148.0, 31.5, 10.0, 'DF');
	}
	$pdf->SetXY(33.5, 150.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg10)){
		$ht = 3;
	}

	$pdf->MultiCell(31.5, $ht, $gmsg10,0,"C");

	//アサーション発揮力
	if($testweight[0][ 'w11' ] != 0){
		$pdf->SetXY(39.0, 130.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(39.0, 127.0, 30.0, 10.0, 'DF');
	}
	$pdf->SetXY(39.0, 129.0);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg11)){
		$ht = 3;
	}
	$pdf->MultiCell(30, $ht, $gmsg11,0,"C");

	//集団適応力
	if($testweight[0][ 'w12' ] != 0){
		$pdf->SetXY(58.0, 107.0);
		$pdf->SetFillColor(162, 199, 255);
		$pdf->SetDrawColor(128, 128, 128);
		$pdf->Rect(58.0, 105.0, 30.0, 10.0, 'DF');
	}
	$pdf->SetXY(58.0, 107.8);
	$ht = 4;
	if(preg_match("/\\n/",$gmsg12)){
		$ht = 3;
	}
	$pdf->MultiCell(30, $ht, $gmsg12,0,"C");


	$pdf->SetLineWidth(0.1);

	$pdf->SetFontSize(9);
	$pdf->Rect(140, 200, 58, 8, 'D');
	$pdf->SetFillColor(162, 204, 255);
	$pdf->Rect(141.0, 202.0, 10.0, 4.0, 'DF');
	$pdf->Text(152, 205.25, "御社が重要視している行動価値");

	$pdf->SetXY(10.0, 210.0);
	if($wtm[ 'master_name' ]){
		$pdf->SetFontSize(9);
		$pdf->Cell(190, 2, "利用基準名：".mb_convert_encoding($wtm[ 'master_name' ],"sjis-win","UTF-8"), 0, 0, 'R');
	}

	$pdf->SetXY(10.0, 208.0);
	$pdf->Ln(3);
	//質問例
	$pdf->SetFontSize(8);
	$pdf->Write("5",$ques);
	$pdf->Ln();
	$pdf->SetFillColor(204, 255, 204);
	$pdf->Cell(45, 4, "スコアの低い行動価値", 1, 0, 'C', 1);
	$pdf->Cell(36, 4, "リスクとなる行動",     1, 0, 'C', 1);
	$pdf->Cell(54, 4, "面接時の質問例",       1, 0, 'C', 1);
	$pdf->Cell(57, 4, "判定のポイント",       1, 1, 'C', 1);
	
	$pdf->SetFillColor(255, 255, 255);
	//pdf用質問タイトル
	$a_questions = array(
		"dev1"=>$msg1
		,"dev2"=>$msg2
		,"dev3"=>$msg3
		,"dev4"=>$msg4
		,"dev5"=>$msg5
		,"dev6"=>$msg6
		,"dev7"=>$msg7
		,"dev8"=>$msg8
		,"dev9"=>$msg9
		,"dev10"=>$msg10
		,"dev11"=>$msg11
		,"dev12"=>$msg12
	);
	$i = 0;
	foreach($quesans as $k=>$v){
		//要素名
		$title =  $a_questions[$k];

		//リスクとなる行動
		$str   = $array_pdf_question[$k][0];
		//面接時の質問例
		$str1  = $array_pdf_question[$k][1];
		//判定のポイント
		$str2 = $array_pdf_question[$k][2];
		if($i == 0){
			//要素名1
			$pdf->MultiCell(45, 32, '', 'LB');
			//リスクとなる行動1
			$pdf->SetXY(55,220);
			$pdf->MultiCell(36, 4, $str, 'LB');
			//面接時の質問例2
			$pdf->SetXY(91,220);
			$pdf->MultiCell(54, 4, $str1, 'LB');
			//判定のポイント3
			$pdf->SetXY(145,220);
			$pdf->MultiCell(57, 4, $str2, 'LBR');
			$spCnt = 30;
			$titleSp = str_split($title, $spCnt);
			$pdf->Text(12,235,$titleSp[0]);
			$pdf->Text(12,238,$titleSp[1]);

		}

		if($i == 1){
			//要素名2
			$pdf->SetXY(10,252);
			$pdf->MultiCell(45, 32, "", 'LB');
			//リスクとなる行動1
			$pdf->SetXY(55,252);
			$pdf->MultiCell(36, 4, $str, 'LB');
			//面接時の質問例2
			$pdf->SetXY(91,252);
			$pdf->MultiCell(54, 4, $str1, 'LB');
			//判定のポイント3
			$pdf->SetXY(145,252);
			$pdf->MultiCell(57, 4, $str2, 'LBR');
			$spCnt = 30;
			$titleSp = str_split($title, $spCnt);
			$pdf->Text(12,267,$titleSp[0]);
			$pdf->Text(12,270,$titleSp[1]);

		}

		$i++;
	}
	$pdf->Ln(2);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');
	
	//採用版：行動価値検査結果レポート（面接版適合あり）(PA版)
	if($pdftype == 30){
		$pdf->setXY(180, 40);
		$pdf->Write("5","HR:".$calc."%");
	}
	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	unlink($img1);
	unlink($img1w);
	unlink($gimg1);

	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------


?>