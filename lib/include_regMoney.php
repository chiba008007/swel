<?PHP
//----------------------------------
//csvアップロードメソッド
//
//
//----------------------------------
class regMoneyMethod extends method{
	public function getData($data){
		$sql = "
				SELECT
					*
				FROM
					t_changeTest
				WHERE
					pid= '".$data[ 'pid' ]."'
				";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[$i] = $rlt;
			$i++;
                }
                return $list;
               
	}
	public function setData($data){
		$sql = "
				SELECT
					*
				FROM
					t_changeTest
				WHERE
					pid= '".$data[ 'pid' ]."'
					AND type = '".$data[ 'type' ]."'
				";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		if($row){
			$sql = "
					UPDATE t_changeTest SET
						dispname = '".$data[ 'dispname' ]."'
						,dispmoney = '".$data[ 'dispmoney' ]."'
						,status = '".$data[ 'status' ]."'
					WHERE
						pid = '".$data[ 'pid' ]."'
						AND type = '".$data[ 'type' ]."'
				";
		}else{
			$sql = "
				INSERT INTO t_changeTest
					(
						pid,type,dispname,dispmoney,status,regist_ts
					)VALUES(
						 '".$data[ 'pid' ]."'
						,'".$data[ 'type' ]."'
						,'".$data[ 'dispname' ]."'
						,'".$data[ 'dispmoney' ]."'
						,'".$data[ 'status' ]."'
						,NOW()
					)
				";
		}
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
	}
}
?>
