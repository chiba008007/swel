<?php

?>
<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#" xmlns:fb="http://ogp.me/ns/fb#">

<head>
	<meta name="robots" content="noindex">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<LINK rel="stylesheet" href="<?= D_URLS ?>css/base.css" type="text/css">

	<?PHP
	if ($css1) {
	?>
		<LINK rel="stylesheet" href="<?= D_URLS ?>css/type1/<?= $css1 ?>.css" type="text/css">
	<?PHP
	}
	?>
	<LINK rel="stylesheet" href="<?= D_URLS ?>css/thickbox.css" type="text/css">
	<LINK rel="stylesheet" href="<?= D_URLS ?>css/alerts.css" type="text/css">

	<script src="<?= D_URLS ?>js/jquery.min.js" type="text/javascript"></script>
	<script src="<?= D_URLS ?>js/thickbox.js" type="text/javascript"></script>
	<?PHP
	if ($time) {
	?>
		<script type="text/javascript" src="<?= D_URLS ?>js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?= D_URLS ?>js/jquery.ui.datepicker-ja.min.js"></script>
		<link type="text/css" href="<?= D_URLS ?>css/jquery-ui.css" rel="stylesheet" />
		<script src="<?= D_URLS ?>js/alerts.js" type="text/javascript"></script>

	<?PHP
	}
	?>

	<script src="<?= D_URLS ?>js/alerts.js" type="text/javascript"></script>


	<?PHP
	if ($js && count($js)) {
		foreach ($js as $key => $val) {
	?>
			<script src="<?= D_URLS ?>js/type1/<?= $val ?>.js" type="text/javascript"></script>
	<?PHP
		}
	}
	?>
	<?PHP
	if ($map) {
	?>
		<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
	<?PHP
	}
	?>

	<?PHP
	if ($drop) {
	?>
		<script src="<?= D_URLS ?>js/jquery.upload-1.0.2.js" type="text/javascript"></script>

	<?PHP
	}
	?>

	<?PHP
	if ($alert) {
	?>
		<script type="text/javascript">
			<!--
			jAlert("<?= $alert ?>", "エラー");
			//
			-->
		</script>
	<?PHP
	}
	?>


	<title><?= $title ?></title>


</head>

<body>
	<div id="container">