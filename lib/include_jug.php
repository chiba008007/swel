<?PHP
class jug extends method{
	public function getRegCount($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		$sql = "
				SELECT
					*
				FROM
					t_testpaper
				WHERE
					testgrp_id = ".$testgrp_id."
			";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->rowCount();

		return $rlt;
	}


	public function setData($data,$where){
	    //テストIDの取得
	    $sql = "SELECT id FROM t_test WHERE test_id=".$where[ 'testgrp_id' ];

	    $stmt = $this->db->prepare($sql);
	    $stmt->execute();
	    $rlt = $stmt->fetch(PDO::FETCH_ASSOC);

	    //連番がt_testpaperで利用されているか確認
	    $i=0;
	    foreach($data as $key=>$val){
	        if($i > 0 && $val[0]){
	            $rlt2 = array();
	            $sql = "SELECT id FROM t_testpaper WHERE testgrp_id=".$where[ 'testgrp_id' ]." AND number =".$val[0];

	            $stmt = $this->db->prepare($sql);
	            $stmt->execute();
	            $rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);
	            if(!$rlt2[ 'id' ]){
	                $iderr += 1;
	            }
	        }
	        $i++;
	    }
	    if($iderr) return 4;


	    //社員番号の重複確認
	    //今登録している連番・社員番号をすべて取得
	    $sql = "
					SELECT GROUP_CONCAT(num separator ',' ) as sepnum,GROUP_CONCAT(empnum separator ',' ) as emp
					FROM jug_member
					WHERE
						testgrp_id=".$where[ 'testgrp_id' ]." AND test_id=".$rlt[ 'id' ]."

				";

	    $stmt = $this->db->prepare($sql);
	    $stmt->execute();
	    $emp = $stmt->fetch(PDO::FETCH_ASSOC);
	    $ex = explode(",",$emp[ 'emp' ]);
	    $sepnum = explode(",",$emp[ 'sepnum' ]);

	    $i=0;
	    if($emp[ 'emp' ]){

	        foreach($data as $key=>$val){
	            if($i > 0 ){
	                //社員番号
	                $errflg = in_array($val[ '4' ],$ex);
	                if($errflg) $err += 1;
	                //連番
	                $errflg2 = in_array($val[ '0' ],$sepnum);
	                if($errflg2) $err2 += 1;
	            }
	            $i++;
	        }
	        if($err2) return "2";
	        if($err) return "1";
	    }

	    $sql = "BEGIN";

