<?php

//----------------------------------
//ROWメソッド
//
//
//----------------------------------
class rowMethod extends method
{
    public function __construct($id = "")
    {
        $pdo = new PDO("mysql:host=".MOBILE_DSN.";dbname=".DB_NAME.";charset=utf8;", MOBILE_USR, MOBILE_PASS);
        $this->db=$pdo;
        $this->eir_id = $id;
    }
    public function rowMethod($id)
    {
        $this->eir_id = $id;
    }

    public function getTestType($where, $atype)
    {
        $eir_id = $where[ 'eir_id' ];
        $sql = "";
        $sql = "SELECT ";
        $sql .= " type ";
        $sql .= " FROM ";
        $sql .= " t_test  ";
        $sql .= " WHERE ";
        $sql .= " eir_id=".$eir_id." ";
        $sql .= " GROUP BY type ";
        $sql .= " ORDER BY type+0 ";
        //$r = mysql_query($sql );
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $list = array();
        while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($rlt[ 'type' ]) {
                $list[$i][ 'type'   ] = $atype[$rlt[ 'type' ]];
                $list[$i][ 'typeid' ] = $rlt[ 'type' ];
            }
            $i++;
        }
        return $list;
    }

    public function getAMPRowData($where)
    {
        $type = $where[ 'type' ];
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.* ,t.name as test_name,u.name as partner_name,u2.name as customer_name ";
        $sql .= " ,amp.* ";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
        $sql .= " LEFT JOIN amp as amp ON tt.id = amp.testpaper_id ";
        $sql .= " WHERE ";
        $sql .= " tt.type=".$type." AND ";
        $sql .= " tt.disabled = 0 AND ";
        $sql .= " t.del=0 AND ";
        if ($this->eir_id) {
            $sql .= " t.eir_id = ".$this->eir_id." AND ";
        }
        if ($where[ 'date' ]) {
            $sql .= " tt.exam_date >= '".$where[ 'date' ]."' AND ";
        }
        $sql .= " tt.exam_state = 2 AND ";
        $sql .= " t.temp_flg = 0 AND ";
        $sql .= " 1=1 ";
        $sql .= " GROUP BY tt.testgrp_id, tt.number";
        $sql .= " ORDER BY tt.id ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }

        return $rlt;
    }

    public function getRowData($where)
    {
        $type = $where[ 'type' ];
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.* ,t.name as test_name,u.name as partner_name,u2.name as customer_name ";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
        $sql .= " WHERE ";
        $sql .= " tt.type=".$type." AND ";
        $sql .= " tt.disabled = 0 AND ";
        $sql .= " t.del=0 AND ";
        if ($this->eir_id) {
            $sql .= " t.eir_id = ".$this->eir_id." AND ";
        }
        if ($where[ 'date' ]) {
            $sql .= " tt.exam_date >= '".$where[ 'date' ]."' AND ";
        }
        $sql .= " tt.exam_state = 2 AND ";
        $sql .= " t.temp_flg = 0 AND ";
        $sql .= " 1=1 ";
        $sql .= "ORDER BY  id ";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }
        if ($type == 72) {
            $sql = "
				SELECT 
					*
				FROM
				t_pfs
			";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $pfs = [];
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $pfs[$result[ 'testpaper_id' ]] = $result;
            }

            foreach ($rlt as $key=>$value) {
                $rlt[$key][ 'pfs_sougo' ] = $pfs[$value[ 'id' ]][ 'sougo' ];
                $rlt[$key][ 'pfs_personal' ] = $pfs[$value[ 'id' ]][ 'personal' ];
                $rlt[$key][ 'pfs_state' ] = $pfs[$value[ 'id' ]][ 'state' ];
                $rlt[$key][ 'pfs_job' ] = $pfs[$value[ 'id' ]][ 'job' ];
                $rlt[$key][ 'pfs_image' ] = $pfs[$value[ 'id' ]][ 'image' ];
                $rlt[$key][ 'pfs_positive' ] = $pfs[$value[ 'id' ]][ 'positive' ];
                $rlt[$key][ 'pfs_self' ] = $pfs[$value[ 'id' ]][ 'self' ];
            }
        }

        return $rlt;
    }

    public function get_age($birth)
    {
        $ty = date("Y");
        $tm = date("m");
        $td = date("d");
        list($by, $bm, $bd) = explode('/', $birth);
        $age = $ty - $by;
        if ($tm * 100 + $td < $bm * 100 + $bd) {
            $age--;
        }
        return $age;
    }


    public function getRowDataVF($data)
    {
        $eir_id = $data[ 'eir_id' ];
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.sex,tt.exam_state,tt.exam_date,tt.start_time,tt.exam_time, ";
        $sql .= " tt.memo1,tt.memo2,tt.testgrp_id,tt.type,";
        $sql .= " t.name as test_name,u.name as partner_name,u2.name as customer_name ,t.id as testID";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
        $sql .= " WHERE ";

        $sql .= " tt.disabled = 0 AND ";
        $sql .= " tt.exam_state = 2 AND ";
        $sql .= " t.del=0 AND ";

        $sql .= " t.type=4 AND ";
        $sql .= " u.eir_id = ".$eir_id." AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.type ASC ,tt.id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }
        $j=0;
        for ($k=1;$k<=66;$k++) {
            $vf .= "r.vf".$k.",";
        }
        if (count($rlt)) {
            foreach ($rlt as $key=>$val) {
                $sql = "";
                $sql = "SELECT ";
                //$sql .= " m.id as vf4_memid, ";
                //$sql .= " r.id as rstid ,";
                $sql .= $vf;
                $sql .= " w.w1,w.w2,w.w3,w.w4,w.w5,w.w6,w.w7,w.w8,w.w9,w.w10,w.w11,w.w12 ";
                $sql .= " FROM vf4_member as m";
                $sql .= " LEFT JOIN vf4_result as r ON r.mem_id = m.id ";
                $sql .= " LEFT JOIN vf4_weight as w ON w.r_id = r.id ";
                $sql .= " WHERE ";
                $sql .= " m.test_id = ".$val[ 'testID' ]." AND ";
                $sql .= " m.exam_id = '".$val[ 'exam_id' ]."' ";

                /*
                $r = mysql_query($sql);
                $wt = mysql_fetch_array($r);
                */
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $wt = $stmt->fetch(PDO::FETCH_ASSOC);
                $rlt[ $j ][ 'weight' ] = $wt;
                $j++;
            }
        }
        return $rlt;
    }
       public function getRowDataVF2($data)
       {
           $eir_id = $data[ 'eir_id' ];
           $sql = "";
           $sql = "SELECT ";
           $sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.sex,tt.exam_state,tt.exam_date,tt.start_time,tt.exam_time, ";
           $sql .= " tt.memo1,tt.memo2,tt.testgrp_id,tt.type,";
           $sql .= " t.name as test_name,u.name as partner_name,u2.name as customer_name ,t.id as testID";
           $sql .= " FROM t_testpaper as tt ";
           $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
           $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
           $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
           $sql .= " WHERE ";

           $sql .= " tt.disabled = 0 AND ";
           $sql .= " tt.exam_state = 2 AND ";
           $sql .= " t.del=0 AND ";

           $sql .= " t.type=33 AND ";
           $sql .= " u.eir_id = ".$eir_id." AND ";
           $sql .= " 1=1 ";
           $sql .= " ORDER BY tt.type ASC ,tt.id ASC";

           $stmt = $this->db->prepare($sql);
           $stmt->execute();
           $i=0;
           $rlt = array();
           while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
               $rlt[$i] = $result;
               if ($result[ 'birth' ]) {
                   $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
               } else {
                   $rlt[ $i ][ 'age' ] = "";
               }
               $i++;
           }
           $j=0;
           for ($k=1;$k<=66;$k++) {
               $vf .= "r.vf".$k.",";
           }
           if (count($rlt)) {
               foreach ($rlt as $key=>$val) {
                   $sql = "";
                   $sql = "SELECT ";
                   //$sql .= " m.id as vf4_memid, ";
                   //$sql .= " r.id as rstid ,";
                   $sql .= $vf;
                   $sql .= " w.w1,w.w2,w.w3,w.w4,w.w5,w.w6,w.w7,w.w8,w.w9,w.w10,w.w11,w.w12 ";
                   $sql .= " FROM vf2_member as m";
                   $sql .= " LEFT JOIN vf4_result as r ON r.mem_id = m.id ";
                   $sql .= " LEFT JOIN vf4_weight as w ON w.r_id = r.id ";
                   $sql .= " WHERE ";
                   $sql .= " m.test_id = ".$val[ 'testID' ]." AND ";
                   $sql .= " m.exam_id = '".$val[ 'exam_id' ]."' ";

                   /*
                   $r = mysql_query($sql);
                   $wt = mysql_fetch_array($r);
                   */
                   $stmt = $this->db->prepare($sql);
                   $stmt->execute();
                   $wt = $stmt->fetch(PDO::FETCH_ASSOC);
                   $rlt[ $j ][ 'weight' ] = $wt;
                   $j++;
               }
           }
           return $rlt;
       }

    public function getRowDpElCsvData()
    {
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.sex,tt.exam_state,tt.exam_date,tt.start_time,tt.exam_time, ";
        $sql .= " tt.memo1,tt.memo2,tt.testgrp_id,tt.type,";
        $sql .= " t.name as test_name,u.name as partner_name,u2.name as customer_name ,t.id as testID";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
        $sql .= " WHERE ";
        $sql .= " tt.disabled = 0 AND ";
        $sql .= " tt.exam_state=2 AND ";
        $sql .= " t.del=0 AND ";
        $sql .= " t.type=5 AND ";
        $sql .= " u.eir_id = ".$this->eir_id." AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.type ASC ,tt.id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }


        for ($i=1;$i<=6;$i++) {
            $secA .= ",dA.sec".$i;
        }
        for ($i=1;$i<=10;$i++) {
            $secB .= ",dA.secB".$i;
        }
        for ($i=1;$i<=22;$i++) {
            $secC .= ",dA.secC".$i;
        }
        for ($i=1;$i<=8;$i++) {
            $secD .= ",dA.secD".$i;
        }
        for ($i=1;$i<=12;$i++) {
            $secE .= ",dA.secE".$i;
        }
        for ($i=1;$i<=5;$i++) {
            $secF .= ",dA.secF".$i;
        }
        for ($i=1;$i<=19;$i++) {
            $secG .= ",dA.secG".$i;
        }
        for ($i=1;$i<=8;$i++) {
            $secH .= ",dA.secH".$i;
        }

        $secA = preg_replace("/^,/", "", $secA);
        $secB = preg_replace("/^,/", "", $secB);
        $secC = preg_replace("/^,/", "", $secC);
        $secD = preg_replace("/^,/", "", $secD);
        $secE = preg_replace("/^,/", "", $secE);
        $secF = preg_replace("/^,/", "", $secF);
        $secG = preg_replace("/^,/", "", $secG);
        $secH = preg_replace("/^,/", "", $secH);

        $ks = 0;
        if (count($rlt)) {
            foreach ($rlt as $key=>$val) {
                $tid     = $val[ 'testID'     ];
                $tgrp_id = $val[ 'testgrp_id' ];
                $ex      = $val[ 'exam_id'    ];

                $sql = "";
                $sql = "SELECT ";
                $sql .= $secA.",".$secB.",".$secC.",".$secD.",";
                $sql .= $secE.",".$secF.",".$secG.",".$secH;
                $sql .= " FROM dp_member as dm";
                $sql .= " LEFT JOIN dp_secA as dA ON dm.id=dA.dp_id ";
                $sql .= " WHERE ";
                $sql .= " dm.test_id = ".$tid." AND ";
                $sql .= " dm.testgrp_id = ".$tgrp_id." AND ";
                $sql .= " dm.exam_id='".$ex."' AND ";
                $sql .= " 1=1 ";
                /*
                $r = mysql_query($sql);
                $result2 = mysql_fetch_array($r);
                $rlt[ $ks ][ 'ans' ] = $result2;
                 *
                 */
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                $rlt[ $ks ][ 'ans' ] = $result2;

                $ks++;
            }
        }
        return $rlt;
    }


    public function getRowNL2Data()
    {
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.sex,tt.exam_state,tt.exam_date,tt.start_time,tt.exam_time, ";
        $sql .= " tt.memo1,tt.memo2,tt.testgrp_id,tt.type,";
        $sql .= " t.name as test_name,u.name as partner_name,u2.name as customer_name ,t.id as testID";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
        $sql .= " WHERE ";

        $sql .= " tt.disabled = 0 AND ";
        $sql .= " tt.exam_state=2 AND ";
        $sql .= " t.del=0 AND ";
        $sql .= " t.type=36 AND ";
        $sql .= " u.eir_id = ".$this->eir_id." AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.type ASC ,tt.id ASC";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }


        $ks = 0;
        if (count($rlt)) {
            foreach ($rlt as $key=>$val) {
                $tid     = $val[ 'testID'     ];
                $tgrp_id = $val[ 'testgrp_id' ];
                $ex      = $val[ 'exam_id'    ];

                $sql = "";
                $sql = "SELECT * ";
                $sql .= " FROM nl2_member as dm";
                $sql .= " LEFT JOIN nl2_sec as dA ON dm.id=dA.mv_id ";
                $sql .= " WHERE ";
                $sql .= " dm.test_id = ".$tid." AND ";
                $sql .= " dm.testgrp_id = ".$tgrp_id." AND ";
                $sql .= " dm.exam_id='".$ex."' AND ";
                $sql .= " 1=1 ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                $rlt[ $ks ][ 'ans' ] = $result2;

                $ks++;
            }
        }
        return $rlt;
    }



    public function getRowMVData()
    {
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.sex,tt.exam_state,tt.exam_date,tt.start_time,tt.exam_time, ";
        $sql .= " tt.memo1,tt.memo2,tt.testgrp_id,tt.type,";
        $sql .= " t.name as test_name,u.name as partner_name,u2.name as customer_name ,t.id as testID";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
        $sql .= " WHERE ";

        $sql .= " tt.disabled = 0 AND ";
        $sql .= " tt.exam_state=2 AND ";
        $sql .= " t.del=0 AND ";
        $sql .= " t.type=6 AND ";
        $sql .= " u.eir_id = ".$this->eir_id." AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.type ASC ,tt.id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }


        $ks = 0;
        if (count($rlt)) {
            foreach ($rlt as $key=>$val) {
                $tid     = $val[ 'testID'     ];
                $tgrp_id = $val[ 'testgrp_id' ];
                $ex      = $val[ 'exam_id'    ];

                $sql = "";
                $sql = "SELECT * ";
                $sql .= " FROM mv_member as dm";
                $sql .= " LEFT JOIN mv_sec as dA ON dm.id=dA.mv_id ";
                $sql .= " WHERE ";
                $sql .= " dm.test_id = ".$tid." AND ";
                $sql .= " dm.testgrp_id = ".$tgrp_id." AND ";
                $sql .= " dm.exam_id='".$ex."' AND ";
                $sql .= " 1=1 ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                $rlt[ $ks ][ 'ans' ] = $result2;

                $ks++;
            }
        }
        return $rlt;
    }

    public function getRowRSData($sec = "")
    {
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.sex,tt.exam_state,tt.exam_date,tt.start_time,tt.exam_time, ";
        $sql .= " tt.memo1,tt.memo2,tt.testgrp_id,tt.type,";
        $sql .= " t.name as test_name,u.name as partner_name,u2.name as customer_name ,t.id as testID";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
        $sql .= " WHERE ";

        $sql .= " tt.disabled = 0 AND ";
        $sql .= " tt.exam_state=2 AND ";
        $sql .= " t.del=0 AND ";
        $sql .= " t.type=".$sec." AND ";
        $sql .= " u.eir_id = ".$this->eir_id." AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.type ASC ,tt.id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }


        $ks = 0;
        if (count($rlt)) {
            foreach ($rlt as $key=>$val) {
                $tid     = $val[ 'testID'     ];
                $tgrp_id = $val[ 'testgrp_id' ];
                $ex      = $val[ 'exam_id'    ];
                $table1 = "rs_member";
                $table2 = "rs_secA";
                if ($sec == 74) {
                    $table1 = "rs3_member";
                    $table2 = "rs3_secA";
                }
                if ($sec == 47) {
                    $table1 = "rs2_member";
                    $table2 = "rs2_secA";
                }
                $sql = "";
                $sql = "SELECT * ";
                $sql .= " FROM ".$table1." as rm";
                $sql .= " LEFT JOIN ".$table2." as rA ON rm.id=rA.rs_id ";
                $sql .= " WHERE ";
                $sql .= " rm.test_id = ".$tid." AND ";
                $sql .= " rm.testgrp_id = ".$tgrp_id." AND ";
                $sql .= " rm.exam_id='".$ex."' AND ";
                $sql .= " 1=1 ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                $rlt[ $ks ][ 'ans' ] = $result2;
                $ks++;
            }
        }
        return $rlt;
    }
    public function getBAGData($sec = "")
    {
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.sex,tt.exam_state,tt.exam_date,tt.start_time,tt.exam_time, ";
        $sql .= " tt.memo1,tt.memo2,tt.testgrp_id,tt.type,";
        $sql .= " t.name as test_name,u.name as partner_name,u2.name as customer_name ,t.id as testID,";
        $sql .= " bs.* ";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";

        $sql .= " LEFT JOIN bag_member as bm ON bm.testgrp_id = tt.testgrp_id AND bm.test_id = tt.test_id AND bm.exam_id=tt.exam_id ";
        $sql .= " LEFT JOIN bag_secA as bs ON bs.dp_id = bm.id ";
        $sql .= " WHERE ";
        $sql .= " tt.disabled = 0 AND ";
        $sql .= " tt.exam_state=2 AND ";
        $sql .= " t.del=0 AND ";
        $sql .= " t.type=".$sec["type"]." AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.type ASC ,tt.id ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }

        // $ks = 0;
        // if (count($rlt)) {
        //     foreach ($rlt as $key=>$val) {
        //         $tid     = $val[ 'testID'     ];
        //         $tgrp_id = $val[ 'testgrp_id' ];
        //         $ex      = $val[ 'exam_id'    ];
        //         $table1 = "rs_member";
        //         $table2 = "rs_secA";
        //         if ($sec == 74) {
        //             $table1 = "rs3_member";
        //             $table2 = "rs3_secA";
        //         }
        //         if ($sec == 47) {
        //             $table1 = "rs2_member";
        //             $table2 = "rs2_secA";
        //         }
        //         $sql = "";
        //         $sql = "SELECT * ";
        //         $sql .= " FROM ".$table1." as rm";
        //         $sql .= " LEFT JOIN ".$table2." as rA ON rm.id=rA.rs_id ";
        //         $sql .= " WHERE ";
        //         $sql .= " rm.test_id = ".$tid." AND ";
        //         $sql .= " rm.testgrp_id = ".$tgrp_id." AND ";
        //         $sql .= " rm.exam_id='".$ex."' AND ";
        //         $sql .= " 1=1 ";

        //         $stmt = $this->db->prepare($sql);
        //         $stmt->execute();
        //         $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
        //         $rlt[ $ks ][ 'ans' ] = $result2;
        //         $ks++;
        //     }
        // }
        return $rlt;
    }

    public function tamenRowDataCsv()
    {
        $sql = "";
        $sql = "SELECT ";
        $sql .= " u.name as partner_name,tt.birth, ";
        $sql .= " tt.exam_state,tt.exam_date,tt.exam_time,tt.start_time, ";
        $sql .= " ta.id as ta_id ,ta.hv_name,ta.hv_busyo,ta.ev_name,ta.ev_busyo,ta.relation ";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN  t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN tamen_tbl as ta ON ta.tp_id = tt.id ";
        $sql .= " WHERE ";
        $sql .= " tt.disabled=0 AND ";
        $sql .= " tt.exam_state = 2 AND ";
        $sql .= " tt.type = 10 AND ";
        $sql .= " u.eir_id = ".$this->eir_id." AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.number ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        while ($result =$stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }

            if ($result[ 'ta_id' ]) {
                $sql = "";
                $sql = "SELECT * FROM tamen_result ";
                $sql .= " WHERE ";
                $sql .= " ta_id=".$result[ 'ta_id' ]." AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tamen_type ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $k=0;
                while ($rst =$stmt->fetch(PDO::FETCH_ASSOC)) {
                    $rlt[$i][ 'result' ][$k] = $rst;
                    $k++;
                }
            }
            $i++;
        }
        return $rlt;
    }


    public function getRowIQCsv()
    {
        $cl = "";
        for ($i=1;$i<=56;$i++) {
            $cl .= ",sec.ans".$i;
        }
        $sql = "";
        $sql = "SELECT ";
        $sql .= " score.language_score,score.math_score ";
        $sql .= $cl;
        $sql .= ",u.name as partner_name,tt.birth,tt.sex,tt.exam_date,tt.exam_id";
        $sql .= ",tt.start_time,exam_time";
        $sql .= " FROM t_testpaper as tt";
        $sql .= " LEFT JOIN t_user as u ON u.id = tt.partner_id ";
        $sql .= " LEFT JOIN iq_member as m ON m.test_id=tt.test_id AND m.testgrp_id = tt.testgrp_id AND tt.exam_id=m.exam_id";
        $sql .= " LEFT JOIN iq_score as score ON m.id=score.iq_id ";
        $sql .= " LEFT JOIN iq_sec as sec ON m.id=sec.iq_id ";

        $sql .= " WHERE ";
        $sql .= " tt.disabled=0 AND ";
        $sql .= " tt.exam_state=2 AND ";
        $sql .= " tt.type = 11 AND ";
        $sql .= " u.eir_id = ".$this->eir_id." AND ";
        $sql .= " 1=1";
        $sql .= " ORDER BY tt.exam_state DESC ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }

        return $rlt;
    }

    public function getMathRowDataList()
    {
        $sql = "";
        $sql = "SELECT mm.*,m_sc.*,m_se.* ";
        $sql .= ",tt.partner_id,tt.customer_id,tt.name,tt.kana,tt.birth,tt.sex,tt.start_time,tt.exam_date,tt.exam_time";
        $sql .= ",tt.pass,tt.memo1,tt.memo2 ,t.name as testname ";
        $sql .= " FROM math_member as mm ";
        $sql .= " LEFT JOIN math_score as m_sc ON mm.id=m_sc.math_id ";
        $sql .= " LEFT JOIN math_sec as m_se ON mm.id=m_se.math_id ";
        $sql .= " LEFT JOIN t_testpaper as tt ON tt.test_id = mm.test_id AND tt.exam_id=mm.exam_id";
        $sql .= " LEFT JOIN t_test as t ON t.id=mm.test_id";
        $sql .= " WHERE ";
        $sql .= " tt.disabled=0 AND ";
        $sql .= " tt.exam_state = 2 AND ";
        $sql .= " tt.type = 13 AND ";
        $sql .= " t.eir_id = ".$this->eir_id." AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.id";


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[$i] = $rlt;
            $i++;
        }
        return $list;
    }

    //-------------------------------------
    //テーブルデータをパーツ別に取得
    //-------------------------------------
    public function getUserDataParts($table, $data, $part="*")
    {
        foreach ($data as $key=>$val) {
            $where .= "AND ".$key."='".$val."' ";
        }
        $where = preg_replace("/^AND/", "", $where);

        $sql = "";
        $sql .= " SELECT ".$part." FROM ".$table." ";
        $sql .= " WHERE ";
        $sql .= $where;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $list[$i] = $rlt;
            $i++;
        }
        return $list;
    }

    public function getRowMV2Data()
    {
        $sql = "";
        $sql = "SELECT ";
        $sql .= " tt.exam_id,tt.name,tt.kana,tt.birth,tt.sex,tt.exam_state,tt.exam_date,tt.start_time,tt.exam_time, ";
        $sql .= " tt.memo1,tt.memo2,tt.testgrp_id,tt.type,";
        $sql .= " t.name as test_name,u.name as partner_name,u2.name as customer_name ,t.id as testID";
        $sql .= " FROM t_testpaper as tt ";
        $sql .= " LEFT JOIN t_test as t ON tt.test_id = t.id ";
        $sql .= " LEFT JOIN t_user as u ON tt.partner_id = u.id ";
        $sql .= " LEFT JOIN t_user as u2 ON tt.customer_id = u2.id ";
        $sql .= " WHERE ";

        $sql .= " tt.disabled = 0 AND ";
        $sql .= " tt.exam_state=2 AND ";
        $sql .= " t.del=0 AND ";
        $sql .= " t.type=37 AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY tt.type ASC ,tt.id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i=0;
        $rlt = array();
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            if ($result[ 'birth' ]) {
                $rlt[$i][ 'age' ] = $this->get_age($result[ 'birth' ]);
            } else {
                $rlt[ $i ][ 'age' ] = "";
            }
            $i++;
        }


        $ks = 0;
        if (count($rlt)) {
            foreach ($rlt as $key=>$val) {
                $tid     = $val[ 'testID'     ];
                $tgrp_id = $val[ 'testgrp_id' ];
                $ex      = $val[ 'exam_id'    ];

                $sql = "";
                $sql = "SELECT * ";
                $sql .= " FROM mv2_member as dm";
                $sql .= " LEFT JOIN mv2_sec as dA ON dm.id=dA.mv_id ";
                $sql .= " WHERE ";
                $sql .= " dm.test_id = ".$tid." AND ";
                $sql .= " dm.testgrp_id = ".$tgrp_id." AND ";
                $sql .= " dm.exam_id='".$ex."' AND ";
                $sql .= " 1=1 ";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                $result2 = $stmt->fetch(PDO::FETCH_ASSOC);
                $rlt[ $ks ][ 'ans' ] = $result2;
                $ks++;
            }
        }
        return $rlt;
    }

       public function getPartner()
       {
           $sql = "
                                SELECT 
                                        name
                                        ,registtime
                                        ,regist_ts
                                        ,logo_name
                                FROM
                                        t_user
                                WHERE
                                        type = 2
                                ORDER BY id
                                ";
           $stmt = $this->db->prepare($sql);
           $stmt->execute();
           $i=1;
           while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
               $list[$i] = $rlt;
               $i++;
           }
           return $list;
       }
       public function getCustomer()
       {
           $sql = "
                                SELECT 
                                        c.name as cname
                                        ,p.name as pname
                                        ,c.rep_email
                                        ,c.rep_email2
                                        ,c.registtime
                                        ,c.regist_ts

                                FROM
                                        t_user as c
                                        LEFT JOIN t_user as p ON p.id = c.partner_id
                                WHERE
                                        c.type = 3
                                ORDER BY c.id
                                ";
           $stmt = $this->db->prepare($sql);
           $stmt->execute();
           $i=1;
           while ($rlt = $stmt->fetch(PDO::FETCH_ASSOC)) {
               $list[$i] = $rlt;
               $i++;
           }
           return $list;
       }
}
