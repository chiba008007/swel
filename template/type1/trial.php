<?PHP
$css1 = "list";
$title = "AMS:パートナー情報一覧画面";
$js = array("trial");
include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
	$pan = array(
			array(
				"",
				"トライアルＩＤ"
			)
			
		);
include_once("include_title.php");
?>

		<br clear=all />
		<ul id="pager">
<?PHP
	$back = (int)$sec-1;
		if($back >= 0){
?>
			<li><a href="/index/trial/<?=$back?>" >前の30件</a></li>
<?PHP
		}else{
?>
			<li class="dis">前の30件</li>
<?PHP
		}
?>
<?PHP
	$next = (int)$sec+1;
		if($next <= $ceil){
?>
			<li><a href="/index/trial/<?=$next?>/" >次の30件</a></li>
<?PHP
		}else{
?>
			<li class="dis">次の30件</li>
<?PHP
		}
?>
		</ul>
		<div id="rightBases">
			<table id="table">
				<tr>
					<th class="w100">パートナー企業</th>
					<th class="w100">顧客企業</th>
					<th rowspan=2 >発行者数</th>
					<th rowspan=2 >受検済数</th>
					<th rowspan=2 >未受検数</th>
					<th rowspan=2 >残数</th>
					<th rowspan=2 >登録日</th>
				</tr>
				<tr>
					<th><input type="text" id="pt" value="" class="w200"></th>
					<th><input type="text" id="cs" value="" class="w200"></th>
					
				</tr>
				<tbody id="tbody">
				</tbody>
			</table>
			<div id="loading"></div>
		</div>
		<ul id="pager2">
<?PHP
	$back = (int)$sec-1;
		if($back >= 0){
?>
			<li><a href="/index/trial/<?=$back?>" >前の30件</a></li>
<?PHP
		}else{
?>
			<li class="dis">前の30件</li>
<?PHP
		}
?>
<?PHP
	$next = (int)$sec+1;
		if($next <= $ceil){
?>
			<li><a href="/index/trial/<?=$next?>/" >次の30件</a></li>
<?PHP
		}else{
?>
			<li class="dis">次の30件</li>
<?PHP
		}
?>
		</ul>

	</div>


	<input type="hidden" id="pages" value="<?=$sec?>" >

<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
