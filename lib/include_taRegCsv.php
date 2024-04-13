<?PHP
//----------------------------------
//BA検査結果メソッド
//
//
//----------------------------------
class cusCsvMethod extends method{
	//データ取得
	public function getTestdetail($where){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " tamen_tbl ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$where[ 'testgrp_id' ];
		$r = mysql_query($sql);
		$i=1;
		while($rlt = mysql_fetch_assoc($r)){
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}

}
?>
