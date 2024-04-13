<?PHP
class moveMethod extends method{
   
    public function getPartner(){
        $sql = "SELECT "
                . " id,name "
                . " FROM "
                . " t_user "
                . " WHERE "
                . " type= 2 "
                . " ORDER BY registtime DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $list = array();
        $i=0;
        while($list = $stmt->fetch(PDO::FETCH_ASSOC)){
                $rlt[$i] = $list;
                $i++;
        }
        return $rlt;
    }
    public function getCompany(){
        $pid = filter_input(INPUT_POST,"pid");
        $sql = "SELECT "
                . " id,name "
                . " FROM "
                . " t_user "
                . " WHERE "
                . " partner_id=".$pid.""
                . " ORDER BY registtime DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $list = array();
        $i=0;
        while($list = $stmt->fetch(PDO::FETCH_ASSOC)){
                $rlt[$i] = $list;
                $i++;
        }
        return $rlt;
    }
    public function getTests($sec){
        $sql = "SELECT "
                . " GROUP_CONCAT(type SEPARATOR '-' ) as line "
                . " FROM "
                . " t_test "
                . " WHERE "
                . " test_id = ".$sec;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $list = $stmt->fetch(PDO::FETCH_ASSOC);
        $cid = filter_input(INPUT_POST,"cid");
        $pid = filter_input(INPUT_POST,"pid");
        
        $sql = " SELECT * FROM ("
                . " SELECT "
                . " id,name,GROUP_CONCAT(type SEPARATOR '-' ) as line ,registtime"
                . " FROM "
                . " t_test "
                . " WHERE "
                . " test_id != 0 AND "
                . " customer_id=".$cid." AND "
                . " partner_id= ".$pid." "
                . " GROUP BY test_id ) as a "
                . " WHERE "
                . " a.line = '".$list[ 'line' ]."' "
                . " ORDER BY registtime DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $list = array();
        $i=0;
        while($list = $stmt->fetch(PDO::FETCH_ASSOC)){
                $rlt[$i] = $list;
                $i++;
        }
        return $rlt;
        
    }
    
