<?PHP
	
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

	if($elem[ 'e_feel' ]){
		$msg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
		$gmsg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
	}else{
		$msg1 = "自己感情モニタリング力";
		$gmsg1 = "自己感情\nモニタリング力";
	}
	if($elem[ 'e_cus' ]){
		$msg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");
		$gmsg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");
	}else{
		$msg2 = "客観的自己評価力";
		$gmsg2 = "客観的\n自己評価力";
	}
	
	if($elem[ 'e_aff' ]){
		$msg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");
		$gmsg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");
	}else{
		$msg3 = "自己肯定力";
		$gmsg3 = "自己肯定力";
	}
	if($elem[ 'e_cntl' ]){
		$msg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");
		$gmsg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");
	}else{
		$msg4 = "コントロール＆アチーブメント力";
		$gmsg4 = "コントロール＆アチ\nーブメント力";
	}
	if($elem[ 'e_vi' ]){
		$msg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");
		$gmsg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");
	}else{
		$msg5 = "ビジョン創出力";
		$gmsg5 = "ビジョン\n創出力";
	}
	if($elem[ 'e_pos' ]){
		$msg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");
		$gmsg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");
	}else{
		$msg6 = "ポジティブ思考力";
		$gmsg6 = "ポジティブ\n思考力";
	}
	
	if($elem[ 'e_symp' ]){
		$msg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");
		$gmsg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");
	}else{
		$msg7 = "対人共感力";
		$gmsg7 = "対人共感力";
	}
	if($elem[ 'e_situ' ]){
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





	//質問用表示箇所データ取得
	$devlist = array(
					 "dev1"=>$testdata['type'][ 'dev1'  ]
					,"dev2" =>$testdata['type'][ 'dev2'  ]
					,"dev3" =>$testdata['type'][ 'dev3'  ]
					,"dev4" =>$testdata['type'][ 'dev4'  ]
					,"dev5" =>$testdata['type'][ 'dev5'  ]
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
		//$devlist_w[$i][ $key ] = $val;
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




	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	$make->makePdfKozin($pdf,$testdata,$pdftype);

	//↓1.ストレス共生力↓
	$pdf->Write("5","1.行動価値検査で測定していること");
	$pdf->Ln(5);

	$pdf->Cell(192, 4, "行動価値検査は、日々行動する中で「あなたがどのような行動を重視しているのか」について測定しており、能力を測定する検査ではありません。", 'LTR', 1, 'L', 1);
	$pdf->Cell(192, 4, "この検査は12の特性から構成されており、12の特性は、「自己認知力：自己を適切に認識する力」「自己安定力：自分をコントロールする力」「対人", 'LR', 1, 'L', 1);
	$pdf->Cell(192, 4, "認知力：他者の立場や感情を適切に認識する力」「対人影響力：他者を巻き込み、組織で目標を達成する力」の4つの領域に分かれています。", 'LR', 1, 'L', 1);
	$pdf->Cell(192, 4, "12の特性はスコア（偏差値）で表わされています。スコアが高い場合には、日常の行動において、その特性を重視して行動していることを表してい", 'LR', 1, 'L', 1);
	$pdf->Cell(192, 4, "ます。各特性のスコアは下記の結果をご覧ください。", 'LRB', 1, 'L', 1);

	$pdf->Ln(2);
	//↑1.ストレス共生力ここまで↑


	//↓2.行動価値　12特性のスコアとチャート↓
	$pdf->Write("5","2.行動価値　12特性のスコアとチャート");

	$pdf->Ln(5);
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
	$pdf->Cell(38, 5, $msg1, 'TL', 0, 'L', 1);
	$dev1 = sprintf("%2.1f",$dev1);
	$pdf->Cell(8.5,5, $dev1,   'TL', 0, 'C', 1);
	//コントロール＆アチーブメント力
	$pdf->Cell(44, 5, $msg4,      'TL', 0, 'L', 1);
	$dev4 = sprintf("%2.1f",$dev4);
	$pdf->Cell(8.5,5, $dev4,   'TL', 0, 'C', 1);
	//対人共感力
	$pdf->Cell(38, 5, $msg7,      'TL', 0, 'L', 1);
	$dev7 = sprintf("%2.1f",$dev7);
	$pdf->Cell(8.5,5, $dev7,   'TL', 0, 'C', 1);
	//リーダーシップ発揮力
	$pdf->Cell(38, 5, $msg10,      'TL', 0, 'L', 1);
	$dev10 = sprintf("%2.1f",$dev10);
	$pdf->Cell(8.5,5, $dev10,  'TLR', 1, 'C', 1);

	//客観的自己評価力
	$pdf->Cell(38, 5, $msg2,     'TL', 0, 'L', 1);
	$dev2 = sprintf("%2.1f",$dev2);
	$pdf->Cell(8.5,5, $dev2,   'TL', 0, 'C', 1);
	//ビジョン創出力
	$pdf->Cell(44, 5, $msg5,        'TL', 0, 'L', 1);
	$dev5 = sprintf("%2.1f",$dev5);
	$pdf->Cell(8.5,5, $dev5,   'TL', 0, 'C', 1);
	//状況察知力
	$pdf->Cell(38, 5, $msg8,      'TL', 0, 'L', 1);
	$dev8 = sprintf("%2.1f",$dev8);
	$pdf->Cell(8.5,5, $dev8,   'TL', 0, 'C', 1);
	//アサーション発揮力
	$pdf->Cell(38, 5, $msg11,       'TL', 0, 'L', 1);
	$dev11 = sprintf("%2.1f",$dev11);
	$pdf->Cell(8.5,5, $dev11,  'TLR', 1, 'C', 1);


	//自己肯定力
	$pdf->Cell(38, 5, $msg3,       'TLB', 0, 'L', 1);
	$dev3 = sprintf("%2.1f",$dev3);
	$pdf->Cell(8.5,5, $dev3,   'TLB', 0, 'C', 1);
	//ポジティブ思考力
	$pdf->Cell(44, 5, $msg6,       'TLB', 0, 'L', 1);
	$dev6 = sprintf("%2.1f",$dev6);
	$pdf->Cell(8.5,5, $dev6,   'TLB', 0, 'C', 1);
	//ホスピタリティ発揮力
	$pdf->Cell(38, 5, $msg9,      'TLB', 0, 'L', 1);
	$dev9 = sprintf("%2.1f",$dev9);
	$pdf->Cell(8.5,5, $dev9,   'TLB', 0, 'C', 1);
	//集団適応力
	$pdf->Cell(38, 5, $msg12,      'TLB', 0, 'L', 1);
	$dev12 = sprintf("%2.1f",$dev12);
	$pdf->Cell(8.5,5, $dev12,  'TLBR', 1, 'C', 1);
	$pdf->Ln(3);
	//↑2.行動価値　12特性のスコアとチャートここまで↑


	//↓レーダーチャート↓

	//外枠を作成
	$pdf->Cell(192, 110, "",    1, 1, 'C', 1);

	//レーダー出力
	$pdf->Image($gimg1, 57, 98.5);

	$en1 = "./images/en01.gif";
	$pdf->Image($en1, 54.75, 98);
//			$pdf->Image($gimg2, 12, 98.5);

	//↓四隅の項目名を出力↓
	$pdf->SetDrawColor(204, 204, 204);
	$pdf->SetFontSize(10);

	$pdf->Rect(17, 106, 25, 8, 'D');
	$pdf->Rect(18, 107, 23, 6, 'D');
	$pdf->Text(21, 111.25, "対人影響力");

	$pdf->Rect(167, 106, 25, 8, 'D');
	$pdf->Rect(168, 107, 23, 6, 'D');
	$pdf->Text(171, 111.25, "自己認知力");

	$pdf->Rect(17, 183, 25, 8, 'D');
	$pdf->Rect(18, 184, 23, 6, 'D');
	$pdf->Text(21, 188.25, "対人認知力");

	$pdf->Rect(167, 183, 25, 8, 'D');
	$pdf->Rect(168, 184, 23, 6, 'D');
	$pdf->Text(171, 188.25, "自己安定力");
	//↑四隅の項目名を出力ここまで↑

	//↓レーダーの数値↓
	$pdf->SetDrawColor(0, 0, 0);
	$pdf->SetFontSize(8);

	$pdf->Text(99, 107, 80);
	$pdf->Text(99, 114.75, 70);
	$pdf->Text(99, 122.25, 60);
	$pdf->Text(99, 129.75, 50);
	$pdf->Text(99, 136, 40);
	$pdf->Text(99, 142.25, 30);
	$pdf->Text(99, 148.25, 20);
	//↑レーダーの数値ここまで↑

	$waku_w = "./images/waku_w.gif";

	//自己感情モニタリング力
	$pdf->SetXY(92.0, 95.0);
	$pdf->MultiCell(30, 4, $gmsg1,0,"C");

	//客観的自己評価力
	$pdf->SetXY(120.0, 104.0);
	$pdf->MultiCell(30, 4, $gmsg2,0,"C");
	//自己肯定力
	$pdf->SetXY(139.0, 126.0);
	$pdf->MultiCell(30, 4, $gmsg3,0,"C");

	//コントロール＆アチーブメント力
	$pdf->SetXY(149.0, 147.4);
	$pdf->MultiCell(30, 4, $gmsg4,0,"C");

	//ビジョン創出力
	$pdf->SetXY(135.0, 170.0);
	$pdf->MultiCell(30, 4, $gmsg5,0,"C");

	//ポジティブ思考力
	$pdf->SetXY(124.0, 188.0);
	$pdf->MultiCell(30, 4, $gmsg6,0,"C");

	//対人共感力
	$pdf->SetXY(93.0, 194.0);
	$pdf->MultiCell(30, 4, $gmsg7,0,"C");

	//状況察知力
	$pdf->SetXY(65.0, 189.0);
	$pdf->MultiCell(30, 4, $gmsg8,0,"C");

	//ホスピタリティ発揮力
	$pdf->SetXY(46.0, 171.0);
	$pdf->MultiCell(30, 4, $gmsg9,0,"C");

	//リーダーシップ発揮力
	$pdf->SetXY(35.0, 148.0);
	$pdf->MultiCell(30, 4, $gmsg10,0,"C");


	//アサーション発揮力
	$pdf->SetXY(42.5, 123.0);
	$pdf->MultiCell(30, 4, $gmsg11,0,"C");

	//集団適応力
	$pdf->SetXY(60.0, 107.0);
	$pdf->MultiCell(30, 4, $gmsg12,0,"C");

	//↑レーダーチャートここまで↑
	
	
	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	unlink($gimg1);

	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------

	$pdf->SetXY(10.0, 208.0);
	//質問例
	$pdf->SetFontSize(8);
	$pdf->Write("5",$ques2);
	$pdf->Ln();
	$pdf->SetFillColor(204, 255, 204);
	$pdf->Cell(35, 4, "重視している要素", 1, 0, 'C', 1);
	$pdf->Cell(157, 4, "重視している要素が発揮された場合の特徴", 1, 1, 'C', 1);
	
	$pdf->SetFillColor(255, 255, 255);
	
	$i = 0;
	foreach($strongPoint as $k=>$v){

		//重視している要素
		$title =  $a_questions[$k];
		//重視している要素が発揮された場合の特徴
		$str   = $array_pdf_strongPoint[$k];
		if($i == 0){
			//要素名1
			
			$pdf->MultiCell(35, 28,"", 'LB');
			//重視している要素が発揮された場合の特徴1
			$pdf->SetXY(45,217);
			$pdf->MultiCell(157, 4, $str, 'LBR');

			$spCnt = 20;
			$titleSp = str_split($title, $spCnt);
			$pdf->Text(15,231,$titleSp[0]);
			$pdf->Text(15,234,$titleSp[1]);
		}

		if($i == 1){
			//要素名2
			$pdf->MultiCell(35, 28,"", 'LB');
			//重視している要素が発揮された場合の特徴2
			$pdf->SetXY(45,245);
			$pdf->MultiCell(157, 4, $str, 'LBR');
			
			$spCnt = 20;
			$titleSp = str_split($title, $spCnt);
			$pdf->Text(15,259,$titleSp[0]);
			$pdf->Text(15,262,$titleSp[1]);
		}

		$i++;
	}

$pdf->Ln(2);

//フッター出力
$pdf->SetFontSize(7);
$pdf->Cell(192, 1, $number, 0,1,'R');
$pdf->Ln(1);
$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');


?>