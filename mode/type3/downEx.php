<?PHP
//-------------------------------------------
//検査結果ファイル作成
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusDown.php");
$obj = new cusDownMethod();

ini_set("memory_limit" , -1);
set_time_limit(0);


/** Include PHPExcel */
require_once './lib/Classes/PHPExcel.php';
require_once './lib/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = new PHPExcel();

$sheet = $objPHPExcel->getActiveSheet();  
// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


$date = sprintf("%04d%02d%02d",date('Y'),date('m'),date('d'));

//アルファベット配列作成
$alphabet = str_split('abcdefghijklmnopqrstuvwxyz');
$a_alpha = $alphabet;
foreach ($alphabet as $a1) {
  foreach ($alphabet as $a2) {
	$a_alpha[] = $a1 . $a2;
  }
}

$where = array();
$where[ 'test_id'     ] = $sec;
$where[ 'customer_id' ] = $id;
$where[ 'partner_id'  ] = $ptid;
$tdatlist = $obj->getUserDataParts($where);

foreach($tdatlist as $key=>$val){
	if($val[ 'stress_flg' ] == 1){
		$stressflg[ $val['id'] ] = $val[ 'stress_flg' ];
	}
}
//$weight 1 は重みつけがない
$weight = 0;
//重み付けチェック
if($tdatlist[0][ 'weight' ] == 0){
	$weight = true;
}

foreach($tdatlist as $k=>$v){
	$tdat[ 0 ][ 'w1' ] += $v[ 'w1' ];
	$tdat[ 0 ][ 'w2' ] += $v[ 'w2' ];
	$tdat[ 0 ][ 'w3' ] += $v[ 'w3' ];
	$tdat[ 0 ][ 'w4' ] += $v[ 'w4' ];
	$tdat[ 0 ][ 'w5' ] += $v[ 'w5' ];
	$tdat[ 0 ][ 'w6' ] += $v[ 'w6' ];
	$tdat[ 0 ][ 'w7' ] += $v[ 'w7' ];
	$tdat[ 0 ][ 'w8' ] += $v[ 'w8' ];
	$tdat[ 0 ][ 'w9' ] += $v[ 'w9' ];
	$tdat[ 0 ][ 'w10' ] += $v[ 'w10' ];
	$tdat[ 0 ][ 'w11' ] += $v[ 'w11' ];
	$tdat[ 0 ][ 'w12' ] += $v[ 'w12' ];
	$typelist[$v[ 'type' ]] = "on";
}

$tests = $obj->getUserDataExcel($where);

if($typelist[1]){
	$where = array();
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'type'        ] = 1;
	$where[ 'customer_id' ] = $id;
	$where[ 'partner_id'  ] = $ptid;
	$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo";
	$mv1 = $obj->getUserDataExcelBj($where,$parts);
	if(count($mv1)){
		foreach($mv1 as $key=>$val){
			$tests[ $key ][ 'exam_date'  ] = $val[ 'exam_date'  ];
			$tests[ $key ][ 'dev1'  ] = $val[ 'dev1'  ];
			$tests[ $key ][ 'dev2'  ] = $val[ 'dev2'  ];
			$tests[ $key ][ 'dev3'  ] = $val[ 'dev3'  ];
			$tests[ $key ][ 'dev4'  ] = $val[ 'dev4'  ];
			$tests[ $key ][ 'dev5'  ] = $val[ 'dev5'  ];
			$tests[ $key ][ 'dev6'  ] = $val[ 'dev6'  ];
			$tests[ $key ][ 'dev7'  ] = $val[ 'dev7'  ];
			$tests[ $key ][ 'dev8'  ] = $val[ 'dev8'  ];
			$tests[ $key ][ 'dev9'  ] = $val[ 'dev9'  ];
			$tests[ $key ][ 'dev10' ] = $val[ 'dev10' ];
			$tests[ $key ][ 'dev11' ] = $val[ 'dev11' ];
			$tests[ $key ][ 'dev12' ] = $val[ 'dev12' ];
			$tests[ $key ][ 'soyo'  ] = $val[ 'soyo'  ];
		}
	}
}
if($typelist[59]){
	$where = array();
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'type'        ] = 59;
	$where[ 'customer_id' ] = $id;
	$where[ 'partner_id'  ] = $ptid;
	$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo";
	$mv1 = $obj->getUserDataExcelBj($where,$parts);
	if(count($mv1)){
		foreach($mv1 as $key=>$val){
			$tests[ $key ][ 'exam_date'  ] = $val[ 'exam_date'  ];
			$tests[ $key ][ 'dev1'  ] = $val[ 'dev1'  ];
			$tests[ $key ][ 'dev2'  ] = $val[ 'dev2'  ];
			$tests[ $key ][ 'dev3'  ] = $val[ 'dev3'  ];
			$tests[ $key ][ 'dev4'  ] = $val[ 'dev4'  ];
			$tests[ $key ][ 'dev5'  ] = $val[ 'dev5'  ];
			$tests[ $key ][ 'dev6'  ] = $val[ 'dev6'  ];
			$tests[ $key ][ 'dev7'  ] = $val[ 'dev7'  ];
			$tests[ $key ][ 'dev8'  ] = $val[ 'dev8'  ];
			$tests[ $key ][ 'dev9'  ] = $val[ 'dev9'  ];
			$tests[ $key ][ 'dev10' ] = $val[ 'dev10' ];
			$tests[ $key ][ 'dev11' ] = $val[ 'dev11' ];
			$tests[ $key ][ 'dev12' ] = $val[ 'dev12' ];
			$tests[ $key ][ 'soyo'  ] = $val[ 'soyo'  ];
		}
	}
}

if($typelist[65]){
	$where = array();
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'type'        ] = 65;
	$where[ 'customer_id' ] = $id;
	$where[ 'partner_id'  ] = $ptid;
	$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo";
	$mv1 = $obj->getUserDataExcelBj($where,$parts);
	if(count($mv1)){
		foreach($mv1 as $key=>$val){
			$tests[ $key ][ 'exam_date'  ] = $val[ 'exam_date'  ];
			$tests[ $key ][ 'dev1'  ] = $val[ 'dev1'  ];
			$tests[ $key ][ 'dev2'  ] = $val[ 'dev2'  ];
			$tests[ $key ][ 'dev3'  ] = $val[ 'dev3'  ];
			$tests[ $key ][ 'dev4'  ] = $val[ 'dev4'  ];
			$tests[ $key ][ 'dev5'  ] = $val[ 'dev5'  ];
			$tests[ $key ][ 'dev6'  ] = $val[ 'dev6'  ];
			$tests[ $key ][ 'dev7'  ] = $val[ 'dev7'  ];
			$tests[ $key ][ 'dev8'  ] = $val[ 'dev8'  ];
			$tests[ $key ][ 'dev9'  ] = $val[ 'dev9'  ];
			$tests[ $key ][ 'dev10' ] = $val[ 'dev10' ];
			$tests[ $key ][ 'dev11' ] = $val[ 'dev11' ];
			$tests[ $key ][ 'dev12' ] = $val[ 'dev12' ];
			$tests[ $key ][ 'soyo'  ] = $val[ 'soyo'  ];
		}
	}
}


if($typelist[2]){
	$where = array();
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'type'        ] = 2;
	$where[ 'customer_id' ] = $id;
	$where[ 'partner_id'  ] = $ptid;
	$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo,level,score";
	$mv1 = $obj->getUserDataExcelBj($where,$parts);

	if(count($mv1)){
		foreach($mv1 as $key=>$val){
			$tests[ $key ][ 'dev1'  ] = $val[ 'dev1'  ];
			$tests[ $key ][ 'dev2'  ] = $val[ 'dev2'  ];
			$tests[ $key ][ 'dev3'  ] = $val[ 'dev3'  ];
			$tests[ $key ][ 'dev4'  ] = $val[ 'dev4'  ];
			$tests[ $key ][ 'dev5'  ] = $val[ 'dev5'  ];
			$tests[ $key ][ 'dev6'  ] = $val[ 'dev6'  ];
			$tests[ $key ][ 'dev7'  ] = $val[ 'dev7'  ];
			$tests[ $key ][ 'dev8'  ] = $val[ 'dev8'  ];
			$tests[ $key ][ 'dev9'  ] = $val[ 'dev9'  ];
			$tests[ $key ][ 'dev10' ] = $val[ 'dev10' ];
			$tests[ $key ][ 'dev11' ] = $val[ 'dev11' ];
			$tests[ $key ][ 'dev12' ] = $val[ 'dev12' ];
			$tests[ $key ][ 'soyo'  ] = $val[ 'soyo'  ];
			                 
		}
	}
}

if($typelist[12]){
	$where = array();
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'type'        ] = 12;
	$where[ 'customer_id' ] = $id;
	$where[ 'partner_id'  ] = $ptid;
	$parts = "exam_date,dev1,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12,soyo,level,score";
	$mv1 = $obj->getUserDataExcelBj($where,$parts);

	if(count($mv1)){
		foreach($mv1 as $key=>$val){
			$tests[ $key ][ 'exam_date'  ] = $val[ 'exam_date'  ];
			$tests[ $key ][ 'dev1'  ] = $val[ 'dev1'  ];
			$tests[ $key ][ 'dev2'  ] = $val[ 'dev2'  ];
			$tests[ $key ][ 'dev3'  ] = $val[ 'dev3'  ];
			$tests[ $key ][ 'dev4'  ] = $val[ 'dev4'  ];
			$tests[ $key ][ 'dev5'  ] = $val[ 'dev5'  ];
			$tests[ $key ][ 'dev6'  ] = $val[ 'dev6'  ];
			$tests[ $key ][ 'dev7'  ] = $val[ 'dev7'  ];
			$tests[ $key ][ 'dev8'  ] = $val[ 'dev8'  ];
			$tests[ $key ][ 'dev9'  ] = $val[ 'dev9'  ];
			$tests[ $key ][ 'dev10' ] = $val[ 'dev10' ];
			$tests[ $key ][ 'dev11' ] = $val[ 'dev11' ];
			$tests[ $key ][ 'dev12' ] = $val[ 'dev12' ];
			$tests[ $key ][ 'soyo'  ] = $val[ 'soyo'  ];
			$tests[ $key ][ 'level' ] = $val[ 'level' ];
			$tests[ $key ][ 'score' ] = $val[ 'score' ];
			                 
		}
	
	}
}

if($typelist[3]){	
	//welcome(FS)
	$where = array();
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'type'        ] = 3;
	$where[ 'customer_id' ] = $id;
	$where[ 'partner_id'  ] = $ptid;
	$parts = "exam_state,exam_id,exam_state,number,exam_date,score";
	$fs = $obj->getUserDataExcelBj($where,$parts);

	if(count($fs)){
		foreach($fs as $key=>$val){
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				$tests[ $key ][ 'exam_date' ] = $val[ 'exam_date' ];
			}

			$tests[ $key ][ 'fs_score' ] = $val[ 'score' ];
		}
	}
}

if($typelist[4]){
	//採用基準検査
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;
	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 4;
	$order = "number";
	$vf = $obj->getTestVF4Data($paper,$order);
	if(count($vf)){
		foreach($vf as $key=>$val){
			
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				$tests[ $key ][ 'exam_date' ] = $val[ 'exam_date' ];
			}
			$tests[ $key ][ 'vf_w1'  ] = $val[ 'w1'  ];
			$tests[ $key ][ 'vf_w2'  ] = $val[ 'w2'  ];
			$tests[ $key ][ 'vf_w3'  ] = $val[ 'w3'  ];
			$tests[ $key ][ 'vf_w4'  ] = $val[ 'w4'  ];
			$tests[ $key ][ 'vf_w5'  ] = $val[ 'w5'  ];
			$tests[ $key ][ 'vf_w6'  ] = $val[ 'w6'  ];
			$tests[ $key ][ 'vf_w7'  ] = $val[ 'w7'  ];
			$tests[ $key ][ 'vf_w8'  ] = $val[ 'w8'  ];
			$tests[ $key ][ 'vf_w9'  ] = $val[ 'w9'  ];
			$tests[ $key ][ 'vf_w9'  ] = $val[ 'w9'  ];
			$tests[ $key ][ 'vf_w10' ] = $val[ 'w10' ];
			$tests[ $key ][ 'vf_w11' ] = $val[ 'w11' ];
			$tests[ $key ][ 'vf_w12' ] = $val[ 'w12' ];
			
		}
	}
}

if($typelist[33]){
	//採用基準検査
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;
	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 33;
	$order = "number";
	$vf = $obj->getTestVF2Data($paper,$order,$limit);
	if(count($vf)){
		foreach($vf as $key=>$val){
			
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				//$tests[ $key ][ 'vf_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val[ 'fin_exam_date' ],0,10);
				$fdate = preg_replace("/\-/","/",$ex);
				//if($fdate == "0000/00/00"){
					$fdate = $val[ 'exam_date' ];
				//}
				$tests[ $key ][ 'exam_date'  ] = $fdate;

			}
			$tests[ $key ][ 'vf_w1'  ] = $val[ 'w1'  ];
			$tests[ $key ][ 'vf_w2'  ] = $val[ 'w2'  ];
			$tests[ $key ][ 'vf_w3'  ] = $val[ 'w3'  ];
			$tests[ $key ][ 'vf_w4'  ] = $val[ 'w4'  ];
			$tests[ $key ][ 'vf_w5'  ] = $val[ 'w5'  ];
			$tests[ $key ][ 'vf_w6'  ] = $val[ 'w6'  ];
			$tests[ $key ][ 'vf_w7'  ] = $val[ 'w7'  ];
			$tests[ $key ][ 'vf_w8'  ] = $val[ 'w8'  ];
			$tests[ $key ][ 'vf_w9'  ] = $val[ 'w9'  ];
			$tests[ $key ][ 'vf_w9'  ] = $val[ 'w9'  ];
			$tests[ $key ][ 'vf_w10' ] = $val[ 'w10' ];
			$tests[ $key ][ 'vf_w11' ] = $val[ 'w11' ];
			$tests[ $key ][ 'vf_w12' ] = $val[ 'w12' ];
			
		}
	}
}

