<?PHP
$css1 = "ptn";
$title = "AMS:顧客情報一覧画面";
include_once("include_header.php");
?>
<?php if($row == 0):?>
<script type="text/javascript">
alert("非表示企業はありません");
location.href="/";
</script>
<?php endif;?>
<style>
    
</style>
<div id="main">
	<div id="contents">
<?PHP
if($basetype == 1){
	$pan = array(
			array(
				"",
				"非表示一覧"
			),
		);
}
include_once("include_title.php");
?>
<p id="ptitle">非表示企業</p>

<ul class="pager" style="margin:0;">
	<li>
	<?php if($p > 0):?>
		<a href="/index/none/?page=<?=$p-1?>">前の30件</a>
	<?php else: ?>
		<a href="javascript:void(0);" style="background-color:#ccc;">前の30件</a>
	<?php endif; ?>
	</li>
	<li>
	<?php if($p == $ceil):?>
		<a href="javascript:void(0);" style="background-color:#ccc;" >次の30件</a>
		<?php else: ?>
		<a href="/index/none/?page=<?=$p+1?>">次の30件</a>
		<?php endif; ?>
	</li>
</ul>

<br clear=all />
<table id="table" style="margin-top:10px;">
	<tr>
		<th>企業名</th>
		<th>受検者数</th>
		<th>処理数</th>
		<th>残数</th>
		<th>非表示日時</th>

	</tr>
<?php foreach($data as $key=>$value):?>
	<tr>
		<td style="text-align:left;"><?=$value[ 'name' ]?></td>
		<td><?=$value[ 'counter' ]?></td>
		<td><?=$value[ 'syori' ]?></td>
		<td><?=$value[ 'zan' ]?></td>
		<td style="text-align:left;"><?=preg_replace("/\-/","/",$value[ 'registtime' ])?></td>
	</tr>
<?php endforeach;?>
</table>
<br clear=all />

<ul class="pager" style="margin:0;">
	<li>
	<?php if($p > 0):?>
		<a href="/index/none/?page=<?=$p-1?>">前の30件</a>
	<?php else: ?>
		<a href="javascript:void(0);" style="background-color:#ccc;">前の30件</a>
	<?php endif; ?>
	</li>
	<li>
	<?php if($p == $ceil):?>
		<a href="javascript:void(0);" style="background-color:#ccc;" >次の30件</a>
		<?php else: ?>
		<a href="/index/none/?page=<?=$p+1?>">次の30件</a>
		<?php endif; ?>
	</li>
</ul>

<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript" >
<!--
$(function(){

});
//-->
</script>

<?PHP
include_once("include_footer.php");
?>
