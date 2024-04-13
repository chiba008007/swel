<?PHP
$css1 = "qr";
$title = "AMS:ID/QR画面";
$js = array("qr");
$prints = true;
include_once("include_header.php");
?>

<div id="main">

	<div id="contents">
<?PHP
	if($third == "qr"){
?>
		<div id="printDiv">
		<div id="title"><p>印刷項目選択</p></div>
		<div id="prints">
			<p class="mg10" >選択した項目が印刷対象となります</p>
			<ul>
				<li>
					<div class="indent" ><input type="checkbox" name="qrChk" value="on" id="qrChk" CHECKED ></div>
					<img src="/images/checkbox_on.jpg" id="qrImg" class="qrChkCl" >
					<label for="qrChk" id="labelQr" >QRコード</label>
				</li>
				<li>
					<div class="indent" ><input type="checkbox" name="listChk" value="on" id="listChk" CHECKED ></div>
					<img src="/images/checkbox_on.jpg" id="chkImg" class="listChkCl" >
					<label for="listChk" >受検者一覧</label>
				</li>
			</ul>
		</div>
		</div><!--printDiv-->
<?PHP
	}
?>
		<div id="divQR">
		<div id="testname"><p><?=$test[ 'name' ]?></p></div>
			<div id="QRimg">
				<p id="url"><?=D_URL_TEST?>?k=<?=$code?></p>
<?PHP
	if($third == "qr"){
?>
				<div id="QR"><img src="/qr/php/qr_img.php?d=<?=D_URL_TEST?>?k=<?=$code?>" id="QRCODE"></div>
<?PHP
	}
?>				<div id="under">ID : </div>
				
				<div class="buttoncenter">
				<input type="button" value="印刷する" onClick="print()" class="buttons" >
				</div>
		</div>
		<div class="break" ></div>

		</div><!--divQR-->

		<div id="tblDiv">
			<div id="testname2" ><p><?=$test[ 'name' ]?></p></div>
			<div id="memlist">
			期間：<?=$test[ 'period_from' ]?>～<?=$test[ 'period_to' ]?><br />
			受検者数：<?=$test[ 'number' ]?>
			<br />
			<table class="table">
				<tr>
					<th>番号</th>
					<th>評価者ID</th>
					<th>検査内容</th>
					<th>氏名</th>
				</tr>
<?PHP
					$i=1;
					$k = 1;
					$roll = ceil(count($mem)/5);
					foreach($mem as $key=>$val){
?>
					<tr>
						<td class="w50" ><?=$i?></td>
						<td class="w100"><?=$val[ 'ev_id' ]?></td>
						<td class="lt">
<?PHP
							foreach($val[ 'ty' ] as $k=>$v){
?>
								<div>■<?=$v?></div>
<?PHP
							}
?>
						</td>
						<td><?=$val[ 'ev_name' ]?></td>
					</tr>
<?PHP
					if($i%10 == 0){
						$k++;
?>
				</table>
				
				<div class="break" >&nbsp;</div>
				
				<table class="table">
<?PHP
					}
						$i++;
					}
?>
				</table>
			<div id="buttonCenter">
				<input type="button" value="印刷する" onClick="print()" class="buttons" >
			</div>
			</div>
		</div><!--tblDiv-->
			
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
