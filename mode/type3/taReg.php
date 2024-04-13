<?PHP
//-------------------------------------------
//BAテスト結果表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_custaReg.php");

$obj = new custaRegMethod();
$where[ 'pid'     ] = $ptid;
$where[ 'cid'     ] = $id;
$where[ 'tgrp_id' ] = $sec;
$testp = $obj->getTestPaper($where);
if($_REQUEST[ 'submit' ] ){
	//現在の登録データ取得
	
	if(!$_FILES[ 'fileName' ][ 'name' ]){
		
	}else{
		$tmp = fopen($_FILES['fileName']['tmp_name'], "r");
		setlocale(LC_ALL, 'ja_JP.UTF-8');
		setlocale(LC_ALL, 'ja_JP.EUC-JP');
		setlocale(LC_ALL, 'ja_JP.Shift_JIS');
		$i=0;
		while ($csv = $db->fgetcsv_reg($tmp, "1024")) {
			if($i > 0){
				$list[$i][ '0' ] = $csv[ 0 ];
				$list[$i][ '1' ] = mb_convert_encoding($csv[ 1 ],"UTF-8","SJIS");
				$list[$i][ '2' ] = mb_convert_encoding($csv[ 2 ],"UTF-8","SJIS");
				$list[$i][ '3' ] = mb_convert_encoding($csv[ 3 ],"UTF-8","SJIS");
				$list[$i][ '4' ] = mb_convert_encoding($csv[ 4 ],"UTF-8","SJIS");
				$list[$i][ '5' ] = mb_convert_encoding($csv[ 5 ],"UTF-8","SJIS");
				$list[$i][ '6' ] = mb_convert_encoding($csv[ 6 ],"UTF-8","SJIS");
				$list[$i][ '7' ] = mb_convert_encoding($csv[ 7 ],"UTF-8","SJIS");
				$list[$i][ 'id' ] = mb_convert_encoding($testp[ $i ][ 'id' ],"UTF-8","SJIS");
				$list[$i][ 'number'     ] = mb_convert_encoding($testp[ $i ][ 'number'     ],"UTF-8","SJIS");
				$list[$i][ 'exam_state' ] = mb_convert_encoding($testp[ $i ][ 'exam_state' ],"UTF-8","SJIS");
				$list[$i][ 'taid'       ] = mb_convert_encoding($testp[ $i ][ 'taid' ],"UTF-8","SJIS");

			}
				$i++;

		}
		$upload = 1;
	}
}
if($_REQUEST[ 'regist' ]){
	//登録データと更新データに分ける
	//配列のtaidがある時はupdate無い時はinsert
	$ins = "";
	$up  = array();
	foreach($_REQUEST[ 'id' ] as $key=>$val){
		if($_REQUEST[ 'taid' ][$key]){
			$up[$val][ 'id'       ] = $val;
			$up[$val][ 'hv_id'    ] = $_REQUEST[ 'hv_id'    ][ $key ];
			$up[$val][ 'hv_name'  ] = $_REQUEST[ 'hv_name'  ][ $key ];
			$up[$val][ 'hv_busyo' ] = $_REQUEST[ 'hv_busyo' ][ $key ];
			$up[$val][ 'ev_id'    ] = $_REQUEST[ 'ev_id'    ][ $key ];
			$up[$val][ 'ev_pwd'   ] = $_REQUEST[ 'ev_pwd'   ][ $key ];
			$up[$val][ 'ev_name'  ] = $_REQUEST[ 'ev_name'  ][ $key ];
			$up[$val][ 'ev_busyo' ] = $_REQUEST[ 'ev_busyo' ][ $key ];
			$up[$val][ 'relation' ] = $_REQUEST[ 'relation' ][ $key ];
		}else{
			
			$ins .= ",(";
			$ins .= " '".$_REQUEST[ 'id'    ][ $key ]."',";
			$ins .= " '".$sec."',";
			$ins .= " '".$_REQUEST[ 'hv_id'    ][ $key ]."',";
			$ins .= " '".$_REQUEST[ 'hv_name'  ][ $key ]."',";
			$ins .= " '".$_REQUEST[ 'hv_busyo' ][ $key ]."',";
			$ins .= " '".$_REQUEST[ 'ev_id'    ][ $key ]."',";
			$ins .= " '".$_REQUEST[ 'ev_pwd'   ][ $key ]."',";
			$ins .= " '".$_REQUEST[ 'ev_name'  ][ $key ]."',";
			$ins .= " '".$_REQUEST[ 'ev_busyo' ][ $key ]."',";
			$ins .= " '".$_REQUEST[ 'relation' ][ $key ]."'";
			$ins .= ")";
		}
	}
	if($ins){
		$ins = preg_replace("/^,/","",$ins);
	}
	//データ更新
	if(count($up)){
		$edit = array();
		foreach($up as $key=>$val){
			$where[ 'tp_id'   ] = $val[ 'id'       ];
			$edit[ 'hv_id'    ] = $val[ 'hv_id'    ];
			$edit[ 'hv_name'  ] = $val[ 'hv_name'  ];
			$edit[ 'hv_busyo' ] = $val[ 'hv_busyo' ];
			$edit[ 'ev_id'    ] = $val[ 'ev_id'    ];
			$edit[ 'ev_pwd'   ] = $val[ 'ev_pwd'   ];
			$edit[ 'ev_name'  ] = $val[ 'ev_name'  ];
			$edit[ 'ev_busyo' ] = $val[ 'ev_busyo' ];
			$edit[ 'relation' ] = $val[ 'relation' ];
			$edit[ 'period'   ] = $val[ 'period'   ];
			$obj->tamenEdit($where,$edit);
		}
	}
	
	if($ins){
		$obj->tamenSet($ins);
	}
	$html = "taRegFin";
}
?>