if($typelist[7]){
	//感情能力検査【社会人版】
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;
	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 7;
	$order = "number";
	$rs = $obj->getTestRsData($paper,$order);

	if(count($rs)){
		foreach($rs as $key=>$val){
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				$tests[ $key ][ 'exam_date' ] = $val[ 'exam_date' ];
			}
			$tests[ $key ][ 'sougo'    ] = $val[ 'sougo'    ];
			$tests[ $key ][ 'yomitori' ] = $val[ 'yomitori' ];
			$tests[ $key ][ 'rikai'    ] = $val[ 'rikai'    ];
			$tests[ $key ][ 'sentaku'  ] = $val[ 'sentaku'  ];
			$tests[ $key ][ 'kirikae'  ] = $val[ 'kirikae'  ];
			$tests[ $key ][ 'jyoho'    ] = $val[ 'jyoho'    ];
			
		}
	}
}

if($typelist[5]){
	//感情能力検査【社会人版】
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;
	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 5;
	$order = "number";
	$dpdata = $obj->getTestDpData($paper,$order);
	if(count($dpdata)){
		foreach($dpdata as $key=>$val){
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				$tests[ $key ][ 'exam_date' ] = $val[ 'exam_date' ];
			}
			$tests[ $key ][ 'sougo'    ] = $val[ 'sougo'    ];
			$tests[ $key ][ 'yomitori' ] = $val[ 'yomitori' ];
			$tests[ $key ][ 'rikai'    ] = $val[ 'rikai'    ];
			$tests[ $key ][ 'sentaku'  ] = $val[ 'sentaku'  ];
			$tests[ $key ][ 'kirikae'  ] = $val[ 'kirikae'  ];
			$tests[ $key ][ 'jyoho'    ] = $val[ 'jyoho'    ];
			
		}
	}
}


if($typelist[31]){
	//感情能力検査【学生版】
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;
	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 31;
	$order = "number";
	$dpdata = $obj->getTestDpSecData($paper,$order,$limit);

	if(count($dpdata)){
		foreach($dpdata as $key=>$val){
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				//$tests[ $key ][ 'rs_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val[ 'fin_exam_date' ],0,10);
				$fdate = preg_replace("/\-/","/",$ex);
				if($fdate == "0000/00/00"){
					$fdate = $val[ 'exam_date' ];
				}
				$tests[ $key ][ 'exam_date'  ] = $fdate;

			}

			if($val[ 'sougo'  ]){
				$tests[ $key ][ 'sougo'    ] = round($val[ 'sougo'    ],1);
			}else{
				$tests[ $key ][ 'sougo'    ] = $val[ 'sougo'    ];
			}
			
			if($val[ 'yomitori' ]){
				$tests[ $key ][ 'yomitori' ] = round($val[ 'yomitori' ],1);
			}else{
				$tests[ $key ][ 'yomitori' ] = $val[ 'yomitori' ];
			}
			
			if($val[ 'rikai'    ]){
				$tests[ $key ][ 'rikai'    ] = round($val[ 'rikai'    ],1);
			}else{
				$tests[ $key ][ 'rikai'    ] = $val[ 'rikai'    ];
			}
			
			if($val[ 'sentaku'    ]){
				$tests[ $key ][ 'sentaku'  ] = round($val[ 'sentaku'  ],1);
			}else{
				$tests[ $key ][ 'sentaku'  ] = $val[ 'sentaku'  ];
			}
			
			if($val[ 'kirikae'  ]){
				$tests[ $key ][ 'kirikae'  ] = round($val[ 'kirikae'  ],1);
			}else{
				$tests[ $key ][ 'kirikae'  ] = $val[ 'kirikae'  ];
			}
			
			if($val[ 'jyoho'  ]){
				$tests[ $key ][ 'jyoho'    ] = round($val[ 'jyoho'    ],1);
			}else{
				$tests[ $key ][ 'jyoho'    ] = $val[ 'jyoho'  ];
			}


		}
	}
	
}


if($typelist[6]){
	//行動意識要素
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;
	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 6;
	$order = "number";
	$mv = $obj->getTestMVData($paper,$order);
	if(count($mv)){
		foreach($mv as $key=>$val){
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				$tests[ $key ][ 'exam_date' ] = $val[ 'exam_date' ];
			}
			$tests[ $key ][ 'score1'  ] = $val[ 'score1'  ];
			$tests[ $key ][ 'score2'  ] = $val[ 'score2'  ];
			$tests[ $key ][ 'score3'  ] = $val[ 'score3'  ];
			$tests[ $key ][ 'score4'  ] = $val[ 'score4'  ];
			$tests[ $key ][ 'score5'  ] = $val[ 'score5'  ];
			$tests[ $key ][ 'score6'  ] = $val[ 'score6'  ];
			$tests[ $key ][ 'score7'  ] = $val[ 'score7'  ];
			$tests[ $key ][ 'score8'  ] = $val[ 'score8'  ];
			$tests[ $key ][ 'score9'  ] = $val[ 'score9'  ];
			$tests[ $key ][ 'score10' ] = $val[ 'score10' ];
			$tests[ $key ][ 'score11' ] = $val[ 'score11' ];
			$tests[ $key ][ 'score12' ] = $val[ 'score12' ];
			$tests[ $key ][ 'score13' ] = $val[ 'score13' ];
			$tests[ $key ][ 'score14' ] = $val[ 'score14' ];
			$tests[ $key ][ 'score15' ] = $val[ 'score15' ];
			$tests[ $key ][ 'score16' ] = $val[ 'score16' ];
			$tests[ $key ][ 'score17' ] = $val[ 'score17' ];
			$tests[ $key ][ 'score18' ] = $val[ 'score18' ];
			$tests[ $key ][ 'score19' ] = $val[ 'score19' ];
			$tests[ $key ][ 'score20' ] = $val[ 'score20' ];
			$tests[ $key ][ 'score21' ] = $val[ 'score21' ];
			$tests[ $key ][ 'score22' ] = $val[ 'score22' ];
			$tests[ $key ][ 'score23' ] = $val[ 'score23' ];
			$tests[ $key ][ 'score24' ] = $val[ 'score24' ];
			$tests[ $key ][ 'score25' ] = $val[ 'score25' ];
		}
	}
}

if($typelist[37]){
	//行動意識要素
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;

	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 37;
	$order = "number";
	$grp = " group by exam_id";

	$mv = $obj->getTestMV2Data($paper,$order,$grp,$limit);
	if(count($mv)){
		foreach($mv as $key=>$val){
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				//$tests[ $key ][ 'mv_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val[ 'exam_date' ],0,10);
				$fdate = preg_replace("/\-/","/",$ex);
				if($fdate == "0000/00/00"){
					$fdate = $val[ 'exam_date' ];
				}
				$tests[ $key ][ 'exam_date'  ] = $fdate;

			}
			$tests[ $key ][ 'score1'  ] = $val[ 'score1'  ];
			$tests[ $key ][ 'score2'  ] = $val[ 'score2'  ];
			$tests[ $key ][ 'score3'  ] = $val[ 'score3'  ];
			$tests[ $key ][ 'score4'  ] = $val[ 'score4'  ];
			$tests[ $key ][ 'score5'  ] = $val[ 'score5'  ];
			$tests[ $key ][ 'score6'  ] = $val[ 'score6'  ];
			$tests[ $key ][ 'score7'  ] = $val[ 'score7'  ];
			$tests[ $key ][ 'score8'  ] = $val[ 'score8'  ];
			$tests[ $key ][ 'score9'  ] = $val[ 'score9'  ];
			$tests[ $key ][ 'score10' ] = $val[ 'score10' ];
			$tests[ $key ][ 'score11' ] = $val[ 'score11' ];
			$tests[ $key ][ 'score12' ] = $val[ 'score12' ];
			$tests[ $key ][ 'score13' ] = $val[ 'score13' ];
			$tests[ $key ][ 'score14' ] = $val[ 'score14' ];
			$tests[ $key ][ 'score15' ] = $val[ 'score15' ];
			$tests[ $key ][ 'score16' ] = $val[ 'score16' ];
			$tests[ $key ][ 'score17' ] = $val[ 'score17' ];
			$tests[ $key ][ 'score18' ] = $val[ 'score18' ];
			$tests[ $key ][ 'score19' ] = $val[ 'score19' ];
			$tests[ $key ][ 'score20' ] = $val[ 'score20' ];
			$tests[ $key ][ 'score21' ] = $val[ 'score21' ];
			$tests[ $key ][ 'score22' ] = $val[ 'score22' ];
			$tests[ $key ][ 'score23' ] = $val[ 'score23' ];
			$tests[ $key ][ 'score24' ] = $val[ 'score24' ];
			$tests[ $key ][ 'score25' ] = $val[ 'score25' ];
		}
	}
}

$math = "";

