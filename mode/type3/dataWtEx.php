<?php
set_time_limit(0);
/*
require_once './lib/PHPExcel.php';
require_once './lib/PHPExcel/IOFactory.php';
 * 
 */
require_once("./lib/Classes18/PHPExcel.php");
require_once("./lib/include_weights.php");
$obj = new weightsClass();

require_once("./lib/include_cusDown.php");
$cus = new cusDownMethod();


//テンプレートの読み込み
$objReader = PHPExcel_IOFactory::createReader("Excel5");
$xl = $objReader->load("./templateWtExcel/template1.xls");
//顧客情報
$where[ 'id' ] = $id; 
$custom = $cus->getTestNameData($where);

//テスト型
$where = array();
$where[ 'testid' ] = $sec;
$types = $cus->getTestTypes($where);

$ty = $types[0][ 'type' ];
//データの取得
//重みデータ
$weights2 = $obj->getWeight($sec);
//var_dump($weights);
//重みデータ取得
$ex = explode("-",$third);


$exk = array();
foreach($ex as $key=>$val){
    if($val){
        $exk[$val] = $val;
    }
}

$no=0;
foreach($weights2 as $key=>$val){
    if(!$exk[$val[ 'id' ]]){
        unset($weights[$key]);
    }else{
        $weights[$no] = $val;
         $no++;
    }
}

foreach($weights as $key=>$val){
    $idlist[] = $val[ 'id' ];
}
array_multisort($idlist, SORT_DESC, SORT_NUMERIC, $weights);

//重み数
$wCount = count($weights);
$mem = $obj->getMember($sec);

$where = array();
$where[ 'testgrp_id'  ] = $sec;
$where[ 'type'        ] = $ty;
$where[ 'customer_id' ] = $id;
$where[ 'partner_id'  ] = $ptid;

if($_REQUEST[ 'comp' ] == "complete")$where[ 'complete_flg' ] = 1;

if($ty == 12 || $ty == 72){
    include_once(D_PATH_HOME."/lib/keisan/functionBA12.php");
    include_once(D_PATH_HOME."/init/rowData/raw_data_ta3.php");
    include_once(D_PATH_HOME."/init/rowData/dev_data_ta3.php");
}else{
    include_once(D_PATH_HOME."/lib/keisan/functionBA.php");
    include_once(D_PATH_HOME."/init/rowData/raw_data_ta.php");
    include_once(D_PATH_HOME."/init/rowData/dev_data_ta.php");
}

$parts = "id,exam_date";


for($q=1;$q<=36;$q++){
        $parts .= ",q".$q;
}

if($ty == 72){
    $mv1 = $cus->getUserDataExcelPFS($where);
}else{
    $mv1 = $cus->getUserDataExcelBj($where,"*");
}

//var_dump($exk);
//var_dump($mv1);
foreach($mv1 as $key=>$val){
    foreach($exk as $key2=>$val2){
        //重みの登録
        //重みデータ取得
        $where = array();
        $where[ 'id' ] = $val2;
        $wtm = array();
        $wtm  = $cus->getWeightMaster($where);
        if($mv1[$key][ "exam_date" ]){
            if($ty == 12 || $ty == 72){
                
                list($rowdata,$lv,$standard_score,$dev_number) = BA12($val,$wtm,$raw_data,$dev_data);
            }else{
                list($rowdata,$lv,$standard_score,$dev_number) = BA($val,$wtm,$raw_data,$dev_data,1);
            }
            $scorelist[ $val[ 'id' ]][ $val2 ][ 'score' ] = round($standard_score,1);
            $scorelist[ $val[ 'id' ]][ $val2 ][ 'lv' ] = $lv;
        }
    }
}

//シートの設定
//$xl->setActiveSheetIndex(0);
//$sheet = $xl->getActiveSheet();

$alphabet = str_split('abcdefghijklmnopqrstuvwxyz');
$a_alpha = $alphabet;
foreach ($alphabet as $a1) {
  foreach ($alphabet as $a2) {
    $a_alpha[] = $a1 . $a2;  
  }
}

