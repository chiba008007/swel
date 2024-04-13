<?PHP
//-------------------------------------------
//データ登録
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_jug.php");
$obj = new jug();
$where = array();
$where[ 'testgrp_id' ] = $sec;
$boss = $obj->getBoss($where);
//データ登録
if($_REQUEST[ 'check' ]){
	$where = array();
	$where[ 'testgrp_id' ] = $sec;
	$where[ 'jmid' ] = $_REQUEST[ 'jmid' ];
	$where[ 'bossid' ] = $_REQUEST[ 'bossid' ];
	$obj->setBoss($where);
	
	exit();
}
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
		$check = $obj->getBossChk($where);
	}

	$where[ 'limit'  ] = $limit;
	$where[ 'offset' ] = $offset;
	$judrow = $obj->getJug($where,1);
	$ceil = ceil($judrow/$limit);
	$data = $obj->getJug($where);
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

?>