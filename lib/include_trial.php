<?PHP
//----------------------------------
//パートナー情報一覧管理画面メソッド
//
//
//----------------------------------
class trialMethod extends method{
	
	public function getPartner($where){
		$temp_flg = $where[ 'temp_flg' ];
		$eir_id   = $where[ 'eir_id' ];
		$pt  = $where[ 'pt' ];
		$cs  = $where[ 'cs' ];

		$of = $where[ 'offset'  ];
		$li = $where[ 'limit'   ];

		$name = $data[ 'name' ];
		
		$sql = "";
		//購入ライセンス数(t.license)
		$sql .= "SELECT ";
		$sql .= " t.name ";
		$sql .= " ,u.name as ptname";
		$sql .= " ,u2.name as cname";
		$sql .= " ,t.number ";
		$sql .= " ,t.registtime ";
		$sql .= " ,SUM(CASE WHEN tt.exam_state = '2' THEN 1 ELSE 0 END) AS sumi ";
		$sql .= " ,SUM(CASE WHEN tt.exam_state = '1' OR tt.exam_state = '0' THEN 1 ELSE 0 END) AS zan ";
		$sql .= " ,SUM(CASE WHEN tt.exam_state = '0' THEN 1 ELSE 0 END) AS mi ";

		$sql .= " FROM ";
		$sql .= " t_test as t";
		$sql .= " INNER JOIN (SELECT id,name FROM t_user ) as u ON u.id=t.partner_id";
		$sql .= " INNER JOIN (SELECT id,name FROM t_user ) as u2 ON u2.id=t.customer_id";
		$sql .= " INNER JOIN (SELECT id,testgrp_id,exam_state FROM t_testpaper ) as tt ON tt.testgrp_id=t.test_id ";
		$sql .= " WHERE ";
		$sql .= " t.temp_flg=".$temp_flg." AND ";
		$sql .= " t.eir_id=".$eir_id." AND ";
		$sql .= " t.test_id !=0 AND ";
		if($pt){
			$sql .= " u.name LIKE '%".$pt."%' AND ";
		}
		if($cs){
			$sql .= " u2.name LIKE '%".$cs."%' AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " GROUP BY test_id ";
		$sql .= "ORDER BY t.registtime DESC ";
		if($li){
			$sql .= " limit ".$li." offset ".$of." ";
		}
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $rlt[$i] = $result;
                    $i++;
                }
		return $rlt;

		
	}


	public function getPartnerRow($where){
		$temp_flg = $where[ 'temp_flg' ];
		$eir_id   = $where[ 'eir_id' ];
		
		$sql = "";
		//購入ライセンス数(t.license)
		$sql .= "SELECT ";
		$sql .= " t.id";
		$sql .= " FROM ";
		$sql .= " t_test as t";

		$sql .= " WHERE ";
		$sql .= " t.temp_flg=".$temp_flg." AND ";
		$sql .= " t.eir_id=".$eir_id." AND ";
		$sql .= " t.test_id !=0 AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY t.test_id ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                
		return $row;

		
	}


}
?>
