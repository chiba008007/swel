<?PHP
if($_COOKIE[ 'lang' ] == "ch" ){
	$dstr1 = "考生列表画面";
	$dstr2 = "考生列表";
	$dstr3 = "检查搜索条件";
	$dstr4 = "姓名";
	$dstr5 = "除检查日期";
	$dstr6 = "号码";
	$dstr7 = "命名";
	$dstr8 = "语音";
	$dstr9 = "出生日期";
	$dstr10 = "检验名称";

}else{
	$dstr1 = "受検者一覧画面";
	$dstr2 = "受検者一覧";
	$dstr3 = "検査検索条件";
	$dstr4 = "氏名";
	$dstr5 = "受検日";
	$dstr6 = "番号";
	$dstr7 = "氏名";
	$dstr8 = "ふりがな";
	$dstr9 = "生年月日";
	$dstr10 = "検査名";
	$dstr11 = "メモ1";
	$dstr12 = "メモ2";
	$dstr13 = "受検ステータス";
	$dstr14 = "ステータス";

}
$css1 = "search";
$title = "AMS:".$dstr1;
$js = array("search");
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
				"検査結果一覧"
			),
			array(
				"",
				"受検者一覧"
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
	<!-- 検索条件 -->
	<div id="searchTitle"><?=$dstr2?></div>
	<div id="searchBox">

		<h3>■ <?=$dstr3?></h3>
		<div class="serchItems">
			<div class="itemCell">
				ID：<input type="text" name="exam_id" value="<?=$_REQUEST[ 'exam_id' ]?>" id="exam_id" >
			</div>
			<div class="itemCell">
				<?=$dstr4?>：<input type="text" name="kana" value="<?=$_REQUEST[ 'kana' ]?>" id="kana" >
			</div>
			<div class="itemCell">
				<?=$dstr13?>：
				<select name="exam_state" id="exam_state" >
				<option value="2">受検済み</option>
				<option value="1">受検中</option>
				</select>
			</div>
		</div>
		<div class="searchItem">
			<div class="itemCell">
				<?=$dstr5?>：
				<input type="text" class="datepicker"   name="datepic"  value="<?=$_REQUEST[ 'datepic' ]?>"  id="datepicker" >～
				<input type="text" class="datepicker2"   name="datepic2" value="<?=$_REQUEST[ 'datepic2' ]?>" id="datepicker2">
			</div>
			<div class="itemCell">
				<?=$dstr11?>：<input type="text" name="memo1" value="<?=$_REQUEST['memo1']?>" id="memo1">
			</div>
			<div class="itemCell">
				<?=$dstr12?>：<input type="text" name="memo2" value="<?=$_REQUEST['memo2']?>" id="memo2">
			</div>
		</div>
		<input type="button" id="search" value="検索" class="button2">

	</div>
	<!-- <div id="pager"></div> -->
	<table id="table">
		<tr>
			<th><?=$dstr6?></th>
			<th>ＩＤ</th>
			<th><?=$dstr7?></th>
			<th><?=$dstr8?></th>
			<th><?=$dstr9?></th>
			<th><?=$dstr10?></th>
			<th><?=$dstr14?></th>
			<th><?=$dstr11?></th>
			<th><?=$dstr12?></th>
		</tr>
		<tbody id="tbody"></tbody>
	</table>
	<div id="loading"></div>
	</div>
	<input type="hidden" id="p" value="<?=$sec?>">
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
