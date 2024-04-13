<?PHP
//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusCsvFm.php");

$obj = new cusCsvFmMethod();
$where[ 'customer_id' ] = $id;
$where[ 'partner_id'  ] = $ptid;
$where[ 'testgrp_id'  ] = $sec;

$data = $obj->getData($where);

//添削テストの有無
$where = array();
$where[ 'test_id' ] = $sec;
$where[ 'type'    ] = 48;
$tensaku = $obj->tensakuSts($where);


$f = sprintf("%04d%02d%02d",date("Y"),date("m"),date("d"));
$file = "format_".$f;


header("Content-Type: application/octet-stream");
header("Content-type: application/x-csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$file.".csv");


echo'番号'.",";
echo'ID'.",";
echo'氏名'.",";
echo'ふりがな'.",";
echo'生年月日'.",";
echo'メモ1'.",";
echo'メモ2'.",";
if($tensaku){
	echo '添削者名'.",";
	echo '添削者メールアドレス'.",";
}
echo "\n";
foreach($data as $key=>$val){
	echo $val[ 'number'  ].",";
	echo $val[ 'exam_id' ].",";
	echo mb_convert_encoding($val[ 'name' ],"sjis-win","utf-8").",";
	echo mb_convert_encoding($val[ 'kana' ],"sjis-win","utf-8").",";
	echo $val[ 'birth' ].",";
	echo mb_convert_encoding($val[ 'memo1' ],"sjis-win","utf-8").",";
	echo mb_convert_encoding($val[ 'memo2' ],"sjis-win","utf-8").",";
	echo mb_convert_encoding($val[ 'tensaku_name' ],"sjis-win","utf-8").",";
	echo mb_convert_encoding($val[ 'tensaku_mail' ],"sjis-win","utf-8").",";
	
	echo "\n";
}
exit();
?>