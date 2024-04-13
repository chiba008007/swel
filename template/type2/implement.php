<?PHP
$css1 = "edit";
$title = "AMS:企業更新画面";
$js = array("edit");
$map = true;
$drop = true;
include_once("include_header.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" >
<style type="text/css">
<!--
.pd5{ padding:5px; }
.w20p{ width:20%;}
.w70p{ width:70%;}

.w100p{ width:100%;}
.w100{ width:100px;}
.w200{ width:200px;}
.w300{ width:300px;}
.left{ float:left;}
.ml10{ margin-left:10px;}
.ml15{ margin-left:15px;}
.ml20{ margin-left:20px;}

.mt15{ margin-top:15px;}
#count{border-bottom:1px solid #000000;width:200px;}
#count2{border-bottom:1px solid #000000;width:200px;}

.f18{font-size:18px;}
.f22{font-size:22px;}
.tright{text-align:right;}
.abs{ position:absolute; }
.btn{
	width:100px;
	font-weight: bold
	border-style: none;
	color: #000000;
	background-color: #ccc;
	font-size: 1.4em;
}
.buttom{ position:absolute; }
.scroll{ overflow: scroll; width:250px; height:300px;}
ul.menus{
	list-style-type:none;
	margin-top:15px;
}
ul.menus li{
	border-bottom:1px dotted #ccc;
}

ul.menus li a{
	display:block;
	text-decoration:none;
	padding:10px;
	font-weight:normal;
	color:#000000;
}
ul.menus li:hover{
	background-color:#eeeeee;
}
.title{
	padding:5px 0px 5px 10px;
	border-left:3px solid #808080;
	margin:15px 0px 15px 10px;
	font-size:18px;
}
.tbl{
	width:100%;
	border-top:1px solid #ccc;
	border-left:1px solid #ccc;
	border-collapse: collapse;
}
.tbl th{
	border-right:1px solid #ccc;
	border-bottom:1px solid #ccc;
	background-color:#eeeeee;
}
.tbl td{
	border-right:1px solid #ccc;
	border-bottom:1px solid #ccc;
}

//-->
</style>
<script>
  $(function() {
    $(".datepicker").datepicker();
  });
</script>


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
				"実施件数確認"
			)
			
		);
if($basetype == 2){
	$pan = array(
			array(
				"",
				"実施件数確認"
			)
		);
}
include_once("include_title.php");
?>

	<div id="searchTitle">実施件数確認</div>
		<div class="left w20p">
			<ul class="menus">
				<li><a href="#" class="f18" id="down">ダウンロード</a></li>
			</ul>
		</div>
		<div class="left ml10 w70p">
			<div class="left w300 ">
				<div class="title">期間選択</div>
				<div class="left">
					<p>開始日<br /><input type="text" name="date1" id="date1" value="" class="datepicker pd5 w100 chg"></p>
				</div>
				<div class="left ml20">
					<p>終了日<br /><input type="text" name="date2" id="date2" value="" class="datepicker pd5 w100 chg"></p>
				</div>
			</div>
			<div class="left ml10 w300">
				<div class="title">顧客選択</div>
				<select name="cid" id="cid" class="pd5 w100p mt15 chg">
					<option value="">-</option>
	<?PHP  foreach( $list as  $key => $val): ?>
				<option value="<?=$val[ 'id' ]?>" ><?=$val[ 'name' ]?></option>
	<?PHP endforeach; ?>
				</select>
			</div>
			<br clear=all />
			<div class="title">検査</div>
			<div class="loading"><img src="/images/loading.gif" /></div>
			<div id="testlist" ></div>
		</div>

	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>


<script type="text/javascript">
<!--
$(function(){
	$("#down").click(function(){
		var _date1 = $("#date1").val();
		var _date2 = $("#date2").val();
		var _cid = $("#cid").val();
		if(
			_date1 == ""
			|| _date2 == ""
			|| _cid == ""
			){
			alert("日付・顧客を選択してください。");
			return false;
		}
		var _url = location.href;
		var _data = {"flg":"download","cid":_cid,"date1":_date1,"date2":_date2};
		$.ajax({
			type:"post",
	        url: _url,
	        data: _data,
	        success: function( data ) {
console.log(data);
				location.href=_url+"?flg=xls"
	        }
	    });
		
		return false;
	});
	
	$(".loading").hide();
	//画面した固定
	$(this).btm();
	$(window).resize(function(){
		$(this).btm();
	});

	//顧客選択
	$(".chg").change(function(){
		$(".loading").show();
		var _url = location.href;
		var _cid = $("#cid").val();
		if(_cid == ""){
			return false;
		}
		var _date1 = $("#date1").val();
		var _date2 = $("#date2").val();

		var _html = "";
		$("#testlist").html(_html);
		if(!_cid) return false;

		var _data = {"flg":"on","cid":_cid,"date1":_date1,"date2":_date2};
		
		$.ajax({
			type:"post",
	        url: _url,
	        data: _data,
	        success: function( data ) {
				$(".loading").hide();
console.log(data);
				//$("#testsid option").remove();
	            var json = $.parseJSON(data);
				_html = "<table class='tbl'>";
				_html += "<tr>";
				_html += "<th>検査名</th>";
				_html += "<th>受検数</th>";
				_html += "<th>受検総数</th>";
				_html += "</tr>";
				jQuery.each(json, function(key,val) {
					_html += "<tr>";
					_html += "<td>"+val.name+"</td>";
					_html += "<td class='tright'>"+val.c+"</td>";
					_html += "<td class='tright'>"+val.c2+"</td>";
					_html += "</tr>";
				});
				_html += "</table>";
				$("#testlist").html(_html);

	        }
	    });

	});
});
$.fn.btm = function(){
	var _ht = $(window).height()-350;
	$(".buttom").css("margin-top",_ht+"px");
}

//-->
</script>
<?PHP
include_once("include_footer.php");
?>
