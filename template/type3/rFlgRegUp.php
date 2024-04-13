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
				"結果一覧"
			),
			array(
				"",
				"ROWデータ登録"
			),
		);

include_once("include_title.php");
?>

	<div id="searchTitle">ROWデータアップロード</div>
	<form action="/index/rFlgReg/<?=$sec?>/<?=$third?>/" method="post" enctype="multipart/form-data">
	<span class="red"><?=$alert?></span>
	<div class="mg10">
		<input type="file" name="upfile" size="30" />
	</div>
	<input type="button" value="戻る" class="button"  id="back" />
	<input type="submit" value="アップロード" class="button" />
	</form>
	<input type="hidden" id="sec" value="<?=$sec?>">
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
