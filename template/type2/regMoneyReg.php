<?PHP
$css1 = "";
$title = "AMS:検査申込料金設定";
$ptitle = "検査申込料金設定";
include_once("include_header.php");
?>
<style type="text/css">

	.w200{
		width:200px;
	}
	.w400{
		width:400px;
	}
	.center{
		margin:0 auto;
	}

</style>
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
				"検査申込料金設定"
			),
		);
if($basetype == 2){
	$pan = array(
			array(
				"",
				"検査申込料金設定"
			),
		);
	
}
include_once("include_title.php");
?>
			<div>
				<form action="" method="POST" name="form1" >
				<p style="padding:10px;text-align:center;">
					データの変更完了しました。
				</p>
				
				<div class="center w200">
				<input type="button" id="back" value="戻る" class="button">
				</div>
				</form>
			</div>
			<br clear=all />
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript" >
<!--
	$(function(){
		$("#back").click(function(){
			location.href="/";
		});
	});
//-->
</script>
<?PHP
include_once("include_footer.php");
?>

