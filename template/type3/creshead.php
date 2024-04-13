
<?php
	$array_gender[1] ="男性"; 
	$array_gender[2] ="女性";

	$array_week[1] = "1週間";
	$array_week[2] = "2週間";
	$array_week[3] = "3週間";

	$array_status[1] ="有効中"; 
	$array_status[0] ="無効中";
	
	$array_exam[1] ="回答済"; 
	$array_exam[0] ="未回答";
?>
<!doctype html>
<html lang="ja" >
  <head>
	<title>検査詳細</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/cres.css" rel="stylesheet">
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
	<script type="text/javascript" >
	$(function(){
		$('.datepicker').datepicker({
			changeYear: true,  // 年選択をプルダウン化
			changeMonth: true,  // 月選択をプルダウン化
			minDate: 0
			
		});

		$("[name='edit']").click(function(){
			if(confirm("データの更新を行います。よろしいですか？")){
				return true;
			}
			return false;
		});
	});

	</script>
</head>