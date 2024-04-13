<?PHP
$css1 = "new";
$title = "AMS:受検者一覧画面";
$js = array("new");
$map = true;
$drop = true;
include_once("include_header.php");
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<style type="text/css" >

</style>
<div id="main">
	<div id="contents">
<?PHP

if($basetype == 2){
$pan = array(
			array(
				"/index/help/",
				"ヘルプ",
			),
			array(
				"",
				"テンプレート画面",
			),
		);
}
include_once("include_title.php");
?>
	<div id="searchTitle">テンプレート画面</div>



	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript" >


</script>
<?PHP
include_once("include_footer.php");
?>
