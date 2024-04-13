<?PHP
if($_COOKIE[ 'lang' ] == "ch" ){
	$tstr = "测试更新屏幕";
	$tstr1 = "待检查结果列表";
	$tstr2 = "测试更新";
	$tstr3 = "除检查信息更新";
	$tstr4 = "ID";
	$tstr5 = "姓名";
	$tstr6 = "语音";
	$tstr7 = "生日";
	$tstr8 = "性別";
	$tstr9 = "曼";
	$tstr10 = "女人";
	$tstr11 = "未设置";
	$tstr12 = "禁用标识";
	$tstr13 = "要禁用标识";
	$tstr14 = "ID指定";
	$tstr15 = "笔记1";
	$tstr16 = "笔记2";
	$tstr17 = "返回";
	$tstr18 = "定位";
	$tstr19 = "它已登记在以下的内容。";
	$tstr20 = "不要禁用";

}else{
	$tstr = "テスト更新画面";
	$tstr1 = "受検結果一覧";
	$tstr2 = "テスト更新";
	$tstr3 = "受検情報更新";
	$tstr4 = "ID";
	$tstr5 = "氏名";
	$tstr6 = "ふりがな";
	$tstr7 = "生年月日";
	$tstr8 = "性別";
	$tstr9 = "男性";
	$tstr10 = "女性";
	$tstr11 = "未設定";
	$tstr12 = "IDの無効化";
	$tstr13 = "IDを無効化する";
	$tstr14 = "ID指定";
	$tstr15 = "メモ1";
	$tstr16 = "メモ2";
	$tstr17 = "戻る";
	$tstr18 = "登録";
	$tstr19 = "下記内容で登録しました。";
	$tstr20 = "無効化しない";
}
$css1 = "testEdit";
$title = "AMS:".$tstr;
$js = array("testEdit");
$time = true;

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
				"/index/data/".$testdata['testgrp_id'],
				"受検結果一覧"
			),
			array(
				"",
				"テスト更新"
			)
		);

if($basetype == 3){
	$pan = array(

			array(
				"/index/data/".$sec,
				$tstr1
			),
			array(
				"",
				$tstr2
			)
		);
}
include_once("include_title.php");
?>
	<p id="title"><?=$tstr3?></p>
	<p id="registTitle"><?=$tstr19?></p>
	<form action="/index/testEdit/<?=$testdata[ 'testgrp_id' ]?>/<?=$testdata[ 'exam_id' ]?>" method="POST">
	<table id="table">
		<tr>
			<th><?=$tstr4?></th>
			<td><?=$testdata[ 'exam_id' ]?></td>
		</tr>
		<tr>
			<th><?=$tstr5?></th>
			<td>
				<?=$name1?><input type="hidden" name="name1" value="<?=$name1?>" > 
				<?=$name2?><input type="hidden" name="name2" value="<?=$name2?>" >
			</td>
		</tr>
		<tr>
			<th><?=$tstr6?></th>
			<td><?=$kana1?> <?=$kana2?>
				<input type="hidden" name="kana1" value="<?=$kana1?>" > 
				<input type="hidden" name="kana2" value="<?=$kana2?>" >
			</td>
		</tr>
		<tr>
			<th><?=$tstr7?></th>
			<td><?=$birth_y?>
				<input type="hidden" name="birth_y" value="<?=$birth_y?>" >
				/<?=$birth_m?>
				<input type="hidden" name="birth_m" value="<?=$birth_m?>" >
				/
				<?=$birth_d?>
				<input type="hidden" name="birth_d" value="<?=$birth_d?>" >
			</td>
		</tr>
		<tr>
			<th><?=$tstr8?></th>
			<td>
<?PHP
			if($sex == 1){
				$sei = $tstr9;
			}else
			if($sex == 2){
				$sei = $tstr10;
			}else{
				$sei = $tstr11;
			}

			
?>
			<?=$sei?>
			<input type="hidden" name="gender" value="<?=$sex?>" >


			</td>
		</tr>
	</table>
<?PHP
	//まだテストが完了していない時のみ
	if(!$complete_flg){
?>
	<table id="table2">
		<tr>
			<th><?=$tstr12?></th>
			<td>
<?PHP
			$notImg = "off";
			$notid  = "div_ID_hand";
			if($invalid){
				$notImg = "on";
				$notid  = "";
			}
?>
<?PHP
			if($invalid){
?>
				<div>
					<input type="hidden" name="ID_invalid" value="<?=$invalid?>" >
					<?=$tstr13?>
				</div>
				<div id="<?=$notid?>">▼<?=$tstr14?><br />
					【<?=$id_hand?>】
					<input type="hidden" name="id_hand" value="<?=$id_hand?>" id="id_hand" >
				</div>
<?PHP
			}else{
?>
				<?=$tstr20?>
<?PHP
			}
?>
			</td>
		</tr>
	</table>
<?PHP
	}
?>
	<table id="table3">

<?PHP
		//添削のときのみ
		if($tensakuFlg){
?>
		<tr>
			<th>メールアドレス</th>
			<td><?=$mail?></td>
		</tr>
		<tr>
			<th>添削者名</th>
			<td><?=$tensaku_name?></td>
		</tr>
		<tr>
			<th>添削者メールアドレス</th>
			<td><?=$tensaku_mail?></td>
		</tr>
<?PHP
		}
?>

		<tr>
			<th>合否</th>
			<td>

			<?=$pass?>
			<input type="hidden" name="pass" value="<?=$pass?>">

			</td>
		</tr>

		<tr>
			<th><?=$tstr15?></th>
			<td><?=$memo1?><input type="hidden" name="memo1" value="<?=$memo1?>" ></td>
		</tr>
		<tr>
			<th><?=$tstr16?></th>
			<td><?=$memo2?><input type="hidden" name="memo2" value="<?=$memo2?>" ></td>
		</tr>

	</table>
	<input type="button" class="button" value="<?=$tstr17?>" id="listback">
	</form>
	<input type="hidden" id="sec" value="<?=$sec?>">
	</div>
	<br clear=all />

<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