if($typelist[13]){
	//BMS　数学検定
	$bms[ 'customer_id' ] = $id;
	$bms[ 'partner_id'  ] = $ptid;
	$bms[ 'testgrp_id' ] = $sec;
	$bms[ 'type'       ] = 13;
	$order = "number";
	$bmsdata = $obj->getMathData($bms,$order,$limit);

	if(count($bmsdata)){
		foreach($bmsdata as $key=>$val){
			$tests[ $key ][ 'math_level' ] = $val[ 'level'      ];
			$tests[ $key ][ 'math_score' ] = $val[ 'sogo_score' ];
			
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				$tests[ $key ][ 'exam_date' ] = $val[ 'exam_date' ];
			}
			if($val[ 'haku_yoso' ] == ""){
				$tests[ $key ][ 'haku_yoso' ] = "";
			}else
			if($val[ 'haku_yoso' ] >= 15){
				$tests[ $key ][ 'haku_yoso' ] = "A";
			}else
			if($val[ 'haku_yoso' ] >= 7){
				$tests[ $key ][ 'haku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'haku_yoso' ] = "C";
			}

			if($val[ 'bunseki_yoso' ] == ""){
				$tests[ $key ][ 'bunseki_yoso' ] = "";
			}else
			if($val[ 'bunseki_yoso' ] >= 15){
				$tests[ $key ][ 'bunseki_yoso' ] = "A";
			}else
			if($val[ 'bunseki_yoso' ] >= 7){
				$tests[ $key ][ 'bunseki_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'bunseki_yoso' ] = "C";
			}



			if($val[ 'sentaku_yoso' ] == ""){
				$tests[ $key ][ 'sentaku_yoso' ] = "";
			}else
			if($val[ 'sentaku_yoso' ] >= 15){
				$tests[ $key ][ 'sentaku_yoso' ] = "A";
			}else
			if($val[ 'sentaku_yoso' ] >= 7){
				$tests[ $key ][ 'sentaku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'sentaku_yoso' ] = "C";
			}


			if($val[ 'yosoku_yoso' ] == ""){
				$tests[ $key ][ 'yosoku_yoso' ] = "";
			}else
			if($val[ 'yosoku_yoso' ] >= 15){
				$tests[ $key ][ 'yosoku_yoso' ] = "A";
			}else
			if($val[ 'yosoku_yoso' ] >= 7){
				$tests[ $key ][ 'yosoku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'yosoku_yoso' ] = "C";
			}


			if($val[ 'hyogen_yoso' ] == ""){
				$tests[ $key ][ 'hyogen_yoso' ] = "";
			}else
			if($val[ 'hyogen_yoso' ] >= 15){
				$tests[ $key ][ 'hyogen_yoso' ] = "A";
			}else
			if($val[ 'hyogen_yoso' ] >= 7){
				$tests[ $key ][ 'hyogen_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'hyogen_yoso' ] = "C";
			}

		}
	}
	$math = "on";
}

if($typelist[35]){
	//BMS　数学検定
	$bms[ 'customer_id' ] = $id;
	$bms[ 'partner_id'  ] = $ptid;
	$bms[ 'testgrp_id' ] = $sec;
	$bms[ 'type'       ] = 35;
	$order = "number";
	$bmsdata = $obj->getMath2Data($bms,$order,$limit);

	if(count($bmsdata)){
		foreach($bmsdata as $key=>$val){
			$tests[ $key ][ 'math_level' ] = $val[ 'level'      ];
			$tests[ $key ][ 'math_score' ] = $val[ 'sogo_score' ];
			
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				$tests[ $key ][ 'exam_date' ] = $val[ 'exam_date' ];
			}
			if($val[ 'haku_yoso' ] == ""){
				$tests[ $key ][ 'haku_yoso' ] = "";
			}else
			if($val[ 'haku_yoso' ] >= 15){
				$tests[ $key ][ 'haku_yoso' ] = "A";
			}else
			if($val[ 'haku_yoso' ] >= 7){
				$tests[ $key ][ 'haku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'haku_yoso' ] = "C";
			}

			if($val[ 'bunseki_yoso' ] == ""){
				$tests[ $key ][ 'bunseki_yoso' ] = "";
			}else
			if($val[ 'bunseki_yoso' ] >= 15){
				$tests[ $key ][ 'bunseki_yoso' ] = "A";
			}else
			if($val[ 'bunseki_yoso' ] >= 7){
				$tests[ $key ][ 'bunseki_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'bunseki_yoso' ] = "C";
			}



			if($val[ 'sentaku_yoso' ] == ""){
				$tests[ $key ][ 'sentaku_yoso' ] = "";
			}else
			if($val[ 'sentaku_yoso' ] >= 15){
				$tests[ $key ][ 'sentaku_yoso' ] = "A";
			}else
			if($val[ 'sentaku_yoso' ] >= 7){
				$tests[ $key ][ 'sentaku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'sentaku_yoso' ] = "C";
			}


			if($val[ 'yosoku_yoso' ] == ""){
				$tests[ $key ][ 'yosoku_yoso' ] = "";
			}else
			if($val[ 'yosoku_yoso' ] >= 15){
				$tests[ $key ][ 'yosoku_yoso' ] = "A";
			}else
			if($val[ 'yosoku_yoso' ] >= 7){
				$tests[ $key ][ 'yosoku_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'yosoku_yoso' ] = "C";
			}


			if($val[ 'hyogen_yoso' ] == ""){
				$tests[ $key ][ 'hyogen_yoso' ] = "";
			}else
			if($val[ 'hyogen_yoso' ] >= 15){
				$tests[ $key ][ 'hyogen_yoso' ] = "A";
			}else
			if($val[ 'hyogen_yoso' ] >= 7){
				$tests[ $key ][ 'hyogen_yoso' ] = "B";
			}else{
				$tests[ $key ][ 'hyogen_yoso' ] = "C";
			}

		}
	}
	$math = "on";
}

$nl2flg = "";
if($typelist[36]){
	//NL2検査
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;
	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 36;
	$order = "number";
	$nl2 = $obj->getNl2Data($paper,$order,$limit);

	if(count($nl2)){
		foreach($nl2 as $key=>$val){
			
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'exam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				//$tests[ $key ][ 'vf_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val[ 'fin_exam_date' ],0,10);
				$fdate = preg_replace("/\-/","/",$ex);
				if($fdate == "0000/00/00"){
					$fdate = $val[ 'exam_date' ];
				}
				$tests[ $key ][ 'exam_date'  ] = $fdate;

			}
			$tests[ $key ][ 'nl2_score1'      ] = $val[ 'score1'   ];
			$tests[ $key ][ 'nl2_score2'      ] = $val[ 'score2'   ];
			$tests[ $key ][ 'nl2_score3'      ] = $val[ 'score3'   ];
			$tests[ $key ][ 'nl2_score4'      ] = $val[ 'score4'   ];
			$tests[ $key ][ 'nl2_score5'      ] = $val[ 'score5'   ];
			$tests[ $key ][ 'nl2_score6'      ] = $val[ 'score6'   ];
			$tests[ $key ][ 'nl2_score7'      ] = $val[ 'score7'   ];
			$tests[ $key ][ 'nl2_score8'      ] = $val[ 'score8'   ];
			$tests[ $key ][ 'nl2_score9'      ] = $val[ 'score9'   ];
			$tests[ $key ][ 'nl2_score10'     ] = $val[ 'score10'  ];
			$tests[ $key ][ 'nl2_score11'     ] = $val[ 'score11'  ];
			$tests[ $key ][ 'nl2_score12'     ] = $val[ 'score12'  ];
			$tests[ $key ][ 'nl2_score13'     ] = $val[ 'score13'  ];
			$tests[ $key ][ 'nl2_score14'     ] = $val[ 'score14'  ];
			$tests[ $key ][ 'nl2_score15'     ] = $val[ 'score15'  ];
			$tests[ $key ][ 'nl2_score16'     ] = $val[ 'score16'  ];
			$tests[ $key ][ 'nl2_score17'     ] = $val[ 'score17'  ];
			$tests[ $key ][ 'nl2_score18'     ] = $val[ 'score18'  ];
			$tests[ $key ][ 'nl2_score19'     ] = $val[ 'score19'  ];
			
		}
	}

	$nl2flg = "on";
}

$IQflg = "";
if($typelist[11]){
	//IQ検査
	$paper[ 'customer_id' ] = $id;
	$paper[ 'partner_id'  ] = $ptid;
	$paper[ 'testgrp_id' ] = $sec;
	$paper[ 'type'       ] = 11;
	$order = "number";
	$iq = $obj->getIQData($paper,$order,$limit);
	if(count($iq)){
		foreach($iq as $key=>$val){
			
			if($val[ 'exam_state' ] == 1){
				$tests[ $key ][ 'xam_date' ] = mb_convert_encoding('受検中','EUC-JP','UTF-8');
			}else{
				//$tests[ $key ][ 'vf_exam_date' ] = $val[ 'exam_date' ];
				$ex = substr($val[ 'fin_exam_date' ],0,10);
				$fdate = preg_replace("/\-/","/",$ex);
				//if($fdate == "0000/00/00"){
					$fdate = $val[ 'exam_date' ];
				//}
				$tests[ $key ][ 'exam_date'  ] = $fdate;

			}
			$tests[ $key ][ 'language_score'     ] = $val[ 'language_score'  ];
			$tests[ $key ][ 'iq_math_score'      ] = $val[ 'math_score'  ];

			
		}
	}
	$IQflg = "on";
}

//////////////////////////////////////////////////////////////////////////
//テスト出力データ終わり
//////////////////////////////////////////////////////////////////////////

session_start();
$company_name = $_SESSION["_authsession"][ 'data' ][ 'name' ];

$test_name    =  $tdatlist[0][ 'name' ];



$sheet->getDefaultStyle()->getFont()->setSize(9.5);
//横幅の指定
$w1 = 14;
$w1_1 = 20;

$w2 = 30;
$w3 = 36;

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth($w1);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth($w1);

$sheet->getRowDimension( 5 )->setRowHeight( 50 );

$i=1;
$cell_style = array(   
	'borders' => array(   
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);
$cell_style2 = array(   
	'borders' => array(   
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);
$cell_style3 = array(   
	'borders' => array(   
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);

$cell_style4 = array(   
	'borders' => array(   
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style5 = array(   
	'borders' => array(   
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_DOTTED)
	)   
);
$cell_style6 = array(   
	'borders' => array(   
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_DOTTED),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_DOTTED)
	)   
);
$cell_style7 = array(   
	'borders' => array(   
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_DOTTED),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style8 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);

$cell_style9 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);

$cell_style10 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);
$cell_style11 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);
$cell_style12 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);

$cell_style13 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);
$cell_style14 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style15 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style16 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style17 = array(   
	'borders' => array(   
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_DOTTED)
	)   
);
$cell_style18 = array(   
	'borders' => array(   
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_DOTTED),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_DOTTED)
	)   
);

$cell_style19 = array(   
	'borders' => array(   
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style20 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);
$cell_style21 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);
$cell_style22 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);

$cell_style23 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_DOTTED)
	)   
);

$cell_style24 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);
$cell_style25 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style26 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style27 = array(   
	'borders' => array(
	'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);
$cell_style28 = array(   
	'borders' => array(
	'top'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);
$cell_style29 = array(   
	'borders' => array(
	'top'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);
$cell_style30 = array(   
	'borders' => array(
	'top'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style31 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);
$cell_style32 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'right'    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)   
);

$cell_style33 = array(   
	'borders' => array(
	'top'     => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);


$cell_style34 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)   
);

$cell_style35 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'   => array('style' => PHPExcel_Style_Border::BORDER_DOTTED)
	)   
);

$cell_style36 = array(   
	'borders' => array(
	'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
	'left'   => array('style' => PHPExcel_Style_Border::BORDER_DOTTED),
	'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)
);


$cell_style37 = array(   
	'borders' => array(
	'left'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)
);

$cell_style38 = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
		'left'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
		'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)

	)
);

$cell_style39 = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
		'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)

	)
);

$cell_style40 = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
		'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)
	)
);
$cell_style41 = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
		'left'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
	)
);

$cell_style42 = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)

	)
);
$cell_style43 = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
		,'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN)

	)
);
$cell_style43w = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
		,'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)

	)
);
$cell_style44 = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		,'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)

	)
);
$cell_style45 = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		,'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		,'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)

	)
);
$cell_style45w = array(   
	'borders' => array(
		'top'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		,'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		,'right'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)

	)
);

$cell_style46 = array(   
	'borders' => array(
		'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE)
		,'right'  => array('style' => PHPExcel_Style_Border::BORDER_THIN)

	)
);
$cell_style46w = array(   
	'borders' => array(
		'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE)
		,'right'  => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)

	)
);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$i, '会社名');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$i, $company_name);
$sheet->getStyle('B'.$i)->applyFromArray($cell_style);
$sheet->mergeCells('C'.$i.':F'.$i);
$sheet->getStyle('C'.$i.':F'.$i)->applyFromArray($cell_style);
// センター寄せ
$sheet->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
//色の設定
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');


$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('H'.$i, '検査名');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('I'.$i, $test_name);
$sheet->getStyle('H'.$i)->applyFromArray($cell_style);
$sheet->mergeCells('I'.$i.':M'.$i);
$sheet->getStyle('I'.$i.':M'.$i)->applyFromArray($cell_style);
$sheet->getStyle('H'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('I'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//色の設定
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('H'.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//フォントサイズ
$sheet->getDefaultStyle()->getFont()->setSize(10);
$i=3;
$i2=$i+1;
$i3=$i2+1;
//タイトル登録
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$i, '受検者ID');

$sheet->getStyle('B'.$i)->applyFromArray($cell_style2);
$sheet->getStyle('B'.$i2)->applyFromArray($cell_style2);
$sheet->getStyle('B'.$i3)->applyFromArray($cell_style2);

$sheet->mergeCells('B'.$i.':B'.$i3);
// センター寄せ
$sheet->getStyle('B'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle('B'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('B'.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//タイトル登録
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('C'.$i, '受検ステータス');

$sheet->getStyle('C'.$i)->applyFromArray($cell_style3);
$sheet->getStyle('C'.$i2)->applyFromArray($cell_style3);
$sheet->getStyle('C'.$i3)->applyFromArray($cell_style3);

$sheet->mergeCells('C'.$i.':C'.$i3);
// センター寄せ
$sheet->getStyle('C'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle('C'.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('C'.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//タイトル登録
$key = "D";
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($key.$i, '受検者氏名');

$sheet->getStyle($key.$i)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i2)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i3)->applyFromArray($cell_style3);

$sheet->mergeCells($key.$i.':'.$key.$i3);
// センター寄せ
$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//タイトル登録
$key = "E";
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($key.$i, 'ふりがな');

$sheet->getStyle($key.$i)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i2)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i3)->applyFromArray($cell_style3);

$sheet->mergeCells($key.$i.':'.$key.$i3);
// センター寄せ
$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//タイトル登録
$key = "F";
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($key.$i, '生年月日');

$sheet->getStyle($key.$i)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i2)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i3)->applyFromArray($cell_style3);

$sheet->mergeCells($key.$i.':'.$key.$i3);
// センター寄せ
$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//タイトル登録
$key = "G";
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, '年齢');

$sheet->getStyle($key.$i)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i2)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i3)->applyFromArray($cell_style3);

$sheet->mergeCells($key.$i.':'.$key.$i3);
// センター寄せ
$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//タイトル登録
$key = "H";
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($key.$i, '受検日');

$sheet->getStyle($key.$i)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i2)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i3)->applyFromArray($cell_style3);

$sheet->mergeCells($key.$i.':'.$key.$i3);
// センター寄せ
$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');


//タイトル登録
$key = "I";
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($key.$i, '合否');

$sheet->getStyle($key.$i)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i2)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i3)->applyFromArray($cell_style3);

$sheet->mergeCells($key.$i.':'.$key.$i3);
// センター寄せ
$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');


//タイトル登録
$key = "J";
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($key.$i, 'メモ１');

$sheet->getStyle($key.$i)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i2)->applyFromArray($cell_style3);
$sheet->getStyle($key.$i3)->applyFromArray($cell_style3);

$sheet->mergeCells($key.$i.':'.$key.$i3);
// センター寄せ
$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//タイトル登録
$key = "K";
$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, 'メモ２');

$sheet->getStyle($key.$i)->applyFromArray($cell_style4);
$sheet->getStyle($key.$i2)->applyFromArray($cell_style4);
$sheet->getStyle($key.$i3)->applyFromArray($cell_style4);

$sheet->mergeCells($key.$i.':'.$key.$i3);
// センター寄せ
$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
//縦方向
$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
//色の設定
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

