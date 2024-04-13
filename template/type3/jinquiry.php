<?PHP
$css1 = "reg";
$title = "AMS:検査新規登録画面";
$js = array("reg");
$scroll = true;
include_once("include_header.php");
$pan = array(
			array("/index/ptn/".$ptid,"顧客企業一覧"),
			array("/","検査一覧"),
			array("","アンケート設定"),
		);
if($basetype == 2){
	$pan = array(
			array("/","検査一覧"),
			array("","アンケート設定"),
		);
}
?>
<div id="main">
	<div id="contents">
<?PHP include_once("include_title.php"); ?>
		<div id="dataTitle">アンケート設定</div>
<?PHP if($msg){ ?>
<div style="color:green;border:1px solid green;padding:10px;margin:5px;"><?=$msg?></div>
<?PHP } ?>
<?PHP if($rlt[ 'status' ] == 1 ) $chk1 = "CHECKED"; ?>
<?PHP if(!$rlt[ 'status' ]  ) $chk2 = "CHECKED"; ?>
<?PHP
	//現在のアンケート回答数
	//1件でもあれば期間の変更をしない
	if($anqCnt[ 'count' ] > 0 ){
		$dis = "disabled";
	}
?>
	<form action="" method="POST" >
		<ul style="margin:0px;list-style-type:none;padding:0px;">
			<li style="display:inline-block;padding:0px;"><input type="radio" name="status" value="1" id="for1" <?=$chk1?> ></li>
			<li style="display:inline-block;padding:5px;font-size:18px;vertical-align:middle;"><label for="for1">設定する</label></li>
		</ul>
		<ul style="margin:0px;list-style-type:none;padding:0px;">
			<li style="display:inline-block;padding:0px;"><input type="radio" name="status" value="0" id="for0" <?=$chk2?> ></li>
			<li style="display:inline-block;padding:5px;font-size:18px;vertical-align:middle;"><label for="for0">設定しない</label></li>
		</ul>
		<br />
		<p>アンケート期間を指定してください。</p>
		<p></p>
		<select name="start_year" style="padding:5px;"  >
<?PHP for($i=date('Y')-1;$i<=date('Y')+1;$i++){?>
<?PHP
		$sel = "";
		if($year1){
			if($i == $year1 ){ $sel = "SELECTED"; }
			elseif($dis){ $sel = $dis; }
		}else{
			if($i == date('Y')){ $sel = "SELECTED"; }
		}
?>
			<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
		</select>年
		<select name="start_month" style="padding:5px;">
<?PHP for($i=1;$i<=12;$i++){?>
<?PHP
		$sel = "";
		if($month1){
			if($i == $month1 ){ $sel = "SELECTED"; }
			elseif($dis){ $sel = $dis; }
		}else{
			if($i == date('m')){ $sel = "SELECTED"; }
		}
?>
			<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
		</select>月

		<select name="start_day" style="padding:5px;">
<?PHP for($i=1;$i<=31;$i++){?>
<?PHP
		$sel = "";
		if($day1){
			if($i == $day1 ){ $sel = "SELECTED"; }
			elseif($dis){ $sel = $dis; }
		}else{
			if($i == date('d')){ $sel = "SELECTED"; }
		}
?>
			<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
		</select>日～
<?PHP
	//翌月
	$nyear = date('Y', strtotime(date('Y-m-d').' +1 month'));
	$nmonth = date('m', strtotime(date('Y-m-d').' +1 month'));
	$nday = date('d', strtotime(date('Y-m-d').' +1 month'));
?>
		<select name="end_year" style="padding:5px;">
<?PHP for($i=date('Y')-1;$i<=date('Y')+1;$i++){?>
<?PHP
		$sel = "";
		if($year2){
			if($i == $year2 ){ $sel = "SELECTED"; }
			elseif($dis){ $sel = $dis; }
		}else{
			if($i == $nyear){ $sel = "SELECTED"; }
		}
?>
			<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
		</select>年
		<select name="end_month" style="padding:5px;">
<?PHP for($i=1;$i<=12;$i++){?>
<?PHP
		$sel = "";
		if($month2){
			if($i == $month2 ){ $sel = "SELECTED"; }
			elseif($dis){ $sel = $dis; }
		}else{
			if($i == $nmonth){ $sel = "SELECTED"; }
		}
?>
			<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
		</select>月

		<select name="end_day" style="padding:5px;">
<?PHP for($i=1;$i<=31;$i++){?>
<?PHP
		$sel = "";
		if($day2){
			if($i == $day2 ){ $sel = "SELECTED"; }
			elseif($dis){ $sel = $dis; }
		}else{
			if($i == $nday){ $sel = "SELECTED"; }
		}
?>
			<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
		</select>日
		<br />
		<br />

		<p>アンケート配信間隔を指定してください</p>
		<select name="interval" style="padding:5px;">
<?PHP for($i=1;$i<=15;$i++){?>
<?PHP
		$sel = "";
		if($i == $rlt[ 'intervalcount' ] ){ 
			$sel = "SELECTED";
		}elseif($dis){ $sel = $dis; 
		}else{
			if($i == $_REQUEST[ 'interval' ]){ $sel = "SELECTED"; }
		}
?>
			<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
		</select>日毎
		<br clear=all />
		アンケート用URL<br />
<?PHP if($rlt[ 'codes' ]){ ?>
		<?=D_URL_TEST?>?k=<?=$code?>&anq=<?=$rlt[ 'codes' ]?>
		<br clear=all />
<?PHP } ?>
		<input type="submit" name="reg" value="設定する" class="button">
	</form>
	</div>
<?PHP include_once("include_footer_name.php"); ?>
</div>
<style type="text/css">
<!--
input[type=radio] {
    width: 20px;
    height: 20px;
    vertical-align: middle;
	-moz-transform-origin: right bottom;
	-moz-transform: scale( 2 , 2 );

}

//-->
</style>
<script type="text/javascript" >
<!--
$(function(){


});
//-->
</script>
<?PHP include_once("include_footer.php"); ?>
