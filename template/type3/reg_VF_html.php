<?PHP
	$vf_object = $_REQUEST[ 'vf4_object' ][$key];

	if($detail[ $key ][ 'vf4_object' ] && !$_REQUEST[ 'vf4_object' ][$key]){
		$vf_object = $detail[ $key ][ 'vf4_object' ];
	}
?>
<div class="openBox">
	検査対象者入力 <input type="text" name="vf4_object[<?=$key?>]" value="<?=$vf_object?>" class="vf4Text"><br />
	<span class="regMsg">ガイダンスで表示される検査対象者を入力してください。未入力の場合は社員（または契約社員等）と表示されます。</span>
</div>