//アルファベットの変動値の設定
$al = 10;
//------------------------------------------------------------------------------
//IQタイトルデータ表示
//------------------------------------------------------------------------------
if($IQflg){
	//タイトル登録
	$al++;
	$key = $a_alpha[$al];
	$al++;
	$key2 = $a_alpha[$al];
	$al++;
	$key3 = $a_alpha[$al];
	$al++;
	$key4 = $a_alpha[$al];
	$al++;
	$key5 = $a_alpha[$al];
	$al++;
	$key6 = $a_alpha[$al];

	$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key2)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key3)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key4)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key5)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key6)->setWidth($w1);


	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, '知的能力総合');
	$sheet->mergeCells($key.$i.':'.$key2.$i);
	// センター寄せ
	$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->mergeCells($key.$i.':'.$key.$i2);
	$sheet->mergeCells($key.$i.':'.$key2.$i);
	//縦方向
	$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	
	
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i3, 'レベル');
	// センター寄せ
	$sheet->getStyle($key.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key2.$i3, 'スコア');
	// センター寄せ
	$sheet->getStyle($key2.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key2.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i2, '言語・論理');
	$sheet->mergeCells($key3.$i2.':'.$key4.$i2);
	
	$arrayfont = array('font'=> array('bold'=> true ));
	$sheet->getStyle($key3.$i2)->applyFromArray($arrayfont);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i3, 'レベル');
	$sheet->getStyle($key3.$i3)->applyFromArray($arrayfont);
	// センター寄せ
	$sheet->getStyle($key3.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');

	$sheet->getStyle($key4.$i3)->applyFromArray($arrayfont);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i3, 'スコア');
	$sheet->getStyle($key4.$i3)->applyFromArray($arrayfont);
	// センター寄せ
	$sheet->getStyle($key4.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key4.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');

	// センター寄せ
	$sheet->getStyle($key3.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key3.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i2, '数理・推論');
	$sheet->mergeCells($key5.$i2.':'.$key6.$i2);
	// センター寄せ
	$sheet->getStyle($key5.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key5.$i2)->applyFromArray($arrayfont);


	$sheet->getStyle($key5.$i2)->applyFromArray($arrayfont);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i3, 'レベル');
	$sheet->getStyle($key5.$i3)->applyFromArray($arrayfont);
	// センター寄せ
	$sheet->getStyle($key5.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key5.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');

	$sheet->getStyle($key6.$i3)->applyFromArray($arrayfont);
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i3, 'スコア');
	$sheet->getStyle($key6.$i3)->applyFromArray($arrayfont);
	// センター寄せ
	$sheet->getStyle($key6.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key6.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');


	
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

	
	
	$sheet->getStyle($key.$i)->applyFromArray($cell_style8);
	$sheet->getStyle($key.$i2)->applyFromArray($cell_style8);
	$sheet->getStyle($key.$i3)->applyFromArray($cell_style9);
	$sheet->getStyle($key2.$i)->applyFromArray($cell_style10);
	$sheet->getStyle($key2.$i2)->applyFromArray($cell_style11);
	$sheet->getStyle($key2.$i3)->applyFromArray($cell_style12);
	$sheet->getStyle($key3.$i3)->applyFromArray($cell_style12);
	$sheet->getStyle($key3.$i)->applyFromArray($cell_style10);
	$sheet->getStyle($key4.$i)->applyFromArray($cell_style10);
	$sheet->getStyle($key5.$i)->applyFromArray($cell_style10);
	$sheet->getStyle($key6.$i)->applyFromArray($cell_style14);
	$sheet->getStyle($key3.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key4.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key4.$i3)->applyFromArray($cell_style12);
	$sheet->getStyle($key5.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key5.$i3)->applyFromArray($cell_style12);
	$sheet->getStyle($key6.$i2)->applyFromArray($cell_style15);
	$sheet->getStyle($key6.$i3)->applyFromArray($cell_style16);
}
//------------------------------------------------------------------------------
//IQタイトルデータ表示終わり
//------------------------------------------------------------------------------



