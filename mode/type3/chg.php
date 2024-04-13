<?PHP
//-------------------------------------------
//請求書表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_cusChg.php");

$obj = new cusChgMethod();
//--------------
//IDチェック
//--------------
if($_REQUEST[ 'lists' ] == "idcheck"){
	$where[ 'login_id' ] = $_REQUEST[ 'id' ];
	$row = $obj->idCheck($where);
	if($row){
		echo "false";
	}else{
		echo "true";
	}
	exit();
}

//登録情報取得
$where[ 'id' ] = $id;
$data = $obj->getUser($where);

//登録画像データ取得
$login_id = $data[ 'login_id' ];
$glob = glob("./img/".$login_id."*");
$logo = preg_replace("/^\./","",$glob[0]);

if($_REQUEST[ 'conf' ]){
	//画像の真偽の確認
	$prev   = preg_replace("/\"|\\\/","",$_REQUEST[ 'previewImgId' ]);
	$fname  = basename($prev);
	$prev = "<img src='/images/preview/".$fname.".".$_REQUEST[ 'pv' ]."'>";
	$html = "chgConf";
}

if($_REQUEST[ 'regist' ]){
	$err = "";
	//IDチェック
	if($_REQUEST[ 'idchk' ] != $_REQUEST[ 'login_id' ]){
		$chkid[ 'login_id' ] = $_REQUEST[ 'login_id' ];
		$chk = $obj->idCheck($chkid);
		if($chk){
			$err = 1;
			$alert = "すでに利用されたＩＤです。再登録をお願いします。";
		}
	}
	if(!$err){
		$edit[ 'where' ][ 'id' ] = $id;
		$edit[ 'edit' ][ 'name'                ] = $_REQUEST[ 'name'                ];
		$edit[ 'edit' ][ 'login_id'            ] = $_REQUEST[ 'login_id'            ];
		$edit[ 'edit' ][ 'login_pw'            ] = $_REQUEST[ 'login_pw'            ];
		$edit[ 'edit' ][ 'post1'               ] = $_REQUEST[ 'post1'               ];
		$edit[ 'edit' ][ 'post2'               ] = $_REQUEST[ 'post2'               ];
		$edit[ 'edit' ][ 'prefecture'          ] = $_REQUEST[ 'pref'                ];
		$edit[ 'edit' ][ 'address1'            ] = $_REQUEST[ 'address1'            ];
		$edit[ 'edit' ][ 'address2'            ] = $_REQUEST[ 'address2'            ];
		$edit[ 'edit' ][ 'tel'                 ] = $_REQUEST[ 'tel'                 ];
		$edit[ 'edit' ][ 'fax'                 ] = $_REQUEST[ 'fax'                 ];
                if($basetype == 1){ $edit[ 'edit' ][ 'exam_pattern'                 ] = $_REQUEST[ 'exam_pattern' ];}
        if($basetype != 3){ 
			if(strlen($_REQUEST[ 'csvupload' ]) > 0 ){
				$edit[ 'edit' ][ 'csvupload'           ] = $_REQUEST[ 'csvupload'];
			}
		}
                
                if($basetype == 1){ $edit[ 'edit' ][ 'pdf_button'          ] = $_REQUEST[ 'pdf_button' ];}
                if($basetype == 1){ $edit[ 'edit' ][ 'pdf_master_status'   ] = $_REQUEST[ 'pdf_master_status'];}
                 if($basetype != 3){$edit[ 'edit' ][ 'excel_master_status' ] = $_REQUEST[ 'excel_master_status' ];}
                 
		$edit[ 'edit' ][ 'privacy_flg'         ] = $_REQUEST[ 'privacy_flg'         ];
		$edit[ 'edit' ][ 'rep_name'            ] = $_REQUEST[ 'rep_name'            ];
		$edit[ 'edit' ][ 'rep_email'           ] = $_REQUEST[ 'rep_email'           ];
		$edit[ 'edit' ][ 'rep_busyo'           ] = $_REQUEST[ 'rep_busyo'           ];
		$edit[ 'edit' ][ 'rep_tel1'            ] = $_REQUEST[ 'rep_tel1'            ];
		$edit[ 'edit' ][ 'rep_tel2'            ] = $_REQUEST[ 'rep_tel2'            ];
		$edit[ 'edit' ][ 'rep_name2'           ] = $_REQUEST[ 'rep_name2'           ];
		$edit[ 'edit' ][ 'rep_email2'          ] = $_REQUEST[ 'rep_email2'          ];
		$edit[ 'edit' ][ 'rep_email2'          ] = $_REQUEST[ 'rep_email2'          ];
		$edit[ 'edit' ][ 'customer_file_upload'  ] = $_REQUEST[ 'customer_file_upload'];
		$edit[ 'edit' ][ 'privacypolicy'         ] = $_REQUEST[ 'privacypolicy'       ];
		$edit[ 'edit' ][ 'privacypolicy_text'    ] = $_REQUEST[ 'privacypolicy_text'  ];
		if($data[ 'login_pw' ] != $_REQUEST['login_pw']){
			$edit[ 'edit'  ][ 'password_editdate' ] = date("Y-m-d");
		}

		$table = "t_user";

		$obj->editUserData($table,$edit);
		//パートナーデータの取得

		//画像ディレクトリID変更
		$login_id = $_REQUEST[ 'idchk' ];
		$glob = glob("./img/".$login_id."*");
		if($glob[0]){
			$exts = split("[/\\.]", $glob[0]);
			$n = count($exts) - 1;
			$ext = $exts[$n];
			rename($glob[0],"./img/".$_REQUEST[ 'login_id' ].".".$ext);
		}

	
		$where = array();
		$where['id'] = $ptid;
		$pt = $db->getUser($where);
		//------------------------------------------------
		//メール配信処理
		//------------------------------------------------
		$mail[ 'subject' ] = '【'.$pt[0]['name'].'】　企業情報登録のお知らせ';
		$mail[ 'to'      ] = $_REQUEST[ 'rep_email' ];

		$body = "";
		$body = $_REQUEST[ 'name']."\n".$_REQUEST['rep_name']."様\n";
		$body .= "\n";
		$body .= $pt[0][ 'name' ]."サポートデスクです。\n";
		$body .= "\n";
		$body .= "貴社におかれましてはますますご清祥のことと\n";
		$body .= "お喜び申し上げます。\n";
		$body .= "\n";
		$body .= "顧客情報変更が完了致しました。\n";
		$body .= "尚、パスワードをお忘れの際はサポートデスクまでご連絡ください。 \n";
		$body .= "ログインID：".$_REQUEST['login_id']."\n";
		$body .= "\n";
		$body .= "以上、宜しくお願い致します。\n";
		$body .= "\n";
		$mail[ 'body'    ] = $body;
		$db->sendMailer($mail);
		
		if($_REQUEST[ 'logodel' ] == "on"){
			$glob = glob("./img/".$_REQUEST[ 'idchk' ].".*");
			if(file_exists($glob[0])){
				@unlink($glob[0]);
			}
		}else{
			//画像処理
			if($_REQUEST[ 'pv' ]){
				$glob = glob("./img/".$_REQUEST[ 'login_id' ].".*");
				foreach($glob as $key=>$val){
					unlink($val);
				}
				rename("./images/preview/".$_REQUEST[ 'imgfilename' ].".".$_REQUEST[ 'pv' ],"./img/".$_REQUEST[ 'login_id' ].".".$_REQUEST[ 'pv' ]);
				@unlink("./images/preview/".$_REQUEST[ 'imgfilename' ].".".$_REQUEST[ 'pv' ]);
			}

		}



		if($_REQUEST[ 'rep_email2' ]){
			//------------------------------------------------
			//メール配信処理2
			//------------------------------------------------
			$mail[ 'subject' ] = '【'.$pt[0]['name'].'】　企業情報登録のお知らせ';
			$mail[ 'to'      ] = $_REQUEST[ 'rep_email2' ];

			$body = "";
			$body = $_REQUEST[ 'name']."\n".$_REQUEST['rep_name2']."様\n";
			$body .= "\n";
			$body .= $pt[0][ 'name' ]."サポートデスクです。\n";
			$body .= "\n";
			$body .= "貴社におかれましてはますますご清祥のことと\n";
			$body .= "お喜び申し上げます。\n";
			$body .= "\n";
			$body .= "顧客情報変更が完了致しました。\n";
			$body .= "尚、パスワードをお忘れの際はサポートデスクまでご連絡ください。 \n";
			$body .= "ログインID：".$_REQUEST['login_id']."\n";
			$body .= "\n";
			$body .= "以上、宜しくお願い致します。\n";
			$body .= "\n";
			$mail[ 'body'    ] = $body;
			$db->sendMailer($mail);
		}
		$html = "chgRegist";
	}
}
?>