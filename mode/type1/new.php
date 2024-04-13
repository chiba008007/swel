<?PHP
//-------------------------------------------
//新規パートナ情報登録
//
//
//
//
//
//-------------------------------------------
include_once("./init/lisence.php");
require_once("./lib/include_new.php");

$new = new newMethod();


if($_REQUEST[ 'idchk' ]){
	//ajax
	//ログインＩＤの重複チェック
	$where = array();
	$where[ 'login_id' ] = $_REQUEST[ 'login_id' ];
	$flg = $new->idCheck($where);
	echo $flg;
	exit();
}
if($_REQUEST[ 'chgConf' ]){
	$html = "newConf";
	
}
if($_REQUEST[ 'chgReg' ]){




	//登録処理
	$where = array();
	$where[ 'login_id' ] = $_REQUEST[ 'login_id' ];
	$flg     = $new->idCheck($where);

	$license = array_sum($_REQUEST[ 'license_part' ]);
	$lp = $_REQUEST[ 'license_part' ];
	ksort($lp);
	$m = max(array_keys($lp));

	for($i=1;$i<=$m;$i++){
		if($lp[$i]){
			$imp[$i] = $lp[$i];
		}else{
			$imp[$i] = 0;
		}
	}
	$imp     = implode(":",$imp);

	$output = "";
	foreach($_REQUEST[ 'pdf' ] as $key=>$val){
		$output .= ":".$key;
	}
	$outpdf = preg_replace("/^:/","",$output);

	if(!$flg){
		$table = "t_user";
		$set = array();
		$set[ 'login_id'          ] = $_REQUEST[ 'login_id'   ];
		$set[ 'login_pw'          ] = $_REQUEST[ 'login_pw'   ];
		$set[ 'type'              ] = 2;
		$set[ 'eir_id'            ] = $id;
		$set[ 'name'              ] = $_REQUEST[ 'name'       ];
		$set[ 'post1'             ] = $_REQUEST[ 'post1'      ];
		$set[ 'post2'             ] = $_REQUEST[ 'post2'      ];
		$set[ 'post2'             ] = $_REQUEST[ 'post2'      ];
		$set[ 'prefecture'        ] = $_REQUEST[ 'pref'       ];
		$set[ 'address1'          ] = $_REQUEST[ 'address1'   ];
		$set[ 'address2'          ] = $_REQUEST[ 'address2'   ];
		$set[ 'tel'               ] = $_REQUEST[ 'tel'        ];
		$set[ 'fax'               ] = $_REQUEST[ 'fax'        ];
		$set[ 'rep_name'          ] = $_REQUEST[ 'rep_name'   ];
		$set[ 'rep_name2'         ] = $_REQUEST[ 'rep_name2'  ];
		$set[ 'rep_email'         ] = $_REQUEST[ 'rep_email'  ];
		$set[ 'rep_email2'        ] = $_REQUEST[ 'rep_email2' ];
		$set[ 'rep_tel1'          ] = $_REQUEST[ 'rep_tel'    ];
		$set[ 'ptTestBtn'          ] = $_REQUEST[ 'ptTestBtn'    ];
		$set[ 'license'           ] = $license;
		$set[ 'license_parts'     ] = $imp;
		$set[ 'logo_name'         ] = $_REQUEST[ 'logo_name'   ];
		$set[ 'outputPdf'         ] = $outpdf;
		$set[ 'regist_ts'         ] = date("Y-m-d H:i:s");
		$set[ 'password_editdate' ] = date("Y-m-d");
		if($_REQUEST[ 'element_flg' ]){
			$set[ 'element_flg'       ] = 1;
		}
		$db->setUserData($table,$set);
		$where = array();
		$where[ 'login_id'          ] = $_REQUEST[ 'login_id'   ];
		$uid = $new->getUniqID($where);


		//--------------------------------------------------------
		//ログデータ登録
		//--------------------------------------------------------
		$log = array();
		$log[ 'to_id'       ] = $uid[ 'id' ];
		$log[ 'from_id'     ] = $id;
		$log[ 'from_type'   ] = 1;
		$log[ 'license_num' ] = $imp;
		$log[ 'status'      ] = 1;
		$new->setLog($log);


		//idの取得
		if($_REQUEST[ 'element_flg' ]){

			$table = "t_element";
			$set = array();
			$set[ 'uid' ] = $uid[ 'id' ];
			$set[ 'element_status' ] = 1;
			$set[ 'e_feel'  ] = $_REQUEST[ 'w1'  ];
			$set[ 'e_cus'   ] = $_REQUEST[ 'w2'  ];
			$set[ 'e_aff'   ] = $_REQUEST[ 'w3'  ];
			$set[ 'e_cntl'  ] = $_REQUEST[ 'w4'  ];
			$set[ 'e_vi'    ] = $_REQUEST[ 'w5'  ];
			$set[ 'e_pos'   ] = $_REQUEST[ 'w6'  ];
			$set[ 'e_symp'  ] = $_REQUEST[ 'w7'  ];
			$set[ 'e_situ'  ] = $_REQUEST[ 'w8'  ];
			$set[ 'e_hosp'  ] = $_REQUEST[ 'w9'  ];
			$set[ 'e_lead'  ] = $_REQUEST[ 'w10' ];
			$set[ 'e_ass'   ] = $_REQUEST[ 'w11' ];
			$set[ 'e_adap'  ] = $_REQUEST[ 'w12' ];
			$db->setUserData($table,$set);

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
		$body .= "尚、パスワードはセキュリティの関係上、別途メールにてお送り致します。\n";

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
			$body .= "尚、パスワードはセキュリティの関係上、別途メールにてお送り致します。\n";

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
			//--------------------------------------------------------
			//パスワードメール配信終わり
			//--------------------------------------------------------
		}
		
	}else{
		$error = 1;
	}
		$html = "newReg";

}
if($_REQUEST[ 'login_id' ]){
	$where = array();
	$where[ 'login_id'          ] = $_REQUEST[ 'login_id'   ];
	$uid = $new->getUniqID($where);
	$uid = $uid[ 'id' ];
}












?>