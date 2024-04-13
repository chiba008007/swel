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
	echo ",研修で聞いた内容を明確に覚えている";
	echo ",研修で決めた目標を明確に覚えている";
	echo ",研修で決めた目標が適切だったと思っている";
	echo ",研修で決めた目標を十分に達成している";
	echo ",この１週間、Aさんに対するフィードバックの仕方について、意識をした";
	echo ",この１週間、Aさんに対するフィードバックの仕方について、行動を変えた";
	echo ",(１以外の人）この１週間で、Aさんの意識や行動が変わった";
	echo ",この１週間、Bさんに対するフィードバックの仕方を意識した";
	echo ",この１週間、Bさんに対するフィードバックの仕方を実際に変えた";
	echo ",（１以外の人）この１週間で、Bさんの意識や行動が変わった";
	echo ",Aさんに対するフィードバックの仕方について、この１週間で意識したことや変えたことを具体的にお書きください";
	echo ",Aさんに対するフィードバックの仕方について、この１週間で変えたことを具体的にお書きください";
	echo ",Bさんに対するフィードバックの仕方について、この１週間で意識したことを具体的にお書きください";
	echo ",Bさんに対するフィードバックの仕方について、この１週間で変えたことを具体的にお書きください";
	echo ",この１週間で、フィードバックの仕方や、部下の反応に関する新たな気づきはありましたか。あれば具体的にお書きください。";
	echo "\n";
	if(count($tlist[ 'ans' ])){
		foreach($tlist[ 'ans' ] as $key=>$val){
			echo "".mb_convert_encoding($val[ 'start_date' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'empnum' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'sei' ].$val[ 'mei' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'sei_kana' ].$val[ 'mei_kana' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'mail' ],"SJIS-WIN","UTF-8").",";
			for($i=1;$i<=6;$i++){
				$anq = "anq".$i;
				echo mb_convert_encoding($val[$anq],"SJIS-WIN","UTF-8").",";
			}
			$anq = "anq61";
			echo mb_convert_encoding($val[$anq],"SJIS-WIN","UTF-8").",";
			for($i=7;$i<=8;$i++){
				$anq = "anq".$i;
				echo mb_convert_encoding($val[$anq],"SJIS-WIN","UTF-8").",";
			}
			$anq = "anq81";
			echo mb_convert_encoding($val[$anq],"SJIS-WIN","UTF-8").",";

			for($i=9;$i<=13;$i++){
				$anq = "anq".$i;
				echo mb_convert_encoding(ereg_replace("\,|\r|\n","",commaEscape4csv($val[$anq])),"SJIS-WIN","UTF-8").",";
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
	
	echo ",もっとも一緒に仕事をしたいと思う部下を下記から選んでください。";
	echo ",もっとも一緒に仕事をしたくない部下を下記から選んでください。";
	echo ",あなたはどのような立場ですか。";
	echo ",あなたはどのような立場ですか。(その他を選んだ時のテキスト)";
	echo ",もっとも一緒に仕事をしたいと思う部下と週何日くらい直接会って話をしますか。※プライベートか仕事上かは問いません。";
	echo ",もっとも一緒に仕事をしたくない部下と週何日くらい直接会って話をしますか。※プライベートか仕事上かは問いません。";
	echo ",あなたは、週何日くらい上司と直接会って話しますか。※プライベートか仕事上かは問いません。";
	$no = 1;
	for($i=5;$i<=313;$i++){
		echo ",回答".$no;
		$no++;
	}
	echo "\n";

	if(count($tlist[ 'ans' ])){

		foreach($tlist[ 'ans' ] as $key=>$val){
			echo "=\"".mb_convert_encoding($val[ 'empnum' ],"SJIS-WIN","UTF-8")."\",";
			echo mb_convert_encoding($val[ 'sei' ].$val[ 'mei' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'sei_kana' ].$val[ 'mei_kana' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'birth' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'age' ],"SJIS-WIN","UTF-8").",";
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
			echo $times.",";
			echo $val[ 'boss' ].",";
			echo $obj->emp[$val[ 'rep'  ]].",";
			echo $obj->emp[$val[ 'ans1' ]].",";
			echo $obj->emp[$val[ 'ans2' ]].",";
			if($val[ 'boss' ] == 1){
				echo $array_pos[$val[ 'ans3' ]].",";
			}else{
				echo ",";
			}
			echo mb_convert_encoding($val[ 'ans3_other' ],"SJIS-WIN","UTF-8").",";
			if($val[ 'boss' ] == 1){
				//上司のとき
				echo $val[ 'ans4' ].",";
				echo $val[ 'ans4_1' ].",";
				echo ",";
			}else{
				//部下のとき
				echo ",";
				echo ",";
				echo $val[ 'ans4' ].",";

			}
			for($i=5;$i<=313;$i++){
				$ans = "ans".$i;
				echo $val[$ans].",";
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