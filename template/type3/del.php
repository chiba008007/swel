<?PHP
$css1 = "del";
$title = "AMS:検査削除画面";
$js = array("del");
//$time = true;

include_once("include_header.php");
?>

<div id="main">

	<div id="contents">
<?PHP
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
				"",
				"検査削除画面"
			),
		);

include_once("include_title.php");
?>
		<div id="dataTitle">検査削除</div>
		<p class="mg10">間違いがなければ <span class="red">[削除]</span> ボタンをクリックしてください。</p>
		<form action="/index/del/<?=$sec?>" method="POST" name="form">
		<table id="table">
			<tr>
				<th class="150">検査名</th>
				<td class="left"><?=$data[ 'name' ]?></td>
			</tr>
			<tr>
				<th class="w150">検査実施期間</th>
				<td class="left"><?=$data[ 'period_from' ]?>～<?=$data[ 'period_to' ]?></td>
			</tr>
		</table>
		<input type="submit" name="delete" value="削除" class="button" id="delete">
		</form>
	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
