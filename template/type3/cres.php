
<?php
	include_once("creshead.php");
?>
  <body  class="bg-light" >
	<div class="container">
		
		  <h3 class="title">
		  <img src="/images/CReS.png" height="30" />
		  	CReS検査詳細画面</h3>
		  <hr />
	</div>
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
				"",
				"受検結果一覧"
			),
		);

		if($basetype == 3){
			$pan = array(

					array(
						"",
						$dstr
					),
				);
		}
?>
	<ol class="breadcrumb">
		<li><a href="/index/home/">HOME</a></li>
		<?php if($pan[0][1]): ?>
		<li ><a href="<?=$pan[0][0]?>"><?=$pan[0][1]?></a></li>
		<?php endif; ?>
		<?php if($pan[1][1]): ?>
		<li><a href="/"><?=$pan[1][1]?></a></li>
		<?php endif; ?>
		<li class="active" >受検結果一覧</li>
	</ol>
	<form action="" method="POST" >
		<div class="box ">
			<p>フィルタリング</p>
			<div class="row">
				<div class="col-md-3">
					<label>ID</label>
					<input type="text" name="id" value="<?=$_REQUEST[ 'id' ]?>" class="form-control" />
				</div>
				<div class="col-md-3">
					<label>氏名</label>
					<input type="text" name="name" value="<?=$_REQUEST[ 'name' ]?>" class="form-control" />
				</div>
				<div class="col-md-3">
					<label>ふりがな</label>
					<input type="text" name="kana" value="<?=$_REQUEST[ 'kana' ]?>" class="form-control" />
				</div>
				<div class="col-md-3">
					<label>受検ステータス</label>
					<input type="text" name="status" value="<?=$_REQUEST[ 'status' ]?>" class="form-control" />
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<label>受検日</label>
					<i状態ut type="text" name="examdate" value="<?=$_REQUEST[ 'examdate' ]?>" class="form-control" />
				</div>
				<div class="col-md-2">
					<label>受検回数</label>
					<select name="count" class="form-control" >
						<option value="">-</option>
						<?php for($i=1;$i<=3;$i++):
							$sel = "";
							if($_REQUEST[ 'count' ] == $i) $sel = "selected";
							?>
							<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
						<?php endfor;?>
					</select>
				</div>
				<div class="col-md-6">
					<label>メールアドレス</label>
					<input type="text" name="mail" value="<?=$_REQUEST[ 'mail' ]?>" class="form-control" />
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-12">
					<label>メモ</label>
					<input type="text" name="memo" value="<?=$_REQUEST[ 'memo' ]?>" class="form-control" />
				</div>		
			</div>
			<div class="mt20">
				<div class="row">
					<div class="col-md-6">
						<button class="btn btn-primary btn-lg btn-block" type="submit">検索</button>
					</div>
					<div class="col-md-6 text-right">
						<a href="/" class="btn btn-warning">一覧画面</a>
					</div>
				</div>
				
			</div>
		</div>
	</form>
	<div class="mt20">
		<div class="container">
		<nav aria-label="Page navigation">
			<ul class="pagination">
				<?php for($i=0;$i<$ceil;$i++):
					$pg = $i+1;
					?>
				<li class="page-item"><a class="page-link" href="/index/cres/<?=$sec?>/?p=<?=$i?>"><?=$pg?></a></li>
				<?php endfor; ?>
			</ul>
		</nav>
		</div>
		<table class="table table-bordered " style="width:2800px;">
			<tr >
				<th >機能</th>
				<th >ID</th>
				<th>氏名</th>
				<th>ふりがな</th>
				<th>メールアドレス</th>
				<th>生年月日</th>
				<th>合否</th>
				<th>内省</th>
				<th>確認</th>
				<th>準備</th>
				<th>メモ1</th>
				<th>メモ2</th>

			</tr>
			<?php foreach($tests as $value):?>
			<tr>
				<td class="text-center"><a href="/index/cresedit/<?=$sec?>/<?=$value[ 'id' ]?>" class="btn btn-success">更新</a></td>
				<td><?=$value[ 'exam_id' ]?></td>
				<td><?=$value[ 'name' ]?></td>
				<td><?=$value[ 'kana' ]?></td>
				<td><?=$value[ 'mail' ]?></td>
				<td><?=preg_replace("/\-/","/",$value[ 'birth' ])?></td>
				<td><?=$value[ 'pass' ]?></td>
				<td>
					<?=$value[ 'exam_date1' ]?><br />
					<?php if($value[ 'exam_date1_status' ]):?>
					【<a href="/tmp/cres/1-<?=$value[ 'id' ]?>.pdf" target=_blank><?=$array_exam[$value[ 'exam_date1_status' ]]?></a>】
					<?php endif;?>
				</td>
				<td><?=$value[ 'exam_date2' ]?><br />
				<?php if($value[ 'exam_date2_status' ]):?>
				【<a href="/tmp/cres/2-<?=$value[ 'id' ]?>.pdf" target=_blank ><?=$array_exam[$value[ 'exam_date2_status' ]]?></a>】
				<?php endif;?>
				</td>
				<td><?=$value[ 'exam_date3' ]?><br />
				<?php if($value[ 'exam_date3_status' ]):?>
				【<a href="/tmp/cres/3-<?=$value[ 'id' ]?>.pdf" target=_blank ><?=$array_exam[$value[ 'exam_date3_status' ]]?></a>】
				<?php endif;?>
				</td>
				<td><?=$value[ 'memo1' ]?></td>
				<td><?=$value[ 'memo2' ]?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>





  </body>
</html>
