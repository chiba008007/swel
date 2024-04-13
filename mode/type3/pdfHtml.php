<?PHP
require_once './lib/tcpdf/tcpdf.php';
$pdf = new TCPDF("P", "mm", "A4", true, "UTF-8" );
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();
$pdf->SetFont('kozgopromedium', '', 8); 

require_once("./lib/include_pdf.php");
$obj = new pdfMethod();

$where = array();
$where[ 'testgrp_id'  ] = $sec;
$where[ 'exam_id'     ] = $third;
$where[ 'partner_id'  ] = $ptid;
$where[ 'customer_id' ] = $id;
//受検データ取得
$testdata  = $obj->getTestData($where);
$testdata[ 'exam_id' ] = $third;
$test_name = $testdata[ 'testname' ];
$test_name = mb_convert_encoding($testdata[ 'testname' ],"SJIS","UTF-8");
$name = $testdata[ 'name' ];

//受検タイプ取得
$type     = $obj->getType($where);

//作成PDFの指定
$exam_id   = $testdata[ 'exam_id' ];
$cus_name  = $testdata[ 'cusname'  ];
$exam_date  = substr(preg_replace("/-/","/",$testdata[ 'exam_dates'  ]),0,10);
$kana  = $testdata[ 'kana'  ];
$age   = $obj->calc_age($testdata[ 'birth' ],$exam_date);
$pdfline = explode(":",$testdata[ 'pdfdownload' ]);
//-------------------------------------
//行動価値検査結果レポート（面接版適合なし）の作成
//-------------------------------------
if(in_array("1",$pdfline)){
	$testdata['type'] = $obj->getTestPaper($where,$type);
	//ストレスレベルスコア取得
	if($testdata[ 'stress_flg' ] == 1){
		list($st_level,$st_score) = $obj->getStress2($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ],$testdata['type'][ 'dev6' ]);
	}else{
		list($st_level,$st_score) = $obj->getStress($testdata['type'][ 'dev1' ],$testdata['type'][ 'dev2' ]);
	}
	//重みデータ取得
	//行動価値検査は１つなので、重みデータも１つ取得する
	$weight = $obj->getWeight($where,$type);
	//var_dump($testdata);
	$ques = "3.".$name." さんへの質問例";
	$ques2 = "3.".$name." さんの強み";


	$array_pdf_question = array(
				"dev1"=>array(
						"自分がやりたいことを考え\nていないか、もしくは、気づいていないため、仕事に\n意欲をもって取り組めない\n可能性があります　　　　　　　　　　　　　　　　　　　"
						,"「あなたは、何かしている際に、自分が\nネガティブ（イライラ、怒り、不安　等）な気持ちを持っていると気づいたこと\nはありますか？」 「その際、ネガティブな気持ちに対してどのように対応しましたか。具体的な例を聞かせてください。」"
						,"自分のネガティブな感情を解消するための具体的な\n行動を説明することができれば問題ありません。ただし、解消できないような行動を取っている場合や、行動そのものが説明できない場合、ネガティブな感情を感じたことがない場合には、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　　"
						),
				"dev2"=>array(
						"自分の能力を過信し、周囲\nの助言を受け入れようとし\nない、逆に、自分を過小評価してチャレンジしようとしない可能性があります　　　　　　　　　　　　　　　　　"
						,"「あなたが最近、他者からミスや失敗を\n指摘された経験はありますか？」 「具体的な例を聞かせてください。また、指摘された際、あなたはどのように感じ、その後、指摘されたことを日々の行動においてどのように活かしましたか。」　　　　"
						,"他人の指摘を素直に受け入れている事例があり、そ\nの後具体的な行動としての例を説明することができれば問題ありません。ただし、失敗を受け入れてい\nない、もしくは、指摘内容を直そうとしていない場合や、失敗を指摘されたことがない場合には、「リ\nスクとなる行動」が起こる可能性を否定できません。"
						),
				"dev3"=>array(
						"自分の能力・知識・経験に\n自信をもてないため、何事\nにも不安に感じ、自分を卑下するような行動を取る可能性があります　　　　　　　　　　　　　　　　　　　　　"
						,"「あなたが一番自信をもてることは何ですか？」 「それを実践した具体的な例を聞かせてください。それは、いつ、どのような場面の、どんな行動として発揮しましたか。」　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"自分の中で自信をもっていることがあり、しかもそ\nれが行動として発揮されている例があれば問題ありません。ただし、まったく自信をもっていることがない、あるいは、自信を持っていてもそれが実践さ\nれている行動が無かった場合には、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　"
						),
				"dev4"=>array(
						"不快な事態や不利な状況において、冷静さを欠いた行動を取る。もしくは、逃げてしまう可能性があります　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"「あなたは、最近、ネガティブ（イライラ、不満、怒り、不安　等）な気持ちを感じ、感情的な行動を取ってしまった出来事はありましたか？」 「その際、その出来事にどのように対応しましたか。具体的な例を聞かせてください。」　　　　　　"
						,"自分が感情的になった場合に、冷静な対応した具体的な行動を説明することができれば問題ありません。ただし、冷静とはいえない行動しか取れていない場合や、行動そのものが説明できない場合、感情的になるようなことがない場合には、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　　　"
						),
				"dev5"=>array(
						"自ら目標をもとうとせず、\n仕事を受身で行い前向きに\n取り組もうとしない可能性があります　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"「あなたは、これまでに何か新しいことに挑戦したことはありますか？」ある場合：「どんなことが新しいことだったのですか？」ない場合：「目標を持って物\n事に取り組んだ経験を話してください。」　　　　　　　　　　　　　　　　　　　　"
						,"新しいことに積極的に挑戦したことがあり、しかもそれが行動として発揮されている例があれば問題ありません。ただし、まったく新しい挑戦をしたことを話せない、あるいは、周囲から言われて行動したような場合には、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　　　　　　　　　　　"
						),
				"dev6"=>array(
						"環境の変化に適応できず、悲観的な見通ししか立たず、困難と感じたら、あきらめてしまう可能性があります　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"「学校（部活・サークル・バイト・仕事）を変わった際、あなたは自分の役割や立場をどのようにして把握しようとしましたか？」「それを実践した具体的な例を聞かせてください。」　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"新しい状況に応じた適切な対処をしたことがあり、しかもそれが行動として発揮されている例があれば問題ありません。ただし、新しい環境を経験したことをまったく話せない、あるいは、それが実践されている行動が無かった場合には、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　　　　"
						),
				"dev7"=>array(
						"相手の感情や立場を理解できず、自分の考えや意見を述べてしまい、周囲と衝突する可能性があります　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"「自分と他者の考え方がずれて衝突や対\n立をしたような経験はありますか？」ある場合：「その衝突や対立をどうやって解決しましたか？」ない場合：「他者を気遣い、うまく相手に合わせてあげた経験があれば、その内容を具体的にお話ください。」"
						,"ある場合、他者と衝突していても、相手の立場を尊\n重するような形で解決している事例があれば問題ありません。ない場合でも、他者に配慮した行動であれば問題ありません。ただし、衝突を解決した事例も、他者に配慮した事例も無い場合は、「リスクと\nなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　"
						),
				"dev8"=>array(
						"他者の状況や本当の気持ち\nが読み取れず、周囲から見\nるとずれた行動を取ってしまう可能性があります　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"「相手に話をしていて、相手の微妙な表\n情や会話から相手の気持ちの変化を感じ\nた経験はありますか？」「その相手からの反応の意味をどう考え、その後どのような行動を取りましたか？」　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"相手の反応に応じて適切な対処をしたことがあり、しかもそれが行動として発揮されている例があれば問題ありません。ただし、相手の気持ちの変化を感\nじたことがない、あるいは、感じたとしても行動できていない場合には、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　　　　　　　　"
						),
				"dev9"=>array(
						"他者を助ける姿勢に欠け、\n困っている人がいても気づかないふりをする可能性があります　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"「他者が困っている際、助けた経験はありますか？」「具体的な例を聞かせてください。それは、いつ、どのような場面でどのように行動しましたか。結果はどうなりましたか。」　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"他者が困っていることに対し、自分から積極的に関\nわっていく例があれば問題ありません。ただし、他者が困っている際に助けた経験がない、あるいは、\n周囲が困っていることを気づくことができない場合には、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						),
				"dev10"=>array(
						"自分の考えをもたず、他者\nの意見に流されやすく、集団を率いるような行動が期待できない可能性があります　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"「あなたは他者に対し、自分の意見を伝\nえたり、アドバイスを与えた経験はありますか？」「その相手からの反応やその後の行動に変化はありましたか？」　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"他者に対してアドバイスをしたり、自分の意見を伝\nえることで周囲に積極的に働きかけている事例が出\nてくれば問題ありません。ただし、相手に対して、\n自分の意見を伝えたり、アドバイスした事例も無い\n場合は、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　　　　　　　　　　　　"
						),
				"dev11"=>array(
						"自分の考えをきちんと相手\nに伝えることができず、不適切な意見に対して同調しやすく、反論できない可能性があります　　　　　　　　　　　　　　　　　　　　"
						,"「自分と他者の考え方がずれて衝突や対\n立をしたような経験はありますか？」ある場合：「その衝突や対立をどうやって解決しましたか？」ない場合：「他者を\n気遣い、うまく相手に合わせてあげた経\n験があれば、その内容を具体的にお話ください。」"
						,"「ある場合」に、他者と衝突・対立しても、相手の\n立場を尊重する形で解決している事例が出てくれば問題ありません。「ない場合」も、他者に配慮した行動をとっていることが確認できれば問題ありません。ただし、衝突を解決したり、他者に配慮した事\n例が無い場合は、「リスクとなる行動」が起こる可能性を否定できません。"
						),
				"dev12"=>array(
						"自ら周囲に働きかけること\nはなく、また、周囲と気軽に会話ができず、孤立する可能性があります　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"「人とのコミュニケーションで失敗してしまったことがありますか？」「具体的な例を聞かせてください。それは、いつ、どのような場面でどのように失敗しましたか。結果はどうなりましたか。」　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						,"自分から積極的に相手に関わっていこうとする姿勢\nが伺える事例が出てくれば問題ありません。また、\n人の話を聞こうとする姿勢が確認できれば問題ありません。ただし、相手に対し、拒否や防御的な態度が原因で失敗している場合は、「リスクとなる行動」が起こる可能性を否定できません。　　　　　　　　　　　　　　　　　"
						),
				"space"=>array("　　　　　　　　　　　　　　　　　　　　　　　　"
						,"　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　"
						),

			);
}
//-------------------------------------
//行動価値検査結果レポート（面接版適合なし）の作成おわり
//-------------------------------------

