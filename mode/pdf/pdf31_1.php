<?PHP
include_once("./lib/pChart/pData.class.php");
include_once("./lib/pChart/pDraw.class.php");
include_once("./lib/pChart/pRadar.class.php");
include_once("./lib/pChart/pImage.class.php");


$MyData = new pData();   
$MyData->addPoints(array(40,20,15,10,8,4),"ScoreA"); 
$MyData->addPoints(array(8,10,12,20,30,15),"ScoreB");
$MyData->setSerieDescription("ScoreA","Application A");
$MyData->setSerieDescription("ScoreB","Application B");
$MyData->addPoints(array("Size","Speed","Reliability","Functionalities","Ease of use","Weight"),"Labels");
$MyData->setAbscissa("Labels");

$myPicture = new pImage(700,230,$MyData);


/* Draw a solid background */
$Settings = array("R"=>179, "G"=>217, "B"=>91, "Dash"=>1, "DashR"=>199, "DashG"=>237, "DashB"=>111);
$myPicture->drawFilledRectangle(0,0,700,230,$Settings);
/* Overlay some gradient areas */
$Settings = array("StartR"=>194, "StartG"=>231, "StartB"=>44, "EndR"=>43, "EndG"=>107, "EndB"=>58, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));
/* Draw the border */
$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));
/* Write the title */
$myPicture->setFontProperties(array("FontName"=>"fonts/Silkscreen.ttf","FontSize"=>6));
$myPicture->drawText(10,13,"pRadar - Draw radar charts",array("R"=>255,"G"=>255,"B"=>255));
/* Define general drawing parameters */
$myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));
$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
/* Create the radar object */
$SplitChart = new pRadar();
/* Draw the 1st radar chart */
$myPicture->setGraphArea(10,25,340,225);
$Options = array("Layout"=>RADAR_LAYOUT_STAR,"BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>100,"EndR"=>207,"EndG"=>227,"EndB"=>125,"EndAlpha"=>50));
$SplitChart->drawRadar($myPicture,$MyData,$Options);
/* Draw the 2nd radar chart */
$myPicture->setGraphArea(350,25,690,225);
$Options = array("Layout"=>RADAR_LAYOUT_CIRCLE, "LabelPos"=>RADAR_LABELS_HORIZONTAL, "BackgroundGradient"=>array("StartR"=>255,"StartG"=>255,"StartB"=>255,"StartAlpha"=>50,"EndR"=>32,"EndG"=>109,"EndB"=>174,"EndAlpha"=>30));
$SplitChart->drawRadar($myPicture,$MyData,$Options);
/* Write down the legend */
$myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));
$myPicture->drawLegend(270,205,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL));
/* Render the picture */
$myPicture->Render("drawradar.png");

//----------------------------------------------
//　棒グラフ
//----------------------------------------------
$img31 = "./images/pdf/pdf31/img".$id.".jpg";
createBarImage31($testdata['score'], $img31);


function createBarImage31($st_score, $img1_bar)
{
	define("ST", 20);
	define("DIFF", 37);
	// 調整の値
	$adjust = 0;
	if ($st_score >= 80) {
		$adjust = 30;
	} else
		if ($st_score >= 70) {
		$adjust = 24;
	} else
		if ($st_score >= 60) {
		$adjust = 18;
	} else
		if ($st_score >= 50) {
		$adjust = 10;
	} else
		if ($st_score >= 40) {
		$adjust = 5;
	}
	$counts = ($st_score - ST) / 5;
	$wid = DIFF * $counts - $adjust;
	if ($wid == 0) $wid = 1;

	$im        = imagecreatetruecolor($wid, 6);
	$img_color = imagecolorallocate($im, 1, 101, 255);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im, 0, 0, $gray);
	imagefilledrectangle($im, 1, 1, $wid - 2, 6, $img_color);
	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img1_bar);
	
	imagedestroy($im);
}


