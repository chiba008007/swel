<?PHP
$css1 = "reg";
$title = "AMS:検査新規登録画面";
$js = array("reg");
$scroll = true;
include_once("include_header.php");

?>
<style type="text/css" >
.left{
	float:left;
}
.hid{ display:none; }
.pd10{padding:10px;border-bottom:1px solid #ccc;}
</style>
<script type="text/javascript">
<!--
$(function(){
	$(".om").hover(
		function(){
			var _id = $(this).attr("class");
			var _ex = _id.split("_");
			var _key = _ex[1];
			var _grp = "chkgrp_"+_key;
			$("."+_grp).show();
		}
		,function(){
			var _id = $(this).attr("class");
			var _ex = _id.split("_");
			var _key = _ex[1];
			var _grp = "chkgrp_"+_key;
			var _fix = "fixchk_"+_key;
			var _cnt = $("."+_fix+":checked").length;
			if(_cnt == 0){
				$("."+_grp).hide();
			}
		}
	);
});
//-->
</script>
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
				"検査新規登録"
			),
		);

if($basetype == 2){
	$pan = array(

			array(
				"/",
				"検査一覧"
			),
			array(
				"",
				"検査新規登録"
			),

		);


}

include_once("include_title.php");
?>

		<div id="dataTitle">新規検査登録</div>
		<p class="hissu"><span class="red">※</span>は必須項目です。</p>
		<form action="/index/reg/<?=$sec?>" method="POST" name="form">
		<table id="table">
			<tr>
				<th>企業名</th>
				<td><?=$ptdata[ 'name' ]?></td>
			</tr>
			<tr>
				<th>販売可能ライセンス数</th>
				<td>
					【全体】：<?=number_format($sell[ 'sell' ])?> 枚<br />
					【詳細】<br />

					<table id="buyTbl"  >
						<thead>
						<tr>
							<th class="buyTle" >検査型</th>
							<th class="buyTle" >検査数</th>
							<th class="buyTle" >検査型</th>
							<th class="buyTle" >検査数</th>
						</tr>
						</thead>
						<tbody >
						<tr>
<?PHP
						$i=0;
						foreach($lists as $key=>$val){

?>
							<input type="hidden" id="sell_<?=$key?>" value="<?=$val?>">
							<td><?=$a_test_type[$key]?></td>
							<td class="right"><?=number_format($val)?> 枚</td>
<?PHP
							if($i%2){
?>
								</tr><tr>
<?PHP
							}
							$i++;
						}
?>
						</tbody>
					</table>

				</td>
			</tr>
			<tr>
				<th>顧客企業名</th>
				<td><?=$cdata[ 'name' ]?></td>
			</tr>
			<tr>
				<th>検査名<span class="red">※</span></th>
				<td><input type="text" name="test_name" value="<?=$_REQUEST[ 'test_name' ]?>" class="w400" id="test_name"></td>
			</tr>
			<tr>
				<th>受検者数<span class="red">※</span></th>
				<td>
					<input type="text" name="RegNumber" value="<?=$_REQUEST[ 'RegNumber' ]?>" id="RegNumber" class="numeric" >名
					<span class="regMsg">半角数字で入力してください。以下で選択される検査受検者数に反映されます。</span>
				</td>
			</tr>
			<tr>
				<th>氏名の入力</th>
				<td >
						<div style="position:relative;">
							<?php
							$chk = ""; 
							if($_REQUEST[ 'input_not_name' ]):
								$chk = "checked";
							endif;
							?>
							<input type="checkbox" name="input_not_name" id="input_name" value="on" <?=$chk?> style="width:20px;height:20px;" />
							<label for="input_name" style="position:absolute;top:1px;left:30px;">設定しない</label> 
						</div>
					</td>
			</tr>
			<tr>
				<th>性別の入力</th>
				<td>
					<div style="position:relative;">
							<?php
							$chk = ""; 
							if($_REQUEST[ 'input_not_gender' ]):
								$chk = "checked";
							endif;
							?>
						<input type="checkbox" name="input_not_gender" id="input_gender" <?=$chk?> value="on" style="width:20px;height:20px;" />
						<label for="input_gender" style="position:absolute;top:1px;left:30px;" >設定しない</label> 
					</div>
				</td>
			</tr>
