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
		echo ",回答1";
		echo ",回答2";
		echo ",回答3";
		echo ",回答4";
		echo ",回答4(その他)";
		echo ",回答5";
		echo ",回答6";
		echo ",回答7-1";
		echo ",回答7-2";
		echo ",回答8";
		echo ",回答9-1";
		echo ",回答9-2";
		echo ",回答9-3";
		echo ",回答9-4";
		echo ",回答10-1";
		echo ",回答10-2";
		echo ",回答10-3";
		echo ",回答10-4";
		echo ",回答11-1";
		echo ",回答11-2";
		echo ",回答11-3";
		echo ",回答11-4";
		echo ",回答12-1";
		echo ",回答13-1";
		echo ",回答13-2";
		echo ",回答13-3";
		echo ",回答13-4";
		echo ",回答13-5";
		echo ",回答14-1";
		echo ",回答14-2";
		echo ",回答14-3";
		echo ",回答14-4";
		echo ",回答14-5";
		echo ",回答15-1";
		echo ",回答15-2";
		echo ",回答15-3";
		echo ",回答15-4";
		echo ",回答15-5";
		echo ",回答15-6";
		echo ",回答15-7";
		echo ",回答15-8";
		echo ",回答15-9";
		echo ",回答16-1";
		echo ",回答16-2";
		echo ",回答16-3";
		echo ",回答16-4";
		echo ",回答16-5";
		echo ",回答16-6";
		echo ",回答16-7";
		echo ",回答17-1";
		echo ",回答17-2";
		echo ",回答17-3";
		echo ",回答17-4";
		echo ",回答17-5";
		echo ",回答17-6";
		echo ",回答17-7";
		echo ",回答17-8";
		echo ",回答17-9";
		echo ",回答17-10";
		echo ",回答17-11";
		echo ",回答17-12";
		echo ",回答17-13";
		echo ",回答17-14";
		echo ",回答17-15";
		echo ",回答18-1";
		echo ",回答18-2";
		echo ",回答18-3";
		echo ",回答18-4";
		echo ",回答18-5";
		echo ",回答18-6";
		echo ",回答18-7";
		echo ",回答18-8";
		echo ",回答19-1";
		echo ",回答19-2";
		echo ",回答19-3";
		echo ",回答19-4";
		echo ",回答20-1";
		echo ",回答20-2";
		echo ",回答20-3";
		echo ",回答20-4";
		echo ",回答20-5";
		echo ",回答20-6";
		echo ",回答20-7";
		echo ",回答20-8";
		echo ",回答20-9";
		echo ",回答21-1";
		echo ",回答21-2";
		echo ",回答21-3";
		echo ",回答21-4";
		echo ",回答21-5";
		echo ",回答21-6";
		echo ",回答21-7";
		echo ",回答22-1";
		echo ",回答22-2";
		echo ",回答22-3";
		echo ",回答22-4";
		echo ",回答23-1";
		echo ",回答23-2";
		echo ",回答23-3";
		echo ",回答23-4";
		echo ",回答23-5";
		echo ",回答24-1";
		echo ",回答24-2";
		echo ",回答24-3";
		echo ",回答24-4";
		echo ",回答24-5";
		echo ",回答24-6";
		echo ",回答24-7";
		echo ",回答24-8";
		echo ",回答24-9";
		echo ",回答25";
		echo ",回答26";
		echo ",回答27";
	}else{
        echo ",回答1";
        echo ",回答2";
        echo ",回答3";
        echo ",回答4";
        echo ",回答4(その他)";
        echo ",回答5";
        echo ",回答6";
        echo ",回答7-1";
        echo ",回答7-2";
        echo ",回答8";
        echo ",回答9-1";
        echo ",回答9-2";
        echo ",回答9-3";
        echo ",回答9-4";
        echo ",回答10-1";
        echo ",回答10-2";
        echo ",回答10-3";
        echo ",回答10-4";
        echo ",回答11";
        echo ",回答12-1";
        echo ",回答12-2";
        echo ",回答12-3";
        echo ",回答12-4";
        echo ",回答12-5";
        echo ",回答13-1";
        echo ",回答13-2";
        echo ",回答13-3";
        echo ",回答13-4";
        echo ",回答13-5";
        echo ",回答14-1";
        echo ",回答14-2";
        echo ",回答14-3";
        echo ",回答14-4";
        echo ",回答14-5";
        echo ",回答14-6";
        echo ",回答14-7";
        echo ",回答14-8";
        echo ",回答14-9";
        echo ",回答15-1";
        echo ",回答15-2";
        echo ",回答15-3";
        echo ",回答15-4";
        echo ",回答15-5";
        echo ",回答15-6";
        echo ",回答15-7";
        echo ",回答16-1";
        echo ",回答16-2";
        echo ",回答16-3";
        echo ",回答16-4";
        echo ",回答16-5";
        echo ",回答16-6";
        echo ",回答16-7";
        echo ",回答16-8";
        echo ",回答16-9";
        echo ",回答16-10";
        echo ",回答16-11";
        echo ",回答16-12";
        echo ",回答16-13";
        echo ",回答16-14";
        echo ",回答16-15";
        echo ",回答17-1";
        echo ",回答17-2";
        echo ",回答17-3";
        echo ",回答17-4";
        echo ",回答17-5";
        echo ",回答17-6";
        echo ",回答17-7";
        echo ",回答17-8";
        echo ",回答18-1";
        echo ",回答18-2";
        echo ",回答18-3";
        echo ",回答18-4";
        echo ",回答19-1";
        echo ",回答19-2";
        echo ",回答19-3";
        echo ",回答19-4";
        echo ",回答19-5";
        echo ",回答19-6";
        echo ",回答19-7";
        echo ",回答19-8";
        echo ",回答20";
        echo ",回答21";
        echo ",回答22";
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