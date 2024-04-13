<?PHP
$css1 = "newedit";
$title = "AMS:パートナー情報更新";
$js[1] = "newedit";
$map = true;
include_once("include_header.php");
$pan[1] = array("","パートナー情報更新");

$plus[1] = "+";
$plus[2] = "-";
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<form action="/index/edit/<?=$sec?>/" method="post">
		<div id="rightBases">
		<h2>パートナー情報更新画面</h2>
			<p>※は必須項目です。</p>
			<table id="table">
				<tr>
					<th class="w200">企業名※</th>
					<td class="left">
						<input type="text" name="name" value="<?=$name?>" class="w400" id="name">
					</td>
				</tr>
				<tr>
					<th>ID※</th>
					<td class="left"><?=$login_id?>
					</td>
				</tr>
				<tr>
					<th >パスワード※</th>
					<td class="left">
						<input type="text" name="login_pw" value="<?=$login_pw?>"  id="login_pw">
						<p style="font-size:13px;">パスワードの長さは、半角8文字以上、半角15文字以下です。​<br/>
							パスワードに使用できる文字は、半角英数すべてです。​​<br />
							パスワードには英大文字・英小文字・数字それぞれを最低1文字ずつ含む必要があります。​
						</p>
					</td>
				</tr>
				<tr>
					<th >郵便番号</th>
					<td class="left">
						<input type="text" name="post1" value="<?=$post1?>"  id="post1" class="w30" maxlength="3">-
						<input type="text" name="post2" value="<?=$post2?>"  id="post2" class="w40" maxlength="4" onKeyUp="AjaxZip3.zip2addr('post1','post2','pref','address1','address2');">
					</td>
				</tr>
				<tr>
					<th >都道府県</th>
					<td class="left">
						<select name="pref">
						<option name="">-</option>
<?PHP
						foreach($array_pref as $key=>$val){
							$sel = "";
							if($val == $pref){
								$sel = "SELECTED";
							}
?>
							<option value="<?=$val?>" <?=$sel?>><?=$val?></option>
<?PHP
						}
?>
						</select>
					</td>
				</tr>
				<tr>
					<th >住所１</th>
					<td class="left">
						<input type="text" name="address1" value="<?=$address1?>" class="w400" id="address1">
					</td>
				</tr>
				<tr>
					<th >住所２</th>
					<td class="left">
						<input type="text" name="address2" value="<?=$address2?>" class="w400" id="address2">
					</td>
				</tr>
				<tr>
					<th >電話番号</th>
					<td class="left">
						<input type="text" name="tel" value="<?=$tel?>" id="tel">例） 03-1234-5678
					</td>
				</tr>

				<tr>
					<th >FAX番号</th>
					<td class="left">
						<input type="text" name="fax" value="<?=$fax?>"  id="fax">例） 03-1234-5678
					</td>
				</tr>

				<tr>
					<th >申込検査ボタン</th>
					<td class="left">
<?PHP
						$chk = "";
						if($ptTestBtn) $chk = "CHECKED";
?>
						<input type="checkbox" name="ptTestBtn" value="1"  <?=$chk?>  >利用する
					</td>
				</tr>


			</table>
			
			<table id="table2">
				<tr>
					<th class="w200">担当者氏名※</th>
					<td class="left">
						<input type="text" name="rep_name" value="<?=$rep_name?>"  id="rep_name">
						※ 氏名の間に空白を入力してください。例） 鈴木　太郎
					</td>
				</tr>
				<tr>
					<th >担当者アドレス※</th>
					<td class="left">
						<input type="text" name="rep_email" value="<?=$rep_email?>" class="w400" id="rep_email">
					</td>
				</tr>

				<tr>
					<th class="w200">担当者氏名２</th>
					<td class="left">
						<input type="text" name="rep_name2" value="<?=$rep_name2?>"  id="rep_name2">
						
					</td>
				</tr>
				<tr>
					<th >担当者アドレス２</th>
					<td class="left">
						<input type="text" name="rep_email2" value="<?=$rep_email2?>" class="w400" id="rep_email2">
					</td>
				</tr>
				<tr>
					<th >担当者連絡先</th>
					<td class="left">
						<input type="text" name="rep_tel" value="<?=$rep_tel?>"  id="rep_tel">例） 03-1234-5678
					</td>
				</tr>
				<tr>
					<th >管理システム名</th>
					<td class="left">
						<input type="text" name="logo_name" value="<?=$logo_name?>"  id="rep_tel">管理システム
					</td>
				</tr>
			</table>
			
			<div id="element">
