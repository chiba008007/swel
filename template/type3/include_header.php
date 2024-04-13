<?php

?>
<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta name="robots" content="noindex">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<LINK rel="stylesheet" href="/css/base.css" type="text/css">

<?PHP
if($css1){
?>
<LINK rel="stylesheet" href="/css/type3/<?=$css1?>.css" type="text/css">
<?PHP
}
?>
<LINK rel="stylesheet" href="/css/thickbox.css" type="text/css">
<LINK rel="stylesheet" href="/css/alerts.css" type="text/css">

<script src="/js/jquery.min.js" type="text/javascript"></script>
<script src="/js/thickbox.js" type="text/javascript"></script>
<script src="/js/jquery.cookie.js" type="text/javascript"></script>

<?PHP
if($time){
//日付表示
?>
<?php if (empty($_SERVER['HTTPS'])) { ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />

<?php }else{ ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
<?php } ?>
<?PHP
}
?>
<script src="/js/alerts.js" type="text/javascript"></script>

<?PHP
if($scroll){
//日付表示
?>
<script type="text/javascript" src="/js/jquery.tablefix.js"></script>
<?PHP
}
?>


<?PHP

if($js && count($js)){
    foreach($js as $key=>$val){
?>
    <script src="/js/type3/<?=$val?>.js" type="text/javascript"></script>
<?PHP
    }
}
?>
<?PHP
if($map){
//住所自動登録
?>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>

<?PHP
}
?>
<?PHP
if($prints){
?>
<link REL="stylesheet" type="text/css" HREF="/css/type3/print.css" media="print"> 
<?PHP
}
?>
<?PHP
if($drop){
?>
<!--
<script src="/js/dropzone.js" type="text/javascript"></script>
<script src="/js/fileUp.js" type="text/javascript"></script>
-->
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
<style type="text/css">
<!--
div.language{
	margin-top:60px;
	width:880px;
	position:absolute;
}
div#language2{
	float:right;
}
.language input{
	display: none;
}
.language label{
	display: block;
	float: left;
	cursor: pointer;
	width: 80px;
	margin: 0;
	padding: 5px;
	border-right: 1px solid #abb2b7;
	background: #bdc3c7;
	color: #555e64;
	font-size: 11px;
	text-align: center;
	line-height: 1;
	transition: .2s;
}
.language label:first-of-type{
/*	border-radius: 3px 0 0 3px;*/
}
.language label:last-of-type{
	border-right: 0px;
	/*border-radius: 0 3px 3px 0;*/
}
.language input[type="radio"]:checked + label {
	background-color: #696969;
	color: #fff;
}

//-->
</style>
</head>
<body>
<div id="container">
