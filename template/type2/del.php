<?PHP
$css1 = "del";
$title = "AMS:企業削除画面";
$js = array("del");
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
				"企業情報削除"
			)
			
		);

include_once("include_title.php");
?>
	<div id="searchTitle">企業情報削除</div>
	<p class="p">下記情報の削除を行います。</p>
	<form action="/index/del/<?=$sec?>/" method="post" name="form">
	<table id="table">
		<tr>
			<th>企業名<span class="red">※</span></th>
			<td><?=$user[ 'name' ]?></td>
		</tr>
		<tr>
			<th>ログインID</th>
			<td><?=$user[ 'login_id' ]?></td>
		</tr>
		<tr>
			<th>パスワード</th>
			<td><?=$user[ 'login_pw' ]?></td>
		</tr>
		<tr>
			<th >郵便番号</th>
			<td class="left"><?=$user[ 'post1' ]?>-<?=$user[ 'post2' ]?></td>
		</tr>
		<tr>
			<th >都道府県</th>
			<td class="left"><?=$user[ 'prefecture' ]?></td>
		</tr>
		<tr>
			<th >住所１</th>
			<td class="left"><?=$user[ 'address1' ]?></td>
		</tr>
		<tr>
			<th >住所２</th>
			<td class="left"><?=$user[ 'address2' ]?></td>
		</tr>

		<tr>
			<th>電話番号</th>
			<td><?=$user[ 'tel' ]?></td>
		</tr>

		<tr>
			<th>FAX番号</th>
			<td><?=$user[ 'fax' ]?></td>
		</tr>
	</table>

	<table id="table2">
		<tr>
			<th>担当者氏名</th>
			<td><?=$user[ 'rep_name' ]?></td>
		</tr>
		<tr>
			<th>担当者アドレス</th>
			<td><?=$user[ 'rep_email' ]?></td>
		</tr>
		<tr>
			<th>部署名</th>
			<td><?=$user[ 'rep_busyo' ]?></td>
		</tr>
		<tr>
			<th>連絡先1</th>
			<td><?=$user[ 'rep_tel1' ]?></td>
		</tr>
		<tr>
			<th>連絡先2</th>
			<td><?=$user[ 'rep_tel2' ]?></td>
		</tr>
		<tr>
			<th>担当者氏名2</th>
			<td><?=$user[ 'rep_name2' ]?></td>
		</tr>
		<tr>
			<th>担当者アドレス2</th>
			<td><?=$user[ 'rep_email2' ]?></td>
		</tr>
	</table>
		
		<input type="button" name="back" value="戻る" class="button" id="back">
		<input type="submit" name="delete" value="削除する"  class="button"  id="delete" >
		<input type="hidden" name="delete" value="on">
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
