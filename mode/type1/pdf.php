<?PHP
require_once("./lib/include_pdfAll.php");
$obj = new pdfAll();

if(
    $_REQUEST[ 'tid' ]
    && $_REQUEST[ 'pid' ]
){
    $test = $obj->getTestData();
    header('Content-type: application/json');
    echo json_encode($test);

    exit();
}

if($_REQUEST[ 'tid' ]){
    $partner = $obj->getPartner();
    header('Content-type: application/json');
    echo json_encode($partner);
    exit();
}

$user = $obj->getUserData();

?>