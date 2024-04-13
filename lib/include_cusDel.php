<?PHP
//----------------------------------
//検査削除メソッド
//
//
//----------------------------------
class cusDelMethod extends method{
	public function getData($where){
		$cid  = $where[ 'customer_id' ];
		$pid  = $where[ 'partner_id'  ];
		$id   = $where[ 'id'          ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name, ";
		$sql .= " period_to,";
		$sql .= " period_from";
		$sql .= " FROM ";
		$sql .= " t_test";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " id =".$id." AND ";
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function deleteTest($where){
		$cid  = $where[ 'customer_id' ];
		$pid  = $where[ 'partner_id'  ];
		$id   = $where[ 'id'          ];

		$sql = "";
		$sql = "DELETE FROM t_test";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " partner_id=".$pid;
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                
		$sql = "";
		$sql = "DELETE FROM t_test";
		$sql .= " WHERE ";
		$sql .= " test_id=".$id." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " partner_id=".$pid;

		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                
		$sql = "";
		$sql = "DELETE FROM t_testpaper";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$id." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " partner_id=".$pid;

		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		
	}
}
?>
