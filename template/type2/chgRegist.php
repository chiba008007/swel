<?PHP
$css1 = "ptnChg";
$title = "AMS:パートナー情報更新画面";
$ptitle = "パートナー情報更新画面";
$map = true;
$js = array("ptnChg");

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
				"パートナー企業情報変更"
			),
		);
if($basetype == 2){
	$pan = array(
			array(
				"",
				"パートナー企業情報変更"
			),
		);
	
}
include_once("include_title.php");
?>
			<div class="center">
				<p>パートナー情報変更完了しました。</p>
				<p><a href="/">一覧に戻る</a></p>
			</div>
			<br clear=all />
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>

