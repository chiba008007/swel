			<div class="openBox">

				受検時間設定 
				<select name="minute_rest[on<?=$key?>]" >
<?PHP
					for($i=20;$i<=65;$i=$i+5){
						$sel = "";

						if(isset($detail[ $key ][ 'minute_rest' ]) && $detail[ $key ][ 'minute_rest' ] == $i && !$_REQUEST[ 'minute_rest' ][ 'on'.$key ]){
							$sel = "SELECTED";
						}
						if(!$_REQUEST['minute_rest']['on'.$key] && $i == 60 && !isset($detail[ $key ][ 'minute_rest' ])){
							$sel = "SELECTED";
						}
						if($_REQUEST['minute_rest']['on'.$key] == $i ){
							$sel = "SELECTED";
						}
						
?>
						<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP
					}
?>
				</select> 分
			</div>
			<div class="openBox">
<?PHP
				foreach($array_tamen_type as $k=>$v){
					$tm = "off";
					$chk = "";
					if(isset($detail[ $key ][ 'tamen_type' ]) && $detail[ $key ][ 'tamen_type' ][$k] && !$_REQUEST[ 'tamen_type' ]){
						$chk = "CHECKED";
						$tm = "on";
					}
					if($_REQUEST[ 'tamen_type' ][$k]){
						$tm = "on";
						$chk = "CHECKED";
					}
?>
					<div class="taleft">
						<input type="checkbox" name="tamen_type[<?=$k?>]" value="<?=$k?>"  id="ta_<?=$k?>" <?=$chk?> class="tamen_type">
						<img src="/images/checkbox_<?=$tm?>.jpg" id="taImg_<?=$k?>" class="tamen_typeImg">
					</div>
					<div class="taleft2">
						<label for="ta_<?=$k?>" ><span class="taMsg"><?=$v?></label>
					</div>
					<br />
<?PHP
				}
?>				
			</div>
