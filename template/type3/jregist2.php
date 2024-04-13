<?PHP
$css1 = "reg";
$title = "AMS:検査新規登録画面";
$js = array("reg");
$scroll = true;
include_once("include_header.php");
$pan = array(
			array("/index/ptn/".$ptid,"顧客企業一覧"),
			array("/","検査一覧"),
			array("","データ登録"),
		);
if($basetype == 2){
	$pan = array(
			array("/","検査一覧"),
			array("","データ登録"),
		);
}
?>
<div id="main">
	<div id="contents">
<?PHP include_once("include_title.php"); ?>
		<div id="dataTitle">ファイルアップロード</div>
		<br clear=all />
		<form method="post" action="" enctype="multipart/form-data" class="pd10" >
<?PHP if($errmsg){ ?>
<div style="color:red;"><?=$errmsg?></div>
<?PHP } ?>
		<input type="file" name="files" style="height:30px;width:250px;" >
		<input type="submit" name="upload" value="登録" class="button1 w100" id="regist" >
		<input type="button"  value="テンプレート" class="button1 w100" id="template">
		</form>
		<form action="" method="POST" name="tempform" >
			<input type="hidden" name="tempflg" value="on" >
		</form>

<?PHP if($msg){ ?>
<br clear=all />
<div style="color:green;border:1px solid green;padding:10px;"><?=$msg?></div>
<?PHP } ?>

		<br clear=all />
		<ul id="pager">
<?PHP if($_REQUEST[ 'page' ] ){ ?>
		<li class=""><a href="/index/jregist/<?=$sec?>/?page=<?=$_REQUEST[ 'page' ]-1 ?>" >前の<?=$limit?>件</a></li>
<?PHP }else{ ?>
		<li class="dis">前の<?=$limit?>件</li>
<?PHP } ?>


<?PHP if($ceil > $_REQUEST[ 'page' ]+1 ){ ?>
		<li class=""><a href="/index/jregist/<?=$sec?>/?page=<?=$_REQUEST[ 'page' ]+1 ?>" >次の<?=$limit?>件</a></li>
<?PHP }else{ ?>
		<li class="dis">次の<?=$limit?>件</li>
<?PHP } ?>
		</ul>
		<br clear=all />

		<table id="table">
			<tr>
				<th style="width:5px;">連番</th>
				<th>部署</th>
				<th>役職</th>
				<th>社員番号</th>
				<th>姓名(かな)</th>
				<th>メールアドレス</th>
				<th>生年月日</th>
				<th style="width:230px;">機能</th>
			</tr>
<?PHP if(count($jud)){ foreach($jud as $key=>$val){ ?>
			<tr>
				<td  ><?=$val[ 'num' ]?></td>
				<td  ><?=$val[ 'busyo' ]?></td>
				<td  ><?=$val[ 'yakusyoku' ]?></td>
				<td  ><?=$val[ 'empnum' ]?></td>
				<td  nowrap ><?=$val[ 'sei' ]?> <?=$val[ 'mei' ]?><br />(<?=$val[ 'sei_kana' ]?> <?=$val[ 'mei_kana' ]?>)</td>
				<td  ><?=$val[ 'mail' ]?></td>
				<td  ><?=$val[ 'birth' ]?></td>
				<td >
					<input type="button" id="ed-<?=$val[ 'id' ]?>" class="edit button1" value="編集">
					<input type="button" id="del-<?=$val[ 'id' ]?>" class="delete button1" value="削除">
				</td>
			</tr>
<?PHP }} ?>
		</table>
	</div>
<?PHP include_once("include_footer_name.php"); ?>
</div>
<style type="text/css">
<!--
	.button1{
		padding:5px !important;
	}
	.pd10{
		padding:10px;
	}
	.w100{
		width:100px;
	}
	#table td{
		text-align:left !important;
	}
	#table td.center{
		text-align:center !important;
	}


	dt.judge{
		font-weight:bold;
		padding-bottom : 10px;
		padding-left : 10px;
		width : 100px;
		float : left;/* 左に寄せる */
		clear : both;/* フロートの解除 */
	}

	dd.judge{
	  padding-left : 10px;
	  padding-right : 10px;
	  padding-bottom : 10px;
	  width : 300px;
	}

//-->
</style>
<script type="text/javascript" >
<!--
$(function(){
	$("#regist").click(function(){
		if(confirm("データの全更新を行います。\n既に登録済みのデータは削除されます。")){
			return true;
		}else{
			return false;
		}
	});
	$("#template").click(function(){
		document.tempform.submit();
	});
	$(".edit").click(function(){
		var _id = $(this).attr("id");
		var _ex = _id.split("-");
		location.href="/index/jregist/<?=$sec?>/"+_ex[1];
	});

	$(".delete").click(function(){
		var _id = $(this).attr("id");
		var _ex = _id.split("-");
		if(confirm("削除を行います。削除したデータは戻せません。")){
			location.href="/index/jregist/<?=$sec?>/delete/"+_ex[1];
		}else{
			return false;
		}
	});

});
//-->
</script>
<?PHP include_once("include_footer.php"); ?>