exit();
/*
$msg1 = "自己感情モニタリング力";
        $msg2 = "客観的自己評価力";
        $msg3 = "自己肯定力";
        $msg4 = "コントロール＆アチーブメント力";
        $msg5 = "ビジョン創出力";
        $msg6 = "ポジティブ思考力";
        $msg7 = "対人共感力";
        $msg8 = "状況察知力";
        $msg9 = "ホスピタリティ発揮力";
        $msg10 = "リーダーシップ発揮力";
        $msg11 = "アサーション発揮力";
        $msg12 = "集団適応力";
        //pdf用質問タイトル
	$a_questions = array(
		"dev1"=> mb_convert_encoding($msg1,"sjis-win","utf-8")
		,"dev2"=>mb_convert_encoding($msg2,"sjis-win","utf-8")
		,"dev3"=>mb_convert_encoding($msg3,"sjis-win","utf-8")
		,"dev4"=>mb_convert_encoding($msg4,"sjis-win","utf-8")
		,"dev5"=>mb_convert_encoding($msg5,"sjis-win","utf-8")
		,"dev6"=>mb_convert_encoding($msg6,"sjis-win","utf-8")
		,"dev7"=>mb_convert_encoding($msg7,"sjis-win","utf-8")
		,"dev8"=>mb_convert_encoding($msg8,"sjis-win","utf-8")
		,"dev9"=>mb_convert_encoding($msg9,"sjis-win","utf-8")
		,"dev10"=>mb_convert_encoding($msg10,"sjis-win","utf-8")
		,"dev11"=>mb_convert_encoding($msg11,"sjis-win","utf-8")
		,"dev12"=>mb_convert_encoding($msg12,"sjis-win","utf-8")
	);

	//----------------------------------------------
	//棒グラフ画像作成
	//----------------------------------------------

	$img31 = "./images/pdf/pdf31/img".$id.".jpg";
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
	
	$im        = imagecreatetruecolor($wid, 20);
	$img_color = imagecolorallocate($im, 127, 171, 226);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, 18, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 10, 5, 5,  "", $text_color);
	imagejpeg($im, $img31);
	imagedestroy($im);
        
	//----------------------------------------------
	//棒グラフ画像作成終わり
	//----------------------------------------------
	//----------------------------------------------
	//チャートグラフ画像作成
	//----------------------------------------------

	$gimg1 = "./images/pdf/pdf31/graf".$id.".png";
    
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
  
// スコアのデータセット 
$MyData->addPoints($kodo_array,"ScoreA"); 
$MyData->setSerieDescription("ScoreA","Application A"); 
$MyData->setPalette("ScoreA",array("R"=>65,"G"=>105,"B"=>225)); 

 
// チャートの項目 
$MyData->addPoints(array($msg1,$msg2,$msg3,$msg4,$msg5,$msg6,$msg7,$msg8,$msg9,$msg10,$msg11,$msg12),"Point"); 
$MyData->setAbscissa("Point"); 
  
// グラフのサイズとデータセットを引数に渡してpChartオブジェクトを生成 
$myPicture = new pImage(540,540,$MyData); 

// 背景色と背景色に入れる斜線の色を指定 
//$Settings = array("R"=>0, "G"=>0, "B"=>0, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107,"Alpha"=>0); 
// 背景を描く 
//$myPicture->drawFilledRectangle(0,0,520,520,$Settings); 
  
// グラフのタイトルをセット 
//$myPicture->setFontProperties(array("FontName"=>"./init/Fonts/TakaoPMincho.ttf","FontSize"=>8)); 
// グラフタイトルを書く 
//$myPicture->drawText(10,18,"勇者のステータス",array("R"=>0,"G"=>0,"B"=>0)); 
  
// フォンとサイズ、色のを切り替え 
$myPicture->setFontProperties(array("FontName"=>"./init/Fonts/Forgotte.ttf","FontSize"=>0.1,"R"=>80,"G"=>80,"B"=>80)); 
  
// グラフに影を付ける 
//$myPicture->setShadow(TRUE,array("X"=>5,"Y"=>5,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 
  
// レーダーチャート作成用オブジェクトを生成 
$SplitChart = new pRadar(); 

// レーダーチャートを書くX軸、Y軸、幅、高さ 
$myPicture->setGraphArea(165,-135,548,548); 
// レーダーチャートのオプション 
$Options = array( 
    "FixedMax"=>6, // データセットの最大値 
    "WriteValues"=>FALSE, // データセットの値を表示 
    "DrawPoly"=>FALSE, // データセットをつないだ領域を塗りつぶす 
    "AxisRotation"=>-75, // グラフの回転角度 
    "Layout"=>RADAR_LAYOUT_STAR, // レーダーチャートのレイアウト(星型) 
    "LabelPos"=>RADAR_LABELS_HORIZONTAL, // ラベルの表示形式(水平) 
    "BackgroundGradient"=> // レーダーチャート内のグラデーション 
        array( 
        //    "StartR"=>255,"StartG"=>255,"StartB"=>255, 
         //   "StartAlpha"=>100, 
          //  "EndR"=>207,"EndG"=>125,"EndB"=>227, 
          //  "EndAlpha"=>50
            )
    
    ); 
// レーダーチャートを描く 
$SplitChart->drawRadar2($myPicture,$MyData,$Options); 
  
// 描いたグラフの保存 
$myPicture->render($gimg1); 
        

$imgname=$gimg1;
//$im = imagecreatefromjpeg($imgname);
$im = imagecreatefrompng($imgname); //pngから読むならこれ

$background = imagecolorallocate($im, 255, 0, 0); //とりあえず真っ赤を背景に
list($width, $height) = getimagesize($imgname);

 for($i=0;$i<$width;$i++){
 for($j=0;$j<$height;$j++){
 $rgb = imagecolorat($im, $i,$j);
 $r = ($rgb >> 16) & 0xFF;
 $g = ($rgb >> 8) & 0xFF;
 $b = $rgb & 0xFF;
 if($r>200 and $g>200 and $b>200) imagefill($im, $i, $j, $background);
 }
 }
 
 
 imagecolortransparent($im, $background);
 header('Content-Type: image/png');
 imagepng($im,$gimg1);
 imagedestroy($im);
 
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

/*
		//$msg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
		$gmsg1 = mb_convert_encoding($gmsg1[ 'e_feel' ],"SJIS","UTF-8");


		$msg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");
		$gmsg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");

		$msg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");
		$gmsg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");

		$msg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");
		$gmsg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");

		$msg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");
		$gmsg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");

		$msg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");
		$gmsg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");

		$msg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");
		$gmsg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");

		$msg8 = mb_convert_encoding($elem[ 'e_situ' ],"SJIS","UTF-8");
		$gmsg8 = mb_convert_encoding($elem[ 'e_situ' ],"SJIS","UTF-8");

		$msg9 = mb_convert_encoding($elem[ 'e_hosp' ],"SJIS","UTF-8");
		$gmsg9 = mb_convert_encoding($elem[ 'e_hosp' ],"SJIS","UTF-8");

		$msg10 = mb_convert_encoding($elem[ 'e_lead' ],"SJIS","UTF-8");
		$gmsg10 = mb_convert_encoding($elem[ 'e_lead' ],"SJIS","UTF-8");

		$msg11 = mb_convert_encoding($elem[ 'e_ass' ],"SJIS","UTF-8");
		$gmsg11 = mb_convert_encoding($elem[ 'e_ass' ],"SJIS","UTF-8");

		$msg12 = mb_convert_encoding($elem[ 'e_adap' ],"SJIS","UTF-8");
		$gmsg12 = mb_convert_encoding($elem[ 'e_adap' ],"SJIS","UTF-8");
*/
        $gmsg1 = mb_convert_encoding($msg1,"SJIS","UTF-8");
        $gmsg2 = mb_convert_encoding($msg2,"SJIS","UTF-8");
        $gmsg3 = mb_convert_encoding($msg3,"SJIS","UTF-8");
        $gmsg4 = mb_convert_encoding($msg4,"SJIS","UTF-8");
        $gmsg5 = mb_convert_encoding($msg5,"SJIS","UTF-8");
        $gmsg6 = mb_convert_encoding($msg6,"SJIS","UTF-8");
        $gmsg7 = mb_convert_encoding($msg7,"SJIS","UTF-8");
        $gmsg8 = mb_convert_encoding($msg8,"SJIS","UTF-8");
        $gmsg9 = mb_convert_encoding($msg9,"SJIS","UTF-8");
        $gmsg10 = mb_convert_encoding($msg10,"SJIS","UTF-8");
        $gmsg11 = mb_convert_encoding($msg11,"SJIS","UTF-8");
        $gmsg12 = mb_convert_encoding($msg12,"SJIS","UTF-8");


	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	//$make->makePdfKozin($pdf,$testdata,31);
                    $pdf->SetXY(10,10);
                    $pdf->SetFontSize(16);
                    $pdf->Write("0",mb_convert_encoding('個人結果シート(面接版)',"sjis-win","utf-8"));
                    
                    $pdf->SetFontSize(11);
                    $pdf->SetXY(140,10);
                    $cus_name  = mb_convert_encoding($testdata[ 'cusname'  ],"sjis-win","utf-8");
                    $pdf->Write("0",mb_convert_encoding('企業名：',"sjis-win","utf-8").$cus_name);


                    $pdf->SetXY(10,18);
                    $pdf->SetFontSize(8);
                    $txt1  = mb_convert_encoding("受検日","sjis-win","utf-8");
                    $pdf->Cell(14, 10, $txt1, 'TB',0,'C');
                    $dates = explode(" ",$testdata[ 'exam_dates'  ]);
                    
                    $dates2 = explode("-",preg_replace("/\//","-",$dates[0]));
                    $txt1  = $dates2[0]."/".$dates2[1]."/".$dates2[2];
                    $pdf->Cell(30, 10, $txt1, 'TBL',0,'C');
                    $txt1  = mb_convert_encoding("受検者ID","sjis-win","utf-8");
                    $pdf->Cell(22, 10, $txt1, 'TBL',0,'C');
                    $txt1  = $testdata[ 'exam_id' ];
                    $pdf->Cell(26, 10, $txt1, 'TBL',0,'C');
                    
                    $txt1  = mb_convert_encoding("氏名","sjis-win","utf-8");
                    $pdf->Cell(13, 10, $txt1, 'TBL',0,'C');
                    $txt1  = $testdata[ 'name' ].'('.$testdata[ 'kana' ].')';
                    $txt1  = mb_convert_encoding($txt1,"sjis-win","utf-8");
                    $pdf->Cell(46, 10, $txt1, 'TBL',0,'C');
                    
                    $txt1  = mb_convert_encoding("年齢","sjis-win","utf-8");
                    $pdf->Cell(25, 10, $txt1, 'TBL',0,'C');
                    
                    $exam_date  = substr(preg_replace("/-/","/",$testdata[ 'exam_dates'  ]),0,10);
                    $age   = calc_age($testdata[ 'birth' ],$exam_date);
                    $txt1  = mb_convert_encoding($age,"sjis-win","utf-8");
                    $pdf->Cell(16, 10, $txt1, 'TBL',0,'C');
                    function calc_age($birth,$date)
                    {
                            $d = explode("/",$date);
                            $ty = $d[0];
                            $tm = $d[1];
                            $td = $d[2];
                            list($by, $bm, $bd) = explode('/', $birth);
                            $age = $ty - $by;
                            if($tm * 100 + $td < $bm * 100 + $bd) $age--;
                            return $age;
                    }
                    
                    $pdf->SetXY(10,31);
	//↓1.ストレス共生力↓
                     $pdf->SetFontSize(11);
	$pdf->Write("5",mb_convert_encoding("1.ストレス共生力","SJIS","UTF-8"));
                    $pdf->SetXY(10,37);
                    $pdf->SetFontSize(7);
                    
                    
                    
                    
                    $pdf->SetFillColor(0,86,255);
                    $pdf->SetTextColor(255,255,255);
	$pdf->Cell(21, 10, mb_convert_encoding("スコア","SJIS","UTF-8"), 'LT', 0, 'C', 1);
	$pdf->Cell(21, 10, mb_convert_encoding("レベル","SJIS","UTF-8"), 'LTR', 0, 'C', 1);
	$pdf->SetFontSize(7);
                    $pdf->SetFillColor(255,255,255);
                    $pdf->SetTextColor(0,0,0);
	$pdf->Cell(38, 5, "1", 'TL', 0, 'C', 1);
	$pdf->Cell(24.5, 5, "2", 'TL', 0, 'C', 1);
                    $pdf->SetFillColor(255, 255, 0);
	$pdf->Cell(23.5, 5, "3", 'TL', 0, 'C', 1);
                    $pdf->SetFillColor(255, 255, 255);
	$pdf->Cell(24.5, 5, "4", 'TL', 0, 'C', 1);
	$pdf->Cell(39.5, 5, "5", 'TLR', 1, 'C', 1);

	
	$pdf->SetXY(52,42);

	$pdf->Cell(24, 5, "20", 'TBL', 0, 'L', 1);
	$pdf->Cell(24, 5, "30", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 5, "40", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 5, "50", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 5, "60", 'TB', 0, 'L', 1);
	$pdf->Cell(24, 5, "70", 'TB', 0, 'L', 1);
	$pdf->Cell(6,  5, "80", 'TRB', 1, 'L', 1);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFontSize(8);
	
        
	//スコアを出力する
	$pdf->Cell(21, 10, $st_score." ", 1, 0, 'C', 1);
	//レベルを出力する
	$pdf->Cell(21, 10, $st_level, 1, 0, 'C', 1);
	$pdf->Cell(26, 10, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 10, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 10, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 10, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 10, "", 1, 0, 'C', 1);
	$pdf->Cell(24, 10, "", 1, 0, 'C', 1);
	$pdf->Cell(4,  10, "", 1, 1, 'C', 1);

                  $pdf->Image($img31, 52, 49);
                  
                  $pdf->Image("./images/pdf/pdf31/left.png", 52, 33);
                  $pdf->SetXY(80,34.5);
                  $pdf->Write("0",mb_convert_encoding('低い',"sjis-win","utf-8"));
                  $pdf->Image("./images/pdf/pdf31/right.png", 90, 33);
                    
                  $pdf->SetXY(123,34.5);
                  $pdf->Write("0",mb_convert_encoding('標準',"sjis-win","utf-8"));
                  
                  $pdf->Image("./images/pdf/pdf31/left.png", 138, 33);
                  $pdf->SetXY(166,34.5);
                  $pdf->Write("0",mb_convert_encoding('高い',"sjis-win","utf-8"));
                  $pdf->Image("./images/pdf/pdf31/right.png", 178, 33);
                  
	 $pdf->SetXY(10,62);
	//↓1.ストレス共生力↓
                     $pdf->SetFontSize(11);
	$pdf->Write("5",mb_convert_encoding("2.".$name."さんの行動価値結果 12特性のスコアとチャート","SJIS","UTF-8"));
                         
        //外枠を作成
	
        $en1 = "./images/pdf/pdf31/waku.png";        
        $pdf->Image($en1, 10, 69,192);
        
        $pdf->Image($gimg1, 12, 77.5);
        
        $pdf->SetTextColor(0, 125, 249);
        $pdf->SetXY(14,76);
        $pdf->Write("0",mb_convert_encoding('対人影響力＞＞',"sjis-win","utf-8"));
        $pdf->SetXY(170,76);
        $pdf->Write("0",mb_convert_encoding('＜＜自己認知力',"sjis-win","utf-8"));
        
        $pdf->SetXY(14,186);
        $pdf->Write("0",mb_convert_encoding('対人認知力＞＞',"sjis-win","utf-8"));
        
        $pdf->SetXY(170,186);
        $pdf->Write("0",mb_convert_encoding('＜＜自己安定力',"sjis-win","utf-8"));
        
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFontSize(8);

	$pdf->Text(105, 82, 80);
	$pdf->Text(105, 90, 70);
	$pdf->Text(105, 98, 60);
	$pdf->Text(105, 107, 50);
	$pdf->Text(105, 115, 40);
	$pdf->Text(105, 123, 30);
	$pdf->Text(105, 134, 20);
        
	//↑レーダーの数値ここまで↑
                 $ht = 6;
                $pdf->SetXY(130,81-$ht);
                $pdf->Write("0",$gmsg1);
                $pt1  = sprintf("%01.1f",round($testdata['type'][ 'dev1' ],1));
                $pdf->SetXY(155,86-$ht);
                $pdf->Write("0",$pt1);
                
                
                $pdf->SetXY(155,95-$ht);
                $pdf->Write("0",$gmsg2);
                $pt2  = sprintf("%01.1f",round($testdata['type'][ 'dev2' ],1));
                $pdf->SetXY(170,101-$ht);
                $pdf->Write("0",$pt2);
                
                $pdf->SetXY(167,121-$ht);
                $pdf->Write("0",$gmsg3);
                $pt3  = sprintf("%01.1f",round($testdata['type'][ 'dev3' ],1));
                $pdf->SetXY(173,126-$ht);
                $pdf->Write("0",$pt3);
                
                
                
                $pdf->SetXY(163,143-$ht);
                $pdf->MultiCell(28, 4, $gmsg4,0,"L");
                $pt4  = sprintf("%01.1f",round($testdata['type'][ 'dev4' ],1));
                $pdf->SetXY(183,155-$ht);
                $pdf->Write("0",$pt4);
                
                
                $pdf->SetXY(155,175-$ht);
                $pdf->Write("0",$gmsg5);
                $pt5  = sprintf("%01.1f",round($testdata['type'][ 'dev5' ],1));
                $pdf->SetXY(170,181-$ht);
                $pdf->Write("0",$pt5);
                
                
                $pdf->SetXY(130,190-$ht);
                $pdf->Write("0",$gmsg6);
                $pt6  = sprintf("%01.1f",round($testdata['type'][ 'dev6' ],1));
                $pdf->SetXY(148,195-$ht);
                $pdf->Write("0",$pt6);
                
                $pdf->SetXY(70,190-$ht);
                $pdf->Write("0",$gmsg7);
                $pt7  = sprintf("%01.1f",round($testdata['type'][ 'dev7' ],1));
                $pdf->SetXY(70,195-$ht);
                $pdf->Write("0",$pt7);
                
                
                $pdf->SetXY(45,175-$ht);
                $pdf->Write("0",$gmsg8);
                $pt8  = sprintf("%01.1f",round($testdata['type'][ 'dev8' ],1));
                $pdf->SetXY(45,181-$ht);
                $pdf->Write("0",$pt8);
                
                $pdf->SetXY(13,150-$ht);
                $pdf->Write("0",$gmsg9);
                $pt9  = sprintf("%01.1f",round($testdata['type'][ 'dev9' ],1));
                $pdf->SetXY(13,155-$ht);
                $pdf->Write("0",$pt9);
                
                $pdf->SetXY(13,121-$ht);
                $pdf->Write("0",$gmsg10);
                $pt10  = sprintf("%01.1f",round($testdata['type'][ 'dev10' ],1));
                $pdf->SetXY(13,126-$ht);
                $pdf->Write("0",$pt10);
                
                $pdf->SetXY(33,95-$ht);
                $pdf->Write("0",$gmsg11);
                $pt11  = sprintf("%01.1f",round($testdata['type'][ 'dev11' ],1));
                $pdf->SetXY(33,101-$ht);
                $pdf->Write("0",$pt11);
                
                
                $pdf->SetXY(70,81-$ht);
                $pdf->Write("0",$gmsg12);
                $pt12  = sprintf("%01.1f",round($testdata['type'][ 'dev12' ],1));
                $pdf->SetXY(70,86-$ht);
                $pdf->Write("0",$pt12);
                
                
                
                $ht2=6;
                $ques = "3.".$name." さんへの質問例（スコアの低い行動価値）";
                
                $pdf->SetXY(10,205-$ht2);
	//↓1.ストレス共生力↓
                     $pdf->SetFontSize(11);
                    $pdf->Write("5",mb_convert_encoding($ques,"sjis-win","utf-8"),"SJIS","UTF-8");
                   
                     $sp = mb_convert_encoding("　","sjis-win","utf-8");

                    $i = 0;
                    $ht2=8;
                    
                    foreach($quesans as $k=>$v){
		//要素名
		$title =  $a_questions[$k];
                                    $no1 = mb_convert_encoding("①", "SJIS-WIN","UTF-8");
                                    $no2 = mb_convert_encoding("②", "SJIS-WIN","UTF-8");
		//リスクとなる行動
		$str   = "▼リスクとなる行動\n".$array_pdf_question[$k][0];
		//面接時の質問例
		$str1  = $array_pdf_question[$k][1];
		//判定のポイント
		$str2 = "▼判定のポイント\n".$array_pdf_question[$k][2];
		if($i == 0){
                                        $pdf->SetFontSize(9);
                                        $pdf->SetXY(10,212-$ht2);
                                        $pdf->Write("5",$no1.$title);
                                        $pdf->SetFontSize(7.4);
                                        $pdf->SetXY(10,217-$ht2);
                                        $pdf->MultiCell(80, 36, $sp,1,"L");
                                        $pdf->SetXY(90,217-$ht2);
                                        $pdf->MultiCell(110, 13, $sp,1,"L");
                                        $pdf->SetXY(90,230-$ht2);
                                        $pdf->MultiCell(110, 23, $sp,1,"L");
                                        
                                        $tle1 = "./images/pdf/pdf31/pdf31.png";
                                        $pdf->Image($tle1, 11, 219-$ht2,26);
                                        $pdf->SetXY(11,224-$ht2);
                                        $pdf->MultiCell(70, 4, mb_convert_encoding($str1,"sjis-win","utf-8"),0,"L");
                                        $pdf->MultiCell(75, 4, "",0,"L");
                                        $pdf->SetXY(91,218-$ht2);
                                        $pdf->MultiCell(103, 4, mb_convert_encoding($str,"sjis-win","utf-8"),0,"L");
                                        $pdf->MultiCell(108, 4, "",0,"L");
                                        $pdf->SetXY(91,231-$ht2);
                                        $pdf->MultiCell(103, 4, mb_convert_encoding($str2,"sjis-win","utf-8"),0,"L");
                                        $pdf->MultiCell(108, 4, "",0,"L");

		}

		if($i == 1){
                                        $pdf->SetFontSize(9);
                                        $pdf->SetXY(10,254-$ht2);
                                        $pdf->Write("5",$no2.$title);
                                        $pdf->SetFontSize(7.4);
                                        $pdf->SetXY(10,259-$ht2);
                                        $pdf->MultiCell(80, 36, $sp,1,"L");
                                        $pdf->SetXY(90,259-$ht2);
                                        $pdf->MultiCell(110, 13, $sp,1,"L");
                                        $pdf->SetXY(90,272-$ht2);
                                        $pdf->MultiCell(110, 23, $sp,1,"L");
                                        
                                        $tle1 = "./images/pdf/pdf31/pdf31.png";
                                        $pdf->Image($tle1, 11, 261-$ht2,26);
                                        $pdf->SetXY(11,267-$ht2);
                                        $pdf->MultiCell(70, 4, mb_convert_encoding($str1,"sjis-win","utf-8"),0,"L");
                                        $pdf->MultiCell(75, 4, "",0,"L");
                                        $pdf->SetXY(91,260-$ht2);
                                        $pdf->MultiCell(103, 4, mb_convert_encoding($str,"sjis-win","utf-8"),0,"L");
                                        $pdf->MultiCell(108, 4, "",0,"L");
                                        $pdf->SetXY(91,273-$ht2);
                                        $pdf->MultiCell(103, 4, mb_convert_encoding($str2,"sjis-win","utf-8"),0,"L");
                                        $pdf->MultiCell(108, 4, "",0,"L");
		}

		$i++;
	}
       
	$pdf->Ln(2);
                    $pdf->SetXY(10,290);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');
                   // $pdf->SetXY(10,290);
                   $pdf->Image("./images/pdf/pdf31/welcome.png", 10, 288,20);
	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	@unlink($img1);
	@unlink($gimg1);

	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------

?>