<?PHP
if($_COOKIE[ 'lang' ] == "ch" ){
	$dstr1 = "下载屏幕";
	$dstr2 = "顾客企業一覽";
	$dstr3 = "檢查一覽";
	$dstr4 = "文件下载";
	$dstr5 = "请选择您要下载的文件的名称。";
	$dstr6 = "注册日期";
	$dstr7 = "文件名";
	$dstr8 = "尺寸";
	$dstr9 = "状态";
	$dstr10 = "返回";

}else{
	$dstr1 = "ダウンロード画面";
	$dstr2 = "顧客企業一覧";
	$dstr3 = "検査一覧";
	$dstr4 = "ファイルダウンロード";
	$dstr5 = "ダウンロードしたいファイル名を選択してください。";
	$dstr6 = "登録日";
	$dstr7 = "ファイル名";
	$dstr8 = "サイズ";
	$dstr9 = "ステータス";
	$dstr10 = "戻る";

}


$css1 = "download";
$title = "AMS:".$dstr1;
$js = array("download");
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
				$dstr2
			),
			array(
				"/",
				$dstr3
			),
			array(
				"",
				$dstr1
			),
		);
if($basetype == 3){
	$pan = array(

			array(
				"",
				$dstr1
			),
		);
}
include_once("include_title.php");
?>
	<div id="searchTitle"><?=$dstr4?></div>
	<p class="mg"><?=$dstr5?></p>
	<table id="table">
		<tr>
			<th rowspan=2 ><a href="/index/download/" id="dSort">▼<?=$dstr6?></a></th>
			<th  ><?=$dstr7?></th>
			<th rowspan=2 ><?=$dstr8?></th>
			<th rowspan=2 ><?=$dstr9?></th>
		</tr>
		<tr>
			<th><input type="text" id="fname" value="" class="w30"></th>
		</tr>
		<tbody id="tbody"></tbody>
	</table>
	<div id="loading"></div>
	<input type="hidden" id="orderFlg" value="" >
	<div>
		<input type="button" id="back" value="<?=$dstr10?>" class="button">
	</div>
	<br clear=all />

<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
