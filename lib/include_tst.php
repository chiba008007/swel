<?PHP
//----------------------------------
//受検者一覧管理画面メソッド
//
//
//----------------------------------
class tstMethod extends method{



	public function getSearchDataSt($data,$limit=""){

		$exam_id  = $data[ 'exam_id'  ];
		$company  = $data[ 'company'  ];
		$username  = $data[ 'username'  ];
		$ex_date  = $data[ 'ex_date'  ];
		$fin_date = $data[ 'fin_date' ];
		
		$sql = "SELECT ";
		$sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.exam_date,tt.fin_exam_date,tt.level,tt.customer_id,tt.partner_id ";
		$sql .= " ,t.name as test_name  ";
		$sql .= " ,u.name as customer_name ";
		$sql .= " ,u2.name as partner_name ";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN t_test as t ON t.id = tt.test_id ";
		$sql .= " LEFT JOIN t_user as u ON u.id = tt.customer_id ";
		$sql .= " LEFT JOIN t_user as u2 ON u2.id = tt.partner_id ";
		$sql .= " WHERE ";
		$sql .= " tt.disabled=0 AND ";
		$sql .= " tt.exam_state=2 AND ";
		$sql .= " tt.complete_flg=1 AND ";
		$sql .= " tt.temp_flg=0  ";

		if($exam_id){
			$sql .= "AND tt.exam_id LIKE '%".$exam_id."%'";
		}
		if($company){
			$sql .= "AND u.name LIKE '%".$company."%'";
		}
		if($username){
			$sql .= "AND tt.name LIKE '%".$username."%' OR tt.kana LIKE '%".$username."%' ";
		}
		if($ex_date && $fin_date){
			$sql .= " AND (tt.exam_date='".$ex_date."' OR tt.fin_exam_date LIKE '".$fin_date."' ) ";
		}
		$sql .= " AND 1=1 ";
		$sql .= " GROUP BY tt.exam_id,tt.testgrp_id ";

		$sql .= " ORDER BY  tt.fin_exam_date DESC";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i = 0;
                while($brow = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[$i] = $brow;
                    $i++;
                }
                $this->row = count($list);
                
		if($limit){
			$sql .= " limit ".$limit[ 'limit' ]." offset ".$limit[ 'offset' ]." ";
		}
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = array();
		$i=0;
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $date = sprintf("%d",preg_replace("/\//","",$result['exam_date']));
                    $rlt[$i] = $result;

                    if($result[ 'birth' ]){
                        $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
                    }else{
                        $rlt[ $i ][ 'age' ] = "";
                    }
                    $i++;
                }
		return $rlt;
		
	}


}
?>