unset($a_alpha[0]);
foreach($a_alpha as $key=>$val){
    $alpha[] = $val;
}
//$alpha = range('b', 'z');
//array_push($alpha, "AA","AB","AC","AD","AE","AF","AG");

//セルの値を設定
$no = 6;


for($i=0;$i<count($mv1);$i++){
    //シート選択戻す
    $xl->setActiveSheetIndex(0);
    $alphaNum = 1;
    $sheet1 = $xl->getActiveSheet();
    
    $sheet1->setCellValue($alpha[$alphaNum-1].$no, $mv1[$i][ 'exam_id' ]);
    if($mv1[$i][ 'complete_flg' ] == 1){
        $sts = "受検済み";
    }else{
        $sts = "未受検";
    }
    $sheet1->setCellValue($alpha[$alphaNum++].$no,$sts );
    $sheet1->setCellValue($alpha[$alphaNum++].$no, $mv1[$i][ 'name' ]);
    $sheet1->setCellValue($alpha[$alphaNum++].$no, $mv1[$i][ 'kana' ]);
    $sheet1->setCellValue($alpha[$alphaNum++].$no, $mv1[$i][ 'birth' ]);
    if($mv1[$i]['birth']){
        $age = get_age($mv1[$i][ 'birth' ]);
    }else{
        $age = "";
    }
    $sheet1->setCellValue($alpha[$alphaNum++].$no, $age);
    $sheet1->setCellValue($alpha[$alphaNum++].$no, $mv1[$i][ 'exam_date' ]);
    $sheet1->setCellValue($alpha[$alphaNum++].$no, $mv1[$i][ 'pass' ]);
    $sheet1->setCellValue($alpha[$alphaNum++].$no, $mv1[$i][ 'memo1' ]);
    $sheet1->setCellValue($alpha[$alphaNum++].$no, $mv1[$i][ 'memo2' ]);
    
    $alphaNum2 = $alphaNum;
    foreach($exk as $key=>$val){
          $sheet1->setCellValue($alpha[$alphaNum2++].$no, $scorelist[$mv1[$i][ "id" ]][ $val ][ 'score' ]);  
    }
    
    if(( $mv1[$i][ 'dev1' ] && $mv1[$i][ 'dev2' ] )){
        list($st_level, $st_score) = $db->getStress($mv1[$i][ 'dev1' ], $mv1[$i][ 'dev2' ]);
        //list($st_level, $st_score) = $db->getStress2($mv1[$i][ 'dev1' ], $mv1[$i][ 'dev2' ],$val[$i][ 'dev6' ]);
    }else{
        $st_level = "";
        $st_score = "";
        
    }
   
   $st_score = sprintf("%.1f",$st_score);
   if($st_score < 0.1) $st_score = "";
    $sheet1->setCellValue($alpha[$alphaNum2++].$no, $st_level);
    $sheet1->setCellValue($alpha[$alphaNum2++].$no, $st_score." ");
    if($mv1[$i]['dev1']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev1' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev2']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev2' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev3']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev3' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev4']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev4' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev5']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev5' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev6']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev6' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev7']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev7' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev8']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev8' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev9']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev9' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev10']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev10' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev11']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev11' ],1));}else{$alphaNum2++;}
    if($mv1[$i]['dev12']){$sheet1->setCellValue($alpha[$alphaNum2++].$no, round($mv1[$i][ 'dev12' ],1));}else{$alphaNum2++;}
    
    
    
    // セルを結合する
    if($i == 0){
        //適合スコア 1回だけ通る
        $st = $alpha[$alphaNum];
        $ed = $alpha[$alphaNum+$wCount-1];
        $sheet1->mergeCells($st.'3:'.$ed.'4');
        for($j=0;$j<count($weights);$j++){
            $st = $alpha[$alphaNum+$j];
            $sheet1->setCellValue( $st.'5', $weights[$j][ 'master_name' ]);
        }
        
        $alphaNum = $alphaNum+$wCount;
        
        //ストレス共生
        $st3 = $alpha[$alphaNum];
        $ed3 = $alpha[$alphaNum+1];
        $sheet1->mergeCells($st3.'4:'.$ed3.'4');
        $sheet1->setCellValue( $st3.'4', "ストレス共生");
        
        //レベル
        $sheet1->setCellValue( $st3.'5', "レベル");
        $sheet1->setCellValue( $ed3.'5', "スコア");
        
        /*
        //適合レベル
        $st4 = $alpha[$alphaNum+2];
        $sheet1->mergeCells($st4.'4:'.$st4.'5');
        $sheet1->setCellValue( $st4.'4', "適合レベル");
        
        //適合スコア
        $st5 = $alpha[$alphaNum+3];
        $sheet1->mergeCells($st5.'4:'.$st5.'5');
        $sheet1->setCellValue( $st5.'4', "適合スコア");
        */
        $st6 = $alpha[$alphaNum+2];
        $md6 = $alpha[$alphaNum+3];
        $ed6 = $alpha[$alphaNum+4];
        $sheet1->mergeCells($st6.'4:'.$ed6.'4');
        $sheet1->setCellValue( $st6.'4', "自分を適切に認識できているか");
        
        $sheet1->getStyle($st6.'5')->getAlignment()->setShrinkToFit(true);
        $sheet1->setCellValue( $st6.'5', "自己感情モニタリング力\r\n自分の感情を認識できるか");
        $sheet1->getColumnDimension( $st6 )->setWidth( 30 );
        $sheet1->setCellValue( $md6.'5', "客観的自己評価力\r\n自分を客観的に評価できるか");
        $sheet1->getColumnDimension( $md6 )->setWidth( 30 );
        $sheet1->setCellValue( $ed6.'5', "自己肯定力\r\n自分を価値ある存在として評価できるか");
        $sheet1->getColumnDimension( $ed6 )->setWidth( 30 );
        
        $st7 = $alpha[$alphaNum+5];
        $md7 = $alpha[$alphaNum+6];
        $ed7 = $alpha[$alphaNum+7];
        $sheet1->mergeCells($st7.'4:'.$ed7.'4');
        $sheet1->setCellValue( $st7.'4', "自分の感情をコントロールしているか");
        $sheet1->setCellValue( $st7.'5', "コントロール＆\nアチーブメント力\n自己をコントロールし、目標を達成できるか");
        $sheet1->setCellValue( $md7.'5', "ビジョン創出力\n達成するべき目標を設定することができるか");
        $sheet1->setCellValue( $ed7.'5', "ポジティブ思考力\n周囲の状況を柔軟に捉え、適応できるか");
        $sheet1->getColumnDimension( $st7 )->setWidth( 30 );
        $sheet1->getColumnDimension( $md7 )->setWidth( 30 );
        $sheet1->getColumnDimension( $ed7 )->setWidth( 30 );
        
        
        $st8 = $alpha[$alphaNum+8];
        $md8 = $alpha[$alphaNum+9];
        $ed8 = $alpha[$alphaNum+10];
        $sheet1->mergeCells($st8.'4:'.$ed8.'4');
        $sheet1->setCellValue( $st8.'4', "相手の状況を適切に認識できているか");
        $sheet1->setCellValue( $st8.'5', "対人共感力\n相手に共感できるか");
        $sheet1->setCellValue( $md8.'5', "状況察知力\n職場の雰囲気を読み取ることができるか");
        $sheet1->setCellValue( $ed8.'5', "ホスピタリティ発揮力\n相手のして欲しいことを積極的にできるか");
        $sheet1->getColumnDimension( $st8 )->setWidth( 30 );
        $sheet1->getColumnDimension( $md8 )->setWidth( 30 );
        $sheet1->getColumnDimension( $ed8 )->setWidth( 30 );
        
        
        $st9 = $alpha[$alphaNum+11];
        $md9 = $alpha[$alphaNum+12];
        $ed9 = $alpha[$alphaNum+13];
        $sheet1->mergeCells($st9.'4:'.$ed9.'4');
        $sheet1->setCellValue( $st9.'4', "相手に適切に働きかけているか");
        $sheet1->setCellValue( $st9.'5', "リーダーシップ発揮力\n集団を目標達成するために積極的に行動できるか");
        $sheet1->setCellValue( $md9.'5', "アサーション発揮力\n相手のことを考慮しながら自分の考えを主張できるか");
        $sheet1->setCellValue( $ed9.'5', "集団適応力\n人に興味があり、仲間との良好な関係を保つことができるか");
        $sheet1->getColumnDimension( $st9 )->setWidth( 30 );
        $sheet1->getColumnDimension( $md9 )->setWidth( 30 );
        $sheet1->getColumnDimension( $ed9 )->setWidth( 30 );
        
        
        //適合スコア
        //var_dump($alphaNum);
        $st2 = $alpha[$alphaNum];
        $ed2 = $alpha[$alphaNum+13];
        $sheet1->mergeCells($st2.'3:'.$ed2.'3');
               
                
        //exit();
    }
    
    $alphaNum = 1;
    //コピーのため
    //シート選択
    $xl->setActiveSheetIndex(1);
    $sheet2 = $xl->getActiveSheet();
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum-1].'6'), 'B'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'C'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'D'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'E'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'F'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'G'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'H'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'I'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'J'.$no);
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum++].'6'), 'K'.$no);
    
   $alphaNum3 = $alphaNum;
    foreach($exk as $ekey=>$eval){
        $al = $alpha[$alphaNum3].$no;
        if( 35 > $scorelist[$mv1[$i][ "id" ]][ $eval ][ 'score' ] &&  $scorelist[$mv1[$i][ "id" ]][ $eval ][ 'score' ] ){
            $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum3].'7'), $al);
        }elseif( 45 > $scorelist[$mv1[$i][ "id" ]][ $eval ][ 'score' ] &&  $scorelist[$mv1[$i][ "id" ]][ $eval ][ 'score' ] ){
            $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum3].'8'), $al);
        }else{
            $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum3].'6'), $al);
        }
        $alphaNum3++;
    }

    $alphaNum4 = $alphaNum3;
    
    $al = $alpha[$alphaNum4].$no;
    if($st_level == 1 && $st_level ){$color=7;
    }elseif($st_level == 2 && $st_level ){$color = 8;
    }else{$color=6;}
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum4].$color), $al);
    $alphaNum4++;
     
    $alphaNum4a = $alphaNum4;
    $al = $alpha[$alphaNum4a].$no;
    if($st_score < 35 && $st_score ){$color=7;
    }elseif($st_score < 45 && $st_score ){$color = 8;
    }else{$color=6;}
    $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum4a].$color), $al);
    $alphaNum4a++;
    
    
    $where = [];
    $where[ 'test_id' ] = $sec;
    $where[ 'partner_id' ] = $ptid;
    $where[ 'customer_id' ] = $id;
    $wdata = $cus->getUserDataParts($where);
    
    $alphaNum5 = $alphaNum4a;
    for($k=1;$k<13;$k++){
        $al = $alpha[$alphaNum5].$no;
        $dev = "dev".$k;
        
        if($k == 12 || $k == 72){
            //最後のみ
            if($mv1[$i][$dev] < 35 && $mv1[$i][$dev]){
                $sheet1->duplicateStyle($sheet2->getStyle('z10'), $al);
            }elseif($mv1[$i][$dev] < 45  && $mv1[$i][$dev] ){
                $sheet1->duplicateStyle($sheet2->getStyle('z11'), $al);
            }else{
                $sheet1->duplicateStyle($sheet2->getStyle('z9'), $al);
            }
        }else{
            if($mv1[$i][$dev] < 35 && $mv1[$i][$dev]){
                $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum5].'7'), $al);
            }elseif($mv1[$i][$dev] < 45  && $mv1[$i][$dev] ){
                $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum5].'8'), $al);
            }else{
                $sheet1->duplicateStyle($sheet2->getStyle($alpha[$alphaNum5].'6'), $al);
            }
        }
       $alphaNum5++;
    }
    

    
    if($i == 0){
        $a1 = $sheet2->getCell('L3')->getValue();
        $sheet1->setCellValue('L3', $a1);
        for($j=0;$j<count($weights);$j++){
            $sheet1->duplicateStyle($sheet2->getStyle('L5'), $alpha[$alphaNum+$j].'5');
        }
        
        for($j=0;$j<$wCount;$j++){
            $sheet1->duplicateStyle($sheet2->getStyle('L3'), $alpha[$alphaNum].'3'); //適合スコア
            $sheet1->duplicateStyle($sheet2->getStyle('L4'), $alpha[$alphaNum].'4'); //適合スコア
            $alphaNum++;
        }
        //ストレス共生
        $sheet1->duplicateStyle($sheet2->getStyle('M4'), $alpha[$alphaNum].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('N4'), $alpha[$alphaNum+1].'4');
        //レベル
        $sheet1->duplicateStyle($sheet2->getStyle('M5'), $alpha[$alphaNum].'5');
        //スコア
        $sheet1->duplicateStyle($sheet2->getStyle('N5'), $alpha[$alphaNum+1].'5');
        
        
        //自分を適切に認識できているか
        $sheet1->duplicateStyle($sheet2->getStyle('Q4'), $alpha[$alphaNum+2].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('R4'), $alpha[$alphaNum+3].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('Q4'), $alpha[$alphaNum+4].'4');
        
        if($wdata[0][ 'w1' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+2].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('Q5'), $alpha[$alphaNum+2].'5');}
        if($wdata[0][ 'w2' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+3].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('R5'), $alpha[$alphaNum+3].'5');}
        if($wdata[0][ 'w3' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+4].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('S5'), $alpha[$alphaNum+4].'5');}
            
        
        //自分の感情をコントロールしているか
        $sheet1->duplicateStyle($sheet2->getStyle('T4'), $alpha[$alphaNum+5].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('U4'), $alpha[$alphaNum+6].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('V4'), $alpha[$alphaNum+7].'4');


        if($wdata[0][ 'w4' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+5].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('T5'), $alpha[$alphaNum+5].'5');}
        if($wdata[0][ 'w5' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+6].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('U5'), $alpha[$alphaNum+6].'5');}
        if($wdata[0][ 'w6' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+7].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('V5'), $alpha[$alphaNum+7].'5');}

        
        
        //相手の状況を適切に認識できているか
        $sheet1->duplicateStyle($sheet2->getStyle('W4'), $alpha[$alphaNum+8].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('X4'), $alpha[$alphaNum+9].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('W4'), $alpha[$alphaNum+10].'4');
        
        if($wdata[0][ 'w7' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+8].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('W5'), $alpha[$alphaNum+8].'5');}
        if($wdata[0][ 'w8' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+9].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('X5'), $alpha[$alphaNum+9].'5');}
        if($wdata[0][ 'w9' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+10].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('Y5'), $alpha[$alphaNum+10].'5');}
        
         //相手に適切に働きかけているか
        $sheet1->duplicateStyle($sheet2->getStyle('X4'),  $alpha[$alphaNum+11].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('Y4'), $alpha[$alphaNum+12].'4');
        $sheet1->duplicateStyle($sheet2->getStyle('Z4'), $alpha[$alphaNum+13].'4');

        if($wdata[0][ 'w10' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+11].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('X5'), $alpha[$alphaNum+11].'5');}
        if($wdata[0][ 'w11' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('O12'), $alpha[$alphaNum+12].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('Y5'), $alpha[$alphaNum+12].'5');}
        if($wdata[0][ 'w12' ] != 0){$sheet1->duplicateStyle($sheet2->getStyle('P12'), $alpha[$alphaNum+13].'5');
        }else{ $sheet1->duplicateStyle($sheet2->getStyle('Z5'), $alpha[$alphaNum+13].'5');}
        
        for($j=0;$j<14;$j++){
            $key = $alpha[$alphaNum];
            if($j == 13){
                //最後のみコピー元を変更する
                $sheet1->duplicateStyle($sheet2->getStyle('Z3'), $key.'3');
            }else{
                $sheet1->duplicateStyle($sheet2->getStyle('M3'), $key.'3');
            }
            $alphaNum++;
        }
    }//タイトル部分終わり
   
    
   $no++;

}