//------------------------------------------------------------------------------
//行動価値タイトルデータ表示
//------------------------------------------------------------------------------
if($delAction){
	if($weight){
		//重みつけがある時
		$al++;
		$key = $a_alpha[$al];
		$al++;
		$key2 = $a_alpha[$al];
		$al++;
		$key3 = $a_alpha[$al];
		$al++;
		$key4 = $a_alpha[$al];
		$al++;
		$key5 = $a_alpha[$al];
		$al++;
		$key6 = $a_alpha[$al];
		$al++;
		$key7 = $a_alpha[$al];
		$al++;
		$key8 = $a_alpha[$al];
		$al++;
		$key9 = $a_alpha[$al];
		$al++;
		$key10 = $a_alpha[$al];
		$al++;
		$key11 = $a_alpha[$al];
		$al++;
		$key12 = $a_alpha[$al];
		$al++;
		$key13 = $a_alpha[$al];
		$al++;
		$key14 = $a_alpha[$al];
		$al++;
		$key15 = $a_alpha[$al];
		$al++;
		$key16 = $a_alpha[$al];
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, '行動価値');
		$sheet->mergeCells($key.$i.':'.$key16.$i);
		// センター寄せ
		$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

		$sheet->getStyle($key.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key2.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key3.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key4.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key5.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key6.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key7.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key8.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key9.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key10.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key11.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key12.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key13.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key14.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key15.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key16.$i)->applyFromArray($cell_style21);


		$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($w1);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key2)->setWidth($w1);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i2, 'ストレス共生');
		$sheet->mergeCells($key.$i2.':'.$key2.$i2);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');
		$sheet->getStyle($key.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i3, 'レベル');
		// センター寄せ
		$sheet->getStyle($key.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//縦方向
		$sheet->getStyle($key.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key2.$i3, 'スコア');
		// センター寄せ
		$sheet->getStyle($key2.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//縦方向
		$sheet->getStyle($key2.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

		$sheet->getStyle($key.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key2.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key.$i3)->applyFromArray($cell_style22);
		$sheet->getStyle($key2.$i3)->applyFromArray($cell_style22);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i2, '適合レベル');
		$sheet->mergeCells($key3.$i2.':'.$key3.$i3);
		// センター寄せ
		$sheet->getStyle($key3.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//縦方向
		$sheet->getStyle($key3.$i2)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle($key3.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key3.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');
		$objPHPExcel->getActiveSheet()->getColumnDimension($key3)->setWidth($w1);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i2, '適合スコア');
		$sheet->mergeCells($key4.$i2.':'.$key4.$i3);
		// センター寄せ
		$sheet->getStyle($key4.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//縦方向
		$sheet->getStyle($key4.$i2)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle($key4.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key4.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');
		$objPHPExcel->getActiveSheet()->getColumnDimension($key4)->setWidth($w1);
		
		$sheet->getStyle($key3.$i2)->applyFromArray($cell_style22);
		$sheet->getStyle($key3.$i3)->applyFromArray($cell_style22);
		$sheet->getStyle($key4.$i2)->applyFromArray($cell_style22);
		$sheet->getStyle($key4.$i3)->applyFromArray($cell_style22);
		
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i2, '自分を適切に認識できているか');
		$sheet->mergeCells($key5.$i2.':'.$key7.$i2);
		// センター寄せ
		$sheet->getStyle($key5.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key5.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key5.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		$sheet->getStyle($key5.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key6.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key7.$i2)->applyFromArray($cell_style13);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i3, $element_msg);
		// センター寄せ
		$sheet->getStyle($key5.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key5.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w1' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key5.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key5.$i3)->applyFromArray($arrayfont);

		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key5.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i3, $cus_msg);
		// センター寄せ
		$sheet->getStyle($key6.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key6.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w2' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key6.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key6.$i3)->applyFromArray($arrayfont);

		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key6.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key7.$i3, $e_aff);
		// センター寄せ
		$sheet->getStyle($key7.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key7.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w3' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key7.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key7.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key7.$i3)->applyFromArray($cell_style22);


		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key8.$i2, '自分の感情をコントロールしているか');
		$sheet->mergeCells($key8.$i2.':'.$key10.$i2);
		// センター寄せ
		$sheet->getStyle($key8.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key8.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key8.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		$sheet->getStyle($key8.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key9.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key10.$i2)->applyFromArray($cell_style13);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key8.$i3, $e_cntl);
		// センター寄せ
		$sheet->getStyle($key8.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key8.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w4' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key8.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key8.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key8.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key9.$i3, $e_vi);
		// センター寄せ
		$sheet->getStyle($key9.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key9.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w5' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key9.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key9.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key9.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key10.$i3, $e_pos);
		// センター寄せ
		$sheet->getStyle($key10.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key10.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w6' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key10.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key10.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key10.$i3)->applyFromArray($cell_style22);



		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key11.$i2, '相手の状況を適切に認識できているか');
		$sheet->mergeCells($key11.$i2.':'.$key13.$i2);
		// センター寄せ
		$sheet->getStyle($key11.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key11.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key11.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		$sheet->getStyle($key11.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key12.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key13.$i2)->applyFromArray($cell_style13);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key11.$i3, $e_symp);
		// センター寄せ
		$sheet->getStyle($key11.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key11.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w7' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key11.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key11.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key11.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key12.$i3, $e_situ);
		// センター寄せ
		$sheet->getStyle($key12.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key12.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w8' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key12.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key12.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key12.$i3)->applyFromArray($cell_style22);

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key13.$i3, $e_hosp);
		// センター寄せ
		$sheet->getStyle($key13.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key13.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w9' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key13.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key13.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key13.$i3)->applyFromArray($cell_style22);



		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key14.$i2, '相手に適切に働きかけているか');
		$sheet->mergeCells($key14.$i2.':'.$key16.$i2);
		// センター寄せ
		$sheet->getStyle($key14.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key14.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key14.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		$sheet->getStyle($key14.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key15.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key16.$i2)->applyFromArray($cell_style19);

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key14.$i3, $e_lead);
		// センター寄せ
		$sheet->getStyle($key14.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key14.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w10' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key14.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key14.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key14.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key15.$i3, $e_ass);
		// センター寄せ
		$sheet->getStyle($key15.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key15.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w11' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key15.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key15.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key15.$i3)->applyFromArray($cell_style22);

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key16.$i3, $e_adap);
		// センター寄せ
		$sheet->getStyle($key16.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key16.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w12' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key16.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key16.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key16.$i3)->applyFromArray($cell_style16);



		$objPHPExcel->getActiveSheet()->getColumnDimension($key5)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key6)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key7)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key8)->setWidth($w3);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key9)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key10)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key11)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key12)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key13)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key14)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key15)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key16)->setWidth($w3);
		
		
	}else{
		//重みつけがない時
		$al++;
		$key = $a_alpha[$al];
		$al++;
		$key2 = $a_alpha[$al];
		$al++;
		$key3 = $a_alpha[$al];
		$al++;
		$key4 = $a_alpha[$al];
		$al++;
		$key5 = $a_alpha[$al];
		$al++;
		$key6 = $a_alpha[$al];
		$al++;
		$key7 = $a_alpha[$al];
		$al++;
		$key8 = $a_alpha[$al];
		$al++;
		$key9 = $a_alpha[$al];
		$al++;
		$key10 = $a_alpha[$al];
		$al++;
		$key11 = $a_alpha[$al];
		$al++;
		$key12 = $a_alpha[$al];
		$al++;
		$key13 = $a_alpha[$al];
		$al++;
		$key14 = $a_alpha[$al];
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, '行動価値');
		$sheet->mergeCells($key.$i.':'.$key14.$i);
		// センター寄せ
		$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

		$sheet->getStyle($key.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key2.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key3.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key4.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key5.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key6.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key7.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key8.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key9.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key10.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key11.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key12.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key13.$i)->applyFromArray($cell_style20);
		$sheet->getStyle($key14.$i)->applyFromArray($cell_style21);

		
		$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($w1);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key2)->setWidth($w1);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i2, 'ストレス共生');
		$sheet->mergeCells($key.$i2.':'.$key2.$i2);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');
		$sheet->getStyle($key.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i3, 'レベル');
		// センター寄せ
		$sheet->getStyle($key.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//縦方向
		$sheet->getStyle($key.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key2.$i3, 'スコア');
		// センター寄せ
		$sheet->getStyle($key2.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//縦方向
		$sheet->getStyle($key2.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
		$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
		$sheet->getStyle($key.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key2.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key.$i3)->applyFromArray($cell_style22);
		$sheet->getStyle($key2.$i3)->applyFromArray($cell_style22);

		

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i2, '自分を適切に認識できているか');
		$sheet->mergeCells($key3.$i2.':'.$key5.$i2);
		// センター寄せ
		$sheet->getStyle($key3.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key3.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key3.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		$sheet->getStyle($key3.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key4.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key5.$i2)->applyFromArray($cell_style13);
		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i3, $element_msg);
		// センター寄せ
		$sheet->getStyle($key3.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key3.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w1' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key3.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key3.$i3)->applyFromArray($arrayfont);

		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key3.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i3, $cus_msg);
		// センター寄せ
		$sheet->getStyle($key4.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key4.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w2' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key4.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key4.$i3)->applyFromArray($arrayfont);

		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key4.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i3, $e_aff);
		// センター寄せ
		$sheet->getStyle($key5.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key5.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w3' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key5.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key5.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key5.$i3)->applyFromArray($cell_style22);

		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i2, '自分の感情をコントロールしているか');
		$sheet->mergeCells($key6.$i2.':'.$key8.$i2);
		// センター寄せ
		$sheet->getStyle($key6.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key6.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key6.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		$sheet->getStyle($key6.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key7.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key8.$i2)->applyFromArray($cell_style13);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i3, $e_cntl);
		// センター寄せ
		$sheet->getStyle($key6.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key6.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w4' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key6.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key6.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key6.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key7.$i3, $e_vi);
		// センター寄せ
		$sheet->getStyle($key7.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key7.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w5' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key7.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key7.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key7.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key8.$i3, $e_pos);
		// センター寄せ
		$sheet->getStyle($key8.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key8.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w6' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key8.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key8.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key8.$i3)->applyFromArray($cell_style22);



		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key9.$i2, '相手の状況を適切に認識できているか');
		$sheet->mergeCells($key9.$i2.':'.$key11.$i2);
		// センター寄せ
		$sheet->getStyle($key9.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key9.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key9.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		$sheet->getStyle($key9.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key10.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key11.$i2)->applyFromArray($cell_style13);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key9.$i3, $e_symp);
		// センター寄せ
		$sheet->getStyle($key9.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key9.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w7' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key9.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key9.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key9.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key10.$i3, $e_situ);
		// センター寄せ
		$sheet->getStyle($key10.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key10.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w8' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key10.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key10.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key10.$i3)->applyFromArray($cell_style22);

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key11.$i3, $e_hosp);
		// センター寄せ
		$sheet->getStyle($key11.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key11.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w9' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key11.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key11.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key11.$i3)->applyFromArray($cell_style22);



		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key12.$i2, '相手に適切に働きかけているか');
		$sheet->mergeCells($key12.$i2.':'.$key14.$i2);
		// センター寄せ
		$sheet->getStyle($key12.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//色の設定
		$objPHPExcel->getActiveSheet()->getStyle($key12.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($key12.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		$sheet->getStyle($key12.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key13.$i2)->applyFromArray($cell_style13);
		$sheet->getStyle($key14.$i2)->applyFromArray($cell_style19);

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key12.$i3, $e_lead);
		// センター寄せ
		$sheet->getStyle($key12.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key12.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w10' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key12.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key12.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key12.$i3)->applyFromArray($cell_style22);


		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key13.$i3, $e_ass);
		// センター寄せ
		$sheet->getStyle($key13.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key13.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w11' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key13.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key13.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key13.$i3)->applyFromArray($cell_style22);

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key14.$i3, $e_adap);
		// センター寄せ
		$sheet->getStyle($key14.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$sheet->getStyle($key14.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//自動改行
		$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		if($tdat[0][ 'w12' ]){
			$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->getStartColor()->setARGB('FF0000ff');
			//文字色
			$sheet->getStyle($key14.$i3)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
			$arrayfont = array('font'=> array('bold'=> true ));
			$sheet->getStyle($key14.$i3)->applyFromArray($arrayfont);
		}else{
			$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
		}
		$sheet->getStyle($key14.$i3)->applyFromArray($cell_style16);



		$objPHPExcel->getActiveSheet()->getColumnDimension($key3)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key4)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key5)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key6)->setWidth($w3);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key7)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key8)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key9)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key10)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key11)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key12)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key13)->setWidth($w2);
		$objPHPExcel->getActiveSheet()->getColumnDimension($key14)->setWidth($w3);

		
	}
}
//------------------------------------------------------------------------------
//行動価値タイトルデータ表示終わり
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
//Welcome(FS)タイトルデータ表示
//------------------------------------------------------------------------------
if($delFS){
	$al++;
	$key = $a_alpha[$al];
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, 'WelcomeFS');
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i2, '総合得点');
	$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($w1);
	$sheet->mergeCells($key.$i2.':'.$key.$i3);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key.$i2)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
	$sheet->getStyle($key.$i)->applyFromArray($cell_style24);
	$sheet->getStyle($key.$i2)->applyFromArray($cell_style25);
	$sheet->getStyle($key.$i3)->applyFromArray($cell_style25);
	
	
}
//------------------------------------------------------------------------------
//Welcome(FS)タイトルデータ表示終了
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
//採用基準タイトルデータ表示
//------------------------------------------------------------------------------
if($delVF){
	$al++;
	$key = $a_alpha[$al];
	$al++;
	$key2 = $a_alpha[$al];
	$al++;
	$key3 = $a_alpha[$al];
	$al++;
	$key4 = $a_alpha[$al];
	$al++;
	$key5 = $a_alpha[$al];
	$al++;
	$key6 = $a_alpha[$al];
	$al++;
	$key7 = $a_alpha[$al];
	$al++;
	$key8 = $a_alpha[$al];
	$al++;
	$key9 = $a_alpha[$al];
	$al++;
	$key10 = $a_alpha[$al];
	$al++;
	$key11 = $a_alpha[$al];
	$al++;
	$key12 = $a_alpha[$al];
	
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, '採用基準');
	$sheet->mergeCells($key.$i.':'.$key12.$i);
	$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$sheet->getStyle($key.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key2.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key3.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key4.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key5.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key6.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key7.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key8.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key9.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key10.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key11.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key12.$i)->applyFromArray($cell_style21);

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i2, '自分を適切に認識できているか');
	$sheet->mergeCells($key.$i2.':'.$key3.$i2);
	$sheet->getStyle($key.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key2.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key3.$i2)->applyFromArray($cell_style13);
	
	$msg1 = "自己感情モニタリング力\n自分の感情を認識できるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i3,$msg1);

	$sheet->getStyle($key.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key.$i3)->applyFromArray($cell_style22);

	$msg2 = "客観的自己評価力\n自分を客観的に評価できるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key2.$i3,$msg2);

	$sheet->getStyle($key2.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key2.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key2.$i3)->applyFromArray($cell_style22);


	$msg2 = "自己肯定力\n自分を価値ある存在として評価できるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i3,$msg2);
	$sheet->getStyle($key3.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key3.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key3.$i3)->applyFromArray($cell_style22);



	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i2, '自分の感情をコントロールしているか');
	$sheet->mergeCells($key4.$i2.':'.$key6.$i2);
	$sheet->getStyle($key4.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key4.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key5.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key6.$i2)->applyFromArray($cell_style13);


	$msg2 = "コントロール＆\nアチーブメント力\n自己をコントロールし、目標を達成できるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i3,$msg2);
	$sheet->getStyle($key4.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key4.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key4.$i3)->applyFromArray($cell_style22);


	$msg2 = "ビジョン創出力\n達成するべき目標を設定することができるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i3,$msg2);
	$sheet->getStyle($key5.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key5.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key5.$i3)->applyFromArray($cell_style22);


	$msg2 = "ポジティブ思考力\n周囲の状況を柔軟に捉え、適応できるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i3,$msg2);
	$sheet->getStyle($key6.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key6.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key6.$i3)->applyFromArray($cell_style22);




	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key7.$i2, '相手の状況を適切に認識できているか');
	$sheet->mergeCells($key7.$i2.':'.$key9.$i2);
	$sheet->getStyle($key7.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key7.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key8.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key9.$i2)->applyFromArray($cell_style13);

	$msg2 = "対人共感力\n相手に共感できるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key7.$i3,$msg2);
	$sheet->getStyle($key7.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key7.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key7.$i3)->applyFromArray($cell_style22);

	$msg2 = "状況察知力\n職場の雰囲気を読み取ることができるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key8.$i3,$msg2);
	$sheet->getStyle($key8.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key8.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key8.$i3)->applyFromArray($cell_style22);


	$msg2 = "ホスピタリティ発揮力\n相手のして欲しいことを積極的にできるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key9.$i3,$msg2);
	$sheet->getStyle($key9.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key9.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key9.$i3)->applyFromArray($cell_style22);


	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key10.$i2, '相手に適切に働きかけているか');
	$sheet->mergeCells($key10.$i2.':'.$key12.$i2);
	$sheet->getStyle($key10.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i2)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key10.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key11.$i2)->applyFromArray($cell_style13);
	$sheet->getStyle($key12.$i2)->applyFromArray($cell_style19);


	$msg2 = "リーダーシップ発揮力\n集団を目標達成するために積極的に行動できるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key10.$i3,$msg2);
	$sheet->getStyle($key10.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key10.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key10.$i3)->applyFromArray($cell_style22);

	$msg2 = "アサーション発揮力\n相手のことを考慮しながら自分の考えを主張できるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key11.$i3,$msg2);
	$sheet->getStyle($key11.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key11.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key11.$i3)->applyFromArray($cell_style22);

	$msg2 = "集団適応力\n人に興味があり、仲間との良好な関係を保つことができるか";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key12.$i3,$msg2);
	$sheet->getStyle($key12.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key12.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key12.$i3)->applyFromArray($cell_style16);





	$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key2)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key3)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key4)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key5)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key6)->setWidth($w3);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key7)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key8)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key9)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key10)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key11)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key12)->setWidth($w2);

}
//------------------------------------------------------------------------------
//採用基準タイトルデータ表示終了
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
//感情能力タイトルデータ表示
//------------------------------------------------------------------------------
if($delDP){
	$al++;
	$key = $a_alpha[$al];
	$al++;
	$key2 = $a_alpha[$al];
	$al++;
	$key3 = $a_alpha[$al];
	$al++;
	$key4 = $a_alpha[$al];
	$al++;
	$key5 = $a_alpha[$al];
	$al++;
	$key6 = $a_alpha[$al];
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, '感情能力');
	$sheet->mergeCells($key.$i.':'.$key5.$i);
	$sheet->mergeCells($key.$i.':'.$key5.$i2);

	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i, '情報の捉え方');
	$sheet->mergeCells($key6.$i.':'.$key6.$i3);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key6.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key6.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);



	$sheet->getStyle($key.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key2.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key3.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key4.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key5.$i)->applyFromArray($cell_style28);
	$sheet->getStyle($key6.$i)->applyFromArray($cell_style29);
	$sheet->getStyle($key6.$i2)->applyFromArray($cell_style29);
	
	$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key2)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key3)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key4)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key5)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key6)->setWidth($w1);


	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i3, '総合');
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
	
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key2.$i3, '読み取り力');
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key2.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key2.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i3, '理解力');
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key3.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key3.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i3, '選択力');
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key4.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key4.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i3, '切り替え力');
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->getStyle($key5.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->getStyle($key5.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);



	$sheet->getStyle($key.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key2.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key3.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key4.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key5.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key6.$i3)->applyFromArray($cell_style30);


}
//------------------------------------------------------------------------------
//感情能力タイトルデータ表示終了
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
//行動意識タイトルデータ表示
//------------------------------------------------------------------------------
if($delMV){
	$al++;
	$key = $a_alpha[$al];
	$al++;
	$key2 = $a_alpha[$al];
	$al++;
	$key3 = $a_alpha[$al];
	$al++;
	$key4 = $a_alpha[$al];
	$al++;
	$key5 = $a_alpha[$al];
	$al++;
	$key6 = $a_alpha[$al];
	$al++;
	$key7 = $a_alpha[$al];
	$al++;
	$key8 = $a_alpha[$al];
	$al++;
	$key9 = $a_alpha[$al];
	$al++;
	$key10 = $a_alpha[$al];
	$al++;
	$key11 = $a_alpha[$al];
	$al++;
	$key12 = $a_alpha[$al];
	$al++;
	$key13 = $a_alpha[$al];
	$al++;
	$key14 = $a_alpha[$al];
	$al++;
	$key15 = $a_alpha[$al];
	$al++;
	$key16 = $a_alpha[$al];
	$al++;
	$key17 = $a_alpha[$al];
	$al++;
	$key18 = $a_alpha[$al];
	$al++;
	$key19 = $a_alpha[$al];
	$al++;
	$key20 = $a_alpha[$al];
	$al++;
	$key21 = $a_alpha[$al];
	$al++;
	$key22 = $a_alpha[$al];
	$al++;
	$key23 = $a_alpha[$al];
	$al++;
	$key24 = $a_alpha[$al];
	$al++;
	$key25 = $a_alpha[$al];
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, '行動意識24素養');
	$sheet->mergeCells($key.$i.':'.$key24.$i2);
	$sheet->mergeCells($key.$i.':'.$key24.$i);
	$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	
	$msgm = "私的\n自意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "社会的\n自意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key2.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key2.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key2.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "割り切り\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key3.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key3.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "踏み出し\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key4.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key4.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "自己ｺﾝﾄﾛｰﾙ\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key5.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key5.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "難局対応\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key6.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key6.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "精神安定\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key7.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key7.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key7.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "自己肯定\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key8.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key8.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key8.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "達成\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key9.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key9.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key9.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "充実\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key10.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key10.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key10.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "楽観\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key11.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key11.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key11.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "感情表出\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key12.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key12.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key12.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');


	$msgm = "ﾉﾝﾊﾞｰﾊﾞﾙ\n表現意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key13.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key13.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key13.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "自主独立\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key14.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key14.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key14.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "対人共存\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key15.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key15.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key15.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "自己主張\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key16.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key16.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key16.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');


	$msgm = "対人問題\n解決意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key17.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key17.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key17.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key17.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key17.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key17.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "対人関係\n構築意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key18.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key18.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key18.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key18.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key18.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key18.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "他己開示\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key19.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key19.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key19.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key19.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key19.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key19.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "感情察知\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key20.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key20.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key20.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key20.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key20.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key20.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');


	$msgm = "状況察知\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key21.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key21.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key21.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key21.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key21.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key21.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');


	$msgm = "対人ｻﾎﾟｰﾄ\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key22.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key22.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key22.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key22.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key22.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key22.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "他者感情\n同調意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key23.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key23.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key23.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key23.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key23.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key23.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$msgm = "共感的理解\n意識";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key24.$i3, $msgm);
	$objPHPExcel->getActiveSheet()->getStyle($key24.$i3)->getAlignment()->setWrapText(true);
	$sheet->getStyle($key24.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key24.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key24.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key24.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');
	
	$msgm = "応答態度";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key25.$i, $msgm);
	$sheet->getStyle($key25.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
	$sheet->getStyle($key25.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	$objPHPExcel->getActiveSheet()->getStyle($key25.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key25.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	$sheet->mergeCells($key25.$i.':'.$key25.$i3);

	
	
	$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key2)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key3)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key4)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key5)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key6)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key7)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key8)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key9)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key10)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key11)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key12)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key13)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key14)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key15)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key16)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key17)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key18)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key19)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key20)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key21)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key22)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key23)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key24)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key25)->setWidth($w1);

	
	$sheet->getStyle($key.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key2.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key3.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key4.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key5.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key6.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key7.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key8.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key9.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key10.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key11.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key12.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key13.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key14.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key15.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key16.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key17.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key18.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key19.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key20.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key21.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key22.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key23.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key24.$i)->applyFromArray($cell_style20);
	$sheet->getStyle($key24.$i)->applyFromArray($cell_style32);
	$sheet->getStyle($key24.$i2)->applyFromArray($cell_style32);
	$sheet->getStyle($key.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key2.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key3.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key4.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key5.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key6.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key7.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key8.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key9.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key10.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key11.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key12.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key13.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key14.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key15.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key16.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key17.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key18.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key19.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key20.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key21.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key22.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key23.$i3)->applyFromArray($cell_style27);
	$sheet->getStyle($key24.$i3)->applyFromArray($cell_style31);
	
	$sheet->getStyle($key25.$i)->applyFromArray($cell_style33);
	$sheet->getStyle($key25.$i2)->applyFromArray($cell_style33);
	$sheet->getStyle($key25.$i3)->applyFromArray($cell_style30);
}

