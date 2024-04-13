<?PHP
require_once("./lib/include_none.php");
$obj = new noneMethod();
$where = [];
$where[ 'partner_id' ] = $id;
$rows = $obj->getData($where);
$row = count($rows);

$limit = 30;
$ceil = ceil($row/$limit)-1;

$p = sprintf("%d",$_REQUEST[ 'page' ]);
$where[ 'limit' ] = $limit;
$where[ 'offset' ] = $limit * $p;

$data = $obj->getData($where);