if($ty == 72){

    if($_REQUEST[ 'comp' ] == "complete") $no = 16;
    //$no++;
    $no = $no+$wCount-1;

    $sheet1->setCellValue( $a_alpha[$no+10].'3', "PFS結果");
    $sheet1->mergeCells($a_alpha[$no+10].'3:'.$a_alpha[$no+10+6].'3');

    $num=$no;
    $sheet1->duplicateStyle($sheet2->getStyle('M3'), $a_alpha[$num+10].'3');
    $sheet1->duplicateStyle($sheet2->getStyle('M3'), $a_alpha[$num+1+10].'3');
    $sheet1->duplicateStyle($sheet2->getStyle('M3'), $a_alpha[$num+2+10].'3');
    $sheet1->duplicateStyle($sheet2->getStyle('M3'), $a_alpha[$num+3+10].'3');
    $sheet1->duplicateStyle($sheet2->getStyle('M3'), $a_alpha[$num+4+10].'3');
    $sheet1->duplicateStyle($sheet2->getStyle('M3'), $a_alpha[$num+5+10].'3');
    $sheet1->duplicateStyle($sheet2->getStyle('Z3'), $a_alpha[$num+6+10].'3');

    


    $sheet1->setCellValue( $a_alpha[$no+10].'4', "総合");
    $sheet1->mergeCells($a_alpha[$no+10].'4:'.$a_alpha[$no+10].'5');
     $sheet1->duplicateStyle($sheet2->getStyle('L5'), $a_alpha[$no+10].'4');
     $sheet1->duplicateStyle($sheet2->getStyle('L5'), $a_alpha[$no+10].'5');

    $sheet1->setCellValue( $a_alpha[$no+11].'4', "モニタリング領域");
    $sheet1->mergeCells($a_alpha[$no+11].'4:'.$a_alpha[$no+13].'4');
    $sheet1->duplicateStyle($sheet2->getStyle('M4'), $a_alpha[$no+11].'4');
    $sheet1->duplicateStyle($sheet2->getStyle('M4'), $a_alpha[$no+12].'4');
    $sheet1->duplicateStyle($sheet2->getStyle('N4'), $a_alpha[$no+13].'4');

    $sheet1->setCellValue( $a_alpha[$no+14].'4', "セルフマネジメント領域");
    $sheet1->mergeCells($a_alpha[$no+14].'4:'.$a_alpha[$no+16].'4');
    $sheet1->duplicateStyle($sheet2->getStyle('M4'), $a_alpha[$no+14].'4');
    $sheet1->duplicateStyle($sheet2->getStyle('M4'), $a_alpha[$no+15].'4');
    $sheet1->duplicateStyle($sheet2->getStyle('AB4'), $a_alpha[$no+16].'4');

    $sheet1->setCellValue( $a_alpha[$no+11].'5', "対人共感リスク");
    $sheet1->duplicateStyle($sheet2->getStyle('AD4'), $a_alpha[$no+11].'5');
    $sheet1->setCellValue( $a_alpha[$no+12].'5', "状況察知リスク");
    $sheet1->duplicateStyle($sheet2->getStyle('AE4'), $a_alpha[$no+12].'5');
    $sheet1->setCellValue( $a_alpha[$no+13].'5', "業務分担リスク");
    $sheet1->duplicateStyle($sheet2->getStyle('AE4'), $a_alpha[$no+13].'5');

    $sheet1->setCellValue( $a_alpha[$no+14].'5', "感情コントロールリスク");
    $sheet1->duplicateStyle($sheet2->getStyle('AD4'), $a_alpha[$no+14].'5');
    $sheet1->setCellValue( $a_alpha[$no+15].'5', "ポジティブ思考リスク");
    $sheet1->duplicateStyle($sheet2->getStyle('AE4'), $a_alpha[$no+15].'5');
    $sheet1->setCellValue( $a_alpha[$no+16].'5', "自己肯定リスク");
    $sheet1->duplicateStyle($sheet2->getStyle('AF4'), $a_alpha[$no+16].'5');

    $row = 6;
    foreach($mv1 as $k=>$v){
        $sheet1->setCellValue( $a_alpha[$no+10].$row, $v[ 'sougo' ]);
        $sheet1->duplicateStyle($sheet2->getStyle('AA6'), $a_alpha[$no+10].$row);
        $sheet1->setCellValue( $a_alpha[$no+11].$row, $v[ 'personal' ]);
        $sheet1->duplicateStyle($sheet2->getStyle('AA6'), $a_alpha[$no+11].$row);
        $sheet1->setCellValue( $a_alpha[$no+12].$row, $v[ 'state' ]);
        $sheet1->duplicateStyle($sheet2->getStyle('AA6'), $a_alpha[$no+12].$row);
        $sheet1->setCellValue( $a_alpha[$no+13].$row, $v[ 'job' ]);
        $sheet1->duplicateStyle($sheet2->getStyle('AA6'), $a_alpha[$no+13].$row);
        $sheet1->setCellValue( $a_alpha[$no+14].$row, $v[ 'image' ]);
        $sheet1->duplicateStyle($sheet2->getStyle('AA6'), $a_alpha[$no+14].$row);
        $sheet1->setCellValue( $a_alpha[$no+15].$row, $v[ 'positive' ]);
        $sheet1->duplicateStyle($sheet2->getStyle('AA6'), $a_alpha[$no+15].$row);
        $sheet1->setCellValue( $a_alpha[$no+16].$row, $v[ 'self' ]);
        $sheet1->duplicateStyle($sheet2->getStyle('z9'), $a_alpha[$no+16].$row);
        $row++;
    }

}


