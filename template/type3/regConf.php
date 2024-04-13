<?PHP
$css1 = "reg";
$title = "AMS:検査新規登録画面";
$js = array("reg");
$scroll = true;
include_once("include_header.php");

?>
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
				"",
				"検査新規登録"
			),
		);


if($basetype == 2){
	$pan = array(

			array(
				"/",
				"検査一覧"
			),
			array(
				"",
				"検査新規登録"
			),

		);
	
	
}

include_once("include_title.php");
?>
		
		<div id="dataTitle">新規検査登録</div>
		<p class="hissu"><span class="red">※</span>は必須項目です。</p>
		<form action="/index/reg/<?=$sec?>" method="POST" name="form">
		<table id="table">
			<tr>
				<th>企業名</th>
				<td><?=$ptdata[ 'name' ]?></td>
			</tr>
			<tr>
				<th>販売可能ライセンス数</th>
				<td>
					【全体】：<?=number_format($sell[ 'sell' ])?> 枚<br />
					【詳細】<br />
					
					<table id="buyTbl"  >
						<thead>
						<tr>
							<th class="buyTle" >検査型</th>
							<th class="buyTle" >検査数</th>
							<th class="buyTle" >検査型</th>
							<th class="buyTle" >検査数</th>
						</tr>
						</thead>
						<tbody >
						<tr>
<?PHP
						$i=0;
						foreach($lists as $key=>$val){
							
?>
							<input type="hidden" id="sell_<?=$key?>" value="<?=$val?>">
							<td><?=$a_test_type[$key]?></td>
							<td class="right"><?=number_format($val)?> 枚</td>
<?PHP
							if($i%2){
?>
								</tr><tr>
<?PHP
							}
							$i++;
						}
?>
						</tbody>
					</table>

				</td>
			</tr>
			<tr>
				<th>顧客企業名</th>
				<td><?=$cdata[ 'name' ]?></td>
			</tr>
			<tr>
				<th>検査名<span class="red">※</span></th>
				<td><?=$_REQUEST[ 'test_name' ]?><input type="hidden" name="test_name" value="<?=$_REQUEST[ 'test_name' ]?>" id="test_name"></td>
			</tr>
			<tr>
				<th>受検者数<span class="red">※</span></th>
				<td><?=$_REQUEST[ 'RegNumber' ]?>
					<input type="hidden" name="RegNumber" value="<?=$_REQUEST[ 'RegNumber' ]?>" id="RegNumber" class="numeric" >名
				</td>
			</tr>
			<tr>
				<th>氏名の入力</th>
				<td >
						<div style="position:relative;">
							<input type="hidden" name="input_not_name" id="input_name" value="<?=$_REQUEST[ 'input_not_name' ]?>" />
							<?php if($_REQUEST[ 'input_not_name' ]): ?>
							設定しない
							<?php else: ?>
							設定する
							<?php endif;?>
						</div>
					</td>
			</tr>
			<tr>
				<th>性別の入力</th>
				<td>
					<div style="position:relative;">
						<input type="hidden" name="input_not_gender" id="input_gender" value="<?=$_REQUEST[ 'input_not_gender' ]?>"  />
						<?php if($_REQUEST[ 'input_not_gender' ]): ?>
						設定しない
						<?php else: ?>
						設定する
						<?php endif;?>
					</div>
				</td>
			</tr>
<?PHP
		if($basetype != 3){
?>
			<tr>
				<th>メール配信受検者残数</th>
				<td><?=$_REQUEST[ 'rest_mail_count' ]?>
					<input type="hidden" name="rest_mail_count" value="<?=$_REQUEST[ 'rest_mail_count' ]?>" id="rest_mail_count" class="numeric" >名<br />
				</td>
			</tr>
<?PHP
		}
