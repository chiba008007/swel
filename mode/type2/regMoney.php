<?PHP
//-------------------------------------------
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_regMoney.php");

$obj = new regMoneyMethod();
$where = array();
$where[ 'id' ] = $id;
$data = $db->getUser($where);
$license = explode(":",$data[ 0 ][ 'license_parts' ]);

//データ取得
$where = array();
$where[ 'pid' ] = $id;
$get = $obj->getData($where);

//現在利用している検査を取得
foreach($license as $key=>$val){
	if($val){
		$c = $key+1;
		$tests[ $key ][ 'type'       ] = $c;
		$tests[ $key ][ 'count'      ] = $val;
		$tests[ $key ][ 'name'       ] = $a_test_type[ $c ];
		$tests[ $key ][ 'dispname'   ] = ($get[ $c ][ 'dispname' ])?$get[ $c ][ 'dispname' ]:$a_test_type[ $c ];
		$tests[ $key ][ 'money'      ] = ($get[ $c ][ 'dispmoney' ])?$get[ $c ][ 'dispmoney' ]:$a_test_money[ $c ];
		$tests[ $key ][ 'status'     ] = $get[ $c ][ 'status' ];
	}
}

foreach($tests as $key=>$val){
	$name[] = $val[ 'name' ];
}
array_multisort($name, SORT_ASC, $tests);

if($_REQUEST[ 'conf' ]){
	
	$html = "regMoneyConf";
}
if($_REQUEST[ 'regist' ]){
	foreach($_REQUEST[ 'type' ] as $key=>$val){
		$dat[ 'pid'      ] = $id;
		$dat[ 'type'     ] = $key;
		$dat[ 'dispname' ] = $_REQUEST[ 'dispname' ][ $key ];
		$dat[ 'dispmoney'] = $_REQUEST[ 'money'    ][ $key ];
		$dat[ 'status'   ] = $_REQUEST[ 'status'   ][ $key ];
		$dat[ 'regist_ts'] = date("Y-m-d H:i:s");
		$obj->setData($dat);
	}
	$html = "regMoneyReg";
}

?>