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

//受検者一覧取得
$mem = $obj->getTamenTestDataList($where,$array_tamen_type);

?>
