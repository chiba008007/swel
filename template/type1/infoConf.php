<?PHP
$css1 = "info";
$title = "AMS:お知らせ情報一覧画面";
$time = true;
$js = array("info");
include_once("include_header.php");
$pan[1] = array("/index/info","お知らせ情報一覧");
$pan[2] = array("","お知らせ情報登録");

?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<br clear=all />
		<h2>お知らせ情報登録</h2>
		<p><span class="red">※</span>は必須項目です。</p>
		<form action="" method="post" enctype="multipart/form-data">
		<table id="table">
			<tr>
				<th>件名</th>
				<td><?=$_REQUEST[ 'title' ]?><input type="hidden" name="title" value="<?=$_REQUEST[ 'title' ]?>" ></td>
			</tr>
			<tr>
				<th>表示期間</th>
				<td><?=$_REQUEST[ 'from' ]?>～<?=$_REQUEST[ 'to' ]?>
					<input type="hidden"  name="from" value="<?=$_REQUEST[ 'from' ]?>" >
					<input type="hidden"   name="to" value="<?=$_REQUEST[ 'to' ]?>"   >
				</td>
			</tr>
			<tr>
				<th>表示範囲<span class="red">※</span></th>
				<td>
					<?=$a_disp_status[ $_REQUEST[ 'disp_status' ] ]?>
					<input type="hidden" name="disp_status" value="<?=$_REQUEST[ 'disp_status' ]?>" >
				</td>
			</tr>

			<tr>
				<th>表示範囲詳細</th>
				<td>
<?PHP
					$disp = "";
					if($_REQUEST[ 'disp_area' ] == 1){
						$disp = "全体";
					}
					if($_REQUEST[ 'disp_area' ] == 2){
						$disp = "代理店選択";
					}
?>
					<?=$disp?>
					<input type="hidden" name="disp_area" value="<?=$_REQUEST[ 'disp_area' ]?>" >
<?PHP
					if($_REQUEST[ 'idList' ] && count($_REQUEST[ 'idList' ])){
?>
						<p>【代理店名】</p>
<?PHP
						foreach($_REQUEST[ 'idList' ] as $key=>$val){
?>
							<?=$user[$key][ 'name' ]?><br />
							<input type="hidden" name="idList[<?=$key?>]" value="on">
<?PHP
						}
					}
?>
				</td>
			</tr>


			<tr>
				<th>詳細内容記載</th>
				<td>
					<?=nl2br($_REQUEST[ 'message' ])?>
					<input type="hidden" name="message" value="<?=$_REQUEST[ 'message' ]?>" >
				</td>
			</tr>
			<tr>
				<th>添付ファイル</th>
				<td>
<?PHP
				if($_FILES[ 'upfile' ][ 'name' ]){
?>
					<?=$_FILES["upfile"]["name"]?>をアップロード
					<input type="hidden" name="fname" value="<?=$fname?>">
<?PHP
				}else{
?>
					-
<?PHP
				}
?>
				</td>
			</tr>
		</table>
		<input type="submit"  value="戻る" class="button" name="regback">
		<input type="submit" name="regRegist" value="登録" class="button" >
		</form>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
