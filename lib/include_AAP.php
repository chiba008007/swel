<?PHP
class aapClass extends method{
   public function checklogin($where){
       $gender = $where[ 'gender' ];
       $testgrp_id = $where[ 'testgrp_id' ];
       $sql = ""
               . "SELECT "
               . " * "
               . " FROM "
               . " t_testpaper "
               . " WHERE "
               . " testgrp_id=".$testgrp_id." "
               . " AND exam_id='".filter_input(INPUT_POST,"exam_id")."'";
       
       $stmt = $this->db->prepare($sql);
       $stmt->execute();
       $list = $stmt->fetch(PDO::FETCH_ASSOC);
       if($list == false ){
           return false;
       }

       $test_id = $list[ 'test_id' ];
       $sql = "SELECT "
               . " * "
               . " FROM "
               . " aap_member "
               . " WHERE "
               . " testgrp_id=".$testgrp_id." "
               . "  AND exam_id='".filter_input(INPUT_POST,"exam_id")."'"
               . " AND gender=".$gender;

       $stmt = $this->db->prepare($sql);
       $stmt->execute();
       $list2 = $stmt->fetch(PDO::FETCH_ASSOC);
       
       if($list2['finflg'] == 1){
            return false;
       }
       if(!$list2){
           $sql = "INSERT INTO aap_member ( "
                   . " gender"
                   . " ,test_id"
                   . " ,testgrp_id"
                   . " ,exam_id"
                   . " ,start_time "
                   
                   . " )VALUES( "
                   . " '".$gender."'"
                   . " ,'".$test_id."'"
                   . " ,'".$testgrp_id."'"
                   . " ,'".filter_input(INPUT_POST,"exam_id")."'"
                   . " ,'".date('Y-m-d H:i:s')."'"
                   . ")";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
       }
       return true;
   }
   
   public function getPdfData($where){
       $exam_id = $where[ 'exam_id' ];
       $testgrp_id = $where[ 'testgrp_id' ];
       $sql = ""
               . " SELECT "
               . "m.id"
               . ",m.gender"
               . ",m.birthday"
               . ",m.start_time"
               . ",s.ans75"
               . ",r.dev1"
               . ",r.dev2"
               . ",r.dev3"
               . ",r.dev4"
               . ",r.dev5"
               . ",r.dev6"
               . ",r.dev7"
               . ",r.dev8"
               . ",r.dev9"
               . ",r.dev10"
               . ",r.dev11"
               . ",r.dev12"
               . ",r.con1"
               . ",r.con2"
               . ",r.con3"
               . ",r.con4"
               . ",r.con5"
               . ",r.con6"
               . " FROM "
               . " aap_member as m "
               . " LEFT JOIN  aap_sec as s ON m.id = s.aap_id "
               . " LEFT JOIN aap_result as r ON m.id = r.aap_id"
               . " WHERE "
               . " m.testgrp_id=".$testgrp_id." "
               . " AND m.exam_id='".$exam_id."'"
               . " AND m.finflg=1";
       $stmt = $this->db->prepare($sql);
       $stmt->execute();
       $i=0;
       while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
           $list[ $rlt[ 'gender' ] ] = $rlt;
           $i++;
       }
       $sql = ""
               . "SELECT "
               . "  name as man"
               . ",kana as woman"
               . "  FROM "
               . " t_testpaper "
               . " WHERE "
               . "  testgrp_id=".$testgrp_id.""
               . " AND exam_id='".$exam_id."'"
               . " AND type=57"
               . " ";
       
