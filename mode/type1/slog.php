<?PHP
//-------------------------------------------
//検査ログ一覧表示
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_slog.php");
$slog = new slogMethod();
$p = sprintf("%d",$sec);
$limit = 100;
$offset = $limit*$p;

$where = array();
if($_REQUEST[ 'name' ]){
	$where[ 'name' ] = $_REQUEST[ 'name' ];
}
if($_REQUEST[ 'search_year' ] && $_REQUEST[ 'search_month' ] && $_REQUEST[ 'search_day' ]){
	$where[ 'regist_ts' ] = sprintf("%04d-%02d-%02d",$_REQUEST[ 'search_year' ],$_REQUEST[ 'search_month' ],$_REQUEST[ 'search_day' ]);
}elseif($_REQUEST[ 'year' ] && $_REQUEST[ 'month' ]){
	$where[ 'regist_ts' ] = sprintf("%04d-%02d",$_REQUEST[ 'search_year' ],$_REQUEST[ 'search_month' ]);
}elseif( $_REQUEST[ 'year' ]  ){
	$where[ 'regist_ts' ] = sprintf("%04d",$_REQUEST[ 'search_year' ]);
}

if($_REQUEST[ 'csv' ]){
	$list = $slog->getLogTable($where);

	$header = array(
		"提供企業名",
		"取得企業名",
		"検査名",
		"検査種別",
		"ステータス",
		"日時",
	);
	$records = [];
	foreach($list as $key=>$value){
		$licenses = preg_replace("/\-/","",$value[ 'license_num' ]);
		$sts = "";
		switch($value[ 'status' ]){
			case "1":
				$sts = $licenses."件の追加処理";
			break;
			case "0":
			case "2":
				$sts = $licenses."件の削除処理";
			break;
		}
		$name = "";
		if($value[ 'fromname' ]){
			$name = mb_convert_encoding($value[ 'fromname' ], 'SJIS-WIN', 'UTF-8');
		}else{
			$name = mb_convert_encoding($value[ 'name' ], 'SJIS-WIN', 'UTF-8');
		}
		// if ($val[ 'flg' ] == 1){
		// 	$name .= mb_convert_encoding($value[ 'partnername' ], 'SJIS-WIN', 'UTF-8');
		// }


		$records[] = [
			$name,
			mb_convert_encoding($value[ 'partnername' ], 'SJIS-WIN', 'UTF-8'),
			mb_convert_encoding($value[ 'kensa' ], 'SJIS-WIN', 'UTF-8'),
			mb_convert_encoding($a_test_type[$value[ 'type' ]], 'SJIS-WIN', 'UTF-8'),
			mb_convert_encoding($sts, 'SJIS-WIN', 'UTF-8'),
			$value[ 'regist_ts' ],
			
		];
	}

	$head = [];
	foreach($header as $key => $val) { 
		$head[$key] = mb_convert_encoding($val, 'SJIS-WIN', 'UTF-8');  
	}

	$filename = date('Ymd');
	createCsv($filename,$head,$records);
	exit();
}
$list = $slog->getLogTable($where,$limit,$offset);
$row  = $slog->row;
$ceil = ceil($row/$limit)-1;
if(count($list)){
	foreach($list as $key=>$val){
		if($val[ 'number' ]){
			$licenses = preg_replace("/\-/","",$val[ 'number' ]);
		}else{
			$licenses = preg_replace("/\-/","",$val[ 'license_num' ]);
		}
		switch($val[ 'status' ]){
			case "1":
				$list[ $key ][ 'status2' ] = $licenses."件の追加処理";
			break;
			case "2":
			case "0":
				$list[ $key ][ 'status2' ] = $licenses."件の削除処理";
			break;
		}
		$list[ $key ][ 'reg' ] = chgregist($val[ 'regist_ts' ]);
	}
}


function createCsv($filename,$header,$records)
{
	header('Content-Type: application/octet-stream');
	header("Content-Disposition: attachment; filename=$filename.csv");

	//ファイルを開く
	$stream = fopen('php://output', 'w');
	
	//ヘッダーを書き込み
	fputcsv($stream, $header);

	//レコードを書き込み
	foreach($records as $record){
		fputcsv($stream, $record);
	}
	exit();
}


function chgregist($time){
	$line = preg_replace("/\-/","/",$time);
	return $line;
}
?>