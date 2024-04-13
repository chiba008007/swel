<?PHP
//----------------------------------
//パートナー情報一覧管理画面メソッド
//
//
//----------------------------------
class ptnListMethod extends method{
	
	public function getLicense($ptid,$total){

		$sql .= "SELECT COUNT( * ) AS cnt, ";
		$sql .= " type ";
		$sql .= " ,COUNT(";
		$sql .= " CASE WHEN exam_state = 2 THEN 1 ELSE NULL END ) as syori";
		$sql .= " FROM t_testpaper";
		$sql .= " WHERE partner_id =".$ptid[ 'id' ];
		$sql .= " AND temp_flg =0";
		$sql .= " GROUP BY TYPE ";
		$sql .= " ORDER BY TYPE +0";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                $rlt = array();
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $rlt[ $result[ 'type' ]] = $result;
                    $rlt[ $result[ 'type' ] ][ 'sale'  ] = $total[ $result[ 'type' ] ] - $result[ 'cnt' ];
                    $rlt[ $result[ 'type' ] ][ 'zan'   ] = $result[ 'cnt'  ] - $result[ 'syori' ];
                    $rlt[ $result[ 'type' ] ][ 'total' ] = $total[ $result[ 'type' ] ];
                    $i++;
                }
                

		//if(!$rlt){

                    $sql = "";
                    $sql = "SELECT ";
                    $sql .= " license_parts ";
                    $sql .= " FROM t_user ";
                    $sql .= " WHERE ";
                    $sql .= " id=".$ptid[ 'id' ]." AND ";
                    $sql .= " 1=1 ";

                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $ex = explode(":",$result["license_parts"]);

                    $i=1;
                    foreach($ex as $key=>$val){
                        if($val){
                            if(!$rlt[ $i ][ 'total' ]) $rlt[ $i ][ 'total' ] = $val;
                            if(!$rlt[ $i ][ 'sale'  ]) $rlt[ $i ][ 'sale'  ] = $val;
                        }
                        $i++;
                    }
		//}
		return $rlt;
	}
	
	
	public function getUserDataPartner($limit="",$bill="",$flg = ""){

		$li = $limit[ 'offset'  ];
		$of = $limit[ 'limit'   ];

		$name = $bill[ 'name' ];
		$sort = $bill[ 'sort' ];
		$partner_id = $bill[ 'id' ];
		$basetype = $bill[ 'basetype' ];
		$sql = "";
		$sql .= " SELECT a.* FROM (";
		$sql .= "SELECT t.id, tt.exam_id, t.license, t.name, t.license_parts, t.user_status, t.registtime, t.customer_display, ";

		$sql .= "  COUNT( ";
		$sql .= " CASE WHEN tt.exam_state IN(0,1,2) AND tt.disabled=0 AND tt.del=0 AND tt.temp_flg = 0 ";
		$sql .= " THEN 1 ";
		$sql .= " ELSE NULL ";
		$sql .= " END ) ";
		$sql .= " as tester ";
		$sql .= " ,COUNT( tt.id ) - ";
		$sql .= " COUNT( ";
		$sql .= " CASE WHEN tt.exam_state ";
		$sql .= " IN ( 1, 2 ) ";
		$sql .= " AND tt.disabled =0 ";
		$sql .= " AND tt.del =0 ";
		$sql .= " THEN 1 ";
		$sql .= " ELSE NULL ";
		$sql .= " END ) ";
		$sql .= " - ";
		$sql .= " COUNT( ";
		$sql .= " CASE WHEN tt.exam_state ";
		$sql .= " IN ( 0,1,2 ) ";
		$sql .= " AND tt.disabled =1 ";
		$sql .= " AND tt.del =1 ";
		$sql .= " THEN 1  ";
		$sql .= " ELSE NULL ";
		$sql .= " END ) ";
		$sql .= " AS zan ";

		$sql .= ", COUNT( ";
		$sql .= " CASE WHEN tt.exam_state =2 ";
		$sql .= " THEN 2 ";
		$sql .= " ELSE NULL ";
		$sql .= " END ) AS syori ";
		$sql .= " FROM t_user AS t ";
		$sql .= " LEFT JOIN (
					SELECT customer_id,temp_flg,exam_state,disabled,del,id,exam_id FROM t_testpaper 
						WHERE
					partner_id=".$partner_id."
				)  AS tt ON t.id = tt.customer_id AND  tt.temp_flg = 0 ";
		$sql .= " WHERE  ";
		$sql .= " t.partner_id=".$partner_id ;
		$sql .= " AND t.del = '0' ";
		if($basetype != 1){
			$sql .= " AND t.customer_display = '1' ";
		}
		if($bill && $name){
			$sql .= " AND t.name LIKE '%".$name."%'";
		}
		$sql .= " GROUP BY t.id ";
		
		$sql .= " ORDER BY  t.registtime DESC ";

		$sql .= " ) as a ";
		$sql .= " ORDER BY a.customer_display desc ,";
		if($sort == 3){ $sql .= "  a.zan ASC ";
		}else if($sort == 4){ $sql .= "  a.zan DESC ";
		}else if($sort == 2){ $sql .= "  a.registtime ASC ";
		}else{
			$sql .= "  a.registtime DESC ";
		}
		if($limit){
			$sql .= " limit ".$of." offset ".$li." ";
		}
