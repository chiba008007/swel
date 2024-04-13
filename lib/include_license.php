<?PHP
//----------------------------------
//ライセンスメソッド
//
//
//----------------------------------
class licenseMethod extends method{
	public function getLicense($type){
		//受検者数
		$sql = "";
		$sql = "SELECT ";
		$sql .= " count(id) as cnt ";
		$sql .= " ,type ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " disabled = 0 AND ";
		$sql .= " del = 0 AND ";
		$sql .= " 1=1  ";
		$sql .= " GROUP BY type ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $jyuken[ $result[ 'type' ] ] = $result[ 'cnt' ];
                }
            /*
		$r = mysql_query($sql);
		while($rlt = mysql_fetch_assoc($r)){
			$jyuken[ $rlt[ type ] ] = $rlt[ 'cnt' ];
		}
		*/
            
		//処理数
		$sql = "";
		$sql = "SELECT ";
		$sql .= " count(id) as cnt ";
		$sql .= " ,type ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " disabled = 0 AND ";
		$sql .= " del = 0 AND ";
		$sql .= " exam_state != 0 AND ";
		$sql .= " 1=1  ";
		$sql .= " GROUP BY type ";
                
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $syori[ $result[ 'type' ] ] = $result[ 'cnt' ];
                }
		
		//購入
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name,license_parts ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " license > 0 ";
                /*
		$r = mysql_query($sql);
		$rlt = array();
		while($rlt = mysql_fetch_assoc($r)){
			$ex = explode(":",$rlt[ 'license_parts' ]);
			foreach($ex as $key=>$val){
				$kounyu[$key+1] += $ex[$key];
			}
		}
                 * 
                 */
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $ex = explode(":",$rlt[ 'license_parts' ]);
                    foreach($ex as $key=>$val){
                            $kounyu[$key+1] += (int)$ex[$key];
                    }
                }
                
		//購入
		foreach($kounyu as $key=>$val){
			$kano[ $key ] = $val-$jyuken[$key];
		}
		//残数
		foreach($jyuken as $key=>$val){
			$zan[$key] = $jyuken[$key]-$syori[$key];
		}
		
		return array($kounyu,$jyuken,$kano,$syori,$zan);
	}

}
?>
