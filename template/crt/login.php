<?PHP
include_once("include_header.php");
?>
<form action="/crt/<?=$first?>/" method="post">
<div id="form">
	<h3>添削対象者の検査IDを入力してください。</h3>
	<div class="pd20">
		<p>検査ID</p>
		<p><input type="text" name="username" value="<?=$sec?>" ></p>
	</div>
	<div class="pd20 center">
		<input type="submit" name="login" value="ログイン" class="button" >
	</div>
</div>
</form>
<?PHP
include_once("include_footer.php");
?>
