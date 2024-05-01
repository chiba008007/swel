<?PHP
//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------
ini_set( 'display_errors', 1 ); 
ini_set('max_execution_time', 0);
require_once("./lib/include_cusCsvUp.php");

$obj = new cusCsvUpMethod();

if($_REQUEST[ 'upload' ] && $_FILES['upfile']['tmp_name']){
	// 今登録済みのデータ取得
	$sql = "SELECT id,exam_id,number FROM t_testpaper WHERE testgrp_id=".$sec;
	$data = $obj->doGetSql($sql);
	$checklist = [];
	foreach($data as $k=>$val){
		$checklist[$val[ 'exam_id' ]] = $val[ 'number' ];
	}

	$tmp = fopen($_FILES['upfile']['tmp_name'], "r");
	setlocale(LC_ALL, 'ja_JP.UTF-8');
	setlocale(LC_ALL, 'ja_JP.EUC-JP');
	setlocale(LC_ALL, 'ja_JP.Shift_JIS');
    $lists = [];
    $i=0;
    $uniqueArray = [];
    $cnt=1;
	while ($csv = $db->fgetcsv_reg($tmp, "1024")) {
	    if($i > 0){
	       // $examArray[$i][ 'id' ] = $csv[1];
	       // $examArray[$i][ 'num'] = $csv[0];
	       // $examArray2[$i] = $csv[1];
	        //配列の作成
	        $lists[$i][ 'number'  ] = $csv[0];
	        $lists[$i][ 'exam_id' ] = $csv[1];
	        $lists[$i][ 'name'    ] = $csv[2];
	        $lists[$i][ 'kana'    ] = $csv[3];
	        $lists[$i][ 'birth'   ] = $csv[4];
	        $lists[$i][ 'memo1'   ] = $csv[5];
	        $lists[$i][ 'memo2'   ] = $csv[6];
	        $lists[$i][ 'tensaku_name'   ] = $csv[7];
	        $lists[$i][ 'tensaku_mail'   ] = $csv[8];
	    }
	    $i++;
	}
    $total = count($lists);

	$examid=[];

	//エラーチェック
	///////////////////////////////////////////////////////////
	//ファイル内に重複するIDがある場合：（両方ともエラー、エラーの種類：“ファイル内重複エラー” ）
	foreach($lists as $key=>$val){
	    $examid[$val[ 'exam_id' ]] += 1;
	}
	$errmsg = "";
	$errtext = [];
	$errexam = [];
	 foreach($examid as $k=>$v){
	     if($v > 1){
	         $errmsg = "ファイル内のID重複チェックをしてください。";
	         $errtext[$k] = "ファイル内重複エラー";
	         $errexam[$k] = 1;
	     }
	 }


    ////////////////////////////////////////////////////////
	 ////ファイル内に重複するIDがある場合：（両方ともエラー、エラーの種類：“ファイル内重複エラー” ）
	 foreach($lists as $key=>$val){
		if($checklist[ $val[ 'exam_id' ]] != $val[ 'number' ]){
			$errmsg = "ファイルのIDが検査内のIDと一致しないか確認してください。";
			$errtext[$val[ 'exam_id' ]] = "IDは既に登録されています";
			$errexam[$val[ 'exam_id' ]] = 1;
		}
	 }

	//  foreach($lists as $key=>$val){
	//      if(!$errtext[ $val[ 'exam_id' ] ]){
    // 	     $ex2 = [];
    // 	     $ex2[ 'pid' ] = $id;
    // 	     $ex2[ 'tid' ] = $sec;
    // 	     $ex2[ 'exam' ] = $val[ 'exam_id' ];
    // 	     $ex2[ 'number' ] = $val[ 'number' ];
    // 	     $exam2 = $obj->checktestdata($ex2);
    // 	     if($exam2){
    // 	         $errmsg = "ファイルのIDが検査内のIDと一致しないか確認してください。";
    // 	         $errtext[$val[ 'exam_id' ]] = "IDは既に登録されています";
    // 	         $errexam[$val[ 'exam_id' ]] = 1;
	// 		}
	// 	}
	//  }

	///////////////////////////////////////////////////////////
	//山本対応 ID文字数チェック
	foreach($lists as $key=>$val) {
		$chkexamid = $val['exam_id'];
		if(mb_strlen($chkexamid) >= 20 ) {
			$errmsg = "IDは20文字以内で設定してください。";
			$errtext[$val[ 'exam_id' ]] = "IDは20文字以内で設定してください。";
			$errexam[$val[ 'exam_id' ]] = 1;
		}
	}
	///////////////////////////////////////////////////////////
	//山本対応 ID半角英数チェック
	foreach($lists as $key=>$val) {
		$chkexamid2 = $val['exam_id'];
		if(!preg_match("/^[a-zA-Z0-9]+$/", $chkexamid2)) {
			$errmsg = "IDは半角英数で設定してください。";
			$errtext[$val[ 'exam_id' ]] = "IDは半角英数で設定してください。";
			$errexam[$val[ 'exam_id' ]] = 1;
		}
	}
	///////////////////////////////////////////////////////////
	//山本対応 ID空欄チェック
	foreach($lists as $key=>$val) {
		$chkexamid3 = $val['exam_id'];
		if(trim($chkexamid3) == "" ) {
			$errmsg = "空欄は設定できません。";
			$errtext[$val[ 'exam_id' ]] = "空欄は設定できません。";
			$errexam[$val[ 'exam_id' ]] = 1;
		}
	}


	 /////////////////////////////
	 ///該当IDが受検済み・受検中の場合：（エラーの種類：“IDは受検済みか受検中エラー” ）
	//  if($_REQUEST[ 'type' ] == 1){

	//      foreach($lists as $key=>$val){
	//          if(!$errtext[ $val[ 'exam_id' ] ]){
    // 	         $ex3 = [];
    // 	         $ex3[ 'pid' ] = $id;
    // 	         $ex3[ 'tid' ] = $sec;
    // 	         $ex3[ 'number' ] = $val[ 'number' ];
    // 	         $exam3 = $obj->checktestexam($ex3);
    // 	         if($exam3){
    // 	             $errmsg = "IDは受検済みか受検中エラー";
    // 	             $errtext[$val[ 'exam_id' ]] = "IDは受検済みか受検中エラー";
    // 	             $errexam[$val[ 'exam_id' ]] = 1;
    // 	         }
	//          }
	//      }
	//  }




	 $update = [];
	 $errdata = [];
	 foreach($lists as $key=>$val){
	     if($errexam[$val[ 'exam_id' ]]){
	         $errdata[$key] = $val;
	     }else{
	         $update[$key] = $val;
	     }
	 }



	if($errmsg){
		$file = date("Ymdhis")."_".$_FILES[ 'upfile' ][ 'name' ];
		$fp = fopen("./errexcel/".$file, "w");
		$txt1 = mb_convert_encoding("番号", 'SJIS','UTF-8');
		$txt2 = mb_convert_encoding("ID", 'SJIS','UTF-8');
		$txt3 = mb_convert_encoding("氏名", 'SJIS','UTF-8');
		$txt4 = mb_convert_encoding("ふりがな", 'SJIS','UTF-8');
		$txt5 = mb_convert_encoding("生年月日", 'SJIS','UTF-8');
		$txt6 = mb_convert_encoding("メモ1", 'SJIS','UTF-8');
		$txt7 = mb_convert_encoding("メモ2", 'SJIS','UTF-8');
		$txt8 = mb_convert_encoding("エラー", 'SJIS','UTF-8');
		$errcount = count($errdata);
		$write = [];
		$write[] =[$txt1, $txt2, $txt3,$txt4,$txt5,$txt6,$txt7,$txt8];
		foreach($errdata as $key=>$val){
			$write[] =[
				$val[ 'number' ]
				, $val[ 'exam_id' ]
				, $val[ 'name' ]
				, $val[ 'kana' ]
				, $val[ 'birth' ]
				, $val[ 'memo1' ]
				, $val[ 'memo2' ]
				, mb_convert_encoding($errtext[$val[ 'exam_id' ]], 'SJIS','UTF-8')
			];
		}
		foreach ($write as $line) {
			fputcsv($fp, $line);
		}
		fclose($fp);

		$ins =[];
		$ins[ 'total' ] = $total;
		$ins[ 'mainid' ] = $id;
		$ins[ 'testid' ] = $sec;
		$ins[ 'errcount' ] = $errcount;
		$ins[ 'filename' ] = $file;
		$ins[ 'errtext' ] = $errtext;
		$db->setUserData('errupload',$ins);
	}else{
		$where=[];
		$where[ 'customer_id' ] = $id;
		$where[ 'partner_id'  ] = $ptid;
		$where[ 'testgrp_id'  ] = $sec;
		// $where[ 'exam_state'  ] = 0;

		// 対象データ
		$targetData = $obj->getTestData($where);
		// var_dump($targetData);
		// exit();
		$cnt = 0;
		// numberのカンマ区切り
		$num = [];
		// exam_idのsql
		$examid = " ";
		// nameのSQL
		$nameData = " ";
		$kanaData = " ";
		// birthのSQL
		$birthData = " ";
		// memo1のSQL
		$memo1Data = " ";
		$memo2Data = " ";
		foreach($update as $key=>$value){
			if($targetData[$value['number']]){
				$num[] = $value['number'];
				$examid .= " WHEN '".$value[ 'number' ]."' THEN '".$value[ 'exam_id' ]."' ";
				$nameData .= " WHEN '".$value[ 'number' ]."' THEN '".mb_convert_encoding($value[ 'name' ],"UTF-8","SJIS")."' ";
				$kanaData .= " WHEN '".$value[ 'number' ]."' THEN '".mb_convert_encoding($value[ 'kana' ],"UTF-8","SJIS")."' ";
				$birthData .= " WHEN '".$value[ 'number' ]."' THEN '".$value[ 'birth' ]."' ";
				$memo1Data .= " WHEN '".$value[ 'number' ]."' THEN '".mb_convert_encoding($value[ 'memo1' ],"UTF-8","SJIS")."' ";
				$memo2Data .= " WHEN '".$value[ 'number' ]."' THEN '".mb_convert_encoding($value[ 'memo2' ],"UTF-8","SJIS")."' ";
			}
		}
		$numline = implode(",",$num);
		$sql = "";
		$sql = "update `t_testpaper` SET 
			`exam_id`= CASE `number` ".$examid." END ,
			`name`= CASE `number` ".$nameData." END ,
			`kana`= CASE `number` ".$kanaData." END ,
			`birth`= CASE `number` ".$birthData." END , 
			`memo1`= CASE `number` ".$memo1Data." END , 
			`memo2`= CASE `number` ".$memo2Data." END 
			WHERE 
				`number` IN (".$numline.") AND
				`testgrp_id` = ".$where[ 'testgrp_id' ]."
		";
		if($_REQUEST[ 'type' ] === 1){
			$sql .= " AND exam_state = 0 ";
		}
		//echo mb_convert_encoding($sql,"utf-8","sjis");
		//var_dump($update);
		$rlt = $obj->doSql($sql);
	}
}
$where = [];
$where[ 'testid' ] = $sec;
$where[ 'mainid' ] = $id;
//エラー履歴
$errhist = $obj->getHist($where);


?>