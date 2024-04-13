<?PHP
class inspectionMethod extends method{
    public function getUserData($where){
        $limit = $where[ 'limit' ];
        $offset = $where[ 'offset' ];
        $searchid = $where[ 'searchid' ];
        $searchname = $where[ 'searchname' ];
        $searchkana = $where[ 'searchkana' ];
        $searchfrom = $where[ 'searchfrom' ];
        $searchto = $where[ 'searchto' ];
        
        $sql = "SELECT * FROM (";
        $sql .= "SELECT ";
        if($where[ 'limit' ]){
            $sql .= " tt.name"
                    . ",tt.id"
                    . ",tt.kana"
                    . ",tt.exam_id"
                    . ",DATE_FORMAT(tt.exam_date,'%Y/%m/%d') as exam_date"
                    . ",tt.birth"
                    . ",tt.sex"
                    . ",tt.inspection"
                    . ",tt.enterdate"
                    . ",tt.retiredate"
                    . ",tt.retirereason"
                    . ",tt.evaluation"
                    . ",tt.adopt"
                    . ",tt.memo1"
                    . ",tt.memo2"
                    . ",t.name as testname";
        }else{
            $sql .= " COUNT(tt.id) as cnt ";
        }
        $sql .= " FROM ";
        $sql .= " t_testpaper as tt "
                . " LEFT JOIN t_test as t "
                . " ON t.id = tt.test_id "
                . "WHERE "
                . " tt.partner_id=".$where[ 'partner_id' ]." AND "
                . " tt.customer_id=".$where[ 'customer_id' ]." AND "
                . " tt.complete_flg = 1 ";
        if($searchid){
            $sql .= " AND tt.exam_id LIKE '%".$searchid."%'";
        }
        if($searchname){
            $sql .= " AND tt.name LIKE '%".$searchname."%'";
        }
        if($searchkana){
            $sql .= " AND tt.kana LIKE '%".$searchkana."%'";
        }
        
         $sql .= " ORDER BY tt.test_id ASC";
        if($where[ 'limit' ]){
            $sql .= " limit ".$offset.",".$limit;
        }
        $sql .= ") as a WHERE ";
        if($searchfrom){
            $sql .= " a.exam_date >= '".$searchfrom."' AND ";
        }
        if($searchto){
            $sql .= " a.exam_date <= '".$searchto."' AND ";
        }
        $sql .= " 1=1 ";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        if($where[ 'limit' ]){
            $result = [];
            $i=0;
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                $result[$i] = $row;
                $result[$i][ 'age' ] = $this->getAge($row);
                $result[$i][ 'enterdate'  ] = ($row[ 'enterdate' ] == '0000-00-00' )?"":$row[ 'enterdate' ];
                $result[$i][ 'retiredate' ] = ($row[ 'retiredate' ] == '0000-00-00' )?"":$row[ 'retiredate' ];
                $year = substr($row[ 'exam_date' ],0,4);
                $result[$i][ 'exam_year' ] = $year;
                $i++;
            }
            return $result;
        }else{
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row[ 'cnt' ];
        }
	
    }
    
    public function getAge($where){
        $examdate = preg_replace("/\//","",$where[ 'exam_date' ]);
        $date = date($examdate);
        $birth = preg_replace("/\//","",$where[ 'birth' ]);
        return floor(($date-$birth)/10000);

    }
    
    public function getDataOne($where){
        $sql = "SELECT "
                . " * "
                . " FROM "
                . " t_testpaper "
                . " WHERE "
                . " id = ".$where[ 'id' ]." AND "
                . " partner_id = ".$where[ 'partner_id' ]." AND "
                . " customer_id=".$where[ 'customer_id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
}
?>