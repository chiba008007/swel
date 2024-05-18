<?PHP
//----------------------------------
//テスト結果一覧管理画面メソッド
//
//
//----------------------------------
class dataListMethod extends method{
	
	public function getParentTest($where){
		$id = $where[ 'id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " pdf_slice,pdfdownload ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                
		return $row;
	}
	
	public function getTestlistCount($where){
		$cid        = $where[ 'cid'        ];
		$pid        = $where[ 'pid'        ];
		$testgrp_id = $where[ 'testgrp_id' ];
		$from       = preg_replace("/\//","",$where[ 'from'       ]);
		$to         = preg_replace("/\//","",$where[ 'to'         ]);
                $exam_state = $where[ 'exam_state' ];
                if($where[ 'exam_id' ]){
			$exam_id = $where[ 'exam_id' ];
		}
		if($where[ 'name' ]){
			$name = $where[ 'name' ];
		}
		if($where[ 'kana' ]){
			$kana = $where[ 'kana' ];
		}
		if($where[ 'pass' ]){
			$pass = $where[ 'pass' ];
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.*";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " WHERE ";
		if($exam_id){
			$sql .= " tt.exam_id LIKE '%".$exam_id."%' AND ";
		}
                if($exam_state == 2){
			$sql .= "tt.complete_flg = 1 AND ";
		}
		if($name){
			$sql .= " tt.name LIKE '%".$name."%' AND ";
		}
		if($kana){
			$sql .= " tt.kana LIKE '%".$kana."%' AND ";
		}
		if($pass){
			$sql .= " tt.pass LIKE '%".$pass."%' AND ";
		}
		if($pid){
			$sql .= " tt.partner_id=".$pid." AND ";
		}
                if($from){
			$sql .= "REPLACE(tt.exam_date,'/','') >='".$from."' AND ";
		}
		if($to){
			$sql .= "REPLACE(tt.exam_date,'/','') <='".$to."' AND ";
		}
                if($exam_state == 1){
			$sql .= " tt.exam_state = 1 AND tt.complete_flg = 0  AND ";
		}
		if($exam_state == 0 && strlen($exam_state)){
			$sql .= " tt.exam_state = 0 AND tt.complete_flg = 0  AND ";
		}
                
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.testgrp_id=".$testgrp_id." AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY tt.number ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                return $row;
                
	}
	
	public function getTestwhere($where){
                    $cid        = $where[ 'cid'        ];
                    $pid        = $where[ 'pid'        ];
                    $testgrp_id = $where[ 'testgrp_id' ];
                    $limit      = $where[ 'limit'      ];
                    $offset     = $where[ 'offset'     ];
                    $exam_state = $where[ 'exam_state' ];
                    $from       = preg_replace("/\//","",$where[ 'from'       ]);
                    $to         = preg_replace("/\//","",$where[ 'to'         ]);

                    $sql = "";
                    $sql = "SELECT ";
                    $sql .= " tt.exam_id ";
                    $sql .= ",MAX(tt.exam_state) as max ";
                    $sql .= ",tt.complete_flg ";
                    $sql .= " FROM ";
                    $sql .= " t_testpaper as tt  ";
                    $sql .= " WHERE ";
                    if($pid){
                            $sql .= " tt.partner_id=".$pid." AND ";
                    }
                    $sql .= " tt.customer_id=".$cid." AND ";
                    $sql .= " tt.testgrp_id=".$testgrp_id." AND ";
                    if($exam_state == 2){
                            $sql .= "tt.complete_flg = 1 AND ";
                    }
                    if($from){
                            $sql .= "REPLACE(tt.exam_date,'/','') >='".$from."' AND ";
                    }
                    if($to){
                            $sql .= "REPLACE(tt.exam_date,'/','') <='".$to."' AND ";
                    }

                    if($exam_state == 1){
                            $sql .= " tt.exam_state = 1 AND tt.complete_flg = 0  AND ";
                    }
                    if($exam_state == 0 && strlen($exam_state)){
                            $sql .= " tt.exam_state = 0 AND tt.complete_flg = 0  AND ";
                    }

                    $sql .= " 1=1 ";
                    $sql .= " GROUP BY tt.number ";
                    $sql .= " ORDER BY tt.number ASC ";
                    if($limit){
                            $sql .= " limit ".$limit." OFFSET ".$offset;
                    }
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    $i=0;
                    $line = [];
                    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                         $line[$i] = $result[ 'exam_id' ];
                         $i++;
                    }
                    $lines = "";
                    if(count($line) > 0 ){
                        $lines = implode("','",$line);
                    }	
                    return $lines;
		
	}
	
	public function getTestlist($where,$lines){

		$cid        = $where[ 'cid'        ];
		$pid        = $where[ 'pid'        ];
		$testgrp_id = $where[ 'testgrp_id' ];
		$limit      = $where[ 'limit'      ];
		$offset     = $where[ 'offset'     ];

		if($where[ 'exam_id' ]){
			$exam_id = $where[ 'exam_id' ];
		}
		if($where[ 'name' ]){
			$name = $where[ 'name' ];
		}
		if($where[ 'kana' ]){
			$kana = $where[ 'kana' ];
		}
		if($where[ 'pass' ]){
			$pass = $where[ 'pass' ];
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= " tt.id,";
		$sql .= " tt.number, ";
		$sql .= " tt.test_id, ";
		$sql .= " tt.exam_id, ";
		$sql .= " tt.type, ";
		$sql .= " tt.name, ";
		$sql .= " tt.kana, ";
		$sql .= " tt.birth, ";
		$sql .= " tt.pass, ";
		$sql .= " tt.kana, ";
		$sql .= " tt.exam_state, ";
		$sql .= " tt.complete_flg, ";
		$sql .= " tt.start_time, ";
		$sql .= " tt.middle_time_status, ";
		$sql .= " tt.memo1, ";
		$sql .= " tt.memo2, ";
		$sql .= " tt.dev1, ";
		$sql .= " tt.dev2, ";
		$sql .= " tt.dev3, ";
		$sql .= " tt.dev6, ";
		$sql .= " tt.level,";
		$sql .= " tt.tensaku_status,";
		$sql .= " tt.tensaku_name,";
		$sql .= " tt.tensaku_mail,";
		$sql .= " tt.mail,";

		$sql .= " CASE ";
		$sql .= " WHEN tt.fin_exam_date != '0000-00-00 00:00:00' THEN tt.fin_exam_date ";
		$sql .= " ELSE ";
		$sql .= " tt.exam_date ";
		$sql .= " END as exam_dates,";
		$sql .= " t.stress_flg,";
		$sql .= " (SELECT pdfdownload FROM t_test WHERE id=".$testgrp_id." AND type=0 ) as pdf";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		if($pid){
			$sql .= " INNER JOIN (SELECT test_id,customer_id,partner_id ,stress_flg FROM t_test ) as t ON tt.testgrp_id = t.test_id AND t.customer_id=".$cid." AND t.partner_id=".$pid;
		}else{
			$sql .= " INNER JOIN (SELECT test_id,customer_id,partner_id ,stress_flg FROM t_test ) as t ON tt.testgrp_id = t.test_id AND t.customer_id=".$cid;
		}
		$sql .= " WHERE ";
		if($exam_id){
			$sql .= " tt.exam_id LIKE '%".$exam_id."%' AND ";
		}
		if($name){
			$sql .= " tt.name LIKE '%".$name."%' AND ";
		}
		if($kana){
			$sql .= " tt.kana LIKE '%".$kana."%' AND ";
		}
		if($pass){
			$sql .= " tt.pass LIKE '%".$pass."%' AND ";
		}
		if($pid){
			$sql .= " tt.partner_id=".$pid." AND ";
		}
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " tt.testgrp_id=".$testgrp_id." AND ";
		$sql .= " tt.exam_id IN ('".$lines."') AND ";
		$sql .= " 1=1 ";
		$sql .= " ORDER BY tt.number ASC,tt.type ASC  ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			if($result[ 'birth' ]){
				$rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
			}else{
				$rlt[$i][ 'age' ] = "";
			}
			//日付フォーマットの設定
			if(preg_match("/\-/",$result[ 'exam_dates' ])){
				$ex = preg_replace("/-/","/",$result[ 'exam_dates' ]);
				$rlt[ $i ][ 'exam_dates' ] = substr($ex,0,11);
			}
			$i++;
		}
		return $rlt;
	}
	