<?PHP
				$chk = "";
				$disp = "disp";
				if($element_flg){
					$chk = "CHECKED";
					$disp = "";
				}
?>
				<input type="checkbox" name="element_flg" value="on" id="element_flg" <?=$chk?> >
				<label for="element_flg">
					行動価値用要素名設定 ※行動価値エクセルダウンロードで利用する要素名を変更する際に利用します。
				</label>
			</div>
			<div id="elementDiv" class="<?=$disp?>">
			<table id="elementTable" >
<?PHP
			foreach($a_element as $key=>$val){
				if($_REQUEST[$key]){
					$el = $_REQUEST[$key];
				}else{
					$el = $array_elm[$key];
					$el = $partner[$el];
				}
?>
			<tr>
				<th><?=$val?></th>
				<td><input type="text" name="<?=$key?>" value="<?=$el?>" class="w400"  id="elem_<?=$key?>">
					&nbsp;<input type="button" class="elembutton" value="初期状態" id="el_<?=$key?>"></td>
			</tr>
<?PHP
			}
?>
			</table>
			</div>
			
			<h3>■ライセンスを登録する検査種類の表示名を選択してください。</h3>
			<ul id="ulLS">
<?PHP

			foreach($a_test_type as $key=>$val){
?>
				<li><a href="javascript:void(0);" class="elem_cnt" id="<?=$key?>"><?=$key?></a></li>
<?PHP
}
?>
			</ul>
			
<?PHP
			$i=1;
			foreach($a_test_type as $key=>$val){
			$disp = "disp";
			if($i == 1){$disp = "";}
?>
			<div id="<?=$key?>" class="<?=$disp?> c">
			<table class="element_cnt" >
				<tr>

<?PHP
				foreach($val as $k=>$v){
?>
					<th><?=$v?></th>
					<td><?=number_format($license_part[$k])?>
						<input type="hidden" name="license_part[<?=$k?>]" value="<?=$license_part[$k]?>" >
						<input type="hidden" name="license_edit_part[<?=$k?>]" value="<?=$license_edit_part[$k]?>" >
						<select name="calc[<?=$k?>]" id="calc<?=$k?>">
<?PHP
							foreach($plus as $pkey=>$pval){
								if($_REQUEST[ 'calc' ][ $k ] == $pval){
									$sel = "SELECTED";
								}else{
									$sel = "";
								}
?>
							<option value="<?=$pval?>" <?=$sel?> ><?=$pval?></option>
<?PHP
							}
?>
						</select>
						<input type="text" name="testType[<?=$k?>]" value="<?=$_REQUEST['testType'][$k]?>"  id="tplus<?=$k?>" class="w60">
					</td>
				
<?PHP
				}
?>
				</tr>
			</table>
			</div>
<?PHP
			$i++;
			}
?>
			
			<h3>■会員自動登録の際に出力されるＰＤＦを選択してください。</h3>
			<ul id="pdfUl">
<?PHP
			foreach($array_pdf as $key=>$val){
				$chk = "";
				if(isset($_REQUEST[ 'pdf' ]) && count($_REQUEST[ 'pdf' ])){
					if($_REQUEST[ 'pdf' ][$key]){
						$chk = "CHECKED";
					}
				}else{
					if($outputPdf[$key]){
						$chk = "CHECKED";
					}
				}
?>
				<li><input type="checkbox" name="pdf[<?=$key?>]" id="pdf<?=$key?>" value="on" <?=$chk?>><label for="pdf<?=$key?>"><?=$val?></label></li>
				
<?PHP
			}
?>
			</ul>
			<br clear=all />
			<div class="center">
			<input type="submit" name="chgConf" value="確認画面" class="button" id="chgConf">
			</div>
		</div>
		<input type="hidden" name="editFlg" value="on" id="editFlg">
		<input type="hidden"  value="<?=$login_id?>" id="login_id_reg">
		<input type="hidden"  value="<?=$login_id?>" id="login_id">
		</form>

<?PHP
	//初期表示用hidden
	foreach($a_element as $key=>$val){
?>
	<input type="hidden" id="hidelem_<?=$key?>" value="<?=$val?>">
<?PHP
	}
?>

	</div><!--contents-->
<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->

<?PHP
include_once("include_footer.php");
?>
