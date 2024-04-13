<?PHP
//----------------------------------
//csvアップロードメソッド
//
//
//----------------------------------
class cusCsvFmMethod extends method{

	public function getData($where){
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		$testgrp_id  = $where[ 'testgrp_id'  ];
		
		$sql = "";
		$sql = "SELECT";
		$sql .= " number, ";
		$sql .= " exam_id, ";
		$sql .= " name, ";
		$sql .= " kana, ";
		$sql .= " birth, ";
		$sql .= " memo1,";
		$sql .= " memo2,";
		$sql .= " tensaku_name,";
		$sql .= " tensaku_mail";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$testgrp_id." AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY number ";
		$sql .= " ORDER BY number ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result =  $stmt->fetch(PDO::FETCH_ASSOC) ){
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
	}
	
	public function tensakuSts($where){
		$sql = "
				SELECT 
					*
				FROM
					t_test
				WHERE
					test_id = '".$where[ 'test_id' ]."' AND
					type='".$where[ 'type' ]."'
				";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$row = $stmt->rowCount();
		return $row;
	}
}
?>
