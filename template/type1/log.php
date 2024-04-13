<?PHP
$css1 = "list";
$title = "AMS:パートナー情報一覧画面";
$js = array("list");
include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<br clear=all />
		<div >
			<a href="/index/log/" style="border:1px solid #ccc; padding:5px;color:#fff;background-color:blue;text-decoration:none">管理者</a>
			<a href="/index/log2/">受検者</a>
		</div>
		<br />
		<br />
		<div id="leftBases">
			<?php if($p > 0 ):?>
			<a href="./?p=<?=$p-1?>">前のページ</a>
			<?php endif; ?>
			<?php if($ceil > $p ):?>
			<a href="./?p=<?=$p+1?>">次のページ</a>
			<?php endif; ?>

		</div>
		<br clear=all />

		<div id="rightBases">
			<table id="table">
				<tr>
					<th width=100>アクセス日時</th>
					<th width=100>IPアドレス</th>
					<th style="width:180px;">ブラウザ名（Ver）</th>
					<th >プラットフォーム</th>
					<th width=40>ID</th>
					<th width=40>PASSWORD</th>
				</tr>
			<?php foreach($admin as $key=>$value): ?>
				<tr>
					<td style="text-align:left;"><?=$value[ 'accessdate' ]?></td>
					<td style="text-align:left;"><?=$value[ 'ip' ]?></td>
					<td style="text-align:left;word-break: break-all;"><?=$value[ 'brauze' ]?></td>
					<td style="text-align:left;word-break: break-all;"><?=$value[ 'platform' ]?></td>
					<td style="text-align:left;"><?=$value[ 'input_id' ]?></td>
					<td style="text-align:left;"><?=$value[ 'input_password' ]?></td>
				</tr>
			<?php endforeach; ?>
			</table>
		</div>
		
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
