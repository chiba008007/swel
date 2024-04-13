<?PHP
//----------------------------------
//パートナー情報新規登録メソッド
//
//
//----------------------------------
class ptnNewMethod extends method{

	/*
	ログインIDの重複チェック
	*/
	public function idCheck($data){
		$login_id = $data[ 'login_id' ];
		$sql = "";
		$sql = "SELECT * FROM t_user";
		$sql .= " WHERE ";
		$sql .= " login_id='".$login_id."' AND ";
		$sql .= " 1=1 ";
                
		//$r = mysql_query($sql);
		//$row = mysql_num_rows($r);
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
               
                
                return $row;
	}

}
?>
