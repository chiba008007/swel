<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("./lib/include_info.php");
$obj = new infoMethod();
if($_REQUEST[ 'type' ] == "hidden"){
   //非表示判定データ登録
    $table = "information_hidden";
    $set = array();
    $set[ 'uid' ] = $id;
    $set[ 'infoid' ] = $_REQUEST[ 'infoid' ];
    $set[ 'regist_ts' ] = date("Y-m-d H:i:s");
    $db->setUserData($table,$set);
    exit();
}
$where = array();
$where[ 'id' ] = $sec;
$info = $obj->getInfo($where);
$ex = explode("-",$info[0][ 'date1' ]);
$ex2 = explode("-",$info[0][ 'date2' ]);

$info[0][ 'st' ] = $ex[0]."年".$ex[1]."月".$ex[2]."日";
$info[0][ 'ed' ] = $ex2[0]."年".$ex2[1]."月".$ex2[2]."日";

//既読判定データ登録
$table = "information_read";
$set = array();
$set[ 'uid' ] = $id;
$set[ 'infoid' ] = $sec;
$set[ 'regist_ts' ] = date("Y-m-d H:i:s");
$db->setUserData($table,$set);

