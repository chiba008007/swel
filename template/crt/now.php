<?PHP
include_once("include_header.php");
?>


<?PHP
		foreach($rlt as $key=>$val){
?>
			<div class="title f18" ><?=$alist[ $val[ 'tensaku_id' ] ]?></div>
			<?PHP if($val[ 'question_text' ]){ ?>
			<table class="printTbl">
				<tr>
					<td>
					<p class="names">【あなたの回答　1回目】</p>
					<?=nl2br($val[ 'question_text' ])?>
					</td>
				</tr>
				<tr>
					<td>
					<p class="names">【記入にあたり悩んだ点】</p>
					<?=nl2br($val[ 'worry_text' ])?>
					<p class="names">【相談事項】</p>
					<?=nl2br($val[ 'advice_text' ])?>
					</td>
				</tr>
				<tr>
					<td>
					<p class="names">【添削コメント】</p>
					<?=nl2br($val[ 'answer_text' ])?>
					<hr />
					<p class="names">【添削アドバイス】</p>
					<?=nl2br($val[ 'answer_advice_text' ])?>
					<hr />
					<p class="names">【ポイント】</p>
					内容：<?=$val[ 'note_point' ]?>　
					形式：<?=$val[ 'logic_point' ]?>　
					熱意：<?=$val[ 'heart_point' ]?>　
					アピール力：<?=$val[ 'apeal_point' ]?>　
					誠実さ：<?=$val[ 'selias_point' ]?>　

					</td>
				</tr>
			</table>
			<div class="memos">【メモ欄】</div>
			<?PHP } ?>
			<?PHP if($val[ 'question_text2' ]){ ?>
			<table class="printTbl">
				<tr>
					<td>
					<p class="names">【あなたの回答　2回目】</p>
					<?=nl2br($val[ 'question_text2' ])?>
					</td>
				</tr>
				<tr>
					<td>
					<p class="names">【記入にあたり悩んだ点】</p>
					<?=nl2br($val[ 'worry_text2' ])?>
					<p class="names">【相談事項】</p>
					<?=nl2br($val[ 'advice_text2' ])?>
					</td>
				</tr>
				<tr>
					<td>
					<p class="names">【添削コメント】</p>
					<?=nl2br($val[ 'answer_text_2' ])?>
					<hr />
					<p class="names">【添削アドバイス】</p>
					<?=nl2br($val[ 'answer_advice_text_2' ])?>
					<hr />
					<p class="names">【ポイント】</p>
					内容：<?=$val[ 'note_point_2' ]?>　
					形式：<?=$val[ 'logic_point_2' ]?>　
					熱意：<?=$val[ 'heart_point_2' ]?>　
					アピール力：<?=$val[ 'apeal_point_2' ]?>　
					誠実さ：<?=$val[ 'selias_point_2' ]?>　
					</td>
				</tr>
			</table>
			<div class="memos">(メモ欄)</div>
			<?PHP } ?>
			<?PHP if($val[ 'question_text3' ]){ ?>
			<table class="printTbl">
				<tr>
					<td>
					<p class="names">【あなたの回答　3回目】</p>
					<?=nl2br($val[ 'question_text3' ])?>
					</td>
				</tr>
				<tr>
					<td>
					<p class="names">【記入にあたり悩んだ点】</p>
					<?=nl2br($val[ 'worry_text3' ])?>
					<p class="names">【相談事項】</p>
					<?=nl2br($val[ 'advice_text3' ])?>
					</td>
				</tr>
				<tr>
					<td>
					<p class="names">【添削コメント】</p>
					<?=nl2br($val[ 'answer_text_3' ])?>
					<hr />
					<p class="names">【添削アドバイス】</p>
					<?=nl2br($val[ 'answer_advice_text_3' ])?>
					<hr />
					<p class="names">【ポイント】</p>
					内容：<?=$val[ 'note_point_3' ]?>　
					形式：<?=$val[ 'logic_point_3' ]?>　
					熱意：<?=$val[ 'heart_point_3' ]?>　
					アピール力：<?=$val[ 'apeal_point_3' ]?>　
					誠実さ：<?=$val[ 'selias_point_3' ]?>　

					</td>
				</tr>
			</table>
			<div class="memos">【メモ欄】</div>
			<?PHP } ?>
			<?PHP if($val[ 'question_text4' ]){ ?>
			<table class="printTbl">
				<tr>
					<td>
					<p class="names">【あなたの回答　4回目】</p>
					<?=nl2br($val[ 'question_text4' ])?>
					</td>
				</tr>
				<tr>
					<td>
					<p class="names">【記入にあたり悩んだ点】</p>
					<?=nl2br($val[ 'worry_text4' ])?>
					<p class="names">【相談事項】</p>
					<?=nl2br($val[ 'advice_text4' ])?>
					</td>
				</tr>
				<tr>
					<td>
					<p class="names">【添削コメント】</p>
					<?=nl2br($val[ 'answer_text_4' ])?>
					<hr />
					<p class="names">【添削アドバイス】</p>
					<?=nl2br($val[ 'answer_advice_text_4' ])?>
					<hr />
					<p class="names">【ポイント】</p>
					内容：<?=$val[ 'note_point_4' ]?>　
					形式：<?=$val[ 'logic_point_4' ]?>　
					熱意：<?=$val[ 'heart_point_4' ]?>　
					アピール力：<?=$val[ 'apeal_point_4' ]?>　
					誠実さ：<?=$val[ 'selias_point_4' ]?>　
					</td>
				</tr>
			</table>
			<div class="memos">【メモ欄】</div>
			<?PHP } ?>
<?PHP
		}
?>

	<div class="printbutton">
		<input type="button"  value="閉じる" onClick="window.close(); return false;">
		<input type="button"  value="印刷" onclick="window.print();" >
	</div>

<?PHP
include_once("include_footer.php");
?>
