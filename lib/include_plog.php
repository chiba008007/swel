<?PHP
//----------------------------------
//検査ログ一覧管理画面メソッド
//
//
//----------------------------------
class plogMethod extends method{
	
	public function getPdfLogData($limitdata,$flg="",$where){

		$id = $limitdata[ 'id' ];
		$limit  = sprintf("%d",$limitdata[ 'limit'  ]);
		$offset = sprintf("%d",$limitdata[ 'offset' ]);

		$partner_name  = $where[ 'partner_name' ];
		$customer_name = $where[ 'customer_name' ];
		$exam_name     = $where[ 'test_name'   ];
		$exam_id       = $where[ 'exam_id' ];
		$pdf_type      = $where[ 'pdf_type'   ];
		$output_auth   = $where[ 'output_auth'   ];
		$from          = $where[ 'from'];
		$to            = $where[ 'to'];

		$sql = "";
		$sql = "SELECT";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " log_pdf";
		$sql .= " WHERE ";
		if($partner_name){
			$sql .= "partner_name like '%".$partner_name."%' AND ";
		}
		if($customer_name){
			$sql .= "customer_name like '%".$customer_name."%' AND ";
		}
		if($exam_name){
			$sql .= "test_name like '%".$exam_name."%' AND ";
		}
		if($exam_id){
			$sql .= "exam_id='".$exam_id."' AND ";
		}
		if($pdf_type){
			$sql .= "pdf_type like '%".$pdf_type."%' AND ";
		}
		if($output_auth){
			$sql .= "output_auth='".$output_auth."' AND ";
		}
		if($from){
			$sql .= "output_time >= '".$from."' AND ";
		}
		if($to){
			$sql .= "output_time <= '".$to."' AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " ORDER BY output_time desc";

                /*
		$rmax = mysql_query($sql);
		$this->rmaxd = mysql_num_rows($rmax);
*/
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i = 0;
                while($brow = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[$i] = $brow;
                    $i++;
                }
                $this->rmaxd = count($list);
                
		$sql .= " LIMIT ".$limit." OFFSET ".$offset;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rst = array();
                $i = 0;
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $rst[$i] = $rlt;
                    $i++;
                }
                
		return $rst;
	}




}
?>