<?PHP
		if($basetype != 3){
?>
			<tr>
				<th>メール配信受検者残数</th>
				<td>
					<input type="text" name="rest_mail_count" value="<?=$_REQUEST[ 'rest_mail_count' ]?>" id="rest_mail_count" class="numeric" >名<br />
					<span class="regMsg">半角数字で人数を入力してください。残数（未受検者）が指定の人数以下になった際に担当者にメールが配信されます。</span><br />
					<span class="regMsg">未指定の場合は0または、空欄にしてください。</span>
				</td>
			</tr>
<?PHP
		}
?>

			<tr>
				<th>検査システム選択<span class="red">※</span></th>
				<td>
					<select name="RegSystem" class="w200" id="RegSystem" >
<?PHP
					foreach($array_system_type as $key=>$val){
						$sel = "";
						if($_REQUEST[ 'RegSystem' ] == $key){
							$sel = "SELECTED";
						}else{
							$sel = "";
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
				<th>検査言語選択<span class="red">※</span></th>
				<td>

					<select name="language" class="w200" id="language" >
<?PHP

					foreach($array_language as $key=>$val){
						$sel = "";
						if($_REQUEST[ 'language' ] == $key){
							$sel = "SELECTED";
						}else{
							$sel = "";
						}
?>
						<option value="<?=$key?>" <?=$sel?>><?=$val?></option>
<?PHP
					}
?>
					</select>
				</td>
			</tr>
			<tr>
				<th>検査実施期間<span class="red">※</span></th>
				<td>
<?PHP
//検査実施期間の設定
//本日の日付
					$y  = date("Y");
					$m  = date("m");
					$d  = date("d");
					$y2 = date("Y", mktime(0, 0, 0, $m, $d+1, $y));
					$m2 = date("m", mktime(0, 0, 0, $m, $d+1, $y));
					$d2 = date("d", mktime(0, 0, 0, $m, $d+1, $y));
					if($_REQUEST[ 'year1' ]){
						$y = $_REQUEST[ 'year1' ];
					}
					if($_REQUEST[ 'month1' ]){
						$m = $_REQUEST[ 'month1' ];
					}
					if($_REQUEST[ 'day1' ]){
						$d = $_REQUEST[ 'day1' ];
					}
					if($_REQUEST[ 'year2' ]){
						$y2 = $_REQUEST[ 'year2' ];
					}
					if($_REQUEST[ 'month2' ]){
						$m2 = $_REQUEST[ 'month2' ];
					}
					if($_REQUEST[ 'day2' ]){
						$d2 = $_REQUEST[ 'day2' ];
					}

?>

					西暦
<!--
						<input type="text" name="year1" value="<?=$y?>" class="w40 numeric" maxlength=4 id="year1" >
-->
					<select name="year1" id="year1">
<?PHP
					for($i=date('Y');$i<=date('Y')+5;$i++){
						$sel = "";
						if($i == $y){
							$sel = "SELECTED";
						}
?>
						<option value="<?=$i?>" <?=$sel?>><?=$i?></option>
<?PHP
					}
?>
					</select>
					年
					<select name="month1" id="month1">
<?PHP
						for($i=1;$i<=12;$i++){
							$sel = "";
							if($i == $m){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP
						}
?>
					</select>月

					<select name="day1" id="day1">
<?PHP
						for($i=1;$i<=31;$i++){
							$sel = "";
							if($i == $d){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP
						}
?>
					</select>日～

<!--
					<input type="text" name="year2" value="<?=$y2?>" class="w40 numeric" maxlength=4 id="year2" >
-->
					<select name="year2" id="year2">
<?PHP
					for($i=date('Y');$i<=date('Y')+5;$i++){
						$sel = "";
						if($i == $y){
							$sel = "SELECTED";
						}
?>
						<option value="<?=$i?>" <?=$sel?>><?=$i?></option>
<?PHP
					}
?>
					</select>


					年
					<select name="month2" id="month2">
<?PHP
						for($i=1;$i<=12;$i++){
							$sel = "";
							if($i == $m2){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP
						}
?>
					</select>月

					<select name="day2" id="day2">
<?PHP
						for($i=1;$i<=31;$i++){
							$sel = "";
							if($i == $d2){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP
						}
?>
					</select>日
				</td>
			</tr>
			<tr>
				<th>検査結果画面</th>
<?PHP
				$notImg = "on";
				$notChk = "CHECKED";
				if($_REQUEST[ 'fin_disp' ] != 1 && isset($_REQUEST[ 'fin_disp' ])){
					$notImg = "off";
					$notChk = "";
				}

?>
				<td>
					<div class="indent"><input type="checkbox" name="fin_disp" value="1" id="fin_disp" <?=$notChk?> ></div>
					<label for="fin_disp"><img src="/images/checkbox_<?=$notImg?>.jpg" id="fin_disp_img" >
					検査結果画面を表示する</label>
				</td>
			</tr>
<?php if($basetype == 1):?>
			<tr>
				<th>事前環境チェックの有無</th>

<?PHP
				$notChk = "";
				if($_REQUEST[ 'judge_login' ] == 1 && isset($_REQUEST[ 'judge_login' ])){
					$notChk = "CHECKED";
				}

?>
				<td >
					<input type="checkbox" name="judge_login" value="1" id="judge_login" <?=$notChk?> style="width:20px;height:22px;" >
					<label for="judge_login" >
						<p style="position:absolute;margin-top:-25px;margin-left:25px;">判定する</p>
					</label>
				</td>
			</tr>
<?php endif;?>
<?PHP
		if($basetype == 1){
?>
			<tr>
				<th>強みアンケート利用</th>
<?PHP
				$notImg = "off";
				$notChk = "";
				if($_REQUEST[ 'enq_status' ] ){
					$notImg = "on";
					$notChk = "CHECKED";
				}
?>
				<td>
					<div class="indent"><input type="checkbox" name="enq_status" value="1" id="enq_status" <?=$notChk?> ></div>
					<div id="enq_status_div"><img src="/images/checkbox_<?=$notImg?>.jpg" id="enq_status_img" >
					アンケートを利用する</div>
				</td>
			</tr>
<?PHP
		}
?>

<?PHP 
$chk = "";
if($_REQUEST[ 'licensecard' ]){
	$chk = "CHECKED";
}
if($basetype == 1): ?>
			<tr>
				<th>受検証明書ダウンロード設定</th>
				<td>
					<p style="display:inline-block;">
						<input type="checkbox" name="licensecard" id="licensecard" class="uniqCheck" value="1" style="width:20px;height:22px;" <?=$chk?> >
					</p>
					<p style="display:inline-block;vertical-align:middle;height:30px;">
						<label for="licensecard">設定する</label>
					</p>
				</td>
			</tr>

			<tr>
				<th>受検者ダウンロード設定</th>
				<td>
					<input type="checkbox" name="exam_download" value="1" class="uniqCheck"  id="exam_download"  style="width:20px;height:22px;" >
					
					<label for="exam_download" style="position:absolute;" >
						設定する
					</label>

				</td>
			</tr>
		<?php endif;?>
<?PHP
		if($basetype == 1){
?>
			<tr>
				<th>一括ダウンロード設定</th>
<?PHP
				$notImg = "off";
				$notChk = "";
				if($_REQUEST[ 'pdf_slice' ] ){
					$notImg = "on";
					$notChk = "CHECKED";
				}
?>
				<td>
					<div class="indent"><input type="checkbox" name="pdf_slice" value="1" id="pdf_slice" <?=$notChk?> ></div>
					<div id="pdf_slice_div"><img src="/images/checkbox_<?=$notImg?>.jpg" id="pdf_slice_img" >
					受検者全員の検査結果を一括でダウンロードします。</div>
				</td>
			</tr>
<?PHP
		}
?>
<?PHP if($basetype <= 2){ ?>
<?PHP
	$rchk = "CHECKED";
	if($_REQUEST[ 'recommen' ] == 0 && isset($_REQUEST[ 'recommen' ])){
		$rchk = "";
	}
?>
			<tr>
				<th>推奨ブラウザ説明文</th>
				<td>
					<p style="display:inline-block;">
						<input type="checkbox" name="recommen" id="recommen"  value="1" style="width:20px;height:22px;" <?=$rchk?> >
					</p>
					<p style="display:inline-block;vertical-align:middle;height:30px;">
						<label for="recommen">利用する</label>
					</p>
				</td>
			</tr>
<?PHP } ?>
<?PHP if($basetype <= 2){ ?>
			<tr>
				<th>ログイン説明文</th>
<?PHP

				if($_REQUEST[ 'explain' ] ){
					$explain = $_REQUEST[ 'explain' ];
				}

?>
				<td>
					<p style="display:inline-block;">
						<input type="checkbox" name="loginDisp" id="loginDisp"  value="1" style="width:20px;height:20px;">
					</p>
					<p style="display:inline-block;vertical-align:middle;height:30px;">
						<label for="loginDisp">編集する</label>
					</p>
					<textarea id="explain" name="explain" style="width:90%;height:80px;padding:5px;background-color:#ccc;" readonly ><?=$explain?></textarea><br />
					ログイン画面で利用される説明文です。<br />空欄の場合は初期状態で表示されます。
				</td>
			</tr>
<?PHP
		}
?>
	<tr>
		<th>動画サムネイルの表示</th>
		<td>
			<?php foreach($youtubeflag as $key=>$value):
					$chk = ""; 
					if($_REQUEST[ 'youtubeflag' ] == $key){
						$chk ="checked";
					}
				?>
				<div>
					<label>
						<input type="radio" name="youtubeflag" value="<?=$key?>" <?=$chk?> />
						<?=$value?>
					</label>
					<?php if($key == 1):?>
						動画のURL
						<input type="text" name="youtube" value="<?=$_REQUEST[ 'youtube' ]?>" style="width:300px;" />

						<button class="btn" type="button" id="youtube" >サムネイル表示</button>
						<div id="thum"></div>
						<script type="text/javascript">
							$(function(){
								$("#youtube").click(function(){
									let url = $("[name='youtube']").val();
									let sp = url.split("=");
									let html = '<iframe width="40%" height="200" src="https://www.youtube.com/embed/'+sp[1]+'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
									$("#thum").html(html);
										return false;
								});
							});
						</script>
						
					<?php endif?>
				</div>
			<?php endforeach;?>
		</td>
	</tr>



<?PHP /* if($basetype == 1){ ?>
	<tr>
		<th>結果エクセル出力形式選択</th>
		<td>
<?php foreach($a_excel_type as $e=>$eval): ?>
<?php
	$echk = "";
	if($e == 1) $echk = "CHECKED";
	if($e == $_REQUEST[ 'excel_type' ]) $echk = "CHECKED";

?>
<label><input type="radio" name="excel_type" value="<?=$e?>" <?=$echk?> /><?=$eval?></label>　
<?php endforeach;?>
		</td>
	</tr>
<?php } */ ?>

                        <?php if($basetype == 1){?>
                            <tr>
                                <th>PDF出力制限</th>
                                <td>
                                    <p>PDF出力に制限を設ける場合は下記を選択してください。</p>

                                    <div style="margin-top:15px;">
                                        <p>PDF出力期間を設定する</p>
                                        <?php
                                            $chk1 = "";
                                            $chkimg1 = "off";
                                            $chk0 = "CHECKED";
                                            $chkimg0 = "on";
                                            if($tests["pdf_output_limit"] == 1):
                                                $chk1 = "CHECKED";
                                                $chk0 = "";
                                                $chkimg1 = "on";
                                                $chkimg0 = "off";
                                            endif;
                                            if($tests["pdf_output_limit"] == 0):

                                                $chk0 = "CHECKED";
                                                $chk1 = "";
                                                $chkimg1 = "off";
                                                $chkimg0 = "on";
                                            endif;

                                            if($_POST):
                                                if(filter_input(INPUT_POST,"pdf_output_limit") == 1):
                                                    $chk1 = "CHECKED";
                                                    $chk0 = "";
                                                    $chkimg1 = "on";
                                                    $chkimg0 = "off";
                                                endif;
                                                if(filter_input(INPUT_POST,"pdf_output_limit") == 0):

                                                    $chk0 = "CHECKED";
                                                    $chk1 = "";
                                                    $chkimg1 = "off";
                                                    $chkimg0 = "on";
                                                endif;
                                            endif;
                                        ?>
                                        <span>
                                            <input type="radio" name="pdf_output_limit" value="1"  id="pdf_output_limit-1" style="display: none;"  class="pdf_output_limit"  <?=$chk1?> />
                                            <label for="pdf_output_limit-1"   style="margin:0px 0px 0px 3px;position:absolute;" class="usebtn" >
                                                <img src="/images/radio_<?=$chkimg1?>.jpg"  id="onUseImg-1" class="rUse_on usebtn">
                                                利用する</label>
                                        </span>
                                        <span style="margin-left:100px;">
                                            <input type="radio" name="pdf_output_limit" value="0"  id="pdf_output_limit-0"  style="display:none;" class="pdf_output_limit"  <?=$chk0?> />
                                            <label for="pdf_output_limit-0"   style="margin:0px 0px 0px 3px;position:absolute;" class="usebtn" >
                                                <img src="/images/radio_<?=$chkimg0?>.jpg"  id="onUseImg-0" class="rUse_on usebtn">
                                                利用しない</label>
                                        </span>
                                        <br /><br />
                                        <p>PDF出力可能期間</p>

<?php
    $pdf_output_limit_from = "";
    $pdf_output_limit_to = "";

    if($tests['pdf_output_limit_from']){
        $pdf_output_limit_from = $tests['pdf_output_limit_from'];
    }
    if($tests['pdf_output_limit_to']){
        $pdf_output_limit_to = $tests['pdf_output_limit_to'];
    }


    if(filter_input(INPUT_POST,"pdf_output_limit_from")){
        $pdf_output_limit_from = filter_input(INPUT_POST,"pdf_output_limit_from");
    }
    if(filter_input(INPUT_POST,"pdf_output_limit_to")){
        $pdf_output_limit_to = filter_input(INPUT_POST,"pdf_output_limit_to");
    }
?>

                                        <input type="text" class="datepicker" style="padding:6px;" name="pdf_output_limit_from"  value="<?=$pdf_output_limit_from?>" >〜
                                        <input type="text" class="datepicker" style="padding:6px;" name="pdf_output_limit_to" value="<?=$pdf_output_limit_to?>">
                                        <br />
                                        <p>※選択された場合は、該当期間のみPDFボタンが表示されます。</p>
                                        <br />
                                        <p>PDF出力人数を設定する</p>

                                        <?php
                                            $chk1 = "";
                                            $chkimg1 = "off";
                                            $chk0 = "CHECKED";
                                            $chkimg0 = "on";

                                            if($tests[ 'pdf_output_limit_count' ] == 1):
                                                $chk1 = "CHECKED";
                                                $chk0 = "";
                                                $chkimg1 = "on";
                                                $chkimg0 = "off";
                                            endif;
                                            if($tests[ 'pdf_output_limit_count' ]== 0):
                                                $chk0 = "CHECKED";
                                                $chk1 = "";
                                                $chkimg1 = "off";
                                                $chkimg0 = "on";
                                            endif;

                                            if($_POST):
                                                if(filter_input(INPUT_POST,"pdf_output_limit_count") == 1):
                                                    $chk1 = "CHECKED";
                                                    $chk0 = "";
                                                    $chkimg1 = "on";
                                                    $chkimg0 = "off";
                                                endif;
                                                if(filter_input(INPUT_POST,"pdf_output_limit_count") == 0):
                                                    $chk0 = "CHECKED";
                                                    $chk1 = "";
                                                    $chkimg1 = "off";
                                                    $chkimg0 = "on";
                                                endif;
                                            endif;
                                        ?>

                                        <span>
                                            <input type="radio" name="pdf_output_limit_count" value="1"  id="pdf_output_limit_count-1" style="display: none;"  class="pdf_output_limit_count"  <?=$chk1?> />
                                            <label for="pdf_output_limit_count-1"   style="margin:0px 0px 0px 3px;position:absolute;" class="usebtn" >
                                                <img src="/images/radio_<?=$chkimg1?>.jpg"  id="onUseImg2-1" class="rUse_on usebtn">
                                                利用する</label>
                                        </span>
                                        <span style="margin-left:100px;">
                                            <input type="radio" name="pdf_output_limit_count" value="0"  id="pdf_output_limit_count-0"  style="display:none;" class="pdf_output_limit_count"  <?=$chk0?> />
                                            <label for="pdf_output_limit_count-0"   style="margin:0px 0px 0px 3px;position:absolute;" class="usebtn" >
                                                <img src="/images/radio_<?=$chkimg0?>.jpg"  id="onUseImg2-0" class="rUse_on usebtn">
                                                利用しない</label>
                                        </span>
                                        <br /><br />



                                        <?php
                                            $pdf_output_count = 0;
                                            if($tests[ 'pdf_output_count' ]):
                                                $pdf_output_count = $tests[ 'pdf_output_count' ];
                                            endif;

                                            if(filter_input(INPUT_POST,"pdf_output_count")):
                                                $pdf_output_count = filter_input(INPUT_POST,"pdf_output_count");
                                            endif;
                                            ?>
                                        <p>PDF出力制限数</p>
                                        <input type="text"  style="padding:6px;width:40px;" name="pdf_output_count" value="<?=$pdf_output_count?>"  >名
                                    </div>




                                    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
                                    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >
                                    <script type="text/javascript" >
                                        $(function(){

                                            $("[name='pdf_output_limit' ]").change(function(){
                                                var _chk = $("input[name=pdf_output_limit]:checked").val();
                                                $("#onUseImg-1").attr("src","/images/radio_off.jpg");
                                                $("#onUseImg-0").attr("src","/images/radio_off.jpg");
                                                if(_chk == 1){
                                                    $("#onUseImg-"+_chk).attr("src","/images/radio_on.jpg");
                                                }
                                                if(_chk == 0){
                                                    $("#onUseImg-"+_chk).attr("src","/images/radio_on.jpg");
                                                }
                                            });

                                            $("[name='pdf_output_limit_count' ]").change(function(){
                                                var _chk = $("input[name=pdf_output_limit_count]:checked").val();
                                                $("#onUseImg2-1").attr("src","/images/radio_off.jpg");
                                                $("#onUseImg2-0").attr("src","/images/radio_off.jpg");
                                                if(_chk == 1){
                                                    $("#onUseImg2-"+_chk).attr("src","/images/radio_on.jpg");
                                                }
                                                if(_chk == 0){
                                                    $("#onUseImg2-"+_chk).attr("src","/images/radio_on.jpg");
                                                }
                                            });

                                            $(".datepicker").datepicker();
                                        });
                                    </script>
                                </td>
                        </tr>

<?php } ?>


																			</table>





<?PHP
$none = "none";
$read = "";
if ($basetype == 1 && $cdata[ 'pdf_button' ] == 1) {
	$none = "";
	$read = "readonly";
}
?>
<table id="table" style="display:<?=$none?>;width:100%;" >
			<tr >
				<th colspan=2>PDF出力形式選択</th>
			</tr>
			<tr >
				<td colspan=2>
<?PHP
					foreach($array_pdf_grp_name as $keys=>$values){
?>
						<div class="pd10 om grp_<?=$keys?>">
						↓ <?=$values[ 'name' ]?>

<?PHP
						foreach($values[ 'values' ] as $key=>$val){
							$notImg  = "off";
							$checked = "";
							if($_REQUEST[ 'pdf' ] && count($_REQUEST[ 'pdf' ]) && array_key_exists($key,$_REQUEST[ 'pdf' ])){
								$checked = "CHECKED";
								$notImg  = "on";
							}

?>
							<div class="hid chkgrp_<?=$keys?>">
								<div class="left">
									┗ <input type="checkbox" name="pdf[<?=$key?>]" value="on" id="pdf_<?=$key?>" class="chk fixchk_<?=$keys?>" <?=$checked?> <?=$read?>>
								</div>
								<div class="divPdf left">
									<label for="pdf_<?=$key?>" class="label">
									<?=$val?>
									</label>
								</div>
								<br clear=all />
							</div>
<?PHP
						}
?>
					</div>
<?PHP
					}
?>
				</td>
			</tr>
		</table>
	</div>
	<p id="pMsg">
		上記の検査に属する検査種別を選択してください。<br />
		検査によっては、検査に必要な情報入力画面が表示されます。
	</p>



	<ul id="testlist">
<?PHP
	foreach($a_test_type as $key=>$val){
		if($_REQUEST[ 'onChk_'.$key ]){
			//下矢印画像の指定
			$chkImg = "on";
			$onChk  = "onChkdisp";
			$onChecked = "CHECKED";
			$bcolor = "#ffe0e0";
		}else{
			$chkImg = "off";
			$onChk  = "onChkhidden";
			$onChecked = "";
			$bcolor = "#ffffff";
		}

		//デフォルト言語フラグ
		$lang = "langJP";
		//中国語語フラグ
		if($key == 54
			|| $key == 55
			|| $key == 56
			|| $key == 57
			){
			$flg = "cFlg";
			$lang = "langCH";
		}else
		if($key == 41
			|| $key == 42
			){
			//ベトナム語フラグ
			$flg = "vFlg";
			$lang = "langVT";
		}else
		//検査用フラグ
		if($key == 10){
			//多面評価用フラグ
			$flg = "taFlg";
		}elseif($key == 44){
			//添削用フラグ
			$flg = "tenFlg";
		}elseif($key == 49 || $key == 53){
			//人権用フラグ
			$flg = "jinFlg";
		}elseif($key == 52 || $key==60 || $key==62 || $key==67 || $key==68 || $key==86 || $key==87 || $key==89 || $key==90){
			//人権用フラグ
			$flg = "judFlg";
		}else{
			$flg = "tFlg";
		}
?>
<?php if(isset($lists[$key])){ ?>
		<div id="onChkBox_<?=$key?>" class="<?=$flg?> " >
		<label for="onChk_<?=$key?>" >
			<li >
				<img src="/images/sita_ya_<?=$chkImg?>.gif" id="onChkImg_<?=$key?>" class="onChkImg">
				<div class="indent">
				<input type="checkbox" name="onChk_<?=$key?>" value="on" id="onChk_<?=$key?>" class="onChk testselect testcheckbox"  >
				</div>
				<?=$val?>
			</li>
		</label>
		</div>


		<div id="openDiv_<?=$key?>" class="<?=$onChk?> <?=$lang?>"><!--onChkhidden-->
			<div class="openBox">
				■受検者数　<span id="jyukensya_<?=$key?>" class="num"></span>名
				<input type="hidden" name="count[on<?=$key?>]" class="numHid" value="<?=$_REQUEST[ 'count' ][ 'on'.$key ]?>" id="jyukensya_<?=$key?>">
			</div>

<?PHP
		//行動価値検査のみ表示
		if(
			$key==1
			|| $key==2
			|| $key==12
			|| $key == 41
			|| $key == 54
			|| $key == 72
			|| $key == 73
			|| $key == 82
			|| $key == 91
			){
			//別ファイルにて管理
			require "./template/type3/reg_BA_html.php";
		}

		//行動価値検査のみ表示終わり
?>

<?PHP
		//VF検査のみ表示
		if(
			$key==4
			|| $key == 33
			){
			//別ファイルにて管理
			require "./template/type3/reg_VF_html.php";
		}
		//VF検査のみ表示終わり
?>
<?PHP
		//VF検査のみ表示
		if(
			$key==85
			){
			//別ファイルにて管理
			require "./template/type3/reg_MHQ_html.php";
		}
		//VF検査のみ表示終わり
?>
<?PHP
		//感情能力検査表示
		//行動意識検査
		//ＮＬ検査
		//数学検定検査
		//IQ
		if(
			$key==5
			|| $key == 31
			|| $key == 6
			|| $key == 37
			|| $key == 34
                        || $key == 61
			|| $key == 36
			|| $key == 13
			|| $key == 35
			|| $key == 11
			|| $key == 28
			|| $key == 39
			|| $key == 40
			|| $key == 42
			|| $key == 43
			|| $key == 45
			|| $key == 51
			|| $key == 76
			|| $key == 70
			){
			//別ファイルにて管理
			require "./template/type3/reg_EA_html.php";

		}
		//感情能力検査のみ表示終わり
?>

<?PHP
		//MMS
		if(
			$key==46
			){
			//別ファイルにて管理
			require "./template/type3/reg_MMS_html.php";

		}
		//感情能力検査のみ表示終わり
?>
<?PHP
		//AMP
		if(
			$key==83
			){
			//別ファイルにて管理
			require "./template/type3/reg_AMP_html.php";

		}
		//感情能力検査のみ表示終わり
?>

<?PHP
		//感情能力検査社会人版
		if(
			$key==7
			|| $key==47
			|| $key==66
			|| $key==74
			){
			//別ファイルにて管理
			require "./template/type3/reg_EABJ_html.php";
		}
		//感情能力検査社会人版終わり
?>
<?PHP
		//多面評価
		if(
			$key==10
			){
			//別ファイルにて管理
			require "./template/type3/reg_TH_html.php";

		}
		//多面評価終わり
?>

<?PHP
		//添削
		if(
			$key==44
			|| $key==48
			){
			//別ファイルにて管理
			require "./template/type3/reg_CRT_html.php";

		}
		//添削終わり
?>


		</div><!--/onChkhidden-->

<?PHP } //検査の有無の確認終わり ?>
<?php } ?>
	</ul>



	<br clear=all />
	<div id="btnBox">
		<input type="button"  value="戻る" class="button" id="home">
		<input type="submit" name="conf" value="確認する" class="button" id="conf">
	</div>
	<br clear=all />
	</form>
	<input type="hidden" id="tamenFlg" value="<?=$tamenflg?>" >
	<input type="hidden" id="testFlg" value="<?=$testflg?>" >
	<input type="hidden" id="vietnamFlg" value="<?=$vietnam?>" >
	<input type="hidden" id="tenFlg" value="<?=$tensaku_flg?>" >


<?PHP
	//jsに渡すテスト最大キー
?>
	<input type="hidden" id="max" value="<?=$max_key?>" >
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
<script type="text/javascript">
    $(function(){
			$(".uniqCheck").click(function(){
				let chk = $(this).prop("checked");
				
				if(chk){
					$(".uniqCheck").prop("disabled",true);
					$(this).prop("disabled",false);
				}else{
					$(".uniqCheck").prop("disabled",false);
				}
			});
        $(document).on("change","#csv_1",function(){
           $(this).setCsv();
        });
        $(document).on("change","#csv_2",function(){
           $(this).setCsv();
        });
        $(document).on("change","#csv_12",function(){
           $(this).setCsv();
        });


    });

    $.fn.setCsv = function(){
        var _val = $(this).val();
        var _id = $(this).attr("id").split("_");
        var _kcode = _id[1];
        var fd = new FormData();
        if ($("input[name='hoge']").val()!== '') {
          fd.append( "file", $("#csv_"+_kcode).prop("files")[0] );
        }
        fd.append("dir",$(".hoge").val());
        var postData = {
          type : "POST",
          dataType : "text",
          data : fd,
          processData : false,
          contentType : false
        };
        var _url = "../reg/";
        $.ajax(
          _url
          ,postData
        ).done(function( text ){
            console.log(text);
          var _obj = $.parseJSON(text);
          $("#wtw1_"+_kcode).val(_obj[1]);
          $("#wtw2_"+_kcode).val(_obj[2]);
          $("#wtw3_"+_kcode).val(_obj[3]);
          $("#wtw4_"+_kcode).val(_obj[4]);
          $("#wtw5_"+_kcode).val(_obj[5]);
          $("#wtw6_"+_kcode).val(_obj[6]);
          $("#wtw7_"+_kcode).val(_obj[7]);
          $("#wtw8_"+_kcode).val(_obj[8]);
          $("#wtw9_"+_kcode).val(_obj[9]);
          $("#wtw10_"+_kcode).val(_obj[10]);
          $("#wtw11_"+_kcode).val(_obj[11]);
          $("#wtw12_"+_kcode).val(_obj[12]);
          $("#wtw13_"+_kcode).val(_obj[13]);
          $("#wtw14_"+_kcode).val(_obj[14]);
        });


    };

</script>



