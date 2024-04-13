<?PHP
//-------------------------------------------
//テスト内容編集表示
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_testEdit.php");
$obj = new testEditMethod();

//---------------------------
//IDの重複チェック（非同期）
//--------------------------
if($_REQUEST[ 'idCheck' ]){
	//テストグループID取得
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'exam_id'     ] = $_REQUEST[ 'input' ];
	$where[ 'partner_id'  ] = $ptid;
	$where[ 'customer_id' ] = $id;
	$row = $obj->idCheck($where);
	if($row){
		echo "0";
	}else{
		echo "1";
	}
	exit();
}
//---------------------------
//IDの重複チェック終わり（非同期）
//--------------------------

//--------------------------------
//テストデータ編集
//--------------------------------
if($_REQUEST[ 'regist' ]){
	//データ登録処理
	$where = array();
	$where[ 'testgrp_id'  ] = $sec;
	$where[ 'exam_id'     ] = $third;
	$where[ 'partner_id'  ] = $ptid;
	$where[ 'customer_id' ] = $id;
	$edit = array();
	$edit[ 'name'    ] = $_REQUEST[ 'name1'   ]."　".$_REQUEST[ 'name2' ];
	$edit[ 'kana'    ] = $_REQUEST[ 'kana1'   ]."　".$_REQUEST[ 'kana2' ];
	if($_REQUEST[ 'birth_y' ]){
		$edit[ 'birth'   ] = sprintf("%04d/%02d/%02d"
						,$_REQUEST[ 'birth_y' ],$_REQUEST[ 'birth_m' ],$_REQUEST[ 'birth_d' ]);
	}else{
		$edit[ 'birth' ] = "";
	}
	$edit[ 'sex'     ] = $_REQUEST[ 'gender'  ];

	$edit[ 'pass'       ] = $_REQUEST[ 'pass'  ];
	$edit[ 'memo1'      ] = $_REQUEST[ 'memo1' ];
	$edit[ 'memo2'      ] = $_REQUEST[ 'memo2' ];
	$edit['tensaku_name'] = $_REQUEST[ 'tensaku_name'       ];
	$edit['tensaku_mail'] = $_REQUEST[ 'tensaku_mail'       ];
	$edit['mail'        ] = $_REQUEST[ 'mail'               ];
	if($_REQUEST[ 'ID_invalid' ]){
		$edit[ 'exam_id' ] = $_REQUEST[ 'id_hand' ];
		//IDを変更の際はテストデータを空欄にする
		$edit[ 'exam_state'   ] = 0;
		$edit[ 'complete_flg' ] = 0;
		$edit[ 'exam_date'    ] = '';
		$edit[ 'start_time'   ] = '';
		$edit[ 'exam_time'    ] = '';
		$edit[ 'level'        ] = '';
		$edit[ 'score'        ] = '';
		$edit[ 'soyo'         ] = '';
//		$edit[ 'birth'        ] = "";
		$edit[ 'memo1' ] = "";
		$edit[ 'memo2' ] = "";
		for($i=1;$i<=36;$i++){
			$edit[ 'q'.$i         ] = '';
		}
		for($i=1;$i<=12;$i++){
			$edit[ 'dev'.$i       ] = '';
		}
		
		
		//登録した時に取得するデータを変更する為
		//72行目で利用
		$third = $_REQUEST[ 'id_hand' ];
	}
	//データ変更
	$obj->editTestData($where,$edit);
	$invalid = $_REQUEST[ 'ID_invalid' ];
	$html = "testEditRegist";
}
//--------------------------------
//テストデータ編集終わり
//--------------------------------


//テストグループID取得
$where[ 'testgrp_id'  ] = $sec;
$where[ 'exam_id'     ] = $third;
$where[ 'partner_id'  ] = $ptid;
$where[ 'customer_id' ] = $id;
$testdata = $obj->getTestGroupId($where);

//名前データの取得
$ex = explode("　",$testdata[ 'name' ]);
$name1 = $ex[0];
$name2 = $ex[1];
//かなデータの取得
$ex = array();
$ex = explode("　",$testdata[ 'kana' ]);
$kana1 = $ex[0];
$kana2 = $ex[1];
//誕生日データの取得
$ex = array();
$ex = explode("/",$testdata[ 'birth' ]);
$birth_y = $ex[0];
$birth_m = $ex[1];
$birth_d = $ex[2];
//性別データ
$sex = $testdata[ 'sex' ];
$pass = $testdata[ 'pass' ];
//メモ1,2
$memo1 = $testdata[ 'memo1' ];
$memo2 = $testdata[ 'memo2' ];

$mail            = $testdata[ 'mail'               ];
$tensaku_name    = $testdata[ 'tensaku_name'       ];
$tensaku_mail    = $testdata[ 'tensaku_mail'       ];


//完了フラグ
$complete_flg = $testdata[ 'complete_flg' ];
//タイプ
//添削検査のときのみ44 タイプが1つのみしか取得できない
$ex = explode(",",$testdata[ 'typeLists' ]);
if(
	in_array("44",$ex)
	|| in_array("48",$ex)
	){
	$tensakuFlg = 1;
}

//-----------------------------
//確認ページ
//------------------------------
if($_REQUEST[ 'conf' ] || $_REQUEST[ 'back' ]){
	$name1   = $_REQUEST[ 'name1'      ];
	$name2   = $_REQUEST[ 'name2'      ];
	$kana1   = $_REQUEST[ 'kana1'      ];
	$kana2   = $_REQUEST[ 'kana2'      ];
	$birth_y = $_REQUEST[ 'birth_y'    ];
	$birth_m = $_REQUEST[ 'birth_m'    ];
	$birth_d = $_REQUEST[ 'birth_d'    ];
	$sex     = $_REQUEST[ 'gender'     ];
	$invalid = $_REQUEST[ 'ID_invalid' ];
	$id_hand = $_REQUEST[ 'id_hand'    ];
	//exam_id設定
	//無効化の設定を行いIDの入力が無い時自動設定
	if($invalid && !$id_hand){
		do{
			$id_hand = $obj->getRandomString(3);
			$where[ 'testgrp_id'  ] = $sec;
			$where[ 'exam_id'     ] = $id_hand;
			$where[ 'partner_id'  ] = $ptid;
			$where[ 'customer_id' ] = $id;
			//IDの重複チェック
			$idCheck = $obj->idCheck($where);
			//$idCheckが0だったら抜ける
		}while($idCheck);
	}
	$mail            = $_REQUEST[ 'mail'       ];
	$tensaku_name    = $_REQUEST[ 'tensaku_name'       ];
	$tensaku_mail    = $_REQUEST[ 'tensaku_mail'       ];

	$pass    = $_REQUEST[ 'pass'       ];
	$memo1   = $_REQUEST[ 'memo1'      ];
	$memo2   = $_REQUEST[ 'memo2'      ];
	if($_REQUEST[ 'back' ]){
		$html = "testEdit";
	}else{
		$html = "testEditConf";
	}
}
//-----------------------------
//確認ページ終わり
//------------------------------

?>