<?PHP
$css1 = "newedit";
$title = "AMS:パートナー情報登録";
$js[1] = "newedit";
$map = true;
include_once("include_header.php");
$pan[1] = array("","パートナー情報登録");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<form action="/index/new/" method="post">
		<div id="rightBases">
		<h2>パートナー情報新規画面</h2>
			<p>※は必須項目です。</p>
			<table id="table">
				<tr>
					<th class="w200">企業名※</th>
					<td class="left">
						<?=$_REQUEST['name']?>
						<input type="hidden" name="name" value="<?=$_REQUEST['name']?>" >
					</td>
				</tr>
				<tr>
					<th  class="w200">ID※</th>
					<td class="left">
						<?=$_REQUEST['login_id']?>
						<input type="hidden" name="login_id" value="<?=$_REQUEST['login_id']?>" >
					</td>
				</tr>
				<tr>
					<th  class="w200">パスワード※</th>
					<td class="left"><?=$_REQUEST['login_pw']?>
						<input type="hidden" name="login_pw" value="<?=$_REQUEST['login_pw']?>" >
					</td>
				</tr>
				<tr>
					<th class="w200" >郵便番号</th>
					<td class="left">
						<?=$_REQUEST['post1']?>-<?=$_REQUEST['post2']?>
						<input type="hidden" name="post1" value="<?=$_REQUEST['post1']?>"  >
						<input type="hidden" name="post2" value="<?=$_REQUEST['post2']?>" >
					</td>
				</tr>
				<tr>
					<th class="w200" >都道府県</th>
					<td class="left">
						<?=$_REQUEST[ 'pref' ]?>
						<input type="hidden" name="pref" value="<?=$_REQUEST[ 'pref' ]?>">
					</td>
				</tr>
				<tr>
					<th class="w200" >住所１</th>
					<td class="left"><?=$_REQUEST['address1']?>
						<input type="hidden" name="address1" value="<?=$_REQUEST['address1']?>" >
					</td>
				</tr>
				<tr>
					<th class="w200" >住所２</th>
					<td class="left"><?=$_REQUEST['address2']?>
						<input type="hidden" name="address2" value="<?=$_REQUEST['address2']?>" >
					</td>
				</tr>
				<tr>
					<th class="w200" >電話番号</th>
					<td class="left"><?=$_REQUEST['tel']?>
						<input type="hidden" name="tel" value="<?=$_REQUEST['tel']?>" >
					</td>
				</tr>

				<tr>
					<th class="w200" >FAX番号</th>
					<td class="left"><?=$_REQUEST['fax']?>
						<input type="hidden" name="fax" value="<?=$_REQUEST['fax']?>" >
					</td>
				</tr>

				<tr>
					<th >申込検査ボタン</th>
					<td class="left">
<?PHP
						$str = "利用しない";
						if($_REQUEST[ 'ptTestBtn' ]) $str = "利用する";
						$ptTestBtn = sprintf("%d",$_REQUEST[ 'ptTestBtn' ]);
?>
						<input type="hidden" name="ptTestBtn" value="<?=$ptTestBtn?>" ><?=$str?>
					</td>
				</tr>

			</table>
			
			<table id="table2">
				<tr>
					<th class="w200">担当者氏名※</th>
					<td class="left"><?=$_REQUEST['rep_name']?>
						<input type="hidden" name="rep_name" value="<?=$_REQUEST['rep_name']?>" >
					</td>
				</tr>
				<tr>
					<th >担当者アドレス※</th>
					<td class="left"><?=$_REQUEST['rep_email']?>
						<input type="hidden" name="rep_email" value="<?=$_REQUEST['rep_email']?>" >
					</td>
				</tr>

				<tr>
					<th class="w200">担当者氏名２</th>
					<td class="left"><?=$_REQUEST['rep_name2']?>
						<input type="hidden" name="rep_name2" value="<?=$_REQUEST['rep_name2']?>" >
						
					</td>
				</tr>
				<tr>
					<th >担当者アドレス２</th>
					<td class="left"><?=$_REQUEST['rep_email2']?>
						<input type="hidden" name="rep_email2" value="<?=$_REQUEST['rep_email2']?>" >
					</td>
				</tr>
				<tr>
					<th >担当者連絡先</th>
					<td class="left"><?=$_REQUEST['rep_tel']?>
						<input type="hidden" name="rep_tel" value="<?=$_REQUEST['rep_tel']?>"  >
					</td>
				</tr>
				<tr>
					<th >管理システム名</th>
					<td class="left"><?=$_REQUEST['logo_name']?>
						<input type="hidden" name="logo_name" value="<?=$_REQUEST['logo_name']?>"  >管理システム
					</td>
				</tr>
			</table>
			
<?PHP
			if($_REQUEST[ 'element_flg' ]){
?>
			<div id="element">

			<input type="hidden" name="element_flg" value="on"  >
			行動価値用要素名設定 ※行動価値エクセルダウンロードで利用する要素名を変更する際に利用します。
			</div>
			<div id="elementDiv" >
			<table id="elementTable" >
<?PHP
			foreach($a_element as $key=>$val){
				if($_REQUEST[$key]){
					$el = $_REQUEST[$key];
				}else{
					$el = $val;
				}
?>
				<tr>
					<th class="w200"><?=$val?></th>
					<td><?=$el?><input type="hidden" name="<?=$key?>" value="<?=$el?>"></td>
				</tr>
<?PHP
			}
?>
			</table>
			</div>

<?PHP
			}
?>
			
			<h3>■ライセンス登録数</h3>
<?PHP
			$i=1;
			foreach($a_test_type as $key=>$val){
?>
			<div id="<?=$key?>" class="c">
			<table class="element_cnt" >
				<tr>

<?PHP
				foreach($val as $k=>$v){
					$vl = sprintf("%d",$_REQUEST['license_part'][$k]);
?>
					<th><?=$v?></th>
					<td><input type="text" name="license_part[<?=$k?>]" value="<?=$vl?>" readonly class="g"></td>
				
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
			
			<h3>■会員自動登録の際に出力されるＰＤＦ</h3>
			<ul id="pdfUl">
<?PHP
			foreach($array_pdf as $key=>$val){
				$chk = "";
				if(count($_REQUEST[ 'pdf' ])){
					if($_REQUEST[ 'pdf' ][$key]){
						
?>
				<li><input type="hidden" name="pdf[<?=$key?>]" id="pdf<?=$key?>" value="on"><?=$val?></li>
<?PHP
					}
				}
			}
?>
			</ul>
			<br clear=all />
			<div class="leftbutton"><input type="submit" name="chgBack" value="戻る" class="button"  ></div>
			<div class="leftbutton"><input type="submit" name="chgReg" value="登録する" class="button" ></div>
		</div>
		</form>
	</div><!--contents-->
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->

<?PHP
include_once("include_footer.php");
?>
