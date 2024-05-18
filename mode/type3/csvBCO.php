<?PHP
		echo "検査名,".$tlist[ 'testname' ]."\n";
		echo "パートナー企業,".$tlist[ 'ptname' ]."\n";
		echo "顧客企業,".$tlist[ 'cname' ]."\n";
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


		$max1 = 55;
		for($i=1;$i<=$max1;$i++){
			echo "問".$i.",";
		}
		$max2 = 89;
		for($i=1;$i<=$max2;$i++){
			echo "回答".$i.",";
		}



		echo "\n";
		foreach($tlist['ans'] as $key=>$val){
			if(is_numeric($val[ 'number' ])){
				echo $val[ 'number' ].",";
				echo $val[ 'exam_id' ].",";
				echo $val[ 'name' ].",";
				echo $val[ 'kana' ].",";
				echo $val[ 'birth' ].",";
				echo $val[ 'age' ].",";
				echo $a_gender[$val[ 'sex' ]].",";
				echo $val[ 'pass' ].",";
				$memo1 = preg_replace("/\n|\r/","",$val[ 'memo1' ]);
				echo $memo1.",";
				$memo2 = preg_replace("/\n|\r/","",$val[ 'memo2' ]);
				echo $memo2.",";
				if($val[ 'exam_state' ] == 2){
					echo $val[ 'exam_date'  ]." ,";
				}elseif($val[ 'exam_state' ] == 1){
					echo "受検中,";
				}else{
					echo "未受検,";
				}
				
				echo $val[ 'start_time' ]." ,";
				
				echo $val[ 'exam_time'  ]." ,";
				
				for($i=1;$i<=$max1;$i++){
					$ans = "ans".$i;
					echo $val[ $ans ].",";
				}
				
				for($i=1;$i<=$max2;$i++){
					$select = "select".$i;
					echo $val[ $select ].",";
				}


				echo "\n";
			}
		}

?>