?>
			<tr>
				<th>検査システム選択<span class="red">※</span></th>
				<td>
					<?=$array_system_type[$_REQUEST[ 'RegSystem' ]]?>
					<input type="hidden" name="RegSystem" value="<?=$_REQUEST[ 'RegSystem' ]?>" >
				</td>
			</tr>
			<tr>
				<th>検査言語選択<span class="red">※</span></th>
				<td>
					<?=$array_language[$_REQUEST[ 'language' ]]?>
					<input type="hidden" name="language" value="<?=$_REQUEST[ 'language' ]?>" >
				</td>
			</tr>
			<tr>
				<th>検査実施期間<span class="red">※</span></th>
				<td>
				
<?PHP
//検査実施期間の設定
					if($_REQUEST[ 'year1' ]){
						$y = $_REQUEST[ 'year1' ];
					}
					if($_REQUEST[ 'month1' ]){
						$m = $_REQUEST[ 'month1' ];
					}
					if($_REQUEST[ 'day1' ]){
						$d = $_REQUEST[ 'day1' ];
					}
					if($_REQUEST[ 'year2' ]){
						$y2 = $_REQUEST[ 'year2' ];
					}
					if($_REQUEST[ 'month2' ]){
						$m2 = $_REQUEST[ 'month2' ];
					}
					if($_REQUEST[ 'day2' ]){
						$d2 = $_REQUEST[ 'day2' ];
					}

?>

					西暦<?=$y?>年<?=$m?>月<?=$d?>日～<?=$y2?>年<?=$m2?>月<?=$d2?>日
					<input type="hidden" name="year1" value="<?=$y?>"  >
					<input type="hidden" name="month1" value="<?=$m?>"  >
					<input type="hidden" name="day1" value="<?=$d?>"  >
					<input type="hidden" name="year2" value="<?=$y2?>"  >
					<input type="hidden" name="month2" value="<?=$m2?>"  >
					<input type="hidden" name="day2" value="<?=$d2?>"  >
				</td>
			</tr>
			<tr>
				<th>検査結果画面</th>
<?PHP
				$suru = "する";
				if(!$_REQUEST[ 'fin_disp' ] && $_REQUEST[ 'conf' ]){
					$suru = "しない";
				}
				
?>
				<td>
					<input type="hidden" name="fin_disp" value="<?=$_REQUEST[ 'fin_disp' ]?>" >
					検査結果画面を表示<?=$suru?></label>
				</td>
			</tr>
			<tr>
<?php if($basetype == 1):?>
			<th>事前環境チェックの有無</th>
<?PHP
				$suru = "判定する";
				if(!$_REQUEST[ 'judge_login' ] && $_REQUEST[ 'judge_login' ]){
					$suru = "判定する";
				}
?>
				<td>
					<input type="hidden" name="judge_login" value="<?=$_REQUEST[ 'judge_login' ]?>" >
					<?=$suru?></label>
				</td>
			</tr>
<?php endif;?>
<?PHP
		if($basetype == 1){
?>
			<tr>
				<th>強みアンケート利用</th>
<?PHP
				$suru = "する";
				if(!$_REQUEST[ 'enq_status' ] && $_REQUEST[ 'conf' ]){
					$suru = "しない";
				}
				
?>
				<td>
					<input type="hidden" name="enq_status" value="<?=$_REQUEST[ 'enq_status' ]?>" >
					アンケートを利用<?=$suru?></label>
				</td>
			</tr>
<?PHP
		}
?>

<?PHP 
$chk = "設定しない";
if($_REQUEST[ 'licensecard' ]):?>
<input type="hidden" name="licensecard" value="1"  >
<?php 
$chk = "設定する";
endif;
?>
<?php if($basetype == 1): ?>
			<tr>
				<th>受検証明書ダウンロード設定</th>
				<td>
					
					<p style="display:inline-block;vertical-align:middle;height:30px;">
						<label for="licensecard"><?=$chk?></label>
					</p>
				</td>
			</tr>
