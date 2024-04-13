<?PHP
$css1 = "slog";
$title = "AMS:検査ログ一覧画面";
$js[1] = "slog";
include_once("include_header.php");
$pan[1] = array("","検査ログ一覧画面");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<form action="/index/slog/" method="post">
		<div id="rightBases">
		<h2>検査ログ一覧画面</h2>

			<table id="searchBox">
				<tr>
					<th>企業名</th>
					<td><input type="text" name="name" value="<?=$_REQUEST[ 'name' ]?>" /></td>
				</tr>
				<tr>
					<th>日時</th>
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
			<p id="searchex">
				赤：顧客側がテストデータを更新した時 / 青：企業側がテストデータを更新した時
			</p>
			<p>
			<input type="submit" name="search" value="検索" class="button2" >
			</p>
			<input type="submit" name="csv" value="検査ログ出力" class="button2" >

<ul id="pager">
<?PHP
		$hiku = (int)$sec-1;
		if($sec){
?>
			<li><a href="/index/slog/<?=$hiku?>">前の<?=$limit?>件</a></li>
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
			<li><a href="/index/slog/<?=$plus?>">次の<?=$limit?>件</a></li>
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
					<th>企業名</th>
					<th>検査種別</th>
					<th>ステータス</th>
					<th>更新日時</th>
					<th>検査名</th>
				</tr>
<?PHP
				foreach($list as $key=>$val){
					if($val[ 'flg' ] == 1){
						$flg = "パートナー企業";
						$cl = "bgRed";
					}else{
						$flg = "顧客企業";
						$cl = "bgBlue";
					}
?>
				<tr>
					<td class="left  <?=$cl?>">
					<?php if ($val[ 'fromname' ]) : ?>
						<?=$val[ 'fromname' ]?>
					<?php else: ?>
						<?=$val[ 'name' ]?>
					<?php endif; ?>

					<?php if ($val[ 'flg' ] == 1) : ?>
					-
					<?=$val[ 'partnername' ]?>
					<?php endif; ?>
				
					</td>
					<td class="left <?=$cl?>"><?=$a_test_type[$val[ 'type' ]]?></td>
					<td class="left <?=$cl?>"><?=$val[ 'status2' ]?></td>
					<td class="left <?=$cl?>"><?=$val[ 'reg' ]?></td>
					<td class="left <?=$cl?>"><?=$val[ 'kensa' ]?></td>

				</tr>
<?PHP
				}
?>
			</table>
		</div>
		</form>

<ul id="pager2">
<?PHP
		$hiku = $sec-1;
		if($sec){
?>
			<li><a href="/index/slog/<?=$hiku?>">前の<?=$limit?>件</a></li>
<?PHP
		}else{
?>
			<li class="dis">前の<?=$limit?>件</li>
<?PHP
		}
?>

<?PHP
		$plus = $sec+1;
		if($ceil >= $plus && $ceil > 1 ){
?>
			<li><a href="/index/slog/<?=$plus?>">次の<?=$limit?>件</a></li>
<?PHP
		}else{
?>
			<li class="dis">次の<?=$limit?>件</li>
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
