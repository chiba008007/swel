<?PHP
//-------------------------------------------
//パートナー情報一覧表示
//
//
//
//
//
//-------------------------------------------


require_once("./lib/include_cusList.php");


$obj = new cusListMethod();
//サイト名取得
$where[ 'id' ] = $ptid;
$site = $obj->getSite($where);
$logoname = $site[ 'logo_name' ];

//全体の件数取得
$where = array();
$limit = 30;
$where[ 'pid'    ] = $ptid;
$where[ 'cid'    ] = $id;
$where[ 'basetype' ] = $basetype;

$row = $obj->getTestListRow($where);

$where['id'] = $id;
$userdata = $db->getUser($where);
$customer_file_upload = $userdata[0][ 'customer_file_upload' ];


$ceil = ceil($row/$limit)-1;
//顧客データ
$where = array();
$where[ 'id' ] = $id;
$cdata = $db->getUser($where);
$lastyear = date("Y-m-d H:i:s",strtotime("-1 year"));
//パートナーデータ
$where = array();
$where[ 'id' ] = $ptid;
$pdata = $db->getUser($where);
$csTestBtn = $cdata[0][ 'csTestBtn' ];
$ptTestBtn = $pdata[0][ 'ptTestBtn' ];


if($_REQUEST[ 'lists' ]){

	if($_REQUEST[ 'lang' ] == "ch" ){
		$str1 = "利用检查表示";
		$str2 = "工作中";
		$str3 = "准备中";
		$str4 = "结束";
		$str5 = "帐号&二维码";
		$str6 = "ID";
		$str7 = "打开";
		$str8 = "关闭";
	}else{
		$str1 = "利用検査表示";
		$str2 = "稼働中";
		$str3 = "準備中";
		$str4 = "終了";
		$str5 = "ID&QRｺｰﾄﾞ";
		$str6 = "ID一覧";
		$str7 = "オン";
		$str8 = "オフ";
	}
	//テストデータ取得
	$where = array();
	$p = sprintf("%d",$_REQUEST[ 'pages' ]);

	$where[ 'pid'    ] = $ptid;
	$where[ 'cid'    ] = $id;
	$where[ 'name'   ] = $_REQUEST[ 'text' ];
	if(!$_REQUEST[ 'text' ]){
		$where[ 'limit'  ] = $limit;
		$where[ 'offset' ] = $limit*$p;
	}
	//管理者のみrowflgが1のものを表示

	if($basetype != 1){
		//通常会員はrowflgが立っているものを表示しない
		$where[ 'rowflg' ] = 1;
	}
	$where[ 'basetype' ] = $basetype;
	$list = $obj->getTestList($where);
	//ボタン表示の為のテストデータ取得
	$blist = $obj->getButtonType($where);

	$html = "";
	if($list && count($list)){
		foreach($list as $key=>$val){
			//トライアルテストのときは青を表示
			$blue = "";
			if($val[ 'temp_flg' ] == 1){
				$blue = "blue";
			}
			if($val[ 'test_show_hide' ] == 0){
				$blue = "blue";
			}
			if($val[ 'test_show_hide' ] == 0 && $basetype == 3){
				continue;
			}

			$html .= "<tr >";
			$html .= "<td class='left ".$blue."'>";

/*
			if(!$val[ 'tamen_flg' ] && $val[ 'type' ] == 10){
				$html .= $val[ 'name' ];
				$html .= "<div class='pre' >準備中</div>";
			}else{
*/
				if($basetype == 1 || $basetype==3){
					$html .= "<a href='".D_URL."index/data/".$val['test_id']."/0'>".$val[ 'name' ]."</a>";
				}else{
					$html .= "".$val[ 'name' ]."";
				}
				if($val[ 'rowflg' ]){
					$html .= "<p class='err'>登録待ち</p>";
				}
				if(!$val[ 'tamen_flg' ] && $val[ 'type' ] == 10){
					$html .= "<div class='pre' >準備中</div>";
				}
//			}
			$html .= "<p class='right'><a href='javascript:void(0);' class='useText' id='ut_".$val['test_id']."'>".$str1."</a></p>";
			$html .= "<div class='fukidashi'><p class='arrow_box' id='fuki_".$val[ 'test_id' ]."'></p></div>";
			$html .= "</td>\n";
			$html .= "<td class='center ".$blue."'>".$val[ 'period_from' ]."～".$val[ 'period_to' ]."</td>\n";
			$html .= "<td class='".$blue."'>".number_format($val[ 'number' ])."</td>";
			$html .= "<td class='".$blue."'>".number_format($val[ 'syori'  ])."</td>";
			$html .= "<td class='".$blue."'>".number_format($val[ 'zan'    ])."</td>";

			if($val[ 'en' ] == 0){
				$sts = "<span style='color:green;'>".$str3."<span>";
			}else
			if($val[ 'status' ]){
				$sts = $str2;
			}else{
				$sts = $str4;
			}
			$html .= "<td class='center ".$blue."' >".$sts."</td>";
			$html .= "<td class='center mg0 ".$blue."'>";


			if($val[ 'rowflg' ] == 1){
				//ROWデータ一括登録
				$html .= "<ul class='ulmenu' >";
				$html .= "<li><a href='/index/del/".$val[ 'test_id' ]."'>削除</a></li>";

				$html .= "</ul>";
			}else{
				$w2 = "";
				if(( $basetype == 2 || $basetype == 3 ) && $val[ 'type' ] != 52 && $val[ 'type' ] != 60 && $val[ 'type' ] != 62 && $val[ 'type' ] != 67  && $val[ 'type' ] != 68  && $val[ 'type' ] != 86 && $val[ 'type' ] != 87 && $val[ 'type' ] != 89 && $val[ 'type' ] != 90 ){
					$w2 = "w20";
				}
				$html .= "<ul class='ulmenu ".$w2."' style='display:inline-block;'>";
				if($basetype == 1){
					$edit = "<li><a href='/index/edit/".$val[ 'test_id' ]."'>追加更新</a></li>";
				}else
				if($basetype == 2){
					if( $val[ 'test_show_hide' ] === '1'){
						$edit = "<li><a href='/index/edit/".$val[ 'test_id' ]."'>追加更新</a></li>";
					}else{
						$edit = "<li>追加更新</li>";
					}
				}
				if($basetype == 1){
					if($val[ 'delFlg' ] == "OFF"){
						$del  = "<li><a href='/index/del/".$val[ 'test_id' ]."'>削除</a></li>";
					}else{
						$del = "<li ><a href='javascript:void(0);' disabled style='background-color:#ffffff;'>削除</a></li>";
					}
				}
				if($val[ 'type' ] == 10){
					if($basetype == 1 || $basetype == 3){
						$html .= "<li><a href='/index/taqr/".$val['test_id']."/id' target=_blank >評価者ID</a></li>";
					}
					$html .= $edit;
					if($basetype == 1){
						$html .= $del;
						$html .= "<li class='w200' ><a href='/index/taReg/".$val['test_id']."'>多面評価検査内容登録</a></li>";
					}
				}else{
					//ボタン名の指定

					if(
						in_array(4,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(33,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(5,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(31,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(7,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(6,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(37,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(37,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(34,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(36,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(13,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(35,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(38,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(11,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(18,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(21,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(38,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(32,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(44,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(46,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(47,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(52,$blist[ $val['test_id'] ][ 'type' ])
						|| in_array(53,$blist[ $val['test_id'] ][ 'type' ])
                                                || in_array(60,$blist[ $val['test_id'] ][ 'type' ])
                                                || in_array(62,$blist[ $val['test_id'] ][ 'type' ])
					    || in_array(67,$blist[ $val['test_id'] ][ 'type' ])
					    || in_array(68,$blist[ $val['test_id'] ][ 'type' ])
					    || in_array(86,$blist[ $val['test_id'] ][ 'type' ])
					    || in_array(87,$blist[ $val['test_id'] ][ 'type' ])
					    || in_array(89,$blist[ $val['test_id'] ][ 'type' ])
					    || in_array(90,$blist[ $val['test_id'] ][ 'type' ])
						){
						//$qrがid:idのみ表示
						//$qrがqr:QRコード
						$button = $str6;
						$qr     = "id";
					}else{
						$button = $str5;
						$qr     = "qr";

					}

					if($basetype == 1 || $basetype == 3 ){
						$html .= "<li style=\"white-space: nowrap;width:70px;\"><a href='/index/qr/".$val['test_id']."/".$qr."' target=_blank >".$button."</a></li>";
					}
					$html .= $edit;

					if($basetype == 1){
						$html .= $del;
					}
					//評価検査
					if(
						$basetype == 1 && (
							$val[ 'type' ] == 52
							|| $val[ 'type' ] == 60
							|| $val[ 'type' ] == 62
							|| $val[ 'type' ] == 86
							|| $val[ 'type' ] == 87
							|| $val[ 'type' ] == 89
							|| $val[ 'type' ] == 90
							
						)
            ){
						$html .= "<li><a href='/index/jregist/".$val[ 'test_id' ]."'>ﾃﾞｰﾀ登録</a></li>";
						$html .= "<li><a href='/index/jallcation/".$val[ 'test_id' ]."'>ﾃﾞｰﾀ割振</a></li>";
						$html .= "<li><a href='/index/jinquiry/".$val[ 'test_id' ]."'>ｱﾝｹｰﾄ</a></li>";

					}

					if(
					     $val[ 'type' ] == 67
					    || $val[ 'type' ] == 68
					    ){
					        $html .= "<li><a href='/index/jregist2/".$val[ 'test_id' ]."'>ﾃﾞｰﾀ登録</a></li>";
					        $html .= "<li><a href='/index/jinquiry/".$val[ 'test_id' ]."'>ｱﾝｹｰﾄ</a></li>";

					}

				}
				$html .= "</ul>";
			}//rowflg終わり


			$html .= "</td>";
			if($basetype == 1 || $basetype == 3 ){
				$html .= "<td class='left ".$blue."'>";
				$html .= "<ul class='ulmail'>";
				$chk1 = "";
				$chk2 = "";
				//off画像
				$imgON1 = "<img src='/images/check_off.gif' id=img_1_".$val['test_id']." class='radio' >";
				$imgON2 = "<img src='/images/check_off.gif' id=img_2_".$val['test_id']." class='radio' >";
				if($val[ 'send_mail' ]){
					$chk1 = "CHECKED";
					//on画像
					$imgON1 = "<img src='/images/check_on.gif' id=img_1_".$val['test_id']." class='radio' >";
				}else{
					$chk2 = "CHECKED";
					//on画像
					$imgON2 = "<img src='/images/check_on.gif' id=img_2_".$val['test_id']." class='radio' >";
				}
				$html .= "<li>";
				$html .= "<div class='indent' >";
				$html .= "<input type='radio' name='send_mail_".$val[ 'test_id' ]."' value=1 ".$chk1." id='on_".$val['test_id']."' class='check' >";
				$html .= "</div>";
				$html .= "<label for='on_".$val['test_id']."'>".$imgON1.$str7."</label>";
				$html .= "</li>";
				$html .= "<li>";
				$html .= "<div class='indent' >";
				$html .= "<input type='radio' name='send_mail_".$val[ 'test_id' ]."' value=0 ".$chk2." id='off_".$val['test_id']."' class='check'>";
				$html .= "</div>";
				$html .= "<label for='off_".$val['test_id']."'>".$imgON2.$str8."</label>";
				$html .= "</li>";
				$html .= "</ul>";
				$html .= "</td>";
        if($basetype == 1 ){
               $html .= "<td style='text-align:left;' class='".$blue."'>";
               $chk = "";

               if($val[ 'pdf_log_use' ]){
                   $chk = "CHECKED";
               }
               $html .= "<label><input type='checkbox' id='pdf_log_use-".$val['test_id']."' value='1'  class='pdf_log_use'  ".$chk."> 表示する</label>";
               $html .= "</td>";
        }
			}
			$html .= "</tr>\n";
		}
	}
	echo $html;
	exit();
}

//メールお知らせ機能
if($_REQUEST[ 'sendmail' ]){
	$edit = array();
	$edit[ 'send_mail' ] = $_REQUEST[ 'status' ];
	$where[ 'id'       ] = $_REQUEST[ 'tid'    ];
	$obj->editTestSendMail($where,$edit);

	exit();
}
//吹き出し情報取得
if($_REQUEST[ 'fukidashi' ]){
	$where = array();
	$where[ 'test_id' ] = $_REQUEST[ 'tid' ];
	$fuki = $obj->getTestFukidashi($where);
	if(count($fuki)){
		$html = "";
		foreach($fuki as $key=>$val){
			$html .= $a_test_type[$val[ 'type' ]]."<br />";
		}
		echo $html;
	}
	exit();
}
//メールログ
if($_REQUEST[ 'pdf_log_flag' ]){
	$where = array();
	$edit[ 'where' ][ 'test_id' ] = $_REQUEST[ 'tid' ];
	$edit[ 'edit' ][ 'pdf_log_use' ] = $_REQUEST[ 'pdf_log' ];
 $db->editUserData("t_test",$edit);
	exit();
}

//-----------------------
//お知らせ
//----------------------
$info = $obj->getInfomation($ptid,$id);


?>