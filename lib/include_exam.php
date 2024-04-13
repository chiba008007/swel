<?PHP
//----------------------------------
//csvアップロードメソッド
//
//
//----------------------------------
class examMethod extends method{
	public function getChangeMoney($where){
		$sql = "
				SELECT
					*
				FROM
					t_changeTest
				WHERE
					pid = '".$where[ 'ptid' ]."' AND
					status = 1
				";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[ $rlt[ 'type' ] ] = $rlt;
		}
		return $list;
	}
	public function getOrderNo(){
		$sql = "
				SELECT 
					MAX(order_no) as order_no
				FROM
					t_order
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
                 
		$max = $rlt[ 'order_no' ]+1;
		return $max;
	}
	
	public function getSelect($where){
		$sql = "
				SELECT 
					*
				FROM(
					SELECT 
						t.id
						,t.name
						,group_concat(t2.type separator ',') as sep
					FROM
						t_test as t 
						LEFT JOIN t_test as t2 ON t.id = t2.test_id AND t2.type != 0 AND t2.temp_flg = 0
					WHERE
						t.customer_id='".$where[ 'customer_id' ]."' AND
						t.temp_flg = '".$where[ 'temp_flg' ]."' AND 
						t.test_id = '".$where[ 'test_id' ]."'
					GROUP BY t.id
				) as a
				WHERE
					a.sep IN ('1','2','12')
				ORDER BY a.id DESC
				";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i=0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[$rlt[ 'id' ]] = $rlt;
			$i++;
		}
		return $list;
	}

	public function getSelectMoney($where){
		$sql = "
				SELECT 
					id
					,name
					,type
					,pdfdownload
				FROM
					t_test
				WHERE
					test_id = '".$where[ 'stid' ]."'
				ORDER BY id
				";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
                $i = 0;
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$list[$rlt[ 'id' ]] = $rlt;
			$i++;
		}

		return $list;
	}

	public function getPdfMoney($where){
		global $array_pdf_money;
		$sql = "
				SELECT 
					id
					,name
					,type
					,pdfdownload
				FROM
					t_test
				WHERE
					test_id = '".$where[ 'stid' ]."'
				ORDER BY id
				";
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = array();
		while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$pdf = $rlt[ 'pdfdownload' ];
		}
		if($pdf){
			$ex = explode(":",$pdf);
			foreach($ex as $key=>$val){
				$mny += $array_pdf_money[ $val ];
			}
			$list[ 'mny' ] = $mny;
			$list[ 'pdf' ] = $pdf;
		}
		return $list;
	}

}
?>
