<?php
$css1 = "list";
$title = "AMS:パートナー情報一覧画面";
$js = array("list");
include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
<?php
include_once("include_title.php");
?>
		<div id="leftBases">
			<ul>
       <?php if($_SESSION[ 'super' ] == 1): ?>
				<li><a href="/index/chg/">企業情報変更</a></li>
        <?php endif; ?>
				<li><a href="/index/new/">新規パートナー登録</a></li>
				<li><a href="/index/tst/">受検者検索</a></li>
				<li><a href="/index/slog/">検査ログ</a></li>
				<li><a href="/index/plog/">PDF出力ログ</a></li>
				<li><a href="/index/row/" class="thickbox" >検査種別ROWデータ</a></li>

				<li><a href="/index/billList/">請求書一覧</a></li>
				<li><a href="/index/license/">ライセンス一覧</a></li>
				<li><a href="/index/trial/">トライアルＩＤ</a></li>
				<li><a href="/index/info/">お知らせ情報</a></li>
				<li><a href="https://analytics.e-wel.com/" target=_blank >受検者ログイン状況</a></li>
        		<li><a href="https://analytics.e-wel.com/adm" target=_blank >管理者ログイン状況</a></li>
				<li><a href="/index/dlist/" target=_blank >企業一覧</a></li>
				<li><a href="/index/pdf/" target=_blank >PDF一括</a></li>
				<li><a href="/index/log/"  >セキュリティログ</a></li>
			</ul>
		</div>
		<br clear=all />
		<ul id="pager">
<?php
    $back = $sec-1;
if($back >= 0) {
    ?>
			<li><a href="/index/list/<?=$back?>" >前の30件</a></li>
<?php
} else {
    ?>
			<li class="dis">前の30件</li>
<?php
}
?>
<?php
$next = $sec+1;
if($next <= $ceil) {
    ?>
			<li><a href="/index/list/<?=$next?>/" >次の30件</a></li>
<?php
} else {
    ?>
			<li class="dis">次の30件</li>
<?php
}
?>
		</ul>
		<div id="rightBases">
			<table id="table">
				<tr>
					<th class="w240">企業名</th>
					<th rowspan=2 >購入<br />ライセンス数</th>
					<th rowspan=2>販売可能<br />ライセンス数</th>
					<th rowspan=2>受検者数</th>
					<th rowspan=2>処理数</th>
					<th rowspan=2>残数</th>
					<th class="w240" rowspan=2>機能</th>

				</tr>
				<tr>
					<th><input type="text" id="searchText" value="<?=$_REQUEST[ 'text' ]?>" class="w200"></th>
					
				</tr>
				<tbody id="tbody">
				</tbody>
			</table>
			<div id="loading"></div>
		</div>
		<ul id="pager2">
<?php
    $back = $sec-1;
if($back >= 0) {
    ?>
			<li><a href="/index/list/<?=$back?>" >前の30件</a></li>
<?php
} else {
    ?>
			<li class="dis">前の30件</li>
<?php
}
?>
<?php
$next = $sec+1;
if($next <= $ceil) {
    ?>
			<li><a href="/index/list/<?=$next?>/" >次の30件</a></li>
<?php
} else {
    ?>
			<li class="dis">次の30件</li>
<?php
}
?>
		</ul>

	</div>


	<input type="hidden" id="pages" value="<?=$sec?>" >

<?php
include_once("include_footer_name.php");
?>
</div>

<?php
include_once("include_footer.php");
?>
