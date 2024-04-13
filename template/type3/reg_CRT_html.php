<?php
/*仕様
カテゴリを選択しその中から選択
例
公務員の1.2
その他の１
等

*/
$edit = "";
//編集のときは変更しない
if($first == "edit") $edit = "readonly";

?>
<div class="openBox">
<p>添削項目選択</p>

<?PHP
$ex = array();
$ex = explode(";",$detail[ $key ][ 'tensaku_title' ]);
$ex2 = array();
$ex2 = explode(";",$detail[ $key ][ 'array_tensaku_text' ]);

foreach($array_tensaku_title as $keys=>$val){
	$sel = "";
	if(!$_REQUEST[ 'back' ] && in_array($keys,$ex) ) $sel = "CHECKED";
	if($keys == $_REQUEST[ 'array_tensaku_title' ][ $keys ] ) $sel = "CHECKED";

?>
	<input type="checkbox" name="array_tensaku_title[<?=$keys?>]" value="<?=$keys?>" <?=$sel?> id="array_tensaku_title_<?=$keys?>_<?=$key?>" class="array_tensaku_title  <?=$edit?>" ><?=$val?><br />


<div id="tensakuLine_<?=$keys?>_<?=$key?>" class="tensakuDiv">
<table>
<?PHP

foreach($array_tensaku[$keys] as $key2=>$val2){
	$check = "";
	if(!$_REQUEST[ 'back' ] && in_array($key2,$ex2) ) $check = "CHECKED";
	if($_REQUEST[ 'tensakukey' ][ $keys ][ $key2 ]){
		$check = "CHECKED";
	}
?>
		<tr>
			<td>
				<input type="checkbox" class="chk <?=$edit?>" name="tensakukey[<?=$keys?>][<?=$key2?>]" value="on" id="tensakukey_<?=$key2?>" <?=$check?>  >
			</td>
			<td>
				<label for="tensakukey_<?=$key2?>"><?=$val2?></label>
			</td>
		</tr>
<?PHP
}
?>
	</table>
	</div>

<?PHP
}
?>

</div>
