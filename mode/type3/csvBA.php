<?PHP
		echo "検査名,".mb_convert_encoding($tlist[ 'testname' ],"SJIS","UTF-8")."\n";
		echo "パートナー企業,".mb_convert_encoding($tlist[ 'ptname' ],"SJIS","UTF-8")."\n";
		echo "顧客企業,".mb_convert_encoding($tlist[ 'cname' ],"SJIS","UTF-8")."\n";
		echo "番号,";
		echo "受検者ID,";
		echo "受検者名,";
		echo "受検者名かな,";
		echo "生年月日,";
		echo "年齢,";
		echo "性別,";
		echo "合否,";
		echo "メモ１,";
		echo "メモ２,";
		echo "受検日,";
		echo "受検開始時間,";
		echo "受検時間,";
		for($i=1;$i<=36;$i++){
			echo "回答".$i.",";
		}
		echo "ストレス共生レベル,";
		echo "ストレス共生スコア,";
		echo "適合度レベル,";
		echo "適合度スコア,";

		foreach($a_element as $key=>$val){
			echo mb_convert_encoding($val,"SJIS",'UTF-8').",";
		}
		echo "最大偏差値の要素名";
		echo "\n";
		
		//最大偏差値の要素名
		$i=0;

		foreach($tlist[ 'ans' ] as $key=>$val){
			if(is_numeric($val[ 'number' ])){
				for($j=1;$j<=12;$j++){
					$dev = "dev".$j;
					$amax[$val[ 'number' ]][$j]  = $val[ $dev ];
					$keys[$val[$dev]] = $j;
				}
			$i++;
			}
		}
		
		if(count($amax)){
			foreach($amax as $key=>$val){
				if($val[1]){
					$max = max($val);
					$maxKey[$key] = mb_convert_encoding($a_element["w".$keys[$max]],"SJIS","UTF-8");
				}else{
					$maxKey[$key] = "";
				}
			}
		}

		foreach($tlist[ 'ans' ] as $key=>$val){
			if(is_numeric($val[ 'number' ])){
				echo $val[ 'number' ].",";
				echo $val[ 'exam_id' ].",";
				echo mb_convert_encoding($val[ 'name' ],'sjis-win','UTF-8').",";
				echo mb_convert_encoding($val[ 'kana' ],'sjis-win','UTF-8').",";
				echo mb_convert_encoding($val[ 'birth' ],'sjis','UTF-8').",";
				echo mb_convert_encoding($val[ 'age' ],'sjis','UTF-8').",";
				echo mb_convert_encoding($a_gender[$val[ 'sex' ]],'sjis','UTF-8').",";
				echo mb_convert_encoding($val[ 'pass' ],'sjis','UTF-8').",";
				$memo1 = preg_replace("/\n|\r/","",$val[ 'memo1' ]);
				echo mb_convert_encoding($memo1,'sjis','UTF-8').",";
				$memo2 = preg_replace("/\n|\r/","",$val[ 'memo2' ]);
				echo mb_convert_encoding($memo2,'sjis','UTF-8').",";
				if($val[ 'exam_state' ] == 2){
					echo mb_convert_encoding($val[ 'exam_date'  ],'sjis','UTF-8').",";
				}elseif($val[ 'exam_state' ] == 1){
					echo "受検中,";
				}else{
					echo "未受検,";
				}
				
				if($val[ 'exam_date' ] && $val[ 'exam_state' ] == 2){
					echo mb_convert_encoding($val[ 'start_time' ],'sjis','UTF-8').",";
				}else{
					echo " ,";
				}
				if($val[ 'exam_time' ] && $val[ 'exam_state' ] == 2){
					echo mb_convert_encoding($val[ 'exam_time'  ],'sjis','UTF-8').",";
				}else{
					echo " ,";
				}
				for($k=1;$k<=36;$k++){
					$q = "q".$k;
					if($val[$q]){
						echo $val[ $q  ].",";
					}else{
						echo " ,";
					}
				}
				$lv = "";
				$sc = "";
				if($val[ 'dev1' ] && $val[ 'dev2' ] && $val[ 'dev3' ]){
					if($val[ 'stress_flg' ] == 1){
						list($lv,$sc) = $db->getStress2($val[ 'dev1' ],$val[ 'dev2' ],$val[ 'dev3' ]);
					}else{
						list($lv,$sc) = $db->getStress($val[ 'dev1' ],$val[ 'dev2' ]);
					}
				}

				echo $lv.",";
				echo $sc.",";
				if($val[ 'level' ]){
					echo $val[ 'level' ].",";
				}else{
					echo ",";
				}
				if($val[ 'level' ]){
					echo $val[ 'score' ].",";
				}else{
					echo ",";
				}

				for($i=1;$i<=12;$i++){
					$dev = "dev".$i;
					if($val[ $dev ]){
						echo $val[$dev].",";
					}else{
						echo ",";
					}
				}
				echo $maxKey[$val[ 'number' ]].",";
				echo "\n";
			}
		}

?>