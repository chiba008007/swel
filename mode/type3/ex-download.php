<?PHP
//--------------------------------
//エクセルダウンロード
//
//
//------------------------------------
$ex = explode("/", $_SERVER['HTTP_REFERER']);
$sets = [];
$atype = 5;
$sets['exam_id'] = $ex[5];
$sets['user_id'] = $id;
$sets['base_id'] = $_SESSION['base_id'];
$sets['type'] = $atype;
$sets['before_url'] = $_SERVER['HTTP_REFERER'];
$db->setUserData("analytics_admin", $sets);

$filename = $_REQUEST['filename'];
$filepath = D_PATH_HOME . "/excelTemp8/" . $filename;

header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
header('Content-Type: application/octet-stream');
header('Content-Transfer-Encoding: binary');
//header('Content-Length: '.filesize($filepath));
readfile($filepath);
exit();
