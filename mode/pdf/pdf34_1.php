<?PHP
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

arsort($devlist);
//５０以下の配列の値の上位2つを取得
$i=0;
foreach($devlist as $key=>$val){
        $quesans[$key] = $val;
}

//上位2つを取得
//arsort($devlist);
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
array_multisort($ary_weight, SORT_DESC,$quesans,SORT_DESC);
$i=0;
$quesanslist = [];
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
	//チャートグラフ画像作成
	//----------------------------------------------

	$gimg1 = "./images/pdf/pdf34/graf".$id.".png";
        
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

        
        $MyData = new pData2(10); 
  
// スコアのデータセット 
$MyData->addPoints($kodo_array,"ScoreA"); 
$MyData->setSerieDescription("ScoreA","Application A"); 
$MyData->setPalette("ScoreA",array("R"=>65,"G"=>105,"B"=>225)); 

 
// チャートの項目 
$MyData->addPoints(array($msg1,$msg2,$msg3,$msg4,$msg5,$msg6,$msg7,$msg8,$msg9,$msg10,$msg11,$msg12),"Point"); 
$MyData->setAbscissa("Point"); 
  
// グラフのサイズとデータセットを引数に渡してpChartオブジェクトを生成 
$myPicture = new pImage(530,530,$MyData); 

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
    "lineTension"=>10,
    "DrawLines"=>10,
    "borderWidth"=>50,
    "aLineWidth"=>5,
    "pointStyle"=>"star",
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


		$msg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
		$gmsg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");


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



	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	//$make->makePdfKozin($pdf,$testdata,31);
                    $pdf->SetXY(10,10);
                    $pdf->SetFontSize(16);
                    $pdf->Write("0",mb_convert_encoding('個人結果シート(自己理解版)',"sjis-win","utf-8"));
                    
                    $pdf->SetFontSize(11);
                    $pdf->SetXY(130,10);
                    $cus_name  = mb_convert_encoding($testdata[ 'cusname'  ],"sjis-win","utf-8");
                  //  $pdf->Write("0",mb_convert_encoding('企業名：',"sjis-win","utf-8").$cus_name);
                    $pdf->Cell(70, 10, mb_convert_encoding('企業名：',"sjis-win","utf-8").$cus_name, 0,"","R");
                    $pdf->SetXY(10,18);
                    $pdf->SetFontSize(8);
                    $txt1  = mb_convert_encoding("受検日","sjis-win","utf-8");
                    $pdf->Cell(14, 6, $txt1, 'TB',0,'C');
                    $dates = explode(" ",$testdata[ 'exam_dates'  ]);
                    $dates2 = explode("-",$dates[0]);
                    $txt1  = $dates2[0]."/".$dates2[1]."/".$dates2[2];
                    $pdf->Cell(30, 6, $txt1, 'TBL',0,'C');
                    $txt1  = mb_convert_encoding("受検者ID","sjis-win","utf-8");
                    $pdf->Cell(22, 6, $txt1, 'TBL',0,'C');
                    $txt1  = $testdata[ 'exam_id' ];
                    $pdf->Cell(26, 6, $txt1, 'TBL',0,'C');
                    
                    $txt1  = mb_convert_encoding("氏名","sjis-win","utf-8");
                    $pdf->Cell(13, 6, $txt1, 'TBL',0,'C');
                    $txt1  = $testdata[ 'name' ].'('.$testdata[ 'kana' ].')';
                    $txt1  = mb_convert_encoding($txt1,"sjis-win","utf-8");
                    $pdf->Cell(46, 6, $txt1, 'TBL',0,'C');
                    
                    $txt1  = mb_convert_encoding("年齢","sjis-win","utf-8");
                    $pdf->Cell(25, 6, $txt1, 'TBL',0,'C');
                    
                    $exam_date  = substr(preg_replace("/-/","/",$testdata[ 'exam_dates'  ]),0,10);
                    $age   = calc_age2($testdata[ 'birth' ],$exam_date);
                    $txt1  = mb_convert_encoding($age,"sjis-win","utf-8");
                    $pdf->Cell(16, 6, $txt1, 'TBL',0,'C');
                    function calc_age2($birth,$date)
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
                    $pdf->Image("./images/pdf/pdf34/box1.gif", 10, 26,194);
                    $pdf->Image("./images/pdf/pdf34/box2.gif", 10, 192,194);
                    $pdf->Image("./images/pdf/pdf34/welcome.png", 10, 280,30);
                    
                    $pdf->Image("./images/pdf/pdf34/g_1.gif", 26, 45,70);
                    $pdf->Image($gimg1, -3, 42.5,95);
                    
                    $pdf->SetXY(26,23);
                    $pdf->SetTextColor(255,255,255);
                    $pdf->SetFontSize(10);
                    $pdf->Write("15",mb_convert_encoding("行動価値（12 特性）から見る".$name."さんの強みとなる要素","SJIS","UTF-8"));
                    
                    $pdf->SetTextColor(0,0,0);
                    $pt1  = sprintf("%01.1f",round($testdata['type'][ 'dev1' ],1));
                    $pt2  = sprintf("%01.1f",round($testdata['type'][ 'dev2' ],1));
                    $pt3  = sprintf("%01.1f",round($testdata['type'][ 'dev3' ],1));
                    $pt4  = sprintf("%01.1f",round($testdata['type'][ 'dev4' ],1));
                    $pt5  = sprintf("%01.1f",round($testdata['type'][ 'dev5' ],1));
                    $pt6  = sprintf("%01.1f",round($testdata['type'][ 'dev6' ],1));
                    $pt7  = sprintf("%01.1f",round($testdata['type'][ 'dev7' ],1));
                    $pt8  = sprintf("%01.1f",round($testdata['type'][ 'dev8' ],1));
                    $pt9  = sprintf("%01.1f",round($testdata['type'][ 'dev9' ],1));
                    $pt10  = sprintf("%01.1f",round($testdata['type'][ 'dev10' ],1));
                    $pt11  = sprintf("%01.1f",round($testdata['type'][ 'dev11' ],1));
                    $pt12  = sprintf("%01.1f",round($testdata['type'][ 'dev12' ],1));
                    
                    $pdf->SetFontSize(8.5);
                    $pdf->SetXY(86,123.5);
                    $pdf->Write("0",$pt1);
                    $pdf->SetXY(77,128.5);
                    $pdf->Write("0",$pt2);
                    $pdf->SetXY(68,134);
                    $pdf->Write("0",$pt3);
                    
                    $pdf->SetXY(100,140);
                    $pdf->Write("0",$pt4);
                    $pdf->SetXY(74,145);
                    $pdf->Write("0",$pt5);
                    $pdf->SetXY(77,150);
                    $pdf->Write("0",$pt6);
                    
                    $pdf->SetXY(68,156.5);
                    $pdf->Write("0",$pt7);
                    $pdf->SetXY(68,161.5);
                    $pdf->Write("0",$pt8);
                    $pdf->SetXY(84,166.5);
                    $pdf->Write("0",$pt9);
                    
                    
                    $pdf->SetXY(84,173);
                    $pdf->Write("0",$pt10);
                    $pdf->SetXY(84,178);
                    $pdf->Write("0",$pt11);
                    $pdf->SetXY(68,183);
                    $pdf->Write("0",$pt12);
                    
                   if($quesans['dev1']){
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 122,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(69,38);
                   $pdf->Write("10",mb_convert_encoding("①","SJIS-WIN","UTF-8"));
                   
                   
                   if($quesans['dev2']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 127,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(86,47);
                   $pdf->Write("10",mb_convert_encoding("②","SJIS-WIN","UTF-8"));
                   
                   
                  if($quesans['dev3']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 132,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(96,65);
                   $pdf->Write("10",mb_convert_encoding("③","SJIS-WIN","UTF-8"));
                   
                   
                   
                   if($quesans['dev4']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 138.5,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(96,85);
                   $pdf->Write("10",mb_convert_encoding("④","SJIS-WIN","UTF-8"));
                   
                   
                   if($quesans['dev5']){
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 143.5,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(86,102);
                   $pdf->Write("10",mb_convert_encoding("⑤","SJIS-WIN","UTF-8"));
                   
                   
                   if($quesans['dev6']){
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 148.5,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(69,112);
                   $pdf->Write("10",mb_convert_encoding("⑥","SJIS-WIN","UTF-8"));
                   
                   
                    
                  if($quesans['dev7']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 155,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(48,112);
                   $pdf->Write("10",mb_convert_encoding("⑦","SJIS-WIN","UTF-8"));
                   
                   
                   
                   if($quesans['dev8']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 160,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(31,102);
                   $pdf->Write("10",mb_convert_encoding("⑧","SJIS-WIN","UTF-8"));
                   
                   
                   if($quesans['dev9']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 165,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(20,85);
                   $pdf->Write("10",mb_convert_encoding("⑨","SJIS-WIN","UTF-8"));
                   
                   if($quesans['dev10']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 171.5,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(20,65);
                   $pdf->Write("10",mb_convert_encoding("⑩","SJIS-WIN","UTF-8"));
                   
                   
                   if($quesans['dev11']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 176.5,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(31,47);
                   $pdf->Write("10",mb_convert_encoding("⑪","SJIS-WIN","UTF-8"));
                   
                   
                   if($quesans['dev12']){     
                        $pdf->Image("./images/pdf/pdf34/ya.gif", 41, 181.5,4);
                        $pdf->SetTextColor(255, 127, 80);
                   }else{
                       $pdf->SetTextColor(0, 0, 0);
                   }
                   $pdf->SetXY(48,38);
                   $pdf->Write("10",mb_convert_encoding("⑫","SJIS-WIN","UTF-8"));
                   
                   
                   
                   $no=1;
                   $number = [];
                   foreach($strongPoint as $key=>$val){
                       $number[$no] = $key;
                       if($no == 1){
                            $pdf->SetXY(130,33.5);
                       }
                       if($no == 2){
                            $pdf->SetXY(130,110.5);
                       }
                       $pdf->SetFontSize(11);
                       if($key == "dev1"){
                            $pdf->Write("10",mb_convert_encoding("① 自己感情モニタリング力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev2"){
                            $pdf->Write("10",mb_convert_encoding("② 客観的自己評価力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev3"){
                            $pdf->Write("10",mb_convert_encoding("③ 自己肯定力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev4"){
                            $pdf->Write("10",mb_convert_encoding("④ コントロール＆アチーブメント力","SJIS-WIN","UTF-8"));
                       }
                       
                       if($key == "dev5"){
                            $pdf->Write("10",mb_convert_encoding("⑤ ビジョン創出力","SJIS-WIN","UTF-8"));
                       }
                        if($key == "dev6"){
                            $pdf->Write("10",mb_convert_encoding("⑥ ポジティブ思考力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev7"){
                            $pdf->Write("10",mb_convert_encoding("⑦ 対人共感力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev8"){
                            $pdf->Write("10",mb_convert_encoding("⑧ 状況察知力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev9"){
                            $pdf->Write("10",mb_convert_encoding("⑨ ホスピタリティ発揮力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev10"){
                            $pdf->Write("10",mb_convert_encoding("⑩ リーダーシップ発揮力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev11"){
                            $pdf->Write("10",mb_convert_encoding("⑪ アサーション発揮力","SJIS-WIN","UTF-8"));
                       }
                       if($key == "dev12"){
                            $pdf->Write("10",mb_convert_encoding("⑫ 集団適応力","SJIS-WIN","UTF-8"));
                       }
                       $no++;
                   }
                   $pdf->SetFontSize(9);
                  $pdf->SetTextColor(30,140,255);
                   $pdf->SetXY(110,38);
                   $pdf->Write("10",mb_convert_encoding("▼強みとなる要素が発揮された場合の特徴","SJIS-WIN","UTF-8"));
                   $pdf->SetTextColor(0,0,0);
                   $pdf->SetXY(110,45.5);
                   
                   $text1 = mb_convert_encoding($array_pdf_strongPoint[$number[1]],"SJIS-WIN","UTF-8");
                    $pdf->MultiCell(86, 4, $text1,0,"L");
                   
                    $pdf->SetXY(114,90);
                    $text11 = mb_convert_encoding($array_pdf_strongArea[$number[1]],"SJIS-WIN","UTF-8");
                    $pdf->MultiCell(81, 4, $text11,0,"L");
                   
                   
                   
                   $pdf->SetTextColor(30,140,255);
                   $pdf->SetXY(110,115);
                   $pdf->Write("10",mb_convert_encoding("▼強みとなる要素が発揮された場合の特徴","SJIS-WIN","UTF-8"));
                   $pdf->SetTextColor(0,0,0);
                   $pdf->SetXY(110,123);
                   $text2 = mb_convert_encoding($array_pdf_strongPoint[$number[2]],"SJIS-WIN","UTF-8");
                    $pdf->MultiCell(86, 4, $text2,0,"L");
                   
                   $pdf->SetXY(114,168);
                   $text21 = mb_convert_encoding($array_pdf_strongArea[$number[2]],"SJIS-WIN","UTF-8");
                   $pdf->MultiCell(81, 4, $text21,0,"L");
                    
                   
                   
	$pdf->Ln(2);
                    $pdf->SetXY(10,290);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');
	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	@unlink($img1);
	@unlink($gimg1);

	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------

?>