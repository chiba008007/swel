<?PHP
//-------------------------------------------
//データ登録
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_jug.php");
$obj = new jug();

//テンプレートダウンロード
if($_REQUEST[ 'tempflg' ] == "on"){
	$fileName = date("YmdHis") . ".csv";
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=' . $fileName);
	echo mb_convert_encoding("連番","SJIS","UTF-8").",";
	echo mb_convert_encoding("上司","SJIS","UTF-8").",";
	echo mb_convert_encoding("部署名","SJIS","UTF-8").",";
	echo mb_convert_encoding("役職名","SJIS","UTF-8").",";
	echo mb_convert_encoding("社員番号","SJIS","UTF-8").",";
	echo mb_convert_encoding("姓","SJIS","UTF-8").",";
	echo mb_convert_encoding("名","SJIS","UTF-8").",";
	echo mb_convert_encoding("姓（かな）","SJIS","UTF-8").",";
	echo mb_convert_encoding("名（かな）","SJIS","UTF-8").",";
	echo mb_convert_encoding("メールアドレス","SJIS","UTF-8").",";
	echo mb_convert_encoding("生年月日","SJIS","UTF-8").",";
	echo mb_convert_encoding("担当社員番号","SJIS","UTF-8").",";

	echo "\n";

	exit();
}
//CSV登録
if($_REQUEST[ 'upload' ] ){
	//最大登録件数
	$where = array();
	$where[ 'testgrp_id' ] = $sec;
	$cnt = $obj->getRegCount($where);
	$size          = $_FILES[ 'files' ][ 'size' ];
	$file_tmp_name = $_FILES["files"]["tmp_name"];
	$file_name     = $_FILES["files"]["name"];

	$errmsg = '';
	if($size && $size > 100000 ){
		$errmsg = "ファイルサイズが大きすぎます。";
	}
	if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
		$errmsg = "CSVファイルのみ対応しています。";
	}
	//アップロードしたファイルの件数
	if(!$errmsg){
		$fcount = count(file($file_tmp_name))-1;
		if($cnt < $fcount){
			$errmsg = "登録件数が多すぎます。";
		}
	}
	if(!$errmsg){
		setlocale(LC_ALL, 'ja_JP.UTF-8');
		setlocale(LC_ALL, 'ja_JP.EUC-JP');
		setlocale(LC_ALL, 'ja_JP.Shift_JIS');

		$tmp = fopen($file_tmp_name,"r");
		while ($csv[] = fgetcsv_reg($tmp)) {}
		mb_convert_variables("UTF-8", "SJIS-win", $csv);
		$flg = $obj->setData($csv,$where);
		if($flg == "1") $errmsg = "すでに登録されている社員番号がファイルに含まれています。";
		if($flg == "2") $errmsg = "すでに登録されている連番がファイルに含まれています。";
		if($flg == "3") $errmsg = "登録データに誤りがあります。";
		if($flg == "4") $errmsg = "登録できない連番が含まれています。";
		fclose($tmp);
	}
}

//登録データ取得
$limit = 100;
$offset = sprintf("%d",$limit*$_REQUEST[ 'page' ]);
$where = array();
$where[ 'testgrp_id' ] = $sec;
$where[ 'limit'  ] = $limit;
$where[ 'offset' ] = $offset;
if(is_numeric($third)){
	$where[ 'id' ] = $third;
}

$judrow = $obj->getJug($where,1);
$ceil = ceil($judrow/$limit);
$jud = $obj->getJug($where);

