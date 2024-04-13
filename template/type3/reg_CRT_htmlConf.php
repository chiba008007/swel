<div class="openBox">
<p>■添削項目選択</p>
<?PHP
if($_REQUEST[ 'array_tensaku_title' ]){
	foreach($_REQUEST[ 'array_tensaku_title' ] as $key=>$val){
?>
		■<?=$array_tensaku_title[$val]?>
		<input type="hidden" name="array_tensaku_title[<?=$key?>]" value="<?=$val?>" >
		<br />
		<table>

<?PHP
		foreach($_REQUEST[ 'tensakukey' ][ $val ] as $keys=>$val){
?>
			<tr>
				<td>
					　<?=$array_tensaku[ $key ][ $keys ]?>
				</td>
				<td>
					<input type="hidden"  name="tensakukey[<?=$key?>][<?=$keys?>]" value="on" >
				</td>
			</tr>
<?PHP
		}
?>
		</table>
<?PHP
	}
}
?>

</div>
