<?php

//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusDownload.php");

$obj = new cusDownloadMethod();

$adisp[0] = "未開封";
$adisp[1] = "開封済み";
//idの取得
$where[ 'id' ] = $id;
$data = $obj->getId($where);
$login_id = $data[ 'login_id' ];
if ($_REQUEST[ 'lists' ] == "list") {
    if ($_REQUEST[ 'lang' ] == "ch") {
        $adisp[0] = "未开封";
        $adisp[1] = "开业";
    }
    $where = array();

    $where[ 'partner_id' ] = $id;
    $where[ 'dir_id'     ] = $login_id;
    $where[ 'filename'   ] = $_REQUEST[ 'name'  ];
    $where[ 'order'      ] = $_REQUEST[ 'order' ];
    $where[ 'basetype'      ] = $basetype;

    $file = $obj->getFileData($where);
    $html = "";
    if (count($file)) {
        foreach ($file as $key=>$val) {
            $html .= "<tr>";
            $html .= "<td >".$val[ 'regist_date' ]."</td>";
            $html .= "<td ><a href='/index/download/".$val['id']."'>".$val[ 'filename'    ]."</a></td>";
            $html .= "<td >".$val[ 'size'        ]."</td>";
            $html .= "<td >".$adisp[$val[ 'status']]."</td>";
            $html .= "</tr>";
        }
    }
    echo $html;
    exit();
}
//-------------------------------------------
//ファイルダウンロード
//-------------------------------------------

if (is_numeric($sec)) {
    $where = array();
    $where[ 'id'         ] = $sec;
    $where[ 'dir_id'     ] = $login_id;
    $where[ 'partner_id' ] = $id;
    $file = $obj->getFileName($where);
    $filename = mb_convert_encoding($file[0][ 'filename' ], "SJIS", 'UTF-8');

    $fname = "./tmpfile/".$login_id."/".$filename;
    //ステータス変更
    $obj->editStatus($where);


    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Content-Length: '.filesize($fname));
    header('Cache-Control: public');
    header('Pragma: public');
    readfile($fname);

    exit();
}
