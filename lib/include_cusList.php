<?PHP
//----------------------------------
//顧客情報一覧管理画面メソッド
//
//
//----------------------------------
class cusListMethod extends method{
	public function getButtonType($where){
		$cid  = $where[ 'cid' ];
		$pid  = $where[ 'pid' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " test_id,type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " ";
		$sql .= " customer_id=".$cid." AND ";
		if($pid){
			$sql .= " partner_id=".$pid." AND ";
		}
		$sql .= " test_id != 0 AND ";
//		$sql .= " enabled = 1 AND ";
		$sql .= " del = 0 AND ";
		$sql .= " type != 0  ";
		$sql .= " ORDER BY test_id ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = array();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$result[ 'test_id' ]][ 'type' ][$result[ 'type' ]] = $result[ 'type' ];
			$i++;
		}
		return $rlt;
		
	}
	//データ取得
	public function getTestList($where){

		$cid  = $where[ 'cid' ];
		$pid  = $where[ 'pid' ];
		$name = $where[ 'name' ];

		$of     = $where[ 'offset'   ];
		$li     = $where[ 'limit'    ];
		$rowflg = $where[ 'rowflg'   ];

		$sql = "";
		$sql = "SELECT";
		$sql .= " t.test_id, ";
		$sql .= " t.partner_id, ";
		$sql .= " t.customer_id, ";
		$sql .= " t.name,";
		$sql .= " t.number,";
		$sql .= " t.type,";
		$sql .= " t.weight,";
		$sql .= " t.rsei_type,";
		$sql .= " t.period_from,";
		$sql .= " t.period_to, ";
		$sql .= " t.type,";
		$sql .= " t.rowflg,";
		$sql .= " t.temp_flg,";
  $sql .= " t.pdf_log_use,";
  $sql .= " t.test_show_hide,";
		$sql .= " min(t.enabled) as en,";
		//削除ボタン
		$sql .= " CASE ";
		$sql .= " WHEN max(tt.exam_state) > 0 THEN 'ON' ";
		$sql .= " ELSE 'OFF' END as delFlg,";
		$sql .= " ta.id as tamen_flg,";
		$sql .= " (SELECT count(*) FROM t_test WHERE type = 0 AND send_mail=1 AND id=t.test_id  ) as send_mail,";
		$sql .= " CASE ";
		$sql .= " WHEN count(DISTINCT(tt.exam_id)) = t.number then '0' ";
		$sql .= " WHEN REPLACE(t.period_to,'/','') < date_format(now(), '%Y%m%d') then '0' ";
		$sql .= " ELSE '1' ";
		$sql .= " END as status,";
		$sql .= " REPLACE(t.period_to,'/','') as made, ";
		$sql .= " count(DISTINCT(tt.exam_id)) as syori ";
//		$sql .= " (SELECT count(DISTINCT(tt2.exam_id))  FROM t_testpaper as tt2 WHERE tt2.testgrp_id=t.test_id AND tt2.exam_state=0 ) as zan";

//		$sql .= " count(DISTINCT(tt2.exam_id)) as zan ";
		$sql .= " FROM ";
		$sql .= " t_test as t ";
		$sql .= " LEFT JOIN (SELECT partner_id,testgrp_id,exam_id,complete_flg,exam_state FROM t_testpaper 
					WHERE partner_id=".$pid." AND customer_id=".$cid."
					) as tt ON t.test_id=tt.testgrp_id AND tt.complete_flg = 1 ";
//		$sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,exam_state FROM t_testpaper ) as tt2 ON t.test_id=tt2.testgrp_id AND tt2.exam_state = 0 ";
		//多面評価チェック
		$sql .= " LEFT JOIN (SELECT id,testgrp_id FROM tamen_tbl ) as ta ON ta.testgrp_id=t.test_id ";
		$sql .= " LEFT JOIN t_user as u ON u.id = t.customer_id";
		$sql .= " WHERE ";
		$sql .= " t.customer_id=".$cid." AND ";
		if($pid){
			$sql .= " t.partner_id=".$pid." AND ";
		}
		$sql .= " t.test_id != 0 AND ";
//		$sql .= " t.enabled = 1 AND ";
		$sql .= " t.del = 0 AND ";
		$sql .= " t.type != 0 AND ";
		if($rowflg){
			$sql .= " t.rowflg = 0 AND ";
		}
		if($name){
			$sql .= "t.name LIKE '%".$name."%' AND ";
		}

