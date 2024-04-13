<?PHP
//----------------------------------
//多面評価登録メソッド
//
//
//----------------------------------
class custaRegMethod extends method{
	public function getTestPaper($where){
		$cid  = $where[ 'cid'     ];
		$pid  = $where[ 'pid'     ];
		$id   = $where[ 'tgrp_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " tt.id,tt.number,tt.exam_state ";
		$sql .= " ,ta.id as taid";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " LEFT JOIN (SELECT tp_id,id FROM tamen_tbl) as ta ON tt.id=ta.tp_id";
		$sql .= " WHERE ";
		$sql .= " tt.partner_id=".$pid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.testgrp_id =".$id." AND ";
		$sql .= " 1=1 ";
		$sql .= " ORDER BY number ASC ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                
		while($result = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[$result[ 'number' ]][ 'number'         ] = $result[ 'number' ];
			$list[$result[ 'number' ]][ 'id'             ] = $result[ 'id' ];
			$list[$result[ 'number' ]][ 'exam_state'     ] = $result[ 'exam_state' ];
			$list[$result[ 'number' ]][ 'taid'           ] = $result[ 'taid' ];

		}
		return $list;
	}
	
	public function tamenEdit($where,$edit){
		$sql = "";
		$sql = " UPDATE  ";
		$sql .= " tamen_tbl SET ";
		$sql .= " hv_id    = '".$edit[ 'hv_id' ]."',";
		$sql .= " hv_name  = '".$edit[ 'hv_name' ]."',";
		$sql .= " hv_busyo = '".$edit[ 'hv_busyo' ]."',";
		$sql .= " ev_id    = '".$edit[ 'ev_id' ]."',";
		$sql .= " ev_pwd   = '".$edit[ 'ev_pwd' ]."',";
		$sql .= " ev_name  = '".$edit[ 'ev_name' ]."',";
		$sql .= " ev_busyo = '".$edit[ 'ev_busyo' ]."',";
		$sql .= " relation = '".$edit[ 'relation' ]."'";
		$sql .= " WHERE ";
		$sql .= " tp_id=".$where[ 'tp_id' ]." AND ";
		$sql .= " testgrp_id = ".$where[ 'tgrp_id' ];
		
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
	}
	
	public function tamenSet($ins){
		
		$sql = "";
		$sql = "INSERT INTO tamen_tbl";
		$sql .= " ( ";
		$sql .= " tp_id,testgrp_id,hv_id,hv_name,hv_busyo,ev_id,ev_pwd,ev_name,ev_busyo,relation";
		$sql .= " )VALUES";
		$sql .= $ins;
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
	}
}
?>
