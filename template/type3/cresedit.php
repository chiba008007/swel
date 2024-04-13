
<?php
	include_once("creshead.php");
?>
  <body  class="bg-light" >
	<div class="container">
		<h3 class="title">
		
		  <img src="/images/CReS.png" height="30" />
			CRES更新画面</h3>
		<hr />
	</div>
	<div class="container">
		<?php if($message):?>
			<p class="message"><?=$message?></p>
		<?php endif;?>
		<form action="/index/cresedit/<?=$sec?>/<?=$third?>" method="POST" >
			<p>※は必須項目です</p>
			<table class="table table-bordered">
				<tr>
					<th class="w200" >ID</th>
					<td><?=$data[ 'exam_id' ]?>
						<input type="hidden" name="exam_id" value="<?=$data[ 'exam_id' ]?>" />
					</td>
				</tr>
				<tr>
					<th class="w200" >名前※</th>
					<td>
						<div class="row">
							<div class="col-md-3">
								<input type="text" name="name1" value="<?=$name1?>" class="form-control" />
							</div>
							<div class="col-md-3">
								<input type="text" name="name2" value="<?=$name2?>" class="form-control" />
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th class="w200" >ふりがな※</th>
					<td>
						<div class="row">
							<div class="col-md-3">
								<input type="text" name="kana1" value="<?=$kana1?>" class="form-control" />
							</div>
							<div class="col-md-3">
								<input type="text" name="kana2" value="<?=$kana2?>" class="form-control" />
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th class="w200" >生年月日</th>
					<td>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-3">
										<input type="text" name="birth_year" value="<?=$year?>" class="form-control" />
									</div>
									<div class="col-md-1 pd0" >年</div>
									<div class="col-md-3">
										<select name="birth_month" class="form-control" >
											<?php for($i=1;$i<=12;$i++): 
												$sel = "";
												if($i==$month) $sel = "selected";
												?>
												<option value="<?=$i?>" <?=$sel?> ><?=$i?>月</option>
											<?php endfor;?>
										</select>
									</div>
									<div class="col-md-3">
										<select name="birth_day" class="form-control" >
										<?php for($i=1;$i<=31;$i++): 
											$sel = "";
											if($i==$day) $sel = "selected";
											?>
											<option value="<?=$i?>" <?=$sel?> ><?=$i?>日</option>
										<?php endfor;?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th class="w200" >性別</th>
					<td>
						<?php foreach($array_gender as $key=>$value):
							$check = ""; 
							if($gender == $key) $check = "checked";
							?>
							<input type="radio" name="gender" id="gender-<?=$key?>" value="<?=$key?>" <?=$check?> />
							<label for="gender-<?=$key?>"><?=$value?></label>
						<?php endforeach;?>
					</td>
				</tr>
				<?php
					$disabled = "";
					$bg = "";
					if($data[ 'status' ]){
						$disabled = "disabled";
						$bg = "bg-dark";
					}
				?>

				<tr>
					<th class="w200 <?=$bg?>" >IDの変更</th>
					<td class="<?=$bg?>">
						
						<label>
						<input type="checkbox" name="idedit" value="on" <?=$disabled?> >
						IDの変更を行う
						</label> 
						<?php if($data[ 'status' ] == 1):?>
							<span class="text-danger">変更不可</span>
						<?php endif;?>
					</td>
				</tr>
				<!--
				<tr>
					<th class="w200" >合否</th>
					<td>
						<input type="text" name="pass" value="<?=$pass?>" class="form-control" />
					</td>
				</tr>
				-->
				<tr>
					<th class="w200" >メールアドレス※</th>
					<td>
						<input type="text" name="mail" value="<?=$mail?>" class="form-control" />
					</td>
				</tr>
				

				<tr>
					<th class="w200" >期間※</th>
					<td>
						<div class="row">
							<div class="col-md-1">
								1回目
							</div>
							<div class="col-md-4">
								<?php if($exam_date1_status): ?>
									<?=$exam_date1?>
									<input type="hidden" name="sendplandate[1]" value="<?=$exam_date1?>" />
								<?php else:?>
									<input type="text" name="sendplandate[1]" value="<?=$exam_date1?>" class="form-control datepicker" />
								<?php endif;?>
								<input type="hidden" name="registed_sendplandate[1]" value="<?=$exam_date1?>" />
							</div>
						</div>
						<div class="row mt10">
							<div class="col-md-1">
								2回目
							</div>
							<div class="col-md-4">
							<?php if($exam_date2_status): ?>
								<?=$exam_date2?>
								<input type="hidden" name="sendplandate[2]" value="<?=$exam_date2?>" />
							<?php else:?>
								<input type="text" name="sendplandate[2]" value="<?=$exam_date2?>" class="form-control datepicker" />

							<?php endif;?>
							<input type="hidden" name="registed_sendplandate[2]" value="<?=$exam_date2?>" />
							</div>
						</div>
						<div class="row mt10">
							<div class="col-md-1">
								3回目
							</div>
							<div class="col-md-4">
							<?php if($exam_date3_status): ?>
								<?=$exam_date3?>
								<input type="hidden" name="sendplandate[3]" value="<?=$exam_date3?>" />
							<?php else:?>
								<input type="text" name="sendplandate[3]" value="<?=$exam_date3?>" class="form-control datepicker" />

							<?php  endif; ?>
							<input type="hidden" name="registed_sendplandate[3]" value="<?=$exam_date3?>" />
							</div>
						</div>


					<?php /* ?>
						<select name="term" class="form-control">
						<?php foreach($array_week as $key=>$value):
							$sel = "";
							if($key == $term)$sel = "SELECTED";
							?>
							<option value="<?=$key?>" <?=$sel?> ><?=$value?></option>
						<?php endforeach;?>
						</select>
						<?php */ ?>
					</td>
				</tr>
				<tr>
					<th class="w200" >受検終了日※</th>
					<td>
						<div class="row">
							<div class="col-md-4">
								<input type="text" name="exam_date_fin" value="<?=preg_replace("/\-/","/",$exam_date_fin)?>" class="form-control datepicker" />
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<th class="w200" >メモ1</th>
					<td>
						<textarea name="memo1" class="form-control" ><?=$memo1?></textarea>
					</td>
				</tr>
				<tr>
					<th class="w200" >メモ2</th>
					<td>
						<textarea name="memo2" class="form-control" ><?=$memo2?></textarea>
					</td>
				</tr>
			</table>
			<div class="row">
				<div class="col-md-3">	
					<a href="/index/cres/<?=$sec?>" class="btn btn-warning" class="w100p" >一覧に戻る</a>
				</div>
				<div class="col-md-3">	
					<input type="submit" name="edit" value="データ更新"  class="btn btn-primary w100p" />
				</div>
			</div>
		</form>
	</div>
	
  </body>
</html>
