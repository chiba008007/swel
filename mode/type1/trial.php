<?PHP
//-------------------------------------------
//パートナー情報一覧表示
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_trial.php");

$obj = new trialMethod();

$limit = 30;
if($_REQUEST[ 'lists' ]){
	$where = array();
	$limit = 30;
	$p = sprintf("%d",$_REQUEST[ 'pages' ]);
	
	$where[ 'eir_id'     ] = $id;
	$where[ 'temp_flg'   ] = 1;
	$where[ 'pt'         ] = $_REQUEST[ 'pt' ];
	$where[ 'cs'         ] = $_REQUEST[ 'cs' ];

	$where[ 'limit' ] = $limit;
	$where[ 'offset' ] =  $limit * $p;
	$partner = $obj->getPartner($where);
	if($partner && count($partner)){
?>
<?PHP
		foreach($partner as $key=>$val){

?>
	<tr>
		<td class="w1"><?=$val[ 'ptname' ]?></td>
		<td class="w1"><?=$val[ 'cname' ]?></td>
		<td class="center"><?=$val[ 'number' ]?></td>
		<td class="center"><?=$val[ 'sumi' ]?></td>
		<td class="center"><?=$val[ 'mi' ]?></td>
		<td class="center"><?=$val[ 'zan' ]?></td>
		<td class="center"><?=$val[ 'registtime' ]?></td>

	</tr>

<?PHP
		}
?>
<?PHP
	}
exit();
}

//全体の件数取得
$where = array();
$where[ 'eir_id'     ] = $id;
$where[ 'temp_flg'   ] = 1;
$row = $obj->getPartnerRow($where);
$ceil = ceil($row/$limit)-1;

?>