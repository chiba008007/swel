<?PHP
class aacClass extends method{
    public function getData($where = array()){
        $testgrp_id = $where[ 'testgrp_id' ];
        $exam_id = $where[ 'exam_id' ];
        $sql = "SELECT"
                . " MAX(a.id) as maxid,"
                . " a.* "
                . "FROM ("
                . "SELECT "
                . " r.* "
                . " FROM "
                . " aac_member as m "
                . " LEFT JOIN acc_result as r ON r.acc_id = m.id"
                . " WHERE "
                . " m.exam_id='".$exam_id."' "
                . " AND m.testgrp_id='".$testgrp_id."' "
                . ") as a ";
        
        
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $i=0;
            while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){

                $dev1 = round($rlt[ 'dev1' ],1);
                $dev2 = round($rlt[ 'dev2' ],1);
                $dev3 = round($rlt[ 'dev3' ],1);
                $dev4 = round($rlt[ 'dev4' ],1);
                $dev5 = round($rlt[ 'dev5' ],1);
                $dev6 = round($rlt[ 'dev6' ],1);
                $dev7 = round($rlt[ 'dev7' ],1);
                $dev8 = round($rlt[ 'dev8' ],1);
                $dev9 = round($rlt[ 'dev9' ],1);
                $dev10 = round($rlt[ 'dev10' ],1);
                $dev11 = round($rlt[ 'dev11' ],1);
                $dev12 = round($rlt[ 'dev12' ],1);
                $dev13 = round($rlt[ 'dev13' ],1);
                if($dev1 > 0 && $dev1 < 20){ $dev1=20; }elseif($dev1 > 80){$dev1 = 80; }
                if($dev2 > 0 && $dev2 < 20){ $dev2=20; }elseif($dev2 > 80){$dev2 = 80; }
                if($dev3 > 0 && $dev3 < 20){ $dev3=20; }elseif($dev3 > 80){$dev3 = 80; }
                if($dev4 > 0 && $dev4 < 20){ $dev4=20; }elseif($dev4 > 80){$dev4 = 80; }
                if($dev5 > 0 && $dev5 < 20){ $dev5=20; }elseif($dev5 > 80){$dev5 = 80; }
                if($dev6 > 0 && $dev6 < 20){ $dev6=20; }elseif($dev6 > 80){$dev6 = 80; }
                if($dev7 > 0 && $dev7 < 20){ $dev7=20; }elseif($dev7 > 80){$dev7 = 80; }
                if($dev8 > 0 && $dev8 < 20){ $dev8=20; }elseif($dev8 > 80){$dev8 = 80; }
                if($dev9 > 0 && $dev9 < 20){ $dev9=20; }elseif($dev9 > 80){$dev9 = 80; }
                if($dev10 > 0 && $dev10 < 20){ $dev10=20; }elseif($dev10 > 80){$dev10 = 80; }
                if($dev11 > 0 && $dev11 < 20){ $dev11=20; }elseif($dev11 > 80){$dev11 = 80; }
                if($dev12 > 0 && $dev12 < 20){ $dev12=20; }elseif($dev12 > 80){$dev12 = 80; }
                if($dev13 > 0 && $dev13 < 20){ $dev13=20; }elseif($dev13 > 80){$dev13 = 80; }
                 
                
                if($dev1 > 0) $list2[$i][ 'dev1'  ] = sprintf("%-2.1f",$dev1);
                if($dev2 > 0) $list2[$i][ 'dev2'  ] = sprintf("%-2.1f",$dev2);
                if($dev3 > 0) $list2[$i][ 'dev3'  ] = sprintf("%-2.1f",$dev3);
                if($dev4 > 0) $list2[$i][ 'dev4'  ] = sprintf("%-2.1f",$dev4);
                if($dev5 > 0) $list2[$i][ 'dev5'  ] = sprintf("%-2.1f",$dev5);
                if($dev6 > 0) $list2[$i][ 'dev6'  ] = sprintf("%-2.1f",$dev6);
                if($dev7 > 0) $list2[$i][ 'dev7'  ] = sprintf("%-2.1f",$dev7);
                if($dev8 > 0) $list2[$i][ 'dev8'  ] = sprintf("%-2.1f",$dev8);
                if($dev9 > 0) $list2[$i][ 'dev9'  ] = sprintf("%-2.1f",$dev9);
                if($dev10 > 0) $list2[$i][ 'dev10' ] = sprintf("%-2.1f",$dev10);
                if($dev11 > 0) $list2[$i][ 'dev11' ] = sprintf("%-2.1f",$dev11);
                if($dev12 > 0) $list2[$i][ 'dev12' ] = sprintf("%-2.1f",$dev12);
                if($dev13 > 0) $list2[$i][ 'dev13' ] = sprintf("%-2.1f",$dev13);
                
                $regi[$i][ 'regist_ts' ] = $rlt[ 'regist_ts' ];
                
		$i++;
            }
            
            return array($list2,$regi);
            
    }
    
    public function get_age($birth,$regdate){
        
        $reg1 = split(" ",$regdate);
        $reg = split("-",$reg1[0]);

      $ty = $reg[0];
      $tm = $reg[1];
      $td = $reg[2];
      list($by, $bm, $bd) = explode('/', $birth);
      $age = $ty - $by;
      if($tm * 100 + $td < $bm * 100 + $bd) $age--;
      return $age;
    }
        
}
?>
