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

//顧客データ取得
$where = array();
$where[ 'type' ] = 2;
$where[ 'del'  ] = 0;
$user = $obj->getUserData($where);

if($_REQUEST[ 'conf' ]){
	if ($_FILES["upfile"]["name"]){
		if (($_FILES["upfile"]["size"] < 20000))
	 	{
			if ($_FILES["upfile"]["error"] > 0){
				$err = 1;
			}
		}
	}
	if(!$err){
		if ($_FILES["upfile"]["name"] && is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
			$time = time();
			$tmp_ary = explode('.', $_FILES["upfile"]["name"]);
			$extension = $tmp_ary[count($tmp_ary)-1];
			$fname = $time.".".$extension;
			if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "infoFile/preview/" .$fname)) {
				
			}
		}
		$html = "infoConf";
	}
}
if($_REQUEST[ 'regRegist' ]){
	$tbl = "information_tbl";
	$set = array();
	$set[ 'title'       ] = $_REQUEST[ 'title'        ];
	$set[ 'date1'       ] = $_REQUEST[ 'from'         ];
	$set[ 'date2'       ] = $_REQUEST[ 'to'           ];
	$set[ 'disp_status' ] = $_REQUEST[ 'disp_status'  ];
	$set[ 'disp_area'   ] = $_REQUEST[ 'disp_area'    ];
	$set[ 'message'     ] = $_REQUEST[ 'message'      ];
	$set[ 'temp_file'   ] = $_REQUEST[ 'fname'        ];
	if($_REQUEST[ 'idList' ] && count($_REQUEST[ 'idList' ])){
		foreach($_REQUEST[ 'idList' ] as $key=>$val){
			$idline .= $key.":";
		}
	}
	$idline = preg_replace("/:$/","",$idline);
	$set[ 'disp_id_list' ] = $idline;
	$db->setUserData($tbl,$set);
	if($_REQUEST[ 'fname' ]){
		$fname = $_REQUEST[ 'fname'        ];

		@rename(D_PATH_HOME."/infoFile/preview/".$fname, D_PATH_HOME."/infoFile/" .$fname);
	}
	$html = "infoFin";
}
?>