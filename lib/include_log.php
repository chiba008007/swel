<?PHP

class logMethod extends method{
	public function getDataAdminRow(){
		$sql = "SELECT 
					*
					FROM
						logincheck
					WHERE
						page = ? 
						ORDER BY id desc
				";
		$params = [];
		$params[] = 'admin';
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		$rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return count($rlt);
	}
	public function getDataAdmin($where){
		$li = $where[ 'offset'  ];
		$of = $where[ 'limit'   ];
		$sql = "SELECT 
					*,
						CASE
							WHEN id_miss_flag = 0  THEN '×'
							WHEN id_miss_flag = 1 THEN '〇'
							ELSE '-'
						END as id_miss_display,
						CASE
							WHEN password_miss_flag = 0  THEN '×'
							WHEN password_miss_flag = 1 THEN '〇'
							ELSE '-'
						END as password_miss_display
					FROM
						logincheck
					WHERE
						page = ? 
						ORDER BY id desc
				";
		$sql .= " limit ".$of." offset ".$li." ";
		$params = [];
		$params[] = 'admin';
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		$list = [];
		$i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
				$list[$i] = $rlt;
				$i++;
		}
		return $list;
	}



	public function getDataExamRow(){
		$sql = "SELECT 
					*
					FROM
						logincheck
					WHERE
						page != ? 
						ORDER BY id desc
				";
		$params = [];
		$params[] = 'admin';
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		$rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return count($rlt);
	}
	public function getDataExam($where){
		$li = $where[ 'offset'  ];
		$of = $where[ 'limit'   ];
		$sql = "SELECT 
					l.*,
					CASE
						WHEN l.id_miss_flag = 0  THEN '×'
						WHEN l.id_miss_flag = 1 THEN '〇'
						ELSE '-'
					END as id_miss_display,
					CASE
						WHEN l.password_miss_flag = 0  THEN '×'
						WHEN l.password_miss_flag = 1 THEN '〇'
						ELSE '-'
					END as password_miss_display,
					u.name as partner_name,
					u2.name as customer_name
					FROM
						logincheck as l 
						LEFT JOIN t_user as u ON u.id = l.pid
						LEFT JOIN t_user as u2 ON u2.id = l.cusid
					WHERE
						l.page != ? 
						ORDER BY l.id desc
				";
		$sql .= " limit ".$of." offset ".$li." ";
		$params = [];
		$params[] = 'admin';
		$stmt = $this->db->prepare($sql);
		$stmt->execute($params);
		$list = [];
		$i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
				$list[$i] = $rlt;
				$i++;
		}
		return $list;
	}


}
?>
