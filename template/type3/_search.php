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
	<div id="searchTitle"><?=$dstr2?></div>

	<div id="searchBox">
		<form action="/index/search/" name="sform" method="POST">
		<h3>■ <?=$dstr3?></h3>
		<ul>
			<li>ID：<input type="text" name="exam_id" value="<?=$_REQUEST[ 'exam_id' ]?>" id="exam_id" ></li>
			<li><?=$dstr4?>：<input type="text" name="kana" value="<?=$_REQUEST[ 'kana' ]?>" id="kana" ></li>
			<li><?=$dstr13?>：
				<select name="exam_state" value="<?=$_REQUEST[ 'exam_state' ]?>" id="exam_state" >
				<option value="<?=$_REQUEST[ 'exam_state_1' ]?>">受検済み</option>
				<option value="<?=$_REQUEST[ 'exam_state_2' ]?>">受検中</option>
				</select>
			</li>
		</ul>
		<!-- <br cear=all /> -->
		<ul>
			<li><?=$dstr5?>：
				<input type="text" class="datepicker"   name="datepic"  value="<?=$_REQUEST[ 'datepic' ]?>"  id="datepicker" >～
				<input type="text" class="datepicker2"   name="datepic2" value="<?=$_REQUEST[ 'datepic2' ]?>" id="datepicker2">
			</li>
			<li><?=$dstr11?>：<input type="text" name="memo1" value="<?=$_REQUEST['memo1']?>" id="memo1"></li>
			<li><?=$dstr12?>：<input type="text" name="memo2" value="<?=$_REQUEST['memo2']?>" id="memo2"></li>
			<input type="submit" id="search" value="検索" class="button2">
		</ul>
		</form>
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
			<th>ステータス</th>
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
