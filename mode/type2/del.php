<?PHP
//-------------------------------------------
//パートナー情報削除
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_ptnDel.php");

$obj = new ptnDelMethod();

//登録情報取得
$where[ 'id' ] = $sec;
$data = $obj->getUser($where);
$user = $data[0];

if($_REQUEST[ 'delete' ]){
	//テストデータは削除しません。
	//一度販売したテストの為
	$where = array();
	$where[ 'id'         ] = $sec;
	$where[ 'partner_id' ] = $id;
	$obj->deleteUser($where);
	$html = "delDelete";
}
?>