<?PHP
$css1 = "ptn";
$title = "AMS:顧客情報一覧画面";
$js = array("list");
include_once("include_header.php");
?>
<style>
    .infoleft{
        float:left;
    }
    .clear{
        clear:both;
    }
</style>
<div id="main">
	<div id="contents">
<?PHP
if($basetype == 1){
	$pan = array(
			array(
				"",
				"顧客企業一覧"
			),
		);
}
include_once("include_title.php");
?>
<?PHP
		if(count($info)){
?>
			<ul id="infoBox">
				<li><h3>■お知らせ情報</h3></li>
<?PHP
			foreach($info as $key=>$val){
				$y = substr($val[ 'regist_ts' ],0,4);
				$m = substr($val[ 'regist_ts' ],5,2);
				$d = substr($val[ 'regist_ts' ],8,2);
				$date = sprintf("%d年%d月%d日",$y,$m,$d);
?>
				<li class="clear" id="li-<?=$val[ 'id' ]?>">
                                    <div class="infoleft">
                                        <?=$date?>　
					<a href="index/infomation/<?=$val[ 'id' ]?>" id="l_<?=$key?>" class="info"><?=$val[ 'title' ]?></a>
                                    </div>
                                    <div class="right"><a href="javascript:void(0);" class="hidden" id="hid-<?=$val[ 'id' ]?>">非表示</a></div>
				</li>
<?PHP
			}
?>
			</ul>
<?PHP
		}
?>
		<?php if($pdata[0]['password_editdate'] < $lastyear ):?>
			<br clear=all />
			<div style="border:1px solid gray;padding:10px;margin:10px;">
				■ ログインパスワード変更のお願い
				<p>前回ログインパスワードの設定から一定期間が経過しました。ログインパスワードの変更をしてください。</p>
				<div style="text-align:right;">
					<a href="/index/chg/">変更する</a>
				</div>
			</div>
		<?php endif; ?>
		<div id="mg10">
		<div id="divLeft">
			<table id="lisenceTbl">
				<tr>
					<th>検査種別</th>
					<th>購入ライセンス数</th>
					<th>販売可能ライセンス数</th>
					<th>受検者数</th>
					<th>処理数</th>
					<th>残数</th>

				</tr>
<?PHP
				if(count($ldata)){
					foreach($ldata as $key=>$val){
						if($val[ 'type' ]){
							$ty = $val[ 'type' ];
						}else{
							$ty = $key;
						}
?>
						<tr>
							<td class="left"><?=$a_test_type[$ty]?></td>
							<td><?=number_format($val[ 'total' ])?></td>
							<td><?=number_format($val[ 'sale'  ])?></td>
							<td><?=number_format($val[ 'cnt'   ])?></td>
							<td><?=number_format($val[ 'syori' ])?></td>
							<td><?=number_format($val[ 'zan'   ])?></td>

						</tr>
<?PHP
					}
				}
?>
			</table>
		</div>
		<div id="divRight">
			<ul class="ptnmenu">
				<li><a href="/index/chg/">企業情報変更</a></li>
				<li><a href="/index/new/">新規顧客登録</a></li>
				<li><a href="/index/down/">ダウンロード</a></li>
				<li><a href="/index/logo/">PDFロゴ画像登録</a></li>
				<li><a href="/index/regForm/">企業登録フォーム</a></li>
<?PHP
				if($ptTestBtn == 1){
?>
				<li><a href="/index/regMoney/">検査申込料金設定</a></li>
				<li><a href="/index/reghist/">検査申込履歴</a></li>
<?PHP
				}
?>
				<li><a href="/index/implement/">実施件数確認</a></li>
				<?php if($basetype == 2):?>
				<li><a href="/index/none/">非表示機能一覧</a></li>
					<?php endif; ?>
			</ul>
		</div>
		</div><!--mg10-->
		<br clear=all />
<?php
		//ページャーの作成
		$back = $sec-1;
		if($back >= 0){
			$backP = "<li><a href='/index/list/' >最初へ</a></li>";
			$backP .= "<li><a href='/index/list/".$back."' >前の30件</a></li>";
		}else{
			$backP = "<li class='dis'>前の30件</li>";
		}
		
		$next = $sec+1;
		if($next <= $ceil){
			$nextP = "<li><a href='/index/list/".$next."/' >次の30件</a></li>";
			$nextP .= "<li><a href='/index/list/".$ceil."/' >最後へ</a></li>";
		}else{
			$nextP = "<li class='dis'>次の30件</li>";
		}
		
?>
		<ul class="pager" style="width:500px;">
			<?=$backP?>
			<?=$nextP?>
		</ul>
		<br clear=all />
		<div >
			<div style="text-align:right;">
				<button id="sortUpdate">更新日<span>▼</span></button>
				<button id="sortCount">残数<span></span></button>
			</div>
			<table id="table">
				<tr>
					<th>企業名</th>
					<th rowspan=2 >受検者数</th>
					<th rowspan=2 >処理数</th>
					<th rowspan=2 >残数</th>
					<th class="w300" rowspan=2>機能</th>

				</tr>
				<tr>
					<th><input type="text" id="searchText" value="" class="w200"></th>
					
				</tr>
				<tbody id="tbody">
				</tbody>
			</table>
			<div id="loading"></div>
			<input type="hidden" id="pages" value="<?=$sec?>" >
		</div>
	</div>
<br clear=all />
	<ul class="pager" style="width:500px;">
		<?=$backP?>
		<?=$nextP?>
	</ul>
<br clear=all />


<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript" >
<!--
$(function(){
    $(".info").click(function(){
        var _href = $(this).attr("href");
        var _w = window.open(_href,"WindowName","width=600,height=500,resizable=no,scrollbars=no");
        _w.focus();
        return false;
    });
    $(".hidden").click(function(){
       var _id = $(this).attr("id").split('-');
       var _key = _id[1];
       var _li = "#li-"+_key;
       if(confirm("非表示にします。\nよろしいですか？")){
           var _data = {
                      "type":"hidden"
                      ,"infoid":_key
           };
            $.ajax({
               type:'POST'
               ,url:'/index/infomation/'
               ,data:_data
               ,success:function(rst){
                    $(_li).hide();
               }
            });
       }
    });
});
//-->
</script>

<?PHP
include_once("include_footer.php");
?>
