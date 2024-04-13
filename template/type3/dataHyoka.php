<?PHP
$css1 = "data";
$title = "AMS:検査結果一覧画面";
$js = array("hyoka");
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
if($basetype == 3){
	$pan = array(

			array(
				"",
				"受検結果一覧"
			),
		);

}
include_once("include_title.php");
?>
		<div id="Loading">
			<img src="/images/downLoading.gif" >
		</div>
		<div id="dataTitle">
			<?=$testname?>
		</div>

		<?php
		if(!$tykey[67] && !$tykey[68]): ?>
		<div id="filterBox">
			<div id="filetering">
				<p>上司を選択してください。</p>
				<select name="boss" id="boss" style="padding:10px;">
					<option value="">-</option>
				<?PHP foreach($boss as $key=>$val){ ?>
					<option value="<?=$val[ 'id' ]?>" ><?=$val[ 'sei' ]?><?=$val[ 'mei' ]?></option>
				<?PHP } ?>
				</select>

			</div>
			<div id="buttonline">
				<input type="button" class="button2" value="メイン画面へ" id="mainBack" onClick="location.href='/';">
			</div>
		</div>
		<?php endif; ?>
		<br clear=all />
		<form action="/index/data/<?=$sec?>/" name="form" >
		<div id="pager"></div>


		<table id="table">
			<tr>
				<th>部署</th>
				<th>役職</th>
				<th>社員番号</th>
				<th>名前(かな)</th>
				<th>メールアドレス</th>
				<th>生年月日</th>
				<th>年齢</th>
				<th>性別</th>
				<th>合否</th>
				<th>メモ1</th>
				<th>メモ2</th>
				<th>ステータス</th>
				<th>機能</th>
			</tr>

			<tbody id="tbody">
			</tbody>
		</table>
		<div id="pager2"></div>

		</form>
		<div id="loading"></div>
		<input type="hidden" id="pages" value="<?=$third?>" >
		<input type="hidden" id="testgrp_id" value="<?=$sec?>" >
		<br clear=all />
		<table>
			<tr>
<?PHP
	$thickbox = "thickbox";
	$csvDown  = "csvDown";
	if(!$rows){
		$not = "not";
		$thickbox = "";
		$csvDown  = "";

	}

	if($basetype == 1 || $basetype == 3){
		if($basetype == 1){
?>
			<td><a href="/index/csv/<?=$sec?>/" class="button <?=$thickbox?> <?=$not?>" id="<?=$csvDown?>" >CSVダウンロード</a></td>
<?PHP
		}
	}
?>
			</tr>
		</table>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<input type="hidden" id="wKey" value="" >
<input type="hidden" id="wKeyPdf" value="" >

<?PHP
	if($pdfline){
		foreach($pdfline as $key=>$val){
?>
		<input type="hidden" id="type<?=$key?>" value="<?=$val?>" class="ty">
<?PHP
		}
	}
?>

<?PHP
include_once("include_footer.php");
?>
