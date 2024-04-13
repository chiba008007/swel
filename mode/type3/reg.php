<?PHP
//-------------------------------------------
//検査新規登録
//
//
//
//
//
//-------------------------------------------
include_once("./init/tensaku.php");
require_once("./lib/include_cusReg.php");
require_once("./lib/include_cusEdit.php");
$obj = new cusRegMethod();
$obj2 = new cusEditMethod();

//パートナー情報取得
$where['id'] = $ptid;
$ptdata = $obj->getPtData($where);

//重みデータcsv
if (filter_input(INPUT_GET, "weightcsv") == "on") {
	$file = $_FILES['file']['tmp_name'];
	$fp   = fopen($file, "r");
	$i = 0;

	while (($data = fgetcsv($fp, 10000))) {
		if ($i == 5) {
			$asins[] = $data;
		}
		$i++;
	}

	$j = 1;
	for ($i = 10; $i <= 40; $i++) {
		$return[$j] = $asins[0][$i];
		$j++;
	}
	header('Content-Type: application/json');
	echo json_encode($return);
	exit();
}


//重みマスタデータの取得
$wt = array();
$wt['uid'] = $id;
$wt['pid'] = $ptid;
$weight = $obj2->getWeightData($wt);
if (filter_input(INPUT_POST, "type") == "master") {
	$list = array();
	foreach ($weight as $key => $val) {
		if ($val['id'] == filter_input(INPUT_POST, 'id')) {
			$list['w1'] = $val['e_feel'];
			$list['w2'] = $val['e_cus'];
			$list['w3'] = $val['e_aff'];
			$list['w4'] = $val['e_cntl'];
			$list['w5'] = $val['e_vi'];
			$list['w6'] = $val['e_pos'];
			$list['w7'] = $val['e_symp'];
			$list['w8'] = $val['e_situ'];
			$list['w9'] = $val['e_hosp'];
			$list['w10'] = $val['e_lead'];
			$list['w11'] = $val['e_ass'];
			$list['w12'] = $val['e_adap'];
			$list['w13'] = $val['avg'];
			$list['w14'] = $val['hensa'];
		}
	}
	echo json_encode($list);
	exit();
}
if (filter_input(INPUT_POST, "dir") == "hoge") {
	//配列に変換する
	$file = $_FILES['file']['tmp_name'];
	$fp   = fopen($file, "r");
	$no = 0;
	while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
		if ($no == 5) {
			$csvdata[] = $data;
		}
		$no++;
	}
	fclose($fp);

	$csv[1] = $csvdata[0][22];
	$csv[2] = $csvdata[0][23];
	$csv[3] = $csvdata[0][24];
	$csv[4] = $csvdata[0][25];
	$csv[5] = $csvdata[0][26];
	$csv[6] = $csvdata[0][27];
	$csv[7] = $csvdata[0][28];
	$csv[8] = $csvdata[0][29];
	$csv[9] = $csvdata[0][30];
	$csv[10] = $csvdata[0][31];
	$csv[11] = $csvdata[0][32];
	$csv[12] = $csvdata[0][33];
	$csv[13] = $csvdata[0][34];
	$csv[14] = $csvdata[0][35];
	header('Content-Type: application/json');
	echo json_encode($csv);
	exit();
}

//販売可能全体数の取得
$sell = $obj->getSellCount($where);




$i = 1;
$tamenflg = 0;
$testflg  = 0;

foreach ($sell as $key => $val) {
	if (preg_match("/^type/", $key)) {
		$ty = preg_replace("/^type/", "", $key);
		$lists[$ty] = $val;
		if ($_REQUEST['weightchecked'][$ty]) {
			$wtype = $ty;
		}
		$i++;
	}
	//中国語が選択されたとき
	if ($array_language_grp[$ty] == "CH") {
		$chine = 1;
	}
	//ベトナム語が選択された時
	if ($array_language_grp[$ty] == "VT") {
		$vietnam = 1;
	} else
		//多面評価がある時
		if ($key == "type10") {
			$tamenflg = 1;
		} else {
			$testflg = 1;
		}

	//添削がある時
	if ($key == "type44") $tensaku_flg = 1;
	//人権がある時
	if ($key == "type49" || $key == "type53") $jinken_flg = 1;
	//評価検査がある時
	if ($key == "type52" || $key == "type86") $judge_flg = 1;
}

