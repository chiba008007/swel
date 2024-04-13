<?PHP

	//データの取得
	$bsa = $obj->getBsa($where);
	$scores = array(
					array(
						"id"=>1
						,"values"=>$bsa[ 'score1'  ]
						,"text"=>"【ブランド戦略とブランド・マネージャーの役割】
ブランド戦略の位置づけや、内と外のブランディングを理解できていない恐れがあります。ブランド・マネージャーと\nして必要な経営者的視点をより意識すると良いでしょう。また、内側と外側に向けたブランディングがあることを意識\nすることも大切です。消費者・顧客へのエクスターナルブランディングだけでなく、一緒にブランドを作り上げる仲間\nたちへのインターナルブランディングに力を入れる事で、ブランドの浸透が容易になる場合があります。"
					),
					array(
						"id"=>2
						,"values"=>$bsa[ 'score2'  ]
						,"text"=>"【ブランドとは何か？】
ブランドの定義をしっかりと意識しましょう。またブランドが消費者・顧客の意思決定を大きく左右する事、ブランド\nプラス・マイナスの状態があることも認識し、プラスの状態を保つ取り組みを続けましょう。ブランドを資産と捉える\nことも大切な視点です。"
					),
					array(
						"id"=>3
						,"values"=>$bsa[ 'score3'  ]
						,"text"=>"【ブランドの歴史】
実際の実務において、歴史的背景は直接的に関係はないかもしれませんが、知っておくことで説得力が増すでしょう。\nまた、ブランドは作るだけではなく、守り育てていく必要があります。そのため、専門家任せにするだけでなく、法律\n的な知識も知っておく方が有利です。"
					),
					array(
						"id"=>4
						,"values"=>$bsa[ 'score4'  ]
						,"text"=>"【ブランドの種類】
ブランド・アンブレラを意識できていますか？ブランディングに取り組むうえで、ブランド・アンブレラをしっかりと\n意識できていないと、途中で矛盾が生じてしまいます。自身が取り組むべきブランドはどの位置にあるのか。常に意識\nする視点を持ちましょう。"
					),
					array(
						"id"=>5
						,"values"=>$bsa[ 'score5'  ]
						,"text"=>"【ブランド認知】
ブランド認知を２つに分解して考える事は、ブランド戦略を効果的に進めていくうえで欠かせません。ブランド再認と\nブランド再生の違いと、その関係性について、復習し理解を深めましょう。ただ知られれば良いだけではなく、消費者\n・顧客のニーズと結びついて認知されなくてはなりません。"
					),
					array(
						"id"=>6
						,"values"=>$bsa[ 'score6'  ]
						,"text"=>"【ブランド構築の概略】
ブランディングを行う上で重要な体系図は理解できていますか？ブランディングとは、ブランド・アイデンティティと\nブランド・イメージをイコールにする作業です。消費者・顧客の心の中で起こるブランド・イメージをどのように引き\n出すかが、ブランディングを行う上でとても重要なポイントです。"
					),
					array(
						"id"=>7
						,"values"=>$bsa[ 'score7'  ]
						,"text"=>"【ブランド要素とブランド体験】
消費者・顧客のブランド・イメージを形作るものが、ブランド要素とブランド体験です。しっかりと認識できていない\nと、ブランディングそのものが無駄になってしまいます。自身のブランドにどういったブランド要素とブランド体験が\n必要なのか。どのように設計していくのかの理解を深めましょう。また、日頃自身が消費者・顧客として触れているブ\nランドを観察することも重要な学びにつながります。"
					),
					array(
						"id"=>8
						,"values"=>$bsa[ 'score8'  ]
						,"text"=>"【ブランドの重要性】
ブランドがなぜ重要なのか。ただ漠然と思うだけでなく、項目に分けて理解しておきましょう。消費者・顧客にとって\nの利益と、企業にとっての利益はそれぞれ異なりますが、効果的にブランディングを行う事で、その多くを解決させる\nことができます。"
					),
					array(
						"id"=>9
						,"values"=>$bsa[ 'score9'  ]
						,"text"=>"【ブランド構築におけるマーケティング】
マーケティングとブランディングは一体で行う活動です。マーケティングの基本概念である「価値交換」をしっかりと\n意識することで、売込みではなく消費者・顧客に心から喜んでもらえる商品・サービスを作り出すことができるでしょ\nう。そうすることで、商品・サービスはひとりでに売れていく理想的な状態に近づきます。"
					),
					array(
						"id"=>10
						,"values"=>$bsa[ 'score10'  ]
						,"text"=>"【ブランド構築のステップ】
ブランド構築のステップは、もっとも効果的にブランディングを行うためのフレームワークです。ケースによって、必\nずしもこれがベストだというものではありませんが、しっかりと基本を理解しておくことで、守破離が成り立つのです\n。自己流になってしまわないよう、基本に立ち戻る姿勢も必要です。"
					)

				);

	foreach($scores as $key=>$value){
		$ids[$key]=$value["id"];
		$vals[$key]=$value["values"];
	}
	array_multisort($vals,SORT_ASC,$ids,SORT_ASC,$scores);
