<?PHP
if($_COOKIE[ 'lang' ] == "ch" ){
	$str1 = "顾客管理画面";
	$str2 = "顾客企業一覽";
	$str3 = "檢查一覽";
	$str4 = "通知信息";
	$str5 = "檢查登記";
	$str6 = "企业信息变更";
	$str7 = "下载";
	$str8 = "检查检索条件";
	$str9 = "姓名";
	$str10 = "接受检查日";
	$str11 = "检索";
	$str12 = "前30件";
	$str13 = "下面30件";
	$str14 = "检查名";
	$str15 = "检查实施期间";
	$str16 = "接受检查的人数";
	$str17 = "处理数";
	$str18 = "剩余数";
	$str19 = "接受检查<br />状況";
	$str20 = "机能";
	$str21 = "电子邮件通知功能";
	$str22 = "備忘錄1";
	$str23 = "備忘錄2";

}else{
	$str1 = "顧客情報一覧画面";
	$str2 = "顧客企業一覧";
	$str3 = "検査一覧";
	$str4 = "お知らせ情報";
	$str5 = "検査登録";
	$str6 = "企業情報変更";
	$str7 = "ダウンロード";
	$str8 = "検査検索条件";
	$str9 = "氏名";
	$str10 = "受検日";
	$str11 = "検索";
	$str12 = "前の30件";
	$str13 = "次の30件";
	$str14 = "検査名";
	$str15 = "検査実施期間";
	$str16 = "受検<br />者数";
	$str17 = "処理数";
	$str18 = "残数";
	$str19 = "受検<br />状況";
	$str20 = "機能";
	$str21 = "メール<br />お知らせ機能";
	$str22 = "メモ1";
	$str23 = "メモ2";
	$str24 = "受検ステータス";
}



$css1 = "list";
$title = "AMS:".$str2;
$js = array("list");
$time = true;

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
				"/index/ptn/".$ptid,
				$str2
			),
			array(
				"",
				$str3
			),
		);
}
if($basetype == 2){
	$pan = array(

			array(
				"",
				$str3
			),
		);
}
include_once("include_title.php");
?>

<?PHP
		if(count($info)){
?>
			<ul id="infoBox">
				<li><h3>■<?=$str4?></h3></li>
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


		<div id="leftBases">
			<ul>

<?php if($basetype != 3){ ?>
				<li><a href="/index/reg/"><?=$str5?></a></li>
<?PHP } ?>
				<li><a href="/index/chg/"><?=$str6?></a></li>

<?php if($basetype != 2){ ?>
				<li><a href="/index/download/"><?=$str7?></a></li>
<?PHP } ?>
<?php if($basetype == 1){ ?>
				<li><a href="/index/reg/row/">ROWデータ一括登録</a></li>
<?PHP } ?>

<?php if($basetype != 3){ ?>
				<li><a href="/index/wt/">重み付けマスタ登録</a></li>
<?PHP } ?>
<?php if($basetype != 3){ ?>
                                <?php if($cdata[0][ 'exam_pattern' ] == 1): ?>
				<li><a href="/index/inspection/">受検者傾向確認</a></li>
                                <?php endif;?>
<?PHP } ?>

<?php if($csTestBtn == 1 && $ptTestBtn == 1){ ?>
				<li><a href="/index/exam/">検査申込</a></li>
<?PHP } ?>
			</ul>
		</div>


		<!--検索条件-->
<?php
	if($basetype ==1 || $basetype == 3){
?>
		<div id="searchBox">
			<form action="/index/search/" name="sform" method="POST">
			<h3>■ <?=$str8?></h3>
			<ul>
				<li>ID：<input type="text" name="exam_id" value="<?=$_REQUEST[ 'exam_id' ]?>" ></li>
				<li><?=$str9?>：<input type="text" name="kana" value="<?=$_REQUEST[ 'kana' ]?>" ></li>
				<li><?=$str24?>：
					<select name="exam_state" value="<?=$_REQUEST[ 'exam_state' ]?>" id="exam_state" >
						<option value="selected">-</option>
						<option value="<?=$_REQUEST[ 'exam_state_1' ]?>">受検済み</option>
						<option value="<?=$_REQUEST[ 'exam_state_2' ]?>">受検中</option>
					</select>
				</li>
			</ul>
			<br clear=all />
			<ul>
				<li><?=$str10?>：
					<input type="text" class="datepicker"   name="datepic"  value="<?=$_REQUEST[ 'datepic' ]?>"  id="datepicker" > ～
					<input type="text" class="datepicker2"   name="datepic2" value="<?=$_REQUEST[ 'datepic2' ]?>" id="datepicker2">
				</li>
				<li><?=$str22?>：<input type="text" name="memo1" value="<?=$_REQUEST['memo1']?>"></li>
				<li><?=$str23?>：<input type="text" name="memo2" value="<?=$_REQUEST['memo2']?>"></li>
				<input type="submit" id="search" value="<?=$str11?>" class="button2">
			</ul>
			</form>
		</div>
		<br clear=all />
<?PHP
	}
?>

<?PHP
	$back = $sec-1;
	if($back >= 0){
		$backP = '<li><a href="/index/list/'.$back.'" >'.$str12.'</a></li>';
	}else{
		$backP = '<li class="dis">'.$str12.'</li>';
	}
	$next = $sec+1;
	if($next <= $ceil){
		$nextP = '<li><a href="/index/list/'.$next.'/" >'.$str13.'</a></li>';
	}else{
		$nextP = '<li class="dis">'.$str13.'</li>';
	}
?>

		<ul class="pager">
			<?=$backP?>
			<?=$nextP?>
		</ul>
		<br clear=all />
		<table id="table">
			<tr>
				<th class="w180" ><?=$str14?></th>
				<th class="w180" rowspan=2 ><?=$str15?></th>
				<th rowspan=2 ><?=$str16?></th>
				<th rowspan=2 ><?=$str17?></th>
				<th rowspan=2 ><?=$str18?></th>
				<th rowspan=2 class="w80" ><?=$str19?></th>
				<th style="width:440px;" rowspan=2><?=$str20?></th>
<?PHP
			if($basetype == 1 || $basetype == 3 ){
?>
				<th rowspan=2 class="w100"><?=$str21?></th>

<?PHP
			}
?>
    <?PHP if($basetype == 1  ){ ?>
        <th rowspan=2 class="w100">PDFログ</th>
        <?PHP } ?>
			</tr>
			<tr>
				<th><input type="text" id="searchText" value="" class="w100"></th>

			</tr>
			<tbody id="tbody">
			</tbody>
		</table>
		<div id="loading"></div>
		<input type="hidden" id="pages" value="<?=$sec?>" >
		<br clear=all />
		<ul class="pager">
			<?=$backP?>
			<?=$nextP?>
		</ul>
		<br clear=all />

	</div>
<?PHP include_once("include_footer_name.php"); ?>
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
<?PHP include_once("include_footer.php"); ?>
