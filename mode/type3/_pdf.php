<?PHP
//-------------------------------------------
//PDFダウンロード
//
//
//
//
//
//-------------------------------------------

require_once("./lib/include_pdf.php");
require_once("./lib/include_makePDF.php");
require_once("./lib/include_cusDown.php");

require_once('./lib/mpdf60/mpdf.php');


$obj = new pdfMethod();
$objw = new cusDownMethod();

ini_set( "display_errors", "Off");

define('FPDF_FONTPATH','./font/');
require('./mbfpdf.php');
if($four == "a3"){
	$pdf = new MBFPDF('L','mm','A3');
}else{
	$pdf = new MBFPDF('P','mm','A4');
}
$pdf->SetAutoPageBreak(false);


$pdf->AddPage();
$pdf->AddMBFont(PGOTHIC ,'SJIS');
$pdf->SetFont(PGOTHIC, '', 8);
$pdf->AddMBFont(GOTHIC, 'SJIS');
//パートナーデータ取得
$where[ id ] = $ptid;
$user = $obj->getUser($where);

$make = new makePDF($user[0][ 'login_id' ]);


$where = array();
$where[ 'testgrp_id'  ] = $sec;
$where[ 'exam_id'     ] = $third;
$where[ 'partner_id'  ] = $ptid;
$where[ 'customer_id' ] = $id;
//受検データ取得
$testdata  = $obj->getTestData($where);

$pdfcount = (int)$testdata[ 'pdf_output_count' ];

//PDF出力数
$getpdf = $obj->getPdfLog($sec);
$todaylimit = date("Y-m-d");
//var_dump($testdata,$pdfcount,$getpdf);

//再出力確認

$reCheck =  $obj->reGetPdfLog($sec,$third);

if($reCheck < 1){

    if($testdata[ 'pdf_output_limit' ] == 1){
        
        if($testdata[ 'pdf_output_limit_from' ] <= $todaylimit && $testdata[ 'pdf_output_limit_to' ] >= $todaylimit){
          
            
        }else{
            //  echo "PDF LIMIT";
            header("Location:/index/data/".$sec."/?pdferror=2");
            exit();
        }
    }
    
    
    if($testdata[ 'pdf_output_limit_count' ] == 1){
        if($pdfcount <= $getpdf){
            header("Location:/index/data/".$sec."/?pdferror=1");
            exit();

        }
    }
   
   
}
$testdata[ 'exam_id' ] = $third;
$stsflg = $testdata[ 'stress_flg' ];

$test_name = $testdata[ 'testname' ];
$test_name = mb_convert_encoding($testdata[ 'testname' ],"SJIS","UTF-8");
$name = mb_convert_encoding($testdata[ 'name' ],"SJIS","UTF-8");

//受検タイプ取得
$type     = $obj->getType($where);
//作成PDFの指定
$pdfline = explode(":",$testdata[ 'pdfdownload' ]);

//-------------------------------------
//PDFログ登録
//-------------------------------------
$set = [];

$set[ 'company_name' ] = $_SESSION[ 'base_site_name' ];
$set[ 'company_name_target' ] = $_SESSION[ 'name' ];
$set[ 'testname' ] = $testdata[ 'testname' ];

$set[ 'worktext' ] = "結果出力";
$set[ 'detail' ] = "pdf";

$db->setUserData("log",$set);


$set = array();
$set[ 'exam_id'    ] = $third;
$set[ 'partner_id' ] = $ptid;
$set[ 'customer_id'] = $id;
$set[ 'test_name'  ] = $test_name;
$set[ 'exam_name'  ] = $name;
$set[ 'test_id'    ] = $sec;
$set[ 'test_id'    ] = $sec;
$set[ 'pdf_type'   ] = $testdata[ 'pdfdownload' ];
$set[ 'pdf_auth'   ] = $basetype;
$obj->setPdfLog($set);


//elementデータの取得
$ewhere = array();
$ewhere[ 'uid' ] = $ptid;
$elem = $obj->getElementLists($ewhere);
//-------------------------------------
//行動価値検査結果レポート（面接版適合なし）の作成
//行動価値検査結果レポート（面接版適合あり）の作成
//-------------------------------------

//ZIPファイルでダウンロードするとき
//ダウンロードするフォルダを作成する
/*
if($five == "zip"){
	//ディレクトリの作成
	$dir = "./pdfDownload/".$sec."_".$third."/";
	@mkdir($dir);
}
*/


