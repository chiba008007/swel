<?PHP
$css1 = "newedit";
$title = "AMS:パートナー情報登録";
if($license){
	$js[1] = "bill";
}
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
<?PHP
			if($error){
?>
			<div id="success"><p>すでに登録済みのデータです。</p></div>
<?PHP
			}else{
?>
			<div id="success"><p>登録成功しました。</p></div>
<?PHP
			}
?>
			<table id="table">
				<tr>
					<th class="w200">企業名※</th>
					<td class="left">
						<?=$_REQUEST['name']?>
					</td>
				</tr>
				<tr>
					<th>ID※</th>
					<td class="left">
						<?=$_REQUEST['login_id']?>
					</td>
				</tr>
				<tr>
					<th >パスワード※</th>
					<td class="left"><?=$_REQUEST['login_pw']?>
					</td>
				</tr>
				<tr>
					<th >郵便番号</th>
					<td class="left">
						<?=$_REQUEST['post1']?>-<?=$_REQUEST['post2']?>
					</td>
				</tr>
				<tr>
					<th >都道府県</th>
					<td class="left">
						<?=$_REQUEST[ 'pref' ]?>
					</td>
				</tr>
				<tr>
					<th >住所１</th>
					<td class="left"><?=$_REQUEST['address1']?>
					</td>
				</tr>
				<tr>
					<th >住所２</th>
					<td class="left"><?=$_REQUEST['address2']?>
					</td>
				</tr>
				<tr>
					<th >電話番号</th>
					<td class="left"><?=$_REQUEST['tel']?>
					</td>
				</tr>

				<tr>
					<th >FAX番号</th>
					<td class="left"><?=$_REQUEST['fax']?>
					</td>
				</tr>
				<tr>
					<th >申込検査ボタン</th>
					<td class="left">
<?PHP
						$str = "利用しない";
						if($_REQUEST[ 'ptTestBtn' ]) $str = "利用する";
?>
						<?=$str?>
					</td>
				</tr>


			</table>
			
			<table id="table2">
				<tr>
					<th class="w200">担当者氏名※</th>
					<td class="left"><?=$_REQUEST['rep_name']?>
					</td>
				</tr>
				<tr>
					<th >担当者アドレス※</th>
					<td class="left"><?=$_REQUEST['rep_email']?>
					</td>
				</tr>

				<tr>
					<th class="w200">担当者氏名２</th>
					<td class="left"><?=$_REQUEST['rep_name2']?>
					</td>
				</tr>
				<tr>
					<th >担当者アドレス２</th>
					<td class="left"><?=$_REQUEST['rep_email2']?>
					</td>
				</tr>
				<tr>
					<th >担当者連絡先</th>
					<td class="left"><?=$_REQUEST['rep_tel']?>
					</td>
				</tr>
				<tr>
					<th >管理システム名</th>
					<td class="left"><?=$_REQUEST['logo_name']?>管理システム
					</td>
				</tr>
			</table>
			
<?PHP
			if($_REQUEST[ 'element_flg' ]){
?>
			<div id="element">

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
					<td><?=$el?></td>
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
?>
					<th><?=$v?></th>
					<td><input type="text" name="license_part[<?=$k?>]" value="<?=$_REQUEST['license_part'][$k]?>" readonly></td>
				
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
				<li><?=$val?></li>
<?PHP
					}
				}
			}
?>
			</ul>
			<br clear=all />
			<div class="center">

			</div>
		</div>
		</form>
	</div><!--contents-->

<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->
<form action="/index/bill/" method="POST" target=_blank name="billform">
<input type="hidden" name="uid" value="<?=$uid?>" >
</form>
<?PHP
include_once("include_footer.php");
?>
