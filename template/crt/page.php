<?PHP
include_once("include_header.php");
?>
<div class="right" style="padding:30px;">
	<a href="/crt/<?=$first?>/logout/" id="close">閉じる</a>
	<div style="color:red;">※添削を終了する場合は上記の閉じるボタンを押してください。</div>
</div>
	<form action="/crt/<?=$first?>" method="POST" >
<!--
		<ul id="tensaku-menu">
<?PHP
	for($i=1;$i<=4;$i++){
		$disable = "DISABLED";
		$class = "disable";
		if($i <= $tensaku_number){
			$disable = "";
			$class = "";
		}
?>
			<li><a href="javascript:void(0);" id="tno-<?=$i?>" class="tno <?=$class?>" <?=$disable?> >添削<?=$i?></a></li>
<?PHP
	}
?>
		</ul>
-->

		<ul id="tensaku-tab">
<?PHP
	for($i=1;$i<=4;$i++){
		$disable = "DISABLED";
		$class = "disable";
		if($i <= $tensaku_number){
			$disable = "";
			$class = "";
		}
?>

<?PHP
			if($disable){
?>
				<li><a href="javascript:void(0);" class="<?=$class?>" <?=$disable?> >添削<?=$i?></a></li>
<?PHP
			}else{
?>

				<li><a href="javascript:void(0);" id="tno-<?=$i?>" class="tno <?=$class?>" >添削<?=$i?></a></li>
<?PHP
			}
?>
<?PHP
	}
?>
		</ul>

	<br clear=all />
<?PHP
	if(count($errmsg)){
?>
		<div style="background-color:#ffe4c4;margin-top:10px;padding:5px;">
<?PHP
		foreach($errmsg as $k=>$v){
?>
			<span style="color:red;"><?=$v?></span><br />
<?PHP
		}
?>
		</div>
<?PHP
	}
?>
	<div id="notes" >
	<div id="tensaku-left">

	<h3>添削画面</h3>
<!--
	<select name="tensaku_id" id="tensaku_id">
<?PHP
	foreach($qlist as $key=>$val){
		$sel = "";
		if($key == $_REQUEST[ 'tensaku_id' ]){
			$sel = "SELECTED";
		}
		$class="";
		$sumi = "";
		if($qlistFin[ $key ] == 1){
			$class="red";
			$sumi = "[済]";
		}
?>
		<option value="<?=$key?>" <?=$sel?> class="<?=$class?>" ><?=$sumi?><?=$val?></option>
<?PHP
	}
?>
	</select>
-->

<?PHP
	$no = 1;
	foreach($qlist as $key=>$val){
		$sel = "";

		$check = "";
		if($_REQUEST[ 'tensaku_id' ] == $key){
			$sel = "checked";
			$check = "checked";
		}
		if(!$_REQUEST[ 'tensaku_id' ] && $no == 1){
			$sel = "checked";
			$check = "checked";
		}

		$class="";
		$sumi = "";
		if($qlistFin[ $key ] == 1){
			$class="red";
			$sumi = "<span style='color:red;'>[済]</span>";

		}
?>
		<p class="ques-menu <?=$check?>"  id="p-<?=$key?>" >
			<label >
				<input type="radio" name="tensaku_id"  value="<?=$key?>" id="tensaku_id-<?=$key?>" <?=$sel?> style="display:none;" class="radioTid">
				<?=$sumi?><?=$val?>
			</label>
		</p>
<?PHP
		$no++;
	}
?>


	</div>
	<div id="tensaku-right">
	選択質問<br />
	<div id="tensaku-title"></div>
