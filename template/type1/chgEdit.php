<?PHP
$css1 = "list";
$title = "AMS:企業情報変更画面";
$js[1] = "chg";
include_once("include_header.php");
$pan[1] = array("","管理者情報変更");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<form action="/index/chg/" method="post">
		<div id="rightBases">
		<h2>企業情報変更画面</h2>
			<div id="success">
			<p>企業情報変更しました。</p>
			</div>
			<table id="table">
				<tr>
					<th class="w100">担当者氏名※</th>
					<td class="left"><?=$_REQUEST[ 'rep_name'  ]?></td>
				</tr>
				<tr>
					<th class="w100">担当者アドレス※</th>
					<td class="left"><?=$_REQUEST[ 'rep_email'  ]?></td>
				</tr>
			</table>
		</div>
		</form>
	</div><!--contents-->

<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->

<?PHP
include_once("include_footer.php");
?>
