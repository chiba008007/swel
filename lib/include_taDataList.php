<?PHP
//----------------------------------
//編集請求書メソッド
//
//
//----------------------------------
class taDataListMethod extends method{
	public function getTamen($where){
		$test_id     = $where[ 'test_id'     ];
		$partner_id  = $where[ 'pid'         ];
		$customer_id = $where[ 'cid'         ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " t.tamen_type ";
		$sql .= " FROM ";
		$sql .= " t_test as t ";
		$sql .= " WHERE ";
		$sql .= " t.test_id = ".$test_id." AND ";
		$sql .= " t.partner_id=".$partner_id." AND ";
		$sql .= " t.customer_id=".$customer_id." AND ";
		$sql .= " 1=1 ";
		$r = mysql_query($sql);
		$i=0;
		while($result = mysql_fetch_assoc($r)){
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
	}
	
	public function getTamenListCount($where){
		$testgrp_id  = $where[ 'test_id'     ];
		$partner_id  = $where[ 'pid'         ];
		$customer_id = $where[ 'cid'         ];
		$hv_id       = $where[ 'hv_id'       ];
		$hv_name     = $where[ 'hv_name'     ];
		$hv_busyo    = $where[ 'hv_busyo'    ];
		$ev_id       = $where[ 'ev_id'       ];
		$ev_name     = $where[ 'ev_name'     ];
		$ev_busyo    = $where[ 'ev_busyo'    ];



		$sql = "";
		$sql = "SELECT ";
		$sql .= " ta.* ";
		$sql .= " ,tt.birth";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt";
		$sql .= " LEFT JOIN tamen_tbl as ta ON ta.testgrp_id=tt.testgrp_id AND ta.tp_id=tt.id ";
		$sql .= " WHERE ";
		if($hv_id){
			$sql .= " ta.hv_id LIKE '%".$hv_id."%' AND ";
		}
		if($hv_name){
			$sql .= " ta.hv_name LIKE '%".$hv_name."%' AND ";
		}

		if($hv_busyo){
			$sql .= " ta.hv_busyo LIKE '%".$hv_busyo."%' AND ";
		}
		if($ev_id){
			$sql .= " ta.ev_id LIKE '%".$ev_id."%' AND ";
		}
		if($ev_name){
			$sql .= " ta.ev_name LIKE '%".$ev_name."%' AND ";
		}
		if($ev_busyo){
			$sql .= " ta.ev_busyo LIKE '%".$ev_busyo."%' AND ";
		}

		$sql .= " tt.testgrp_id=".$testgrp_id." AND ";
		$sql .= " tt.partner_id=".$partner_id." AND ";
		$sql .= " tt.customer_id=".$customer_id." AND ";
		$sql .= " 1=1 ";
		$sql .= " ORDER BY tt.number ";
		$r = mysql_query($sql);
		$row = mysql_num_rows($r);
		return $row;
	}


	public function getTamenList($where){
		$testgrp_id  = $where[ 'test_id'     ];
		$partner_id  = $where[ 'pid'         ];
		$customer_id = $where[ 'cid'         ];
		$hv_id       = $where[ 'hv_id'       ];
		$hv_name     = $where[ 'hv_name'     ];
		$hv_busyo    = $where[ 'hv_busyo'    ];
		$ev_id       = $where[ 'ev_id'       ];
		$ev_name     = $where[ 'ev_name'     ];
		$ev_busyo    = $where[ 'ev_busyo'    ];
		$limit       = $where[ 'limit'       ];
		$offset      = $where[ 'offset'      ];
		


		$sql = "";
		$sql = "SELECT ";
		$sql .= " ta.* ";
		$sql .= " ,tt.birth,tt.number";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt";
		$sql .= " LEFT JOIN tamen_tbl as ta ON ta.testgrp_id=tt.testgrp_id AND ta.tp_id=tt.id ";
		$sql .= " WHERE ";
		if($hv_id){
			$sql .= " ta.hv_id LIKE '%".$hv_id."%' AND ";
		}
		if($hv_name){
			$sql .= " ta.hv_name LIKE '%".$hv_name."%' AND ";
		}

		if($hv_busyo){
			$sql .= " ta.hv_busyo LIKE '%".$hv_busyo."%' AND ";
		}
		if($ev_id){
			$sql .= " ta.ev_id LIKE '%".$ev_id."%' AND ";
		}
		if($ev_name){
			$sql .= " ta.ev_name LIKE '%".$ev_name."%' AND ";
		}
		if($ev_busyo){
			$sql .= " ta.ev_busyo LIKE '%".$ev_busyo."%' AND ";
		}

		$sql .= " tt.testgrp_id=".$testgrp_id." AND ";
		$sql .= " tt.partner_id=".$partner_id." AND ";
		$sql .= " tt.customer_id=".$customer_id." AND ";
		$sql .= " 1=1 ";
		$sql .= " ORDER BY tt.number ";
		$sql .= " LIMIT ".$limit." OFFSET ".$offset;
               
		$r = mysql_query($sql);
		$i=0;
		while($result = mysql_fetch_assoc($r)){
			$rlt[$i] = $result;
			if($result[ 'birth' ]){
				$rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
			}else{
				$rlt[$i][ 'age' ] = "";
			}
			if($result[ 'id' ]){
				$idlist[$i] = $result[ 'id' ];
			}
			$i++;
		}
		$rlts = array();
		if($idlist){
			$idline = implode("','",$idlist);
			$sql = "";
			$sql = "SELECT ";
			$sql .= " tamen_type,ta_id,exam_state ";
			$sql .= " ,SUBSTR(update_ts,1,10) as update_ts";
			$sql .= " FROM ";
			$sql .= " tamen_result ";
			$sql .= " WHERE ";
			$sql .= " ta_id IN ('".$idline."')";
			$r = mysql_query($sql);
			$i=0;
			while($rt = mysql_fetch_assoc($r)){
				$rlts[$rt['ta_id']][$rt[ 'tamen_type' ]] = $rt;
				$i++;
			}
		}
		return array($rlt,$rlts);
	}
}
?>
