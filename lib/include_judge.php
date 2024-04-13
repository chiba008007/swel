<?php
class judge extends tMethod{
    public function ___getTestList($test,$a_test_type){
        $sql = "
            SELECT 
                t.*,
                tt.exam_state,
                tt.complete_flg,
                CASE 
                    WHEN t.period_from <= ? AND t.period_to >= ? THEN 'ENABLE'
                    ELSE 'DISABLE'
                END as flag
            FROM 
                t_test  as t 
                LEFT JOIN t_testpaper as tt ON tt.test_id = t.id AND tt.type = t.type
            WHERE 
                t.test_id = ? AND 
                t.dir = ? AND 
                tt.exam_id = ? 
        ";
        $params = [];
        $params[] = date("Y/m/d");
        $params[] = date("Y/m/d");
        $params[] = $test['id'];
        $params[] = base64_decode($_REQUEST[ 'k' ]);
        $params[] = $_SESSION[ 'visit' ][ 'exam_id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $list = [];
        $i=0;
        while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
            $list[$i] = $rlt;
            $list[$i]['examname'] = $a_test_type[$rlt['type']];
            $i++;
        }

        $sort = [];
        foreach ($list as $key => $value) {
            $sort[$key] = $value['examname'];
        }
        array_multisort($sort, SORT_ASC, $list);
        return $list;

    }
    public function ___getTestListTop($test,$a_test_type){
        $sql = "
            SELECT 
                t.*
            FROM 
                t_test  as t 
            WHERE 
                t.test_id = ? AND 
                t.dir = ? 
        ";
        $params = [];
        $params[] = $test['id'];
        $params[] = base64_decode($_REQUEST[ 'k' ]);
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $list = [];
        $i=0;
        while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
            $list[$i] = $rlt;
            $list[$i]['examname'] = $a_test_type[$rlt['type']];
            $i++;
        }
        $sort = [];
        foreach ($list as $key => $value) {
            $sort[$key] = $value['examname'];
        }
        array_multisort($sort, SORT_ASC, $list);
        return $list;

    }

    public function ___checkJudgeLogin($test){
        $today = date("Y/m/d");
        $sql = "SELECT 
            * 
            FROM 
                t_testpaper 
            WHERE
                testgrp_id = ? AND
                exam_id = ? 
            ";
        $params = [];
        $params[] = $test['id'];
        $params[] = $_REQUEST[ 'id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $redirect = "";
        $judge_login_flag_page = "";
        $date = sprintf("%04d/%02d/%02d"
            ,$_REQUEST[ 'year' ]
            ,$_REQUEST[ 'month' ]
            ,$_REQUEST[ 'day' ]
        );
        while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
            //誕生日が登録済みの時は入力値と比べる
            //相違があればfalseで返す
            if(strlen($rlt[ 'birth' ]) > 0  && $rlt[ 'birth' ] != $date){
                $_SESSION['error'] = "ログインに失敗しました。";
                header("Location:./judgelogin.php?k=".$_REQUEST[ 'k' ]);
                exit();
            }

            $_SESSION['exam'][$rlt['type']][ 'id' ] = $rlt[ 'id' ];
            $_SESSION['exam'][$rlt['type']][ 'type' ] = $rlt[ 'type' ];
            if($rlt[ 'judge_login_flag' ] == 1) $redirect = "on";
            if($rlt[ 'judge_login_flag_page' ] == 1) $judge_login_flag_page = "on";
        }
        
        if(
            ($redirect == "on" 
            || $judge_login_flag_page == "on"
            )
            && $test[ 'period_from' ] <= $today 
            && $test[ 'period_to' ] >= $today 
            
            ){
            $_SESSION['visit']['k'] = $_REQUEST[ 'k' ];
            $_SESSION['visit']['exam_id'] = $_REQUEST[ 'id' ];
            $_SESSION['visit']['test_id'] = $test['id'];

            
                header("Location:./judgeloginMenu.php?k=".$_REQUEST[ 'k' ]);
               // exit();
            
            return true;
        }
        return false;
    }
    public function __checkParamName($test){
        $name1 = $_REQUEST[ 'name1' ];
        $name2 = $_REQUEST[ 'name2' ];
        if(!$name1 || !$name2){
            $_SESSION['error'] = "名前を入力してください。";
            return false;
        }
        $kana1 = $_REQUEST[ 'kana1' ];
        $kana2 = $_REQUEST[ 'kana2' ];
        if(!$kana1 || !$kana2){
            $_SESSION['error'] = "かなを入力してください。";
            return false;
        }
        
        $sex = $_REQUEST[ 'sex' ];
        /*
        if(!$sex){
            $_SESSION['error'] = "性別を選択してください。";
            return false;
        }
        */

        $sql = "
            UPDATE t_testpaper SET
                name=?,
                kana=?,
                sex=?,
                birth=?
            WHERE
                testgrp_id = ? AND
                exam_id = ? 
        ";
        $params = [];
        $params[] = $name1."　".$name2;
        $params[] = $kana1."　".$kana2;
        $params[] = $sex;
        $year = $_REQUEST[ 'year' ];
        $month = $_REQUEST[ 'month' ];
        $day = $_REQUEST[ 'day' ];
        $params[] = sprintf("%04d/%02d/%02d",$year,$month,$day);
        
        $params[] = $test['id'];
        $params[] = $_REQUEST[ 'id' ];
        $stmt = $this->db->prepare($sql);
        $flg = $stmt->execute($params);
        return $flg;
    }
    public function __editParamJudge($test){
        $sql = "
            UPDATE t_testpaper SET
                judge_login_flag = ?,
                judge_login_flag_page = 1
            WHERE
                testgrp_id = ? AND
                exam_id = ? 
        ";

        if($_REQUEST[ 'next_hidden' ] == "next_hidden_disp"){
            $params[] = 1;
        }else{
            $params[] = 0;
        }
        
        $params[] = $test['id'];
        $params[] = $_REQUEST[ 'id' ];
        $stmt = $this->db->prepare($sql);
        $flg = $stmt->execute($params);
        return $flg;
    }
    public function __checkParam($test){

        if($_REQUEST[ 'login' ] == "on"){
            
            $sql = "SELECT 
                * 
                    FROM 
                        t_testpaper 
                    WHERE
                        testgrp_id = ? AND
                        exam_id = ? 
                    ";
            $params = [];
            $params[] = $test['id'];
            $params[] = $_REQUEST[ 'id' ];
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$rlt){
                $_SESSION['error'] = "登録されていないIDです。";
                return false;
            }

            $year = $_REQUEST['year'];
            $month = $_REQUEST['month'];
            $day = $_REQUEST['day'];


            if(
                !$year ||
                ($year &&  
                !checkdate($month, $day, $year)
                ) || 
                !preg_match("/^[0-9]+$/", $year) ||
                !preg_match("/^[0-9]+$/", $month) ||
                !preg_match("/^[0-9]+$/", $day) 
                ){
                $_SESSION['error'] = "生年月日に不備があります。";
                return false;

            }

            if(!$_REQUEST[ 'id' ]
                || !preg_match("/^[a-zA-Z0-9]+$/", $_REQUEST[ 'id' ])
            ){
                $_SESSION['error'] = "IDに不備があります。";
                return false;
            }

            
        }
        return true;
    }
    public function __getLogoImage($test){
        if(!$test) return "";
      //  $logoimage = $test[ 'name' ];
        $logopath = D_PATH_HOME."img/".$test[ 'login_id' ];
        $glob = glob($logopath.".*");
        $filename = basename($glob[0]);
        if(strlen($filename) > 0 ) $logoimage = "<img src='/img/".$filename."' />";
        return $logoimage;
    }
    public function __getTestPaper($test){
        $sql = "SELECT 
                *
                FROM 
                    t_testpaper
                WHERE 
                    testgrp_id = ? AND
                    exam_id = ? AND 
                    birth = ? 
                ";
        $params = [];
        $params[] = $test['id'];
        $params[] = $_REQUEST[ 'id' ];
        $params[] = sprintf("%04d/%02d/%02d"
            ,$_REQUEST[ 'year' ]
            ,$_REQUEST[ 'month' ]
            ,$_REQUEST[ 'day' ]
        );
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rlt;
    }
    public function __getTestPaperCheck($test){
        $sql = "SELECT 
                *
                FROM 
                    t_testpaper
                WHERE 
                    testgrp_id = ? AND
                    exam_id = ? 
                ";
        $params = [];
        $params[] = $test['id'];
        $params[] = $_REQUEST[ 'id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rlt;
    }
}