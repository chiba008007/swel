<?PHP
require_once("./lib/include_cres.php");
$obj = new cres();

//ユーザーデータ
$usr = $obj->getUserData();




$where = [];
$where[ 'customer_id' ] = $id;
$where[ 'testgrp_id' ] = $sec;
$where[ 'id' ] = $third;
//データ更新
$message = "";
if($obj->editCresData($where)){
    $message = "データの更新を行いました。<br />指定のメールアドレスに検査用URLが配信されます。";
}else{
    $message = $obj->errmsg;
}
//var_dump($obj->errmsg);
$data = $obj->getCresTest($where);

//メール配信用データ登録
$obj->setCresMail($data);

$name = explode(" ",$data[ 'name' ]);
$name1 = $name[0];
$name2 = $name[1];
if($_REQUEST[ 'name1' ]) $name1 = $_REQUEST[ 'name1' ];
if($_REQUEST[ 'name2' ]) $name2 = $_REQUEST[ 'name2' ];
$kana  = explode(" ",$data[ 'kana' ]);
$kana1 = $kana[0];
$kana2 = $kana[1];
if($_REQUEST[ 'kana1' ]) $kana1 = $_REQUEST[ 'kana1' ];
if($_REQUEST[ 'kana2' ]) $kana2 = $_REQUEST[ 'kana2' ];

$birth = (empty($data[ 'birth' ]))?'1981/01/01':$data['birth'];
$ex = explode("-",$data[ 'birth' ]);
$year = $ex[0];
$month = $ex[1];
$day = $ex[2];
if($_REQUEST[ 'birth_year'  ]) $year = $_REQUEST[ 'birth_year' ];
if($_REQUEST[ 'birth_month' ]) $birth_month = $_REQUEST[ 'birth_month' ];
if($_REQUEST[ 'birth_day'   ]) $birth_day = $_REQUEST[ 'birth_day' ];

$gender = $data[ 'sex' ];
if($_REQUEST[ 'gender' ]) $gender = $_REQUEST[ 'gender' ];
$pass = $data[ 'pass' ];
$memo1 = $data[ 'memo1' ];
if($_REQUEST[ 'memo1' ]) $memo1 = $_REQUEST[ 'memo1' ];
$memo2 = $data[ 'memo2' ];
if($_REQUEST[ 'memo2' ]) $memo1 = $_REQUEST[ 'memo2' ];
$mail = $data[ 'mail' ];
if($_REQUEST[ 'mail' ]) $mail = $_REQUEST[ 'mail' ];
$exam_date1 = calendertime($data,1);
$exam_date2 = calendertime($data,2);
$exam_date3 = calendertime($data,3);
$exam_date1_status = $data[ 'exam_date1_status' ];
$exam_date2_status = $data[ 'exam_date2_status' ];
$exam_date3_status = $data[ 'exam_date3_status' ];
$exam_date_fin = $data[ 'exam_date_fin' ];

if($_REQUEST[ 'sendplandate' ][1]) $exam_date1=$_REQUEST[ 'sendplandate' ][1];
if($_REQUEST[ 'sendplandate' ][2]) $exam_date2=$_REQUEST[ 'sendplandate' ][2];
if($_REQUEST[ 'sendplandate' ][3]) $exam_date3=$_REQUEST[ 'sendplandate' ][3];
if($_REQUEST[ 'exam_date_fin' ]) $exam_date_fin=$_REQUEST[ 'exam_date_fin' ];




function calendertime($data,$type){
    $exam = "exam_date".$type;
    if(!$data[$exam]){
        $date = date("Y/m/d");
    }else{
        $date = date("Y/m/d",strtotime($data[$exam]));
    }
    return $date;
}