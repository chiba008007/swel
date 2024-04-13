<?PHP
$css1 = "reg";
$title = "AMS:検査新規登録画面";
$js = array("reg");
$scroll = true;
include_once("include_header.php");
$pan = array(
			array("/index/ptn/".$ptid,"顧客企業一覧"),
			array("/","検査一覧"),
			array("/index/jregist/".$sec."/","データ登録"),
			array("","データ編集"),
		);
if($basetype == 2){
	$pan = array(
			array("/","検査一覧"),
			array("/index/jregist/".$sec."/","データ登録"),
			array("","データ編集"),
		);
}
?>
<div id="main">
	<div id="contents">
<?PHP include_once("include_title.php"); ?>
		<div id="dataTitle">データ編集</div>
<?PHP
	$chk1 = "";
	if($_REQUEST[ 'bossflg' ]){ $chk1 = "CHECKED";
	}elseif($jud[0][ 'bossflg' ] && !$_REQUEST[ 'update' ]){ $chk1 = "CHECKED";}

	if($_REQUEST[ 'busyo' ]){ $busyo = $_REQUEST[ 'busyo' ];
	}elseif($jud[0][ 'busyo' ]){ $busyo = $jud[0][ 'busyo' ];}

	if($_REQUEST[ 'yakusyoku' ]){ $yakusyoku = $_REQUEST[ 'yakusyoku' ];
	}elseif($jud[0][ 'yakusyoku' ]){ $yakusyoku = $jud[0][ 'yakusyoku' ];}

	if($_REQUEST[ 'empnum' ]){ $empnum = $_REQUEST[ 'empnum' ];
	}elseif($jud[0][ 'empnum' ]){ $empnum = $jud[0][ 'empnum' ];}

	if($_REQUEST[ 'sei' ]){ $sei = $_REQUEST[ 'sei' ];
	}elseif($jud[0][ 'sei' ]){ $sei = $jud[0][ 'sei' ];}

	if($_REQUEST[ 'mei' ]){ $mei = $_REQUEST[ 'mei' ];
	}elseif($jud[0][ 'mei' ]){ $mei = $jud[0][ 'mei' ];}

	if($_REQUEST[ 'sei_kana' ]){ $sei_kana = $_REQUEST[ 'sei_kana' ];
	}elseif($jud[0][ 'sei_kana' ]){ $sei_kana = $jud[0][ 'sei_kana' ];}

	if($_REQUEST[ 'mei_kana' ]){ $mei_kana = $_REQUEST[ 'mei_kana' ];
	}elseif($jud[0][ 'mei_kana' ]){ $mei_kana = $jud[0][ 'mei_kana' ];}

	if($_REQUEST[ 'mail' ]){ $mail = $_REQUEST[ 'mail' ];
	}elseif($jud[0][ 'mail' ]){ $mail = $jud[0][ 'mail' ];}
	
	$names = $jud[ 'bs_list' ][ 'names' ];
	$birth = explode("/",$jud[0][ 'birth' ]);
	if($_REQUEST[ 'year' ]){ $year = $_REQUEST[ 'year' ];
	}elseif($jud[0][ 'birth' ]){ $year = $birth[0];}

	if($_REQUEST[ 'month' ]){ $month = $_REQUEST[ 'month' ];
	}elseif($jud[0][ 'birth' ]){ $month = sprintf("%d",$birth[1]); }

	if($_REQUEST[ 'day' ]){ $day = $_REQUEST[ 'day' ];
	}elseif($jud[0][ 'birth' ]){ $day = sprintf("%d",$birth[2]); 

	if($_REQUEST[ 'sex' ]){ $sex = $_REQUEST[ 'sex' ];
	}elseif($jud[0][ 'sex' ]){ $sex = $jud[0]['sex']; }

	if($_REQUEST[ 'pass' ]){ $pass = $_REQUEST[ 'pass' ];
	}elseif($jud[0][ 'pass' ]){ $pass = $jud[0]['pass']; }

	if($_REQUEST[ 'memo1' ]){ $memo1 = $_REQUEST[ 'memo1' ];
	}elseif($jud[0][ 'memo1' ]){ $memo1 = $jud[0]['memo1']; }

	if($_REQUEST[ 'memo2' ]){ $memo2 = $_REQUEST[ 'memo2' ];
	}elseif($jud[0][ 'memo2' ]){ $memo2 = $jud[0]['memo2']; }


}
?>
<?PHP if($errmsg){ ?>
<br clear=all />
<div style="color:red;border:1px solid red;padding:10px;"><?=$errmsg?></div>
<?PHP } ?>
<?PHP if($msg){ ?>
<br clear=all />
<div style="color:green;border:1px solid green;padding:10px;"><?=$msg?></div>
<?PHP } ?>
		<br clear=all />
		<form action="" method="POST" >
		<table id="table">
			<tr>
				<th>上司</th>
				<td>
