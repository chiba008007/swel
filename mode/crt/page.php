<?PHP
	//完了ボタン
	if($_REQUEST[ 'finish' ]){
		//1回目の登録
		if($_REQUEST[ 'tensaku_number' ] == 1){
			$where = array();
			$table = "crt_member";
			$where[ 'edit'  ][ 'tensaku_number'        ] = 2;
			$where[ 'edit'  ][ 'tensaku_flg'           ] = 0;
			$where[ 'where' ][ 'id'                    ] = $id;
			$db->editUserData($table,$where);
			$where = array();
			$table = "crt_result";
			$where[ 'edit'  ][ 'counts'                 ] = 2;
			$where[ 'where' ][ 'crt_id'                 ] = $id;
			$db->editUserData($table,$where);
			//配信データ取得
			$where = array();
			$where[ 'testgrp_id' ] = $first;
			$where[ 'exam_id'    ] = $exam_id;
			$mails = $crt->getUserData($where);
			
			$mail = array();
			//受検者へのメール
			$mail[ 'subject' ] = $testTitle."添削完了のご連絡";
			$mail[ 'to'      ] = $mails[ 'mail' ];
			$mail[ 'body'    ] = $mails[ 'name' ]."様\n
お世話になっております。
".$mails[ 'company_name' ]."の".$mails[ 'rep_name' ]."です。
添削が完了いたしましたので、ご連絡いたします。\n
下記URLより再度ログインを行い、内容の確認及び入力を行ってください。

".D_URL_TEST."?k=".$dir."
ID:".$exam_id."

------------------------------------------------
■ お問い合わせ窓口 ■
".$mails[ 'company_name' ]." 担当 ".$mails[ 'rep_name' ]."
e-mail: ".$mails[ 'rep_email' ]."
------------------------------------------------

";

			$db->sendMailer($mail);
			header("Location:/crt/".$first."/logout/");
			exit();
		}

		//2回目の登録
		if(
			$_REQUEST[ 'tensaku_number' ] == 2
			|| $_REQUEST[ 'tensaku_number' ] == 3
			|| $_REQUEST[ 'tensaku_number' ] == 4
			){
			$tn = $_REQUEST[ 'tensaku_number' ]+1;
			$where = array();
			$table = "crt_member";
			$where[ 'edit'  ][ 'tensaku_number'        ] = $tn;
			if($_REQUEST[ 'tensaku_number' ] == 4){
				$where[ 'edit' ][ 'tensaku_flg'        ] = 1;
			}else{
				$where[ 'edit'  ][ 'tensaku_flg'       ] = 0;
			}
			$where[ 'where' ][ 'id'                    ] = $id;
			$db->editUserData($table,$where);
			$where = array();
			$table = "crt_result";
			$where[ 'edit'  ][ 'counts'                 ] = $tn;
			$where[ 'where' ][ 'crt_id'                 ] = $id;
			$db->editUserData($table,$where);
			//配信データ取得
			$where = array();
			$where[ 'testgrp_id' ] = $first;
			$where[ 'exam_id'    ] = $exam_id;
			$mails = $crt->getUserData($where);
			if($_REQUEST[ 'tensaku_number' ] == 4){
				//担当者にメール
				$mail[ 'subject' ] = $testTitle." ".$_REQUEST[ 'tensaku_number' ]."回目添削完了のご連絡";
				$mail[ 'to'      ] = $mails[ 'rep_email' ];
				$mail[ 'body'    ] = $mails[ 'rep_name' ]."様\n
添削が完了いたしましたので、ご連絡いたします。\n
下記URLより再度ログインを行い、内容の確認及び入力を行ってください。
".D_URL."
	
	";
				$db->sendMailer($mail);
				header("Location:/crt/".$first."/logout/");
			}else{
				$mail = array();
				//受検者へのメール
				$mail[ 'subject' ] = $testTitle." ".$_REQUEST[ 'tensaku_number' ]."回目添削完了のご連絡";
				$mail[ 'to'      ] = $mails[ 'mail' ];
				$mail[ 'body'    ] = $mails[ 'name' ]."様\n
お世話になっております。
".$mails[ 'company_name' ]."の".$mails[ 'rep_name' ]."です。
添削が完了いたしましたので、ご連絡いたします。\n
下記URLより再度ログインを行い、内容の確認及び入力を行ってください。

".D_URL_TEST."?k=".$dir."
ID:".$exam_id."

------------------------------------------------
■ お問い合わせ窓口 ■
".$mails[ 'company_name' ]." 担当 ".$mails[ 'rep_name' ]."
e-mail: ".$mails[ 'rep_email' ]."
------------------------------------------------
	";
				$db->sendMailer($mail);
				header("Location:/crt/".$first."/logout/");
			}
			exit();
		}

		exit();
	}
	//データの登録
	if($_REQUEST[ 'save' ]){
		//1回目の登録
		$errmsg = array();
		if($_REQUEST[ 'tensaku_number' ] == 1){
			$answer_fin = 1;
			if(!$_REQUEST[ 'note_point_1' ]){
				$errmsg[0] = "内容が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'logic_point_1' ]){
				$errmsg[1] = "形式が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'heart_point_1' ]){
				$errmsg[2] = "熱意が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'apeal_point_1' ]){
				$errmsg[3] = "アピール力が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'selias_point_1' ]){
				$errmsg[4] = "誠実さが選択されていません。";
				$answer_fin = 0;
			}
			
			$where = array();
			$table = "crt_result";
			$where[ 'edit'  ][ 'answer_text'        ] = $_REQUEST[ 'answer_text_1'        ];
			$where[ 'edit'  ][ 'answer_advice_text' ] = $_REQUEST[ 'answer_advice_text_1' ];
			$where[ 'edit'  ][ 'note_point'         ] = $_REQUEST[ 'note_point_1'         ];
			$where[ 'edit'  ][ 'logic_point'        ] = $_REQUEST[ 'logic_point_1'        ];
			$where[ 'edit'  ][ 'heart_point'        ] = $_REQUEST[ 'heart_point_1'        ];
			$where[ 'edit'  ][ 'apeal_point'        ] = $_REQUEST[ 'apeal_point_1'        ];
			$where[ 'edit'  ][ 'selias_point'       ] = $_REQUEST[ 'selias_point_1'       ];

			$where[ 'edit'  ][ 'answer_fin_1'       ] = $answer_fin;
			$where[ 'where' ][ 'crt_id'             ] = $id;
			$where[ 'where' ][ 'tensaku_id'         ] = $_REQUEST[ 'tensaku_id'           ];
			$db->editUserData($table,$where);
			
		}
		//2回目の登録
		if($_REQUEST[ 'tensaku_number' ] == 2){
			$answer_fin = 1;
			if(!$_REQUEST[ 'note_point_2' ]){
				$errmsg[0] = "内容が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'logic_point_2' ]){
				$errmsg[1] = "形式が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'heart_point_2' ]){
				$errmsg[2] = "熱意が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'apeal_point_2' ]){
				$errmsg[3] = "アピール力が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'selias_point_2' ]){
				$errmsg[4] = "誠実さが選択されていません。";
				$answer_fin = 0;
			}
			$where = array();
			$table = "crt_result";
			$where[ 'edit'  ][ 'answer_text_2'        ] = $_REQUEST[ 'answer_text_2'        ];
			$where[ 'edit'  ][ 'answer_advice_text_2' ] = $_REQUEST[ 'answer_advice_text_2' ];
			$where[ 'edit'  ][ 'note_point_2'         ] = $_REQUEST[ 'note_point_2'         ];
			$where[ 'edit'  ][ 'logic_point_2'        ] = $_REQUEST[ 'logic_point_2'        ];
			$where[ 'edit'  ][ 'heart_point_2'        ] = $_REQUEST[ 'heart_point_2'        ];
			$where[ 'edit'  ][ 'apeal_point_2'        ] = $_REQUEST[ 'apeal_point_2'        ];
			$where[ 'edit'  ][ 'selias_point_2'       ] = $_REQUEST[ 'selias_point_2'       ];

			$where[ 'edit'  ][ 'answer_fin_2'         ] = $answer_fin;
			$where[ 'where' ][ 'crt_id'               ] = $id;
			$where[ 'where' ][ 'tensaku_id'           ] = $_REQUEST[ 'tensaku_id'           ];
			$db->editUserData($table,$where);
			
		}

		//3回目の登録
		if($_REQUEST[ 'tensaku_number' ] == 3){
			$answer_fin = 1;
			if(!$_REQUEST[ 'note_point_3' ]){
				$errmsg[0] = "内容ポイントが選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'logic_point_3' ]){
				$errmsg[1] = "形式が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'heart_point_3' ]){
				$errmsg[2] = "熱意が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'apeal_point_3' ]){
				$errmsg[3] = "アピール力が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'selias_point_3' ]){
				$errmsg[4] = "誠実さが選択されていません。";
				$answer_fin = 0;
			}

			$where = array();
			$table = "crt_result";
			$where[ 'edit'  ][ 'answer_text_3'        ] = $_REQUEST[ 'answer_text_3'        ];
			$where[ 'edit'  ][ 'answer_advice_text_3' ] = $_REQUEST[ 'answer_advice_text_3' ];
			$where[ 'edit'  ][ 'note_point_3'         ] = $_REQUEST[ 'note_point_3'         ];
			$where[ 'edit'  ][ 'logic_point_3'        ] = $_REQUEST[ 'logic_point_3'        ];
			$where[ 'edit'  ][ 'heart_point_3'        ] = $_REQUEST[ 'heart_point_3'        ];
			$where[ 'edit'  ][ 'apeal_point_3'        ] = $_REQUEST[ 'apeal_point_3'        ];
			$where[ 'edit'  ][ 'selias_point_3'       ] = $_REQUEST[ 'selias_point_3'       ];

			$where[ 'edit'  ][ 'answer_fin_3'         ] = $answer_fin;
			$where[ 'where' ][ 'crt_id'               ] = $id;
			$where[ 'where' ][ 'tensaku_id'           ] = $_REQUEST[ 'tensaku_id'           ];
			$db->editUserData($table,$where);
			
		}
		//4回目の登録
		if($_REQUEST[ 'tensaku_number' ] == 4){
			$answer_fin = 1;
			if(!$_REQUEST[ 'note_point_4' ]){
				$errmsg[0] = "内容が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'logic_point_4' ]){
				$errmsg[1] = "形式が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'heart_point_4' ]){
				$errmsg[2] = "熱意が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'apeal_point_4' ]){
				$errmsg[3] = "アピール力が選択されていません。";
				$answer_fin = 0;
			}
			if(!$_REQUEST[ 'selias_point_4' ]){
				$errmsg[4] = "誠実さが選択されていません。";
				$answer_fin = 0;
			}

			$where = array();
			$table = "crt_result";
			$where[ 'edit'  ][ 'answer_text_4'        ] = $_REQUEST[ 'answer_text_4'        ];
			$where[ 'edit'  ][ 'answer_advice_text_4' ] = $_REQUEST[ 'answer_advice_text_4' ];
			$where[ 'edit'  ][ 'note_point_4'         ] = $_REQUEST[ 'note_point_4'         ];
			$where[ 'edit'  ][ 'logic_point_4'        ] = $_REQUEST[ 'logic_point_4'        ];
			$where[ 'edit'  ][ 'heart_point_4'        ] = $_REQUEST[ 'heart_point_4'        ];
			$where[ 'edit'  ][ 'apeal_point_4'        ] = $_REQUEST[ 'apeal_point_4'        ];
			$where[ 'edit'  ][ 'selias_point_4'       ] = $_REQUEST[ 'selias_point_4'       ];
			$where[ 'edit'  ][ 'answer_fin_4'         ] = $answer_fin;
			$where[ 'where' ][ 'crt_id'               ] = $id;
			$where[ 'where' ][ 'tensaku_id'           ] = $_REQUEST[ 'tensaku_id'           ];
			$db->editUserData($table,$where);
			
		}


		
	}
	//データの表示
	//テスト一覧データ取得
	$where = array();
	$where[ 'crt_id' ] = $id;
	$test = $crt->getTestList($where);

	//質問配列
	$qlistFin = array();
	$fin=0;
	foreach($test as $key=>$val){
		if($tensaku_number == 1){
			if($val[ 'answer_fin_1' ] == 1){
				$qlistFin[$val[ 'tensaku_id' ]] = 1;
				$fin++;
			}
		}
		if($tensaku_number == 2){
			if($val[ 'answer_fin_2' ] == 1){
				$qlistFin[$val[ 'tensaku_id' ]] = 1;
				$fin++;
			}
		}
		if($tensaku_number == 3){
			if($val[ 'answer_fin_3' ] == 1){
				$qlistFin[$val[ 'tensaku_id' ]] = 1;
				$fin++;
			}
		}
		if($tensaku_number == 4){
			if($val[ 'answer_fin_4' ] == 1){
				$qlistFin[$val[ 'tensaku_id' ]] = 1;
				$fin++;
			}
		}
		$qlist[$val[ 'tensaku_id' ]] = $array_tensaku_question[$val[ 'tensaku_main_id' ]][ $val[ 'tensaku_id' ] ];
	}
	//$finと$qlistの数が同じになれば完了ボタンを有効にする
	$finDisable = "disabled";
	if($fin == count($qlist)){
		$finDisable = "";
	}
	
	if($_REQUEST[ 'getFlg' ]){
		$tid = $_REQUEST[ 'tid' ];
		$tlist = $test[ $tid ];
		$tlist[ 'tensaku-title' ] = $qlist[ $tid ];

		echo json_encode($tlist);
		exit();
	}

	if(
		$_REQUEST[ 'pagecode' ] == "now"
		|| $_REQUEST[ 'pagecode' ] == "all"
		){
		foreach($array_tensaku_question as $key=>$val){
			foreach($val as $k=>$v){
					$alist[ $k ] = $v;
			}
		}
		$md = "now";
		$where = array();
		$where[ 'exam_id'    ] = $authobj->getUsername();
		$where[ 'testgrp_id' ] = $first;
		if($_REQUEST[ 'pagecode' ] == "all"){
			$rlt = $crt->getDataOne($where);
		}else{
			$where[ 'tensaku_id' ] = $_REQUEST[ 'tid' ];
			$rlt = $crt->getDataOne($where);
		}
	}

?>