<?PHP
$array_pos = array(
				1=>"社長・役員・事業部長相当"
				,2=>"部長相当"
				,3=>"課長相当"
				,4=>"主任・リーダー相当"
				,5=>"その他"
			);
if($five == "anq"){
	echo "アンケート日";
	echo ",受検者ID";
	echo ",受検者名";
	echo ",受検者名かな";
	echo ",メールアドレス";
	echo ",回答1";
	echo ",回答2";
	echo ",回答3";
	echo ",回答4";
	echo ",回答5";
	echo ",回答6";
	echo ",回答7";
	echo ",回答8";
	echo ",回答9";
	echo ",回答10";
	echo ",回答11";
	echo ",回答12";
	echo ",回答13";

	echo "\n";
	if(count($tlist[ 'ans' ])){
		foreach($tlist[ 'ans' ] as $key=>$val){
			echo "".mb_convert_encoding($val[ 'start_date' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'empnum' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'sei' ].$val[ 'mei' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'sei_kana' ].$val[ 'mei_kana' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'mail' ],"SJIS-WIN","UTF-8").",";
			for($i=1;$i<=13;$i++){
				$anq = "anq".$i;
				echo mb_convert_encoding($val[$anq],"SJIS-WIN","UTF-8").",";
			}
			

			echo "\n";
		}
	}
}else{
	echo "検査名,".mb_convert_encoding($tlist[ 'testname' ],"SJIS","UTF-8")."\n";
	echo "パートナー企業,".mb_convert_encoding($tlist[ 'ptname' ],"SJIS","UTF-8")."\n";
	echo "顧客企業,".mb_convert_encoding($tlist[ 'cname' ],"SJIS","UTF-8")."\n";
	echo "受検者ID";
	echo ",受検者名";
	echo ",受検者名かな";
	echo ",生年月日";
	echo ",年齢";
	echo ",性別";
	echo ",合否";
	echo ",メモ１";
	echo ",メモ２";
	echo ",受検日";
	echo ",受検開始時間";
	echo ",受検時間";
	echo ",受検種別";
	echo ",関係者ID";
	if($_REQUEST[ 'type' ] == "sub"){
		echo ",回答1(1)";
		echo ",回答1(2)";
		echo ",回答1(3)";
		echo ",回答1(4)";
		echo ",回答2(1)";
		echo ",回答2(2)";
		echo ",回答2(3)";
		echo ",回答2(4)";
		echo ",回答3(1)";
		echo ",回答3(2)";
		echo ",回答3(3)";
		echo ",回答3(4)";
		echo ",回答4";
		echo ",回答5(1)";
		echo ",回答5(2)";
		echo ",回答5(3)";
		echo ",回答5(4)";
		echo ",回答5(5)";
		echo ",回答6(1)";
		echo ",回答6(2)";
		echo ",回答6(3)";
		echo ",回答6(4)";
		echo ",回答6(5)";
		echo ",回答7(1)";
		echo ",回答7(2)";
		echo ",回答7(3)";
		echo ",回答7(4)";
		echo ",回答7(5)";
		echo ",回答7(6)";
		echo ",回答7(7)";
		echo ",回答7(8)";
		echo ",回答7(9)";
		
		echo ",回答8(1)";
		echo ",回答8(2)";
		echo ",回答8(3)";
		echo ",回答8(4)";
		echo ",回答8(5)";
		echo ",回答8(6)";
		echo ",回答8(7)";

		echo ",回答9(1)";
		echo ",回答9(2)";
		echo ",回答9(3)";
		echo ",回答9(4)";
		echo ",回答9(5)";
		echo ",回答9(6)";
		echo ",回答9(7)";
		echo ",回答9(8)";
		echo ",回答9(9)";
		echo ",回答9(10)";
		echo ",回答9(11)";
		echo ",回答9(12)";
		echo ",回答9(13)";
		echo ",回答9(14)";
		echo ",回答9(15)";

		echo ",回答10(1)";
		echo ",回答10(2)";
		echo ",回答10(3)";
		echo ",回答10(4)";
		echo ",回答10(5)";
		echo ",回答10(6)";
		echo ",回答10(7)";
		echo ",回答10(8)";
	
		echo ",回答11(1)";
		echo ",回答11(2)";
		echo ",回答11(3)";
		echo ",回答11(4)";

		echo ",回答12(1)";
		echo ",回答12(2)";
		echo ",回答12(3)";
		echo ",回答12(4)";
		echo ",回答12(5)";
		echo ",回答12(6)";
		echo ",回答12(7)";
		echo ",回答12(8)";
		echo ",回答12(9)";

		echo ",回答13(1)";
		echo ",回答13(2)";
		echo ",回答13(3)";
		echo ",回答13(4)";
		echo ",回答13(5)";
		echo ",回答13(6)";
		echo ",回答13(7)";

		echo ",回答14(1)";
		echo ",回答14(2)";
		echo ",回答14(3)";
		echo ",回答14(4)";

		echo ",回答15(1)";
		echo ",回答15(2)";
		echo ",回答15(3)";
		echo ",回答15(4)";
		echo ",回答15(5)";

		echo ",回答16(1)";
		echo ",回答16(2)";
		echo ",回答16(3)";
		echo ",回答16(4)";
		echo ",回答16(5)";
		echo ",回答16(6)";
		echo ",回答16(7)";
		echo ",回答16(8)";
		echo ",回答16(9)";

		echo ",回答17(1)";
		echo ",回答17(2)";
		echo ",回答17(3)";
		echo ",回答17(4)";
		echo ",回答17(5)";
		echo ",回答17(6)";
		echo ",回答17(7)";
		echo ",回答17(8)";
		echo ",回答17(9)";
		echo ",回答17(10)";

		echo ",回答18";
		echo ",回答19";
		echo ",回答20";

	}else{
        echo ",回答1";
        echo ",回答2(1)";
        echo ",回答2(2)";
        echo ",回答2(3)";
        echo ",回答2(4)";
        echo ",回答3(1)";
        echo ",回答3(2)";
        echo ",回答3(3)";
        echo ",回答3(4)";
        echo ",回答4";
				echo ",回答5(1)";
        echo ",回答5(2)";
        echo ",回答5(3)";
        echo ",回答5(4)";
        echo ",回答5(5)";
				echo ",回答6(1)";
        echo ",回答6(2)";
        echo ",回答6(3)";
        echo ",回答6(4)";
        echo ",回答6(5)";
				echo ",回答7(1)";
        echo ",回答7(2)";
        echo ",回答7(3)";
        echo ",回答7(4)";
        echo ",回答7(5)";
        echo ",回答7(6)";
        echo ",回答7(7)";
        echo ",回答7(8)";
        echo ",回答7(9)";
				echo ",回答8(1)";
        echo ",回答8(2)";
        echo ",回答8(3)";
        echo ",回答8(4)";
        echo ",回答8(5)";
        echo ",回答8(6)";
        echo ",回答8(7)";
				echo ",回答9(1)";
        echo ",回答9(2)";
        echo ",回答9(3)";
        echo ",回答9(4)";
        echo ",回答9(5)";
        echo ",回答9(6)";
        echo ",回答9(7)";
				echo ",回答9(8)";
        echo ",回答9(9)";
        echo ",回答9(10)";
        echo ",回答9(11)";
        echo ",回答9(12)";
        echo ",回答9(13)";
        echo ",回答9(14)";
        echo ",回答9(15)";
				echo ",回答10(1)";
        echo ",回答10(2)";
        echo ",回答10(3)";
        echo ",回答10(4)";
        echo ",回答10(5)";
        echo ",回答10(6)";
        echo ",回答10(7)";
				echo ",回答10(8)";
				echo ",回答11(1)";
        echo ",回答11(2)";
        echo ",回答11(3)";
        echo ",回答11(4)";

				echo ",回答12(1)";
        echo ",回答12(2)";
        echo ",回答12(3)";
        echo ",回答12(4)";
        echo ",回答12(5)";
        echo ",回答12(6)";
        echo ",回答12(7)";
				echo ",回答12(8)";
        echo ",回答12(9)";
        echo ",回答12(10)";

				echo ",回答13(1)";
        echo ",回答13(2)";
        echo ",回答13(3)";
        echo ",回答13(4)";
        echo ",回答13(5)";
        echo ",回答13(6)";
        echo ",回答13(7)";
				echo ",回答13(8)";
        echo ",回答13(9)";
        echo ",回答13(10)";
        echo ",回答14";
        echo ",回答15";
        echo ",回答16";
        echo ",回答17";

    }
	echo "\n";
	if(count($tlist[ 'ans' ])){

		foreach($tlist[ 'ans' ] as $key=>$val){
			echo "=\"".mb_convert_encoding($val[ 'empnum' ],"SJIS-WIN","UTF-8")."\",";
			echo mb_convert_encoding($val[ 'sei' ].$val[ 'mei' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'sei_kana' ].$val[ 'mei_kana' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'birth' ],"SJIS-WIN","UTF-8").",";
			if($val[ 'age' ] > 0 ){
				echo mb_convert_encoding($val[ 'age' ],"SJIS-WIN","UTF-8").",";

			}
			echo mb_convert_encoding($val[ 'sex' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'pass' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'memo1' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'memo2' ],"SJIS-WIN","UTF-8").",";
			//受験日
			$examdate = substr($val[ 'starttime' ],0,11);
			$examtime = substr($val[ 'starttime' ],11,8);
			echo $examdate.",";
			echo $examtime.",";
			$starttime = strtotime($val[ 'starttime' ]);
			$endtime  = strtotime($val[ 'endtime' ]);
			$times = s2h($endtime-$starttime);
			if($times < 0){
				$times = "";
			}
			echo $times.",";
			echo $val[ 'boss' ].",";
			echo $obj->emp[$val[ 'rep'  ]].",";
			for($i = 1; $i <= 113; $i ++){
				$ans = "ans".$i;

				echo str_replace(array("\r\n","\r","\n"), "", mb_convert_encoding($val[ $ans ],"SJIS-WIN","UTF-8")).",";
			}
			echo "\n";
		}
	}
}

function s2h($seconds) {
	$hours = floor($seconds / 3600);
	$minutes = floor(($seconds / 60) % 60);
	$seconds = $seconds % 60;
	$hms = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
	return $hms;
}
function commaEscape4csv($str)
{
  if(!(strstr($str, ',') === False)){
    $str = preg_replace('/"/', '""',$str);
    $str = '"' . $str . '"';
  }
  return $str;
}


?>