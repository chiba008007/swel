<?PHP
$css1 = "info";
$title = "AMS:お知らせ情報一覧画面";
$time = true;
$js = array("info");
include_once("include_header.php");
$pan[1] = array("/index/info","お知らせ情報一覧");
$pan[2] = array("","お知らせ情報登録");

?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<br clear=all />
		<h2>お知らせ情報登録</h2>
		<form action="" method="post" enctype="multipart/form-data">
		<p>登録完了しました。</p>
		</form>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