       $stmt = $this->db->prepare($sql);
       $stmt->execute();
       $rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);
       $list[ 1 ][ 'man' ] = $rlt2[ 'man' ];
       $list[ 2 ][ 'woman' ] = $rlt2[ 'woman' ];
       return $list;
   }
   
  //  public function get_age($birth,$regdate){
        
  //       $reg1 = explode(" ",$regdate);
  //       $reg = explode("-",$reg1[0]);

  //     $ty = $reg[0];
  //     $tm = $reg[1];
  //     $td = $reg[2];
  //     list($by, $bm, $bd) = explode('/', $birth);
  //     $age = $ty - $by;
  //     if($tm * 100 + $td < $bm * 100 + $bd) $age--;
  //     return $age;
  //   }
    public function get_age2($birth,$regdate){
      $reg1 = explode(" ",$regdate);
      $reg = explode("-",$reg1[0]);

      $ty = $reg[0];
      $tm = $reg[1];
      $td = $reg[2];
      list($by, $bm, $bd) = explode('-', $birth);
      $age = $ty - $by;
      if($tm * 100 + $td <= $bm * 100 + $bd) $age--;
      
      return $age;
    }
    
    public function getDownPdfList($where,$flg=""){
        
        $sql = ""
                . "SELECT "
                . "m.exam_id"
                . ",m.gender"
                . ",m.birthday"
                . ",m.start_time"
                . ", CASE WHEN m.finflg = 1 THEN '受検済み' ELSE '受検中 ' END as sts "
                . ", CASE WHEN m.gender = 1 THEN '男性' ELSE '女性 ' END as gendername "
                . ",r.* "
                . ",t.name"
                . ",t.kana"
                . ",t.type "
                . " FROM "
                . " aap_member as m "
                . " LEFT JOIN aap_result as r ON r.aap_id = m.id "
                . " LEFT JOIN (SELECT number,testgrp_id,exam_id,name,kana,type FROM t_testpaper WHERE testgrp_id=".$where[ 'test_id' ].")as t ON t.testgrp_id=m.testgrp_id AND t.exam_id=m.exam_id"
                . " WHERE "
                . " m.testgrp_id=".$where[ 'test_id' ]." AND "
                . " t.testgrp_id=".$where[ 'test_id' ]."  ";
            if($flg == "complete") $sql .= " AND m.finflg = 1 ";
        
            $sql .= "GROUP BY m.id ORDER BY t.number";

       $stmt = $this->db->prepare($sql);
       $stmt->execute();
       
       $list = array();
       $i = 0;
       while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
           $list[$i] = $rlt;
           $i++;
       }
       return $list;
               
    }
    
    //ストレスデータ取得
    public function getStress($dev1, $dev2) {
      $ave = ($dev1 + $dev2) / 2;
      $roundedAve = round($ave, 1);
      if ($ave < 30) {
        $st_level = 1;
        $st_score = $roundedAve;
      } else if ($ave < 35) {
        if ($dev1 < 40 && $dev2 < 40) {
          $st_level = 1;
          $st_score = $roundedAve;
        } else {
          $st_level = 2;
          $st_score = 35;
        }
      } else if ($ave < 40) {
        if ($dev1 < 40 && $dev2 < 40) {
          $st_level = 1;
          $st_score = 34.9;
        } else if ($dev1 < 30 || $dev2 < 30) {
          $st_level = 2;
          $st_score = $roundedAve;
        } else {
          $st_level = 3;
          $st_score = 45;
        }
      } else if ($ave < 45) {
        if ($dev1 < 30 || $dev2 < 30) {
          $st_level = 2;
          $st_score = $roundedAve;
        } else if ($dev1 < 50 && $dev2 < 50) {
          $st_level = 3;
          $st_score = 45;
        } else {
          $st_level = 4;
          $st_score = 55;
        }
      } else if ($ave < 50) {
        if ($dev1 < 30 || $dev2 < 30) {
          $st_level = 2;
          $st_score = 44.9;
        } else if ($dev1 < 50 && $dev2 < 50) {
          $st_level = 3;
          $st_score = $roundedAve;
        } else {
          $st_level = 4;
          $st_score = 55;
        }
      } else if ($ave < 55) {
        if ($dev1 < 30 || $dev2 < 30) {
          $st_level = 2;
          $st_score = 44.9;
        } else {
          $st_level = 4;
          $st_score = 55;
        }
      } else if ($ave < 60) {
        if ($dev1 < 50 || $dev2 < 50) {
          $st_level = 4;
          $st_score = $roundedAve;
        } else if ($dev1 < 60 && $dev2 < 60) {
          $st_level = 4;
          $st_score = $roundedAve;
        } else {
          $st_level = 5;
          $st_score = 65;
        }
      } else if ($ave < 65) {
        if ($dev1 < 50 || $dev2 < 50) {
          $st_level = 4;
          $st_score = $roundedAve;
        } else {
          $st_level = 5;
          $st_score = 65;
        }
      } else {
        $st_level = 5;
        $st_score = $roundedAve;
      }
      return array($st_level, $st_score);
    }
        
    
}
?>
