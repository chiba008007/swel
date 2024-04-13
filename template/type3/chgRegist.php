<?PHP
if($_COOKIE[ 'lang' ] == "ch" ){
	$str = "企业信息更新";
	$str1 = "接受检查者一览";
	$cstr1 = "它被注册完毕。";
	$cstr2 = "回到列表";
}else{
	$str = "企業情報更新";
	$str1 = "受検者一覧";
	$cstr1 = "登録完了しました。";
	$cstr2 = "一覧に戻る";
}
$css1 = "chg";
$title = "AMS:".$str;
$js = array("chg");
$map = true;
$drop = true;
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
				"検査結果一覧"
			),
			array(
				"",
				"受検者一覧"
			),
		);
if($basetype == 2){
	$pan = array(
			array(
				"/",
				"検査結果一覧"
			),
			array(
				"",
				"受検者一覧"
			),
		);
}
if($basetype == 3){
	$pan = array(

			array(
				"",
				$str1
			),
		);
}
include_once("include_title.php");
?>
	<div id="searchTitle"><?=$str?></div>
	<div id="registDiv">
		<p><?=$cstr1?></p>
		<p><a href="/"><?=$cstr2?></a></p>
	</div>
	
	
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
