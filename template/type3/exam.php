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
				<li class="act"><p>1.検査申込選択</p></li>
				<li><p>2.検査名・追加数</p></li>
				<li><p>3.注文確認画面</p></li>
			</ul>
			<div class="clear">
<?PHP
			if($errmsg){
?>
				<div class="errmsg pd10 div80"><?=$errmsg?></div>
<?PHP
			}
?>
<?PHP
				$chk1 = "";
				$chk2 = "";
				if($_REQUEST[ 'application' ] == 1) $chk1 = "CHECKED";
				if($_REQUEST[ 'application' ] == 2) $chk2 = "CHECKED";

?>
				<div class="pd10">
					<p>新たに申し込む方は「新規申込」、既に検査を実施していてIDを追加したい場合は「追加申込」を選んでください。</p>
				</div>
				<dl class="application">
					<dt class="rd"><input type="radio" name="application" id="application1" value="1" class="rd" <?=$chk1?> ></dt>
					<dd class="txt"><label for="application1"><?=$array_application[1]?></label></dd>
				</dl>
<?PHP
				if(count($sel)){
?>
				<dl class="application">
					<dt class="rd"><input type="radio" name="application" id="application2" value="2" class="rd" <?=$chk2?> ></dt>
					<dd class="txt"><label for="application2"><?=$array_application[2]?></label></dd>
				</dl>
				<div class="sel">
					<select name="stid" id="stest">
						<?PHP
							foreach($sel as $key=>$val){
								$sel = "";
								if($_REQUEST[ 'stid' ] == $key) $sel = "SELECTED";
						?>
							<option value="<?=$val[ 'id' ]?>" <?=$sel?>><?=$val[ 'name' ]?></option>
						<?PHP
							}
						?>
					</select>
				</div>
<?PHP
				}
?>
			</div>
			<br clear=all />
			<div class="tcenter">
				<input type="button"  value="戻る" class="button" id="home">
				<input type="submit" name="exam2" value="次へ" class="button" id="conf">
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
		jConfirm('検査一覧画面に戻ります。よろしいですか？', '確認',function(r) {
			if(r){
				location.href = "/";
			}
		});
	});
});
//-->
</script>
<?PHP
include_once("include_footer.php");
?>
