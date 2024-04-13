<?PHP
//----------------------------------
//一括データ登録管理画面メソッド
//
//
//----------------------------------
class cusRFlgRegMethod extends method{
	public function getTest($where){
		$cid     = $where[ 'customer_id' ];
		$pid     = $where[ 'partner_id'  ];
		$test_id = $where[ 'test_id'     ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name,type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " test_id = ".$test_id." AND ";
		$sql .= " 1=1 ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                    $rlt[$i] = $result;
                    $i++;
		}

		return $rlt;

	}
	
	//----------------------------
	//行動価値検査登録
	//---------------------------
	public function setTestBa($set){
		$ins = "";
		foreach($set as $key=>$val){
			$ins .= "(";
			$ins .= "'".$val[ 'number'       ]."',";
			$ins .= "'".$val[ 'partner_id'   ]."',";
			$ins .= "'".$val[ 'customer_id'  ]."',";
			$ins .= "'".$val[ 'test_id'      ]."',";
			$ins .= "'".$val[ 'testgrp_id'   ]."',";
			$ins .= "'".$val[ 'exam_id'      ]."',";
			$ins .= "'".$val[ 'type'         ]."',";
			$ins .= "'".$val[ 'name'         ]."',";
			$ins .= "'".$val[ 'kana'         ]."',";
			$ins .= "'".$val[ 'birth'        ]."',";
			$ins .= "'".$val[ 'sex'          ]."',";
			$ins .= "'".$val[ 'exam_state'   ]."',";
			$ins .= "'".$val[ 'complete_flg' ]."',";
			$ins .= "'".$val[ 'exam_date'    ]."',";
			$ins .= "'".$val[ 'start_time'   ]."',";
			$ins .= "'".$val[ 'exam_time'    ]."',";
			$ins .= "'".$val[ 'level'        ]."',";
			$ins .= "'".$val[ 'score'        ]."',";
			for($i=1;$i<=36;$i++){
				$q = "q".$i;
				$ins .= "'".$val[ $q ]."',";
			}
			for($i=1;$i<=12;$i++){
				$dev = "dev".$i;
				$ins .= "'".$val[ $dev ]."',";
			}
			$ins .= "'".$val[ 'soyo' ]."'";

			$ins .= "),";
		}
		$inscode = preg_replace("/\,$/","",$ins);
		
		$sql = "";
		$sql .= "INSERT INTO t_testpaper ";
		$sql .= " ( ";
		$sql .= "number,partner_id,customer_id,test_id,testgrp_id,exam_id,type,";
		$sql .= "name,kana,birth,sex,exam_state,complete_flg,exam_date,";
		$sql .= "start_time,exam_time,level,score,";
		for($i=1;$i<=36;$i++){
			$q = "q".$i;
			$sql .= $q.",";
		}
		for($i=1;$i<=12;$i++){
			$dev = "dev".$i;
			$sql .= $dev.",";
		}
		$sql .= "soyo";

		$sql .= " )VALUES";
		$sql .= $inscode;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                
	}


	public function getMaxId($tbl){
		$sql = "SELECT MAX(id) as id FROM ".$tbl;
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $rlt[ 'id' ];
	}
	
	public function getTestId($where){
		$test_id     = $where[ 'test_id'       ];
		$type        = $where[ 'type'          ];
		$partner_id  = $where[ 'partner_id'    ];
		$customer_id = $where[ 'customer_id'   ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$test_id." AND ";
		$sql .= " type=".$type." AND ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " 1=1 ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $rlt;

	}


	//---------------------------------
	//テストデータ登録
	//NL-J21
	//--------------------------------
	public function setTestNLJ2($set){
		$count = ceil(count($set)/200);
		$clum = "";
		$vals = "";
		for($i=1;$i<=90;$i++){
			$clum .= ",ans".$i;
		}

		$clum2 = "";
		$clum3 = "";
		for($i=1;$i<=19;$i++){
			$clum2 .= ",score".$i;
			$clum3 .= ",soten".$i;

		}

		for($j=0;$j<=$count;$j++){
			$sql = "";
			$sql = "INSERT INTO nl2_member (";
			$sql .= "id,test_id,testgrp_id,exam_id,start_time";

			$sql .= ") VALUES ";
			$i=$j*200;
			$sqlvals = "";
			for($k=$i;$k<$i+200;$k++){
				if($set[$k][ 'id' ]){
					$sqlvals .= "(";
					$sqlvals .= "'".$set[$k]["id"]."',";
					$sqlvals .= "'".$set[$k]["testid"]."',";
					$sqlvals .= "'".$set[$k]["tgrpid"]."',";
					$sqlvals .= "'".$set[$k]["exid"]."',";
					$sqlvals .= "'".$set[$k]["start_time"]."'";
					$sqlvals .= "),";
				}
			}
			$sqlvals = preg_replace("/,$/","",$sqlvals);
			$sql .= $sqlvals;
			
			$stmt = $this->db->prepare($sql);
                        $stmt->execute();

			$sql = "INSERT INTO nl2_sec (";
			$sql .= "mv_id";
			$sql .= $clum;
			$sql .= ") VALUES ";
			$i=$j*200;
			$sqlvals = "";
			for($k=$i;$k<$i+200;$k++){
				if($set[$k][ 'id' ]){
					$sqlvals .= "(";
					$sqlvals .= "'".$set[$k]["id"]."'";
					for($n=1;$n<=90;$n++){
						$a = "ans".$n;
						$sqlvals .= ",'".$set[$k][$a]."'";
					}
					$sqlvals .= "),";
				}
			}
			$sqlvals = preg_replace("/,$/","",$sqlvals);
			$sql .= $sqlvals;

			$stmt = $this->db->prepare($sql);
                        $stmt->execute();
			

			$sql = "INSERT INTO nl2_score (";
			$sql .= "mv_id";
			$sql .= $clum2;
			$sql .= $clum3;
			$sql .= ") VALUES ";
			$i=$j*200;
			$sqlvals = "";
			for($k=$i;$k<$i+200;$k++){
				if($set[$k][ 'id' ]){
					$sqlvals .= "(";
					$sqlvals .= "'".$set[$k]["id"]."'";
					for($n=1;$n<=19;$n++){
						$a = $n;
						$sqlvals .= ",'".$set[$k][ 'hensa' ][$a]."'";
					}
					for($n=1;$n<=19;$n++){
						$a = $n;
						$sqlvals .= ",'".$set[$k][ 'soten' ][$a]."'";
					}
					$sqlvals .= "),";
				}
			}
			$sqlvals = preg_replace("/,$/","",$sqlvals);
			$sql .= $sqlvals;

			$stmt = $this->db->prepare($sql);
                        $stmt->execute();

		}
		
	}




}
?>
