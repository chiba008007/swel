<?PHP
//----------------------------------
//tamenテスト用
//
//
//----------------------------------
class taMethod extends method{

	public function loginCheck($where){
		$birth = $where[ 'birth' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " tt.id, ";
		$sql .= " tt.birth, ";
		$sql .= " tat.tp_id";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " INNER JOIN (SELECT tp_id,ev_id FROM tamen_tbl) as tat ON tt.id = tat.tp_id ";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=".$where[ 'testgrp_id' ]." AND ";
		$sql .= " tat.ev_id='".$where[ 'ev_id'  ]."' AND ";
		$sql .= " 1=1 ";
		$r = mysql_query($sql);
		$upFlg = false;
		while($rlt = mysql_fetch_assoc($r)){
			$id .= ",'".$rlt[ 'tp_id' ]."'";
			//誕生日データが無い時はupdateをする
			if(!$rlt[ 'birth' ]){
				$upFlg = true;
			}else{
				$chkBirth = $rlt[ 'birth' ];
			}
		}

		$idline = preg_replace("/^,/","",$id);
		//誕生日が存在しない時は登録
		//ある時は、相違確認
		if($upFlg){
			$sql = "";
			$sql = "UPDATE ";
			$sql .= " t_testpaper ";
			$sql .= " SET ";
			$sql .= " birth='".$birth."'";
			$sql .= " WHERE ";
			$sql .= " id IN (".$idline.")";
			mysql_query($sql);
			
			$flg = true;
		}else{
			if($chkBirth == $birth){
				$flg = true;
			}else{
				return false;
			}
		}
		//登録データを返す
		if($flg){
			$sql = "";
			$sql = "SELECT ";
			$sql .= " * ";
			$sql .= " FROM ";
			$sql .= " tamen_tbl ";
			$sql .= " WHERE ";
			$sql .= " tp_id IN (".$idline.")";
			$r = mysql_query($sql);
			$i=0;
			$list = array();
			while($rlt = mysql_fetch_assoc($r)){
				$list[ $i ] = $rlt;
				$i++;
			}
			return $list;
		}

	}
	
	public function getTaisyoData($where){
		$id = $where[ 'tp_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " hv_busyo, ";
		$sql .= " relation,";
		$sql .= " period";
		$sql .= " FROM ";
		$sql .= " tamen_tbl ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
		$r = mysql_query($sql);
		$rlt = mysql_fetch_assoc($r);
		return $rlt;
	}
	
	public function getKensaData($where){
		//データ変更
		$sql = "";
		$sql = "UPDATE ";
		$sql .= " tamen_tbl";
		$sql .= " SET ";
		$sql .= " period=".$where[ 'period' ];
		$sql .= " WHERE ";
		$sql .= " id =".$where[ 'id' ];
		mysql_query($sql);
		
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " ta.* ";
		$sql .= " ,tt.birth";
		$sql .= " ,t.tamen_type";
		$sql .= " ,t.type";
		$sql .= " FROM ";
		$sql .= " tamen_tbl as ta";
		$sql .= " LEFT JOIN (SELECT id,birth,testgrp_id FROM t_testpaper ) as tt ON tt.id=ta.tp_id";
		$sql .= " LEFT JOIN (SELECT tamen_type,test_id,type FROM t_test ) as t ON t.test_id=tt.testgrp_id";
		$sql .= " WHERE ";
		$sql .= " ta.id =".$where[ 'id' ];
		$r = mysql_query($sql);
		$rlt = mysql_fetch_assoc($r);
		return $rlt;
	}
	
	
	public function getTamenRst($ta_id){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_state,tamen_type ";
		$sql .= " FROM ";
		$sql .= " tamen_result ";
		$sql .= " WHERE ";
		$sql .= " ta_id=".$ta_id." AND ";
		$sql .= " exam_state = 2";
		$r = mysql_query($sql);
		while($rlt = mysql_fetch_assoc($r)){
			$list[ $rlt[ 'tamen_type' ] ] = $rlt[ 'tamen_type' ];
		}
		return $list;
	}
	
	
	public function checkTamenResult($where){
		$ta_id      = $where[ 'ta_id'      ];
		$tamen_type = $where[ 'tamen_type' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id,exam_state ";
		$sql .= " FROM ";
		$sql .= " tamen_result ";
		$sql .= " WHERE ";
		$sql .= " ta_id=".$ta_id." AND ";
		$sql .= " tamen_type=".$tamen_type." ";
		$r = mysql_query($sql);
		$rlt = mysql_fetch_assoc($r);
		if($rlt[ 'exam_state' ] == 2){
			return 0;
		}else{
			return 1;
		}
	}
}
?>
