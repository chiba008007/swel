<?PHP
class dlBillMethod extends method{
	
	public function getBillData($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_bill ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
		
	}

	public function getBillListData($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_bill_list ";
		$sql .= " WHERE ";
		$sql .= " t_bill_id=".$id." AND ";
		$sql .= " 1=1 ";
		$sql .= " ORDER BY number";
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