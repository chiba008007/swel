<?PHP
//-------------------------------------------
//お知らせ情報
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_info.php");

$obj = new infoMethod();

//データの削除
if($_REQUEST[ 'del' ] && count($_REQUEST[ 'del' ])){
	foreach($_REQUEST[ 'del' ] as $key=>$val){
		$where = array();
		$where[ 'id' ] = $key;
		$obj->deleteInfo($where);
	}
}

//お知らせ情報取得
$info = $obj->getInfo();


if($_REQUEST[ 'lists' ]){
	$where[ 'id' ] = $_REQUEST[ 'id' ];
	$list = $obj->getInfo($where);
	$ex = preg_replace("/:/",",",$list[0][ 'disp_id_list' ]);
	$user = $obj->getUserLine($ex);
	if(count($user)){
		foreach($user as $key=>$val){
			$echo .= "<div>".$val[ 'name' ]."</div>";
		}
	}
	echo $echo;
	exit();
}

?>