<?PHP
class billMethod extends method{
	public function getUserData($data){
		$id = $data[ 'id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name,post1,post2,prefecture,address1,address2,tel ";
		$sql .= " ,fax,rep_name,rep_email,rep_busyo,license_parts,outputPdf";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " 1=1 ";
               
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	public function getBillMax(){
		$sql = "";
		$sql = "SELECT MAX(id)+1 as max FROM ";
		$sql .= " t_bill ";
		$sql .= " WHERE ";
		$sql .= " 1=1 ";
                /*
		$r = mysql_query($sql);
		$row = mysql_fetch_assoc($r);
                 * 
                 */
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result[ 'max' ];
	}

	public function to_wareki($y, $m, $d)
	{
	    //�N�����𕶎���Ƃ��Č���
	    $ymd = sprintf("%02d%02d%02d", $y, $m, $d);
	    if ($ymd <= "19120729") {
	        $gg = "����";
	        $yy = $y - 1867;
	    } elseif ($ymd >= "19120730" && $ymd <= "19261224") {
	        $gg = "�吳";
	        $yy = $y - 1911;
	    } elseif ($ymd >= "19261225" && $ymd <= "19890107") {
	        $gg = "���a";
	        $yy = $y - 1925;
	    } elseif ($ymd >= "19890108") {
	        $gg = "����";
	        $yy = $y - 1988;
	    }
	    $wareki = "{$gg}{$yy}�N{$m}��{$d}��";
	    return array($yy,$m,$d);
	}
	
	

	public function setBillData($data){

		$bill_num         = $data[ 'bill_num'         ];
		$eir_id	          = $data[ 'eir_id'           ];
		$testid           = $data[ 'testid'           ];
		$partner_id       = $data[ 'partner_id'       ];
		$customer_id      = $data[ 'customer_id'      ];
		$send_status      = $data[ 'send_status'      ];
		$money_total      = $data[ 'money_total'      ];
		$name             = $data[ 'name'             ];
		$pay_date         = $data[ 'pay_date'         ];
		$pay_bank         = $data[ 'pay_bank'         ];
		$pay_num          = $data[ 'pay_num'          ];
		$pay_name         = $data[ 'pay_name'         ];
		$post1            = $data[ 'post1'            ];
		$post2            = $data[ 'post2'            ];
		$address          = $data[ 'address'          ];
		$address2         = $data[ 'address2'          ];
		$busyo            = $data[ 'busyo'            ];
		$tanto            = $data[ 'tanto'            ];
		$title            = $data[ 'title'            ];
		$registdate       = $data[ 'registdate'       ];
		if($data[ 'download_status' ]){
			$download_status  = $data[ 'download_status'  ];
		}else{
			$download_status  = 0;
		}
		$other            = $data[ 'other'            ];
		
		$company_post1   = $data[ 'company_post1'   ];
		$company_post2   = $data[ 'company_post2'   ];
		$company_address = $data[ 'company_address' ];
		$company_address2 = $data[ 'company_address2' ];
		$company_name    = $data[ 'company_name'    ];
		
		$bill        = $data[ 'bill'        ];
		$regist_ts   = sprintf("%04d-%02d-%02d",date('Y'),date('m'),date('d'));
		
		$bill_term_date_from = $data[ 'bill_term_date_from' ];
		$bill_term_date_to   = $data[ 'bill_term_date_to'   ];
		
		$syahan_sts          = $data[ 'syahan_sts'   ];
		$tantohan_sts        = $data[ 'tantohan_sts' ];
		$post                = $data[ 'post' ];


		
		$sql = "";
		$sql = "SELECT * FROM t_bill ";
		$sql .= " WHERE ";
		$sql .= " bill_num = '".$bill_num."' ";
		$sql .= " AND 1=1 ";
                /*
		$r = mysql_query($sql);
		$row=mysql_num_rows($r);
		*/
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
		if($row){
			$sql = "";
			$sql .= "UPDATE t_bill SET ";
			$sql .= " money_total='".$money_total."'";
			$sql .= " ,name='".$name."'";
			$sql .= " ,eir_id='".$eir_id."'";
			$sql .= " ,title='".$title."'";
			$sql .= " ,pay_date='".$pay_date."'";
			$sql .= " ,pay_bank='".$pay_bank."'";
			$sql .= " ,pay_num='".$pay_num."'";
			$sql .= " ,pay_name='".$pay_name."'";
			$sql .= " ,post1='".$post1."'";
			$sql .= " ,post2='".$post2."'";
			$sql .= " ,address='".$address."'";
			$sql .= " ,address2='".$address2."'";
			$sql .= " ,busyo='".$busyo."'";
			$sql .= " ,tanto='".$tanto."'";
			$sql .= " ,registdate='".$registdate."'";
			$sql .= " ,company_post1='".$company_post1."'";
			$sql .= " ,company_post2='".$company_post2."'";
			$sql .= " ,company_address='".$company_address."'";
			$sql .= " ,company_address2='".$company_address2."'";
			$sql .= " ,company_name='".$company_name."'";
			$sql .= " ,other='".$other."'";
			$sql .= " ,download_status='".$download_status."'";
			//$sql .= " ,bill_term_date_from='".$bill_term_date_from."'";
			//$sql .= " ,bill_term_date_to='".$bill_term_date_to."'";
			$sql .= ",syahan_sts = '".$syahan_sts."'";
			$sql .= ",tantohan_sts = '".$tantohan_sts."'";
			$sql .= ",post = '".$post."'";
			$sql .= " WHERE ";
			$sql .= " bill_num = '".$bill_num."' ";
			
			
		}else{
			$sql = "";
			$sql = "INSERT INTO t_bill (";
			$sql .= "bill_num";
			$sql .= ",eir_id";
			$sql .= ",testid";
			$sql .= ",partner_id";
			$sql .= ",customer_id";
			$sql .= ",send_status";
			$sql .= ",money_total";
			$sql .= ",name";
			$sql .= ",title";
			$sql .= ",pay_date";
			$sql .= ",pay_bank";
			$sql .= ",pay_num";
			$sql .= ",pay_name";
			$sql .= ",post1";
			$sql .= ",post2";
			$sql .= ",address";
			$sql .= ",address2";
			$sql .= ",busyo";
			$sql .= ",post";
			$sql .= ",tanto";
			$sql .= ",registdate";
			$sql .= ",company_post1";
			$sql .= ",company_post2";
			$sql .= ",company_address";
			$sql .= ",company_address2";
			$sql .= ",company_name";
			$sql .= ",other";
			$sql .= ",download_status";
			$sql .= ",bill_term_date_from";
			$sql .= ",bill_term_date_to";
			$sql .= ",syahan_sts";
			$sql .= ",tantohan_sts";
			$sql .= ",regist_ts";
			$sql .= ")VALUES(";
			$sql .= "'".$bill_num."'";
			$sql .= ",'".$eir_id."'";
			$sql .= ",'".$testid."'";
			$sql .= ",'".$partner_id."'";
			$sql .= ",'".$customer_id."'";
			$sql .= ",'".$send_status."'";
			$sql .= ",'".$money_total."'";
			$sql .= ",'".$name."'";
			$sql .= ",'".$title."'";
			$sql .= ",'".$pay_date."'";
			$sql .= ",'".$pay_bank."'";
			$sql .= ",'".$pay_num."'";
			$sql .= ",'".$pay_name."'";
			$sql .= ",'".$post1."'";
			$sql .= ",'".$post2."'";
			$sql .= ",'".$address."'";
			$sql .= ",'".$address2."'";
			$sql .= ",'".$busyo."'";
			$sql .= ",'".$post."'";
			$sql .= ",'".$tanto."'";
			$sql .= ",'".$registdate."'";
			
			$sql .= ",'".$company_post1."'";
			$sql .= ",'".$company_post2."'";
			$sql .= ",'".$company_address."'";
			$sql .= ",'".$company_address2."'";
			$sql .= ",'".$company_name."'";
			
			$sql .= ",'".$other."'";
			$sql .= ",'".$download_status."'";
			$sql .= ",'".$bill_term_date_from."'";
			$sql .= ",'".$bill_term_date_to."'";
			$sql .= ",'".$syahan_sts."'";
			$sql .= ",'".$tantohan_sts."'";
			
			$sql .= ",'".$regist_ts."'";
			$sql .= ")";
		}
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                

		$sql = "";
		$sql = "SELECT id,bill_num FROM t_bill ";
		$sql .= " WHERE ";
		$sql .= " bill_num = '".$bill_num."' ";
		$sql .= " AND 1=1 ";
		//$r = mysql_query($sql);
		//$rlt = mysql_fetch_assoc($r);
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                
		$bill_id = $row[ 'id' ];
		
		$sql = "";
		$sql = "SELECT * FROM t_bill_list ";
		$sql .= " WHERE ";
		$sql .= " t_bill_id = '".$bill_id."' AND ";
		$sql .= " 1=1 ";

                /*
		$r = mysql_query($sql);
		$brow = mysql_num_rows($r);
                 * 
                 */
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $brow = $stmt->fetch(PDO::FETCH_ASSOC);
                
		if($brow){
			$sql = "";
			$sql = "DELETE FROM t_bill_list ";
			$sql .= " WHERE ";
			$sql .= " t_bill_id = '".$bill_id."' ";
			
			$stmt = $this->db->prepare($sql);
                        $stmt->execute();
			$i=1;

			foreach($bill as $key=>$val){
				//�f�[�^�̗L���̊m�F

				$sql = "";
				$sql = "SELECT * FROM t_bill_list ";
				$sql .= " WHERE ";
				$sql .= " t_bill_id = '".$bill_id."' ";
				$sql .= " AND number = ".$i;
				$sql .= " AND 1=1 ";
				//$r = mysql_query($sql);
				//$cnt = mysql_num_rows($r);
                                $stmt = $this->db->prepare($sql);
                                $stmt->execute();
                                $brow = $stmt->fetch(PDO::FETCH_ASSOC);
                                
				if($brow){
					$sql = "";
					$sql .= "UPDATE t_bill_list SET ";
					$sql .= " number='".$i."'";
					$sql .= " ,name='".$val[ 'article' ]."'";
					$sql .= " ,brand='".$val[ 'brand' ]."'";
					$sql .= " ,kikaku='".$val[ 'standard' ]."'";
					$sql .= " ,count='".$val[ 'number' ]."'";
					$sql .= " ,unit='".$val[ 'unit' ]."'";
					$sql .= " ,money='".$val[ 'unitprice' ]."'";
					$sql .= " ,price='".$val[ 'price' ]."'";
					$sql .= " WHERE ";
					$sql .= " t_bill_id='".$bill_id."'";
					$sql .= " AND number = ".$i;
				}else{
					$sql = "";
					$sql = "INSERT INTO t_bill_list (";
					$sql .= "t_bill_id";
					$sql .= ",number";
					$sql .= ",name";
					$sql .= ",brand";
					$sql .= ",kikaku";
					$sql .= ",count";
					$sql .= ",unit";
					$sql .= ",money";
					$sql .= ",price";
					$sql .= ",regist_ts";
					$sql .= ")VALUES(";
					$sql .= "'".$bill_id."'";
					$sql .= ",'".$i."'";
					$sql .= ",'".$val[ 'article' ]."'";
					$sql .= ",'".$val[ 'brand' ]."'";
					$sql .= ",'".$val[ 'standard' ]."'";
					$sql .= ",'".$val[ 'number' ]."'";
					$sql .= ",'".$val[ 'unit' ]."'";
					$sql .= ",'".$val[ 'unitprice' ]."'";
					$sql .= ",'".$val[ 'price' ]."'";
					$sql .= ",'".$regist_ts."'";
					$sql .= ")";
				}

				//mysql_query($sql);
                                $stmt = $this->db->prepare($sql);
                                $stmt->execute();
                                //$brow = $stmt->fetch(PDO::FETCH_ASSOC);
				$i++;
			}
		}else{
			$i=1;
			if(count($bill)){
				foreach($bill as $key=>$val){
					$sql = "";
					$sql = "INSERT INTO t_bill_list (";
					$sql .= "t_bill_id";
					$sql .= ",number";
					$sql .= ",name";
					$sql .= ",brand";
					$sql .= ",kikaku";
					$sql .= ",count";
					$sql .= ",unit";
					$sql .= ",money";
					$sql .= ",price";
					$sql .= ",regist_ts";
					$sql .= ")VALUES(";
					$sql .= "'".$bill_id."'";
					$sql .= ",'".$i."'";
					$sql .= ",'".$val[ 'article' ]."'";
					$sql .= ",'".$val[ 'brand' ]."'";
					$sql .= ",'".$val[ 'standard' ]."'";
					$sql .= ",'".$val[ 'number' ]."'";
					$sql .= ",'".$val[ 'unit' ]."'";
					$sql .= ",'".$val[ 'unitprice' ]."'";
					$sql .= ",'".$val[ 'price' ]."'";
					$sql .= ",'".$regist_ts."'";
					$sql .= ")";
					
					$i++;
					//mysql_query($sql);
                                        $stmt = $this->db->prepare($sql);
                                        $stmt->execute();
				}
			}
		}
	}

}
?>