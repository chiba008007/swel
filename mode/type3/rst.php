<?PHP
//-------------------------------------------
//BAテスト結果表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusRst.php");

$obj = new cusRstMethod();
$where[ 'id' ] = $sec;
$result = $obj->getTestResult($where);
$type = $result[0][ 'type' ];
//結果読み取り

switch($type){
	case "1":
	case "12":
	case "41":
	case "72":
		include_once("./init/resultBa1.php");
		$imgDir = "ta";
	break;
	case "2":
		include_once("./init/resultBa2.php");
		$imgDir = "tb";
	break;
	case "3":
		include_once("./init/resultBa3.php");
		$fsFlg = "on";
	break;
	case "13":
	case "35":
	case "42":
		include_once(D_PATH_HOME."/mode/pdf/pdf14_comment.php");
		$mathFlg = "on";
		if($type == 35){
			$math = $obj->getMath2Data($where);
		}else{
			$math = $obj->getMathData($where);
		}
		$haku    = $math[ 'haku'    ];
		$bunseki = $math[ 'bunseki' ];
		$sentaku = $math[ 'sentaku' ];
		$yosoku  = $math[ 'yosoku'  ];
		$hyogen  = $math[ 'hyogen'  ];

		if($haku >= 15){
			$hkey = "a";
		}elseif($haku >= 7){
			$hkey = "b";
		}else{
			$hkey = "c";
		}

		if($bunseki >= 15){
			$bkey = "a";
		}elseif($bunseki >= 7){
			$bkey = "b";
		}else{
			$bkey = "c";
		}

		if($sentaku >= 15){
			$skey = "a";
		}elseif($sentaku >= 7){
			$skey = "b";
		}else{
			$skey = "c";
		}

		if($yosoku >= 15){
			$ykey = "a";
		}elseif($yosoku >= 7){
			$ykey = "b";
		}else{
			$ykey = "c";
		}

		if($hyogen >= 15){
			$hykey = "a";
		}elseif($hyogen >= 7){
			$hykey = "b";
		}else{
			$hykey = "c";
		}


	break;
}

if($mathFlg){
	$code = "";
	$code = "<h3>【把握力】</h3>";
	$code .= mb_convert_encoding($a_math_advice_haku_pdf[$hkey],"UTF-8","SJIS")."<br />";
	$code .= "<h3>【分析力】</h3>";
	$code .= mb_convert_encoding($a_math_advice_bunseki_pdf[$bkey],"UTF-8","SJIS")."<br />";
	$code .= "<h3>【選択力】</h3>";
	$code .= mb_convert_encoding($a_math_advice_sentaku_pdf[$skey],"UTF-8","SJIS")."<br />";
	$code .= "<h3>【予測力】</h3>";
	$code .= mb_convert_encoding($a_math_advice_yosoku_pdf[$ykey],"UTF-8","SJIS")."<br />";
	$code .= "<h3>【表現力】</h3>";
	$code .= mb_convert_encoding($a_math_advice_hyogen_pdf[$hykey],"UTF-8","SJIS")."<br />";
}elseif($fsFlg){
	
	$lv = $result[0][ 'level' ];
	$code = "";
	$code .= "<p>".$ans_data[$lv][0]."</p>";
	$code .= "<p class='tle' >".$ans_data[ $lv ][1]."</p>";
	$code .= "<p class='sub' >".$ans_data[ $lv ][2]."</p>";
}else{
	$soyo  = $result[0][ 'soyo'  ];
	$level = $result[0][ 'level' ];

	$code = "";
	$code = $ans_data[ $soyo ][ 0 ];
	$code .= "<br /><br />";
	$code .= $ans_data[ $soyo ][ 1 ];
	$code .= "<br /><br />";
	$code .= $ans_data[ $soyo ][ 2 ];
	$code .= "<br /><br />";
	if(preg_match("/jpg/",$ans_data[ $soyo ][ 3])){
		$code .= "<img src='/images/".$imgDir."/".$ans_data[ $soyo ][ 3 ]."' />";
	}else{
		$code .= $ans_data[ $soyo ][ 3 ];
	}
	$code .= "<br /><br />";
	$code .= $ans_data[ $soyo ][ 4 ];
}

?>