<?php endif; ?>


	<?PHP if($basetype == 1): ?>
		<tr>
			<th>受検者ダウンロード設定</th>
			<td>
				<?php if(isset($_REQUEST[ 'exam_download'  ])): ?>
				<input type="hidden" name="exam_download" value="<?=$_REQUEST[ 'exam_download' ]?>" >設定する
				<?php else: ?>
					設定しない
				<?php endif;?>
			</td>
		</tr>
	<?php endif;?>


<?PHP
		if($basetype == 1){
?>
			<tr>
				<th>一括ダウンロード設定</th>
<?PHP
				$suru = "する";
				if(!$_REQUEST[ 'pdf_slice' ] && $_REQUEST[ 'conf' ]){
					$suru = "しない";
				}
				
?>
				<td>
					<input type="hidden" name="pdf_slice" value="<?=$_REQUEST[ 'pdf_slice' ]?>" >
					受検者全員の検査結果を一括でダウンロード<?=$suru?></label>
				</td>
			</tr>
<?PHP
		}
?>

<?PHP if($basetype <= 2){ ?>
<?PHP 
	$recommen = sprintf("%d",$_REQUEST[ 'recommen' ]);
?>
			<tr>
				<th>推奨ブラウザ説明文</th>
				<td>
					<input type="hidden" name="recommen"  value="<?=$recommen?>"  >
<?PHP if($recommen == 1){ ?>
					利用する
<?PHP }else{ ?>
					利用しない
<?PHP } ?>
				</td>
			</tr>
<?PHP } ?>


<?PHP
		if($basetype == 1){
?>
			<tr>
				<th>ログイン説明文</th>
<?PHP

				if($_REQUEST[ 'explain' ] ){
					$explain = $_REQUEST[ 'explain' ];
				}
				
?>
				<td>
					<?=nl2br($_REQUEST[ 'explain' ])?>
					<input type="hidden" name="explain" value="<?=$_REQUEST[ 'explain' ]?>">
				</td>
			</tr>
<?PHP
		}
?>

