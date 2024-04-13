<?PHP
require_once("./lib/include_row.php");
$obj = new rowMethod($id);


$data = $obj->getPartner();
$data[0][ 'name' ] = "企業名";
$data[0][ 'registtime' ] = "更新日";
$data[0][ 'regist_ts' ] = "登録日";
$data[0][ 'logo_name'  ] = "管理システム名";
ksort($data);
// 書き込み
$fp = fopen('./csv/partner.csv', 'w');
if(count($data)){
	fwrite($fp, arr2csv($data));
}
fclose($fp);

$data = array();
$data = $obj->getCustomer();
$data[0][ 'cname' ] = "企業名";
$data[0][ 'pname' ] = "パートナー企業名";
$data[0][ 'req_address'  ] = "担当者アドレス";
$data[0][ 'req_address2' ] = "担当者アドレス2";
$data[0][ 'registtime' ] = "更新日";
$data[0][ 'regist_ts' ] = "登録日";


ksort($data);
// 書き込み
$fp = fopen('./csv/customer.csv', 'w');
if(count($data)){
	fwrite($fp, arr2csv($data));
}
fclose($fp);

$zip = new ZipArchive();
// Zipファイル名
$zipFileName = 'download.zip';
// Zipファイル一時保存ディレクトリ
$zipTmpDir = './csv/';

// Zipファイルオープン
$result = $zip->open($zipTmpDir.$zipFileName, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
if ($result !== true) {
    // 失敗した時の処理
}
 
// ここでDB等から画像イメージ配列を取ってくる
$image_data_array = glob("./csv/*");

// 処理制限時間を外す
set_time_limit(0);
 
foreach ($image_data_array as $filepath) {
 
    $filename = basename($filepath);
 
    // 取得ファイルをZipに追加していく
    $zip->addFromString($filename,file_get_contents($filepath));
 
}
				
$zip->close();
 
// ストリームに出力
header('Content-Type: application/zip; name="' . $zipFileName . '"');
header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
header('Content-Length: '.filesize($zipTmpDir.$zipFileName));
echo file_get_contents($zipTmpDir.$zipFileName);
 
// 一時ファイルを削除しておく
unlink($zipTmpDir.$zipFileName);



function arr2csv($fields) {
    $fp = fopen('php://temp', 'r+b');
    foreach($fields as $field) {
        fputcsv($fp, $field);
    }
    rewind($fp);
    $tmp = str_replace(PHP_EOL, "\r\n", stream_get_contents($fp));
    return mb_convert_encoding($tmp, 'SJIS-win', 'UTF-8');
}
exit();

?>