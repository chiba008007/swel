<?PHP
//----------------------------------
//パートナー情報削除メソッド
//
//
//----------------------------------
class amsMethod extends method{
	public function getUserData($where){
		$form_code = $where[ 'form_code' ];
		$sql = "";
		$sql = " SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " form_code='".$form_code."' AND ";
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
		
	}


	public function setTempMailData($where){
		$code = $where[ 'code' ];
		$mail = $where[ 'mail' ];
		$uid  = $where[ 'uid'  ];
		

		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " member_regist_form ";
		$sql .= " WHERE ";
		$sql .= " code = '".$code."' AND ";
		$sql .= " mail = '".$mail."' AND ";
		$sql .= " 1=1 ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                
//		if($row){
//			return false;
//		}else{
			//本番用t_userで指定のパートナーに登録された
			//データの有無の確認

			$sql = "";
			$sql = "SELECT ";
			$sql .= " id ";
			$sql .= " FROM ";
			$sql .= " t_user ";
			$sql .= " WHERE ";
			$sql .= " partner_id=".$uid." AND ";
			$sql .= " del = 0 AND ";
			$sql .= " type = 3 AND ";
			$sql .= " rep_email='".$mail."'";

			
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                        $row = $stmt->rowCount();
                
//			if($row){
//				return false;
//			}else{
				$sql = "";
				$sql = "INSERT INTO member_regist_form ";
				$sql .= " (";
				$sql .= " uid,code,mail";
				$sql .= ")VALUES(";
				$sql .= $uid.",'".$code."','".$mail."'";
				$sql .= ")";
				//mysql_query($sql);
                                $stmt = $this->db->prepare($sql);
                                $stmt->execute();
                                $id = $this->db->lastInsertId('id');
                                
				return $id;
//			}
//		}
	}
	
	
	public function getMemRegForm($where){
		$id   = $where[ 'id'    ];
		$code = $where[ 'code'  ];
		$sql = "";
		$sql = "SELECT * FROM member_regist_form ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " code='".$code."'";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $rlt;
		
	}


	//認証データの確認
	public function checkUserData($where){
		$partner_id = $where[ 'partner_id' ];
		$rep_email  = $where[ 'rep_email'  ];
		$rep_email2 = $where[ 'rep_email2' ];
		
		$sql = "";
		$sql = "SELECT * FROM t_user ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " del=0 AND ";
		$sql .= "(";
		$sql .= " rep_email = '".$rep_email."' OR rep_email2='".$rep_email2."'";
		$sql .= ")";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                
		return $row;
	}
	
	
	public function getUserCheckLoginId($where){
		$login_id = $where[ 'login_id' ];
		$sql = "";
		$sql = "SELECT";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " login_id='".$login_id."' AND ";
		$sql .= " 1=1 ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		return $row;
		
	}
	
	public function getUserDataRow($table,$data){

		foreach($data as $key=>$val){
			$where .= "AND ".$key."= '".$val."' ";
			
		}
		$where = preg_replace("/^AND/","",$where);
		
		$sql = "";
		$sql = "SELECT * FROM ".$table." ";
		
		$sql .= " WHERE ".$where;
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		return $row;
		
		
	}
	
	public function getWeight($where){
		$uid = $where[ 'uid' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_user_weight ";
		$sql .= " WHERE  ";
		$sql .= " uid=".$uid;
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;

		
	}
	



	public function getUserDatas($table,$data,$order="",$limit="",$parts="*",$bill=""){

		$li = $limit[ 'offset'  ];
		$of = $limit[ 'limit'   ];
		if($order){
			$od = " ORDER BY ".$order;
		}
		if(count($data)){
			foreach($data as $key=>$val){
				$where .= "AND ".$key."= '".$val."' ";
				
			}
			$where = preg_replace("/^AND/","",$where);
		}
		$name = $bill[ 'name' ];
		
		$sql = "";
		$sql = "SELECT ".$parts." FROM ".$table." ";
		if($where){
			$sql .= " WHERE ".$where;
		}
		if($bill && $name){
			$sql .= " AND name LIKE '%".$name."%'";
		}
		$sql .= $od;
		if($limit){
			$sql .= " limit ".$of." offset ".$li." ";
		}
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
