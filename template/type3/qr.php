<?PHP
if($_COOKIE[ 'lang' ] == "ch" ){
	$qstr = "帐号&二维码";
	$qstr2 = "印刷项目选择";
	$qstr3 = "选择项目作为印刷对象";
	$qstr4 = "二维码";
	$qstr5 = "接受检查者一览";
	$qstr6 = "印";
	$qstr7 = "期间";
	$qstr8 = "接受检查的人数";
	$qstr9 = "号码";
	$qstr10 = "接受检查帐号";
	$qstr11 = "检查型";
	$qstr12 = "姓名";

}else{
	$qstr = "ID/QR画面";
	$qstr2 = "印刷項目選択";
	$qstr3 = "選択した項目が印刷対象となります";
	$qstr4 = "QRコード";
	$qstr5 = "受検者一覧";
	$qstr6 = "印刷する";
	$qstr7 = "期間";
	$qstr8 = "受検者数";
	$qstr9 = "番号";
	$qstr10 = "受検ID";
	$qstr11 = "検査型";
	$qstr12 = "氏名";
}
$css1 = "qr";
$title = "AMS:".$qstr;
$js = array("qr");
$prints = true;
include_once("include_header.php");
?>
<script type="text/javascript">
<!--
$(function(){
	$(".listChkCl").click(function(){
		var _v = $('#listChk:checked').val();
		$("#break1").css("display","block");
		if(!_v){
			$("#break1").css("display","none");
		}
	});
});
//-->
</script>
<div id="main">

	<div id="contents">
<?PHP
	if($third == "qr"){
?>
		<div id="printDiv">
		<div id="title"><p><?=$qstr2?></p></div>
		<div id="prints">
			<p class="mg10" ><?=$qstr3?></p>
			<ul>
				<li>
					<div class="indent" ><input type="checkbox" name="qrChk" value="on" id="qrChk" CHECKED ></div>
					<img src="/images/checkbox_on.jpg" id="qrImg" class="qrChkCl" >
					<label for="qrChk" id="labelQr" ><?=$qstr4?></label>
				</li>
				<li>
					<div class="indent" ><input type="checkbox" name="listChk" value="on" id="listChk" CHECKED class="listChkCl" ></div>
					<img src="/images/checkbox_on.jpg" id="chkImg" class="listChkCl" >
					<label for="listChk" class="listChkCl" ><?=$qstr5?></label>
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
			<?php if($use[0]['ssltype'] == 1):?>
				<p id="url"><?=D_URLS_TEST?>?k=<?=$code?></p>
			<?php else: ?>
					<p id="url"><?=D_URL_TEST?>?k=<?=$code?></p>
			<?php endif;?>
<?PHP if($third == "qr"){ ?>
<?php if($use[0]['ssltype'] == 1):?>
				<div id="QR"><img src="/qr/php/qr_img.php?d=<?=D_URLS_TEST?>?k=<?=$code?>" id="QRCODE"></div>
<?php else: ?>
				<div id="QR"><img src="/qr/php/qr_img.php?d=<?=D_URL_TEST?>?k=<?=$code?>" id="QRCODE"></div>
<?php endif;?>
<?PHP } ?>				<div id="under">ID : </div>

				<div class="buttoncenter">
				<input type="button" value="<?=$qstr6?>" onClick="print()" class="buttons" >
				</div>
		</div>
		<div id="break1">
			<div class="break"  >&nbsp;</div>
		</div>
		</div><!--divQR-->

		<div id="tblDiv">
			<div id="testname2" ><p><?=$test[ 'name' ]?></p></div>
			<div id="memlist">
			<?=$qstr7?>：<?=$test[ 'period_from' ]?>～<?=$test[ 'period_to' ]?><br />
			<?=$qstr8?>：<?=$test[ 'number' ]?>
			<br />

<?PHP
    if(
        $obj->test52 == 52
        || $obj->test52 == 60
        || $obj->test52 == 62
        || $obj->test52 == 67
        || $obj->test52 == 68
        || $obj->test52 == 86
        || $obj->test52 == 87
        || $obj->test52 == 89
        || $obj->test52 == 90
        ){ ?>
<?PHP //評価検査の時　?>
			<table class="table">
				<tr>
					<th>社員番号</th>
					<th>メールアドレス</th>
					<th>氏名</th>
				</tr>
<?PHP if($mem && count($mem)){?>
<?PHP foreach($mem as $key=>$val){ ?>
				<tr>
					<td><?=$val[ 'empnum' ]?></td>
					<td><?=$val[ 'mail' ]?></td>
					<td><?=$val[ 'sei' ]?><?=$val[ 'mei' ]?></td>
				</tr>
<?PHP } ?>
<?PHP } ?>
			</table>
<?PHP }else{ ?>
			<table class="table">
				<tr>
					<th><?=$qstr9?></th>
					<th><?=$qstr10?></th>
					<th><?=$qstr11?></th>
					<th><?=$qstr12?></th>
				</tr>
<?PHP
					$i=1;
					$k = 1;
if (count($mem)) {
    $roll = ceil(count($mem)/5);
    foreach ($mem as $key=>$val) {
        ?>
					<tr>
						<td class="w50" ><?=$i?></td>
						<td class="w100"><?=$val[ 'exam_id' ]?></td>
						<td class="lt"><?=$val[ 'type' ]?></td>
						<td><?=$val[ 'name' ]?></td>
					</tr>
<?php
                            if ($i%10 == 0) {
                                $k++;
                                ?>
				</table>

				<div class="break" >&nbsp;</div>

				<table class="table">
<?php
                            }
                                $i++;
    }
}
?>
				</table>
			<div id="buttonCenter">
				<input type="button" value="<?=$qstr6?>" onClick="print()" class="buttons" >
			</div>
			</div>
<?PHP } ?>
		</div><!--tblDiv-->

	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