/*
if($sec == "Lists"){
	require_once("./mode/type3/regTestList.php");
	exit();
}
*/

//テストの最大キー取得
$max_key = max(array_keys($a_test_type));

//顧客情報取得
$where['id'] = $id;
$cdata = $obj->getPtData($where);


//多面評価がない時配列の修正
if (!$tamenflg) {
	unset($array_system_type[1]);
}

//通常テストが無い時
if (!$testflg) {
	unset($array_system_type[0]);
}
//添削テストがないとき
if (!$tensaku_flg) {
	unset($array_system_type[2]);
}
//人権テストがないとき
if (!$jinken_flg) {
	unset($array_system_type[3]);
}
//評価検査テストがないとき
if (!$judge_flg) {
	unset($array_system_type[4]);
}

$array_language = array();
//日本語を選択した時の検査言語選択項目設定
if ($testflg || $tamenflg) {
	$array_language[0] = "日本語";
}
//ベトナム語を選択した時の検査言語選択項目設定
if ($vietnam) {
	$array_language[4] = "ベトナム語";
}
//中国語を選択したとき
if ($chine) {
	$array_language[2] = "中国語";
}

if ($_REQUEST['conf']) {
	$countErr = 0;
	//テストの数のエラーチェック
	foreach ($_REQUEST['count'] as $key => $val) {
		$ty = "";
		$k = preg_replace("/^on/", "", $key);
		$on = "onChk_" . $k;
		$ty = "type" . $k;
		if ($_REQUEST[$on] && $sell[$ty] < $_REQUEST['RegNumber']) {
			$countErr += 1;
		}
	}
	if ($countErr) {
		$alert = "受験者数が多すぎます。";
		$html = "reg";
	} else {
		$html = "regConf";
	}
}
if ($_REQUEST['regist']) {

	$edit['edit']['registtime'] = date('Y-m-d H:i:s');
	$edit['where']['id'] = $id;
	$table = "t_user";

	$db->editUserData($table, $edit);

	$set = [];

	$set['company_name'] = $_SESSION['base_site_name'];
	$set['company_name_target'] = $_SESSION['name'];
	$set['testname'] = $_REQUEST['test_name'];

	$set['worktext'] = "検査登録";
	$set['testcount'] = $_REQUEST['RegNumber'];
	$set['detail'] = "日付/検査数";

	$db->setUserData("log", $set);


	$countErr = 0;
	//テストの数のエラーチェック
	foreach ($_REQUEST['count'] as $key => $val) {
		$ty = "";
		$k = preg_replace("/^on/", "", $key);
		$on = "onChk_" . $k;
		$ty = "type" . $k;
		if ($_REQUEST[$on] && $sell[$ty] < $_REQUEST['RegNumber']) {
			$countErr += 1;
		}
	}

	if ($countErr) {
		//登録エラー
		header("Location:/");
		exit();
	}

	//テストweb申込のステータスの変更
	$table = "t_application";
	$edit = array();
	$edit['where']['cid'] = $id;
	$edit['where']['pid'] = $ptid;
	$edit['where']['status'] = 0;
	$edit['where']['type'] = 1;
	$edit['edit']['status'] = 1;
	$db->editUserData($table, $edit);

	$html = "regRegist";
	foreach ($_REQUEST['count'] as $key => $val) {
		$total_number += $val;
	}
	//----------------------------------
	//親検査データの登録
	//----------------------------------
	$sets['youtubeflag'] = $_REQUEST['youtubeflag'];
	$sets['youtube'] = $_REQUEST['youtube'];
	$sets['partner_id'] = $ptid;
	$sets['customer_id'] = $id;
	$sets['test_id'] = 0;
	$sets['name'] = $_REQUEST['test_name'];
	$sets['period_from'] = sprintf("%04d/%02d/%02d", $_REQUEST['year1'], $_REQUEST['month1'], $_REQUEST['day1']);
	$sets['period_to'] = sprintf("%04d/%02d/%02d", $_REQUEST['year2'], $_REQUEST['month2'], $_REQUEST['day2']);
	$sets['number'] = $total_number;
	$sets['recommen'] = $_REQUEST['recommen'];

	$sets['input_not_name'] = ($_REQUEST['input_not_name']) ? 1 : 0;
	$sets['input_not_gender'] = ($_REQUEST['input_not_gender']) ? 1 : 0;


	$sets['excel_type'] = $_REQUEST['excel_type'];
	$sets['judge_login'] = $_REQUEST['judge_login'];

	$sets['pdf_output_limit'] = filter_input(INPUT_POST, "pdf_output_limit");
	$sets['pdf_output_limit_from'] = preg_replace("/\//", "-", filter_input(INPUT_POST, "pdf_output_limit_from"));
	$sets['pdf_output_limit_to'] = preg_replace("/\//", "-", filter_input(INPUT_POST, "pdf_output_limit_to"));
	$sets['pdf_output_count'] = filter_input(INPUT_POST, "pdf_output_count");
	$sets['pdf_output_limit_count'] = filter_input(INPUT_POST, "pdf_output_limit_count");

	if ($_REQUEST['stress'] && @count($_REQUEST['stress'])) {
		$sets['stress_flg'] = 1;
	} else {
		$sets['stress_flg'] = 0;
	}
	if ($basetype <= 2 || $_REQUEST['weightchecked'][$wtype] != "on") {
		$sets['enabled'] = 1;
	} else {
		$sets['enabled'] = 0;
	}
	$sets['fin_disp'] = $_REQUEST['fin_disp'];
	if ($basetype == 1) {
		$sets['exam_download'] = $_REQUEST['exam_download'];
		$sets['enq_status'] = $_REQUEST['enq_status'];
	}
	if ($basetype == 2 && $first == "reg") {
		$sets['exam_download'] = $_REQUEST['exam_download'];
	}


	$sets['licensecard'] = $_REQUEST['licensecard'];

	if ($basetype == 1) {
		$sets['pdf_slice'] = $_REQUEST['pdf_slice'];
	}
	$sets['language'] = $_REQUEST['language'];
	$sets['rest_mail_count'] = $_REQUEST['rest_mail_count'];
	//一括ROWFlG
	if ($sec == "row") {
		$sets['rowflg'] = 1;
	}
	if ($_REQUEST['weightchecked'] && @count($_REQUEST['weightchecked'])) {
		//重み付けするときは0
		$sets['weight'] = 0;
	} else {
		$sets['weight'] = 1;
	}

	//vf検査
	if ($_REQUEST['vf4_object']) {
		$sets['vf4_object'] = $_REQUEST['vf4_object'][4];
	}
	//多面評価検査用
	if ($_REQUEST['tamen_type']) {
		$tamen = implode(":", $_REQUEST['tamen_type']);
		$sets['tamen_type'] = $tamen;
	}
	//pdf出力形式
	if ($basetype == 2) {

		if ($_REQUEST['onChk_72'] || $_REQUEST['onChk_91']) {
			$sets['pdfdownload'] = "5:24";
		} else
	if ($_REQUEST['pdf'][37]) {
			$sets['pdfdownload'] = "37";
		}
	} else {
		if ($_REQUEST["pdf"]) {
			foreach ($_REQUEST["pdf"] as $key => $val) {
				$pdflist .= ":" . $key;
			}
			$pdf = preg_replace("/^:/", "", $pdflist);
			$sets['pdfdownload'] = $pdf;
		}
	}

	$c = 0;
	do {
		$str = $db->getRandomStringDir();

		$f = false;

		// 重複チェック（重複がなくなるまでループ）
		$chk['dir'] = $str;
		$flg = $obj->dirCheck($chk);

		if (!$flg) {
			$f = false;
		} else {
			$f = true;
		}
		// 念のため無限ループ回避
		$c += 1;
		if ($c > 9999) {
			break;
		}
	} while ($f);
	$sets['dir'] = $str;
	$sets['type'] = 0;
	if ($_REQUEST['pdf37_detail_flag']) {
		$sets['pdf37_detail_flag'] = $_REQUEST['pdf37_detail_flag'];
	}
	$tbl = "t_test";

	$lastid = $obj->setData($tbl, $sets);

	$tgrpid = $lastid;
	//ログイン用説明文登録
	if ($_REQUEST['explain']) {
		$explain = array();
		$extbl = "t_test_explain";
		$explain['test_id'] = $tgrpid;
		$explain['explain_text'] = $_REQUEST['explain'];
		$db->setUserData($extbl, $explain);
	}

	//子供用検査IDの取得
	if (count($_REQUEST['count'])) {
		foreach ($_REQUEST['count'] as $key => $vals) {
			$ty = preg_replace("/^on/", "", $key);

			//検査ログデータ
			$log = array();
			$log['cid'] = $id;
			$log['pid'] = $ptid;
			$log['test_id'] = $tgrpid;
			$log['tname'] = $_REQUEST['test_name'];
			$log['number'] = $vals;
			$log['type'] = $ty;
			$log['status'] = 1;
			$logtbl = "log_testpaper";
			$db->setUserData($logtbl, $log);

			$sets = array();
			$sets['partner_id'] = $ptid;
			$sets['customer_id'] = $id;
			$sets['test_id'] = $tgrpid;
			$sets['name'] = $_REQUEST['test_name'];
			$sets['period_from'] = sprintf("%04d/%02d/%02d", $_REQUEST['year1'], $_REQUEST['month1'], $_REQUEST['day1']);
			$sets['period_to'] = sprintf("%04d/%02d/%02d", $_REQUEST['year2'], $_REQUEST['month2'], $_REQUEST['day2']);
			$on = "on" . $key;
			$sets['number'] = $vals;
			$sets['dir'] = $str;
			$sets['type'] = $ty;
			$sets['language'] = $_REQUEST['language'];
			//一括ROWFlG
			if ($sec == "row") {
				$sets['rowflg'] = 1;
			}
			if ($_REQUEST['minute_rest'][$key]) {
				$sets['minute_rest'] = $_REQUEST['minute_rest'][$key];
			}
			if ($_REQUEST['vf4_object'][$ty]) {
				$sets['vf4_object'] = $_REQUEST['vf4_object'][$ty];
			}
			//感情能力検査・社会人版用検査型式
			if ($_REQUEST['rsei'][$ty]) {
				$sets['rsei_type'] = $_REQUEST['rsei'][$ty];
			}
			if ($_REQUEST['amp_type'][$ty]) {
				$sets['amp_type'] = $_REQUEST['amp_type'][$ty];
			}
			if ($_REQUEST['mhq_type'][$ty]) {
				$sets['mhq_type'] = $_REQUEST['mhq_type'][$ty];
			}
			//多面評価検査用
			if ($_REQUEST['tamen_type']) {
				$tamen = implode(":", $_REQUEST['tamen_type']);
				$sets['tamen_type'] = $tamen;
			}
			if (
				$ty == 1
				|| $ty == 2
				|| $ty == 12
				|| $ty == 41
				|| $ty == 59
				|| $ty == 72
				|| $ty == 73
				|| $ty == 82
				|| $ty == 91
			) {
				$sets['w1'] = sprintf("%s", $_REQUEST['weight'][$ty]['w1']);
				$sets['w2'] = sprintf("%s", $_REQUEST['weight'][$ty]['w2']);
				$sets['w3'] = sprintf("%s", $_REQUEST['weight'][$ty]['w3']);
				$sets['w4'] = sprintf("%s", $_REQUEST['weight'][$ty]['w4']);
				$sets['w5'] = sprintf("%s", $_REQUEST['weight'][$ty]['w5']);
				$sets['w6'] = sprintf("%s", $_REQUEST['weight'][$ty]['w6']);
				$sets['w7'] = sprintf("%s", $_REQUEST['weight'][$ty]['w7']);
				$sets['w8'] = sprintf("%s", $_REQUEST['weight'][$ty]['w8']);
				$sets['w9'] = sprintf("%s", $_REQUEST['weight'][$ty]['w9']);
				$sets['w10'] = sprintf("%s", $_REQUEST['weight'][$ty]['w10']);
				$sets['w11'] = sprintf("%s", $_REQUEST['weight'][$ty]['w11']);
				$sets['w12'] = sprintf("%s", $_REQUEST['weight'][$ty]['w12']);
				$sets['ave'] = sprintf("%s", $_REQUEST['weight'][$ty]['ave']);
				$sets['sd'] = sprintf("%s", $_REQUEST['weight'][$ty]['sd']);
				if ($_REQUEST['stress'][$ty]) {
					$sets['stress_flg'] = 1;
				} else {
					$sets['stress_flg'] = 0;
				}
			}
			$sets['pdfdownload'] = $pdf;
			$sets['download_excel'] = sprintf("%s", $_REQUEST['download_excel'][$ty]);
			if ($_REQUEST['weightchecked'][$ty]) {
				//重み付けするときは0
				$sets['weight'] = 0;
			} else {
				$sets['weight'] = 1;
			}
			//登録者が管理者の時は、検査実施可能
			//重み付けをしないときは検査実施可能
			if ($basetype <= 2 || $_REQUEST['weightchecked'][$ty] != "on") {
				$sets['enabled'] = 1;
			} else {
				$sets['enabled'] = 0;
			}
			//添削を選択した際の処理
			$tensaku_title = "";
			if ($_REQUEST['array_tensaku_title'] && @count($_REQUEST['array_tensaku_title'])) {
				foreach ($_REQUEST['array_tensaku_title'] as $tkey => $tval) {
					$tensaku_title .= ";" . $tkey;
				}
			}
			$tensaku_title = preg_replace("/^;/", "", $tensaku_title);
			$sets['array_tensaku_title_status'] = $tensaku_title;

			$tensaku_line = "";
			if ($_REQUEST['tensakukey'] && @count($_REQUEST['tensakukey'])) {
				foreach ($_REQUEST['tensakukey'] as $tkey => $tval) {
					foreach ($tval as $tk => $tv) {
						$tensaku_line .= ";" . $tk;
					}
				}

				$tensaku_line = preg_replace("/^;/", "", $tensaku_line);
				$sets['array_tensaku_text'] = $tensaku_line;
			}

			//t_testの子供データ登録
			$lastid = $obj->setData($tbl, $sets);

			//rowデータ一括登録の時は下記は利用しない
			if ($sec != "row") {
				$tid = $lastid;

				for ($i = 0; $i < $_REQUEST['count'][$key]; $i++) {
					if ($_REQUEST['count'][$key] >= 100) {
						$exam_id = sprintf("%05d", $i + 1);
					} else {
						$c = 0;
						do {
							// ランダムな3桁英小文字
							$exam_id = $db->getRandomString();

							$f = false;

							// 重複チェック（重複がなくなるまでループ）
							$chk_ex['exam_id'] = $exam_id;
							$chk_ex['test_id'] = $tid;
							$flg = $obj->idCheck($chk_ex);
							usleep(200000);
							if (!$flg) {
								$f = false;
							} else {
								$f = true;
							}
							// 念のため無限ループ回避
							$c += 1;
							if ($c > 9999) {
								break;
							}
						} while ($f);
						if (!$regEx[$i]) {
							$regEx[$i] = $exam_id;
						}
					}


					$a_num[$i] = $i + 1;
					$a_tgrpid[$i] = $tgrpid;
					$a_ptnid[$i] = $ptid;
					$a_cusid[$i] = $id;
					$a_tstid[$i] = $tid;
					if (!$regEx[$i]) {
						$a_ex[$i] = $exam_id;
					} else {
						$a_ex[$i] = $regEx[$i];
					}
					$a_type[$i] = $ty;
				}
				$obj->setTestPaperData($a_num, $a_tgrpid, $a_ptnid, $a_cusid, $a_tstid, $a_ex, $a_type);
			} //rowデータ一括登録の時は下記は利用しない終わり
		} //for文終わり

	} ////子供用検査IDの取得終わり


	//rowデータ一括登録の時は下記は利用しない
	if ($sec != "row") {

		//----------------------------------------------
		//顧客企業メール配信
		//
		//----------------------------------------------
		//顧客情報取得
		$where = array();
		$where['id'] = $id;
		$cdata = $obj->getUserData($where);
		//パートナー情報取得
		$where['id'] = $ptid;
		$ptdata = $obj->getUserData($where);
		$period     = $sets['period_from'] . "～" . $sets['period_to'];
		$number     = $sets['number'];
		//--------------------------------
		//メール配信 担当者１
		//---------------------------------
		$mail['subject'] = "【" . $ptdata['name'] . "】検査登録のお知らせ";
		$mail['to'] = $cdata['rep_email'];
		$body = "";
		$body = $cdata['name'] . "\n" . $cdata['rep_name'] . "様\n";
		$body .= $ptdata['partner_name'] . "サポートデスクよりお知らせです。\n\n";
		$body .= $_REQUEST['test_name'] . "の検査情報を受付ました。\n";
		$body .= "受検可能になるまで、もうしばらくお待ち下さい。\n";
		$body .= "検査詳細情報を登録次第、ご連絡致します。\n";
		$body .= "\n";
		$body .= "顧客名：" . $cdata['name'] . "\n";
		$body .= "検査名：" . $_REQUEST['test_name'] . "\n";
		$body .= "期間：" . $period . "\n";
		$body .= "受検者数：" . $number . "\n";
		$body .= "\n";
		$body .= "以上、宜しくお願い致します。\n";
		$body .= "\n";
		$body2 .= "----------------------------------------------\n";
		$body2 .= "■ ご登録内容についてのお問い合わせ窓口 ■\n";
		$body2 .= $ptdata['name'] . "　担当：" . $ptdata['rep_name'] . "\n";
		$body2 .= "e-mail：" . $ptdata['rep_email'] . "\n";
		$body2 .= "--------------------------------------------- \n";
		$mail['body'] = $body . $body2;
		$db->sendMailer($mail);


		//担当者２-----------------------------------------------------------------------------
		if ($cdata['rep_email2']) {
			$mail = array();
			$mail['subject'] = "【" . $ptdata['name'] . "】検査登録のお知らせ";
			$mail['to'] = $cdata['rep_email2'];
			$body = "";
			$body = "";
			$body = $cdata['name'] . "\n" . $cdata['rep_name2'] . "様\n";
			$body .= $ptdata['partner_name'] . "サポートデスクよりお知らせです。\n\n";
			$body .= $_REQUEST['test_name'] . "の検査情報を受付ました。\n";
			$body .= "受検可能になるまで、もうしばらくお待ち下さい。\n";
			$body .= "検査詳細情報を登録次第、ご連絡致します。\n";
			$body .= "\n";
			$body .= "顧客名：" . $cdata['name'] . "\n";
			$body .= "検査名：" . $_REQUEST['test_name'] . "\n";
			$body .= "期間：" . $period . "\n";
			$body .= "受検者数：" . $number . "\n";
			$body .= "\n";
			$body .= "以上、宜しくお願い致します。\n";
			$body .= "\n";

			$mail['body'] = $body . $body2;
			$db->sendMailer($mail);
		}
		//--------------------------------------------------------------------------------------


		//----------------------------------------------
		//パートナー企業メール配信
		//
		//----------------------------------------------
		$mail = array();
		$mail['subject'] = "【" . $ptdata['name'] . "】検査登録のお知らせ";
		$mail['to'] = $ptdata['rep_email'];
		$body = "";
		$body = "";
		$body = $ptdata['name'] . "\n" . $ptdata['rep_name'] . "様\n";
		$body .= $ptdata['partner_name'] . "サポートデスクよりお知らせです。\n\n";
		$body .= $_REQUEST['test_name'] . "の検査情報を受付ました。\n";
		$body .= "受検可能になるまで、もうしばらくお待ち下さい。\n";
		$body .= "検査詳細情報を登録次第、ご連絡致します。\n";
		$body .= "\n";
		$body .= "顧客名：" . $cdata['name'] . "\n";
		$body .= "検査名：" . $_REQUEST['test_name'] . "\n";
		$body .= "期間：" . $period . "\n";
		$body .= "受検者数：" . $number . "\n";
		$body .= "\n";
		$body .= "以上、宜しくお願い致します。\n";
		$body .= "\n";

		$mail['body'] = $body . $body2;
		$db->sendMailer($mail);

		//担当者２-----------------------------------------------------------------------------
		if ($cdata['rep_email2']) {
			$mail = array();
			$mail['subject'] = "【" . $ptdata['name'] . "】検査登録のお知らせ";
			$mail['to'] = $ptdata['rep_email2'];
			$body = "";
			$body = "";
			$body = $ptdata['name'] . "\n" . $ptdata['rep_name2'] . "様\n";
			$body .= $ptdata['partner_name'] . "サポートデスクよりお知らせです。\n\n";
			$body .= $_REQUEST['test_name'] . "の検査情報を受付ました。\n";
			$body .= "受検可能になるまで、もうしばらくお待ち下さい。\n";
			$body .= "検査詳細情報を登録次第、ご連絡致します。\n";
			$body .= "\n";
			$body .= "顧客名：" . $cdata['name'] . "\n";
			$body .= "検査名：" . $_REQUEST['test_name'] . "\n";
			$body .= "期間：" . $period . "\n";
			$body .= "受検者数：" . $number . "\n";
			$body .= "\n";
			$body .= "以上、宜しくお願い致します。\n";
			$body .= "\n";

			$mail['body'] = $body . $body2;
			$db->sendMailer($mail);
		}

		//----------------------------------------------
		//管理者にメール配信
		//
		//----------------------------------------------
		$where['id'] = $id;
		$master = $obj->getMasterData($where);
		$mail['subject'] = "【" . $ptdata['name'] . "】検査登録のお知らせ";
		$mail['to'] = $master['rep_email'];
		$body = "";
		$body = "";
		$body = $master['name'] . "\n" . $ptdata['rep_name'] . "様\n";
		$body .= $ptdata['partner_name'] . "サポートデスクよりお知らせです。\n\n";
		$body .= $_REQUEST['test_name'] . "の検査情報を受付ました。\n";
		$body .= "受検可能になるまで、もうしばらくお待ち下さい。\n";
		$body .= "検査詳細情報を登録次第、ご連絡致します。\n";
		$body .= "\n";
		$body .= "顧客名：" . $cdata['name'] . "\n";
		$body .= "検査名：" . $_REQUEST['test_name'] . "\n";
		$body .= "期間：" . $period . "\n";
		$body .= "受検者数：" . $number . "\n";
		$body .= "\n";
		$body .= "以上、宜しくお願い致します。\n";
		$body .= "\n";

		$mail['body'] = $body . $body2;
		$db->sendMailer($mail);
		sleep(2);
		if ($basetype <= 2) {
			$mail3 = array();
			$url = D_URL_TEST . "?k=" . base64_encode($str);

			$mail3['subject'] = "【" . $ptdata['name'] . "】受検可能のお知らせ";
			$mail3['to'] = $cdata['rep_email'];

			$body = $cdata['name'] . "\n" . $cdata['rep_name'] . "様\n\n";
			$body .= "サポートデスクよりお知らせです。\n";
			$body .= "\n";
			$body .= "受検が可能になりましたので、お知らせ致します。\n";
			$body .= "ログインして、ご確認下さい。\n";
			$body .= "\n";
			$body .= "URL：" . D_URLS_HOME . "\n";
			$body .= "\n";
			$body .= "検査名：" . $_REQUEST['test_name'] . "\n";
			$body .= "検査ＵＲＬ：" . $url . "\n";
			$body .= "期間：" . $period . "\n";
			$body .= "受検者数：" . $number . "\n";
			$body .= "\n";
			$body .= "詳細な検査情報や、受検者用のIDは、管理画面にログインしてご確認ください。\n";
			$body .= "以上、宜しくお願い致します。-------------------------------------------------------------------------------------------------------------------------";

			$mail3['body'] = $body;
			$db->sendMailer($mail3);
			$mail3['to'] = $cdata['rep_email2'];
			if ($mail3['to']) {
				$db->sendMailer($mail3);
			}

			$url = D_URL_TEST . "?k=" . base64_encode($str);
			$mail3 = array();
			$mail3['subject'] = "【" . $ptdata['name'] . "】受検可能のお知らせ";
			$mail3['to'] = $ptdata['rep_email'];

			$body = $ptdata['name'] . "\n" . $ptdata['rep_name'] . "様\n\n";
			$body .= $logoname . "管理システムよりお知らせです。\n";
			$body .= "\n";
			$body .= $logoname . "管理システムの検査受検が可能になりましたので、\n";
			$body .= "お知らせ致します。\n";
			$body .= "ログインして、ご確認下さい。\n";
			$body .= "\n";
			$body .= "URL：" . D_URLS_HOME . "\n";
			$body .= "\n";
			$body .= "検査名：" . $_REQUEST['test_name'] . "\n";
			$body .= "検査ＵＲＬ：" . $url . "\n";
			$body .= "期間：" . $period . "\n";
			$body .= "受検者数：" . $number . "\n";
			$body .= "詳細な検査情報や、受検者用のIDは、管理画面にログインしてご確認ください。";
			$body .= "\n";
			$body .= "以上、宜しくお願い致します。\n";

			$mail3['body'] = $body . $body2;

			$db->sendMailer($mail3);

			$mail3['to'] = $ptdata['rep_email2'];
			if ($mail3['to']) {
				$db->sendMailer($mail3);
			}
		}
	} //rowデータ一括登録の時は下記は利用しない終わり
}
