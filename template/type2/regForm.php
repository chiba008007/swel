<?PHP
$css1 = "regForm";
$title = "AMS:企業登録フォーム画面";
$js = array("regForm");
$map = true;
$drop = true;
include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
$pan = array(

			array(
				"/",
				"顧客企業一覧"
			),
			array(
				"",
				"企業登録フォームボタン"
			),
		);
if($basetype == 2){
$pan = array(
			array(
				"",
				"企業登録フォームボタン"
			),
		);
}
include_once("include_title.php");
?>
	<div id="dataTitle">企業登録フォーム</div>
	<p id="title">企業登録フォームより、登録を行った顧客に対し、貴社側で認証を行うか否かの設定を行います。</p>
<?PHP
	$chk1 = "CHECKED";
	$img1 = "on";
	$chk0 = "";
	$img0 = "off";
	if($user[ 'form_status' ] == 0){
		$chk1 = "";
		$img1 = "off";
		$chk0 = "checked";
		$img0 = "on";
	}

?>
	<ul id="ulStatus">
		<li>
			<div class="indent" ><input type="radio" name="form_status" value="1" id="form_status1" <?=$chk1?> class="radioSts" ></div>
			<img src="/images/radio_<?=$img1?>.jpg" id="radio_1" class="rdo rImg">
			<span class="rdo" id="span_1">認証作業を行う</span>
		</li>
		<li>
			<div class="indent" ><input type="radio" name="form_status" value="0" id="form_status0" <?=$chk0?> class="radioSts" ></div>
			<img src="/images/radio_<?=$img0?>.jpg" id="radio_0" class="rdo rImg">
			<span class="rdo" id="span_0">認証作業をしない</span>
		</li>

	</ul>
	
	<div id="manualbox">
		<p>メールに添付するマニュアルをアップロードしてください。<br />
		PDFファイルのみアップロードをお願いします。</p>
		<form action="/index/regForm/" method="post" enctype="multipart/form-data">
			<p class="mgtop">検査システムの説明用マニュアル</p>
			<div class="left">
				<input type="file" name="upfile1" size="30" id="img1" />
			</div>
			<div class="left">
				<input type="button" id="img1Btn" value="アップロード" class="upbutton">
			</div>
			<div class="left">
				<input type="button" id="del1Btn" value="登録ファイル削除" class="upbutton">
			</div>
			<br clear=all />
<?PHP
			$href1 = "/manual/system-manual.pdf";
			//専用マニュアルあれば利用
			$usePdf = "./manual/".$id."/system-manual.pdf";
			if(file_exists($usePdf)){
				$href1 = "/manual/".$id."/system-manual.pdf";
			}
?>
			<div ><a href="<?=$href1?>" id="preview1" target=_blank >検査システムの説明用マニュアル</a></div>
		</form>
		<form action="/index/regForm/" method="post" enctype="multipart/form-data">
			<p class="mgtop">検査結果の説明用マニュアル</p>
			<div class="left">
				<input type="file" name="upfile2" size="30" id="img2" />
			</div>
			<div class="left">
				<input type="button" id="img2Btn" value="アップロード" class="upbutton">
			</div>
			<div class="left">
				<input type="button" id="del2Btn" value="登録ファイル削除" class="upbutton">
			</div>

			<br clear=all />

<?PHP
			$href2 = "/manual/output-manual.pdf";
			//専用マニュアルあれば利用
			$usePdf = "./manual/".$id."/output-manual.pdf";
			if(file_exists($usePdf)){
				$href2 = "/manual/".$id."/output-manual.pdf";
			}
?>
			<div ><a href="<?=$href2?>" id="preview2" target=_blank >検査結果の説明用マニュアル</a></div>
		</form>

		<p><b>検査結果の説明用マニュアル送信日指定</b></p>
<?PHP
		$sel1 = "";
		$sel2 = "";
		if($user[ 'sendDayStatus' ] == 0){
			$sel1 = "CHECKED";
		}else
		if($user[ 'sendDayStatus' ] == 1){
			$sel2 = "CHECKED";
		}