//-------------------------------------
//神戸教育委員会用
//-------------------------------------
if(in_array("35",$pdfline)){
	require_once("./lib/include_AAP.php");
	require_once("./lib/include_dataList.php");
	require_once("./lib/keisan/functionPDF35.php");
	
	$aap = new aapClass();
	$dl = new dataListMethod();
	$logo = D_URL."/img/pdflogo/pl_".$user[0]['login_id'].".jpg";
	if(!file_get_contents($logo)){
		$logo = "/image/welcome.jpg";
	}
	$stress_flg = $testdata[ 'stress_flg' ];

	$pt35 = $objw->getSougoPoint($testdata);
	$color = $objw->color;
	$km = "※";
	//var_dump($testdata,$user);
	//exit();
	$mpdf = new mPDF('ja', 'A3-L', 0, '', 10, 1, 1, 1, 9, 9);
	$mpdf->ignore_invalid_utf8 = true;
	$testdate = explode("-",substr($testdata["findate"],0,10));
	$age = $aap->get_age(
					preg_replace("/\//","-",$testdata[ 'birth' ])
					,$testdata[ 'findate' ]);
					
	$contents = file_get_contents(D_URL_HOME.'template/pdf/pdf35.html');
	$contents = preg_replace("/##CNAME##/",$testdata['cusname'],$contents);
	$contents = preg_replace("/##LOGOPATH##/",$logo,$contents);
	$contents = preg_replace("/##Y##/",$testdate[0],$contents);
	$contents = preg_replace("/##M##/",$testdate[1],$contents);
	$contents = preg_replace("/##D##/",$testdate[2],$contents);
	$contents = preg_replace("/##EXAMID##/",$testdata['exam_id'],$contents);
	$contents = preg_replace("/##NAME##/",$testdata['name'],$contents);
	$contents = preg_replace("/##AGE##/",$age,$contents);
	$contents = preg_replace("/##COLOR##/",$color,$contents);
	//$contents = preg_replace("/##JUDGE##/",$objw->judge,$contents);
	$contents = preg_replace("/##JUDGE##/",$objw->rs_sougolv,$contents);
	$contents = preg_replace("/##SOUGOP##/",$objw->sougoP,$contents);
	//$contents = preg_replace("/##sLEFT##/",470+22*$objw->sougo/10,$contents);
	//★の位置の調整値
	//2桁目と1桁目を分けて調整
	$keyptX = $objw->getStX();
	$contents = preg_replace("/##sLEFT##/",(470+21*(($objw->tenX*10)+$keyptX)/10)+44*($objw->oneX/10),$contents);
	$keyptY = $objw->getStY();
	$contents = preg_replace("/##sTOP##/",380-((22*$keyptY)+44*($objw->oneY/10)),$contents);
	if($objw->judge == 1) $contents = preg_replace("/##J1##/",$km,$contents);
	if($objw->judge == 2) $contents = preg_replace("/##J2##/",$km,$contents);
	if($objw->judge == 3) $contents = preg_replace("/##J3##/",$km,$contents);
	if($objw->judge == 4) $contents = preg_replace("/##J4##/",$km,$contents);
	if($objw->judge == 5) $contents = preg_replace("/##J5##/",$km,$contents);
	$contents = preg_replace("/##J1##/","",$contents);
	$contents = preg_replace("/##J2##/","",$contents);
	$contents = preg_replace("/##J3##/","",$contents);
	$contents = preg_replace("/##J4##/","",$contents);
	$contents = preg_replace("/##J5##/","",$contents);
	$contents = preg_replace("/##COMMENT1##/",getComment1($objw->judge),$contents);
	
	$rs = $obj->getPdfDataRs($where);
	
	$sougo     = sprintf("%.1f",round($rs[0][ 'sougo'     ],1));
	$yomitori  = sprintf("%.1f",round($rs[0][ 'yomitori'  ],1));
	$rikai     = sprintf("%.1f",round($rs[0][ 'rikai'     ],1));
	$sentaku   = sprintf("%.1f",round($rs[0][ 'sentaku'   ],1));
	$kirikae   = sprintf("%.1f",round($rs[0][ 'kirikae'   ],1));

	$rsid = getComment2ID($yomitori,$rikai,$sentaku,$kirikae);
	//コメント配列読み込み
	require_once("./mode/pdf/pdf4_comment.php");
	$comment2 = $array_pdf_rsbalance[$rsid];
	$contents = preg_replace("/##COMMENT2##/",mb_convert_encoding($comment2,"UTF-8","SJIS"),$contents);

	//行動価値適合度
	$contents = preg_replace("/##SOGOSC##/",$objw->score,$contents);
	$sogobar = $objw->getBarWidth("score");
	$contents = preg_replace("/##SOGOBAR##/",$sogobar,$contents);
	$sogoback = "";
	if($objw->lv <=2 ) $sogoback = "red";
	$contents = preg_replace("/##SOGOBACK##/",$sogoback,$contents);

	$contents = preg_replace("/##DEV1SC##/",$objw->dev1,$contents);
	$DEV1BAR = $objw->getBarWidth("dev1");
	$contents = preg_replace("/##DEV1BAR##/",$DEV1BAR,$contents);
	$sogoback = "";
	if($objw->dev1lv <=2 ) $dev1back = "red";
	$contents = preg_replace("/##DEV1BACK##/",$dev1back,$contents);


	$contents = preg_replace("/##DEV2SC##/",$objw->dev2,$contents);
	$DEV2BAR = $objw->getBarWidth("dev2");
	$contents = preg_replace("/##DEV2BAR##/",$DEV2BAR,$contents);
	$sogoback = "";
	if($objw->dev2lv <=2 ) $dev2back = "red";
	$contents = preg_replace("/##DEV2BACK##/",$dev2back,$contents);
	

	$contents = preg_replace("/##DEV4SC##/",$objw->dev4,$contents);
	$DEV4BAR = $objw->getBarWidth("dev4");
	$contents = preg_replace("/##DEV4BAR##/",$DEV4BAR,$contents);
	if($objw->dev4lv <=2 ) $dev4back = "red";
	$contents = preg_replace("/##DEV4BACK##/",$dev4back,$contents);


	$contents = preg_replace("/##DEV7SC##/",$objw->dev7,$contents);
	$DEV7BAR = $objw->getBarWidth("dev7");
	$contents = preg_replace("/##DEV7BAR##/",$DEV7BAR,$contents);
	if($objw->dev7lv <=2 ) $dev7back = "red";
	$contents = preg_replace("/##DEV7BACK##/",$dev7back,$contents);


	$contents = preg_replace("/##DEV8SC##/",$objw->dev8,$contents);
	$DEV8BAR = $objw->getBarWidth("dev8");
	$contents = preg_replace("/##DEV8BAR##/",$DEV8BAR,$contents);
	if($objw->dev8lv <=2 ) $dev8back = "red";
	$contents = preg_replace("/##DEV8BACK##/",$dev8back,$contents);


	$contents = preg_replace("/##DEV10SC##/",$objw->dev10,$contents);
	$DEV10BAR = $objw->getBarWidth("dev10");
	$contents = preg_replace("/##DEV10BAR##/",$DEV10BAR,$contents);
	if($objw->dev10lv <=2 ) $dev10back = "red";
	$contents = preg_replace("/##DEV10BACK##/",$dev10back,$contents);


	$contents = preg_replace("/##DEV12SC##/",$objw->dev12,$contents);
	$DEV12BAR = $objw->getBarWidth("dev12");
	$contents = preg_replace("/##DEV12BAR##/",$DEV12BAR,$contents);
	if($objw->dev12lv <=2 ) $dev12back = "red";
	$contents = preg_replace("/##DEV12BACK##/",$dev12back,$contents);


	$contents = preg_replace("/##SOGOLV##/",$objw->lv,$contents);
	$contents = preg_replace("/##DEV1LV##/",$objw->dev1lv,$contents);
	$contents = preg_replace("/##DEV2LV##/",$objw->dev2lv,$contents);
	$contents = preg_replace("/##DEV4LV##/",$objw->dev4lv,$contents);
	$contents = preg_replace("/##DEV7LV##/",$objw->dev7lv,$contents);
	$contents = preg_replace("/##DEV8LV##/",$objw->dev8lv,$contents);
	$contents = preg_replace("/##DEV10LV##/",$objw->dev10lv,$contents);
	$contents = preg_replace("/##DEV12LV##/",$objw->dev12lv,$contents);
	
	$interviews = $objw->interviewCheck();
	$interview = getInterView($interviews);

	$contents = preg_replace("/##CHECKTITLE1##/",$interview[1]['title'],$contents);
	$contents = preg_replace("/##CHECKTITLE2##/",$interview[2]['title'],$contents);
	$contents = preg_replace("/##CHECKRISK1##/",$interview[1]['risk'],$contents);
	$contents = preg_replace("/##CHECKRISK2##/",$interview[2]['risk'],$contents);
	$contents = preg_replace("/##CHECKQ1##/",$interview[1]['q'],$contents);
	$contents = preg_replace("/##CHECKQ2##/",$interview[2]['q'],$contents);
	$contents = preg_replace("/##CHECKJ1##/",$interview[1]['j'],$contents);
	$contents = preg_replace("/##CHECKJ2##/",$interview[2]['j'],$contents);

	if($stress_flg){
		list($stress_lv,$stress_score) = $dl->getStress2($objw->dev1,$objw->dev2,$objw->dev6);
	}else{
		list($stress_lv,$stress_score) = $dl->getStress($objw->dev1,$objw->dev2);
	}

	if($stress_score < 45){
		$contents = preg_replace("/##STBACK##/","red",$contents);
	}else{
		$contents = preg_replace("/##STBACK##/","",$contents);
	}
	$contents = preg_replace("/##STSC##/",$stress_score,$contents);
	$contents = preg_replace("/##STLV##/",$stress_lv,$contents);
	$STRESSBAR = $objw->getStressBarWidth($stress_score);
	$contents = preg_replace("/##STRESSBAR##/",$STRESSBAR,$contents);

	if($stress_lv == 2){
		if($objw->dev1 < $objw->dev2){
			$stressCmt = getStressComment('dev1');
		}else{
			$stressCmt = getStressComment('dev2');
		}
	}elseif($stress_lv == 1){
		$stressCmt = getStressComment('1');
	}
	
	$contents = preg_replace("/##STRESSR##/",$stressCmt['risk'],$contents);
	$contents = preg_replace("/##STRESSQ##/",$stressCmt['q'],$contents);
	$contents = preg_replace("/##STRESSJ##/",$stressCmt['j'],$contents);
	
	$contents = preg_replace("/##RSSOGOSC##/",round($objw->rs_sougo,1),$contents);
	$contents = preg_replace("/##RSSOGOLV##/",$objw->rs_sougolv,$contents);
	if($objw->rs_sougolv <= 2){ $contents = preg_replace("/##RSSOGOBACK##/","red",$contents);
	}else{ $contents = preg_replace("/##RSSOGOBACK##/","",$contents);}


	$contents = preg_replace("/##RSYOMITORISC##/",round($objw->rs_yomitori,1),$contents);
	$contents = preg_replace("/##RSYOMITORILV##/",$objw->rs_yomitorilv,$contents);
	if($objw->rs_yomitorilv <= 2){ $contents = preg_replace("/##RSYOMITORIBACK##/","red",$contents);
	}else{ $contents = preg_replace("/##RSYOMITORIBACK##/","",$contents);}



	$contents = preg_replace("/##RSRIKAISC##/",round($objw->rs_rikai,1),$contents);
	$contents = preg_replace("/##RSRIKAILV##/",$objw->rs_rikailv,$contents);
	if($objw->rs_rikailv <= 2){ $contents = preg_replace("/##RSRIKAIBACK##/","red",$contents);
	}else{ $contents = preg_replace("/##RSRIKAIBACK##/","",$contents);}


	$contents = preg_replace("/##RSSELECTSC##/",round($objw->rs_sentaku,1),$contents);
	$contents = preg_replace("/##RSSELECTLV##/",$objw->rs_sentakulv,$contents);
	if($objw->rs_sentakulv <= 2){ $contents = preg_replace("/##RSSELECTBACK##/","red",$contents);
	}else{ $contents = preg_replace("/##RSSELECTBACK##/","",$contents);}


	$contents = preg_replace("/##RSCHANGESC##/",round($objw->rs_kirikae,1),$contents);
	$contents = preg_replace("/##RSCHANGELV##/",$objw->rs_kirikaelv,$contents);
	if($objw->rs_kirikaelv <= 2){ $contents = preg_replace("/##RSCHANGEBACK##/","red",$contents);
	}else{ $contents = preg_replace("/##RSCHANGEBACK##/","",$contents);}


	$contents = preg_replace("/##RSINFOSC##/",round($objw->rs_jyoho,1),$contents);
	$contents = preg_replace("/##RSINFOLV##/",$objw->rs_jyoholv,$contents);
	if($objw->rs_jyoholv <= 2){ $contents = preg_replace("/##RSINFOBACK##/","red",$contents);
	}else{ $contents = preg_replace("/##RSINFOBACK##/","",$contents);}

	$RS1BAR = $objw->getBarWidth("rs_sougo");	
	$RS2BAR = $objw->getBarWidth("rs_yomitori");	
	$RS3BAR = $objw->getBarWidth("rs_rikai");	
	$RS4BAR = $objw->getBarWidth("rs_sentaku");	
	$RS5BAR = $objw->getBarWidth("rs_kirikae");	
	$RS6BAR = $objw->getBarWidth("rs_jyoho");	
	$contents = preg_replace("/##RS1BAR##/",$RS1BAR,$contents);
	$contents = preg_replace("/##RS2BAR##/",$RS2BAR,$contents);
	$contents = preg_replace("/##RS3BAR##/",$RS3BAR,$contents);
	$contents = preg_replace("/##RS4BAR##/",$RS4BAR,$contents);
	$contents = preg_replace("/##RS5BAR##/",$RS5BAR,$contents);
	$contents = preg_replace("/##RS6BAR##/",$RS6BAR,$contents);

	$rs_interview = $objw->interviewCheckRS();
	$rs_comment = getRSComment($rs_interview);

	$contents = preg_replace("/##RS_CHECKTITLE1##/",$rs_comment[0]['t'],$contents);
	$contents = preg_replace("/##RS_CHECKRISK1##/",$rs_comment[0]['r'],$contents);
	$contents = preg_replace("/##RS_CHECKQ1##/",$rs_comment[0]['q'],$contents);
	$contents = preg_replace("/##RS_CHECKJ1##/",$rs_comment[0]['j'],$contents);
	$contents = preg_replace("/##RS_CHECKTITLE2##/",$rs_comment[1]['t'],$contents);
	$contents = preg_replace("/##RS_CHECKRISK2##/",$rs_comment[1]['r'],$contents);
	$contents = preg_replace("/##RS_CHECKQ2##/",$rs_comment[1]['q'],$contents);
	$contents = preg_replace("/##RS_CHECKJ2##/",$rs_comment[1]['j'],$contents);

	//規範適応力
	$adapt = $objw->getBasicScore();
	$contents = preg_replace("/##RSBASIC##/",$adapt['basic']['sc'],$contents);
	$contents = preg_replace("/##RSEMOTIONSC##/",$adapt['emotion']['sc'],$contents);
	$contents = preg_replace("/##RSIMAGESC##/",$adapt['image']['sc'],$contents);
	$contents = preg_replace("/##RSBASICLV##/",$objw->basiclv,$contents);
	$contents = preg_replace("/##RSEMOTIONLV##/",$objw->emotionlv,$contents);
	$contents = preg_replace("/##RSIMAGELV##/",$objw->imagelv,$contents);

	$BC1BAR = $objw->getBarWidth("basic");	
	$BC2BAR = $objw->getBarWidth("emotion");	
	$BC3BAR = $objw->getBarWidth("image");
	$contents = preg_replace("/##BC1BAR##/",$BC1BAR,$contents);
	$contents = preg_replace("/##BC2BAR##/",$BC2BAR,$contents);
	$contents = preg_replace("/##BC3BAR##/",$BC3BAR,$contents);
	$basics = $objw->basicCheckRS();
	$bc_comment = getBCComment($basics);

	$contents = preg_replace("/##BC_CHECKTITLE1##/",$bc_comment[0]['t'],$contents);
	$contents = preg_replace("/##BC_CHECKRISK1##/",$bc_comment[0]['r'],$contents);
	$contents = preg_replace("/##BC_CHECKQ1##/",$bc_comment[0]['q'],$contents);
	$contents = preg_replace("/##BC_CHECKJ1##/",$bc_comment[0]['j'],$contents);
	$contents = preg_replace("/##BC_CHECKTITLE2##/",$bc_comment[1]['t'],$contents);
	$contents = preg_replace("/##BC_CHECKRISK2##/",$bc_comment[1]['r'],$contents);
	$contents = preg_replace("/##BC_CHECKQ2##/",$bc_comment[1]['q'],$contents);
	$contents = preg_replace("/##BC_CHECKJ2##/",$bc_comment[1]['j'],$contents);
	
	$mpdf->SetAutoPageBreak(false);
	$mpdf->WriteHTML($contents);

	//echo $contents;
    // PDF表示
    $date = date("Ymdhis");
    $mpdf->Output($date.'.pdf', 'D');
  //  $mpdf->Output($date.'.pdf', 'I');
    
	exit();
	
}


