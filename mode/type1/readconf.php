<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("./lib/include_method.php");
$db = new method();
$dbs = $db->db;
$data = getInfo($sec,$dbs);
$limit = array();
$li = 20;
$limit[ 'limit'  ] = $li;
$limit[ 'offset' ] = sprintf("%d",$_REQUEST[ 'pg' ]*$li);
$count = getList($sec,"",$dbs);
$ceil = ceil($count/$li)-1;
$list = getList($sec,$limit,$dbs);
function getInfo($id,$dbs){
    $sql = "SELECT "
            . " * "
            . " FROM information_tbl "
            . " WHERE "
            . " id = ".$id;

    $stmt = $dbs->prepare($sql);
    $stmt->execute();
    $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                
    $ex1 = explode("-",$rlt[ 'date1' ]);
    $ex2 = explode("-",$rlt[ 'date2' ]);
    $rlt[ 'd1' ] = $ex1[0]."年".$ex1[1]."月".$ex1[2]."日";
    $rlt[ 'd2' ] = $ex2[0]."年".$ex2[1]."月".$ex2[2]."日";
    return $rlt;
}
function getList($id,$limit = "",$db){
    
    $sql = " SELECT "
            . " a.*"
            . ",(SELECT name FROM t_user WHERE id=a.partner_id ) as pt "
            . "FROM ("
            . "SELECT "
            . " i.uid "
            . ",u.name "
            . ",u.type"
            . ",u.partner_id "
            . ",DATE_FORMAT(MAX(i.regist_ts ),'%Y年%c月%e日 %H:%i:%s') as regdate "
            . " FROM information_read  as i"
            . " LEFT JOIN t_user as u ON i.uid=u.id "
            . " WHERE infoid =  ".$id
            . " GROUP BY i.uid "
            . " ) as a "
            . " ORDER BY a.regdate DESC ";
    if($limit){
            $l = $limit[ 'limit'  ];
            $o = $limit[ 'offset' ];
           $sql .= " limit ".$o.",".$l."";
    }else{
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
    //$r = mysql_query($sql);
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $i = 0;
    while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
        $list[$i] = $rlt;
        $list[ $i ][ 'partner'  ] = "";
        $list[ $i ][ 'customer' ] = "-";
        if($rlt[ 'type' ] == 2){
            $list[ $i ][ 'partner' ] = $rlt[ 'name' ];
        }else
        if($rlt[ 'type' ] == 3){
            $list[ $i ][ 'partner' ] = $rlt[ 'pt' ];
            $list[ $i ][ 'customer' ] = $rlt[ 'name' ];
        }
         $i++;
    }
    return $list;
}