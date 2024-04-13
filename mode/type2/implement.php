<?PHP
//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_implement.php");

$obj = new implementMethod();
if($_REQUEST[ 'flg' ] == "xls"){
	$fpath = './excel/download.xls';
	//ファイル名
	$fname = time().'.xls';
	header('Content-Type: application/force-download');
	header('Content-Length: '.filesize($fpath));
	header('Content-disposition: attachment; filename="'.$fname.'"');
	readfile($fpath);
	exit();
}
if($_REQUEST[ 'flg' ] == "download"){
/*
	require_once './lib/Classes/PHPExcel.php';
	require_once './lib/Classes/PHPExcel/IOFactory.php';
*/
	include_once("./lib/reviser.php");
	$reviser = NEW Excel_Reviser;
	
	$where = array();
	$where[ 'cid' ] = $_REQUEST[ 'cid' ];
	$cdata = $obj->getCusData($where);
	
	$where = array();
	$where[ 'partner_id'  ] = $id;
	$where[ 'customer_id' ] = $_REQUEST[ 'cid' ];
	$where[ 'date1'       ] = $_REQUEST[ 'date1' ];
	$where[ 'date2'       ] = $_REQUEST[ 'date2' ];
	$clist = $obj->getListData($where);
	$reviser->addString(0, 2, 1, $_REQUEST[ 'date1' ]);
	$reviser->addString(0, 2, 2, $_REQUEST[ 'date2' ]);
	$reviser->addString(0, 3, 1, mb_convert_encoding($cdata[ 'name' ],"eucJP-win","UTF-8"));
	
	if(count($clist)){
		$row=7;
		foreach($clist as $key=>$val){
			$reviser->addString(0,$row,0, $val[ 'exam_id'   ],0,0,1);
			$reviser->addString(0,$row,1, $val[ 'exam_date' ],0,0,1);
			$reviser->addString(0,$row,2, mb_convert_encoding($val[ 'tname' ],"eucJP-win","UTF-8"),0,0,1);
			$reviser->addString(0,$row,3, mb_convert_encoding($a_test_type[$val[ 'type' ]],"eucJP-win","UTF-8"),0,0,1);
			$row++;
		}
	}
	$reviser->rmSheet(1);
	//読み込みエクセルファイル名
	$readfile   = './excelTemp/download.xls';
	//書き込みファイル名
	$outfile    = 'download.xls';
	//保存先（相対パス）
	$savepath = './excel';
	
	$reviser->reviseFile($readfile,$outfile,$savepath);

	exit();
}
if($_REQUEST[ 'flg' ] == "setting"){
	$testimp = implode("','",$_REQUEST[ 'array' ]);
	$where = array();
	$where[ 'testimp' ] = $testimp;
	$where[ 'date1'  ] = $_REQUEST[ 'date1' ];
	$where[ 'date2'  ] = $_REQUEST[ 'date2' ];
	$data = $obj->getListData($where);
	echo json_encode($data);
	exit();
}
if($_REQUEST[ 'flg' ] == "on"){
	//検査データ取得
	$where[ 'partner_id'  ] = $id;
	$where[ 'customer_id' ] = $_REQUEST[ 'cid' ];
	$where[ 'date1'       ] = $_REQUEST[ 'date1' ];
	$where[ 'date2'       ] = $_REQUEST[ 'date2' ];
	$test = $obj->getTestData($where);
	//header('Content-type: application/json');
	echo json_encode($test);
	exit();
}
$where = array();
$where[ 'ptid' ] = $id;
$list = $obj->getUserData($where);

?>