		if($where[ 'basetype' ] != 1 ){
			$sql .= " u.customer_display = 1 AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " GROUP BY t.test_id ";
		$sql .= " ORDER BY test_show_hide DESC,status DESC,t.period_to DESC";
		if($li){
			$sql .= " limit ".$li." offset ".$of." ";
		}
if($_REQUEST[ 'aaa' ]){
	print $sql;
	exit();
}
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$grp = $result[ 'test_id' ];
			$rlt[$i]['zan'] = $this->getZan($grp);
			$i++;
		}

		return $rlt;
	}
	public function getZan($testgrp_id){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " count(DISTINCT(exam_id)) as zan ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id." AND ";
		$sql .= " exam_state = 0 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $result[ 'zan' ];
	}
	
	public function getTestListRow($where){
		$cid  = $where[ 'cid' ];
		$pid  = $where[ 'pid' ];
		
		$sql = "";
		$sql = "SELECT";
		$sql .= " t.test_id ";
		$sql .= " FROM ";
		$sql .= " t_test as t ";
		$sql .= " LEFT JOIN t_user as u ON u.id = t.customer_id";

		$sql .= " WHERE ";
		$sql .= " t.customer_id=".$cid." AND ";
		if($pid){
			$sql .= " t.partner_id=".$pid." AND ";
		}
		$sql .= " t.test_id != 0 AND ";
//		$sql .= " t.enabled = 1 AND ";
		$sql .= " t.del = 0 AND ";
		$sql .= " t.type != 0 AND ";
		if($where[ 'basetype' ] != 1 ){
			$sql .= " u.customer_display = 1 AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " GROUP BY t.test_id ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                 
		return $row;
	}
	
	
	
	//お知らせメール
	public function editTestSendMail($where,$edit){
		$id        = $where[ 'id'       ];
		$send_mail = $edit[ 'send_mail' ];
		$sql = "";
		$sql = "UPDATE ";
		$sql .= " t_test ";
		$sql .= " SET ";
		$sql .= " send_mail=".$send_mail;
		$sql .= " WHERE ";
		$sql .= " id=".$id;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		
	}
	
	//吹き出し情報取得
	public function getTestFukidashi($where){
		$test_id = $where[ 'test_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
//		$sql .= " enabled = 1 AND ";
		$sql .= " del = 0 AND ";
		$sql .= " test_id=".$test_id ;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = array();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
		
	}


	public function getInfomation($id = "",$myid=""){
		$now = sprintf("%04d-%02d-%02d",date('Y'),date('m'),date('d'));
		$sql = "";
		$sql = "SELECT";
		$sql .= " i.*,h.infoid ";
		$sql .= " FROM ";
		$sql .= " information_tbl as i "
                        . " LEFT JOIN information_hidden as h ON i.id = h.infoid AND h.uid=".$myid;
		$sql .= " WHERE ";
		$sql .= " i.disp_status IN (2,3) AND ";
		$sql .= " i.date1 <= '".$now."' AND ";
		$sql .= " i.date2 >= '".$now."' "
                        . " AND h.infoid IS NULL ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                        
			//disp_id_listのチェック
			$disp = $result[ 'disp_id_list' ];
			if(strlen($result[ 'disp_id_list' ]) > 0 ){
				$ex = explode(":",$disp);
				if(in_array($id,$ex)){
					$rlt[$i] = $result;
				}
			}else{
				$rlt[$i] = $result;
			}
			$i++;
		}
		return $rlt;
	}
	
	public function getSite($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " logo_name ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
                $stmt = $this->db->prepare($sql);
                $r = $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $result;
	}
}
?>
