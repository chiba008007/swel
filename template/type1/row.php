<?PHP
$title = "AMS:検査種別ROWデータ画面";

include_once("include_header.php");
?>
<div>
		<h2>ROWデータ出力画面</h2>

	<div >
		<div >
		<table id="table">
			<tr>
				<th>テストタイプ</th>
				<th>機能</th>
			</tr>
<?PHP
			foreach($rowlist as $key=>$val){
?>
				<tr>
					<td><?=$val[ 'type' ]?></td>
					<td><div class="csvlink"><a href="/index.php/rowcsv/<?=$val[ 'typeid' ]?>/">CSVダウンロード</a></div></td>
				</tr>
<?PHP			
			}
?>
			<tr>
				<td>2019年02月～ BA-J3</td>
				<td><div class="csvlink"><a href="/index.php/rowcsv/12/?date=2019/02">CSVダウンロード</a></div></td>
			</tr>

		</table>
		</div>
	</div>

</div>

<?PHP
include_once("include_footer.php");
?>
