<?PHP
//----------------------------------
//csvアップロードメソッド
//
//
//----------------------------------
class cusSearchMethod extends method{
	public function getTestData($where){
		$ptid    = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		$limit   = $where[ 'limit'       ];
		$offset  = $where[ 'offset'      ];
		$exam_id = $where[ 'exam_id'     ];
		$kana    = $where[ 'kana'        ];
		$from    = $where[ 'from'        ];
		$to      = $where[ 'to'          ];
		$memo1   = $where[ 'memo1'          ];
		$memo2   = $where[ 'memo2'          ];

		$sql = "";
		$sql = " SELECT ";
		$sql .= " tt.exam_id, ";
		$sql .= " tt.name, ";
		$sql .= " tt.kana, ";
		$sql .= " tt.type, ";
		$sql .= " tt.exam_date, ";
		$sql .= " tt.birth, ";
		$sql .= " tt.exam_id, ";
		$sql .= " tt.memo1, ";
		$sql .= " tt.memo2, ";
		$sql .= " tt.number, ";
		$sql .= " t.test_id, ";
		$sql .= " t.name as testname ";

		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " LEFT JOIN (SELECT id, name, test_id, pdf_log_use, temp_flg, test_show_hide FROM t_test ) as t ON t.id=tt.test_id ";
		$sql .= " WHERE ";
		$sql .= " tt.partner_id=".$ptid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " t.pdf_log_use= 1 AND ";
		$sql .= " t.temp_flg != 1 AND ";
		$sql .= " t.test_show_hide = 1 AND ";
		$sql .= " tt.exam_state = 2 AND ";
		if($exam_id){
			$sql .= " tt.exam_id LIKE '%".$exam_id."%' AND ";
		}
		if($kana){
			$sql .= " ( tt.kana LIKE '%".$kana."%' OR tt.name LIKE '%".$kana."%') AND ";
		}
		if($memo1){
			$sql .= " ( tt.memo1 LIKE '%".$memo1."%' ) AND ";
		}
		if($memo2){
			$sql .= " ( tt.memo2 LIKE '%".$memo2."%' ) AND ";
		}
		if($from){
			$sql .= " tt.exam_date > '".$from."' AND ";
		}
		if($to){
			$sql .= " tt.exam_date < '".$to."' AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " ORDER BY exam_date DESC ";

                /*
		$r2 = mysql_query($sql);
		$this->row = mysql_num_rows($r2);
                 * 
                 */
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $this->row = $stmt->rowCount();
                
		$sql .= " limit ".$limit." OFFSET ".$offset;

                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                
                $i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
                
	}


	public function getTestData2($where,$rowflag = 0){
		$ptid    = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		$limit   = $where[ 'limit'       ];
		$offset  = $where[ 'offset'      ];
		$exam_id = $where[ 'exam_id'     ];
		$kana    = $where[ 'kana'        ];
		$from    = $where[ 'from'        ];
		$to      = $where[ 'to'          ];
		$memo1   = $where[ 'memo1'          ];
		$memo2   = $where[ 'memo2'          ];

		$sql = "";
		$sql = " SELECT ";
		$sql .= " tt.exam_id, ";
		$sql .= " tt.name, ";
		$sql .= " tt.kana, ";
		$sql .= " tt.type, ";
		$sql .= " tt.exam_date, ";
		$sql .= " tt.birth, ";
		$sql .= " tt.exam_id, ";
		$sql .= " tt.memo1, ";
		$sql .= " tt.memo2, ";
		$sql .= " tt.number, ";
		$sql .= " t.test_id, ";
		$sql .= " t.name as testname ";

		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " LEFT JOIN (SELECT id, name, test_id, pdf_log_use, temp_flg, test_show_hide FROM t_test ) as t ON t.id=tt.test_id ";
		$sql .= " WHERE ";
		$sql .= " tt.partner_id=".$ptid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		//$sql .= " t.pdf_log_use= 1 AND ";
		$sql .= " t.temp_flg != 1 AND ";
		$sql .= " t.test_show_hide = 1 AND ";
		$sql .= " tt.exam_state = 2 AND ";
		if($exam_id){
			$sql .= " tt.exam_id LIKE '%".$exam_id."%' AND ";
		}
		if($kana){
			$sql .= " ( tt.kana LIKE '%".$kana."%' OR tt.name LIKE '%".$kana."%') AND ";
		}
		if($memo1){
			$sql .= " ( tt.memo1 LIKE '%".$memo1."%' ) AND ";
		}
		if($memo2){
			$sql .= " ( tt.memo2 LIKE '%".$memo2."%' ) AND ";
		}
		if($from){
			$sql .= " tt.exam_date > '".$from."' AND ";
		}
		if($to){
			$sql .= " tt.exam_date < '".$to."' AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " GROUP BY tt.testgrp_id , tt.exam_id ";
		$sql .= " ORDER BY tt.exam_date DESC ";

                /*
		$r2 = mysql_query($sql);
		$this->row = mysql_num_rows($r2);
                 * 
                 */
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		if($rowflag){
			//$this->row = $stmt->rowCount();
			return $stmt->rowCount();
		}
		$sql .= " limit ".$limit." OFFSET ".$offset;

                
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
                
	}


}
?>
