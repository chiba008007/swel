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
	$tstr13 = "如果禁用该ID请参阅检查。";
	$tstr14 = "ID手工指定";
	$tstr15 = "笔记1";
	$tstr16 = "笔记2";
	$tstr17 = "确认画面";
	$tstr18 = "取消";

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
	$tstr13 = "IDを無効化する際はチェックをしてください。";
	$tstr14 = "ID手動指定";
	$tstr15 = "メモ1";
	$tstr16 = "メモ2";
	$tstr17 = "確認";
	$tstr18 = "キャンセル";
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
	<form action="/index/testEdit/<?=$testdata[ 'testgrp_id' ]?>/<?=$testdata[ 'exam_id' ]?>" method="POST">
	<table id="table">
		<tr>
			<th><?=$tstr4?></th>
			<td><?=$testdata[ 'exam_id' ]?></td>
		</tr>
		<tr>
			<th><?=$tstr5?></th>
			<td>
				姓<input type="text" name="name1" value="<?=$name1?>" id="name1"> 
				名<input type="text" name="name2" value="<?=$name2?>" id="name2">
			</td>
		</tr>
		<tr>
			<th><?=$tstr6?></th>
			<td>
				姓<input type="text" name="kana1" value="<?=$kana1?>" id="kana1"> 
				名<input type="text" name="kana2" value="<?=$kana2?>" id="kana2">
			</td>
		</tr>
		<tr>
			<th><?=$tstr7?></th>
			<td>
				<input type="text" name="birth_y" value="<?=$birth_y?>" id="birth_y">
				/
				<select name="birth_m" id="birth_m">
<?PHP
				for($i=1;$i<=12;$i++){
					if($i == $birth_m){
						$sel = "SELECTED";
					}else{
						$sel = "";
					}
?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP
				}
?>
				</select>
				/

				<select name="birth_d" id="birth_d">
<?PHP
				for($i=1;$i<=31;$i++){
					if($i == $birth_d){
						$sel = "SELECTED";
					}else{
						$sel = "";
					}
?>
					<option value="<?=$i?>" <?=$sel?>><?=$i?></option>
<?PHP
				}
?>
				</select>

			</td>
		</tr>
		<tr>
			<th><?=$tstr8?></th>
			<td>
<?PHP
			$chk1 = "";
			$chk1img = "off";
			$chk2 = "";
			$chk2img = "off";
			$chk0 = "";
			$chk0img = "off";
			
			if($sex == 1){
				$chk1 = "CHECKED";
				$chk1img = "on";
			}else
			if($sex == 2){
				$chk2 = "CHECKED";
				$chk2img = "on";
			}else{
				$chk0 = "CHECKED";
				$chk0img = "on";
			}

			
?>
				<input type="radio" name="gender" value="1" class="gender" id="gender_1" <?=$chk1?> >
				<img src="/images/radio_<?=$chk1img?>.jpg" id="genderImg_1" class="gender">
				<label for="gender_1"><?=$tstr9?></label>　
				<input type="radio" name="gender" value="2" class="gender" id="gender_2" <?=$chk2?>>
				<img src="/images/radio_<?=$chk2img?>.jpg" id="genderImg_2" class="gender">
				<label for="gender_2"><?=$tstr10?></label>　
				<input type="radio" name="gender" value="0" class="gender" id="gender_3" <?=$chk0?>>
				<img src="/images/radio_<?=$chk0img?>.jpg" id="genderImg_3" class="gender">
				<label for="gender_3"><?=$tstr11?></label>

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
			$notChk = "";
			$notid  = "div_ID_hand";
			if($invalid){
				$notImg = "on";
				$notChk = "CHECKED";
				$notid  = "";
			}
?>
				<div>
					<input type="checkbox" name="ID_invalid" value="on" id="ID_invalid" class="checkHand" <?=$notChk?> >
					
					<label for="ID_invalid"><img src="/images/checkbox_<?=$notImg?>.jpg" id="ID_invalidImg" class="checkHand" >
					<span class="red"><?=$tstr13?></span></label>
				</div>
				<div id="<?=$notid?>">▼<?=$tstr14?><br />
					<input type="text" name="id_hand" value="<?=$id_hand?>" id="id_hand" ><span class="red">空欄の際は自動でIDが指定されます。</span>
				</div>
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
			<td><input type="text" name="mail" value="<?=$mail?>" style="width:300px;" ></td>
		</tr>
		<tr>
			<th>添削者名</th>
			<td><input type="text" name="tensaku_name" value="<?=$tensaku_name?>" style="width:300px;" ></td>
		</tr>
		<tr>
			<th>添削者メールアドレス</th>
			<td><input type="text" name="tensaku_mail" value="<?=$tensaku_mail?>" style="width:300px;" ></td>
		</tr>
<?PHP
		}
?>
		<tr>
			<th>合否</th>
			<td>
<?PHP
			$pass1 = "";
			$pass1img = "off";
			$pass2 = "";
			$pass2img = "off";
			$pass0 = "";
			$pass0img = "off";
			if($pass == "合"){
				$pass1 = "CHECKED";
				$pass1img = "on";
			}else
			if($pass == "不"){
				$pass2 = "CHECKED";
				$pass2img = "on";
			}elseif($pass == "未"){
				$pass0 = "CHECKED";
				$pass0img = "on";
			}
?>
				<input type="radio" name="pass" value="合" class="pass" id="pass_1" <?=$pass1?> >
				<img src="/images/radio_<?=$pass1img?>.jpg" id="passImg_1" class="pass">
				<label for="pass_1">合</label>　
				<input type="radio" name="pass" value="不" class="pass" id="pass_2" <?=$pass2?> >
				<img src="/images/radio_<?=$pass2img?>.jpg" id="passImg_2" class="pass">
				<label for="pass_2">不</label>　
				<input type="radio" name="pass" value="未" class="pass" id="pass_3" <?=$pass0?> >
				<img src="/images/radio_<?=$pass0img?>.jpg" id="passImg_3" class="pass">
				<label for="pass_3">未</label>

			</td>
		</tr>
		<tr>
			<th><?=$tstr15?></th>
			<td><input type="text" name="memo1" value="<?=$memo1?>" class="memo1"></td>
		</tr>
		<tr>
			<th><?=$tstr16?></th>
			<td><input type="text" name="memo2" value="<?=$memo2?>" class="memo2"></td>
		</tr>

	</table>
	<br clear=all />
	
	
	
	<div id="buttonBox">
			<input type="submit" name="conf" value="<?=$tstr17?>" class="button" id="conf">
			<input type="button"  value="<?=$tstr18?>" class="button" id="cancel"></div>
			<input type="hidden" id="testgrp_id" value="<?=$sec?>">
			<input type="hidden" id="exam_id" value="<?=$third?>">
	</form>
	<br clear=all />

	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
