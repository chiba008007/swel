<?PHP
$css1 = "list";
$title = "AMS:顧客情報一覧画面";
$js = array("wt");
$time = true;

include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
if($basetype == 1){
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
				"重みマスタ"
			),
		);
}
if($basetype == 2){
	$pan = array(

			array(
				"/",
				"検査一覧"
			),
			array(
				"",
				"重みマスタ"
			),
		);

}
include_once("include_title.php");
?>

<?PHP
	$back = (int)$sec-1;
	if($back >= 0){
		$backP = '<li><a href="/index/wt/'.$back.'" >前の30件</a></li>';
	}else{
		$backP = '<li class="dis">前の30件</li>';
	}
	$next = (int)$sec+1;
	if($next <= $ceil){
		$nextP = '<li><a href="/index/wt/'.$next.'/" >次の30件</a></li>';
	}else{
		$nextP = '<li class="dis">次の30件</li>';
	}
?>

		<div id="leftBases">
			<ul>
				<li><a href="/index/wt/new">新規登録</a></li>
			</ul>
		</div>
		<br clear=all />

		<ul class="pager">
			<?=$backP?>
			<?=$nextP?>
		</ul>

		<br clear=all />
		<table id="table">
			<tr>
				<th >重み付けマスター名</th>
				<th class="w180" rowspan=2 >作成日</th>
				<th class="w250" rowspan=2>機能</th>
			</tr>
			<tr>
				<th><input type="text" id="searchText" value="" class="w100"></th>
				
			</tr>
			<tbody id="tbody">
			</tbody>

		</table>


</div>
<?PHP
include_once("include_footer_name.php");
?>
<input type="hidden" id="sec" value="<?=$sec?>">
</div>

<?PHP
include_once("include_footer.php");
?>
