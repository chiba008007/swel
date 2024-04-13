<?PHP
//----------------------------------
//PDF�_�E�����[�h���\�b�h
//
//
//----------------------------------
class pdfMethod extends method{
    
    public function getPdfLog($tid){
        $sql = "SELECT "
                . " id"
                . " FROM "
                . " log_pdf "
                . " WHERE "
                . " test_id=".$tid." "
                . " GROUP BY exam_id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row = [];
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $row[] = 1;
        }
        $rows = count($row);
        return $rows;
    }
    public function reGetPdfLog($tid,$examid){
        $sql = "SELECT "
                . " id"
                . " FROM "
                . " log_pdf "
                . " WHERE "
                . " test_id=".$tid." AND "
                . " exam_id = '".$examid."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $row = 0;
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $row += 1;
        }
        return $row;
    }
	public function getWeightKey($tid){
		$sql = "";
		$sql = "SELECT min(weight) as weight FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$tid;
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
		
	}
	//---------------------------------
	//�󌟃f�[�^
	//---------------------------------
	public function getTestData($where){
		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " t.pdfdownload ";
		$sql .= " ,t.stress_flg ,t.pdf_output_count ";
		$sql .= " ,t.pdf_output_limit ";
		$sql .= " ,t.pdf_output_limit_from ";
		$sql .= " ,t.pdf_output_limit_to ";
		$sql .= " ,t.pdf_output_limit_count ";
		$sql .= " ,t.pdf_output_count ";
		$sql .= " ,t.input_not_name ";
		$sql .= " ,t.input_not_gender ";
		$sql .= " ,t.weight ";
		if($grpid == 6260 && $pid == 690){
			$sql .= " ,min(tt.id) as id ";
		}else{
			$sql .= " ,tt.id";
		}
		$sql .= " ,tt.name";
		$sql .= " ,tt.kana";
		$sql .= " ,tt.sex";
		$sql .= " ,MAX(tt.score) as score";
		$sql .= " ,MAX(tt.level) as level";
		$sql .= " ,CASE ";
		$sql .= " WHEN tt.fin_exam_date != '0000-00-00 00:00:00' THEN tt.fin_exam_date ";
		$sql .= " ELSE ";
		$sql .= " tt.exam_date ";
		$sql .= " END as exam_dates";
		$sql .= " ,t.name as testname";
		$sql .= " ,MAX(tt.fin_exam_date) as findate";
		$sql .= " ,t.id as tid";
		$sql .= " ,tt.birth";
		$sql .= " ,tt.ampflag";
		$sql .= " ,(SELECT name FROM t_user WHERE id=".$cid.") as cusname";
		$sql .= " ,(SELECT rep_busyo FROM t_user WHERE id=".$cid.") as rep_busyo";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " LEFT JOIN (SELECT pdf_output_count, id,pdfdownload,name,weight,stress_flg,pdf_output_limit,pdf_output_limit_from,pdf_output_limit_to,pdf_output_limit_count,input_not_name,input_not_gender  FROM t_test ) as t ON tt.testgrp_id = t.id ";

		$sql .= " WHERE ";
		if($pid){
			$sql .= " tt.partner_id=".$pid." AND ";
		}
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.exam_id='".$exam_id."' AND ";
		$sql .= " tt.testgrp_id=".$grpid." AND ";
		$sql .= " 1=1 ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $result;
	}
	
	public function getType($where){
		$grpid   = $where[ 'testgrp_id'  ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		if($pid){
			$sql .= " partner_id=".$pid." AND ";
		}
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " test_id=".$grpid." AND ";
		$sql .= " 1=1 ";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$type[ $result[ 'type' ]] = $result[ 'type' ];
		}
		return $type;
		
	}
	//------------------------------------------
	//MET�擾
	//------------------------------------------
	public function getPdfDataMet($where){
		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		
		$sql = "
				SELECT 
				tt.exam_id,
				tt.sex,
				tt.exam_state,
				tt.complete_flg,
				tt.exam_date,
				tt.start_time,
				tt.exam_time,
				tt.pass,
				tt.memo1,
				tt.memo2,
				ms.*
				FROM 
				t_testpaper as tt
				INNER JOIN (SELECT id,testgrp_id,exam_id FROM met_member) as mm ON tt.testgrp_id = mm.testgrp_id AND tt.exam_id=mm.exam_id
				INNER JOIN (SELECT *  FROM met_score) as ms ON ms.met_id = mm.id
				WHERE
				tt.testgrp_id=".$grpid." AND
				tt.customer_id=".$cid." AND 
				tt.partner_id=".$pid." AND 
				tt.exam_id='".$exam_id."'
			
			";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rst = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rst;

		
	}
	//------------------------------------------
	//MET�擾
	//------------------------------------------
	public function getPdfDataMMS($where){
		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		
		$sql = "
				SELECT 
				tt.exam_id,
				tt.sex,
				tt.exam_state,
				tt.complete_flg,
				tt.exam_date,
				tt.start_time,
				tt.exam_time,
				tt.pass,
				tt.memo1,
				tt.memo2,
				ms.*
				FROM 
				t_testpaper as tt
				INNER JOIN (SELECT id,testgrp_id,exam_id FROM mms_member) as mm ON tt.testgrp_id = mm.testgrp_id AND tt.exam_id=mm.exam_id
				INNER JOIN (SELECT *  FROM mms_result) as ms ON ms.mms_id = mm.id
				WHERE
				tt.testgrp_id=".$grpid." AND
				tt.customer_id=".$cid." AND 
				tt.partner_id=".$pid." AND 
				tt.exam_id='".$exam_id."'
			
			";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rst = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rst;

		
	}
	
	//------------------------------------------
	//�e�X�g�d�݃f�[�^�擾
	//�d�݃f�[�^�͂P�݂̂Ȃ̂łP�f�[�^�擾
	//------------------------------------------
	public function getWeight($where,$type){
		$tid = $where[ 'testgrp_id' ];
		if(is_array($type)){
			$ty = implode(",",$type);
		}else{
			$ty = $type;
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= " w1";
		$sql .= " ,w2";
		$sql .= " ,w3";
		$sql .= " ,w4";
		$sql .= " ,w5";
		$sql .= " ,w6";
		$sql .= " ,w7";
		$sql .= " ,w8";
		$sql .= " ,w9";
		$sql .= " ,w10";
		$sql .= " ,w11";
		$sql .= " ,w12";
/*
		$sql .= " ,ave";
		$sql .= " ,sd";
		$sql .= " ,weight";
*/
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$tid." AND ";
		$sql .= " type IN(".$ty.") AND ";
		$sql .= " 1=1 ";
		           
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
    
		return $result;
	}
	
	//------------------------------------------
	//�e�X�g���󌱂������̔N����擾
	//
	//------------------------------------------
	function calc_age($birth,$date)
	{
	  $d = explode("/",$date);
		
	  $ty = $d[0];
	  $tm = $d[1];
	  $td = $d[2];
	  list($by, $bm, $bd) = explode('/', $birth);
	  $age = $ty - $by;
	  if($tm * 100 + $td < $bm * 100 + $bd) $age--;
	  return $age;
	}
	//---------------------------------
	//�^�C�v�P,2,3,�̃e�X�g�f�[�^�擾
	//---------------------------------
	public function getTestPaper($where,$type){
		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		$ty = implode(",",$type);
		$sql = "";
		$sql = "SELECT ";
		$sql .= " tt.type";
		$sql .= " ,tt.number";
		$sql .= " ,tt.dev1";
		$sql .= " ,tt.dev2";
		$sql .= " ,tt.dev3";
		$sql .= " ,tt.dev4";
		$sql .= " ,tt.dev5";
		$sql .= " ,tt.dev6";
		$sql .= " ,tt.dev7";
		$sql .= " ,tt.dev8";
		$sql .= " ,tt.dev9";
		$sql .= " ,tt.dev10";
		$sql .= " ,tt.dev11";
		$sql .= " ,tt.dev12";
		$sql .= " ,tt.soyo";
		$sql .= " ,p.sougo
			,p.personal
			,p.state
			,p.job
			,p.image
			,p.positive
			,p.self
		";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " LEFT JOIN t_pfs as p ON tt.id = p.testpaper_id ";
		$sql .= " WHERE ";
		$sql .= " tt.partner_id=".$pid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.exam_id='".$exam_id."' AND ";
		$sql .= " tt.testgrp_id=".$grpid." AND ";
		$sql .= " tt.type IN(".$ty.") AND ";
		$sql .= " 1=1 ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $result;
	}

	public function getAnswerPaper($where,$type){

		$grpid     = $where[ 'testgrp_id'  ];
		$exam_id   = $where[ 'exam_id'     ];
		$type      = $type;
		$pid       = $where[ 'pid'  ];
		$cid       = $where[ 'cid'  ];
		for($i=1;$i<=36;$i++){
			$q .= ",q".$i;
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_date";
		$sql .= $q;
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " exam_id='".$exam_id."' AND ";
		$sql .= " testgrp_id=".$grpid." AND ";
		$sql .= " type = ".$type." AND ";
		$sql .= " 1=1 ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $result;
	}




	//�X�g���X�f�[�^�擾
	public function getStress($dev1, $dev2) {
	  $ave = ($dev1 + $dev2) / 2;
	  $roundedAve = round($ave, 1);
	  if ($ave < 30) {
	    $st_level = 1;
	    $st_score = $roundedAve;
	  } else if ($ave < 35) {
	    if ($dev1 < 40 && $dev2 < 40) {
	      $st_level = 1;
	      $st_score = $roundedAve;
	    } else {
	      $st_level = 2;
	      $st_score = 35;
	    }
	  } else if ($ave < 40) {
	    if ($dev1 < 40 && $dev2 < 40) {
	      $st_level = 1;
	      $st_score = 34.9;
	    } else if ($dev1 < 30 || $dev2 < 30) {
	      $st_level = 2;
	      $st_score = $roundedAve;
	    } else {
	      $st_level = 3;
	      $st_score = 45;
	    }
	  } else if ($ave < 45) {
	    if ($dev1 < 30 || $dev2 < 30) {
	      $st_level = 2;
	      $st_score = $roundedAve;
	    } else if ($dev1 < 50 && $dev2 < 50) {
	      $st_level = 3;
	      $st_score = 45;
	    } else {
	      $st_level = 4;
	      $st_score = 55;
	    }
	  } else if ($ave < 50) {
	    if ($dev1 < 30 || $dev2 < 30) {
	      $st_level = 2;
	      $st_score = 44.9;
	    } else if ($dev1 < 50 && $dev2 < 50) {
	      $st_level = 3;
	      $st_score = $roundedAve;
	    } else {
	      $st_level = 4;
	      $st_score = 55;
	    }
	  } else if ($ave < 55) {
	    if ($dev1 < 30 || $dev2 < 30) {
	      $st_level = 2;
	      $st_score = 44.9;
	    } else {
	      $st_level = 4;
	      $st_score = 55;
	    }
	  } else if ($ave < 60) {
	    if ($dev1 < 50 || $dev2 < 50) {
	      $st_level = 4;
	      $st_score = $roundedAve;
	    } else if ($dev1 < 60 && $dev2 < 60) {
	      $st_level = 4;
	      $st_score = $roundedAve;
	    } else {
	      $st_level = 5;
	      $st_score = 65;
	    }
	  } else if ($ave < 65) {
	    if ($dev1 < 50 || $dev2 < 50) {
	      $st_level = 4;
	      $st_score = $roundedAve;
	    } else {
	      $st_level = 5;
	      $st_score = 65;
	    }
	  } else {
	    $st_level = 5;
	    $st_score = $roundedAve;
	  }
	  return array($st_level, $st_score);
	}


	//�X�g���X�f�[�^�擾
	public function getStress2($dev1, $dev2,$dev3) {

		$dev1 = sprintf("%s",($dev1 >= 70 )?60:$dev1);
		$dev2 = sprintf("%s",($dev2 >= 70 )?60:$dev2);
		$dev3 = sprintf("%s",($dev3 >= 70 )?60:$dev3);

		$dev1 = sprintf("%s",($dev1 <= 35.21  )?20:$dev1);
		$dev2 = sprintf("%s",($dev2 <= 35.21  )?20:$dev2);
		$dev3 = sprintf("%s",($dev3 <= 35.21  )?20:$dev3);
		
		//�|�W�e�B�u�v�l�̓X�R�A���]
		$dev3 = 100-$dev3;
		
		$ave = ($dev1+$dev2+$dev3)/3;
		$st_score = round($ave,1);
		if($ave >= 64.79 ){
			$st_level = 5;
		}elseif( $ave >= 54.49){
			$st_level = 4;
		}elseif( $ave >= 45.3 ){
			$st_level = 3;
		}elseif( $ave >= 35 ){
			$st_level = 2;
		}else{
			$st_level = 1;
		}
		
		return array($st_level, $st_score);
	}

	//---------------------------------
	//element�f�[�^�̎擾
	//---------------------------------
	public function getElementLists($where){
		$uid = $where[ 'uid' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_element ";
		$sql .= " WHERE ";
		$sql .= " uid=".$uid;

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $lists = $stmt->fetch(PDO::FETCH_ASSOC);
		return $lists;
		
	}

	
	//-------------------------------------
	//����\�͌������|�[�g�f�[�^�擾
	//-------------------------------------
	public function getPdfDataRs($where){

		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
			$sql = "";
			$sql = "SELECT tt.test_id,tt.testgrp_id,tt.exam_id,tt.birth,tt.exam_date,tt.type";
			$sql .= " FROM t_testpaper as tt ";
			$sql .= " WHERE ";
			$sql .= " tt.partner_id=".$pid." AND ";
			$sql .= " tt.customer_id=".$cid." AND ";
			$sql .= " tt.exam_id='".$exam_id."' AND ";
			$sql .= " tt.testgrp_id=".$grpid." AND ";
			$sql .= " tt.type IN (5,7,47,66,74) AND ";
			$sql .= " 1=1";
			$sql .= " limit 1";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
                        
			$i=0;
			unset($rlt);
			while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){

				$result[$i] = $rlt;
				$result[$i][ 'age' ] = $this->calc_age($rlt[ 'birth' ],$rlt[ 'exam_date' ]);
				if($rlt[ 'type' ] == 5){
					$sql = "";
					$sql = "SELECT ";
					$sql .= "ds.*,tt.exam_id,tt.exam_date,tt.name,tt.kana,birth ";
					$sql .= "FROM ";
					$sql .= "dp_member as dm INNER JOIN dp_score as ds ON dm.id=ds.dp_id,t_testpaper as tt ";
					$sql .= " WHERE ";
					$sql .= " dm.test_id=".$rlt[ 'test_id' ]." AND ";
					$sql .= " dm.testgrp_id=".$rlt[ 'testgrp_id' ]." AND ";
					$sql .= " dm.exam_id='".$rlt[ 'exam_id' ]."' AND ";
					$sql .= " tt.exam_id='".$rlt[ 'exam_id' ]."' AND ";
					$sql .= " tt.test_id=".$rlt[ 'test_id' ]." AND ";
					$sql .= " tt.testgrp_id=".$rlt[ 'testgrp_id' ]." AND ";
					$sql .= " 1=1 ";

					$stmt = $this->db->prepare($sql);
					$stmt->execute();
					$ans = $stmt->fetch(PDO::FETCH_ASSOC);
                
					$result[ $i ] = $ans;
					$result[$i][ 'age' ] = $this->calc_age($rlt[ 'birth' ],$rlt[ 'exam_date' ]);

				}
				if($rlt[ 'type' ] == 7){
					$sql = "";
					$sql = "SELECT ";
					$sql .= "rs.*,rss.*,tt.exam_id,tt.exam_date,tt.name,tt.kana,birth ";
					$sql .= "FROM ";
					$sql .= "rs_member as rs INNER JOIN rs_score as rss ON rs.id=rss.rs_id,t_testpaper as tt ";
					$sql .= " WHERE ";
					$sql .= " rs.test_id=".$rlt[ 'test_id' ]." AND ";
					$sql .= " rs.testgrp_id=".$rlt[ 'testgrp_id' ]." AND ";
					$sql .= " rs.exam_id='".$rlt[ 'exam_id' ]."' AND ";
					$sql .= " tt.exam_id='".$rlt[ 'exam_id' ]."' AND ";
					$sql .= " tt.test_id=".$rlt[ 'test_id' ]." AND ";
					$sql .= " tt.testgrp_id=".$rlt[ 'testgrp_id' ]." AND ";
					$sql .= " 1=1 ";

					$stmt = $this->db->prepare($sql);
					$stmt->execute();
					$ans = $stmt->fetch(PDO::FETCH_ASSOC);

					$result[ $i ] = $ans;
					$result[$i][ 'age' ] = $this->calc_age($rlt[ 'birth' ],$rlt[ 'exam_date' ]);
				}
				if($rlt[ 'type' ] == 47){
					$sql = "";
					$sql = "SELECT ";
					$sql .= "rs.*,rss.*,tt.exam_id,tt.exam_date,tt.name,tt.kana,birth ";
					$sql .= "FROM ";
					$sql .= "rs2_member as rs INNER JOIN rs2_score as rss ON rs.id=rss.rs_id,t_testpaper as tt ";
					$sql .= " WHERE ";
					$sql .= " rs.test_id=".$rlt[ 'test_id' ]." AND ";
					$sql .= " rs.testgrp_id=".$rlt[ 'testgrp_id' ]." AND ";
					$sql .= " rs.exam_id='".$rlt[ 'exam_id' ]."' AND ";
					$sql .= " tt.exam_id='".$rlt[ 'exam_id' ]."' AND ";
					$sql .= " tt.test_id=".$rlt[ 'test_id' ]." AND ";
					$sql .= " tt.testgrp_id=".$rlt[ 'testgrp_id' ]." AND ";
					$sql .= " 1=1 ";
					$stmt = $this->db->prepare($sql);
					$stmt->execute();
					$ans = $stmt->fetch(PDO::FETCH_ASSOC);
					$result[ $i ] = $ans;
					$result[$i][ 'age' ] = $this->calc_age($rlt[ 'birth' ],$rlt[ 'exam_date' ]);
				}

				if($rlt[ 'type' ] == 66 || $rlt[ 'type' ] == 74){
					$sql = "";
					$sql = "SELECT ";
					$sql .= "rs.*,rss.*,tt.exam_id,tt.exam_date,tt.name,tt.kana,birth ";
					$sql .= "FROM ";
					$sql .= "rs3_member as rs INNER JOIN rs3_score as rss ON rs.id=rss.rs_id,t_testpaper as tt ";
					$sql .= " WHERE ";
					$sql .= " rs.test_id=".$rlt[ 'test_id' ]." AND ";
					$sql .= " rs.testgrp_id=".$rlt[ 'testgrp_id' ]." AND ";
					$sql .= " rs.exam_id='".$rlt[ 'exam_id' ]."' AND ";
					$sql .= " tt.exam_id='".$rlt[ 'exam_id' ]."' AND ";
					$sql .= " tt.test_id=".$rlt[ 'test_id' ]." AND ";
					$sql .= " tt.testgrp_id=".$rlt[ 'testgrp_id' ]." AND ";
					$sql .= " 1=1 ";
                                        
					$stmt = $this->db->prepare($sql);
					$stmt->execute();
					$ans = $stmt->fetch(PDO::FETCH_ASSOC);
                                        
					$result[ $i ] = $ans;
					$result[$i][ 'age' ] = $this->calc_age($rlt[ 'birth' ],$rlt[ 'exam_date' ]);
				}

				$i++;
			}

		return $result;
	}

	//-------------------------------------
	//����\�͌������|�[�g�f�[�^�擾
	//$table�͔z��
	//$table[0]:mv_member
	//$table[1]:mv_score
	//-------------------------------------
	public function getMovePdfData($where,$table){
		
		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		$tbl     = $table[0];
		$tbl1    = $table[1];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " tt.test_id,tt.testgrp_id,tt.exam_id,tt.birth,tt.exam_date,tt.type,tt.name,tt.kana,tt.birth ";
		$sql .= " ,mm2.score1,mm2.score2,mm2.score3,mm2.score4,mm2.score5,mm2.score6,mm2.score7,mm2.score8,mm2.score9,mm2.score10,mm2.score11,mm2.score12 ";
		$sql .= " ,mm2.score13,mm2.score14,mm2.score15,mm2.score16,mm2.score17,mm2.score18,mm2.score19,mm2.score20,mm2.score21,mm2.score22,mm2.score23,mm2.score24,mm2.score25 ";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " INNER JOIN (SELECT id,testgrp_id,test_id,exam_id FROM ".$tbl." ) as mm ON tt.testgrp_id=mm.testgrp_id AND tt.test_id=mm.test_id AND tt.exam_id=mm.exam_id";
		$sql .= " INNER JOIN (SELECT mv_id,score1,score2,score3,score4,score5,score6,score7,score8,score9,score10,score11,score12,score13,score14,score15,score16,score17,score18,score19,score20,score21,score22,score23,score24,score25 FROM ".$tbl1." ) as mm2 ON mm2.mv_id = mm.id ";
		$sql .= " WHERE ";
		$sql .= " tt.partner_id=".$pid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.exam_id='".$exam_id."' AND ";
		$sql .= " tt.testgrp_id=".$grpid." AND ";
		$sql .= " 1=1 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                                        
		if($rlt){
			$rlt[ 'age' ] = $this->calc_age($rlt[ 'birth' ],$rlt[ 'exam_date' ]);
		}
		return $rlt;

	}

	//-------------------------------------
	//VF����(�̗p���l�����/�\���Ȃ� ����)
	//$table�͔z��
	//$table[0]:vf2_member
	//$table[1]:vf2_result
	//$table[2]:vf2_weight
	//-------------------------------------

	public function getVFPdfData($where,$table){
		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		$tbl     = $table[0];
		$tbl1    = $table[1];
		$tbl2    = $table[2];

		//�o��PDF���ƂɃf�[�^���擾����
		$sql = "";
		$sql = "SELECT tt.test_id,tt.testgrp_id,tt.exam_id,tt.birth,tt.exam_date,tt.type,tt.name,tt.kana,tt.birth,t.vf4_object";
		$sql .= " ,vw.w1,vw.w2,vw.w3,vw.w4,vw.w5,vw.w6,vw.w7,vw.w8,vw.w9,vw.w10,vw.w11,vw.w12";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " INNER JOIN (SELECT vf4_object,test_id,type  FROM t_test ) as t  ON t.test_id = tt.testgrp_id AND t.type = tt.type";
		$sql .= " INNER JOIN (SELECT id,test_id,exam_id FROM ".$tbl." ) as vm ON tt.test_id = vm.test_id AND tt.exam_id=vm.exam_id ";
		$sql .= " INNER JOIN (SELECT id,test_id,mem_id FROM ".$tbl1." ) as vr ON tt.test_id = vr.test_id AND vm.id=vr.mem_id ";
		$sql .= " INNER JOIN (SELECT w1,w2,w3,w4,w5,w6,w7,w8,w9,w10,w11,w12,test_id,r_id FROM ".$tbl2." ) as vw ON tt.test_id = vw.test_id AND vr.id=vw.r_id ";
		
		$sql .= " WHERE ";
		$sql .= " tt.partner_id=".$pid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.exam_id='".$exam_id."' AND ";
		$sql .= " tt.testgrp_id=".$grpid." AND ";
		$sql .= " 1=1";
		$sql .= " limit 1";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                
		if($rlt){
			$rlt[ 'age' ] = $this->calc_age($rlt[ 'birth' ],$rlt[ 'exam_date' ]);
		}
		return $rlt;
	}
	
	//-------------------------------------
	//CRTS�f�[�^�擾
	//
	//-------------------------------------
	public function getPdfDataCRTS($where){
		$sql = "
				SELECT 
					r.* 
				FROM 
					crt_member as m
					LEFT JOIN crt_result as r ON m.id=r.crt_id
				WHERE
					exam_id = '".$where[ 'exam_id' ]."'
					AND testgrp_id=".$where[ 'testgrp_id' ]."
				
				";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[$rlt[ 'tensaku_id' ]] = $rlt;
		}
		return $list;
	}
	
	
	//----------------------------
	//A3���x���擾
	//---------------------------
	function getLevela3($point){
		if($point >= 64.789 ){
			$lv = 5;
		}elseif($point >= 54.969){
			$lv = 4;
		}elseif($point >= 45.0299){
			$lv = 3;
		}elseif($point >= 35.2099){
			$lv = 2;
		}else{
			$lv = 1;
		}
		return $lv;
	}






	//�_��������
	function dotted($x,$y){
		global $pdf;
		$startX = $x;

		for($i=0; $i < 8; $i++){

			if($i%2 == 0){
				$startY = $y + $i;
				$endY = $startY + 1.25;
				$pdf->Line($x,$startY,$x,$endY);
			}

		}
	}

	// 星の位置
	function starPlace($key,$lv,$no){

		$key1 = $key;
		$lv1 = $lv;

		$no1 = $no['1'];
		$no2 = $no['2'];
		$no3 = $no['3'];
		$no4 = $no['4'];
		$no5 = $no['5'];
		$no6 = $no['6'];
		$no7 = $no['7'];
		$no8 = $no['8'];
		$no9 = $no['9'];

		if($key1 == 1){

			//要注意
			if($lv1 == 3){
				if($no1 >= 20){
					$star['3']['1'] = "★";
				}elseif($no1 >= 15){
					$star['3']['2'] = "★";
				}elseif($no1 >= 10){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no1 >= 7){
					$star['2']['1'] = "★";
				}elseif($no1 >= 6){
					$star['2']['2'] = "★";
				}elseif($no1 >= 3){
					$star['2']['3'] = "★";
				}
			}
			// 問題なし
			if($lv1 == 1){
				if( $no1 > -20  && $no1 < 3 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -20){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}

		}elseif($key1 == 2){

			
			if($lv1 == 3){
				if($no2 >= 15){
					$star['3']['1'] = "★";
				}elseif($no2 >= 8){
					$star['3']['2'] = "★";
				}elseif($no2 >= 5){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no2 >= 2){
					$star['2']['1'] = "★";
				}elseif($no2 >= 1){
					$star['2']['2'] = "★";
				}elseif($no2 > 0){
					$star['2']['3'] = "★";
				}
			}
			
			// 問題なし
			if($lv1 == 1){
				if( $no1 > -5  && $no1 <= 0 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -5){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}

		}elseif($key1 == 3){

			//要注意
			if($lv1 == 3){
				if($no3 >= 15){
					$star['3']['1'] = "★";
				}elseif($no3 >= 8){
					$star['3']['2'] = "★";
				}elseif($no3 >= 6){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no3 >= 2){
					$star['2']['1'] = "★";
				}elseif($no3 >= 1){
					$star['2']['2'] = "★";
				}elseif($no3 > 0){
					$star['2']['3'] = "★";
				}
			}
			// 問題なし
			if($lv1 == 1){
				if( $no1 > -5  && $no1 <= 0 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -5){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}

		}elseif($key1 == 4){

			//要注意
			if($lv1 == 3){
				if($no4 >= 15){
					$star['3']['1'] = "★";
				}elseif($no4 >= 7){
					$star['3']['2'] = "★";
				}elseif($no4 >= 1){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no4 >= 0.8){
					$star['2']['1'] = "★";
				}elseif($no4 >= 0.5){
					$star['2']['2'] = "★";
				}elseif($no4 > 0){
					$star['2']['3'] = "★";
				}
			}
			// 問題なし
			if($lv1 == 1){
				if( $no1 > -10 && $no1 <= 0 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -10){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}


		}elseif($key1 == 5){

			//要注意
			if($lv1 == 3){
				if($no5 >= 25){
					$star['3']['1'] = "★";
				}elseif($no5 >= 20){
					$star['3']['2'] = "★";
				}elseif($no5 >= 15){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no5 >= 10){
					$star['2']['1'] = "★";
				}elseif($no5 >= 8){
					$star['2']['2'] = "★";
				}elseif($no5 >= 5){
					$star['2']['3'] = "★";
				}
			}

			// 問題なし
			if($lv1 == 1){
				if( $no1 > -20 && $no1 < 5 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -20){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}
		}elseif($key1 == 6){

			//要注意
			if($lv1 == 3){
				if($no6 >= 30){
					$star['3']['1'] = "★";
				}elseif($no6 >= 25){
					$star['3']['2'] = "★";
				}elseif($no6 >= 15){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no6 >= 10){
					$star['2']['1'] = "★";
				}elseif($no6 >= 9){
					$star['2']['2'] = "★";
				}elseif($no6 >= 7){
					$star['2']['3'] = "★";
				}
			}

			// 問題なし
			if($lv1 == 1){
				if( $no1 > -30 && $no1 < 7 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -30){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}

		}elseif($key1 == 7){

			//要注意
			if($lv1 == 3){
				if($no7 >= 25){
					$star['3']['1'] = "★";
				}elseif($no7 >= 20){
					$star['3']['2'] = "★";
				}elseif($no7 >= 15){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no7 >= 10){
					$star['2']['1'] = "★";
				}elseif($no7 >= 6){
					$star['2']['2'] = "★";
				}elseif($no7 >= 5){
					$star['2']['3'] = "★";
				}
			}

			// 問題なし
			if($lv1 == 1){
				if( $no1 > -20 && $no1 < 5 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -20){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}
		}elseif($key1 == 8){

			//要注意
			if($lv1 == 3){
				if($no8 >= 25){
					$star['3']['1'] = "★";
				}elseif($no8 >= 20){
					$star['3']['2'] = "★";
				}elseif($no8 >= 15){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no8 >= 10){
					$star['2']['1'] = "★";
				}elseif($no8 >= 6){
					$star['2']['2'] = "★";
				}elseif($no8 >= 5){
					$star['2']['3'] = "★";
				}
			}

			// 問題なし
			if($lv1 == 1){
				if( $no1 > -20 && $no1 < 5 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -20){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}
		}elseif($key1 == 9){

			//要注意
			if($lv1 == 3){
				if($no9 >= 20){
					$star['3']['1'] = "★";
				}elseif($no9 >= 15){
					$star['3']['2'] = "★";
				}elseif($no9 >= 10){
					$star['3']['3'] = "★";
				}
			}

			//注意
			if($lv1 == 2){
				if($no9 >= 8){
					$star['2']['1'] = "★";
				}elseif($no9 >= 5){
					$star['2']['2'] = "★";
				}elseif($no9 >= 4){
					$star['2']['3'] = "★";
				}
			}
			// 問題なし
			if($lv1 == 1){
				if( $no1 > -15 && $no1 < 4 ){
					$star['1']['1'] = "★";
				}elseif($no1 >= -15){
					$star['1']['2'] = "★";
				}else{
					$star['1']['3'] = "★";
				}
			}
		}

		return $star;

	}

	//-------------------------------------
	//VF����(�̗p���l�����/�\���Ȃ� ����)
	//$table�͔z��
	//$table[0]:math_member
	//$table[1]:math_score
	//$table[2]:math_sec
	//-------------------------------------

	public function getMathDataList($where,$table){
		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];
		$tbl     = $table[0];
		$tbl1    = $table[1];
		$tbl2    = $table[2];

		$sql = "";
		$sql = "SELECT ";
		$sql .= " mm.id";
		$sql .= " ,tt.exam_id,tt.test_id,tt.testgrp_id,mm.start_time";
		$sql .= ",m_sc.*,m_se.* ";
		$sql .= ",tt.partner_id,tt.customer_id,tt.name,tt.kana,tt.birth,tt.sex,tt.start_time,tt.exam_date,tt.exam_time";
		$sql .= ",tt.pass,tt.memo1,tt.memo2 ,t.name as testname,u2.name as customer_name,u.name as partner_name";
		$sql .= " FROM  t_testpaper as tt ";
		$sql .= " INNER JOIN ".$tbl." as mm  ON tt.test_id = mm.test_id AND tt.exam_id=mm.exam_id";
		$sql .= " INNER JOIN ".$tbl1." as m_sc ON mm.id=m_sc.math_id ";
		$sql .= " INNER JOIN ".$tbl2." as m_se ON mm.id=m_se.math_id ";
		$sql .= " INNER JOIN t_test as t ON t.id=tt.test_id";
		$sql .= " INNER JOIN t_user as u ON u.id = tt.partner_id ";
		$sql .= " INNER JOIN t_user as u2 ON tt.customer_id = u2.id ";
		$sql .= " WHERE ";
		$sql .= " tt.partner_id=".$pid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.exam_id='".$exam_id."' AND ";
		$sql .= " tt.testgrp_id=".$grpid." AND ";
		$sql .= " 1=1";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}



	public function getNL2PdfScore($where,$ty=""){

		$table = "nl2_member";
		$table2 = "nl2_score";
		if($ty == 61){
			$table = "nl3_member";
			$table2 = "nl3_score";
		}
		$grpid   = $where[ 'testgrp_id'  ];
		$exam_id = $where[ 'exam_id'     ];
		$pid     = $where[ 'partner_id'  ];
		$cid     = $where[ 'customer_id' ];

		$sql = "";
		$sql = "SELECT ";
		$sql .= " ns.score1 ";
		$sql .= " ,ns.score2 ";
		$sql .= " ,ns.score3 ";
		$sql .= " ,ns.score4 ";
		$sql .= " ,ns.score5 ";
		$sql .= " ,ns.score6 ";
		$sql .= " ,ns.score7 ";
		$sql .= " ,ns.score8 ";
		$sql .= " ,ns.score9 ";
		$sql .= " ,ns.score10 ";
		$sql .= " ,ns.score11 ";
		$sql .= " ,ns.score12 ";
		$sql .= " ,ns.score13 ";
		$sql .= " ,ns.score14 ";
		$sql .= " ,ns.score15 ";
		$sql .= " ,ns.score16 ";
		$sql .= " ,ns.score17 ";
		$sql .= " ,ns.score18 ";
		$sql .= " ,ns.score19 ";

		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " INNER JOIN (SELECT id,test_id,testgrp_id,exam_id FROM ".$table.") as nm ON tt.test_id = nm.test_id AND tt.testgrp_id=nm.testgrp_id AND tt.exam_id=nm.exam_id ";
		$sql .= " INNER JOIN (SELECT * FROM ".$table2.") as ns ON ns.mv_id=nm.id ";

		$sql .= " WHERE ";
		$sql .= " tt.partner_id=".$pid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.exam_id='".$exam_id."' AND ";
		$sql .= " tt.testgrp_id=".$grpid." AND ";
		$sql .= " 1=1";

		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $w = $stmt->fetch(PDO::FETCH_ASSOC);
		return $w;
		
/*
		$testgrp_id = $where[ 'testgrp_id' ];
		$exam_id    = $where[ 'exam_id'    ];
		$test_id    = $where[ 'test_id'    ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " nl2s.score1 ";
		$sql .= " ,nl2s.score2 ";
		$sql .= " ,nl2s.score3 ";
		$sql .= " ,nl2s.score4 ";
		$sql .= " ,nl2s.score5 ";
		$sql .= " ,nl2s.score6 ";
		$sql .= " ,nl2s.score7 ";
		$sql .= " ,nl2s.score8 ";
		$sql .= " ,nl2s.score9 ";
		$sql .= " ,nl2s.score10 ";
		$sql .= " ,nl2s.score11 ";
		$sql .= " ,nl2s.score12 ";
		$sql .= " ,nl2s.score13 ";
		$sql .= " ,nl2s.score14 ";
		$sql .= " ,nl2s.score15 ";
		$sql .= " ,nl2s.score16 ";
		$sql .= " ,nl2s.score17 ";
		$sql .= " ,nl2s.score18 ";
		$sql .= " ,nl2s.score19 ";
		$sql .= "FROM ";
		$sql .= " nl2_member as nl2m ";
		$sql .= " LEFT JOIN nl2_score as nl2s ON nl2m.id=nl2s.mv_id ";
		$sql .= " WHERE ";
		$sql .= " nl2m.test_id=".$test_id." AND ";
		$sql .= " nl2m.exam_id='".$exam_id."' AND ";
		$sql .= " nl2m.testgrp_id=".$testgrp_id." AND ";
		$sql .= " 1=1 ";
		$r = mysql_query($sql);
		$w = mysql_fetch_assoc($r);
		return $w;
*/
	}
	public function getMMSData($where){
		$sql = "
				SELECT 
					ms.*
				FROM
					mms_member as mm
				INNER JOIN mms_score as ms ON ms.mms_id = mm.id
				WHERE
					mm.testgrp_id=".$where[ 'test_id' ]." AND
					mm.exam_id='".$where[ 'exam_id' ]."'
			";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $p = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $p;
	}

	public function setPdfLog($set){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$set[ 'partner_id' ];
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $p = $stmt->fetch(PDO::FETCH_ASSOC);
                
                
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name ";
		$sql .= " FROM ";
		$sql .= " t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$set[ 'customer_id' ];
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $c = $stmt->fetch(PDO::FETCH_ASSOC);
                
		$now = sprintf("%04d-%02d-%02d %02d:%02d:%02d"
							,date('Y'),date('m'),date('d')
							,date('H'),date('i'),date('s')
							
							);
		$sql = "";
		$sql = "INSERT INTO log_pdf ";
		$sql .= "(";
		$sql .= "partner_id,";
		$sql .= "partner_name,";
		$sql .= "customer_id,";
		$sql .= "customer_name,";
		$sql .= "test_id,";
		$sql .= "test_name,";
		$sql .= "exam_id,";
		$sql .= "exam_name,";
		$sql .= "pdf_type,";
		$sql .= "output_auth,";
		$sql .= "output_time,";
		$sql .= "ip";
		$sql .= ")VALUES(";
		$sql .= "'".$set[ 'partner_id' ]."',";
		$sql .= "'".$p[ 'name' ]."',";
		$sql .= "'".$set[ 'customer_id' ]."',";
		$sql .= "'".$c[ 'name' ]."',";
		$sql .= "'".$set[ 'test_id' ]."',";
		$sql .= "'".mb_convert_encoding($set[ 'test_name' ],'UTF-8','SJIS')."',";
		$sql .= "'".$set[ 'exam_id' ]."',";
		$sql .= "'".mb_convert_encoding($set[ 'exam_name' ],'UTF-8','SJIS')."',";
		$sql .= "'".$set[ 'pdf_type' ]."',";
		$sql .= "'".$set[ 'pdf_auth' ]."',";
		$sql .= "'".$now."',";
		$sql .= "'".$set[ 'ip' ]."'";
		$sql .= ")";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
	}


	function getMetLevel($point){
		if($point >= 65 ){
			$lv = 5;
		}elseif($point >= 55){
			$lv = 4;
		}elseif($point >= 45){
			$lv = 3;
		}elseif($point >= 35){
			$lv = 2;
		}else{
			$lv = 1;
		}
		return $lv;
	}
	public function getIqScore($where){
		$sql = "
				SELECT
					iqs.*
				FROM
					iq_member as iqm
				LEFT JOIN iq_score as iqs ON iqs.iq_id = iqm.id
				WHERE
					iqm.testgrp_id=".$where[ 'testgrp_id' ]."
					AND iqm.exam_id = '".$where[ 'exam_id' ]."'
			";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
		
	}
	public function getBsa($where){
		$sql = "
				SELECT 
					*
				FROM
					bsa_member as b
					LEFT JOIN bsa_score as bs ON bs.mv_id = b.id
				WHERE
					b.testgrp_id = ".$where[ 'testgrp_id' ]."
					AND b.exam_id = '".$where[ 'exam_id' ]."'
				";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $rlt;
	}
	
	public function getTestLine($where,$a_test_type){
		$sql = "
			SELECT 
				*
			FROM
				t_test as t
			WHERE
				t.test_id = ".$where[ 'testgrp_id' ]."
			";
	
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$list = [];
		$no=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[$no] = $rlt;
			$list[$no]['testname'] = $a_test_type[$rlt['type']];
			$no++;
		}
                
		return $list;
	}
}
?>
