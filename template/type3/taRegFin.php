<?PHP
$css1 = "taReg";
$title = "AMS:検査削除画面";
$js = array("taReg");
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
		<div id="dataTitle">多面評価検査内容登録</div>

		<p class="red">登録成功しました。</p>

	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
