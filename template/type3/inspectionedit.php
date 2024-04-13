<?PHP


include_once("include_header.php");

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" >
<script type="text/javascript" >
<!--
    $(function(){
         $(".datepicker").datepicker();
       $("input[name=regist]").click(function(){
           if(confirm("データの変更を行います")){
               
               return true;
           }
           return false;
       }) ;
    });
//-->
</script>
<div id="main">
    <div id="contents">
<?PHP
$pan = array(
			array(
				"/index/ptn/".$ptid,
				"顧客企業一覧"
			),
			array(
				"/",
				"検査一覧"
			),
			array(
				"/index/inspection/",
				"受検一覧画面"
			),
                        array(
				"",
				"受検編集"
			),
		);
include_once("include_title.php");
?>  
        <?php if($msg): ?>
        <br clear="all" />
        <div class="alert alert-info alert-dismissable">
            <?=$msg?>
        </div>
        <?php endif; ?>
        <form action="" method="POST" >
            <div style="margin-top:30px;">
            <table class="table " style="width:600px;margin:10px auto;">
                <tr>
                    <th>受検区分(新卒・中途)</th>
                    <td>
                        <input type="text" name="inspection" value="<?=$inspection?>" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <th>面接評価</th>
                    <td>
                        <input type="text" name="evaluation" value="<?=$evaluation?>" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <th>採用合否</th>
                    <td>
                        <input type="text" name="adopt" value="<?=$adopt?>" class="form-control" />
                    </td>
                </tr>
                <tr>
                    <th>入社日</th>
                    <td>
                        <input type="text" name="enterdate" value="<?=$enterdate?>" class="form-control datepicker" />
                    </td>
                </tr>
                <tr>
                    <th>退職日</th>
                    <td>
                        <input type="text" name="retiredate" value="<?=$retiredate?>" class="form-control datepicker" />
                    </td>
                </tr>
                <tr>
                    <th>退職理由</th>
                    <td>
                        <textarea name="retirereason" class="form-control" style="height:100px;"><?=$retirereason?></textarea>
                    </td>
                </tr>
            </table>
            </div>
            <div class="text-center">
            <input type="submit"  class="btn btn-success" name="regist" value="登録" />
            </div>
        </form>

   </div>
<?PHP
include_once("include_footer_name.php");
?>
 
<?PHP
include_once("include_footer.php");
?>
