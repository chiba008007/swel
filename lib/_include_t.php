<?PHP
//----------------------------------
//テスト用
//
//
//----------------------------------
class tMethod extends method{
	public function getAllTest($where){
		$dir  = $where[ 'dir'  ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " t.type";
		$sql .= " FROM ";
		$sql .= " t_test as t ";
		$sql .= " WHERE ";
		$sql .= " dir='".$dir."' AND ";
		$sql .= " type > 0 AND ";
		$sql .= " ";
		$sql .= " 1=1 ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
	}
	public function getTest($where){
		$dir  = $where[ 'dir'  ];
		$type = $where[ 'type' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " t.name as testname";
		$sql .= " ,u.name,u.privacy_flg ";
		$sql .= " ,u.login_id ";
		$sql .= " ,t.fin_disp";
		$sql .= " ,t.enq_status";
		$sql .= " ,t.id ";
		$sql .= " ,t.period_from ";
		$sql .= " ,t.period_to ";
		$sql .= " ,t.language ";
		$sql .= " ,t.recommen";
		$sql .= " ,ex.explain_text ";
		$sql .= " FROM ";
		$sql .= " t_test as t ";
		$sql .= " LEFT JOIN (SELECT id,name,login_id,privacy_flg FROM t_user) as u ON u.id=t.customer_id";
		$sql .= " LEFT JOIN (SELECT test_id,explain_text FROM t_test_explain) as ex ON t.id=ex.test_id";
		$sql .= " WHERE ";
		$sql .= " dir='".$dir."' AND ";
		$sql .= " type = ".$type." AND ";
		$sql .= " ";
		$sql .= " 1=1 ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		if($rlt[ 'id' ]){
			//稼働状況のチェック
			$sql = "";
			$sql = "SELECT ";
			$sql .= " min( t.enabled ) as en";
			$sql .= " FROM ";
			$sql .= " t_test as t ";
			$sql .= " WHERE ";
			$sql .= " test_id=".$rlt[ 'id' ];
			
                        
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                         $rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);
                 
			$rlt[ 'en' ] = $rlt2[ 'en' ];
		}
		return $rlt;
		
	}
	
	public function getPaper($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		$exam_id    = $where[ 'exam_id'    ];
		$sql = "";
		$sql .= "SELECT ";
		$sql .= " id,birth,name,birth,kana,sex,tensaku_mail,mail ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id." AND ";
		$sql .= " exam_id='".$exam_id."' AND ";
		$sql .= " 1=1 ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                 
		return $rlt;
		
	}
	