<?PHP if($chk1){?>
					上司
<input type="hidden" name="bossflg" value="1" class="pd10"  >

<?PHP }else{ ?>
					部下
<input type="hidden" name="bossflg" value="0" class="pd10"  >
<?PHP } ?>

				</td>
			</tr>
			<tr>
				<th>部署</th>
				<td><input type="text" name="busyo" value="<?=$busyo?>" class="pd10" ></td>
			</tr>
			<tr>
				<th>役職</th>
				<td><input type="text" name="yakusyoku" value="<?=$yakusyoku?>" class="pd10" ></td>
			</tr>
			<tr>
				<th>社員番号</th>
				<td><input type="text" name="empnum" value="<?=$empnum?>" class="pd10" ></td>
			</tr>
			<tr>
				<th>姓名</th>
				<td>姓<input type="text" name="sei" value="<?=$sei?>" class="pd10" >　名<input type="text" name="mei" value="<?=$mei?>" class="pd10" ></td>
			</tr>
			<tr>
				<th>姓名(かな)</th>
				<td>せい<input type="text" name="sei_kana" value="<?=$sei_kana?>" class="pd10" >　めい<input type="text" name="mei_kana" value="<?=$mei_kana?>" class="pd10" ></td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td><input type="text" name="mail" value="<?=$mail?>" style="width:300px;" class="pd10" ></td>
			</tr>
			<tr>
				<th>担当上司</th>
				<td><?=$names?></td>
			</tr>
			<tr>
				<th>生年月日</th>
				<td>
				<input type="text" name="year" value="<?=$year?>" style="width:40px;" class="pd10"  maxlength=4 />/
					<select name="month" class="pd10" >
<?PHP for($i=1;$i<=12;$i++){ ?>
<?PHP $sel = ""; if($month == $i){ $sel = "SELECTED"; }?>
						<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
					</select>
				/
					<select name="day" class="pd10" >
<?PHP for($i=1;$i<=31;$i++){ ?>
<?PHP $sel = ""; if($day == $i){ $sel = "SELECTED"; }?>
						<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
<?PHP } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>性別</th>
				<td>
					<select name="sex" class="pd10" >
<?PHP for($i=1;$i<=2;$i++){ ?>
<?PHP $sel = ""; if($sex == $i){ $sel = "SELECTED"; }?>
						<option value="<?=$i?>" <?=$sel?> ><?=$a_gender[$i]?></option>
<?PHP } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>合否</th>
				<td>
<?PHP if($pass == "合"){ $sel1 = "CHECKED"; } ?>
<?PHP if($pass == "不"){ $sel2 = "CHECKED"; } ?>
<?PHP if($pass == "未"){ $sel3 = "CHECKED"; } ?>

					合<input type="radio" name="pass" value="合" <?=$sel1?> >　不<input type="radio" name="pass" value="不" <?=$sel2?> >　未<input type="radio" name="pass" value="未" <?=$sel3?> >
				</td>
			</tr>
			<tr>
				<th>メモ1</th>
				<td><input type="text" name="memo1" value="<?=$memo1?>" style="width:90%;" class="pd10"  /></td>
			</tr>
			<tr>
				<th>メモ2</th>
				<td><input type="text" name="memo2" value="<?=$memo2?>" style="width:90%;" class="pd10"  /></td>
			</tr>
		</table>
		<input type="submit" name="update" id="update" value="更新" class="button" >
		</form>
	</div>
<br clear=all />
<?PHP include_once("include_footer_name.php"); ?>
</div>
<style type="text/css">
<!--
	.button1{
		padding:5px !important;
	}
	.pd10{
		padding:5px !important;
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
	$("#update").click(function(){
		if(confirm("データの更新を行います。")){
			return true;
		}else{
			return false;
		}
	});

});
//-->
</script>
<?PHP include_once("include_footer.php"); ?>
