<?PHP
//--------------------------------
//ID QRコード表示
//
//
//------------------------------------
require_once("./lib/include_cusQr.php");
$obj = new cusQrMethod();
$where[ 'partner_id'     ] = $ptid;
$where[ 'customer_id'    ] = $id;
$where[ 'id'             ] = $sec;

$test = $obj->getTestData($where);
$code = base64_encode($test[ "dir" ]);

$use = $obj->getUsersData($where);
//受検者一覧取得
$mem = $obj->getTestDataList($where,$a_test_type);
if(
        $obj->test52 == 52
        || $obj->test52 == 60
        || $obj->test52 == 62
    || $obj->test52 == 67
    || $obj->test52 == 68
    || $obj->test52 == 86
    || $obj->test52 == 87
    || $obj->test52 == 89
    || $obj->test52 == 90
        ){
	//評価検査の時
	$mem = array();
	$mem = $obj->getTestJug($where);
    if(!$mem){
        $test[ 'number' ] = 0;
    }else{
	    $test[ 'number' ] = count($mem);
    }
}
?>
