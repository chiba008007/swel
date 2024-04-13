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
		if($basetype == 1){
?>
			<tr>
				<th>PDFダウンロード型式</th>
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
					各型式別に複数ファイルとしてダウンロードする（PDFファイルがそれぞれZIPファイルでダウンロードされます。）</div>
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

<?PHP
			if($basetype == 1){
?>
			<tr>
				<th colspan=2>PDF出力形式選択</th>
			</tr>
			<tr>
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
							if(count($_REQUEST[ 'pdf' ]) && array_key_exists($key,$_REQUEST[ 'pdf' ])){
								$checked = "CHECKED";
								$notImg  = "on";
							}

?>
							<div class="hid chkgrp_<?=$keys?>">
								<div class="left">
									┗ <input type="checkbox" name="pdf[<?=$key?>]" value="on" id="pdf_<?=$key?>" class="chk fixchk_<?=$keys?>" <?=$checked?> >
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
<?PHP
			}
?>
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
		}elseif($key == 52){
			//人権用フラグ
			$flg = "judFlg";
		}else{
			$flg = "tFlg";
		}
		//検査の有無の確認
		if(isset($lists[$key])){
?>
		<div id="onChkBox_<?=$key?>" class="<?=$flg?>" >
		<label for="onChk_<?=$key?>" >
			<li>
				<img src="/images/sita_ya_<?=$chkImg?>.gif" id="onChkImg_<?=$key?>" class="onChkImg">
				<div class="indent">
				<input type="checkbox" name="onChk_<?=$key?>" value="on" id="onChk_<?=$key?>" class="onChk" <?=$onChecked?> >
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
                        || $key == 59
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
		//感情能力検査社会人版
		if(
			$key==7
			|| $key==47
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

<?PHP
		}//検査の有無の確認終わり
	}
?>
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
