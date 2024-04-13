<?PHP
$css1 = "edit";
$title = "AMS:企業更新画面";
$js = array("edit");
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
				"企業情報更新"
			)

		);
		if ($basetype == 2) {
			$pan = array(
				array(
					"",
					"企業情報更新"
				)
			);
		}
		include_once("include_title.php");
		?>
		<div id="searchTitle">企業情報更新</div>
		<p class="p"><span class="red">※</span>は必須項目です。</p>
		<form action="/index/edit/<?= $sec ?>/" method="post" enctype="multipart/form-data">
			<table id="table">
				<tr>
					<th>企業名<span class="red">※</span></th>
					<td>
						<?PHP
						$name = $data['name'];
						if ($_REQUEST['name']) {
							$name = $_REQUEST['name'];
						}
						?>
						<input type="text" name="name" value="<?= $name ?>" id="name" class="w90per">
					</td>
				</tr>
				<tr>
					<th>ログインID<span class="red">※</span></th>
					<td>
						<?PHP
						$login_id = $data['login_id'];
						if ($_REQUEST['login_id']) {
							$login_id = $_REQUEST['login_id'];
						}
						?>
						<input type="text" name="login_id" value="<?= $login_id ?>" id="login_id" class="w200" maxlength=15><span id="idcheck"></span>
						<input type="hidden" name="idchk" id="idchk" value="<?= $login_id ?>">
						<br />
						<span class="explain">※ 4文字以上15文字以下で設定してください</span>
					</td>
				</tr>
				<?PHP
				if ($basetype == 1) {
				?>
					<tr>
						<th>パスワード<span class="red">※</span></th>
						<td>
							<?PHP
							$login_pw = $data['login_pw'];
							if ($_REQUEST['login_pw']) {
								$login_pw = $_REQUEST['login_pw'];
							}

							?>
							<input type="text" name="login_pw" value="<?= $login_pw ?>" id="login_pw" class="w200" maxlength=15>
							<br />
							<span class="explain">
								※ パスワードの長さは、半角8文字以上、半角15文字以下です。<br />
								※ パスワードに使用できる文字は、半角英数すべてです。<br />
								※ パスワードには英大文字・英小文字・数字それぞれを最低1文字ずつ含む必要があります。

							</span>
						</td>
					</tr>
				<?PHP
				} else {
					$login_pw = $data['login_pw'];
					if ($_REQUEST['login_pw']) {
						$login_pw = $_REQUEST['login_pw'];
					}
				?>
					<input type="hidden" value="<?= $login_pw ?>" name="login_pw" id="login_pw">
				<?PHP
				}
				?>
				<tr>
					<th>郵便番号</th>
					<td class="left">
						<?PHP
						$post1 = $data['post1'];
						$post2 = $data['post2'];
						if ($_REQUEST['post1']) {
							$post1 = $_REQUEST['post1'];
						}

						if ($_REQUEST['post2']) {
							$post2 = $_REQUEST['post2'];
						}


						?>
						<input type="text" name="post1" value="<?= $post1 ?>" id="post1" class="w30" maxlength="3">-
						<input type="text" name="post2" value="<?= $post2 ?>" id="post2" class="w40" maxlength="4" onKeyUp="AjaxZip3.zip2addr('post1','post2','pref','address1','address2');">
					</td>
				</tr>
				<tr>
					<th>都道府県</th>
					<td class="left">
						<select name="pref">
							<option name="">-</option>
							<?PHP
							$prefecture = $data['prefecture'];
							if ($_REQUEST['pref']) {
								$prefecture = $_REQUEST['pref'];
							}
							foreach ($array_pref as $key => $val) {
								$sel = "";
								if ($val == $prefecture) {
									$sel = "SELECTED";
								}
							?>
								<option value="<?= $val ?>" <?= $sel ?>><?= $val ?></option>
							<?PHP
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<th>住所１</th>
					<td class="left">
						<?PHP
						$address1 = $data['address1'];
						$address2 = $data['address2'];


						if ($_REQUEST['address1']) {
							$address1 = $_REQUEST['address1'];
						}

						if ($_REQUEST['address2']) {
							$address2 = $_REQUEST['address2'];
						}
						?>
						<input type="text" name="address1" value="<?= $address1 ?>" class="w400" id="address1">
						<span class="explain">※ 市区郡町村、番地</span>
					</td>
				</tr>
				<tr>
					<th>住所２</th>
					<td class="left">
						<input type="text" name="address2" value="<?= $address2 ?>" class="w400" id="address2">
						<span class="explain">※ ビル名など</span>
					</td>
				</tr>

				<tr>
					<th>電話番号</th>
					<td>
						<?PHP
						$tel = $data['tel'];

						if ($_REQUEST['tel']) {
							$tel = $_REQUEST['tel'];
						}
						?>
						<input type="text" name="tel" value="<?= $tel ?>" size=25 id="tel"> <span class="explain">例） 03-1234-5678</span>
					</td>
				</tr>

				<tr>
					<th>FAX番号</th>
					<td>
						<?PHP
						$fax = $data['fax'];
						if ($_REQUEST['fax']) {
							$fax = $_REQUEST['fax'];
						}
						?>
						<input type="text" name="fax" value="<?= $fax ?>" size=25 id="fax"> <span class="explain">例） 03-1234-5678</span>
					</td>
				</tr>

				<?php if ($basetype == 1) : ?>
					<tr>
						<th>受検者傾向確認機能</th>
						<td>
							<?php
							$chk0 = "";
							$chk1 = "";
							if ($data['exam_pattern'] == "1") {
								$chk1 = "CHECKED";
							}
							if ($data['exam_pattern'] == "0") {
								$chk0 = "CHECKED";
							}
							if ($_REQUEST['exam_pattern'] == "0") {
								$chk0 = "CHECKED";
								$chk1 = "";
							}
							if ($_REQUEST['exam_pattern'] == "1") {
								$chk1 = "CHECKED";
								$chk0 = "";
							}
							?>
							<input type="radio" name="exam_pattern" value="0" style="width:20px;height:20px;" id="exam_pattern0" <?= $chk0 ?> />
							<label for="exam_pattern0" style="margin:0px 0px 0px 3px;position:absolute;">利用しない</label>
							<br />
							<input type="radio" name="exam_pattern" value="1" style="width:20px;height:20px;" id="exam_pattern1" <?= $chk1 ?> />
							<label for="exam_pattern1" style="margin:0px 0px 0px 3px;position:absolute;">利用する</label>
						</td>
					</tr>
				<?php endif; ?>


				<?PHP
				if ($basetype != 3) {

					$img0 = "on";
					$chk0 = "CHECKED";
					$img1 = "off";
					$chk1 = "";
					if ($data['csvupload'] == 1) {
						$img0 = "off";
						$chk0 = "";
						$img1 = "on";
						$chk1 = "CHECKED";
					}

					if (isset($_REQUEST['csvupload']) && $_REQUEST['csvupload'] == 1) {
						$img0 = "off";
						$chk0 = "";
						$img1 = "on";
						$chk1 = "CHECKED";
					}
					if (isset($_REQUEST['csvupload']) &&  $_REQUEST['csvupload'] == 0) {
						$img0 = "on";
						$chk0 = "CHECKED";
						$img1 = "off";
						$chk1 = "";
					}

				?>




					<tr>
						<th>CSVアップロードボタン</th>
						<td>
							<div class="indent">
								<input type="radio" name="csvupload" value="1" id="csvon" <?= $chk1 ?>>
							</div>
							<img src="/images/radio_<?= $img1 ?>.jpg" class="rChk_on" id="onImg">
							<label for="csvon" class="rChk_on">表示する</label><br />
							<div class="indent">
								<input type="radio" name="csvupload" value="0" id="csvoff" <?= $chk0 ?>>
							</div>
							<img src="/images/radio_<?= $img0 ?>.jpg" class="rChk_off" id="offImg">
							<label for="csvoff" class="rChk_off">表示しない</label>
						</td>
					</tr>

					<tr>
						<th>PDFボタン</th>
						<td>
							<?PHP
							$imgP0 = "on";
							$chkP0 = "CHECKED";
							$imgP1 = "off";
							$chkP1 = "";
							if ($data['pdf_button'] == 1) {
								$imgP0 = "off";
								$chkP0 = "";
								$imgP1 = "on";
								$chkP1 = "CHECKED";
							}
							if (isset($_REQUEST['pdf_button']) && $_REQUEST['pdf_button'] == 1) {
								$imgP0 = "off";
								$chkP0 = "";
								$imgP1 = "on";
								$chkP1 = "CHECKED";
							}
							if (isset($_REQUEST['pdf_button']) && $_REQUEST['pdf_button'] == 0) {
								$imgP0 = "on";
								$chkP0 = "CHECKED";
								$imgP1 = "off";
								$chkP1 = "";
							}


							?>
							<div class="indent"><input type="radio" name="pdf_button" value="1" id="pdfon" <?= $chkP1 ?>></div>
							<img src="/images/radio_<?= $imgP1 ?>.jpg" id="onPdfImg" class="rPdf_on">
							<label for="pdfon" class="rPdf_on">表示する</label>
							<br />
							<div class="indent"><input type="radio" name="pdf_button" value="0" id="pdfoff" <?= $chkP0 ?>></div>
							<img src="/images/radio_<?= $imgP0 ?>.jpg" id="offPdfImg" class="rPdf_off">
							<label for="pdfoff" class="rPdf_off">表示しない</label>

						</td>
					</tr>
				<?PHP
				}
				?>

				<?PHP
				if ($basetype == 1) {
					$imgP0 = "on";
					$chkP0 = "CHECKED";
					$imgP1 = "off";
					$chkP1 = "";


					if ($data['pdf_master_status'] == 1) {
						$imgP0 = "off";
						$chkP0 = "";
						$imgP1 = "on";
						$chkP1 = "CHECKED";
					}

					if (isset($_REQUEST['pdf_master_status']) && $_REQUEST['pdf_master_status'] == 1) {
						$imgP0 = "off";
						$chkP0 = "";
						$imgP1 = "on";
						$chkP1 = "CHECKED";
					}
					if (isset($_REQUEST['pdf_master_status']) && $_REQUEST['pdf_master_status'] == 0) {
						$imgP0 = "on";
						$chkP0 = "CHECKED";
						$imgP1 = "off";
						$chkP1 = "";
					}
				?>
					<tr>
						<th>PDF重みマスタ</th>
						<td>
							<div class="indent"><input type="radio" name="pdf_master_status" value="1" id="pdf_master_status_on" <?= $chkP1 ?>></div>
							<img src="/images/radio_<?= $imgP1 ?>.jpg" id="msonPdfImg" class="msrPdf_on">
							<label for="pdf_master_status_on" class="msrPdf_on">利用する</label>
							<br />
							<div class="indent"><input type="radio" name="pdf_master_status" value="0" id="pdf_master_status_off" <?= $chkP0 ?>></div>
							<img src="/images/radio_<?= $imgP0 ?>.jpg" id="msoffPdfImg" class="msrPdf_off">
							<label for="pdf_master_status_off" class="msrPdf_off">利用しない</label>
						</td>
					</tr>

					<?PHP
					$imgP0 = "on";
					$chkP0 = "CHECKED";
					$imgP1 = "off";
					$chkP1 = "";
					if ($data['excel_master_status'] == 1) {
						$imgP0 = "off";
						$chkP0 = "";
						$imgP1 = "on";
						$chkP1 = "CHECKED";
					}
					if (isset($_REQUEST['excel_master_status']) && $_REQUEST['excel_master_status'] == 1) {
						$imgP0 = "off";
						$chkP0 = "";
						$imgP1 = "on";
						$chkP1 = "CHECKED";
					}
					if (isset($_REQUEST['excel_master_status']) && $_REQUEST['excel_master_status'] == 0) {
						$imgP0 = "on";
						$chkP0 = "CHECKED";
						$imgP1 = "off";
						$chkP1 = "";
					}
					?>

					<tr>
						<th>エクセル重みマスタ</th>
						<td>
							<div class="indent"><input type="radio" name="excel_master_status" value="1" id="excel_master_status_on" <?= $chkP1 ?>></div>
							<img src="/images/radio_<?= $imgP1 ?>.jpg" id="exonPdfImg" class="exrPdf_on">
							<label for="excel_master_status_on" class="exrPdf_on">利用する</label>
							<br />
							<div class="indent"><input type="radio" name="excel_master_status" value="0" id="excel_master_status_off" <?= $chkP0 ?>></div>
							<img src="/images/radio_<?= $imgP0 ?>.jpg" id="exoffPdfImg" class="exrPdf_off">
							<label for="excel_master_status_off" class="exrPdf_off">利用しない</label>
						</td>
					</tr>


					<tr>
						<th>顧客ファイルアップロード</th>
						<td>
							<?php
							$chk0 = "CHECKED";
							$chk1 = "";
							if ($_REQUEST['customer_file_upload'] == "0") {
								$chk0 = "CHECKED";
								$chk1 = "";
							} else
							if ($_REQUEST['customer_file_upload'] == "1") {
								$chk0 = "";
								$chk1 = "CHECKED";
							} else {
								if ($data['customer_file_upload'] == "1") {
									$chk1 = "CHECKED";
								}
								if ($data['customer_file_upload'] == "0") {
									$chk0 = "CHECKED";
								}
							}
							?>
							<input type="radio" name="customer_file_upload" value="0" style="width:20px;height:20px;" id="customer_file_upload0" <?= $chk0 ?> />
							<label for="customer_file_upload0" style="margin:0px 0px 0px 3px;position:absolute;">利用しない</label>
							<br />
							<input type="radio" name="customer_file_upload" value="1" style="width:20px;height:20px;" id="customer_file_upload1" <?= $chk1 ?> />
							<label for="customer_file_upload1" style="margin:0px 0px 0px 3px;position:absolute;">利用する</label>
						</td>
					</tr>



				<?PHP
				}
				?>

				<?PHP

				if ($ptTestBtn == 1) {
					$chk1 = "";
					$chk2 = "";

					if ($data['csTestBtn'] == 1) $chk1 = "CHECKED";
					if ($data['csTestBtn'] == 0) $chk2 = "CHECKED";
					if (isset($_REQUEST['csTestBtn'])) {
						if ($_REQUEST['csTestBtn'] == 1) $chk1 = "CHECKED";
						if ($_REQUEST['csTestBtn'] == 0) $chk2 = "CHECKED";
					}
				?>

					<tr>
						<th>検査申込みボタン</th>
						<td>
							<ul class="ul">
								<li><input type="radio" name="csTestBtn" value="1" id="csTestBtn_on" class="radio" <?= $chk1 ?>></li>
								<li><label for="csTestBtn_on">利用する</label> </li>
							</ul>
							<ul class="ul">
								<li><input type="radio" name="csTestBtn" value="0" id="csTestBtn_off" class="radio" <?= $chk2 ?>></li>
								<li><label for="csTestBtn_off">利用しない</label> </li>
							</ul>
						</td>
					</tr>
				<?PHP
				}
				?>
				<tr>
					<th>SSL設定</th>
					<td>
						<?php
						$chk1 = "";
						$chk0 = "";
						if ($data['ssltype'] == "0") $chk0 = "checked";
						if ($data['ssltype'] == "1") $chk1 = "checked";
						if ($_REQUEST['ssltype'] == '1') $chk1 = "checked";
						if ($_REQUEST['ssltype'] == '0') $chk0 = "checked";
						?>
						<input type="radio" name="ssltype" value=1 class="radio" <?= $chk1 ?>> 設定する<br />
						<input type="radio" name="ssltype" value=0 class="radio" <?= $chk0 ?>> 設定しない
					</td>
				</tr>
				<tr>
					<th>ロゴ画像</th>
					<td>
						<?PHP
						/*
$agent = getenv("HTTP_USER_AGENT");
if(mb_ereg("MSIE", $agent)){
*/
						?>
						<input type="file" name="upfile" size="30" id="img" />
						<span class="explain">※幅240ピクセル、高さ80ピクセル、ファイルサイズ10kbyte程度</span>
						<div id="preview">
							<?PHP
							if ($logo) {
							?>
								<img src="<?= $logo ?>" id="logoimg">
							<?PHP
							}
							?>
						</div>

						<?PHP
						/*
}else{
?>
			<div id="fileUpLoad">ここにファイルをドラッグしてください。<div id="prev"></div></div>
			<span class="explain" >※幅240ピクセル、高さ80ピクセル、ファイルサイズ10kbyte程度</span>
<?PHP
}
*/
						?>
						<div class="indent"><input type="checkbox" name="logodel" value="on" id="logodel"></div>
						<img src="/images/checkbox_off.jpg" id="delimg" class="ldel">
						<label for="logodel" id="lableLogo">ロゴ画像削除</label>
					</td>
				</tr>
				<?PHP

				$img0 = "off";
				$chk0 = "";
				$img1 = "on";
				$chk1 = "CHECKED";
				if ($data['privacy_flg'] == 0) {
					$img1 = "off";
					$chk1 = "";
					$img0 = "on";
					$chk0 = "CHECKED";
				}

				if (isset($_REQUEST['privacy_flg']) && $_REQUEST['privacy_flg'] == 1) {
					$img1 = "on";
					$chk1 = "CHECKED";
					$img0 = "off";
					$chk0 = "";
				}

				if (isset($_REQUEST['privacy_flg']) &&  $_REQUEST['privacy_flg'] == 0) {
					$img1 = "off";
					$chk1 = "";
					$img0 = "on";
					$chk0 = "CHECKED";
				}
				?>
				<tr>
					<th>プライバシーポリシー</th>
					<td>
						<?php
						$chk1 = "";
						$chk2 = "";
						if ($data['privacypolicy'] == 1) :
							$chk1 = "CHECKED";
						endif;
						if ($data['privacypolicy'] == 2) :
							$chk2 = "CHECKED";
						endif;
						?>
						<input type="radio" id="privacypolicy-1" name="privacypolicy" value="1" <?= $chk1 ?> />
						<label for="privacypolicy-1">デフォルト表示</label>
						<br />
						<input type="radio" id="privacypolicy-2" name="privacypolicy" value="2" <?= $chk2 ?> />
						<label for="privacypolicy-2">編集する</label>
						<br />
						<textarea name="privacypolicy_text" id="privacypolicy_text" style="width:100%;height:300px;"><?= preg_replace("/株式会社テスト２/", "弊社", $data['privacypolicy_text']) ?></textarea>
					</td>
				</tr>
				<tr>
					<th>顧客の表示/非表示</th>
					<td>
						<?php foreach ($array_customer_display as $key => $value) :
							$checked = "";

							if ($key == $data['customer_display']) {
								$checked = "checked";
							}
							if (isset($_REQUEST['customer_display']) && $key == $_REQUEST['customer_display']) {
								$checked = "checked";
							}

							if ($key == 1 && !$checked) {
								$checked = "checked";
							}

							$disabled = "";
							$color="black";
							if ($hidecount && $key == 0) {
								$disabled = "disabled";
								$color="#cfcfcf";
							}

						?>
							<label>
								<input type="radio" name="customer_display" value="<?= $key ?>" <?= $checked ?> <?= $disabled ?> />
								<span style='color:<?=$color?>;'><?= $value ?></span>
							</label>
						<?php endforeach; ?>
						<p style="color:red;">顧客を非表示にする場合は、登録検査をすべて非表示にしてください。</p>
						<?php if(!$disabled):?>
						<p style="color:red;">表示中の検査があります。すべての検査を非表示にしてから顧客の非表示を行ってください。</p>
						<?php endif; ?>

					</td>
				</tr>

			</table>

			<table id="table2">
				<tr>
					<th>担当者氏名<span class="red">※</span></th>
					<td>
						<?PHP
						$rep_name = $data['rep_name'];
						if ($_REQUEST['rep_name']) {
							$rep_name = $_REQUEST['rep_name'];
						}
						?>
						<input type="text" name="rep_name" value="<?= $rep_name ?>" id="rep_name" class="w400">
					</td>
				</tr>
				<tr>
					<th>担当者アドレス<span class="red">※</span></th>
					<td>
						<?PHP
						$rep_email = $data['rep_email'];
						if ($_REQUEST['rep_name']) {
							$rep_email = $_REQUEST['rep_email'];
						}
						?>
						<input type="text" name="rep_email" value="<?= $rep_email ?>" id="rep_email" class="w90per">
					</td>
				</tr>
				<tr>
					<th>部署名</th>
					<td>
						<?PHP
						$rep_busyo = $data['rep_busyo'];
						if ($_REQUEST['rep_busyo']) {
							$rep_busyo = $_REQUEST['rep_busyo'];
						}
						?>
						<input type="text" name="rep_busyo" value="<?= $rep_busyo ?>" id="rep_busyo" class="w90per">
					</td>
				</tr>
				<tr>
					<th>連絡先1</th>
					<td>
						<?PHP
						$rep_tel1 = $data['rep_tel1'];
						if ($_REQUEST['rep_tel1']) {
							$rep_tel1 = $_REQUEST['rep_tel1'];
						}
						?>
						<input type="text" name="rep_tel1" value="<?= $rep_tel1 ?>" id="rep_tel1" class="w400"><span class="explain">例） 03-1234-5678</span>
					</td>
				</tr>
				<tr>
					<th>連絡先2</th>
					<td>
						<?PHP
						$rep_tel2 = $data['rep_tel2'];
						if ($_REQUEST['rep_tel2']) {
							$rep_tel2 = $_REQUEST['rep_tel2'];
						}
						?>
						<input type="text" name="rep_tel2" value="<?= $rep_tel2 ?>" id="rep_tel2" class="w400"><span class="explain">例） 03-1234-5678</span>
					</td>
				</tr>
				<tr>
					<th>担当者氏名2</th>
					<td>
						<?PHP
						$rep_name2 = $data['rep_name2'];
						if ($_REQUEST['rep_name2']) {
							$rep_name2 = $_REQUEST['rep_name2'];
						}
						?>
						<input type="text" name="rep_name2" value="<?= $rep_name2 ?>" id="rep_name2" class="w400">
					</td>
				</tr>
				<tr>
					<th>担当者アドレス2</th>
					<td>
						<?PHP
						$rep_email2 = $data['rep_email2'];
						if ($_REQUEST['rep_email2']) {
							$rep_email2 = $_REQUEST['rep_email2'];
						}
						?>
						<input type="text" name="rep_email2" value="<?= $rep_email2 ?>" id="rep_email2" class="w90per">
					</td>
				</tr>

				<input type="hidden" name="previewImgId" value="<?= $id . "_" . time() ?>" id="previewImgId">
				<input type="hidden" name="pv" value="" id="pv">
			</table>

			<input type="button" name="back" value="戻る" class="button" id="back">
			<input type="submit" name="conf" value="確認画面" class="button" id="conf">
			<input type="hidden" id="basetype" value="<?=$basetype?>" />
		</form>
	</div>
	<br clear=all />
	<?PHP
	include_once("include_footer_name.php");
	?>
</div>
<script type="text/javascript">
	$(function() {

		$("#conf").click(function() {
			let basetype = $("#basetype").val();
			if(basetype == 1){
				let pwd = $("[name='login_pw']").val();
				if (pwd.length < 8) {
					alert("パスワードは8文字以上で入力してください。");
					return false;
				}
				if (pwd.length > 15) {
					alert("パスワードは15文字以下で入力してください。");
					return false;
				}
				if (!pwd.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,15}$/)) {
					alert("パスワードには英大文字・英小文字・数字それぞれを最低1文字ずつ含む必要があります。");
					return false;
				}
			}
			return true;
		});


		$(this).chk();
		$("[name='privacypolicy']").on("click", function() {
			$(this).chk();
		});
	});
	$.fn.chk = function() {
		var _chk = $("#privacypolicy-2").prop("checked");
		$("#privacypolicy_text").prop("disabled", true);
		if (_chk) {
			$("#privacypolicy_text").prop("disabled", false);
		}
	}
</script>
<?PHP
include_once("include_footer.php");
?>