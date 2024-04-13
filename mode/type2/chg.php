<?PHP
//-------------------------------------------
//パートナー情報変更
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_ptnChg.php");

$obj = new ptnChgMethod();
//パートナー情報取得
$where = array();
$where[ 'id' ] = $id;
$user = $obj->getUser($where);

//要素名の取得
$where = array();
$where[ 'uid' ] = $id;
$element = $obj->getElement($where);
//要素名配列の作成
//DBにデータがあれば作り直し
foreach($a_element2 as $key=>$val){
	if($element[ $key ]){
		$a_element2[$key] = $element[ $key ];
	}
}
if($_REQUEST[ 'conf' ]){
	
	
	$html = "chgConf";
}


if($_REQUEST[ 'regist' ]){
	
	//データ変更
	$tbl = "t_user";
	$edit[ 'where' ][ 'id'          ] = $id;
	$edit[ 'edit'  ][ 'login_pw'    ] = $_REQUEST[ 'login_pw'    ];
	$edit[ 'edit'  ][ 'post1'       ] = $_REQUEST[ 'post1'       ];
	$edit[ 'edit'  ][ 'post2'       ] = $_REQUEST[ 'post2'       ];
	$edit[ 'edit'  ][ 'prefecture'  ] = $_REQUEST[ 'pref'        ];
	$edit[ 'edit'  ][ 'address1'    ] = $_REQUEST[ 'address1'    ];
	$edit[ 'edit'  ][ 'address2'    ] = $_REQUEST[ 'address2'    ];
	$edit[ 'edit'  ][ 'tel'         ] = $_REQUEST[ 'tel'         ];
	$edit[ 'edit'  ][ 'fax'         ] = $_REQUEST[ 'fax'         ];
	$edit[ 'edit'  ][ 'rep_name'    ] = $_REQUEST[ 'rep_name'    ];
	$edit[ 'edit'  ][ 'rep_email'   ] = $_REQUEST[ 'rep_email'   ];
	$edit[ 'edit'  ][ 'rep_name2'   ] = $_REQUEST[ 'rep_name2'   ];
	$edit[ 'edit'  ][ 'rep_email2'  ] = $_REQUEST[ 'rep_email2'  ];
	$edit[ 'edit'  ][ 'rep_tel1'    ] = $_REQUEST[ 'rep_tel1'    ];
	$edit[ 'edit'  ][ 'logo_name'   ] = $_REQUEST[ 'logo_name'   ];
        
        if($basetype == 1){
            $edit[ 'edit'  ][ 'exam_pattern'   ] = $_REQUEST[ 'exam_pattern'   ];
        }

	if($user[0][ 'login_pw' ] != $_REQUEST['login_pw']){
		$edit[ 'edit'  ][ 'password_editdate' ] = date("Y-m-d");
	}

	$db->editUserData($tbl,$edit);
	$where[ 'id' ] = $id;

	$us =  $db->getUser($where);
	//$authobj->setAuthData('logoname'     ,$us[0][ 'logo_name'          ]);
        $_SESSION[ 'logoname' ] = $us[0][ 'logo_name' ];
	//-----------------------------------
	//メール配信
	//-----------------------------------
	$body = "";
	$body = $user[0][ 'name']."\n".$_REQUEST['rep_name']."様\n";
	$body .= "貴社におかれましてはますますご清祥のことと\n";
	$body .= "お喜び申し上げます。\n\n";
	$body .= "サポートデスクです。\n";
	$body .= "\n";
	$body .= $_REQUEST[ 'logo_name']."管理システムへの企業情報変更が完了致しました。\n\n";
	$body .= "尚、パスワードをお忘れの際はサポートデスクまでご連絡ください。 \n\n";
	$body .= "ログインID：".$user[0]['login_id']."\n";
	$body .= "\n";
	$body .= $invgfoot;
	
	$mail[ 'to'      ] = $_REQUEST[ 'rep_email' ];
	$mail[ 'subject' ] = '【'.$user[0][ 'name' ].'】企業情報変更のお知らせ';
	$mail[ 'body'    ] = $body;
	$db->sendMailer($mail);
	


	//-----------------------------------
	//メール配信2
	//-----------------------------------
	if($_REQUEST[ 'rep_email2' ]){
		$body = "";
		$body = $user[0][ 'name']."\n".$_REQUEST['rep_name2']."様\n";
		$body .= "貴社におかれましてはますますご清祥のことと\n";
		$body .= "お喜び申し上げます。\n\n";
		$body .= "サポートデスクです。\n";
		$body .= "\n";
		$body .= $_REQUEST[ 'logo_name']."管理システムへの企業情報変更が完了致しました。\n\n";
		$body .= "尚、パスワードをお忘れの際はサポートデスクまでご連絡ください。 \n\n";
		$body .= "ログインID：".$user[0]['login_id']."\n";
		$body .= "\n";
		$body .= $invgfoot;
		
		$mail[ 'to'      ] = $_REQUEST[ 'rep_email2' ];
		$mail[ 'subject' ] = '【'.$user[0][ 'name' ].'】企業情報変更のお知らせ';
		$mail[ 'body'    ] = $body;
		$db->sendMailer($mail);
	}

	$html = "chgRegist";
	
}
?>
