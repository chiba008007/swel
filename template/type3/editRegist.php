<?PHP
$css1 = "edit";
$title = "AMS:検査更新画面";
$js = array("edit");
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
				"検査更新"
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
				"検査更新"
			),
		);

}

include_once("include_title.php");
?>
		
		<div id="dataTitle">検査更新登録</div>
		<p class="regFinish">登録完了しました。</p>
		<center><a href="/">検査一覧</a></center>
		<form action="/index/editBill/<?=$tgrpid?>" method="POST" name="form" target=_blank>
<?PHP
			if($hidden){
?>
				<?=$hidden?>
<?PHP
			}
?>
		</form>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<?PHP
if($basetype == 1 && $_REQUEST[ 'editMan' ] == "adds" && $_REQUEST[ 'RegNumber' ] > 0 ){
?>
<script type="text/javascript">
<!--
$(function(){
	jConfirm('登録内容で請求書の発行を行います。よろしいですか？', '請求書発行',function(r) {
		if(r==true){
			document.form.submit();
			
		}
		if(r == false){
			location.href="/index/";
		}
		return false;
	});
});

//-->
</script>
<?PHP
}
/*
else{
?>
<script type="text/javascript">
<!--
$(function(){

	alert("データ更新完了しました。検査一覧に移動します。");
	location.href="/index/";

});
//-->
</script>

<?PHP
}
*/
?>
<?PHP
include_once("include_footer.php");
?>
