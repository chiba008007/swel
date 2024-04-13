
			<div class="openBox">
				受検時間設定 
				<?=$_REQUEST[ 'minute_rest' ][ 'on'.$key ]?>
				<input type="hidden" name="minute_rest[on<?=$key?>]" value="<?=$_REQUEST[ 'minute_rest' ][ 'on'.$key ]?>"> 分

			</div>
			<div style="margin:10px;">
				<label>
					<?=$a_mhq[$_REQUEST[ 'mhq_type' ]['on'.$key]] ?>
					<input type="hidden" name="mhq_type[<?=$key?>]" value="<?=$_REQUEST[ 'mhq_type' ]['on'.$key]?>" />
				</label>
			</div>
