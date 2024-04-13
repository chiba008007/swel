<?PHP
//-------------------------------------------
//ROWデータ表示
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_row.php");
$orow = new rowMethod($id);
$where = array();
$where[ 'eir_id' ] = $id;
$rowlist = $orow->getTestType($where,$a_test_type);
?>