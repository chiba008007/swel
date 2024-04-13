<?php

//-------------------------------------------
//パートナー情報削除
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_ptnTmp.php");

$obj = new ptnTmpMethod();

//ステータス
$a_status[0] = "未開封";
$a_status[1] = "開封済";

//ディレクトリ取得
$dirs['id'] = $sec;
$dirid = $obj->getDir($dirs);

if ($_REQUEST[ 'lists' ]) {
    //データ取得

    $where = array();
    $where[ 'partner_id' ] = $sec;
    $where[ 'id'         ] = $id;
    $where[ 'order'      ] = $_REQUEST[ 'order' ];
    $where[ 'filename'   ] = $_REQUEST[ 'text'  ];
    $where[ 'status'     ] = $_REQUEST[ 'stsText' ];
    $where[ 'basetype'   ] = $basetype;
    $file = $obj->getFileData($where);

    $html = "";
    if ($file && count($file)) {
        foreach ($file as $key=>$val) {
            $html .= "<tr>\n";
            $html .= "<td><div class='indent'><input type='checkbox' name='del[".$val[ 'id' ]."]' value=".$val[ 'id' ]." id='chk_".$val[ 'id' ]."' class='chk'></div>";
            $html .= "<img src='/images/check_off.gif' class='chkImg'  id='chkImg_".$val[ 'id' ]."' >";
            $html .= "</td>\n";
            $html .= "<td>".$val[ 'regist_ts' ]."</td>\n";
            $enc = urlencode($val[ 'filename' ]);
            $html .= "<td><a href='/index/tmp/".$sec."/".$val['id']."/".$enc."' >".$val[ 'filename' ]."</a></td>\n";
            $html .= "<td>".$val[ 'size' ]."</td>\n";
            $html .= "<td>".$a_status[$val[ 'status' ]]."</td>\n";
            $html .= "<td><div class=mg><input type='button' id='del_".$val[ 'id' ]."' class='del button2' value='削除' ></div></td>\n";
            $html .= "</tr>";
        }
    }
    echo $html;
    exit();
}

//-----------------------------
//ファイルﾀﾞｳﾝﾛｰﾄﾞ
//-----------------------------
if ($third > 0 && is_numeric($third)) {
    $file = urldecode($four);
    $id   = $third;
    //ﾀﾞｳﾝﾛｰﾄﾞデータ取得
    $where[ 'id'         ] = $id;
    $where[ 'partner_id' ] = $sec;
    $where[ 'filename'   ] = $file;
    $file = $obj->getDown($where);
    $filename = mb_convert_encoding($file[ 'filename' ], "SJIS", "UTF-8");

    //ステータスの変更
    $where = array();
    $tbl = "uploadfile";
    $where[ 'edit'  ][ 'status'       ] = 1;
    $where[ 'where' ][ 'id'           ] = $id;
    $where[ 'where' ][ 'partner_id'   ] = $sec;

    $obj->editUserData($tbl, $where);

    header("Content-Type: application/octet-stream");
    // ダイアログボックスに表示するファイル名
    header("Content-Disposition: attachment; filename=".$filename);
    // 対象ファイルを出力する。

    $tmp_file = "./tmpfile/".$file[ 'dir_id' ]."/".$filename;
    readfile($tmp_file);

    exit();
}
//-----------------------------
//ファイル削除
//-----------------------------
if ($_REQUEST[ 'delete' ]) {
    $where = array();
    $where[ 'id'         ] = $_REQUEST[ 'id' ];
    $where[ 'partner_id' ] = $sec;
    $file = $obj->getDown($where);
    $filename = $file[ 'filename' ];
    $tmp_file = "./tmpfile/".$file[ 'dir_id' ]."/".$filename;
    @unlink($tmp_file);
    $obj->delFile($where);
    exit();
}


if ($_REQUEST[ 'delcheck' ]) {
    if (count($_REQUEST[ 'del' ])) {
        $i = 0;
        foreach ($_REQUEST[ 'del' ] as $key=>$val) {
            $where = array();
            $where[ 'id'         ] = $val;
            $where[ 'partner_id' ] = $sec;
            $file = $obj->getDown($where);
            $filename = $file[ 'filename' ];
            $tmp_file = "./tmpfile/".$file[ 'dir_id' ]."/".$filename;
            @unlink($tmp_file);
            $obj->delFile($where);
            $i++;
        }
    }
}

