<?php
//var_dump($id,$ptid);

require_once("./init/init.php");
require_once('./all/lib/lib_makePDF.php');

$obj = new createPDF($id,$ptid,$sec);

$where = [];
$where[ 'pt_id' ] = $ptid;
$where[ 'customer_id' ] = $id;
$where[ 'test_id' ] = $sec;
$where[ 'limit' ] = 10;
$pdfall = $obj->getFilePDFPartner($where);

?>