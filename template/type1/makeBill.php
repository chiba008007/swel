<?PHP
$css1 = "makeBill";
$title = "AMS:請求書新規作成画面";
$time = true;
$js = array("makeBill");

include_once("include_header.php");
$pan[1] = array("/index/billList/","請求書一覧画面");
$pan[2] = array("","請求書新規作成");

?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
<form action="/index/makeBill/makes" method="POST" id="billMakeForm" name="billMakeForm" target=_blank >
<div id="divMake">
	<input type="button" id="billMakeButton" value="請求書作成" class="button" >
</div>
<div id="billsend">
	<p class="text" >１．請求書の宛先を選択してください。</p>
	<span><input type="radio" name="send" value="partner" CHECKED >企業宛</span>
	<span><input type="radio" name="send" value="customer">顧客宛</span>
</div>

<div id="billdate">
	<p class="text" >２．検査日時を選択してください。</p>
<?PHP
	$date = date("Y/m/d");
?>
		<input type="text" class="datepicker1"   name="datepic" value="<?=$date?>" id="datepicker">
		　～
<?PHP
	$date2 = date("Y/m/d");
?>
		<input type="text" class="datepicker2"   name="datepic2" value="<?=$date2?>" id="datepicker2">
</div>


	<div id="partner_box">
		<p class="text">３．パートナー企業を選択してください。</p>
		<div id="loading"></div>
		<div id="partner"></div>
	</div>
	<div id="customer_box">
		<p>&nbsp;</p>
		<div id="customer">左記のパートナー企業を選択してください。</div>
		<div id="loading2"></div>
	</div>
	<div id="tester_box">
		<p>&nbsp;</p>
		<div id="tester">左記の顧客企業を選択してください。</div>
		<div id="loading3"></div>
	</div>


	</div>
	<!--contents-->
</form>
<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