//-----------------------------
//ファイルアップロード
//-----------------------------
//if($third == "up"){
if ($_REQUEST[ 'reg' ] && $_FILES[ 'upfile' ][ 'name' ]) {
    $dirs = $dirid[ 'login_id' ];
    $file_nm = $_FILES['upfile']['name'];
    $extension = pathinfo($file_nm, PATHINFO_EXTENSION);
    @mkdir("./tmpfile/".$dirs, 0755);
    $filename = mb_convert_encoding($_FILES["upfile"]["name"], "shift-jis", "auto");
    if ($_FILES[ 'upfile' ][ 'error' ]) {
        $errflg = 1;
    } else {
        if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
            if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "./tmpfile/".$dirs."/".$filename)) {
                chmod("./tmpfile/".$dirs."/".$filename, 0644);
                $size = filesize("./tmpfile/".$dirs."/".$filename);

                if ($size >= 30000000) {
                    $errflg = 1;
                }
            }
        }
    }

    if ($errflg) {
        $alert = "ファイルのアップロード失敗しました。";
    } else {
        $edit = array();
        $edit[ 'dir_id'     ] = $dirs;
        $edit[ 'partner_id' ] = $sec;
        $edit[ 'size'       ] = $size;
        $edit[ 'filename'   ] = $_FILES["upfile"]["name"];
        $edit[ 'regist_date '  ] = date("Y-m-d H:i:s");
        $tbl = "uploadfile";
        $obj->setUserData($tbl, $edit);



        //ファイルアップロードメール配信
        //パートナーにメール配信
        $where = array();
        $where[ 'id' ] = $sec;
        $user = $db->getUser($where);
        //パートナー情報取得
        $where = array();
        $where[ 'id' ] = $user[0][ 'partner_id' ];
        $pt = $db->getUser($where);
        $from = $pt[0][ 'rep_email' ];
        $body = "";
        $body1 = "";
        $body1 = $user[0][ 'name']."　".$user[0]['rep_name']."様\n";
        $body2 = "";
        $body2 = $user[0][ 'name']."　".$user[0]['rep_name2']."様\n";

        $body .= "\n";
        $body .= "サポートデスクです。\n";
        $body .= "\n";

        $body .= "ファイルを下記に格納致しましたので、ご連絡させて頂きます。\n";
        $body .= "URL：https://e-wel.com\n";
        $body .= "\n";

        $body .= "ダウンロード方法については、下記を参照願います。\n";
        $body .= "\n";

        $body .= "【ダウンロード方法】＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊\n";
        $body .= "\n";
        $body .= "１．上記、URLにアクセスして頂き、ID・PWを入力後、ログインをします。\n";
        $body .= "２．開いた画面の上の段にボタンが表示されており、\n";
        $body .= "　　一番右のダウンロードボタンをクリックしてください。\n";
        $body .= "３．格納されているファイルの一覧が表示されます。\n";
        $body .= "４．ファイル名をクリックし、ダウンロードしてください。\n";
        $body .= "　【ファイル名】\n";
        $body .= "　・".$_FILES["upfile"]["name"];
        $body .= "\n";

        $body .= "＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊＊\n";
        $body .= "\n";

        $body .= "ご確認の程、よろしくお願いいたします。\n";
        $body .= "\n";

        $body .= "（ご注意.1）\n";
        $body .= "検査結果は、ログイン画面に表示された「登録日」から、\n";
        $body .= "14日間で自動的にアクセス不可能になりますのでご注意ください。\n";
        $body .= "\n\n";

        $body .= "（ご注意.2）\n";
        $body .= "検査結果を再度、アップロードするには、別途費用がかかりますので、\n";
        $body .= "ダウンロードしたデータは保存することをお勧めいたします。\n";
        $body .= "\n\n";
        $body .= "なおID及びパスワードをお忘れの際は下記までご連絡ください。\n";
        $body .= "今後とも、よろしくお願い申し上げます。\n";

        $body .= "\n";

        $body .= "---------------------------------------------------------------------------------------\n";
        $body .= "■ ご登録内容についてのお問い合わせ窓口 ■\n";
        $body .= "サポートデスク\n";
        $body .= "e-mail：info@e-wel.com\n";
        $body .= "---------------------------------------------------------------------------------------\n";

        $mail = array();
        $rep_email = $user[0][ 'rep_email' ];
        $mail[ 'to'      ] = $rep_email;
        $mail[ 'subject' ] = 'ファイルアップロードのお知らせ';
        $mail[ 'body'    ] = $body1.$body;
        $obj->sendMailerPtnTmp($mail, $from);
        if ($user[0][ 'rep_email2' ]) {
            $rep_email = $user[0][ 'rep_email2' ];
            $mail[ 'to'      ] = $rep_email;
            $mail[ 'subject' ] = 'ファイルアップロードのお知らせ';
            $mail[ 'body'    ] = $body2.$body;
            $obj->sendMailerPtnTmp($mail, $from);
        }


        header("Location:/index/tmp/".$sec);
        exit();
    }
}
