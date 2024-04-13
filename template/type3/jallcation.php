<?PHP
$css1 = "reg";
$title = "AMS:検査新規登録画面";
$js = array("reg");
$scroll = true;
include_once("include_header.php");
$pan = array(
			array("/index/ptn/".$ptid,"顧客企業一覧"),
			array("/","検査一覧"),
			array("","データ割振"),
		);
if($basetype == 2){
	$pan = array(
			array("/","検査一覧"),
			array("","データ割振"),
		);
}
?>
<div id="main">
	<div id="contents">
<?PHP include_once("include_title.php"); ?>
		<div id="dataTitle">データ割振り</div>
		<br clear=all />

		<div class="upbox">
			<p>上司を選択してください。</p>
			<select name="boss" id="boss" class="pd10">
				<option value="">-</option>
			<?PHP foreach($boss as $key=>$val){ ?>
				<option value="<?=$val[ 'id' ]?>" ><?=$val[ 'sei' ]?><?=$val[ 'mei' ]?></option>
			<?PHP } ?>
			</select>
		</div>
		<br clear=all />
		<p>選択した上司に対する部下を選択してください。</p>
		<div id="pg"></div>
		<br clear=all />
		<table class="tbl left" style="width:100%;" >
			<tr>
				<th style="width:40px;">対象</th>
				<th>部署</th>
				<th>社員番号</th>
				<th>名前</th>
			</tr>
			<tbody id="tbody"></tbody>
		</table>
		
		<br clear=all />



	</div>
<?PHP include_once("include_footer_name.php"); ?>
</div>
<style type="text/css">
<!--
.pd10{
	padding:10px;
}
.left{
	float:left;
}
.tbl{
	border-collapse: collapse;
	margin-top:10px;
	margin-right:30px;
}
.tbl th{
	padding: 6px;
	vertical-align: top;
	color: #333;
	background-color: #eee;
	border: 1px solid #b9b9b9;
}
.tbl td{
	padding: 6px;
	background-color: #fff;
	border: 1px solid #b9b9b9;
}
.tbl td.chk{
	background-color:yellow;
}
//-->
</style>
<script type="text/javascript" >
<!--
var _pg;
var _bossid;
jQuery(function(){
	$(this).getList();
	jQuery(".pagemove").live("click",function(){
		var _id = $(this).attr("id");
		var _sp = _id.split("-");
		_pg = _sp[1];
		$(this).getList();
		return false;
	});
	$("#boss").change(function(){
		_bossid = $("#boss").val();
		$(this).getList();
	});
	$(".checks").live('click',function(){
		_bossid = $("#boss").val();
		if(!_bossid){
			alert("上司を選択してください");
			return false;
		}
		$(".checks").attr("disabled",true);
		var _jmid = $(this).val();
		var _data = {"check":true,"jmid":_jmid,"bossid":_bossid};
		var _url = location.href;
		$.ajax({
		    url: _url,
		    type: 'POST',
		    data: _data,
			cache : false,
		    success: function( lists ) {
console.log(lists);
				$(this).getList();
				$(".checks").attr("disabled",false);

			}
		});
	});
});
$.fn.getList = function(){
	var _data = new Array();
	var _array = new Array();
	_array.push({bossid:_bossid});
	var _data = {"getList":true,"pg":_pg,"arrays":_array};
	var _url = location.href;
	$.ajax({
	    url: _url,
	    type: 'POST',
	    data: _data,
		cache : false,
	    success: function( lists ) {
			var _data = jQuery.parseJSON(lists);
			var _tbl = "";
			$.each(_data[ 'data' ],function(_i,_v){
				_chk = "";
				var _cl = "";
				if(_v.check){ 
					_chk = "CHECKED";
					_cl = "chk";
				}
				_tbl += "<tr>";
				_tbl += "<td align='center' class='"+_cl+"'><input type='checkbox' id='chk-"+_v.id+"'  value='"+_v.id+"' "+_chk+" class='checks' ></td>";
				_tbl += "<td class='"+_cl+"' >"+_v.busyo+"("+_v.yakusyoku+")</td>";
				_tbl += "<td class='"+_cl+"'>"+_v.empnum+"</td>";
				_tbl += "<td class='"+_cl+"'>"+_v.sei+_v.mei+"</td>";
				_tbl += "</tr>";
			});
			var _p="<ul id='pager' class='pagination' style='margin:0;'>";
			var _j=1;
			for(var i=0;i<_data.page;i++){
				_p += "<li><a href='#' class='pagemove' id='pg-"+i+"' >"+_j+"</a></li>";
				_j++;
			}
			_p += "</ul>";
			$("#tbody").html(_tbl);
			$("#pg").html(_p);
		}
	});
}
//-->
</script>
<?PHP include_once("include_footer.php"); ?>