//------------------------------------------------------------------------------
//行動意識タイトルデータ表示終了
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
//数学タイトルデータ表示
//------------------------------------------------------------------------------
if($math){
	$al++;
	$key = $a_alpha[$al];
	$al++;
	$key2 = $a_alpha[$al];
	$al++;
	$key3 = $a_alpha[$al];
	$al++;
	$key4 = $a_alpha[$al];
	$al++;
	$key5 = $a_alpha[$al];
	$al++;
	$key6 = $a_alpha[$al];
	$al++;
	$key7 = $a_alpha[$al];
	

	$objPHPExcel->getActiveSheet()->getColumnDimension($key3)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key4)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key5)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key6)->setWidth($w2);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key7)->setWidth($w2);

	$msg = "数学力\n総合";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, $msg);
	$sheet->mergeCells($key.$i.':'.$key2.$i2);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getAlignment()->setWrapText(true);

	// センター寄せ
	$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$sheet->mergeCells($key.$i.':'.$key2.$i2);
	//縦方向
	$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	
	
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i3, 'レベル');
	$sheet->getStyle($key.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key2.$i3, 'スコア');
	$sheet->getStyle($key2.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key2.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->getStartColor()->setARGB('FFc0ffff');

	

	$msg = "数学力(分野別)";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i, $msg);
	$sheet->mergeCells($key3.$i.':'.$key7.$i2);
	$sheet->getStyle($key3.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key3.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');



	$msg = "把握力\nデータやグラフの意味を的確に把握する力";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i3, $msg);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getAlignment()->setWrapText(true);

	$sheet->getStyle($key3.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key3.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');

	$msg = "分析力\nデータを的確に加工して使える情報にする力";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i3, $msg);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getAlignment()->setWrapText(true);

	$sheet->getStyle($key4.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key4.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');


	$msg = "選択力\n数理的な根拠をもとに最適な選択肢を選ぶ力";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i3, $msg);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getAlignment()->setWrapText(true);

	$sheet->getStyle($key5.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key5.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');


	$msg = "予測力\n数理的なデータをもとに事業の将来を見抜く力";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i3, $msg);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getAlignment()->setWrapText(true);

	$sheet->getStyle($key6.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key6.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');


	$msg = "表現力\n情報をわかりやすく表現し相手に的確に伝える力";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key7.$i3, $msg);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getAlignment()->setWrapText(true);

	$sheet->getStyle($key7.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key7.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');



	$sheet->getStyle($key.$i)->applyFromArray($cell_style8);
	$sheet->getStyle($key2.$i)->applyFromArray($cell_style8);
	$sheet->getStyle($key.$i2)->applyFromArray($cell_style8);
	$sheet->getStyle($key2.$i2)->applyFromArray($cell_style8);
	$sheet->getStyle($key.$i3)->applyFromArray($cell_style38);
	$sheet->getStyle($key2.$i3)->applyFromArray($cell_style39);
	
	$sheet->getStyle($key3.$i)->applyFromArray($cell_style10);
	$sheet->getStyle($key4.$i)->applyFromArray($cell_style10);
	$sheet->getStyle($key5.$i)->applyFromArray($cell_style10);
	$sheet->getStyle($key6.$i)->applyFromArray($cell_style10);
	$sheet->getStyle($key7.$i)->applyFromArray($cell_style14);
	$sheet->getStyle($key7.$i2)->applyFromArray($cell_style14);
	$sheet->getStyle($key3.$i3)->applyFromArray($cell_style40);
	$sheet->getStyle($key4.$i3)->applyFromArray($cell_style40);
	$sheet->getStyle($key5.$i3)->applyFromArray($cell_style40);
	$sheet->getStyle($key6.$i3)->applyFromArray($cell_style40);
	$sheet->getStyle($key7.$i3)->applyFromArray($cell_style41);

	
	
	
}
//------------------------------------------------------------------------------
//数学タイトルデータ表示終了
//------------------------------------------------------------------------------

//------------------------------------------------------------------------------
//NL2タイトルデータ表示
//------------------------------------------------------------------------------
if($nl2flg){
	$al++;
	$key = $a_alpha[$al];
	$al++;
	$key2 = $a_alpha[$al];
	$al++;
	$key3 = $a_alpha[$al];
	$al++;
	$key4 = $a_alpha[$al];
	$al++;
	$key5 = $a_alpha[$al];
	$al++;
	$key6 = $a_alpha[$al];
	$al++;
	$key7 = $a_alpha[$al];
	$al++;
	$key8 = $a_alpha[$al];
	$al++;
	$key9 = $a_alpha[$al];
	$al++;
	$key10 = $a_alpha[$al];
	$al++;
	$key11 = $a_alpha[$al];
	$al++;
	$key12 = $a_alpha[$al];
	$al++;
	$key13 = $a_alpha[$al];
	$al++;
	$key14 = $a_alpha[$al];
	$al++;
	$key15 = $a_alpha[$al];
	$al++;
	$key16 = $a_alpha[$al];
	$al++;
	$key17 = $a_alpha[$al];
	$al++;
	$key18 = $a_alpha[$al];
	$al++;
	$key19 = $a_alpha[$al];
	$objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key2)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key3)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key4)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key5)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key6)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key7)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key8)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key9)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key10)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key11)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key12)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key13)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key14)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key15)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key16)->setWidth($w1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key17)->setWidth($w1_1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key18)->setWidth($w1_1);
	$objPHPExcel->getActiveSheet()->getColumnDimension($key19)->setWidth($w1);

	$msg = "NL検査結果：目標・モチベーション";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i, $msg);
	$sheet->mergeCells($key.$i.':'.$key8.$i);
	// センター寄せ
	$sheet->getStyle($key.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	
	$sheet->getStyle($key.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key2.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key3.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key4.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key5.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key6.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key7.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key8.$i)->applyFromArray($cell_style43);
	
	$msg = "NL検査結果：組織環境";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key9.$i, $msg);
	$sheet->mergeCells($key9.$i.':'.$key19.$i);
	// センター寄せ
	$sheet->getStyle($key9.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key9.$i)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i)->getFill()->getStartColor()->setARGB('FFc0ffff');
	
	$sheet->getStyle($key9.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key10.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key11.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key12.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key13.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key14.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key15.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key16.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key17.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key18.$i)->applyFromArray($cell_style42);
	$sheet->getStyle($key19.$i)->applyFromArray($cell_style43w);

	
	//２行目
	$msg = "意識のスケール";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i2, $msg);
	$sheet->mergeCells($key.$i2.':'.$key2.$i2);
	// センター寄せ
	$sheet->getStyle($key.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key2.$i2)->applyFromArray($cell_style45);
	

	$msg = "モチベーションの方向";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i2, $msg);
	$sheet->mergeCells($key3.$i2.':'.$key4.$i2);
	// センター寄せ
	$sheet->getStyle($key3.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key3.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key4.$i2)->applyFromArray($cell_style45);

	$msg = "業務の取り組み方";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i2, $msg);
	$sheet->mergeCells($key5.$i2.':'.$key6.$i2);
	// センター寄せ
	$sheet->getStyle($key5.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key5.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key6.$i2)->applyFromArray($cell_style45);

	$msg = "選択行動の傾向";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key7.$i2, $msg);
	$sheet->mergeCells($key7.$i2.':'.$key8.$i2);
	// センター寄せ
	$sheet->getStyle($key7.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key7.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key8.$i2)->applyFromArray($cell_style45);
	
	$msg = "変化への対応";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key9.$i2, $msg);
	$sheet->mergeCells($key9.$i2.':'.$key11.$i2);
	// センター寄せ
	$sheet->getStyle($key9.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key9.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key10.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key11.$i2)->applyFromArray($cell_style45);


	$msg = "仕事のスタイル";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key12.$i2, $msg);
	$sheet->mergeCells($key12.$i2.':'.$key14.$i2);
	// センター寄せ
	$sheet->getStyle($key12.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key12.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key13.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key14.$i2)->applyFromArray($cell_style45);

	$msg = "重視する要素";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key15.$i2, $msg);
	$sheet->mergeCells($key15.$i2.':'.$key16.$i2);
	// センター寄せ
	$sheet->getStyle($key15.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key15.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key15.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key15.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key16.$i2)->applyFromArray($cell_style45);

	$msg = "ルールの適用";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key17.$i2, $msg);
	$sheet->mergeCells($key17.$i2.':'.$key19.$i2);
	// センター寄せ
	$sheet->getStyle($key17.$i2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key17.$i2)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key17.$i2)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key17.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key18.$i2)->applyFromArray($cell_style44);
	$sheet->getStyle($key19.$i2)->applyFromArray($cell_style45w);
	
	//３行目
	$msg = "全般・全体型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key.$i3)->applyFromArray($cell_style46);

	$msg = "具体詳細型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key2.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key2.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key2.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key2.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key2.$i3)->applyFromArray($cell_style46);

	$msg = "目的追求型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key3.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key3.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key3.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key3.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key3.$i3)->applyFromArray($cell_style46);


	$msg = "問題回避型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key4.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key4.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key4.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key4.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key4.$i3)->applyFromArray($cell_style46);

	$msg = "即実行型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key5.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key5.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key5.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key5.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key5.$i3)->applyFromArray($cell_style46);

	$msg = "熟慮・分析型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key6.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key6.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key6.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key6.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key6.$i3)->applyFromArray($cell_style46);


	$msg = "多様選択型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key7.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key7.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key7.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key7.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key7.$i3)->applyFromArray($cell_style46);

	$msg = "既存プロセス型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key8.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key8.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key8.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key8.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key8.$i3)->applyFromArray($cell_style46);

	$msg = "長期安定型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key9.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key9.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key9.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key9.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key9.$i3)->applyFromArray($cell_style46);

	$msg = "継続進展型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key10.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key10.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key10.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key10.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key10.$i3)->applyFromArray($cell_style46);


	$msg = "変化相違型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key11.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key11.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key11.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key11.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key11.$i3)->applyFromArray($cell_style46);

	$msg = "チーム型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key12.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key12.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key12.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key12.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key12.$i3)->applyFromArray($cell_style46);


	$msg = "責任分担型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key13.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key13.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key13.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key13.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key13.$i3)->applyFromArray($cell_style46);


	$msg = "個人型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key14.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key14.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key14.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key14.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key14.$i3)->applyFromArray($cell_style46);

	$msg = "タスク重視型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key15.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key15.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key15.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key15.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key15.$i3)->applyFromArray($cell_style46);


	$msg = "人間重視型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key16.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key16.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key16.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key16.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key16.$i3)->applyFromArray($cell_style46);


	$msg = "自分ルール\n適用型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key17.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key17.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key17.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key17.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key17.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key17.$i3)->applyFromArray($cell_style46);


	$msg = "組織ルール\n遵守型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key18.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key18.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key18.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key18.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key18.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key18.$i3)->applyFromArray($cell_style46);

	$msg = "寛容型";
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue($key19.$i3, $msg);
	// センター寄せ
	$sheet->getStyle($key19.$i3)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	//縦方向
	$sheet->getStyle($key19.$i3)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	//色の設定
	$objPHPExcel->getActiveSheet()->getStyle($key19.$i3)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle($key19.$i3)->getFill()->getStartColor()->setARGB('FFc0c0c0');
	$sheet->getStyle($key19.$i3)->applyFromArray($cell_style46w);



}


