<?php

//----------------------------------
//検査削除メソッド
//
//
//----------------------------------
class cusCsvMethod extends method
{
    public function getTest($where)
    {
        $test_id     = $where['test_id'];
        $partner_id  = $where['partner_id'];
        $customer_id = $where['customer_id'];

        $sql = "";
        $sql = "SELECT ";
        $sql .= " type,id,name ";
        $sql .= " FROM ";
        $sql .= " t_test ";
        $sql .= " WHERE ";
        $sql .= " test_id=" . $test_id . " AND ";
        $sql .= " partner_id=" . $partner_id . " AND ";
        $sql .= " customer_id=" . $customer_id . " AND ";
        $sql .= " 1=1 ";
        $sql .= " ORDER BY type";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i = 0;
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt[$i] = $result;
            $i++;
        }
        return $rlt;
    }

    public function getTestdetail($where)
    {
        $test_id     = $where['test_id'];
        $testgrp_id  = $where['testgrp_id'];
        $partner_id  = $where['partner_id'];
        $customer_id = $where['customer_id'];
        $type        = $where['type'];
        //パートナー名取得
        $sql = "";
        $sql = " SELECT ";
        $sql .= " name ";
        $sql .= " FROM ";
        $sql .= " t_user ";
        $sql .= " WHERE ";
        $sql .= " id=" . $partner_id;


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $tst = $stmt->fetch(PDO::FETCH_ASSOC);
        $ptname = $tst['name'];

        //顧客名取得
        $sql = "";
        $sql = " SELECT ";
        $sql .= " name ";
        $sql .= " FROM ";
        $sql .= " t_user ";
        $sql .= " WHERE ";
        $sql .= " id=" . $customer_id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $tst = $stmt->fetch(PDO::FETCH_ASSOC);
        $cname = $tst['name'];

        //テスト名取得
        $sql = "";
        $sql = " SELECT ";
        $sql .= " name ";
        $sql .= " FROM ";
        $sql .= " t_test ";
        $sql .= " WHERE ";
        $sql .= " id=" . $test_id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $tst = $stmt->fetch(PDO::FETCH_ASSOC);
        $testname = $tst['name'];

        switch ($type) {
            case "1":
            case "2":
            case "3":
            case "12":
            case "41":
            case "54":
            case "38":
            case "72":
            case "82":
            case "73":
            case "92":

                //BA
                //PA
                $sql = "";
                $sql = "SELECT ";
                $sql .= " tt.*, ";
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " t.stress_flg";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt";
                $sql .= " LEFT JOIN (SELECT id,stress_flg FROM t_test ) as t ON t.id=tt.test_id";
                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "91":

                $sql = "";
                $sql = "SELECT ";
                $sql .= " tt.*, ";
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " t.stress_flg, ";
                $sql .= "tt.q25 as q1,";
                $sql .= "tt.q19 as q2,";
                $sql .= "tt.q26 as q3,";
                $sql .= "tt.q10 as q4,";
                $sql .= "tt.q31 as q5,";
                $sql .= "tt.q21 as q6,";
                $sql .= "tt.q32 as q7,";
                $sql .= "tt.q15 as q8,";
                $sql .= "tt.q6 as q9,";
                $sql .= "tt.q9 as q10,";
                $sql .= "tt.q22 as q11,";
                $sql .= "tt.q18 as q12,";
                $sql .= "tt.q16 as q13,";
                $sql .= "tt.q28 as q14,";
                $sql .= "tt.q27 as q15,";
                $sql .= "tt.q35 as q16,";
                $sql .= "tt.q7 as q17,";
                $sql .= "tt.q36 as q18,";
                $sql .= "tt.q13 as q19,";
                $sql .= "tt.q34 as q20,";
                $sql .= "tt.q1 as q21,";
                $sql .= "tt.q24 as q22,";
                $sql .= "tt.q12 as q23,";
                $sql .= "tt.q5 as q24,";
                $sql .= "tt.q20 as q25,";
                $sql .= "tt.q23 as q26,";
                $sql .= "tt.q29 as q27,";
                $sql .= "tt.q4 as q28,";
                $sql .= "tt.q3 as q29,";
                $sql .= "tt.q30 as q30,";
                $sql .= "tt.q2 as q31,";
                $sql .= "tt.q33 as q32,";
                $sql .= "tt.q17 as q33,";
                $sql .= "tt.q8 as q34,";
                $sql .= "tt.q11 as q35,";
                $sql .= "tt.q14 as q36";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt";
                $sql .= " LEFT JOIN (SELECT id,stress_flg FROM t_test ) as t ON t.id=tt.test_id";
                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "85":
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
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date, ";
                $sql .= " mhq.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN mhq as mhq ON mhq.testpaper_id=tt.id ";
                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "83":
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
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "4":
            case "33":
                if ($type == 33) {
                    $tbl1 = "vf2_member";
                    $tbl2 = "vf2_result";
                    $tbl3 = "vf2_weight";
                } else {
                    $tbl1 = "vf4_member";
                    $tbl2 = "vf4_result";
                    $tbl3 = "vf4_weight";
                }
                //VF
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " r.*,";
                $sql .= " w.*";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT id,test_id,exam_id FROM " . $tbl1 . ") as m ON tt.exam_id=m.exam_id AND tt.test_id=m.test_id ";
                $sql .= " LEFT JOIN (SELECT * FROM " . $tbl2 . ") as r ON r.mem_id=m.id AND r.test_id=m.test_id ";
                $sql .= " LEFT JOIN (SELECT * FROM " . $tbl3 . ") as w ON w.r_id=r.id ";
                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "5":
            case "31":
            case "70":
                //EA
                if ($type == 70) {
                    $tbl1 = "bag_member";
                    $tbl2 = "bag_secA";
                    $tbl3 = "bag_score";
                } elseif ($type == 31) {
                    $tbl1 = "dp_sec_member";
                    $tbl2 = "dp_sec_secA";
                    $tbl3 = "dp_sec_score";
                } else {
                    $tbl1 = "dp_member";
                    $tbl2 = "dp_secA";
                    $tbl3 = "dp_score";
                }
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
                $sql .= " tt.memo1,";
                $sql .= " tt.memo2,";
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " sa.*, ";
                $sql .= " sc.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN  " . $tbl2 . " as sa ON sa.dp_id = mm.id ";
                $sql .= " LEFT JOIN " . $tbl3 . " as sc ON sc.dp_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "7":
            case "47":
            case "66":
            case "74":
                if ($type == 66 || $type == 74) {
                    $table1 = "rs3_member";
                    $table2 = "rs3_secA";
                } elseif ($type == 47) {
                    $table1 = "rs2_member";
                    $table2 = "rs2_secA";
                } else {
                    $table1 = "rs_member";
                    $table2 = "rs_secA";
                }
                //EABJ
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
                $sql .= " tt.memo1,";
                $sql .= " tt.memo2,";
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " rs.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $table1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $table2 . " as rs ON rs.rs_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "6":
            case "37":

                if ($type == 37) {
                    $tbl1 = "mv2_member";
                    $tbl2 = "mv2_sec";
                } else {
                    $tbl1 = "mv_member";
                    $tbl2 = "mv_sec";
                }
                //SA
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.mv_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "34":
            case "36":
            case "61":
                if ($type == 61) {
                    $tbl1 = "nl3_member";
                    $tbl2 = "nl3_sec";
                } elseif ($type == 36) {
                    $tbl1 = "nl2_member";
                    $tbl2 = "nl2_sec";
                } else {
                    $tbl1 = "nl_member";
                    $tbl2 = "nl_sec";
                }
                //SA
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
                $sql .= " tt.memo1,";
                $sql .= " tt.memo2,";
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.mv_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "13":
            case "35":
            case "42":
                if ($type == 35) {
                    $tbl1 = "math2_member";
                    $tbl2 = "math2_sec";
                    $tbl3 = "math2_score";
                } else {
                    $tbl1 = "math_member";
                    $tbl2 = "math_sec";
                    $tbl3 = "math_score";
                }
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " sa.*, ";
                $sql .= " sc.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN  " . $tbl2 . " as sa ON sa.math_id = mm.id ";
                $sql .= " LEFT JOIN " . $tbl3 . " as sc ON sc.math_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "10":
                //多面評価
                $sql = "";
                $sql = "SELECT ";
                $sql .= " tt.fin_exam_date, ";
                $sql .= " tt.exam_date,";
                $sql .= " tt.birth,";
                $sql .= " tt.start_time,";
                $sql .= " ta.*, ";
                $sql .= " tr.*,";
                $sql .= " tr.update_ts as time";
                $sql .= " FROM ";
                $sql .= " tamen_result as tr";
                $sql .= " LEFT JOIN tamen_tbl as ta ON ta.id=tr.ta_id";
                $sql .= " LEFT JOIN (SELECT id,number,test_id,testgrp_id,partner_id,customer_id,type,fin_exam_date,exam_date,birth,start_time FROM t_testpaper) as tt ON tt.id=ta.tp_id";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "11":
                $tbl1 = "iq_member";
                $tbl2 = "iq_sec";
                //IQ
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
                $sql .= " mm.nowpage,";
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id,nowpage FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.iq_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;

            case "32":
                $tbl1 = "ocs_member";
                $tbl2 = "ocs_sec";
                //OCS
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.ocs_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "39":
                $tbl1 = "sp_member";
                $tbl2 = "sp_sec";
                //IQ
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.sp_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "40":
                $tbl1 = "met_member";
                $tbl2 = "met_sec";
                //IQ
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.met_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;

            case "43":

                $tbl1 = "lcp_member";
                $tbl3 = "lcp_sec";

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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " sc.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl3 . " as sc ON sc.lcp_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                // no break
            case "45":

                $tbl1 = "esa_member";
                $tbl3 = "esa_sec";

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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " sc.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl3 . " as sc ON sc.esa_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;

            case "46":
                $tbl1 = "mms_member";
                $tbl3 = "mms_score";
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " sc.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl3 . " as sc ON sc.mms_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;

            case "48":
                $tbl1 = "crt_member";
                $tbl3 = "crt_result";
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
                $sql .= " tt.mail,";
                $sql .= " tt.tensaku_mail,";
                $sql .= " tt.tensaku_name,";

                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " sc.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl3 . " as sc ON sc.crt_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "49":
            case "53":
            case "58":
            case "59":
            case "65":
            case "69":
            case "71":
            case "81":
            case "84":
                if ($type == 71) {
                    $tbl1 = "elans2_member";
                    $tbl2 = "elans2_sec";
                } elseif ($type == 69) {
                    $tbl1 = "elans_member";
                    $tbl2 = "elans_sec";
                } elseif ($type == 65) {
                    $tbl1 = "elan5_member";
                    $tbl2 = "elan5_sec";
                } elseif ($type == 81 || $type == 84) {
                    $tbl1 = "elan6_member";
                    $tbl2 = "elan6_sec";
                } elseif ($type == 59) {
                    $tbl1 = "elan4_member";
                    $tbl2 = "elan4_sec";
                } elseif ($type == 58) {
                    $tbl1 = "elan3_member";
                    $tbl2 = "elan3_sec";
                } elseif ($type == 53) {
                    $tbl1 = "elan2_member";
                    $tbl2 = "elan2_sec";
                } else {
                    $tbl1 = "elan_member";
                    $tbl2 = "elan_sec";
                }

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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.elan_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;


            case "77":
            case "78":
            case "79":
            case "80":
                if ($type == 77) {
                    $tbl1 = "nspe1_member";
                    $tbl2 = "nspe1_sec";
                    $key = "nspe1_id";
                }
                if ($type == 78) {
                    $tbl1 = "nspe2_member";
                    $tbl2 = "nspe2_sec";
                    $key = "nspe2_id";
                }
                if ($type == 79) {
                    $tbl1 = "nspe3_member";
                    $tbl2 = "nspe3_sec";
                    $key = "nspe3_id";
                }
                if ($type == 80) {
                    $tbl1 = "nspe4_member";
                    $tbl2 = "nspe4_sec";
                    $key = "nspe4_id";
                }

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
                $sql .= " tt.memo1,";
                $sql .= " tt.memo2,";
                $sql .= " tt.fin_exam_date,";
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.*, ";
                $sql .= " mm.start_time as ne_start_time ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id,start_time FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms." . $key . " = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;



            case "50":
                $tbl1 = "mea_member";
                $tbl2 = "mea_result";
                //IQ
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.mid = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "51":
                $tbl1 = "bsa_member";
                $tbl2 = "bsa_sec";
                $tbl3 = "bsa_score";
                //IQ
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.*, ";
                $sql .= " msr.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.mv_id = mm.id ";
                $sql .= " LEFT JOIN " . $tbl3 . " as msr ON ms.mv_id = msr.mv_id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "52":
            case "60":
            case "62":
            case "67":
            case "68":
            case "86":
            case "87":
            case "89":
            case "90":
                if ($type == 87 || $type == 90) {
                    $tbl1 = "jug_boss_text6";
                } elseif ($type == 86 || $type == 89) {
                    $tbl1 = "jug_boss_text5";
                } elseif ($type == 62) {
                    $tbl1 = "jug_boss_text3";
                } elseif ($type == 60 || $type == 67 || $type == 68) {
                    $tbl1 = "jug_boss_text2";
                } else {
                    $tbl1 = "jug_boss_text";
                }
                $sql = "
						SELECT
							id,empnum,sei,mei
						FROM
							jug_member
						WHERE
						test_id = " . $test_id . " AND
						testgrp_id = " . $testgrp_id . "
						";

                $stmt = $this->db->prepare($sql);
                $stmt->execute();

                while ($rst2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $emp[$rst2['id']] = $rst2['empnum'];
                    $emp2[$rst2['id']] = $rst2['sei'] . $rst2['mei'];
                }

                $this->emp = $emp;
                $this->emp2 = $emp2;

                $sql = "
					SELECT aa.*
					,CASE
						WHEN aa.boss = 1 THEN aa.jmid
						WHEN aa.boss = 2 THEN aa.bossid
					END as rep
					 FROM (
					SELECT
						jbt.*
						,jm.num
						,jm.bossflg
						,jm.busyo
						,jm.yakusyoku
						,jm.empnum
						,jm.sei
						,jm.mei
						,jm.sei_kana
						,jm.mei_kana
						,jm.mail
						,tt.birth
						,tt.exam_date
						,CASE
							WHEN tt.sex = 1 THEN '男性'
							WHEN tt.sex = 2 THEN '女性'
						END as sex
						,CASE
							WHEN jm.bossflg  = 1 THEN '1'
							ELSE '2'
							END as boss
						,tt.pass
						,tt.memo1
						,tt.memo2
					FROM
						jug_member as jm
						LEFT JOIN " . $tbl1 . " as jbt ON jm.id = jbt.jmid
						LEFT JOIN t_testpaper as tt ON tt.number = jm.num AND tt.testgrp_id = jm.testgrp_id
					WHERE
						jm.test_id = " . $test_id . " AND ";

                if ($_REQUEST['type'] == "sub") {
                    $sql .= "  jbt.type=2 AND ";
                } else {
                    $sql .= "  jbt.type=1 AND ";
                }

                $sql .= "
						jm.testgrp_id = " . $testgrp_id . "
					ORDER BY jm.num
					) as aa
				";
                break;

            case "55":
                $tbl1 = "cba_member";
                $tbl2 = "cba_sec";
                //IQ
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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.cba_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;

            case "56":
                $tbl1 = "aac_member";
                $tbl2 = "aac_sec";

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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.*, ";
                $sql .= " mm.counter ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id,counter FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.aac_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";
                break;
            case "76":
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
                $sql .= " bo.regist_ts as exam_date,";
                $sql .= " date_format(bo.regist_ts,'%H:%i:%s') as start_time,";
                $sql .= " bo.* ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN basiconline as bo ON bo.testpaper_id = tt.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;
            case "57":
                $tbl1 = "aap_member";
                $tbl2 = "aap_sec";

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
                $sql .= " (CASE ";
                $sql .= " WHEN tt.exam_date THEN tt.exam_date ELSE tt.fin_exam_date END ) as exam_date,";
                $sql .= " ms.*, ";
                $sql .= " mm.counter,"
                    . "mm.gender,"
                    . "mm.start_time"
                    . ",mm.birthday"
                    . ",mm.quesfin_time"
                    . ",mm.quesfin_time-mm.start_time as times ";
                $sql .= " FROM ";
                $sql .= " t_testpaper as tt ";
                $sql .= " LEFT JOIN (SELECT testgrp_id,exam_id,id,counter,gender,start_time,birthday,quesfin_time FROM " . $tbl1 . ") as mm ON tt.testgrp_id=mm.testgrp_id AND tt.exam_id=mm.exam_id";
                $sql .= " LEFT JOIN " . $tbl2 . " as ms ON ms.aap_id = mm.id ";

                $sql .= " WHERE ";
                $sql .= " tt.test_id=" . $test_id . " AND ";
                $sql .= " tt.testgrp_id=" . $testgrp_id . " AND ";
                $sql .= " tt.partner_id=" . $partner_id . " AND ";
                $sql .= " tt.customer_id=" . $customer_id . " AND ";
                $sql .= " tt.type=" . $type . " AND ";
                $sql .= " 1=1 ";
                $sql .= " ORDER BY tt.number ";

                break;

            case "anq":
                $sql = "
					SELECT
						*
					FROM
						jug_inquiry_text as jit
						INNER JOIN jug_member as jm ON jm.id = jit.jmid
					WHERE
						jm.testgrp_id = '" . $testgrp_id . "'
						AND jit.status = 1
				";
                break;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $i = 0;
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rlt['ans'][$i] = $result;
            if ($result['exam_date'] != "0000-00-00 00:00:00" && $result['birth']) {
                $rlt['ans'][$i]['age'] = $this->calc_age($result['birth'], $result['exam_date']);
            } else {
                $rlt['ans'][$i]['age'] = "";
            }

            $time = $result['time'];
            $ex = explode(" ", $time);
            $rlt['ans'][$i]['time'] = $ex[0];
            $rlt['ans'][$i]['second'] = $ex[1];
            $i++;
        }
        $rlt['ptname'] = $ptname;
        $rlt['testname'] = $testname;
        $rlt['cname'] = $cname;

        return $rlt;
    }


    //------------------------------------------
    //テストを受験した日の年齢を取得
    //
    //------------------------------------------
    public function calc_age($birth, $date)
    {
        $d = explode("/", $date);

        $ty = $d[0];
        $tm = $d[1];
        $td = $d[2];
        list($by, $bm, $bd) = explode('/', $birth);
        $age = $ty - $by;
        if ($tm * 100 + $td < $bm * 100 + $bd) {
            $age--;
        }
        return $age;
    }
}
