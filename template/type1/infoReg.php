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
				<th>件名<span class="red">※</span></th>
				<td><input type="text" name="title" value="<?=$_REQUEST[ 'title' ]?>" class="w600" id="title"></td>
			</tr>
			<tr>
				<th>表示期間</th>
				<td>
					<input type="text" id="datepicker"  name="from" value="<?=$_REQUEST[ 'from' ]?>"  id="date1" readonly >
					～　<input type="text" id="datepicker2"   name="to" value="<?=$_REQUEST[ 'to' ]?>"  id="date2" readonly>
				</td>
			</tr>
			<tr>
				<th>表示範囲<span class="red">※</span></th>
				<td>
					<select name="disp_status" id="disp_status">
<?PHP
					foreach($a_disp_status as $key=>$val){
						$sel = "";
						if($key == $_REQUEST[ 'disp_status' ]){
							$sel = "SELECTED";
						}
?>
						<option value="<?=$key?>" <?=$sel?> ><?=$val?></option>
<?PHP
					}
?>
					</select>
				</td>
			</tr>

			<tr>
				<th>表示範囲詳細</th>
				<td>
<?PHP
					$chk1 = "";
					$chk2 = "";
					if($_REQUEST[ 'disp_area' ] == 1){
						$chk1 = "CHECKED";
					}
					if($_REQUEST[ 'disp_area' ] == 2){
						$chk2 = "CHECKED";
					}
					if(!$_REQUEST[ 'disp_area' ]){
						$chk1 = "CHECKED";
					}
?>
					<input type="radio" name="disp_area" value="1" id="disp_area1" <?=$chk1?> ><label for="disp_area1">全体</label><br />
					<input type="radio" name="disp_area" value="2" id="disp_area2" <?=$chk2?> ><label for="disp_area2">代理店選択
					</label><a href="javascript:void(0);" id="store">【代理店名選択表示/非表示】</a>
					<div id="dispStore">
<?PHP
					foreach($user as $key=>$val){
						$chk = "";
						if($_REQUEST[ 'idList' ][ $val[ 'id' ]]){
							$chk = "CHECKED";
						}
?>
						<input type="checkbox" name="idList[<?=$val[ 'id' ]?>]" value="on" <?=$chk?> ><?=$val[ 'name' ]?><br />
<?PHP
					}
?>
					</div>
				</td>
			</tr>


			<tr>
				<th>詳細内容記載</th>
				<td>
					<textarea name="message" id="message"><?=$_REQUEST[ 'message' ]?></textarea>
				</td>
			</tr>
			<tr>
				<th>添付ファイル</th>
				<td><input type="file" name="upfile" size="30" /></td>
			</tr>
		</table>
		<input type="button"  value="戻る" class="button" id="infoback">
		<input type="submit" name="conf" value="確認" class="button" id="conf">
		</form>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