	public function get_age($birth){
	  $ty = date("Y");
	  $tm = date("m");
	  $td = date("d");
	  list($by, $bm, $bd) = explode('/', $birth);
	  $age = $ty - $by;
	  if($tm * 100 + $td < $bm * 100 + $bd) $age--;
	  return $age;
	}
	
	//受検テスト形取得
	public function getTestTypes($where){
		$cid        = $where[ 'cid'     ];
		$pid        = $where[ 'pid'     ];
		$test_id    = $where[ 'test_id' ];
		
		$sql = "";
		$sql = "SELECT type,name,weight,rowflg FROM t_test ";
		$sql .= " WHERE ";
		if($pid){
			$sql .= " partner_id=".$pid." AND ";
		}
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " test_id=".$test_id." AND ";
		$sql .= " 1=1 ";
		$sql .= " ORDER BY type ,weight";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                     $rlt[$i] = $result;
                     $i++;
                }
                
		return $rlt;
	}
	//テスト数
	public function getTestCount($testgrp_id){
		$sql = "";
		$sql = "SELECT id FROM t_test";
		$sql .= " WHERE ";
		$sql .= " test_id = ".$testgrp_id;
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                
		return $row;
	}
	
	//colspanの取得
	public function getColspan($type,$weight){
		switch($type){
			case "1";
                            $cols = 2;
                            //重みが0の時は1をたす
                            if($weight == "0"){
                                    $cols += 1;
                            }
			break;
			case "2";
				$cols = 2;
			//重みが0の時は1をたす
			if($weight == "0"){
				$cols += 1;
			}
			break;
			case "12";
			case "54";
				$cols = 2;
			//重みが0の時は1をたす
			if($weight == "0"){
				$cols += 1;
			}
			break;
			case "41";
				$cols = 2;
			//重みが0の時は1をたす
			if($weight == "0"){
				$cols += 1;
			}
			break;
			case "44";
				$cols = 4;
			break;
			default:
				$cols = 1;
			break;
		}

		return $cols;
	}


	//ストレスデータ取得
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


	//ストレスデータ取得
	public function getStress2($dev1, $dev2,$dev3) {

		$dev1 = sprintf("%s",($dev1 >= 70 )?60:$dev1);
		$dev2 = sprintf("%s",($dev2 >= 70 )?60:$dev2);
		$dev3 = sprintf("%s",($dev3 >= 70 )?60:$dev3);

		$dev1 = sprintf("%s",($dev1 <= 35.21  )?20:$dev1);
		$dev2 = sprintf("%s",($dev2 <= 35.21  )?20:$dev2);
		$dev3 = sprintf("%s",($dev3 <= 35.21  )?20:$dev3);
		
		//ポジティブ思考力スコア反転
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
	
	//テストデータ削除
	public function deleteTestpaper($delline,$testid){
		$sql = "";
		$sql = "DELETE FROM t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testid." AND ";
		$sql .= " exam_id IN ('".$delline."')";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		
	}
	//テスト数変更
	public function editTestCount($mainasu,$mainasutotal,$testid){
		$sql = "";
		$sql = "UPDATE t_test SET ";
		$sql .= " number = number-".$mainasutotal;
		$sql .= " WHERE ";
		$sql .= " id=".$testid;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();

		$sql = "";
		$sql .= "UPDATE t_test SET ";
		$sql .= " number = number-".$mainasu;
		$sql .= " WHERE ";
		$sql .= " test_id=".$testid;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
	}
	
	public function editRowFlg($where,$edit){
		$id = $where[ 'id' ];
		$rowflg = $edit[ 'rowflg' ];
		
		$sql = "";
		$sql = "UPDATE t_test SET ";
		$sql .= " rowflg=".$rowflg;
		$sql .= " WHERE ";
		$sql .= " id=".$id." OR ";
		$sql .= " test_id=".$id;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
	}
	
	//数学検定受検済み確認
	public function getMathRow($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_id ";
		$sql .= " FROM ";
		$sql .= " math_member ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $rlt[ 'exam_id' ]] = $rlt[ 'exam_id' ];
		}
		return $list;
	}
	//数学検定受検済み確認
	public function getMath2Row($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_id ";
		$sql .= " FROM ";
		$sql .= " math2_member ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $rlt[ 'exam_id' ]] = $rlt[ 'exam_id' ];
		}
		return $list;
	}

	//IQ検定受検済み確認
	public function getIQRow($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_id ";
		$sql .= " FROM ";
		$sql .= " iq_member ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $rlt[ 'exam_id' ]] = $rlt[ 'exam_id' ];
		}
		return $list;
	}
	public function getIQCount($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_id
				,s.*
			 ";
		$sql .= " FROM ";
		$sql .= " iq_member as m 
				LEFT JOIN iq_sec as s ON s.iq_id = m.id
				";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id."
				GROUP BY exam_id
				";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $rlt[ 'exam_id' ]][ 'exam_id' ] = $rlt[ 'exam_id' ];
			$cnt = 0;
			for($i=1;$i<=56;$i++){
				$ks = "ans".$i;
				if($rlt[ $ks ] > 0 ) $cnt++;
			}
			$exid = lcfirst($rlt[ 'exam_id' ]);
			$list[$exid][ 'cnt'     ] = $cnt;
		}
		return $list;
	}
	public function getMathCount($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_id
				,s.*
			 ";
		$sql .= " FROM ";
		$sql .= " math_member as m 
				LEFT JOIN math_sec as s ON s.math_id = m.id
				";
		$sql .= " WHERE ";
		$sql .= " m.testgrp_id=".$testgrp_id."
				GROUP BY m.exam_id
				";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $rlt[ 'exam_id' ]][ 'exam_id' ] = $rlt[ 'exam_id' ];
			$cnt = 0;
			for($i=1;$i<=30;$i++){
				$ks = "ans".$i;
				if($rlt[ $ks ] > 0 ) $cnt++;
			}
			$list[ $rlt[ 'exam_id' ]][ 'cnt'     ] = $cnt;
		}
		return $list;
	}



	//テストデータＩＤ test_id testgrp_id取得
	public function getTestPaper($id){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_id,test_id,testgrp_id,type ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " id=".$id;
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		
		return $rlt;
	}
	//添削状況取得
	public function getTensakuSts($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		$sql = "
				SELECT 
					cm.exam_id
					,cm.tensaku_flg
					,cm.tensaku_number
					,count(cr.id) as cnt
				FROM
					crt_member as cm
					LEFT JOIN crt_result as cr ON cr.crt_id = cm.id
				WHERE
					cm.testgrp_id=".$testgrp_id."
				GROUP BY cm.exam_id
				";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $rlt[ 'exam_id' ] ][ 'tensaku_flg' ] = $rlt[ 'tensaku_flg' ];
			$list[ $rlt[ 'exam_id' ] ][ 'tensaku_number' ] = $rlt[ 'tensaku_number' ];
			$list[ $rlt[ 'exam_id' ] ][ 'tensaku_count' ] = $rlt[ 'cnt' ];
		}
		return $list;
	}
	
	public function getTensakuStsEd($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		$sql = "
				SELECT 
					cm.exam_id
					,SUM(CASE WHEN finFlg = '1' THEN 1 ELSE 0 END ) as oneCnt
					,SUM(CASE WHEN finFlg2 = '1' THEN 1 ELSE 0 END ) as twoCnt
					,SUM(CASE WHEN finFlg3 = '1' THEN 1 ELSE 0 END ) as threeCnt
					,SUM(CASE WHEN finFlg4 = '1' THEN 1 ELSE 0 END ) as fourCnt
				FROM
					crt_member as cm
					LEFT JOIN crt_result as cr ON cr.crt_id = cm.id
				WHERE
					cm.testgrp_id=".$testgrp_id."
				GROUP BY cm.exam_id
					
				";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $rlt[ 'exam_id' ] ][ 'tensaku_sumi1' ] = $rlt[ 'oneCnt' ];
			$list[ $rlt[ 'exam_id' ] ][ 'tensaku_sumi2' ] = $rlt[ 'twoCnt' ];
			$list[ $rlt[ 'exam_id' ] ][ 'tensaku_sumi3' ] = $rlt[ 'threeCnt' ];
			$list[ $rlt[ 'exam_id' ] ][ 'tensaku_sumi4' ] = $rlt[ 'fourCnt' ];
		}
		return $list;
	}
        public function getTestData($where){
            $test_id = $where[ 'test_id' ];
            $sql = "SELECT "
                    . " graph_status "
                    . "FROM "
                    . "t_test"
                    . " WHERE "
                    . " test_id = ".$test_id;
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
            return $rlt;
            
        }
}
?>
