<?PHP
include_once("./lib/keisan/include_nl2.php");
$nl = new nl2();
$no = 0;
$number = 1;
$ques = 12;
$sets = array();
//idの最大値取得
$maxid = $obj->getMaxId("nl2_member");
$max = $maxid+1;
//test_idの取得
$wt = array();
$wt[ 'test_id'       ] = $sec;
$wt[ 'type'          ] = $third;
$wt[ 'partner_id'    ] = $ptid;
$wt[ 'customer_id'   ] = $id;
$tid = $obj->getTestId($wt);

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
			
		$set[ $number ][ 'number'         ] = $line[0];
		$set[ $number ][ 'partner_id'     ] = $ptid;
		$set[ $number ][ 'customer_id'    ] = $id;
		$set[ $number ][ 'test_id'        ] = $tid[ 'id' ];
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

		}elseif($exams == "%8E%F3%8C%9F%92%86"){
			$set[ $number ][ 'exam_state'     ] = 1;
			$set[ $number ][ 'complete_flg'   ] = 0;
			
		}else{
			$set[ $number ][ 'exam_state'     ] = 2;
			$set[ $number ][ 'complete_flg'   ] = 1;
		}

		$exam = explode("/",$line[10]);

		if($exam[0] && $exam[1] && $exam[2]){
			$set[ $number ][ 'exam_date'      ] = sprintf("%04d/%02d/%02d",$exam[0],$exam[1],$exam[2]);
			$set[ $number ][ 'start_time'     ] = $line[11];
			$set[ $number ][ 'exam_time'      ] = preg_replace("/^'/","",$line[12]);
		}else{
			$set[ $number ][ 'exam_date'      ] = "";
			$set[ $number ][ 'start_time'     ] = "";
			$set[ $number ][ 'exam_time'      ] = "";
		}
		
		$nldata[$number]['id'         ] = $max;
		$nldata[$number]['testid'     ] = $tid[ 'id' ];
		$nldata[$number]['tgrpid'     ] = $sec;
		$nldata[$number]['exid'       ] = $line[1];
		$st = sprintf("%04d-%02d-%02d",$exam[0],$exam[1],$exam[2]);
		$nldata[$number]['start_time'  ] = $st." ".$line[11];

		$nkk = 13;
		$nldatakey=array();
		for($nk=1;$nk<=90;$nk++){
			$q = "ans".$nk;
			$nldatakey[$q]  = $line[$nkk];
			$nldata[$number][$q]  = $line[$nkk];
			$nkk++;
		}
		list($nldata[$number]['soten'],$nldata[$number][ 'hensa' ]) = $nl->getHensaNL2($nldatakey);
		
		//exam_idの重複チェック
		$examid[$number] = $line[1];
		$number++;
		$max++;
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
	$obj->setTestNLJ2($nldata);
	header("Location:/index/rFlgReg/".$sec."/".$third."/TRUE");
	exit();
}
?>