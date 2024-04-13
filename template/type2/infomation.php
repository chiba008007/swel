<?PHP
$title = "AMS:お知らせ";
include_once("include_header.php");
?>
<div id="info">
    <h2>お知らせ情報</h2>
    <table>
        <tr>
            <th>期間</th>
            <td><?=$info[0][ 'st' ]?>～<?=$info[0][ 'ed' ]?></td>
        </tr>
        <tr>
            <th>題名</th>
            <td><?=$info[0][ 'title' ]?></td>
        </tr>
        <tr>
            <th>内容</th>
            <td><?=nl2br($info[0][ 'message' ])?></td>
        </tr>
        <?PHP if($info[0][ 'temp_file' ]): ?>
        <tr>
            <th>添付ファイル</th>
            <td>
                <a href="/infoFile/<?=$info[0][ 'temp_file' ]?>" >ダウンロード</a>
                
            </td>
        </tr>
        <?PHP endif; ?>
    </table>
    <div id="btn">
        <input type="button" id="close" value="閉じる" class="button1" />
        
    </div>
</div>
<?PHP include_once("include_footer_name.php"); ?>
<style type="text/css">
    #info{
        padding:20px;
    }
    table{
        margin-top:20px;
        border-collapse: collapse;
        width:100%;
    }
    table th{
      width:20%;
      border-bottom:1px solid #ccc;
    }
    table td{
        padding:5px;
        border-bottom:1px solid #ccc;
    }
    #btn{
        padding:20px;
        text-align:center;
    }
    .button1{
        padding:15px;
        width:100px;
        border:1px solid #ccc;
        color:#333;
    }
</style>
<script type="text/javascript">
$(function(){
    $("#close").click(function(){
       window.close();
    });
    $(window).blur(function(){
       window.close();
    });
});
</script>
<?PHP include_once("include_footer.php"); ?>
