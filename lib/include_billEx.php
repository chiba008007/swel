<?PHP
//----------------------------------
//納品書作成メソッド
//
//
//----------------------------------
class billexMethod extends method{
	public function getBillData($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_bill ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
		$sql .= " ORDER BY id DESC ";

		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;

	}

	public function getBillDetail($where){
		
		$id = $where[ 't_bill_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_bill_list ";
		$sql .= " WHERE ";
		$sql .= " t_bill_id=".$id;
		$sql .= " ORDER BY id ";

		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$rlt[$i] = $result;
			$i++;
		}
		
		return $rlt;
	}


	public function getBillDataDetail($where){
		$testgrp_id  = $where[ 'testgrp_id'  ];
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];

		$bill_term_date_from = preg_replace("/\-/","/",$where[ 'bill_term_date_from' ]);
		$bill_term_date_to   = preg_replace("/\-/","/",$where[ 'bill_term_date_to'   ]);
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_id ";
		$sql .= " FROM t_testpaper";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id;
		$sql .= " AND partner_id=".$partner_id;
		$sql .= " AND customer_id=".$customer_id;
		$sql .= " AND complete_flg = 1 ";
		if($bill_term_date_to == "0000/00/00"){
			$sql .= "";
		}else{
			$sql .= " AND exam_date <='".$bill_term_date_to."'";
		}
		if($bill_term_date_from == "0000/00/00"){
			$sql .= "";
		}else{
			$sql .= " AND exam_date >='".$bill_term_date_from."'";
		}
		$sql .= " GROUP BY exam_id ";
		$sql .= " ORDER BY type+0";


		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
		
	}
}
?>
