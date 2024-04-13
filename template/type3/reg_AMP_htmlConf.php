<div class="openBox">
	受検時間設定 
	<?=$_REQUEST[ 'minute_rest' ][ 'on'.$key ]?>
	<input type="hidden" name="minute_rest[on<?=$key?>]" value="<?=$_REQUEST[ 'minute_rest' ][ 'on'.$key ]?>"> 分


<?php if($basetype == 2 && $first == "reg"):?>
	<div>
		<table>
			<tr>
					<th>受検者ダウンロード設定</th>
					<td style="position:relative">
						
							<?php if($_REQUEST[ 'exam_download' ] == 1):?>
								<input type="hidden" name="exam_download" value="<?=$_REQUEST[ 'exam_download' ]?>" >
								設定する
							<?php else: ?>
								設定しない
							<?php endif;?>
					</td>
				</tr>
		</table>

			<?php if($_REQUEST[ 'pdf' ][37]):?>
				<input type="hidden" name="pdf[37]" value="on" id="pdf_37" class="chk fixchk_9" readonly="" checked>
			<?php endif;?>

	</div>
<?php endif;?>

<?php if($basetype == 2  && $first == "reg" ):?>
<div >
	<table>
		<tr>
				<th>詳細アウトプットの設定</th>
				<td style="position:relative">
					<input type="hidden" name="pdf37_detail_flag" value="<?=$_REQUEST[ 'pdf37_detail_flag' ]?>" >
					<div style="position:absolute;top:0px;left:40px;width:200px;">
						<?php if($_REQUEST[ 'pdf37_detail_flag' ]):?>
							設定する
							<?php else: ?>
							設定しない
							<?php endif; ?>
					</div>
				</td>
			</tr>
	</table>
</div>
<?php endif; ?>
</div>
