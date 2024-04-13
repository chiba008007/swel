<?PHP
//----------------------------------
//編集請求書メソッド
//
//
//----------------------------------
class cusEditBillMethod extends method{
	//請求書No
	public function getBillNumber(){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " MAX(id) as id";
		$sql .= " FROM ";
		$sql .= " t_bill ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $result[ id ];
	}

	public function to_wareki($y, $m, $d)
	{
	    //年月日を文字列として結合
	    $ymd = sprintf("%02d%02d%02d", $y, $m, $d);
	    if ($ymd <= "19120729") {
	        $gg = "明治";
	        $yy = $y - 1867;
	    } elseif ($ymd >= "19120730" && $ymd <= "19261224") {
	        $gg = "大正";
	        $yy = $y - 1911;
	    } elseif ($ymd >= "19261225" && $ymd <= "19890107") {
	        $gg = "昭和";
	        $yy = $y - 1925;
	    } elseif ($ymd >= "19890108") {
	        $gg = "平成";
	        $yy = $y - 1988;
	    }
		
	    return $yy;
	}

	//請求書新規作成ユーザーデータ取得
	public function getBillData($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id,name,post1,post2,prefecture,address1,address2,tel,rep_name,rep_busyo,license ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " del = 0 ";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
		
	}



}
?>
