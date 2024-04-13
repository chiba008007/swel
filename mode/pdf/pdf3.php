<?PHP
	//ストレスグラフの表示
	$img2 = "./images/pdf/img".$id."_2.jpg";
	$st_score2 = substr($st_score, 1, 4) * 9.8;
	if($st_score >= 80){
		$wid = 588;
	}elseif($st_score >= 70){
		$wid = $st_score2 + 490;
	}elseif($st_score >= 60){
		$wid = $st_score2 + 392;
	}elseif($st_score >= 50){
		$wid = $st_score2 + 294;
	}elseif($st_score >= 40){
		$wid = $st_score2 + 196;
	}elseif($st_score >= 30){
		$wid = $st_score2 + 98;
	}elseif($st_score >= 20){
		$wid = $st_score2 + 1;
	}else{
		$wid = 1;
	}

	$im = imagecreatetruecolor($wid, 15);
	$img_color = imagecolorallocate($im, 64, 64, 64);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagefilledrectangle($im, 1, 1, $wid-2, 13, $img_color);

	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img2);
	imagedestroy($im);
	//ストレスグラフの表示終わり
	
	//----------------------------------------------------
	//12領域のグラフ
	//----------------------------------------------------

	//自己感情モニタリング力
	$imgdev1 = "./images/pdf/img".$id."_dev1.jpg";
	$imgdev1_score = $testdata['type'][ 'dev1' ];
	$imgdev1_score2 = substr($imgdev1_score, 1, 4) * 8.3;
	$dev1x = substr($imgdev1_score, 1, 4) * 2.2;
	if($imgdev1_score >= 80){
		$wid = 498;
		$dev1x = 183;
	}elseif($imgdev1_score >= 70){
		$wid = $imgdev1_score2 + 414.4;
		$dev1x = $dev1x + 160.5;
	}elseif($imgdev1_score >= 60){
		$wid = $imgdev1_score2 + 331.8;
		$dev1x = $dev1x + 138.5;
	}elseif($imgdev1_score >= 50){
		$wid = $imgdev1_score2 + 248.75;
		$dev1x = $dev1x + 117;
	}elseif($imgdev1_score >= 40){
		$wid = $imgdev1_score2 + 165.2;
		$dev1x = $dev1x + 94.5;
	}elseif($imgdev1_score >= 30){
		$wid = $imgdev1_score2 + 82.2;
		$dev1x = $dev1x + 72.5;
	}elseif($imgdev1_score >= 20){
		$wid = $imgdev1_score2 + 1;
		$dev1x = $dev1x + 50;
	}else{
		$wid = 1;
	}

	//グラフ作成
	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 128, 100, 162);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev1);
	imagedestroy($im);
	
	//客観的自己評価力
	$imgdev2 = "./images/pdf/img".$id."_dev2.jpg";
	$imgdev2_score = $testdata['type'][ 'dev2' ];
	$imgdev2_score2 = substr($imgdev2_score, 1, 4) * 8.3;
	$dev2x = substr($imgdev2_score, 1, 4) * 2.2;
	if($imgdev2_score >= 80){
		$wid = 498;
		$dev2x = 183;
	}elseif($imgdev2_score >= 70){
		$wid = $imgdev2_score2 + 414.4;
		$dev2x = $dev2x + 160.5;
	}elseif($imgdev2_score >= 60){
		$wid = $imgdev2_score2 + 331.8;
		$dev2x = $dev2x + 138.5;
	}elseif($imgdev2_score >= 50){
		$wid = $imgdev2_score2 + 248.75;
		$dev2x = $dev2x + 117;
	}elseif($imgdev2_score >= 40){
		$wid = $imgdev2_score2 + 165.2;
		$dev2x = $dev2x + 94.5;
	}elseif($imgdev2_score >= 30){
		$wid = $imgdev2_score2 + 82.2;
		$dev2x = $dev2x + 72.5;
	}elseif($imgdev2_score >= 20){
		$wid = $imgdev2_score2 + 1;
		$dev2x = $dev2x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 128, 100, 162);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev2);
	imagedestroy($im);

	//自己肯定力
	$imgdev3 = "./images/pdf/img".$id."_dev3.jpg";
	$imgdev3_score = $testdata['type'][ 'dev3' ];
	$imgdev3_score2 = substr($imgdev3_score, 1, 4) * 8.3;
	$dev3x = substr($imgdev3_score, 1, 4) * 2.2;
	if($imgdev3_score >= 80){
		$wid = 498;
		$dev3x = 183;
	}elseif($imgdev3_score >= 70){
		$wid = $imgdev3_score2 + 414.4;
		$dev3x = $dev3x + 160.5;
	}elseif($imgdev3_score >= 60){
		$wid = $imgdev3_score2 + 331.8;
		$dev3x = $dev3x + 138.5;
	}elseif($imgdev3_score >= 50){
		$wid = $imgdev3_score2 + 248.75;
		$dev3x = $dev3x + 117;
	}elseif($imgdev3_score >= 40){
		$wid = $imgdev3_score2 + 165.2;
		$dev3x = $dev3x + 94.5;
	}elseif($imgdev3_score >= 30){
		$wid = $imgdev3_score2 + 82.2;
		$dev3x = $dev3x + 72.5;
	}elseif($imgdev3_score >= 20){
		$wid = $imgdev3_score2 + 1;
		$dev3x = $dev3x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 128, 100, 162);
	$gray      = imagecolorallocate($im, 169, 169, 169);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev3);
	imagedestroy($im);
	

	//コントロール＆アチーブメント力
	$imgdev4 = "./images/pdf/img".$id."_dev4.jpg";
	$imgdev4_score = $testdata['type'][ 'dev4' ];
	$imgdev4_score2 = substr($imgdev4_score, 1, 4) * 8.3;
	$dev4x = substr($imgdev4_score, 1, 4) * 2.2;
	if($imgdev4_score >= 80){
		$wid = 498;
		$dev4x = 183;
	}elseif($imgdev4_score >= 70){
		$wid = $imgdev4_score2 + 414.4;
		$dev4x = $dev4x + 160.5;
	}elseif($imgdev4_score >= 60){
		$wid = $imgdev4_score2 + 331.8;
		$dev4x = $dev4x + 138.5;
	}elseif($imgdev4_score >= 50){
		$wid = $imgdev4_score2 + 248.75;
		$dev4x = $dev4x + 117;
	}elseif($imgdev4_score >= 40){
		$wid = $imgdev4_score2 + 165.2;
		$dev4x = $dev4x + 94.5;
	}elseif($imgdev4_score >= 30){
		$wid = $imgdev4_score2 + 82.2;
		$dev4x = $dev4x + 72.5;
	}elseif($imgdev4_score >= 20){
		$wid = $imgdev4_score2 + 1;
		$dev4x = $dev4x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 155, 186, 89);
	$gray      = imagecolorallocate($im, 102, 102, 102);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2.5, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev4);
	imagedestroy($im);

	//ビジョン創出力
	$imgdev5 = "./images/pdf/img".$id."_dev5.jpg";
	$imgdev5_score = $testdata['type'][ 'dev5' ];
	$imgdev5_score2 = substr($imgdev5_score, 1, 4) * 8.3;
	$dev5x = substr($imgdev5_score, 1, 4) * 2.2;
	if($imgdev5_score >= 80){
		$wid = 498;
		$dev5x = 183;
	}elseif($imgdev5_score >= 70){
		$wid = $imgdev5_score2 + 414.4;
		$dev5x = $dev5x + 160.5;
	}elseif($imgdev5_score >= 60){
		$wid = $imgdev5_score2 + 331.8;
		$dev5x = $dev5x + 138.5;
	}elseif($imgdev5_score >= 50){
		$wid = $imgdev5_score2 + 248.75;
		$dev5x = $dev5x + 117;
	}elseif($imgdev5_score >= 40){
		$wid = $imgdev5_score2 + 165.2;
		$dev5x = $dev5x + 94.5;
	}elseif($imgdev5_score >= 30){
		$wid = $imgdev5_score2 + 82.2;
		$dev5x = $dev5x + 72.5;
	}elseif($imgdev5_score >= 20){
		$wid = $imgdev5_score2 + 1;
		$dev5x = $dev5x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 155, 186, 89);
	$gray      = imagecolorallocate($im, 102, 102, 102);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2.5, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev5);
	imagedestroy($im);

	//ポジティブ思考力
	$imgdev6 = "./images/pdf/img".$id."_dev6.jpg";
	$imgdev6_score = $testdata['type'][ 'dev6' ];
	$imgdev6_score2 = substr($imgdev6_score, 1, 4) * 8.3;
	$dev6x = substr($imgdev6_score, 1, 4) * 2.2;
	if($imgdev6_score >= 80){
		$wid = 498;
		$dev6x = 183;
	}elseif($imgdev6_score >= 70){
		$wid = $imgdev6_score2 + 414.4;
		$dev6x = $dev6x + 160.5;
	}elseif($imgdev6_score >= 60){
		$wid = $imgdev6_score2 + 331.8;
		$dev6x = $dev6x + 138.5;
	}elseif($imgdev6_score >= 50){
		$wid = $imgdev6_score2 + 248.75;
		$dev6x = $dev6x + 117;
	}elseif($imgdev6_score >= 40){
		$wid = $imgdev6_score2 + 165.2;
		$dev6x = $dev6x + 94.5;
	}elseif($imgdev6_score >= 30){
		$wid = $imgdev6_score2 + 82.2;
		$dev6x = $dev6x + 72.5;
	}elseif($imgdev6_score >= 20){
		$wid = $imgdev6_score2 + 1;
		$dev6x = $dev6x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 155, 186, 89);
	$gray      = imagecolorallocate($im, 102, 102, 102);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2.5, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev6);
	imagedestroy($im);

	//対人共感力
	$imgdev7 = "./images/pdf/img".$id."_dev7.jpg";
	$imgdev7_score = $testdata['type'][ 'dev7' ];
	$imgdev7_score2 = substr($imgdev7_score, 1, 4) * 8.3;
	$dev7x = substr($imgdev7_score, 1, 4) * 2.2;
	if($imgdev7_score >= 80){
		$wid = 498;
		$dev7x = 183;
	}elseif($imgdev7_score >= 70){
		$wid = $imgdev7_score2 + 414.4;
		$dev7x = $dev7x + 160.5;
	}elseif($imgdev7_score >= 60){
		$wid = $imgdev7_score2 + 331.8;
		$dev7x = $dev7x + 138.5;
	}elseif($imgdev7_score >= 50){
		$wid = $imgdev7_score2 + 248.75;
		$dev7x = $dev7x + 117;
	}elseif($imgdev7_score >= 40){
		$wid = $imgdev7_score2 + 165.2;
		$dev7x = $dev7x + 94.5;
	}elseif($imgdev7_score >= 30){
		$wid = $imgdev7_score2 + 82.2;
		$dev7x = $dev7x + 72.5;
	}elseif($imgdev7_score >= 20){
		$wid = $imgdev7_score2 + 1;
		$dev7x = $dev7x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 57, 99, 149);
	$gray      = imagecolorallocate($im, 169, 169, 169);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev7);
	imagedestroy($im);

	//状況察知力
	$imgdev8 = "./images/pdf/img".$id."_dev8.jpg";
	$imgdev8_score = $testdata['type'][ 'dev8' ];
	$imgdev8_score2 = substr($imgdev8_score, 1, 4) * 8.3;
	$dev8x = substr($imgdev8_score, 1, 4) * 2.2;
	if($imgdev8_score >= 80){
		$wid = 498;
		$dev8x = 183;
	}elseif($imgdev8_score >= 70){
		$wid = $imgdev8_score2 + 414.4;
		$dev8x = $dev8x + 160.5;
	}elseif($imgdev8_score >= 60){
		$wid = $imgdev8_score2 + 331.8;
		$dev8x = $dev8x + 138.5;
	}elseif($imgdev8_score >= 50){
		$wid = $imgdev8_score2 + 248.75;
		$dev8x = $dev8x + 117;
	}elseif($imgdev8_score >= 40){
		$wid = $imgdev8_score2 + 165.2;
		$dev8x = $dev8x + 94.5;
	}elseif($imgdev8_score >= 30){
		$wid = $imgdev8_score2 + 82.2;
		$dev8x = $dev8x + 72.5;
	}elseif($imgdev8_score >= 20){
		$wid = $imgdev8_score2 + 1;
		$dev8x = $dev8x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 57, 99, 149);
	$gray      = imagecolorallocate($im, 169, 169, 169);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev8);
	imagedestroy($im);

	//ホスピタリティ発揮力
	$imgdev9 = "./images/pdf/img".$id."_dev9.jpg";
	$imgdev9_score = $testdata['type'][ 'dev9' ];
	$imgdev9_score2 = substr($imgdev9_score, 1, 4) * 8.3;
	$dev9x = substr($imgdev9_score, 1, 4) * 2.2;
	if($imgdev9_score >= 80){
		$wid = 498;
		$dev9x = 183;
	}elseif($imgdev9_score >= 70){
		$wid = $imgdev9_score2 + 414.4;
		$dev9x = $dev9x + 160.5;
	}elseif($imgdev9_score >= 60){
		$wid = $imgdev9_score2 + 331.8;
		$dev9x = $dev9x + 138.5;
	}elseif($imgdev9_score >= 50){
		$wid = $imgdev9_score2 + 248.75;
		$dev9x = $dev9x + 117;
	}elseif($imgdev9_score >= 40){
		$wid = $imgdev9_score2 + 165.2;
		$dev9x = $dev9x + 94.5;
	}elseif($imgdev9_score >= 30){
		$wid = $imgdev9_score2 + 82.2;
		$dev9x = $dev9x + 72.5;
	}elseif($imgdev9_score >= 20){
		$wid = $imgdev9_score2 + 1;
		$dev9x = $dev9x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 57, 99, 149);
	$gray      = imagecolorallocate($im, 169, 169, 169);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev9);
	imagedestroy($im);

	//リーダーシップ発揮力
	$imgdev10 = "./images/pdf/img".$id."_dev10.jpg";
	$imgdev10_score = $testdata['type'][ 'dev10' ];
	$imgdev10_score2 = substr($imgdev10_score, 1, 4) * 8.3;
	$dev10x = substr($imgdev10_score, 1, 4) * 2.2;
	if($imgdev10_score >= 80){
		$wid = 498;
		$dev10x = 183;
	}elseif($imgdev10_score >= 70){
		$wid = $imgdev10_score2 + 414.4;
		$dev10x = $dev10x + 160.5;
	}elseif($imgdev10_score >= 60){
		$wid = $imgdev10_score2 + 331.8;
		$dev10x = $dev10x + 138.5;
	}elseif($imgdev10_score >= 50){
		$wid = $imgdev10_score2 + 248.75;
		$dev10x = $dev10x + 117;
	}elseif($imgdev10_score >= 40){
		$wid = $imgdev10_score2 + 165.2;
		$dev10x = $dev10x + 94.5;
	}elseif($imgdev10_score >= 30){
		$wid = $imgdev10_score2 + 82.2;
		$dev10x = $dev10x + 72.5;
	}elseif($imgdev10_score >= 20){
		$wid = $imgdev10_score2 + 1;
		$dev10x = $dev10x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 255, 157, 46);
	$gray      = imagecolorallocate($im, 102, 102, 102);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev10);
	imagedestroy($im);

	//アサーション発揮力
	$imgdev11 = "./images/pdf/img".$id."_dev11.jpg";
	$imgdev11_score = $testdata['type'][ 'dev11' ];
	$imgdev11_score2 = substr($imgdev11_score, 1, 4) * 8.3;
	$dev11x = substr($imgdev11_score, 1, 4) * 2.2;
	if($imgdev11_score >= 80){
		$wid = 498;
		$dev11x = 183;
	}elseif($imgdev11_score >= 70){
		$wid = $imgdev11_score2 + 414.4;
		$dev11x = $dev11x + 160.5;
	}elseif($imgdev11_score >= 60){
		$wid = $imgdev11_score2 + 331.8;
		$dev11x = $dev11x + 138.5;
	}elseif($imgdev11_score >= 50){
		$wid = $imgdev11_score2 + 248.75;
		$dev11x = $dev11x + 117;
	}elseif($imgdev11_score >= 40){
		$wid = $imgdev11_score2 + 165.2;
		$dev11x = $dev11x + 94.5;
	}elseif($imgdev11_score >= 30){
		$wid = $imgdev11_score2 + 82.2;
		$dev11x = $dev11x + 72.5;
	}elseif($imgdev11_score >= 20){
		$wid = $imgdev11_score2 + 1;
		$dev11x = $dev11x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 255, 157, 46);
	$gray      = imagecolorallocate($im, 102, 102, 102);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev11);
	imagedestroy($im);

	//集団適応力
	$imgdev12 = "./images/pdf/img".$id."_dev12.jpg";
	$imgdev12_score = $testdata['type'][ 'dev12' ];
	$imgdev12_score2 = substr($imgdev12_score, 1, 4) * 8.3;
	$dev12x = substr($imgdev12_score, 1, 4) * 2.2;
	if($imgdev12_score >= 80){
		$wid = 498;
		$dev12x = 183;
	}elseif($imgdev12_score >= 70){
		$wid = $imgdev12_score2 + 414.4;
		$dev12x = $dev12x + 160.5;
	}elseif($imgdev12_score >= 60){
		$wid = $imgdev12_score2 + 331.8;
		$dev12x = $dev12x + 138.5;
	}elseif($imgdev12_score >= 50){
		$wid = $imgdev12_score2 + 248.75;
		$dev12x = $dev12x + 117;
	}elseif($imgdev12_score >= 40){
		$wid = $imgdev12_score2 + 165.2;
		$dev12x = $dev12x + 94.5;
	}elseif($imgdev12_score >= 30){
		$wid = $imgdev12_score2 + 82.2;
		$dev12x = $dev12x + 72.5;
	}elseif($imgdev12_score >= 20){
		$wid = $imgdev12_score2 + 1;
		$dev12x = $dev12x + 50;
	}else{
		$wid = 1;
	}

	$hei = 10;
	$im = imagecreatetruecolor($wid, $hei);
	$img_color = imagecolorallocate($im, 255, 157, 46);
	$gray      = imagecolorallocate($im, 102, 102, 102);
	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, $hei-2, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $imgdev12);
	imagedestroy($im);
	//----------------------------------------------------
	//12領域のグラフ終わり
	//----------------------------------------------------

	//devの中から上位2つを取得する
	$devAll = array(
					"1"  => $testdata[ 'type' ]['dev1'],
					"2"  => $testdata[ 'type' ]['dev2'],
					"3"  => $testdata[ 'type' ]['dev3'],
					"4"  => $testdata[ 'type' ]['dev4'],
					"5"  => $testdata[ 'type' ]['dev5'],
					"6"  => $testdata[ 'type' ]['dev6'],
					"7"  => $testdata[ 'type' ]['dev7'],
					"8"  => $testdata[ 'type' ]['dev8'],
					"9"  => $testdata[ 'type' ]['dev9'],
					"10" => $testdata[ 'type' ]['dev10'],
					"11" => $testdata[ 'type' ]['dev11'],
					"12" => $testdata[ 'type' ]['dev12']
				);

	arsort($devAll);
	$i = 1;
	foreach($devAll as $key => $value){
		if($i == 1){
			//上位1を取得
			$devNo1 = $key;
		}
		if($i == 2){
			//上位2を取得
			$devNo2 = $key;
			break;
		}
		$i++;
	}
	//上位1
	$comments = $array_pdf_stress2_1[$devNo1];
	//上位2
	$comments .= $array_pdf_stress2_2[$devNo2];
	//↑コメント2ここまで↑
	
	//グラフ表示
	if($pdfdata[0][ 'weight' ] == 0){
		$imgdevEx = "./images/pdf/img".$id."_devEx.jpg";
		$devExscore = $testdata[ 'score' ];
		$devExscore2 = substr($devExscore, 1, 4) * 9.8;
		if($devExscore >= 80){
			$wid = 588;
		}elseif($devExscore >= 70){
			$wid = $devExscore2 + 490;
		}elseif($devExscore >= 60){
			$wid = $devExscore2 + 392;
		}elseif($devExscore >= 50){
			$wid = $devExscore2 + 294;
		}elseif($devExscore >= 40){
			$wid = $devExscore2 + 196;
		}elseif($devExscore >= 30){
			$wid = $devExscore2 + 98;
		}elseif($devExscore >= 20){
			$wid = $devExscore2 + 1;
		}else{
			$wid = 1;
		}

		$im = imagecreatetruecolor($wid, 15);
		$img_color = imagecolorallocate($im, 64, 64, 64);
		$gray      = imagecolorallocate($im, 102, 102, 102);
		imagefill($im , 0 , 0 , $gray);
		imagefilledrectangle($im, 1, 1, $wid-2, 13, $img_color);

		$text_color = imagecolorallocate($im, 255, 0, 0);
		imagestring($im, 1, 5, 5,  "", $text_color);
		imagejpeg($im, $imgdevEx);
		imagedestroy($im);
	}


	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	$make->makePdfKozin($pdf,$testdata,3);

	//-----------------------
	//ストレス共生力
	//-----------------------
	$pdf->Ln(3);
	$pdf->SetFontSize(9);
	$pdf->Write("5","1.ストレス共生力　…受検者のストレスレベル");
	$pdf->Ln(5);
	$pdf->SetFontSize(8);
	$pdf->SetFillColor(204, 255, 204);
	$pdf->Cell(11, 6, "レベル", 1, 0, 'C', 1);
	$pdf->Cell(11, 6, "スコア", 1, 0, 'C', 1);

	$pdf->SetFillColor(204, 255, 204);
	$pdf->Cell(4,  6, ""  , 'TBL', 0, 'L', 1);
	$pdf->Cell(26, 6, "20", 'TB', 0, 'L', 1);
	$pdf->Cell(26, 6, "30", 'TB', 0, 'L', 1);
	$pdf->Cell(26, 6, "40", 'TB', 0, 'L', 1);
	$pdf->Cell(26, 6, "50", 'TB', 0, 'L', 1);
	$pdf->Cell(26, 6, "60", 'TB', 0, 'L', 1);
	$pdf->Cell(26, 6, "70", 'TB', 0, 'L', 1);
	$pdf->Cell(10, 6, "80", 'TRB', 1, 'L', 1);
	
	$pdf->SetFillColor(255, 255, 255);
	$pdf->Cell(11, 8, " ".$st_level, 1, 0, 'C', 1);
	$pdf->Cell(11, 8, " ".$st_score." ", 1, 0, 'C', 1);
	$pdf->Cell(6.5, 8, "", "TBL", 0, 'C', 1);
	$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
	$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
	$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
	$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
	$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
	$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
	$pdf->Cell(7.5, 8, "", "TRBL", 1, 'C', 1);
	//第二引数x 第三引数y
	//棒グラフの表示
	$pdf->Image($img2, 38.75, 56);
	//-----------------------
	//ストレス共生力終わり
	//-----------------------
	
	//----------------------------------
	//ストレス共生力コメント
	//----------------------------------
	$pdf->Ln(4);
	$pdf->SetFontSize(15);
	$pdf->Cell(11, 6, $st_level, 1, 0, 'C', 1);

	//項目とスコア
	$pdf->SetFontSize(10);
	if($elem[ 'e_feel' ]){
		$msg1 = mb_convert_encoding($elem[ 'e_feel' ],"SJIS","UTF-8");
	}else{
		$msg1 = "自己感情モニタリング力";
	}
	if($elem[ 'e_cus' ]){
		$msg2 = mb_convert_encoding($elem[ 'e_cus' ],"SJIS","UTF-8");
	}else{
		$msg2 = "客観的自己評価力";
	}
	
	if($elem[ 'e_aff' ]){
		$msg3 = mb_convert_encoding($elem[ 'e_aff' ],"SJIS","UTF-8");
	}else{
		$msg3 = "自己肯定力";
	}
	if($elem[ 'e_cntl' ]){
		$msg4 = mb_convert_encoding($elem[ 'e_cntl' ],"SJIS","UTF-8");
	}else{
		$msg4 = "コントロール＆アチーブメント力";
	}
	if($elem[ 'e_vi' ]){
		$msg5 = mb_convert_encoding($elem[ 'e_vi' ],"SJIS","UTF-8");
	}else{
		$msg5 = "ビジョン創出力";
	}
	if($elem[ 'e_pos' ]){
		$msg6 = mb_convert_encoding($elem[ 'e_pos' ],"SJIS","UTF-8");
	}else{
		$msg6 = "ポジティブ思考力";
	}
	
	if($elem[ 'e_symp' ]){
		$msg7 = mb_convert_encoding($elem[ 'e_symp' ],"SJIS","UTF-8");
	}else{
		$msg7 = "対人共感力";
	}
	if($elem[ 'e_situ' ]){
		$msg8 = mb_convert_encoding($elem[ 'e_situ' ],"SJIS","UTF-8");
	}else{
		$msg8 = "状況察知力";
	}
	if($elem[ 'e_hosp' ]){
		$msg9 = mb_convert_encoding($elem[ 'e_hosp' ],"SJIS","UTF-8");
	}else{
		$msg9 = "ホスピタリティ発揮力";
	}
	if($elem[ 'e_lead' ]){
		$msg10 = mb_convert_encoding($elem[ 'e_lead' ],"SJIS","UTF-8");
	}else{
		$msg10 = "リーダーシップ発揮力";
	}
	if($elem[ 'e_ass' ]){
		$msg11 = mb_convert_encoding($elem[ 'e_ass' ],"SJIS","UTF-8");
	}else{
		$msg11 = "アサーション発揮力";
	}
	if($elem[ 'e_adap' ]){
		$msg12 = mb_convert_encoding($elem[ 'e_adap' ],"SJIS","UTF-8");
	}else{
		$msg12 = "集団適応力";
	}


	$dev1  = round($testdata[ 'type' ][ 'dev1'  ],1);
	$dev2  = round($testdata[ 'type' ][ 'dev2'  ],1);
	$dev3  = round($testdata[ 'type' ][ 'dev3'  ],1);
	$dev4  = round($testdata[ 'type' ][ 'dev4'  ],1);
	$dev5  = round($testdata[ 'type' ][ 'dev5'  ],1);
	$dev6  = round($testdata[ 'type' ][ 'dev6'  ],1);
	$dev7  = round($testdata[ 'type' ][ 'dev7'  ],1);
	$dev8  = round($testdata[ 'type' ][ 'dev8'  ],1);
	$dev9  = round($testdata[ 'type' ][ 'dev9'  ],1);
	$dev10 = round($testdata[ 'type' ][ 'dev10' ],1);
	$dev11 = round($testdata[ 'type' ][ 'dev11' ],1);
	$dev12 = round($testdata[ 'type' ][ 'dev12' ],1);

	$pdf->Cell(90.5, 6, "【".$msg1."】　".$dev1, 'LTB', 0, 'L', 1);
	$pdf->Cell(90.5, 6, "【".$msg2."】　".$dev2, 'TRB', 1, 'L', 1);
	
	//コメント1
	$pdf->SetFontSize(9);
	if($st_level == 1){
		if($dev1 < 40 && $dev2 < 40 ){
			$msg = $array_pdf_stress[1];
		}
	}
	if($st_level == 2){
		if($dev1 < 30){
			$msg = $array_pdf_stress[2];
		}elseif($dev2 < 30){
			$msg = $array_pdf_stress[3];
		}
	}
	if($st_level == 3){
		if($dev1 < 50 && $dev2 < 50 ){
			$msg = $array_pdf_stress[4];
		}
	}
	if($st_level >= 4){
		$msg = $array_pdf_stress[5];
	}
	$pdf->MultiCell(192, 5, $msg, 1, 1, 'L', 1);

	$pdf->Ln(5);
	//----------------------------------
	//ストレス共生力コメント終わり
	//----------------------------------
	
	//----------------------------------
	//↓2.12領域のスコア↓
	//----------------------------------
	$pdf->SetFontSize(10);
	$pdf->Write("5","2.12領域のスコア");
	//グラフの表示
	
	//自己認知力
	$pdf->SetFontSize(9);

	$pdf->Ln(5);
	$pdf->SetFillColor(242, 239, 246);
	$pdf->Cell(40, 5, ''  , 'TL' ,0,'L');
	$pdf->Cell(18, 5, '', 'T' ,0,'L');
	$pdf->Cell(22, 5, '30', 'T' ,0,'L');
	$pdf->Cell(22, 5, '40', 'T' ,0,'L');
	$pdf->Cell(22, 5, '50', 'T' ,0,'L');
	$pdf->Cell(22, 5, '60', 'T' ,0,'L');
	$pdf->Cell(22, 5, '70', 'T' ,0,'L');
	$pdf->Cell(24, 5, '80', 'TR',1,'L');
	$pdf->Text(47.5, 110.35, 20);

	$pdf->Cell(5,  4, "自", 'TL', 'C', 1, 1);
	$pdf->SetFontSize(8);
	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);
	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);
	$pdf->SetFontSize(9);
	$pdf->Cell(5,  4, "己", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);
	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);
	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);
	//自己感情モニタリング力
	$pdf->Text(16, 115.75, $msg1);
	$pdf->SetFontSize(9);
	$pdf->Cell(5,  4, "認", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);
	//客観的自己評価力
	$pdf->Cell(34, 4, $msg2, 'L',0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);
	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);
	$pdf->SetFontSize(9);
	$pdf->Cell(5, 4, "知", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);
	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);
	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);
	$pdf->SetFontSize(9);
	$pdf->Cell(5, 4, "力", 'LB', 'C', 1, 1);
	$pdf->SetFontSize(8);
	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);
	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	//自己肯定力
	$pdf->Text(16, 129.75, $msg3);

	$pdf->SetFontSize(9);
	//棒グラフの表示
	$pdf->Image($imgdev1, 49.25, 113.5);
	$pdf->Text($dev1x, 116, $dev1);
	$pdf->Image($imgdev2, 49.25, 120.5);
	$pdf->Text($dev2x, 122.75, $dev2);
	$pdf->Image($imgdev3, 49.25, 127.5);
	$pdf->Text($dev3x, 129.75, $dev3);
	$pdf->SetFontSize(8);
	