<tr>
		<th>動画サムネイルの表示</th>
		<td>
			<?=$youtubeflag[ $_REQUEST[ 'youtubeflag' ] ]?>
			<input type="hidden" name="youtubeflag" value="<?=$_REQUEST[ 'youtubeflag' ]?>" />
			<br />
			動画のURL
			【<?=$_REQUEST[ 'youtube' ]?>】
			<input type="hidden" name="youtube" value="<?=$_REQUEST[ 'youtube' ]?>" />
		</td>
	</tr>
	
                        
                        
                        <?php if($basetype == 1){?>
                            <tr>
                                <th>PDF出力制限</th>
                                <td>
                                    <p>PDF出力に制限を設ける場合は下記を選択してください。</p>
                                    
                                    <div style="margin-top:15px;">
                                        PDF出力期間を
                                        <?php 
                                            
                                            $chk = "";
                                            if(filter_input(INPUT_POST,"pdf_output_limit") == 1):
                                                $chk = "利用する";
                                            endif; 
                                            if(filter_input(INPUT_POST,"pdf_output_limit") == 0):
                                                $chk = "利用しない";
                                            endif;
                                        ?>
                                        <span>
                                            【<?=$chk?>】
                                           <input type="hidden" name="pdf_output_limit" value="<?=filter_input(INPUT_POST,"pdf_output_limit")?>" />
                                        </span>
                                        
                                        <br /><br />
                                        <p>PDF出力可能期間</p>
                                        <?=filter_input(INPUT_POST,"pdf_output_limit_from")?>〜
                                        <?=filter_input(INPUT_POST,"pdf_output_limit_to")?>
                                        <input type="hidden"  name="pdf_output_limit_from"  value="<?=filter_input(INPUT_POST,"pdf_output_limit_from")?>" >
                                        <input type="hidden"  name="pdf_output_limit_to" value="<?=filter_input(INPUT_POST,"pdf_output_limit_to")?>">
                                        <br />
                                        <br />
                                        PDF出力人数を
                                        
                                        <?php 
                                            $chk = "";
                                            if(filter_input(INPUT_POST,"pdf_output_limit_count") == 1):
                                                $chk = "利用する";
                                            endif; 
                                            if(filter_input(INPUT_POST,"pdf_output_limit_count") == 0):
                                                $chk = "利用しない";
                                            endif;
                                        ?>
                                        <input type="hidden"   name="pdf_output_limit_count"  value="<?=filter_input(INPUT_POST,"pdf_output_limit_count")?>" >
                                        <span>
                                            【<?=$chk?>】
                                        </span>
                                        <br /><br />
                                        <p>PDF出力数【<?=filter_input(INPUT_POST,"pdf_output_count")?>名】</p>
                                        <input type="hidden"   name="pdf_output_count"  value="<?=filter_input(INPUT_POST,"pdf_output_count")?>" >
                                    </div>
                                    
                                    
                                    
                                    
                                    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
                                    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
                                    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" >
                                    <script type="text/javascript" >
                                        $(function(){
                                            
                                            $("[name='pdf_output_limit' ]").change(function(){
                                                var _chk = $("input[name=pdf_output_limit]:checked").val();
                                                $("#onUseImg-1").attr("src","/images/radio_off.jpg");
                                                $("#onUseImg-0").attr("src","/images/radio_off.jpg");
                                                if(_chk == 1){
                                                    $("#onUseImg-"+_chk).attr("src","/images/radio_on.jpg");
                                                }
                                                if(_chk == 0){
                                                    $("#onUseImg-"+_chk).attr("src","/images/radio_on.jpg");
                                                }
                                            });
                                            
                                            $("[name='pdf_output_limit_count' ]").change(function(){
                                                var _chk = $("input[name=pdf_output_limit_count]:checked").val();
                                                $("#onUseImg2-1").attr("src","/images/radio_off.jpg");
                                                $("#onUseImg2-0").attr("src","/images/radio_off.jpg");
                                                if(_chk == 1){
                                                    $("#onUseImg2-"+_chk).attr("src","/images/radio_on.jpg");
                                                }
                                                if(_chk == 0){
                                                    $("#onUseImg2-"+_chk).attr("src","/images/radio_on.jpg");
                                                }
                                            });
                                            
                                            $(".datepicker").datepicker();
                                        });
                                    </script>
                                </td>
                        </tr>
                        
<?php } ?>
                        
                        
<?PHP
			if($basetype == 1){
?>
			<tr>
				<th>PDF出力形式選択</th>
				<td>
<?PHP
				foreach($array_pdf as $key=>$val){
					if($_REQUEST[ 'pdf' ] && count($_REQUEST[ 'pdf' ]) && array_key_exists($key,$_REQUEST[ 'pdf' ])){
?>
					<input type="hidden" name="pdf[<?=$key?>]" value="on" > 
					<div class="divPdf"><?=$val?></div>
<?PHP
					}
				}
?>
				</td>
			</tr>
<?PHP
			}
?>
		</table>
	</div>
	<p id="pMsg">
		上記の検査に属する検査種別を選択してください。<br />
		検査によっては、検査に必要な情報入力画面が表示されます。
	</p>



	<ul id="testlist">