//$thirdが数値のときはテンプレート変更
$int = (int)$third;
if($int > 0 && is_numeric($third)){
	//上司一覧取得
	$boss = $obj->getBoss($where);
	//登録処理
	if($_REQUEST[ 'update' ]){
		//エラーチェック
		if(!$_REQUEST[ 'mail' ]){
			$errmsg = "メールアドレスが入力されていません。";
		}
		if(!$_REQUEST[ 'sei_kana' ] || !$_REQUEST[ 'mei_kana' ]){
			$errmsg = "姓名(かな)が入力されていません。";
		}
		if(!$_REQUEST[ 'sei' ] || !$_REQUEST[ 'mei' ]){
			$errmsg = "姓名が入力されていません。";
		}
		if(!$_REQUEST[ 'empnum' ]){
			$errmsg = "社員番号が入力されていません。";
		}
		if(!$_REQUEST[ 'yakusyoku' ]){
			$errmsg = "役職名が入力されていません。";
		}
		if(!$_REQUEST[ 'busyo' ]){
			$errmsg = "部署名が入力されていません。";
		}
		if(!$_REQUEST[ 'year' ] || !checkdate($_REQUEST[ 'month' ],$_REQUEST[ 'day' ],$_REQUEST[ 'year' ])){
			$errmsg = "生年月日に誤りがあります。";
		}
		if(!$errmsg){
			$table = "jug_member";
			$edit = array();
			$edit[ 'where' ][ 'id' ] = $third;
		//	$edit[ 'edit'  ][ 'bossflg' ] = $_REQUEST[ 'bossflg' ];
			$edit[ 'edit'  ][ 'busyo' ] = $_REQUEST[ 'busyo' ];
			$edit[ 'edit'  ][ 'yakusyoku' ] = $_REQUEST[ 'yakusyoku' ];
			$edit[ 'edit'  ][ 'empnum' ] = $_REQUEST[ 'empnum' ];
			$edit[ 'edit'  ][ 'sei' ] = $_REQUEST[ 'sei' ];
			$edit[ 'edit'  ][ 'mei' ] = $_REQUEST[ 'mei' ];
			$edit[ 'edit'  ][ 'sei_kana' ] = $_REQUEST[ 'sei_kana' ];
			$edit[ 'edit'  ][ 'mei_kana' ] = $_REQUEST[ 'mei_kana' ];
			$edit[ 'edit'  ][ 'mail' ] = $_REQUEST[ 'mail' ];

			//$edit[ 'edit'  ][ 'empnum_rep' ] = $_REQUEST[ 'empnum_rep' ];
			$db->editUserData($table,$edit);
			$edit = array();
			$edit[ 'edit'  ][ 'birth' ] = sprintf("%04d/%02d/%02d",$_REQUEST[ 'year' ],$_REQUEST[ 'month' ],$_REQUEST[ 'day' ]);
			$edit[ 'edit'  ][ 'sex' ] = $_REQUEST[ 'sex' ];
			$edit[ 'edit'  ][ 'pass'  ] = $_REQUEST[ 'pass' ];
			$edit[ 'edit'  ][ 'memo1' ] = $_REQUEST[ 'memo1' ];
			$edit[ 'edit'  ][ 'memo2' ] = $_REQUEST[ 'memo2' ];
			$edit[ 'where' ][ 'id' ] = $third;
			$table = "t_testpaper";
			$obj->editTestPaperData($edit);
			$msg = "データの更新を行いました。";
		}
	}
	$html = "jregistEdit";
}
if($third == "delete"){
	$where[ 'id' ] = $four;
	$obj->delete($where);
	$msg = "データの削除を行いました。";
}



function fgetcsv_reg (&$handle, $length = null, $d = ',', $e = '"') {
    $d = preg_quote($d);
    $e = preg_quote($e);
    $_line = "";
    while (($eof != true)and(!feof($handle))) {
        $_line .= (empty($length) ? fgets($handle) : fgets($handle, $length));
        $itemcnt = preg_match_all('/'.$e.'/', $_line, $dummy);
        if ($itemcnt % 2 == 0) $eof = true;
    }
    $_csv_line = preg_replace('/(?:\\r\\n|[\\r\\n])?$/', $d, trim($_line));
    $_csv_pattern = '/('.$e.'[^'.$e.']*(?:'.$e.$e.'[^'.$e.']*)*'.$e.'|[^'.$d.']*)'.$d.'/';
    preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
    $_csv_data = $_csv_matches[1];
    for($_csv_i=0;$_csv_i<count($_csv_data);$_csv_i++){
        $_csv_data[$_csv_i]=preg_replace('/^'.$e.'(.*)'.$e.'$/s','$1',$_csv_data[$_csv_i]);
        $_csv_data[$_csv_i]=str_replace($e.$e, $e, $_csv_data[$_csv_i]);
    }
    return empty($_line) ? false : $_csv_data;
}


?>