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
	echo ",フィードバック研修で聞いた内容を明確に覚えている";
	echo ",フィードバック研修で決めたアクションプランを明確に覚えている";
	echo ",フィードバック研修で決めた個人に対するアクションプランを十分に実行している";
	echo ",フィードバック研修で決めたチームに対するアクションプランを十分に実行している";
	echo ",アクションプランを十分には実行できていない方に伺います。その原因は何だと思いますか。実行できている方は「実行できている」とお書きください。";
	echo ",Aさん対するネガティブなフィードバック（悪いところの指摘：「ダメ出し」）の仕方について、あなたの意識や行動を変えた";
	echo ",Ｂさんさんに対するネガティブなフィードバック（悪いところの指摘：「ダメ出し」）の仕方について、あなたの意識や行動を変えた";
	echo ",チーム全体に対するネガティブなフィードバック（悪いところの指摘：「ダメ出し」）の仕方について、あなたの意識や行動を変えた";
	echo ",Aさんの意識や行動が変わった";
	echo ",Ｂさんの意識や行動が変わった";
	echo ",チーム全体の意識や行動が変わった";
	echo ",この２週間のあなたやメンバー、チーム全体の変化について、具体的にお書きください。特にない場合は、「特になし」とお書きください。";



	echo "\n";
	if(count($tlist[ 'ans' ])){
		foreach($tlist[ 'ans' ] as $key=>$val){
			echo "".mb_convert_encoding($val[ 'start_date' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'empnum' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'sei' ].$val[ 'mei' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'sei_kana' ].$val[ 'mei_kana' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'mail' ],"SJIS-WIN","UTF-8").",";
			for($i=1;$i<=12;$i++){
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
	
	echo ",あなたの職種をお知らせください。";
	echo ",あなたの職種をお知らせください。(その他の時)";

	//上司用
	echo ",あなたのチームのメンバー（あなたが仕事の指示をしたり、仕事に対する評価責任を持つ人）は何人いますか。あなたを除いた数を半角整数値でお答えください。";
	echo ",あなたが今のチームのリーダーになってからどれくらい経ちますか。「〇年〇か月」という形式で、半角整数値でお答えください。";
	echo ",チームの中で、あなたが最も「一緒に働きたい」と思うメンバーをひとり選択してください。";
	echo ",チームの中で、あなたが最も「一緒に働きたくない」と思うメンバーをひとり選択してください。";
	echo ",（部下A）は、男性ですか、女性ですか。";
	echo ",（部下A）は、何歳ですか。";
	echo ",（部下B）は、男性ですか、女性ですか。";
	echo ",（部下B）は、何歳ですか。";
	
	//部下用
	echo ",あなたのチームのリーダー（（上司・リーダー））について伺います。";
	echo ",（上司・リーダー）は、男性ですか、女性ですか。";
	echo ",現在のチームで働き始めてからどれくらい経ちますか。";
	echo ",あなたのチームのメンバーは、何人いますか。（上司・リーダー）を除いた数を半角整数値でお答えください。";
	
	for($i=10;$i<=143;$i++){
		echo ",回答".$i;
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
			echo mb_convert_encoding($val[ 'ans1' ],"SJIS-WIN","UTF-8").",";
			echo mb_convert_encoding($val[ 'ans1_text' ],"SJIS-WIN","UTF-8").",";
			
			//上司の時
			if($val[ 'boss' ] == 1){
				echo mb_convert_encoding($val[ 'ans2' ],"SJIS-WIN","UTF-8").",";
				echo mb_convert_encoding($val[ 'ans3' ],"SJIS-WIN","UTF-8").",";
				echo $obj->emp[$val[ 'ans4' ]].",";
				echo $obj->emp[$val[ 'ans5' ]].",";
				echo mb_convert_encoding($val[ 'ans6' ],"SJIS-WIN","UTF-8").",";
				echo mb_convert_encoding($val[ 'ans7' ],"SJIS-WIN","UTF-8").",";
				echo mb_convert_encoding($val[ 'ans8' ],"SJIS-WIN","UTF-8").",";
				echo mb_convert_encoding($val[ 'ans9' ],"SJIS-WIN","UTF-8").",";
				echo ",";
				echo ",";
				echo ",";
				echo ",";
			}else{
				echo ",";
				echo ",";
				echo ",";
				echo ",";
				echo ",";
				echo ",";
				echo ",";
				echo ",";
				echo mb_convert_encoding($val[ 'ans2' ],"SJIS-WIN","UTF-8").",";
				echo mb_convert_encoding($val[ 'ans3' ],"SJIS-WIN","UTF-8").",";
				echo mb_convert_encoding($val[ 'ans4' ],"SJIS-WIN","UTF-8").",";
				echo mb_convert_encoding($val[ 'ans5' ],"SJIS-WIN","UTF-8").",";
			}
			
			for($i=10;$i<=143;$i++){
				echo mb_convert_encoding($val[ 'ans'.$i ],"SJIS-WIN","UTF-8").",";
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