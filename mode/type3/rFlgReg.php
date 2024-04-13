<?PHP
//-------------------------------------------
//一括データ登録
//利用されるのはswitchにあるテスト型のみ
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusRFlgReg.php");

$obj = new cusRFlgRegMethod();

$where = array();
preg_match("/^[0-9]*/",$sec,$match);
$sec = $match[0];
$where[ 'partner_id'  ] = $ptid;
$where[ 'customer_id' ] = $id;
$where[ 'test_id'     ] = $sec;
$test = $obj->getTest($where);
if($four == 'TRUE' ){
	$alert = "データの登録を行いました。";
}
if(is_numeric($third)){
	//ファイルアップロード
	setlocale(LC_ALL, "ja_JP.utf-8");

	if($_FILES[ 'upfile' ][ 'tmp_name' ]){
		$fp = fopen($_FILES["upfile"]["tmp_name"], "r");
	
		switch($third){
			case "1":
				//BA
				include_once("./mode/type3/keisan/BA.php");
			break;
			case "2":
				//BA2
				include_once("./mode/type3/keisan/BA2.php");
			break;
			case "12":
				//BA3
				include_once("./mode/type3/keisan/BA12.php");
			break;
			case "36":
				//NL2
				include_once("./mode/type3/keisan/NL2.php");
			break;
			case "6":
				//SA
				include_once("./mode/type3/keisan/SA.php");
			break;
			case "37":
				//SA2
				include_once("./mode/type3/keisan/SA2.php");
			break;
			case "7":
				//EA-BJ
				include_once("./mode/type3/keisan/EAB.php");
			break;
			default:
				$alert = "こちらのデータは登録フォームが存在しません。";
				$alert .= "\n問い合わせいただければ作成します。【管理者のみ】";
			break;
		}//switch終わり
	}//$_FILES終わり
	
	$html = "rFlgRegUp";
}
?>