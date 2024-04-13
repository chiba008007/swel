<?php

?>
<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<?php if($basetype != 2):?>
<script src="//synalio.com/api/chatbox?appid=78ab789a78c843f89438586136bf4330" type="text/javascript"></script>
	<?php endif; ?>
<meta name="robots" content="noindex">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<LINK rel="stylesheet" href="/css/base.css" type="text/css">

<?PHP
if($css1){
?>
<LINK rel="stylesheet" href="/css/type2/<?=$css1?>.css" type="text/css">
<?PHP
}
?>
<LINK rel="stylesheet" href="/css/thickbox.css" type="text/css">
<LINK rel="stylesheet" href="/css/alerts.css" type="text/css">

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/thickbox.js" type="text/javascript"></script>
<script src="/js/alerts.js" type="text/javascript"></script>
<?PHP
if($js && count($js)){
	foreach($js as $key=>$val){
?>
<script src="/js/type2/<?=$val?>.js" type="text/javascript"></script>
<?PHP
	}
}
?>
<?PHP
if($map){
?>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<?PHP
}
?>

<?PHP
if($drop){
?>
<script src="/js/jquery.upload-1.0.2.js" type="text/javascript"></script>

<?PHP
}
?>

<?PHP
if($alert){
?>
<script type="text/javascript">
<!--
	jAlert("<?=$alert?>","エラー");
//-->
</script>
<?PHP
}
?>

<title><?=$title?></title>


</head>
<body>
<div id="container">
