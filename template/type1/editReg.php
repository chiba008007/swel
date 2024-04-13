<?PHP
$css1 = "newedit";
$title = "AMS:パートナー情報更新";
//追加がなければ
//請求書を出さない
$billFlg = 0;
foreach($_REQUEST[ 'testType' ] as $key=>$val){
	if($val > 0){
		$billFlg += 1;
	}
}
if($billFlg){
	$js[1] = "bill";
}
$map = true;
include_once("include_header.php");
$pan[1] = array("","パートナー情報更新");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<form action="/index/edit/<?=$sec?>/" method="post">
		<div id="rightBases">
		<h2>パートナー情報更新画面</h2>
<?PHP
			if($error){
?>
			<div id="success"><p>すでに登録済みのデータです。</p></div>
<?PHP
			}else{
?>
			<div id="success"><p>更新成功しました。</p></div>
<?PHP
			}
?>
			<table id="table">
				<tr>
					<th class="w200">企業名※</th>
					<td class="left"><?=$name?>
						<input type="hidden" name="name" value="<?=$name?>" >
					</td>
				</tr>
				<tr>
					<th>ID※</th>
					<td class="left"><?=$login_id?>
						<input type="hidden" name="login_id" value="<?=$login_id?>">	
					</td>
				</tr>
				<tr>
					<th >パスワード※</th>
					<td class="left"><?=$login_pw?>
						<input type="hidden" name="login_pw" value="<?=$login_pw?>" >
					</td>
				</tr>
				<tr>
					<th >郵便番号</th>
					<td class="left"><?=$post1?>-<?=$post2?>
						<input type="hidden" name="post1" value="<?=$post1?>"  >
						<input type="hidden" name="post2" value="<?=$post2?>"  >
					</td>
				</tr>
				<tr>
					<th >都道府県</th>
					<td class="left"><?=$pref?>
						<input type="hidden" name="pref" value="<?=$pref?>">
					</td>
				</tr>
				<tr>
					<th >住所１</th>
					<td class="left"><?=$address1?>
						<input type="hidden" name="address1" value="<?=$address1?>">
					</td>
				</tr>
				<tr>
					<th >住所２</th>
					<td class="left"><?=$address2?>
						<input type="hidden" name="address2" value="<?=$address2?>">
					</td>
				</tr>
				<tr>
					<th >電話番号</th>
					<td class="left"><?=$tel?>
						<input type="hidden" name="tel" value="<?=$tel?>" >
					</td>
				</tr>

				<tr>
					<th >FAX番号</th>
					<td class="left"><?=$fax?>
						<input type="hidden" name="fax" value="<?=$fax?>" >
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
					<td class="left"><?=$rep_name?>
						<input type="hidden" name="rep_name" value="<?=$rep_name?>" >
					</td>
				</tr>
				<tr>
					<th >担当者アドレス※</th>
					<td class="left"><?=$rep_email?>
						<input type="hidden" name="rep_email" value="<?=$rep_email?>" >
					</td>
				</tr>

				<tr>
					<th class="w200">担当者氏名２</th>
					<td class="left"><?=$rep_name2?>
						<input type="hidden" name="rep_name2" value="<?=$rep_name2?>">
						
					</td>
				</tr>
				<tr>
					<th >担当者アドレス２</th>
					<td class="left"><?=$rep_email2?>
						<input type="hidden" name="rep_email2" value="<?=$rep_email2?>" >
					</td>
				</tr>
				<tr>
					<th >担当者連絡先</th>
					<td class="left"><?=$rep_tel?>
						<input type="hidden" name="rep_tel" value="<?=$rep_tel?>" >
					</td>
				</tr>
				<tr>
					<th >管理システム名</th>
					<td class="left"><?=$logo_name?>
						<input type="hidden" name="logo_name" value="<?=$logo_name?>" >管理システム
					</td>
				</tr>
			</table>
			
<?PHP
			$chk = "";
			if($_REQUEST['element_flg']){
?>
			<div id="element">

				<input type="hidden" name="element_flg" value="on" id="element_flg"  >
				<label for="element_flg">
					行動価値用要素名設定 ※行動価値エクセルダウンロードで利用する要素名を変更する際に利用します。
				</label>
			</div>
			<div id="elementDiv" >
			<table id="elementTable" >
<?PHP
			foreach($a_element as $key=>$val){
				if($_REQUEST[$key]){
					$el = $_REQUEST[$key];
				}else{
					$el = $partner[$key];
				}
?>
			<tr>
				<th class="w200"><?=$val?></th>
				<td><?=$el?><input type="hidden" name="<?=$key?>" value="<?=$el?>" ></td>
			</tr>
<?PHP
			}
			
?>
			</table>
			</div>
<?PHP
			}else{
?>
			<input type="hidden" name="element_flg" value="0"   >

<?PHP
			}
?>
			

			<h3>■ライセンスを登録する検査種類の表示名を選択してください。</h3>
			
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
					<td><input type="text" name="license_part[<?=$k?>]" value="<?=$license_part[$k]?>" readonly class="g"></td>
				
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
				if(isset($_REQUEST[ 'pdf' ])  && count($_REQUEST[ 'pdf' ])){
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
			<div class="center">
			</div>
		</div>
		</form>
	</div><!--contents-->

<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->

<form action="/index/bill/edits" method="POST" target=_blank name="billform">
<input type="hidden" name="uid" value="<?=$sec?>" >
<?PHP
foreach($_REQUEST[ 'testType' ] as $key=>$val){
	if($_REQUEST[ 'calc' ][$key] == "+"){
?>
	<input type="hidden" name="type[<?=$key?>]" value="<?=$val?>">
<?PHP
	}
}
?>

<?PHP
foreach($array_pdf as $key=>$val){
	$chk = "";
	if(isset($_REQUEST[ 'pdf' ]) && count($_REQUEST[ 'pdf' ])){
		if($_REQUEST[ 'pdf' ][$key]){
						
?>
			<input type="hidden" name="pdf[<?=$key?>]" value="on">
<?PHP
		}
	}
}
?>


</form>

<?PHP
include_once("include_footer.php");
?>
