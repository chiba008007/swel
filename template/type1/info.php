<?PHP
$css1 = "info";
$title = "AMS:お知らせ情報一覧画面";
$js = array("info");
include_once("include_header.php");
$pan[1] = array("","お知らせ情報一覧");

?>
<div id="main">
	<div id="contents">
<?PHP
include_once("include_title.php");
?>
		<br clear=all />
		<h2>お知らせ情報登録</h2>
		
		<div id="leftBases">
			<ul>
				<li><a href="/index/infoReg/">お知らせ情報登録</a></li>
				<li><a href="/index/info/delete/" id="delete">チェック項目を削除</a></li>
			</ul>
		</div>
		<form action="/index/info/" method="POST" name="form">
		<table id="table">
			<tr>
				<th class="center w10"><input type="checkbox" id="all" ></th>
				<th class="center">件名</th>
				<th class="center">表示期間</th>
				<th class="center">表示範囲</th>
				<th class="center">機能</th>
			</tr>
<?PHP
			foreach($info as $key=>$val){
?>
			<tr>
				<td class="center"><input type="checkbox" name="del[<?=$val[ 'id' ]?>]" value="on" class="del"></td>
				<td><?=$val[ 'title' ]?>
<?PHP
					if($val[ 'disp_area' ] == 2){
?>
					<div class="divStore" id="s_<?=$val[ 'id' ]?>">代理店名</div>
					<div class="divStoreDist" id="s2_<?=$val[ 'id' ]?>">
						aaa
					</div>
<?PHP
					}
?>
				</td>
				<td class="center"><?=$val[ 'date1' ]?>～<?=$val[ 'date2' ]?></td>
				<td class="center"><?=$a_disp_status[$val[ 'disp_status' ]]?></td>
				<td class="center">
					<input type="button" value="編集" id="d_<?=$val[ 'id' ]?>" class="edit">
                                        <input type="button" value="既読確認" id="read-<?=$val[ 'id' ]?>" class="read" style="padding:3px 10px;" >
				</td>
			</tr>
<?PHP
			}
?>
		</table>
		</form>
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript">
$(function(){
    $(".read").click(function(){
       var _id = $(this).attr("id").split("-");
       var _key = _id[1];
       location.href="/index/readconf/"+_key;
    });
}) ;  
</script>
<?PHP
include_once("include_footer.php");
?>
