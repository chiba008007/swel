<?PHP


include_once("include_header.php");

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>


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
				"CSVアップロード"
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
        <br clear="all" />
        <form action="" id="form1" method="POST" enctype="multipart/form-data">
            
            <input type="file" name="upfile" size="30" />
            <div class="mt10" style="margin-top:10px;">
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
