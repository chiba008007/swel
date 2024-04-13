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
		<p>以下の内容で登録します。</p>
		<form action="/index/edit/<?= $sec ?>/" method="post" enctype="multipart/form-data">
			<table id="table">
				<tr>
					<th>企業名</th>
					<td>
						<?PHP
						if ($_REQUEST['name']) {
							$name = $_REQUEST['name'];
						}
						?>
						<?= $name ?>
						<input type="hidden" name="name" value="<?= $name ?>">
					</td>
				</tr>
				<tr>
					<th>ログインID</th>
					<td>
						<?PHP
						if ($_REQUEST['login_id']) {
							$login_id = $_REQUEST['login_id'];
						}
						?>
						<?= $login_id ?>
						<input type="hidden" name="login_id" value="<?= $login_id ?>">
						<input type="hidden" name="idchk" id="idchk" value="<?= $_REQUEST['idchk'] ?>">
					</td>
				</tr>
				<?PHP
				if ($basetype == 1) {
				?>
					<tr>
						<th>パスワード</th>
						<td>
							<?PHP
							if ($_REQUEST['login_pw']) {
								$login_pw = $_REQUEST['login_pw'];
							}

							?>
							<?= $login_pw ?>
							<input type="hidden" name="login_pw" value="<?= $login_pw ?>">
						</td>
					</tr>
				<?PHP
				} else {
				?>
					<input type="hidden" name="login_pw" value="<?= $_REQUEST['login_pw'] ?>">
				<?PHP
				}
				?>
				<tr>
					<th>郵便番号</th>
					<td class="left">
						<?PHP
						if ($_REQUEST['post1']) {
							$post1 = $_REQUEST['post1'];
						}

						if ($_REQUEST['post2']) {
							$post2 = $_REQUEST['post2'];
						}


						?>
						<input type="hidden" name="post1" value="<?= $post1 ?>"><?= $post1 ?>-
						<input type="hidden" name="post2" value="<?= $post2 ?>"><?= $post2 ?>
					</td>
				</tr>
				<tr>
					<th>都道府県</th>
					<td class="left">

						<?PHP
						if ($_REQUEST['pref']) {
							$prefecture = $_REQUEST['pref'];
						}
						?>
						<?= $prefecture ?>
						<input type="hidden" name="pref" value="<?= $prefecture ?>">
					</td>
				</tr>
				<tr>
					<th>住所１</th>
					<td class="left">
						<?PHP
						if ($_REQUEST['address1']) {
							$address1 = $_REQUEST['address1'];
						}

						if ($_REQUEST['address2']) {
							$address2 = $_REQUEST['address2'];
						}
						?>
						<?= $address1 ?>
						<input type="hidden" name="address1" value="<?= $address1 ?>">
					</td>
				</tr>
				<tr>
					<th>住所２</th>
					<td class="left">
						<?= $address2 ?>
						<input type="hidden" name="address2" value="<?= $address2 ?>">
					</td>
				</tr>

				<tr>
					<th>電話番号</th>
					<td>
						<?PHP
						if ($_REQUEST['tel']) {
							$tel = $_REQUEST['tel'];
						}
						?>
						<?= $tel ?>
						<input type="hidden" name="tel" value="<?= $tel ?>">
					</td>
				</tr>

				<tr>
					<th>FAX番号</th>
					<td>
						<?PHP
						if ($_REQUEST['fax']) {
							$fax = $_REQUEST['fax'];
						}
						?>
						<?= $fax ?>
						<input type="hidden" name="fax" value="<?= $fax ?>" size=25>
					</td>
				</tr>
				<?php if ($basetype == 1) : ?>
					<tr>
						<th>受検者傾向確認機能</th>
						<td>
							<?php if ($_REQUEST['exam_pattern'] == "1") { ?>
								利用する
							<?php } ?>
							<?php if ($_REQUEST['exam_pattern'] == "0") { ?>
								利用しない
							<?php } ?>
							<input type="hidden" name="exam_pattern" value="<?= $_REQUEST['exam_pattern'] ?>" />
						</td>
					</tr>
				<?php endif; ?>
				<?PHP

				$adisp[1] = "表示する";
				$adisp[0] = "表示しない";
				$adisp1[1] = "利用する";
				$adisp1[0] = "利用しない";
				if ($basetype != 3) {
				?>
					<tr>
						<th>CSVアップロードボタン</th>
						<td>
							<?= $adisp[$_REQUEST['csvupload']] ?>
							<input type="hidden" name="csvupload" value="<?= $_REQUEST['csvupload'] ?>">
						</td>
					</tr>
					<tr>
						<th>PDFボタン</th>
						<td>
							<?= $adisp1[$_REQUEST['pdf_button']] ?>
							<input type="hidden" name="pdf_button" value="<?= $_REQUEST['pdf_button'] ?>">
						</td>
					</tr>

				<?PHP
				}
				?>

				<?PHP
				if ($basetype == 1) {

					$adisp[1] = "利用する";
					$adisp[0] = "利用しない";
				?>
					<tr>
						<th>PDF重みマスタ</th>
						<td>
							<?= $adisp[$_REQUEST['pdf_master_status']] ?>
							<input type="hidden" name="pdf_master_status" value="<?= $_REQUEST['pdf_master_status'] ?>">
						</td>
					</tr>
					<tr>
						<th>エクセル重みマスタ</th>
						<td>
							<?= $adisp[$_REQUEST['excel_master_status']] ?>
							<input type="hidden" name="excel_master_status" value="<?= $_REQUEST['excel_master_status'] ?>">
						</td>
					</tr>

					<tr>
						<th>顧客ファイルアップロード</th>
						<td>
							<?= $adisp[$_REQUEST['customer_file_upload']] ?>
							<input type="hidden" name="customer_file_upload" value="<?= $_REQUEST['customer_file_upload'] ?>">

						</td>
					</tr>


				<?PHP
				}
				?>

				<tr>
					<th>SSL設定</th>
					<td>
						<input type="hidden" name="ssltype" value="<?= $_REQUEST['ssltype'] ?>" class="radio">
						<?php
						if ($_REQUEST['ssltype'] == "1") echo "設定する";
						if ($_REQUEST['ssltype'] == "0") echo "設定しない";
						?>

					</td>
				</tr>

				<tr>
					<th>ロゴ画像</th>
					<td>
						<?PHP
						if ($_REQUEST['logodel']) {
						?>
							ロゴ画像削除
							<input type="hidden" name="logodel" value="on">
							<?PHP
						} else {
							if ($_REQUEST['pv']) {
							?>
								<div id="preview">
									<img src="/images/preview/<?= $imgPath ?>" />
								</div>
								<input type="hidden" name="prev" value="<?= $prev ?>">
								<input type="hidden" name="imgfilename" value="<?= $fname ?>">
							<?PHP
							} else {
							?>
								<img src="<?= $logo ?>" id="logoimg">
						<?PHP
							}
						} //logodel終わり
						?>
					</td>
				</tr>

				<?PHP
				if ($ptTestBtn == 1) {
					if ($_REQUEST['csTestBtn'] == 1) $str = "利用する";
					if ($_REQUEST['csTestBtn'] == 0) $str = "利用しない";
				?>

					<tr>
						<th>検査申込みボタン</th>
						<td>
							<ul class="ul">
								<li><input type="hidden" name="csTestBtn" value="<?= $_REQUEST['csTestBtn'] ?>"></li>
								<li><?= $str ?></li>
							</ul>

						</td>
					</tr>
				<?PHP
				}
				?>


				<?PHP

				$img0 = "on";
				$chk0 = "CHECKED";
				$img1 = "off";
				$chk1 = "";

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
						<input type="hidden" name="privacypolicy" value="<?= $_REQUEST['privacypolicy'] ?>" />
						<?php if ($_REQUEST['privacypolicy'] == 1) : ?>
							デフォルト表示<br />
						<?php endif; ?>
						<?php if ($_REQUEST['privacypolicy'] == 2) : ?>
							編集する
							<hr />
							<?= nl2br($_REQUEST['privacypolicy_text']) ?>

						<?php endif; ?>
						<input type="hidden" name="privacypolicy_text" value="<?= $_REQUEST['privacypolicy_text'] ?>" />

						<br />
					</td>
				</tr>

				<tr>
					<th>顧客の表示/非表示</th>
					<td>
						<?= $array_customer_display[$_REQUEST['customer_display']] ?>
						<input type="hidden" name="customer_display" value="<?= $_REQUEST['customer_display'] ?>" />
					</td>
				</tr>

			</table>

			<table id="table2">
				<tr>
					<th>担当者氏名<span class="red">※</span></th>
					<td>
						<?PHP
						if ($_REQUEST['rep_name']) {
							$rep_name = $_REQUEST['rep_name'];
						}
						?>
						<?= $rep_name ?>
						<input type="hidden" name="rep_name" value="<?= $rep_name ?>">
					</td>
				</tr>
				<tr>
					<th>担当者アドレス<span class="red">※</span></th>
					<td>
						<?PHP
						if ($_REQUEST['rep_email']) {
							$rep_email = $_REQUEST['rep_email'];
						}
						?>
						<?= $rep_email ?>
						<input type="hidden" name="rep_email" value="<?= $rep_email ?>">
					</td>
				</tr>
				<tr>
					<th>部署名</th>
					<td>
						<?PHP
						if ($_REQUEST['rep_busyo']) {
							$rep_busyo = $_REQUEST['rep_busyo'];
						}
						?>
						<?= $rep_busyo ?>
						<input type="hidden" name="rep_busyo" value="<?= $rep_busyo ?>">
					</td>
				</tr>
				<tr>
					<th>連絡先1</th>
					<td>
						<?PHP
						if ($_REQUEST['rep_tel1']) {
							$rep_tel1 = $_REQUEST['rep_tel1'];
						}
						?>
						<?= $rep_tel1 ?>
						<input type="hidden" name="rep_tel1" value="<?= $rep_tel1 ?>">
					</td>
				</tr>
				<tr>
					<th>連絡先2</th>
					<td>
						<?PHP
						if ($_REQUEST['rep_tel2']) {
							$rep_tel2 = $_REQUEST['rep_tel2'];
						}
						?>
						<?= $rep_tel2 ?>
						<input type="hidden" name="rep_tel2" value="<?= $rep_tel2 ?>">
					</td>
				</tr>
				<tr>
					<th>担当者氏名2</th>
					<td>
						<?PHP
						if ($_REQUEST['rep_name2']) {
							$rep_name2 = $_REQUEST['rep_name2'];
						}
						?>
						<?= $rep_name2 ?>
						<input type="hidden" name="rep_name2" value="<?= $rep_name2 ?>">
					</td>
				</tr>
				<tr>
					<th>担当者アドレス2</th>
					<td>
						<?PHP
						if ($_REQUEST['rep_email2']) {
							$rep_email2 = $_REQUEST['rep_email2'];
						}
						?>
						<?= $rep_email2 ?>
						<input type="hidden" name="rep_email2" value="<?= $rep_email2 ?>">
					</td>
				</tr>

				<input type="hidden" name="previewImgId" value="<?= $id . "_" . time() ?>" id="previewImgId">
				<input type="hidden" name="pv" value="<?= $_REQUEST['pv'] ?>" id="pv">

			</table>

			<input type="submit" name="input" value="戻る" class="button" id="input">
			<input type="submit" name="regist" value="登録" class="button">
		</form>
	</div>
	<br clear=all />

	<?PHP
	include_once("include_footer_name.php");
	?>
</div>

<?PHP
include_once("include_footer.php");
?>