<?PHP
	for($i=1;$i<=4;$i++){
?>
	<div id="tensaku_<?=$i?>" class="tensaku">
		<h2><?=$i?>回目</h2>
		<div class="mg inline in<?=$i?>" id="question_<?=$i?>" >▼内容</div>
		<div class="mg inline in<?=$i?>" id="worry_<?=$i?>" >▼記入にあたり悩んだ点</div>
<!--
		<div class="mg inline in<?=$i?>" id="advice_<?=$i?>" >▼相談事項</div>
-->
		<div class="boxes">
			<div id="question_text_<?=$i?>" class="texts<?=$i?>" ></div>
			<div id="worry_text_<?=$i?>"  class="texts<?=$i?>" ></div>
			<div id="advice_text_<?=$i?>" class="texts<?=$i?>" ></div>
		</div>

<?PHP
		if($i < $tensaku_number){
?>
		<h3>▼回答</h3>
		<div id="answer_text_<?=$i?>" class="ans_box" ></div>

		<h3>▼アドバイス</h3>
		<div id="answer_advice_text_<?=$i?>" class="ans_box" ></div>
		<h3>▼得点</h3>
		<dl class="point">
			<dt>１．内容（情景が浮かぶか、適切か、ありきたりのことではないか、その人の特徴を表すものか）</dt>
			<dd><input type="text" id="note_point_<?=$i?>" value="" readonly class="read" >　ポイント</dd>
		</dl>
		<dl class="point">
			<dt>２．形式（分量は適切か、文章を書く場合の法則にしたがっているか（1マス開けるなど）,読みやすいか、誤字脱字はないか）</dt>
			<dd><input type="text" id="logic_point_<?=$i?>" value="" readonly class="read" >　ポイント</dd>
		</dl>
		<dl class="point">
			<dt>３．熱意（気迫が伝わってくるか、何としてでも公務員になりたいという意欲は伝わるか）</dt>
			<dd><input type="text" id="heart_point_<?=$i?>" value="" readonly class="read" >　ポイント</dd>
		</dl>
		<dl class="point">
			<dt>４．アピール力（内容と形式に関連するが、自分を表現できている内容か、読み手の興味を引く内容か、粘りや頑張りが伝わる内容か、他人がしていない経験があるか）</dt>
			<dd><input type="text" id="apeal_point_<?=$i?>" value="" readonly class="read" >　ポイント</dd>
		</dl>
		<dl class="point">
			<dt>５．誠実さ（内容全体から誠実さが伝わるか、嘘がないか、表面的な内容じゃないか、信用できる人物か）</dt>
			<dd><input type="text" id="selias_point_<?=$i?>" value="" readonly class="read" >　ポイント</dd>
		</dl>
		
<?PHP
		}else{
?>

		<h3>▼回答</h3>
		<textarea name="answer_text_<?=$i?>"   id="answer_text_<?=$i?>" class="textarea" ></textarea>
		<h3>▼アドバイス</h3>
		<textarea name="answer_advice_text_<?=$i?>" id="answer_advice_text_<?=$i?>"  class="textarea" ></textarea>
		<h3>▼得点</h3>
		<dl class="point">
			<dt>１．内容（情景が浮かぶか、適切か、ありきたりのことではないか、その人の特徴を表すものか）</dt>
			<dd>
				<select name="note_point_<?=$i?>"  id="note_point_<?=$i?>">
					<option value=""></option>
<?PHP
					for($pt=1;$pt<=5;$pt++){
?>
						<option value="<?=$pt?>"><?=$pt?></option>
<?PHP
					}
?>
				</select>
			</dd>
		</dl>
		<dl class="point">
			<dt>２．形式（分量は適切か、文章を書く場合の法則にしたがっているか（1マス開けるなど）,読みやすいか、誤字脱字はないか）</dt>
			<dd>
				<select name="logic_point_<?=$i?>" id="logic_point_<?=$i?>" >
					<option value=""></option>
<?PHP
					for($pt=1;$pt<=5;$pt++){
?>
						<option value="<?=$pt?>"><?=$pt?></option>
<?PHP
					}
?>
				</select>
			</dd>
		</dl>

		<dl class="point">
			<dt>３．熱意（気迫が伝わってくるか、何としてでも公務員になりたいという意欲は伝わるか）</dt>
			<dd>
				<select name="heart_point_<?=$i?>" id="heart_point_<?=$i?>" >
					<option value=""></option>
<?PHP
					for($pt=1;$pt<=5;$pt++){
?>
						<option value="<?=$pt?>"><?=$pt?></option>
<?PHP
					}
?>
				</select>
			</dd>
		</dl>

		<dl class="point">
			<dt>４．アピール力（内容と形式に関連するが、自分を表現できている内容か、読み手の興味を引く内容か、粘りや頑張りが伝わる内容か、他人がしていない経験があるか）</dt>
			<dd>
				<select name="apeal_point_<?=$i?>" id="apeal_point_<?=$i?>" >
					<option value=""></option>
<?PHP
					for($pt=1;$pt<=5;$pt++){
?>
						<option value="<?=$pt?>"><?=$pt?></option>
<?PHP
					}
?>
				</select>
			</dd>
		</dl>


		<dl class="point">
			<dt>５．誠実さ（内容全体から誠実さが伝わるか、嘘がないか、表面的な内容じゃないか、信用できる人物か）</dt>
			<dd>
				<select name="selias_point_<?=$i?>" id="selias_point_<?=$i?>" >
					<option value=""></option>
<?PHP
					for($pt=1;$pt<=5;$pt++){
?>
						<option value="<?=$pt?>"><?=$pt?></option>
<?PHP
					}
?>
				</select>
			</dd>
		</dl>



<?PHP
		}
?>
	</div>
<?PHP
	}
?>
	</div>
	</div><!--#notes-->
	<br clear=all />
<?PHP
	if($tensaku_number == 5){
?>
	<input type="hidden" name="tensaku_number" id="tensaku_number" value="1">
	<div class="clearfix buttonArea">&nbsp;</div>
<?PHP
	}else{
?>
	<input type="hidden" name="tensaku_number" id="tensaku_number" value="<?=$tensaku_number?>">
	<div class="clearfix buttonArea">
		<div id="printbox">
			<ul>
				<li><a href="javascript:void(0);" class="printpage" id="now">現ページ印刷画面</a></li>
				<li><a href="javascript:void(0);" class="printpage" id="all" >全ページ印刷画面</a></li>
			</ul>
		</div>
		<input type="submit" name="save" value="保存" class="button">
		<input type="submit" name="finish" id="finish"  value="完了" class="button <?=$finDisable?>" <?=$finDisable?>>
		<input type="button"  value="ページ印刷" class="button w150" id="print">

	</div>
<?PHP
	}
?>
	<br clear=all />
	</form>
	<script type="text/javascript">
	<!--
	$(function(){
		$("#close").click(function(){
			var url = location.href;
			$.ajax({
				url: "./logout/",
				cache: false,
				success: function(data){
					window.close();
					return false;
				}
			});
			return false;
		});
	});
	//-->
	</script>
<?PHP
include_once("include_footer.php");
?>
