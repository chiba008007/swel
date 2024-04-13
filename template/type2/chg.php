<?PHP
$css1 = "ptnChg";
$title = "AMS:パートナー情報更新画面";
$ptitle = "パートナー情報更新画面";
$map = true;
$js = array("ptnChg");

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
				"パートナー企業情報変更"
			),
		);
if($basetype == 2){
	$pan = array(
			array(
				"",
				"パートナー企業情報変更"
			),
		);
	
}
include_once("include_title.php");

if($_REQUEST[ 'login_pw' ]){
	$login_pw = $_REQUEST[ 'login_pw' ];
}else{
	$login_pw = $user[0][ 'login_pw' ];
}

if($_REQUEST[ 'post1' ]){
	$post1 = $_REQUEST[ 'post1' ];
}else{
	$post1 = $user[0][ 'post1' ];
}
if($_REQUEST[ 'post2' ]){
	$post2 = $_REQUEST[ 'post2' ];
}else{
	$post2 = $user[0][ 'post2' ];
}
if($_REQUEST[ 'address1' ]){
	$address1 = $_REQUEST[ 'address1' ];
}else{
	$address1 = $user[0][ 'address1' ];
}

if($_REQUEST[ 'address2' ]){
	$address2 = $_REQUEST[ 'address2' ];
}else{
	$address2 = $user[0][ 'address2' ];
}

if($_REQUEST[ 'tel' ]){
	$tel = $_REQUEST[ 'tel' ];
}else{
	$tel = $user[0][ 'tel' ];
}

if($_REQUEST[ 'fax' ]){
	$fax = $_REQUEST[ 'fax' ];
}else{
	$fax = $user[0][ 'fax' ];
}


?>

<script type="text/javascript">
	$(function(){
		$("#confbutton").click(function(){
			let pwd = $("[name='login_pw']").val();
			if(pwd.length < 8 ){
				alert("パスワードは8文字以上で入力してください。");
				return false;
			}
			if(pwd.length > 15 ){
				alert("パスワードは15文字以下で入力してください。");
				return false;
			}
			if (!pwd.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,15}$/)) {
				alert("パスワードには英大文字・英小文字・数字それぞれを最低1文字ずつ含む必要があります。");
				return false;
			}
			return true;
		});
	});
</script>

		<p><span class="err">※</span>は必須項目です。</p>
			<form action="/index/chg/" method="POST">
			<table id="table">
				<tr>
					<th >企業名</th>
					<td ><?=$user[0][ 'name' ]?></td>
				</tr>
				<tr>
					<th >ID</th>
					<td ><?=$user[0][ 'login_id' ]?></td>
				</tr>
				<tr>
					<th  >PW</th>
					<td >
						<input type="text" name="login_pw"  value="<?=$login_pw?>" class="w200"  id="login_pw" ><br />
						<p style="font-size:13px;">パスワードの長さは、半角8文字以上、半角15文字以下です。​<br/>
							パスワードに使用できる文字は、半角英数すべてです。​​<br />
							パスワードには英大文字・英小文字・数字それぞれを最低1文字ずつ含む必要があります。​
						</p>
					</td>
				</tr>
				<tr>
					<th  >郵便番号</th>
					<td >
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
							if($val == $_REQUEST[ 'pref' ]){
								$sel = "SELECTED";
							}else{
								if($val == $user[0][ 'prefecture' ]){
									$sel = "SELECTED";
								}
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
					<td >
						<input type="text" name="address1" value="<?=$address1?>" class="w400" id="address1">
					</td>
				</tr>
				<tr>
					<th >住所２</th>
					<td >
						<input type="text" name="address2" value="<?=$address2?>" class="w400" id="address2">
					</td>
				</tr>
				<tr>
					<th>電話番号</th>
					<td>
						<input type="text" name="tel" value="<?=$tel?>"  > 例） 03-1234-5678
					</td>
				</tr>
				<tr>
					<th>FAX番号</th>
					<td>
						<input type="text" name="fax" value="<?=$fax?>"  > 例） 03-1234-5678
					</td>
				</tr>
			</table>
<?PHP
			$rep_name = $user[0][ 'rep_name' ];
			if($_REQUEST[ 'rep_name' ]){
				$rep_name = $_REQUEST[ 'rep_name' ];
			}

			$rep_email = $user[0][ 'rep_email' ];
			if($_REQUEST[ 'rep_email' ]){
				$rep_email = $_REQUEST[ 'rep_email' ];
			}

			$rep_name2 = $user[0][ 'rep_name2' ];
			if($_REQUEST[ 'rep_name2' ]){
				$rep_name2 = $_REQUEST[ 'rep_name2' ];
			}

			$rep_email2 = $user[0][ 'rep_email2' ];
			if($_REQUEST[ 'rep_email2' ]){
				$rep_email2 = $_REQUEST[ 'rep_email2' ];
			}


			$rep_tel1 = $user[0][ 'rep_tel1' ];
			if($_REQUEST[ 'rep_tel1' ]){
				$rep_tel1 = $_REQUEST[ 'rep_tel1' ];
			}

			$logo_name = $user[0][ 'logo_name' ];
			if($_REQUEST[ 'logo_name' ]){
				$logo_name = $_REQUEST[ 'logo_name' ];
			}

?>
			<table id="table2">
				<tr>
					<th>担当者氏名<span class="err">※</span></th>
					<td><input type="text" name="rep_name" value="<?=$rep_name?>" id="rep_name" class="w300">
						<span class="explain">※ 氏名の間に空白を入力してください。例） 鈴木　太郎 </span>
					</td>
				</tr>
				<tr>
					<th>担当者アドレス<span class="err">※</span></th>
					<td><input type="text" name="rep_email" value="<?=$rep_email?>" id="rep_email" class="w300">
					</td>
				</tr>

				<tr>
					<th>担当者氏名2</th>
					<td><input type="text" name="rep_name2" value="<?=$rep_name2?>" id="rep_name2" class="w300">
						<span class="explain">※ 氏名の間に空白を入力してください。例） 鈴木　太郎 </span>
					</td>
				</tr>
				<tr>
					<th>担当者アドレス2</th>
					<td><input type="text" name="rep_email2" value="<?=$rep_email2?>" id="rep_email2" class="w300">
					</td>
				</tr>
				<tr>
					<th>担当者連絡先</th>
					<td><input type="text" name="rep_tel1" value="<?=$rep_tel1?>" id="rep_tel1">
					</td>
				</tr>
				<tr>
					<th>管理システム名</th>
					<td><input type="text" name="logo_name" value="<?=$logo_name?>" id="logo_name">管理システム
						<span class="explain">※ 管理者システム名になります。</span>
					</td>
				</tr>
			</table>

			<table id="table3">
				<tr>
					<th>行動価値用要素名<br /><span class="explain">※行動価値エクセルダウンロードで利用する要素名になります。</span></th>
				</tr>
<?PHP
				foreach($a_element2 as $key=>$val){
?>
				<tr>
					<td><?=$val?></td>
				</tr>
<?PHP
				}
?>
			</table>
			<div id="buttonbox">
				<input type="button" name="back" value="戻る" id="back" class="button" >
				<input type="submit" name="conf" value="確認する" id="confbutton" class="button"  >

			</div>
			</form>
			<br clear=all />
	</div>


<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>

