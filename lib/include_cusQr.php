<?PHP
//----------------------------------
//Qrコードメソッド
//
//
//----------------------------------
class cusQrMethod extends method{
    public function getUsersData($where){
        $id = $where[ 'id' ];
        $sql = "

select
tt.customer_id
,u.ssltype
from
    t_testpaper as tt
    LEFT JOIN t_user as u ON u.id = tt.customer_id
WHERE
    testgrp_id =:id
group by customer_id
";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_BOTH);

        return $result;

    }
	public function getTestData($where){
		$id  = $where[ 'id'          ];
		$cid = $where[ 'customer_id' ];
		$pid = $where[ 'partner_id'  ];
		//テスト形数の取得
		$sql = "";
		$sql = "SELECT ";
		$sql .= " id ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$id." AND ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY type";
                /*
		$r = mysql_query($sql);
		$row = mysql_num_rows($r);
		*/

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();


		$sql = "";
		$sql .= "SELECT ";
		$sql .= " name,period_to,period_from,dir ";
		$sql .= " , number";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " 1=1 ";
                /*
		$r = mysql_query($sql);
		$result = mysql_fetch_assoc($r);
		$result[ 'number' ] = ceil($result[ 'number' ]/$row);
		return $result;
                 *
                 */
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                 $result = $stmt->fetch(PDO::FETCH_ASSOC);
                 $result[ 'number' ] = ceil($result[ 'number' ]/$row);
		return $result;

	}

	public function getTestDataList($where,$testType){
		$id  = $where[ 'id'          ];
		$cid = $where[ 'customer_id' ];
		$pid = $where[ 'partner_id'  ];

		$sql = "SELECT ";
		$sql .= " type ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$id." AND ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " 1=1 ";

                /*
		$r = mysql_query($sql);
		while($rlt = mysql_fetch_assoc($r)){
			$ty = $rlt[ 'type' ];
			$type .= "■".$testType[ $rlt['type'] ]."<br />";
		}
                 *
                 */
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
			$ty = $rlt[ 'type' ];
			$type .= "■".$testType[ $rlt['type'] ]."<br />";
		}

		//評価検査用
		$this->test52 = $ty;

		$sql = "";
		$sql = "SELECT ";
		$sql .= " exam_id,name ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=".$id." AND ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY number ";
		$sql .= " ORDER BY number ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i = 0;
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[$i] = $rlt;
                    $list[ $i ][ 'type' ] = $type;
                    $i++;
                }
                return $list;

	}



	public function getTamenTestDataList($where,$testType){
		$id  = $where[ 'id'          ];
		$cid = $where[ 'customer_id' ];
		$pid = $where[ 'partner_id'  ];

		$sql = "";
		$sql = "SELECT tamen_type FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$id." AND ";
		$sql .= " partner_id=".$pid." AND ";
		$sql .= " customer_id=".$cid." AND ";
		$sql .= " 1=1 ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
		$types = explode(":",$row[ 'tamen_type' ]);
		foreach($types as $key=>$val){
			$ty[ $val ] = $testType[ $val ];
		}

		$sql = "";
		$sql = "SELECT ";
		$sql .= " ta.ev_name, ";
		$sql .= " ta.ev_id";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql .= " LEFT JOIN (SELECT ev_id,ev_name,tp_id FROM tamen_tbl) as ta ON ta.tp_id=tt.id";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=".$id." AND ";
		$sql .= " tt.partner_id=".$pid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		$sql .= " 1=1 ";
		$sql .= " GROUP BY number ";
		$sql .= " ORDER BY number ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){

			$list[$i] = $rlt;
			$list[$i]['ty'] = $ty;

			$i++;
		}
		return $list;
	}

	//評価検査用
	public function getTestJug($where){
		$sql = "
				SELECT
					*
				FROM
					jug_member
				WHERE
					testgrp_id = ".$where[ 'id' ]."
				ORDER BY id
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
}
?>
