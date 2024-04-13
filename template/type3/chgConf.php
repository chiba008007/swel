<?PHP

if($_COOKIE[ 'lang' ] == "ch" ){
	$str = "企业信息更新";
	$str1 = "接受检查者一览";
	$cstr1 = "登记的内容如下";
	$cstr2 = "企业名";
	$cstr3 = "登录帐号";
	$cstr4 = "密码";
	$cstr5 = "未输入没有変更。用半角英数输入。设定4文字以上。";
	$cstr6 = "邮编";
	$cstr7 = "省";
	$cstr8 = "地址１";
	$cstr9 = "※市县镇乡村、街道";
	$cstr10 = "地址２";
	$cstr11 = "楼名等";
	$cstr12 = "电话号码";
	$cstr13 = "传真号码";
	$cstr14 = "标识画像";
	$cstr15 = "宽240像素、高80像素、文件大小10kbyte左右";
	$cstr16 = "没选择";
	$cstr17 = "选择文件";
	$cstr18 = "标识画像删除";
	$cstr19 = "隐私声明";
	$cstr20 = "表示企业名";
	$cstr21 = "使用企业名";
	$cstr22 = "设定隐私声明使用的企业名。";
	$cstr23 = "负责人姓名";
	$cstr24 = "负责人地址";
	$cstr25 = "部门名";
	$cstr26 = "联系方式1";
	$cstr27 = "联系方式2";
	$cstr28 = "负责人姓名2";
	$cstr29 = "负责人地址2";
	$cstr30 = "返回";
	$cstr31 = "定位";


}else{
	$str = "企業情報更新";
	$str1 = "受検者一覧";
	$cstr1 = "以下の内容で登録します。";
	$cstr2 = "企業名";
	$cstr3 = "ログインID";
	$cstr4 = "パスワード";
	$cstr5 = "未入力で変更なし。半角英数で入力してください。4文字以上で設定してください。";
	$cstr6 = "郵便番号";
	$cstr7 = "都道府県";
	$cstr8 = "住所１";
	$cstr9 = "※ 市区郡町村、番地";
	$cstr10 = "住所２";
	$cstr11 = "ビル名など";
	$cstr12 = "電話番号";
	$cstr13 = "FAX番号";
	$cstr14 = "ロゴ画像";
	$cstr15 = "幅240ピクセル、高さ80ピクセル、ファイルサイズ10kbyte程度";
	$cstr16 = "選択されていません。";
	$cstr17 = "ファイルを選択";
	$cstr18 = "ロゴ画像削除";
	$cstr19 = "プライバシーポリシー";
	$cstr20 = "表示企業名";
	$cstr21 = "企業名が利用されます";
	$cstr22 = "プライバシーポリシーで使用する企業名の設定をします。";
	$cstr23 = "担当者氏名";
	$cstr24 = "担当者アドレス";
	$cstr25 = "部署名";
	$cstr26 = "連絡先1";
	$cstr27 = "連絡先2";
	$cstr28 = "担当者氏名2";
	$cstr29 = "担当者アドレス2";
	$cstr30 = "戻る";
	$cstr31 = "登録";

}


$css1 = "chg";
$title = "AMS:".$str;
$js = array("chg");
$map = true;
$drop = true;
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
				"検査結果一覧"
			),
			array(
				"",
				"受検者一覧"
			),
		);

if($basetype == 2){
	$pan = array(
			array(
				"/",
				"検査結果一覧"
			),
			array(
				"",
				"受検者一覧"
			),
		);
}
if($basetype == 3){
	$pan = array(

			array(
				"",
				$str1
			),
		);
}

include_once("include_title.php");
?>
	<div id="searchTitle"><?=$str?></div>
	<p><?=$cstr1?></p>
	<form action="/index/chg/" method="post" enctype="multipart/form-data">
	<table id="table">
		<tr>
			<th><?=$cstr2?></th>
			<td>
<?PHP
				if($_REQUEST[ 'name' ]){
					$name = $_REQUEST[ 'name' ];
				}
?>
				<?=$name?>
				<input type="hidden" name="name" value="<?=$name?>" >
			</td>
		</tr>
		<tr>
			<th><?=$cstr3?></th>
			<td>
<?PHP
				if($_REQUEST[ 'login_id' ]){
					$login_id = $_REQUEST[ 'login_id' ];
				}
?>
				<?=$login_id?>
				<input type="hidden" name="login_id" value="<?=$login_id?>" >
				<input type="hidden" name="idchk" id="idchk" value="<?=$_REQUEST[ 'idchk' ]?>">
			</td>
		</tr>
