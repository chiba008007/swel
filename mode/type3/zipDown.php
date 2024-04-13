<?PHP
	require_once("./lib/zip_lib.php");

	$zipfile = new zipfile();
	//ディレクトリ以下にあるファイル取得
	$dirs = D_PATH_HOME."pdfDownload/".$sec."_".$third."/*";
	$glob = glob($dirs);

	//ファイルのコピー
	foreach($glob as $key=>$val){
		$filename = basename($val);
		copy($val,D_PATH_HOME.$filename);
		//圧縮するファイルのパス
		$file1 = $filename;
		//ファイルを追加
		$zipfile->addFile(file_get_contents($file1), $file1);
		file_put_contents(D_PATH_HOME.'pdfDownload/'.$sec.'_'.$third.'.zip', $zipfile->file());
		//ファイルの削除
		unlink($file1);
	}
	
	$down = "./pdfDownload/".$sec."_".$third.".zip";
	$file = basename($down);
	header('Content-Type: application/octet-stream'); 
	header('Content-Disposition: attachment; filename="'.$file.'"'); 
	readfile($down);

exit();
?>
