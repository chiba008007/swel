<?PHP
//----------------------------------
//パートナー情報削除メソッド
//
//
//----------------------------------
class tmpMethod extends method{
	public function getFileData($where){
		$id    = $where[ 'id'         ];
		$order = $where[ 'order'      ];
		$file  = $where[ 'filename'   ];
		$status = $where[ 'status'    ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " up.* ";
		$sql .= " FROM ";
		$sql .= " uploadfile as up ";
		$sql .= " WHERE ";
		$sql .= " up.partner_id=".$id." AND ";
		$sql .= " up.filename LIKE '%".$file."%' AND";
		if(strlen($status)){
			$sql .= " up.status = ".$status." AND ";
		}
		$sql .= " 1=1 ";

		if($order){
			$sql .= " ORDER BY up.regist_ts  ".$order;
		}else{
			$sql .= " ORDER BY up.regist_ts DESC ";
		}
                 $stmt = $this->db->prepare($sql);
                $stmt->execute();
                
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
		
	}
	public function getDown($where){
		$id    = $where[ 'id'         ];
		$ptid  = $where[ 'partner_id' ];
		$file  = $where[ 'filename'   ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " uploadfile ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " partner_id=".$ptid." AND ";
		$sql .= " filename LIKE '%".$file."%' AND";
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
              
		return $result;
	}
	
	public function delFile($where){
		$id    = $where[ 'id'         ];
		$ptid  = $where[ 'partner_id' ];
		$sql = "DELETE FROM uploadfile ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " partner_id=".$ptid." AND ";
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
               
		
	}
	public function getDir($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql .= "SELECT ";
		$sql .= " login_id ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
		
		return $result;
	}
}
?>
