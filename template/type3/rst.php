<?PHP
$css1 = "rst";
$title = "AMS:検査結果画面";
include_once("include_header.php");
?>

<div id="main">
	<div id="contents">
	<div id="title">
	<?=$result[0]['name']?>さんの結果
	</div>


<?=$code?>



	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
