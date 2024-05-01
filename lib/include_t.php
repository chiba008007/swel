<?PHP
//----------------------------------
//csvアップロードメソッド
//
//
//----------------------------------
class cusCsvUpMethod extends method{


	public function tensakuSts($where){
		$sql = "
				SELECT
					*
				FROM
					t_test
				WHERE
					test_id = '".$where[ 'test_id' ]."' AND
					type='".$where[ 'type' ]."'
				";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $row = $stmt->rowCount();
		return $row;
	}


	public function getTypeOne($where){
		$test_id = $where[ 'test_id' ];
		$type    = $where[ 'type'    ];

		$sql = "";
		$sql = "SELECT";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=".$test_id." AND ";
		$sql .= " type=".$type."  ";


                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $list = $stmt->fetch(PDO::FETCH_ASSOC);
		return $list;
	}

	public function editTest($where,$edit){
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		$testgrp_id  = $where[ 'testgrp_id'  ];
		$number      = $where[ 'number'      ];

		$exam_id      = $edit[ 'exam_id'      ];
		$name         = $edit[ 'name'         ];
		$kana         = $edit[ 'kana'         ];
		$birth        = $edit[ 'birth'        ];
		$memo1        = $edit[ 'memo1'        ];
		$memo2        = $edit[ 'memo2'        ];
		$tensaku_name = $edit[ 'tensaku_name' ];
		$tensaku_mail = $edit[ 'tensaku_mail' ];


		$sql = "";
		$sql = "UPDATE ";
		$sql .= " t_testpaper ";
		$sql .= " SET ";
		$sql .= " name = '".$name."',";
		$sql .= " kana = '".$kana."',";
		$sql .= " birth = '".$birth."',";
		if($tensaku_name) $sql .= " tensaku_name = '".$tensaku_name."',";
		if($tensaku_mail) $sql .= " tensaku_mail = '".$tensaku_mail."',";

		$sql .= " memo1 = '".$memo1."',";
		$sql .= " memo2 = '".$memo2."'";
		//if($_REQUEST[ 'type' ] == 1){
		    $sql .= ",exam_id = '".$exam_id."'";
		//}
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$testgrp_id." AND ";
		$sql .= " number = ".$number;
		if($_REQUEST[ 'type' ] == 2){
		   // $sql .= " AND exam_state != 0 ";
		}else{
		    $sql .= " AND exam_state = 0 ";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return $r;
	}

	public function getExamId($where){
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		$testgrp_id  = $where[ 'testgrp_id'  ];

		$sql  = "";
		$sql  = " SELECT ";
		$sql .= " exam_id ";
		$sql .= " ,number ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$testgrp_id." ";


                $stmt = $this->db->prepare($sql);
                $stmt->execute();

		$i=0;
		while($list = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$list[ 'number' ]] = $list[ 'exam_id' ];
			$i++;
		}
		return $rlt;
	}
	public  function getHist($where){

	    $sql = "SELECT
                    *
                FROM
                    errupload
                WHERE
                    testid=".$where[ 'testid' ]." AND
                    mainid=".$where[ 'mainid' ]."
                order by regist_ts desc
                ";
	    $stmt = $this->db->prepare($sql);
	    $stmt->execute();
        $i=0;
        $rlt = [];
		while($list = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[] = $list;
			$i++;
		}
		return $rlt;

	}
	public function checktestdata($chk){

	    $sql = "SELECT
                 *
                FROM
                    t_testpaper
                WHERE
                    customer_id = ".$chk[ 'pid' ]." AND
                    testgrp_id = ".$chk[ 'tid' ]." AND
                    BINARY exam_id = '".$chk[ 'exam' ]."'
             ";
	    $stmt = $this->db->prepare($sql);
	    $stmt->execute();
	    $list = $stmt->fetch(PDO::FETCH_ASSOC);
	 //   var_dump($list[ 'number' ],$chk[ 'number' ]);
	    if($list[ 'number' ] && $list[ 'number' ] != $chk[ 'number' ]){
	        return $chk[ 'number' ];
	    }
	}

	public function checktestexam($chk){

	    $sql = "SELECT
                 exam_id
                FROM
                    t_testpaper
                WHERE
                    customer_id = ".$chk[ 'pid' ]." AND
                    testgrp_id = ".$chk[ 'tid' ]." AND
                    number = '".$chk[ 'number' ]."' AND
                    exam_state IN( '1','2')
             ";

	    $stmt = $this->db->prepare($sql);
	    $stmt->execute();
	    $list = $stmt->fetch(PDO::FETCH_ASSOC);

	    return $list[ 'exam_id' ];

	}

	public function getTestData($where){
		$partner_id  = $where[ 'partner_id'  ];
		$customer_id = $where[ 'customer_id' ];
		$testgrp_id  = $where[ 'testgrp_id'  ];

		$sql  = "";
		$sql  = " SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " partner_id=".$partner_id." AND ";
		$sql .= " customer_id=".$customer_id." AND ";
		$sql .= " testgrp_id=".$testgrp_id."  ";
		if($_REQUEST[ 'type' ] == 1){
			$sql .= "AND exam_state = 0 ";
		}
		$sql .= " GROUP BY number ";
		if($_REQUEST[ 'type' ] == 1){
			$sql .= " HAVING count(*) >= (SELECT MAX(a.cnt) as max FROM (SELECT count(*) as cnt FROM igtests_innov.t_testpaper where testgrp_id=".$testgrp_id." AND exam_state=0 GROUP BY number) as a)";
		}
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$i=0;
		$rlt = [];
		while($list = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$list[ 'number' ]] = $list;
			$i++;
		}
		return $rlt;
	}

	public function doSql($sql){

		$stmt = $this->db->prepare($sql);
		return $stmt->execute();
	}
	public function doGetSql($sql){

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i=0;
		$rlt = [];
		while($list = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$list[ 'number' ]] = $list;
			$i++;
		}
		return $rlt;
	}
}
?>
