<?PHP
	//テスト配列の調整
	//検査システム選択で評価が選択されている時
	if($_REQUEST[ 'sys' ] != 1){
		unset($a_test_type[10]);
	}
	if($_REQUEST[ 'sys' ] == 1){
		$aPdfs[10] = $a_test_type[10];
		$a_test_type = array();
		$a_test_type = $aPdfs;
	}
	
?>
	<ul id="testlist">
<?PHP
	foreach($a_test_type as $key=>$val){
		$chkImg = "off";
		
		//検査の有無の確認
		if($lists[$key]){
		
?>
		<div id="onChkBox_<?=$key?>">
		<label for="onChk_<?=$key?>" >
			<li>
				<img src="/images/sita_ya_<?=$chkImg?>.gif" id="onChkImg_<?=$key?>" class="onChkImg">
				<div class="indent">
				<input type="checkbox" name="onChk_<?=$key?>" value="on" id="onChk_<?=$key?>" class="onChk">
				</div>
				<?=$val?>
			</li>
		</label>
		</div>


		<div id="openDiv_<?=$key?>" class="onChkhidden"><!--onChkhidden-->
			<div class="openBox">
				■受検者数　<span id="jyukensya_<?=$key?>"></span>名
				<input type="hidden" name="count[on<?=$key?>]" value="" id="jyukensya_<?=$key?>">
			</div>

<?PHP
		//行動価値検査のみ表示
		if(
			$key==1 
			|| $key==2
			|| $key==12
			){
			//別ファイルにて管理
			require "./template/type3/reg_BA_html.php";
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
			require "./template/type3/reg_VF_html.php";
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
			|| $key == 13
			|| $key == 35
			|| $key == 11
			|| $key == 28

			){
			//別ファイルにて管理
			require "./template/type3/reg_EA_html.php";
			
		}
		//感情能力検査のみ表示終わり
?>

<?PHP
		//感情能力検査社会人版
		if(
			$key==7
			){
			//別ファイルにて管理
			require "./template/type3/reg_EABJ_html.php";
		}
		//感情能力検査社会人版終わり
?>
<?PHP
		//多面評価
		if(
			$key==10
			){
			//別ファイルにて管理
			require "./template/type3/reg_TH_html.php";

		}
		//多面評価終わり
?>


		</div><!--/onChkhidden-->

<?PHP
		}//検査の有無の確認終わり
	}
?>
	</ul>


<?PHP

exit();
?>
