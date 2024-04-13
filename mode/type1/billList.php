<?PHP
//-------------------------------------------
//¿‹‘ˆê——•\Ž¦
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_billList.php");
$blist = new billListMethod();

$where = array();
$where[ 'id' ] = $id;
$user = $db->getUser($where);


$where = array();
$where[ 'eir_id' ] = $id;



/*
if($_REQUEST[ 'datepic' ]){
	$update_ts = preg_replace("/\//","-",$_REQUEST[ 'datepic' ]);
}
*/
if($sec == "del"){
	//¿‹‘ƒf[ƒ^íœ
	$del = array();
	$del['id'] = $_REQUEST[ 'id' ];
	$blist->deleteBillData($del);
	
	exit();
}

if($_REQUEST[ 'tekikakuNumberFlag' ]){
	$table = "t_user";
	$where = [];
	$where[ 'where' ][ 'id' ] = $id;
	$where[ 'edit'  ][ 'tekikakuNumber' ] = $_REQUEST[ 'tekikakuNumber' ];
	$db->editUserData($table,$where);
	exit();
}


if( !($_REQUEST[ 'down' ] && strlen($_REQUEST['down0'])) ){
	if( $_REQUEST['down'] ) $where[ 'download_status' ] = 1;
	if( strlen($_REQUEST['down0']) && $_REQUEST['down0'] == 0 ) $where[ 'download_status' ] = 0;
}


if( $_REQUEST['bill_num']     ) $where[ 'bill_num'         ] = $_REQUEST[ 'bill_num'     ];
if( $_REQUEST['partner_name'] ) $where[ 'name'             ] = $_REQUEST[ 'partner_name' ];
if( $_REQUEST['title']        ) $where[ 'title'            ] = $_REQUEST[ 'title'        ];
if( $_REQUEST['down1']        ) $where[ 'download_status'  ] = 1;
if( $_REQUEST['down0']        ) $where[ 'download_status'  ] = 0;
if( $_REQUEST['down0'] && $_REQUEST['down1'] ) $where[ 'download_status'  ] = "";
if( $_REQUEST['datepic']      ) $where[ 'pay_date'  ] = preg_replace("/\//","-",$_REQUEST[ 'datepic' ]);
if( $_REQUEST['title'  ]      ) $where[ 'title'     ] = $_REQUEST[ 'title' ];



$max = $blist->getRow($where);

$offset = 20;
$maxp = ceil($max/$offset)-1;

$p = sprintf("%d",$sec);

$limit[ 'offset'  ] = $offset * $p;
$limit[ 'limit'    ] = $offset;


$bill = $blist->getUserDatabill($where,$limit);
?>