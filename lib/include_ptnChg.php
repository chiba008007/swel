<?PHP
//----------------------------------
//パートナー情報一覧管理画面メソッド
//
//
//----------------------------------
class ptnChgMethod extends method{
	public function getElement($where){
		$uid = $where[ 'uid' ];
		$sql = "";
		$sql = "SELECT * FROM t_element ";
		$sql .= " WHERE ";
		$sql .= " uid=".$uid." AND ";
		$sql .= " element_status = 1 ";
                
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = $stmt->fetch(PDO::FETCH_ASSOC);
                return $list;
	}


}
?>
