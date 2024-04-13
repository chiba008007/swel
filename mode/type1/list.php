<?PHP
//-------------------------------------------
//パートナー情報一覧表示
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_list.php");

$olist = new listMethod();
$limit = 30;

//全体の件数取得
$where = array();
$where[ 'type'   ] = 2;
$where[ 'eir_id' ] = $id;
$where[ 'name'   ] = $_REQUEST[ 'text'  ];

$row = $olist->getPartnerRow($where);
$ceil = ceil($row/$limit)-1;

if($_REQUEST[ 'lists' ]){
	$where = array();
	$p = sprintf("%d",$_REQUEST[ 'pages' ]);
	$where[ 'type'   ] = 2;
	$where[ 'eir_id' ] = $id;
	$where[ 'name'   ] = $_REQUEST[ 'text'  ];
	if(!$_REQUEST[ 'text' ]){
		$where[ 'offset' ] = $limit * $p;
		$where[ 'limit'  ] = $limit;
	}
	$partner = $olist->getPartner($where);
	if(count($partner)){
?>
<?PHP
		foreach($partner as $key=>$val){

?>
	<tr>
		<td class="w1"><?=$val[ 'name' ]?></td>
		<td><?=number_format($val[ 'license' ])?></td>
		<td><?=number_format($val[ 'buy' ])?></td>
		<td><?=number_format($val[ 'remain' ])?></td>
		<td><?=number_format($val[ 'syori' ])?></td>
		<td><?=number_format($val[ 'zan' ])?></td>
		<td class="w2">
			<ul class="ulmenu">
				<li><a href="/index/ptn/<?=$val[ 'id' ]?>/"  >ﾊﾟｰﾄﾅｰ</a></li>
				<li><a href="/index/edit/<?=$val[ 'id' ]?>/">更新</a></li>
				<li><a href="/index/tmp/<?=$val[ 'id' ]?>">添付</a></li>
			</ul>
		</td>
	</tr>

<?PHP
		}
?>
<?PHP
	}
exit();
}



?>