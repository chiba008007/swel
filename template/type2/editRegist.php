<?PHP
$css1 = "edit";
$title = "AMS:企業更新画面";
$js = array("edit");
$map = true;
$drop = true;
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
				"企業情報更新"
			)
			
		);
if($basetype == 2){
	$pan = array(
			array(
				"",
				"企業情報更新"
			)

		);
}
include_once("include_title.php");
?>
	<div id="searchTitle">企業情報更新</div>

	<div id="registDiv">
		<p>登録完了しました。</p>
		<p><a href="/">検査一覧に戻る</a></p>
	</div>
	
	
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
