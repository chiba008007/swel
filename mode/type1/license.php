<?PHP
//-------------------------------------------
//ライセンス
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_license.php");
$obj = new licenseMethod();



if($_REQUEST[ 'lists' ]){
	//$ko:購入ライセンス数
	//$jyu:受検者数
	//$kno:販売可能
	//$sy:処理数
	//$zan:残数
	list($ko,$jyu,$kno,$sy,$zan) = $obj->getLicense($a_test_type);
	$html = "";
	foreach($ko as $key=>$val){
		$html .= "<tr>";
		$html .= "<td class='left'>".$a_test_type[ $key ]."</td>";
		$html .= "<td >".$val."</td>";
		$html .= "<td>".$kno[ $key ]."</td>";
		$html .= "<td>".$jyu[ $key ]."</td>";
		$html .= "<td>".$sy[ $key ]."</td>";
		$html .= "<td>".$zan[ $key ]."</td>";

		$html .= "</tr>";
	}
	echo $html;
	exit();
}
?>