//------------------------------------------
//行動価値検査結果レポート（面接版適合なし）出力
//------------------------------------------

include("./lib/pChart/pData.class");
include("./lib/pChart/pChart.class");


include("./lib/pChart/pData2.class.php");
include("./lib/pChart/pDraw.class.php");
include("./lib/pChart/pRadar.class.php");
include("./lib/pChart/pImage.class.php");

// Dataset definition 
$DataSet = new pData;
if(in_array("1",$pdfline)){
	
	//----------------------------------------------
	//棒グラフ画像作成
	//----------------------------------------------
	$img1 = "./images/pdf/img".$id.".jpg";
	$st_score2 = substr($st_score, 1, 4) * 9.2;
	if($st_score >= 80){
		$wid = 552;
	}elseif($st_score >= 70){
		$wid = $st_score2 + 461.3;
	}elseif($st_score >= 60){
		$wid = $st_score2 + 370.8;
	}elseif($st_score >= 50){
		$wid = $st_score2 + 279.75;
	}elseif($st_score >= 40){
		$wid = $st_score2 + 188.8;
	}elseif($st_score >= 30){
		$wid = $st_score2 + 94.8;
	}elseif($st_score >= 20){
		$wid = $st_score2 + 1;
	}else{
		$wid = 1;
	}
	
	$im        = imagecreatetruecolor($wid, 10);
	$img_color = imagecolorallocate($im, 1, 101, 255);
	$gray      = imagecolorallocate($im, 169, 169, 169);

	imagefill($im , 0 , 0 , $gray);
	imagefilledrectangle($im, 1, 1, $wid-2, 8, $img_color);

	$text_color = imagecolorallocate($im, 255, 0, 0);
	imagestring($im, 1, 5, 5,  "", $text_color);
	imagejpeg($im, $img1);
	imagedestroy($im);
	//----------------------------------------------
	//棒グラフ画像作成終わり
	//----------------------------------------------
	//----------------------------------------------
	//チャートグラフ画像作成
	//----------------------------------------------

	$gimg1 = "./images/pdf/graf".$id.".png";
	$gimg2 = "./images/pdf/graf2".$id.".png";
	$dev1scr  = round($testdata['type'][ 'dev1'  ]/10,1)-2;
	$dev2scr  = round($testdata['type'][ 'dev2'  ]/10,1)-2;
	$dev3scr  = round($testdata['type'][ 'dev3'  ]/10,1)-2;
	$dev4scr  = round($testdata['type'][ 'dev4'  ]/10,1)-2;
	$dev5scr  = round($testdata['type'][ 'dev5'  ]/10,1)-2;
	$dev6scr  = round($testdata['type'][ 'dev6'  ]/10,1)-2;
	$dev7scr  = round($testdata['type'][ 'dev7'  ]/10,1)-2;
	$dev8scr  = round($testdata['type'][ 'dev8'  ]/10,1)-2;
	$dev9scr  = round($testdata['type'][ 'dev9'  ]/10,1)-2;
	$dev10scr = round($testdata['type'][ 'dev10' ]/10,1)-2;
	$dev11scr = round($testdata['type'][ 'dev11' ]/10,1)-2;
	$dev12scr = round($testdata['type'][ 'dev12' ]/10,1)-2;
	$kodo_array = array(
				$dev1scr,$dev2scr,$dev3scr
				,$dev4scr,$dev5scr,$dev6scr
				,$dev7scr,$dev8scr,$dev9scr
				,$dev10scr,$dev11scr,$dev12scr
				);

	$MyData = new pData2();
	$MyData->addPoints($kodo_array,"ScoreA");  
	$MyData->setSerieDescription("ScoreA","Application A");
	$MyData->setPalette("ScoreA",array("R"=>0,"G"=>0,"B"=>255));
	$myPicture = new pImage(360,360,$MyData);
	$myPicture->setFontProperties(array("FontName"=>"./init/Fonts/Forgotte.ttf","FontSize"=>0.1,"R"=>255,"G"=>255,"B"=>255));
	$SplitChart = new pRadar();
	$myPicture->setGraphArea(10,25,360,360);
	$Options = array("FixedMax"=>6,"AxisRotation"=>-90,"Layout"=>RADAR_LAYOUT_STAR);
	$SplitChart->drawRadar($myPicture,$MyData,$Options);
	$myPicture->render($gimg1);
	//----------------------------------------------
	//チャートグラフ画像作成終わり
	//----------------------------------------------
	//----------------------------------------------
	//質問用表示箇所データ取得
	//----------------------------------------------

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
	

	$i=0;
	foreach($devlist as $key=>$val){
		if($i >= 2){
			break;
		}
		$strongPoint[$key] = $val;
		$i++;
	}
	//----------------------------------------------
	//質問用表示箇所データ取得終わり
	//----------------------------------------------


	//--------------------------------
	//PDF出力
	//--------------------------------
	$css = '<style>
	  	table {
	  		text-align: left;
	  	}
		th {
			vertical-align: middle;
			background-color: rgb(144, 238, 144);
			text-align: center;
			width:40px;
		}
		th.wlv{
			text-align:left;
			border-left:none;
		}
		th.w80{
			width:80px;
		}
		td {
			vertical-align: middle;
			text-align: center;"
			width:80px;
		}
		td.w40 {
			width:40px;
		}
		td.w80 {
			width:80px;
		}
		td.w180 {
			width:180px;
		}
	   </style>';

	$pdf->Image("./images/welcome.jpg", 5, 5, 60, '', 'JPG');
	//企業名

	$html = '<div align="right" style="font-size:22pt;">個人結果シート(面接版)</div>'

	 . '<div>企業名： '.$cus_name.'</div>'
     . '<table  border="1" cellpadding="0" cellspacing="0"  >'
     . '<tbody>'
     . '<tr>'
     . '<th>受検日</th>'
     . '<td >'.$exam_date.'</td>'
     . '<th>受検者ID</th>'
     . '<td class="w80">'.$exam_id.'</td>'
     . '<th>氏名</th>'
     . '<td class="w180">'.$name.'('.$kana.')</td>'
     . '<th>年齢</th>'
	 . '<td class="w40">'.$age.'</td>'
     . '</tr>'
     . '</tbody></table><br />'
     ;

/*
	 . '<div>1.ストレス共生力</div>'
     . '<table  border="1" cellpadding="0" cellspacing="0"  >'
     . '<tbody>'
     . '<tr>'
     . '<th rowspan=2 style="width:62px;">&nbsp;</th>'
     . '<th rowspan=2 style="width:28px;">スコア</th>'
     . '<th rowspan=2 style="width:28px;">レベル</th>'
     . '<th style="width:108px;">1</th>'
     . '<th style="width:71px;">2</th>'
     . '<th style="width:65px;">3</th>'
     . '<th style="width:71px;">4</th>'
     . '<th style="width:110px;">5</th>'
     . '</tr>'
	 . '<tr>'
     . '<th>1</th>'
     . '<th>1</th>'
     . '<th>1</th>'
     . '<th>1</th>'
     . '<th>1</th>'
     . '</tr>'
     . '</tbody></table>'

     . '</div>'
*/
$aaa = "123";
$tbl = <<<EOD
<div>1.ストレス共生力
EOD;
$tbl .= $pdf->SetLeftMargin(100);
$tbl .= "<span style='margin-left:100px'>".$aaa."</span>";
$tbl .= <<<EOD
</div>
<table  border="1" cellpadding="0" cellspacing="0"  >
	<tr>
	<th rowspan="2" style="width:62px;">&nbsp;</th>
	<th rowspan="2" style="width:28px;" valign="middle">スコア</th>
	<th rowspan="2" style="width:28px;" valign="middle">レベル</th>
	<th style="width:108px;">1</th>
	<th style="width:71px;">2</th>
	<th style="width:65px;">3</th>
	<th style="width:71px;">4</th>
	<th style="width:110px;">5</th>
	</tr>
	<tr>
	<th  colspan="5" style="width:425px;text-align:left;">
	
	</th>
	</tr>
</table>
EOD;


	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	unlink($img1);
	unlink($gimg1);

	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------
}

$pdf->writeHTML($css.$html, true, false, true, false, '');
$pdf->writeHTML($css.$tbl, true, false, false, false, '');

//$pdf->writeHTML($css.$html, true, 0, true, 0);
$pdf->Output("test.pdf", "D");
exit();
?>