<?PHP
//-------------------------------------------
//重み付け
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_method.php");
require_once("./lib/include_wt.php");
$obj = new wtMethod();
$db = new method();


$where = array();
$where[ 'uid' ] = $id;
$where[ 'pid' ] = $ptid;
$row = $obj->getList($where);
$limit = 30;
$ceil = ceil($row/$limit)-1;
if($_REQUEST[ 'lists' ] == "true"){
	$p = sprintf("%d",$sec);
	$where[ 'limit'  ] = $limit;
	$where[ 'offset' ] = $limit*$p;
	$where[ 'master_name' ] = $_REQUEST[ 'text' ];
	$list = $obj->getList($where);
	if($list && count($list)){
		$html = "";
		foreach($list as $key=>$val){
			$html .= "
					<tr>
						<td class='left'>".$val[ 'master_name' ]."</td>
						<td class='center'>".$val[ 'date' ]."</td>
						<td class='center' >
							<input type='button' id='e-".$key."'  value='更新' class='edit w100' >
							<input type='button' id='d-".$key."' value='削除' class='del w100' >
						</td>
					</tr>
					";
			
		}
		echo $html;
	}
	exit();
}
if($sec == "del"){
	if($_REQUEST[ 'delete' ]){
		$del = array();
		$del[ 'id' ] = $third;
		$obj->delWeight($del);
		$html = "wtDelFin";
	}else{
		//エレメント取得
		$where[ 'uid' ] = $ptid;
		$el = $obj->getElement($where);
		$element[ 'e_feel'  ] = ($el[ 'e_feel'  ])?$el[ 'e_feel'  ]:$a_element[ 'w1'  ];
		$element[ 'e_cus'   ] = ($el[ 'e_cus'   ])?$el[ 'e_cus'   ]:$a_element[ 'w2'  ];
		$element[ 'e_aff'   ] = ($el[ 'e_aff'   ])?$el[ 'e_aff'   ]:$a_element[ 'w3'  ];
		$element[ 'e_cntl'  ] = ($el[ 'e_cntl'  ])?$el[ 'e_cntl'  ]:$a_element[ 'w4'  ];
		$element[ 'e_vi'    ] = ($el[ 'e_vi'    ])?$el[ 'e_vi'    ]:$a_element[ 'w5'  ];
		$element[ 'e_pos'   ] = ($el[ 'e_pos'   ])?$el[ 'e_pos'   ]:$a_element[ 'w6'  ];
		$element[ 'e_symp'  ] = ($el[ 'e_symp'  ])?$el[ 'e_symp'  ]:$a_element[ 'w7'  ];
		$element[ 'e_situ'  ] = ($el[ 'e_situ'  ])?$el[ 'e_situ'  ]:$a_element[ 'w8'  ];
		$element[ 'e_hosp'  ] = ($el[ 'e_hosp'  ])?$el[ 'e_hosp'  ]:$a_element[ 'w9'  ];
		$element[ 'e_lead'  ] = ($el[ 'e_lead'  ])?$el[ 'e_lead'  ]:$a_element[ 'w10' ];
		$element[ 'e_ass'   ] = ($el[ 'e_ass'   ])?$el[ 'e_ass'   ]:$a_element[ 'w11' ];
		$element[ 'e_adap'  ] = ($el[ 'e_adap'  ])?$el[ 'e_adap'  ]:$a_element[ 'w12' ];

		//削除
		$where = array();
		$where[ 'id'     ] = $third;
		$where[ 'uid'    ] = $id;
		$where[ 'pid'    ] = $ptid;
		$where[ 'limit'  ] = 1;
		$where[ 'offset' ] = 0;

		$datas = $obj->getList($where,"1");
		$master_name = $datas[$third][ 'master_name' ];
		$e_feel      = sprintf("%g",$datas[$third][ 'e_feel' ]);
		$e_cus       = sprintf("%g",$datas[$third][ 'e_cus'  ]);
		$e_aff       = sprintf("%g",$datas[$third][ 'e_aff'  ]);
		$e_cntl      = sprintf("%g",$datas[$third][ 'e_cntl' ]);
		$e_vi        = sprintf("%g",$datas[$third][ 'e_vi'   ]);
		$e_pos       = sprintf("%g",$datas[$third][ 'e_pos'  ]);
		$e_symp      = sprintf("%g",$datas[$third][ 'e_symp' ]);
		$e_situ      = sprintf("%g",$datas[$third][ 'e_situ' ]);
		$e_hosp      = sprintf("%g",$datas[$third][ 'e_hosp' ]);
		$e_lead      = sprintf("%g",$datas[$third][ 'e_lead' ]);
		$e_ass       = sprintf("%g",$datas[$third][ 'e_ass'  ]);
		$e_adap      = sprintf("%g",$datas[$third][ 'e_adap' ]);
		$avg         = sprintf("%g",$datas[$third][ 'avg'    ]);
		$hensa       = sprintf("%g",$datas[$third][ 'hensa'  ]);
		$html = "wtDel";
	}
}

