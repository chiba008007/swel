<?PHP
$css1 = "csvUp";
$title = "AMS:検査削除画面";
$js = array("csvUp");
//$time = true;

include_once("include_header.php");
?>
<style type="text/css">
label{
    margin-right:20px;
}
label input{
    width:auto !important;
}
div.redbox{
    border:1px solid #000;
    padding:10px;


}
div.redbox p{
    color:#ff0000;
}
div.errmsg{
    padding:10px;
    border:1px solid #000;
    color:red;
    margin-top:10px;
}

div#hist{
    border:1px bottom #000 !mportant;
    text-align:left;
    font-size:18px;
}
div.area{
    margin:20px 0px;
}

table{
  border-collapse: collapse;
  border-spacing: 0;
  table-layout: fixed;
  border:solid 1px #ddd;
}
table th{
  text-align: center;
  padding: 7px;
  border:solid 1px #ddd;
}
table td{
  text-align: center;
  padding: 7px;
  border:solid 1px #ddd;
}
ul.l li{
    color:#ff0000;
    margin-left:20px;
}
dl dd,dt{
	color:#ff0000;
	float:left;
}
dl dt{
    width:80px;
}
dl dt{
   clear:both;
}
</style>
<script type="text/javascript">
$(function(){
    $("[name=upload]").click(function(){
		var _filename = $("[name='upfile']").val();
		var _pos= $("[name='upfile']").val().lastIndexOf('.');
		if(_filename.slice(_pos + 1) != "csv"){
			alert("CSVファイルのみアップロード可能です。");
			return false;
		}
		
		
		var _rdo = $("input[name=type]:checked").val();
		if(!_rdo){
			alert("取込方法の選択を選択してください。");
			return false;
		}
    	return true;
    });
});
</script>
<div id="main">

	<div id="contents">
<?PHP
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
				"/index/data/".$sec,
				"受検結果一覧"
			),
			array(
				"",
				"CSVアップロード"
			),
		);

if($basetype == 3){
	$pan = array(

			array(
				"/index/data/".$sec,
				"受検結果一覧"
			),
			array(
				"",
				"テスト更新"
			)
		);
}



include_once("include_title.php");
?>
	<div id="dataTitle">CSVアップロード</div>
	<FORM enctype="multipart/form-data" action="" method="POST" >
<?PHP
if($type == 44 || $tensaku > 0 ){
?>
	<p>一番左の列から、番号、ID、氏名、ふりがな、生年月日,メモ1,メモ2,添削者名,添削者メールアドレスの順に記述されたCSVファイルを指定してください。<br />
 詳しくは、「csvデータ登録手順」ボタンを選択してください。 </p>
<?PHP
}else{
    $check1="";
    $check2="";
    if($_REQUEST[ 'type' ] == 1) $check1 = "CHECKED";
    if($_REQUEST[ 'type' ] == 2) $check2 = "CHECKED";

?>
<?php if($errmsg): ?><div class="errmsg"><?=$errcount?>件取込できませんでした。エラーファイルを確認してください。</div><?php endif; ?>
<div class="area">
	<p>■取込方法の選択（必須）</p>
	<label><input type="radio" name="type" value="1" <?=$check1?> />未受検者のみ変更</label>
	<label><input type="radio" name="type" value="2" <?=$check2?> />受検済み・受検中も対象とする</label>
</div>

	<div class="redbox">
		<p>※「受検済み・受検中も対象とする」を選んだ際の注意点</p><br />

			<dl>
				<dt>未受検者</dt><dd>:ID、名前、ふりがな、生年月日、メモ１、メモ２の変更が可能です。</dd>
				</dl><br /><br />
				<dl>
				<dt>受検中</dt><dd>:ID、名前、ふりがな、生年月日、メモ１、メモ２の変更が可能です。</dd>
				<dt>&nbsp;</dt><dd>:IDも変更されます。</dd>

			</dl>

		<br clear=all />
		<dl>
			<dt>受検済</dt><dd>:名前、ふりがな、生年月日、メモ１、メモ２の変更が可能です。</dd>
			<dt>&nbsp;</dt><dd> &nbsp;ID以外は変更されます。</dd>
		</dl><br clear=all />
	</div><br />
	<p>■取込ファイルについて</p>
	<p>一番左の列から、番号、ID、氏名、ふりがな、生年月日、メモ１、メモ２の順に記述されたCSVファイルを指定してください。</p>
	<div class="redbox">
		<p>※設定時の注意点</p>
        <ul class="l">
        	<li>一番左の番号がキーになります。IDは２０文字以内の半角英数で設定してください。アルファベットの大文字と小文字を区別しております。​</li>
        	<li>該当する番号にID、名前、ふりがな、生年月日、メモ１、メモ２を設定してください。</li>
        	<li>サイズ30KB以下、名前 ふりがなを入力の際は、姓と名の間にスペースを入力してください。</li>
        	<li>件数は300名以下です。</li>
        	<li>300名を超える場合は2回に分けるか、弊社に登録依頼をお願いします。</li>
		</ul>
	</div>
<?PHP
}
?>
		<div class="mg10">
		<INPUT name="upfile" type="file" >
		</div>
		<br />

		<INPUT type="button" value="戻る" class="button" id="back">
		<INPUT type="submit" value="アップロード" name="upload" class="button" >
	</FORM>
	</div>
	<br clear=all />
	<input type="hidden" id="sec" value="<?=$sec?>" >

		<br clear=all />

		<div id="hist">エラー履歴</div>
		<table>
			<tr>
				<th>取込日</th>
				<th>総件数</th>
				<th>未取込件数</th>
				<th>ファイル名</th>
			</tr>
			<?php foreach($errhist as $key=>$val):?>
			<tr>
				<td><?=$val[ 'regist_ts' ]?></td>
				<td><?=$val[ 'total' ]?></td>
				<td><?=$val[ 'errcount' ]?></td>
				<td><a href="/errexcel/<?=$val['filename'] ?>"><?=$val['filename'] ?></a></td>
			</tr>
			<?php endforeach; ?>
		</table>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
