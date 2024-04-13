<?PHP
$css1 = "license";
$title = "AMS:ライセンス一覧";
$js[1] = "license";
$time = true;
include_once("include_header.php");
$pan[1] = array("","ライセンス一覧");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
	<table id="table">
		<tr>
			<th>検査種別</th>
			<th >購入<br />ライセンス数</th>
			<th >販売可能<br />ライセンス数</th>
			<th >受検者数</th>
			<th >処理数</th>
			<th >残数</th>
		</tr>

		<tbody id="tbody"></tbody>
	</table>
	</div><!--contents-->
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->

<?PHP
include_once("include_footer.php");
?>
