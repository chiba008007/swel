<?PHP
//-------------------------------------------
//パートナー情報一覧表示
//
//
//
//
//
//-------------------------------------------
include_once("./init/tensaku.php");
require_once("./lib/include_dataList.php");
require_once("./lib/include_t.php");
require_once("./lib/include_wt.php");

if ($_SERVER['HTTPS']) {
    header("Location:".D_URL."index/data/".$sec);
    exit;
}

//合否判定配列
$array_pass = array(
				""=>"-"
				,"合"=>"合"
				,"否"=>"否"
				);
if($_COOKIE[ 'lang' ] == "ch" ){
	$array_status = array(
			""=>"-"
			,"0"=>"未接受检查"
			,"1"=>"正在接受检查"
			,"2"=>"待检查完成"
			);
}else{
	$array_status = array(
			""=>"-"
			,"0"=>"未受検"
			,"1"=>"受検中"
			,"2"=>"受検済"
			);
}

//IQ用
//管理者の場合は完了選択可能
//管理者以外はロック解除のみ
if($basetype == 1){
	$array_iq = array(
				""=>"-"
				,"1"=>"完了"
				,"2"=>"ﾛｯｸ解除"
			);
}else{
	$array_iq = array(
			""=>"-"
			,"2"=>"ﾛｯｸ解除"
		);
}



$obj = new dataListMethod();
$t   = new tMethod();
$wt  = new wtMethod();

$where = array();
$where[ 'test_id' ] = $sec;
$test = $obj->getTestData( $where );

//var_dump($ptid,$id);
$limit = 50;
//---------------------------------
//MATHデータの処理完了
//---------------------------------
if($_REQUEST[ 'mathFin' ]){
	$id = $_REQUEST[ 'id' ];
	$td = $obj->getTestPaper($id);

	$where = array();
	$where[ 'where' ][ 'id'            ] = $id;
	$where[ 'edit'  ][ 'exam_state'    ] = 2;
	$where[ 'edit'  ][ 'exam_time'     ] = "0:00";
	$where[ 'edit'  ][ 'fin_exam_date' ] = sprintf("%04d-%02d-%02d %02d:%02d:%02d"
											,date('Y'),date('m'),date('d')
											,date('H'),date('i'),date('s')
											);
	$tbl = "t_testpaper";
	//テストデータ変更
	$db->editUserData($tbl,$where);
	$where = array();
	$where[ 'exam_id'    ] = $td[ 'exam_id'    ];
	$where[ 'testgrp_id' ] = $td[ 'testgrp_id' ];
	//テストcomplete_flgチェック
	$t->editCompleteFlg($where);
	$where[ 'test_id'    ] = $td[ 'test_id'    ];

	//数学テストデータ計算処理
	include_once(D_PATH_HOME."/init/mathData/mathData.php");
	include_once("./lib/keisan/functionMATH.php");
	include_once("./t/lib/include_MATH.php");
	$math  = new mathmethod();
	$ans = $math->getEa($where);
	$mathid = $ans[ 'math_id' ];
	$list = setMathScore($ans,$a_math_point,$a_math_answer,$a_math_pointdata);
	$math->setResult($list,$mathid);
	exit();
}
//---------------------------------
//MATHデータの処理完了。終わり
//---------------------------------


//---------------------------------
//MATH2データの処理完了
//---------------------------------
if($_REQUEST[ 'math2Fin' ]){
	$id = $_REQUEST[ 'id' ];
	$td = $obj->getTestPaper($id);

	$where = array();
	$where[ 'where' ][ 'id'            ] = $id;
	$where[ 'edit'  ][ 'exam_state'    ] = 2;
	$where[ 'edit'  ][ 'exam_time'     ] = "0:00";
	$where[ 'edit'  ][ 'fin_exam_date' ] = sprintf("%04d-%02d-%02d %02d:%02d:%02d"
											,date('Y'),date('m'),date('d')
											,date('H'),date('i'),date('s')
											);
	$tbl = "t_testpaper";
	//テストデータ変更
	$db->editUserData($tbl,$where);
	$where = array();
	$where[ 'exam_id'    ] = $td[ 'exam_id'    ];
	$where[ 'testgrp_id' ] = $td[ 'testgrp_id' ];
	//テストcomplete_flgチェック
	$t->editCompleteFlg($where);
	$where[ 'test_id'    ] = $td[ 'test_id'    ];

	//数学テストデータ計算処理
	include_once(D_PATH_HOME."/init/mathData/mathData.php");
	include_once("./lib/keisan/functionMATH2.php");
	include_once("./t/lib/include_MATH2.php");
	$math  = new mathmethod();
	$ans = $math->getEa($where);
	$mathid = $ans[ 'math_id' ];
	$list = setMathScore($ans,$a_math_point,$a_math_answer,$a_math_pointdata);
	$math->setResult($list,$mathid);
	exit();
}
//---------------------------------
//MATH2データの処理完了。終わり
//---------------------------------


