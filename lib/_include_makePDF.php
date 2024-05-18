<?PHP
//----------------------------------
//PDF作成
//
//
//----------------------------------
class makePdf extends pdfMethod{
	function __construct($login) {
		$this->login = $login;
		
		
	}
	public function makePdfKozin($pdf,$testdata,$types,$a_gender){
		$exam_id   = $testdata[ 'exam_id' ];
		$test_name = $testdata[ 'testname' ];
		$test_name = mb_convert_encoding($testdata[ 'testname' ],"SJIS","UTF-8");
		$cus_name  = mb_convert_encoding($testdata[ 'cusname'  ],"sjis-win","utf-8");
		$exam_date  = substr(preg_replace("/-/","/",$testdata[ 'exam_dates'  ]),0,10);
		$name       = mb_convert_encoding($testdata[ 'name'       ],"sjis-win","utf-8");
		$kana       = mb_convert_encoding($testdata[ 'kana'       ],"sjis-win","utf-8");
		$sexs       = mb_convert_encoding($a_gender[$testdata[ 'sex'        ]],"sjis-win","utf-8");

		$rep_busyo  = mb_convert_encoding($testdata[ 'rep_busyo'  ],"sjis-win","utf-8");
		$age   = $this->calc_age($testdata[ 'birth' ],$exam_date);
		$pdfline = explode(":",$testdata[ 'pdfdownload' ]);
		
		$logo = "./img/pdflogo/pl_".$this->login.".jpg";
		//$logo = "./images/preview/pdflogo/".$this->login.".jpg";
		if(file_exists($logo)){
			$pdf->Image($logo, 10,5,50,18);
		}else{
			$pdf->Image("./images/welcome.jpg", 10,5,50,25);
		}
		//PDFタイトル作成
		if(
			$types == 1 || $types == 2
		){
			$pdf->SetXY(120,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'個人結果シート(面接版)');
		}else
		if($types == 3 ){
			$pdf->SetXY(141,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'個人結果レポート');
		}else
		if($types == 4 ){
			$pdf->SetXY(141,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'感情能力レポート');
		}else
		if($types == 5  || $types == 26 ){
			$pdf->SetXY(105,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'個人結果シート(自己理解版)');
		}else
		if($types == 6 ){
			$pdf->SetXY(135,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'行動意識レポート');
		}
		if($types == 7 || $types == 8 ){
			$pdf->SetXY(123,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'採用基準設定レポート');
		}
		if($types == 11 ){
			$pdf->SetXY(120,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'個人結果シート(面接版)');
		}
		if($types == 12 ){
			$pdf->SetXY(85,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'個人結果シート(面接質問のヒント)');
		}
		if($types == 13 ){
			$pdf->SetXY(95,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'個人結果シート(面接詳細版２)');
		}
		if($types == 14 ){
			$pdf->SetXY(90,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'BMS検査結果レポート(自己理解版)');
		}
		if($types == 15 || $types == 16){
			$pdf->SetXY(75,9);
			$pdf->SetFontSize(11);
			$pdf->Image("./images/r.gif", 146.5,20.0);
			$pdf->Write("25",'コミュニケーション特性(NLPコーチング　)検査　　個人結果報告書');
		}
		if($types == 16 || $types==26){
			$exam_date = "";
			$exam_id   = "";
			$name      = "";
			$kana      = "";
			$age       = "";
		}

		if($types == 17 ){
			$pdf->SetXY(110,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'感情能力レポート T');
		}
		if($types == 18 ){
			$pdf->SetXY(90,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'コミュニケーション意識レポート');
		}
		if($types == 19 ){
			$pdf->SetXY(105,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'個人結果シート（タイプ別）');
		}
		if($types == 21 ){
			$pdf->SetXY(105,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'  ');
			//企業データ取得
			$cus_name  = mb_convert_encoding($testdata[ 'mms' ][ 'company_name'  ],"sjis-win","utf-8");
		}

		if($types == 23 ){
			$pdf->SetXY(90,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'BMS検査結果レポート(面接版)');
		}
		if($types == 24 ){
			$pdf->SetXY(130,5);
			$pdf->SetFontSize(14);
			$pdf->Write("25",'パワハラ傾向振り返りシート');
		}
		if($types == 25 ){
			$pdf->SetXY(120,9);
			$pdf->SetFontSize(20);
			$pdf->Write("25",'ブランド感度力診断結果');
		}
		if($types == 27 ){
			$pdf->SetXY(115,9);
			$pdf->SetFontSize(14);
			$pdf->Write("25",'行動価値検査結果レポート(VF)');
		}
		if($types == 28 ){
			$pdf->SetXY(145,9);
			$pdf->SetFontSize(14);
			$pdf->Write("25",'レポート（面談用）');
		}

		if($types == 29 ){
			$pdf->SetXY(105,9);
			$pdf->SetFontSize(18);
			$pdf->Write("25",'行動価値検査結果レポート(BV)');
		}

		$pdf->SetXY(120,5);
		//----------------------------------------------------------
		//個人情報記入
		//----------------------------------------------------------
/*
		if($types == 17 || $types == 18){
			//感情能力レポート Tの時は表示方法が変わる
			$pdf->SetFontSize(8);
			$pdf->SetXY(25,40);
			$pdf->Write("5", "企業名：".$cus_name);
			$pdf->SetLineWidth(0.2);
			$pdf->SetDrawColor(0, 0, 0);
			$pdf->Line(35,45,100,45);
			
			$pdf->SetXY(105,40);
			$pdf->Write("5", "受検日：".$exam_date);
			$pdf->Line(115,45,180,45);

			$pdf->SetFontSize(8);
			$pdf->SetXY(25,47);
			$pdf->Write("5", "部署名：".$rep_busyo);
			$pdf->Line(35,52,100,52);
			
			$pdf->SetXY(105,47);
			$pdf->Write("5", "性別　：".$sexs);
			$pdf->Line(115,52,140,52);
			
			$pdf->SetXY(140,47);
			$pdf->Write("5", "年齢　：".$age);
			$pdf->Line(150,52,180,52);
			
			$pdf->SetFontSize(8);
			$pdf->SetXY(25,54);
			$pdf->Write("5", "名前　：".$name);
			$pdf->Line(35,59,100,59);
			
		}else{
*/
			$pdf->SetFontSize(12);
			$pdf->Ln();
			$pdf->Write("5", "企業名：".$cus_name);
			$pdf->Ln();
			//↓受検者個人情報↓
			$pdf->SetFontSize(8);

			$pdf->SetFillColor(204, 255, 204);
			$pdf->Cell(20, 5, "受検日", 1, 0, 'C', 1);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(20, 5, $exam_date, 1, 0, 'C', 1);

			$pdf->SetFillColor(204, 255, 204);
			$pdf->Cell(20, 5, "受検者ID", 1, 0, 'C', 1);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(30, 5, $exam_id, 1, 0, 'C', 1);

			$pdf->SetFillColor(204, 255, 204);
			$pdf->Cell(10, 5, "氏名", 1, 0, 'C', 1);
			$pdf->SetFillColor(255, 255, 255);
			if($types == 16 || $types == 26){
				$name = "";
			}else{
				$name = $name."(".$kana.")";
			}
			$pdf->Cell(62, 5, $name, 1, 0, 'C', 1);

			$pdf->SetFillColor(204, 255, 204);
			$pdf->Cell(10, 5, "年齢", 1, 0, 'C', 1);
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(12, 5, $age, 1, 1, 'C', 1);
//		}
		//----------------------------------------------------------
		//個人情報記入終わり
		//----------------------------------------------------------
		
		
	}
	
	
	public function makePdfKozinA3($pdf,$testdata,$types){
		
		$exam_id   = $testdata[ 'exam_id' ];
		$test_name = $testdata[ 'testname' ];
		$test_name = mb_convert_encoding($testdata[ 'testname' ],"SJIS","UTF-8");
		$cus_name  = mb_convert_encoding($testdata[ 'cusname'  ],"sjis-win","utf-8");
		$exam_date  = substr(preg_replace("/-/","/",$testdata[ 'exam_dates'  ]),0,10);
		$name  = mb_convert_encoding($testdata[ 'name'  ],"sjis-win","utf-8");
		$kana  = mb_convert_encoding($testdata[ 'kana'  ],"sjis-win","utf-8");
		$age   = $this->calc_age($testdata[ 'birth' ],$exam_date);
		$pdfline = explode(":",$testdata[ 'pdfdownload' ]);

		$logo = "./img/pdflogo/pl_".$this->login.".jpg";
		if(file_exists($logo)){
			$pdf->Image($logo,10,5,50,18);
		}else{
			$pdf->Image("./images/welcome.jpg",10,5,50,25);
		}

		
		$pdf->SetXY(85,8);
		$pdf->SetFontSize(20);
		$pdf->Write("25",'行動価値結果シート（自己理解用）');
		$pdf->SetXY(200,15);
		$pdf->SetFontSize(8);
		
		$pdf->SetFillColor(204, 255, 204);
		$pdf->Cell(20, 5, "受検日", 1, 0, 'C', 1);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(20, 5, $exam_date, 1, 0, 'C', 1);

		$pdf->SetFillColor(204, 255, 204);
		$pdf->Cell(20, 5, "受検者ID", 1, 0, 'C', 1);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(20, 5, $exam_id, 1, 0, 'C', 1);

		$pdf->SetFillColor(204, 255, 204);
		$pdf->Cell(10, 5, "氏名", 1, 0, 'C', 1);
		$pdf->SetFillColor(255, 255, 255);
		$name = $name."(".$kana.")";
		$pdf->Cell(62, 5, $name, 1, 0, 'C', 1);

		$pdf->SetFillColor(204, 255, 204);
		$pdf->Cell(10, 5, "年齢", 1, 0, 'C', 1);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->Cell(20, 5, $age, 1, 1, 'C', 1);
		$pdf->Ln(1);
		
	}
	
	public function setPdfLog($set){
		var_dump($set);
		
	}
}
?>
