<?PHP
class newMethod extends method{
	/*
	・ｽ・ｽ・ｽO・ｽC・ｽ・ｽID・ｽﾌ重・ｽ・ｽ・ｽ`・ｽF・ｽb・ｽN
	*/
	public function idCheck($data){
		$login_id = $data[ 'login_id' ];
		$sql = "";
		$sql = "SELECT * FROM t_user";
		$sql .= " WHERE ";
		$sql .= " login_id='".$login_id."' AND ";
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
                
                /*
		$r = mysql_query($sql);
		$row = mysql_num_rows($r);
		return $row;
                 * 
                 */
	}
	/*
	・ｽ・ｽ・ｽj・ｽ[・ｽNID・ｽﾌ取得
	*/
	public function getUniqID($data){
		$login_id = $data[ 'login_id' ];
		$sql = "";
		$sql = "SELECT id FROM t_user";
		$sql .= " WHERE ";
		$sql .= " login_id='".$login_id."' AND ";
		$sql .= " 1=1 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
		//$r = mysql_query($sql);
		//$row = mysql_fetch_assoc($r);
		//return $row;
	}

	//-----------------------------------------------
	//・ｽ・ｽ・ｽ・ｽ・ｽ・ｽ・ｽO・ｽﾇ会ｿｽ
	//-----------------------------------------------
	public function setLog($data){
		$to_id     = $data[ 'to_id'     ];
		$from_id   = $data[ 'from_id'   ];
		$from_type = $data[ 'from_type' ];
		$status    = $data[ 'status'    ];
		$exp = explode(":",$data[ 'license_num' ]);
		$i=1;
		$ins = "";
		foreach($exp as $key=>$val){
			if($val){
				$ins .= "(".$to_id.",".$from_id.",".$from_type.",".$val.",".$i.",".$status."),";
			}
			$i++;
		}
		$ins = preg_replace("/,$/","",$ins);
		$sql = "";
		$sql = "INSERT INTO log_tbl (to_id, from_id, from_type, license_num,type,status) VALUES ";
		$sql .= $ins;

                $stmt = $this->db->prepare($sql);
                $stmt->execute();

	}
}
?>