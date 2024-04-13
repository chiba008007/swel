<?PHP
$css1 = "";
$title = "AMS:検査申込料金設定";
$ptitle = "検査申込料金設定";
include_once("include_header.php");
?>
<style type="text/css">
	.w30{
		width:30px;
	}
	.h30{
		height:30px;
	}
	.w400{
		width:400px;
	}
	.center{
		margin:0 auto;
	}
	table.table{
		border-collapse: collapse;
		margin:auto;
	}
	table.table th{
		font-size:16px;
		font-weight:normal;
		padding:10px;
		border-bottom:1px solid #000000;
		
	}
	table.table td{
		padding:10px;
		border-bottom:1px dotted #000000;
		text-align:center;
	}
	table.table th.w60{
		width:60px !important;
	}
	table.table th.w200{
		width:200px !important;
	}
	table.table td input{
		padding:5px;
		font-size:16px;
		width:75%;
	}
</style>
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
				"検査申込料金設定"
			),
		);
if($basetype == 2){
	$pan = array(
			array(
				"",
				"検査申込料金設定"
			),
		);
	
}
include_once("include_title.php");
?>
			<div>
				<form action="" method="POST" name="form1" >
				<table class="table">
					<tr>
						<th class="w60">利用</th>
						<th class="w200">検査型</th>
						<th class="w200">表示名</th>
						<th class="w200">金額(結果PDF込/税抜)</th>
					</tr>
<?PHP
					foreach($tests as $key=>$val){
						$dispname = $val[ 'dispname' ];
						$money    = $val[ 'money'    ];
						if(strlen($_REQUEST[ 'dispname' ][ $val[ 'type' ] ]) > 0 ){ $dispname = $_REQUEST[ 'dispname' ][ $val[ 'type' ] ]; }
						if(strlen($_REQUEST[ 'money'    ][ $val[ 'type' ] ]) > 0 ){ $money    = $_REQUEST[ 'money'    ][ $val[ 'type' ] ]; }
						$chk = "";
						if($val[ 'status' ] == "1" && !$_REQUEST[ 'back2' ] ) $chk = "CHECKED";
						if($_REQUEST[ 'status' ][$val[ 'type' ]]) $chk = "CHECKED";
?>
					<tr>
						<td><input type="checkbox" name="status[<?=$val[ 'type' ]?>]" value="1" class="w30 h30" <?=$chk?> /></td>
						<td><?=$val[ 'name' ]?></td>
						<td><input type="text" name="dispname[<?=$val[ 'type' ]?>]" value="<?=$dispname?>" /></td>
						<td><input type="text" name="money[<?=$val[ 'type' ]?>]" value="<?=$money?>" /></td>
						<input type="hidden" name="type[<?=$val[ 'type' ]?>]" value="<?=$val[ 'type' ]?>" >
					</tr>
<?PHP
					}
?>
				</table>
				<div class="center w400">
					<input type="button" id="back" value="戻る" class="button">
					<input type="submit" name="conf" value="確認" class="button">
				</div>
				</form>
			</div>
			<br clear=all />
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript" >
<!--
	$(function(){
		$("#back").click(function(){
			location.href="/";
		});
	});
//-->
</script>
<?PHP
include_once("include_footer.php");
?>

