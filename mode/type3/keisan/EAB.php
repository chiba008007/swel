<?PHP
include_once("./lib/keisan/include_EAB.php");
include_once("./init/rowData/ea_bj_hensa.php");

$eab = new EAB();
//データ登録配列作成
$rs_ans = array(
				'secA1'
				,'secA2a'
				,'secA2b'
				,'secA2c'
				,'secA2d'
				,'secA2e'
				,'secA2f'
				,'secA2g'
				,'secA3a'
				,'secA3b'
				,'secA3c'
				,'secA3d'
				,'secA3e'
				,'secA3f'
				,'secA3g'
				,'secB1a'
				,'secB1b'
				,'secB1c'
				,'secB2a'
				,'secB2b'
				,'secB2c'
				,'secB3a'
				,'secB3b'
				,'secB3c'
				,'secB4a'
				,'secB4b'
				,'secB4c'
				,'secB5a'
				,'secB5b'
				,'secB5c'
				,'secB6a'
				,'secB6b'
				,'secB6c'
				,'secC1'
				,'secC2'
				,'secC3'
				,'secC4'
				,'secC5'
				,'secC6'
				,'secC7'
				,'secC8'
				,'secC9'
				,'secC10'
				,'secC11'
				,'secC12'
				,'secC13'
				,'secC14'
				,'secC15'
				,'secD1_1'
				,'secD1_2'
				,'secD2_1'
				,'secD2_2'
				,'secD3_1'
				,'secD3_2'
				,'secD4_1'
				,'secD4_2'
				,'secD4_3'
				,'secD5_1'
				,'secD5_2'
				,'secD5_3'
				,'secD5_4'
				,'secD6_1'
				,'secD6_2'
				,'secH1A'
				,'secH1B'
				,'secH1C'
				,'secH2A'
				,'secH2B'
				,'secH2C'
				,'secH3A'
				,'secH3B'
				,'secH3C'
				,'secH4A'
				,'secH4B'
				,'secH4C'
				,'secH5A'
				,'secH5B'
				,'secH5C'
				,'secH6A'
				,'secH6B'
				,'secH6C'
				,'secH7A'
				,'secH7B'
				,'secH7C'
				,'secG1a'
				,'secG1b'
				,'secG1c'
				,'secG2a'
				,'secG2b'
				,'secG2c'
				,'secG3a'
				,'secG3b'
				,'secG3c'
				,'secG4a'
				,'secG4b'
				,'secG4c'
				,'secG5a'
				,'secG5b'
				,'secG5c'
				,'secF1'
				,'secF2'
				,'secF3'
				,'secF4'
				,'secF5'
				,'secF6'
				,'secF7'
				,'secF8'
				,'secF9'
				,'secF10'
				,'secF11'
				,'secF12'
				,'secF13'
				,'secF14'
				,'secE1_1'
				,'secE1_2'
				,'secE2_1'
				,'secE2_2'
				,'secE3_1'
				,'secE3_2'
				,'secE4_1'
				,'secE4_2'
				,'secE4_3'
				,'secE5_1'
				,'secE5_2'
				,'secE5_3'
				,'secE6_1'
				,'secE6_2'
				,'secE6_3'
				,'secI1_1'
				,'secI1_2'
				,'secI1_3'
				,'secI1_4'
				,'secI1_5'
				,'secI2_1'
				,'secI2_2'
				,'secI2_3'
				,'secI2_4'
				,'secI2_5'
				,'secI3_1'
				,'secI3_2'
				,'secI3_3'
				,'secI3_4'
				,'secI3_5'
				,'secI4_1'
				,'secI4_2'
				,'secI4_3'
				,'secI4_4'
				,'secI4_5'
				,'secI5_1'
				,'secI5_2'
				,'secI5_3'
			);


$no = 0;
$number = 1;
$ques = 12;
//idの最大値取得
$maxid = $obj->getMaxId("rs_member");
$max = $maxid+1;
//test_idの取得
$wt = array();
$wt[ 'test_id'       ] = $sec;
$wt[ 'type'          ] = $third;
$wt[ 'partner_id'    ] = $ptid;
$wt[ 'customer_id'   ] = $id;
$tid = $obj->getTestId($wt);

