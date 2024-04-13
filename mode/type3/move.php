<?PHP
require_once("./lib/include_move.php");
$obj = new moveMethod();


if(filter_input(INPUT_POST,"move")){

    $obj->moveTest($sec,$third);
    header("Location:/index/data/".$sec);
    exit();
}


if(filter_input(INPUT_POST,"flag") == "company"){
    $company = $obj->getCompany();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($company);
    exit();
}
if(filter_input(INPUT_POST,"flag") == "tests"){
    $data = $obj->getTests($sec);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit();
}

$partner = $obj->getPartner();

?>