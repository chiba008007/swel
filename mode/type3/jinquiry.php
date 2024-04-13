<?PHP

require_once("./lib/include_jug.php");
$obj = new jug();

if($_REQUEST[ 'reg' ] ){
	$st = sprintf("%04d-%02d-%02d",$_REQUEST[ 'start_year' ],$_REQUEST[ 'start_month' ],$_REQUEST[ 'start_day' ]);
	$ed = sprintf("%04d-%02d-%02d",$_REQUEST[ 'end_year' ],$_REQUEST[ 'end_month' ],$_REQUEST[ 'end_day' ]);
	$chkst = checkdate($_REQUEST[ 'start_month' ],$_REQUEST[ 'start_day' ],$_REQUEST[ 'start_year' ]);
	$chked = checkdate($_REQUEST[ 'end_month' ],$_REQUEST[ 'end_day' ],$_REQUEST[ 'end_year' ]);
	if($st >= $ed || !$chkst || !$chked){
		$msg = "日付の指定にあやまりがあります";
	}
	
	if(!$msg){
		//上司のidを取得
		$bossList = $obj->getBossId($sec);
		$table = "jug_inquiry";
		$where = array();
		$where[ 'testgrp_id' ] = $sec;
		$where[ 'start_date' ] = $st;
		$where[ 'end_date' ] = $ed;
		$where[ 'interval' ] = $_REQUEST[ 'interval' ];
		$where[ 'status' ] = $_REQUEST[ 'status' ];
		$where[ 'regist_ts' ] = date('Y-m-d H:i:s');
		$where[ 'codes' ] = md5($sec);
		//戻り値が下記で登録するID
		$rlt = $obj->setInquery($where);

		//アンケート実施日付を取得
		$diff = (strtotime($ed) - strtotime($st)) / ( 60 * 60 * 24);
//var_dump($st,$ed);
		$startday = sprintf("%04d/%02d/%02d",$_REQUEST[ 'start_year' ],$_REQUEST[ 'start_month' ],$_REQUEST[ 'start_day' ]);
		//登録数
		$total = ceil($diff/$_REQUEST[ 'interval' ]);
//var_dump(date('Y-m-d',strtotime($st." +1 day")));

		//登録しているデータを消す
		$obj->delinquiry($rlt,$bossList);
		foreach($bossList as $keys=>$vals){
			$st = "";
			$st2 = "";
			$flg = 1;
			$i=0;
			$no = 1;
			do{
				$st = date('Y-m-d',strtotime($startday." +".$i." day"));
				$st2 = preg_replace("/\-/","/",$st);
				$i += $_REQUEST[ 'interval' ];
				$interval = $_REQUEST[ 'interval' ]-1;
				$end = date('Y-m-d',strtotime($st2." +".$interval." day"));
				if($end > $ed ) $end = $ed;
				
				if($st >= $ed){
					$flg = 0;
					break;
				}
				$obj->setinquiryText($st,$end,$rlt,$vals[ 'id' ],$no,$total);
				$no++;
/*
var_dump($st,$end,$rlt);
print "<br >";
*/
			}while($flg);
		}
		$msg = "データの更新をおこないました";
	}
}
$where = array();
$where[ 'testgrp_id' ] = $sec;
$rlt = array();
$rlt = $obj->getInquery($where);
$code = base64_encode($rlt[ "dir" ]);
$ex1 = explode("-",$rlt[ 'start_date' ]);
$ex2 = explode("-",$rlt[ 'end_date' ]);
$year1  = $ex1[0];
$month1 = $ex1[1];
$day1   = $ex1[2];
$year2  = $ex2[0];
$month2 = $ex2[1];
$day2   = $ex2[2];

//現在のアンケート回答数
$anqCnt = $obj->getAnqCount($where);


?>