while( $line = $db->fgetcsv_reg($fp, 1000)){
	if($no > 4){
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
			
		$sets[ $number ][ 'number'         ] = $line[0];
		$sets[ $number ][ 'partner_id'     ] = $ptid;
		$sets[ $number ][ 'customer_id'    ] = $id;
		$sets[ $number ][ 'test_id'        ] = $tid[ 'id' ];
		$sets[ $number ][ 'testgrp_id'     ] = $sec;
		$sets[ $number ][ 'exam_id'        ] = $line[1];
		$sets[ $number ][ 'type'           ] = $third;
		$sets[ $number ][ 'name'           ] = $name;
		$sets[ $number ][ 'kana'           ] = $kana;
		$ex = "";
		$ex = explode("/",$line[4]);
		if($ex[0] && $ex[1] && $ex[2]){
			$set[ $number ][ 'birth'          ] = sprintf("%04d/%02d/%02d",$ex[0],$ex[1],$ex[1]);
		}else{
			$set[ $number ][ 'birth'          ] = "";
		}

		$sets[ $number ][ 'sex'            ] = $sexKey;
		$exams = urlencode($line[10]);
		if($exams == "%96%A2%8E%F3%8C%B1"){
			$set[ $number ][ 'exam_state'     ] = 0;
			$set[ $number ][ 'complete_flg'   ] = 0;

		}elseif($exams == "%8E%F3%8C%9F%92%86"){
			$set[ $number ][ 'exam_state'     ] = 1;
			$set[ $number ][ 'complete_flg'   ] = 0;
			
		}else{
			$set[ $number ][ 'exam_state'     ] = 2;
			$set[ $number ][ 'complete_flg'   ] = 1;
		}

		$exam = explode("/",$line[10]);
		$sets[ $number ][ 'exam_date'      ] = sprintf("%04d/%02d/%02d",$exam[0],$exam[1],$exam[2]);
		$sets[ $number ][ 'start_time'     ] = $line[11];
		$sets[ $number ][ 'exam_time'      ] = preg_replace("/^'/","",$line[12]);
	
	
		$mvdata[$number]['id'         ] = $max;
		$mvdata[$number]['testid'     ] = $tid[ 'id' ];
		$mvdata[$number]['tgrpid'     ] = $sec;
		$mvdata[$number]['exid'       ] = $line[1];
		$st = sprintf("%04d-%02d-%02d",$exam[0],$exam[1],$exam[2]);
		$mvdata[$number]['start_time'  ] = $st." ".$line[11];
		$rowd = 13;
		$ans = array();
		$set = array();
		for($i=0;$i<151;$i++){
			$set[ $rs_ans[$i] ] = $line[$rowd];
			$mvdata[$number][ 'answer' ][ $rs_ans[$i] ] = $line[ $rowd ];
			$rowd++;
		}

		

		$nums = 1;
		$infoP = 0;
		$infoM = 0;
		foreach($set as $k=>$v){
			if(preg_match("/^sec/",$k)){
				$score[ $nums ] = $array_calc[ $nums ][$v];
				if($nums == 71){
					$infoP = $v;
				}
				if($nums == 64
					|| $nums == 65
					|| $nums == 66
					|| $nums == 68
					|| $nums == 69
					|| $nums == 70
					|| $nums == 72
					|| $nums == 73
					|| $nums == 76
					|| $nums == 77
					|| $nums == 79
					|| $nums == 80
					|| $nums == 82
					|| $nums == 83
					|| $nums == 84
				){
					$infoM += $v;
				}


				$nums++;
			}
			
		}
		$sum = array_sum($score);
		$read = 0;
		$change = 0;
		$understand = 0;
		$select = 0;

		foreach($score as $k=>$v){
			//読み取り力
			if($k >=1 && $k <=15 ){
				$read += $v;
			}
			if($k >=64 && $k <=84 ){
				$read += $v;
			}

			//切り替え
			if($k >=16 && $k <=33 ){
				$change += $v;
			}
			if($k >=85 && $k <=99 ){
				$change += $v;
			}
			//理解
			if($k >= 34 && $k <= 48 ){
				$understand += $v;
			}
			if( $k >= 100 && $k <= 113 ){
				$understand += $v;
			}
			//選択力
			if($k >=49 && $k <= 63){
				$select += $v;
			}
			if($k >= 114 && $k<=128 ){
				$select += $v;
			}

		}
		$jyohos   = $infoP-($infoM/15);
		//偏差値
		$sougo   = (($sum-$array_vf['sougo']['ave'])*10)/$array_vf['sougo']['hen']+50;
		$reads   = (($read-$array_vf['read']['ave'])*10)/$array_vf['read']['hen']+50;
		$changes = (($change-$array_vf['change']['ave'])*10)/$array_vf['change']['hen']+50;
		$unders  = (($understand-$array_vf['understand']['ave'])*10)/$array_vf['understand']['hen']+50;
		$selects = (($select-$array_vf['select']['ave'])*10)/$array_vf['select']['hen']+50;

		$jyoho   = (($jyohos-$array_vf['vaias']['ave'])*10)/$array_vf['vaias']['hen']+50;

		//偏差値が20以下の場合は20になる
		//偏差値が80以上の場合は80になる
		if($sougo <= 20){
			$sougo = 20.0;
		}elseif($sougo >= 80){
			$sougo = 80.0;
		}
		if($reads <= 20){
			$reads = 20.0;
		}elseif($reads >= 80){
			$reads = 80.0;
		}
		if($changes <= 20){
			$changes = 20.0;
		}elseif($changes >= 80){
			$changes = 80.0;
		}

		if($unders <= 20){
			$unders = 20.0;
		}elseif($unders >= 80){
			$unders = 80.0;
		}

		if($selects <= 20){
			$selects = 20.0;
		}elseif($selects >= 80){
			$selects = 80.0;
		}

		if($jyoho <= 20){
			$jyoho = 20.0;
		}elseif($jyoho >= 80){
			$jyoho = 80.0;
		}

		$mvdata[$number][ 'sougo'  ] = round($sougo,2);
		$mvdata[$number][ 'reads'  ] = round($reads,2);
		$mvdata[$number][ 'changes'] = round($changes,2);
		$mvdata[$number][ 'unders' ] = round($unders,2);
		$mvdata[$number][ 'selects'] = round($selects,2);
		$mvdata[$number][ 'jyoho'  ]  = round($jyoho,2);


		$examid[$number] = $line[1];
		$number++;
		$max++;
	}
	$no++;

}
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
	$obj->setTestBa($sets);
	$eab->setTestEAB($mvdata,$rs_ans);
	header("Location:/index/rFlgReg/".$sec."/".$third."/TRUE");

	exit();
}




?>