//---------------------------------
//MATH2データの処理完了
//---------------------------------
if($_REQUEST[ 'iqFin' ]){
	$id = $_REQUEST[ 'id' ];
	$td = $obj->getTestPaper($id);
	$where = array();
	$where[ 'where' ][ 'id'            ] = $id;
	$where[ 'edit'  ][ 'exam_state'    ] = 2;
	$where[ 'edit'  ][ 'exam_time'     ] = "0:00";
	$where[ 'edit'  ][ 'fin_exam_date' ] = sprintf("%04d-%02d-%02d %02d:%02d:%02d"
											,date('Y'),date('m'),date('d')
											,date('H'),date('i'),date('s')
											);

	$tbl = "t_testpaper";
	//テストデータ変更
	$db->editUserData($tbl,$where);
	$where = array();
	$where[ 'exam_id'    ] = $td[ 'exam_id'    ];
	$where[ 'testgrp_id' ] = $td[ 'testgrp_id' ];
	//テストcomplete_flgチェック
	$t->editCompleteFlg($where);
	$where[ 'test_id'    ] = $td[ 'test_id'    ];

	//IQテストデータ計算処理
	include_once(D_PATH_HOME."/init/iqData/iqData.php");
	include_once(D_PATH_HOME."/lib/keisan/functionIQ.php");
	include_once("./t/lib/include_IQ.php");
	$math  = new mathmethod();
	$ans = $math->getEa($where);
	$iqid = $ans[ 'iq_id' ];
	
	list($lang_hen,$math_hen) = IQScore($ans,$a_iq,$a_lang,$a_math);
	$list = array();
	$list[ 'lang' ] = $lang_hen;
	$list[ 'math' ] = $math_hen;
	$math->setResult($list,$iqid);

	exit();
}
//---------------------------------
//MATH2データの処理完了。終わり
//---------------------------------









//---------------------------------
//MATHデータのロック解除
//---------------------------------
if($_REQUEST[ 'mathFlg' ]){
	$id = $_REQUEST[ 'id' ];
	$where = array();
	$where[ 'where' ][ 'id'         ] = $id;
	$where[ 'edit'  ][ 'exam_state' ] = 0;
	$tbl = "t_testpaper";
	$db->editUserData($tbl,$where);
	
	//math_memberのデータ削除
	$dat = $obj->getTestPaper($id);
	if($dat[ 'type' ] == 13){
		$tbl = "math_member";
		$del['where'][ 'testgrp_id' ] = $dat[ 'testgrp_id' ];
		$del['where'][ 'test_id'    ] = $dat[ 'test_id' ];
		$del['where'][ 'exam_id'    ] = $dat[ 'exam_id' ];
		$db->deleteUserData($tbl,$del);
	}

	//iq_memberのデータ削除
	if($dat[ 'type' ] == 11){
		$tbl = "iq_member";
		$del['where'][ 'testgrp_id' ] = $dat[ 'testgrp_id' ];
		$del['where'][ 'test_id'    ] = $dat[ 'test_id' ];
		$del['where'][ 'exam_id'    ] = $dat[ 'exam_id' ];
		$db->deleteUserData($tbl,$del);
	}
	exit();
}
//---------------------------------
//MATHデータのロック解除。終わり
//---------------------------------



//ROWデータの登録完了処理。
//---------------------------------
if($_REQUEST[ 'rowFlg' ]){
	$id = $_REQUEST[ 'id' ];
	$where = array();
	$where[ 'id'    ] = $id;
	$edit[ 'rowflg' ] = 0;
	$obj->editRowFlg($where,$edit);
	exit();
}
//---------------------------------
//ROWデータの登録完了処理。終わり
//---------------------------------

//---------------------------------
//受検データ削除
//---------------------------------
if($_REQUEST[ 'delete' ]){
	$i=0;
	//削除するデータのexam_idをカンマ区切り
	$where = array();
	$mainasu=0;
	foreach($_REQUEST[ 'check' ] as $key=>$val){
		$where[$i] = $val;
		$mainasu++;
		$i++;
	}
	//テスト数
	$count = $obj->getTestCount($sec);
	$mainasutotal = $mainasu*$count;
	$examline = implode(",'",$where);

	//テストデータ削除
	$obj->deleteTestpaper($examline,$sec);
	//テスト総数データ変更
	$obj->editTestCount($mainasu,$mainasutotal,$sec);
	
	exit();
}


//---------------------------------
//重みデータ取得
//---------------------------------
$where = array();
$where[ 'uid' ] = $id;
$where[ 'pid' ] = $ptid;
$wdata = $wt->getList($where,"all");
//ダイヤログ用
if($_REQUEST[ 'wflg' ]){
	$options = "";
	$options = "<option value=''>指定されている基準値</option>";
	if(count($wdata)){
		foreach($wdata as $key=>$val){
			$options .= "<option value='".$key."'>".$val[ 'master_name' ]."</option>";
		}
	}
	echo $options;
	exit();
}

//ユーザーデータ取得
$where = array();
$where[ 'id' ] = $id;
$user = $db->getUser($where);
$pdfbutton = $user[0][ 'pdf_button' ];
$csvbutton = $user[0][ 'csvupload'  ];
$outputPdf = $user[0][ 'outputPdf'  ];

//重みマスタ利用
$pdf_master_status   = $user[0][ 'pdf_master_status' ];
$excel_master_status = $user[0][ 'excel_master_status' ];

//テスト数取得
$where = array();
$where[ 'pid'        ] = $ptid;
$where[ 'cid'        ] = $id;
$where[ 'testgrp_id' ] = $sec;
$rows = $obj->getTestlistCount($where);

//テスト親データ取得
$where = array();
$where[ 'id' ] = $sec;
$parent = $obj->getParentTest($where);
$pdf_slice = $parent[ 'pdf_slice' ];
$pdfline   = explode(":",$parent[ 'pdfdownload' ]);
//行動価値検査結果レポート（面接版適合あり） のときのみマスタボックス表示

if(strlen(array_search('2',$pdfline)) > 0 && $pdf_master_status == 1 ){
	$makePdf = "makePdf";
}


if(strlen(array_search('28',$pdfline)) > 0 && $pdf_master_status == 1 ){
	$makePdf = "makePdf";
}


//受検テストタイプ取得
$where = array();
$where[ 'pid'        ] = $ptid;
$where[ 'cid'        ] = $id;
$where[ 'test_id'    ] = $sec;
$types = $obj->getTestTypes($where);

$testname = $types[0][ 'name'   ];
$weight = 1;