    public function moveTest($sec,$third){
        $this->sec = $sec;
        $testid = filter_input(INPUT_POST,"testid");
        //testgrp_idの取得
        $sql = " SELECT "
                . " test_id "
                . " FROM "
                . " t_test "
                . " WHERE "
                . " id = ".$testid;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->partnerid = filter_input(INPUT_POST,"partnerid");
        $this->customerid = filter_input(INPUT_POST,"customerid");

        //テスト数の調整
        $sql = "UPDATE t_test SET "
                . " `number` = `number`-1 "
                . " WHERE "
                . " id = ".$sec;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $sql = " UPDATE t_test SET "
                . " `number` = `number`-1 "
                . " WHERE "
                . " test_id=".$sec;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        

        $sql = "UPDATE t_test SET "
                . " `number` = `number`+1 "
                . " WHERE "
                . " id = ".$row[ 'test_id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $sql = " UPDATE t_test SET "
                . " `number` = `number`+1 "
                . " WHERE "
                . " test_id=".$row[ 'test_id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        //重みがある場合再計算
 
        $this->reCulc($third);
        
        //行動価値以外のテスト移動
        
    }
    public function reCulc($third){
        
        $this->third = $third;
                
    //    $partnerid = filter_input(INPUT_POST,"partnerid");
     //   $customerid = filter_input(INPUT_POST,"customerid");
        $testid = filter_input(INPUT_POST,"testid");
      //  var_dump($third,$partnerid,$customerid,$testid);
        $sql = "SELECT * FROM "
                . " t_testpaper "
                . " WHERE "
                . " testgrp_id = ".$this->sec.""
                . " AND exam_id='".$third."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC) ){

             if($row[ 'type' ] == 12){
                 $this->baj3($row);
             }
             if($row[ 'type' ] == 1){
                 $this->baj($row);
             }
             if($row[ 'type' ] == 2){
                 $this->baj2($row);
             }
             if($row[ 'type' ] == 7){
                  $this->eabj($row);
             }
            
             if($row[ 'type' ] == 50){
                  $this->mea();                 
             }
        }
       
    }
    public function getgrpid($id,$type){
        $sql = "SELECT id,test_id FROM t_test"
                . " WHERE "
                . " test_id = (SELECT test_id FROM t_test WHERE id = ".$id.") "
                . " AND type = ".$type;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
         
        $sql = "SELECT MAX(number) as max  FROM t_testpaper WHERE testgrp_id = ".$rlt[ 'test_id' ]." AND type=".$type;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->max = $row2[ 'max' ]+1;
        
        $sql = "UPDATE t_testpaper SET "
                . " number = ".$this->max
                . " ,partner_id= ".$this->partnerid
                . " ,customer_id= ".$this->customerid." "
                . " ,test_id=".$rlt[ 'id' ]." "
                . " ,testgrp_id=".$rlt[ 'test_id' ]." "
                . " WHERE "
                . " testgrp_id = ".$this->sec." "
                . " AND exam_id = '".$this->third."'"
                . " AND type=".$type;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
       
        return $rlt[test_id];
    }
    public function getid($id,$type){
        $sql = "SELECT "
                . " id "
                . " FROM "
                . " t_test "
                . " WHERE "
                . " test_id= (SELECT test_id FROM t_test WHERE id = ".$id." ) AND"
                . " type = ".$type;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
                
        return $row2[ 'id' ];
    }
    public function mea(){
        $sql = "UPDATE mea_member SET "
                . " test_id=".$this->getid($_REQUEST[ 'testid' ],50).""
                . " ,testgrp_id=".$this->getgrpid($_REQUEST[ 'testid' ],50).""
                . " WHERE "
                . " testgrp_id='".$this->sec."'"
                . " AND exam_id='".$this->third."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
    public function eabj($data){
        $sql = "UPDATE rs_member SET "
                . " test_id=".$this->getid($_REQUEST[ 'testid' ],7).""
                . " ,testgrp_id=".$this->getgrpid($_REQUEST[ 'testid' ],7).""
                . " WHERE "
                . " testgrp_id='".$this->sec."'"
                . " AND exam_id='".$this->third."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

    }
    public function baj($data){
        $this->getgrpid($_REQUEST[ 'testid' ],1);
        include_once(D_PATH_HOME."/lib/keisan/functionBA.php");
        include_once(D_PATH_HOME."/init/rowData/raw_data_ta.php");
        include_once(D_PATH_HOME."/init/rowData/dev_data_ta.php");
        require_once(D_PATH_HOME."t/lib/include_ba.php");
        $obj = new BAmethod();
        $wt[ 'test_id' ] = $data[ 'testgrp_id' ];
        $wt[ 'type' ] = 1;
        $weights = $obj->getWeight($wt);
        list($row,$lv,$standard_score,$dev_number) = BA($data,$weights,$raw_data,$dev_data);
        $sql = "UPDATE t_testpaper SET "
                . " level = ".$lv." "
                . " ,score = ".$standard_score." "
                . " ,soyo=".$dev_number." "
                . " WHERE "
                . " id = ".$data[ 'id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
    public function baj2($data){
        $this->getgrpid($_REQUEST[ 'testid' ],2);
        include_once(D_PATH_HOME."/lib/keisan/functionBA2.php");
        include_once(D_PATH_HOME."/init/rowData/raw_data_tb.php");
        include_once(D_PATH_HOME."/init/rowData/dev_data_tb.php");
        require_once(D_PATH_HOME."t/lib/include_ba.php");
        $obj = new BAmethod();
        $wt[ 'test_id' ] = $data[ 'testgrp_id' ];
        $wt[ 'type' ] = 2;
        $weights = $obj->getWeight($wt);
        list($row,$lv,$standard_score,$dev_number) = BA2($data,$weights,$raw_data,$dev_data);
        $sql = "UPDATE t_testpaper SET "
                . " level = ".$lv." "
                . " ,score = ".$standard_score." "
                . " ,soyo=".$dev_number." "
                . " WHERE "
                . " id = ".$data[ 'id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
    
    public function baj3($data){
        $this->getgrpid($_REQUEST[ 'testid' ],12);
        include_once(D_PATH_HOME."/lib/keisan/functionBA12.php");
        include_once(D_PATH_HOME."/init/rowData/raw_data_ta3.php");
        include_once(D_PATH_HOME."/init/rowData/dev_data_ta3.php");
        require_once(D_PATH_HOME."t/lib/include_ba.php");
        $obj = new BAmethod();
        $wt[ 'test_id' ] = $data[ 'testgrp_id' ];
        $wt[ 'type' ] = 12;
        $weights = $obj->getWeight($wt);
        list($row,$lv,$standard_score,$dev_number) = BA12($data,$weights,$raw_data,$dev_data);
        $sql = "UPDATE t_testpaper SET "
                . " level = ".$lv." "
                . " ,score = ".$standard_score." "
                . " ,soyo=".$dev_number." "
                . " WHERE "
                . " id = ".$data[ 'id' ];
       $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
    
}
?>
