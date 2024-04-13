<?PHP
//----------------------------------
//BA検査結果メソッド
//
//
//----------------------------------
class cusRegMethod extends method{
	
	public function getPtData($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT name,temp_flg,pdf_button FROM t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = $stmt->fetch(PDO::FETCH_ASSOC);
		return $list;
		
	}

	public function getUserData($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT * FROM t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = $stmt->fetch(PDO::FETCH_ASSOC);
                return $list;
		
	}

	//-------------------------------------
	//販売可能数
	//$where u.id
	//$type 検査配列全体
	//-------------------------------------
	public function getSellCount($where){
		$id = $where[ 'id' ];
		//ライセンス数部品取得
		$sql = "";
		$sql = "SELECT ";
		$sql .= " license_parts  ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = $stmt->fetch(PDO::FETCH_ASSOC);
                $ex = explode(":",$list["license_parts"] );
		$i=1;
		foreach($ex as $key=>$val){
			$type[ 'type'.$i ] = $val;
			$i++;
		}
                
		$sql = "";
		$sql = "SELECT ";
		//全体
		$sql .= " u.license -  ( SELECT count(id) FROM t_testpaper WHERE partner_id=".$id." AND  disabled=0 AND del=0 AND  temp_flg=0) as sell";
		$i=1;
		foreach($type as $key=>$val){
			if($val){
				$sql .= " ,".$val."-(SELECT count(id) FROM t_testpaper WHERE partner_id=".$id." AND  disabled=0 AND del=0 AND  temp_flg=0 AND type=".$i." ) as ".$key;
			}
			$i++;
		}

		$sql .= " FROM ";
		$sql .= " t_user  as u ";
		
		$sql .= " WHERE ";
		$sql .= " u.id=".$id;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
	}
	//------------------------------
	//重複チェック
	//------------------------------
	public function dirCheck($check){
		$dir = $check[ 'dir' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " dir='".$dir."' AND ";
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                return $row;
                
	}
	public function idCheck($check){
		$exam_id = $check[ 'exam_id' ];
		$test_id = $check[ 'test_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " exam_id='".$exam_id."' AND ";
		$sql .= " test_id=".$test_id." AND ";
		$sql .= " 1=1 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                return $row;
	}
	//データ登録
	public function setData($table,$data){
		
		foreach($data as $key=>$val){
			$calum .= ",".$key;
			$value .= ",'".$val."'";
		}
		$calum = preg_replace("/^,/","",$calum);
		$value = preg_replace("/^,/","",$value);
		$sql = "";
		$sql = "INSERT INTO ".$table." (";
		$sql .= $calum;
		$sql .= ") VALUES (";
		$sql .= $value;
		$sql .= ")";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $id = $this->db->lastInsertId('id');
                return $id;
                
	}


	//---------------------------------
	//テストデータ登録
	//
	//--------------------------------
	public function setTestPaperData($num,$grp,$ptn,$cus,$test,$ex,$type){
		$count = ceil(count($num)/200);
		for($j=0;$j<$count;$j++){
			$sql = "";
			$sql = "INSERT INTO t_testpaper (";
			$sql .= "number,testgrp_id,partner_id,customer_id,test_id";
			$sql .= ",exam_id,type";
			if($_REQUEST[ 'pdf37_detail_flag' ]){
				$sql .= ",ampflag,ampdate";
			}
			$sql .= ") VALUES ";
			$i=$j*200;
			$sqlvals = "";
			for($k=$i;$k<$i+200;$k++){
				if($num[$k]){
					$sqlvals .= "(";
					$sqlvals .= "'".$num[$k]."',";
					$sqlvals .= "'".$grp[$k]."',";
					$sqlvals .= "'".$ptn[$k]."',";
					$sqlvals .= "'".$cus[$k]."',";
					$sqlvals .= "'".$test[$k]."',";
					$sqlvals .= "'".$ex[$k]."',";
					$sqlvals .= "'".$type[$k]."'";

					if($_REQUEST[ 'pdf37_detail_flag' ]){
						$sqlvals .= ",1,'".date( 'Y-m-d' )."'";
					}

					$sqlvals .= "),";
				}
			}

			$sqlvals = preg_replace("/,$/","",$sqlvals);
			$sql .= $sqlvals;
//print $sql;
//print "<br />";

                        
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                
		}
		
	}


}
?>
