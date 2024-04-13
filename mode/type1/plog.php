<?PHP
//-------------------------------------------
//PDFログ一覧表示
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_plog.php");
$plog = new plogMethod();


if($_REQUEST['partner_name']){
	$where['partner_name'] = $_REQUEST['partner_name'];
}

if($_REQUEST['customer_name']){
	$where['customer_name'] = $_REQUEST['customer_name'];
}

if($_REQUEST['test_name']){
	$where['test_name'] = $_REQUEST['test_name'];
}

if($_REQUEST['exam_id']){
	$where['exam_id'] = $_REQUEST['exam_id'];
}

if($_REQUEST['pdf_type']){
	$where['pdf_type'] = $_REQUEST['pdf_type'];
}

if($_REQUEST['output_auth']){
	$where['output_auth'] = $_REQUEST['output_auth'];
}

if($_REQUEST[ 'year1' ] && $_REQUEST[ 'month1' ] && $_REQUEST[ 'day1' ]){
	$where[ 'from' ] = sprintf("%04d-%02d-%02d",$_REQUEST[ 'year1' ] ,$_REQUEST[ 'month1' ] ,$_REQUEST[ 'day1' ]);

}
if($_REQUEST[ 'year2' ] && $_REQUEST[ 'month2' ] && $_REQUEST[ 'day2' ]){
	$where[ 'to' ] = sprintf("%04d-%02d-%02d",$_REQUEST[ 'year2' ],$_REQUEST[ 'month2' ],$_REQUEST[ 'day2' ])." 23:59:59";
	
}

$offset = 100;
$p = sprintf("%d",$sec);

$limit[ 'offset'  ] = $offset * $p;
$limit[ 'limit'   ] = $offset;

if($_REQUEST[ 'select' ]){
	$limit[ 'id' ] = $_REQUEST[ 'select' ];
}

if($_REQUEST[ 'wid' ]){
	$html = "logpdf";
	$limit[ 'id' ] = $_REQUEST[ 'wid' ];
	$logdata = $plog->getPdfLogData($limit,1);

}else{
	$logdata = $plog->getPdfLogData($limit,"",$where);
}


if(count($logdata)){
	foreach($logdata as $key=>$val){
		$logdata[$key][ 'output_auth' ] = strtr($logdata[$key]['output_auth'], $pdf_auth);
		$ex  = explode(":",$val[ 'pdf_type' ]);
		$pdfline = "";
		foreach($ex as $keys=>$vals){
			$pdfline .= $array_pdf[ $vals ]."<br />";
		}
		$logdata[ $key ][ 'pdf_type' ] = $pdfline;
	}
	$max = $plog->rmaxd;

	$all = $max;
	$limit = $offset;
	$ceil = ceil($all/$offset)-1;
}
?>