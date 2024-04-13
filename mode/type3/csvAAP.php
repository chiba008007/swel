<?PHP
	echo "検査名,".mb_convert_encoding($tlist[ 'testname' ],"SJIS","UTF-8")."\n";
	echo "パートナー企業,".mb_convert_encoding($tlist[ 'ptname' ],"SJIS","UTF-8")."\n";
	echo "顧客企業,".mb_convert_encoding($tlist[ 'cname' ],"SJIS","UTF-8")."\n";
	echo "番号,";
	echo "受検者ID,";
	echo "受検者名(男性),";
	echo "受検者名(女性),";
	echo "生年月日,";
	echo "年齢,";
	echo "性別,";
	echo "合否,";
	echo "メモ１,";
	echo "メモ２,";
	echo "ログイン回数,";
	echo "受検日,";
	echo "受検開始時間,";
	echo "受検終了時間,";
	echo "受検時間,";
	for($i=1;$i<=149;$i++){
		echo "設問".$i.",";
	}
	echo "\n";

		foreach($tlist['ans'] as $key=>$val){
			if(is_numeric($val[ 'number' ])){
				echo $val[ 'number' ].",";
				echo $val[ 'exam_id' ].",";
				if($val[ 'gender' ] == 1){
					echo mb_convert_encoding($val[ 'name' ],'sjis-win','UTF-8').",";
				}else{
					echo "-,";
				}
				if($val[ 'gender' ] == 2){
					echo mb_convert_encoding($val[ 'kana' ],'sjis-win','UTF-8').",";
				}else{
					echo "-,";
				}
				echo mb_convert_encoding($val[ 'birthday' ],'sjis','UTF-8').",";
				echo mb_convert_encoding($val[ 'age' ],'sjis','UTF-8').",";
				echo mb_convert_encoding($a_gender[$val[ 'gender' ]],'sjis','UTF-8').",";
				echo mb_convert_encoding($val[ 'pass' ],'sjis','UTF-8').",";
				$memo1 = preg_replace("/\n|\r/","",$val[ 'memo1' ]);
				echo mb_convert_encoding($memo1,'sjis','UTF-8').",";
				$memo2 = preg_replace("/\n|\r/","",$val[ 'memo2' ]);
				echo mb_convert_encoding($memo2,'sjis','UTF-8').",";
				echo $val[ 'counter' ].",";
				if($val[ 'exam_state' ] == 2){
					echo mb_convert_encoding($val[ 'exam_date'  ],'sjis','UTF-8')." ,";
				}elseif($val[ 'exam_state' ] == 1){
					echo "受検中,";
				}else{
					echo "未受検,";
				}
				if($val[ 'times' ] > 0){
					$times = "'".ceil($val[ 'times'  ]/60).":".($val[ 'times' ]%60);
				}else{
					$times = "-";
				}
				echo mb_convert_encoding($val[ 'start_time' ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'quesfin_time' ],'sjis','UTF-8')." ,";
				echo $times." ,";
				
				for($i=1;$i<=148;$i++){
					$ans = "ans".$i;
					echo mb_convert_encoding($val[$ans],'Shift-JIS','UTF-8').",";
				}

				echo "\n";
			}
		}


?>