<?PHP
//----------------------------------
//テスト内容編集メソッド
//
//
//----------------------------------
class testEditMethod extends method{

	//テストグループ取得
	public function getTestGroupId($where){
		$testgrp_id  = $where[ 'testgrp_id'  ];
		$exam_id     = $where[ 'exam_id'     ];
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= "testgrp_id ";
		$sql .= " ,exam_id ";
		$sql .= " ,exam_state ";
		$sql .= " ,name ";
		$sql .= " ,kana ";
		$sql .= " ,birth ";
		$sql .= " ,sex ";
		$sql .= " ,pass ";
		$sql .= " ,memo1 ";
		$sql .= " ,memo2 ";
		$sql .= " ,complete_flg";
		$sql .= " ,type ";
		$sql .= " ,GROUP_CONCAT(type SEPARATOR ', ') as typeLists";
		$sql .= " ,max(tensaku_name) as tensaku_name";
		$sql .= " ,max(tensaku_mail) as tensaku_mail";
		$sql .= " ,max(mail) as mail";
		$sql .= " FROM ";
		$sql .= "t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id." AND ";
		$sql .= " exam_id='".$exam_id."' AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		if($partner_id){
			$sql .= " partner_id=".$partner_id." AND ";
		}
		$sql .= " 1=1 ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	//IDの重複チェック
	public function idCheck($where){
		$testgrp_id  = $where[ 'testgrp_id'  ];
		$exam_id     = $where[ 'exam_id'     ];
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= "id ";
		$sql .= " FROM ";
		$sql .= " t_testpaper";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$testgrp_id." AND ";
		$sql .= " exam_id='".$exam_id."' AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		if($partner_id){
			$sql .= " partner_id=".$partner_id." AND ";
		}
		$sql .= " 1=1 ";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
                return $row;
		
	}
	
	//ランダムな英数字取得
	function getRandomString($nLengthRequired = 8){
		/*
	     $sCharList = "abcdefghijklmnopqrstuvwxyz0123456789";
	     mt_srand();
	     $sRes = "";
	     for($i = 0; $i < $nLengthRequired; $i++)
	         $sRes .= $sCharList{mt_rand(0, strlen($sCharList) - 1)};
	     return $sRes;
*/
			 $sRes = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789"), 0, 3);
			 return $sRes;
	 }
	
	//テスト情報編集
	public function editTestData($where,$edit){
		
		foreach($edit as $k=>$v){
			$edits .= ",".$k."='".$v."'";
		}
		$edits = preg_replace("/^,/","",$edits);
		foreach($where as $k=>$v){
			$wheres .= $k."='".$v."' AND ";
		}
		$sql = "";
		$sql = " UPDATE t_testpaper SET ";
		$sql .= $edits;
		$sql .= " WHERE ";
		$sql .= $wheres;
		$sql .= " 1=1 ";
		
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
		
	}
}
?>
