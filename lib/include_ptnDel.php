<?PHP
//----------------------------------
//パートナー情報削除メソッド
//
//
//----------------------------------
class ptnDelMethod extends method{
	public function deleteUser($where){
		$id         = $where[ 'id'         ];
		$partner_id = $where[ 'partner_id' ];
		$sql = "";
		$sql = "DELETE FROM t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " partner_id=".$partner_id;
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		
	}

}
?>
