<?PHP
//-------------------------------------------
//お知らせ情報
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_info.php");
$obj = new infoMethod();



//お知らせ情報取得
$where = array();
$where[ 'id' ] = $sec;
$info = $obj->getInfo($where);

$dlist = explode(":",$info[0][ 'disp_id_list' ]);
if(count($dlist)){
	foreach($dlist as $key=>$val){
		$d[$val] = "on";
	}
}
//顧客データ取得
$where = array();
$where[ 'type' ] = 2;
$where[ 'del'  ] = 0;
$user = $obj->getUserData($where);

if($_REQUEST[ 'conf' ]){
	if ($_FILES["upfile"]["name"] && is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
		$time = time();
		$tmp_ary = explode('.', $_FILES["upfile"]["name"]);
		$extension = $tmp_ary[count($tmp_ary)-1];
		$fname = $time.".".$extension;
		if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "infoFile/preview/" .$fname)) {
			
		}
	}
	$html = "infoEditConf";
}

if($_REQUEST[ 'regRegist' ]){
	$tbl = "information_tbl";
	$set = array();
	$set['edit'][ 'title'       ] = $_REQUEST[ 'title'        ];
	$set['edit'][ 'date1'       ] = $_REQUEST[ 'from'         ];
	$set['edit'][ 'date2'       ] = $_REQUEST[ 'to'           ];
	$set['edit'][ 'disp_status' ] = $_REQUEST[ 'disp_status'  ];
	$set['edit'][ 'disp_area'   ] = $_REQUEST[ 'disp_area'    ];
	$set['edit'][ 'message'     ] = $_REQUEST[ 'message'      ];
	$set['edit'][ 'temp_file'   ] = $_REQUEST[ 'fname'        ];
	if($_REQUEST[ 'idList' ] && count($_REQUEST[ 'idList' ])){
		foreach($_REQUEST[ 'idList' ] as $key=>$val){
			$idline .= $key.":";
		}
	}
	$idline = preg_replace("/:$/","",$idline);
	$set[ 'edit' ][ 'disp_id_list' ] = $idline;
	$set[ 'where' ][ 'id' ] = $sec;
	$db->editUserData($tbl,$set);
	
	@rename(D_PATH_HOME."/infoFile/preview/".$fname, D_PATH_HOME."/infoFile/" .$fname);


	$html = "infoEditFin";
}
?>