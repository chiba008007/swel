<?PHP
//-------------------------------------------
//BAテスト結果表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusDel.php");

$obj = new cusDelMethod();

//データ取得
$where[ 'partner_id'  ] = $ptid;
$where[ 'customer_id' ] = $id;
$where[ 'id'          ] = $sec;
$data = $obj->getData($where);
if($_REQUEST[ 'delete' ]){
	$obj->deleteTest($where);
	$html = "delFinish";
}
?>