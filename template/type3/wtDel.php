<?PHP
$css1 = "wt";
$title = "AMS:顧客情報一覧画面";
$js = array("wt");
$time = true;

include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
if($basetype == 1){
	$pan = array(
			array(
				"/index/ptn/".$ptid,
				"顧客企業一覧"
			),
			array(
				"/",
				"検査一覧"
			),
			array(
				"/index/wt/",
				"重みマスタ"
			),
			array(
				"",
				"削除"
			),
		);
}
if($basetype == 2){
	$pan = array(

			array(
				"/",
				"検査一覧"
			),
			array(
				"/index/wt/",
				"重みマスタ"
			),
			array(
				"",
				"削除"
			),
		);

}
include_once("include_title.php");
?>
	<form action="" method="POST" >
		<br clear=all />
		▼マスター名<br /><?=$master_name?>
		<br clear=all />
		<br clear=all />
		<table id="table">
			<tr>
				<th><?=$element[ 'e_feel' ]?></th>
				<th><?=$element[ 'e_cus'  ]?></th>
				<th><?=$element[ 'e_aff'  ]?></th>
				<th><?=$element[ 'e_cntl' ]?></th>
				<th><?=$element[ 'e_vi'   ]?></th>
				<th><?=$element[ 'e_pos'  ]?></th>
			</tr>
			<tr>
				<td><?=$e_feel?></td>
				<td><?=$e_cus?></td>
				<td><?=$e_aff?></td>
				<td><?=$e_cntl?></td>
				<td><?=$e_vi?></td>
				<td><?=$e_pos?></td>
			</tr>
			<tr>
				<th><?=$element[ 'e_symp' ]?></th>
				<th><?=$element[ 'e_situ' ]?></th>
				<th><?=$element[ 'e_hosp' ]?></th>
				<th><?=$element[ 'e_lead' ]?></th>
				<th><?=$element[ 'e_ass'  ]?></th>
				<th><?=$element[ 'e_adap' ]?></th>
			</tr>
			<tr>
				<td><?=$e_symp?></td>
				<td><?=$e_situ?></td>
				<td><?=$e_hosp?></td>
				<td><?=$e_lead?></td>
				<td><?=$e_ass?></td>
				<td><?=$e_adap?></td>
			</tr>
			<tr>
				<th>平均点</th>
				<th>標準偏差値</th>
			</tr>
			<tr>
				<td><?=$avg?></td>
				<td><?=$hensa?></td>
			</tr>
		</table>
		<br />
		<input type="button" name="back" id="back" value="一覧に戻る"  class="button" >
		<input type="submit" name="delete" id="delete" value="削除"  class="button" >
	</form>

</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
