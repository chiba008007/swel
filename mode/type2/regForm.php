<?PHP
//-------------------------------------------
//企業登録フォーム
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_ptnRegForm.php");

$obj = new ptnRegFormMethod();

//-------------------------------------
//検査結果の説明用マニュアル送信日指定
//-------------------------------------
if($_REQUEST[ 'flg' ] == "sendDay"){
	$edit = array();
	$tbl = "t_user";
	$edit[ 'where' ][ 'id'            ] = $id;
	$edit[ 'edit'  ][ 'sendDayStatus' ] = $_REQUEST[ 'sendDay' ];
	$obj->editUserData($tbl,$edit);
	exit();
}

//-------------------------------------
//マニュアル削除
//-------------------------------------
if($_REQUEST[ 'flg' ] == "del"){
	$fname = "system-manual.pdf";
	$href = './manual/'.$_REQUEST['id']."/".$fname;
	if(file_exists($href)){
		unlink($href);
		echo 1;
	}else{
		echo 0;
	}
	exit();
}
if($_REQUEST[ 'flg' ] == "del2"){
	$fname = "output-manual.pdf";
	$href = './manual/'.$_REQUEST['id']."/".$fname;
	if(file_exists($href)){
		unlink($href);
		echo 1;
	}else{
		echo 0;
	}
	exit();
}

//---------------------------------
//form_status変更
//----------------------------------
if($_REQUEST[ 'flg' ] == "form_status"){
	$edit = array();
	$tbl = "t_user";
	$edit[ 'where' ][ 'id'          ] = $id;
	$edit[ 'edit'  ][ 'form_status' ] = $_REQUEST[ 'form_status' ];
	$obj->editUserData($tbl,$edit);
	
	exit();
}

//---------------------------------
//重みつけ登録
//----------------------------------
if($_REQUEST[ 'flg' ] == "weight"){
	$where = array();
	$where[ 'uid' ] = $id;
	$row = $obj->wDataRow($where);
	$tbl = "t_user_weight";
	if($row){
		$edit[ 'where' ][ 'uid'   ] = $id;
		$edit[ 'edit' ][ 'w1'  ] = $_REQUEST[ 'w1' ];
		$edit[ 'edit' ][ 'w2'  ] = $_REQUEST[ 'w2' ];
		$edit[ 'edit' ][ 'w3'  ] = $_REQUEST[ 'w3' ];
		$edit[ 'edit' ][ 'w4'  ] = $_REQUEST[ 'w4' ];
		$edit[ 'edit' ][ 'w5'  ] = $_REQUEST[ 'w5' ];
		$edit[ 'edit' ][ 'w6'  ] = $_REQUEST[ 'w6' ];
		$edit[ 'edit' ][ 'w7'  ] = $_REQUEST[ 'w7' ];
		$edit[ 'edit' ][ 'w8'  ] = $_REQUEST[ 'w8' ];
		$edit[ 'edit' ][ 'w9'  ] = $_REQUEST[ 'w9' ];
		$edit[ 'edit' ][ 'w10' ] = $_REQUEST[ 'w10' ];
		$edit[ 'edit' ][ 'w11' ] = $_REQUEST[ 'w11' ];
		$edit[ 'edit' ][ 'w12' ] = $_REQUEST[ 'w12' ];
		$edit[ 'edit' ][ 'ave' ] = $_REQUEST[ 'ave' ];
		$edit[ 'edit' ][ 'sd'  ] = $_REQUEST[ 'sd'  ];
		$db->editUserData($tbl,$edit);
	}else{
		
		$set[ 'uid' ] = $id;
		$set[ 'w1'  ] = $_REQUEST[ 'w1' ];
		$set[ 'w2'  ] = $_REQUEST[ 'w2' ];
		$set[ 'w3'  ] = $_REQUEST[ 'w3' ];
		$set[ 'w4'  ] = $_REQUEST[ 'w4' ];
		$set[ 'w5'  ] = $_REQUEST[ 'w5' ];
		$set[ 'w6'  ] = $_REQUEST[ 'w6' ];
		$set[ 'w7'  ] = $_REQUEST[ 'w7' ];
		$set[ 'w8'  ] = $_REQUEST[ 'w8' ];
		$set[ 'w9'  ] = $_REQUEST[ 'w9' ];
		$set[ 'w10' ] = $_REQUEST[ 'w10' ];
		$set[ 'w11' ] = $_REQUEST[ 'w11' ];
		$set[ 'w12' ] = $_REQUEST[ 'w12' ];
		$set[ 'ave' ] = $_REQUEST[ 'ave' ];
		$set[ 'sd'  ] = $_REQUEST[ 'sd' ];

		$set[ 'regist_ts' ] = sprintf("%04d-%02d-%02d %02d:%02d:%02d"
									,date("Y"),date('m'),date("d")
									,date("H"),date("i"),date("s")
									);
		$db->setUserData($tbl,$set);
		
	}
	exit();
}


//---------------------------------
//フォームコード生成
//無ければ新規作成
//----------------------------------
$where = array();
$where[ 'id'   ] = $id;
$user = $obj->getFormCode($where);
if(!$user[ 'form_code' ]){
	$tbl = "t_user";
	$md5 = md5(uniqid(rand(),1));
	$edit = array();
	$edit[ 'where' ][ 'id'   ] = $id;
	$edit[ 'where' ][ 'type' ] = 2;
	$edit[ 'edit'  ][ 'form_code' ] = $md5;
	$obj->editUserData($tbl,$edit);
}

//---------------------------------
//データ取得
//----------------------------------
$where[ 'id'   ] = $id;
$users = array();
$users = $obj->getUser($where);
$user = $users[0];
$where[ 'uid'   ] = $id;
$wt = array();
$wt = $obj->getWeightUser($where);

$w1  = $wt["w1" ];
$w2  = $wt["w2" ];
$w3  = $wt["w3" ];
$w4  = $wt["w4" ];
$w5  = $wt["w5" ];
$w6  = $wt["w6" ];
$w7  = $wt["w7" ];
$w8  = $wt["w8" ];
$w9  = $wt["w9" ];
$w10 = $wt["w10"];
$w11 = $wt["w11"];
$w12 = $wt["w12"];
$ave = $wt["ave"];
$sd  = $wt["sd" ];

//var_dump($user);
?>