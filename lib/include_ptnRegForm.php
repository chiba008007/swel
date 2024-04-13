<?PHP
//----------------------------------
//企業登録フォーム
//
//
//----------------------------------
class ptnRegFormMethod extends method{

	public function getFormCode($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " form_code ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $result;
	}
	
	public function wDataRow($where){
		$uid = $where[ 'uid' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_user_weight ";
		$sql .= " WHERE ";
		$sql .= " uid = ".$uid;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                return $row;		
	}
	public function getWeightUser($where){
		$uid = $where[ 'uid' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_user_weight ";
		$sql .= " WHERE ";
		$sql .= " uid = ".$uid;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
	}
}
?>