<?PHP
	if($basetype == 1 || $basetype == 3){
?>
		<tr>
			<th><?=$cstr4?></th>
			<td>
<?PHP
				if($_REQUEST[ 'login_pw' ]){
					$login_pw = $_REQUEST[ 'login_pw' ];
				}

?>
				<?=$login_pw?>
				<input type="hidden" name="login_pw" value="<?=$login_pw?>" >
			</td>
		</tr>

<?PHP
	}else{
		$login_pw = $data[ 'login_pw' ];
?>
		<input type="hidden" name="login_pw" value="<?=$login_pw?>" id="login_pw"  >
<?PHP
	}
?>

		<tr>
			<th ><?=$cstr6?></th>
			<td class="left">
<?PHP
				if($_REQUEST[ 'post1' ]){
					$post1 = $_REQUEST[ 'post1' ];
				}

				if($_REQUEST[ 'post2' ]){
					$post2 = $_REQUEST[ 'post2' ];
				}

				
?>
				<input type="hidden" name="post1" value="<?=$post1?>"  ><?=$post1?>-
				<input type="hidden" name="post2" value="<?=$post2?>"  ><?=$post2?>
			</td>
		</tr>
		<tr>
			<th ><?=$cstr7?></th>
			<td class="left">

<?PHP
				if($_REQUEST[ 'pref' ]){
					$prefecture = $_REQUEST[ 'pref' ];
				}
?>
				<?=$prefecture?>
				<input type="hidden" name="pref" value="<?=$prefecture?>" >
			</td>
		</tr>
		<tr>
			<th ><?=$cstr8?></th>
			<td class="left">
<?PHP
				if($_REQUEST[ 'address1' ]){
					$address1 = $_REQUEST[ 'address1' ];
				}

				if($_REQUEST[ 'address2' ]){
					$address2 = $_REQUEST[ 'address2' ];
				}
?>
				<?=$address1?>
				<input type="hidden" name="address1" value="<?=$address1?>" >
			</td>
		</tr>
		<tr>
			<th ><?=$cstr10?></th>
			<td class="left">
				<?=$address2?>
				<input type="hidden" name="address2" value="<?=$address2?>" >
			</td>
		</tr>

		<tr>
			<th><?=$cstr12?></th>
			<td>
<?PHP
				if($_REQUEST[ 'tel' ]){
					$tel = $_REQUEST[ 'tel' ];
				}
?>
				<?=$tel?>
				<input type="hidden" name="tel" value="<?=$tel?>" >
			</td>
		</tr>

		<tr>
			<th><?=$cstr12?></th>
			<td>
<?PHP
				if($_REQUEST[ 'fax' ]){
					$fax = $_REQUEST[ 'fax' ];
				}
?>
				<?=$fax?>
				<input type="hidden" name="fax" value="<?=$fax?>" size=25 >
			</td>
		</tr>

<?PHP

$adisp[1] = "表示する";
$adisp[0] = "表示しない";

$adisp1[1] = "利用する";
$adisp1[0] = "利用しない";
if($basetype != 3){
?>
                 <tr>
                    <th>受検者傾向確認機能</th>
                    <td>
                        <?php if($_REQUEST[ 'exam_pattern' ] == "1"){ ?>
                                利用する
                         <?php } ?>
                        <?php if($_REQUEST[ 'exam_pattern' ] == "0"){ ?>
                                利用しない
                        <?php } ?>
                        <input type="hidden" name="exam_pattern" value="<?=$_REQUEST[ 'exam_pattern' ]?>" />
                    </td>
                </tr>
		<tr>
			<th>CSVアップロードボタン</th>
			<td>
			<?=$adisp[$_REQUEST[ 'csvupload' ]]?>
			<input type="hidden" name="csvupload" value="<?=$_REQUEST[ 'csvupload' ]?>"  >
			</td>
		</tr>

	<tr>
		<th>PDFボタンの利用</th>
		<td>
			<?=$adisp1[$_REQUEST[ 'pdf_button' ]]?>
			<input type="hidden" name="pdf_button" value="<?=$_REQUEST[ 'pdf_button' ]?>" >
		</td>
	</tr>
<?PHP
}
?>

<?PHP
if($basetype == 1){

	$adisp[1] = "利用する";
	$adisp[0] = "利用しない";
?>
	<tr>
		<th>PDF重みマスタ</th>
		<td>
		<?=$adisp[$_REQUEST[ 'pdf_master_status' ]]?>
		<input type="hidden" name="pdf_master_status" value="<?=$_REQUEST[ 'pdf_master_status' ]?>"  >
		</td>
	</tr>
	<tr>
		<th>エクセル重みマスタ</th>
		<td>
			<?=$adisp[$_REQUEST[ 'excel_master_status' ]]?>
			<input type="hidden" name="excel_master_status" value="<?=$_REQUEST[ 'excel_master_status' ]?>" >
		</td>
	</tr>
	<tr>
			<th>顧客ファイルアップロード</th>
			<td>
				<?=$adisp[$_REQUEST[ 'customer_file_upload' ]]?>
				<input type="hidden" name="customer_file_upload" value="<?=$_REQUEST[ 'customer_file_upload' ]?>" >
			
			</td>
	</tr>
<?PHP
}
?>


	<tr>
		<th><?=$cstr14?></th>
		<td>
