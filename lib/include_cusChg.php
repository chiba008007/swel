<?PHP
//----------------------------------
//csvアップロードメソッド
//
//
//----------------------------------
class cusChgMethod extends method
{
	public function getTestHideCount($where)
	{
		$partner_id = $where['partner_id'];
		$customer_id = $where['customer_id'];
		$sql = "
			SELECT 
				count(test_show_hide) as cnt
			FROM
				t_test
			WHERE 
				partner_id=:partner_id AND 
				customer_id=:customer_id AND 
				test_show_hide = 1 AND 
				del = 0 AND 
				type = 0 
		";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':partner_id', $partner_id);
		$stmt->bindValue(':customer_id', $customer_id);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		return $data['cnt'];
	}
	/*
	ログインIDの重複チェック
	*/
	public function idCheck($data)
	{
		$login_id = $data['login_id'];
		$sql = "";
		$sql = "SELECT * FROM t_user";
		$sql .= " WHERE ";
		$sql .= " login_id='" . $login_id . "' AND ";
		$sql .= " 1=1 ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$row = $stmt->rowCount();
		return $row;
	}

	public function getUser($where)
	{
		$id = $where['id'];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=" . $id;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$list = $stmt->fetch(PDO::FETCH_ASSOC);
		return $list;
	}

	//------------------------------------
	//データ修正
	//------------------------------------
	public function editUserData($table, $data)
	{

		foreach ($data['edit'] as $k => $v) {
			$edit .= "," . $k . "='" . $v . "'";
		}
		$edit = preg_replace("/^,/", "", $edit);
		foreach ($data['where'] as $k => $v) {
			$where .= $k . "='" . $v . "' AND ";
		}
		$sql = "";
		$sql = " UPDATE " . $table . " SET ";
		$sql .= $edit;
		$sql .= " WHERE ";
		$sql .= $where;
		$sql .= " 1=1 ";
		$stmt = $this->db->prepare($sql);
		$r = $stmt->execute();

		return $r;
	}
}
