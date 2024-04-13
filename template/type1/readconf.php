<?PHP
$title = "AMS:既読確認画面";
include_once("include_header.php");
$pan[1] = array("/index/info","お知らせ情報一覧");
$pan[2] = array("","既読確認");
?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
                <br clear="all" />
		<h2>既読確認</h2>
                <div >
                    <b>■タイトル</b><br />
                    <?=$data[ 'title' ]?>
                </div>
                <div >
                    <b>■本文</b><br />
                    <?=$data[ 'message' ]?>
                </div>
                <div >
                    <b>■表示期間</b><br />
                    <?=$data[ 'd1' ]?>～
                    <?=$data[ 'd2' ]?>
                </div>
                <div class="list">
                <?PHP if( count($list) ):?>
                <?PHP
                    $pg = sprintf("%d",$_REQUEST[ 'pg' ]+1);
                    $bk = sprintf("%d",$pg - 2);
                ?>
                <?PHP if($bk >= 0 ):?>
                    <a href="?pg=<?=$bk?>">前の<?=$li?>件</a>
                <?PHP else :?>
                    <span>前の<?=$li?>件</span>
                <?PHP endif;?>
                 <?PHP if($pg <= $ceil): ?>
                    <a href="?pg=<?=$pg?>">次の<?=$li?>件</a>
                    <?PHP else: ?>
                    <span>次の<?=$li?>件</span>
                    <?PHP endif; ?>
                    <table id="table">
                        <tr>
                            <th>パートナー企業</th>
                            <th>顧客企業</th>
                            <th>既読日時</th>
                        </tr>
                        <?PHP foreach($list as $key=>$val): ?>
                        <tr>
                            <td><?=$val[ 'partner' ]?></td>
                            <td><?=$val[ 'customer' ]?></td>
                            <td><?=$val[ 'regdate' ]?></td>
                        </tr>
                        <?PHP endforeach; ?>
                    </table>
                <?PHP else : ?>
                    <p>既読データが存在しません。</p>
                <?PHP endif; ?>
                </div>
        </div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<style type="text/css" >
    .list{
        margin:20px 0px;
    }
    td{
        text-align:left !important;
    }
</style>
<script type="text/javascript">
$(function(){
    
}) ;  
</script>
<?PHP
include_once("include_footer.php");
?>