if(
	in_array("21",$pdfline)
	){
	
	$mms = array();
	$mms[ 'test_id' ] = $testdata[ 'tid' ];
	$mms[ 'exam_id' ] = $testdata[ 'exam_id' ];
	$testdata[ 'mms' ] = $obj->getMMSData($mms);
}

if(
	in_array("1",$pdfline)
	|| in_array("2",$pdfline)
	|| in_array("22",$pdfline)
	|| in_array("24",$pdfline)
	|| in_array("28",$pdfline)
        || in_array("30",$pdfline)
        || in_array("31",$pdfline)
        || in_array("34",$pdfline)        
	){
	$types = array(1,2,12,59,72);

	$testdata['type'] = $obj->getTestPaper($where,$types);

	if($five){
		//マスタデータがあるときは値の再設定

		if(in_array("2",$pdfline)){
			//重みデータ取得
			$wtwhere = array();
			$wtwhere[ 'id' ] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
		if(in_array("28",$pdfline)){
			//重みデータ取得
			$wtwhere = array();
			$wtwhere[ 'id' ] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}

		if(in_array("30",$pdfline)){
			//重みデータ取得
			$wtwhere = array();
			$wtwhere[ 'id' ] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
                if(in_array("31",$pdfline)){
			//重みデータ取得
			$wtwhere = array();
			$wtwhere[ 'id' ] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
                if(in_array("34",$pdfline)){
			//重みデータ取得
			$wtwhere = array();
			$wtwhere[ 'id' ] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
		$masterType = array();
		foreach($type as $k=>$v){
			$masterType[$v] = $v;
		}
		//BAJ1
		$wtwhere = array();
		$wtwhere[ 'cid'        ] = $id;
		$wtwhere[ 'pid'        ] = $ptid;
		$wtwhere[ 'exam_id'    ] = $third;
		$wtwhere[ 'testgrp_id' ] = $sec;
		if(in_array("1",$masterType)){
			include_once(D_PATH_HOME."/lib/keisan/functionBA.php");
			include_once(D_PATH_HOME."/init/rowData/raw_data_ta.php");
			include_once(D_PATH_HOME."/init/rowData/dev_data_ta.php");
			//回答データ取得
			$wpaper = $obj->getAnswerPaper($wtwhere,1);
			list($rowdata,$lv,$standard_score,$dev_number) = BA($wpaper,$wtm,$raw_data,$dev_data,1);
			//取得データの書き換え
			$testdata['type']['dev1'  ] = round($rowdata[ 'dev1'  ],4);
			$testdata['type']['dev2'  ] = round($rowdata[ 'dev2'  ],4);
			$testdata['type']['dev3'  ] = round($rowdata[ 'dev3'  ],4);
			$testdata['type']['dev4'  ] = round($rowdata[ 'dev4'  ],4);
			$testdata['type']['dev5'  ] = round($rowdata[ 'dev5'  ],4);
			$testdata['type']['dev6'  ] = round($rowdata[ 'dev6'  ],4);
			$testdata['type']['dev7'  ] = round($rowdata[ 'dev7'  ],4);
			$testdata['type']['dev8'  ] = round($rowdata[ 'dev8'  ],4);
			$testdata['type']['dev9'  ] = round($rowdata[ 'dev9'  ],4);
			$testdata['type']['dev10' ] = round($rowdata[ 'dev10' ],4);
			$testdata['type']['dev11' ] = round($rowdata[ 'dev11' ],4);
			$testdata['type']['dev12' ] = round($rowdata[ 'dev12' ],4);
			$testdata['type']['soyo'  ] =  $dev_number;
			$testdata['level' ] =  $lv;
			$testdata['score' ] =  $standard_score;
		}
		if(in_array("59",$masterType)){
			include_once(D_PATH_HOME."/lib/keisan/functionBA.php");
			include_once(D_PATH_HOME."/init/rowData/raw_data_ta.php");
			include_once(D_PATH_HOME."/init/rowData/dev_data_ta.php");
			//回答データ取得
			$wpaper = $obj->getAnswerPaper($wtwhere,59);
			list($rowdata,$lv,$standard_score,$dev_number) = BA($wpaper,$wtm,$raw_data,$dev_data,1);
			//取得データの書き換え
			$testdata['type']['dev1'  ] = round($rowdata[ 'dev1'  ],4);
			$testdata['type']['dev2'  ] = round($rowdata[ 'dev2'  ],4);
			$testdata['type']['dev3'  ] = round($rowdata[ 'dev3'  ],4);
			$testdata['type']['dev4'  ] = round($rowdata[ 'dev4'  ],4);
			$testdata['type']['dev5'  ] = round($rowdata[ 'dev5'  ],4);
			$testdata['type']['dev6'  ] = round($rowdata[ 'dev6'  ],4);
			$testdata['type']['dev7'  ] = round($rowdata[ 'dev7'  ],4);
			$testdata['type']['dev8'  ] = round($rowdata[ 'dev8'  ],4);
			$testdata['type']['dev9'  ] = round($rowdata[ 'dev9'  ],4);
			$testdata['type']['dev10' ] = round($rowdata[ 'dev10' ],4);
			$testdata['type']['dev11' ] = round($rowdata[ 'dev11' ],4);
			$testdata['type']['dev12' ] = round($rowdata[ 'dev12' ],4);
			$testdata['type']['soyo'  ] =  $dev_number;
			$testdata['level' ] =  $lv;
			$testdata['score' ] =  $standard_score;
		}

		if(in_array("2",$masterType)){
			include_once(D_PATH_HOME."/lib/keisan/functionBA2.php");
			include_once(D_PATH_HOME."/init/rowData/raw_data_tb.php");
			include_once(D_PATH_HOME."/init/rowData/dev_data_tb.php");
			//回答データ取得
			$wpaper = $obj->getAnswerPaper($wtwhere,2);
			list($rowdata,$lv,$standard_score,$dev_number) = BA2($wpaper,$wtm,$raw_data,$dev_data,1);
			//取得データの書き換え
			$testdata['type']['dev1'  ] = round($rowdata[ 'dev1'  ],4);
			$testdata['type']['dev2'  ] = round($rowdata[ 'dev2'  ],4);
			$testdata['type']['dev3'  ] = round($rowdata[ 'dev3'  ],4);
			$testdata['type']['dev4'  ] = round($rowdata[ 'dev4'  ],4);
			$testdata['type']['dev5'  ] = round($rowdata[ 'dev5'  ],4);
			$testdata['type']['dev6'  ] = round($rowdata[ 'dev6'  ],4);
			$testdata['type']['dev7'  ] = round($rowdata[ 'dev7'  ],4);
			$testdata['type']['dev8'  ] = round($rowdata[ 'dev8'  ],4);
			$testdata['type']['dev9'  ] = round($rowdata[ 'dev9'  ],4);
			$testdata['type']['dev10' ] = round($rowdata[ 'dev10' ],4);
			$testdata['type']['dev11' ] = round($rowdata[ 'dev11' ],4);
			$testdata['type']['dev12' ] = round($rowdata[ 'dev12' ],4);
			$testdata['type']['soyo'  ] =  $dev_number;
			$testdata['level' ] =  $lv;
			$testdata['score' ] =  $standard_score;
		}
		if(in_array("12",$masterType) || in_array("72",$masterType) ){
			include_once(D_PATH_HOME."/lib/keisan/functionBA12.php");
			include_once(D_PATH_HOME."/init/rowData/raw_data_ta3.php");
			include_once(D_PATH_HOME."/init/rowData/dev_data_ta3.php");
			//回答データ取得
			if( in_array("72",$masterType) ){
				$wpaper = $obj->getAnswerPaper($wtwhere,72);
			}else{
				$wpaper = $obj->getAnswerPaper($wtwhere,12);
			}
			list($rowdata,$lv,$standard_score,$dev_number) = BA12($wpaper,$wtm,$raw_data,$dev_data);
			//取得データの書き換え
			$testdata['type']['dev1'  ] = round($rowdata[ 'dev1'  ],4);
			$testdata['type']['dev2'  ] = round($rowdata[ 'dev2'  ],4);
			$testdata['type']['dev3'  ] = round($rowdata[ 'dev3'  ],4);
			$testdata['type']['dev4'  ] = round($rowdata[ 'dev4'  ],4);
			$testdata['type']['dev5'  ] = round($rowdata[ 'dev5'  ],4);
			$testdata['type']['dev6'  ] = round($rowdata[ 'dev6'  ],4);
			$testdata['type']['dev7'  ] = round($rowdata[ 'dev7'  ],4);
			$testdata['type']['dev8'  ] = round($rowdata[ 'dev8'  ],4);
			$testdata['type']['dev9'  ] = round($rowdata[ 'dev9'  ],4);
			$testdata['type']['dev10' ] = round($rowdata[ 'dev10' ],4);
			$testdata['type']['dev11' ] = round($rowdata[ 'dev11' ],4);
			$testdata['type']['dev12' ] = round($rowdata[ 'dev12' ],4);
			$testdata['type']['soyo'  ] =  $dev_number;
			$testdata['level' ] =  $lv;
			$testdata['score' ] =  $standard_score;
		}
	}
     
        
	//ストレスレベルスコア取得
	if($stsflg == 1){
		list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
	}else{
		list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
	}
        
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);
	if($five){
		//マスタデータがあるときは重みの再設定
		$testweight = array();
		$testweight[0] = $wtm;
	}
	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}

	//var_dump($testdata);
	$name = mb_convert_encoding($name,"utf-8","sjis");
	$ques = "3.".$name." さんへの質問例";
	$ques2 = "3.".$name." さんの強み";
	$ques = mb_convert_encoding($ques,"sjis-win","UTF-8");
	$ques2 = mb_convert_encoding($ques2,"sjis-win","UTF-8");
	require_once("./mode/pdf/pdf1_2_comment.php");

}

//-------------------------------------
//AAP　HTMLから出力
//-------------------------------------
if(in_array("33",$pdfline)){
    require_once("./lib/include_AAP.php");
    require_once("./mode/pdf/pdf33_comment.php");
    $aap = new aapClass();
    $where = array();
    $where[ 'testgrp_id' ] = $sec;
    $where[ 'exam_id' ] = $third;
    $list = $aap->getPdfData($where);
    //男性用
    $contents = "";
    //女性用
    $contents2 = "";
   // var_dump($list);
    
    //男性用
    $sort = array();
    //女性用
    $sort2 = array();
    $con = array();
    $con2 = array();
    foreach($list[1] as $key=>$val){
        if(preg_match("/^dev/",$key)){
            $sort[$key] = $val;
        }
        if(preg_match("/^con/",$key)){
            $con[$key] = $val;
        }
    }
    foreach($list[2] as $key=>$val){
        if(preg_match("/^dev/",$key)){
            $sort2[$key] = $val;
        }
        if(preg_match("/^con/",$key)){
            $con2[$key] = $val;
        }
    }
    
    //var_dump($sort,$sort2);
    //var_dump($con,$con2);
    
    $point = array();
    $nums = array();
    foreach($sort as $key=>$val){
        $point[ $key ] = $val;
        $num = preg_replace("/^dev/","",$key);
        $nums[ $key ] = $num;
    }
    $point2 = array();
    $nums2 = array();
    foreach($sort2 as $key=>$val){
        $point2[ $key ] = $val;
        $num2 = preg_replace("/^dev/","",$key);
        $nums2[ $key ] = $num2;
    }
  //  var_dump($point2,$num2);
    array_multisort($point, SORT_DESC,$nums,SORT_ASC,$sort);
    array_multisort($point2, SORT_DESC,$nums2,SORT_ASC,$sort2);
   // var_dump($sort,$sort2);
    
    
    
    foreach($sort as $key=>$val){
        $one = $key;
        $onekey = preg_replace("/^dev/","",$key);
         break;
    }
    foreach($sort2 as $key=>$val){
        $one2 = $key;
        $onekey2 = preg_replace("/^dev/","",$key);
         break;
    }
    
    
    //３については、下記により出力します。
    $a1 = ($con[ 'con1' ]+$con[ 'con2' ]+$con[ 'con3' ])/3;
    $b1 = ($con[ 'con4' ]+$con[ 'con5' ]+$con[ 'con6' ])/3;
    //バランスタイプ
    $comme = 4;
    if($a1 >= 50 && $b1 >= 50){ 
        $comme = 1; 
    }else
    if($a1 >= 50 && $b1 < 50){ 
        $comme = 2;
    }else
    if($a1 < 50 && $b1 >= 50){ 
        $comme = 3;
    }
    
    
    $a2 = ($con2[ 'con1' ]+$con2[ 'con2' ]+$con2[ 'con3' ])/3;
    $b2 = ($con2[ 'con4' ]+$con2[ 'con5' ]+$con2[ 'con6' ])/3;
    //バランスタイプ
    $comme2 = 4;
    if($a2 >= 50 && $b2 >= 50){
        $comme2 = 1;
    }else
    if($a2 >= 50 && $b2 < 50){
        $comme2 = 2;
    }else
    if($a2 < 50 && $b2 >= 50){
        $comme2 = 3;
    }
    
    if($list[ 1 ][ 'gender' ] == 1){
        $st = explode(" ",$list[1][ 'start_time' ]);
        $st2 = explode("-",$st[0]);
        $age = $aap->get_age($list[1][ 'birthday' ],$list[1][ 'start_time' ]);
        
        $contents = file_get_contents(D_URL_HOME.'template/pdf/pdf33_m.html');
        $contents = preg_replace("/##YEAR##/",$st2[0],$contents);
        $contents = preg_replace("/##MONTH##/",$st2[1],$contents);
        $contents = preg_replace("/##DAY##/",$st2[2],$contents);
        $contents = preg_replace("/##NAME##/",$list[1][ 'man' ],$contents);
        $contents = preg_replace("/##MESSAGE1##/",$comment33_type[$list[1][ 'ans75' ]][ 'note' ],$contents);
        $contents = preg_replace("/##IMG1##/",$comment33_type[$list[1][ 'ans75' ]][ 'imgF' ],$contents);
        $contents = preg_replace("/##TITLE1##/",$comment33_type[$list[1][ 'ans75' ]][ 'title' ],$contents);
        
        $contents = preg_replace("/##MESSAGE2##/",$comment33_strong[$onekey][ 'note' ],$contents);
        $contents = preg_replace("/##IMG2##/",$comment33_strong[$onekey][ 'img' ],$contents);
        $contents = preg_replace("/##TITLE2##/",$comment33_strong[$onekey][ 'disp' ],$contents);
       
        $contents = preg_replace("/##MESSAGE3##/",$comment33_comu[$comme][ 'note' ],$contents);
        $contents = preg_replace("/##TITLE3##/",$comment33_comu[$comme][ 'title' ],$contents);
        
    }
    
    if($list[ 2 ][ 'gender' ] == 2){
        $contents2 = file_get_contents(D_URL_HOME.'template/pdf/pdf33_w.html');
        $st = array();
        $st2 = array();
        $st = explode(" ",$list[2][ 'start_time' ]);
        $st2 = explode("-",$st[0]);
        $age = $aap->get_age($list[2][ 'birthday' ],$list[2][ 'start_time' ]);
        
        $contents2 = preg_replace("/##YEAR##/",$st2[0],$contents2);
        $contents2 = preg_replace("/##MONTH##/",$st2[1],$contents2);
        $contents2 = preg_replace("/##DAY##/",$st2[2],$contents2);
        $contents2 = preg_replace("/##NAME##/",$list[2][ 'woman' ],$contents2);
        
        $contents2 = preg_replace("/##MESSAGE1##/",$comment33_type[$list[2][ 'ans75' ]][ 'note' ],$contents2);
        $contents2 = preg_replace("/##IMG1##/",$comment33_type[$list[2][ 'ans75' ]][ 'imgM' ],$contents2);
        $contents2 = preg_replace("/##TITLE1##/",$comment33_type[$list[2][ 'ans75' ]][ 'title' ],$contents2);
        
        $contents2 = preg_replace("/##MESSAGE2##/",$comment33_strong[$onekey2][ 'note' ],$contents2);
        $contents2 = preg_replace("/##IMG2##/",$comment33_strong[$onekey2][ 'img' ],$contents2);
        $contents2 = preg_replace("/##TITLE2##/",$comment33_strong[$onekey2][ 'disp' ],$contents2);
        
        $contents2 = preg_replace("/##MESSAGE3##/",$comment33_comu[$comme2][ 'note' ],$contents2);
        $contents2 = preg_replace("/##TITLE3##/",$comment33_comu[$comme2][ 'title' ],$contents2);
    }
        
    
    // 日本語化 ja+aCJK
    // フォーマット A4は縦、A4-Lは横
    // 左マージン 15、右マージン 15、上マージン 16、下マージン 16、ヘッダマージン 9、フッタマージン 9
    $mpdf = new mPDF('ja', 'A4', 0, '', 15, 15, 16, 16, 9, 9);
    $mpdf->ignore_invalid_utf8 = true;
    if($list[ 1 ][ 'gender' ] == 1) $mpdf->WriteHTML($contents);
    if(
        $list[ 1 ][ 'gender' ] == 1
            && $list[ 2 ][ 'gender' ] == 2
        ){
            $mpdf->AddPage();
        }
    if($list[ 2 ][ 'gender' ] == 2) $mpdf->WriteHTML($contents2);
    
    // PDF表示
    $date = date("Ymdhis");
    $mpdf->Output($date.'.pdf', 'D');
    
    exit();
}

//-------------------------------------
//ACC　HTMLから出力
//-------------------------------------
if(in_array("32",$pdfline)){
    require_once("./lib/include_AAC.php");
    $acc = new aacClass();
    $where = array();
    $where[ 'testgrp_id' ] = $sec;
    $where[ 'exam_id' ] = $third;
    list($accdata,$regi) = $acc->getData( $where );

    $reg1 = split(" ",$regi[0]['regist_ts']);
    $reg = split("-",$reg1[0]);

	$devarray['dev1'] = $accdata[0]['dev1'];
	$devarray['dev2'] = $accdata[0]['dev2'];
	$devarray['dev3'] = $accdata[0]['dev3'];
	$devarray['dev4'] = $accdata[0]['dev4'];
	$devarray['dev5'] = $accdata[0]['dev5'];
	$devarray['dev6'] = $accdata[0]['dev6'];
	$devarray['dev7'] = $accdata[0]['dev7'];
	$devarray['dev8'] = $accdata[0]['dev8'];
	$devarray['dev9'] = $accdata[0]['dev9'];
	$devarray['dev10'] = $accdata[0]['dev10'];
	$devarray['dev11'] = $accdata[0]['dev11'];
	$devarray['dev12'] = $accdata[0]['dev12'];
	
    $sort = $devarray;
   $sort2 = $devarray;
   foreach($sort as $key=>$val){
       $point[ $key ] = $val;
       $num = preg_replace("/dev/","",$key);
       $strlen[$key] = $num;
   }
   foreach($sort2 as $key=>$val){
       $point2[ $key ] = $val;
       $num2 = preg_replace("/dev/","",$key);
       $strlen2[$key] = $num2;

   }
   
   array_multisort($point, SORT_DESC,$strlen,SORT_ASC,$sort);
   
   array_multisort($point2,SORT_ASC,$strlen2,SORT_ASC,$sort2);
  
    $i=1;
    $start = array();
    $second = array();
    $last = array();
    
    foreach($sort as $key=>$val){
        if($i == 1){
            $start[ 'code'  ] = $key;
            $start[ 'point' ] = $val;
        }
        if($i == 2){
            $second[ 'code'  ] = $key;
            $second[ 'point' ] = $val;
        }
        $i++;
    }

    $last[ 'code'  ] = key($sort2);
    $last[ 'point' ] = reset($sort2);
    //var_dump($start,$second,$last);
    
    require_once("./mode/pdf/pdf32_comment.php");

    $title[1]  = $code[$start[ 'code' ]][ 'ch' ][ 'title' ];
    $strong[1] = $code[$start[ 'code' ]][ 'ch' ][ 'strong' ];
    $week[1]   = $code[$start[ 'code' ]][ 'ch' ][ 'week' ];
    $codes[1]  = $start[ 'code' ];

    
    $title[2]  = $code[$second[ 'code' ]][ 'ch' ][ 'title' ];
    $strong[2] = $code[$second[ 'code' ]][ 'ch' ][ 'strong' ];
    $week[2]   = $code[$second[ 'code' ]][ 'ch' ][ 'week' ];
    $codes[2]  = $second[ 'code' ];
    
    
    $title[3]  = $code[$last[ 'code' ]][ 'ch' ][ 'title' ];
    $strong[3] = $code[$last[ 'code' ]][ 'ch' ][ 'strong' ];
    $week[3]   = $code[$last[ 'code' ]][ 'ch' ][ 'week' ];
    $codes[3]  = $last[ 'code' ];

    
    $age = $acc->get_age($testdata[ 'birth' ],$testdata[ 'exam_dates' ]);

    $contents = file_get_contents(D_URL_HOME.'template/pdf/pdf32.html');
    $contents = preg_replace("/##YEAR##/",$reg[0],$contents);
    $contents = preg_replace("/##MONTH##/",$reg[1],$contents);
    $contents = preg_replace("/##DAY##/",$reg[2],$contents);
    $contents = preg_replace("/##NAME##/",$testdata[ 'name' ],$contents);
    $contents = preg_replace("/##AGE##/",$age,$contents);
    

    $contents = preg_replace("/##IMG1##/",$codes[1], $contents);
    $contents = preg_replace("/##MESSAGE1##/",$strong[1], $contents);
    
    $contents = preg_replace("/##IMG2##/",$codes[2], $contents);
    $contents = preg_replace("/##MESSAGE2##/",$strong[2], $contents);
    
    $contents = preg_replace("/##IMG3##/",$codes[3], $contents);
    $contents = preg_replace("/##MESSAGE3##/",$week[3], $contents);
    
    
    // 日本語化 ja+aCJK
    // フォーマット A4は縦、A4-Lは横
    // 左マージン 15、右マージン 15、上マージン 16、下マージン 16、ヘッダマージン 9、フッタマージン 9
    $mpdf = new mPDF('ja', 'A4', 0, '', 15, 15, 16, 16, 9, 9);
    $mpdf->ignore_invalid_utf8 = true;
    $mpdf->WriteHTML($contents);
    // PDF表示
    $date = date("Ymdhis");
    $mpdf->Output($date.'.pdf', 'D');
    exit();
}

//--------------------------------
//PDF修正版のダウンロード終わり
//---------------------------------






/*
$pdfsave = $dir."koudou1.pdf";
$pdf->Output($pdfsave, 'F');
exit();
*/
//-------------------------------------
//行動価値検査結果レポート（面接版適合なし/あり）の作成おわり
//-------------------------------------

include("./lib/pChart/pData.class");
include("./lib/pChart/pChart.class");


include("./lib/pChart/pData2.class.php");
include("./lib/pChart/pDraw.class.php");
include("./lib/pChart/pRadar.class.php");
include("./lib/pChart/pImage.class.php");

// Dataset definition 
$DataSet = new pData;
$plus = 0;

//------------------------------------------
//行動価値検査結果レポート（面接版適合なし）出力
//------------------------------------------
if(in_array("1",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf1.php");
	$plus++;
}
if(in_array("31",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
                  require_once("./mode/pdf/pdf31_comment.php");
	require_once("./mode/pdf/pdf31_1.php");
    
	$plus++;
}
 if(in_array("34",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
                    require_once("./mode/pdf/pdf34_comment.php");
	require_once("./mode/pdf/pdf34_1.php");
	$plus++;
}
 
//------------------------------------------
//行動価値検査結果レポート（面接版適合なし）出力終わり
//------------------------------------------
//--------------------------------
//PDF修正版のダウンロード
//---------------------------------

/*
if(
        in_array("31",$pdfline) || in_array("34",$pdfline)
        ){
        if(in_array("34",$pdfline)){
            require_once("./mode/pdf/pdf34.php");
        }else{
            require_once("./mode/pdf/pdf31.php");
        }
       
        require_once("./mode/pdf/pdf31_comment.php");

        if($plus){
                $pdf->AddPage();
        }
        

        // ページ読み込み
        //$contents = file_get_contents('http://abc.under.jp/samples.html');
       // $stylesheet = file_get_contents("sample.css");//CSSの読み込み
        $msg1 = "自己感情モニタリング力";
        $msg2 = "客観的自己評価力";
        $msg3 = "自己肯定力";
        $msg4 = "コントロール＆アチーブメント力";
        $msg5 = "ビジョン創出力";
        $msg6 = "ポジティブ思考力";
        $msg7 = "対人共感力";
        $msg8 = "状況察知力";
        $msg9 = "ホスピタリティ発揮力";
        $msg10 = "リーダーシップ発揮力";
        $msg11 = "アサーション発揮力";
        $msg12 = "集団適応力";
        //pdf用質問タイトル
	$a_questions = array(
		"dev1"=>$msg1
		,"dev2"=>$msg2
		,"dev3"=>$msg3
		,"dev4"=>$msg4
		,"dev5"=>$msg5
		,"dev6"=>$msg6
		,"dev7"=>$msg7
		,"dev8"=>$msg8
		,"dev9"=>$msg9
		,"dev10"=>$msg10
		,"dev11"=>$msg11
		,"dev12"=>$msg12
	);

        $devlist = array(
            "dev1" =>$testdata['type'][ 'dev1' ]
           ,"dev2" =>$testdata['type'][ 'dev2' ]
           ,"dev3" =>$testdata['type'][ 'dev3' ]
           ,"dev4" =>$testdata['type'][ 'dev4' ]
           ,"dev5" =>$testdata['type'][ 'dev5' ]
           ,"dev6" =>$testdata['type'][ 'dev6' ]
           ,"dev7" =>$testdata['type'][ 'dev7' ]
           ,"dev8" =>$testdata['type'][ 'dev8' ]
           ,"dev9" =>$testdata['type'][ 'dev9' ]
           ,"dev10"=>$testdata['type'][ 'dev10' ]
           ,"dev11"=>$testdata['type'][ 'dev11' ]
           ,"dev12"=>$testdata['type'][ 'dev12' ]
        );
        asort($devlist);
	//５０以下の配列の値の上位2つを取得
	$i=0;
	foreach($devlist as $key=>$val){
		$quesans[$key] = $val;
	}
	//上位2つを取得
	arsort($devlist);
	//重みつけがある時は
	//重みつけのデータを優先にする
	$i=0;
	foreach($quesans as $key=>$val){
		$k = preg_replace("/dev/","w",$key);
		if($testweight[0][$k] > 0 ){
			$ary_weight[$key] = 1;
		}else{
			$ary_weight[$key] = 0;
		}
		$i++;
	}
	array_multisort($ary_weight, SORT_DESC,$quesans);
	$i=0;
	foreach($quesans as $k=>$v){
		$quesanslist[$k] = $v;
		if($i == 1){
			break;
		}
		$i++;
	}
	unset($quesans);
	$quesans = $quesanslist;
        
        reset($quesans);
        $first = key($quesans);
        
        end($quesans);
        $last = key($quesans);
        
        $title =  $a_questions[$first];
        //面接時の質問例
        $str1  = $array_pdf_question[$first][1];
        //リスクとなる行動
        $str2   = $array_pdf_question[$first][0];
        //判定のポイント
        $str3 = $array_pdf_question[$first][2];
        
        $title2 =  $a_questions[$last];
        //面接時の質問例
        $str12  = $array_pdf_question[$last][1];
        //リスクとなる行動
        $str22   = $array_pdf_question[$last][0];
        //判定のポイント
        $str32 = $array_pdf_question[$last][2];
        
       // var_dump($str1);

        //var_dump($testdata);
        if(in_array("34",$pdfline)){
            $contents = file_get_contents(D_URL_HOME.'template/pdf/pdf34.html');
            if($testweight[0][ 'w1' ] != 0){
                $contents = preg_replace("/##CHK1##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK1##/","<img src='/images/pdf/pdf34/checkoff.png' width=20' />", $contents);
            }
            if($testweight[0][ 'w2' ] != 0){
                $contents = preg_replace("/##CHK2##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK2##/","<img src='/images/pdf/pdf34/checkoff.png' width=20' />", $contents);
            }
            if($testweight[0][ 'w3' ] != 0){
                $contents = preg_replace("/##CHK3##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK3##/","<img src='/images/pdf/pdf34/checkoff.png' width=20' />", $contents);
            }
   
            if($testweight[0][ 'w4' ] != 0){
                $contents = preg_replace("/##CHK4##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                
                $contents = preg_replace("/##CHK4##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
            if($testweight[0][ 'w5' ] != 0){
                $contents = preg_replace("/##CHK5##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK5##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
            if($testweight[0][ 'w6' ] != 0){
                $contents = preg_replace("/##CHK6##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK6##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
            if($testweight[0][ 'w7' ] != 0){
                $contents = preg_replace("/##CHK7##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK7##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
            if($testweight[0][ 'w8' ] != 0){
                $contents = preg_replace("/##CHK8##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK8##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
            if($testweight[0][ 'w9' ] != 0){
                $contents = preg_replace("/##CHK9##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK9##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
            if($testweight[0][ 'w10' ] != 0){
                $contents = preg_replace("/##CHK10##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK10##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
            if($testweight[0][ 'w11' ] != 0){
                $contents = preg_replace("/##CHK11##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK11##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
            if($testweight[0][ 'w12' ] != 0){
                $contents = preg_replace("/##CHK12##/","<img src='/images/pdf/pdf34/checkon.png' width=20 />", $contents);
            }else{
                $contents = preg_replace("/##CHK12##/","<img src='/images/pdf/pdf34/checkoff.png' width=20 />", $contents);
            }
        }else{
            $contents = file_get_contents(D_URL_HOME.'template/pdf/pdf31.html');
        }

        $devw = $testdata[ 'score' ];
	$levelStr = $testdata[ 'level' ];
        $contents = preg_replace("/##ID##/",$id, $contents);
        $contents = preg_replace("/##point1##/",$st_score, $contents);
        $contents = preg_replace("/##level1##/",$st_level, $contents);
        $contents = preg_replace("/##stpoint1##/",$devw, $contents);
        $contents = preg_replace("/##stlevel1##/",$levelStr, $contents);
        $contents = preg_replace("/##STRING1##/",$title, $contents);
        $contents = preg_replace("/##STRING2##/",$str1, $contents);
        $contents = preg_replace("/##STRING3##/",$str2, $contents);
        $contents = preg_replace("/##STRING4##/",$str3, $contents);
        
        $contents = preg_replace("/##STRING5##/",$title2, $contents);
        $contents = preg_replace("/##STRING6##/",$str12, $contents);
        $contents = preg_replace("/##STRING7##/",$str22, $contents);
        $contents = preg_replace("/##STRING8##/",$str32, $contents);
        $contents = preg_replace("/##NAMAE##/",$testdata[ 'name' ], $contents);
        $contents = preg_replace("/##TESTNAME##/",$testdata[ 'testname' ], $contents);
        $contents = preg_replace("/##EXAMID##/",$testdata[ 'exam_id' ], $contents);
        $exam_dates = substr(preg_replace("/\-/", "/", $testdata[ 'exam_dates' ]),0,10);
        $contents = preg_replace("/##examdate##/",$exam_dates, $contents);
        $age = (int) ((date('Ymd')-preg_replace("/\//", "", $testdata[ 'birth' ]))/10000);
        $contents = preg_replace("/##AGE##/",$age, $contents);
        $company = $testdata[ 'cusname' ];
        $contents = preg_replace("/##COMPANY##/",$company, $contents);
        
        $d1 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev1' ],1));
        $d2 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev2' ],1));
        $d3 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev3' ],1));
        $d4 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev4' ],1));
        $d5 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev5' ],1));
        $d6 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev6' ],1));
        $d7 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev7' ],1));
        $d8 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev8' ],1));
        $d9 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev9' ],1));
        $d10 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev10' ],1));
        $d11 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev11' ],1));
        $d12 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev12' ],1));
        
        $contents = preg_replace("/##dev1##/",$d1, $contents);
        $contents = preg_replace("/##dev2##/",$d2, $contents);
        $contents = preg_replace("/##dev3##/",$d3, $contents);
        $contents = preg_replace("/##dev4##/",$d4, $contents);
        $contents = preg_replace("/##dev5##/",$d5, $contents);
        $contents = preg_replace("/##dev6##/",$d6, $contents);
        $contents = preg_replace("/##dev7##/",$d7, $contents);
        $contents = preg_replace("/##dev8##/",$d8, $contents);
        $contents = preg_replace("/##dev9##/",$d9, $contents);
        $contents = preg_replace("/##dev10##/",$d10, $contents);
        $contents = preg_replace("/##dev11##/",$d11, $contents);
        $contents = preg_replace("/##dev12##/",$d12, $contents);
        
        
        // 日本語化 ja+aCJK
        // フォーマット A4は縦、A4-Lは横
        // 左マージン 15、右マージン 15、上マージン 16、下マージン 16、ヘッダマージン 9、フッタマージン 9
        $mpdf = new mPDF('ja', 'A4', 0, '', 15, 15, 8, 8, 3, 3);
        $mpdf->ignore_invalid_utf8 = true;
        $mpdf->WriteHTML($contents);

        // PDF表示
        $filename = $sec."_".$third."_".date('Y').date('m').date('d').".pdf";
        $mpdf->Output($filename,"D");

        exit();
}
*/



////------------------------------------------
//行動価値検査結果レポート（面接版適合あり）出力
//------------------------------------------
if(
        in_array("2",$pdfline)
        ){
	if($plus){
		$pdf->AddPage();
	}

	require_once("./mode/pdf/pdf2.php");
	$plus++;
}



if(in_array("28",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}

	require_once("./mode/pdf/pdf28.php");
	$plus++;
}

//------------------------------------------
//行動価値検査結果レポート（面接版適合あり）出力終わり
//------------------------------------------


//-------------------------------------
//行動価値検査結果レポート（ストレス版）作成
//-------------------------------------
if(in_array("3",$pdfline)){
	$types = array(1,2,12);
	$testdata['type'] = $obj->getTestPaper($where,$types);
	//ストレスレベルスコア取得
	if($testdata[ 'stress_flg' ] == 1){
		list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
	}else{
		list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
	}
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);
	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}
	require_once("./mode/pdf/pdf3_comment.php");

}

//-------------------------------------
//行動価値検査結果レポート（ストレス版）作成終わり
//-------------------------------------

//------------------------------------------
//行動価値検査結果レポート（ストレス版）
//------------------------------------------
if(in_array("3",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf3.php");
	$plus++;
}
//------------------------------------------
//行動価値検査結果レポート（ストレス版）終わり
//------------------------------------------

//-------------------------------------
//感情能力検査レポート作成
//-------------------------------------
if(
	in_array("4",$pdfline)
){
	$rs = $obj->getPdfDataRs($where);
	$sougo     = sprintf("%.1f",round($rs[0][ 'sougo'     ],1));
	$yomitori  = sprintf("%.1f",round($rs[0][ 'yomitori'  ],1));
	$rikai     = sprintf("%.1f",round($rs[0][ 'rikai'     ],1));
	$sentaku   = sprintf("%.1f",round($rs[0][ 'sentaku'   ],1));
	$kirikae   = sprintf("%.1f",round($rs[0][ 'kirikae'   ],1));
	//コメント配列読み込み
	require_once("./mode/pdf/pdf4_comment.php");
}
//-------------------------------------
//感情能力検査レポート作成作成
//-------------------------------------



//-------------------------------------
//感情能力検査レポート作成
//-------------------------------------
if(in_array("4",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf4.php");
	$plus++;
}
//-------------------------------------
//感情能力検査レポート作成作成
//-------------------------------------

//-------------------------------------
//感情能力検査レポート自己理解作成
//-------------------------------------

if(in_array("5",$pdfline)){
	$types = array(1,2,12,72);
	$testdata['type'] = $obj->getTestPaper($where,$types);
	$dev1  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev1'  ],1));
	$dev2  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev2'  ],1));
	$dev3  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev3'  ],1));
	$dev4  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev4'  ],1));
	$dev5  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev5'  ],1));
	$dev6  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev6'  ],1));
	$dev7  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev7'  ],1));
	$dev8  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev8'  ],1));
	$dev9  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev9'  ],1));
	$dev10 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev10' ],1));
	$dev11 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev11' ],1));
	$dev12 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev12' ],1));
	$number = $testdata[ 'type' ][ 'number' ];

	if($five){
		//マスタデータがあるときは値の再設定
		if(in_array("5",$pdfline)){
			//重みデータ取得
			$wtwhere = array();
			$wtwhere[ 'id' ] = $five;
			$wtm  = $objw->getWeightMaster($wtwhere);
		}
		$masterType = array();
		foreach($type as $k=>$v){
			$masterType[$v] = $v;
		}
		//BAJ1
		$wtwhere = array();
		$wtwhere[ 'cid'        ] = $id;
		$wtwhere[ 'pid'        ] = $ptid;
		$wtwhere[ 'exam_id'    ] = $third;
		$wtwhere[ 'testgrp_id' ] = $sec;
		if(in_array("1",$masterType)){
			include_once(D_PATH_HOME."/lib/keisan/functionBA.php");
			include_once(D_PATH_HOME."/init/rowData/raw_data_ta.php");
			include_once(D_PATH_HOME."/init/rowData/dev_data_ta.php");
			//回答データ取得
			$wpaper = $obj->getAnswerPaper($wtwhere,1);
			list($rowdata,$lv,$standard_score,$dev_number) = BA($wpaper,$wtm,$raw_data,$dev_data,1);
			//取得データの書き換え
			$testdata['type']['dev1'  ] = round($rowdata[ 'dev1'  ],4);
			$testdata['type']['dev2'  ] = round($rowdata[ 'dev2'  ],4);
			$testdata['type']['dev3'  ] = round($rowdata[ 'dev3'  ],4);
			$testdata['type']['dev4'  ] = round($rowdata[ 'dev4'  ],4);
			$testdata['type']['dev5'  ] = round($rowdata[ 'dev5'  ],4);
			$testdata['type']['dev6'  ] = round($rowdata[ 'dev6'  ],4);
			$testdata['type']['dev7'  ] = round($rowdata[ 'dev7'  ],4);
			$testdata['type']['dev8'  ] = round($rowdata[ 'dev8'  ],4);
			$testdata['type']['dev9'  ] = round($rowdata[ 'dev9'  ],4);
			$testdata['type']['dev10' ] = round($rowdata[ 'dev10' ],4);
			$testdata['type']['dev11' ] = round($rowdata[ 'dev11' ],4);
			$testdata['type']['dev12' ] = round($rowdata[ 'dev12' ],4);
			$testdata['type']['soyo'  ] =  $dev_number;
			$testdata['level' ] =  $lv;
			$testdata['score' ] =  $standard_score;
		}
		if(in_array("2",$masterType)){
			include_once(D_PATH_HOME."/lib/keisan/functionBA2.php");
			include_once(D_PATH_HOME."/init/rowData/raw_data_tb.php");
			include_once(D_PATH_HOME."/init/rowData/dev_data_tb.php");
			//回答データ取得
			$wpaper = $obj->getAnswerPaper($wtwhere,2);
			list($rowdata,$lv,$standard_score,$dev_number) = BA2($wpaper,$wtm,$raw_data,$dev_data,1);
			//取得データの書き換え
			$testdata['type']['dev1'  ] = round($rowdata[ 'dev1'  ],4);
			$testdata['type']['dev2'  ] = round($rowdata[ 'dev2'  ],4);
			$testdata['type']['dev3'  ] = round($rowdata[ 'dev3'  ],4);
			$testdata['type']['dev4'  ] = round($rowdata[ 'dev4'  ],4);
			$testdata['type']['dev5'  ] = round($rowdata[ 'dev5'  ],4);
			$testdata['type']['dev6'  ] = round($rowdata[ 'dev6'  ],4);
			$testdata['type']['dev7'  ] = round($rowdata[ 'dev7'  ],4);
			$testdata['type']['dev8'  ] = round($rowdata[ 'dev8'  ],4);
			$testdata['type']['dev9'  ] = round($rowdata[ 'dev9'  ],4);
			$testdata['type']['dev10' ] = round($rowdata[ 'dev10' ],4);
			$testdata['type']['dev11' ] = round($rowdata[ 'dev11' ],4);
			$testdata['type']['dev12' ] = round($rowdata[ 'dev12' ],4);
			$testdata['type']['soyo'  ] =  $dev_number;
			$testdata['level' ] =  $lv;
			$testdata['score' ] =  $standard_score;
		}
		if(in_array("12",$masterType) || in_array("72",$masterType)){
			include_once(D_PATH_HOME."/lib/keisan/functionBA12.php");
			include_once(D_PATH_HOME."/init/rowData/raw_data_ta3.php");
			include_once(D_PATH_HOME."/init/rowData/dev_data_ta3.php");
			//回答データ取得
			if( in_array("72",$masterType) ){
				$wpaper = $obj->getAnswerPaper($wtwhere,72);
			}else{
				$wpaper = $obj->getAnswerPaper($wtwhere,12);
			}
			list($rowdata,$lv,$standard_score,$dev_number) = BA12($wpaper,$wtm,$raw_data,$dev_data);
			//取得データの書き換え
			$testdata['type']['dev1'  ] = round($rowdata[ 'dev1'  ],4);
			$testdata['type']['dev2'  ] = round($rowdata[ 'dev2'  ],4);
			$testdata['type']['dev3'  ] = round($rowdata[ 'dev3'  ],4);
			$testdata['type']['dev4'  ] = round($rowdata[ 'dev4'  ],4);
			$testdata['type']['dev5'  ] = round($rowdata[ 'dev5'  ],4);
			$testdata['type']['dev6'  ] = round($rowdata[ 'dev6'  ],4);
			$testdata['type']['dev7'  ] = round($rowdata[ 'dev7'  ],4);
			$testdata['type']['dev8'  ] = round($rowdata[ 'dev8'  ],4);
			$testdata['type']['dev9'  ] = round($rowdata[ 'dev9'  ],4);
			$testdata['type']['dev10' ] = round($rowdata[ 'dev10' ],4);
			$testdata['type']['dev11' ] = round($rowdata[ 'dev11' ],4);
			$testdata['type']['dev12' ] = round($rowdata[ 'dev12' ],4);
			$testdata['type']['soyo'  ] =  $dev_number;
			$testdata['level' ] =  $lv;
			$testdata['score' ] =  $standard_score;

		}

	}

	//ストレスレベルスコア取得
	if($stsflg == 1){
		list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
	}else{
		list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
	}




	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);

	if($five){
		//マスタデータがあるときは重みの再設定
		$testweight = array();
		$testweight[0] = $wtm;
	}

	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}
//	$name = mb_convert_encoding($name,"utf-8","sjis");
	$ques = "3.".$name;
	$ques2 = "3.".$name;
	$ques = $ques.mb_convert_encoding(" さんへの質問例","sjis-win","UTF-8");
	$ques2 = $ques2.mb_convert_encoding(" さんの強み","sjis-win","UTF-8");
	require_once("./mode/pdf/pdf5_comment.php");

}

//-------------------------------------
//感情能力検査レポート作成作成
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート（自己理解版）
//-------------------------------------
if(in_array("5",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	$pdftype = 5;
	require_once("./mode/pdf/pdf5.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（自己理解版）終わり
//-------------------------------------


//-------------------------------------
//感情能力検査レポート自己理解作成
//-------------------------------------
if(in_array("29",$pdfline)){
	$types = array(1,2,12);
	$testdata['type'] = $obj->getTestPaper($where,$types);
	$dev1  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev1'  ],1));
	$dev2  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev2'  ],1));
	$dev3  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev3'  ],1));
	$dev4  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev4'  ],1));
	$dev5  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev5'  ],1));
	$dev6  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev6'  ],1));
	$dev7  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev7'  ],1));
	$dev8  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev8'  ],1));
	$dev9  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev9'  ],1));
	$dev10 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev10' ],1));
	$dev11 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev11' ],1));
	$dev12 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev12' ],1));
	$number = $testdata[ 'type' ][ 'number' ];
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);
	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}
	$ques = "3.".$name." さんへの質問例";
	$ques2 = "3.".$name." さんの強み";
	$ques = mb_convert_encoding($ques,"sjis-win","UTF-8");
	$ques2 = mb_convert_encoding($ques2,"sjis-win","UTF-8");
	require_once("./mode/pdf/pdf5_comment.php");

}
//-------------------------------------
//感情能力検査レポート作成作成
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート（自己理解版）
//-------------------------------------
if(in_array("29",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	$pdftype = 29;
	require_once("./mode/pdf/pdf29.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（自己理解版）終わり
//-------------------------------------
//-------------------------------------
//採用版：行動価値検査結果レポート（面接版適合あり）(PA版)
//-------------------------------------
if(in_array("30",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	//HR計算

	//データ配列
	$array_dev = array(
				1=>"12.3899988842875"
				,2=>"10.8091355795122"
				,3=>"-11.3400630508907"
				,4=>"-11.1409935987687"
				,5=>"-11.4670977166782"
				,6=>"-11.2616469638557"
				,7=>"-12.9346044211069"
				,8=>"-10.9954272066392"
				,9=>"-11.3643939778109"
				,10=>"-13.6341834932924"
				,11=>"-10.904631776716"
				,12=>"-11.1985541645689"
				,13=>"-0.15956446241323"
				,14=>"0.183189766780266"
				,15=>"-0.115175657922674"
				,16=>"4605.50309924376"
			);

	$aplus[] = $array_dev[1]*round($testdata[ 'type' ][ 'dev1' ],1);
	$aplus[] = $array_dev[2]*round($testdata[ 'type' ][ 'dev2' ],1);
	$aplus[] = $array_dev[3]*round($testdata[ 'type' ][ 'dev3' ],1);
	$aplus[] = $array_dev[4]*round($testdata[ 'type' ][ 'dev4' ],1);
	$aplus[] = $array_dev[5]*round($testdata[ 'type' ][ 'dev5' ],1);
	$aplus[] = $array_dev[6]*round($testdata[ 'type' ][ 'dev6' ],1);
	$aplus[] = $array_dev[7]*round($testdata[ 'type' ][ 'dev7' ],1);
	$aplus[] = $array_dev[8]*round($testdata[ 'type' ][ 'dev8' ],1);
	$aplus[] = $array_dev[9]*round($testdata[ 'type' ][ 'dev9' ],1);
	$aplus[] = $array_dev[10]*round($testdata[ 'type' ][ 'dev10' ],1);
	$aplus[] = $array_dev[11]*round($testdata[ 'type' ][ 'dev11' ],1);
	$aplus[] = $array_dev[12]*round($testdata[ 'type' ][ 'dev12' ],1);
	$aplus[] = $array_dev[13]*round($rs[ '0' ][ 'yomitori' ],1);
	$aplus[] = $array_dev[14]*round($rs[ '0' ][ 'sentaku'  ],1);
	$aplus[] = $array_dev[15]*round($rs[ '0' ][ 'jyoho'    ],1);
	
	$plus = (array_sum($aplus)+$array_dev[16])*-1;

	//自然対数
	$e = 2.7182;
	$pow = pow($e,$plus);
	
	$calc = round(((1/(1+$pow))*100),1);

	$pdftype = 30;
	require_once("./mode/pdf/pdf30.php");
	$plus++;
}
//-------------------------------------
//採用版：行動価値検査結果レポート（面接版適合あり）(PA版)
//-------------------------------------


if(in_array("26",$pdfline)
	){
	$types = array(1,2,12);
	$testdata['type'] = $obj->getTestPaper($where,$types);

	$dev1  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev1'  ],1));
	$dev2  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev2'  ],1));
	$dev3  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev3'  ],1));
	$dev4  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev4'  ],1));
	$dev5  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev5'  ],1));
	$dev6  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev6'  ],1));
	$dev7  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev7'  ],1));
	$dev8  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev8'  ],1));
	$dev9  = sprintf("%.1f",round($testdata[ 'type' ][ 'dev9'  ],1));
	$dev10 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev10' ],1));
	$dev11 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev11' ],1));
	$dev12 = sprintf("%.1f",round($testdata[ 'type' ][ 'dev12' ],1));
	$number = $testdata[ 'type' ][ 'number' ];
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);
	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}

	//var_dump($testdata);
	$ques = "3.○○さんへの質問例";
	$ques2 = "3.○○さんの強み";
	$ques = mb_convert_encoding($ques,"sjis-win","UTF-8");
	$ques2 = mb_convert_encoding($ques2,"sjis-win","UTF-8");
	require_once("./mode/pdf/pdf5_comment.php");

}
//-------------------------------------
//感情能力検査レポート作成作成
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート（自己理解版）
//-------------------------------------
if(in_array("26",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	$pdftype = 26;
	require_once("./mode/pdf/pdf26.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（自己理解版）終わり
//-------------------------------------




//-------------------------------------
//行動意識検査作成
//-------------------------------------
if(in_array("6",$pdfline)){
	if(in_array("37",$type)){
		$table[0] = "mv2_member";
		$table[1] = "mv2_score";
	}else{
		$table[0] = "mv_member";
		$table[1] = "mv_score";
		
	}
	$mvdata = $obj->getMovePdfData($where,$table);
	require_once("./mode/pdf/pdf6_comment.php");
}
//-------------------------------------
//行動意識検査作成終わり
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート（自己理解版）
//-------------------------------------
if(in_array("6",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf6.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（自己理解版）終わり
//-------------------------------------

//-------------------------------------
//VF検査(採用価値基準検査/表紙なし あり)
//-------------------------------------
if(
	in_array("7",$pdfline)
	|| in_array("8",$pdfline)
	|| in_array("27",$pdfline)
	){
	if(in_array("33",$type)){
		$table[0] = "vf2_member";
		$table[1] = "vf2_result";
		$table[2] = "vf2_weight";
	}else{
		$table[0] = "vf4_member";
		$table[1] = "vf4_result";
		$table[2] = "vf4_weight";
	}
	
	$vfdata = $obj->getVFPdfData($where,$table);
}
//-------------------------------------
//VF検査(採用価値基準検査/表紙なし あり)終わり
//-------------------------------------

//-------------------------------------
//VF検査(採用価値基準検査/表紙なし あり)
//-------------------------------------
if(
	in_array("7",$pdfline)
	|| in_array("8",$pdfline)
	){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf7_8.php");
	$plus++;
}
if(
	in_array("27",$pdfline)
	){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf27.php");
	$plus++;
}

//-------------------------------------
//VF検査(採用価値基準検査/表紙なし あり)終わり
//-------------------------------------


//-------------------------------------
//行動価値検査結果レポート（A3　自己理解版）
//-------------------------------------
if( in_array("9",$pdfline) ){
	$types = array(1,2,12);
	$testdata['type'] = $obj->getTestPaper($where,$types);
	//ストレスレベルスコア取得
	if($testdata[ 'stress_flg' ] == 1){
		list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
	}else{
		list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
	}
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);
	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}
	require_once("./mode/pdf/pdf9_comment.php");

}
//-------------------------------------
//行動価値検査結果レポート（A3　自己理解版）終わり
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート（A3　自己理解版）
//-------------------------------------
if( in_array("9",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf9.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（A3　自己理解版）終わり
//-------------------------------------


//-------------------------------------
//行動価値検査結果レポート(面接版適合なし/日本生命用)
//-------------------------------------
if( in_array("11",$pdfline) ){
	$types = array(1,2,12);
	$testdata['type'] = $obj->getTestPaper($where,$types);
	//ストレスレベルスコア取得
	if($testdata[ 'stress_flg' ] == 1){
		list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
	}else{
		list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
	}
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);
	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}

	$ques = "3.".$name." さんへの質問例";
	$ques2 = "3.".$name." さんの強み";

	require_once("./mode/pdf/pdf11_comment.php");

	
}
//-------------------------------------
//行動価値検査結果レポート(面接版適合なし/日本生命用)終わり
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート(面接版適合なし/日本生命用)
//-------------------------------------
if( in_array("11",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf11.php");
	$plus++;

}
//-------------------------------------
//行動価値検査結果レポート(面接版適合なし/日本生命用)終わり
//-------------------------------------



//-------------------------------------
//行動価値検査結果レポート（面接詳細版１）
//-------------------------------------
if( in_array("12",$pdfline) ){
	
	require_once("./mode/pdf/pdf12_comment.php");
	$types = array(1,2,12,72);
	$testdata['type'] = $obj->getTestPaper($where,$types);

	foreach($testdata['type'] as $key=>$val){
		if(preg_match("/^dev/",$key)){
			$devlist[ $key ] = $val;
		}
	}
	asort($devlist);
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);
	if($testdata[ 'weight' ] == 0 ){
		//weight=0の時重みあり
		//重みのあるものを優先にする
		$weight = $testweight[0];
		foreach($weight as $key=>$val){
			if($key != "weight"){
				$keys = preg_replace("/w/","dev",$key);
				if($val == 0){
					$wgt[ $keys ] = 0;
				}else{
					$wgt[ $keys ] = 1;
				}
			}
		}
		$i=1;
		foreach($devlist as $key=>$val){
				$dlists[$i]['key'  ]=$key;
				$dlists[$i]['value']=$val;
				$num = preg_replace("/^dev/","",$key);
				$dlists[$i]['num'  ]=$num;
				$dlists[$i][ 'w'   ]=$wgt[$key];
				$i++;
		}
		
		//wの降順で並び替えさらにvalueの昇順で並び替え
		foreach($dlists as $key=>$val){
			$key_w[ $key ]     = $val[ 'w' ];
			$key_value[ $key ] = $val[ 'value' ];
		}
		array_multisort($key_w,SORT_DESC,$key_value,SORT_ASC,$dlists);

		$i=1;

		foreach($dlists as $key=>$val){
			if($val[ 'value' ] <= 50 ){
				$dlist[$i]['key'  ]=$val[ 'key' ];
				$dlist[$i]['value']=$val[ 'value' ];
				$num = preg_replace("/^dev/","",$val['key']);
				$dlist[$i]['num'  ]=$num;
				$dlist[$i][ 'w'   ]=$val[ 'w' ];
				if($i>=2){
					break;
				}
				$i++;
			}
		}

	}else{
		$i=1;
		foreach($devlist as $key=>$val){
			if($val <= 50 ){
				$dlist[$i]['key'  ]=$key;
				$dlist[$i]['value']=$val;
				$num = preg_replace("/^dev/","",$key);
				$dlist[$i]['num'  ]=$num;

				if($i>=2){
					break;
				}
				$i++;
			}
		}
	}
}
//-------------------------------------
//行動価値検査結果レポート（面接詳細版１）終わり
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート（面接詳細版１）
//-------------------------------------
if( in_array("12",$pdfline) ){
	
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf12.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（面接詳細版１）終わり
//-------------------------------------


//-------------------------------------
//行動価値検査結果レポート（面接詳細版2）
//-------------------------------------
if( in_array("13",$pdfline) ){
	require_once("./mode/pdf/pdf13_comment.php");
	$types = array(1,2,12,72);
	$testdata['type'] = $obj->getTestPaper($where,$types);

	foreach($testdata['type'] as $key=>$val){
		if(preg_match("/^dev/",$key)){
			$devlist[ $key ] = $val;
		}
	}
}
//-------------------------------------
//行動価値検査結果レポート（面接詳細版2）終わり
//-------------------------------------

//-------------------------------------
//行動価値検査結果レポート（面接詳細版１）
//-------------------------------------
if( in_array("13",$pdfline) ){
	
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf13.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（面接詳細版１）終わり
//-------------------------------------

//-------------------------------------
//行動価値検査結果レポート（面接詳細版2）
//-------------------------------------
if( in_array("14",$pdfline) ){
	require_once("./mode/pdf/pdf14_comment.php");
	if(in_array("35",$type)){
		$mtable[0] = "math2_member";
		$mtable[1] = "math2_score";
		$mtable[2] = "math2_sec";
	}else{
		$mtable[0] = "math_member";
		$mtable[1] = "math_score";
		$mtable[2] = "math_sec";
	}
	$math = $obj->getMathDataList($where,$mtable);
}
//-------------------------------------
//行動価値検査結果レポート（面接詳細版2）終わり
//-------------------------------------
//-------------------------------------
//行動価値検査結果レポート（面接詳細版2）
//-------------------------------------
if( in_array("14",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf14.php");
	$plus++;
}
//-------------------------------------
//行動価値検査結果レポート（面接詳細版2）終わり
//-------------------------------------

//-------------------------------------
//コミュニケーション特性(NLPコーチング)
//-------------------------------------

if( in_array("15",$pdfline) ){
	require_once("./mode/pdf/pdf15_comment.php");
	$types = array(34,36,61);
	$testdata['type'] = $obj->getTestPaper($where,$types);
	//ストレスレベルスコア取得
	if($testdata[ 'stress_flg' ] == 1){
		list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
	}else{
		list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
	}
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight[0] = $obj->getWeight($where,$type);
	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}
	
	//var_dump($testdata);
	$ques = "3.".$name." さんへの質問例";
	$ques2 = "3.".$name." さんの強み";
	$score = $obj->getNL2PdfScore($where,$testdata['type'][ 'type']);

}

//-------------------------------------
//コミュニケーション特性(NLPコーチング)終わり
//-------------------------------------

//-------------------------------------
//コミュニケーション特性(NLPコーチング)
//-------------------------------------
if( in_array("15",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf15.php");
	$plus++;	
	
}


//-------------------------------------
//コミュニケーション特性(NLPコーチング)終わり
//-------------------------------------

if( in_array("16",$pdfline) ){
	require_once("./mode/pdf/pdf15_comment.php");
	$types = array(34,36,61);
	$testdata['type'] = $obj->getTestPaper($where,$types);
	//ストレスレベルスコア取得
	if($testdata[ 'stress_flg' ] == 1){
		list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
	}else{
		list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
	}
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$testweight = array();
	$testweight[0] = $obj->getWeight($where,$type);
	foreach($testweight as $key=>$val){
		$sum[$key] = array_sum($val);
		
	}
	foreach($sum as $key=>$val){
		if($val != 0){
			$testweightkey = $key;
		}
	}
	if($testweightkey && $testweight[$testweightkey]){
		$testweight[0] = $weight[$testweightkey];
	}
	
	//var_dump($testdata);
	$ques = "3.".$name." さんへの質問例";
	$ques2 = "3.".$name." さんの強み";
	$score = array();
	$score = $obj->getNL2PdfScore($where,$testdata['type'][ 'type']);
}

//-------------------------------------
//コミュニケーション特性(NLPコーチング)
//-------------------------------------
if( in_array("16",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf16.php");
	$plus++;	
	
}
//-------------------------------------
//コミュニケーション特性(NLPコーチング)終わり
//-------------------------------------




//-------------------------------------
//感情能力レポート
//-------------------------------------

if( in_array("17",$pdfline) ){
	require_once("./mode/pdf/pdf17_comment.php");
	$rs17 = $obj->getPdfDataRs($where);

}

//-------------------------------------
//感情能力レポート
//-------------------------------------
if( in_array("17",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf17.php");

	$plus++;	
	
}
//-------------------------------------
//感情能力レポート終わり
//-------------------------------------


//-------------------------------------
//コミュニケーション意識レポート
//-------------------------------------

if( in_array("18",$pdfline) ){
	if(in_array("37",$type)){
		$table[0] = "mv2_member";
		$table[1] = "mv2_score";
	}else{
		$table[0] = "mv_member";
		$table[1] = "mv_score";
		
	}
	$data18 = $obj->getMovePdfData($where,$table);

	require_once("./mode/pdf/pdf18_comment.php");

}

//-------------------------------------
//コミュニケーション意識レポート
//-------------------------------------
if( in_array("18",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf18.php");

	$plus++;	
	
}
//-------------------------------------
//感情能力レポート終わり
//-------------------------------------

//-------------------------------------
//METレポート
//-------------------------------------

if( in_array("19",$pdfline) ){
	require_once("./mode/pdf/pdf19_comment.php");
	$rs19 = $obj->getPdfDataMet($where);

}

//-------------------------------------
//METレポート
//-------------------------------------
if( in_array("19",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf19.php");
	$plus++;
}

//-------------------------------------
//MMSレポート
//-------------------------------------

if( in_array("21",$pdfline) ){
	require_once("./mode/pdf/pdf21_comment.php");
	$rs21 = $obj->getPdfDataMMS($where);
}

//-------------------------------------
//MMSレポート
//-------------------------------------
if( in_array("21",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf21.php");
	$plus++;
}



//-------------------------------------
//添削レポート
//-------------------------------------

if( in_array("20",$pdfline) ){
	require_once("./init/tensaku.php");
	$rs20 = $obj->getPdfDataCRTS($where);
}
//-------------------------------------
//添削レポート
//-------------------------------------
if( in_array("20",$pdfline) ){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf20.php");
	$plus++;
}


//-------------------------------------
//添削レポート
//-------------------------------------


//-------------------------------------
//
//-------------------------------------

if(in_array("22",$pdfline)){
	$rs = array();
	$rs = $obj->getPdfDataRs($where);

	$sougo     = sprintf("%.1f",round($rs[0][ 'sougo'     ],1));
	//コメント配列読み込み
	require_once("./mode/pdf/pdf22_comment.php");
	//IQデータ読み込み
	$iqdata = $obj->getIqScore($where);

	require_once("./mode/pdf/pdf17_comment.php");
	$rs17 = $obj->getPdfDataRs($where);
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf22.php");
	$plus++;
}


//-------------------------------------
//BMS検査結果レポート（面接版）
//-------------------------------------

if(in_array("23",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf23_comment.php");
	$mtable[0] = "math_member";
	$mtable[1] = "math_score";
	$mtable[2] = "math_sec";
	$math = $obj->getMathDataList($where,$mtable);
	require_once("./mode/pdf/pdf23.php");
	$plus++;
}


//-------------------------------------
//個人結果シート（パワハラ）
//-------------------------------------

if(in_array("24",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf24.php");
	$plus++;
}
//-------------------------------------
//ブランド診断
//-------------------------------------

if(in_array("25",$pdfline)){
	if($plus){
		$pdf->AddPage();
	}
	require_once("./mode/pdf/pdf25.php");
	$plus++;
}




$exam_id = $third;
$test_name = mb_convert_encoding($test_name,"SJIS","UTF-8");
//$filename = $test_name."_".$exam_id."_".date('Y').date('m').date('d').".pdf";
$filename = $sec."_".$exam_id."_".date('Y').date('m').date('d').".pdf";

$pdf->Output($filename, 'D');
exit();


# 破線
function dotted($x0, $y0, $x1, $y1,$d=""){
    global $pdf;

	if($d){
	    $w = 0.2; #線を引く長さ
	    $s = 0.9; #空白の長さ
		$pdf->SetLineWidth(0.3);
	}else{
	    $w = 0.2; #線を引く長さ
	    $s = 0.35; #空白の長さ
    	$pdf->SetLineWidth(0.0875);
	}
    # 縦
    if ($x0 == $x1){
        $y = $y0;
        while ($y < $y1){
            $y0 += $w;
            if ($y0 > $y1) { $y0 = $y1;}
            $pdf->Line($x0, $y, $x0, $y0);    
            $y += $w;
            
            $y0 += $s;
            $y += $s;
        }
    }
    
    # 横
    if ($y0 == $y1){
        $x = $x0;
        while ($x < $x1){
            $x0 += $w;
            if ($x0 > $x1) { $x0 = $x1;}
            $pdf->Line($x, $y0, $x0, $y0);    
            $x += $w;
            
            $x0 += $s;
            $x = $x0;
        }
    }
    
}
?>