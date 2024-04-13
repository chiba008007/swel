<?PHP
	//----------------------------------------------
	//棒グラフ画像作成
	//----------------------------------------------
	$img1 = "./images/pdf/pdf31/img".$id.".jpg";
        
	$st_score2 = substr($st_score, 1, 4)*10;

	if($st_score >= 80){
		$wid = 548;
	}elseif($st_score >= 70){
		$wid = $st_score2 + 458;
	}elseif($st_score >= 60){
		$wid = $st_score2 + 367;
	}elseif($st_score >= 50){
		$wid = $st_score2 + 277;
	}elseif($st_score >= 40){
		$wid = $st_score2 + 188;
	}elseif($st_score >= 30){
		$wid = $st_score2 + 98;
	}elseif($st_score >= 20){
		$wid = $st_score2 + 8;
	}else{
		$wid = 1;
	}
        
	$im        = imagecreatetruecolor($wid, 15);
	$img_color = imagecolorallocate($im, 116, 169, 214);
	//$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $img_color);
	//imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img1);
        
//	imagedestroy($im);

	//----------------------------------------------
	//棒グラフ画像作成終わり
	//----------------------------------------------
	//----------------------------------------------
	//チャートグラフ画像作成
	//----------------------------------------------

	$gimg1 = "./images/pdf/pdf31/graf".$id.".png";
	$gimg2 = "./images/pdf/pdf31/graf2".$id.".png";
        
       
        
        $dev1scr  = (round($testdata['type'][ 'dev1'  ]/10,1)-2)*1.13;
	$dev2scr  = (round($testdata['type'][ 'dev2'  ]/10,1)-2)*1.13;
	$dev3scr  = (round($testdata['type'][ 'dev3'  ]/10,1)-2)*1.13;
	$dev4scr  = (round($testdata['type'][ 'dev4'  ]/10,1)-2)*1.13;
	$dev5scr  = (round($testdata['type'][ 'dev5'  ]/10,1)-2)*1.13;
	$dev6scr  = (round($testdata['type'][ 'dev6'  ]/10,1)-2)*1.13;
	$dev7scr  = (round($testdata['type'][ 'dev7'  ]/10,1)-2)*1.13;
	$dev8scr  = (round($testdata['type'][ 'dev8'  ]/10,1)-2)*1.13;
	$dev9scr  = (round($testdata['type'][ 'dev9'  ]/10,1)-2)*1.13;
	$dev10scr = (round($testdata['type'][ 'dev10' ]/10,1)-2)*1.13;
	$dev11scr = (round($testdata['type'][ 'dev11' ]/10,1)-2)*1.13;
	$dev12scr = (round($testdata['type'][ 'dev12' ]/10,1)-2)*1.13;
        
        /*
        $dev1scr  = 2*1.13;
	$dev2scr  = 3*1.13;
	$dev3scr  = 4*1.13;
	$dev4scr  = 5*1.13;
	$dev5scr  = 6*1.13;
	$dev6scr  = 2;
	$dev7scr  = 2;
	$dev8scr  = 2;
	$dev9scr  = 2;
	$dev10scr = 2;
	$dev11scr = 2;
	$dev12scr = 2;
        */
        $kodo_array = array(
				$dev1scr,$dev2scr,$dev3scr
				,$dev4scr,$dev5scr,$dev6scr
				,$dev7scr,$dev8scr,$dev9scr
				,$dev10scr,$dev11scr,$dev12scr
				);
       // var_dump($kodo_array);
        ini_set( 'display_errors', 1 ); 
        // データセット用オブジェクトを生成 
$MyData = new pData2(); 
  
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
$myPicture->setGraphArea(180,-80,500,500); 
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
 //exit();

	//--------------------------------
	//作成した画像の削除
	//--------------------------------
//	unlink($img1);
//	unlink($gimg1);

	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------

?>