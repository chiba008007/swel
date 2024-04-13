<?PHP
	require_once("./lib/include_pdf.php");
	require_once("./lib/include_makePDF.php");

	$obj = new pdfMethod();



	define('FPDF_FONTPATH','./font/');
	require('./mbfpdf.php');
	if($four == "a3"){
		$pdf = new MBFPDF('L','mm','A3');
	}else{
		$pdf = new MBFPDF('P','mm','A4');
	}
	$pdf->SetAutoPageBreak(false);


	$pdf->AddPage();
	$pdf->AddMBFont(PGOTHIC ,'SJIS');
	$pdf->SetFont(PGOTHIC, '', 8);
	$pdf->AddMBFont(GOTHIC, 'SJIS');
	//パートナーデータ取得
	$where[ id ] = $ptid;
	$user = $obj->getUser($where);
	$make = new makePDF($user[0][ 'login_id' ]);


	$where = array();
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'exam_id'     ] = $third;
	$where[ 'partner_id'  ] = $ptid;
	$where[ 'customer_id' ] = $id;
	//受検データ取得
	$testdata  = $obj->getTestData($where);
	$testdata[ 'exam_id' ] = $third;
	$test_name = $testdata[ 'testname' ];
	$test_name = mb_convert_encoding($testdata[ 'testname' ],"SJIS","UTF-8");
	$name = mb_convert_encoding($testdata[ 'name' ],"SJIS","UTF-8");

	//受検タイプ取得
	$type     = $obj->getType($where);
	//作成PDFの指定
	$pdfline = explode(":",$testdata[ 'pdfdownload' ]);



