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
				<li class="act"><p>2.検査名・追加数</p></li>
				<li ><p>3.注文確認画面</p></li>
			</ul>
			<div class="clear">

			<div class="clear">
<?PHP
			if($errmsg){
?>
				<div class="errmsg pd10 div80"><?=$errmsg?></div>
<?PHP
			}
?>


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
					<p class="left">2・検査金額</p>
					<p class="left ml20"><span id="money" >0</span>円</p>
					<br clear=all />
				</div>
<?PHP
				if($_REQUEST[ 'application' ] == 1){
?>
					<div class="div80 pd10" >
						<p>検査名を入力してください。</p>
						<input type="text" name="examname" id="examname" value="<?=$_REQUEST[ 'examname' ]?>" class="pd10" style="width:350px;" >
					</div>
<?PHP
				}
?>
				<div class="div80 pd10" >
					<p>何件追加しますか？</p>
					<input type="text" name="addcount" id="addcount" value="<?=$_REQUEST[ 'addcount' ]?>" class="pd10 w10" >件
				</div>
			</div>
			<br clear=all />
			<div class="tcenter">
				<input type="submit"  value="戻る" class="button" id="home">
				<input type="submit" name="exam3" value="次へ" class="button" id="conf">
				<input type="hidden"  name="application" id="application"  value="<?=$_REQUEST[ 'application' ]?>" >
				<input type="hidden"  name="stid" id="stid" value="<?=$_REQUEST[ 'stid' ]?>" >
				<input type="hidden" id="tax" value="<?=$a_tax?>">
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
	$(this).setMoney();
	
	$("#addcount").keyup(function(){
		$(this).setMoney();
	});
});
$.fn.setMoney = function(){
	var _add = $("#addcount").val();
	var _application = $("#application").val();
	var _stid = $("#stid").val();

	var _data = {"flg":"money","application":_application,"stid":_stid};
	var _url = "location.href";
	$.ajax({
	    url: _url,
	    type: 'POST',
	    data: _data,
		cache : false,
	    success: function( lists ) {
			var tax = $("#tax").val();
			//var pdfmoney = $("#pdfmoney").val();
			//var _m = number_format(Math.floor((lists*_add*tax)+(pdfmoney*_add*tax)));
			var _m = number_format(Math.floor((lists*_add*tax)));

			$("#money").html(_m);

	    }
	});
}

function number_format(num) {
  return num.toString().replace(/([0-9]+?)(?=(?:[0-9]{3})+$)/g , '$1,')
}

//-->
</script>
<?PHP
include_once("include_footer.php");
?>
