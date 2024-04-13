<?PHP
//-------------------------
//印刷ボタンPDF
//-------------------------
if($_REQUEST[ 'printflg' ]){
	$pdf = new MBFPDF('P','mm','A4');
	include_once("makePdf.php");

	$exam_id = $_REQUEST[ 'exam_id'  ];
	$filename = $exam_id."_".date('Y').date('m').date('d').".pdf";
	$pdf->Output($filename, 'D');
	
	
	exit();
}

//-------------------------
//データ保存
//-------------------------
if($_REQUEST[ 'flg' ] == "saveData"){
	$set = array();
	$set[ 'answer_text'        ] = $_REQUEST[ 'answer_text'        ];
	$set[ 'answer_advice_text' ] = $_REQUEST[ 'answer_advice_text' ];
	$set[ 'note_point'         ] = $_REQUEST[ 'note_point'         ];
	$set[ 'logic_point'        ] = $_REQUEST[ 'logic_point'        ];
	$set[ 'tensaku_number'     ] = 2;
	$set[ 'exam_id'            ] = $_REQUEST[ 'exam_id'            ];
	$set[ 'testgrp_id'         ] = $_REQUEST[ 'testgrp_id'         ];
	$set[ 'test_id'            ] = $_REQUEST[ 'test_id'            ];
	$set[ 'tensaku_id'         ] = $_REQUEST[ 'tensaku_id'         ];
	$flg = $pcrt->setAnswer($set);
	echo $flg;
	exit();
}

//-------------------------
//添削完了
//-------------------------
if($_REQUEST[ 'flg' ] == "collect"){
	$edit = array();
	$edit[ 'tensaku_number' ] = $_REQUEST[ 'tensaku_number' ];
	$edit[ 'tensaku_flg'    ] = 0;
	$edit[ 'exam_id'        ] = $first;
	$edit[ 'testgrp_id'     ] = $sec;
	$edit[ 'test_id'        ] = $third;

	$flg = $pcrt->editBaseCrt($edit);

	echo $flg;
	exit();
}


//where句の作成
$where = array();
$where[ 'testgrp_id'] = $sec;
$where[ 'exam_id'   ] = $first;
$where[ 'type'      ] = 44;
//受検時間の取得 IDの取得
$baseData = $crt->getBaseData($where);
$where[ 'test_id' ] = $baseData[ 'id' ];
//設問カテゴリ取得
$category = explode(";",$baseData[ 'array_tensaku_title_status' ]);
//質問内容取得
$questionList = explode(";",$baseData[ 'array_tensaku_text' ]);


$data = array();
$data = $crt->getCrtData($where);

if($data[ 'tensaku_flg' ] == 0){
	//入力状態中
	$errmsg = "<p class='errmsg'>現在入力待ち状態です。</p>";
	//$md = "error";
	//すべてreadonlyにする
	$readonly="readonly=readonly";
}

$tline1 = explode(",",$data[ 'tline1' ]);
$tline2 = explode(",",$data[ 'tline2' ]);
$tline3 = explode(",",$data[ 'tline3' ]);
$crt_id = $data[ 'id' ];

//------------------
//データ取得
//-----------------
if($_REQUEST[ 'flg' ] == "getData"){
	
	$get[ 'crt_id'     ] = $crt_id;
	$get[ 'tensaku_id' ] = $_REQUEST[ 'category' ];
	$alldata = $crt->getCrtDataOne($get,"*");
	$json = json_encode($alldata);
	echo $json;
	exit();
}


$ques = array();
foreach($tline3 as $key=>$val){
	$ques[$val] = $val;
}


foreach($array_tensaku_question as $key=>$val){
	foreach($val as $k=>$v){
		if($ques[$k]){
			$alist[ $k ] = $v;
		}
	}
}

?>
