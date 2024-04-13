<?PHP
$css1 = "tst";
$title = "AMS:受検者一覧画面";
$js[1] = "tst";
include_once("include_header.php");
$pan[1] = array("","受検者一覧画面");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<form action="/index/tst/" method="post">
		<div id="rightBases">
		<h2>受検者一覧画面</h2>
			<table id="searchBox">
				<tr>
					<th>ID</th>
					<td><input type="text" name="search_id" value="<?=$_REQUEST[ 'search_id' ]?>" /></td>
				</tr>
				<tr>
					<th>顧客企業名</th>
					<td><input type="text" name="company" value="<?=$_REQUEST[ 'company' ]?>" /></td>
				</tr>

				<tr>
					<th>氏名</th>
					<td><input type="text" name="username" value="<?=$_REQUEST[ 'username' ]?>" /></td>
				</tr>

				<tr>
					<th>受検日</th>
					<td>
						<select name="search_year" id="search_year">
							<option value="">-</option>
<?PHP
						for($y=date('Y')-2;$y<=date('Y');$y++){
							$sel = "";
							if($_REQUEST[ 'search_year' ] == $y){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$y?>" <?=$sel?> ><?=$y?></option>
<?PHP
						}
?>
						</select>年
						<select name="search_month" id="search_month">
							<option value="">-</option>
<?PHP
						for($m=1;$m<=12;$m++){
							$sel = "";
							if($_REQUEST[ 'search_month' ] == $m){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$m?>" <?=$sel?> ><?=$m?></option>
<?PHP
						}
?>
						</select>月

						<select name="search_day" id="search_day">
							<option value="">-</option>
<?PHP
						for($m=1;$m<=31;$m++){
							$sel = "";
							if($_REQUEST[ 'search_day' ] == $m){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$m?>" <?=$sel?> ><?=$m?></option>
<?PHP
						}
?>
						</select>日


					</td>
				</tr>
			</table>
			<p>
			<input type="submit" name="search" value="検索" class="button2" >
			</p>

	<ul id="pager">
<?PHP
		$hiku = (int)$sec-1;
		if($sec){
?>
			<li><a href="/index/tst/<?=$hiku?>?search_day=<?=$_REQUEST[ 'search_day' ]?>&search_month=<?=$_REQUEST[ 'search_month' ]?>&search_year=<?=$_REQUEST[ 'search_year' ]?>&company=<?=$_REQUEST[ 'company' ]?>&search_id=<?=$_REQUEST[ 'search_id']?>&username=<?=$_REQUEST[ 'username' ]?>">前の<?=$offset?>件</a></li>
<?PHP
		}else{
?>
			<li class="dis">前の<?=$offset?>件</li>
<?PHP
		}
?>


<?PHP
		$plus = (int)$sec+1;
		if($ceil >= $plus && $ceil > 1 ){
?>
			<li><a href="/index/tst/<?=$plus?>?search_day=<?=$_REQUEST[ 'search_day' ]?>&search_month=<?=$_REQUEST[ 'search_month' ]?>&search_year=<?=$_REQUEST[ 'search_year' ]?>&company=<?=$_REQUEST[ 'company' ]?>&search_id=<?=$_REQUEST[ 'search_id']?>&username=<?=$_REQUEST[ 'username' ]?>">次の<?=$offset?>件</a></li>
<?PHP
		}else{
?>
			<li class="dis">次の<?=$offset?>件</li>
<?PHP
}
?>
	</ul>

			<table id="table">
				<tr>
					<th>検査名</th>
					<th>ID</th>
					<th>顧客企業名</th>
					<th>パートナ会社</th>
					<th>氏名</th>
					<th>受検日</th>
				</tr>
<?PHP
			if(count($list)){
				foreach($list as $key=>$val){
?>
				<tr>
					<td class="left"><?=$val[ 'test_name' ]?></td>
					<td class="left"><?=$val[ 'exam_id' ]?></td>
					<td class="left"><?=$val[ 'customer_name' ]?></td>
					<td class="left"><?=$val[ 'partner_name' ]?></td>
					<td class="left"><?=$val[ 'name' ]?></td>
					<td class="left"><?=$val[ 'fin_exam_date' ]?></td>
				</tr>
<?PHP
				}
			}
?>
			</table>
		</div>
		</form>
	<ul id="pager">
<?PHP
		$hiku = $sec-1;
		if($sec){
?>
			<li><a href="/index/tst/<?=$hiku?>?search_day=<?=$_REQUEST[ 'search_day' ]?>&search_month=<?=$_REQUEST[ 'search_month' ]?>&search_year=<?=$_REQUEST[ 'search_year' ]?>&company=<?=$_REQUEST[ 'company' ]?>&search_id=<?=$_REQUEST[ 'search_id']?>&username=<?=$_REQUEST[ 'username' ]?>">前の<?=$offset?>件</a></li>
<?PHP
		}else{
?>
			<li class="dis">前の<?=$offset?>件</li>
<?PHP
		}
?>


<?PHP
		$plus = $sec+1;
		if($ceil >= $plus && $ceil > 1 ){
?>
			<li><a href="/index/tst/<?=$plus?>?search_day=<?=$_REQUEST[ 'search_day' ]?>&search_month=<?=$_REQUEST[ 'search_month' ]?>&search_year=<?=$_REQUEST[ 'search_year' ]?>&company=<?=$_REQUEST[ 'company' ]?>&search_id=<?=$_REQUEST[ 'search_id']?>&username=<?=$_REQUEST[ 'username' ]?>">次の<?=$offset?>件</a></li>
<?PHP
		}else{
?>
			<li class="dis">次の<?=$offset?>件</li>
<?PHP
}
?>
	</ul>


	</div><!--contents-->

<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->

<?PHP
include_once("include_footer.php");
?>
