<?PHP
$css1 = "tmp";
$title = "AMS:ファイルアップロード画面";
$js = array("tmp");
$drop = true;
include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
if($basetype == 1){
	$pan = array(
			array(
				"",
				"添付"
			)
			
		);
	
	
}else{
	$pan = array(
			array(
				"/",
				"顧客企業一覧"
			),
			array(
				"",
				"添付"
			)
			
		);
}
include_once("include_title.php");
?>
	<div id="searchTitle">ファイルアップロード</div>
	<div id="formBox">
	<form action="/index/tmp/<?=$sec?>/" method="post" enctype="multipart/form-data">
		<p>添付するファイルを選択してください。</p>
		<input type="file" name="upfile" size="30" id="img" />
		<input type="submit" name="reg" value="アップロード" class="mg" id="upBotton">
	</form>
	</div>
	<p>ファイルサイズは5M以下となります。<br />登録できるファイルの合計サイズは200MBです。 </p>
	<form action="/index/tmp/<?=$sec?>" method="POST" >
		<table id="table">
			<tr>
				<th class="w10" rowspan=2 ><input type="checkbox" id="all" value="on"></th>
				<th rowspan=2 ><a href="/index/tmp/<?=$sec?>" id="date" class="w80"><span id="order">▼</span>登録日</a></th>
				<th>ファイル名</th>
				<th rowspan=2>サイズ</th>
				<th rowspan=1>ステータス</th>
				<th rowspan=2>削除</th>
			</tr>
			<tr>
				<th><input type="text" id="file" value="" ></th>
				<th>
					<select name="<?=$key?>" id="stsTxt">
						<option value="">-</option>
<?PHP
				foreach($a_status as $key=>$val){
?>
						<option value="<?=$key?>"><?=$val?></option>
<?PHP
				}
?>
					</select>
				</th>

			</tr>
			<tbody id="tbody"></tbody>

		</table>
<!--
		<input type="button" id="back" value="戻る" class="button" >
-->
		<input type="submit" name="delcheck" value="ﾁｪｯｸﾌｧｲﾙを削除" class="button" >
	</form>
	<input type="hidden" id="sec" value="<?=$sec?>">
	<input type="hidden" id="dir" value="<?=$dirid[ 'login_id' ]?>" >
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