//var_dump($scores);
	//45未満のものが無い場合は、最も低いものだけを1つだし、2つ目は出さないようにしてください。
	$min = min($vals);
	$advice[1] = $scores[0];
	$advice[2] = $scores[1];
	if($min > 45 ){
		//45未満のものが無い場合
		$advice[1] = $scores[0];
		$advice[2] = "";
	}elseif($vals[0] < 45 && $vals[1] >= 45){

		//１つは45未満だが、それ以外は45以上の場合
		$advice[1] = $scores[0];
		$advice[2] = "";
	}

	//チャートグラフの作成
	$gimg1 = "./images/pdf/graf25-".$id.".png";
	$dev1scr  = round($bsa[ 'score1'  ]/10,1)-2;
	$dev2scr  = round($bsa[ 'score2'  ]/10,1)-2;
	$dev3scr  = round($bsa[ 'score3'  ]/10,1)-2;
	$dev4scr  = round($bsa[ 'score4'  ]/10,1)-2;
	$dev5scr  = round($bsa[ 'score5'  ]/10,1)-2;
	$dev6scr  = round($bsa[ 'score6'  ]/10,1)-2;
	$dev7scr  = round($bsa[ 'score7'  ]/10,1)-2;
	$dev8scr  = round($bsa[ 'score8'  ]/10,1)-2;
	$dev9scr  = round($bsa[ 'score9'  ]/10,1)-2;
	$dev10scr = round($bsa[ 'score10' ]/10,1)-2;
	$kodo_array = array(
				$dev1scr,$dev2scr,$dev3scr
				,$dev4scr,$dev5scr,$dev6scr
				,$dev7scr,$dev8scr,$dev9scr
				,$dev10scr
				);

	$MyData = new pData2();
	$MyData->addPoints($kodo_array,"ScoreA");  
	$MyData->setSerieDescription("ScoreA","Application A");
	$MyData->setPalette("ScoreA",array("R"=>0,"G"=>0,"B"=>255));
	$myPicture = new pImage(400,400,$MyData);
	$myPicture->setFontProperties(array("FontName"=>"./init/Fonts/Forgotte.ttf","FontSize"=>0.01,"R"=>255,"G"=>255,"B"=>255));
	$SplitChart = new pRadar();
	$myPicture->setGraphArea(10,25,400,400);
	$Options = array("FixedMax"=>6,"AxisRotation"=>-90,"Layout"=>RADAR_LAYOUT_STAR);
	$SplitChart->drawRadar($myPicture,$MyData,$Options);
	$myPicture->render($gimg1);
	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	$make->makePdfKozin($pdf,$testdata,25);
	//↓1.ストレス共生力↓
	$pdf->SetFontSize(10);
	$pdf->SetXY(10, 41);
	$pdf->Write("5","1.ブランド感度力とは");
	$pdf->SetXY(10, 46);
	$pdf->MultiCell(192,18, "", 1,"L");
	$str = "ブランド感度力とは、ブランドに関する知識を10の領域において測定しています。知識を持っていることで、ブランド\nに関する感度（アンテナ）が敏感になり、多く溢れている情報の取捨選択ができます。どこが得意でどこが苦手である\nかを把握し、今後の知識習得に活かしましょう。";
	$pdf->SetXY(11, 48.5);
	$pdf->MultiCell(190,4,$str, 0,"L");

	$pdf->SetXY(10, 67);
	$pdf->Write("5","2.結果グラフ");
	$pdf->SetXY(10, 73);
	$pdf->MultiCell(192,130, "", 1,"L");
	$pdf->Image($gimg1, 50, 79);
	$pdf->SetFontSize(12);
	$pdf->Text(98, 86, "80");
	$pdf->Text(98, 96, "70");
	$pdf->Text(98, 103, "60");
	$pdf->Text(98, 111, "50");
	$pdf->Text(98, 120, "40");
	$pdf->Text(98, 128, "30");
	$pdf->Text(98, 135, "20");
	$pdf->SetFontSize(9);
	$pdf->Text(75, 81, "ブランド戦略とブランド・マネージャーの役割");
	$pdf->Text(135, 94, "ブランドとは何か？");
	$pdf->Text(151, 120, "ブランドの歴史");
	$pdf->Text(151, 153, "ブランドの種類");
	$pdf->Text(135, 177, "ブランド認知");
	$pdf->Text(90, 189, "ブランド構築の概略");
	$pdf->Text(35, 177, "ブランド要素とブランド体験");
	$pdf->Text(32, 153, "ブランドの重要性");
	$pdf->Text(25, 120, "ブランド構築における");
	$pdf->Text(25, 124, "マーケティング");
	$pdf->Text(41, 94, "ブランド構築のステップ");

	$pdf->SetFontSize(10);
	$pdf->Text(10, 208, "3.".$name."さんへのアドバイス");
	$pdf->SetXY(10, 210);
	$pdf->MultiCell(192,30, "", 1,"L");
	$pdf->SetXY(11, 212);
	$pdf->MultiCell(192,4, $advice[1][ 'text' ], 0,"L");
	$pdf->SetXY(10, 245);
	$pdf->MultiCell(192,30, "", 1,"L");
	$pdf->SetXY(11, 247);
	$pdf->MultiCell(192,4, $advice[2][ 'text' ], 0,"L");

	$pdf->Ln(2);
	$pdf->SetXY(11, 280);
	$pdf->SetFontSize(7);
	$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');
	//--------------------------------
	//作成した画像の削除
	//--------------------------------
	unlink($img1);
	unlink($gimg1);

	//--------------------------------
	//作成した画像の削除終わり
	//--------------------------------

?>