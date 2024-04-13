<?PHP
	if($_REQUEST[ 'stress' ][$key]){
?>
	<div class="openBox">
		<input type="hidden" value="<?=$_REQUEST[ 'stress' ][$key]?>" name="stress[<?=$key?>]" >
		３要素を用いるストレス共生力算出
	</div>
<?PHP
	}
?>



<?PHP
	if($_REQUEST[ 'download_excel' ][$key]){
     $dkey = $_REQUEST[ 'download_excel' ][$key];     
?>
	<div class="openBox">
    <p>■エクセルの追加列の選択</p>
		<input type="hidden" value="<?=$dkey?>" name="download_excel[<?=$key?>]" >
		<?=$sitename?>(<?=$download_excel[$id][$dkey] ?>)<?=$download_excel_date[$id][ $dkey ]?>
	</div>
<?PHP
	}
?>


<?php if($basetype == 2 && $first == "reg" && ($key == 72 || $key == 91)):?>
	<div>
		<table style="border-bottom:1px dashed #ccc; width:100%;">
			<tr>
					<th style="width:200px;">受検者ダウンロード設定</th>
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


<?PHP
	if($_REQUEST[ 'weightchecked' ][$key]){
?>
	<div class="openBox">
		<input type="hidden" value="on" name="weightchecked[<?=$key?>]"  >
		重付け【<?=$val?>】
	</div>
	<div id="wTbl_<?=$key?>" >
	<table class="wtable" >
		<tr>
			<th><?=$a_element[ 'w1' ]?></th>
			<th><?=$a_element[ 'w2' ]?></th>
			<th><?=$a_element[ 'w3' ]?></th>
			<th><?=$a_element[ 'w4' ]?></th>
			<th><?=$a_element[ 'w5' ]?></th>
			<th><?=$a_element[ 'w6' ]?></th>
			<th><?=$a_element[ 'w7' ]?></th>
		</tr>
		<tr>
			<td><?=$_REQUEST[ 'weight' ][$key]['w1']?><input type="hidden" name="weight[<?=$key?>][w1]" value="<?=$_REQUEST[ 'weight' ][$key]['w1']?>" ></td>
			<td><?=$_REQUEST[ 'weight' ][$key]['w2']?><input type="hidden" name="weight[<?=$key?>][w2]" value="<?=$_REQUEST[ 'weight' ][$key]['w2']?>" ></td>
			<td><?=$_REQUEST[ 'weight' ][$key]['w3']?><input type="hidden" name="weight[<?=$key?>][w3]" value="<?=$_REQUEST[ 'weight' ][$key]['w3']?>" ></td>
			<td><?=$_REQUEST[ 'weight' ][$key]['w4']?><input type="hidden" name="weight[<?=$key?>][w4]" value="<?=$_REQUEST[ 'weight' ][$key]['w4']?>" ></td>
			<td><?=$_REQUEST[ 'weight' ][$key]['w5']?><input type="hidden" name="weight[<?=$key?>][w5]" value="<?=$_REQUEST[ 'weight' ][$key]['w5']?>" ></td>
			<td><?=$_REQUEST[ 'weight' ][$key]['w6']?><input type="hidden" name="weight[<?=$key?>][w6]" value="<?=$_REQUEST[ 'weight' ][$key]['w6']?>" ></td>
			<td><?=$_REQUEST[ 'weight' ][$key]['w7']?><input type="hidden" name="weight[<?=$key?>][w7]" value="<?=$_REQUEST[ 'weight' ][$key]['w7']?>" ></td>
		</tr>
		<tr>
			<th><?=$a_element[ 'w8'  ]?></th>
			<th><?=$a_element[ 'w9'  ]?></th>
			<th><?=$a_element[ 'w10' ]?></th>
			<th><?=$a_element[ 'w11' ]?></th>
			<th><?=$a_element[ 'w12' ]?></th>
			<th>平均点</th>
			<th>標準偏差値</th>
		</tr>
		<tr>
			<td><?=$_REQUEST['weight'][$key]['w8' ]?><input type="hidden" name="weight[<?=$key?>][w8]"  value="<?=$_REQUEST['weight'][$key]['w8' ]?>" ></td>
			<td><?=$_REQUEST['weight'][$key]['w9' ]?><input type="hidden" name="weight[<?=$key?>][w9]"  value="<?=$_REQUEST['weight'][$key]['w9' ]?>" ></td>
			<td><?=$_REQUEST['weight'][$key]['w10']?><input type="hidden" name="weight[<?=$key?>][w10]" value="<?=$_REQUEST['weight'][$key]['w10']?>" ></td>
			<td><?=$_REQUEST['weight'][$key]['w11']?><input type="hidden" name="weight[<?=$key?>][w11]" value="<?=$_REQUEST['weight'][$key]['w11']?>" ></td>
			<td><?=$_REQUEST['weight'][$key]['w12']?><input type="hidden" name="weight[<?=$key?>][w12]" value="<?=$_REQUEST['weight'][$key]['w12']?>" ></td>
			<td><?=$_REQUEST['weight'][$key]['ave']?><input type="hidden" name="weight[<?=$key?>][ave]" value="<?=$_REQUEST['weight'][$key]['ave']?>" ></td>
			<td><?=$_REQUEST['weight'][$key]['sd' ]?><input type="hidden" name="weight[<?=$key?>][sd]"  value="<?=$_REQUEST['weight'][$key]['sd' ]?>" ></td>
		</tr>
	</table>
	</div>
<?PHP
	}
?>


