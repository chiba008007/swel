<?PHP
	//行動価値検査2登録
	$no = 0;
	$number = 1;
	$ques = 12;
	$sets = array();
	//---------------------------------------------------
	//行動価値検査2
	//---------------------------------------------------
	include_once("./init/rowData/dev_data_tb.php");
	include_once("./init/rowData/raw_data_tb.php");
	include_once("./lib/keisan/functionBA2.php");

	$wt = array();
	$wt[ 'test_id'       ] = $sec;
	$wt[ 'type'          ] = $third;
	$wt[ 'partner_id'    ] = $ptid;
	$wt[ 'customer_id'   ] = $id;

	$row2 = $db->getWeights($wt);
	while( $line = $db->fgetcsv_reg($fp, 1000)){
		if($no >= 4){
			$name  = mb_convert_encoding($line[2],"utf-8","sjis-win");
			$kana  = mb_convert_encoding($line[3],"utf-8","sjis-win");
			$pass  = mb_convert_encoding($line[7],"utf-8","sjis-win");
			$sex   = mb_convert_encoding($line[6],"utf-8","sjis-win");
			if($sex == "男"){
				$sexKey = 1;
			}elseif($sex == "女"){
				$sexKey = 2;
			}else{
				$sexKey = "";
			}
			$memo1 = mb_convert_encoding($line[8],"utf-8","sjis-win");
			$memo2 = mb_convert_encoding($line[9],"utf-8","sjis-win");
			//--------------------------------
			//データ計算処理
			//---------------------------------
			list($row,$lv,$standard_score,$dev_number) = BA2($line,$row2,$raw_data,$dev_data);

			//exam_idの重複チェック
			//exam_idの重複チェック
			if($line[1]){
				$examid[$number] = $line[1];
			}
			//----------------------------------------------------
			//登録データ作成
			//----------------------------------------------------
			if($line[0]){

				$set[ $number ][ 'number'         ] = $line[0];
				$set[ $number ][ 'partner_id'     ] = $ptid;
				$set[ $number ][ 'customer_id'    ] = $id;
				$set[ $number ][ 'test_id'        ] = $row2[ 'id' ];
				$set[ $number ][ 'testgrp_id'     ] = $sec;
				$set[ $number ][ 'exam_id'        ] = $line[1];
				$set[ $number ][ 'type'           ] = $third;
				$set[ $number ][ 'name'           ] = $name;
				$set[ $number ][ 'kana'           ] = $kana;

				$ex = "";
				$ex = explode("/",$line[4]);
				if($ex[0] && $ex[1] && $ex[2]){
					$set[ $number ][ 'birth'          ] = sprintf("%04d/%02d/%02d",$ex[0],$ex[1],$ex[1]);
				}else{
					$set[ $number ][ 'birth'          ] = "";
				}
				$set[ $number ][ 'sex'            ] = $sexKey;
				$exams = urlencode($line[10]);
				if($exams == "%96%A2%8E%F3%8C%B1"){
					$set[ $number ][ 'exam_state'     ] = 0;
					$set[ $number ][ 'complete_flg'   ] = 0;

					$set[ $number ][ 'level'          ] = "";
					$set[ $number ][ 'score'          ] = "";

				}elseif($exams == "%8E%F3%8C%9F%92%86"){
					$set[ $number ][ 'exam_state'     ] = 1;
					$set[ $number ][ 'complete_flg'   ] = 0;
					
					$set[ $number ][ 'level'          ] = "";
					$set[ $number ][ 'score'          ] = "";
				}else{
					$set[ $number ][ 'exam_state'     ] = 2;
					$set[ $number ][ 'complete_flg'   ] = 1;

					$set[ $number ][ 'level'          ] = $lv;
					$set[ $number ][ 'score'          ] = $standard_score;
					

				}



				$exam = explode("/",$line[10]);
				$set[ $number ][ 'exam_date'      ] = sprintf("%04d/%02d/%02d",$exam[0],$exam[1],$exam[2]);
				$set[ $number ][ 'start_time'     ] = $line[11];
				$set[ $number ][ 'exam_time'      ] = preg_replace("/^'/","",$line[12]);

				
				$set[ $number ]['q1']  = $line[13];
				$set[ $number ]['q2']  = $line[14];
				$set[ $number ]['q3']  = $line[15];
				$set[ $number ]['q4']  = $line[16];
				$set[ $number ]['q5']  = $line[17];
				$set[ $number ]['q6']  = $line[18];
				$set[ $number ]['q7']  = $line[19];
				$set[ $number ]['q8']  = $line[20];
				$set[ $number ]['q9']  = $line[21];
				$set[ $number ]['q10'] = $line[22];
				$set[ $number ]['q11'] = $line[23];
				$set[ $number ]['q12'] = $line[24];
				$set[ $number ]['q13'] = $line[25];
				$set[ $number ]['q14'] = $line[26];
				$set[ $number ]['q15'] = $line[27];
				$set[ $number ]['q16'] = $line[28];
				$set[ $number ]['q17'] = $line[29];
				$set[ $number ]['q18'] = $line[30];
				$set[ $number ]['q19'] = $line[31];
				$set[ $number ]['q20'] = $line[32];
				$set[ $number ]['q21'] = $line[33];
				$set[ $number ]['q22'] = $line[34];
				$set[ $number ]['q23'] = $line[35];
				$set[ $number ]['q24'] = $line[36];
				$set[ $number ]['q25'] = $line[37];
				$set[ $number ]['q26'] = $line[38];
				$set[ $number ]['q27'] = $line[39];
				$set[ $number ]['q28'] = $line[40];
				$set[ $number ]['q29'] = $line[41];
				$set[ $number ]['q30'] = $line[42];
				$set[ $number ]['q31'] = $line[43];
				$set[ $number ]['q32'] = $line[44];
				$set[ $number ]['q33'] = $line[45];
				$set[ $number ]['q34'] = $line[46];
				$set[ $number ]['q35'] = $line[47];
				$set[ $number ]['q36'] = $line[48];
				//回答が無い時は空欄で返す
				if(!is_numeric($line[13])){
					$set[ $number ]['dev1' ] = "";
					$set[ $number ]['dev2' ] = "";
					$set[ $number ]['dev3' ] = "";
					$set[ $number ]['dev4' ] = "";
					$set[ $number ]['dev5' ] = "";
					$set[ $number ]['dev6' ] = "";
					$set[ $number ]['dev7' ] = "";
					$set[ $number ]['dev8' ] = "";
					$set[ $number ]['dev9' ] = "";
					$set[ $number ]['dev10'] = "";
					$set[ $number ]['dev11'] = "";
					$set[ $number ]['dev12'] = "";
					$set[ $number ]['fin_exam_date'] = "";
					$set[ $number ][ 'soyo' ] = "";

				}else{
					$set[ $number ]['dev1'] = $row['dev1'];
					$set[ $number ]['dev2'] = $row['dev2'];
					$set[ $number ]['dev3'] = $row['dev3'];
					$set[ $number ]['dev4'] = $row['dev4'];
					$set[ $number ]['dev5'] = $row['dev5'];
					$set[ $number ]['dev6'] = $row['dev6'];
					$set[ $number ]['dev7'] = $row['dev7'];
					$set[ $number ]['dev8'] = $row['dev8'];
					$set[ $number ]['dev9'] = $row['dev9'];
					$set[ $number ]['dev10'] = $row['dev10'];
					$set[ $number ]['dev11'] = $row['dev11'];
					$set[ $number ]['dev12'] = $row['dev12'];
					$ex = explode("/",$line[10]);
					$set[ $number ]['fin_exam_date'] = $ex[0]."-".$ex[1]."-".$ex[2];
					$set[ $number ][ 'soyo' ] = $dev_number;

				}
				//----------------------------------------------------
				//登録データ作成終わり
				//----------------------------------------------------
			}//line[0]の終わり
			$number++;
		}//if $no>4終わり
		$no++;
	}//while終わり

	//----------------------------------------
	//exam_idの重複チェック
	//----------------------------------------
	$check = @array_count_values($examid);
	$err = "";
	if(count($check)){
		foreach($check as $key=>$val){
			if($val > 1){
				$err += 1;
			}
		}
	}
	if($err){
		$alert = "検査IDが重複しています。";
	}else{
		//データ登録
		$obj->setTestBa($set);
		header("Location:/index/rFlgReg/".$sec."/".$third."/TRUE");
		exit();
	}

?>