//調整
$sheet1->setCellValue( 'c1', $custom[ 'name' ]);
$sheet1->duplicateStyle($sheet2->getStyle('c1'), 'c1');

$sheet1->setCellValue( 'i1', $types[0][ 'name' ]);
$sheet1->duplicateStyle($sheet2->getStyle('i1'), 'i1');


$sheet1->duplicateStyle($sheet2->getStyle('k3'), 'k3');
$sheet1->duplicateStyle($sheet2->getStyle('k4'), 'k4');
$sheet1->duplicateStyle($sheet2->getStyle('k5'), 'k5');


//exit();

$xl->setActiveSheetIndex(0);
$xl->removeSheetByIndex(2);
$xl->removeSheetByIndex(1);
//ブラウザへ出力をリダイレクト
header('Content-Type: application/vnd.ms-excel');
$file = "resultlist_".date('Ymd')."_".$sec.".xls";
header('Content-Disposition: attachment;filename='.$file);
header('Cache-Control: max-age=0');

//Excel5形式で保存
$writer = PHPExcel_IOFactory::createWriter($xl, 'Excel5');
$writer->save('php://output');


function get_age($birth){
    $ty = date("Y");
    $tm = date("m");
    $td = date("d");
    list($by, $bm, $bd) = explode('/', $birth);
    $age = $ty - $by;
    if($tm * 100 + $td < $bm * 100 + $bd) $age--;
    return $age;
}

exit;
