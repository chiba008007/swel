<?PHP
	require_once("./init/tensaku.php");
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
	echo "メールアドレス,";
	echo "添削者名,";
	echo "添削者メールアドレス,";
	echo "質問,";
	for($i=1;$i<=4;$i++){
		echo "回答".$i.",";
		echo "記入にあたり悩んだ点".$i.",";
		echo "相談".$i.",";
		echo "添削".$i.",";
		echo "アドバイス".$i.",";
		echo "内容ポイント".$i.",";
		echo "ロジック容ポイント".$i.",";
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
			echo mb_convert_encoding($val[ 'start_time'    ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'exam_time'     ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'mail'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'tensaku_name'  ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'tensaku_mail'  ],'sjis','UTF-8')." ,";
			$str = $array_tensaku_question[$val['tensaku_main_id']][$val['tensaku_id']];
			echo mb_convert_encoding($str,'sjis','UTF-8')." ,";
			//回答1-4
			echo mb_convert_encoding("'".$val[ 'question_text'       ]."'",'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'worry_text'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'advice_text'         ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'answer_text'         ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'answer_advice_text'  ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'note_point'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'logic_point'         ],'sjis','UTF-8')." ,";


			echo mb_convert_encoding($val[ 'question_text2'        ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'worry_text2'           ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'advice_text2'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'answer_text_2'         ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'answer_advice_text_2'  ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'note_point_2'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'logic_point_2'         ],'sjis','UTF-8')." ,";

			echo mb_convert_encoding($val[ 'question_text3'        ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'worry_text3'           ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'advice_text3'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'answer_text_3'         ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'answer_advice_text_3'  ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'note_point_3'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'logic_point_3'         ],'sjis','UTF-8')." ,";

			echo mb_convert_encoding($val[ 'question_text4'        ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'worry_text4'           ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'advice_text4'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'answer_text_4'         ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'answer_advice_text_4'  ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'note_point_4'          ],'sjis','UTF-8')." ,";
			echo mb_convert_encoding($val[ 'logic_point_4'         ],'sjis','UTF-8')." ,";

			echo "\n";
		}
	}


?>