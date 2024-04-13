<?PHP
$css1 = "taReg";
$title = "AMS:検査削除画面";
$js = array("taReg");
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
				"検査削除画面"
			),
		);

include_once("include_title.php");
?>
		<div id="dataTitle">多面評価検査内容登録</div>
		<div id="form">
<?PHP
		if($upload){
?>
		▼以下の内容を登録します。よろしいですか？
		<form name="form1" method="post" action="/index/taReg/<?=$sec?>" >
		<table id="table">
			<tr>
				<th>被評価者ID</th>
				<th>被評価者名</th>
				<th>被評価者所属部署</th>
				<th>評価者ID</th>
				<th>評価者パスワード</th>
				<th>評価者名</th>
				<th>評価者所属部署名</th>
				<th>関係性</th>
			</tr>
<?PHP
			if(count($list)){
				foreach($list as $key=>$val){
					if($key > 0 && $val[0] ){
						if(!$val[ 'exam_state' ] || !$val[ 'taid' ]){
?>
						<tr>
							<td><?=$val[0]?><input type="hidden" name="hv_id[<?=$key?>]" value="<?=$val[0]?>"></td>
							<td><?=$val[1]?><input type="hidden" name="hv_name[<?=$key?>]" value="<?=$val[1]?>"></td>
							<td><?=$val[2]?><input type="hidden" name="hv_busyo[<?=$key?>]" value="<?=$val[2]?>"></td>
							<td><?=$val[3]?><input type="hidden" name="ev_id[<?=$key?>]" value="<?=$val[3]?>"></td>
							<td><?=$val[4]?><input type="hidden" name="ev_pwd[<?=$key?>]" value="<?=$val[4]?>"></td>
							<td><?=$val[5]?><input type="hidden" name="ev_name[<?=$key?>]" value="<?=$val[5]?>"></td>
							<td><?=$val[6]?><input type="hidden" name="ev_busyo[<?=$key?>]" value="<?=$val[6]?>"></td>
							<td><?=$val[7]?><input type="hidden" name="relation[<?=$key?>]" value="<?=$val[7]?>"></td>
						</tr>
						<input type="hidden" name="number[<?=$key?>]" value="<?=$val[ 'number' ]?>">
						<input type="hidden" name="id[<?=$key?>]" value="<?=$val[ 'id' ]?>">
						<input type="hidden" name="taid[<?=$key?>]" value="<?=$val[ 'taid' ]?>">

<?PHP
						}
					}
				}
			}
?>
		</table>
		
		<div id="btnBox">
			<input type="submit"  name="back" value="戻る" class="button" >
			<input type="submit" name="regist" value="登録する" class="button">
			
		</div>

		</form>
		<br clear=all />
		
<?PHP
		}else{
?>

			▼アップロードするファイル
			<form name="form1" method="post" action="/index/taReg/<?=$sec?>" enctype="multipart/form-data">
				<input type="file" name="fileName" size="60" >
				<input type="submit" name="submit" value="アップロード確認" class="button2">
			</form>
<?PHP
		}
?>
		</div>
	<hr size=1 />
	▼例
	<table id="table2" >
		<tr>
			<th>被評価者ID</th>
			<th>被評価者名</th>
			<th>被評価者所属部署</th>
			<th>評価者ID</th>
			<th>評価者パスワード</th>
			<th>評価者名</th>
			<th>評価者所属部署名</th>
			<th>関係性</th>
		</tr>
		<tr>
			<td>test1</td>
			<td>検査太郎</td>
			<td>営業</td>
			<td>id001</td>
			<td>id001</td>
			<td>検査上司</td>
			<td>営業</td>
			<td>上司</td>
		</tr>
	</table>
	
	</div>

	
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