foreach($types as $key=>$val){
	//重みフラグが１件でも０があれば0
	if($val[ 'weight' ] == "0"){
		$weight = 0;
	}
}
$rowflg   = $types[0][ 'rowflg' ];

//選択したテストに行動価値検査が含まれている時グラフ表示
$graphbutton = 0;
//移動フラグ
$movebutton = 0;
foreach($types as $key=>$val){
    if( 
            $val[ 'type' ] == 1
            || $val[ 'type' ] == 2
            || $val[ 'type' ] == 12
            || $val[ 'type' ] == 59
            ){
        $graphbutton = 1;
    }

    if(
        !($val[ 'type' ] == 1
                || $val[ 'type' ] == 2
                || $val[ 'type' ] == 12
                || $val[ 'type' ] == 7
                || $val[ 'type' ] == 50
                )    
        ){
        $movebutton += 1;
        
    }
}
//colspan値の設定
if(count($types)){
	foreach($types as $key=>$val){
		$types[$key][ 'colspan' ] = $obj->getColspan($val[ 'type' ],$weight);
		$tykey[$val[ 'type' ]] = $val[ 'type' ];
	}
}
if($tykey[52]){
	//評価検査のとき
	require_once("./lib/include_jug.php");
	$hobj = new jug();

	$where = array();
	$where[ 'testgrp_id' ] = $sec;
	$boss = $hobj->getBoss($where);

	//データ取得
	if($_REQUEST[ 'getList' ]){
		//登録データ取得
		$limit = 50;
		$offset = sprintf("%d",$limit*$_REQUEST[ 'pg' ]);
		$where = array();
		$where[ 'testgrp_id' ] = $sec;
		//上司と部下の関連データ取得
		$bossid = $_REQUEST[ 'arrays' ][0][ 'bossid' ];
		if($bossid){
			$where[ 'bossid' ] = $bossid;
			$check = $hobj->getBossChk($where);
			$where[ 'bossid' ] = $bossid;
		}

		$where[ 'limit'  ] = $limit;
		$where[ 'offset' ] = $offset;
		$judrow = $hobj->getLists($where,1);
		$ceil = ceil($judrow/$limit);
		$data = $hobj->getLists($where);
		foreach($data as $key=>$val){
			if($check && $check[ $val[ 'id' ] ]){
				$data[$key][ 'check' ] = "checked";
			}
		}
		$jud[ 'data' ] = $data;
		$jud[ 'page' ] = $ceil;
		
		$data = json_encode($jud);
		echo $data;
		exit();
	}

	$html = "dataHyoka";
}else
if($tykey[10]){
//多面評価の時はコチラ
	//テストデータ取得
	require_once("./lib/include_taDataList.php");
	$ta = new taDataListMethod();
	$where = array();
	$offset = sprintf("%d",$limit*$_REQUEST[ 'pages' ]);
	$where[ 'pid'        ] = $ptid;
	$where[ 'cid'        ] = $id;
	$where[ 'test_id'    ] = $sec;

	$taList  = $ta->getTamen($where);
	$tlist = explode(":",$taList[0][ 'tamen_type' ]);
	$cols=count($tlist);
	
	
	//--------------------------------
	//
	//テーブルデータ
	//
	//--------------------------------
	if($_REQUEST[ 'lists' ]){
		if($_REQUEST[ 'text' ] && $_REQUEST[ 'status' ] == "ID"){
			$where[ 'hv_id' ] = $_REQUEST[ 'text' ];
		}
		if($_REQUEST[ 'text' ] && $_REQUEST[ 'status' ] == "hv_name"){
			$where[ 'hv_name' ] = $_REQUEST[ 'text' ];
		}
		if($_REQUEST[ 'text' ] && $_REQUEST[ 'status' ] == "hv_busyo"){
			$where[ 'hv_busyo' ] = $_REQUEST[ 'text' ];
		}
		if($_REQUEST[ 'text' ] && $_REQUEST[ 'status' ] == "ev_id"){
			$where[ 'ev_id' ] = $_REQUEST[ 'text' ];
		}
		if($_REQUEST[ 'text' ] && $_REQUEST[ 'status' ] == "ev_name"){
			$where[ 'ev_name' ] = $_REQUEST[ 'text' ];
		}
		if($_REQUEST[ 'text' ] && $_REQUEST[ 'status' ] == "ev_busyo"){
			$where[ 'ev_busyo' ] = $_REQUEST[ 'text' ];
		}
		$offset = sprintf("%d",$limit*$_REQUEST[ 'pages' ]);
		$where[ 'limit'      ] = $limit;
		$where[ 'offset'     ] = $offset;
		$row = $ta->getTamenListCount($where);
		
		list($talist,$tdetail) = $ta->getTamenList($where);
		$ceil = @ceil($row/$limit);

		$html = "";
		$i=1;
		if(count($talist)){
			foreach($talist as $key=>$val){
				$html .= "<tr>";
				//$html .= "<td class='center' ><input type='checkbox' name='del'  value='".$val[tp_id]."' id='del_".$val[tp_id]."' class='delchecks'  ></td>\n";
				$html .= "<td class='center' >".$val[ 'number'   ]."</td>\n";
				$html .= "<td class='center' >".$val[ 'hv_id'    ]."</td>";
				$html .= "<td class='center' >".$val[ 'hv_name'  ]."</td>";
				$html .= "<td class='center' >".$val[ 'hv_busyo' ]."</td>";
				$html .= "<td class='center' >".$val[ 'ev_id'    ]."</td>";
				$html .= "<td class='center' >".$val[ 'ev_name'  ]."</td>";
				$html .= "<td class='center' >".$val[ 'ev_busyo' ]."</td>";
				$html .= "<td class='center' >".$val[ 'relation' ]."</td>";
				$age = "";
				if($val[ 'age' ]){
					$age = "<br />(".$val[ 'age' ].")";
				}
				$html .= "<td class='center' >".$val[ 'birth' ].$age."</td>";
				if(count($tdetail[ $val[ 'id' ]])){
					$j = 0;
					foreach($tdetail[$val['id']] as $k=>$v){
						if($v[ 'exam_state' ] == 1) $state = "受検中";
						if($v[ 'exam_state' ] == 0) $state = "未受検";
						if($v[ 'exam_state' ] == 2){
							$html .= "<td class='center' >".$v[ 'update_ts' ]."</td>";
						}else{
							$html .="<td class='center'>".$state."</td>";
						}
						$j++;

					}
					//足りないtdを追加
					for($k=0;$k<$cols-$j;$k++){
						$html .="<td class='center'>".$state."</td>";
					}
					
				}else{
					for($k = 0;$k<$cols;$k++){
						$html .= "<td class='center'>未受検</td>";
					}
				}
				$html .= "</tr>\n";
				$i++;
			}
		}

		//ページャーの作成
		$page = "";
		$page = "<div id='pager'>";
		$page .= "<ul>";
		$one = $_REQUEST['pages']-3;
		if($one < 0) $one = 0;
		$end = $one+5;
		$page .= "<li><a href='/index/data/".$sec."/0'>[<<]</a></li>";
		for($i=$one;$i<$end;$i++){
			$cnt = $i+1;
			if($i >= $ceil){
			
			}else{
				$page .= "<li>[<a href='/index/data/".$sec."/".$i."'>".$cnt."</a>]</li>";
			}
		}
		$ends = $ceil-1;
		$page .= "<li><a href='/index/data/".$sec."/".$ends."'>[>>]</a></li>";

		$page .= "</ul>";
		$page .= "</div>";


		echo $html."_;_".$page;
		exit();
	}
	//--------------------------------
	//
	//テーブルデータ終わり
	//
	//--------------------------------

	$html = "taData";
}else{
	ksort($tykey);
	foreach($tykey as $key=>$val){
		$ty .= $val.":";
	}
	$ty = preg_replace("/:$/","",$ty);

		if(
			   $ty == "1"
			|| $ty == "2"
			|| $ty == "12"
			|| $ty == "41"
                        || $ty == "59"

			|| $ty == "7"
			|| $ty == "5"
			|| $ty == "31"
			|| $ty == "6"
			|| $ty == "13"
			|| $ty == "42"
			|| $ty == "36"
			|| $ty == "4"
			|| $ty == "33"
			|| $ty == "3"
			|| $ty == "11"
			|| $ty == "35"
			|| $ty == "37"
			|| $ty == "40"
			|| $ty == "46"
			|| $ty == "47"
			|| $ty == "49"
			|| $ty == "51"
			|| $ty == "53"
			|| $ty == "54"
                        || $ty == "56"
                        || $ty == "57"
                        || $ty == "58"
                        
			|| $ty == "1:7"
			|| $ty == "1:47"
			|| $ty == "1:5"
			|| $ty == "2:7"
			|| $ty == "2:5"
			|| $ty == "7:12"
			|| $ty == "5:12"
			|| $ty == "12:47"
                        || $ty == "7:59"
			|| $ty == "47:59"
			|| $ty == "5:59"

			|| $ty == "1:13"
			|| $ty == "2:13"
			|| $ty == "12:13"
			|| $ty == "1:42"
			|| $ty == "2:42"
			|| $ty == "12:42"
			|| $ty == "1:35"
			|| $ty == "2:35"
			|| $ty == "12:35"
			|| $ty == "41:42"
			|| $ty == "37:47"

			|| $ty == "1:3"
			|| $ty == "2:3"
			|| $ty == "3:12"
	/*
			|| $ty == "1:4"
			|| $ty == "2:4"
			|| $ty == "4:12"
	*/		
			|| $ty == "6:7"
			|| $ty == "7:37"
			|| $ty == "5:6"
			|| $ty == "5:37"
			|| $ty == "31:37"
			|| $ty == "6:31"
			
			|| $ty == "1:5:7"
			|| $ty == "1:5:37"
			|| $ty == "1:6:7"
			|| $ty == "1:7:37"
			|| $ty == "1:6:31"
			|| $ty == "1:31:37"

			|| $ty == "2:5:7"
			|| $ty == "2:5:37"
			|| $ty == "2:6:7"
			|| $ty == "2:7:37"
			|| $ty == "2:6:31"
			|| $ty == "2:31:37"

			|| $ty == "5:12:7"
			|| $ty == "5:12:37"
			|| $ty == "6:12:7"
			|| $ty == "7:12:37"
			|| $ty == "7:12:50"
			|| $ty == "6:12:31"
			|| $ty == "12:31:37"


			|| $ty == "1:5:13"
			|| $ty == "1:5:42"
			|| $ty == "1:5:35"
			|| $ty == "1:7:13"
			|| $ty == "1:7:42"
			|| $ty == "1:7:35"
			|| $ty == "1:13:31"
			|| $ty == "1:42:31"
			|| $ty == "1:31:35"

			|| $ty == "2:5:13"
			|| $ty == "2:5:42"
			|| $ty == "2:5:35"
			|| $ty == "2:7:13"
			|| $ty == "2:7:42"
			|| $ty == "2:7:35"
			|| $ty == "2:13:35"
			|| $ty == "2:42:35"
			|| $ty == "2:31:35"

			|| $ty == "5:12:13"
			|| $ty == "5:12:42"

			|| $ty == "5:12:35"
			|| $ty == "7:12:13"
			|| $ty == "5:12:42"

			|| $ty == "7:12:35"
			|| $ty == "12:13:35"
			|| $ty == "5:12:42"

			|| $ty == "12:31:35"


			|| $ty == "1:5:11"
			|| $ty == "1:7:11"
			|| $ty == "1:31:11"

			|| $ty == "2:5:11"
			|| $ty == "2:7:11"
			|| $ty == "2:11:31"

			|| $ty == "5:11:12"
			|| $ty == "7:12:11"
			|| $ty == "11:12:31"

			|| $ty == "1:6"
			|| $ty == "2:6"
			|| $ty == "6:12"

			|| $ty == "1:37"
			|| $ty == "2:37"
			|| $ty == "12:37"
			|| $ty == "12:37:47"

			|| $ty == "1:11"
			|| $ty == "2:11"
			|| $ty == "11:12"


			|| $ty == "7:11:12"
			|| $ty == "1:7:11"

	){
			$excelBtn = 1;
	}




	if($_REQUEST[ 'lists' ]){
		$dstr1 = "未受検";
		$dstr2 = "受検中";
		$dstr3 = "更新";
		if($_REQUEST[ 'lang' ] == "ch" ){
			$dstr1 = "未接受检查";
			$dstr2 = "正在接受检查";
			$dstr3 = "更新";
		}

		$str11 = "ロック解除";
		$str12 = "検査完了";
		$str13 = "時間切れ";
		$str14 = "回答率";
		if($_REQUEST[ 'lang' ] == "ch" ){
			$str11 = "放开";
			$str12 = "检查完成";
			$str13 = "超时";
			$str14 = "响应速度";
		}


		$offset = sprintf("%d",$limit*$_REQUEST[ 'pages' ]);
		$where = array();
		$where[ 'pid'        ] = $ptid;
		$where[ 'cid'        ] = $id;
		$where[ 'testgrp_id' ] = $sec;
		$where[ 'limit'      ] = $limit;
		$where[ 'offset'     ] = $offset;

		if($_REQUEST[ 'status' ] == "ID"){
			$where[ 'exam_id' ] = $_REQUEST[ 'text' ];
			$where[ 'limit'      ] = "";
			$where[ 'offset'     ] = "";
		}
		if($_REQUEST[ 'status' ] == "name"){
			$where[ 'name'    ] = $_REQUEST[ 'text' ];
			$where[ 'limit'      ] = "";
			$where[ 'offset'     ] = "";

		}
		if($_REQUEST[ 'status' ] == "kana"){
			$where[ 'kana'    ] = $_REQUEST[ 'text' ];
			$where[ 'limit'      ] = "";
			$where[ 'offset'     ] = "";

		}
		if($_REQUEST[ 'status' ] == "pass"){
			$where[ 'pass'    ] = $_REQUEST[ 'text' ];
		}
		if($_REQUEST[ 'status' ] == "search" || strlen($_REQUEST[ 'es' ]) || strlen($_REQUEST[ 'dc' ]) || strlen($_REQUEST[ 'dc2' ])){
			$txt = explode("_",$_REQUEST[ 'text' ]);
			$where[ 'exam_state' ] = $_REQUEST[ 'es' ];
			$where[ 'from'       ] = $txt[1];
			$where[ 'to'         ] = $txt[2];
		}
               ;
		//テストデータの取得
		//テスト件数の取得
		$rows = $obj->getTestlistCount($where);

		$ceil = @ceil($rows/$limit);
		//取得するtest_idカンマ区切り
		//getTestlistで取得する配列の絞り込みが
		//groupbyが出来ない配列の為where句でデータを取得したい為
		$wheres = $obj->getTestwhere($where);
		$list = $obj->getTestlist($where,$wheres);
		
		//数学検定登録済みデータ取得
		$mwhere[ 'testgrp_id' ] = $sec;
		$mathes = $obj->getMathRow($mwhere);
		//数学検定2登録済みデータ取得
		$mathes2 = $obj->getMath2Row($mwhere);
		//IQ検査の登録済みデータ取得
		$iqes = $obj->getIQRow($mwhere);
		//IQデータの受検数取得
		$iqCount = $obj->getIQCount($mwhere);
		//mathデータの受検数取得
		$mathCount = $obj->getMathCount($mwhere);
		//添削状況データ取得
		$tensaku = $obj->getTensakuSts($where);
		//添削の済数
		$tensakued = $obj->getTensakuStsEd($where);
		//データ配列の組み直し
		if(!count($list)){
			exit();
		}
		foreach($list as $key=>$val){
			$data[ $val[ 'number' ] ]['number'         ] = $val[ 'number'         ];
			$data[ $val[ 'number' ] ]['name'           ] = $val[ 'name'           ];
			$data[ $val[ 'number' ] ]['test_id'        ] = $val[ 'test_id'        ];
			$data[ $val[ 'number' ] ]['kana'           ] = $val[ 'kana'           ];
			$data[ $val[ 'number' ] ]['birth'          ] = $val[ 'birth'          ];
			$data[ $val[ 'number' ] ]['exam_id'        ] = $val[ 'exam_id'        ];
			$data[ $val[ 'number' ] ]['age'            ] = $val[ 'age'            ];
			$data[ $val[ 'number' ] ]['pass'           ] = $val[ 'pass'           ];
			$data[ $val[ 'number' ] ]['pdf'            ] = $val[ 'pdf'            ];
			$data[ $val[ 'number' ] ]['memo1'          ] = $val[ 'memo1'          ];
			$data[ $val[ 'number' ] ]['memo2'          ] = $val[ 'memo2'          ];
			$data[ $val[ 'number' ] ]['pdfdownload'    ] = $val[ 'pdfdownload'    ];
			if($val[ 'complete_flg' ]){
				$data[ $val[ 'number' ] ]['disabled'          ] = "disabled";
			}else{
				$data[ $val[ 'number' ] ]['disabled'          ] = "";
			}
			//ストレスレベルの取得
			if($val[ 'dev1' ] && $val[ 'dev2' ] && $val[ 'dev6' ]){
				$dev1 = $val[ 'dev1' ];
				$dev2 = $val[ 'dev2' ];
				$dev3 = $val[ 'dev3' ];
				$dev6 = $val[ 'dev6' ];

				if(!$val[ 'stress_flg' ]){
					list($lv,$score) = $obj->getStress($dev1,$dev2);
					$data[ $val[ 'number' ] ]['lv'      ][$val[ 'type' ]] = $lv;
					$data[ $val[ 'number' ] ]['score'   ][$val[ 'type' ]] = $score;
				}else{
					list($lv,$score) = $obj->getStress2($dev1,$dev2,$dev6);
					$data[ $val[ 'number' ] ]['lv'      ][$val[ 'type' ]] = $lv;
					$data[ $val[ 'number' ] ]['score'   ][$val[ 'type' ]] = $score;
				}
			}
			$data[ $val[ 'number' ] ]['id'                  ][$val[ 'type' ]] = $val[ 'id'           ];
			$data[ $val[ 'number' ] ]['type'                ][$val[ 'type' ]] = $val[ 'type'         ];
			$data[ $val[ 'number' ] ]['exam_state'          ][$val[ 'type' ]] = $val[ 'exam_state'   ];
			$data[ $val[ 'number' ] ]['complete_flg'        ][$val[ 'type' ]] = $val[ 'complete_flg' ];
			$data[ $val[ 'number' ] ]['middle_time_status'  ][$val[ 'type' ]] = $val[ 'middle_time_status' ];
			$data[ $val[ 'number' ] ]['stress_flg'          ][$val[ 'type' ]] = $val[ 'stress_flg'   ];
			$data[ $val[ 'number' ] ]['exam_dates'          ][$val[ 'type' ]] = $val[ 'exam_dates'   ];
			$data[ $val[ 'number' ] ]['start_time'          ][$val[ 'type' ]] = $val[ 'start_time'   ];
			$data[ $val[ 'number' ] ]['level'               ][$val[ 'type' ]] = $val[ 'level'        ];
			$data[ $val[ 'number' ] ]['tensaku_status'      ][$val[ 'type' ]] = $val[ 'tensaku_status'  ];
			$data[ $val[ 'number' ] ]['tensaku_name'        ][$val[ 'type' ]] = $val[ 'tensaku_name'    ];
			$data[ $val[ 'number' ] ]['tensaku_mail'        ][$val[ 'type' ]] = $val[ 'tensaku_mail'    ];
			$data[ $val[ 'number' ] ]['mail'                ][$val[ 'type' ]] = $val[ 'mail'            ];

		}
		$html = "";
		//html表示
		foreach($data as $key=>$val){
			//チェックボックスのchecked指定
			$html .= "<tr>";
		//	$html .= "<td class='center' ><input type='checkbox' name='del'  value='".$val[exam_id]."' id='del_".$val[exam_id]."' class='delchecks' ".$val[ 'disabled' ]." ></td>";
			$html .= "<td>".$val[number]."</td>";
			$html .= "<td class='center' >".$val[exam_id]."</td>";
			$html .= "<td class='left' >".$val[name]."</td>";
			$html .= "<td class='left' >".$val[kana]."</td>";
			if($val[age]){
				$html .= "<td class='center' >".$val[birth]."(".$val[age].")</td>";
			}else{
				$html .= "<td></td>";
			}
			$html .= "<td class='center' >".$val[pass]."</td>";



			foreach($val[ 'type' ] as $k=>$v){
				//------------------------------------------------------------------------------------------------
				//IQselectボックス作成
				//------------------------------------------------------------------------------------------------

				//------------------------------------------------------------------------------------------------
				//IQselectボックス作成終わり
				//------------------------------------------------------------------------------------------------
				//------------------------------------------------------------------------------------------------
				//MATHボックス作成
				//------------------------------------------------------------------------------------------------
				$math = "";
				if($v == 13 || $v==35 || $v == 42){
					//受験完了した際はロック解除ボタンを表示しない
					if($val[ 'exam_state' ][ $v ] != 2){
						$ratio = round(($mathCount[$val[ 'exam_id' ]][ 'cnt' ]/30)*100,0);
						//$maths = "<br />".$mathCount[$val[ 'exam_id' ]][ 'cnt' ]."/30";
						$math .= "<br />".$str14.":".$ratio."%".$maths;
						$math .= "<br /><input type='button' id='m_".$val[ id ][$v]."' value='".$str11."' class='mathRock'>";
					}
					//if($basetype == 1){
						if($val[ 'exam_state' ][$v] != 2){
							if($v == 13 || $v == 42){
								$math .= "<br /><input type='button' id='mf_".$val[id][$v]."' value='".$str12."' class='mathFin' >";
							}
							if($v == 35){
								$math .= "<br /><input type='button' id='mf_".$val[id][$v]."' value='".$str12."' class='math2Fin' >";
							}
							if($v == 11){
								$math .= "<br /><input type='button' id='mf_".$val[id][$v]."' value='".$str12."' class='iqFin' >";
							}
						}
					//}
				}

				if($v == 11 ){
					//受験完了した際はロック解除ボタンを表示しない
					if($val[ 'exam_state' ][ $v ] != 2){
						$examid = ucfirst($val[ 'exam_id' ]);
						$ratio = round(($iqCount[$val[ 'exam_id' ]][ 'cnt' ]/56)*100,0);
						//$ratio = round(($iqCount[$examid][ 'cnt' ]/56)*100,0);
						//var_dump($iqCount[$examid][ 'cnt' ]);
						//var_dump($iqCount['Win473'][ 'cnt' ]);
					//	$maths = "<br />".$iqCount[$val[ 'exam_id' ]][ 'cnt' ]."/56";
						$math = "<br />".$str14.":".$ratio."%".$maths;
						$math .= "<br /><input type='button' id='m_".$val[ id ][$v]."' value='".$str11."' class='mathRock'>";
					}
					if($val[ 'exam_state' ][$v] != 2){
						if($v == 13 || $v == 42){
							$math .= "<br /><input type='button' id='mf_".$val[id][$v]."' value='".$str12."' class='mathFin' >";
						}
						if($v == 35){
							$math .= "<br /><input type='button' id='mf_".$val[id][$v]."' value='".$str12."' class='math2Fin' >";
						}
						if($v == 11){
							$math .= "<br /><input type='button' id='mf_".$val[id][$v]."' value='".$str12."' class='iqFin' >";
						}
					}
				}

				if($val[middle_time_status][$v] == 1){
					$math .= "<div style='color:red;'>".$str13."</div>";
				}
				//------------------------------------------------------------------------------------------------
				//MATHボックス作成終わり
				//------------------------------------------------------------------------------------------------
				
				//------------------------------------------------------------------------------------------------
				//--受検ステータス
				//------------------------------------------------------------------------------------------------
				//IQ検定で$iqes[ID]がある時は受検中にする
				if($iqes[ $val[ 'exam_id' ]] && $val[type][$v] == 11 && $val[ 'exam_state' ][$v] != 2){
					$html .= "<td class='center'>".$dstr2.$math."</td>";
				}else
				//数学検定2で$mathes[ID]がある時は受検中にする
				if($mathes2[ $val[ 'exam_id' ]] && $val[type][$v] == 35 && $val[ 'exam_state' ][$v] != 2){
					$html .= "<td class='center'>".$dstr2.$math."</td>";
				}else
				//数学検定で$mathes[ID]がある時は受検中にする
				if($mathes[ $val[ 'exam_id' ]] && $val[type][$v] == 13  && $val[ 'exam_state' ][$v] != 2){
					$html .= "<td class='center'>".$dstr2.$math."</td>";
				}else
				//数学検定で$mathes[ID]がある時は受検中にする
				if($mathes[ $val[ 'exam_id' ]] && $val[type][$v] == 42  && $val[ 'exam_state' ][$v] != 2){
					$html .= "<td class='center'>".$dstr2.$math."</td>";
				}else
				//添削のとき
				if($val[type][$v] == 48  && $val[ 'exam_state' ][$v] == 1){
					$disabled = "";
					$tnum = $tensaku[ $val[ 'exam_id' ] ][ 'tensaku_number' ];
					$tcnt = sprintf("%d",$tensaku[ $val[ 'exam_id' ] ][ 'tensaku_count' ]);
					$tsumi = "0";
					if($tnum == 1){
						$tsumi = $tensakued[ $val[ 'exam_id' ] ][ 'tensaku_sumi1' ];
					}
					if($tnum == 2){
						$tsumi = $tensakued[ $val[ 'exam_id' ] ][ 'tensaku_sumi2' ];
					}
					if($tnum == 3){
						$tsumi = $tensakued[ $val[ 'exam_id' ] ][ 'tensaku_sumi3' ];
					}
					if($tnum == 4){
						$tsumi = $tensakued[ $val[ 'exam_id' ] ][ 'tensaku_sumi4' ];
					}
					$str = "添削待";
					if($tensaku[ $val[ 'exam_id' ] ][ 'tensaku_flg' ] == 0){
						$disabled = "DISABLED";
						if($tcnt == "0"){
							$str = "設定中";
						}else{
							$str = "受検者入力中";
						}
					}
					
					
					$button = "<br /><input type='button' id='exam_".$val[ exam_id ]."' class='tensakubutton'  value='添削' ".$disabled.">";
					$html .= "<td class='center'>".$tnum."回目 ".$tsumi."/".$tcnt."<br />".$str.$button."</td>";
				}else
				//exam_stateが0のときは未受検
				if($val[ 'exam_state' ][$v] == 0){
					$html .= "<td class='center'>".$dstr1."</td>";
				}else
				//exam_stateが1のときは受検中
				if($val[ 'exam_state' ][$v] == 1){
					$html .= "<td class='center'>".$dstr2.$math."</td>";
				}else
				//BA,FSの時はリンクを貼る
				
				if(
					$val[type][$v] == 1 ||
					$val[type][$v] == 2 ||
					$val[type][$v] == 3 ||
					$val[type][$v] == 12 ||
					$val[type][$v] == 54 ||
                                        $val[type][$v] == 59 ||
					$val[type][$v] == 41 

				){
					$html .= "<td class='center' ><a href='/index/rst/".$val[id][$v]."/' class='rst' >";
					$html .= $val['exam_dates'][$v]."</a>";
					
					$html .= "</td>";
				}elseif($val[type][$v] == 13 || $val[ type ][ $v ] == 35 || $val[type][$v] == 42){
					//BMSの時はリンクを張る
					$html .= "<td class='center' ><a href='/index/rst/".$val[id][$v]."/' class='rstM' >";
					$html .= $val['exam_dates'][$v]."</a>".$math;
					
					$html .= "</td>";
				}elseif($val[type][$v] == 11){
					//BMSの時はリンクを張る
					$html .= "<td class='center' >";
					$html .= $val['exam_dates'][$v]."".$math;
					
					$html .= "</td>";
				}elseif($val[type][$v] == 48){
					$html .= "<td class='center' >";
					$html .= $val['exam_dates'][$v];
					$html .= "<br /><input type='button' id='exam_".$val[ exam_id ]."' class='tensakubutton'  value='添削' ".$disabled.">";
					$html .= "</td>";
				}else{
				
					$html .= "<td class='center' >".$val['exam_dates'][$v]."</td>";
				}
				//------------------------------------------------------------------------------------------------
				//---受検ステータス終わり-------------------------------------------------------------------------
				//------------------------------------------------------------------------------------------------
				
				//----------------------------------------------------------
				//BA,FSの時はレベルを表示する
				//----------------------------------------------------------
				if(
					$val[type][$v] == 1 ||
					$val[type][$v] == 2 ||
				//	$val[type][$v] == 3 ||
					$val[type][$v] == 12 ||
					$val[type][$v] == 54 ||
                                        $val[type][$v] == 59 ||
					$val[type][$v] == 41 

				){
					if($weight == "0"){
						$Balevel = "";
						if($val[ 'level' ][$v]){
							$Balevel = $val[ 'level' ][$v];
						}
						$html .= "<td class='center'>".$Balevel."</td>";
					}
					
					$BaLv = "";
					if($val[ 'lv' ][$v]){
						$BaLv = $val[ 'lv' ][$v];
					}
					$html .= "<td class='center'>".$BaLv."</td>";
				}
				//----------------------------------------------------------
				//BA,FSの時はレベルを表示する終わり
				//----------------------------------------------------------
				

				//----------------------------------------------------------
				//添削の時は更新日時・添削者を表示する
				//----------------------------------------------------------
				if(
					$val[type][$v] == 44

				){
					$t_sts = $array_tensaku_status[$val['tensaku_status'][$v]];
					$mail  = $val['mail'][$v];
					$html .= "<td class='center'>".$mail."</td>";
					$html .= "<td class='center'>".$t_sts."</td>";
					$html .= "<td class='center'>".$val['tensaku_name'][$v]."<br />".$val['tensaku_mail'][$v]."</td>";

				}
				//----------------------------------------------------------
				//添削の時は更新日時・添削者を表示する終わり
				//----------------------------------------------------------


				//----------------------------------------------------------
				//PDFボタン
				//----------------------------------------------------------
				$pdfdisabled = "on";
				if($val[complete_flg][$v] && $val[ 'pdf' ]){
					$pdfdisabled = "";
				}
				
			}
			//メモ
			$wsel = "";
			$html .= "<td class='left'>".$val[ 'memo1' ]."</td>";
			$html .= "<td class='left'>".$val[ 'memo2' ]."</td>";
			$html .= "<td class='center w200' >";
			$html .= "<ul class='ulmenu w'>";
			if(
				$val[type][$v] == 44
			){
				$html .= "<li class='w30' ><a href='/tk/".$val[ exam_id ]."/".$sec."/".$val[ test_id ]."' target=_blank >添削</a></li>";
			}
			$html .= "<li class='w30' ><a href='/index/testEdit/".$sec."/".$val[ exam_id ]."'>".$dstr3."</a></li>";
			
			//pdfが9の時はA3でダウンロードを行う
			if($val[ 'pdf' ] == 9){
				$a3 = "a3";
			}else{
				$a3 = "a4";
			}
			
			if($pdf_slice  && !$pdfdisabled ){
				$html .= "<li class='w30' ><a href='/index/zip/".$sec."/".$val[ exam_id ]."/".$a3."' id='zip_".$sec."_".$val[ exam_id ]."' class='zipMake' >ZIP</a></li>";
			}else
			//if(!$pdfdisabled){
                        if(!$pdfdisabled && $pdfbutton == 1){

				$html .= "<li class='w30' ><a href='/index/pdf/".$sec."/".$val[ exam_id ]."/".$a3."' class='".$makePdf."' target=_blank >PDF</a>";
                              //  $html .= "<a href='/index/pdf/".$sec."/".$val[ exam_id ]."/".$a3."'>HTML</a>";
                                $html .= "</li>";
			//}elseif($pdfbutton == 0 && !$pdfdisabled ){
                        }elseif($pdfbutton == 0  ){
				$html .= "";
			
			}else{
				$html .= "<li class='w30' ><p class='disabled'>PDF</p></li>";
			}
			//移動ボタンを出す
                        if($movebutton == 0 ){
                            $html .= "<li><a href='/index/move/".$sec."/".$val[ exam_id]."'>移動</a></li>";
                        }
			$html .= "</ul>";
			$html .= "</td>";

			$html .= "</tr>\n";
			
		}
		//ページャーの作成
		$page = "";
		$page = "<div id='pager'>";
		if($ceil > 1){
				$page .= "<ul>";
				$one = $_REQUEST['pages']-3;
				if($one < 0) $one = 0;
				$end = $one+5;
				$page .= "<li><a href='/index/data/".$sec."/0/?es=".$_REQUEST[ 'es' ]."&dc=".$txt[1]."&dc2=".$txt[2]."'>[<<]</a></li>";
				for($i=$one;$i<$end;$i++){
					$cnt = $i+1;
					if($i >= $ceil){
					
					}else{
						$page .= "<li>[<a href='/index/data/".$sec."/".$i."/?es=".$_REQUEST[ 'es' ]."&dc=".$txt[1]."&dc2=".$txt[2]."'>".$cnt."</a>]</li>";
					}
				}
				$ends = $ceil-1;
				$page .= "<li><a href='/index/data/".$sec."/".$ends."/?es=".$_REQUEST[ 'es' ]."&dc=".$txt[1]."&dc2=".$txt[2]."'>[>>]</a></li>";

				$page .= "</ul>";
		}
		$page .= "</div>";


		echo $html."_;_".$page;
		exit();
	}
}//多面評価の時はコチラ終わり




?>