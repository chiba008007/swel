<?PHP
$css1 = "list";
$title = "AMS:企業情報変更画面";
$js[1] = "chg";
include_once("include_header.php");
$pan[1] = array("","管理者情報変更");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<form action="/index/chg/" method="post">
		<div id="rightBases">
		<h2>企業情報変更画面</h2>
        <h3>■スーパーユーザ</h3>
   			<table id="table">
				<tr>
            <th>ID</th>
            <td style="text-align:left;"><?=$superuser[0]['login_id']?></td>
        </tr>
				<tr>
            <th>パスワード</th>
            <td style="text-align:left;"><?=$superuser[0]['login_pw']?></td>
        </tr>
        <tr>
					<th>担当者氏名</th>
					<td class="left">
						<input type="text" name="rep_name" value="<?=$superuser[0]['rep_name']?>" class="w300" id="rep_name">
						※ 氏名の間に空白を入力してください。例） 鈴木　太郎</td>
				</tr>
        <tr>
					<th>担当者メールアドレス</th>
					<td class="left">
						<input type="text" name="rep_email" value="<?=$superuser[0]['rep_email']?>" class="w300" id="rep_name">
        </td>
				</tr>        
        <input type="hidden" name="superid" value="<?=$superuser[0]['id']?>" />
    
      </table>
   
   
   
   
      <br clear="all" />
			<table id="table">
       
       <?php for($i=0;$i<5;$i++):?>
       
       	<tr>
					<th>ID</th>
					<td class="left"><?=$adminuser[$i]['login_id']?>
						</td>
				</tr>
        <tr>
					<th>パスワード</th>
					<td class="left"><input type="text" name="admin_login_pw[<?=$i?>]" value="<?=$adminuser[$i]['login_pw']?>" class="w300" >
						</td>
				</tr>
				<tr>
					<th>担当者氏名1※</th>
					<td class="left">
						<input type="text" name="admin_rep_name[<?=$i?>]" value="<?=$adminuser[$i]['rep_name']?>" class="w300" >
						※ 氏名の間に空白を入力してください。例） 鈴木　太郎</td>
				</tr>
				<input type="hidden" name="adminid[<?=$i?>]" value="<?=$adminuser[$i]['id']?>" />
        <?php endfor; ?>
			
    
			</table>
   
			<input type="submit" name="chgEdit" value="登録" class="button" 　>
      <br clear="all" />
		</div>
		</form>
	</div><!--contents-->

<?PHP
include_once("include_footer_name.php");
?>
</div><!--main-->
<script type="text/javascript" >
$(function(){
    $("[name='chgEdit']").click(function(){
        if(confirm("登録を行います。")){
            return true;
        }
        return false;
    });
}) ;   
</script>
<?PHP
include_once("include_footer.php");
?>
