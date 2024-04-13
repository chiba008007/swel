<?PHP
class noneMethod extends method{
	public function getData($where){
		$partner_id = $where[ 'partner_id' ];
		$limit      = $where[ 'limit'      ];
		$offset     = $where[ 'offset'     ];
		$sql = "SELECT 
				u.*,
				count(t.id) as counter,
				SUM(CASE WHEN t.complete_flg = 1 THEN 1
				ELSE 0 END  ) as syori,
				SUM(CASE WHEN t.complete_flg = 0 THEN 1
				ELSE 0 END  ) as zan 
				FROM
					t_user as u 
					LEFT JOIN t_testpaper as t ON t.partner_id = u.partner_id AND t.customer_id = u.id 
				WHERE
					u.partner_id = :partner_id AND 
					u.del = 0 AND 
					u.customer_display = 0
					group by u.id
				";

		if($limit){
			$sql .= " limit ".$limit." OFFSET ".$offset;
		}

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(':partner_id', $partner_id);
		$stmt->execute();
		$list = [];
		$i = 0 ;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[$i] = $result;
			$i++;
		}
		return $list;
	}

}