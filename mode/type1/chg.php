<?PHP
$superuser = $db->getAdminUserSuper();
if($_SESSION[ 'super' ] != 1){
    
    exit();
}

$adminuser = $db->getAdminUser();



if($_REQUEST[ 'chgEdit' ]){
	$table = "t_user";
	$where = array();
	$where[ 'edit'  ][ 'rep_name'  ] = $_REQUEST[ 'rep_name'  ];
	$where[ 'edit'  ][ 'rep_email' ] = $_REQUEST[ 'rep_email' ];

	$where[ 'where' ][ 'id'        ] = $_REQUEST[ 'superid' ];
	$db->editUserData($table,$where);
	foreach($_REQUEST[ 'adminid' ] as $key=>$val){
     $where = [];
     $where[ 'where' ][ 'id'        ] = $val;
     $where[ 'edit'  ][ 'rep_name'  ] = $_REQUEST[ 'admin_rep_name'  ][$key];
     $where[ 'edit'  ][ 'login_pw'  ] = $_REQUEST[ 'admin_login_pw'  ][$key];
     $db->editUserData($table,$where);
 }
        //$_SESSION[ 'rep_name'  ] = $_REQUEST[ 'rep_name'  ];
       // $_SESSION[ 'rep_email' ] = $_REQUEST[ 'rep_email' ];

        header("Location:/index/chg/");
        exit();
	//$html = "chgEdit";
}



















?>