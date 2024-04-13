<?PHP
//----------------------------------
//重み付けメソッド
//
//
//----------------------------------
class wtMethod extends method{
	public function getElement($where){
		$uid = $where[ 'uid' ];
		$sql = "
				SELECT 
					*
				FROM
					t_element
				WHERE
					uid=".$uid." AND 
					element_status = 1
				";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
	}
	public function getList($where,$flg=""){
		$uid          = $where[ 'uid' ];
		$pid          = $where[ 'pid' ];
		$id           = $where[ 'id'  ];
		$of           = $where[ 'offset'  ];
		$li           = $where[ 'limit'   ];
		$master_name  = $where[ 'master_name'   ];

		$sql = "
				SELECT 
				";
		if($flg == 1){
			//flgがあるときはデータを１件取得
			$sql .= " * ";
		}else{
			$sql .= "
					id
					,master_name
					,DATE_FORMAT(regist_ts,'%Y/%m/%d') as date
				";
		}
		$sql .= "
				FROM
					t_weight_master
				WHERE
					uid=".$uid." AND
					pid=".$pid;
		if($id){
			$sql .= " AND id = ".$id;
		}
		if($master_name){
			$sql .= " AND master_name LIKE '%".$master_name."%'";
		}

		$sql .= "
				ORDER BY id DESC
				";
		if($flg == "all"){
		
		}else
		if($li){
			$sql .= " limit ".$li." offset ".$of." ";
		}else{
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                        $row = $stmt->rowCount();
			return $row;
		}
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                
                $i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[ $rlt[ 'id' ] ] = $rlt;
			$i++;
		}
                
		
		return $list;
	}
	public function delWeight($where){
		$id  = $where[ 'id' ];
		$sql = "
				DELETE FROM t_weight_master
					WHERE
				id=".$id."
				";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
	}
}
?>
