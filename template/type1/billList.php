<?PHP
$css1 = "billList";
$title = "AMS:請求書一覧画面";
$time = true;
$js = array("billList");

include_once("include_header.php");
$pan[1] = array("","請求書一覧画面");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<div id="searchBox">
			<form action="/index/billList/" method="POST">
			<table id="searchTbl" >
				<tr>
					<th>請求書番号</th>
					<td><input type="text" name="bill_num" value="<?=$_REQUEST[ 'bill_num' ]?>" ></td>
					<th>企業名</th>
					<td><input type="text" name="partner_name" value="<?=$_REQUEST[ 'partner_name' ]?>" ></td>
				</tr>
				<tr>
					<th>ステータス</th>
					<td colspan=3 >
<?PHP
					$chk1 = "";
					$chk0 = "";
					if($_REQUEST[ 'down1' ]){
						$chk1 = "CHECKED";
					}
					if($_REQUEST[ 'down0' ]){
						$chk0 = "CHECKED";
					}
?>
						<input type="checkbox" name="down1" value="1"  style="width:20px;" <?=$chk1?> >開封済み
						<input type="checkbox" name="down0" value="1"  style="width:20px;" <?=$chk0?> >未開封
					</td>

				</tr>
				<tr>
					<th>発行日</th>
					<td><input type="text" class="datepicker1"   name="datepic" value="<?=$_REQUEST[ 'datepic' ]?>" id="datepicker"></td>
					<th>件名</th>
					<td><input type="text" name="title" value="<?=$_REQUEST[ 'title' ]?>" ></td>

				</tr>
				
			</table>
			

			<div class="btnLeft">
				<input type="button" id="newBill"  value="請求書新規作成" class="button" >
				<div id="registBillNumber" class="button" >
					適格請求書発行<br>事業者登録番号
				</div>
			</div>
			<div class="btnRight">
				<input type="submit" name="search" value="検索" class="button" >
			</div>
			</form>
			<br clear=all />
		</div>
		<ul id="pager">
<?PHP
			if($sec >= 1){
				$p = $sec-1;
?>
					<li><a href="<?=$p?>">次の<?=$offset?>件</a></li>
<?PHP
			}else{
?>
					<li class="dis">次の<?=$offset?>件</li>
<?PHP
			}
?>

<?PHP
			if($sec < $maxp){
				$p = (int)$sec+1;
?>
				<li><a href="<?=$p?>">前の<?=$offset?>件</a></li>
<?PHP
			}else{
?>
				<li class="dis">前の<?=$offset?>件</li>
<?PHP
			}
?>
		</ul>
		<div id="rightBases">
			<table id="table">
				<tr>
					<th>請求書番号</th>
					<th>発行先企業名</th>
					<th>件名</th>
					<th class="w80">発行日</th>
					<th class="w240">機能</th>
					<th class="w80">ステータス</th>
					<th class="w80">請求金額</th>
				</tr>
<?PHP
			if(count($bill)){
			foreach($bill as $key=>$val){
				$cl = "";
				if($val[ 'download_status' ]){
					$sts = "開封済";
				}else{
					$sts = "未開封";
					$cl  = "rd";
				}
?>
				<tr>
					<td class="center" ><?=$val[ 'bill_num' ]?></td>
					<td><?=$val[ 'name' ]?></td>
					<td><?=$val[ 'title' ]?></td>
					<td><?=$val[ 'regist_ts' ]?></td>
					<td class="center">
						<ul class="ulmenu">
<?PHP

							if($val['count'] == 0 || $val['tcount'] == 0){
								$class = "no-links";
								$link  = "javascript:void(0);";
							}else{
								$class = "";
								$link  = "/index/billEx/".$val[ 'id' ]."/";
							}
?>
							<li><a href="<?=$link?>" class="<?=$class?>" >納品書</a></li>
							<li><a href="/index/dlBill/<?=$val[ 'id' ]?>/" target=_blank>請求書</a></li>
							<li><a href="javascript:void(0);" id="bill-<?=$val[ 'id' ]?>" class="billDel">削除</a></li>
						</ul>
					</td>
					<td class="center <?=$cl?>"><?=$sts?></td>
					<td class="center">\<?=number_format($val[ 'money_total' ])?></td>

				</tr>
<?PHP
			}
			}
?>
			</table>
		</div>

		<ul id="pager2">

<?PHP
			if($sec >= 1){
				$p = $sec-1;
?>
					<li><a href="<?=$p?>">次の<?=$offset?>件</a></li>
<?PHP
			}else{
?>
					<li class="dis">次の<?=$offset?>件</li>
<?PHP
			}
?>

<?PHP
			if($sec < $maxp){
				$p = (int)$sec+1;
?>
				<li><a href="<?=$p?>">前の<?=$offset?>件</a></li>
<?PHP
			}else{
?>
				<li class="dis">前の<?=$offset?>件</li>
<?PHP
			}
?>

		</ul>


	</div>
	<div id="registBillBox">
		<div id="registBillBox-box">
			<h5>適格請求書発行事業者番号</h5>
			<input type="text" name="tekikakuNumber"  value="<?=$user[0][ 'tekikakuNumber' ]?>" />
			<button class="btn" id="tekikakuNumberSave">保存</button>
			<button class="btn" id="tekikakuNumberClose">閉じる</button>
		</div>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript">
	$(function(){
		$("#registBillNumber").click(function(){
			$("#registBillBox").show();
		});
		$("#tekikakuNumberClose").click(function(){
			$("#registBillBox").hide();
		});
		$("#tekikakuNumberSave").click(function(){
			let _tekikakuNumber = $("[name='tekikakuNumber']").val();
			let _url = location.href;
			var _data = {tekikakuNumberFlag:true,tekikakuNumber:_tekikakuNumber}
			$.ajax({
				type: "POST",
				url: _url,
				data: _data,
				success: function(){
					alert("適格請求書発行事業者番号の更新を行いました。");
				}
			});



		});
	});
</script>
<?PHP
include_once("include_footer.php");
?>
