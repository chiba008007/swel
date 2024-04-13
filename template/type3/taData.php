<?PHP
$css1 = "taData";
$title = "AMS:検査結果一覧画面";
$js = array("taData");
$time = true;

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
				"",
				"受検結果一覧"
			),
		);

include_once("include_title.php");
?>
		<div id="Loading">
			<img src="/images/downLoading.gif" >
		</div>
		<div id="dataTitle">
			<?=$testname?>
		</div>
		<form action="/index/data/<?=$sec?>/" name="form" >

		<div id="pager"></div>
		<table id="table">
			<tr>
<?PHP
/*
				<th rowspan=2 class="w10">
					<input type="checkbox" id="allCheck" value="on" <?=$checked?>>
				</th>
*/
?>
				<th rowspan=2 class="w10">番号</th>
				<th >被評価者ID</th>
				<th >被評価者名</th>
				<th >被評価者所属部署</th>
				<th >評価者ID</th>
				<th >評価者名</th>
				<th >評価者所属部署</th>
				<th rowspan=2 >関係性</th>
				<th rowspan=2>生年月日<br />（年齢）</th>
				<th colspan=<?=$cols?> >多面評価システム</th>
			</tr>
			<tr>
				<th><input type="text" id="hv_id" class="w30"></th>
				<th><input type="text" id="hv_name" class="w60"></th>
				<th><input type="text" id="hv_busyo" class="w60"></th>
				<th><input type="text" id="ev_id" class="w30"></th>
				<th><input type="text" id="ev_name" class="w60"></th>
				<th><input type="text" id="ev_busyo" class="w60"></th>
<?PHP
				foreach($tlist as $key=>$val){
?>
				<th><?=$array_tamen_type[$val]?></th>

<?PHP
}
?>
			</tr>
			<tbody id="tbody">
			</tbody>
		</table>
		</form>
		<div id="loading"></div>
		<input type="hidden" id="pages" value="<?=$third?>" >
		<input type="hidden" id="testgrp_id" value="<?=$sec?>" >
		<table>
			<tr>
<?PHP
/*
				<td><a href="/index/data/<?=$sec?>/" class="button" id="deleteAll">チェックした検査を削除</a></td>
*/
?>
<?PHP

	if($excelBtn){
?>
				<td><a href="/index/down/<?=$sec?>/" class="button" id="resultDown">検査結果ダウンロード</a></td>
<?PHP

	}else{
?>
				<td>
				<!--
					<a href="/index/downEx/<?=$sec?>/" class="button" id="resultDownEx" >検査結果ダウンロード</a>
				-->
					<input type=button value="検査結果ダウンロード" class="button" onClick="alert('error');">
				</td>
<?PHP
	}

?>
				<td><a href="/index/taReg/<?=$sec?>/" class="button" >システム内容登録</a></td>
<?PHP
	if($basetype == 1){
?>
				<td><a href="/index/csv/<?=$sec?>/" class="button thickbox" id="csvDown" >CSVダウンロード</a></td>
<?PHP
	}
?>
				<td><a href="/index/taRegCsv/<?=$sec?>/" class="button" id="registDown" >登録内容ダウンロード</a></td>
			</tr>
		</table>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
