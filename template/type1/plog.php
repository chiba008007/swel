<?PHP
$css1 = "plog";
$title = "AMS:企業情報変更画面";
$js[1] = "plog";
include_once("include_header.php");
$pan[1] = array("","PDF出力ログ一覧");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<form action="/index/plog/" method="post" name="form" id="form">
		<div id="rightBases">
		<h2>PDF出力ログ一覧画面</h2>

			<table id="searchBox">
				<tr>
					<th>パートナー名</th>
					<td><input type="text" name="partner_name" value="<?=$_REQUEST[ 'partner_name' ]?>" /></td>
					<th>顧客名</th>
					<td><input type="text" name="customer_name" value="<?=$_REQUEST[ 'customer_name' ]?>" /></td>
				</tr>
				<tr>
					<th>検査名</th>
					<td><input type="text" name="test_name" value="<?=$_REQUEST[ 'test_name' ]?>" /></td>
					<th>受検者ID</th>
					<td><input type="text" name="exam_id" value="<?=$_REQUEST[ 'exam_id' ]?>" /></td>
				</tr>
				<tr>
					<th>出力PDF</th>
					<td>
						<select name="pdf_type">
							<option value="">-</option>
<?PHP
							foreach($array_pdf as $key=>$val){
								$sel = "";
								if($key == $_REQUEST[ 'pdf_type' ]){
									$sel = "SELECTED";
								}
?>
								<option value="<?=$key?>" <?=$sel?>><?=$val?></option>
<?PHP
							}
?>							
						</select >
					</td>
					<!--
					<th>出力者</th>
					<td>
						<select name="output_auth">
							<option value="">-</option>
<?PHP
							foreach($pdf_auth as $key=>$val){
								$sel = "";
								if($key == $_REQUEST[ 'output_auth' ]){
									$sel = "SELECTED";
								}
?>
								<option value="<?=$key?>" <?=$sel?> ><?=$val?></option>
<?PHP
							}
?>
						</select>
					</td>
					-->
				</tr>
				<tr>
					<th>出力日時：西暦</th>
					<td colspan=3 >
						<select name="year1" id="year1">
							<option value="">-</option>
<?PHP
						for($y=date('Y')-2;$y<=date('Y');$y++){
							$sel = "";
							if($_REQUEST[ 'year1' ] == $y){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$y?>" <?=$sel?> ><?=$y?></option>
<?PHP
						}
?>
						</select>年
						<select name="month1" id="month1">
							<option value="">-</option>
<?PHP
						for($m=1;$m<=12;$m++){
							$sel = "";
							if($_REQUEST[ 'month1' ] == $m){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$m?>" <?=$sel?> ><?=$m?></option>
<?PHP
						}
?>
						</select>月

						<select name="day1" id="day1">
							<option value="">-</option>
<?PHP
						for($m=1;$m<=31;$m++){
							$sel = "";
							if($_REQUEST[ 'day1' ] == $m){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$m?>" <?=$sel?> ><?=$m?></option>
<?PHP
						}
?>
						</select>日～


						<select name="year2" id="year2">
							<option value="">-</option>
<?PHP
						for($y=date('Y')-2;$y<=date('Y');$y++){
							$sel = "";
							if($_REQUEST[ 'year2' ] == $y){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$y?>" <?=$sel?> ><?=$y?></option>
<?PHP
						}
?>
						</select>年
						<select name="month2" id="month2">
							<option value="">-</option>
<?PHP
						for($m=1;$m<=12;$m++){
							$sel = "";
							if($_REQUEST[ 'month2' ] == $m){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$m?>" <?=$sel?> ><?=$m?></option>
<?PHP
						}
?>
						</select>月

						<select name="day2" id="day2">
							<option value="">-</option>
<?PHP
						for($m=1;$m<=31;$m++){
							$sel = "";
							if($_REQUEST[ 'day2' ] == $m){
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
<!--
			<p id="searchex">
				赤：顧客側がテストデータを更新した時 / 青：企業側がテストデータを更新した時
			</p>
-->
			<p>
			<input type="submit" name="search" value="検索" class="button2" >
			</p>

		<br clear=all />
	<ul id="pager">
<?PHP
		$limit = 100;
		$hiku = (int)$sec-1;
		if($sec){
?>
			<li><a href="/index/plog/<?=$hiku?>" id="backPage">前の<?=$limit?>件</a></li>
<?PHP
		}else{
?>
			<li class="dis">前の<?=$limit?>件</li>
<?PHP
		}
?>



<?PHP
		$plus = (int)$sec+1;
		if($ceil >= $plus && $ceil > 1 ){
?>
			<li><a href="/index/plog/<?=$plus?>" id="nextPage">次の<?=$limit?>件</a></li>
<?PHP
		}else{
?>
			<li class="dis">次の<?=$limit?>件</li>
<?PHP
		}
?>

	</ul>

			<table id="table">
				<tr>
					<th>パートナー名</th>
					<th>顧客名</th>
					<th>検査名</th>
					<th>受検者ID</th>
					<th>出力PDF</th>
					<th>IP</th>
					<th>出力日時</th>

				</tr>
<?PHP
				if($logdata){
				foreach($logdata as $key=>$val){
					
?>
				<tr>
					<td class="left"><?=$val[ 'partner_name' ]?></td>
					<td class="left"><?=$val[ 'customer_name' ]?></td>
					<td class="left"><?=$val[ 'test_name' ]?></td>
					<td class="left"><?=$val[ 'exam_id' ]?></td>
					<td class="left"><?=$val[ 'pdf_type' ]?></td>
					<td class="left"><?=$val[ 'ip' ]?></td>
					<td class="left"><?=$val[ 'output_time' ]?></td>
					

				</tr>
<?PHP
				}
				}
?>
			</table>
		</div>
		</form>



	</div><!--contents-->

<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->

<?PHP
include_once("include_footer.php");
?>