?>
		<input type="radio" name="sendDayStatus" value="0" <?=$sel1?> class="sendDayStatus" >指定なし<br />
		<input type="radio" name="sendDayStatus" value="1" <?=$sel2?> class="sendDayStatus" >3日後配信<br />

	</div>

	<div id="weightBox">
		<p>重み付けを行う</p>
		<table class="wtable" >
			<tr>
				<th><?=$a_element[ 'w1' ]?></th>
				<th><?=$a_element[ 'w2' ]?></th>
				<th><?=$a_element[ 'w3' ]?></th>
				<th><?=$a_element[ 'w4' ]?></th>
				<th><?=$a_element[ 'w5' ]?></th>
				<th><?=$a_element[ 'w6' ]?></th>
				<th><?=$a_element[ 'w7' ]?></th>
			</tr>
			<tr>
				<td><input type="text" id="w1" value="<?=$w1?>" ></td>
				<td><input type="text" id="w2" value="<?=$w2?>" ></td>
				<td><input type="text" id="w3" value="<?=$w3?>" ></td>
				<td><input type="text" id="w4" value="<?=$w4?>" ></td>
				<td><input type="text" id="w5" value="<?=$w5?>" ></td>
				<td><input type="text" id="w6" value="<?=$w6?>" ></td>
				<td><input type="text" id="w7" value="<?=$w7?>" ></td>
			</tr>
			<tr>
				<th><?=$a_element[ 'w8'  ]?></th>
				<th><?=$a_element[ 'w9'  ]?></th>
				<th><?=$a_element[ 'w10' ]?></th>
				<th><?=$a_element[ 'w11' ]?></th>
				<th><?=$a_element[ 'w12' ]?></th>
				<th>平均点</th>
				<th>標準偏差値</th>
			</tr>
			<tr>
				<td><input type="text" id="w8"  value="<?=$w8?>" ></td>
				<td><input type="text" id="w9"  value="<?=$w9?>" ></td>
				<td><input type="text" id="w10" value="<?=$w10?>" ></td>
				<td><input type="text" id="w11" value="<?=$w11?>" ></td>
				<td><input type="text" id="w12" value="<?=$w12?>" ></td>
				<td><input type="text" id="ave" value="<?=$ave?>" ></td>
				<td><input type="text" id="sd"  value="<?=$sd?>" ></td>
			</tr>
		</table>
		<div id="wt"><input type="button" id="weights" value="重み登録" class="button"></div>
	</div>
	<br clear=all />
	<div id="linkBox">
		<p>貴社専用の企業登録フォームが表示されるURL・リンクタグが表示されます。Ａ・Ｂどちらか一方をご利用ください。</p>
		<p><b>Ａ</b><br />
		企業登録フォームリンクタグを生成します。貴社のホームページ等でご利用ください。<br />
		下記ＵＲＬより、貴社専用の企業登録フォームが表示されます。 </p>
		企業登録フォームリンク<br />
		<input type="text" value="<?=D_URLS_HOME?>ams/index/<?=$user[form_code]?>/" class="w100p" readonly>
		<br /><br />
		<p><b>B</b><br />
		企業登録フォームリンクタグを生成します。貴社のホームページ等で利用します。 </p>
		企業登録フォームリンク<br />
		<textarea readonly >
&#60;!--ここからコピー--!&#62;
&#60;a href="<?=D_URLS_HOME?>ams/index/<?=$user[form_code]?>/" target=_blank /&#62;
&#60;img src="<?=D_URL_HOME?>ams/images/ams.jpg" /&#62;
&#60;/a&#62;
&#60;!--ここまでコピー--!&#62;
		
		</textarea>
<img src="/ams/images/ams.jpg" >

	</div>
	<input type="button" class="button" value="戻る" id="back">
	<input type="hidden" id="id" value="<?=$id?>">
	<br clear=all />

	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
