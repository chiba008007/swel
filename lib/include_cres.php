<?PHP
class cres extends method{
    
    public $errmsg = "";
    public $filename = "";
    public $testname = "";
    public $pdffilename = "";
    public $errormessage = "";
    public function getTestData(){
        $sql  = "
                SELECT 
                    * 
                FROM 
                    t_test 
                WHERE
                    dir = ? AND 
                    type=75
                ";
        $dir = base64_decode($_REQUEST[ 'k' ]);
        
        $edit = [];
        $edit[] = $dir;
        $stmt = $this->db->prepare($sql);
        $stmt->execute($edit);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);



        $sql  = "
                SELECT 
                    MAX(recommen)  as recom 
                FROM 
                    t_test 
                WHERE
                    dir = ? 
                ";
        $dir = base64_decode($_REQUEST[ 'k' ]);
        
        $edit = [];
        $edit[] = $dir;
        $stmt = $this->db->prepare($sql);
        $stmt->execute($edit);
        $rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);
        $rlt['recom'] = $rlt2['recom'];



        $this->testname = $rlt[ 'name' ];
        return $rlt;
    }

    /************************
     * ユーザーデータ
     */
    public function getUserData(){
        $sql  = "
            SELECT 
                * 
            FROM 
                t_user 
            WHERE
                id = ? 
            ";
        $set = [];
        $set[] = $_SESSION[ 'id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($set);
        $rlts = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rlts;
    }
    /***********************
     * テストデータ取得
     */
    public function getCresData(){
        $sql = "
            SELECT 
                *
            FROM
                cres_exam1
            WHERE
                testpaper_id=?
        ";
        $set = [];
        $set[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($set);
        $rlt['main'] = $stmt->fetch(PDO::FETCH_ASSOC);
        $sql = "
            SELECT 
                *
            FROM
                crest_other
            WHERE
                testpaper_id=? AND
                cres_exam_id = ?
                ORDER BY number 
        ";
        $set = [];
        $set[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
        $set[] = $rlt[ 'main' ]['id'];
        $stmt = $this->db->prepare($sql);
        $stmt->execute($set);
        $list = [];
        while($rlts = $stmt->fetch(PDO::FETCH_ASSOC)){
            $rlt['sub'][$rlts[ 'questionkey' ]][$rlts[ 'number' ]] = $rlts;
        }
        return $rlt;
    }

    public function question(){
        $this->filename="q".$_SESSION['cres'][ 'questiontype' ];
        //保存する
        if($_REQUEST[ 'keep' ]){
            //メイン保存
            self::setCres_exam1($this->db,0);
            //サブ保存
            self::setCres_other($this->db);
            $this->errmsg = "保存処理を行いました。";
        }
        //保存する
        if($_REQUEST[ 'finish' ]){
            //エラーチェック           
            //メイン保存
            self::setCres_exam1($this->db,1);
            //サブ保存
            self::setCres_other($this->db);
            //検査終了ステータス
            if($this->filename == "q3"){
                $sts = "exam_date3_status";
            }else
            if($this->filename == "q2"){
                $sts = "exam_date2_status";
            }else{
                $sts = "exam_date1_status";
            }
            if($this->errorCheck()){ 

                self::editTestpaperCres($this->db,$sts);
                $this->filename="finish";
                
                
                //検査結果PDFの作成
                if($_SESSION[ 'cres' ][ 'questiontype' ] == 3){
                    $this->createPDF3();
                }else
                if($_SESSION[ 'cres' ][ 'questiontype' ] == 2){
                    $this->createPDF2();
                }else{
                    $this->createPDF();
                }
                
                //検査終了のメール配信
                $this->cresSendMailfin();
                //終了したquestion_typeの保存
                if($_SESSION[ 'cres' ][ 'questiontype' ] == 1){
                    $_SESSION[ 'cres' ][ 'exam_date1_status' ] = 1;
                }
                if($_SESSION[ 'cres' ][ 'questiontype' ] == 2){
                    $_SESSION[ 'cres' ][ 'exam_date2_status' ] = 1;
                }
                if($_SESSION[ 'cres' ][ 'questiontype' ] == 3){
                    $_SESSION[ 'cres' ][ 'exam_date3_status' ] = 1;
                }

                
                //unset($_SESSION['cres']);
            }
        }
        
        
    }
    /***************************
     * PDF3
     */
    public function createPDF3(){
        //現在のテスト状況取得
        $data = $this->getCresData();


        require_once('../lib/mpdf60/mpdf.php');
        define('FPDF_FONTPATH','../font/');
        require('../mbfpdf.php');
        $createdate = date("Y年m月d日");
        $contents = file_get_contents("../t/template/cres/crespdf.html");
        $contents = preg_replace("/##CRES1##/","準備",$contents);
        $contents = preg_replace("/##PATH##/",D_PATH_HOME,$contents);
        $contents = preg_replace("/##CREATE_DATE##/",$createdate,$contents);
        $contents = preg_replace("/##NAME##/",$_SESSION[ 'cres' ][ 'name' ],$contents);
        $contents = preg_replace("/##QUESTION1##/",nl2br($data['main'][ 'question1' ]),$contents);
        $contents = preg_replace("/##QUESTION2##/",nl2br($data['main'][ 'question2' ]),$contents);

        $ques3 = "";
        for($i=1;$i<=$data['main']['question3_count'];$i++){
            $ques3 .= $i.":<br />";
            $ques3 .= nl2br($data['sub'][ 'question3' ][$i]['note']);
            $ques3 .= "<hr />";
        }
        $contents = preg_replace("/##QUESTION3##/",$ques3,$contents);
        $ques4="";
        for($i=1;$i<=$data['main']['question4_count'];$i++){
            $ques4 .= $i.":<br />";
            $ques4 .= nl2br($data['sub'][ 'question4' ][$i]['note']);
            $ques4 .= "<hr />";
        }
        $contents = preg_replace("/##QUESTION4##/",$ques4,$contents);

        $contents3 = file_get_contents("../t/template/cres/crespdf3.html");
        $contents3 = preg_replace("/##CRES1##/","準備",$contents3);
        $contents3 = preg_replace("/##PATH##/",D_PATH_HOME,$contents3);
        $contents3 = preg_replace("/##CREATE_DATE##/",$createdate,$contents3);
        $contents3 = preg_replace("/##NAME##/",$_SESSION[ 'cres' ][ 'name' ],$contents3);

        $ques7 = "";
        for($i=1;$i<=$data['main']['question7_count'];$i++){
            if($data['sub'][ 'question7' ][$i]['note'] 
            && $data['sub'][ 'question8' ][$i]['note']){
                $ques7 .= "<tr>";
                $ques7 .= "<td class='border3'>";
                $ques7 .= nl2br($data['sub'][ 'question7' ][$i]['note']);
                $ques7 .= "</td>";
                $ques7 .= "<td class='border3'>";
                $ques7 .= nl2br($data['sub'][ 'question8' ][$i]['note']);
                $ques7 .= "</td>";
                $ques7 .= "</tr>";
            }
        }

        $contents3 = preg_replace("/##QUESTION7##/",$ques7,$contents3);
        $contents3 = preg_replace("/##QUESTION9##/",nl2br($data['main'][ 'question9' ]),$contents3);


        $this->pdffilename = D_PATH_HOME."/tmp/cres/".$_SESSION[ 'cres' ][ 'questiontype' ]."-".$_SESSION[ 'cres' ][ 'testpaper_id' ].".pdf";
       
        $mpdf = new mPDF('ja', 'A4', 0, '', 15, 15, 16, 16, 9, 9);
        $mpdf->ignore_invalid_utf8 = true;
        $mpdf->WriteHTML($contents);
        $mpdf->AddPage();
        $mpdf->WriteHTML($contents3);
        $mpdf->Output($this->pdffilename, 'F');

       return true;
    }
    /***************************
     * PDF2
     */
    public function createPDF2(){
        //現在のテスト状況取得
        $data = $this->getCresData();
        
        require_once('../lib/mpdf60/mpdf.php');
        define('FPDF_FONTPATH','../font/');
        require('../mbfpdf.php');
        $createdate = date("Y年m月d日");
        $contents = file_get_contents("../t/template/cres/crespdf.html");
        $contents = preg_replace("/##CRES1##/","確認",$contents);
        $contents = preg_replace("/##PATH##/",D_PATH_HOME,$contents);
        $contents = preg_replace("/##CREATE_DATE##/",$createdate,$contents);
        $contents = preg_replace("/##NAME##/",$_SESSION[ 'cres' ][ 'name' ],$contents);
        $contents = preg_replace("/##QUESTION1##/",nl2br($data['main'][ 'question1' ]),$contents);
        $contents = preg_replace("/##QUESTION2##/",nl2br($data['main'][ 'question2' ]),$contents);

        $ques3 = "";
        for($i=1;$i<=$data['main']['question3_count'];$i++){
            $ques3 .= $i.":<br />";
            $ques3 .= nl2br($data['sub'][ 'question3' ][$i]['note']);
            $ques3 .= "<hr />";
        }
        $contents = preg_replace("/##QUESTION3##/",$ques3,$contents);
        $ques4="";
        for($i=1;$i<=$data['main']['question4_count'];$i++){
            $ques4 .= $i.":<br />";
            $ques4 .= nl2br($data['sub'][ 'question4' ][$i]['note']);
            $ques4 .= "<hr />";
        }
        $contents = preg_replace("/##QUESTION4##/",$ques4,$contents);

        
        $contents2 = file_get_contents("../t/template/cres/crespdf2.html");
        $contents2 = preg_replace("/##CRES1##/","確認",$contents2);
        $contents2 = preg_replace("/##PATH##/",D_PATH_HOME,$contents2);
        $contents2 = preg_replace("/##CREATE_DATE##/",$createdate,$contents2);
        $contents2 = preg_replace("/##NAME##/",$_SESSION[ 'cres' ][ 'name' ],$contents2);
        

        $contents2 = preg_replace("/##QUESTION5##/",nl2br($data['main'][ 'question5' ]),$contents2);

       $ques6 = "";
        for($i=1;$i<=$data['main']['question6_count'];$i++){
            //ques4と同様(見直しがないときは処理をしない)
           // if($data['sub'][ 'question6' ][$i]['note'] != $data['sub'][ 'question4' ][$i]['note']){
               
                $ques6 .= $i.":<br />";
                $ques6 .= nl2br($data['sub'][ 'question6' ][$i]['note']);
                $ques6 .= "<hr />";
                
            //}
        }
        

        $contents2 = preg_replace("/##QUESTION6##/",$ques6,$contents2);






        $this->pdffilename = D_PATH_HOME."/tmp/cres/".$_SESSION[ 'cres' ][ 'questiontype' ]."-".$_SESSION[ 'cres' ][ 'testpaper_id' ].".pdf";
       
        $mpdf = new mPDF('ja', 'A4', 0, '', 15, 15, 16, 16, 9, 9);
        $mpdf->ignore_invalid_utf8 = true;
        $mpdf->WriteHTML($contents);
        $mpdf->AddPage();
        $mpdf->WriteHTML($contents2);
        $mpdf->Output($this->pdffilename, 'F');
       //$mpdf->Output($this->pdffilename, 'D');
        return true;
    }
    /***************************
     * PDF
     */
    public function createPDF(){
        //現在のテスト状況取得
        $data = $this->getCresData();
        
        require_once('../lib/mpdf60/mpdf.php');
        define('FPDF_FONTPATH','../font/');
        require('../mbfpdf.php');
        $contents = file_get_contents("../t/template/cres/crespdf.html");
        $createdate = date("Y年m月d日");
        $contents = preg_replace("/##CRES1##/","内省",$contents);
        $contents = preg_replace("/##PATH##/",D_PATH_HOME,$contents);
        $contents = preg_replace("/##CREATE_DATE##/",$createdate,$contents);
        $contents = preg_replace("/##NAME##/",$_SESSION[ 'cres' ][ 'name' ],$contents);
        $contents = preg_replace("/##QUESTION1##/",nl2br($data['main'][ 'question1' ]),$contents);
        $contents = preg_replace("/##QUESTION2##/",nl2br($data['main'][ 'question2' ]),$contents);
        $ques3 = "";
        for($i=1;$i<=$data['main']['question3_count'];$i++){
            $ques3 .= $i.":<br />";
            $ques3 .= nl2br($data['sub'][ 'question3' ][$i]['note']);
            $ques3 .= "<hr />";
        }
        $contents = preg_replace("/##QUESTION3##/",$ques3,$contents);
        $ques4="";
        for($i=1;$i<=$data['main']['question4_count'];$i++){
            $ques4 .= $i.":<br />";
            $ques4 .= nl2br($data['sub'][ 'question4' ][$i]['note']);
            $ques4 .= "<hr />";
        }
        $contents = preg_replace("/##QUESTION4##/",$ques4,$contents);

        $mpdf = new mPDF('ja', 'A4', 0, '', 15, 15, 16, 16, 9, 9);
        $mpdf->ignore_invalid_utf8 = true;
        //$mpdf->autoPageBreak=false;
        $mpdf->WriteHTML($contents);
        $this->pdffilename = D_PATH_HOME."/tmp/cres/".$_SESSION[ 'cres' ][ 'questiontype' ]."-".$_SESSION[ 'cres' ][ 'testpaper_id' ].".pdf";
       
        $mpdf->Output($this->pdffilename, 'F');

        //$mpdf->Output($this->pdffilename, 'D');

        return true;
    }
    /**************
     * エラーチェック
     */
    public function errorCheck(){

       
        if($_SESSION['cres'][ 'questiontype' ] == 1){
            
            if(!$_REQUEST[ 'question1' ]){
                $this->errmsg = "1.コーチングの目的が入力されていません。";
                return false;
            }
            if(!$_REQUEST[ 'question2' ]){
                $this->errmsg = "2.トピックが入力されていません。";
                return false;
            }

            if(!$_REQUEST[ 'question' ]){
                $this->errmsg = "3.気づきもしくは、4.アクションに不備があります。";
                return false;
            }else{
                foreach($_REQUEST['question'][ '3' ] as $val){
                    if(!$val){
                        $this->errmsg = "入力されていない「3.気づき」があります。";
                        return false;
                    }
                }
                foreach($_REQUEST['question'][ '4' ] as $val){
                    if(!$val){
                        $this->errmsg = "入力されていない「4.アクション」があります。";
                        return false;
                    }
                }
                
                
            }
        }
        if($_SESSION['cres'][ 'questiontype' ] == 2){
/*
            if(!$_REQUEST[ 'question5' ]){
                $this->errmsg = "1.設問が選択されていません。";
                return false;
            }
            */
        }

        if($_SESSION['cres'][ 'questiontype' ] == 3){
            $q7 = $_REQUEST[ 'question' ]['7'];
            $q8 = $_REQUEST[ 'question' ]['8'];

            foreach($_REQUEST['question'][ '7' ] as $key => $val){

                if(!$val && !$q8[$key]){
                    //両方入力されていないときはチェックを走らせない
                    //1回目以外
                    if($key == 1){
                        $this->errmsg = "「行ったこと」「気づき」が入力されていません。";
                        return false;
                    }
                }else{
                    if(!$val || !$q8[$key]){    
                        $this->errmsg = "入力されていない「行ったこと」もしくは「気づき」があります。";
                        return false;
                    }
                }
            }
            
        }
        return true;

    }
    /**********************
     * 検査終了ステータス
     */
    static function editTestpaperCres($db,$clum){
        $set = [];
        $set[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
        $sql = "
            UPDATE t_testpaper_cres SET
                ".$clum." = 1
            WHERE
                testpaper_id=?
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute($set);
        //t_testpaper

        $sql = "UPDATE t_testpaper SET 
                complete_flg = 1,
                exam_state=1,
                fin_exam_date=NOW()
            WHERE
                id=?
        ";
        

        $stmt = $db->prepare($sql);
        $stmt->execute($set);
    }
    /*****************
     * サブ保存
     */
    public function setCres_other($db){
       
        $sql = "
            SELECT 
                id
            FROM
                cres_exam1
            WHERE
                testpaper_id = ?
        ";
        $where = [];
        $where[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
        $stmt = $db->prepare($sql);
        $stmt->execute($where);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
        
        //余分データを削除

        $set = [];
        $set[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
        $set[] = $rlt['id'];
        $set[] = $_SESSION[ 'cres' ][ 'questiontype' ];


        $sql = "
            DELETE
            FROM
                crest_other
            WHERE
                testpaper_id = ? AND
                cres_exam_id = ? AND
                type = ? 
        ";

        $delete = $db->prepare($sql);
        $delete->execute($set);


        foreach($_REQUEST[ 'question' ] as $key=>$values){
            foreach($values as $k=>$value){
                if(!$value) continue;
                $set = [];
                $set[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
                $set[] = $rlt['id'];
                $set[] = $_SESSION[ 'cres' ][ 'questiontype' ];
                $set[] = "question".$key;
                $set[] = $k;

                $sql = "
                    SELECT 
                        *
                    FROM
                        crest_other
                    WHERE
                        testpaper_id = ? AND
                        cres_exam_id = ? AND
                        type = ? AND
                        questionkey = ? AND
                        number = ?
                ";
                $stmt = $db->prepare($sql);
                $stmt->execute($set);
                $r = $stmt->fetch(PDO::FETCH_ASSOC);

                if(empty($r)){
                    
                    $set[] = $value;
                    $sql = "
                        INSERT INTO crest_other(
                            testpaper_id,
                            cres_exam_id,
                            type,
                            questionkey,
                            number,
                            note,
                            regist_ts
                        )VALUES(
                            ?,?,?,?,?,?,NOW()
                        )
                    ";
                    $stmt = $db->prepare($sql);
                    $stmt->execute($set);
                }else{
                    $set = [];
                    $set[] = $value;
                    $set[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
                    $set[] = $rlt['id'];
                    $set[] = $_SESSION[ 'cres' ][ 'questiontype' ];
                    $set[] = "question".$key;
                    $set[] = $k;
                    $sql = "
                        UPDATE  crest_other SET
                            
                            note = ?
                        WHERE 
                            testpaper_id=? AND
                            cres_exam_id=? AND
                            type = ? AND
                            questionkey =? AND
                            number =? 
                        
                    ";
                    $stmt = $db->prepare($sql);
                    $stmt->execute($set);
                }

            }

        }
        
    }
    /*********
     * メイン保存
     */
    public function setCres_exam1($db,$comp){
        $sql = "
            SELECT 
                *
            FROM
                cres_exam1
            WHERE
                testpaper_id = ?
        ";
        $where = [];
        $where[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
  
        $stmt = $db->prepare($sql);
        $stmt->execute($where);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($rlt)){
            $sql = "
                INSERT INTO cres_exam1 (
                    testpaper_id,
                    question1,
                    question2,
                    question3_count,
                    question4_count,
                    complete_flag,
                    regist_ts
                )VALUES(
                    ?,?,?,?,?,?,?
                )
            ";
            $edit = [];
            $edit[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
            $edit[] = $_REQUEST[ 'question1' ];
            $edit[] = $_REQUEST[ 'question2' ];
            $edit[] = count($_REQUEST[ 'question' ][3]);
            $edit[] = count($_REQUEST[ 'question' ][4]);
            $edit[] = $comp;
            $edit[] = date('Y-m-d H:i:s');
            
            $stmt = $db->prepare($sql);

            $stmt->execute($edit);

        }else{
            if($this->filename == "q3"){
                //question8がないのは,7と同じカウントに含まれる
                $sql = "
                    UPDATE cres_exam1 SET 
                        question1=?,
                        question2=?,
                        question7_count=?,
                        question9=?,
                        complete_flag=?
                    WHERE
                        testpaper_id=?
                ";
                $edit = [];
                $edit[] = $_REQUEST[ 'question1' ];
                $edit[] = $_REQUEST[ 'question2' ];
                $edit[] = count($_REQUEST[ 'question' ][7]);
                $edit[] = $_REQUEST[ 'question9' ];
                $edit[] = $comp;
                $edit[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
                $stmt = $db->prepare($sql);
                $stmt->execute($edit);

            }else
            if($this->filename == "q2"){
                
                $sql = "
                    UPDATE cres_exam1 SET 
                        question1=?,
                        question2=?,
                        question5=?,
                        question6_count=?,
                        complete_flag=?
                    WHERE
                        testpaper_id=?
                ";
                $edit = [];
                
                $edit[] = $_REQUEST[ 'question1' ];
                $edit[] = $_REQUEST[ 'question2' ];
                $edit[] = $_REQUEST[ 'question5' ];
                $edit[] = count($_REQUEST[ 'question' ][6]);
                $edit[] = $comp;
                $edit[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];
                $stmt = $db->prepare($sql);
                $stmt->execute($edit);

            }else{

                $sql = "
                    UPDATE cres_exam1 SET 
                        question1=?,
                        question2=?,
                        question3_count=?,
                        question4_count=?,
                        complete_flag=?
                    WHERE
                        testpaper_id=?
                ";
                $edit = [];
                
                $edit[] = $_REQUEST[ 'question1' ];
                $edit[] = $_REQUEST[ 'question2' ];
                $edit[] = count($_REQUEST[ 'question' ][3]);
                $edit[] = count($_REQUEST[ 'question' ][4]);
                $edit[] = $comp;
                $edit[] = $_SESSION[ 'cres' ][ 'testpaper_id' ];

                $stmt = $db->prepare($sql);
                $stmt->execute($edit);
            }

        }
    }


    public function loginCheck(){

        if($_REQUEST[ 'login' ] == "on"){
            //ログイン成功時
            $sql = "
                SELECT 
                    * 
                FROM
                    t_testpaper
                WHERE
                    test_id = ? AND 
                    testgrp_id = ? AND 
                    exam_id = ? 
            ";
            $birth = sprintf("%04d/%02d/%02d"
                    ,$_REQUEST[ 'year' ]
                    ,$_REQUEST[ 'month' ]
                    ,$_REQUEST[ 'day' ]
                    );
            $birth = preg_replace("/\//","-",$birth);
            $where = [];
            $where[] = $this->test[ 'id' ];
            $where[] = $this->test[ 'test_id' ];
            $where[] = $_REQUEST[ 'id' ];
//            $where[] = $birth;


            $stmt = $this->db->prepare($sql);
            $stmt->execute($where);
            $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if(!$rlt || !$_REQUEST[ 'year' ] ){
                $_SESSION['cres'][ 'errmsg' ] = "ログイン情報に誤りがあります。";
                $this->filename  = "login";
                return false;
            }
            //誕生日の登録がないときは誕生日の登録を行う
            //誕生日があるときは誕生日の突合を行う
            
            if(!$rlt[ 'birth' ]){
                $sql = "
                    UPDATE  t_testpaper SET 
                        birth = ? 
                    WHERE 
                        id=?
                ";
                $set = [];
                $set[] = $birth;
                $set[] = $rlt[ 'id' ];
                $stmt = $this->db->prepare($sql);
                $stmt->execute($set);
                
            }else{
                if($rlt[ 'birth' ] != $birth){
                    $_SESSION['cres'][ 'errmsg' ] = "ログイン情報(生年月日)に誤りがあります。";
                    
                    return false;
                }
            }

            $_SESSION[ 'cres' ]['name'] = $rlt['name'];
            if(!empty($rlt)){
               //受検日程確認
               $sql = "
                    SELECT 
                        * 
                    FROM 
                        t_testpaper_cres 
                    WHERE
                        testpaper_id=?
               ";
                $where = [];
                $where[] = $rlt[ 'id' ];
                $stmt = $this->db->prepare($sql);
                $stmt->execute($where);
                $rlt2 = [];
                $rlt2 = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!$rlt2){
                    $this->filename  = "login";
                    $_SESSION['cres'][ 'errmsg' ] = "登録情報に誤りがあります。";
                    return false;
                }
               $now = date("Y-m-d H:i:s");
               //現在の受検をする番号を登録
               $_SESSION[ 'cres' ][ 'exam_date1_status' ] = $rlt2[ 'exam_date1_status' ];
               $_SESSION[ 'cres' ][ 'exam_date2_status' ] = $rlt2[ 'exam_date2_status' ];
               $_SESSION[ 'cres' ][ 'exam_date3_status' ] = $rlt2[ 'exam_date3_status' ];
               

               if(
                //    $rlt2[ 'exam_date1_status' ] == 0 &&  
                    $rlt2[ 'exam_date1' ] <= $now  &&  
                    $now <= $rlt2[ 'exam_date2' ]
               ){
                   
                    $_SESSION[ 'cres' ][ 'questiontype' ] = 1;
                    $_SESSION['cres'][ 'testpaper_id' ] = $rlt[ 'id' ];
                    return true;
               }else
               if(
                 //   $rlt2[ 'exam_date2_status' ] == 0 && 
                    $rlt2[ 'exam_date2' ] <= $now  && 
                    $now <= $rlt2[ 'exam_date3' ]
               ){
                    $_SESSION[ 'cres' ][ 'questiontype' ] = 2;
                    $_SESSION['cres'][ 'testpaper_id' ] = $rlt[ 'id' ];
                    return true;
               }else
               if(
                  //  $rlt2[ 'exam_date3_status' ] == 0 && 
                    $rlt2[ 'exam_date3' ] <= $now 
               ){
                    $_SESSION[ 'cres' ][ 'questiontype' ] = 3;
                    $_SESSION['cres'][ 'testpaper_id' ] = $rlt[ 'id' ];
                    return true;
               }
               /*
               $this->filename="login";
               $this->errmsg = "ログイン情報の誤りもしくは、受検対象外となります。";
               if(
                    $rlt2[ 'exam_date1_status' ] == 1 &&
                    $rlt2[ 'exam_date2_status' ] == 1 &&
                    $rlt2[ 'exam_date3_status' ] == 1 
               ){
                   $_SESSION['cres'][ 'errmsg' ] = "現在「回答済み」となります。";
               }
               return false;
               */
            }
        }

        $this->filename="login";
        return false;
    }


    public function getTtestPaper($data,$countflag=0){
        $sql = "
            SELECT 
                tt.*,
                cres.mail,
                date_format(cres.exam_date1,'%Y/%m/%d') as exam_date1,
                date_format(cres.exam_date2,'%Y/%m/%d') as exam_date2,
                date_format(cres.exam_date3,'%Y/%m/%d') as exam_date3,
                cres.exam_date1_status,
                cres.exam_date2_status,
                cres.exam_date3_status,
                cres.status
            FROM
                t_testpaper as tt
                LEFT JOIN t_testpaper_cres as cres ON tt.id = cres.testpaper_id 
            WHERE
                tt.customer_id= ? 
                AND tt.testgrp_id= ?
            ";
        $where = [];
        $where[] = $data[ 'customer_id' ];
        $where[] = $data[ 'testgrp_id' ];
        if($_REQUEST[ 'id' ]){
            $sql .= "AND tt.exam_id LIKE ?";
            $where[] = "%".$data[ 'id' ]."%";
        }
        if($_REQUEST[ 'name' ]){
            $sql .= "AND tt.name LIKE ?";
            $where[] = "%".$data[ 'name' ]."%";
        }
        if($_REQUEST[ 'kana' ]){
            $sql .= "AND tt.kana LIKE ?";
            $where[] = "%".$data[ 'kana' ]."%";
        }


        if($countflag){
            $stmt = $this->db->prepare($sql);
            $stmt->execute($where);
            $rlt = $stmt->rowCount();
            return $rlt;

        }else{
            $sql .= " 
                limit ".$data[ 'limit' ]." OFFSET ".$data[ 'offset' ].""; 

            $stmt = $this->db->prepare($sql);
            $stmt->execute($where);
            $list = [];
            while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
                $list[] = $rlt;
            }
            return $list;
        }
    }
    public function getCresTest($data){
        $where = [];
        $where[] = $data[ 'customer_id' ];
        $where[] = $data[ 'testgrp_id' ];
        $where[] = $data[ 'id' ];
        $sql = "
                SELECT 
                    tt.name,
                    tt.kana,
                    tt.birth,
                    tt.sex,
                    tt.pass,
                    tt.memo1,
                    tt.memo2,
                    tt.exam_id,
                    cres.*,
                    tt.customer_id,
                    tt.testgrp_id,
                    tt.id
                FROM
                    t_testpaper as tt
                    LEFT JOIN t_testpaper_cres as cres ON cres.testpaper_id=tt.id 
                WHERE
                    
                    tt.customer_id= ? 
                    AND tt.testgrp_id= ?
                    AND tt.id = ?
            ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rlt;
    }
    public function getTests($where){
        $sql = "SELECT 
                * 
                FROM 
                    t_test
                WHERE 
                    id=".$where[ 'testgrp_id' ]."
                    ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rlt;  
    }
    public function editCresData($data){
        $this->errmsg = "";
        $tests = $this->getTests($data);
        if($_REQUEST[ 'edit' ]){
            $error = 0;
            //エラーチェック
            $period_to = $tests['period_to'];
        //    var_dump($_REQUEST,$period_to);
         //   exit();
            
            if(
                $_REQUEST[ 'sendplandate' ][1] >= $_REQUEST[ 'sendplandate' ][2]
                ){
                    $this->errmsg .= "2回目の日付が1回目の日付より前になっています。修正してください。<br />";
                    $error++;
            }
            if(
                $_REQUEST[ 'sendplandate' ][2] >= $_REQUEST[ 'sendplandate' ][3]
                ){
                    $this->errmsg .= "3回目の日付が2回目の日付より前になっています。修正してください。<br />";
                    $error++;
            }

            if(
                $period_to <= $_REQUEST[ 'sendplandate' ][3]
                ){
                    $this->errmsg .= "3回目の日付がテスト終了日の日付より前になっています。修正してください。<br />";
                    $error++;
            }

            if(!$_REQUEST[ 'exam_date_fin' ] ){
                $this->errmsg .= "受検終了日を入力してください。<br />";
                $error++;
            }

            if( 
                !$_REQUEST[ 'sendplandate' ][1] ||
                !$_REQUEST[ 'sendplandate' ][2] ||
                !$_REQUEST[ 'sendplandate' ][3] 
            ){
                $this->errmsg .= "期間を入力してください。<br />";
                $error++;
            }
            if(!$_REQUEST[ 'mail' ] ){
                $this->errmsg .= "メールアドレスを入力してください。<br />";
                $error++;
            }
            if(!$_REQUEST[ 'kana1' ] || !$_REQUEST[ 'kana2' ]){
                $this->errmsg .= "ふりがなを入力してください。<br />";
                $error++;
            }
            if(!$_REQUEST[ 'name1' ] || !$_REQUEST[ 'name2' ]){
                $this->errmsg .= "名前を入力してください。<br />";
                $error++;
            }

            if($error > 0 ){
                

                return false;
            }


            //IDの無効化
            $exam_id = $_REQUEST[ 'exam_id' ];
            if($_REQUEST[ 'idedit' ]){
                $exam_id = self::changeExamID($this->db,$data);
            }
            $where = [];
            $where[] = $_REQUEST[ 'name1' ]." ".$_REQUEST['name2'];
            $where[] = $_REQUEST[ 'kana1' ]." ".$_REQUEST[ 'kana2' ];
            if($_REQUEST[ 'birth_year' ]){
                $where[] = sprintf("%04d-%02d-%02d"
                    ,$_REQUEST[ 'birth_year' ]
                    ,$_REQUEST[ 'birth_month' ]
                    ,$_REQUEST[ 'birth_day' ]

                );
            }else{
                $where[] = "";
            }
            $where[] = $exam_id;
            $where[] = $_REQUEST[ 'gender' ];
            $where[] = $_REQUEST[ 'pass' ];
            $where[] = $_REQUEST[ 'memo1' ];
            $where[] = $_REQUEST[ 'memo2' ];

            $where[] = $data[ 'customer_id' ];
            $where[] = $data[ 'testgrp_id' ];
            $where[] = $data[ 'id' ];

            $sql = "
                UPDATE t_testpaper SET
                    name=?,
                    kana=?,
                    birth=?,
                    exam_id=?,
                    sex=?,
                    pass=?,
                    memo1=?,
                    memo2=?
                WHERE
                    customer_id= ? 
                    AND testgrp_id= ?
                    AND id = ?
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($where);

            //cresデータの登録
            self::setCresData($this->db,$data);

            return true;
        }
    }
    static function changeExamID($db,$data){
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $str = '';
        for ($i = 0; $i < 3; $i++) {
            $str .= $chars[mt_rand(0, strlen($chars))];
        }
        
        do{
            $where = [];
            $where[] = $data[ 'testgrp_id' ];
            $where[] = $str;
            $flg = true;
            //exam_idの重複確認
            $sql = "
                SELECT exam_id FROM t_testpaper 
                WHERE
                    testgrp_id=? AND
                    exam_id = ?
            ";
            $stmt = $db->prepare($sql);
            $stmt->execute($where);
            $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($rlt)){
                $flg = false;
            }else{
                $flg = true;
            }

        }while($flg);
        return $str;

    }
    static function setCresData($db,$data){
        
        $where = [];
        $where[] = $data[ 'id' ];
        $sql = "
            SELECT 
                * 
            FROM
                t_testpaper_cres 
            WHERE
                testpaper_id= ? 
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute($where);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);

        //受検期間の設定
        /*
        $term = $_REQUEST[ 'term' ];
        $exam_date1 = $_REQUEST[ 'exam_date1' ];
        $exam_date2 = date("Y/m/d",strtotime("+".$term." week".$exam_date1));
        $exam_date3 = date("Y/m/d",strtotime("+".$term." week".$exam_date2));
        */
        $term = "";
        $exam_date1 = $_REQUEST[ 'sendplandate' ][1];
        $exam_date2 = $_REQUEST[ 'sendplandate' ][2];
        $exam_date3 = $_REQUEST[ 'sendplandate' ][3];
        $exam_date_fin = $_REQUEST[ 'exam_date_fin' ];
        $mail = $_REQUEST[ 'mail' ];
        if($rlt){
            $edit = [];
            $edit[] = $mail;
            $edit[] = $term;
            $edit[] = $exam_date1;
            $edit[] = $exam_date2;
            $edit[] = $exam_date3;
            $edit[] = $exam_date_fin;
            $edit[] = $rlt[ 'id' ];
            $sql = "
                UPDATE t_testpaper_cres SET 
                    mail=?,
                    term=?,
                    exam_date1=?,
                    exam_date2=?,
                    exam_date3=?,
                    exam_date_fin=?
                WHERE
                    id=?
            ";
            $stmt = $db->prepare($sql);
            $stmt->execute($edit);
        }else{
            $set = [];
            $set[] = $data[ 'id' ];
            $set[] = $mail;
            $set[] = 1;
            $set[] = 0;
            $set[] = $term;
            $set[] = $exam_date1;
            $set[] = $exam_date2;
            $set[] = $exam_date3;
            $set[] = $exam_date_fin;
            $set[] = date('Y-m-d H:i:s');
            $sql = "
                INSERT INTO t_testpaper_cres(
                    testpaper_id,
                    mail,
                    enable,
                    status,
                    term,
                    exam_date1,
                    exam_date2,
                    exam_date3,
                    exam_date_fin,
                    regist_ts
                )VALUES(
                    ?,?,?,?,?,?,?,?,?,?
                )
            ";
            $stmt = $db->prepare($sql);
            $stmt->execute($set);

        }
        
        return true;

    }
    public function setCresMail($data){
        
        if($_REQUEST[ 'edit' ]){
            
            $del = [];
            $del[] = $data[ 'testpaper_id' ];
            $sql = "
                DELETE FROM cres_mail 
                WHERE
                    testpaper_id = ?
                ";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($del);

            $examdate = array(
                $data['exam_date1'],
                $data['exam_date2'],
                $data['exam_date3']
            );
            $registed_sendplandate = array(
                $_REQUEST['registed_sendplandate'][1],
                $_REQUEST['registed_sendplandate'][2],
                $_REQUEST['registed_sendplandate'][3]
            );
            $number = 1;
            $now = date("Y/m/d");
            foreach($examdate as $k=>$values){
                $set = [];
                $set[] = $data[ 'testpaper_id' ];
                $set[] = $number;
                $set[] = $values;
                //registed_sendplandateとsendplandateが同じかつ本日より前であれば１
                //上記以外は0
                $d = date("Y/m/d",strtotime($values));
                /*
                if($registed_sendplandate[$k] == $d && 
                    $d <= $now
                ){
                    $set[] = 1;
                }else{
                    $set[] = 0;
                }
                */
                $set[] = 0;
                $set[] = date('Y-m-d H:i:s');
                $sql = "
                    INSERT INTO cres_mail 
                        (
                            testpaper_id,
                            number,
                            sendplandate,
                            status,
                            regist_ts
                        )VALUES(
                            ?,?,?,?,?
                        )
                ";
                $stmt = $this->db->prepare($sql);
                $stmt->execute($set);
                
                $number++;
            }
        }
    }
    public function cresMailsend(){
        $sql = "
            SELECT 
                tt.name,
                tt.kana,
                tt.exam_id,
                ttc.mail,
                cm.sendplandate,
                cm.number,
                t.dir,
                t.id as test_id,
                t.partner_id as partner_id,
                t.customer_id as customer_id,
                t.period_to,
                t.name as testname,
                u.name as username,
                u.rep_name as rep_name,
                u.rep_email as rep_email,
                cm.id,
                ttc.id as ttc_id,
                cm.status,
                ttc.exam_date1,
                ttc.exam_date2,
                ttc.exam_date3,
                date_format(ttc.exam_date1,'%m月%d日') as exam_date1_jp,
                date_format(ttc.exam_date2,'%m月%d日') as exam_date2_jp,
                date_format(ttc.exam_date3,'%m月%d日') as exam_date3_jp,
                date_format(ttc.exam_date1,'%Y/%m/%d') as exam_date1_eg,
                date_format(ttc.exam_date2,'%Y/%m/%d') as exam_date2_eg,
                date_format(ttc.exam_date3,'%Y/%m/%d') as exam_date3_eg,
                date_format(ttc.exam_date_fin,'%Y/%m/%d') as period,
                DAYOFWEEK(ttc.exam_date1) as exam_date1_w,
                DAYOFWEEK(ttc.exam_date2) as exam_date2_w,
                DAYOFWEEK(ttc.exam_date3) as exam_date3_w,
                ttc.exam_date1_status,
                ttc.exam_date2_status,
                ttc.exam_date3_status,
                CASE 
                    WHEN exam_date1_status = 0 THEN CONCAT(date_format(ttc.exam_date1,'%Y/%m/%d'),'～',date_format(ttc.exam_date2-INTERVAL 1 DAY,'%Y/%m/%d'))
                    WHEN exam_date2_status = 0 THEN CONCAT(date_format(ttc.exam_date2,'%Y/%m/%d'),'～',date_format(ttc.exam_date3-INTERVAL 1 DAY,'%Y/%m/%d'))
                    WHEN exam_date3_status = 0 THEN CONCAT(date_format(ttc.exam_date3,'%Y/%m/%d'),'～',t.period_to)
                END as term
            FROM 
                cres_mail as cm
                LEFT JOIN t_testpaper_cres as ttc ON ttc.testpaper_id = cm.testpaper_id
                LEFT JOIN t_testpaper as tt ON tt.id = cm.testpaper_id
                LEFT JOIN t_test as t ON t.id = tt.test_id
                LEFT JOIN t_user as u ON u.id = t.customer_id
            WHERE
                cm.status = 0 AND 
                cm.sendplandate <= ?
            
        ";

        //base64_encode($test[ "dir" ]);
        $where = [];
        $where[] = date("Y/m/d");
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($where);
        $list = [];
        $i=0;
        while($rlt = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            $list[$i]['id']=$rlt['id'];
            $list[$i]['ttc_id']=$rlt['ttc_id'];
            if($rlt['number'] == 1){
                self::cresSendMailFirst($rlt);
            }

            self::cresSendMail($rlt);
            
            $i++;
        }
        foreach($list as $values){
            $sql = "UPDATE cres_mail SET status = 1 WHERE id=?";
            $edit[0] = $values['id'];
            $stmt = $this->db->prepare($sql);
            $stmt->execute($edit);


            $sql = "UPDATE t_testpaper_cres SET status = 1 WHERE id=?";
            $edit[0] = $values['ttc_id'];
            $stmt = $this->db->prepare($sql);
            $stmt->execute($edit);

        }
    }
    public function getTestPaperCres(){
        $sql = "
            SELECT 
                tc.*,
                tt.name,
                tt.exam_id,
                u.name as customer_name,
                u.rep_name,
                u.rep_email,
                t.send_mail
            FROM
                t_testpaper_cres as tc
                LEFT JOIN t_testpaper as tt ON tt.id = tc.testpaper_id 
                LEFT JOIN t_test as t ON tt.testgrp_id = t.id 
                LEFT JOIN t_user as u ON u.id=tt.customer_id 
            WHERE 
                testpaper_id = ?
            GROUP BY testpaper_id
        ";
        $stmt = $this->db->prepare($sql);
        $where = [];
        $where[] = $_SESSION['cres'][ 'testpaper_id' ];
        $stmt->execute($where);
        $rlt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rlt;

    }

    public  function cresSendMailfin(){

        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $data = $this->getTestPaperCres();
        


        $title = "セルフコーチング [".$this->testname."]PDF送付";
        $to = $data['mail'];
        $from = "cres@innovation-gate.jp";


        
        $message = "
".$data['name']." 様

CReS（クレス）です。

先ほど記入して頂いた内容をPDFで送付致します。

印刷をして目が触れる場所に置き、意識するようにしてください。

不明点等ございましたら、下記までお問合せ頂けますようお願い致します。
※ご連絡頂く際は、ログインIDとお名前をお知らせください。


----------------------------------------------
■ お問い合わせ窓口 ■
CReS
e-mail：cres@innovation-gate.jp
---------------------------------------------


        ";

    $title = mb_encode_mimeheader($title,"ISO-2022-JP-MS");
    $message = mb_convert_encoding($message,"ISO-2022-JP-MS","UTF-8");

    $boundary = '----=_Boundary_' . uniqid(rand(1000,9999) . '_') . '_';

    $header  = "From: ".$from."\n";
    $header .= "MIME-Version: 1.0\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\n";
    $header .= "Content-Transfer-Encoding: 7bit";


        // ファイルを添付
    
    $file = basename($this->pdffilename);
    //$file = $this->pdffilename;
    $filename = "../tmp/cres/".$file;
    
    
    $body = "";

    $body .= "--{$boundary}\n";
    $body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\r\n";
    $body .= "\r\n";
    $body .= $message . "\r\n";
    $body .= "\n";


    // 添付ファイルへの処理
    $handle = fopen($filename, 'r');
    $attachFile = fread($handle, filesize($filename));
    fclose($handle);
    $attachEncode = base64_encode($attachFile);
    
    $body .= "--{$boundary}\n";
    $body .= "Content-Type: image/pdf; name=\"$file\"\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n";
    $body .= "Content-Disposition: attachment; filename=\"$file\"\r\n";
    $body .= "\r\n";
    $body .= chunk_split($attachEncode) . "\r\n";
    

    
    

    //var_dump($to);
        if($to){
          //  mb_send_mail($to, $title, $body, $header);
            mail($to, $title, $body, $header);
        }
        //send_mailが1の時は担当者にメールを配信する
        if($data[ 'send_mail' ] == 1){
            $title = "セルフコーチング （回答のご連絡）";

            $message = "
".$data[ 'rep_name' ]."様

CReS（クレス）です。

登録されている下記の方が、回答の入力を完了致しました。

ID:".$data['exam_id']."


管理画面より結果を確認してください。
URL：".D_URL."

ID・PWが不明な場合は、下記までお問合せ頂けますようお願い致します。

----------------------------------------------
■ お問い合わせ窓口 ■
CReS
e-mail：cres@innovation-gate.jp
---------------------------------------------



";

            $to = $data[ 'rep_email' ];
            mb_send_mail($to, $title, $message,$header);          
        }


    }

    static function cresSendMailFirst($data){

        $week[1] = "日";
        $week[2] = "月";
        $week[3] = "火";
        $week[4] = "水";
        $week[5] = "木";
        $week[6] = "金";
        $week[7] = "土";
        
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $title = "【CReS】セルフコーチングシステムのご案内";
        $to = $data['mail'];
        $headers = "From: cres@innovation-gate.jp";




        $message = "
".$data['name']."　様


私は、CReS（クレス　Coaching Reflection System）です。

私は、あなたがコーチングを受けた後、
コーチングの際に得た気づきやアクションを実現していくためのフォローを行うセルフコーチングの仕組みです。

私を活用することで下記の３つの利点が得られます。
●	コーチング後、定期的にフォローアップが行われるため、コーチングを受けた意識が持続します。
●	コーチングで得たことをあなた自身で書くことでコーチングの効果を高めることができます。
●	コーチング時に決めたアクションをうっかり忘れてしまうことを防ぐことができます。

■CReSの仕組み
CReSのセルフコーチングの仕組みは下記です。
１．	定期的にあなたにメールを送付します。
２．	メールに記載されているURLにアクセスし、質問に回答してください。
３．	回答した内容をPDFとして、あなたに送付します。

■CReSのセルフコーチングのプロセス
CReSでは、セルフコーチングを3つのプロセスで行います。
プロセス１：内省
メール送付のタイミング：コーチングを受けた後、翌日頃にメールを送付
　内容：コーチングの目的やテーマ、コーチングで得た気づき、アクションを
　　　　あなたの言葉でまとめ、言語化することが目的です。
プロセス２：確認
メール送付のタイミング：コーチングを受けた後、1～2週間後
内容：コーチング時に決めたアクションのうっかり忘れや、気づきを思い出すために、
　　　1回目に書いた内容を確認することが目的です。
　　　もし、状況が異なっていれば加筆していきます。

プロセス３：準備
メール送付のタイミング：次回コーチングの3営業日前、もしくはプロセス２のメールの１～2週間後
内容：前回のコーチングから行ったことと、その結果気づいたことを整理し、次のコーチングの準備をすることが目的です。



".$data['name']."様には、下記のスケジュールでメールを送付致します。
・内省　".$data['exam_date1_jp']." (".$week[$data['exam_date1_w']]."曜日)　 
・確認　".$data['exam_date2_jp']." (".$week[$data['exam_date2_w']]."曜日) 
・準備　".$data['exam_date3_jp']." (".$week[$data['exam_date3_w']]."曜日)

不明点等ございましたら、下記までお問合せください。
※ご連絡頂く際は、ログインIDとお名前をお知らせください。

----------------------------------------------
■ お問い合わせ窓口 ■
CReS
e-mail：cres@innovation-gate.jp
---------------------------------------------
";





        mb_send_mail($to, $title, $message, $headers,'-f '.'cres@innovation-gate.jp');

    }
    static function cresSendMail($data){

        $parttern = "内省";
        if($data[ 'number' ] == 2){$parttern = "確認";}
        if($data[ 'number' ] == 3){$parttern = "準備";}
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $title = "【CReS】セルフコーチングシステムのプロセス".$data[ 'number' ]."：".$parttern;
        $to = $data['mail'];
        $headers = "From: cres@innovation-gate.jp\n";
        $headers.="Cc:" .mb_encode_mimeheader("担当者様") ."<".$data[ 'rep_email' ].">";


if($data['number'] == 3){

    $message = "

".$data['name']." 様

CReS（クレス）です。


コーチングを受け、ご自身がやりたいことやゴールに近づけたでしょうか。

3回目は準備です。

下記の（回答方法）以下を読んで、サイトにアクセスしてください。
次回のコーチングセッションでどのようなことを話すのか準備をしましょう。
次回、コーチングセッションがない方は、コーチングを受けた後、どのような変化があったのか言語化してみましょう。

（回答方法）////////////////////////////////////////////////////

１．以下のサイトにアクセスしてください。
アクセスURL
".D_URL_TEST."?k=".base64_encode($data[ 'dir' ])."

２．以下のログインIDとご自身の生年月日を入力し、ログインをして下さい。
　　ログインIDは下記です。
　　ログインID：".$data[ 'exam_id' ]." 


３．ログイン後、回答をお願いします。
　※回答については、途中保存することができます。
　途中保存せずに終了してしまいますと、
　次回ログイン時に再度最初から入力することになりますので、
　注意してください。


４．回答後、送信ボタンを押してください。回答内容をPDFにて送付致します。




(注意事項）
3回目は".$data['exam_date3_eg']."から
受検終了日の".$data['period']."です。
※終了期間を超えてしまうと回答できなくなりますので、
　　　ご注意願います。

////////////////////////////////////////////////////////////////

不明点等ございましたら、下記までお問合せ頂けますようお願い致します。
    ";
    

}else
if($data['number'] == 2){

    $message = "

".$data['name']." 様

CReS（クレス）です。

コーチングセッションの内容やあなたの気づきやアクションは覚えていますか。

2回目は確認です。
今回は、前回記載した内容を確認することが目的ですので、特に回答することはありません。
下記の（確認方法）以下を読んで、サイトにアクセスしてください。
アクションを行い、何か状況等が変わった場合のみ、回答を記入してください。

（確認方法）////////////////////////////////////////////////////



１．以下のサイトにアクセスしてください。
アクセスURL
".D_URL_TEST."?k=".base64_encode($data[ 'dir' ])."

２．以下のログインIDとご自身の生年月日を入力し、ログインをして下さい。
　ログインIDは下記です。
　ログインID：".$data[ 'exam_id' ]." 




３．ログイン後、前回の内容について確認をしてください。
忘れてしまっていること等あれば、思い出してください。

４．確認後、送信ボタンを押してください。回答内容をPDFにて送付致します。
よく目にするところにおいておくと、常に意識することができます。




(注意事項）
回答期間:".$data[ 'term' ]."

※終了期間を超えてしまうと回答できなくなりますので、
　　　ご注意願います。

////////////////////////////////////////////////////////////////

不明点等ございましたら、下記までお問合せ頂けますようお願い致します。
    ";


}else
if($data['number'] == 1){


        $message = "

".$data['name']." 様

CReS（クレス）です。

コーチングお疲れ様でした。
コーチングのセッションを通じ、いろいろ気づきがあったのではないでしょうか。

１回目は内省です。
下記の（回答方法）以下を読んで、サイトにアクセスしてください。
今回のコーチングの内容を振り返りながら、回答してください。

（回答方法）////////////////////////////////////////////////////


１．以下のサイトにアクセスしてください。
アクセスURL
".D_URL_TEST."?k=".base64_encode($data[ 'dir' ])."

２．以下のログインIDとご自身の生年月日を入力し、ログインをして下さい。
　ログインIDは下記です。
　ログインID：".$data[ 'exam_id' ]." 
　※生年月日については、次回以降ログインする際のパスワード替わりになります。
　あなた自身の生年月日でなくても構いませんが、忘れないようにメモをするようにしてください。



３．ログイン後、回答をお願いします。
　　※回答については、途中保存することができます。
　　途中保存せずに終了してしまいますと、
　　次回ログイン時に再度最初から入力することになりますので、
　　注意してください。



４．回答後、送信ボタンを押してください。回答内容をPDFにて送付致します。
よく目にするところにおいておくと、常に意識することができます。



(注意事項）
回答期間:".$data[ 'term' ]."

※終了期間を超えてしまうと回答できなくなりますので、
　　　ご注意願います。

////////////////////////////////////////////////////////////////

不明点等ございましたら、下記までお問合せ頂けますようお願い致します。
";
}





$message .= "
※ご連絡頂く際は、ログインIDとお名前をお知らせください。

----------------------------------------------
■ お問い合わせ窓口 ■
CReS
e-mail：cres@innovation-gate.jp
--------------------------------------------- 

        ";

        mb_send_mail($to, $title, $message, $headers,'-f' . 'cres@innovation-gate.jp');

    }

}
?>