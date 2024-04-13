<?PHP
$css1 = "rFlgReg";
$title = "AMS:ROWデータ登録画面";
$js = array("rFlgReg");
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
				"検査一覧"
			),
			array(
				"/index/data/".$sec,
				"受検結果一覧"
			),
			array(
				"",
				"ROWデータ登録"
			),
		);

include_once("include_title.php");
?>


	<div id="searchTitle">ROWデータ登録</div>
	<ul id="ulmenu">
<?PHP
	foreach($test as $key=>$val){
?>
	<li><a href="/index/rFlgReg/<?=$sec?>/<?=$val[ 'type' ]?>/"><?=$val[ 'name' ]?>【<?=$a_test_type[$val[ 'type' ]]?>】</a></li>
<?PHP
	}
?>
	</ul>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
