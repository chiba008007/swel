<?PHP
//-------------------------------------------
//ŽóŒŸŽÒˆê——•\Ž¦
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_tst.php");

$otst = new tstMethod();

$offset = 50;

$p = sprintf("%d",$sec);
$limit[ 'offset'  ] = $offset * $p;
$limit[ 'limit'   ] = $offset;

$where = array();
$where[ 'exam_id'  ] = $_REQUEST[ 'search_id' ];
$where[ 'company'  ] = $_REQUEST[ 'company'   ];
$where[ 'username' ] = $_REQUEST[ 'username'  ];

if($_REQUEST['search_year'] && $_REQUEST[ 'search_month' ] && $_REQUEST[ 'search_day' ]){
	$where[ 'ex_date'    ] = sprintf("%04d/%02d/%02d"
					,$_REQUEST[ 'search_year' ],$_REQUEST[ 'search_month' ],$_REQUEST[ 'search_day' ]);
	$where[ 'fin_date'    ] = sprintf("%04d-%02d-%02d"
					,$_REQUEST[ 'search_year' ],$_REQUEST[ 'search_month' ],$_REQUEST[ 'search_day' ]);
}
$list = $otst->getSearchDataSt($where,$limit);
$row = $otst->row;
$ceil = ceil($row/$offset);

?>