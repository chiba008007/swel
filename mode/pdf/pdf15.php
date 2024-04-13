<?PHP
ini_set( "display_errors", "Off");
	//レベルの作成
	//棒グラフの横幅指定
	if($score[ 'score1' ] <= 30 ){
		$lv1 = 1;
		$w1 = 8;
	}elseif($score[ 'score1' ] <= 35 ){
		$lv1 = 2;
	}elseif($score[ 'score1' ] <= 40 ){
		$lv1 = 3;
	}elseif($score[ 'score1' ] <= 45 ){
		$lv1 = 4;
	}elseif($score[ 'score1' ] <= 50 ){
		$lv1 = 5;
	}elseif($score[ 'score1' ] <= 55 ){
		$lv1 = 6;
	}elseif($score[ 'score1' ] <= 60 ){
		$lv1 = 7;
	}elseif($score[ 'score1' ] <= 65 ){
		$lv1 = 8;
	}elseif($score[ 'score1' ] <= 70 ){
		$lv1 = 9;
	}else{
		$lv1 = 10;
	}
		$w1 = 8*$lv1;
	//棒グラフの作成

	$img1 = "./images/pdf/nl2".$id.".jpg";
	$st_score2 = substr($st_score, 1, 4) * 9.2;
	if($lv1 >= 1){
		$wid = 500;
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
	

	if($score[ 'score2' ] <= 30 ){
		$lv2 = 1;
	}elseif($score[ 'score2' ] <= 35 ){
		$lv2 = 2;
	}elseif($score[ 'score2' ] <= 40 ){
		$lv2 = 3;
	}elseif($score[ 'score2' ] <= 45 ){
		$lv2 = 4;
	}elseif($score[ 'score2' ] <= 50 ){
		$lv2 = 5;
	}elseif($score[ 'score2' ] <= 55 ){
		$lv2 = 6;
	}elseif($score[ 'score2' ] <= 60 ){
		$lv2 = 7;
	}elseif($score[ 'score2' ] <= 65 ){
		$lv2 = 8;
	}elseif($score[ 'score2' ] <= 70 ){
		$lv2 = 9;
	}else{
		$lv2 = 10;
	}
	$w2 = 8*$lv2;

	if($score[ 'score3' ] <= 30 ){
		$lv3 = 1;
	}elseif($score[ 'score3' ] <= 35 ){
		$lv3 = 2;
	}elseif($score[ 'score3' ] <= 40 ){
		$lv3 = 3;
	}elseif($score[ 'score3' ] <= 45 ){
		$lv3 = 4;
	}elseif($score[ 'score3' ] <= 50 ){
		$lv3 = 5;
	}elseif($score[ 'score3' ] <= 55 ){
		$lv3 = 6;
	}elseif($score[ 'score3' ] <= 60 ){
		$lv3 = 7;
	}elseif($score[ 'score3' ] <= 65 ){
		$lv3 = 8;
	}elseif($score[ 'score3' ] <= 70 ){
		$lv3 = 9;
	}else{
		$lv3 = 10;
	}
	$w3 = 8*$lv3;


	if($score[ 'score4' ] <= 30 ){
		$lv4 = 1;
	}elseif($score[ 'score4' ] <= 35 ){
		$lv4 = 2;
	}elseif($score[ 'score4' ] <= 40 ){
		$lv4 = 3;
	}elseif($score[ 'score4' ] <= 45 ){
		$lv4 = 4;
	}elseif($score[ 'score4' ] <= 50 ){
		$lv4 = 5;
	}elseif($score[ 'score4' ] <= 55 ){
		$lv4 = 6;
	}elseif($score[ 'score4' ] <= 60 ){
		$lv4 = 7;
	}elseif($score[ 'score4' ] <= 65 ){
		$lv4 = 8;
	}elseif($score[ 'score4' ] <= 70 ){
		$lv4 = 9;
	}else{
		$lv4 = 10;
	}
	$w4 = 8*$lv4;


	if($score[ 'score5' ] <= 30 ){
		$lv5 = 1;
	}elseif($score[ 'score5' ] <= 35 ){
		$lv5 = 2;
	}elseif($score[ 'score5' ] <= 40 ){
		$lv5 = 3;
	}elseif($score[ 'score5' ] <= 45 ){
		$lv5 = 4;
	}elseif($score[ 'score5' ] <= 50 ){
		$lv5 = 5;
	}elseif($score[ 'score5' ] <= 55 ){
		$lv5 = 6;
	}elseif($score[ 'score5' ] <= 60 ){
		$lv5 = 7;
	}elseif($score[ 'score5' ] <= 65 ){
		$lv5 = 8;
	}elseif($score[ 'score5' ] <= 70 ){
		$lv5 = 9;
	}else{
		$lv5 = 10;
	}
	$w5 = 8*$lv5;

	if($score[ 'score6' ] <= 30 ){
		$lv6 = 1;
	}elseif($score[ 'score6' ] <= 35 ){
		$lv6 = 2;
	}elseif($score[ 'score6' ] <= 40 ){
		$lv6 = 3;
	}elseif($score[ 'score6' ] <= 45 ){
		$lv6 = 4;
	}elseif($score[ 'score6' ] <= 50 ){
		$lv6 = 5;
	}elseif($score[ 'score6' ] <= 55 ){
		$lv6 = 6;
	}elseif($score[ 'score6' ] <= 60 ){
		$lv6 = 7;
	}elseif($score[ 'score6' ] <= 65 ){
		$lv6 = 8;
	}elseif($score[ 'score6' ] <= 70 ){
		$lv6 = 9;
	}else{
		$lv6 = 10;
	}
	$w6 = 8*$lv6;


	if($score[ 'score7' ] <= 30 ){
		$lv7 = 1;
	}elseif($score[ 'score7' ] <= 35 ){
		$lv7 = 2;
	}elseif($score[ 'score7' ] <= 40 ){
		$lv7 = 3;
	}elseif($score[ 'score7' ] <= 45 ){
		$lv7 = 4;
	}elseif($score[ 'score7' ] <= 50 ){
		$lv7 = 5;
	}elseif($score[ 'score7' ] <= 55 ){
		$lv7 = 6;
	}elseif($score[ 'score7' ] <= 60 ){
		$lv7 = 7;
	}elseif($score[ 'score7' ] <= 65 ){
		$lv7 = 8;
	}elseif($score[ 'score7' ] <= 70 ){
		$lv7 = 9;
	}else{
		$lv7 = 10;
	}
	$w7 = 8*$lv7;



	if($score[ 'score8' ] <= 30 ){
		$lv8 = 1;
	}elseif($score[ 'score8' ] <= 35 ){
		$lv8 = 2;
	}elseif($score[ 'score8' ] <= 40 ){
		$lv8 = 3;
	}elseif($score[ 'score8' ] <= 45 ){
		$lv8 = 4;
	}elseif($score[ 'score8' ] <= 50 ){
		$lv8 = 5;
	}elseif($score[ 'score8' ] <= 55 ){
		$lv8 = 6;
	}elseif($score[ 'score8' ] <= 60 ){
		$lv8 = 7;
	}elseif($score[ 'score8' ] <= 65 ){
		$lv8 = 8;
	}elseif($score[ 'score8' ] <= 70 ){
		$lv8 = 9;
	}else{
		$lv8 = 10;
	}
	$w8 = 8*$lv8;



	if($score[ 'score9' ] <= 30 ){
		$lv9 = 1;
	}elseif($score[ 'score9' ] <= 35 ){
		$lv9 = 2;
	}elseif($score[ 'score9' ] <= 40 ){
		$lv9 = 3;
	}elseif($score[ 'score9' ] <= 45 ){
		$lv9 = 4;
	}elseif($score[ 'score9' ] <= 50 ){
		$lv9 = 5;
	}elseif($score[ 'score9' ] <= 55 ){
		$lv9 = 6;
	}elseif($score[ 'score9' ] <= 60 ){
		$lv9 = 7;
	}elseif($score[ 'score9' ] <= 65 ){
		$lv9 = 8;
	}elseif($score[ 'score9' ] <= 70 ){
		$lv9 = 9;
	}else{
		$lv9 = 10;
	}
	$w9 = 8*$lv9;


	if($score[ 'score10' ] <= 30 ){
		$lv10 = 1;
	}elseif($score[ 'score10' ] <= 35 ){
		$lv10 = 2;
	}elseif($score[ 'score10' ] <= 40 ){
		$lv10 = 3;
	}elseif($score[ 'score10' ] <= 45 ){
		$lv10 = 4;
	}elseif($score[ 'score10' ] <= 50 ){
		$lv10 = 5;
	}elseif($score[ 'score10' ] <= 55 ){
		$lv10 = 6;
	}elseif($score[ 'score10' ] <= 60 ){
		$lv10 = 7;
	}elseif($score[ 'score10' ] <= 65 ){
		$lv10 = 8;
	}elseif($score[ 'score10' ] <= 70 ){
		$lv10 = 9;
	}else{
		$lv10 = 10;
	}
	$w10 = 8*$lv10;



	if($score[ 'score11' ] <= 30 ){
		$lv11 = 1;
	}elseif($score[ 'score11' ] <= 35 ){
		$lv11 = 2;
	}elseif($score[ 'score11' ] <= 40 ){
		$lv11 = 3;
	}elseif($score[ 'score11' ] <= 45 ){
		$lv11 = 4;
	}elseif($score[ 'score11' ] <= 50 ){
		$lv11 = 5;
	}elseif($score[ 'score11' ] <= 55 ){
		$lv11 = 6;
	}elseif($score[ 'score11' ] <= 60 ){
		$lv11 = 7;
	}elseif($score[ 'score11' ] <= 65 ){
		$lv11 = 8;
	}elseif($score[ 'score11' ] <= 70 ){
		$lv11 = 9;
	}else{
		$lv11 = 10;
	}
	$w11 = 8*$lv11;


	if($score[ 'score12' ] <= 30 ){
		$lv12 = 1;
	}elseif($score[ 'score12' ] <= 35 ){
		$lv12 = 2;
	}elseif($score[ 'score12' ] <= 40 ){
		$lv12 = 3;
	}elseif($score[ 'score12' ] <= 45 ){
		$lv12 = 4;
	}elseif($score[ 'score12' ] <= 50 ){
		$lv12 = 5;
	}elseif($score[ 'score12' ] <= 55 ){
		$lv12 = 6;
	}elseif($score[ 'score12' ] <= 60 ){
		$lv12 = 7;
	}elseif($score[ 'score12' ] <= 65 ){
		$lv12 = 8;
	}elseif($score[ 'score12' ] <= 70 ){
		$lv12 = 9;
	}else{
		$lv12 = 10;
	}
	$w12 = 8*$lv12;



	if($score[ 'score13' ] <= 30 ){
		$lv13 = 1;
	}elseif($score[ 'score13' ] <= 35 ){
		$lv13 = 2;
	}elseif($score[ 'score13' ] <= 40 ){
		$lv13 = 3;
	}elseif($score[ 'score13' ] <= 45 ){
		$lv13 = 4;
	}elseif($score[ 'score13' ] <= 50 ){
		$lv13 = 5;
	}elseif($score[ 'score13' ] <= 55 ){
		$lv13 = 6;
	}elseif($score[ 'score13' ] <= 60 ){
		$lv13 = 7;
	}elseif($score[ 'score13' ] <= 65 ){
		$lv13 = 8;
	}elseif($score[ 'score13' ] <= 70 ){
		$lv13 = 9;
	}else{
		$lv13 = 10;
	}
	$w13 = 8*$lv13;



	if($score[ 'score14' ] <= 30 ){
		$lv14 = 1;
	}elseif($score[ 'score14' ] <= 35 ){
		$lv14 = 2;
	}elseif($score[ 'score14' ] <= 40 ){
		$lv14 = 3;
	}elseif($score[ 'score14' ] <= 45 ){
		$lv14 = 4;
	}elseif($score[ 'score14' ] <= 50 ){
		$lv14 = 5;
	}elseif($score[ 'score14' ] <= 55 ){
		$lv14 = 6;
	}elseif($score[ 'score14' ] <= 60 ){
		$lv14 = 7;
	}elseif($score[ 'score14' ] <= 65 ){
		$lv14 = 8;
	}elseif($score[ 'score14' ] <= 70 ){
		$lv14 = 9;
	}else{
		$lv14 = 10;
	}
	$w14 = 8*$lv14;


	if($score[ 'score15' ] <= 30 ){
		$lv15 = 1;
	}elseif($score[ 'score15' ] <= 35 ){
		$lv15 = 2;
	}elseif($score[ 'score15' ] <= 40 ){
		$lv15 = 3;
	}elseif($score[ 'score15' ] <= 45 ){
		$lv15 = 4;
	}elseif($score[ 'score15' ] <= 50 ){
		$lv15 = 5;
	}elseif($score[ 'score15' ] <= 55 ){
		$lv15 = 6;
	}elseif($score[ 'score15' ] <= 60 ){
		$lv15 = 7;
	}elseif($score[ 'score15' ] <= 65 ){
		$lv15 = 8;
	}elseif($score[ 'score15' ] <= 70 ){
		$lv15 = 9;
	}else{
		$lv15 = 10;
	}
	$w15 = 8*$lv15;



	if($score[ 'score16' ] <= 30 ){
		$lv16 = 1;
	}elseif($score[ 'score16' ] <= 35 ){
		$lv16 = 2;
	}elseif($score[ 'score16' ] <= 40 ){
		$lv16 = 3;
	}elseif($score[ 'score16' ] <= 45 ){
		$lv16 = 4;
	}elseif($score[ 'score16' ] <= 50 ){
		$lv16 = 5;
	}elseif($score[ 'score16' ] <= 55 ){
		$lv16 = 6;
	}elseif($score[ 'score16' ] <= 60 ){
		$lv16 = 7;
	}elseif($score[ 'score16' ] <= 65 ){
		$lv16 = 8;
	}elseif($score[ 'score16' ] <= 70 ){
		$lv16 = 9;
	}else{
		$lv16 = 10;
	}
	$w16 = 8*$lv16;



	if($score[ 'score17' ] <= 30 ){
		$lv17 = 1;
	}elseif($score[ 'score17' ] <= 35 ){
		$lv17 = 2;
	}elseif($score[ 'score17' ] <= 40 ){
		$lv17 = 3;
	}elseif($score[ 'score17' ] <= 45 ){
		$lv17 = 4;
	}elseif($score[ 'score17' ] <= 50 ){
		$lv17 = 5;
	}elseif($score[ 'score17' ] <= 55 ){
		$lv17 = 6;
	}elseif($score[ 'score17' ] <= 60 ){
		$lv17 = 7;
	}elseif($score[ 'score17' ] <= 65 ){
		$lv17 = 8;
	}elseif($score[ 'score17' ] <= 70 ){
		$lv17 = 9;
	}else{
		$lv17 = 10;
	}
	$w17 = 8*$lv17;



	if($score[ 'score18' ] <= 30 ){
		$lv18 = 1;
	}elseif($score[ 'score18' ] <= 35 ){
		$lv18 = 2;
	}elseif($score[ 'score18' ] <= 40 ){
		$lv18 = 3;
	}elseif($score[ 'score18' ] <= 45 ){
		$lv18 = 4;
	}elseif($score[ 'score18' ] <= 50 ){
		$lv18 = 5;
	}elseif($score[ 'score18' ] <= 55 ){
		$lv18 = 6;
	}elseif($score[ 'score18' ] <= 60 ){
		$lv18 = 7;
	}elseif($score[ 'score18' ] <= 65 ){
		$lv18 = 8;
	}elseif($score[ 'score18' ] <= 70 ){
		$lv18 = 9;
	}else{
		$lv18 = 10;
	}
	$w18 = 8*$lv18;


	if($score[ 'score19' ] <= 30 ){
		$lv19 = 1;
	}elseif($score[ 'score19' ] <= 35 ){
		$lv19 = 2;
	}elseif($score[ 'score19' ] <= 40 ){
		$lv19 = 3;
	}elseif($score[ 'score19' ] <= 45 ){
		$lv19 = 4;
	}elseif($score[ 'score19' ] <= 50 ){
		$lv19 = 5;
	}elseif($score[ 'score19' ] <= 55 ){
		$lv19 = 6;
	}elseif($score[ 'score19' ] <= 60 ){
		$lv19 = 7;
	}elseif($score[ 'score19' ] <= 65 ){
		$lv19 = 8;
	}elseif($score[ 'score19' ] <= 70 ){
		$lv19 = 9;
	}else{
		$lv19 = 10;
	}
	$w19 = 8*$lv19;

	//配列グループ
	$score_grp = array(
					"score1" =>array("score2")
					,"score2"=>array("score1")
					,"score3"=>array("score4")
					,"score4"=>array("score3")
					,"score5"=>array("score6")
					,"score6"=>array("score5")
					,"score7"=>array("score8")
					,"score8"=>array("score7")
					,"score9"=>array("score10","score11")
					,"score10"=>array("score9","score11")
					,"score11"=>array("score9","score10")
					,"score12"=>array("score13","score14")
					,"score13"=>array("score12","score14")
					,"score14"=>array("score12","score13")
					,"score15"=>array("score16")
					,"score16"=>array("score15")
					,"score17"=>array("score18","score19")
					,"score18"=>array("score17","score19")
					,"score19"=>array("score17","score18")
				);


	//スコア最大値取得----------------------------
	$max = max($score);
	foreach($score as $key=>$val){
		if($val == $max){
			$maxlist[$key] = $val;
		}
	}

	//最大配列の要素の最小値
	foreach($maxlist as $key=>$val){
		$value = $score_grp[ $key ];
		foreach($value as $k=>$v){
			$minlist[$k] = $score[$v];
		}
		$min[$key] = min($minlist);
	}
	$mins = min($min);
	foreach($min as $key=>$val){
		if($val == $mins){
			$maxkome = $key;
			break;
		}
	}
	switch($maxkome){

		case "score1":
			$lv1 = $lv1."※";
			$strongKome = "1";
		break;
		case "score2":
			$lv2 = $lv2."※";
			$strongKome = "2";
		break;
		case "score3":
			$lv3 = $lv3."※";
			$strongKome = "3";
		break;
		case "score4":
			$lv4 = $lv4."※";
			$strongKome = "4";
		break;
		case "score5":
			$lv5 = $lv5."※";
			$strongKome = "5";
		break;
		case "score6":
			$lv6 = $lv6."※";
			$strongKome = "6";
		break;
		case "score7":
			$lv7 = $lv7."※";
			$strongKome = "7";
		break;
		case "score8":
			$lv8 = $lv8."※";
			$strongKome = "8";
		break;
		case "score9":
			$lv9 = $lv9."※";
			$strongKome = "9";
		break;
		case "score10":
			$lv10 = $lv10."※";
			$strongKome = "10";
		break;
		case "score11":
			$lv11 = $lv11."※";
			$strongKome = "11";
		break;
		case "score12":
			$lv12 = $lv12."※";
			$strongKome = "12";
		break;
		case "score13":
			$lv13 = $lv13."※";
			$strongKome = "13";
		break;
		case "score14":
			$lv14 = $lv14."※";
			$strongKome = "14";
		break;
		case "score15":
			$lv15 = $lv15."※";
			$strongKome = "15";
		break;
		case "score16":
			$lv16 = $lv16."※";
			$strongKome = "16";

		break;
		case "score17":
			$lv17 = $lv17."※";
			$strongKome = "17";

		break;
		case "score18":
			$lv18 = $lv18."※";
			$strongKome = "18";

		break;
		case "score19":
			$lv19 = $lv19."※";
			$strongKome = "19";

		break;
	}
	//スコア最大値終わり------------------------------

	//スコア最小値取得----------------------------
	$min = min($score);
	$minlist = array();
	$maxlist = array();
	$max = array();
	foreach($score as $key=>$val){
		if($val == $min){
			$minlist[$key] = $val;
		}
	}


	//最大配列の要素の最小値
	foreach($minlist as $key=>$val){
		$value = $score_grp[ $key ];
		foreach($value as $k=>$v){
			$maxlist[$k] = $score[$v];
		}
		$max[$key] = max($maxlist);
	}

	$maxs = max($max);

	foreach($max as $key=>$val){
		if($val == $maxs){
			$minkome = $key;
			break;
		}
	}
	switch($minkome){

		case "score1":
			$lv1 = $lv1."※";
			$weakKome = "1";
		break;
		case "score2":
			$lv2 = $lv2."※";
			$weakKome = "2";
		break;
		case "score3":
			$lv3 = $lv3."※";
			$weakKome = "3";
		break;
		case "score4":
			$lv4 = $lv4."※";
			$weakKome = "4";
		break;
		case "score5":
			$lv5 = $lv5."※";
			$weakKome = "5";
		break;
		case "score6":
			$lv6 = $lv6."※";
			$weakKome = "6";
		break;
		case "score7":
			$lv7 = $lv7."※";
			$weakKome = "7";
		break;
		case "score8":
			$lv8 = $lv8."※";
			$weakKome = "8";
		break;
		case "score9":
			$lv9 = $lv9."※";
			$weakKome = "9";
		break;
		case "score10":
			$lv10 = $lv10."※";
			$weakKome = "10";
		break;
		case "score11":
			$lv11 = $lv11."※";
			$weakKome = "11";
		break;
		case "score12":
			$lv12 = $lv12."※";
			$weakKome = "12";
		break;
		case "score13":
			$lv13 = $lv13."※";
			$weakKome = "13";
		break;
		case "score14":
			$lv14 = $lv14."※";
			$weakKome = "14";
		break;
		case "score15":
			$lv15 = $lv15."※";
			$weakKome = "15";
		break;
		case "score16":
			$lv16 = $lv16."※";
			$weakKome = "16";

		break;
		case "score17":
			$lv17 = $lv17."※";
			$weakKome = "17";

		break;
		case "score18":
			$lv18 = $lv18."※";
			$weakKome = "18";

		break;
		case "score19":
			$lv19 = $lv19."※";
			$weakKome = "19";

		break;

	}
	//スコア最小値終わり------------------------------

	//星マーク
	$abs1 = abs($lv1-$lv2);
	$abs2 = abs($lv3-$lv4);
	$abs3 = abs($lv5-$lv6);
	$abs4 = abs($lv7-$lv8);

	$abs5_1 = abs($lv9-$lv10);
	$abs5_2 = abs($lv10-$lv11);
	$abs5_3 = abs($lv9-$lv11);
	$abs5 = max(array($abs5_1,$abs5_2,$abs5_3));

	$abs6_1 = abs($lv12-$lv13);
	$abs6_2 = abs($lv13-$lv14);
	$abs6_3 = abs($lv12-$lv14);
	$abs6 = max(array($abs6_1,$abs6_2,$abs6_3));

	$abs7 = abs($lv15-$lv16);

	$abs8_1 = abs($lv17-$lv18);
	$abs8_2 = abs($lv18-$lv19);
	$abs8_3 = abs($lv17-$lv19);
	$abs8 = max(array($abs8_1,$abs8_2,$abs8_3));

	$abs_array = array(
				1=>$abs1
				,2=>$abs2
				,3=>$abs3
				,4=>$abs4
				,5=>$abs5
				,6=>$abs6
				,7=>$abs7
				,8=>$abs8
				);
	arsort($abs_array);

	foreach($abs_array as $key=>$val){
		if($val >= 3){
			$lv_array[$key] = $val;
		}
	}

	if(count($lv_array) >= 3 ){
		$abs1 = "";
		$abs2 = "";
		$abs3 = "";
		$abs4 = "";
		$abs5 = "";
		$abs6 = "";
		$abs7 = "";
		$abs8 = "";
		$abs9 = "";

		foreach($lv_array as $key=>$val){
			switch($key){
				case "1":
					$abs1 = abs($score[ 'score1' ]-$score[ 'score2' ]);
				break;
				case "2":
					$abs2 = abs($score[ 'score3' ]-$score[ 'score4' ]);
				break;
				case "3":
					$abs3 = abs($score[ 'score5' ]-$score[ 'score6' ]);
				break;
				case "4":
					$abs4 = abs($score[ 'score7' ]-$score[ 'score8' ]);
				break;
				case "5":
					$abs5_1 = abs($score[ 'score9'  ]-$score[ 'score10' ]);
					$abs5_2 = abs($score[ 'score10' ]-$score[ 'score11' ]);
					$abs5_3 = abs($score[ 'score9'  ]-$score[ 'score11' ]);
					$abs5 = max(array($abs5_1,$abs5_2,$abs5_3));

				break;
				case "6":
					$abs6_1 = abs($score[ 'score12' ]-$score[ 'score13' ]);
					$abs6_2 = abs($score[ 'score13' ]-$score[ 'score14' ]);
					$abs6_3 = abs($score[ 'score12' ]-$score[ 'score14' ]);
					$abs6 = max(array($abs6_1,$abs6_2,$abs6_3));
				break;
				case "7":
					$abs7 = abs($score[ 'score15' ]-$score[ 'score16' ]);
				break;
				case "8":
					$abs8_1 = abs($score[ 'score17' ]-$score[ 'score18' ]);
					$abs8_2 = abs($score[ 'score18' ]-$score[ 'score19' ]);
					$abs8_3 = abs($score[ 'score17' ]-$score[ 'score19' ]);
					$abs8 = max(array($abs8_1,$abs8_2,$abs8_3));
				break;
			}
		}
		$abs = array(
					1=>$abs1
					,2=>$abs2
					,3=>$abs3
					,4=>$abs4
					,5=>$abs5
					,6=>$abs6
					,7=>$abs7
					,8=>$abs8
				);
		arsort($abs);
		$i=1;
		$lv_array = array();
		foreach($abs as $key=>$val){
			$lv_array[$key] = $val;
			if($i >= 2){
				break;
			}
			$i++;
		}
		
	}









	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	$make->makePdfKozin($pdf,$testdata,15);

	$pdf->Write("5", "１．コミュニケーション特性検査で測定していること");
	$pdf->Ln(5);
	$pdf->SetFontSize(9);
	$msg = "本検査は、仕事で求められるコミュニケーション特性を客観的に測定しています。実践心理学「ＮＬＰコーチング」の言語パターン\nに基づき、各人の特性を ≪個人行動≫と≪組織行動≫ の観点から把握しています。最も高い要素／低い要素には※印が付き、\n「４．あなたの顕著な要素」にて解説します。同じ項目間で差異が大きい要素がある箇所には◆印が付き、「５．あなたの特徴」にて解説します。自己理解を図りコミュニケーション改善のための具体的なヒントを得ることができます。";
	$pdf->MultiCell(192, 5, $msg, 1,"L");


	$pdf->Ln(4);
	$pdf->SetFontSize(11);
	$pdf->Write("5", "２．個人行動領域におけるレベル");
	$pdf->Ln(6);


	//枠の設定
	$pdf->SetFontSize(8);
	$pdf->Cell(20, 4, '', 1,"R");
	$pdf->Cell(27.5, 4, '項目', 1,"R","C");
	$pdf->Cell(27.5, 4, '要素', 1,"R","C");
	$pdf->Cell(12, 4, 'レベル', 1,"R","C");
	$pdf->Cell(8,  4, '1', 1,"R","C");
	$pdf->Cell(8,  4, '2', 1,"R","C");
	$pdf->Cell(8,  4, '3', 1,"R","C");
	$pdf->Cell(8,  4, '4', 1,"R","C");
	$pdf->Cell(8,  4, '5', 1,"R","C");
	$pdf->Cell(8,  4, '6', 1,"R","C");
	$pdf->Cell(8,  4, '7', 1,"R","C");
	$pdf->Cell(8,  4, '8', 1,"R","C");
	$pdf->Cell(8,  4, '9', 1,"R","C");
	$pdf->Cell(8,  4, '10', 1,"R","C");
	$pdf->Cell(25, 4, '特徴的項目', 1,"R","C");
	$pdf->Ln();
	$pdf->Cell(20, 40, "", 1,"R","C");

	$pdf->Image($img1, 97, 80.3, $w1,2.5);
	$pdf->Cell(27.5, 10, '意識のスケール', 1,"R","C");
	$pdf->Cell(27.5, 5, '全般・全体型', 1,"R","C");
	$lv = $lv1;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$hosi_array = array();
	if($lv_array[1]){
		$hosi = "◆";
		//要素におけるスコアの最大値を取得
		$maxary = array();
		$maxary = array(
					"score1"=>$score[ 'score1' ]
					,"score2"=>$score[ 'score2' ]
					);
		$values = array();
		foreach($maxary as $key=>$val){
			$values[] = $val; 
			
		}
		array_multisort($values, SORT_DESC, $maxary);
		$i = 0;
		foreach($maxary as $key=>$val){
			$keys[$i] = $key;
			$i++;
		}
		$hosi_ary[1] = $keys[0];
		$hosi_ary_key[1] = 1;

	}else{
		$hosi = "";
	}
	$pdf->SetFontSize(15);

	$pdf->Cell(25, 10, $hosi, 1,"1","C");

	$pdf->SetFontSize(8);

	$pdf->SetXY(57.5, 84);
	$pdf->Cell(27.5, 5, '具体・詳細型', 1,"R","C");
	$lv = $lv2;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Cell(8, 5, '', 1,"0","C");
	$pdf->Image($img1, 97, 85.2, $w2,2.5);


	$pdf->SetXY(30, 89);
	$pdf->Cell(27.5, 10, '', 1,"R","C");


	$pdf->SetFontSize(8);
	$pdf->Cell(27.5, 5, '目的追求型', 1,"R","C");
	$lv = $lv3;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	if($lv_array[2]){
		$hosi = "◆";
		$maxary = array();
		$maxary = array(
					"score3"=>$score[ 'score3' ]
					,"score4"=>$score[ 'score4' ]
					);
		$values = array();
		foreach($maxary as $key=>$val){
			$values[] = $val; 
			
		}

		array_multisort($values, SORT_DESC, $maxary);
		$i = 0;
		foreach($maxary as $key=>$val){
			$keys[$i] = $key;
			$i++;
		}
		$hosi_ary[2] = $keys[0];
		$hosi_ary_key[2] = 1;


	}else{
		$hosi = "";
	}

	$pdf->SetFontSize(15);
	$pdf->Cell(25, 10, $hosi, 1,"1","C");
	$pdf->Image($img1, 97, 90.2, $w3,2.5);

	$pdf->SetFontSize(8);
	$pdf->SetXY(57.5, 94);
	$pdf->Cell(27.5, 5, '問題回避型', 1,"R","C");
	$lv = $lv4;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 95.2, $w4,2.5);


	$pdf->SetXY(30, 99);

	$pdf->Cell(27.5, 10, '業務の取組み方', 1,"R","C");
	$pdf->Cell(27.5, 5, '即実行型', 1,"R","C");
	$lv = $lv5;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	if($lv_array[3]){
		$hosi = "◆";
		$maxary = array();
		$maxary = array(
					"score5"=>$score[ 'score5' ]
					,"score6"=>$score[ 'score6' ]
					);
		$values = array();
		foreach($maxary as $key=>$val){
			$values[] = $val; 
			
		}

		array_multisort($values, SORT_DESC, $maxary);
		$i = 0;
		foreach($maxary as $key=>$val){
			$keys[$i] = $key;
			$i++;
		}
		$hosi_ary[3] = $keys[0];
		$hosi_ary_key[3] = 1;

	}else{
		$hosi = "";
	}

	$pdf->SetFontSize(15);
	$pdf->Cell(25, 10, $hosi, 1,"1","C");
	$pdf->Image($img1, 97, 100.2, $w5,2.5);


	$pdf->SetFontSize(8);
	$pdf->SetXY(57.5, 104);
	$pdf->Cell(27.5, 5, '熟慮・分析型', 1,"R","C");
	$lv = $lv6;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 105.2, $w6,2.5);



	$pdf->SetXY(30, 109);
	$pdf->Cell(27.5, 10, '選択行動の傾向', 1,"R","C");
	$pdf->Cell(27.5, 5, '多様選択型', 1,"R","C");
	$lv = $lv7;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	if($lv_array[4]){
		$hosi = "◆";

		$maxary = array();
		$maxary = array(
					"score7"=>$score[ 'score7' ]
					,"score8"=>$score[ 'score8' ]
					);
		$values = array();
		foreach($maxary as $key=>$val){
			$values[] = $val; 
			
		}

		array_multisort($values, SORT_DESC, $maxary);
		$i = 0;
		foreach($maxary as $key=>$val){
			$keys[$i] = $key;
			$i++;
		}
		$hosi_ary[4] = $keys[0];
		$hosi_ary_key[4] = 1;

	}else{
		$hosi = "";
	}

	$pdf->SetFontSize(15);
	$pdf->Cell(25, 10, $hosi, 1,"1","C");
	$pdf->Image($img1, 97, 110.3, $w7,2.5);


	$pdf->SetFontSize(8);
	$pdf->SetXY(57.5, 114);
	$pdf->Cell(27.5, 5, '既存プロセス型', 1,"R","C");
	$lv = $lv8;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 115.1, $w8,2.5);



	$pdf->SetXY(13, 96);
	$pdf->Write("5", "個人行動");
	$pdf->SetXY(33, 91);
	$pdf->Write("5", "モチベーション");
	$pdf->SetXY(33, 94);
	$pdf->Write("5", "の方向");

	$pdf->SetXY(10, 124);
	$pdf->SetFontSize(11);
	$pdf->Write("5", "３．組織行動領域におけるレベル");
	$pdf->Ln(5);


	//枠の設定
	$pdf->SetFontSize(8);
	$pdf->Cell(20, 5, '', 1,"R");
	$pdf->Cell(27.5, 5, '項目', 1,"R","C");
	$pdf->Cell(27.5, 5, '要素', 1,"R","C");
	$pdf->Cell(12, 5, 'レベル', 1,"R","C");
	$pdf->Cell(8,  5, '1', 1,"R","C");
	$pdf->Cell(8,  5, '2', 1,"R","C");
	$pdf->Cell(8,  5, '3', 1,"R","C");
	$pdf->Cell(8,  5, '4', 1,"R","C");
	$pdf->Cell(8,  5, '5', 1,"R","C");
	$pdf->Cell(8,  5, '6', 1,"R","C");
	$pdf->Cell(8,  5, '7', 1,"R","C");
	$pdf->Cell(8,  5, '8', 1,"R","C");
	$pdf->Cell(8,  5, '9', 1,"R","C");
	$pdf->Cell(8,  5, '10', 1,"R","C");
	$pdf->Cell(25, 5, '特徴的項目', 1,"R","C");
	$pdf->Ln();
	$pdf->Cell(20, 55, "組織行動", 1,"R","C");


	$pdf->Cell(27.5, 15, '変化への対応', 1,"R","C");
	$pdf->Cell(27.5, 5, '長期安定型', 1,"R","C");
	$lv = $lv9;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	if($lv_array[5]){
		$hosi = "◆";

		$maxary = array();
		$maxary = array(
					"score9"=>$score[ 'score9' ]
					,"score10"=>$score[ 'score10' ]
					,"score11"=>$score[ 'score11' ]
					);

		$values = array();
		foreach($maxary as $key=>$val){
			$values[] = $val; 
			
		}

		array_multisort($values, SORT_DESC, $maxary);
		$i = 0;
		foreach($maxary as $key=>$val){
			$keys[$i] = $key;
			$i++;
		}
		$hosi_ary[5] = $keys[0];
		switch($keys[0]){
			case "score9":
				if($score[ 'score10' ] <= $score[ 'score11' ]){
					$hosi_ary_key[5] = 1;
				}else{
					$hosi_ary_key[5] = 2;
				}
			break;
			case "score10":
				if($score[ 'score9' ] <= $score[ 'score11' ]){
					$hosi_ary_key[5] = 1;
				}else{
					$hosi_ary_key[5] = 2;
				}
			break;
			case "score11":
				if($score[ 'score9' ] <= $score[ 'score10' ]){
					$hosi_ary_key[5] = 1;
				}else{
					$hosi_ary_key[5] = 2;
				}
			break;
		}

	}else{
		$hosi = "";
	}

	$pdf->SetFontSize(15);
	$pdf->Cell(25, 15, $hosi, 1,"1","C");
	$pdf->Image($img1, 97, 135.2, $w9,2.5);

	$pdf->SetFontSize(8);
	$pdf->SetXY(57.5, 139);
	$pdf->Cell(27.5, 5, '継続進展型', 1,"R","C");
	$lv = $lv10;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 140.2, $w10,2.5);


	$pdf->SetXY(57.5, 144);
	$pdf->Cell(27.5, 5, '変化相違型', 1,"R","C");
	$lv = $lv11;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 145.2, $w11,2.5);


	$pdf->SetXY(30, 149);
	$pdf->Cell(27.5, 15, '仕事のスタイル', 1,"0","C");
	$pdf->Cell(27.5, 5, 'チーム型', 1,"0","C");
	$lv = $lv12;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	if($lv_array[6]){
		$hosi = "◆";

		$maxary = array();
		$maxary = array(
					"score12"=>$score[ 'score12' ]
					,"score13"=>$score[ 'score13' ]
					,"score14"=>$score[ 'score14' ]
					);

		$values = array();
		foreach($maxary as $key=>$val){
			$values[] = $val; 
			
		}

		array_multisort($values, SORT_DESC, $maxary);
		$i = 0;
		foreach($maxary as $key=>$val){
			$keys[$i] = $key;
			$i++;
		}
		$hosi_ary[6] = $keys[0];
		switch($keys[0]){
			case "score12":
				if($score[ 'score13' ] <= $score[ 'score14' ]){
					$hosi_ary_key[6] = 1;
				}else{
					$hosi_ary_key[6] = 2;
				}
			break;
			case "score13":
				if($score[ 'score12' ] <= $score[ 'score14' ]){
					$hosi_ary_key[6] = 1;
				}else{
					$hosi_ary_key[6] = 2;
				}
			break;
			case "score14":
				if($score[ 'score12' ] <= $score[ 'score13' ]){
					$hosi_ary_key[6] = 1;
				}else{
					$hosi_ary_key[6] = 2;
				}
			break;
		}

	}else{
		$hosi = "";
	}
	$pdf->SetFontSize(15);
	$pdf->Cell(25, 15, $hosi, 1,"1","C");
	$pdf->Image($img1, 97, 150.2, $w12,2.5);


	$pdf->SetFontSize(8);
	$pdf->SetXY(57.5, 154);
	$pdf->Cell(27.5, 5, '責任分担型', 1,"R","C");
	$lv = $lv13;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 155.2, $w13,2.5);




	$pdf->SetXY(57.5, 159);
	$pdf->Cell(27.5, 5, '個人型', 1,"R","C");
	$lv = $lv14;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 160.2, $w14,2.5);


	$pdf->SetXY(30, 164);
	$pdf->Cell(27.5, 10, '重視する要素', 1,"R","C");
	$pdf->Cell(27.5, 5, 'タスク重視型', 1,"R","C");
	$lv = $lv15;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	if($lv_array[7]){
		$hosi = "◆";
		$maxary = array();
		$maxary = array(
					"score15"=>$score[ 'score15' ]
					,"score16"=>$score[ 'score16' ]
					);
		$values = array();
		foreach($maxary as $key=>$val){
			$values[] = $val; 
			
		}

		array_multisort($values, SORT_DESC, $maxary);
		$i = 0;
		foreach($maxary as $key=>$val){
			$keys[$i] = $key;
			$i++;
		}
		$hosi_ary[7] = $keys[0];
		$hosi_ary_key[7] = 1;

	}else{
		$hosi = "";
	}
	$pdf->SetFontSize(15);
	$pdf->Cell(25, 10, $hosi, 1,"1","C");
	$pdf->Image($img1, 97, 165.2, $w15,2.5);

	$pdf->SetFontSize(8);
	$pdf->SetXY(57.5, 169);
	$pdf->Cell(27.5, 5, '人間重視型', 1,"R","C");
	$lv = $lv16;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 170.2, $w16,2.5);


	$pdf->SetXY(30, 174);
	$pdf->Cell(27.5, 15, 'ルールの適用', 1,"R","C");
	$pdf->SetFontSize(7);
	$pdf->Cell(27.5, 5, '自分ルール適用型', 1,"R","C");
	$pdf->SetFontSize(8);
	$lv = $lv17;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");

	if($lv_array[8]){
		$hosi = "◆";
		$maxary = array();
		$maxary = array(
					"score17"=>$score[ 'score17' ]
					,"score18"=>$score[ 'score18' ]
					,"score19"=>$score[ 'score19' ]
					);
		$values = array();
		foreach($maxary as $key=>$val){
			$values[] = $val; 
			
		}
		array_multisort($values, SORT_DESC, $maxary);
		$i = 0;
		foreach($maxary as $key=>$val){
			$keys[$i] = $key;
			$i++;
		}
		$hosi_ary[8] = $keys[0];
		switch($keys[0]){
			case "score17":
				if($score[ 'score18' ] <= $score[ 'score19' ]){
					$hosi_ary_key[8] = 1;
				}else{
					$hosi_ary_key[8] = 2;
				}
			break;
			case "score18":
				if($score[ 'score17' ] <= $score[ 'score19' ]){
					$hosi_ary_key[8] = 1;
				}else{
					$hosi_ary_key[8] = 2;
				}
			break;
			case "score19":
				if($score[ 'score17' ] <= $score[ 'score18' ]){
					$hosi_ary_key[8] = 1;
				}else{
					$hosi_ary_key[8] = 2;
				}
			break;
		}


	}else{
		$hosi = "";
	}
	$pdf->SetFontSize(15);
	$pdf->Cell(25, 15, $hosi, 1,"1","C");
	$pdf->Image($img1, 97, 175.2, $w17,2.5);


	$pdf->SetFontSize(8);
	$pdf->SetXY(57.5, 179);
	$pdf->SetFontSize(7);
	$pdf->Cell(27.5, 5, '組織ルール遵守型', 1,"R","C");
	$pdf->SetFontSize(8);
	$lv = $lv18;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 180.2, $w18,2.5);



	$pdf->SetXY(57.5, 184);
	$pdf->Cell(27.5, 5, '寛容型', 1,"R","C");
	$lv = $lv19;
	$pdf->Cell(12, 5, $lv, 1,"R","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Cell(8,  5, '', 1,"0","C");
	$pdf->Image($img1, 97, 185.2, $w19,2.5);

	$pdf->Ln(9);
	$pdf->SetFontSize(11);
	$pdf->Write("5", "４．".$name."さんの顕著な要素　(最も高い要素／低い要素)");
	$pdf->Ln(5);

	$msg = $strong_array[ $strongKome ];
	$msg .= "\n";
	$msg .= $weak_array[ $weakKome ];


	$pdf->SetFontSize(9);
	$pdf->MultiCell(192, 4.5, $msg, 1,"L");


	$pdf->Ln(4);
	$pdf->SetFontSize(11);
	$pdf->Write("5", "５．".$name."さんの特徴　(同じ項目内で差異が大きい要素)");
	$pdf->Ln(5);

	if(count($hosi_ary)){
		foreach($hosi_ary as $key=>$val){
			$youso[ $val ] = $val;
		}
	}

	$i=0;
	if(count($youso)){
		foreach($youso as $key=>$val){
			$yso[$i] = $val;
			$i++;
		}
	}


	if(count($hosi_ary_key)){
		foreach($hosi_ary_key as $key=>$val){
			$youso2[ $key ] = $val;
		}
	}

	$i=0;
	if(count($youso2)){
		foreach($youso2 as $key=>$val){
			$yso2[$i] = $val;
			$i++;
		}
	}

	/*
	$yso[0] = "score16";
	$yso2[0] = "1";
	*/

	$msg = $comment[$yso[0]][$yso2[0]][0]."\n".$comment[$yso[0]][$yso2[0]][1];

	if(strlen($msg) <= 1){
		$msg = "\n\n\n\n\n";
	}
	$pdf->SetFontSize(9);
	$pdf->MultiCell(192, 4.0, $msg, 1,"L");


	$msg1 = $comment[$yso[1]][$yso2[1]][0]."\n".$comment[$yso[1]][$yso2[1]][1];
	if(strlen($msg1) <= 1){
		$msg1 = "\n\n\n\n\n";
	}
	$pdf->SetFontSize(9);
	$pdf->MultiCell(192, 4.0, $msg1, 1,"L");

	$pdf->SetXY(10, 275);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');


?>