<?PHP
require_once("./lib/include_log.php");

$obj = new logMethod();
$row = $obj->getDataExamRow();
$limit = 5;

$ceil = ceil($row/$limit)-1;

$p = sprintf("%d",$_REQUEST[ 'p' ]);

$where = [];
$where[ 'offset' ] = $limit * $p;
$where[ 'limit'  ] = $limit;
$exam = $obj->getDataExam($where);
