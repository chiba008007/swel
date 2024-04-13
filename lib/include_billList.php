<?PHP
class billListMethod extends method{
	//--------------------------------------
	//データ件数取得
	//--------------------------------------
	public function getRow($where){
		$eir_id          = $where[ 'eir_id' ];
		$bill_num        = $where['bill_num'];
		$name            = $where['name'];
		$download_status = $where[ 'download_status'  ];
		$pay_date        = $where[ 'pay_date'  ];
		$title           = $where[ 'title'     ];
		$sql = "";
		$sql = "SELECT * FROM t_bill ";
		$sql .= " WHERE ";
	//	$sql .= " eir_id=".$eir_id." AND ";
		if($bill_num){
			$sql .= "bill_num='".$bill_num."' AND ";
		}
		if($title){
			$sql .= "title LIKE '%".$title."%' AND ";
		}
		if($name){
			$sql .= "name LIKE '%".$name."%' AND ";
		}
		if(strlen($download_status)){
			$sql .= "download_status='".$download_status."' AND ";
		}		
		if(strlen($pay_date)){
			$sql .= "regist_ts LIKE '".$pay_date."%' AND ";
		}
		$sql .= " 1=1 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                
		return $row;
	}
	
	//--------------------------------------
	//請求書データ一覧取得
	//--------------------------------------
	public function getUserDatabill($where,$limit){
		$eir_id          = $where[ 'eir_id'           ];
		$offset          = $limit[ 'offset'           ];
		$limits          = $limit[ 'limit'            ];
		$bill_num        = $where['bill_num'          ];
		$name            = $where['name'              ];
		$download_status = $where[ 'download_status'  ];
		$pay_date        = $where[ 'pay_date'         ];
		$title           = $where[ 'title'            ];

		$sql = "";
		$sql = "SELECT ";
		$sql .= " b.* ";
		$sql .= " ,count(bl.id) as count ";
		$sql .= " FROM ";
		$sql .= " t_bill as b";
		$sql .= " LEFT JOIN t_bill_list as bl ON b.id=bl.t_bill_id";

		$sql .= " WHERE ";
	//	$sql .= " b.eir_id=".$eir_id." AND ";
		if($bill_num){
			$sql .= "b.bill_num='".$bill_num."' AND ";
		}
		if($title){
			$sql .= "title LIKE '%".$title."%' AND ";
		}
		if($name){
			$sql .= "b.name LIKE '%".$name."%' AND ";
		}
		if(strlen($download_status)){
			$sql .= "b.download_status='".$download_status."' AND ";
		}
		if(strlen($pay_date)){
			$sql .= "b.regist_ts LIKE '".$pay_date."%' AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " GROUP BY b.id ";
		$sql .= " ORDER BY b.bill_num DESC , b.regist_ts DESC ";
		$sql .= " LIMIT ".$limits." OFFSET ".$offset;
		//$r = mysql_query($sql);
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                
		$i = 1;
		while($rlt =$stmt->fetch(PDO::FETCH_ASSOC)){
			$list[$i] = $rlt;
			//テストペーパーのカウントデータ取得
			$where = array();
			$where[ 'testpaper_id'   ] = $rlt[ 'testid'      ];
			$where[ 'partner_id'     ] = $rlt[ 'partner_id'  ];
			$where[ 'customer_id'    ] = $rlt[ 'customer_id' ];
			$where[ 'complete_flg'   ] = 1;
			$counts = $this->getTestCount($where);
			$list[ $i ][ 'tcount'    ] = $counts;
			$list[ $i ][ 'regist_ts' ] = substr($rlt[ 'regist_ts' ],0,10);
			$i++;
		}
		return $list;
	}
	public function getTestCount($where){
		$testpaper_id = $where[ 'testpaper_id'   ];
		$partner_id   = $where[ 'partner_id'     ];
		$customer_id  = $where[ 'customer_id'    ];
		$complete_flg = $where[ 'complete_flg'   ];
		
		$sql = "";
		$sql = "SELECT exam_id FROM t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id =".$testpaper_id." AND ";
		$sql .= " partner_id   =".$partner_id." AND ";
		$sql .= " customer_id  =".$customer_id." AND ";
		$sql .= " complete_flg =".$complete_flg." AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY exam_id ";
		$sql .= " ORDER BY type+0";

		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		return $row;
	}
	//-----------------------------------------
	//請求書データ削除
	//----------------------------------------
	public function deleteBillData($where){
		$id = $where[ 'id' ];
		
		$sql = "";
		$sql = "DELETE FROM t_bill ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		if($flg){
			$sql = "";
			$sql = "DELETE FROM t_bill_list ";
			$sql .= " WHERE ";
			$sql .= " t_bill_id = ".$id;
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
			
		}
		
	}
}
?>