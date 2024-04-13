<?PHP
$css1 = "new";
$title = "AMS:受検者一覧画面";
$js = array("new");
$map = true;
$drop = true;
include_once("include_header.php");
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<style type="text/css" >
<!--
.pd10{
	padding:10px;
}
textarea {
    resize: none;
}
div.alert{
	height:200px;
}
ul{
	margin-left:20px;
}
//-->
</style>
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
				"新規顧客登録"
			),
			
		);
if($basetype == 2){
$pan = array(
			array(
				"",
				"ヘルプ"
			),
		);
}
include_once("include_title.php");
?>
	<div id="searchTitle">AMSヘルプ（パートナー版）</div>
		
		<div class="row pd10">
			<div class="col-md-3">
				<div class="box box-danger">
                    <div class="alert alert-warning alert-dismissable">
                        基本編<br />～AMSでできること～
                    </div>
                </div><!-- /.box-body -->
			</div>
			<div class="col-md-3 ">
				<div class="box box-danger">
                    <div class="alert alert-warning alert-dismissable">
                        顧客企業の登録<br />（新規・変更）
                    </div>
                </div><!-- /.box-body -->
			</div>
			<div class="col-md-3 ">
				<div class="box box-danger">
                    <div class="alert alert-warning alert-dismissable">
                        検査の注文方法<br />（新規・追加）
                    </div>
                </div><!-- /.box-body -->
			</div>
		</div>
		

		<div class="row pd10">
			<div class="col-md-3">
				<div class="box box-danger">
                    <div class="alert alert-warning alert-dismissable">
                        検査実施件数の確認
                    </div>
                </div><!-- /.box-body -->
			</div>
			<div class="col-md-3 ">
				<div class="box box-danger">
                    <div class="alert alert-warning alert-dismissable">
                        アカウント設定
						<ul>
							<li>企業情報変更</li>
							<li>PDF出力ロゴ設定</li>
							<li>トライアル用フォーム</li>
						</ul>
                    </div>
                </div><!-- /.box-body -->
			</div>

		</div>
		<p>
			上記で解決できない場合は<a href="/index/helpform/">こちら</a>からお問い合わせください。
		</p>
	</div>
	<br clear=all />
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
