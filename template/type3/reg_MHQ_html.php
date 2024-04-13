
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
			</div>
<?php foreach($a_mhq as $mhq_key=>$mhq_value):
				$chk = "";
				if($_REQUEST[ 'mhq_type' ]['on'.$key] == $mhq_key || $detail[ $key ][ 'mhq_type' ] == $mhq_key) $chk = "checked";
	?>
			<div style="margin:10px;">
				<label>
					<input type="radio" name="mhq_type[on<?=$key?>]" value="<?=$mhq_key?>" <?=$chk?> />
				<?=$mhq_value?>
				</label>
			</div>
<?php endforeach; ?>
