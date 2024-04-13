<?PHP
		ini_set('display_errors', "On");
		echo mb_convert_encoding("検査名","SJIS","UTF-8");
		echo mb_convert_encoding($tlist[ 'testname' ],"SJIS","UTF-8")."\n";
		echo mb_convert_encoding("パートナー企業,","SJIS","UTF-8").mb_convert_encoding($tlist[ 'ptname' ],"SJIS","UTF-8")."\n";
		echo mb_convert_encoding("顧客企業,","SJIS","UTF-8").mb_convert_encoding($tlist[ 'cname' ],"SJIS","UTF-8")."\n";
		echo mb_convert_encoding("番号,","SJIS","UTF-8");
		echo mb_convert_encoding("受検者ID,","SJIS","UTF-8");
		echo mb_convert_encoding("受検者名,","SJIS","UTF-8");
		echo mb_convert_encoding("受検者名かな,","SJIS","UTF-8");
		echo mb_convert_encoding("生年月日,","SJIS","UTF-8");
		echo mb_convert_encoding("年齢,","SJIS","UTF-8");
		echo mb_convert_encoding("性別,","SJIS","UTF-8");
		echo mb_convert_encoding("合否,","SJIS","UTF-8");
		echo mb_convert_encoding("メモ１,","SJIS","UTF-8");
		echo mb_convert_encoding("メモ２,","SJIS","UTF-8");
		echo mb_convert_encoding("受検日,","SJIS","UTF-8");
		echo mb_convert_encoding("受検開始時間,","SJIS","UTF-8");
		echo mb_convert_encoding("受検時間,","SJIS","UTF-8");
		for($i=1;$i<=20;$i++){
			echo mb_convert_encoding("回答".$i.",","SJIS","UTF-8");
		}
		echo mb_convert_encoding("自己実現,","SJIS","UTF-8");
		echo mb_convert_encoding("家族との時間,","SJIS","UTF-8");
		echo mb_convert_encoding("自由と柔軟性,","SJIS","UTF-8");
		echo mb_convert_encoding("経済的安定,","SJIS","UTF-8");
		echo mb_convert_encoding("多様な経験とスキルの獲得,","SJIS","UTF-8");

		echo "\n";

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
					echo mb_convert_encoding("受検中,",'sjis','UTF-8');
				}else{
					echo mb_convert_encoding("未受検,",'sjis','UTF-8');
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
				for($k=1;$k<=20;$k++){
					$q = "q".$k;
					if($val[$q]){
						echo $val[ $q  ].",";
					}else{
						echo " ,";
					}
				}
				echo $val[ 'dev1' ].",";
				echo $val[ 'dev2' ].",";
				echo $val[ 'dev3' ].",";
				echo $val[ 'dev4' ].",";
				echo $val[ 'dev5' ].",";
			}

			echo "\n";
		}

?>