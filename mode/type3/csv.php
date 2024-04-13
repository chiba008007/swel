<?PHP
//-------------------------------------------
//CSVダウンロード表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusCsv.php");

$obj = new cusCsvMethod();

$where[ 'partner_id'  ] = $ptid;
$where[ 'customer_id' ] = $id;
$where[ 'test_id'     ] = $sec;
$tlist = $obj->getTest($where);
?>