<?PHP
$css1 = "down";
$title = "AMS:ダウンロード画面";
$js = array("logo");
$map = true;
$drop = true;
include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
$pan = array(

			array(
				"/",
				"企業一覧"
			),
			array(
				"",
				"PDFロゴ画像"
			),
		);

if($basetype == 2){
	$pan = array(
			array(
				"",
				"PDFロゴ画像"
			),
		);
}

include_once("include_title.php");
?>
	<div id="searchTitle">PDFロゴ画像アップロード</div>
	<div id="waku">
	<p>検査結果のPDFで利用するロゴ画像を登録してください。 </p>
		<form action="/index/logo/" method="post" enctype="multipart/form-data">
		<input type="file" name="upfile" size="30" id="img" />
		<p class="red">登録画像(jpg)/登録サイズ30キロ以下<br />270×80で保存されます</p>
		<p>■登録画像</p>
<?PHP
		//画像の有無の確認
		$imgpath = "/img/pdflogo/pl_".$loginid.".jpg";
		$file_exists = "./img/pdflogo/pl_".$loginid.".jpg";
?>
		<div id="preview">
<?PHP
		if(file_exists($file_exists)){
?>
			<img src="<?=$imgpath?>"  id="" />
<?PHP
		}
?>
		</div>
		<input type="button" id="registlogo" value="ロゴ画像登録" class="button">
		</form>
	<br clear=all />
	<input type="button" id="back" value="戻る" class="button">
<?PHP
		if(file_exists($file_exists)){
?>
	<input type="button" id="delete" value="登録画像削除" class="button">
<?PHP
		}
?>
	<input type="hidden" id="logoid" value="<?=$loginid?>">
	</div>
	<br clear=all />
	
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
