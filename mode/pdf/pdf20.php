<?PHP
	//--------------------------------
	//PDF出力
	//--------------------------------
	//PDF個人情報入力
	$make->makePdfKozin($pdf,$testdata,19);
	$pdf->SetFillColor(65, 105, 225);
	$pdf->SetDrawColor(176,196,222);
	$pdf->SetXY(10, 42);
	$pdf->SetFontSize(14);
	$pdf->SetTextColor(255, 255, 255);
	$pdf->Cell(192, 6, $test_name, 'LTBR', 1, 'C', 1);
	$pdf->SetXY(10, 52);
	$i=1;
	$max = count($rs20);
	foreach($rs20 as $key=>$val){
		$pdf->SetFontSize(8.5);
		$pdf->SetFillColor(255, 255, 255);
		$pdf->SetTextColor(65, 105, 225);
		$pdf->SetDrawColor(176,196,222);
		$tensakuName = mb_convert_encoding($array_tensaku_question[ $val[ 'tensaku_main_id' ] ][ $val[ 'tensaku_id' ] ],"sjis","UTF-8");
		$pdf->Cell(192, 6, $tensakuName, 'LTBR', 1, 'C', 1);
		$pdf->Ln(2);
		$pdf->SetDrawColor(0,0,0);
		$pdf->SetTextColor(0,0,0);
		$str = smarty_modifier_unicode_wordwrap($val[ 'answer_text_4' ],60,"\n");
		$string = mb_convert_encoding($str,"SJIS","UTF-8");
		$answer_text_4 = "(完成版)\n";
		$answer_text_4 .= $string;
		$pdf->MultiCell(192, 5.5, $answer_text_4."\n\n\n" , 1);
		$pdf->Ln(2);


		$str = smarty_modifier_unicode_wordwrap($val[ 'answer_advice_text_4' ],60,"\n");
		$string = mb_convert_encoding($str,"SJIS","UTF-8");
		$answer_text_4 = "(アドバイス)\n";
		$answer_text_4 .= $string;
		$pdf->MultiCell(192, 5.5, $answer_text_4."\n\n\n" , 1);
		$pdf->Ln(2);

		$pdf->MultiCell(192, 4, "(メモ)\n\n\n\n\n\n\n\n\n" , 1);
		$pdf->Ln(10);

		$pdf->SetFontSize(7);
		$pdf->Cell(192, 1, 'powered by Innovation Gate ,Inc.', 0,1,'R');
		if($i < $max){
			$pdf->AddPage();
		}
		$i++;
		
	}

function smarty_modifier_unicode_wordwrap($str, $len=80, $break="\n", $indent='' ){
    $str = str_replace( "\r", $break, str_replace( "\r", "\n", str_replace("\r\n", "\n", $str) ) );
    $str = preg_replace('/(.{'.$len.'})/u', '${1}'.$break, $str);
    if (strcmp($indent,'')==0){ return $str; }
    else{
        $ar  = preg_split("/{$break}/",$str);
        for($i=0 ; $i<count($ar); $i++){
            $ar[$i] = $indent.$ar[$i];
        }
        return join($break, $ar);
    }
}

?>