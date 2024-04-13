<?PHP
//----------------------------------
//パートナー情報一覧管理画面メソッド
//
//
//----------------------------------
class listMethod extends method{
	public function getPartner($data){
		$type   = $data[ 'type'   ];
		$eir_id = $data[ 'eir_id' ];
		
		$of = $data[ 'offset'  ];
		$li = $data[ 'limit'   ];

		$name = $data[ 'name' ];

		//受験者数
		$sql = "
				SELECT 
					partner_id
					,count(tt.id) as cnt
				FROM
					t_testpaper as tt
				WHERE
					tt.exam_state IN ( 0,1,2 )
					AND tt.disabled = 0
					AND tt.del = 0
					AND tt.temp_flg = 0
				GROUP BY tt.partner_id
				";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                while($rst = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $remain[$rst[ 'partner_id' ]] = $rst[ 'cnt' ];
                }
                
		//販売可能ライセンス数
		//購入ライセンス数 - (未受検ステータス検査数 + 受検中ステータス検査数 + 受検済み検査数)
		
		//処理数
		$sql = "
				SELECT 
					partner_id
					,count(tt.id) as cnt
				FROM
					t_testpaper as tt
				WHERE
					tt.exam_state =2 
					AND tt.disabled = 0
					AND tt.del = 0
					AND tt.temp_flg = 0
				GROUP BY tt.partner_id
				";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                while($rst = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $syori[$rst[ 'partner_id' ]] = $rst[ 'cnt' ];
                }
                
		//残数
		$sql = "
				SELECT 
					partner_id
					,COUNT( tt.id ) as cnt,
					COUNT(
						CASE WHEN tt.exam_state IN (1,2) 
						AND tt.disabled = 0
						AND tt.del = 0
						AND tt.temp_flg = 0
						THEN 1 ELSE NULL END 
					) as cnt2,
					COUNT(
						CASE WHEN tt.exam_state IN (0,1,2) 
						AND tt.disabled = 1
						AND tt.del = 1
						AND tt.temp_flg = 0
						THEN 1 ELSE NULL END  
					) as cnt3
				FROM
					t_testpaper as tt
				
				GROUP BY tt.partner_id
				";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                while($rst = $stmt->fetch(PDO::FETCH_ASSOC)){
                    
                    $zan[$rst[ 'partner_id' ]] = $rst[ 'cnt' ]-$rst[ 'cnt2' ]-$rst[ 'cnt3' ];
                }
                
		
		$sql = "
				SELECT 
					*
				FROM
					t_user as t
				WHERE
					t.eir_id = '1' 
				";
		if($name){
			$sql .= " AND t.name LIKE '%".$name."%'";
		}
		$sql .= "
				ORDER BY t.registtime DESC 
				";
		if($li){
			$sql .= " limit ".$li." offset ".$of." ";
		}
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $rlt[$i] = $result;
                    $rlt[$i][ 'remain' ] = $remain[ $result[ 'id' ] ];
                    $rlt[$i][ 'buy'    ] = $result[ 'license' ] - $remain[ $result[ 'id' ] ];
                    $rlt[$i][ 'syori'  ] = $syori[ $result[ 'id' ] ];
                    $rlt[$i][ 'zan'    ] = $zan[ $result[ 'id' ] ];
                    $i++;
                }
                
                /*
		$r = mysql_query($sql);
		$i=0;
		while($result = mysql_fetch_assoc($r)){
			$rlt[$i] = $result;
			$rlt[$i][ 'remain' ] = $remain[ $result[ 'id' ] ];
			$rlt[$i][ 'buy'    ] = $result[ 'license' ] - $remain[ $result[ 'id' ] ];
			$rlt[$i][ 'syori'  ] = $syori[ $result[ 'id' ] ];
			$rlt[$i][ 'zan'    ] = $zan[ $result[ 'id' ] ];
			$i++;
		}
                 * 
                 */
		return $rlt;
	}


	public function getPartnerRow($data){
		$type   = $data[ 'type'   ];
		$eir_id = $data[ 'eir_id' ];
		$name = $data[ 'name' ];
		
		$sql = "";
		//購入ライセンス数(t.license)
		$sql .= "SELECT t.id ";
		
		$sql .= " FROM t_user AS t ";
		$sql .= " LEFT JOIN t_testpaper AS tt ON t.id = tt.partner_id AND tt.temp_flg = 0 ";
		$sql .= " WHERE ";
		$sql .= " t.type=".$type." AND ";
		$sql .= "t.eir_id = '1' AND ";
		
		$sql .= "  t.del = '0' ";
		if($name){
			$sql .= " AND t.name LIKE '%".$name."%'";
		}
		$sql .= "GROUP BY t.id ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$row = $stmt->rowCount();

		//$r = mysql_query($sql);
		//$row = mysql_num_rows($r);
		return $row;
	}

}
?>
