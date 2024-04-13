<?PHP
$pan = [];
?>
<div id="titleline">
	<div id="login">
		<h1><a href="/index/"><?=$sitename?> 管理画面</a></h1>
	</div><!--login-->
	
	<div id="logo">
		<div class="left">管理システム</div>
		<div class="right">
			<a href="/index/home/">HOME</a> ｜
			<a href="/index/logout/">ログアウト</a>
		</div>
	</div><!--logo-->
</div><!--titleline-->
<div id="pan">
	<ul>
		<li><a href="/index/home/">HOME</a></li>
<?PHP
if(count($pan)){
	foreach($pan as $key=>$val){
		if($val[0]){
?>
		<li> > <a href="<?=$val[0]?>"><?=$val[1]?></a></li>
<?PHP
		}else{
?>
		<li> > <?=$val[1]?></li>
<?PHP
		}
?>
<?PHP
	}
}
?>
	</ul>
</div>