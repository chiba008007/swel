<?PHP
require_once("./lib/include_log.php");

$obj = new logMethod();
$row = $obj->getDataAdminRow();
$limit = 5;

$ceil = ceil($row/$limit)-1;

$p = sprintf("%d",$_REQUEST[ 'p' ]);

$where = [];
$where[ 'offset' ] = $limit * $p;
$where[ 'limit'  ] = $limit;
$admin = $obj->getDataAdmin($where);