if($_REQUEST[ 'pdfZip' ]){
	//elementデータの取得
	$ewhere = array();
	$ewhere[ 'uid' ] = $ptid;
	$elem = $obj->getElementLists($ewhere);
	//-------------------------------------
	//行動価値検査結果レポート（面接版適合なし）の作成
	//行動価値検査結果レポート（面接版適合あり）の作成
	//-------------------------------------

	//ZIPファイルでダウンロードするとき
	//ダウンロードするフォルダを作成する

	if($first == "zip"){
		//ディレクトリの作成
		$dirs = "./pdfDownload/".$sec."_".$third."/";
		@mkdir($dirs,0777);
	}

	if(
		$five == 1 || $five == 2
		){
		$types = array(1,2,12);
		$testdata['type'] = $obj->getTestPaper($where,$types);

		//ストレスレベルスコア取得
		if($testdata[ 'stress_flg' ] == 1){
			list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
		}else{
			list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
		}
		//重みデータ取得
		//行動価値検査は１つなので、重みデータも１つ取得する
		$testweight[0] = $obj->getWeight($where,$type);
		foreach($testweight as $key=>$val){
			$sum[$key] = array_sum($val);
			
		}
		foreach($sum as $key=>$val){
			if($val != 0){
				$testweightkey = $key;
			}
		}
		if($testweightkey && $testweight[$testweightkey]){
			$testweight[0] = $weight[$testweightkey];
		}

		//var_dump($testdata);
		$ques = "3.".$name." さんへの質問例";
		$ques2 = "3.".$name." さんの強み";

		require_once("./mode/pdf/pdf1_2_comment.php");

	}

	//-------------------------------------
	//行動価値検査結果レポート（面接版適合なし/あり）の作成おわり
	//-------------------------------------

	include("./lib/pChart/pData.class");
	include("./lib/pChart/pChart.class");


	include("./lib/pChart/pData2.class.php");
	include("./lib/pChart/pDraw.class.php");
	include("./lib/pChart/pRadar.class.php");
	include("./lib/pChart/pImage.class.php");

	// Dataset definition 
	$DataSet = new pData;
	$plus = 0;
	//------------------------------------------
	//行動価値検査結果レポート（面接版適合なし）出力
	//------------------------------------------
	if($five == 1){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf1.php");

		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}


	//------------------------------------------
	//行動価値検査結果レポート（面接版適合なし）出力終わり
	//------------------------------------------
	//------------------------------------------
	//行動価値検査結果レポート（面接版適合あり）出力
	//------------------------------------------
	if($five == 2){
		if($plus){
			$pdf->AddPage();
		}

		require_once("./mode/pdf/pdf2.php");
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();

	}
	//------------------------------------------
	//行動価値検査結果レポート（面接版適合あり）出力終わり
	//------------------------------------------

	//-------------------------------------
	//行動価値検査結果レポート（ストレス版）作成
	//-------------------------------------
	if($five == 3){
		$types = array(1,2,12);
		$testdata['type'] = $obj->getTestPaper($where,$types);
		//ストレスレベルスコア取得
		if($testdata[ 'stress_flg' ] == 1){
			list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
		}else{
			list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
		}
		//重みデータ取得
		//行動価値検査は１つなので、重みデータも１つ取得する
		$testweight[0] = $obj->getWeight($where,$type);
		foreach($testweight as $key=>$val){
			$sum[$key] = array_sum($val);
			
		}
		foreach($sum as $key=>$val){
			if($val != 0){
				$testweightkey = $key;
			}
		}
		if($testweightkey && $testweight[$testweightkey]){
			$testweight[0] = $weight[$testweightkey];
		}
		require_once("./mode/pdf/pdf3_comment.php");

	}

	//-------------------------------------
	//行動価値検査結果レポート（ストレス版）作成終わり
	//-------------------------------------

	//------------------------------------------
	//行動価値検査結果レポート（ストレス版）
	//------------------------------------------
	if($five == 3){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf3.php");
		
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();

	}
	//------------------------------------------
	//行動価値検査結果レポート（ストレス版）終わり
	//------------------------------------------

	//-------------------------------------
	//感情能力検査レポート作成
	//-------------------------------------
	if($five == 4){
		$rs = $obj->getPdfDataRs($where);
		$sougo     = sprintf("%.1f",round($rs[0][ 'sougo'     ],1));
		$yomitori  = sprintf("%.1f",round($rs[0][ 'yomitori'  ],1));
		$rikai     = sprintf("%.1f",round($rs[0][ 'rikai'     ],1));
		$sentaku   = sprintf("%.1f",round($rs[0][ 'sentaku'   ],1));
		$kirikae   = sprintf("%.1f",round($rs[0][ 'kirikae'   ],1));
		//コメント配列読み込み
		require_once("./mode/pdf/pdf4_comment.php");
	}
	//-------------------------------------
	//感情能力検査レポート作成作成
	//-------------------------------------

	//-------------------------------------
	//感情能力検査レポート作成
	//-------------------------------------
	if($five == 4){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf4.php");

		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}
	//-------------------------------------
	//感情能力検査レポート作成作成
	//-------------------------------------

	//-------------------------------------
	//感情能力検査レポート自己理解作成
	//-------------------------------------
	if($five == 5){
		$types = array(1,2,12);
		$testdata['type'] = $obj->getTestPaper($where,$types);
		$dev1  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev1'  ],1));
		$dev2  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev2'  ],1));
		$dev3  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev3'  ],1));
		$dev4  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev4'  ],1));
		$dev5  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev5'  ],1));
		$dev6  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev6'  ],1));
		$dev7  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev7'  ],1));
		$dev8  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev8'  ],1));
		$dev9  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev9'  ],1));
		$dev10 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev10' ],1));
		$dev11 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev11' ],1));
		$dev12 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev12' ],1));
		
		//重みデータ取得
		//行動価値検査は１つなので、重みデータも１つ取得する
		$testweight[0] = $obj->getWeight($where,$type);
		foreach($testweight as $key=>$val){
			$sum[$key] = array_sum($val);
			
		}
		foreach($sum as $key=>$val){
			if($val != 0){
				$testweightkey = $key;
			}
		}
		if($testweightkey && $testweight[$testweightkey]){
			$testweight[0] = $weight[$testweightkey];
		}

		//var_dump($testdata);
		$ques = "3.".$name." さんへの質問例";
		$ques2 = "3.".$name." さんの強み";
		require_once("./mode/pdf/pdf5_comment.php");

	}
	//-------------------------------------
	//感情能力検査レポート作成作成
	//-------------------------------------
	//-------------------------------------
	//行動価値検査結果レポート（自己理解版）
	//-------------------------------------
	if($five == 5){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf5.php");

		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}
	//-------------------------------------
	//行動価値検査結果レポート（自己理解版）終わり
	//-------------------------------------

	//-------------------------------------
	//行動意識検査作成
	//-------------------------------------
	if($five == 6){
		if(in_array("37",$type)){
			$table[0] = "mv2_member";
			$table[1] = "mv2_score";
		}else{
			$table[0] = "mv_member";
			$table[1] = "mv_score";
			
		}
		$mvdata = $obj->getMovePdfData($where,$table);
		require_once("./mode/pdf/pdf6_comment.php");
	}
	//-------------------------------------
	//行動意識検査作成終わり
	//-------------------------------------
	//-------------------------------------
	//行動価値検査結果レポート（自己理解版）
	//-------------------------------------
	if($five == 6){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf6.php");
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}
	//-------------------------------------
	//行動価値検査結果レポート（自己理解版）終わり
	//-------------------------------------

	//-------------------------------------
	//VF検査(採用価値基準検査/表紙なし あり)
	//-------------------------------------
	if($five == 7 || $five == 8){
		if(in_array("33",$type)){
			$table[0] = "vf2_member";
			$table[1] = "vf2_result";
			$table[2] = "vf2_weight";
		}else{
			$table[0] = "vf4_member";
			$table[1] = "vf4_result";
			$table[2] = "vf4_weight";
		}
		
		$vfdata = $obj->getVFPdfData($where,$table);

	}
	//-------------------------------------
	//VF検査(採用価値基準検査/表紙なし あり)終わり
	//-------------------------------------

	//-------------------------------------
	//VF検査(採用価値基準検査/表紙なし あり)
	//-------------------------------------
	if($five == 7 || $five == 8){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf7_8.php");
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();

	}
	//-------------------------------------
	//VF検査(採用価値基準検査/表紙なし あり)終わり
	//-------------------------------------

	//-------------------------------------
	//行動価値検査結果レポート（A3　自己理解版）
	//-------------------------------------
	if($five == 9){
		$types = array(1,2,12);
		$testdata['type'] = $obj->getTestPaper($where,$types);
		//ストレスレベルスコア取得
		if($testdata[ 'stress_flg' ] == 1){
			list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
		}else{
			list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
		}
		//重みデータ取得
		//行動価値検査は１つなので、重みデータも１つ取得する
		$testweight[0] = $obj->getWeight($where,$type);
		foreach($testweight as $key=>$val){
			$sum[$key] = array_sum($val);
			
		}
		foreach($sum as $key=>$val){
			if($val != 0){
				$testweightkey = $key;
			}
		}
		if($testweightkey && $testweight[$testweightkey]){
			$testweight[0] = $weight[$testweightkey];
		}
		require_once("./mode/pdf/pdf9_comment.php");

	}
	//-------------------------------------
	//行動価値検査結果レポート（A3　自己理解版）終わり
	//-------------------------------------
	//-------------------------------------
	//行動価値検査結果レポート（A3　自己理解版）
	//-------------------------------------
	if($five == 9){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf9.php");
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}
	//-------------------------------------
	//行動価値検査結果レポート（A3　自己理解版）終わり
	//-------------------------------------


	//-------------------------------------
	//行動価値検査結果レポート(面接版適合なし/日本生命用)
	//-------------------------------------
	if($five == 11){
		$types = array(1,2,12);
		$testdata['type'] = $obj->getTestPaper($where,$types);
		//ストレスレベルスコア取得
		if($testdata[ 'stress_flg' ] == 1){
			list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
		}else{
			list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
		}
		//重みデータ取得
		//行動価値検査は１つなので、重みデータも１つ取得する
		$testweight[0] = $obj->getWeight($where,$type);
		foreach($testweight as $key=>$val){
			$sum[$key] = array_sum($val);
			
		}
		foreach($sum as $key=>$val){
			if($val != 0){
				$testweightkey = $key;
			}
		}
		if($testweightkey && $testweight[$testweightkey]){
			$testweight[0] = $weight[$testweightkey];
		}

		$ques = "3.".$name." さんへの質問例";
		$ques2 = "3.".$name." さんの強み";

		require_once("./mode/pdf/pdf11_comment.php");

		
	}
	//-------------------------------------
	//行動価値検査結果レポート(面接版適合なし/日本生命用)終わり
	//-------------------------------------
	//-------------------------------------
	//行動価値検査結果レポート(面接版適合なし/日本生命用)
	//-------------------------------------
	if($five == 11){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf11.php");
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();

	}
	//-------------------------------------
	//行動価値検査結果レポート(面接版適合なし/日本生命用)終わり
	//-------------------------------------



	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版１）
	//-------------------------------------
	if($five == 12){
		
		require_once("./mode/pdf/pdf12_comment.php");
		$types = array(1,2,12);
		$testdata['type'] = $obj->getTestPaper($where,$types);

		foreach($testdata['type'] as $key=>$val){
			if(preg_match("/^dev/",$key)){
				$devlist[ $key ] = $val;
			}
		}
		asort($devlist);
		//重みデータ取得
		//行動価値検査は１つなので、重みデータも１つ取得する
		$testweight[0] = $obj->getWeight($where,$type);
		if($testdata[ 'weight' ] == 0 ){
			//weight=0の時重みあり
			//重みのあるものを優先にする
			$weight = $testweight[0];
			foreach($weight as $key=>$val){
				if($key != "weight"){
					$keys = preg_replace("/w/","dev",$key);
					if($val == 0){
						$wgt[ $keys ] = 0;
					}else{
						$wgt[ $keys ] = 1;
					}
				}
			}
			$i=1;
			foreach($devlist as $key=>$val){
					$dlists[$i]['key'  ]=$key;
					$dlists[$i]['value']=$val;
					$num = preg_replace("/^dev/","",$key);
					$dlists[$i]['num'  ]=$num;
					$dlists[$i][ 'w'   ]=$wgt[$key];
					$i++;
			}
			
			//wの降順で並び替えさらにvalueの昇順で並び替え
			foreach($dlists as $key=>$val){
				$key_w[ $key ]     = $val[ 'w' ];
				$key_value[ $key ] = $val[ 'value' ];
			}
			array_multisort($key_w,SORT_DESC,$key_value,SORT_ASC,$dlists);

			$i=1;

			foreach($dlists as $key=>$val){
				if($val[ 'value' ] <= 50 ){
					$dlist[$i]['key'  ]=$val[ 'key' ];
					$dlist[$i]['value']=$val[ 'value' ];
					$num = preg_replace("/^dev/","",$val['key']);
					$dlist[$i]['num'  ]=$num;
					$dlist[$i][ 'w'   ]=$val[ 'w' ];
					if($i>=2){
						break;
					}
					$i++;
				}
			}

		}else{
			$i=1;
			foreach($devlist as $key=>$val){
				if($val <= 50 ){
					$dlist[$i]['key'  ]=$key;
					$dlist[$i]['value']=$val;
					$num = preg_replace("/^dev/","",$key);
					$dlist[$i]['num'  ]=$num;

					if($i>=2){
						break;
					}
					$i++;
				}
			}
		}
	}
	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版１）終わり
	//-------------------------------------
	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版１）
	//-------------------------------------
	if($five == 12){
		
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf12.php");
		
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}
	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版１）終わり
	//-------------------------------------


	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版2）
	//-------------------------------------
	if($five == 13){
		require_once("./mode/pdf/pdf13_comment.php");
		$types = array(1,2,12);
		$testdata['type'] = $obj->getTestPaper($where,$types);

		foreach($testdata['type'] as $key=>$val){
			if(preg_match("/^dev/",$key)){
				$devlist[ $key ] = $val;
			}
		}
	}
	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版2）終わり
	//-------------------------------------

	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版１）
	//-------------------------------------
	if($five == 13){
		
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf13.php");
		
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}
	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版１）終わり
	//-------------------------------------

	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版2）
	//-------------------------------------
	if($five == 14){
		require_once("./mode/pdf/pdf14_comment.php");
		if(in_array("35",$type)){
			$mtable[0] = "math2_member";
			$mtable[1] = "math2_score";
			$mtable[2] = "math2_sec";
		}else{
			$mtable[0] = "math_member";
			$mtable[1] = "math_score";
			$mtable[2] = "math_sec";
		}
		$math = $obj->getMathDataList($where,$mtable);
	}
	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版2）終わり
	//-------------------------------------
	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版2）
	//-------------------------------------
	if($five == 14){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf14.php");
		
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}
	//-------------------------------------
	//行動価値検査結果レポート（面接詳細版2）終わり
	//-------------------------------------

	//-------------------------------------
	//コミュニケーション特性(NLPコーチング)
	//-------------------------------------

	if($five == 15){
		require_once("./mode/pdf/pdf15_comment.php");
		$types = array(34,36);
		$testdata['type'] = $obj->getTestPaper($where,$types);
		//ストレスレベルスコア取得
		if($testdata[ 'stress_flg' ] == 1){
			list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
		}else{
			list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
		}
		//重みデータ取得
		//行動価値検査は１つなので、重みデータも１つ取得する
		$testweight[0] = $obj->getWeight($where,$type);
		foreach($testweight as $key=>$val){
			$sum[$key] = array_sum($val);
			
		}
		foreach($sum as $key=>$val){
			if($val != 0){
				$testweightkey = $key;
			}
		}
		if($testweightkey && $testweight[$testweightkey]){
			$testweight[0] = $weight[$testweightkey];
		}
		
		//var_dump($testdata);
		$ques = "3.".$name." さんへの質問例";
		$ques2 = "3.".$name." さんの強み";
		$score = $obj->getNL2PdfScore($where);

	}

	//-------------------------------------
	//コミュニケーション特性(NLPコーチング)終わり
	//-------------------------------------

	//-------------------------------------
	//コミュニケーション特性(NLPコーチング)
	//-------------------------------------
	if($five == 15){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf15.php");
		
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
		
	}


	//-------------------------------------
	//コミュニケーション特性(NLPコーチング)終わり
	//-------------------------------------

	if($five == 16){
		require_once("./mode/pdf/pdf15_comment.php");
		$types = array(34,36);
		$testdata['type'] = $obj->getTestPaper($where,$types);
		//ストレスレベルスコア取得
		if($testdata[ 'stress_flg' ] == 1){
			list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
		}else{
			list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
		}
		//重みデータ取得
		//行動価値検査は１つなので、重みデータも１つ取得する
		$testweight = array();
		$testweight[0] = $obj->getWeight($where,$type);
		foreach($testweight as $key=>$val){
			$sum[$key] = array_sum($val);
			
		}
		foreach($sum as $key=>$val){
			if($val != 0){
				$testweightkey = $key;
			}
		}
		if($testweightkey && $testweight[$testweightkey]){
			$testweight[0] = $weight[$testweightkey];
		}
		
		//var_dump($testdata);
		$ques = "3.".$name." さんへの質問例";
		$ques2 = "3.".$name." さんの強み";
		$score = array();
		$score = $obj->getNL2PdfScore($where);
	}

	//-------------------------------------
	//コミュニケーション特性(NLPコーチング)
	//-------------------------------------
	if($five == 16){
		if($plus){
			$pdf->AddPage();
		}
		require_once("./mode/pdf/pdf16.php");
		
		$exam_id = $third;
		$filename = $dirs.$test_name."_".$exam_id."_".date('Y').date('m').date('d')."_".$five.".pdf";
		$pdf->Output($filename, 'F');
		exit();
	}
	//-------------------------------------
	//コミュニケーション特性(NLPコーチング)終わり
	//-------------------------------------
	
	/*
	//-------------------------------------
	//PDFログ登録
	//-------------------------------------
	$set = array();
	$set[ 'exam_id'    ] = $third;
	$set[ 'partner_id' ] = $ptid;
	$set[ 'customer_id'] = $id;
	$set[ 'test_name'  ] = $test_name;
	$set[ 'exam_name'  ] = $name;
	$set[ 'test_id'    ] = $sec;
	$set[ 'test_id'    ] = $sec;
	$set[ 'pdf_type'   ] = $testdata[ 'pdfdownload' ];
	$set[ 'pdf_auth'   ] = $basetype;
	$obj->setPdfLog($set);
	*/
	exit();
}
	exit();
	
	
?>
