<?PHP
//-------------------------------------------
//PDFロゴ画像
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_ptnLogo.php");

$obj = new ptnLogoMethod();

//プレビュー用ディレクトリの作成
$pre = D_PATH_HOME."images/preview/";
$Pdfpre = D_PATH_HOME."images/preview/pdflogo/";

@mkdir($pre);
@mkdir($Pdfpre);

$where[ 'id' ] = $id;
$user = $obj->getUser($where);
$loginid = $user[ 0 ][ 'login_id' ]; 

//------------------------
//画像更新
//------------------------

if($_REQUEST[ 'lists' ] == "logo"){
	$prev = "./images/preview/pdflogo/".$loginid.".jpg";
	$new  = "./img/pdflogo/pl_".$loginid.".jpg";
	rename($prev,$new);
	exit();
}
if($_REQUEST[ 'lists' ] == "delete"){
	//$img  = "./img/pdflogo/pl_".$loginid.".jpg";
        $img  = "./images/preview/pdflogo/".$loginid.".jpg";
	unlink($img);
	exit();
}
?>