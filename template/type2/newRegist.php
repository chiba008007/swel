<?PHP
$css1 = "new";
$title = "AMS:パートナー情報登録画面";
$ptitle = "パートナー情報登録画面";
$map = true;
$js = array("new");

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
				"新規顧客登録"
			),
			
		);
if($basetype == 2){
$pan = array(
			array(
				"",
				"新規顧客登録"
			),
		);
}
include_once("include_title.php");
?>
			<div class="center">
				<p>パートナー情報登録完了しました。</p>
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

