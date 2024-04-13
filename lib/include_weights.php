<?PHP
class weightsClass extends method{
    public function getMember($testgrp_id){
        $sql = "SELECT  "
                . "*"
                . ", CASE "
                . "     WHEN complete_flg = '1' THEN '受検済み'"
                . "     WHEN complete_flg = '2' THEN '未受検' "
                . " END as examStatus "
                . "  "
                . " FROM "
                . "t_testpaper "
                . "WHERE "
                . "testgrp_id=".$testgrp_id;
        
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $ary = array();
        $i = 0;
        while($rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $ary[$i] = $rlt;
            if($rlt[ 'birth' ]){
                $age = (int) ((date('Ymd')-preg_replace("/\//","",$rlt['birth']))/10000);
            }else{
                $age = "";
            }
            $ary[$i][ 'age' ] = $age;
            $i++;
        }
        return $ary;
    }
    public function getWeight($testgrp_id){
        $sql = "SELECT  "
                . " customer_id,partner_id "
                . " FROM "
                . "t_testpaper "
                . "WHERE "
                . "testgrp_id=".$testgrp_id.""
                . " GROUP BY customer_id,partner_id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                
        $sql = "SELECT "
                . "* "
                . "FROM "
                . " t_weight_master "
                . " WHERE "
                . " uid = ".$rlt[ 'customer_id' ]." AND "
                . " pid=".$rlt[ 'partner_id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $ary = array();
        while($array = $stmt->fetch(PDO::FETCH_ASSOC) ){
            
            $ary[]  = $array;
        }
        return $ary;
    }
}
?>
