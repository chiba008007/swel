			<div class="openBox">
				受検時間設定 
				<select name="minute_rest[on<?=$key?>]" >
<?PHP
					for($i=10;$i<=90;$i=$i+10){
						$sel = "";
						if(isset($detail[ $key ][ 'minute_rest' ]) && $detail[ $key ][ 'minute_rest' ] == $i && !$_REQUEST[ 'minute_rest' ][ 'on'.$key ]){
							$sel = "SELECTED";
						}

						if($i == 60 && !$_REQUEST[ 'minute_rest' ][ 'on'.$key ] && !isset($detail[ $key ][ 'minute_rest' ])){
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

