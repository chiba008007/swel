<?PHP
class editMethod extends method{
	/*
	���O�C��ID�̏d���`�F�b�N
	*/
	public function idCheck($data){
		$login_id = $data[ 'login_id' ];
		$sql = "";
		$sql = "SELECT * FROM t_user";
		$sql .= " WHERE ";
		$sql .= " login_id='".$login_id."' AND ";
		$sql .= " 1=1 ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		return $row;
	}
	/*
	���j�[�NID�̎擾
	*/
	public function getUniqID($data){
		$login_id = $data[ 'login_id' ];
		$sql = "";
		$sql = "SELECT id FROM t_user";
		$sql .= " WHERE ";
		$sql .= " login_id='".$login_id."' AND ";
		$sql .= " 1=1 ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		return $row;
	}
	/*
	�o�^���[�U�[�f�[�^�擾
	*/
	public function getUserData($data){
		$id     = $data[ 'id'     ];
		$eir_id = $data[ 'eir_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " u.id,u.login_id,u.login_pw,u.name,u.post1,u.post2,u.prefecture,u.address1,u.address2 ";
		$sql .= " ,u.tel,u.fax,u.rep_name,u.rep_email,u.rep_name2,u.rep_email2,u.rep_busyo ";
		$sql .= " ,u.rep_tel1,u.license,u.license_parts,u.logo_name,u.element_flg,u.outputPdf,u.ptTestBtn ";
		$sql .= " ,e_feel,e_cus,e_aff,e_cntl,e_vi,e_pos,e_symp,e_situ,e_hosp,e_lead,e_ass,e_adap";
		$sql .= " FROM ";
		$sql .= " t_user as u ";
		$sql .= " LEFT JOIN t_element as e ON u.id = e.uid";
		$sql .= " WHERE ";
		$sql .= " u.id= '".$id."' AND ";
	//	$sql .= " eir_id=".$eir_id." AND ";
		$sql .= " del = 0 AND ";
		$sql .= " 1=1 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	
	/*
		�v�f�f�[�^�ҏW
	*/
	public function editElement($data){
		$uid = $data[ 'where' ][ 'uid' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_element ";
		$sql .= " WHERE ";
		$sql .= " uid=".$uid." AND ";
		$sql .= " 1=1 ";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();

		if($row){
			$table = "t_element";
			$this->editUserData($table,$data);
		}else{
			$table = "t_element";
			$set = array();
			$set[ 'uid'            ] = $uid;
			$set[ 'element_status' ] = 1;
			$set[ 'e_feel'  ] = $data[ 'edit' ][ 'e_feel' ];
			$set[ 'e_cus'   ] = $data[ 'edit' ][ 'e_cus'  ];
			$set[ 'e_aff'   ] = $data[ 'edit' ][ 'e_aff'  ];
			$set[ 'e_cntl'  ] = $data[ 'edit' ][ 'e_cntl' ];
			$set[ 'e_vi'    ] = $data[ 'edit' ][ 'e_vi'   ];
			$set[ 'e_pos'   ] = $data[ 'edit' ][ 'e_pos'  ];
			$set[ 'e_symp'  ] = $data[ 'edit' ][ 'e_symp' ];
			$set[ 'e_situ'  ] = $data[ 'edit' ][ 'e_situ' ];
			$set[ 'e_hosp'  ] = $data[ 'edit' ][ 'e_hosp' ];
			$set[ 'e_lead'  ] = $data[ 'edit' ][ 'e_lead' ];
			$set[ 'e_ass'   ] = $data[ 'edit' ][ 'e_ass'  ];
			$set[ 'e_adap'  ] = $data[ 'edit' ][ 'e_adap' ];
			$this->setUserData($table,$set);
			
		}
		
	}


	//-----------------------------------------------
	//�������O�ǉ�
	//-----------------------------------------------
	public function setLog($data){
		$to_id     = $data[ 'to_id'     ];
		$from_id   = $data[ 'from_id'   ];
		$from_type = $data[ 'from_type' ];
		$status    = $data[ 'status'    ];

		$exp = explode(":",$data[ 'license_num' ]);

		$i=1;
		$ins = "";
		foreach($exp as $key=>$val){
			$sts = $status[$key+1];
			if($val){
				$ins .= "(".$to_id.",".$from_id.",".$from_type.",".$val.",".$i.",".$sts."),";
			}
			$i++;
		}

		$ins = preg_replace("/,$/","",$ins);
		$sql = "";
		if($ins){
			$sql = "INSERT INTO log_tbl (to_id, from_id, from_type, license_num,`type`,`status`) VALUES ";
			$sql .= $ins;

			$stmt = $this->db->prepare($sql);
			$stmt->execute();
		}
	}
	
}
?>