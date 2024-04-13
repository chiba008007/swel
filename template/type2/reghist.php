<?PHP
$css1 = "edit";
$title = "AMS:検査申込履歴";
$ptitle = "検査申込履歴";
include_once("include_header.php");
?>
<style type="text/css">
.right{
	text-align:right !important;
}
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
				"検査申込履歴"
			),
		);
if($basetype == 2){
	$pan = array(
			array(
				"",
				"検査申込履歴"
			),
		);
	
}
include_once("include_title.php");
?>
			<div>
				<form action="" method="POST" name="form1" >
				<table id="table">
					<tr>
						<th >申込内容</th>
						<th >テスト名</th>
						<th >追加件数</th>
						<th >追加日時</th>
						<th >受付状態</th>
						<th >金額</th>
						<th >PDF</th>
					</tr>
					<tbody id="tbody"></tbody>
				</table>
				</form>
			</div>
			<br clear=all />
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<script type="text/javascript" >
<!--
	$(function($){
		$("#back").click(function(){
			location.href="/";
		});
		$("select.selappli").live("change",function(){
			var _val = $(this).val();
			var _id = $(this).attr("id");
			var _key = _id.split("-");

			_url = location.href;
			_data = {
					"flg":"sts"
					,"status":_val
					,"id":_key[1]
					};
			$.ajax({
				url: _url,
				type: 'POST',
				data: _data,
				cache : false,
				dataType: "json",
				success: function(data){
					
				}
			});
		});
		$(this).getTable();
	});
	$.fn.getTable = function(){
		_url = location.href;
		_data = {"flg":"get"};
		$.ajax({
			url: _url,
			type: 'POST',
			data: _data,
			cache : false,
			dataType: "json",
			success: function(data, textStatus){

				// 成功したとき
				var _tbl;
				jQuery.each(data.hist, function(i, val) {

					//ステータス配列
					var _sel = "<select class='selappli' id='sel-"+val.id+"'>";
					jQuery.each(data.array_sts, function(_i, _val) {
						var _s = "";
						if(_i == val.status){
							_s  = "SELECTED";
						}
						_sel += "<option value='"+_i+"' "+_s+">"+_val+"</option>";
					});
					_sel += "</select>";

					_tbl += "<tr>";
					_tbl += "<td>"+val.typename+"</td>";
					_tbl += "<td>"+val.examname+"</td>";
					_tbl += "<td class='right' >"+val.addcount+"件</td>";
					_tbl += "<td class='center' >"+val.create_ts+"</td>";
					_tbl += "<td class='center' >"+_sel+"</td>";
					_tbl += "<td class='center' >"+val.money+"円</td>";
					_tbl += "<td class='center' ><a href='"+val.pdf+"' target=_blank >PDF</a></td>";
					_tbl += "</tr>";
				});
				$("#tbody").html(_tbl);
			}
		});
	}
//-->
</script>
<?PHP
include_once("include_footer.php");
?>