	public function getTestLink($where){
		$testgrp_id = $where[ 'testgrp_id' ];
		$exam_id    = $where[ 'exam_id'    ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " tt.id as tpid";
		$sql .= " ,tt.exam_state ";
		$sql .= " ,tt.exam_id ";
		$sql .= " ,tt.name as examname";
		$sql .= " ,tt.tensaku_status ";
		$sql .= " ,t.type";
		$sql .= " FROM ";
		$sql .= " t_test as t";
		$sql .= " LEFT JOIN (SELECT id,name,exam_id,exam_state,testgrp_id,type,test_id,tensaku_status FROM t_testpaper ) as tt ON t.test_id=tt.testgrp_id AND tt.test_id = t.id";
		$sql .= " WHERE ";
		$sql .= " t.test_id=".$testgrp_id." AND ";
		$sql .= " tt.testgrp_id=".$testgrp_id." AND ";
		$sql .= " tt.exam_id='".$exam_id."' AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY t.type ";
		$sql .= " ORDER BY t.type ";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $i ] = $rlt;
			$i++;
		}
		return $list;
	}
	
	//complete_Flgの設定
	//exam_stateがすべて2であれば1を立てる
	public function editCompleteFlg($where){
                    $exam_id    = $where[ 'exam_id'    ];
                    $testgrp_id = $where[ 'testgrp_id' ];
                    
                    $sql = "";
                    $sql = "SELECT ";
                    $sql .= " id ";
                    $sql .= " FROM ";
                    $sql .= " t_testpaper ";
                    $sql .= " WHERE ";
                    $sql .= " exam_id='".$exam_id."' AND ";
                    $sql .= " testgrp_id=".$testgrp_id." AND ";
                    $sql .= " exam_state IN (0,1) AND ";
                    
                    $sql .= " 1=1 ";
                
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->rowCount();
                
                    if(!$row ){
                        $sql = "";
                        $sql = "UPDATE ";
                        $sql .= " t_testpaper";
                        $sql .= " SET ";
                        $sql .= " complete_flg = 1";
                        $sql .= " WHERE ";
                        $sql .= " exam_id='".$exam_id."' AND ";
                        $sql .= " testgrp_id=".$testgrp_id." AND ";
                        $sql .= " 1=1 ";

                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                    }
	}
	
        
                public function editCompleteFlgAdmin($where){
                    $exam_id    = $where[ 'exam_id'    ];
                    $testgrp_id = $where[ 'testgrp_id' ];
                    $type = $where[ 'type' ];
                    
                    $sql = "";
                    $sql = "UPDATE ";
                    $sql .= " t_testpaper";
                    $sql .= " SET ";
                    $sql .= " complete_flg = 1";
                    $sql .= " WHERE ";
                    $sql .= " exam_id='".$exam_id."' AND ";
                    $sql .= " testgrp_id=".$testgrp_id." AND ";
                    $sql .= " type = ".$type." AND ";
                    $sql .= " 1=1 ";
                    
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    
                    //指定タイプ以外のテストの更新確認
                    $sql = "";
                    $sql = "SELECT ";
                    $sql .= " id ";
                    $sql .= " FROM ";
                    $sql .= " t_testpaper ";
                    $sql .= " WHERE ";
                    $sql .= " exam_id='".$exam_id."' AND ";
                    $sql .= " testgrp_id=".$testgrp_id." AND ";
                    $sql .= " exam_state IN (0,1) AND ";
                    $sql .= " type != ".$type." AND ";
                    $sql .= " 1=1 ";
                
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    $row = $stmt->rowCount();
                
                    //typeがある時は管理画面から変更
                    if(!$row ){
                        $sql = "";
                        $sql = "UPDATE ";
                        $sql .= " t_testpaper";
                        $sql .= " SET ";
                        $sql .= " complete_flg = 1";
                        $sql .= " WHERE ";
                        $sql .= " exam_id='".$exam_id."' AND ";
                        $sql .= " testgrp_id=".$testgrp_id." AND ";
                        $sql .= " type != ".$type." AND ";
                        $sql .= " 1=1 ";

                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                    }
	}
	//メール配信
	//exam_stateがすべて2であれば1を立てる	
	public function sendFinMail($where){
		$testid     = $where[ 'testgrp_id' ];
		$exam_id    = $where[ 'exam_id'    ];
		$testgrp_id = $where[ 'testgrp_id' ];
		$type       = $where[ 'type'       ];
		
		//メール配信フラグ
		$sql = "";
		$sql = "SELECT ";
		$sql .= " send_mail,rest_mail_count,name ";
		$sql .= " ,period_from,period_to";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " id=".$testid;

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                 
		//send_mailが1以上の時
		//すべての受検完了後にメール配信
		$sql = "";
		$sql = "SELECT ";
		$sql .= " count(tt.id) as count ";
		$sql .= " ,p.name as ptname";
		$sql .= " ,p.rep_name as ptRep";
		$sql .= " ,p.rep_email as ptRepMail";
		$sql .= " ,p.rep_name2 as ptRep2";
		$sql .= " ,p.rep_email2 as ptRepMail2";
		$sql .= " ,c.name as cname";
		$sql .= " ,c.rep_name as cRep";
		$sql .= " ,c.rep_email as cRepMail";
		$sql .= " ,c.rep_name2 as cRep2";
		$sql .= " ,c.rep_email2 as cRepMail2";
		$sql .= " ,(SELECT COUNT(DISTINCT exam_id) FROM t_testpaper WHERE testgrp_id=".$testgrp_id." AND exam_state !=2 ) as rest";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " LEFT JOIN (SELECT id,name,rep_name,rep_email,rep_name2,rep_email2 FROM t_user ) as p ON p.id=tt.partner_id";
		$sql .= " LEFT JOIN (SELECT id,name,rep_name,rep_email,rep_name2,rep_email2 FROM t_user ) as c ON c.id=tt.customer_id";
		$sql .= " WHERE ";
		$sql .= " tt.exam_id='".$exam_id."' AND ";
		$sql .= " tt.testgrp_id=".$testgrp_id." AND ";
		$sql .= " tt.complete_flg=1 AND ";
		$sql .= " 1=1 ";

		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 
		if($rlt[ 'send_mail' ]){

			if($row[ 'count' ]){
				//----------------------------------------------
				//受検が完了した際に
				//メール配信　担当者１
				//-----------------------------------------------
				if($row[ 'cRepMail' ]){


					$msg = "";
					$msg = $row[ 'cname']." ".$row[ 'cRep' ]."様";
					$msg .= "\n\n";
					$msg .= "サポートディスクよりお知らせです。\n\n";
					$msg .= "下記の検査において、受検完了いたしました。\n\n";
					$msg .= "検査名： ".$rlt[ 'name' ]."\n";
					$msg .= "受検者ID： ".$exam_id."\n";
					$msg .= "\n";
					$msg .= "ご確認の程、よろしくお願いいたします。\n\n\n";
					$msg .= "------------------------------------------------\n";
					$msg .= "■ ご登録内容についてのお問い合わせ窓口 ■\n";
					$msg .= $row[ 'ptname' ]." 担当".$row[ 'ptRep' ]." ".$row[ 'ptRep2' ]."\n";
					$msg .= "e-mail: ".$row[ 'ptRepMail' ]." ".$row[ 'ptRepMail2' ]."\n";
					$msg .= "------------------------------------------------\n";
					
					$mail = array();
					$mail[ 'subject' ] = "【".$row[ 'ptname' ]."】受検完了メール";
					$mail[ 'to'      ] = $row[ 'cRepMail'  ];
					$mail[ 'body'    ] = $msg;
					$this->sendMailer($mail);
				}
				
				if($row[ 'cRepMail2' ]){
					//----------------------------------------------
					//受検が完了した際に
					//メール配信　担当者2
					//-----------------------------------------------
					$msg = "";
					$msg = $row[ 'cname2']." ".$row[ 'cRep2' ]."様";
					$msg .= "\n\n";
					$msg .= "サポートディスクよりお知らせです。\n\n";
					$msg .= "下記の検査において、受検完了いたしました。\n\n";
					$msg .= "検査名： ".$rlt[ 'name' ]."\n";
					$msg .= "受検者ID： ".$exam_id."\n";
					$msg .= "\n";
					$msg .= "ご確認の程、よろしくお願いいたします。\n\n\n";
					$msg .= "------------------------------------------------\n";
					$msg .= "■ ご登録内容についてのお問い合わせ窓口 ■\n";
					$msg .= $row[ 'ptname' ]." 担当".$row[ 'ptRep' ]." ".$row[ 'ptRep2' ]."\n";
					$msg .= "e-mail: ".$row[ 'ptRepMail' ]." ".$row[ 'ptRepMail2' ]."\n";
					$msg .= "------------------------------------------------\n";
					
					$mail = array();
					$mail[ 'subject' ] = "【".$row[ 'ptname' ]."】受検完了メール";
					$mail[ 'to'      ] = $row[ 'cRepMail2'  ];
					$mail[ 'body'    ] = $msg;
					$this->sendMailer($mail);
				}
			}
			
		}//お知らせメール終わり

		//-----------------------------
		//メール残数配信 パートナに配信
		//-----------------------------
		$rest = $row[ 'rest' ];
		if($rlt[ 'rest_mail_count' ] > 0 ){

			if($rest == $rlt[ 'rest_mail_count' ]){
				$title = "検査数のお知らせ";
				if($row[ 'ptRepMail'  ]){
					$msg = $row[ 'ptname']." ".$row[ 'ptRep' ]."様";
					$msg .= "\n";
					$msg .= "\n";
					$msg .= "下記、検査において、残数が".$rest."件になり、\n受検できる件数が少なくなってきておりますので、\nお知らせ致します。\n";
					$msg .= "\n";
					$msg .= "顧客名：".$row[ 'cname' ]."\n";
					$msg .= "検査名：".$rlt[ 'name' ]."\n";
					$msg .= "期間：".$rlt[period_from]."～".$rlt[period_to]."\n";
					$msg .= "残数：".$rest."\n";

					$mail = array();
					$mail[ 'subject' ] = $title;
					$mail[ 'to'      ] = $row[ 'ptRepMail'  ];
					$mail[ 'body'    ] = $msg;
					$this->sendMailer($mail);
				}
				//担当者２にメール配信
				if($row[ 'ptRepMail2' ]){
					$msg = $row[ 'ptname2']." ".$row[ 'ptRep2' ]."様";
					$msg .= "\n";
					$msg .= "\n";
					$msg .= "下記、検査において、残数が".$rest."件になり、\n受検できる件数が少なくなってきておりますので、\nお知らせ致します。\n";
					$msg .= "\n";
					$msg .= "顧客名：".$row[ 'cname' ]."\n";
					$msg .= "検査名：".$rlt[ 'name' ]."\n";
					$msg .= "期間：".$rlt[period_from]."～".$rlt[period_to]."\n";
					$msg .= "残数：".$rest."\n";

					$mail = array();
					$mail[ 'subject' ] = $title;
					$mail[ 'to'      ] = $row[ 'ptRepMail2'  ];
					$mail[ 'body'    ] = $msg;
					$this->sendMailer($mail);
				}
			}
		}
	}
	
	//多面検査のチェック
	public function tamenCheck($where){
		$test_id = $where[ 'id' ];
		if(!$test_id){
			return false;
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= " type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$test_id;
		$sql .= " AND type= 10";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		if($row){
			return true;
		}else{
			return false;
		}
		
	}
	
	public function getEnqRow($where){
		$test_id = $where[ 'test_id' ];
		$exam_id = $where[ 'exam_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " t_enq ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$test_id." AND ";
		$sql .= " exam_id='".$exam_id."'";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		return $row;
		
	}

	public function checkExamState($where){
		$exam_id    = $where[ 'exam_id'    ];
		$testgrp_id = $where[ 'testgrp_id' ];
		$type       = $where[ 'type'       ];
		
		$sql = "";
		$sql = " SELECT ";
		$sql .= " exam_state ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " type=".$type." AND ";
		$sql .= " exam_id='".$exam_id."' AND ";
		$sql .= " testgrp_id=".$testgrp_id." AND ";
		$sql .= " 1=1 ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
		
	}

	public function checkExamPart($where){
		$dir = $where[ 'dir' ];
		
		$sql = "";
		$sql = " SELECT ";
		$sql .= " type";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " dir='".$dir."' ";

		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = array();
                $i=0;
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $row['type'];
			$i++;
		}
		return $rlt;
		
	}
	
	//評価検査用ログイン
	public function checkJudCheck($where){
		$sql = "
				SELECT 
					j.*
					,t.exam_id
					,t.id as tid
				FROM
					jug_member as j
					INNER JOIN t_testpaper as t ON t.number = j.num AND j.test_id = t.test_id AND t.testgrp_id = j.testgrp_id
				WHERE
					j.empnum = '".$where[ 'empnum' ]."'
					AND t.birth = '".$where[ 'birth' ]."'
					AND t.testgrp_id = '".$where[ 'testgrp_id' ]."'
				";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
	}
	public function getJugData($mem){
		
//上司・部下データ全部
/*
		$sql = "
				SELECT a.* FROM (
				SELECT
					j1.*
					,'1' as boss
					,jm1.empnum
					,CONCAT(jm1.sei,jm1.mei) as nam
				FROM
					jug_boss as j1
					LEFT JOIN jug_member as jm1 ON jm1.id = j1.bossid

				WHERE
					j1.jmid = ".$mem[ 'id' ]."
				UNION ALL
				SELECT
					j2.*
					,'0' as boss
					,jm2.empnum
					,CONCAT(jm2.sei,jm2.mei) as nam
				FROM
					jug_boss as j2
					LEFT JOIN jug_member as jm2 ON jm2.id = j2.jmid
				WHERE
					j2.bossid = ".$mem[ 'id' ]."
				) as a
				ORDER BY a.boss DESC
				";
*/
		
		$sql = "
				SELECT a.* FROM (
				SELECT
					j1.*
					,jm1.empnum
					,'1' as boss
					,'' as cnt
					,CONCAT(jm1.sei,jm1.mei) as nam
					,jb.endtime as endtime
				FROM
					jug_boss as j1
					LEFT JOIN jug_member as jm1 ON jm1.id = j1.bossid
					LEFT JOIN jug_boss_text as jb ON jb.bossid = jm1.id AND type = 2 AND jb.jmid = '".$mem[ 'id' ]."'
				WHERE
					j1.jmid = ".$mem[ 'id' ]." 
					AND j1.bossid <> 0 
				UNION ALL
				SELECT
					j2.*
					,'' as empnum
					,'0' as boss
					,count( j2.id ) as cnt
					,'' as nam
					,jb.endtime as endtime
				FROM
					jug_boss as j2
					LEFT JOIN jug_member as jm2 ON jm2.id = j2.jmid
					LEFT JOIN jug_boss_text as jb ON jb.bossid = 0 AND type = 1 AND jb.jmid = '".$mem[ 'id' ]."'
				WHERE
					j2.bossid = ".$mem[ 'id' ]."  
					
				) as a
				ORDER BY a.boss DESC , a.empnum
				";
//print $sql;
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		$i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
			if($rlt[ 'cnt' ] || $rlt[ 'boss' ] == 1){
				$list[ $i ] = $rlt;
			}
			$i++;
		}
		return $list;

	}
	
	public function checkJudgeFin($mem){
/*
		$sql = "
				SELECT 
					exam_state
				FROM
					t_testpaper
				WHERE
					testgrp_id = '".$mem[ 'testgrp_id' ]."'
					AND type = '52'
					AND number = '".$mem[ 'num' ]."'
				";
*/
		$sql = "
				SELECT 
					endtime
				FROM
					jug_boss_text
				WHERE
					type = '1'
					AND jmid = '".$mem[ 'id' ]."'
				";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
	}

	public function checkInquiry($where){
		$sql = "
				SELECT 
					*
				FROM
					jug_inquiry
				WHERE
					codes = '".$where[ 'codes' ]."'
					AND testgrp_id = '".$where[ 'testgrp_id' ]."'
					AND status = '".$where[ 'status' ]."'
				";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                 
		return $rlt;
	}
	public function getAnqMenu($where){
		$sql = "
				SELECT 
					*
				FROM
					jug_boss
				WHERE
					bossid = '".$where[ 'bossid' ]."'
					AND testgrp_id = '".$where[ 'testgrp_id' ]."'
				";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                
		$i=0;
		while( $rlt = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$list[ $i ] = $rlt;
			$i++;
		}
		return $list;
	}
	
	public function getAnqData($where){
		$today = date("Y-m-d");
		$sql = "
				SELECT 
					*
					,jit.id as jitid
					,jit.status as status
				FROM
					jug_inquiry as ji
					INNER JOIN jug_inquiry_text as jit ON jit.inq_id = ji.id
				WHERE
					ji.testgrp_id = '".$where[ 'testgrp_id' ]."'
					AND jit.jmid = '".$where[ 'bossid' ]."'
					AND jit.start_date <= '".$today."'
					AND jit.end_date >= '".$today."'
				";


                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
	}
}