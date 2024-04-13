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
		echo "社名,";
		echo "業種,";
		echo "売上(年商),";
		echo "従業員数,";
		echo "部署名,";
		echo "職位,";
		echo "本診断をどこで知りましたか。もっとも最近のものを選んでください。,";
		echo "その他,";
		echo "あなたが今一番お困りのことはなんですか。,";
		echo "その他,";


		for($i=1;$i<=50;$i++){
			$kaito = "回答".$i;
			echo $kaito.",";
		}

		echo "\n";
		foreach($tlist['ans'] as $key=>$val){
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
					echo mb_convert_encoding($val[ 'exam_date'  ],'sjis','UTF-8')." ,";
				}elseif($val[ 'exam_state' ] == 1){
					echo "受検中,";
				}else{
					echo "未受検,";
				}
				
				echo mb_convert_encoding($val[ 'start_time' ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'exam_time'  ],'sjis','UTF-8')." ,";
				
				echo mb_convert_encoding($val[ 'company_name'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'bussiness_category'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'sales'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'employee'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'busyo'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'position'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'ques1'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'q1txt'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'ques2'  ],'sjis','UTF-8')." ,";
				echo mb_convert_encoding($val[ 'q2txt'  ],'sjis','UTF-8')." ,";
				
				for($i=1;$i<=50;$i++){
					$ans = "ans".$i;
					echo mb_convert_encoding($val[$ans],'Shift-JIS','UTF-8').",";
				}

				echo "\n";
			}
		}

?>