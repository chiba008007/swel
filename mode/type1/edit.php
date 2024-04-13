<?PHP
//-------------------------------------------
//パートナー情報更新
//
//
//
//
//
//-------------------------------------------
include_once("./init/lisence.php");
require_once("./lib/include_edit.php");

$oedit = new editMethod();

//element変換配列
$array_elm = array(
				 "w1"=>"e_feel" 
				,"w2"=>"e_cus"  
				,"w3"=>"e_aff"  
				,"w4"=>"e_cntl" 
				,"w5"=>"e_vi"   
				,"w6"=>"e_pos"  
				,"w7"=>"e_symp" 
				,"w8"=>"e_situ" 
				,"w9"=>"e_hosp" 
				,"w10"=>"e_lead"
				,"w11"=>"e_ass" 
				,"w12"=>"e_adap"
			);

if($_REQUEST[ 'idchk' ]){
	//ajax
	//ログインＩＤの重複チェック
	$where = array();
	$where[ 'login_id' ] = $_REQUEST[ 'login_id' ];
	$flg = $oedit->idCheck($where);
	echo $flg;
	exit();
}


$where = array();
$where[ 'eir_id' ] = $id;
$where[ 'id'     ] = $sec;
$partner = $oedit->getUserData($where);

if(!count($partner)){
	//データが無い時はトップに戻る
	header("Location:../");
	exit();
}else{
	$name          = ($_REQUEST[ 'name'          ])?$_REQUEST[ 'name'           ]:$partner[ 'name'             ];
	$login_id      = $partner[ 'login_id'         ];
	$login_pw      = ($_REQUEST[ 'login_pw'      ] || $_REQUEST[ 'chgConf' ])?$_REQUEST[ 'login_pw'       ]:$partner[ 'login_pw'         ];
	$post1         = ($_REQUEST[ 'post1'         ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'post1'          ]:$partner[ 'post1'            ];
	$post2         = ($_REQUEST[ 'post2'         ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'post2'          ]:$partner[ 'post2'            ];
	$pref          = ($_REQUEST[ 'pref'          ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'pref'           ]:$partner[ 'prefecture'       ];
	$address1      = ($_REQUEST[ 'address1'      ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'address1'       ]:$partner[ 'address1'         ];
	$address2      = ($_REQUEST[ 'address2'      ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'address2'       ]:$partner[ 'address2'         ];
	$tel           = ($_REQUEST[ 'tel'           ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'tel'            ]:$partner[ 'tel'              ];
	$fax           = ($_REQUEST[ 'fax'           ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'fax'            ]:$partner[ 'fax'              ];
	$rep_name      = ($_REQUEST[ 'rep_name'      ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'rep_name'       ]:$partner[ 'rep_name'         ];
	$rep_email     = ($_REQUEST[ 'rep_email'     ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'rep_email'      ]:$partner[ 'rep_email'        ];
	//$rep_name2     = ($_REQUEST[ 'rep_name2'     ] || $_REQUEST[ 'chgConf' ])?$_REQUEST[ 'rep_name2'      ]:$partner[ 'rep_name2'        ];
	$rep_name2 = $_REQUEST[ 'rep_name2'     ];
	$ptTestBtn     = ($_REQUEST[ 'ptTestBtn'     ] || $_REQUEST[ 'ptTestBtn' ] == "0" )?$_REQUEST[ 'ptTestBtn'      ]:$partner[ 'ptTestBtn'        ];
	//$rep_email2    = ($_REQUEST[ 'rep_email2'    ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'rep_email2'     ]:$partner[ 'rep_email2'       ];
	$rep_email2 = $_REQUEST[ 'rep_email2'     ];
	$rep_tel       = ($_REQUEST[ 'rep_tel'       ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'rep_tel'        ]:$partner[ 'rep_tel1'         ];
	$logo_name     = ($_REQUEST[ 'logo_name'     ] || $_REQUEST[ 'chgConf' ] )?$_REQUEST[ 'logo_name'      ]:$partner[ 'logo_name'        ];
	$element_flg   = ($_REQUEST[ 'element_flg'   ] || $_REQUEST[ 'element_flg' ] == "0")?$_REQUEST[ 'element_flg'    ]:$partner[ 'element_flg'      ];
	$license_parts = ($_REQUEST[ 'license_part'  ] && !$_REQUEST[ 'chgBack' ] )?$_REQUEST[ 'license_part'   ]:$partner[ 'license_parts'    ];

	if($_REQUEST[ 'chgReg' ]){
		$license_parts = $_REQUEST[ 'license_part' ];
		$license_edit_parts = $_REQUEST[ 'license_edit_part' ];
		$calc = $_REQUEST[ 'calc' ];
		$status = [];
		foreach($license_parts as $key=>$val){
				$license_part[$key] = $val;
			//	$status[$key] = ($_REQUEST[ 'calc' ][ $key ] == '+')?1:0;
			//	$keys[$key] = $key;
		}
		
		foreach($license_edit_parts as $key=>$val){
				$license_edit_part[$key] = $val;
				$status[$key] = ($_REQUEST[ 'calc' ][ $key ] == '+')?1:0;
				$keys[$key] = $key;
		}
		$max = max($keys);
		
		for($i=1;$i<=$max;$i++){
			$imp .= sprintf(":%d",$license_part[$i]);
		}
		$imp = preg_replace("/^:/","",$imp);
		for($i=1;$i<=$max;$i++){
			$impedit .= sprintf(":%d",$license_edit_part[$i]);
		}
		$impedit = preg_replace("/^:/","",$impedit);

		$log = array();
		$log[ 'to_id'       ] = $sec;
		$log[ 'from_id'     ] = $id;
		$log[ 'from_type'   ] = 1;
		$log[ 'license_num' ] = $impedit;
		$log[ 'status'      ] = $status;
		$oedit->setLog($log);

	}elseif($_REQUEST[ 'chgConf' ] ){
		foreach($license_parts as $key=>$val){
			if($_REQUEST[ 'calc' ][$key] == "+"){
				$license_part[$key] = (int)$val+(int)$_REQUEST[ 'testType' ][$key];
				$license_edit_part[$key] = (int)$_REQUEST[ 'testType' ][$key];
			}else{
				$license_part[$key] = (int)$val-(int)$_REQUEST[ 'testType' ][$key];
				$license_edit_part[$key] = (int)$_REQUEST[ 'testType' ][$key];
			}
		}

	}else{
		$ex = explode(":",$license_parts);
		$i = 1;
		foreach($ex as $key=>$val){
			$license_part[$i] = sprintf("%d",$val);
			$i++;
		}
	}

	$out        = ($_REQUEST[ 'pdf'  ])?$_REQUEST[ 'pdf'   ]:$partner[ 'outputPdf'    ];
	if($_REQUEST[ 'pdf'  ]){
		$exp = $out;
		$outputPdf=array();
		foreach($exp as $key=>$val){
			$outputPdf[$key] = $val;
		}
	}else{
		$exp = explode(":",$out);
		$i=1;
		$outputPdf=array();
		foreach($exp as $key=>$val){
			$w = "w".$i;
			$outputPdf[$val] = $val;
			$i++;
		}
	}
	if($_REQUEST[ 'chgConf' ]){
		$html = "editConf";
	}
	
	if($_REQUEST[ 'chgReg' ]){



$set = [];

$set[ 'company_name' ] = $_SESSION[ 'base_site_name' ];
$set[ 'company_name_target' ] = $name;


$set[ 'worktext' ] = "対象企業編集";


$db->setUserData("log",$set);


		$edit = array();
		$edit[ 'where' ][ 'login_id'      ] = $login_id;
		//$edit[ 'where' ][ 'eir_id'        ] = $id;
		$edit[ 'where' ][ 'type'          ] = 2;
		$edit[ 'where' ][ 'id'            ] = $sec;
		$edit[ 'edit'  ][ 'login_pw'          ] = $login_pw;
		$edit[ 'edit'  ][ 'name'          ] = $name;
		$edit[ 'edit'  ][ 'post1'         ] = $post1;
		$edit[ 'edit'  ][ 'post2'         ] = $post2;
		$edit[ 'edit'  ][ 'prefecture'    ] = $pref;
		$edit[ 'edit'  ][ 'address1'      ] = $address1;
		$edit[ 'edit'  ][ 'address2'      ] = $address2;
		$edit[ 'edit'  ][ 'tel'           ] = $tel;
		$edit[ 'edit'  ][ 'fax'           ] = $fax;
		$edit[ 'edit'  ][ 'ptTestBtn'     ] = $ptTestBtn;
		$edit[ 'edit'  ][ 'rep_name'      ] = $rep_name;
		$edit[ 'edit'  ][ 'rep_email'     ] = $rep_email;
		$edit[ 'edit'  ][ 'rep_name2'     ] = $rep_name2;
		$edit[ 'edit'  ][ 'rep_email2'    ] = $rep_email2;
		$edit[ 'edit'  ][ 'rep_tel1'      ] = $rep_tel;
		if($_REQUEST[ 'element_flg' ]){
			$edit[ 'edit'  ][ 'element_flg'   ] = 1;
		}else{
			$edit[ 'edit'  ][ 'element_flg'   ] = 0;
		}
		$edit[ 'edit'  ][ 'license_parts'  ] = $imp;
		$license = array_sum($license_part);
		$edit[ 'edit'  ][ 'license'       ] = $license;
		$edit[ 'edit'  ][ 'logo_name'     ] = $logo_name;
		$out = "";

		foreach($outputPdf as $key=>$val){
			$out .= ":".$key;
		}
		$out = preg_replace("/^,/","",$out);
		$edit[ 'edit'  ][ 'outputPdf'     ] = $out;
		if($partner["login_pw"] != $login_pw){
			$edit[ 'edit'  ][ 'password_editdate' ] = date("Y-m-d");
		}

		$table = "t_user";

		$db->editUserData($table,$edit);




		if($_REQUEST[ 'element_flg' ]){
			$edit = array();
			$edit[ 'where' ][ 'uid'  ] = $sec;
			$edit[ 'edit'  ][ 'e_feel'  ] = $_REQUEST[ "w1"   ];
			$edit[ 'edit'  ][ 'e_cus'   ] = $_REQUEST[ "w2"   ];
			$edit[ 'edit'  ][ 'e_aff'   ] = $_REQUEST[ "w3"   ];
			$edit[ 'edit'  ][ 'e_cntl'  ] = $_REQUEST[ "w4"   ];
			$edit[ 'edit'  ][ 'e_vi'    ] = $_REQUEST[ "w5"   ];
			$edit[ 'edit'  ][ 'e_pos'   ] = $_REQUEST[ "w6"   ];
			$edit[ 'edit'  ][ 'e_symp'  ] = $_REQUEST[ "w7"   ];
			$edit[ 'edit'  ][ 'e_situ'  ] = $_REQUEST[ "w8"   ];
			$edit[ 'edit'  ][ 'e_hosp'  ] = $_REQUEST[ "w9"   ];
			$edit[ 'edit'  ][ 'e_lead'  ] = $_REQUEST[ "w10"  ];
			$edit[ 'edit'  ][ 'e_ass'   ] = $_REQUEST[ "w11"  ];
			$edit[ 'edit'  ][ 'e_adap'  ] = $_REQUEST[ "w12"  ];
			$oedit->editElement($edit);
		}
		
		$body = "";
		//--------------------------------------------------------
		//メール配信
		//--------------------------------------------------------
		$sub = '【Welcome-k】　企業情報登録のお知らせ';
		$body = $_REQUEST[ 'name']."\n".$_REQUEST['rep_name']."様\n";
		$body .= "貴社におかれましてはますますご清祥のことと\n";
		$body .= "お喜び申し上げます。\n";
		$body .= "Welcome-k　サポートデスクです。\n";
		$body .= "\n";
		$body .= $_REQUEST[ 'logo_name'     ]."管理システムへの企業情報登録が完了致しました。\n";
		$body .= "下記URLよりログインし、内容をご確認ください。\n";
//		$body .= "尚、パスワードはセキュリティの関係上、別途メールにてお送り致します。\n";

		$body .= "URL：".D_URL_HOME."/\n";
		$body .= "ログインID：".$_REQUEST['login_id']."\n";
		if($license){
			$body .= "ライセンス数：".$license."\n";
		}
		$body .= $invgfoot;
		$mail[ 'to'      ] = $_REQUEST[ 'rep_email' ];
		$mail[ 'subject' ] = $sub;
		$mail[ 'body'    ] = $body;
		$db->sendMailer($mail);
		//--------------------------------------------------------
		//メール配信終わり
		//--------------------------------------------------------
		sleep(1);
		//--------------------------------------------------------
		//パスワードメール配信
		//--------------------------------------------------------
/*
		$body2 = $_REQUEST[ 'name']."\n".$_REQUEST['rep_name']."様\n";
		$body2 .= "貴社におかれましてはますますご清祥のことと\n";
		$body2 .= "お喜び申し上げます。\n\n";
		$body2 .= "Welcome-k　サポートデスクです。\n";
		$body2 .= "\n";
		$body2 .= $_REQUEST[ 'logo_name'     ]."管理システムのログインに必要なパスワードをお知らせします。\n";
		$body2 .= "パスワード：".$_REQUEST['login_pw']."\n";
		$body2 .= "尚、初回ログイン時にパスワードの変更をお勧め致します。\n";
		$body2 .= "\n";
		$body2 .= "以上、宜しくお願い致します。\n";
		$body2 .= "\n";
		$body2 .= $invgfoot;
		$mail = array();
		$mail[ 'to'      ] = $_REQUEST[ 'rep_email' ];
		$mail[ 'subject' ] = $sub;
		$mail[ 'body'    ] = $body2;
		$db->sendMailer($mail);
*/
		//--------------------------------------------------------
		//パスワードメール配信終わり
		//--------------------------------------------------------
		
		
		if($_REQUEST[ 'rep_email2' ]){
			//--------------------------------------------------------
			//担当者２メール配信
			//--------------------------------------------------------
			$body = $_REQUEST[ 'name']."\n".$_REQUEST['rep_name2']."様\n";
			$body .= "貴社におかれましてはますますご清祥のことと\n";
			$body .= "お喜び申し上げます。\n";
			$body .= "Welcome-k　サポートデスクです。\n";
			$body .= "\n";
			$body .= $_REQUEST[ 'logo_name'     ]."管理システムへの企業情報登録が完了致しました。\n";
			$body .= "下記URLよりログインし、内容をご確認ください。\n";
//			$body .= "尚、パスワードはセキュリティの関係上、別途メールにてお送り致します。\n";

			$body .= "URL：".D_URL_HOME."/\n";
			$body .= "ログインID：".$_REQUEST['login_id']."\n";
			if($license){
				$body .= "ライセンス数：".$license."\n";
			}
			$body .= $invgfoot;

			$mail = array();
			$mail[ 'to'      ] = $_REQUEST[ 'rep_email2' ];
			$mail[ 'subject' ] = $sub;
			$mail[ 'body'    ] = $body;
			$db->sendMailer($mail);
			//--------------------------------------------------------
			//担当者２メール配信終わり
			//--------------------------------------------------------
			sleep(1);
/*
			//--------------------------------------------------------
			//パスワードメール配信
			//--------------------------------------------------------
			$body2 = $_REQUEST[ 'name']."\n".$_REQUEST['rep_name2']."様\n";
			$body2 .= "貴社におかれましてはますますご清祥のことと\n";
			$body2 .= "お喜び申し上げます。\n\n";
			$body2 .= "Welcome-k　サポートデスクです。\n";
			$body2 .= "\n";
			$body2 .= $_REQUEST[ 'logo_name'     ]."管理システムのログインに必要なパスワードをお知らせします。\n";
			$body2 .= "パスワード：".$_REQUEST['login_pw']."\n";
			$body2 .= "尚、初回ログイン時にパスワードの変更をお勧め致します。\n";
			$body2 .= "\n";
			$body2 .= "以上、宜しくお願い致します。\n";
			$body2 .= "\n";
			$body2 .= $invgfoot;
			$mail = array();
			$mail[ 'to'      ] = $_REQUEST[ 'rep_email2' ];
			$mail[ 'subject' ] = $sub;
			$mail[ 'body'    ] = $body2;
			$db->sendMailer($mail);
*/
			//--------------------------------------------------------
			//パスワードメール配信終わり
			//--------------------------------------------------------
		}

		
		
		$html = "editReg";
	}
}
?>