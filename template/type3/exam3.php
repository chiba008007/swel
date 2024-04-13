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
				<li class="act" ><p>3.注文確認画面</p></li>
			</ul>

			<div class="clear">
				<div class="div80 pd10 bb">
					<p class="left">1・検査申込</p>
					<p class="left ml20"><?=$array_application[$_REQUEST[ 'application' ]]?></p>
<?PHP
					if($_REQUEST[ 'application' ] == 2){
?>
						<p class="left ml20">「<?=$sel[$_REQUEST[ 'stid' ]][ 'name' ]?>」</p>
<?PHP
					}
?>
					<br clear=all />
				</div>

				<div class="div80 pd10 bb">
					<p class="left">2・申込件数</p>
					<p class="left ml20"><?=$_REQUEST[ 'addcount' ]?> 件</p>
					<br clear=all />
				</div>
				<div class="div80 pd10 bb">
					<p class="left">3・注文金額</p>
					<p class="left ml20"><?=number_format($money*$a_tax)?> 円</p>
					<br clear=all />
				</div>
<?PHP
				if($_REQUEST[ 'examname' ]){
?>
				<div class="div80 pd10 bb">
					<p class="left">4・検査名</p>
					<p class="left ml20"><?=$_REQUEST[ 'examname' ]?>
						<input type="hidden" name="examname" value="<?=$_REQUEST[ 'examname' ]?>" >
					</p>
					<br clear=all />
				</div>
<?PHP
				}
?>
			</div>
			<br clear=all />
			<div class="tcenter">
				<input type="submit"  name="back2" value="戻る" class="button" id="home">
				<input type="submit" name="exam4" value="申込" class="button" id="conf">
				<input type="hidden"  name="application" value="<?=$_REQUEST[ 'application' ]?>" >
				<input type="hidden"  name="stid" value="<?=$_REQUEST[ 'stid' ]?>" >
				<input type="hidden"  name="addcount" value="<?=$_REQUEST[ 'addcount' ]?>" >
				<input type="hidden" id="pdfmoney" value="<?=$pdfmny[ 'mny' ]?>">

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
	$("#stest").click(function(){
		$("#application2").attr("checked",true);
	});
	$("#home").click(function(){
		
	});
});
//-->
</script>
<?PHP
include_once("include_footer.php");
?>
