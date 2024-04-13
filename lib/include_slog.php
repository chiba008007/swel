<?PHP
//----------------------------------
//検査ログ一覧管理画面メソッド
//
//
//----------------------------------
class slogMethod extends method{
	

	public function getLogTable($where,$limit="",$offset=""){
		
		$sql = "";
		$sql = "SELECT  ";
		
		$sql .= " '' as tname";
		$sql .= " ,lt.id";
		$sql .= " ,lt.license_num ";
		$sql .= " ,lt.type ";
		$sql .= " ,lt.status ";
		$sql .= " ,lt.regist_ts";
		$sql .= " ,u.name as partnername";
		$sql .= " ,u2.name as fromname";
		$sql .= " ,'' as customername ";
		$sql .= " ,1 as flg ";
		$sql .= " ,'' as kensa ";
		$sql .= " FROM log_tbl as lt ";
		$sql .= " LEFT JOIN t_user as u ON lt.to_id = u.id";
		$sql .= " LEFT JOIN t_user as u2 ON lt.from_id = u2.id";
		$sql .= " WHERE ";
		$sql .= " u.del=0 ";
		if($where[ 'name' ]){
			$sql .= " AND u.name LIKE '%".$where[ 'name' ]."%'";
		}
		if($where[ 'regist_ts' ]){
			$sql .= " AND lt.regist_ts LIKE '%".$where[ 'regist_ts' ]."%'";
		}
		$sql .= " AND 1=1 ";


		$sql .= " UNION ALL ";
		$sql .= "SELECT";
		$sql .= "  lt.id";
		$sql .= " ,lt.tname ";
		$sql .= " ,lt.number as license_num";
		$sql .= " ,lt.type ";
		$sql .= " ,lt.status ";
		$sql .= " ,lt.regist_ts";
		
		$sql .= " ,u.name as partnername ";
		$sql .= " ,'' as fromname";
		$sql .= " ,u2.name as customername ";
		$sql .= " ,2 as flg";
		$sql .= " ,t.name as kensa ";
		$sql .= " FROM log_testpaper as lt ";
		$sql .= " LEFT JOIN t_user as u ON lt.pid = u.id ";
		$sql .= " LEFT JOIN t_user as u2 ON lt.cid = u2.id ";
		$sql .= " LEFT JOIN (SELECT name,id FROM  t_test ) as t ON lt.test_id = t.id";

		$sql .= " WHERE ";
		$sql .= " u.del=0 ";
		if($where[ 'name' ]){
			$sql .= " AND u.name LIKE '%".$where[ 'name' ]."%'";
		}
		if($where[ 'regist_ts' ]){
			$sql .= " AND lt.regist_ts LIKE '%".$where[ 'regist_ts' ]."%'";
		}

		$sql .= " AND 1=1 ";
		$sql .= " ORDER BY `regist_ts` DESC ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i = 0;
                while($brow = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[$i] = $brow;
                    $i++;
                }
                $this->row = count($list);
                
                

		if($limit){
			$sql .= " LIMIT ".$limit." OFFSET ".$offset;
		}       
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i = 0;
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[ $i ] = $rlt;
                    if($rlt[ 'flg' ] == 2){
                      //$list[ $i ][ 'name' ] = $rlt[ 'partnername' ]."　-　".$rlt[ 'customername' ]."　-　".$rlt[ 'tname' ];
                      $list[ $i ][ 'name' ] = $rlt[ 'partnername' ]."　-　".$rlt[ 'customername' ];
                    }else{
                      $list[ $i ][ 'name' ] = $rlt[ 'partnername' ];
                    }
                    $i++;
                }
		return $list;
	}
	public function getLogTableCSV($where,$limit="",$offset=""){
		
		$sql = "";

		$sql .= "SELECT";
		$sql .= "  lt.id";
		$sql .= " ,lt.tname ";
		$sql .= " ,lt.number as license_num";
		$sql .= " ,lt.type ";
		$sql .= " ,lt.status ";
		$sql .= " ,lt.regist_ts";
		
		$sql .= " ,u.name as partnername ";
		$sql .= " ,u2.name as customername ";
		$sql .= " ,2 as flg";
		$sql .= " ,t.name as kensa ";
		$sql .= " FROM log_testpaper as lt ";
		$sql .= " LEFT JOIN t_user as u ON lt.pid = u.id ";
		$sql .= " LEFT JOIN t_user as u2 ON lt.cid = u2.id ";
		$sql .= " LEFT JOIN (SELECT name,id FROM  t_test ) as t ON lt.test_id = t.id";

		$sql .= " WHERE ";
		$sql .= " u.del=0 ";


		$sql .= " AND 1=1 ";
		$sql .= " ORDER BY `regist_ts` DESC ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i = 0;
                while($brow = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[$i] = $brow;
                    $i++;
                }
                $this->row = count($list);
                
                  
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i = 0;
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[ $i ] = $rlt;
                   
                      $list[ $i ][ 'name' ] = $rlt[ 'partnername' ];
                   
                    $i++;
                }
		return $list;
	}


}
?>