if($sec == "new" || $sec== "edit" ){
	//データ新規登録
	//エレメント取得
	$where[ 'uid' ] = $ptid;
	$el = $obj->getElement($where);
	$element[ 'e_feel'  ] = ($el[ 'e_feel'  ])?$el[ 'e_feel'  ]:$a_element[ 'w1'  ];
	$element[ 'e_cus'   ] = ($el[ 'e_cus'   ])?$el[ 'e_cus'   ]:$a_element[ 'w2'  ];
	$element[ 'e_aff'   ] = ($el[ 'e_aff'   ])?$el[ 'e_aff'   ]:$a_element[ 'w3'  ];
	$element[ 'e_cntl'  ] = ($el[ 'e_cntl'  ])?$el[ 'e_cntl'  ]:$a_element[ 'w4'  ];
	$element[ 'e_vi'    ] = ($el[ 'e_vi'    ])?$el[ 'e_vi'    ]:$a_element[ 'w5'  ];
	$element[ 'e_pos'   ] = ($el[ 'e_pos'   ])?$el[ 'e_pos'   ]:$a_element[ 'w6'  ];
	$element[ 'e_symp'  ] = ($el[ 'e_symp'  ])?$el[ 'e_symp'  ]:$a_element[ 'w7'  ];
	$element[ 'e_situ'  ] = ($el[ 'e_situ'  ])?$el[ 'e_situ'  ]:$a_element[ 'w8'  ];
	$element[ 'e_hosp'  ] = ($el[ 'e_hosp'  ])?$el[ 'e_hosp'  ]:$a_element[ 'w9'  ];
	$element[ 'e_lead'  ] = ($el[ 'e_lead'  ])?$el[ 'e_lead'  ]:$a_element[ 'w10' ];
	$element[ 'e_ass'   ] = ($el[ 'e_ass'   ])?$el[ 'e_ass'   ]:$a_element[ 'w11' ];
	$element[ 'e_adap'  ] = ($el[ 'e_adap'  ])?$el[ 'e_adap'  ]:$a_element[ 'w12' ];

	if($sec == "edit"){
		//編集
		$where = array();
		$where[ 'id'     ] = $third;
		$where[ 'uid'    ] = $id;
		$where[ 'pid'    ] = $ptid;
		$where[ 'limit'  ] = 1;
		$where[ 'offset' ] = 0;

		$datas = $obj->getList($where,"1");
		$master_name = $datas[$third][ 'master_name' ];
		$e_feel      = sprintf("%g",$datas[$third][ 'e_feel' ]);
		$e_cus       = sprintf("%g",$datas[$third][ 'e_cus'  ]);
		$e_aff       = sprintf("%g",$datas[$third][ 'e_aff'  ]);
		$e_cntl      = sprintf("%g",$datas[$third][ 'e_cntl' ]);
		$e_vi        = sprintf("%g",$datas[$third][ 'e_vi'   ]);
		$e_pos       = sprintf("%g",$datas[$third][ 'e_pos'  ]);
		$e_symp      = sprintf("%g",$datas[$third][ 'e_symp' ]);
		$e_situ      = sprintf("%g",$datas[$third][ 'e_situ' ]);
		$e_hosp      = sprintf("%g",$datas[$third][ 'e_hosp' ]);
		$e_lead      = sprintf("%g",$datas[$third][ 'e_lead' ]);
		$e_ass       = sprintf("%g",$datas[$third][ 'e_ass'  ]);
		$e_adap      = sprintf("%g",$datas[$third][ 'e_adap' ]);
		$avg         = sprintf("%g",$datas[$third][ 'avg'    ]);
		$hensa       = sprintf("%g",$datas[$third][ 'hensa' ]);

	}
	$html = "wtNew";
}

