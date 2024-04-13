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
$post1 = $_REQUEST[ 'post1' ];

$post2 = $_REQUEST[ 'post2' ];

$address1 = $_REQUEST[ 'address1' ];

$address2 = $_REQUEST[ 'address2' ];

$tel = $_REQUEST[ 'tel' ];

$fax = $_REQUEST[ 'fax' ];


?>
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
						<?=$login_pw?>
						<input type="hidden" name="login_pw"  value="<?=$login_pw?>" ><br />
					</td>
				</tr>
				<tr>
					<th  >郵便番号</th>
					<td >
						<input type="hidden" name="post1" value="<?=$post1?>" ><?=$post1?>-
						<input type="hidden" name="post2" value="<?=$post2?>"  ><?=$post2?>
					</td>
				</tr>
				<tr>
					<th >都道府県</th>
					<td class="left">
						<?=$_REQUEST[ 'pref' ]?>
						<input type="hidden" name="pref" value="<?=$_REQUEST[ 'pref' ]?>">
					</td>
				</tr>
				<tr>
					<th >住所１</th>
					<td ><?=$address1?>
						<input type="hidden" name="address1" value="<?=$address1?>" >
					</td>
				</tr>
				<tr>
					<th >住所２</th>
					<td ><?=$address2?>
						<input type="hidden" name="address2" value="<?=$address2?>" >
					</td>
				</tr>
				<tr>
					<th>電話番号</th>
					<td><?=$tel?>
						<input type="hidden" name="tel" value="<?=$tel?>"  >
					</td>
				</tr>
				<tr>
					<th>FAX番号</th>
					<td><?=$fax?>
						<input type="hidden" name="fax" value="<?=$fax?>"  >
					</td>
				</tr>
			</table>
<?PHP
			$rep_name   = $_REQUEST[ 'rep_name'   ];
			$rep_email  = $_REQUEST[ 'rep_email'  ];
			$rep_name2  = $_REQUEST[ 'rep_name2'  ];
			$rep_email2 = $_REQUEST[ 'rep_email2' ];
			$rep_tel1   = $_REQUEST[ 'rep_tel1'   ];
			$logo_name  = $_REQUEST[ 'logo_name'  ];
?>
			<table id="table2">
				<tr>
					<th>担当者氏名<span class="err">※</span></th>
					<td>
						<?=$rep_name?>
						<input type="hidden" name="rep_name" value="<?=$rep_name?>" >
					</td>
				</tr>
				<tr>
					<th>担当者アドレス<span class="err">※</span></th>
					<td>
						<?=$rep_email?>
						<input type="hidden" name="rep_email" value="<?=$rep_email?>" >
					</td>
				</tr>

				<tr>
					<th>担当者氏名2</th>
					<td>
						<?=$rep_name2?>
						<input type="hidden" name="rep_name2" value="<?=$rep_name2?>" >
					</td>
				</tr>
				<tr>
					<th>担当者アドレス2</th>
					<td>
						<?=$rep_email2?>
						<input type="hidden" name="rep_email2" value="<?=$rep_email2?>" >
					</td>
				</tr>
				<tr>
					<th>担当者連絡先</th>
					<td>
						<?=$rep_tel1?>
						<input type="hidden" name="rep_tel1" value="<?=$rep_tel1?>" >
					</td>
				</tr>
				<tr>
					<th>管理システム名</th>
					<td>
						<?=$logo_name?>
						<input type="hidden" name="logo_name" value="<?=$logo_name?>" >管理システム
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
				<input type="submit" name="back" value="戻る"  class="button" >
				<input type="submit" name="regist" value="登録する" id="regist" class="button" >

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

