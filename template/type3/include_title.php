<?PHP

switch($_COOKIE[ 'lang' ]){
	case "jp":
		$check_jp = "CHECKED";
	break;
	case "ch":
		$check_ch = "CHECKED";
	break;
	default:
		$check_jp = "CHECKED";
	break;
}

if($_COOKIE[ 'lang' ] == "ch" ){
	$str1 = "管理画面";
	$str2 = "管理系统";
	$str3 = "退出";
}else{
	$str1 = "管理画面";
	$str2 = "管理システム";
	$str3 = "ログアウト";
}
?>
<script type="text/javascript" >
<!--
$(function() {
    try{
	if( !$.cookie("lang") ){
		$.cookie("lang", "jp", { expires: 365 });
	}
	$(".langradio").click(function(){
		var _val = $(this).val();
		$.cookie("lang", _val, { expires: 365 });
		$("#langForm").submit();

	});
    }catch(e){}
});
//-->
</script>


<div id="titleline">
	<div id="login">
		<h1><a href="/index/"><?=$sitename?> <?=$str1?></a></h1>
	</div><!--login-->
	
	<div id="logo">
		<div class="left"><?=$logoname?><?=$str2?></div>
		<div class="right">
			<a href="/index/home/">HOME</a> ｜
			<a href="/index/logout/"><?=$str3?></a>
		</div>
	</div><!--logo-->
<?PHP if($basetype == 1 || $basetype == 3 ): ?>
	<div class="language">
		<div id="language2">
			<form action="./" method="POST" id="langForm" >
			    <input name="language" id="select1" type="radio" class="langradio" value="jp" <?=$check_jp?> >
			    <label for="select1">日本語</label>
			    <input name="language" id="select2" type="radio" class="langradio" value="ch" <?=$check_ch?> >
			    <label for="select2">中国語</label>
			</form>
		</div>
	</div>
<?PHP endif; ?>
</div><!--titleline-->
<div id="pan">
	<ul>
		<li><a href="/index/home/">HOME</a></li>
<?PHP

if(isset($pan) && count($pan)){
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
<?PHP if($val[2] && $basetype != 3){?> 

<li> > <?=$val[2]?></li>
 <?PHP } ?>
		
	</ul>
</div>
<?PHP
if($ptitle){
?>
<p id="ptitle"><?=$ptitle?></p>
<?PHP
}
?>

