<?PHP
//----------------------------------
//グラフ
//
//
//----------------------------------
class graphMethod extends method{
    function getTestDataTotalCount($where){
        $testgrp_id = $where[ 'testgrp_id' ];
        $sql = "SELECT "
                . " id "
                . " FROM t_testpaper "
                . " WHERE "
                . " exam_state = 2"
                . " AND type IN( 1,2,12) "
                . " AND testgrp_id=".$testgrp_id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row = $stmt->rowCount();
        
        return $row;
    }
    function getTestDataLevelCount($where){
        $testgrp_id = $where[ 'testgrp_id' ];
        $sql = "SELECT "
                . " stress_flg "
                . "FROM "
                . " t_test "
                . " WHERE "
                . " test_id=".$testgrp_id.""
                . " AND type IN( 1,2,12) ";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
        $stflg = $row1['stress_flg'];
        
        $sql = "SELECT "
                . " dev1 ,dev2,dev3,dev4,dev5,dev6,dev7,dev8,dev9,dev10,dev11,dev12 "
                . " FROM t_testpaper "
                . " WHERE "
                . " exam_state = 2"
                . " AND type IN( 1,2,12) "
                . " AND testgrp_id=".$testgrp_id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
       $i=0;
       while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
           $list[ 'data' ][$i] = $row;
           $i++;
       }
       $list[ 'stress' ] = $stflg;
        return $list;
    }
    function getTestDataDev($where){
        $testgrp_id = $where[ 'testgrp_id' ];
        $sql = " SELECT "
                . "( a.dev1/cnt ) as d1"
                . ",( a.dev2/cnt ) as d2"
                . ",( a.dev3/cnt ) as d3"
                . ",( a.dev4/cnt ) as d4"
                . ",( a.dev5/cnt ) as d5"
                . ",( a.dev6/cnt ) as d6"
                . ",( a.dev7/cnt ) as d7"
                . ",( a.dev8/cnt ) as d8"
                . ",( a.dev9/cnt ) as d9"
                . ",( a.dev10/cnt ) as d10"
                . ",( a.dev11/cnt ) as d11"
                . ",( a.dev12/cnt ) as d12"
                . " FROM ("
                . "SELECT "
                . "COUNT( id ) as cnt"
                . ",SUM(dev1) as dev1 "
                . ",SUM(dev2) as dev2 "
                . ",SUM(dev3) as dev3 "
                . ",SUM(dev4) as dev4 "
                . ",SUM(dev5) as dev5 "
                . ",SUM(dev6) as dev6 "
                . ",SUM(dev7) as dev7 "
                . ",SUM(dev8) as dev8 "
                . ",SUM(dev9) as dev9 "
                . ",SUM(dev10) as dev10 "
                . ",SUM(dev11) as dev11 "
                . ",SUM(dev12) as dev12 "
                . " FROM "
                . " t_testpaper "
                . " WHERE "
                . " exam_state = 2 "
                . " AND type IN( 1,2,12) "
                . " AND testgrp_id=".$testgrp_id.""
                . ") as a";
        
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public function getElement($id){
        
        $sql = "SELECT * FROM t_element "
                . "WHERE "
                . " element_status = 1 "
                . " AND uid = ".$id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
}
?>