<?PHP
	foreach($a_test_type as $key=>$val){
		if($_REQUEST[ 'onChk_'.$key ]){
			//下矢印画像の指定
			$chkImg = "on";
			$onChk  = "onChkdisp";
		}else{
			$chkImg = "off";
			$onChk  = "onChkhidden";
		}
		//検査用フラグ
		if($key == 10){
			//多面評価用フラグ
			$flg = "taFlg";
		}else{
			$flg = "tFlg";
		}
		//検査の有無の確認

		if($_REQUEST[ 'onChk_'.$key ]){
?>
		<div id="onChkBox_<?=$key?>" class="onChkdisp" >
			<li>
				<input type="hidden" name="onChk_<?=$key?>" value="on"  >
				<?=$val?>
			</li>
		</div>


		<div id="openDiv_<?=$key?>" class="<?=$onChk?>"><!--onChkhidden-->
			<div class="openBox">
				■受検者数　<span id="jyukensya_<?=$key?>" class="num"></span>名
				<input type="hidden" name="count[on<?=$key?>]" class="numHid" value="<?=$_REQUEST[ 'count' ][ 'on'.$key ]?>" id="jyukensya_<?=$key?>">
			</div>

<?PHP
		//行動価値検査のみ表示
		if(
			$key==1 
			|| $key==2
			|| $key==12
			|| $key==41
			|| $key==54
			|| $key==59
			|| $key==72
			|| $key==82
			|| $key==73
			|| $key==91
			){
			//別ファイルにて管理
			require "./template/type3/reg_BA_htmlConf.php";
		}
		
		//行動価値検査のみ表示終わり
?>

<?PHP
		//VF検査のみ表示
		if(
			$key==4
			|| $key == 33
			){
			//別ファイルにて管理
			require "./template/type3/reg_VF_htmlConf.php";
		}
		//VF検査のみ表示終わり
?>
<?PHP
		//感情能力検査表示
		//行動意識検査
		//ＮＬ検査
		//数学検定検査
		//IQ
		if(
			$key==5
			|| $key == 31
			|| $key == 6
			|| $key == 37
			|| $key == 34
			|| $key == 36
                        || $key == 61
			|| $key == 13
			|| $key == 35
			|| $key == 11
			|| $key == 28
			|| $key == 39
			|| $key == 40
			|| $key == 42
			|| $key == 43
			|| $key == 45
			|| $key == 46
			|| $key == 51
			|| $key == 76
			|| $key == 70        
			){
			//別ファイルにて管理
			require "./template/type3/reg_EA_htmlConf.php";
			
		}
		//感情能力検査のみ表示終わり
?>

<?PHP
		//感情能力検査社会人版
		if(
			$key==7
			|| $key==47
			|| $key==66
			|| $key==74
			){
			//別ファイルにて管理
			require "./template/type3/reg_EABJ_htmlConf.php";
		}
		//感情能力検査社会人版終わり
?>
<?PHP
		//AMP
		if(
			$key==83
			){
			//別ファイルにて管理
			require "./template/type3/reg_AMP_htmlConf.php";

		}
		//感情能力検査のみ表示終わり
?>
<?PHP
		//AMP
		if(
			$key==85
			){
			//別ファイルにて管理
			require "./template/type3/reg_MHQ_htmlConf.php";

		}
		//感情能力検査のみ表示終わり
?>

<?PHP
		//多面評価
		if(
			$key==10
			){
			//別ファイルにて管理
			require "./template/type3/reg_TH_htmlConf.php";

		}
		//多面評価終わり
?>

<?PHP
		//添削
		if(
			$key==44
			|| $key==48
			){
			//別ファイルにて管理
			require "./template/type3/reg_CRT_htmlConf.php";

		}
		//添削終わり
?>

		</div><!--/onChkhidden-->

<?PHP
		}//検査の有無の確認終わり
	}
?>
	</ul>



	<br clear=all />
	<div id="btnBox">
		<input type="submit" name="back" value="戻る" class="button" >
		<input type="submit" name="regist" value="登録する" class="button" >
		
	</div>
	<br clear=all />
	</form>
	<input type="hidden" id="tamenFlg" value="<?=$tamenflg?>" >
	<input type="hidden" id="testFlg" value="<?=$testflg?>" >
<?PHP
	//jsに渡すテスト最大キー
?>
	<input type="hidden" id="max" value="<?=$max_key?>" >
	</div>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
