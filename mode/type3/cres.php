<?PHP
require_once("./lib/include_cres.php");
$obj = new cres();
$limit = 30;

$where = [];
$where['customer_id']=$id;
$where['testgrp_id'] = $sec;
$where['id'] = $_REQUEST[ 'id' ];
$where['name'] = $_REQUEST[ 'name' ];
$where['kana'] = $_REQUEST[ 'kana' ];
$total = $obj->getTtestPaper($where,1);
$where[ 'limit'  ] = $limit;
$p = sprintf("%d",$_REQUEST[ 'p' ]);
$where[ 'offset' ] = $limit*$p;
$tests = $obj->getTtestPaper($where);
$ceil = ceil($total/$limit);

//ユーザーデータ
$usr = $obj->getUserData();


