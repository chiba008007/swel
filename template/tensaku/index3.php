<?PHP
$title = "AMS:添削完了画面";
$time = true;

include_once("include_header.php");
?>

<div id="main">

	<div id="contents">
<?PHP
include_once("include_title.php");
?>
	<div id="dataTitle">
		<?=$sitename?>
	</div>
	<form action="" method="POST" name="form">

	<div id="overflow">
		<table>
<?PHP
		foreach($module as $key=>$val){
			$chk = "";
			if($key == $qkey) $chk = "CHECKED";
?>
			<tr>
				<td><input type="radio" name="ques" value="<?=$key?>" <?=$chk?> id="ques_<?=$key?>" class="ques" ></td>
				<td>
					<label for="ques_<?=$key?>" ><?=$val["question"]?></label>

				</td>
			</tr>
<?PHP
		}
?>
		</table>
	</div>

	<div class="half">
		<div class="lefts"><h2>■回答 </h2></div><br clear=all />
		<div><?=nl2br($ans[ 'question' ])?></div>
	</div>
	<div class="half">
		<div class="lefts"><h2>■添削 </h2></div><br clear=all />
		<div><?=nl2br($ans[ 'answer' ])?></div>
	</div>
	<br clear=all />
	<div class="mgtop">
		<div class="lefts"><h2>■アドバイス </h2></div><br clear=all />
		<div><?=nl2br($ans[ 'advice_text' ])?></div>
		<div><span class="mgr10">内容：<?=$ans[ 'text_point' ]?></span><span>ロジック：<?=$ans[ 'logic_point' ]?></span></div>
	</div>
	<br clear=all />

	<div class="half">
		<div class="lefts"><h2>■完成版 </h2></div><br clear=all />
		<div><?=nl2br($ans[ 'comp_question' ])?></div>
	</div>
	<div class="half">
		<div class="lefts"><h2>■完成版添削 </h2></div><br clear=all />
		<div><?=nl2br($ans[ 'comp_answer' ])?></div>
	</div>
	<br clear=all />
	<div class="mgtop">
		<div class="lefts"><h2>■完成版アドバイス </h2></div><br clear=all />
		<div><?=nl2br($ans[ 'comp_advice' ])?></div>
	</div>
	<br clear=all />
	<div class="center">
		<input type="button" value="印刷" id="print" class="button">
		<input type="hidden" id="pdfFlg" name="pdfFlg" value="" >
	</div>
		<br clear=all />
	

	</div>
		
		<input type="hidden" id="scrol" name="scrol" value="<?=$scrol?>" >

	</form>
		<input type="hidden" id="saveFlg" value="" >
		<input type="hidden" id="qkey" value="<?=$qkey?>" >
		<input type="hidden" id="first" value="<?=$first?>" >
		<input type="hidden" id="sec"   value="<?=$sec?>"   >
		<input type="hidden" id="third" value="<?=$third?>" >

<?PHP
include_once("include_footer_name.php");
?>
</div>
<?PHP
include_once("include_footer.php");
?>