	    $stmt = $this->db->prepare($sql);
	    $stmt->execute();
	    $sql = "";
	    try{
	        $i=0;
	        //データの整理
	        //連番社員番号がないデータは登録しない
	        foreach($data as $key=>$val){
	            if($val[0] && $val[4]){
	                if($key > 0){
	                    $ins .= ",(
								'".$rlt[ 'id' ]."'
								,'".$where[ 'testgrp_id' ]."'
								,'".$val[0]."'
								,'".$val[1]."'
								,'".$val[2]."'
								,'".$val[3]."'
								,'".$val[4]."'
								,'".$val[5]."'
								,'".$val[6]."'
								,'".$val[7]."'
								,'".$val[8]."'
								,'".$val[9]."'
								,''
								,NOW()
								)";
	                    //上司と部下の関係性の登録
	                    $ex = array();
	                    $ex = explode(",",$val[11]);
	                    $aboss[$val[4]] = $ex;
	                    $i++;
	                }
	            }
	        }
	        $str = preg_replace("/^,/","",$ins);
	        $sql = sprintf("
					INSERT INTO jug_member (
						test_id
						,testgrp_id
						,num
						,bossflg
						,busyo
						,yakusyoku
						,empnum
						,sei
						,mei
						,sei_kana
						,mei_kana
						,mail
						,empnum_rep
						,regist_ts
					)VALUES %s
				",$str);

	        $stmt = $this->db->prepare($sql);
	        $stmt->execute();

	        if(count($aboss)){
	            $str = "";
	            foreach($aboss as $key=>$val){
	                $key = preg_replace("/^\'/","",$key);
	                foreach($val as $k=>$v){
	                    $v = preg_replace("/^\'/","",$v);

	                    if($v){
	                        $str .= ",(".$rlt[ 'id' ]."
								,".$where[ 'testgrp_id' ]."
								,(SELECT id FROM jug_member WHERE empnum='".$key."' AND test_id=".$rlt[ 'id' ]." AND testgrp_id=".$where[ 'testgrp_id' ].")
								,(SELECT id FROM jug_member WHERE empnum='".$v."' AND test_id=".$rlt[ 'id' ]." AND testgrp_id=".$where[ 'testgrp_id' ].")
								,NOW()
								)";
	                    }
	                }
	            }
	        }
	        $str = preg_replace("/^,/","",$str);
	        $sql = sprintf("
				INSERT INTO jug_boss (
					test_id
					,testgrp_id
					,jmid
					,bossid
					,regist_ts
				)VALUES %s
				",$str);

	        $stmt = $this->db->prepare($sql);
	        $stmt->execute();
	        $sql = "COMMIT";
	        $stmt = $this->db->prepare($sql);
	        $stmt->execute();

	        //t_testpaperに登録
	        foreach($data as $key=>$val){
	            $ex = array();
	            $ex = explode("/",$val[10]);
	            $birth = sprintf("%04d/%02d/%02d",$ex[0],$ex[1],$ex[2]);
	            $sql = "
					UPDATE t_testpaper SET
						birth= '".$birth."'
					WHERE
						testgrp_id = '".$where[ 'testgrp_id' ]."'
						AND number = '".$val[0]."'
				";
	            $stmt = $this->db->prepare($sql);
	            $stmt->execute();
	        }
	    }catch(Exception $e){
	        $sql = "ROLLBACK";
	        $stmt = $this->db->prepare($sql);
	        $stmt->execute();
	    }
	    if(!$rflg && $rflg === false){
	        return 3;
	    }

	}

	public function setData2($data,$where){
		//テストIDの取得
		$sql = "SELECT id FROM t_test WHERE test_id=".$where[ 'testgrp_id' ];

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);

                /*
		//連番がt_testpaperで利用されているか確認
		$i=0;
		foreach($data as $key=>$val){
			if($i > 0 && $val[0]){
				$rlt2 = array();
				$sql = "SELECT id FROM t_testpaper WHERE testgrp_id=".$where[ 'testgrp_id' ]." AND number =".$val[0];
                                $stmt = $this->db->prepare($sql);
                                $stmt->execute();
                                $rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);
				if(!$rlt2[ 'id' ]){
					$iderr += 1;
				}
			}
			$i++;
		}
		if($iderr) return 4;
*/

		//社員番号の重複確認
		//今登録している連番・社員番号をすべて取得
		$sql = "
					SELECT GROUP_CONCAT(num separator ',' ) as sepnum,GROUP_CONCAT(empnum separator ',' ) as emp
					FROM jug_member
					WHERE
						testgrp_id=".$where[ 'testgrp_id' ]." AND test_id=".$rlt[ 'id' ]."

				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $emp = $stmt->fetch(PDO::FETCH_ASSOC);

		$ex = explode(",",$emp[ 'emp' ]);
		$sepnum = explode(",",$emp[ 'sepnum' ]);

		$i=0;
		if($emp[ 'emp' ]){

			foreach($data as $key=>$val){
				if($i > 0 ){
					//社員番号
					$errflg = in_array($val[ '4' ],$ex);
					if($errflg) $err += 1;
					//連番
					$errflg2 = in_array($val[ '0' ],$sepnum);
					if($errflg2) $err2 += 1;
				}
				$i++;
			}
			if($err2) return "2";
			if($err) return "1";
		}

		$sql = "BEGIN";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$sql = "";
		try{
			$i=0;
			//データの整理
			//連番社員番号がないデータは登録しない
			foreach($data as $key=>$val){
				if($val[0] && $val[4]){
					if($key > 0){
						$ins .= ",(
								'".$rlt[ 'id' ]."'
								,'".$where[ 'testgrp_id' ]."'
								,'".$val[0]."'
                                ,'0'
								,'".$val[1]."'
								,'".$val[2]."'
								,'".$val[3]."'
								,'".$val[4]."'
								,'".$val[5]."'
								,'".$val[6]."'
								,'".$val[7]."'
								,'".$val[8]."'
								,''
								,NOW()
								)";
							//上司と部下の関係性の登録
							$ex = array();
							$ex = explode(",",$val[10]);
							$aboss[$val[3]] = $ex;
							$i++;
					}
				}
			}
			$str = preg_replace("/^,/","",$ins);
			$sql = sprintf("
					INSERT INTO jug_member (
						test_id
						,testgrp_id
						,num
						,bossflg
						,busyo
						,yakusyoku
						,empnum
						,sei
						,mei
						,sei_kana
						,mei_kana
						,mail
						,empnum_rep
						,regist_ts
					)VALUES %s
				",$str);

                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();

			if(count($aboss)){
				$str = "";
				foreach($aboss as $key=>$val){
					$key = preg_replace("/^\'/","",$key);
					foreach($val as $k=>$v){
						$v = preg_replace("/^\'/","",$v);

						if($v){
							$str .= ",(".$rlt[ 'id' ]."
								,".$where[ 'testgrp_id' ]."
								,(SELECT id FROM jug_member WHERE empnum='".$key."' AND test_id=".$rlt[ 'id' ]." AND testgrp_id=".$where[ 'testgrp_id' ].")
								,(SELECT id FROM jug_member WHERE empnum='".$v."' AND test_id=".$rlt[ 'id' ]." AND testgrp_id=".$where[ 'testgrp_id' ].")
								,NOW()
								)";
						}
					}
				}
			}
			$str = preg_replace("/^,/","",$str);
			$sql = sprintf("
				INSERT INTO jug_boss (
					test_id
					,testgrp_id
					,jmid
					,bossid
					,regist_ts
				)VALUES %s
				",$str);

                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
			$sql = "COMMIT";
			$stmt = $this->db->prepare($sql);
                        $stmt->execute();

			//t_testpaperに登録
			foreach($data as $key=>$val){
				$ex = array();
				$ex = explode("/",$val[9]);
				$birth = sprintf("%04d/%02d/%02d",$ex[0],$ex[1],$ex[2]);
				$sql = "
					UPDATE t_testpaper SET
						birth= '".$birth."'
					WHERE
						testgrp_id = '".$where[ 'testgrp_id' ]."'
						AND number = '".$val[0]."'
				";
				$stmt = $this->db->prepare($sql);
                                $stmt->execute();
			}
		}catch(Exception $e){
			$sql = "ROLLBACK";
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
		}
		if(!$rflg && $rflg === false){
			return 3;
		}

	}

	public function getJug($where,$flg=""){
		$sql = "
				SELECT
					j.*
					,group_concat(jb.bossid separator ',') as bossids
					,CASE j.bossflg
						WHEN '1' THEN '○'
						ELSE '　' END as boss
					,t.birth
					,t.sex
					,t.pass
					,t.memo1
					,t.memo2

				FROM
					jug_member as j
					LEFT JOIN jug_boss as jb ON j.id = jb.jmid
					LEFT JOIN t_testpaper as t ON t.testgrp_id = j.testgrp_id AND t.number = j.num AND t.type IN (52,60,62,67,68,86,87,89,90)
				WHERE
					j.testgrp_id = '".$where[ 'testgrp_id' ]."'
					AND t.testgrp_id = '".$where[ 'testgrp_id' ]."'
				";
		if($where[ 'id' ]){
			$sql .= " AND j.id=".$where[ 'id' ];
		}

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		if($flg){
                    $row = $stmt->rowCount();
                    return $row;
		}
		$sql .= " GROUP BY j.id ORDER BY j.id ";
		$sql .= "limit ".$where[ 'offset' ].",".$where[ 'limit' ];

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[$i] = $rlt;
			$i++;
		}
		//上司のデータ取得
		if($where[ 'id' ] && $list[0][ 'bossids' ]){
			$sql = "
					SELECT
						group_concat(CONCAT(sei,mei) separator '<br />') as names
					FROM
						jug_member
					WHERE
						id IN (".$list[0][ 'bossids' ].")
				";

                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                        $rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);


			$list[ 'bs_list' ] = $rlt2;
			$i++;

		}
		return $list;
	}

	public function getBoss($where){
		$sql = "
				SELECT
					j.*
					,t.birth
					,t.pass
					,t.memo1
					,t.memo2
				FROM
					jug_member as j
					INNER JOIN t_testpaper as t ON t.number = j.num AND t.testgrp_id = j.testgrp_id
				WHERE
					j.bossflg = 1
					AND j.testgrp_id = ".$where[ 'testgrp_id' ]."
				";
		if($where[ 'id' ]){
			$sql .= "
					AND j.id != ".$where[ 'id' ]."
				";
		}

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[] = $rlt;
		}
		return $list;
	}
	public function delete($where){
		$sql = "
				DELETE FROM
					jug_member
				WHERE
					id=".$where[ 'id' ]."
					AND testgrp_id = ".$where[ 'testgrp_id' ]."
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
	}

	public function getBossChk($where){
		$sql = "
				SELECT
					jmid
				FROM
					jug_boss
				WHERE
					test_id = (SELECT id FROM t_test WHERE test_id = '".$where[ 'testgrp_id' ]."' )
					AND testgrp_id = '".$where[ 'testgrp_id' ]."'
					AND bossid = '".$where[ 'bossid' ]."'
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[$rlt[ 'jmid' ]] = $rlt;
			$i++;
		}
		return $list;
	}
	public function setBoss($where){
		$sql = "SELECT
					id
				FROM
					jug_boss
				WHERE
					test_id = (SELECT id FROM t_test WHERE test_id = '".$where[ 'testgrp_id' ]."' )
					AND testgrp_id = '".$where[ 'testgrp_id' ]."'
					AND jmid = '".$where[ 'jmid' ]."'
					AND bossid = '".$where[ 'bossid' ]."'
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		//データがあるときは削除
		if($row){
			$sql = "DELETE FROM jug_boss
					WHERE
					test_id = (SELECT id FROM t_test WHERE test_id = '".$where[ 'testgrp_id' ]."' )
					AND testgrp_id = '".$where[ 'testgrp_id' ]."'
					AND jmid = '".$where[ 'jmid' ]."'
					AND bossid = '".$where[ 'bossid' ]."'
				";
		}else{
			$sql = "INSERT INTO jug_boss
					(
						test_id
						,testgrp_id
						,jmid
						,bossid
						,regist_ts
					)
					VALUES
					(
						(SELECT id FROM t_test WHERE test_id = '".$where[ 'testgrp_id' ]."' )
						,'".$where[ 'testgrp_id' ]."'
						,'".$where[ 'jmid' ]."'
						,'".$where[ 'bossid' ]."'
						,NOW()
					)";
		}


                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		return true;
	}

	public function getLists($where,$flg=""){
		$sql = "
				SELECT
					a.*
					,CASE t.sex WHEN 1 THEN '男性' WHEN 2 THEN '女性' ELSE '' END as sex
					,CASE WHEN t.pass IS NULL THEN  ''  ELSE t.pass END as pass
					,CASE WHEN t.memo1 IS NULL THEN  ''  ELSE t.memo1 END as memo1
					,CASE WHEN t.memo2 IS NULL THEN  ''  ELSE t.memo2 END as memo2
					,t.exam_state
					,t.exam_date
					,t.birth

				FROM (
				SELECT
					j.*
				FROM
					jug_boss as jb
					RIGHT JOIN jug_member as j ON jb.jmid = j.id
				WHERE
					j.testgrp_id = '".$where[ 'testgrp_id' ]."'
				";
		if($where[ 'bossid' ]){
			$sql .= " AND jb.bossid='".$where[ 'bossid' ]."'";
		}
		$sql .= " GROUP BY j.empnum ) as a
				LEFT JOIN  t_testpaper  as t ON t.testgrp_id = a.testgrp_id AND t.number = a.num
				WHERE
					t.type IN (52,60,62,67,68,86,87,89,90)
					AND t.testgrp_id = '".$where[ 'testgrp_id' ]."'
		";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();

		if($flg){
			$row = $stmt->rowCount();
			return $row;
		}
		$sql .= "limit ".$where[ 'offset' ].",".$where[ 'limit' ];


                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($rlt =  $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[$i] = $rlt;
			if($rlt[ 'birth' ]){
				$list[$i][ 'age' ] = $this->get_age($rlt[ 'birth' ]);
			}else{
				$list[$i][ 'age' ] = "";
				$list[$i][ 'birth' ] = "";
			}
			$i++;
		}
		return $list;
	}
	public function editTestPaperData($where){
		$sql = "
				SELECT
					*
				FROM
					 jug_member
				WHERE
					id = '".$where[ 'where' ][ 'id' ]."'
				";


                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);

		$sql = "
				UPDATE t_testpaper SET
					birth = '".$where[ 'edit' ][ 'birth' ]."'
					,sex  ='".$where[ 'edit' ][ 'sex' ]."'
					,pass = '".$where[ 'edit' ][ 'pass' ]."'
					,memo1 = '".$where[ 'edit' ][ 'memo1' ]."'
					,memo2 = '".$where[ 'edit' ][ 'memo2' ]."'
				WHERE
					testgrp_id = '".$rlt[ 'testgrp_id' ]."'
					AND number = '".$rlt[ 'num' ]."'
					AND type IN (52,60,62,67,68,86,89,90)
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();

	}

	public function setInquery($where){
		$sql = "
				SELECT
					count( id ) as cnt
					,id
				FROM
					jug_inquiry
				WHERE
					testgrp_id = '".$where[ 'testgrp_id' ]."'
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		if($rlt[ 'cnt' ] == 0){
			$sql = "
					INSERT INTO jug_inquiry
					(
						testgrp_id
						,start_date
						,end_date
						,intervalcount
						,codes
						,status
						,regist_ts
					)VALUES(
						'".$where[ 'testgrp_id' ]."'
						,'".$where[ 'start_date' ]."'
						,'".$where[ 'end_date' ]."'
						,'".$where[ 'interval' ]."'
						,'".$where[ 'codes' ]."'
						,'".$where[ 'status' ]."'
						,NOW()
					)
				";

                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
			$id = $this->db->lastInsertId('id');

		}else{
			$sql = "
					UPDATE jug_inquiry SET
						start_date = '".$where[ 'start_date' ]."'
						,end_date = '".$where[ 'end_date' ]."'
						,intervalcount = '".$where[ 'interval' ]."'
						,status = '".$where[ 'status' ]."'
					WHERE
						testgrp_id = '".$where[ 'testgrp_id' ]."'
				";

                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();

			$id = $rlt[ 'id' ];
		}

		return $id;
	}
	public function getInquery($where){
		$sql = "SELECT
					j.*
					,t.dir
				FROM
					jug_inquiry as j
					LEFT JOIN t_test as t ON j.testgrp_id = t.test_id
				WHERE
					j.testgrp_id = '".$where[ 'testgrp_id' ]."'
				";


                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
	}
	public function setinquiryText($st,$end,$rlt,$jmid,$no,$total){
		$sql = "
				INSERT INTO jug_inquiry_text
					(
					inq_id
					,jmid
					,start_date
					,end_date
					,number
					,total
					,regist_ts
					)VALUES(
						'".$rlt."'
						,'".$jmid."'
						,'".$st."'
						,'".$end."'
						,'".$no."'
						,'".$total."'
						,NOW()
					)
				";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
	}
	public function delinquiry($rlt,$key){
		if(count($key)){
			foreach($key as $k=>$v){
				$line[] = $v[ 'id' ];
			}
			if($line) $imp = implode(",",$line);
		}
		$sql = "DELETE FROM jug_inquiry_text WHERE inq_id='".$rlt."'";
		if($imp){
			$sql .= " AND jmid IN (".$imp.")";
		}


                $stmt = $this->db->prepare($sql);
                $stmt->execute();
	}

	public function getSendList(){
		$today = date("Y-m-d");
		$sql = "
				SELECT
					jm.*
					,u.name as username
					,t.name as testname
					,t.dir as dir
					,ji.codes as codes
					,jit.id as jitid
					,jit.number as sendnum
					,jit.total as sendtotal
					,jit.start_date as start_date
					,jit.end_date as end_date
					,jm.sei
					,jm.mei
					,jm.sei_kana
					,jm.mei_kana
				FROM
					jug_inquiry_text as jit
					INNER JOIN jug_inquiry as ji ON ji.id = jit.inq_id
					INNER JOIN jug_member as jm ON jm.testgrp_id = ji.testgrp_id AND jit.jmid = jm.id
					INNER JOIN t_test as t ON t.id = jm.test_id
					INNER JOIN t_user as u ON u.id = t.customer_id
				WHERE
					jit.start_date = '".$today."'
					AND ji.status = 1
					AND jm.bossflg = 1
				GROUP BY jit.jmid
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

	public function getBossId($testgrp_id){
		//既にアンケート登録済みの上司IDは取得しない
		$sql = "
				SELECT
					jit.jmid
				FROM
					jug_inquiry_text as jit
				WHERE
					jit.inq_id=(SELECT id FROM jug_inquiry WHERE testgrp_id='".$testgrp_id."')
					AND jit.status = 1
				GROUP BY jit.jmid
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		while($rlt2 = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$line[] = $rlt2[ 'jmid' ];
		}
		if($line) $imp = implode(",",$line);

		$sql = "
				SELECT
					*
				FROM
					jug_member
				WHERE
					testgrp_id = '".$testgrp_id."'
					AND bossflg = 1
					AND status = 1
				";

		if($imp){
			$sql .= " AND id NOT IN (".$imp.")";
		}
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}

	public function getAnqCount($where){
		$sql = "
				SELECT
					count(id) as count
				FROM
					jug_inquiry_text
				WHERE
					inq_id = (SELECT id FROM jug_inquiry WHERE testgrp_id = ".$where[ 'testgrp_id' ].")
					AND status = 1
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
	}
}
?>
