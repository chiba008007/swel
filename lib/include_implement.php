<?PHP
//----------------------------------
//お知らせ情報
//
//
//----------------------------------
class implementMethod extends method{
	public function getListData($where){
		$pid = $where[ 'partner_id'  ];
		$cid = $where[ 'customer_id' ];

		$date1 = $where[ 'date1' ];
		$date2 = $where[ 'date2' ];
		//受験者数
		if($date1){
			$d1 = " AND tt.exam_date >='".$date1."'";
		}
		if($date2){
		//	$date2 = preg_replace("/\//","-",$date2);
			$d2 = " AND tt.exam_date <='".$date2."'";
		}
		$sql = "
				SELECT 
					tt.name
					,tt.kana
					,tt.type
					,tt.exam_date
					,tt.fin_exam_date
					,tt.exam_id
					,t.name as tname
				FROM
					t_testpaper as tt
					LEFT JOIN t_test as t ON tt.test_id = t.id
				WHERE
					tt.partner_id = '".$pid."'
					AND tt.customer_id='".$cid."'
					".$d1.$d2."
				GROUP BY tt.number,tt.testgrp_id
			";
                
               
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
	public function getTestData($where){
		$pid = $where[ 'partner_id'  ];
		$cid = $where[ 'customer_id' ];

		$date1 = $where[ 'date1' ];
		$date2 = $where[ 'date2' ];
		//受験者数
		if($date1){
			$d1 = " AND a.exam_date >='".$date1."'";
		}
		if($date2){
			//$date2 = preg_replace("/\//","-",$date2);
			//$d2 = " AND a.fin_exam_date <='".$date2." 23:59:00'";
			$d2 = " AND a.exam_date <='".$date2."'";
		}
		$sql = "
				SELECT 
					*
					, SUM( CASE WHEN a.exam_state = 2 ".$d1.$d2." THEN 1 ELSE 0 END ) AS c
					, count(a.id) AS c2
				FROM (
				SELECT 
					t.id
					,t.name
					,tt.id as ttid
					,tt.exam_date
					,tt.fin_exam_date
					,tt.exam_state
					,tt.number
					,tt.testgrp_id
				FROM
					t_test as t
					LEFT JOIN t_testpaper as tt ON t.id=tt.testgrp_id
				WHERE
					t.partner_id='".$pid."'
					AND t.customer_id = '".$cid."'
					AND t.test_id = 0
					GROUP BY tt.number,tt.testgrp_id
				) as a
				WHERE
				a.exam_state IN( 0,1,2 )
				
				GROUP BY a.id
			";
                
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
	public function getUserData($where){
		$ptid = $where[ 'ptid' ];
		$sql = "
				SELECT 
					id
					,name
				FROM 
					t_user
				WHERE
					partner_id = '".$ptid."'
					AND del=0
				ORDER BY registtime DESC
			";
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
	public function getCusData($where){
		$cid = $where[ 'cid' ];
		$sql = "
				SELECT 
					name
				FROM
					t_user
				WHERE
					id='".$cid."'
				";
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
		$i=0;
                $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $list;
	}
}
?>