if($_REQUEST[ 'conf' ] || $_REQUEST[ 'return'  ]){
	$master_name = $_REQUEST[ 'master_name' ];
	$e_feel      = sprintf("%g",$_REQUEST[ 'e_feel' ]);
	$e_cus       = sprintf("%g",$_REQUEST[ 'e_cus'  ]);
	$e_aff       = sprintf("%g",$_REQUEST[ 'e_aff'  ]);
	$e_cntl      = sprintf("%g",$_REQUEST[ 'e_cntl' ]);
	$e_vi        = sprintf("%g",$_REQUEST[ 'e_vi'   ]);
	$e_pos       = sprintf("%g",$_REQUEST[ 'e_pos'  ]);
	$e_symp      = sprintf("%g",$_REQUEST[ 'e_symp' ]);
	$e_situ      = sprintf("%g",$_REQUEST[ 'e_situ' ]);
	$e_hosp      = sprintf("%g",$_REQUEST[ 'e_hosp' ]);
	$e_lead      = sprintf("%g",$_REQUEST[ 'e_lead' ]);
	$e_ass       = sprintf("%g",$_REQUEST[ 'e_ass'  ]);
	$e_adap      = sprintf("%g",$_REQUEST[ 'e_adap' ]);
	$avg         = sprintf("%g",$_REQUEST[ 'avg'    ]);
	$hensa       = sprintf("%g",$_REQUEST[ 'hensa'  ]);

	$html = "wtConf";
	if($_REQUEST[ 'return' ] ){
		$html = "wtNew";
	}
}
if($_REQUEST[ 'regist' ]){
	$table = "t_weight_master";
	if($third){
		$set = array();
		$set[ 'where' ][ 'id' ] = $third;
		$set[ 'edit' ][ 'master_name' ] = $_REQUEST[ 'master_name' ];
		$set[ 'edit' ][ 'e_feel' ] = sprintf("%g",$_REQUEST[ 'e_feel'  ]);
		$set[ 'edit' ][ 'e_cus'  ] = sprintf("%g",$_REQUEST[ 'e_cus'   ]);
		$set[ 'edit' ][ 'e_aff'  ] = sprintf("%g",$_REQUEST[ 'e_aff'   ]);
		$set[ 'edit' ][ 'e_cntl' ] = sprintf("%g",$_REQUEST[ 'e_cntl'  ]);
		$set[ 'edit' ][ 'e_vi'   ] = sprintf("%g",$_REQUEST[ 'e_vi'    ]);
		$set[ 'edit' ][ 'e_pos'  ] = sprintf("%g",$_REQUEST[ 'e_pos'   ]);
		$set[ 'edit' ][ 'e_symp' ] = sprintf("%g",$_REQUEST[ 'e_symp'  ]);
		$set[ 'edit' ][ 'e_situ' ] = sprintf("%g",$_REQUEST[ 'e_situ'  ]);
		$set[ 'edit' ][ 'e_hosp' ] = sprintf("%g",$_REQUEST[ 'e_hosp'  ]);
		$set[ 'edit' ][ 'e_lead' ] = sprintf("%g",$_REQUEST[ 'e_lead'  ]);
		$set[ 'edit' ][ 'e_ass'  ] = sprintf("%g",$_REQUEST[ 'e_ass'   ]);
		$set[ 'edit' ][ 'e_adap' ] = sprintf("%g",$_REQUEST[ 'e_adap'  ]);
		$set[ 'edit' ][ 'avg'    ] = sprintf("%g",$_REQUEST[ 'avg'     ]);
		$set[ 'edit' ][ 'hensa'  ] = sprintf("%g",$_REQUEST[ 'hensa'   ]);
		
		$db->editUserData($table,$set);
	
	}else{
		$set = array();
		$set[ 'uid' ] = $id;
		$set[ 'pid' ] = $ptid;
		$set[ 'master_name' ] = $_REQUEST[ 'master_name' ];
		$set[ 'e_feel' ] = sprintf("%g",$_REQUEST[ 'e_feel'  ]);
		$set[ 'e_cus'  ] = sprintf("%g",$_REQUEST[ 'e_cus'   ]);
		$set[ 'e_aff'  ] = sprintf("%g",$_REQUEST[ 'e_aff'   ]);
		$set[ 'e_cntl' ] = sprintf("%g",$_REQUEST[ 'e_cntl'  ]);
		$set[ 'e_vi'   ] = sprintf("%g",$_REQUEST[ 'e_vi'    ]);
		$set[ 'e_pos'  ] = sprintf("%g",$_REQUEST[ 'e_pos'   ]);
		$set[ 'e_symp' ] = sprintf("%g",$_REQUEST[ 'e_symp'  ]);
		$set[ 'e_situ' ] = sprintf("%g",$_REQUEST[ 'e_situ'  ]);
		$set[ 'e_hosp' ] = sprintf("%g",$_REQUEST[ 'e_hosp'  ]);
		$set[ 'e_lead' ] = sprintf("%g",$_REQUEST[ 'e_lead'  ]);
		$set[ 'e_ass'  ] = sprintf("%g",$_REQUEST[ 'e_ass'   ]);
		$set[ 'e_adap' ] = sprintf("%g",$_REQUEST[ 'e_adap'  ]);
		$set[ 'avg'    ] = sprintf("%g",$_REQUEST[ 'avg'     ]);
		$set[ 'hensa'  ] = sprintf("%g",$_REQUEST[ 'hensa'   ]);
		$set[ 'regist_ts' ] = date("Y-m-d H:i:s");

		$db->setUserData($table,$set);
	}
	$html = "wtReg";
}
//var_dump($ptid,$id);
?>