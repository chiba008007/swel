<?PHP
$css1 = "info";
$title = "AMS:お知らせ情報";
$time = true;
$js = array("info");
include_once("include_header.php");
$pan[1] = array("/index/info","お知らせ情報一覧");
$pan[2] = array("","お知らせ情報変更");

?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<br clear=all />
		<h2>お知らせ情報登録</h2>
		<p><span class="red">※</span>は必須項目です。</p>
		<form action="/index/infoEdit/<?=$sec?>" method="post" enctype="multipart/form-data">
		<table id="table">
			<tr>
				<th>件名<span class="red">※</span></th>
<?PHP
				if($info[0][ 'title' ]){
					$title = $info[0][ 'title' ];
				}
				if($_REQUEST[ 'title' ]){
					$title = $_REQUEST[ 'title' ];
				}

?>
				<td><input type="text" name="title" value="<?=$title?>" class="w600" id="title"></td>
			</tr>
			<tr>
				<th>表示期間</th>
				<td>
<?PHP
				if($info[0][ 'date1' ]){
					$from = $info[0][ 'date1' ];
				}
				if($_REQUEST[ 'from' ]){
					$from = $_REQUEST[ 'from' ];
				}
				if($info[0][ 'date2' ]){
					$to = $info[0][ 'date2' ];
				}
				if($_REQUEST[ 'to' ]){
					$to = $_REQUEST[ 'to' ];
				}


?>
					<input type="text" id="datepicker"  name="from" value="<?=$from?>"  id="date1" readonly >
					～　<input type="text" id="datepicker2"   name="to" value="<?=$to?>"  id="date2" readonly>
				</td>
			</tr>
			<tr>
				<th>表示範囲<span class="red">※</span></th>
				<td>
					<select name="disp_status" id="disp_status">
<?PHP
					foreach($a_disp_status as $key=>$val){
						$sel = "";
						if($key == $info[0][ 'disp_status' ]){
							$sel = "SELECTED";
						}
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
					if($info[0][ 'disp_area' ] == 1){
						$chk1 = "CHECKED";
					}
					if($info[0][ 'disp_area' ] == 2){
						$chk2 = "CHECKED";
					}
					if($_REQUEST[ 'disp_area' ] == 1){
						$chk1 = "CHECKED";
					}
					if($_REQUEST[ 'disp_area' ] == 2){
						$chk2 = "CHECKED";
					}
?>
					<input type="radio" name="disp_area" value="1" id="disp_area1" <?=$chk1?> ><label for="disp_area1">全体</label><br />
					<input type="radio" name="disp_area" value="2" id="disp_area2" <?=$chk2?> ><label for="disp_area2">代理店選択
					</label><a href="javascript:void(0);" id="store">【代理店名選択表示/非表示】</a>
					<div id="dispStore">
<?PHP
					foreach($user as $key=>$val){
						$chk = "";
						if($d[ $val[ 'id' ] ]){
							$chk = "CHECKED";
						}
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
<?PHP
					if($_REQUEST[ 'message' ]){
						$message = $_REQUEST[ 'message' ];
					}
					if($info[0][ 'message' ]){
						$message = $info[0][ 'message' ];
					}
?>
					<textarea name="message" id="message"><?=$message?></textarea>
				</td>
			</tr>
			<tr>
				<th>添付ファイル</th>
				<td>
<?PHP
					$chk = "";
					if($_REQUEST[ 'tempDelete' ]){
						$chk = "CHECKED";
					}
					if($info[0][ 'temp_file' ]){
						
?>
					<input type="checkbox" name="tempDelete" value="on" <?=$chk?> >
					添付ファイル削除
					<br />
<?PHP
					}
?>
					<input type="file" name="upfile" size="30" />
				</td>
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
