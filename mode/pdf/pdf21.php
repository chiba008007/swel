<?PHP
$cover = "./images/pdf21.jpg";
$pdf->Image($cover, 52, 100);

$pdf->AddPage();

//----------------------------------------------
//チャートグラフ画像作成
//----------------------------------------------
$gimg1 = "./images/pdf/graf".$id.$third.".png";

	//-------------------------------
	//対策実施状況の計算
	//------------------------------
	$total = $rs21[ 'result1' ]+$rs21[ 'result2' ]+$rs21[ 'result3' ]+$rs21[ 'result4' ]+$rs21[ 'result5' ]+$rs21[ 'result6' ]+$rs21[ 'result7' ]+$rs21[ 'result8' ]+$rs21[ 'result9' ]+$rs21[ 'result10' ];
	$score = round((($total-52.3)/22.28)*10+50,1);
	if($score >= 80){
		$score = 80;
	}
	if($score <= 20 ){
		$score = 20;
	}
	$lv = getLevel($total);
	//素点よりグラフバーの表示
	$gimg = "./images/pdf/bar".$id.$third."_2.jpg";
	getBars($score,$gimg,1);

	$kodo_array = array(
					 $rs21[ 'result1'  ]*1.25
					,$rs21[ 'result2'  ]*1.25
					,$rs21[ 'result3'  ]*1.25
					,$rs21[ 'result4'  ]*1.25
					,$rs21[ 'result5'  ]*1.25
					,$rs21[ 'result6'  ]*1.25
					,$rs21[ 'result7'  ]*1.25
					,$rs21[ 'result8'  ]*1.25
					,$rs21[ 'result9'  ]*1.25
					,$rs21[ 'result10' ]*1.25
					);
	$MyData = new pData2();
	$MyData->addPoints($kodo_array,"ScoreA");  
	$MyData->setPalette("ScoreA",array("R"=>0,"G"=>0,"B"=>255));
	
	$myPicture = new pImage(420,420,$MyData);
//	$myPicture->setFontProperties(array("FontName"=>"./init/Fonts/Forgotte.ttf","FontSize"=>20,"R"=>0,"G"=>0,"B"=>255));
	// 背景色と背景色に入れる斜線の色を指定
	$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
	// 背景を描く