//↓自己安定力↓
	$pdf->Cell(36, 1.5, '' ,'L' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(24, 1.5, '', 'R',1,'L');

	$pdf->SetFillColor(245, 248, 238);

	$pdf->Cell(5,  4, "自", 'TL', 'C', 1, 1);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	$pdf->SetFontSize(9);
	$pdf->Cell(5,  4, "己", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);
	$pdf->SetFontSize(6);
	//コントロール＆アチーブメント力
	$pdf->Text(16, 137.25, $msg4);

	$pdf->SetFontSize(9);
	$pdf->Cell(5,  4, "安", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	//ビジョン創出力
	$pdf->Cell(34, 4, $msg5, 'L',0,'',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	$pdf->SetFontSize(9);
	$pdf->Cell(5,  4, "定", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	$pdf->SetFontSize(9);
	$pdf->Cell(5,  4, "力", 'LB', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	//ポジティブ思考力
	$pdf->Text(16, 150.5, $msg6);

	$pdf->SetFontSize(9);
	//棒グラフの表示
	$pdf->Image($imgdev4, 49.25, 135);
	$pdf->Text($dev4x, 137.5, $dev4);

	$pdf->Image($imgdev5, 49.25, 142.25);
	$pdf->Text($dev5x, 143.5, $dev5);

	$pdf->Image($imgdev6, 49.25, 149);
	$pdf->Text($dev6x, 150.25, $dev6);
	$pdf->SetFontSize(8);

//↑自己安定力ここまで↑

//↓対人認知力↓
	$pdf->SetFillColor(237, 242, 248);

	$pdf->Cell(36, 1.5, '', 'L' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(24, 1.5, '', 'R',1,'L');

	$pdf->Cell(5,  4, "対", 'TL', 'C', 1, 1);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	$pdf->SetFontSize(9);
	$pdf->Cell(5, 4, "人", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	//対人共感力
	$pdf->Text(16, 159, $msg7);

	$pdf->SetFontSize(9);
	$pdf->Cell(5, 4, "認", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	//状況察知力
	$pdf->Cell(34, 4, $msg8, 'L',0,'',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	$pdf->SetFontSize(9);
	$pdf->Cell(5, 4, "知", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);
	$pdf->SetFontSize(9);
	$pdf->Cell(5,  4, "力", 'LB', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	//ホスピタリティ発揮力
	$pdf->Text(16, 171.75, $msg9);

	$pdf->SetFontSize(9);
	//棒グラフの表示
	$pdf->Image($imgdev7, 49.25, 156.5);
	$pdf->Text($dev7x, 159, $dev7);

	$pdf->Image($imgdev8, 49.25, 163.25);
	$pdf->Text($dev8x, 165.5, $dev8);

	$pdf->Image($imgdev9, 49.25, 170.25);
	$pdf->Text($dev9x, 172.75, $dev9);
	$pdf->SetFontSize(8);


//↑対人認知力ここまで↑

//↓対人影響力↓
	$pdf->SetFillColor(255, 249, 229);

	$pdf->Cell(36, 1.5, '', 'L' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(22, 1.5, '', '' ,0,'L');
	$pdf->Cell(24, 1.5, '', 'R',1,'L');

	$pdf->Cell(5,  4, "対", 'TL', 'C', 1, 1);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	$pdf->SetFontSize(9);
	$pdf->Cell(5, 4, "人", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	//リーダーシップ発揮力
	$pdf->Text(16, 180.75, $msg10);

	$pdf->SetFontSize(9);
	$pdf->Cell(5, 4, "影", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	//アサーション発揮力
	$pdf->Cell(34, 4, $msg11, 'L',0,'',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	$pdf->SetFontSize(9);
	$pdf->Cell(5, 4, "響", 'L', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	$pdf->SetFontSize(9);
	$pdf->Cell(5,  4, "力", 'LB', 'C', 1, 1);
	$pdf->SetFontSize(8);

	$pdf->Cell(34, 4, '', 'L' ,0,'L',1);
	$pdf->SetDrawColor(204, 204, 204);

	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'L' ,0,'L',1);
	$pdf->Cell(22, 4, '', 'LR' ,0,'L',1);

	$pdf->SetDrawColor(0, 0, 0);
	$pdf->Cell(21, 4, '', 'R',1,'L',1);

	//集団適応力
	$pdf->Text(16, 194.25, $msg12);

	$pdf->SetFontSize(9);
	//棒グラフの表示
	$pdf->Image($imgdev10, 49.25, 178.25);
	$pdf->Text($dev10x, 180.75, $dev10);

	$pdf->Image($imgdev11, 49.25, 185.25);
	$pdf->Text($dev11x, 187.75, $dev11);

	$pdf->Image($imgdev12, 49.25, 192);
	$pdf->Text($dev12x, 194.5, $dev12);

//↑対人影響力ここまで↑

	$pdf->Cell(36, 1.5, '', 'BL' ,0,'L');
	$pdf->Cell(22, 1.5, '', 'B' ,0,'L');
	$pdf->Cell(22, 1.5, '', 'B' ,0,'L');
	$pdf->Cell(22, 1.5, '', 'B' ,0,'L');
	$pdf->Cell(22, 1.5, '', 'B' ,0,'L');
	$pdf->Cell(22, 1.5, '', 'B' ,0,'L');
	$pdf->Cell(22, 1.5, '', 'B' ,0,'L');
	$pdf->Cell(24, 1.5, '', 'BR',1,'L');
	//----------------------------------
	//↓2.12領域のスコア終わり↓
	//----------------------------------
	//コメント出力
	$pdf->SetFontSize(9);

	$pdf->Ln(5);
	$pdf->MultiCell(192, 5, $comments, 1, 1, 'L', 1);
	
	//↓重みつけがある場合は行動価値適合度を出力する

	//重み付けの確認
	$weightKey = $obj->getWeightKey($testdata[ 'tid' ]);
	if($weightKey[ 'weight' ] == 0){
		$pdf->Ln(5);
		$pdf->SetFontSize(10);
		$pdf->Write("5","3.行動価値適合度　…貴社の重視する行動価値との適合度");
		$pdf->Ln(5);

		$pdf->SetFontSize(8);
		$pdf->SetFillColor(204, 255, 204);
		$pdf->Cell(11, 6, "レベル", 1, 0, 'C', 1);
		$pdf->Cell(11, 6, "スコア", 1, 0, 'C', 1);

		$pdf->SetFillColor(204, 255, 204);
		$pdf->Cell(4,  6, ""  , 'TBL', 0, 'L', 1);
		$pdf->Cell(26, 6, "20", 'TB', 0, 'L', 1);
		$pdf->Cell(26, 6, "30", 'TB', 0, 'L', 1);
		$pdf->Cell(26, 6, "40", 'TB', 0, 'L', 1);
		$pdf->Cell(26, 6, "50", 'TB', 0, 'L', 1);
		$pdf->Cell(26, 6, "60", 'TB', 0, 'L', 1);
		$pdf->Cell(26, 6, "70", 'TB', 0, 'L', 1);
		$pdf->Cell(10, 6, "80", 'TRB', 1, 'L', 1);
		
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(11, 8, $testdata[ 'level' ], 1, 0, 'L', 1);
		$sc = round($testdata[ 'score' ],1);
		$pdf->Cell(11, 8, $sc, 1, 0, 'L', 1);

		$pdf->Cell(6.5, 8, "", "TBL", 0, 'C', 1);
		$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
		$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
		$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
		$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
		$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
		$pdf->Cell(26,  8, "", "TBL", 0, 'C', 1);
		$pdf->Cell(7.5, 8, "", "TRBL", 1, 'C', 1);

		//グラフ出力
		$pdf->Image($imgdevEx, 38.75, 246);

		
	}
	$pdf->Ln(24);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');

	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	unlink($img2);
	unlink($imgdev1);
	unlink($imgdev2);
	unlink($imgdev3);
	unlink($imgdev4);
	unlink($imgdev5);
	unlink($imgdev6);
	unlink($imgdev7);
	unlink($imgdev8);
	unlink($imgdev9);
	unlink($imgdev10);
	unlink($imgdev11);
	unlink($imgdev12);
	unlink($imgdevEx);


	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------



?>