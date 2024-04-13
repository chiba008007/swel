<?PHP
//----------------------------------
//BA検査結果メソッド
//
//
//----------------------------------
class cusRstMethod extends method{
	//データ取得
	function getTestResult($data){
		$id = $data[ 'id' ];
		
		$sql = "";
		$sql = "SELECT ";
		$sql .= " tt.name,tt.level,tt.soyo,t.type ";
		$sql .= " FROM t_testpaper as tt";
		$sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
		$sql .= " WHERE ";
		$sql .= " tt.id =".$id." AND ";
		$sql .= " tt.disabled=0 AND ";
		$sql .= " 1=1 ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = array();
                $i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		
			$rlt[ $i ] = $result;
			$i++;
		}
		return $rlt;
		
	}

	//数学データ取得
	public function getMathData($id){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " test_id,testgrp_id,exam_id ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " id =".$id[ 'id' ]." AND ";
		$sql .= " disabled=0 AND ";
		$sql .= " 1=1 ";
		
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
		$sql = "";
		$sql = "SELECT ";
		$sql .= " ms.haku_yoso as haku,";
		$sql .= " ms.bunseki_yoso as bunseki, ";
		$sql .= " ms.sentaku_yoso as sentaku, ";
		$sql .= " ms.yosoku_yoso as yosoku, ";
		$sql .= " ms.hyogen_yoso as hyogen";
		$sql .= " FROM ";
		$sql .= " math_score as ms ";
		$sql .= " WHERE ";
		$sql .= " ms.math_id=";
		$sql .= " (";
		$sql .= " SELECT mm.id FROM math_member as mm";
		$sql .= " WHERE ";
		$sql .= " mm.test_id=".$row[ 'test_id' ]." AND ";
		$sql .= " mm.testgrp_id=".$row[ 'testgrp_id' ]." AND ";
		$sql .= " mm.exam_id='".$row[ 'exam_id' ]."'  ";
		$sql .= ")";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $rlt;
	}

	public function getMath2Data($id){
		$sql = "";
		$sql = "SELECT ";
		$sql .= " test_id,testgrp_id,exam_id ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " id =".$id[ 'id' ]." AND ";
		$sql .= " disabled=0 AND ";
		$sql .= " 1=1 ";
		
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                
		$sql = "";
		$sql = "SELECT ";
		$sql .= " ms.haku_yoso as haku,";
		$sql .= " ms.bunseki_yoso as bunseki, ";
		$sql .= " ms.sentaku_yoso as sentaku, ";
		$sql .= " ms.yosoku_yoso as yosoku, ";
		$sql .= " ms.hyogen_yoso as hyogen";
		$sql .= " FROM ";
		$sql .= " math2_score as ms ";
		$sql .= " WHERE ";
		$sql .= " ms.math_id=";
		$sql .= " (";
		$sql .= " SELECT mm.id FROM math2_member as mm";
		$sql .= " WHERE ";
		$sql .= " mm.test_id=".$row[ 'test_id' ]." AND ";
		$sql .= " mm.testgrp_id=".$row[ 'testgrp_id' ]." AND ";
		$sql .= " mm.exam_id='".$row[ 'exam_id' ]."'  ";
		$sql .= ")";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                
		return $rlt;
	}

}
?>
