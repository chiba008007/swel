<?PHP
//-------------------------------------------
//グラフ表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_graph.php");
require_once("./lib/include_dataList.php");
$obj = new graphMethod();
$obj2 = new dataListMethod();
if( strlen($_REQUEST[ 'graph_status' ]) > 0){
   
    //グラフ表示ボタンの切り替え
    $table = "t_test";
    $where = array();
    $where[ 'where' ][ 'test_id'     ] = $sec;
    $where[ 'edit' ][ 'graph_status' ] = $_REQUEST[ 'graph_status' ];
    $obj->editUserData($table,$where);
    
    exit();
}
$where[ 'testgrp_id' ] = $sec;
$count = $obj->getTestDataTotalCount($where);
//固定グラフの値
/*
$fix1 = $count*(5/100);
$fix2 = $count*(5/100);
$fix3 = $count*(25/100);
$fix4 = $count*(45/100);
$fix5 = $count*(20/100);
*/
$fix1 = 5;
$fix2 = 5;
$fix3 = 25;
$fix4 = 45;
$fix5 = 20;

$lv = $obj->getTestDataLevelCount($where);

$stress_flg = $lv[ 'stress' ];
if(count($lv[ 'data' ])){
    foreach($lv[ 'data' ] as $key=>$val){
        $dev1 = $val[ 'dev1' ];
        $dev2 = $val[ 'dev2' ];
        $dev3 = $val[ 'dev3' ];
        $dev6 = $val[ 'dev6' ];
        if(!$val[ 'stress_flg' ]){
            list($lv,$score) = $obj2->getStress($dev1,$dev2);
            $level[$lv] += 1;
        }else{
            list($lv,$score) = $obj2->getStress2($dev1,$dev2,$dev6);
            $level[$lv] += 1;
        }
    }
}
//var_dump($level,$count);
$set1 = @round(($level[1]/$count)*100);
$set2 = @round(($level[2]/$count)*100);
$set3 = @round(($level[3]/$count)*100);
$set4 = @round(($level[4]/$count)*100);
$set5 = @round(($level[5]/$count)*100);

//var_dump($id);
$point = $obj->getTestDataDev($where);

$d1 = round($point[ 'd1' ]);
$d2 = round($point[ 'd2' ]);
$d3 = round($point[ 'd3' ]);
$d4 = round($point[ 'd4' ]);
$d5 = round($point[ 'd5' ]);
$d6 = round($point[ 'd6' ]);
$d7 = round($point[ 'd7' ]);
$d8 = round($point[ 'd8' ]);
$d9 = round($point[ 'd9' ]);
$d10 = round($point[ 'd10' ]);
$d11 = round($point[ 'd11' ]);
$d12 = round($point[ 'd12' ]);

$element = $obj->getElement($id);

$str1 =  ($element[ 'e_feel' ])?$element[ 'e_feel' ]:$a_element[ 'w1' ];
$str2 =  ($element[ 'e_cus'  ])?$element[ 'e_cus'  ]:$a_element[ 'w2' ];
$str3 =  ($element[ 'e_aff'  ])?$element[ 'e_aff'  ]:$a_element[ 'w3' ];
$str4 =  ($element[ 'e_cntl' ])?$element[ 'e_cntl' ]:$a_element[ 'w4' ];
$str5 =  ($element[ 'e_vi'   ])?$element[ 'e_vi'   ]:$a_element[ 'w5' ];
$str6 =  ($element[ 'e_pos'  ])?$element[ 'e_pos'  ]:$a_element[ 'w6' ];
$str7 =  ($element[ 'e_symp' ])?$element[ 'e_symp' ]:$a_element[ 'w7' ];
$str8 =  ($element[ 'e_situ' ])?$element[ 'e_situ' ]:$a_element[ 'w8' ];
$str9 =  ($element[ 'e_hosp' ])?$element[ 'e_hosp' ]:$a_element[ 'w9' ];
$str10 =  ($element[ 'e_lead'])?$element[ 'e_lead' ]:$a_element[ 'w10' ];
$str11 =  ($element[ 'e_ass' ])?$element[ 'e_ass'  ]:$a_element[ 'w11' ];
$str12 =  ($element[ 'e_adap' ])?$element[ 'e_adap' ]:$a_element[ 'w12' ];
?>