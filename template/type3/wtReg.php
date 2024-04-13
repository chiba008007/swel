<?PHP
$css1 = "wt";
$title = "AMS:顧客情報一覧画面";
$js = array("wt");
$time = true;

include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
if($basetype == 1){
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
				"/index/wt/",
				"重みマスタ"
			),
			array(
				"",
				"新規登録"
			),
		);
}
if($basetype == 2){
	$pan = array(

			array(
				"/",
				"検査一覧"
			),
			array(
				"/index/wt/",
				"重みマスタ"
			),
			array(
				"",
				"新規登録"
			),
		);

}
include_once("include_title.php");
?>
	<form action="" method="POST" >
		<br clear=all />
		<p>登録完了しました。</p>
		<br clear=all />

		<input type="button" name="back" id="back" value="一覧に戻る"  class="button" >
	</form>

</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
