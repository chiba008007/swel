<?PHP
//----------------------------------
//お知らせ情報
//
//
//----------------------------------
class infoMethod extends method{

	public function getUserData($where){
		$type = $where[ 'type' ];
		$del  = $where[ 'del'  ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id,name ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " type=".$type." AND ";
		$sql .= " del =  ".$del;
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                $list = array();
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    if(isset($rlt[ 'id' ])){
                        $list[ $rlt[ 'id' ] ] = $rlt;
                    }
                    $i++;
                }
                
                
		return $list;
	}
	
	public function getInfo( $where = ""){
		$id = '';
		if(isset($where[ 'id' ]) && $where[ 'id' ] > 0){
			$id = $where[ 'id' ];
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " information_tbl ";
		$sql .= " WHERE ";
		if($id){
			$sql .= " id=".$id." AND";
		}
		$sql .= " 1=1 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                $list = array();
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[ $i ] = $rlt;
                    $i++;
                }
                
		return $list;
	}
	
	public function getUserLine($line){

		$sql = "";
		$sql = "SELECT ";
		$sql .= " name ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		if($line){
			$sql .= " id IN (".$line.") AND";
		}
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                $list = array();
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[ $i ] = $rlt;
                    $i++;
                }
                
                
		return $list;
	}
	
	public function deleteInfo($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "DELETE FROM ";
		$sql .= " information_tbl ";
		$sql .= " WHERE ";
		$sql .= " id= ".$id;
		$stmt = $this->db->prepare($sql);
                $stmt->execute();	
	}
        
}
?>
