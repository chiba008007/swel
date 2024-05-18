			<div class="openBox">
				受検時間設定 
				<select name="minute_rest[on<?=$key?>]" >
<?PHP
					for($i=20;$i<=65;$i=$i+5){
						$sel = "";
						if(!$_REQUEST[ 'minute_rest' ][ 'on'.$key ] && $i == 45 && !isset($detail[ $key ][ 'minute_rest' ])){
							$sel = "SELECTED";
						}
						if(isset($detail[ $key ][ 'minute_rest' ]) && $detail[ $key ][ 'minute_rest' ] == $i && !$_REQUEST[ 'minute_rest' ][ 'on'.$key ]){
							$sel = "SELECTED";
						}
						if($_REQUEST[ 'minute_rest' ][ 'on'.$key ] == $i){
							$sel = "SELECTED";
						}
?>
						<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP
					}
?>
				</select> 分

<?php if($basetype == 2 && $first == "reg"):?>
<div>
	<table>
		<tr>
				<th>受検者ダウンロード設定</th>
				<td style="position:relative">
					<input type="checkbox" name="exam_download" value="1" id="exam_download"  style="width:20px;height:22px;margin-left:20px;" >
						<div style="position:absolute;top:0;left:40px;width:200px;">設定する</div>
				</td>
			</tr>
	</table>
	<input type="hidden" name="pdf[37]" value="on"  >


</div>
<?php endif;?>
<?php if($basetype == 2 && $first == "reg" ):?>
<div >
	<table>
		<tr>
				<th>詳細アウトプットの設定</th>
				<td style="position:relative">
					<input type="checkbox" name="pdf37_detail_flag" value="1" id="pdf37_detail_flag"  style="width:20px;height:22px;margin-left:20px;margin-top:5px;" >
						<div style="position:absolute;top:5px;left:40px;width:200px;">設定する</div>
				</td>
			</tr>
	</table>
</div>
<?php endif; ?>
</div>
