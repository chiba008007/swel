<?php
$css1 = "reg";
$title = "AMS:検査新規登録画面";

include_once("include_header.php");

?>
<style type="text/css" >
.f14{
    font-size:14px;
}

</style>

<div id="main">
	<div id="contents">
<?php
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
                "/index/data/".$sec."/",
                "検査結果一覧"
            ),
            array(
                "",
                "PDF一括ダウンロード"
            ),
        );

if($basetype == 2 || $basetype == 3) {
    $pan = array(


            array(
                "/index/data/".$sec."/",
                "検査結果一覧"
            ),
            array(
                "",
                "PDF一括ダウンロード"
            ),

        );
}

include_once("include_title.php");
?>

		<div id="dataTitle">PDF一括ダウンロード</div>
		<p>
        ■PDF作成には時間がかかります。<br />
        　※作成時間は指定人数により多少前後致します。<br />
        　　作成完了後、管理画面に登録されているアドレスに完了のメールを送付致します。<br />
        　　目安として50名程度であれば、1時間後です。）
        </p>
        <p>
        ■メール受取後、管理画面の「ダウンロード」ボタンを押し、<br />
        　ファイルダウンロード画面から、結果PDFをダウンロードしてください。<br />
        　※ファイルは14日後に自動的に削除されますのでご注意ください。
        </p>
        <div class="left">
            <input type="button" name="cancel"  class="button f14" value="キャンセル" />
        </div>
        <div class="left">
            <input type="button" name="download"  class="button f14" value="一括ダウンロード" />
        </div>
        <br clear=all />
        <table>
            <tr>
                <th style="width:200px;">処理完了日</th>
                <th style="width:100px;">検査名</th>
                <th style="width:100px;">状態</th>
            </tr>
        <?php if(count($pdfall)):foreach($pdfall as $key=>$val):?>
            <tr>
                <td>
                    <?php if($val[ 'status' ] == 1): ?>
                    <?=$val['regist_ts']?>
                    <?php endif; ?>
                </td>
                <td><?=$val['testname']?></td>
                <td><?=$val[ 'jp' ]?></td>
            </tr>
        <?php endforeach;endif;?>
        </table>
	</div>
<?php
include_once("include_footer_name.php");
?>
</div>

<?php
include_once("include_footer.php");
?>
<script type="text/javascript">
   $(function(){
        $('input[name="cancel"]').click(function(){
            location.href="/index/data/<?=$sec?>";
            return false;
        });
        $("input[name='download']").click(function(){
            if(confirm("PDFの一括ダウンロードを行います。処理に時間が掛かる場合があります。")){
                //location.href="http://igtests.sakura.ne.jp/all/down.php?tid=<?=$ptid?>&pid=<?=$id?>&testid=<?=$sec?>";
                alert("処理の実行中です。画面を閉じていただいても処理は実行されます。");
                var _data = {
                      "tid":"<?=$ptid?>"
                      ,"pid":"<?=$id?>"
                      ,"testid":"<?=$sec?>"
                };
                $.ajax({
                    type:'POST'
                    ,url:'/all/down.php'
                    ,data:_data
                    ,success:function(rst){
                        location.href="/index/data/<?=$sec?>";
                    }
                });
                return false;
            }
            return false;
        });
   });
</script>
