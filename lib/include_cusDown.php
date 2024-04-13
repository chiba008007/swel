<?PHP
//----------------------------------
//エクセルダウンロードメソッド
//
//
//----------------------------------
class cusDownMethod extends method
{

	public function getSougoPoint($data)
	{
		$sql = "SELECT 
					tt.*
					,rs.*
				FROM 
					t_testpaper as tt
					LEFT JOIN rs3_member as rm ON rm.testgrp_id = tt.testgrp_id AND rm.exam_id = tt.exam_id
					LEFT JOIN rs3_score as rs ON rs.rs_id = rm.id 
				WHERE
					tt.id=:id
				";

		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":id", $data['id']);
		$stmt->execute();
		$result = $stmt->fetch();

		$this->exam_id = $result['exam_id'];

		//総合得点の計算
		$this->dev1 = round($result['dev1'], 1); //自己感情モニタリング力
		//$this->dev2 = $result[ 'sougo' ]; //感情能力総合
		$this->dev2 = round($result['dev2'], 1);
		$this->dev3 = round($result['dev3'], 1);
		$this->dev4 = round($result['dev4'], 1);
		$this->dev5 = round($result['dev5'], 1);
		$this->dev6 = round($result['dev6'], 1);
		$this->dev7 = round($result['dev7'], 1);
		$this->dev8 = round($result['dev8'], 1);
		$this->dev9 = round($result['dev9'], 1);
		$this->dev10 = round($result['dev10'], 1);
		$this->dev11 = round($result['dev11'], 1);
		$this->dev12 = round($result['dev12'], 1);
		$this->lv = $result['level'];


		$this->dev1lv = $this->getLevel($this->dev1);
		$this->dev2lv = $this->getLevel($this->dev2);
		$this->dev3lv = $this->getLevel($this->dev3);
		$this->dev4lv = $this->getLevel($this->dev4);
		$this->dev5lv = $this->getLevel($this->dev5);
		$this->dev6lv = $this->getLevel($this->dev6);
		$this->dev7lv = $this->getLevel($this->dev7);
		$this->dev8lv = $this->getLevel($this->dev8);
		$this->dev9lv = $this->getLevel($this->dev9);
		$this->dev10lv = $this->getLevel($this->dev10);
		$this->dev11lv = $this->getLevel($this->dev11);
		$this->dev12lv = $this->getLevel($this->dev12);

		//感情能力
		$this->rs_sougo = round((float)$result['sougo'], 1);
		$this->rs_sougolv = $this->getLevel($result['sougo']);
		$this->rs_yomitori = $result['yomitori'];
		$this->rs_yomitorilv = $this->getLevel($result['yomitori']);
		$this->rs_rikai = $result['rikai'];
		$this->rs_rikailv = $this->getLevel($result['rikai']);
		$this->rs_sentaku = $result['sentaku'];
		$this->rs_sentakulv = $this->getLevel($result['sentaku']);
		$this->rs_kirikae = $result['kirikae'];
		$this->rs_kirikaelv = $this->getLevel($result['kirikae']);
		$this->rs_jyoho = $result['jyoho'];
		$this->rs_jyoholv = $this->getLevel($result['jyoho']);

		$this->score = round($result['score'], 1);
		$this->toplevel = $this->getJudgeCalc();
		$point = $this->getSougoCalc();


