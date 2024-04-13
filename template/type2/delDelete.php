<?PHP
$css1 = "del";
$title = "AMS:企業削除画面";
$js = array("del");
include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
$pan = array(
			array(
				"/",
				"顧客企業一覧"
			),
			array(
				"",
				"企業情報削除"
			)
			
		);

include_once("include_title.php");
?>
	<div id="searchTitle">企業情報削除</div>
	<p class="p">削除完了しました。</p>

	<a href="/" id="back">一覧に戻る</a>
	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
