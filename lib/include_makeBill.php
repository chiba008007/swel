<?PHP
//----------------------------------
//請求書作成メソッド
//
//
//----------------------------------
class makeBillMethod extends method{
	public function getPartner($where){
		$type = $where[ 'type' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id,login_id,login_pw,name ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " type = ".$type." AND ";
		$sql .= " del = 0 ";
		$sql .= " ORDER BY registtime DESC ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
	}
	
	public function getCustomer($where){
		$type = $where[ 'type' ];
		$pid  = $where[ 'pid'  ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id,login_id,login_pw,name ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " type = ".$type." AND ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " del = 0 ";
		$sql .= " ORDER BY registtime DESC ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
	}

	public function getUserDataBillList($where){
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " t.id,t.name,t.period_from,t.period_to ";
		$sql .= " ,count(tt.id) as cnt ";
		$sql .= " ,(CASE WHEN count(tt.id) = 0 THEN 0 ELSE 1 END ) as FLG ";
		$sql .= " FROM ";
		$sql .= " t_test as t ";
		$sql .= " LEFT JOIN t_testpaper as tt ON t.partner_id=tt.partner_id AND tt.customer_id=t.customer_id AND t.id=tt.testgrp_id AND tt.exam_state IN( 0,1 )  ";
		$sql .= " WHERE ";
		$sql .= " t.del=0 AND ";
		$sql .= " t.type=0 AND ";
		$sql .= " t.partner_id=".$where[ 'partner_id' ]." AND ";
		$sql .= " t.customer_id=".$where[ 'customer_id' ]." AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY t.dir ";
		$sql .= " ORDER BY FLG DESC , t.period_to DESC ";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
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
		while($result =$stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
		
	}
	//請求書No
	public function getBillNumber(){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " MAX(id) as id";
		$sql .= " FROM ";
		$sql .= " t_bill ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result =$stmt->fetch(PDO::FETCH_ASSOC);
		return $result[ 'id' ];
	}
	
	//テストデータ
	public function getTestData($where){
		$id   = $where[ 'id'   ];
		$type = $where[ 'type' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name,period_from,period_to,number,pdfdownload ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE  ";
		$sql .= " id=".$id." AND ";
		$sql .= " type=".$type."";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
		
	}



	public function getTestDetailGroupBill($where){
		$date1 = $where[ 'date1' ];
		$date2 = $where[ 'date2' ];
		$testgrp_id = $where[ 'testgrp_id' ];

		$sql = "";
		$sql = "SELECT ";
/*
		$sql .= " id";

		$sql .= " ,type ";
		$sql .= " ,count(type) as cnt ";
*/

		$sql .= " exam_id";
		$sql .= " ,max(fin_exam_date) as fin_exam_date ";
		$sql .= " ,max(exam_date) as exam_date ";
		$sql .= " ,test_id";

		$sql .= " FROM t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id;
		$sql .= " AND disabled = 0 ";
//		$sql .= " AND exam_state = 2";
		$sql .= " AND complete_flg = 1";
		$sql .= " AND 1=1 ";
		$sql .= " GROUP BY exam_id ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($rlt=$stmt->fetch(PDO::FETCH_ASSOC)){
			if($rlt[ 'fin_exam_date' ] == "0000-00-00 00:00:00"){
				$date1 = substr($date1,0,10);
				$date1 = preg_replace("/\-/","/",$date1);
				$date2 = substr($date2,0,10);
				$date2 = preg_replace("/\-/","/",$date2);

				if( $date1 <= $rlt[ 'exam_date' ] && $rlt[ 'exam_date' ] <= $date2){
					$id[ $i ] = $rlt['exam_id'];
					$i++;
				}
			}else{
				$dates1 = preg_replace("/\//","-",$date1);
				$dates2 = preg_replace("/\//","-",$date2);
				$dates1 = $dates1." 00:00:00";
				$dates2 = $dates2." 23:59:59";

				if( $dates1 <= $rlt[ 'fin_exam_date' ] && $rlt[ 'fin_exam_date' ] <= $dates2){
					$id[ $i ] = $rlt['exam_id'];
					$i++;
				}
			}
		}
		if($id && count($id)){
			foreach($id as $key=>$val){
				$line .= ",'".$val."'";
			}
			$line = preg_replace("/^,/","",$line);
			$sql = "";
			$sql = "SELECT ";
			$sql .= " type ";
			$sql .= " ,count(type) as cnt ";
			$sql .= " ,exam_id";
			$sql .= " ,exam_date ";
			$sql .= " ,test_id";

			$sql .= " FROM t_testpaper ";
			$sql .= " WHERE ";
			$sql .= " testgrp_id=".$testgrp_id;
			$sql .= " AND disabled = 0 ";
	//		$sql .= " AND exam_state = 2";
			$sql .= " AND complete_flg = 1";
		//	$sql .= " AND exam_date >='".$date1."'";
		//	$sql .= " AND exam_date <= '".$date2."'";
			$sql .= " AND exam_id IN(".$line.")";
			$sql .= " AND 1=1 ";
			$sql .= " GROUP BY type ";
			$stmt = $this->db->prepare($sql);
                        $stmt->execute();
			$i=0;
			while($rlt=$stmt->fetch(PDO::FETCH_ASSOC)){
				$list[ $i ] = $rlt;
				$i++;
			}
		}
/*
		$j=0;
		foreach($list as $key=>$val){
			$cnt[$j] = $val[ 'cnt' ];
			$j++;
		}
		$min = min($cnt);
		foreach($list as $key=>$val){
			$list[ $key ][ 'cnt' ] = $min;
		}
*/
		return $list;
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


}
?>
