<?PHP
$css1 = "exam";
$title = "AMS:検査申込";
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
				"検査申込"
			),
		);

if($basetype == 2 || $basetype == 3){
	$pan = array(
			array(
				"/",
				"検査一覧"
			),
			array(
				"",
				"検査申込"
			),
		);
}

include_once("include_title.php");
?>
		
		<div id="dataTitle">検査申込</div>
		<form action="/index/exam/" method="POST" name="form">
			<ul class="orderbox" >
				<li ><p>1.検査申込選択</p></li>
				<li ><p>2.検査名・追加数</p></li>
				<li  ><p>3.注文確認画面</p></li>
			</ul>

			<div class="clear">
				<div class="div60 pd10">
					<p>
						このたびは検査ご注文いただきまして､ ありがとうございました。<br />
						つきましては､ご依頼いただきました検査追加処理をさせていただきます。<br />
						追加処理後ご連絡させていただきますので、少々お待ちください。
					</p>
				</div>
			</div>
			<br clear=all />
			<div class="tcenter">
				<input type="button"  value="戻る" class="button" id="home">
			</div>
			<br clear=all />

		</form>
	</div>




<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript">
<!--
$(function(){
	$("#home").click(function(){
		location.href = "/";
	});
});
//-->
</script>
<?PHP
include_once("include_footer.php");
?>
