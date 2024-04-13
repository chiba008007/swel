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
			<p>※は必須項目です。</p>
			<table id="table">
				<tr>
					<th class="w100">担当者氏名※</th>
					<td class="left">
						<?=$_REQUEST[ 'rep_name'  ]?>
						<input type="hidden" name="rep_name" value="<?=$_REQUEST[ 'rep_name'  ]?>">
						</td>
				</tr>
				<tr>
					<th class="w100">担当者アドレス※</th>
					<td class="left">
						<?=$_REQUEST[ 'rep_email'  ]?>
						<input type="hidden" name="rep_email" value="<?=$_REQUEST[ 'rep_email'  ]?>">
					</td>
				</tr>
			</table>
			<input type="submit" name="chgBack" value="戻る" class="button">
			<input type="submit" name="chgEdit" value="変更する" class="button">

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
