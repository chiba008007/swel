<?PHP
$title = "AMS:添削画面";
$time = true;

include_once("include_header.php");
?>

<div id="main">

	<div id="contents">
<?PHP
include_once("include_title.php");
?>

	<h3>添削画面</h3>
	<span style="color:red;"><?=$errmsg?></span>
	<p class="mg" >▼設問カテゴリ選択</p>
	<form action="" method="POST" name="form">
	<select name="tensaku_id" id="tensaku_id">
<?PHP
		foreach($alist as $key=>$val){
?>
			<option value="<?=$key?>"><?=$val?></option>
<?PHP
		}
?>
	</select>
	
	<p class="mg" >■入力内容</p>
	<div id="inputBox" class="divBox">&nbsp;</div>
	<hr class="hr" />
	<p class="mg" >▼添削者入力ボックス</p>
	<textarea name="answer_text" id="answer_text" class="textarea" <?=$readonly?> ></textarea>
	<p class="mg" >▼アドバイス</p>
	<textarea name="answer_advice_text" id="answer_advice_text" class="textarea" <?=$readonly?>></textarea>
	<p class="mg" >▼得点</p>
	
	内　　容： <select name="note_point" id="note_point" class="selectPoint" <?=$readonly?>>
<?PHP
		for($i=1;$i<=10;$i++){
?>
		<option value="<?=$i?>"><?=$i?></option>
<?PHP
		}
?>
	</select><br /><br />
	ロジック：
	<select name="logic_point" id="logic_point" class="selectPoint" <?=$readonly?> >
<?PHP
		for($i=1;$i<=10;$i++){
?>
		<option value="<?=$i?>"><?=$i?></option>
<?PHP
		}
?>
	</select>
	
	<div class="center">
		<input type="button" id="print" value="印刷" class="button" <?=$readonly?> >
<?PHP
	if(!$readonly){
?>
		<input type="button" id="save" value="保存" class="button" <?=$readonly?> >
		<input type="button" id="collect" value="添削" class="button" <?=$readonly?> >
<?PHP
	}
?>
		<input type="hidden" name="exam_id" id="exam_id"  value="<?=$first?>">
		<input type="hidden" name="testgrp_id" id="testgrp_id"  value="<?=$sec?>">
		<input type="hidden" name="test_id" id="test_id"  value="<?=$third?>">
		<input type="hidden" name="printflg" id="printflg"  value="">

	</div>
	</form>
	<br clear=all />
	</div>
	
<?PHP
include_once("include_footer_name.php");
?>
</div>
<?PHP
include_once("include_footer.php");
?>
