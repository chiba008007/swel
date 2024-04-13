<?PHP
//----------------------------------
//テスト内容編集メソッド
//
//
//----------------------------------
class cusEditMethod extends method{

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
                /*
		$r = mysql_query($sql);
		$result = mysql_fetch_assoc($r);
		return $result;
                 * 
                 */
	}
	
	public function getTestData($where){
		$id          = $where[ 'id'          ];
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name,rest_mail_count,language,period_from,period_to,fin_disp,pdfdownload,temp_flg,enq_status,pdf_slice ,recommen,pdf_output_limit,pdf_output_limit_from,pdf_output_limit_to,pdf_output_limit_count,pdf_output_count,download_excel,excel_type";
		$sql .= " ,enabled,judge_login,exam_download,licensecard,test_show_hide,input_not_name,input_not_gender,youtubeflag,youtube";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " id=".$id." AND ";
		$sql .= " 1=1 ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
		//テスト型取得
		$sql = "";
		$sql = "SELECT ";
		$sql .= " type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " test_id=".$id." AND ";
		$sql .= " 1=1 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		while($rst = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$result[ 'type' ][$rst[ 'type' ]] = $rst[ 'type' ];
		}
		
		return $result;
	}
	
	//---------------------------------
	//受検登録数・未受検数取得
	//--------------------------------
	public function getTestCount($where,$cnt){
		$id          = $where[ 'id'          ];
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		$sql = "";
		$sql = " SELECT ";
		$sql .= " id ";
		$sql .= " ,COUNT(id) as regCnt";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$id." AND ";
		$sql .= " del=0 AND ";
		$sql .= " temp_flg = 0 AND ";
		$sql .= " disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY exam_id";
		//$r = mysql_query($sql);
		//$jyuken = mysql_num_rows($r);
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $jyuken = $stmt->rowCount();

		$sql = "";
		$sql = "SELECT * FROM (";
		$sql .= " SELECT ";
		$sql .= " id ,count( id ) as cnt";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$id." AND ";
		$sql .= " del=0 AND ";
		$sql .= " temp_flg = 0 AND ";
		$sql .= " disabled = 0 AND ";
		$sql .= " exam_state = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY exam_id";
		$sql .= " ) as a
				WHERE a.cnt = ".$cnt."
			";
		//$r = mysql_query($sql);
		//$mijyuken = mysql_num_rows($r);
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $mijyuken = $stmt->rowCount();
                
		$result[ 'jyuken'   ] = $jyuken;
		$result[ 'mijyuken' ] = $mijyuken;
		return $result;
		
		
	}
	
	
	
	public function getTestDetail($where){
		$id          = $where[ 'id'          ];
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		$tylist      = $where[ 'tylist'      ];
		
		$sql = "";
		$sql = "SELECT";
		$sql .= " weight,w1,w2,w3,w4,w5,w6,w7,w8,w9,w10,w11,w12,ave,sd ";
		$sql .= " ,minute_rest,rsei_type,tamen_type,vf4_object,stress_flg,no_disp_flg,number";
		$sql .= " ,type,array_tensaku_title_status,array_tensaku_text,download_excel,mhq_type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " test_id=".$id." AND ";
		$sql .= " del=0 AND ";
//		$sql .= " temp_flg = 0 AND ";

		$sql .= " type IN ('".$tylist."') AND";
		$sql .= " 1=1 ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		while($rst = $stmt->fetch(PDO::FETCH_ASSOC)){
			$result[$rst[ 'type' ]] = $rst;
		}
		
		return $result;	
	}
	
	public function getPdfDLCount($where){
                        $sql = "SELECT "
                                . " COUNT(id) as cnt "
                                . " FROM "
                                . " log_pdf "
                                . " WHERE "
                                . " test_id=".$where[ 'test_id' ]." "
                                . " GROUP BY exam_id";
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                        $row = 0;
                        while($stmt->fetch(PDO::FETCH_ASSOC)){
                            $row++;
                            
                        }
                        
                        $rst[ 'cnt' ] = $row;
                        return $rst;
                    }
	public function editTestData($where,$edit,$basetype = 1){

		$id          = $where[ 'id'          ];
		$customer_id = $where[ 'customer_id' ];
		$partner_id  = $where[ 'partner_id'  ];
		//親データ
		foreach($edit as $key=>$val){

			$sql = "";
			$sql = "UPDATE t_test ";
			$sql .= " SET ";
			$sql .= " number=number".$val[ 'number' ].",";
			$sql .= " period_from='".$val[ 'period_from' ]."',";
			$sql .= " period_to='".$val[ 'period_to' ]."',";
			if($basetype == 1){
				$sql .= " pdfdownload='".$val[ 'pdfdownload' ]."',";
			}
			$sql .= " fin_disp='".$val[ 'fin_disp' ]."',";
			if(isset($val[ 'enq_status' ])){
				$sql .= " enq_status='".$val[ 'enq_status' ]."',";
			}
			if(isset($val[ 'judge_login' ])){
				$sql .= " judge_login='".$val[ 'judge_login' ]."',";
			}
			if(isset($val[ 'pdf_slice' ])){
				$sql .= " pdf_slice='".$val[ 'pdf_slice' ]."',";
			}
			if($val[ 'weightchecked' ]){
				$sql .= " weight=0,";
			}else{
				$sql .= " weight=1,";
			}
			if($val[ 'weight' ] && count($val[ 'weight' ])){
				foreach($val[ 'weight' ] as $ks=>$vs){
					$sql .= $ks."='".$vs."',";
				}
			}
			$sql .= " minute_rest='".$val[ 'minute_rest' ]."',";
			$sql .= " rsei_type='".$val[ 'rsei_type' ]."',";
			$sql .= " vf4_object='".$val[ 'vf4_object' ]."',";
			$sql .= " tamen_type='".$val[ 'tamen_type' ]."',";
			$sql .= " stress_flg='".$val[ 'stress_flg' ]."',";
			$sql .= " rest_mail_count='".$val[ 'rest_mail_count' ]."',";
			$sql .= " array_tensaku_title_status='".$val[ 'array_tensaku_title_status' ]."',";
			$sql .= " array_tensaku_text ='".$val[ 'array_tensaku_text' ]."',";

			$sql .= " name='".$val[ 'test_name' ]."',";
			$sql .= " enabled='".$val[ 'enabled' ]."',";
   $sql .= " download_excel='".$val[ 'download_excel' ]."',";
   if(strlen($val[ 'exam_download' ]) > 0 ){
   	$sql .= " exam_download='".$val[ 'exam_download' ]."',";
   }                                              
			$sql .= " test_show_hide='".$val[ 'test_show_hide'  ]."',";
			if($basetype == 1){
				$sql .= " pdf_output_limit='".$val[ 'pdf_output_limit'  ]."',";
				$sql .= " pdf_output_limit_from='".$val[ 'pdf_output_limit_from'  ]."',";
				$sql .= " pdf_output_limit_to='".$val[ 'pdf_output_limit_to'  ]."',";
				$sql .= " pdf_output_count='".$val[ 'pdf_output_count'  ]."',";
				$sql .= " pdf_output_limit_count='".$val[ 'pdf_output_limit_count'  ]."',";
			}
			$sql .= " recommen='".$val[ 'recommen'  ]."',";
			$sql .= " input_not_name='".$val[ 'input_not_name'  ]."',";
			$sql .= " input_not_gender='".$val[ 'input_not_gender'  ]."',";
			$sql .= " youtube='".$val[ 'youtube'  ]."',";
			$sql .= " youtubeflag='".$val[ 'youtubeflag'  ]."',";
			$sql .= " licensecard='".$val[ 'licensecard'  ]."'";

			$sql .= " WHERE ";
			$sql .= " partner_id=".$partner_id." AND ";
			$sql .= " customer_id=".$customer_id." AND ";
			if($key){
				$sql .= " test_id=".$id." AND ";
			}else{
				$sql .= " id=".$id." AND ";
			}
			$sql .= " type = ".$key;
			$stmt = $this->db->prepare($sql);

                        $stmt->execute();
		}
	}
	
	public function editTestenabled($where){
		foreach($where[ 'set' ] as $key=>$val){
			$test_id     = $val[ 'testgrp_id'  ];
			$customer_id = $val[ 'customer_id' ];
			$partner_id  = $val[ 'partner_id'  ];
			

			$sql = "";
			$sql = "UPDATE t_test ";
			$sql .= " SET ";
			$sql .= " enabled = 1";
			$sql .= " WHERE ";
			$sql .= " partner_id=".$partner_id." AND ";
			$sql .= " customer_id=".$customer_id." AND ";
			$sql .= " test_id=".$test_id." AND ";
			$sql .= " type = ".$key;
			
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
		}
		

		
	}
	
	public function getNum($where){
		$partner_id   = $where[ 'partner_id'  ];
		$customer_id  = $where[ 'customer_id' ];
		$id           = $where[ 'id'          ];
		$sql = "SELECT ";
		$sql .= " MAX(number) as max ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$id." AND ";
		$sql .= " del=0 AND ";
		$sql .= " temp_flg = 0 AND ";
		$sql .= " disabled = 0  ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		//$r = mysql_query($sql);
		//$max = mysql_fetch_assoc($r);
		return $rlt;
	}
	
	public function getTestID($where){
		$partner_id   = $where[ 'partner_id'  ];
		$customer_id  = $where[ 'customer_id' ];
		$id           = $where[ 'id'          ];
		$sql = "SELECT ";
		$sql .= " id,type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " test_id=".$id." AND ";
		$sql .= " del=0 AND ";
		$sql .= " temp_flg = 0 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		while($rst =$stmt->fetch(PDO::FETCH_ASSOC)){
			$lists[$rst[ 'type' ]] = $rst[ 'id' ];
		}
		
		return $lists;
		
	}
	
	public function getExam($where){
		$partner_id   = $where[ 'partner_id'  ];
		$customer_id  = $where[ 'customer_id' ];
		$id           = $where[ 'id'          ];
		do{

			$flg = false;
			$exam_id = $this->getRandomString();
			$where[ 'exam_id' ] = $exam_id;
			$row = $this->checkExam($where);
			if($row){
				$flg = true;
			}else{
				$flg = false;
			}
		}while($flg);
		
		return $exam_id;
	}
	
	public function checkExam($where){
		$partner_id   = $where[ 'partner_id'  ];
		$customer_id  = $where[ 'customer_id' ];
		$id           = $where[ 'id'          ];
		$exam_id      = $where[ 'exam_id'     ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$id." AND ";
		$sql .= " exam_id='".$exam_id."' ";
		$sql .= " GROUP BY exam_id";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		
		return $row;
		
	}
	
	public function getCountTests($where){
		$partner_id   = $where[ 'partner_id'  ];
		$customer_id  = $where[ 'customer_id' ];
		$id           = $where[ 'id'          ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$id." ";
		$sql .= " GROUP BY exam_id";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		return $row;
		
	}
	public function setTestData($set,$exam){
		$ins = "";
		foreach($set['set'] as $key=>$val){
			$max = $set[ 'max' ];

			$partner_id   = $val[ 'partner_id'  ];
			$customer_id  = $val[ 'customer_id' ];
			$testgrp_id   = $val[ 'testgrp_id'  ];
			$test_id      = $val[ 'test_id'     ];
			$type         = $val[ 'type'        ];
			$ins = "";
			for($i=0;$i<$val[ 'count' ];$i++){
				$max++;
				$ins .= ",('".$max."','".$partner_id."','".$customer_id."','".$test_id."','".$testgrp_id."','".$exam[$max]."','".$type."')";
			}
			$ins = preg_replace("/^,/","",$ins);

			$sql = "";
			$sql = "INSERT INTO t_testpaper ";
			$sql .= "(";
			$sql .= " number,partner_id,customer_id,test_id,testgrp_id,exam_id,type";
			$sql .= ")VALUES";
			$sql .= $ins;
			$sql .= "";
			$stmt = $this->db->prepare($sql);
                        $stmt->execute();
		}
	}
	
	public function setTestDelete($set,$count,$typecnt){
		$i=0;

		foreach($set['set'] as $key=>$val){
			$del['partner_id' ]  = $val[ 'partner_id'  ];
			$del['customer_id']  = $val[ 'customer_id' ];
			$del['testgrp_id' ]  = $val[ 'testgrp_id'  ];
			$del['test_id'    ]  = $val[ 'test_id'     ];
			$del['type'       ]  = $val[ 'type'        ];
			$delList = $this->getDelList($del,$count,$typecnt);
			$dsql = $this->delTests($delList,$del);
			$i++;
		}
		foreach($dsql as $key=>$val){
			//mysql_query($val);
                        $stmt = $this->db->prepare($val);
                        $stmt->execute();
		}
	}
	public function getDelList($where,$cnt,$typecnt){
		$partner_id   = $where[ 'partner_id'  ];
		$customer_id  = $where[ 'customer_id' ];
		$testgrp_id   = $where[ 'testgrp_id'  ];
		$test_id      = $where[ 'test_id'     ];
		$type         = $where[ 'type'        ];
		
		$sql = "SELECT * FROM (
				 SELECT ";
		$sql .= " number ,count(id) as cnt";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$testgrp_id." AND ";
//		$sql .= " test_id='".$test_id."' AND ";
//		$sql .= " type = '".$type."' AND ";
		$sql .= " exam_state = 0 ";
		$sql .= " GROUP BY number ";
//		$sql .= " ORDER BY number ";
		
		$sql .= " ) as a 
				WHERE a.cnt = ".$typecnt."
				LIMIT ".$cnt;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($rst =  $stmt->fetch(PDO::FETCH_ASSOC) ){
			$number[$i] = $rst[ 'number' ];
			$i++;
		}
/*
		$imp = implode("','",$number);
		return $imp;
*/
		return $number;
	}
	public function delTests($line,$where){
		$partner_id   = $where[ 'partner_id'  ];
		$customer_id  = $where[ 'customer_id' ];
		$testgrp_id   = $where[ 'testgrp_id'  ];
		$test_id      = $where[ 'test_id'     ];
		$type         = $where[ 'type'        ];
		if(count($line)){
			foreach($line as $key=>$val){
				$sql = "";
				$sql .= "DELETE FROM t_testpaper ";
				$sql .= " WHERE ";
				$sql .= " number =".$val." AND ";
				$sql .= " partner_id=".$partner_id." AND ";
				$sql .= " customer_id=".$customer_id." AND ";
				$sql .= " testgrp_id=".$testgrp_id." AND ";
				//$sql .= " test_id='".$test_id."' AND ";
				//$sql .= " type = '".$type."'  AND";
				$sql .= " exam_state = 0; ";
				$asql[] = $sql;
			}

		}
		return $asql;

	}
	public function getExplain($where){
		$test_id = $where[ 'test_id' ];
		$sql = "SELECT
					*
				FROM
					t_test_explain
				WHERE
					test_id = '".$test_id."'
					";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rst = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $rst;
	}
	public function setExplain($where){
		$test_id = $where[ 'test_id' ];
		$explain = $where[ 'explain' ];
		$sql = "
				SELECT * FROM t_test_explain
					WHERE
					test_id = '".$test_id."'
				";
                
		//$r = mysql_query($sql);
		//$rst = mysql_fetch_assoc($r);
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rst = $stmt->fetch(PDO::FETCH_ASSOC);
                
		if(!$rst){
			$sql = "
				INSERT INTO t_test_explain
					(
					test_id
					,explain_text
					,regist_ts
					)VALUES(
					'".$test_id."'
					,'".$explain."'
					,NOW()
					)
				";
		}else{
			$sql = "
				UPDATE
					t_test_explain 
				SET
					explain_text = '".$explain."'
				WHERE
					test_id='".$test_id."'
				";
		}
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
	}
        
        
        public function getWeightData($where) {
           $uid = $where[ 'uid' ];
           $pid = $where[ 'pid' ];
           $sql = "SELECT * FROM t_weight_master "
                   . " WHERE "
                   . " uid=".$uid.""
                   . " AND pid = ".$pid."";
           
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
           $i=0;
           while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
               $list[$i] = $rlt;
               $i++;
           }
           return $list;
        }
}
