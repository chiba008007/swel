<?PHP
$array_pos = array(
	1 => "社長・役員・事業部長相当", 2 => "部長相当", 3 => "課長相当", 4 => "主任・リーダー相当", 5 => "その他"
);
if ($five == "anq") {
	echo mb_convert_encoding("アンケート日", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検者ID", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検者名", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検者名かな", "SJIS", "UTF-8");
	echo mb_convert_encoding(",メールアドレス", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答1", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答2", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答3", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答4", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答5", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答6", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答7", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答8", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答9", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答10", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答11", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答12", "SJIS", "UTF-8");
	echo mb_convert_encoding(",回答13", "SJIS", "UTF-8");

	echo "\n";
	if (count($tlist['ans'])) {
		foreach ($tlist['ans'] as $key => $val) {
			echo "" . mb_convert_encoding($val['start_date'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['empnum'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['sei'] . $val['mei'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['sei_kana'] . $val['mei_kana'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['mail'], "SJIS-WIN", "UTF-8") . ",";
			for ($i = 1; $i <= 13; $i++) {
				$anq = "anq" . $i;
				echo mb_convert_encoding($val[$anq], "SJIS-WIN", "UTF-8") . ",";
			}
			echo "\n";
		}
	}
} else {
	echo mb_convert_encoding("検査名,", "SJIS", "UTF-8") . mb_convert_encoding($tlist['testname'], "SJIS", "UTF-8") . "\n";
	echo mb_convert_encoding("パートナー企業,", "SJIS", "UTF-8") . mb_convert_encoding($tlist['ptname'], "SJIS", "UTF-8") . "\n";
	echo mb_convert_encoding("顧客企業,", "SJIS", "UTF-8") . mb_convert_encoding($tlist['cname'], "SJIS", "UTF-8") . "\n";
	echo mb_convert_encoding("受検者ID", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検者名", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検者名かな", "SJIS", "UTF-8");
	echo mb_convert_encoding(",生年月日", "SJIS", "UTF-8");
	echo mb_convert_encoding(",年齢", "SJIS", "UTF-8");
	echo mb_convert_encoding(",性別", "SJIS", "UTF-8");
	echo mb_convert_encoding(",合否", "SJIS", "UTF-8");
	echo mb_convert_encoding(",メモ１", "SJIS", "UTF-8");
	echo mb_convert_encoding(",メモ２", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検日", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検開始時間", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検時間", "SJIS", "UTF-8");
	echo mb_convert_encoding(",受検種別", "SJIS", "UTF-8");
	echo mb_convert_encoding(",関係者ID", "SJIS", "UTF-8");
	if ($_REQUEST['type'] == "sub") {
		echo mb_convert_encoding(",回答1(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答1(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答1(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答1(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答1(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答1(6)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答2", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(10)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(11)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(12)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(10)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(11)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(12)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答5(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(9)", "SJIS", "UTF-8");


		echo mb_convert_encoding(",回答6(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(7)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答7(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(10)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(11)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(12)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(13)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(14)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(15)", "SJIS", "UTF-8");


		echo mb_convert_encoding(",回答8(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(8)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答9(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答9(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答9(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答9(4)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答10(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(7)", "SJIS", "UTF-8");


		echo mb_convert_encoding(",回答11(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(6)", "SJIS", "UTF-8");



		echo mb_convert_encoding(",回答12(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答12(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答12(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答12(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答12(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答12(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答12(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答12(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答12(9)", "SJIS", "UTF-8");



		echo mb_convert_encoding(",回答13(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(10)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(11)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(12)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13(13)", "SJIS", "UTF-8");



		echo mb_convert_encoding(",回答14", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答15", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答16", "SJIS", "UTF-8");
	} else {
		echo mb_convert_encoding(",回答1", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答2(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答2(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答2(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答2(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答2(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答2(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(10)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(11)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答3(12)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答4(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(10)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(11)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答4(12)", "SJIS", "UTF-8");


		echo mb_convert_encoding(",回答5(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答5(9)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答6(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答6(7)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答7(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(10)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(11)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(12)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(13)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(14)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答7(15)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答8(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答8(8)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答9(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答9(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答9(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答9(4)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答10(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答10(10)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答11(1)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(2)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(3)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(4)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(5)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(6)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(7)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(8)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(9)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(10)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(11)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(12)", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答11(13)", "SJIS", "UTF-8");

		echo mb_convert_encoding(",回答12", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答13", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答14", "SJIS", "UTF-8");
		echo mb_convert_encoding(",回答15", "SJIS", "UTF-8");
	}
	echo "\n";
	if (count($tlist['ans'])) {

		foreach ($tlist['ans'] as $key => $val) {
			echo "=\"" . mb_convert_encoding($val['empnum'], "SJIS-WIN", "UTF-8") . "\",";
			echo mb_convert_encoding($val['sei'] . $val['mei'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['sei_kana'] . $val['mei_kana'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['birth'], "SJIS-WIN", "UTF-8") . ",";
			if ($val['age'] > 0) {
				echo mb_convert_encoding($val['age'], "SJIS-WIN", "UTF-8") . ",";
			}
			echo mb_convert_encoding($val['sex'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['pass'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['memo1'], "SJIS-WIN", "UTF-8") . ",";
			echo mb_convert_encoding($val['memo2'], "SJIS-WIN", "UTF-8") . ",";
			//受験日
			$examdate = substr($val['starttime'], 0, 11);
			$examtime = substr($val['starttime'], 11, 8);
			echo $examdate . ",";
			echo $examtime . ",";
			$starttime = strtotime($val['starttime']);
			$endtime  = strtotime($val['endtime']);
			$times = s2h($endtime - $starttime);
			if ($times < 0) {
				$times = "";
			}
			echo $times . ",";
			echo $val['boss'] . ",";
			echo $obj->emp[$val['rep']] . ",";
			for ($i = 1; $i <= 129; $i++) {
				$ans = "ans" . $i;

				echo str_replace(array("\r\n", "\r", "\n"), "", mb_convert_encoding($val[$ans], "SJIS-WIN", "UTF-8")) . ",";
			}
			echo "\n";
		}
	}
}

function s2h($seconds)
{
	$hours = floor($seconds / 3600);
	$minutes = floor(($seconds / 60) % 60);
	$seconds = $seconds % 60;
	$hms = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
	return $hms;
}
function commaEscape4csv($str)
{
	if (!(strstr($str, ',') === False)) {
		$str = preg_replace('/"/', '""', $str);
		$str = '"' . $str . '"';
	}
	return $str;
}