<?PHP
		if($_REQUEST[ 'logodel' ]){
?>
			<?=$cstr18?>
			<input type="hidden" name="logodel" value="on" >
<?PHP
		}else{
			if($_REQUEST[ 'pv' ]){
?>
				<div id="preview">
					<?=$prev?>
				</div>
				<input type="hidden" name="prev" value="<?=$prev?>">
				<input type="hidden" name="imgfilename" value="<?=$fname?>">
<?PHP
			}else{
?>
			<img src="<?=$logo?>" id="logoimg" >
<?PHP
			}
		}//logodel終わり
?>
		</td>
	</tr>

	<tr>
		<th>プライバシーポリシー</th>
		<td>
			<?php 
			$chk1="";
			$chk2="";
			if($data[ 'privacypolicy' ] == 1):
				$chk1 = "CHECKED";
			endif;
			if($data[ 'privacypolicy' ] == 2):
				$chk2 = "CHECKED";
			endif;
			?>
			<input type="hidden" name="privacypolicy" value="<?=$_REQUEST[ 'privacypolicy' ]?>" />
			<?php  if($_REQUEST[ 'privacypolicy' ] == 1): ?>
				デフォルト表示<br />
			<?php endif;?>
			<?php  if($_REQUEST[ 'privacypolicy' ] == 2): ?>
				編集する<hr />
				<?=nl2br($_REQUEST[ 'privacypolicy_text' ])?>

			<?php endif;?>
			<input type="hidden" name="privacypolicy_text" value="<?=$_REQUEST[ 'privacypolicy_text' ]?>" />

			<br />
		</td>
	</tr>

	</table>

	<table id="table2">
		<tr>
			<th><?=$cstr23?><span class="red">※</span></th>
			<td>
<?PHP
			if($_REQUEST[ 'rep_name' ]){
				$rep_name = $_REQUEST[ 'rep_name' ];
			}
?>
				<?=$rep_name?>
				<input type="hidden" name="rep_name" value="<?=$rep_name?>" >
			</td>
		</tr>
		<tr>
			<th><?=$cstr24?><span class="red">※</span></th>
			<td>
<?PHP
			if($_REQUEST[ 'rep_email' ]){
				$rep_email = $_REQUEST[ 'rep_email' ];
			}
?>
				<?=$rep_email?>
				<input type="hidden" name="rep_email" value="<?=$rep_email?>" >
			</td>
		</tr>
		<tr>
			<th><?=$cstr25?></th>
			<td>
<?PHP
			if($_REQUEST[ 'rep_busyo' ]){
				$rep_busyo = $_REQUEST[ 'rep_busyo' ];
			}
?>
				<?=$rep_busyo?>
				<input type="hidden" name="rep_busyo" value="<?=$rep_busyo?>" >
			</td>
		</tr>
		<tr>
			<th><?=$cstr26?></th>
			<td>
<?PHP
			if($_REQUEST[ 'rep_tel1' ]){
				$rep_tel1 = $_REQUEST[ 'rep_tel1' ];
			}
?>
				<?=$rep_tel1?>
				<input type="hidden" name="rep_tel1" value="<?=$rep_tel1?>" >
			</td>
		</tr>
		<tr>
			<th><?=$cstr27?></th>
			<td>
<?PHP
				if($_REQUEST[ 'rep_tel2' ]){
					$rep_tel2 = $_REQUEST[ 'rep_tel2' ];
				}
?>
				<?=$rep_tel2?>
				<input type="hidden" name="rep_tel2" value="<?=$rep_tel2?>" >
			</td>
		</tr>
		<tr>
			<th><?=$cstr28?></th>
			<td>
<?PHP
				if($_REQUEST[ 'rep_name2' ]){
					$rep_name2 = $_REQUEST[ 'rep_name2' ];
				}
?>
				<?=$rep_name2?>
				<input type="hidden" name="rep_name2" value="<?=$rep_name2?>" >
			</td>
		</tr>
		<tr>
			<th><?=$cstr29?></th>
			<td>
<?PHP
				if($_REQUEST[ 'rep_email2' ]){
					$rep_email2 = $_REQUEST[ 'rep_email2' ];
				}
?>
				<?=$rep_email2?>
				<input type="hidden" name="rep_email2" value="<?=$rep_email2?>" >
			</td>
		</tr>

		<input type="hidden" name="previewImgId" value="<?=$id."_".time()?>" id="previewImgId" >
		<input type="hidden" name="pv" value="<?=$_REQUEST[ 'pv' ]?>" id="pv">
	</table>
		
		<input type="submit" name="input" value="<?=$cstr30?>" class="button" id="input">
		<input type="submit" name="regist" value="<?=$cstr31?>"  class="button"   >
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