//	$myPicture->drawFilledRectangle(0,0,600,600,$Settings);
	$SplitChart = new pRadar();
	$myPicture->setGraphArea(0,0,420,420);
	// グラフに影を付ける
	//$myPicture->setShadow(TRUE,array("X"=>5,"Y"=>5,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 
	$Options = array("FixedMax"=>25,"AxisRotation"=>-90,"Layout"=>RADAR_LAYOUT_STAR,
					"WriteValues"=>FALSE, // データセットの値を表示 
				);
	$SplitChart->drawRadar($myPicture,$MyData,$Options);
	$myPicture->render($gimg1);


	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	$make->makePdfKozin($pdf,$testdata,21);
	$pdf->SetFillColor(250, 240, 230);
	$pdf->Ln(2);
	$pdf->Cell(100, 5, '[1]メンタルヘルス対策実施状況診断で測定していること', 0, 1, 'L', 1);
	$msg = "診断は、貴社内におけるメンタルヘルス対策の実施状況レベルを多方面から具体的に把握し、それをもって労務リスク最小化のための施策立案に\n役立てるために行うものです。";
	$pdf->Ln(1);
	$pdf->SetDrawColor(220, 220, 220);
	$pdf->MultiCell(192.5,4, $msg,1,"L");


	$pdf->Ln(2);
	$pdf->Cell(100, 5, '[2]貴社内におけるメンタルヘルス対策実施状況レベル', 0, 1, 'L', 1);
	
	//-----------------------------
	//棒グラフ表示用枠
	//-----------------------------
	$pdf->Ln(2);
	$pdf->SetFillColor(255,255,255);
	$pdf->Cell(22, 4, "　", 'LT', 0, 'C', 1);
	$pdf->Cell(10, 8, "レベル", 'LTB', 0, 'C', 1);
	$pdf->Cell(10, 8, "スコア", 'LTBR', 0, 'C', 1);
	$pdf->SetFontSize(8);
	$pdf->Cell(38,   4, "1", 'TL', 0, 'C', 1);
	$pdf->Cell(24.5, 4, "2", 'TL', 0, 'C', 1);
	$pdf->Cell(23.5, 4, "3", 'TL', 0, 'C', 1);
	$pdf->Cell(24.5, 4, "4", 'TL', 0, 'C', 1);
	$pdf->Cell(39.5, 4, "5", 'TLR', 1, 'C', 1);
	$pdf->Cell(22, 4, "　", 'LRB', 0, 'C', 1);
	$pdf->Cell(10, 0, " ",  '',    0, 'C', 1);
	$pdf->Cell(10, 0, " ",  '',    0, 'C', 1);
	$pdf->Cell(24, 4, "20", 'TBL', 0, 'L', 1);
	$pdf->Cell(24, 4, "30", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 4, "40", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 4, "50", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 4, "60", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 4, "70", 'TB', 0, 'L', 1);
	$pdf->Cell(6,  4, "80", 'TRB', 1, 'L', 1);
	$pdf->Cell(22, 6, "対策実施状況", 1, 0, 'L', 1);
	//スコアを出力する
	$pdf->Cell(10, 6,"　".$lv, 1, 0, 'L', 1);
	//レベルを出力する
	$pdf->Cell(10, 6,"　".$score, 1, 0, 'L', 1);
	$pdf->Cell(2, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 6, "", 1, 0, 'C', 1);
	$pdf->Cell(4,  6, "", 1, 1, 'C', 1);
	$pdf->Image($gimg, 52, 74.5);

	//-----------------------------------------------------
	//円グラフ表示
	//-----------------------------------------------------
	$pdf->Ln(2);
	$pdf->SetFillColor(250, 240, 230);
	$pdf->Cell(100, 5, '[3]貴社内における対策実施状況詳細', 0, 1, 'L', 1);
	$pdf->Ln(2);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->Cell(192, 135, "",    1, 1, 'C', 1);
	$pdf->Image($gimg1, 52, 100);
	//円グラフメモリ
	$pdf->Text(105, 157, 0);
	$pdf->Text(105, 147, 4);
	$pdf->Text(105, 137, 8);
	$pdf->Text(105, 127, 12);
	$pdf->Text(105, 117, 16);
	$pdf->Text(105, 107, 20);
	
	$pdf->Text(97, 100,  "1.経営者/企業の姿勢");
	$pdf->Text(135, 110,  "2.人事/労働部門の体制");
	$pdf->Text(157, 140,  "3.従業員への意識付け");
	$pdf->Text(157, 172,  "4.産業医の適切な配備と運用");
	$pdf->Text(135, 203,  "5.定期診断の実施");
	$pdf->Text(97, 212,  "6.過重労働対応");
	$pdf->Text(50, 203,  "7.健康/メンタル相談体制");
	$pdf->Text(30, 172,  "8.休職と復職に関して");
	$pdf->Text(25, 140,  "9.安心・安全な職場づくり");
	$pdf->Text(50, 110,  "10.個人情報の取り扱い");

	$pdf->Ln(2);
	$pdf->SetDrawColor(220, 220, 220);
	$pdf->SetFillColor(250, 240, 230);
	$pdf->Ln(2);
	$pdf->Cell(100, 5, '[4]診断結果に基づいたリスクとアドバイス', 0, 1, 'L', 1);
	$pdf->Ln(2);
	//表示用配列の作成
	//表示ロジックは、10個の要素がありますが、最も素点が低い2個を表示してください。
	//同じ得点があった場合は、番号が若い方を優先してください。
	$amms = array(
				array(
					"key"=>1
					,"val"=>$rs21[ 'result1'  ]
				),
				array(
					"key"=>2
					,"val"=>$rs21[ 'result2'  ]
				),
				array(
					"key"=>3
					,"val"=>$rs21[ 'result3'  ]
				),
				array(
					"key"=>4
					,"val"=>$rs21[ 'result4'  ]
				),
				array(
					"key"=>5
					,"val"=>$rs21[ 'result5'  ]
				),
				array(
					"key"=>6
					,"val"=>$rs21[ 'result6'  ]
				),
				array(
					"key"=>7
					,"val"=>$rs21[ 'result7'  ]
				),
				array(
					"key"=>8
					,"val"=>$rs21[ 'result8'  ]
				),
				array(
					"key"=>9
					,"val"=>$rs21[ 'result9'  ]
				),
				array(
					"key"=>10
					,"val"=>$rs21[ 'result10'  ]
				),
			);
	foreach ($amms as $v) $amounts[] = $v['val'];
	array_multisort($amounts, SORT_ASC, $amms);

	$one = $amms[0][ 'key' ];
	$two = $amms[1][ 'key' ];
	$pdf->MultiCell(192.5,4,$mms_pdf[$one],1,"L");
	$pdf->MultiCell(192.5,4,$mms_pdf[$two],1,"L");
	$pdf->Ln(2);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');
	
	$pdf->AddPage();
	$pdf->SetFillColor(250, 240, 230);
	$pdf->Ln(2);
	$pdf->Cell(100, 5, '結果の解説', 0, 1, 'L', 1);
	$pdf->Ln(2);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->Cell(100, 5, '■貴社内におけるメンタルヘルス対策実施状況レベルについて', 0, 1, 'L', 1);
	$pdf->SetXY(15.0, 25.0);
	$pdf->Cell(100, 5, '実施状況レベルは5段階で表示されます。', 0, 1, 'L', 1);

	$pdf->SetXY(15.0, 35.0);
	$pdf->SetFillColor(250, 240, 230);
	$pdf->Cell(22, 10, "レベル", 'LT', 0, 'C', 1);
	$pdf->Cell(165, 10, "コメント", 'LTR', 1, 'C', 1);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetXY(15.0, 45.0);
	$pdf->Cell(22, 10, "レベル5", 'LT', 0, 'L', 1);
	$pdf->Cell(165, 10, "現在貴社では、メンタルヘルス対策が機能しており、労災、賠償リスクなどは見受けられません。", 'LTR', 1, 'L', 1);
	$pdf->SetXY(15.0, 55.0);
	$pdf->Cell(22, 10, "レベル4", 'LT', 0, 'L', 1);
	$pdf->Cell(165, 10, "現在貴社では、メンタルヘルス対策が機能していますが、一部にごく小さなリスクが見受けられます。", 'LTR', 1, 'L', 1);
	$pdf->SetXY(15.0, 65.0);
	$pdf->Cell(22, 10, "レベル3", 'LT', 0, 'L', 1);
	$pdf->Cell(165, 10, "現在貴社では、メンタルヘルス対策の項目によってばらつきがあり、ややリスクの高い状態です。", 'LTR', 1, 'L', 1);
	$pdf->SetXY(15.0, 75.0);
	$pdf->Cell(22, 10, "レベル2", 'LT', 0, 'L', 1);
	$pdf->Cell(165, 10, "現在貴社では、メンタルヘルス対策が機能しておらず、放置すればリスクが増大していく状況にあります。", 'LTR', 1, 'L', 1);
	$pdf->SetXY(15.0, 85.0);
	$pdf->Cell(22, 10, "レベル1", 'LTB', 0, 'L', 1);
	$pdf->Cell(165, 10, "現在貴社では、メンタルヘルス対策が無く、いつ事件や事故にあってもおかしくない状況にあります。", 'LTRB', 1, 'L', 1);

	$pdf->SetXY(10, 100.0);
	$pdf->Cell(100, 5, '■10項目について', 0, 1, 'L', 1);
	$pdf->SetXY(12.0, 105.0);
	$pdf->Cell(100, 5, '10項目のスコアについて', 1, 1, 'L', 1);
	$pdf->SetXY(15.0, 112.0);
	$pdf->Cell(180, 2, '・10項目のスコアは、標準得点（偏差値）と呼ばれる数値で得点を表示しています。', 0, 1, 'L', 1);
	$pdf->SetXY(15.0, 117.0);
	$pdf->Cell(180, 2, '・標準得点（偏差値）とは、得点の基準となる母集団の平均を「50」として、平均からどれくらい離れているかを得点化した数値を意味しています。', 0, 1, 'L', 1);
	$pdf->SetXY(15.0, 122.0);
	$pdf->Cell(180, 2, '　標準得点を用いることにより、母集団のなかでの受検者の相対的な位置を客観的に把握することができます。', 0, 1, 'L', 1);
	$pdf->SetXY(15.0, 127.0);
	$pdf->Cell(180, 2, '　また、標準得点に対する出現率も確認することができます。', 0, 1, 'L', 1);
	$pdf->SetXY(15.0, 132.0);
	$pdf->Cell(180, 2, '・出現率とは、受検者の得点が母集団の中でどの程度出現するのかを知ることができます。', 0, 1, 'L', 1);
	$pdf->SetXY(15.0, 142.0);
	$pdf->Cell(180, 2, '【出現率】', 0, 1, 'L', 1);
	$pdf->SetXY(15.0, 147.0);
	$pdf->Cell(180, 2, '20以上-35未満　7%、35以上-45未満　24%、45以上-55未満　38%、55以上-65未満　24%、65以上　7%', 0, 1, 'L', 1);
	$pdf->SetXY(15.0, 155.0);
	$pdf->Cell(100, 5, '10項目の測定内容', 1, 1, 'L', 1);
	$pdf->SetXY(15.0, 162.0);

	$pdf->SetFillColor(250, 240, 230);
	$pdf->Cell(37, 10, "項目名", 'LT', 0, 'C', 1);
	$pdf->Cell(150, 10, "測定内容", 'LTR', 1, 'C', 1);
	$pdf->SetFillColor(255, 255, 255);
	$pdf->SetXY(15.0, 172.0);
	$pdf->Cell(37, 10, "1.経営者/企業の姿勢", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "現在貴社では、メンタルヘルス対策が機能しており、労災、賠償リスクなどは見受けられません", 'LTR', 1, 'L', 1);
	$pdf->SetXY(15.0, 182.0);
	$pdf->Cell(37, 10, "2.人事・労務部門の体制", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "人事部門が、正しい知識を持ち、社内規程の整備や経営トップへの報告、そして各施策の実施と検証など、行っているかどうか", 'LTR', 1, 'L', 1);
	$pdf->SetXY(15.0, 192.0);
	$pdf->Cell(37, 10, "3.従業員の意識付け", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "従業員に正しい知識を与え、自ら健康を守ろうとする意識を植え付けているかどうか", 'LTR', 1, 'L', 1);
	$pdf->SetXY(15.0, 202.0);
	$pdf->Cell(37, 10, "4.産業医の適切な配備と運用", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "産業医との連携を取るための規程、ルールを策定し、使いやすい帳票類を活用しているかどうか", 'LTR', 1, 'L', 1);

	$pdf->SetXY(15.0, 212.0);
	$pdf->Cell(37, 10, "5.定期健康診断の実施", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "労働安全衛生法に則った定期健康診断の実施と事後措置ができているかどうか", 'LTR', 1, 'L', 1);

	$pdf->SetXY(15.0, 222.0);
	$pdf->Cell(37, 10, "6.過重労働者対応", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "労働安全衛生法に則って、長時間労働者の医師面接を実施しているかどうか", 'LTR', 1, 'L', 1);

	$pdf->SetXY(15.0, 232.0);
	$pdf->Cell(37, 10, "7.健康/メンタル相談窓口", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "従業員が不調を感じたとき、気軽にいつでも相談できる窓口を提供しているかどうか", 'LTR', 1, 'L', 1);

	$pdf->SetXY(15.0, 242.0);
	$pdf->Cell(37, 10, "8.休職と退職", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "メンタル不調による休職や復職など、一連の流れに関する社内規程や手順が明文化されているかどうか", 'LTR', 1, 'L', 1);

	$pdf->SetXY(15.0, 252.0);
	$pdf->Cell(37, 10, "9.安心・安全な職場作り", 'LT', 0, 'L', 1);
	$pdf->Cell(150, 10, "ハラスメントの防止など、誰もが働きやすい職場を作るためのルールがあり、また、周知のための教育が実施されているかどうか", 'LTR', 1, 'L', 1);

	$pdf->SetXY(15.0, 262.0);
	$pdf->Cell(37, 10, "10.個人情報の取り扱い", 'LTB', 0, 'L', 1);
	$pdf->Cell(150, 10, "従業員の健康情報の取り扱いに関するルールが定められ、きちんと運用されているかどうか", 'LTRB', 1, 'L', 1);

	$pdf->Ln(2);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');

	

	
	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	unlink($gimg1);
	
	function getLevel($total){
		if($total >= 65){
			$lv = 5;
		}elseif($total >= 55){
			$lv = 4;
		}elseif($total >= 45){
			$lv = 3;
		}elseif($total >= 35){
			$lv = 2;
		}else{
			$lv = 1;
		}
		return $lv;
	}
	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------
	
	function getBars($sc,$gimg,$flg=""){
		
		$st_score = $sc;
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
			$wid = $st_score2 + 8;
		}else{
			$wid = 1;
		}
		$im        = imagecreatetruecolor($wid, 10);
		if($flg){
			$img_color = imagecolorallocate($im, 255, 255, 0);
			$gray      = imagecolorallocate($im, 255, 255, 0);
		}else{
			$img_color = imagecolorallocate($im, 242, 216, 223);
			$gray      = imagecolorallocate($im, 242, 216, 223);
		}
		imagefill($im , 0 , 0 , $gray);
		imagefilledrectangle($im, 1, 1, $wid, 8, $img_color);

		$text_color = imagecolorallocate($im, 255, 0, 0);
		imagestring($im, 1, 5, 5,  "", $text_color);
		imagejpeg($im, $gimg);
		imagedestroy($im);
	}

?>