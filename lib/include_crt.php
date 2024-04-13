<?PHP
	class crt extends method{
		public function setAnswer($set){
			$answer_text        = $set[ 'answer_text'        ];
			$answer_advice_text = $set[ 'answer_advice_text' ];
			$note_point         = $set[ 'note_point'         ];
			$logic_point        = $set[ 'logic_point'        ];
			$exam_id            = $set[ 'exam_id'            ];
			$testgrp_id         = $set[ 'testgrp_id'         ];
			$test_id            = $set[ 'test_id'            ];
			$tensaku_id         = $set[ 'tensaku_id'         ];
			$sql = "
					UPDATE crt_result SET 
						 answer_text        = '".$answer_text."'
						,answer_advice_text = '".$answer_advice_text."'
						,note_point         = '".$note_point."'
						,logic_point        = '".$logic_point."'
					WHERE
						crt_id = (
								SELECT id FROM crt_member
									WHERE
								test_id = '".$test_id."' AND
								testgrp_id = '".$testgrp_id."' AND
								exam_id = '".$exam_id."' 
							)
						AND tensaku_id = ".$tensaku_id."
				";

			
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                        
			return true;
		}
		
		public function editBaseCrt($edit){
			$exam_id            = $edit[ 'exam_id'            ];
			$testgrp_id         = $edit[ 'testgrp_id'         ];
			$test_id            = $edit[ 'test_id'            ];
			$tensaku_number     = $edit[ 'tensaku_number'     ];
			$tensaku_flg        = $edit[ 'tensaku_flg'        ];
			
			$sql = "
					UPDATE crt_member SET 
						tensaku_flg     = '".$tensaku_flg."'
						,tensaku_number = '".$tensaku_number."'
					WHERE
						test_id = '".$test_id."' AND
						testgrp_id = '".$testgrp_id."' AND
						exam_id = '".$exam_id."' 
				";

			$stmt = $this->db->prepare($sql);
                        $stmt->execute();
                        
			return true;
		}
		
		public function getTestBase($where){
			$sql = "
					SELECT 
						name
						,dir
					FROM
						t_test
					WHERE
						test_id=".$where[ 'test_id' ]."
						AND type=48
					";
			
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
			return $rlt;
		}
		
		public function getTestList($where){
			$crt_id = $where[ 'crt_id' ];
			$sql = "
					SELECT 
						*
					FROM
						crt_result
					WHERE
						crt_id=".$crt_id."
						AND 1=1
				";
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
			$i=0;
			while($list = $stmt->fetch(PDO::FETCH_ASSOC)){
				$rlt[$list[ 'tensaku_id' ]] = $list;
				$i++;
			}
			return $rlt;
		}
		
		public function getUserData($where){
			$testgrp_id = $where[ 'testgrp_id' ];
			$exam_id    = $where[ 'exam_id'    ];
			$sql = "
					SELECT 
						tt.mail
						,tt.tensaku_name
						,tt.name
						,u.rep_email
						,u.rep_name
						,u.name as company_name
					FROM
						t_testpaper as tt
					INNER JOIN (SELECT id,rep_email,rep_name,name FROM t_user ) as u
						ON u.id = tt.customer_id
					WHERE
						tt.testgrp_id=".$testgrp_id."
						AND tt.exam_id='".$exam_id."'
					GROUP BY u.id
					";
			
                        
                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
			$i=0;
			$list = $stmt->fetch(PDO::FETCH_ASSOC);
                            
                        
			return $list;
		}



		//--------------------------
		//�S�f�[�^�擾
		//--------------------------
		public function getAllData($data){
			$crt_id = $data[ 'id' ];
			$sql = "
					SELECT 
						 *
					FROM
						crt_result
					WHERE
						crt_id=".$crt_id."
					ORDER BY tensaku_id
					";
			$stmt = $this->db->prepare($sql);
                        $stmt->execute();
			
			$i=0;
			while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
				$list[$i] = $rlt;
				$i++;
			}
			return $list;
		}
		public function getDataOne($where){
			$sql = "
					SELECT 
						*
					FROM
						crt_member as cm
						LEFT JOIN crt_result as cr ON cr.crt_id = cm.id
					WHERE
						exam_id='".$where[ 'exam_id' ]."' 
						AND testgrp_id = ".$where[ 'testgrp_id' ]."
					";
			if($where[ 'tensaku_id' ]){
				$sql .= "
						AND tensaku_id = ".$where[ 'tensaku_id' ]."
					";
			}
			$sql .= " ORDER BY tensaku_id ASC";
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
?>