		return $result;
	}
	//面接時のチェックポイント
	public function interviewCheck()
	{

		$points = array(
			"dev1" => array(
				"p" => $this->dev1, "lv" => $this->dev1lv, "sort" => 1
			),
			"dev2" => array(
				"p" => $this->dev2, "lv" => $this->dev2lv, "sort" => 2
			),
			"dev4" => array(
				"p" => $this->dev4, "lv" => $this->dev4lv, "sort" => 3
			),
			"dev7" => array(
				"p" => $this->dev7, "lv" => $this->dev7lv, "sort" => 4
			),
			"dev8" => array(
				"p" => $this->dev8, "lv" => $this->dev8lv, "sort" => 5
			),
			"dev12" => array(
				"p" => $this->dev12, "lv" => $this->dev12lv, "sort" => 6
			),
		);


		$values = [];
		$sort = [];
		foreach ($points as $key => $vals) {
			//			if($vals['lv'] <= 2){
			$values[$key] = $vals['p'];
			$sort[$key] = $vals['sort'];
			//			}
		}

		array_multisort($values, SORT_ASC, $sort, SORT_ASC, $points);

		$first = "";
		$second = "";

		$first = array_slice($points, 0, 1, true);
		$second = array_slice($points, 1, 1, true);

		$merges = array_merge($first, $second);
		$merge = [];
		foreach ($merges as $key => $val) {
			if ($val['lv'] <= 2) $merge[$key] = $val['lv'];
		}

		return $merge;
	}

	//行動価値面接時のチェックポイント
	public function interviewCheckRS()
	{

		$points = array(
			"rs_yomitori" => array(
				"p" => $this->rs_yomitori, "lv" => $this->rs_yomitorilv, "sort" => 1
			),
			"rs_rikai" => array(
				"p" => $this->rs_rikai, "lv" => $this->rs_rikailv, "sort" => 2
			),
			"rs_sentaku" => array(
				"p" => $this->rs_sentaku, "lv" => $this->rs_sentakulv, "sort" => 3
			),
			"rs_kirikae" => array(
				"p" => $this->rs_kirikae, "lv" => $this->rs_kirikaelv, "sort" => 4
			),
			// "rs_jyoho"=>array(
			// 	"p"=>$this->rs_jyoho
			// 	,"lv"=>$this->rs_jyoholv
			// 	,"sort"=>5
			// ),
		);

		$levels = [];
		$values = [];
		$sort = [];
		foreach ($points as $key => $vals) {
			//	if($vals['lv'] <= 2){
			$sort[$key] = $vals['sort'];
			$values[$key] = $vals['p'];
			//	}
		}
		array_multisort($values, SORT_ASC, $sort, SORT_ASC, $points);

		$first = "";
		$second = "";

		$first = array_slice($points, 0, 1, true);
		$second = array_slice($points, 1, 1, true);

		$merges = array_merge($first, $second);
		$merge = [];
		foreach ($merges as $key => $val) {
			if ($val['lv'] <= 2) $merge[$key] = $val['lv'];
		}
		return $merge;
	}

	//規範適応のチェックポイント
	public function basicCheckRS()
	{

		$points = array(
			"basic" => array(
				"p" => $this->basic, "lv" => $this->basiclv, "sort" => 1
			),
			"emotion" => array(
				"p" => $this->emotion, "lv" => $this->emotionlv, "sort" => 2
			),
			"image" => array(
				"p" => $this->image, "lv" => $this->imagelv, "sort" => 3
			),
		);

		$levels = [];
		$values = [];
		$sort = [];
		foreach ($points as $key => $vals) {
			//	if($vals['lv'] <= 2){
			$sort[$key] = $vals['sort'];
			$values[$key] = $vals['p'];
			//	}
		}
		array_multisort($values, SORT_ASC, $sort, SORT_ASC, $points);

		$first = "";
		$second = "";

		$first = array_slice($points, 0, 1, true);
		$second = array_slice($points, 1, 1, true);

		$merges = array_merge($first, $second);
		$merge = [];
		foreach ($merges as $key => $val) {
			if ($val['lv'] <= 2) $merge[$key] = $val['lv'];
		}
		return $merge;
	}

	public function getBasicScore()
	{
		//規範意識		
		$this->basic = (round($this->dev2, 1) + (100 - round($this->rs_jyoho, 1))) / 2;
		$this->basiclv = $this->getLevel($this->basic);
		//情緒的余裕
		$this->emotion = (round($this->dev4, 1) + round($this->rs_kirikae, 1)) / 2;
		$this->emotionlv = $this->getLevel($this->emotion);
		//感情コントロール
		$this->image = (round($this->dev3, 1) + round($this->rs_sentaku, 1)) / 2;
		$this->imagelv = $this->getLevel($this->image);
		$return = [];
		$return['basic']['sc'] = $this->basic;
		$return['emotion']['sc'] = $this->emotion;
		$return['image']['sc'] = $this->image;
		return $return;
	}

	public function getBarWidth($type)
	{
		define("BAR", 40);
		$one = substr($this->$type, 0, 1);
		$two = substr($this->$type, 1, 1);
		$sogobar = BAR * ($one - 2);
		$sogobar1 = 0;
		if ($this->$type == 80) $sogobar = $sogobar - 5;
		if ($sogobar <= 0) $sogobar = 5;
		if ($two > 0) $sogobar1 = BAR / (10 / $two);

		return $sogobar + $sogobar1;
	}
	public function getStressBarWidth($point)
	{
		$one = substr($point, 0, 1);
		$two = substr($point, 1, 1);
		$sogobar = BAR * ($one - 2);
		$sogobar1 = 0;
		if ($point == 80) $sogobar = $sogobar - 5;
		if ($sogobar <= 0) $sogobar = 5;
		if ($two > 0) $sogobar1 = BAR / (10 / $two);

		return $sogobar + $sogobar1;
	}
	public function getLevel($p)
	{
		if ($p >= 65) {
			$lv = 5;
		} else
		if ($p >= 55) {
			$lv = 4;
		} else
		if ($p >= 45) {
			$lv = 3;
		} else
		if ($p >= 35) {
			$lv = 2;
		} else
		if ($p >= 20) {
			$lv = 1;
		}
		return $lv;
	}



	public function getSougoCalc()
	{
		//$this->score 行動価値総合
		//$this->rs_sougo  感情能力総合
		$ave = ($this->score + $this->rs_sougo) / 2;

		error_log("\n[" . date('Y-m-d H:i:s') . "][" . $this->exam_id . "]" . "行動価値総合:" . $this->score, 3, D_PATH_HOME . "/logs/debugPDF.log");
		error_log("\n[" . date('Y-m-d H:i:s') . "][" . $this->exam_id . "]" . "感情能力総合:" . $this->rs_sougo, 3, D_PATH_HOME . "/logs/debugPDF.log");
		error_log("\n[" . date('Y-m-d H:i:s') . "][" . $this->exam_id . "]" . "(行動価値総合+感情能力総合)/2:" . $ave, 3, D_PATH_HOME . "/logs/debugPDF.log");

		//$lv = $this->rs_sougolv;
		$lv = $this->toplevel;
		//$this->judge=$lv;
		$this->ave = $ave;
		error_log("[" . date('Y-m-d H:i:s') . "][" . $this->exam_id . "]" . "レベル:" . $lv, 3, D_PATH_HOME . "/logs/debugPDF.log");

		switch ($lv) {
			case "1":
				if ($ave < 35) {
					$sougoP = $ave;
				} else {
					if ($this->rs_sougo >= 35 and $this->score >= 35) {
						if ($this->rs_sougo >= $this->score) {
							$sougoP = 34.9;
						} else {
							$sougoP = 34.8;
						}
					} elseif ($this->rs_sougo >= $this->score) {
						$sougoP = 34.7;
					} else {
						$sougoP = 34.6;
					}
				}
				break;
			case "2":

				$sougoP = $ave * 1 / 3 + 25;
				break;
			case "3":
				$sougoP = $ave * 2 / 5 + 29;
				break;
			case "4":
				$sougoP = $ave * 1 / 2 + 30;
				break;
			case "5":
				if ($ave >= 65) {
					if ($ave + 10 >= 80) {
						$sougoP = 80;
					} else {
						$sougoP = $ave + 5;
					}
				} else {
					$sougoP = $ave + 5;
				}
				break;
		}
		error_log("\n[" . date('Y-m-d H:i:s') . "][" . $this->exam_id . "]" . "総合ポイント:" . round($sougoP, 1), 3, D_PATH_HOME . "/logs/debugPDF.log");
		$this->sougoP = round($sougoP, 1);
	}
	public function getJudgeCalc()
	{

		$lv = 2;
		$this->color = "yellow";
		if ($this->rs_sougo >= 60 && $this->score >= 60) {
			$lv = 5;
		} elseif ($this->rs_sougo < 40 && $this->score < 40) {
			$lv = 1;
			$this->color = "red";
		} elseif ($this->rs_sougo >= 50 && $this->score >= 50) {
			$lv = 4;
			$this->color = "gray";
		} elseif ($this->rs_sougo >= 40 && $this->score >= 40) {
			$lv = 3;
			$this->color = "aqua";
		}
		return $lv;
	}
	public function getStX()
	{
		$keyp = array(-20, -10, 0, 10, 20, 31, 41);
		$this->tenX = substr($this->rs_sougo, 0, 1);
		$this->oneX = substr($this->rs_sougo, 1, 1);
		$ten = $this->tenX;
		if ($ten == 2) {
			$keypt = $keyp[0];
		} else
		if ($ten == 3) {
			$keypt = $keyp[1];
		} else
		if ($ten == 4) {
			$keypt = $keyp[2];
		} else
		if ($ten == 5) {
			$keypt = $keyp[3];
		} else
		if ($ten == 6) {
			$keypt = $keyp[4];
		} else
		if ($ten == 7) {
			$keypt = $keyp[5];
		} else
		if ($ten == 8) {
			$keypt = $keyp[6];
		}
		return $keypt;
	}
	public function getStY()
	{
		$keyp = array(0, 2, 4, 6, 7.8, 9.8, 11.6);
		$this->tenY = substr($this->score, 0, 1);
		$this->oneY = substr($this->score, 1, 1);
		$ten = $this->tenY;
		if ($ten == 2) {
			$keypt = $keyp[0];
		} else
		if ($ten == 3) {
			$keypt = $keyp[1];
		} else
		if ($ten == 4) {
			$keypt = $keyp[2];
		} else
		if ($ten == 5) {
			$keypt = $keyp[3];
		} else
		if ($ten == 6) {
			$keypt = $keyp[4];
		} else
		if ($ten == 7) {
			$keypt = $keyp[5];
		} else
		if ($ten == 8) {
			$keypt = $keyp[6];
		}
		return $keypt;
	}

	public function getUserDataParts($where)
	{
		$tid = $where['test_id'];
		$cid = $where['customer_id'];
		$pid = $where['partner_id'];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " name,type,weight,w1,w2,w3,w4,w5,w6,w7,w8,w9,w10,w11,w12,sd,ave,stress_flg ,download_excel";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " test_id=" . $tid . " AND ";
		$sql .= " customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " partner_id=" . $pid . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " ORDER BY weight";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$i = 0;
		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
	}

	public function getExceltype($where)
	{
		$id = $where['id'];

		$sql = "";
		$sql = "SELECT ";
		$sql .= " excel_type";
		$sql .= " FROM ";
		$sql .= " t_test ";
		$sql .= " WHERE ";
		$sql .= " id=" . $id . "";
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		return $result["excel_type"];
	}

	public function getUserDataExcel($where, $flg = "")
	{
		$tid = $where['test_id'];
		$cid = $where['customer_id'];
		$pid = $where['partner_id'];
		$complete_flg = $where['complete_flg'];
		$sql = "";
		$sql = "SELECT";
		//$sql .= " test_id,exam_id,type,name,kana,birth,exam_state,level,score,pass,memo1,memo2,complete_flg ,exam_date ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=" . $tid . " AND ";
		$sql .= " customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " partner_id=" . $pid . " AND ";
		}
		if ($complete_flg) {
			$sql .= " complete_flg=" . $complete_flg . " AND ";
		}
		if ($flg) {
			$sql .= " type IN(1,2,12,59,72,82,91) AND ";
		}
		$sql .= " 1=1 ";
		$sql .= " GROUP BY exam_id ";
		$sql .= " ORDER BY number ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$i = 0;
		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
	}

	public function getUserDataExcelBj($where, $parts)
	{
		$tid  = $where['testgrp_id'];
		$cid  = $where['customer_id'];
		$pid  = $where['partner_id'];
		$type = $where['type'];
		$complete_flg = $where['complete_flg'];
		$sql = "";
		$sql = "SELECT ";
		$sql .= $parts;
		$sql .= " FROM ";
		$sql .= " t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " testgrp_id=" . $tid . " AND ";
		$sql .= " customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " partner_id=" . $pid . " AND ";
		}
		if ($complete_flg) {
			$sql .= " complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " type=" . $type . "  ";
		$sql .= " ORDER BY number ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$i = 0;
		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
	}
	/*
	public function getUserDataExcelBj($where,$parts){
		$tid  = $where[ 'testgrp_id'  ];
		$cid  = $where[ 'customer_id' ];
		$pid  = $where[ 'partner_id'  ];
		$type = $where[ 'type'        ];
		$complete_flg = $where[ 'complete_flg'  ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= $parts ;
		$sql .= " ,tp.*";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt 
			LEFT JOIN t_pfs as tp ON tp.testpaper_id = tt.id
		";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=".$tid." AND ";
		$sql .= " tt.customer_id=".$cid." AND ";
		if($pid){
			$sql .= " tt.partner_id=".$pid." AND ";
		}
		if($complete_flg){
			$sql .= " tt.complete_flg=".$complete_flg." AND ";
		}
		$sql .= " tt.type=".$type."  ";
		$sql .= " ORDER BY tt.number ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();

		$i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}


		return $rlt;
	}
*/
	public function getUserDataExcelPFS($where)
	{
		$tid  = $where['testgrp_id'];
		$cid  = $where['customer_id'];
		$pid  = $where['partner_id'];
		$type = $where['type'];
		$complete_flg = $where['complete_flg'];
		$sql = "";
		$sql = "SELECT ";
		$sql .=  " tt.*,
			tp.*
		";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt 
			LEFT JOIN t_pfs as tp ON tp.testpaper_id = tt.id
		";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tid . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.type=" . $type . "  ";
		$sql .= " ORDER BY tt.number ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$i = 0;
		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $result;
			$i++;
		}
		return $rlt;
	}


	public function getWeightMaster($where)
	{
		$id  = $where['id'];
		$sql = "
				SELECT 
					e_feel as w1
					,e_cus as w2
					,e_aff as w3
					,e_cntl as w4
					,e_vi as w5
					,e_pos as w6
					,e_symp as w7
					,e_situ as w8
					,e_hosp as w9
					,e_lead as w10
					,e_ass as w11
					,e_adap as w12
					,avg as ave
					,hensa as sd
					,master_name
				FROM
					t_weight_master
				WHERE
					id=" . $id . "
				";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	public function getWeightMasters($where)
	{
		$id = $where['id'];
		$sql = "
				SELECT
					e_feel as w1
					,e_cus as w2
					,e_aff as w3
					,e_cntl as w4
					,e_vi as w5
					,e_pos as w6
					,e_symp as w7
					,e_situ as w8
					,e_hosp as w9
					,e_lead as w10
					,e_ass as w11
					,e_adap as w12
					,avg as ave
					,hensa as sd
					,master_name
				FROM
					t_weight_master
				WHERE
					id=" . $id . "
				";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}


	public function getTestVF4Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}
		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state ";
		$sql .= " ,vfw.w1,vfw.w2,vfw.w3,vfw.w4,vfw.w5,vfw.w6,vfw.w7,vfw.w8,vfw.w9,vfw.w10,vfw.w11,vfw.w12";
		$sql .= " ,vfw.dev1,vfw.dev2,vfw.dev3,vfw.dev4,vfw.dev5,vfw.dev6,vfw.dev7,vfw.dev8,vfw.dev9,vfw.dev10,vfw.dev11,vfw.dev12";
		$sql .= " ,vfw.avg,vfw.std ";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN vf4_member as vfm ON";
		$sql .= " tt.test_id = vfm.test_id AND tt.exam_id=vfm.exam_id ";
		$sql .= " LEFT JOIN vf4_result as vfr ON vfr.mem_id=vfm.id ";
		$sql .= " LEFT JOIN vf4_weight as vfw ON vfr.id=vfw.r_id ";

		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}


	public function getTestVF2Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state ";
		$sql .= " ,vfw.w1,vfw.w2,vfw.w3,vfw.w4,vfw.w5,vfw.w6,vfw.w7,vfw.w8,vfw.w9,vfw.w10,vfw.w11,vfw.w12";
		$sql .= " ,vfw.dev1,vfw.dev2,vfw.dev3,vfw.dev4,vfw.dev5,vfw.dev6,vfw.dev7,vfw.dev8,vfw.dev9,vfw.dev10,vfw.dev11,vfw.dev12";
		$sql .= " ,vfw.avg,vfw.std ";

		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN vf2_member as vfm ON";
		$sql .= " tt.test_id = vfm.test_id AND tt.exam_id=vfm.exam_id ";
		$sql .= " LEFT JOIN vf2_result as vfr ON vfr.mem_id=vfm.id ";
		$sql .= " LEFT JOIN vf2_weight as vfw ON vfr.id=vfw.r_id ";

		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}


		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}


	public function getTestRsData($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];


		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}
		$type = $data['type'];
		if ($type == 66 || $type == 74) {
			$table0 = "rs3_member";
			$table1 = "rs3_score";
		} else
		if ($type == 47) {
			$table0 = "rs2_member";
			$table1 = "rs2_score";
		} else {
			$table0 = "rs_member";
			$table1 = "rs_score";
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state ";
		$sql .= " ,rs.sougo,rs.yomitori,rs.rikai,rs.sentaku,rs.kirikae,rs.jyoho ";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN " . $table0 . " as rm ON rm.test_id=tt.test_id AND rm.testgrp_id = tt.testgrp_id AND tt.exam_id = rm.exam_id ";
		$sql .= " LEFT JOIN " . $table1 . " as rs ON rm.id=rs.rs_id ";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}



	public function getTestDpData($data, $order = "", $limit = "")
	{

		$tgrp_id      = $data['testgrp_id'];
		$cid          = $data['customer_id'];
		$pid          = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}
		$type = $data['type'];
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state ";
		$sql .= " ,ds.sougo,ds.yomitori,ds.rikai,ds.sentaku,ds.kirikae,ds.jyoho ";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN dp_member as dm ON dm.test_id=tt.test_id AND dm.testgrp_id = tt.testgrp_id AND tt.exam_id = dm.exam_id ";
		$sql .= " LEFT JOIN dp_score as ds ON dm.id=ds.dp_id ";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getTestDpSecData($data, $order = "", $limit = "")
	{

		$tgrp_id = $data['testgrp_id'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}
		$type = $data['type'];
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state ";
		$sql .= " ,ds.sougo,ds.yomitori,ds.rikai,ds.sentaku,ds.kirikae,ds.jyoho ";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN dp_sec_member as dm ON dm.test_id=tt.test_id AND dm.testgrp_id = tt.testgrp_id AND tt.exam_id = dm.exam_id ";
		$sql .= " LEFT JOIN dp_sec_score as ds ON dm.id=ds.dp_id ";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}


		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}


	public function getTestMVData($data, $order = "", $group = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}
		//スコアカラム
		for ($i = 1; $i <= 25; $i++) {
			$scores .= ",score" . $i;
		}
		$type = $data['type'];
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state ";
		$sql .= $scores;
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN mv_member as mm ON mm.test_id=tt.test_id AND mm.testgrp_id = tt.testgrp_id AND tt.exam_id = mm.exam_id ";
		$sql .= " LEFT JOIN mv_score as ms ON mm.id=ms.mv_id ";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $group . " ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getTestMV2Data($data, $order = "", $group = "", $limit = "")
	{
		$tgrp_id      = $data['testgrp_id'];
		$cid          = $data['customer_id'];
		$pid          = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}
		//スコアカラム
		for ($i = 1; $i <= 25; $i++) {
			$scores .= ",score" . $i;
		}
		$type = $data['type'];
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state ";
		$sql .= $scores;
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN mv2_member as mm ON mm.test_id=tt.test_id AND mm.testgrp_id = tt.testgrp_id AND tt.exam_id = mm.exam_id ";
		$sql .= " LEFT JOIN mv2_score as ms ON mm.id=ms.mv_id ";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $group . " ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}


	public function getMathData($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state, ";
		$sql .= " ms.* ";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN math_member as mm ON";
		$sql .= " tt.test_id = mm.test_id AND tt.exam_id=mm.exam_id ";

		$sql .= " LEFT JOIN math_score as ms ON ms.math_id=mm.id ";

		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getMath2Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state, ";
		$sql .= " ms.* ";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN math2_member as mm ON";
		$sql .= " tt.test_id = mm.test_id AND tt.exam_id=mm.exam_id ";

		$sql .= " LEFT JOIN math2_score as ms ON ms.math_id=mm.id ";

		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getNl3Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state,tt.fin_exam_date, ";
		$sql .= " nl3s.score1 ";
		$sql .= " ,nl3s.score1 ";
		$sql .= " ,nl3s.score2 ";
		$sql .= " ,nl3s.score3 ";
		$sql .= " ,nl3s.score4 ";
		$sql .= " ,nl3s.score5 ";
		$sql .= " ,nl3s.score6 ";
		$sql .= " ,nl3s.score7 ";
		$sql .= " ,nl3s.score8 ";
		$sql .= " ,nl3s.score9 ";
		$sql .= " ,nl3s.score10 ";
		$sql .= " ,nl3s.score11 ";
		$sql .= " ,nl3s.score12 ";
		$sql .= " ,nl3s.score13 ";
		$sql .= " ,nl3s.score14 ";
		$sql .= " ,nl3s.score15 ";
		$sql .= " ,nl3s.score16 ";
		$sql .= " ,nl3s.score17 ";
		$sql .= " ,nl3s.score18 ";
		$sql .= " ,nl3s.score19 ";

		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN nl3_member as nl3m ON";
		$sql .= " tt.test_id = nl3m.test_id AND tt.exam_id=nl3m.exam_id ";
		$sql .= " LEFT JOIN nl3_score as nl3s ON nl3s.mv_id=nl3m.id ";

		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;

		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}
	public function getNl2Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];
		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state,tt.fin_exam_date, ";
		$sql .= " nl2s.score1 ";
		$sql .= " ,nl2s.score1 ";
		$sql .= " ,nl2s.score2 ";
		$sql .= " ,nl2s.score3 ";
		$sql .= " ,nl2s.score4 ";
		$sql .= " ,nl2s.score5 ";
		$sql .= " ,nl2s.score6 ";
		$sql .= " ,nl2s.score7 ";
		$sql .= " ,nl2s.score8 ";
		$sql .= " ,nl2s.score9 ";
		$sql .= " ,nl2s.score10 ";
		$sql .= " ,nl2s.score11 ";
		$sql .= " ,nl2s.score12 ";
		$sql .= " ,nl2s.score13 ";
		$sql .= " ,nl2s.score14 ";
		$sql .= " ,nl2s.score15 ";
		$sql .= " ,nl2s.score16 ";
		$sql .= " ,nl2s.score17 ";
		$sql .= " ,nl2s.score18 ";
		$sql .= " ,nl2s.score19 ";

		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN nl2_member as nl2m ON";
		$sql .= " tt.test_id = nl2m.test_id AND tt.exam_id=nl2m.exam_id ";

		$sql .= " LEFT JOIN nl2_score as nl2s ON nl2s.mv_id=nl2m.id ";

		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " 1=1 ";
		$sql .= $order;

		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getIQData($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}
		$sql = "";
		$sql = "SELECT ";
		$sql .= "tt.exam_id,tt.exam_date,tt.test_id,tt.exam_state ";
		$sql .= " ,iqsr.language_score,iqsr.math_score";
		$sql .= " FROM t_testpaper as tt ";
		$sql .= " LEFT JOIN iq_member as iqm ON";
		$sql .= " tt.test_id = iqm.test_id AND tt.exam_id=iqm.exam_id ";
		//			$sql .= " LEFT JOIN iq_sec as iqsc ON iqsc.iq_id=iqm.id ";
		$sql .= " LEFT JOIN iq_score as iqsr ON iqsr.iq_id=iqm.id ";

		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $tgrp_id . " AND ";
		$sql .= " tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}

		$sql .= " 1=1 ";
		$sql .= $order;
		if ($limit) {
			$sql .= " limit " . $of . " offset " . $li . " ";
		}

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}
	public function getMetData($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					ms.*
					FROM
					t_testpaper as tt
					INNER JOIN (SELECT id,testgrp_id,exam_id FROM met_member) as mm ON tt.testgrp_id = mm.testgrp_id AND tt.exam_id=mm.exam_id
					INNER JOIN (SELECT *  FROM met_score) as ms ON ms.met_id = mm.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getMmsData($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					ms.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM mms_member) as mm ON tt.testgrp_id = mm.testgrp_id AND tt.exam_id=mm.exam_id
					LEFT JOIN (SELECT *  FROM mms_result) as ms ON ms.mms_id = mm.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getMEAData($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					ms.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM mea_member) as mm ON tt.testgrp_id = mm.testgrp_id AND tt.exam_id=mm.exam_id
					LEFT JOIN (SELECT *  FROM mea_result) as ms ON ms.mid = mm.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}


	public function getElanData($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					es.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM elan_member) as em ON tt.testgrp_id = em.testgrp_id AND tt.exam_id=em.exam_id
					LEFT JOIN (SELECT *  FROM elan_sec) as es ON es.elan_id = em.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}


	public function getElan2Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					es.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM elan2_member) as em ON tt.testgrp_id = em.testgrp_id AND tt.exam_id=em.exam_id
					LEFT JOIN (SELECT *  FROM elan2_sec) as es ON es.elan_id = em.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}
	public function getElanSData($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					es.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM elans_member) as em ON tt.testgrp_id = em.testgrp_id AND tt.exam_id=em.exam_id
					LEFT JOIN (SELECT *  FROM elans_sec) as es ON es.elan_id = em.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}
	public function getElanS2Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					es.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM elans2_member) as em ON tt.testgrp_id = em.testgrp_id AND tt.exam_id=em.exam_id
					LEFT JOIN (SELECT *  FROM elans2_sec) as es ON es.elan_id = em.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getElan6Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					es.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM elan6_member) as em ON tt.testgrp_id = em.testgrp_id AND tt.exam_id=em.exam_id
					LEFT JOIN (SELECT *  FROM elan6_sec) as es ON es.elan_id = em.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}
	public function getElan5Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					es.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM elan5_member) as em ON tt.testgrp_id = em.testgrp_id AND tt.exam_id=em.exam_id
					LEFT JOIN (SELECT *  FROM elan5_sec) as es ON es.elan_id = em.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}



	public function getElan4Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					es.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM elan4_member) as em ON tt.testgrp_id = em.testgrp_id AND tt.exam_id=em.exam_id
					LEFT JOIN (SELECT *  FROM elan4_sec) as es ON es.elan_id = em.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}

	public function getElan3Data($data, $order = "", $limit = "")
	{
		$tgrp_id = $data['testgrp_id'];
		$type    = $data['type'];
		$cid     = $data['customer_id'];
		$pid     = $data['partner_id'];
		$complete_flg = $data['complete_flg'];

		if ($limit) {
			$li = $limit['offset'];
			$of = $limit['limit'];
		}

		if ($order) {
			$order = "ORDER BY tt." . $order;
		}

		$sql = "
					SELECT
					tt.exam_id,
					tt.sex,
					tt.exam_state,
					tt.complete_flg,
					tt.exam_date,
					tt.start_time,
					tt.exam_time,
					tt.pass,
					tt.memo1,
					tt.memo2,
					es.*
					FROM
					t_testpaper as tt
					LEFT JOIN (SELECT id,testgrp_id,exam_id FROM elan3_member) as em ON tt.testgrp_id = em.testgrp_id AND tt.exam_id=em.exam_id
					LEFT JOIN (SELECT *  FROM elan3_sec) as es ON es.elan_id = em.id
					WHERE
					tt.testgrp_id=" . $tgrp_id . " AND
					tt.customer_id=" . $cid . " AND ";
		if ($pid) {
			$sql .= " tt.partner_id=" . $pid . " AND ";
		}
		$sql .= " tt.type=" . $type . " AND ";
		if ($complete_flg) {
			$sql .= " tt.complete_flg=" . $complete_flg . " AND ";
		}
		$sql .= " tt.disabled = 0 AND ";
		$sql .= " 1=1 ";
		$sql .= $order;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rst =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$rlt[$i] = $rst;
			$i++;
		}
		return $rlt;
	}


	public function getFinExamDate($where)
	{
		$testgrp_id  = $where['testgrp_id'];
		$exam_id     = $where['exam_id'];
		$sql = "";
		$sql = "SELECT max(exam_date) as exam_date";
		$sql .= " ,max(fin_exam_date) as fin_exam_date";
		$sql .= " FROM t_testpaper ";
		$sql .= " WHERE ";
		$sql .= " exam_id = '" . $exam_id . "' AND ";
		$sql .= " testgrp_id = " . $testgrp_id;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result =  $stmt->fetch(PDO::FETCH_ASSOC);

		if ($result['fin_exam_date'] == "0000-00-00 00:00:00") {
			$date = $result['exam_date'];
		} else {
			$ex = substr($result['fin_exam_date'], 0, 10);
			$fdate = preg_replace("/\-/", "/", $ex);
			$date = $fdate;
		}
		return $date;
	}

	public function getElementData($where)
	{
		$uid = $where['uid'];
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_element ";
		$sql .= " WHERE ";
		$sql .= " uid=" . $uid;


		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$result =  $stmt->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getBsa($where)
	{
		$sql = "
				SELECT
					*
				FROM
					bsa_member as b
					LEFT JOIN bsa_score as bs ON bs.mv_id = b.id
				WHERE
					b.testgrp_id = " . $where['testgrp_id'] . "
				";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rlt =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$rlt['exam_id']] = $rlt;
			$i++;
		}

		return $list;
	}
	public function getAccData($where)
	{
		$testgrp_id = $where['testgrp_id'];
		$type = $where['type'];
		$customer_id = $where['customer_id'];
		$partner_id = $where['partner_id'];
		$complete_flg = $where['complete_flg'];

		$sql = "SELECT "
			. "tt.test_id,tt.exam_id,tt.type,tt.name,tt.kana,tt.birth,tt.exam_state,tt.level,tt.score,tt.pass,tt.memo1,tt.memo2,tt.complete_flg"
			. ",a1.id,a1.counter"
			. ",a2.dev1,a2.dev2,a2.dev3,a2.dev4,a2.dev5,a2.dev6,a2.dev7,a2.dev8,a2.dev9,a2.dev10,a2.dev11,a2.dev12,a2.dev13 "
			. " FROM "
			. " t_testpaper as tt "
			. " LEFT JOIN aac_member as a1 ON a1.testgrp_id=tt.testgrp_id AND tt.exam_id = a1.exam_id"
			. " LEFT JOIN (SELECT * FROM acc_result ORDER BY id DESC) as a2 ON a1.id=a2.acc_id "
			. " WHERE "
			. " tt.testgrp_id=" . $testgrp_id . ""
			. " AND tt.type=" . $type . "";
		if ($complete_flg > 0) {
			$sql .= " AND tt.complete_flg = " . $complete_flg;
		}
		$sql .= " GROUP BY tt.id ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$i = 0;
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$i] = $rlt;

			$dev1 = round($rlt['dev1'], 1);
			$dev2 = round($rlt['dev2'], 1);
			$dev3 = round($rlt['dev3'], 1);
			$dev4 = round($rlt['dev4'], 1);
			$dev5 = round($rlt['dev5'], 1);
			$dev6 = round($rlt['dev6'], 1);
			$dev7 = round($rlt['dev7'], 1);
			$dev8 = round($rlt['dev8'], 1);
			$dev9 = round($rlt['dev9'], 1);
			$dev10 = round($rlt['dev10'], 1);
			$dev11 = round($rlt['dev11'], 1);
			$dev12 = round($rlt['dev12'], 1);
			$dev13 = round($rlt['dev13'], 1);
			if ($dev1 > 0 && $dev1 < 20) {
				$dev1 = 20;
			} elseif ($dev1 > 80) {
				$dev1 = 80;
			}
			if ($dev2 > 0 && $dev2 < 20) {
				$dev2 = 20;
			} elseif ($dev2 > 80) {
				$dev2 = 80;
			}
			if ($dev3 > 0 && $dev3 < 20) {
				$dev3 = 20;
			} elseif ($dev3 > 80) {
				$dev3 = 80;
			}
			if ($dev4 > 0 && $dev4 < 20) {
				$dev4 = 20;
			} elseif ($dev4 > 80) {
				$dev4 = 80;
			}
			if ($dev5 > 0 && $dev5 < 20) {
				$dev5 = 20;
			} elseif ($dev5 > 80) {
				$dev5 = 80;
			}
			if ($dev6 > 0 && $dev6 < 20) {
				$dev6 = 20;
			} elseif ($dev6 > 80) {
				$dev6 = 80;
			}
			if ($dev7 > 0 && $dev7 < 20) {
				$dev7 = 20;
			} elseif ($dev7 > 80) {
				$dev7 = 80;
			}
			if ($dev8 > 0 && $dev8 < 20) {
				$dev8 = 20;
			} elseif ($dev8 > 80) {
				$dev8 = 80;
			}
			if ($dev9 > 0 && $dev9 < 20) {
				$dev9 = 20;
			} elseif ($dev9 > 80) {
				$dev9 = 80;
			}
			if ($dev10 > 0 && $dev10 < 20) {
				$dev10 = 20;
			} elseif ($dev10 > 80) {
				$dev10 = 80;
			}
			if ($dev11 > 0 && $dev11 < 20) {
				$dev11 = 20;
			} elseif ($dev11 > 80) {
				$dev11 = 80;
			}
			if ($dev12 > 0 && $dev12 < 20) {
				$dev12 = 20;
			} elseif ($dev12 > 80) {
				$dev12 = 80;
			}
			if ($dev13 > 0 && $dev13 < 20) {
				$dev13 = 20;
			} elseif ($dev13 > 80) {
				$dev13 = 80;
			}
			if ($dev1 > 0) $list[$i]['dev1'] = sprintf("%-2.1f", $dev1);
			if ($dev2 > 0) $list[$i]['dev2'] = sprintf("%-2.1f", $dev2);
			if ($dev3 > 0) $list[$i]['dev3'] = sprintf("%-2.1f", $dev3);
			if ($dev4 > 0) $list[$i]['dev4'] = sprintf("%-2.1f", $dev4);
			if ($dev5 > 0) $list[$i]['dev5'] = sprintf("%-2.1f", $dev5);
			if ($dev6 > 0) $list[$i]['dev6'] = sprintf("%-2.1f", $dev6);
			if ($dev7 > 0) $list[$i]['dev7'] = sprintf("%-2.1f", $dev7);
			if ($dev8 > 0) $list[$i]['dev8'] = sprintf("%-2.1f", $dev8);
			if ($dev9 > 0) $list[$i]['dev9'] = sprintf("%-2.1f", $dev9);
			if ($dev10 > 0) $list[$i]['dev10'] = sprintf("%-2.1f", $dev10);
			if ($dev11 > 0) $list[$i]['dev11'] = sprintf("%-2.1f", $dev11);
			if ($dev12 > 0) $list[$i]['dev12'] = sprintf("%-2.1f", $dev12);
			if ($dev13 > 0) $list[$i]['dev13'] = sprintf("%-2.1f", $dev13);
			$i++;
		}

		return $list;
	}
	public function getTestTypes($where)
	{
		$test_id = $where['testid'];
		$sql = "SELECT "
			. " type ,name"
			. " FROM "
			. " t_test "
			. " WHERE "
			. " test_id=" . $test_id;

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		$i = 0;
		$list = array();
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$i] = $rlt;
			$i++;
		}
		return $list;
	}

	public function getTestNameData($where)
	{
		$sql = ""
			. "SELECT name FROM t_user "
			. " WHERE "
			. " id=" . $where['id'];

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$rlt = $stmt->fetch(PDO::FETCH_ASSOC);

		return $rlt;
	}



	public function getNSPE($where, $flg = "1")
	{
		$table1 = "nspe" . $flg . "_member";
		$table2 = "nspe" . $flg . "_sec";

		$test_id = $where['test_id'];

		$sql = "
				SELECT 
					* 
				FROM (
					SELECT 
						MAX(nm.id) as maxid,
						nm.exam_id
					FROM 
						" . $table1 . " as nm 
						LEFT JOIN " . $table2 . " as ns ON nm.id = ns.nspe" . $flg . "_id 
					WHERE 
						nm.testgrp_id=" . $test_id . " 
					GROUP BY nm.exam_id
				) as a 
					LEFT JOIN " . $table2 . " as ns2 ON a.maxid = ns2.nspe" . $flg . "_id 
			";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$list = [];
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$rlt['exam_id']] = $rlt;
		}

		return $list;
	}

	public function getAMP($where)
	{
		$test_id = $where['test_id'];
		$partner_id = $where['partner_id'];
		$customer_id = $where['customer_id'];
		$type = 83;
		$sql = "";
		$sql = "SELECT ";
		$sql .= " tt.name, ";
		$sql .= " tt.kana, ";
		$sql .= " tt.birth, ";
		$sql .= " tt.sex, ";
		$sql .= " tt.exam_state, ";
		$sql .= " tt.start_time, ";
		$sql .= " tt.exam_time, ";
		$sql .= " tt.number,";
		$sql .= " tt.exam_id,";
		$sql .= " tt.pass,";
		$sql .= " tt.ampdate,";
		$sql .= " (CASE ";
		$sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
		$sql .= " r.*,";
		$sql .= " w.*";
		$sql .= " FROM ";
		$sql .= " t_testpaper as tt ";
		$sql2 = " 
			SELECT * FROM amp WHERE id IN (
				SELECT MAX( id ) AS id
				FROM amp
				GROUP BY testpaper_id
				)
			";
		$sql .= " LEFT JOIN (" . $sql2 . ") as r ON r.testpaper_id=tt.id  ";

		$sql .= " LEFT JOIN amp_ans as w ON w.amp_id=r.id ";
		$sql .= " WHERE ";
		$sql .= " tt.testgrp_id=" . $test_id . " AND ";
		$sql .= " tt.partner_id=" . $partner_id . " AND ";
		$sql .= " tt.customer_id=" . $customer_id . " AND ";
		$sql .= " tt.type=" . $type . " AND ";
		$sql .= " 1=1 ";
		$sql .= " ORDER BY tt.number ";

		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		$list = [];
		while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$list[$rlt['exam_id']] = $rlt;
		}
		return $list;
	}

	public function getAmpPdf($where)
	{
		$sql = "
				SELECT 
					aa.*
				FROM
					amp as a 
					LEFT JOIN amp_ans as aa ON aa.amp_id = (SELECT MAX(id) FROM amp where testpaper_id=:testpaper_id)
				WHERE
					a.testpaper_id = :testpaper_id
			";
		$stmt = $this->db->prepare($sql);
		$stmt->bindValue(":testpaper_id", $where['testpaper_id']);
		$stmt->bindValue(":testpaper_id", $where['testpaper_id']);

		$stmt->execute();
		$rlt = $stmt->fetch(PDO::FETCH_ASSOC);
		return $rlt;
	}
}