if($_REQUEST[ 'aaa' ]){
	print $sql;
	exit();
}

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
		if($flg == "row"){
                        $row = $stmt->rowCount();
			return $row;
		}
                
                $i=0;
                $list = array();
                while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $list[$i] = $rlt;
			$i++;
                }
		return $list;
 
	}

	public function deleteTbl($where){
		$id = $where[ 'id' ];
		$partner_id = $where[ 'partner_id' ];
		$sql = "";
		$sql = "DELETE FROM t_user ";
		$sql .= " WHERE ";
		$sql .= " id=".$id." AND ";
		$sql .= " partner_id=".$partner_id;
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
	}

	public function getUserRow($where){
		$sql = "
			SELECT count(t.id) as cnt FROM t_user AS t  WHERE t.partner_id=:partner_id AND t.del = '0' 
		";
		$prepare = $this->db->prepare($sql);
		$prepare->bindValue(':partner_id', $where[ 'id' ], PDO::PARAM_INT);
		$prepare->execute();
		$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
		return $result[0]['cnt'];
	}

	//--------------------------------
	//重みデータ取得
	//---------------------------------
	public function getWeight($where){
		$uid = $where[ 'uid' ];
		$sql = "";
		$sql = "SELECT ";
		$sql .= " * ";
		$sql .= " FROM ";
		$sql .= " t_user_weight ";
		$sql .= " WHERE  ";
		$sql .= " uid=".$uid;
		
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                 
		return $result;
	}


	public function getUserDatas($table,$data){

		if(count($data)){
			foreach($data as $key=>$val){
				$where .= "AND ".$key."= '".$val."' ";
				
			}
			$where = preg_replace("/^AND/","",$where);
		}
		
		$sql = "";
		$sql = "SELECT *  FROM ".$table." ";
		if($where){
			$sql .= " WHERE ".$where;
		}

                
		$stmt = $this->db->prepare($sql);
                $stmt->execute();
                $rlt = array();
                $i=0;
		while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			$rlt[$i] = $result;
			$i++;
		}

		return $rlt;
	}


	public function getInfomation($id = ""){
		$now = sprintf("%04d-%02d-%02d",date('Y'),date('m'),date('d'));
		$sql = "";
		$sql = "SELECT";
		$sql .= " i.* ,h.id as hid ";
		$sql .= " FROM ";
		$sql .= " information_tbl as i "
                        . " LEFT JOIN information_hidden as h ON i.id = h.infoid AND h.uid = ".$id;
		$sql .= " WHERE ";
		$sql .= " i.disp_status IN (1,3) AND ";
		$sql .= " i.date1 <= '".$now."' AND ";
		$sql .= " i.date2 >= '".$now."' AND "
                        . "h.id IS NULL ";
                
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $i=0;
                $rlt = array();
                while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    //disp_id_listのチェック
                    $disp = $result[ 'disp_id_list' ];
                    if($result[ 'disp_id_list' ]){
                        $ex = explode(":",$disp);
                        if(in_array($id,$ex)){
                            $rlt[$i] = $result;
                        }
                    }else{
                            $rlt[$i] = $result;
                    }
                    $i++;
                }
		return $rlt;
	}

}
?>
