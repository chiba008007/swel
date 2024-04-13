<?PHP
$css1 = "reg";
$title = "AMS:検査新規登録画面";
$js = array("reg");
$scroll = true;
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
				"検査新規登録"
			),
		);

if($basetype == 2){
	$pan = array(

			array(
				"/",
				"検査一覧"
			),
			array(
				"",
				"検査新規登録"
			),
		);
}
include_once("include_title.php");
?>
		
		<div id="dataTitle">新規検査登録</div>
		<p class="regFinish">登録完了しました。</p>
		<center><a href="/">一覧に戻る</a></center>
		<form action="/index/bill/<?=$tgrpid?>" method="POST" name="form" target=_blank></form>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<?PHP
if($basetype == 1){
?>
<script type="text/javascript">
<!--
$(function(){
	jConfirm('登録内容で請求書の発行を行います。よろしいですか？', '請求書発行',function(r) {
		if(r==true){
			document.form.submit();
		}
		return false;
	});
});
//-->
</script>
<?PHP
}
?>
<?PHP
include_once("include_footer.php");
?>
