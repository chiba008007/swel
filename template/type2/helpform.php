<?PHP
$css1 = "new";
$title = "AMS:受検者一覧画面";
$js = array("new");
$map = true;
$drop = true;
include_once("include_header.php");
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<style type="text/css" >
<!--
.pd10{
	padding:10px;
}
textarea {
    resize: none;
}

ul{
	margin-left:20px;
}
//-->
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
				"新規顧客登録"
			),
			
		);
if($basetype == 2){
$pan = array(
			array(
				"/index/help/",
				"ヘルプ",
			),
			array(
				"",
				"問い合わせ画面",
			),
		);
}
include_once("include_title.php");
?>
	<div id="searchTitle">問い合わせ画面</div>
		<form action="/index/helpform/" method="POST" >

			<div class="form-group pd10">
			<?php if($_SESSION[ 'alert' ]): ?>
			<div class="alert alert-info alert-dismissable">
            	<?=$_SESSION[ 'alert' ]?>
            </div>
			<?php endif; 
				$_SESSION[ 'alert' ] = "";
			?>

		      <label for="inputEmail" class="col-lg-2 control-label">問い合わせ内容</label>
				<br />
		        <textarea class="form-control" name="note" rows=10  placeholder="問い合わせ内容"></textarea>
				<br />
				<input type="submit" name="send" value="送信" class="btn btn-success" />
		    </div>
		</form>
	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript" >
$(function(){
	$("[name='send']").click(function(){
		if(confirm("問い合わせ内容の送信を行います。よろしいですか？")){
			return true;
		}
		return false;
	});
});
</script>
<?PHP
include_once("include_footer.php");
?>
