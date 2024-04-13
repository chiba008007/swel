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
		<p class="delMsg">データを削除しました。</p>
		<p class="delMsg"><a href="/">一覧に戻る</a></p>
	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