if($weight){
	$i=1;
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('o'.$i, '行動価値で青枠になっているのは御社で重要な素養です');

	$sheet->getStyle( 'o'.$i )->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

	$sheet->mergeCells('o'.$i.':s'.$i);
	$sheet->getStyle('o'.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$objPHPExcel->getActiveSheet()->getStyle('o'.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$objPHPExcel->getActiveSheet()->getStyle('o'.$i)->getFill()->getStartColor()->setARGB('FF0000ff');

	
}






// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
/*
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="TEST-AMS.xls"');
header('Cache-Control: max-age=0');
*/
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save('php://output');

//シート追加
$sheet1 = $objPHPExcel->createSheet();
//追加したシートに編集するテンプレートの作成を行う
//左:太線　下:線 center 0-0
$sheet1->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('A1')->applyFromArray($cell_style34);
//左:点線　下:線 center 0-1
$sheet1->getStyle('B1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('B1')->applyFromArray($cell_style35);
//左:点線　下:線 0-2
$sheet1->getStyle('C1')->applyFromArray($cell_style35);

//左:点線　右:太線 下:線 center 0-3
$sheet1->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('D1')->applyFromArray($cell_style36);



//左:太線　下:線 center 色:赤 1-0
$sheet1->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('A2')->applyFromArray($cell_style34);
$objPHPExcel->getActiveSheet(1)->getStyle('A2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet(1)->getStyle('A2')->getFill()->getStartColor()->setARGB('FFff99cc');

//左:点線　下:線 center 色:赤色 1-1
$sheet1->getStyle('B2')->applyFromArray($cell_style35);
$sheet1->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$objPHPExcel->getActiveSheet(1)->getStyle('B2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet(1)->getStyle('B2')->getFill()->getStartColor()->setARGB('FFff99cc');


//左:太線　下:線 center 色:黄色 2-0
$sheet1->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('A3')->applyFromArray($cell_style34);
$objPHPExcel->getActiveSheet(1)->getStyle('A3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet(1)->getStyle('A3')->getFill()->getStartColor()->setARGB('FFffff99');


//左:点線　下:線 center 色:黄色 2-1 
$sheet1->getStyle('B3')->applyFromArray($cell_style35);
$sheet1->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$objPHPExcel->getActiveSheet(1)->getStyle('B3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet(1)->getStyle('B3')->getFill()->getStartColor()->setARGB('FFffff99');

//左：太線 3-0
$sheet1->getStyle('A4')->applyFromArray($cell_style37);


//分類を数値にする
//スコア用点テンプレート作成
$objPHPExcel->getActiveSheet()->getStyle('A5:C10')->getNumberFormat()->setFormatCode('0.0');
//左:太線　下:線 center 4-0
$sheet1->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('A5')->applyFromArray($cell_style34);

//左:点線　下:線 center 4-1
$sheet1->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('B5')->applyFromArray($cell_style35);
//左:点線　下:線 4-2
$sheet1->getStyle('C5')->applyFromArray($cell_style35);

//左:点線　右:太線 下:線 center 4-3
$sheet1->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('D5')->applyFromArray($cell_style36);


//左:太線　下:線 center 色:赤 5-0
$sheet1->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('A6')->applyFromArray($cell_style34);
$objPHPExcel->getActiveSheet(1)->getStyle('A6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet(1)->getStyle('A6')->getFill()->getStartColor()->setARGB('FFff99cc');

//左:点線　下:線 center 色:赤色 5-2
$sheet1->getStyle('B6')->applyFromArray($cell_style35);
$sheet1->getStyle('B6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$objPHPExcel->getActiveSheet(1)->getStyle('B6')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet(1)->getStyle('B6')->getFill()->getStartColor()->setARGB('FFff99cc');


//左:太線　下:線 center 色:黄色 6-0
$sheet1->getStyle('A7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$sheet1->getStyle('A7')->applyFromArray($cell_style34);
$objPHPExcel->getActiveSheet(1)->getStyle('A7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet(1)->getStyle('A7')->getFill()->getStartColor()->setARGB('FFffff99');


//左:点線　下:線 center 色:黄色 6-1 
$sheet1->getStyle('B7')->applyFromArray($cell_style35);
$sheet1->getStyle('B7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
$objPHPExcel->getActiveSheet(1)->getStyle('B7')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet(1)->getStyle('B7')->getFill()->getStartColor()->setARGB('FFffff99');


$sheet2 = $objPHPExcel->createSheet();
$sheet_copy = $sheet2->copy();
$sheet_copy->setTitle("Copied");
$objPHPExcel->setActiveSheetIndex(0);



$objWriter->save('./templateExcel/samples.xls');


include_once("./lib/reviser.php");

$reviser = NEW Excel_Reviser;

foreach($tests as $key=>$val){
	$wheres = array();
	$wheres[ 'testgrp_id' ] = $sec;
	$wheres[ 'exam_id'    ] = $val[ 'exam_id' ];
	$tests[$key][ 'fin_exam_date' ] = $obj->getFinExamDate($wheres);
}


$row = 5;
foreach($tests as $key=>$val){

	$line=1;
	$exam_id = $val[ 'exam_id' ];
	//引数7つは前から順にシート番号、縦(数字)、横(英語),入力文字,コピーするセルの縦(数字)、横(英語),シート番号

	$reviser->addString(0, $row, $line++, $exam_id ,0,0,1  );

/*	
	if($val[ 'complete_flg' ] == 0){
		if($val[ 'exam_state' ] == 1 || $val[ 'exam_state' ] == 2){
			$exam_state = "受検中";
		}else{
			$exam_state = "未受検";
		}
	}else{
		$exam_state = "受検済み";
	}
	
	$reviser->addString(0, $row, $line++, mb_convert_encoding($exam_state,"EUC-JP","UTF-8") ,0,1,1 );
	$name  = mb_convert_encoding($val[ 'name'  ],"EUC-JP","UTF-8");
	$kana  = mb_convert_encoding($val[ 'kana'  ],"EUC-JP","UTF-8");
	

	$reviser->addString(0, $row, $line++, $name ,0,1,1);
	$reviser->addString(0, $row, $line++, $kana ,0,1,1);
	$reviser->addString(0, $row, $line++, $val[ 'birth' ] ,0,1,1 );
	if($val[ 'birth' ]){
		$age = $db->get_age($val[ 'birth' ])."";
	}else{
		$age = "";
	}
	if($age){
		$reviser->addNumber(0, $row, $line++, $age ,0,1,1);
	}else{
		$reviser->addString(0, $row, $line++, "" ,0,1,1);
	}

	$ex = substr($val[ 'fin_exam_date' ],0,10);
	$fdate = preg_replace("/\-/","/",$ex);
	if($fdate == "0000/00/00"){
		$fdate = $val[ 'exam_date' ];
	}

	$reviser->addString(0, $row, $line++, $fdate ,0,1,1);
	$pass       = mb_convert_encoding($val[ 'pass'  ],"EUC-JP","UTF-8");
	$memo1      = mb_convert_encoding($val[ 'memo1' ],"EUC-JP","UTF-8");
	$memo2      = mb_convert_encoding($val[ 'memo2' ],"EUC-JP","UTF-8");
	$reviser->addString(0, $row, $line++, $pass ,0,2,1);
	$reviser->addString(0, $row, $line++, $memo1 ,0,2,1);
	$reviser->addString(0, $row, $line++, $memo2 ,0,2,1);
	
	//---------------------------------------------------------------------------
	//IQ検査
	//---------------------------------------------------------------------------
	if($IQflg){
		$l_score = $val[ 'language_score' ];
		$m_score = $val[ 'iq_math_score' ];
		//平均値
		if($l_score && $m_score){
			$h_score = round(($l_score+$m_score)/2,1);
			$h_lv = getIQLevel($h_score);
		}else{
			$h_score = "";
			$h_lv = "";
		}
		//言語レベル
		if($l_score){
			$l_lv = getIQLevel($l_score);
		}else{
			$l_lv = "";
		}
		
		//数値レベル
		if($m_score){
			$m_lv = getIQLevel($m_score);
		}else{
			$m_lv = "";
		}
		
		
		if(!$h_lv){
			$reviser->addString(0, $row, $line++, "",0,0,1);
		}elseif($h_lv == 1) {
				$reviser->addNumber(0, $row, $line++, $h_lv,1,0,1);
		}elseif($h_lv ==2 ) {
				$reviser->addNumber(0, $row, $line++, $h_lv,2,0,1);
		}else{
			$reviser->addNumber(0, $row, $line++, $h_lv,0,0,1);
		}
		
		if($h_score){
			$reviser->addNumber(0, $row, $line++, $h_score,4,1,1);
		}else{
			$reviser->addString(0, $row, $line++, $h_score,4,1,1);
		}


		
		if(!$l_lv ){
			$reviser->addString(0, $row, $line++, "" ,0,1,1);

		}elseif($l_lv == 1){
			$reviser->addNumber(0, $row, $line++, $l_lv,1,1,1 );
		}elseif($l_lv == 2){
			$reviser->addNumber(0, $row, $line++, $l_lv,2,1,1);
		}else{
			$reviser->addString(0, $row, $line++, $l_lv,0,1,1 );
		}

		if($l_score){
			$reviser->addNumber(0, $row, $line++, $l_score,4,1,1);
		}else{
			$reviser->addString(0, $row, $line++, $l_score,4,1,1);
		}
		
		

		if(!$m_lv ){
			$reviser->addString(0, $row, $line++, "",0,1,1 );
		}elseif($m_lv == 1){
			$reviser->addNumber(0, $row, $line++, $m_lv,1,1,1 );
		}elseif($m_lv == 2){
			$reviser->addNumber(0, $row, $line++, $m_lv,2,1,1);
		}else{
			$reviser->addNumber(0, $row, $line++, $m_lv,0,1,1);
		}
		if($m_score){
			$reviser->addNumber(0, $row, $line++, $m_score ,4,3,1     );
		}else{
			$reviser->addString(0, $row, $line++, $m_score ,4,3,1      );
		}
	}
	
	//---------------------------------------------------------------------------
	//行動価値
	//---------------------------------------------------------------------------
	if($delAction){
		if( ( $val[ 'dev1' ] && $val[ 'dev2' ] )  ){
			if($stressflg[$val[ 'test_id' ]] == 1){
				list($st_level, $st_score) = $db->getStress2($val[ 'dev1' ], $val[ 'dev2' ],$val[ 'dev6' ]);
			}else{
				list($st_level, $st_score) = $db->getStress($val[ 'dev1' ], $val[ 'dev2' ]);
			}
		}else{
			$st_level = "";
			$st_score = "";
			
		}
		if(!$st_level){
			$reviser->addString(0, $row, $line++, "", 0, 0, 1);
		} elseif ($st_level == 1) {
			$reviser->addNumber(0, $row, $line++, $st_level, 1, 0, 1);
		} elseif ($st_level == 2) {
			$reviser->addNumber(0, $row, $line++, $st_level, 2, 0, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $st_level, 0, 0, 1);
		}

		if($st_score){
			$reviser->addNumber(0, $row, $line++, $st_score, 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, "", 0, 1, 1);
		}
		
		//$weightがあるのときは重み付けがある
		if( $weight ){
			
			if($tdatlist[0][ 'weight' ] == 1){
				$level = "";
				$score = "";
			}else{
				$level = $val[ 'level' ];
				if($val[ 'score' ]){
					$score = round($val[ 'score' ],1);
				}else{
					$score = "";
				}
			}

			if(!$level){
				$reviser->addString(0, $row, $line++, "", 0, 1, 1);
			}else
			if ($level == 1) {
				$reviser->addNumber(0, $row, $line++, $level, 1, 1, 1);
			} elseif ($level == 2) {
				$reviser->addNumber(0, $row, $line++, $level, 2, 1, 1);
			} else {
				$reviser->addNumber(0, $row, $line++, $level, 0, 1, 1);
			}

			if(!$score){
				$reviser->addString(0, $row, $line++, "", 0, 1, 1);
			}else{
				$reviser->addNumber(0, $row, $line++, $score, 4, 1, 1);
			}
		}

		$dev1  = round($val[ 'dev1'  ],1);
		$dev2  = round($val[ 'dev2'  ],1);
		$dev3  = round($val[ 'dev3'  ],1);
		$dev4  = round($val[ 'dev4'  ],1);
		$dev5  = round($val[ 'dev5'  ],1);
		$dev6  = round($val[ 'dev6'  ],1);
		$dev7  = round($val[ 'dev7'  ],1);
		$dev8  = round($val[ 'dev8'  ],1);
		$dev9  = round($val[ 'dev9'  ],1);
		$dev10 = round($val[ 'dev10' ],1);
		$dev11 = round($val[ 'dev11' ],1);
		$dev12 = round($val[ 'dev12' ],1);

		if($dev1 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($dev1 < 35) {
	        $reviser->addNumber(0, $row, $line++, $dev1, 5, 1, 1);
		} elseif ($dev1 < 45) {
			$reviser->addNumber(0,$row,  $line++, $dev1, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $dev1, 4, 1, 1);
	    }

		if($dev2 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev2 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev2, 5, 1, 1);
		} elseif ($dev2 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev2, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev2, 4, 1, 1);
		}

		if($dev3 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev3 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev3, 5, 1, 1);
		} elseif ($dev3 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev3, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev3, 4, 1, 1);
		}

		if($dev4 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev4 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev4, 5, 1, 1);
		} elseif ($dev4 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev4, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev4, 4, 1, 1);
		}


		if($dev5 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev5 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev5, 5, 1, 1);
		} elseif ($dev5 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev5, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev5, 4, 1, 1);
		}

		if($dev6 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev6 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev6, 5, 1, 1);
		} elseif ($dev6 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev6, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev6, 4, 1, 1);
		}

		if($dev7 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev7 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev7, 5, 1, 1);
		} elseif ($dev7 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev7, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev7, 4, 1, 1);
		}

		if($dev8 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev8 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev8, 5, 1, 1);
		} elseif ($dev8 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev8, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev8, 4, 1, 1);
		}
		

		if($dev9 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev9 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev9, 5, 1, 1);
		} elseif ($dev9 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev9, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev9, 4, 1, 1);
		}

		if($dev10 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev10 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev10, 5, 1, 1);
		} elseif ($dev10 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev10, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev10, 4, 1, 1);
		}

		if($dev11 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev11 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev11, 5, 1, 1);
		} elseif ($dev11 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev11, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev11, 4, 1, 1);
		}

		if($dev12 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
		if ($dev12 < 35) {
			$reviser->addNumber(0, $row, $line++, $dev12, 5, 1, 1);
		} elseif ($dev12 < 45) {
			$reviser->addNumber(0, $row, $line++, $dev12, 6, 1, 1);
		} else {
			$reviser->addNumber(0, $row, $line++, $dev12, 4, 1, 1);
		}
	}
	
	if($delFS){
	//welcomeFSの値記入
//		$reviser->addString(0, $row, $line++, $val[ 'fs_exam_date' ], 5, 1, 1);
		if($val[ 'fs_score' ] || $val[ 'fs_score' ] == '0' ){
			$reviser->addNumber(0, $row, $line++, $val[ 'fs_score'     ], 0, 0, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'fs_score'     ], 0, 0, 1);
		}
	}
	

	if($delVF){
		//VF検査
//		$reviser->addString(0, $row, $line++, $val[ 'vf_exam_date' ], 5, 1, 1);
		
		if($val[ 'vf_w1' ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w1'        ], 0, 0, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w1'        ], 0, 0, 1);
		}
		
		if($val[ 'vf_w2' ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w2'        ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w2'        ], 0, 1, 1);
		}
		
		if($val[ 'vf_w3'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w3'        ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w3'        ], 0, 1, 1);
		}
		
		if($val[ 'vf_w4'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w4'        ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w4'        ], 0, 1, 1);
		}
		
		if($val[ 'vf_w5'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w5'        ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w5'        ], 0, 1, 1);
		}
		
		if($val[ 'vf_w6'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w6'        ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w6'        ], 0, 1, 1);
		}

		
		if($val[ 'vf_w7'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w7'        ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w7'        ], 0, 1, 1);
		}
		
		if($val[ 'vf_w8'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w8'        ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w8'        ], 0, 1, 1);
		}
		
		
		if($val[ 'vf_w9'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w9'        ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w9'        ], 0, 1, 1);
		}
		
		if($val[ 'vf_w10'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w10'       ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w10'       ], 0, 1, 1);
		}
		
		
		
		if($val[ 'vf_w11'        ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w11'       ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w11'       ], 0, 1, 1);
		}
		
		if($val[ 'vf_w12'       ]){
			$reviser->addNumber(0, $row, $line++, $val[ 'vf_w12'       ], 0, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++, $val[ 'vf_w12'       ], 0, 1, 1);
		}
		
	}


	
	if($delDP){
		//感情能力
	//	$reviser->addString(0, $row, $line++,$val[ 'rs_exam_date' ], 5, 1, 1);
		
		if($val[ 'sougo'        ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'sougo'        ], 4, 0, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'sougo'        ], 0, 0, 1);
		}
		
		if($val[ 'yomitori'        ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'yomitori'     ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'yomitori'     ], 0, 1, 1);
		}
		
		if($val[ 'rikai'        ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'rikai'        ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'rikai'        ], 0, 1, 1);
		}
		
		if($val[ 'sentaku'      ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'sentaku'      ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'sentaku'      ], 0, 1, 1);
		}
		
		if($val[ 'kirikae'      ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'kirikae'      ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'kirikae'      ], 0, 1, 1);
		}
		
		if($val[ 'jyoho'        ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'jyoho'        ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'jyoho'        ], 0, 1, 1);
		}
	}

	

	if($delMV){
		//行動意識
	//	$reviser->addString(0, $row, $line++,$val[ 'mv_exam_date' ], 5, 1, 1);
		if($val[ 'score1'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score1'  ], 4, 0, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score1'  ], 0, 0, 1);
		}
		
		if($val[ 'score2'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score2'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score2'  ], 0, 1, 1);
		}
		
		if($val[ 'score3'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score3'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score3'  ], 0, 1, 1);
		}
		
		if($val[ 'score4'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score4'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score4'  ], 0, 1, 1);
		}
		
		if($val[ 'score5'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score5'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score5'  ], 0, 1, 1);
		}

		if($val[ 'score6'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score6'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score6'  ], 0, 1, 1);
		}
		
		if($val[ 'score7'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score7'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score7'  ], 0, 1, 1);
		}
		
		if($val[ 'score8'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score8'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score8'  ], 0, 1, 1);
		}
		
		if($val[ 'score9'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score9'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score9'  ], 0, 1, 1);
		}
		
		if($val[ 'score10' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score10' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score10' ], 0, 1, 1);
		}
		
		if($val[ 'score11' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score11' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score11' ], 0, 1, 1);
		}
		
		if($val[ 'score12' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score12' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score12' ], 0, 1, 1);
		}
		
		if($val[ 'score13' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score13' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score13' ], 0, 1, 1);
		}
		
		if($val[ 'score14' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score14' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score14' ], 0, 1, 1);
		}
		
		if($val[ 'score15' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score15' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score15' ], 0, 1, 1);
		}
		
		if($val[ 'score16' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score16' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score16' ], 0, 1, 1);
		}
			
		if($val[ 'score17' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score17' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score17' ], 0, 1, 1);
		}
		
		if($val[ 'score18' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score18' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score18' ], 0, 1, 1);
		}
		
		if($val[ 'score19' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score19' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score19' ], 0, 1, 1);
		}
		
		if($val[ 'score20' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score20' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score20' ], 0, 1, 1);
		}
		
		if($val[ 'score21' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score21' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score21' ], 0, 1, 1);
		}
		
		if($val[ 'score22' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score22' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score22' ], 0, 1, 1);
		}
		
		if($val[ 'score23' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score23' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score23' ], 0, 1, 1);
		}
		
		if($val[ 'score24' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score24' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score24' ], 0, 1, 1);
		}
		
		if($val[ 'score25' ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'score25' ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,$val[ 'score25' ], 0, 1, 1);
		}
	}
	
	if($math){

		//数学検定
		if($val[ 'math_level'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'math_level'  ], 0, 0, 1);
		}else{
			$reviser->addString(0, $row, $line++,'', 0, 0, 1);
		}

		if($val[ 'math_score'  ]){
			$reviser->addNumber(0, $row, $line++,$val[ 'math_score'  ], 4, 1, 1);
		}else{
			$reviser->addString(0, $row, $line++,'', 0, 1, 1);
		}
		$reviser->addString(0, $row, $line++,$val[ 'haku_yoso'    ], 0, 1, 1);
		$reviser->addString(0, $row, $line++,$val[ 'bunseki_yoso' ], 0, 1, 1);
		$reviser->addString(0, $row, $line++,$val[ 'sentaku_yoso' ], 0, 1, 1);
		$reviser->addString(0, $row, $line++,$val[ 'yosoku_yoso'  ], 0, 1, 1);
		$reviser->addString(0, $row, $line++,$val[ 'hyogen_yoso'  ], 0, 1, 1);

	}
	
	if($nl2flg){
		//NL2データ
		$nldata1  = round($val[ 'nl2_score1'   ],1);
		$nldata2  = round($val[ 'nl2_score2'   ],1);
		$nldata3  = round($val[ 'nl2_score3'   ],1);
		$nldata4  = round($val[ 'nl2_score4'   ],1);
		$nldata5  = round($val[ 'nl2_score5'   ],1);
		$nldata6  = round($val[ 'nl2_score6'   ],1);
		$nldata7  = round($val[ 'nl2_score7'   ],1);
		$nldata8  = round($val[ 'nl2_score8'   ],1);
		$nldata9  = round($val[ 'nl2_score9'   ],1);
		$nldata10 = round($val[ 'nl2_score10'  ],1);
		$nldata11 = round($val[ 'nl2_score11'  ],1);
		$nldata12 = round($val[ 'nl2_score12'  ],1);
		$nldata13 = round($val[ 'nl2_score13'  ],1);
		$nldata14 = round($val[ 'nl2_score14'  ],1);
		$nldata15 = round($val[ 'nl2_score15'  ],1);
		$nldata16 = round($val[ 'nl2_score16'  ],1);
		$nldata17 = round($val[ 'nl2_score17'  ],1);
		$nldata18 = round($val[ 'nl2_score18'  ],1);
		$nldata19 = round($val[ 'nl2_score19'  ],1);
		
		if($nldata1 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata1 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata1, 5, 1, 1);
		} elseif ($nldata1 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata1, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata1, 4, 1, 1);
	    }

		if($nldata2 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata2 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata2, 5, 1, 1);
		} elseif ($nldata2 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata2, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata2, 4, 1, 1);
	    }


		if($nldata3 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata3 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata3, 5, 1, 1);
		} elseif ($nldata3 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata3, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata3, 4, 1, 1);
	    }


		if($nldata4 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata4 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata4, 5, 1, 1);
		} elseif ($nldata4 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata4, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata4, 4, 1, 1);
	    }


		if($nldata5 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata5 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata5, 5, 1, 1);
		} elseif ($nldata5 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata5, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata5, 4, 1, 1);
	    }


		if($nldata6 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata6 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata6, 5, 1, 1);
		} elseif ($nldata6 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata6, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata6, 4, 1, 1);
	    }

		if($nldata7 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata7 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata7, 5, 1, 1);
		} elseif ($nldata7 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata7, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata7, 4, 1, 1);
	    }


		if($nldata8 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata8 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata8, 5, 1, 1);
		} elseif ($nldata8 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata8, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata8, 4, 1, 1);
	    }

		if($nldata9 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata9 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata9, 5, 1, 1);
		} elseif ($nldata9 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata9, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata9, 4, 1, 1);
	    }

		if($nldata10 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata10 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata10, 5, 1, 1);
		} elseif ($nldata10 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata10, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata10, 4, 1, 1);
	    }

		if($nldata11 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata11 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata11, 5, 1, 1);
		} elseif ($nldata11 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata11, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata11, 4, 1, 1);
	    }

		if($nldata12 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata12 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata12, 5, 1, 1);
		} elseif ($nldata12 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata12, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata12, 4, 1, 1);
	    }

		if($nldata13 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata13 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata13, 5, 1, 1);
		} elseif ($nldata13 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata13, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata13, 4, 1, 1);
	    }

		if($nldata14 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata14 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata14, 5, 1, 1);
		} elseif ($nldata14 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata14, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata14, 4, 1, 1);
	    }


		if($nldata15 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata15 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata15, 5, 1, 1);
		} elseif ($nldata15 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata15, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata15, 4, 1, 1);
	    }


		if($nldata16 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata16 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata16, 5, 1, 1);
		} elseif ($nldata16 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata16, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata16, 4, 1, 1);
	    }


		if($nldata17 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata17 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata17, 5, 1, 1);
		} elseif ($nldata17 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata17, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata17, 4, 1, 1);
	    }


		if($nldata18 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata18 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata18, 5, 1, 1);
		} elseif ($nldata18 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata18, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata18, 4, 1, 1);
	    }


		if($nldata19 == "0.0"){
			$reviser->addString(0, $row, $line++, " ", 0, 1, 1);
		}else
	    if ($nldata19 < 35) {
	        $reviser->addNumber(0, $row, $line++, $nldata19, 5, 1, 1);
		} elseif ($nldata19 < 45) {
			$reviser->addNumber(0,$row,  $line++, $nldata19, 6, 1, 1);
	    } else {
	        $reviser->addNumber(0, $row, $line++, $nldata19, 4, 1, 1);
	    }

	}
	
	$reviser->addString(0, $row, $line++,"", 3, 0, 1);
*/
	$row++;
}




$reviser->rmSheet(1);
$reviser->rmSheet(2);


$expath = "./templateExcel/samples.xls";
$date = sprintf("%04d%02d%02d",date('Y'),date('m'),date('d'));
$out = "koudou_".$date."_".$id.".xls";
$reviser->reviseFile($expath, $out);


//destory();
exit;

function getIQLevel($score){
	if($score < 35){
		$lv = "1";
	}elseif(35 <= $score && $score < 45 ){
		$lv = "2";
	}elseif(45 <= $score && $score < 55 ){
		$lv = "3";
	}elseif(55 <= $score && $score < 65 ){
		$lv = "4";
	}else{
		$lv = "5";
	}
	return $lv;
}

function returnNumber($num){
	if(strlen($num) <= 2 ){
		$num = $num.".0";
	}
	return $num;
}

function destroy()   
{   
    $this->excel->disconnectWorksheets();   
    unset($this->excel);   
}  













exit();
?>