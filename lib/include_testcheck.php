<?PHP
    class testcheck extends method{
        public function testlist(){
            //一週間前
            $oneweek = date("Y/m/d",strtotime("+1 week"));
            
            
            $sql = " SELECT "
                    . " a.* "
                    . " ,u2.name as partnername"
                    . " ,u2.rep_name as parnerreq_name"
                    . " ,u2.rep_email as partnerreq_email"
                    . " FROM ("
                    . "SELECT "
                    . " t.id "
                    . " ,t.partner_id "
                    . " ,t.customer_id"
                    . " ,t.name as testname"
                    . " ,t.period_to "
                    . " ,u.name as username"
                    . " ,u.rep_name"
                    . " ,u.rep_email"
                    . " FROM "
                    . " t_test as t "
                    . " LEFT JOIN t_user as u ON u.id = t.customer_id"
                    . " WHERE "
                    . " t.enabled = 1 AND "
                    . " t.del = 0 AND "
                    . " t.test_id = 0 AND "
                    . " t.period_to = '".$oneweek."'"
                    . ") as a "
                    . " LEFT JOIN t_user as u2 ON u2.id = a.partner_id ";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $list = array();
            $i=0;
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $rlt[$i] = $result;
                    $i++;
            }
            return $rlt;
        }


    }
?>
