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
		

		for($i=1;$i<=6;$i++){
			switch($i){
				case "3":
				case "4":
				case "5":
				case "6":
					for($j=1;$j<=7;$j++){
						echo 'セクションA'.$i.'_'.$j.",";
					}
				break;
				default:
					echo 'セクションA'.$i.",";
				break;
			}
		}

		for($i=1;$i<=10;$i++){
			for($j=1;$j<=3;$j++){
				echo 'セクションB'.$i.'_'.$j.",";
			}
		}

		for($i=1;$i<=22;$i++){
			echo 'セクションC'.$i.",";

		}
		for($i=1;$i<=8;$i++){
			switch($i){
				case "6":
				case "7":
				case "8":
					for($j=1;$j<=5;$j++){
						echo 'セクションD'.$i.'_'.$j.",";
					}
					
				break;
				default:
					for($j=1;$j<=4;$j++){
						echo 'セクションD'.$i.'_'.$j.",";
					}
				break;
			}
		}
		for($i=1;$i<=12;$i++){
			for($j=1;$j<=6;$j++){
				echo 'セクションE'.$i.'_'.$j.",";
			}
		}
		for($i=1;$i<=5;$i++){
			for($j=1;$j<=3;$j++){
				echo 'セクションF'.$i.'_'.$j.",";
			}
		}
		for($i=1;$i<=19;$i++){
			echo 'セクションG'.$i.",";

		}
		for($i=1;$i<=8;$i++){
			switch($i){
				case "1":
				case "2":
				case "3":
				case "4":
					for($j=1;$j<=3;$j++){
						echo 'セクションH'.$i.'_'.$j.",";
					}
				break;
				case "5":
				case "6":
				case "7":
					for($j=1;$j<=5;$j++){
						echo 'セクションH'.$i.'_'.$j.",";
					}
				break;
				default:
					echo 'セクションH'.$i.",";
				break;
			}
		}
		echo "\n";
		if(count($tlist[ 'ans' ])){
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
					
				//	if($val[ 'exam_date' ] && $val[ 'exam_state' ] == 2){
						echo mb_convert_encoding($val[ 'start_time' ],'sjis','UTF-8')." ,";
				//	}else{
				//		",";
				//	}
					
					echo mb_convert_encoding($val[ 'exam_time'  ],'sjis','UTF-8')." ,";
					
					echo mb_convert_encoding($val[ 'sec1'    ],'Shift-JIS','UTF-8').",";
					echo mb_convert_encoding($val[ 'sec2'    ],'Shift-JIS','UTF-8').",";
					for($i=3;$i<=6;$i++){
						$Akey = "sec".$i;
						$ex = explode(":",$val[ $Akey ]);
						foreach($ex as $k=>$v){
							echo mb_convert_encoding($v,'Shift-JIS','UTF-8').",";
						}
					}

					for($i=1;$i<=10;$i++){
						$Bkey = "secB".$i;
						$ex = explode(":",$val[ $Bkey ]);
						foreach($ex as $k=>$v){
							echo mb_convert_encoding($v,'Shift-JIS','UTF-8').",";
						}
					}
					for($i=1;$i<=22;$i++){
						$Ckey = "secC".$i;
						echo mb_convert_encoding($val[ $Ckey ],'Shift-JIS','UTF-8').",";
					}

					for($i=1;$i<=8;$i++){
						$Dkey = "secD".$i;
						$ex = explode(":",$val[ $Dkey ]);
						foreach($ex as $k=>$v){
							echo mb_convert_encoding($v,'Shift-JIS','UTF-8').",";
						}
					}

					for($i=1;$i<=12;$i++){
						$Ekey = "secE".$i;
						$ex = explode(":",$val[ $Ekey ]);
						foreach($ex as $k=>$v){
							echo mb_convert_encoding($v,'Shift-JIS','UTF-8').",";
						}
					}

					for($i=1;$i<=5;$i++){
						$Fkey = "secF".$i;
						$ex = explode(":",$val[ $Fkey ]);
						foreach($ex as $k=>$v){
							echo mb_convert_encoding($v,'Shift-JIS','UTF-8').",";
						}
					}

					for($i=1;$i<=19;$i++){
						$Gkey = "secG".$i;
						echo mb_convert_encoding($val[ $Gkey ],'Shift-JIS','UTF-8').",";
					}

					for($i=1;$i<=8;$i++){
						$Hkey = "secH".$i;
						$ex = explode(":",$val[ $Hkey ]);
						foreach($ex as $k=>$v){
							echo mb_convert_encoding($v,'Shift-JIS','UTF-8').",";
						}
					}

					echo "\n";
				}
			}
		}
?>