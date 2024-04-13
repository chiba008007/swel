<?PHP
$css1 = "down";
$title = "AMS:ダウンロード画面";
$js = array("down");
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
				"ダウンロード"
			),
		);
if($basetype == 2){
$pan = array(
			array(
				"",
				"ダウンロード"
			),
		);
}
include_once("include_title.php");
?>
	<div id="searchTitle">ファイルダウンロード</div>
	<p class="mg">ダウンロードしたいファイル名を選択してください。</p>
	<table id="table">
		<tr>
			<th rowspan=2 ><a href="/index/down/" id="dSort">▼登録日</a></th>
			<th  >ファイル名</th>
			<th rowspan=2 >サイズ</th>
			<th rowspan=2 >ステータス</th>
		</tr>
		<tr>
			<th><input type="text" id="fname" value="" class="w30"></th>
		</tr>
		<tbody id="tbody"></tbody>
	</table>
	<div id="loading"></div>
	<input type="hidden" id="orderFlg" value="" >
	<div>
		<input type="button" id="back" value="戻る" class="button">
	</div>
	<br clear=all />

<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
