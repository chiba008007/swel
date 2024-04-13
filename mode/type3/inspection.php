<?PHP
    require_once("./lib/include_inspection.php");
    $obj = new inspectionMethod();
    if($sec == "upload"){
        if(filter_input(INPUT_POST,"regist") ){
            
            setlocale(LC_ALL, 'ja_JP');
            if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
                $file_tmp_name = $_FILES["upfile"]["tmp_name"];
                $file_name = $_FILES["upfile"]["name"];
                if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
                      $msg = "CSVのみ対応";
                    
                }else{
                    $fp = fopen($file_tmp_name, "r");
                    //配列に変換する
                    $no = 0;
                    while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
                        if($no > 0){
                            $edit = [];
                            $edit[ 'where' ][ 'id' ] = $data[0];
                            $edit[ 'where' ][ 'partner_id' ] = $_SESSION[pid];
                            $edit[ 'where' ][ 'customer_id' ] = $id;
                            $edit[ 'edit'  ][ 'inspection' ] = $data[1];
                            $edit[ 'edit'  ][ 'enterdate' ] = $data[14];
                            $edit[ 'edit'  ][ 'retiredate' ] = $data[15];
                            $edit[ 'edit'  ][ 'retirereason' ] = mb_convert_encoding($data[16],"utf-8","sjis");
                            $edit[ 'edit'  ][ 'evaluation' ] = $data[12];
                            $edit[ 'edit'  ][ 'adopt' ] = $data[13];
                            
                            $db->editUserData("t_testpaper",$edit);
                        }
                        $no++;
                    }
                    fclose($fp);

                    $msg = "登録完了しました";
                }
            }
            
          
        }

       $html = "inspectionupload";
    }
    if($sec == "edit"){
        $where = [];
        $where[ 'partner_id' ] = $_SESSION[pid];
        $where[ 'customer_id' ] = $id;
        $where[ 'id' ] = $third;
        $data = $obj->getDataOne($where);
        $inspection = $data[ 'inspection' ];
        $enterdate = ($data[ 'enterdate' ] == '0000-00-00')?"":$data[ 'enterdate' ];
        $retiredate = ($data[ 'retiredate' ] == '0000-00-00')?"":$data[ 'retiredate' ];
        $evaluation = $data[ 'evaluation' ];
        $adopt  = $data[ 'adopt' ];
        $retirereason = $data[ 'retirereason' ];
        if(!$data){
            header("Location:/index/inspection/");
            exit();
        }
        $msg = "";
        if(filter_input(INPUT_POST,"regist")){
            $inspection = filter_input(INPUT_POST,"inspection");
            $enterdate = filter_input(INPUT_POST,"enterdate");
            $retiredate = filter_input(INPUT_POST,"retiredate");
            $evaluation = filter_input(INPUT_POST,"evaluation");
            $adopt = filter_input(INPUT_POST,"adopt");
            $retirereason = filter_input(INPUT_POST,"retirereason");

            $edit = [];
            $edit[ 'where' ][ 'id' ] = $third;
            $edit[ 'where' ][ 'partner_id' ] = $_SESSION[pid];
            $edit[ 'where' ][ 'customer_id' ] = $id;
            $edit[ 'edit' ][ 'inspection' ] = $inspection;
            $edit[ 'edit' ][ 'enterdate' ] = $enterdate;
            $edit[ 'edit' ][ 'retiredate' ] = $retiredate;
            $edit[ 'edit' ][ 'evaluation' ] = $evaluation;
            $edit[ 'edit' ][ 'adopt' ] = $adopt;
            $edit[ 'edit' ][ 'retirereason' ] = $retirereason;
            $db->editUserData("t_testpaper",$edit);
            $msg = "登録を行いました。";
        }
        
        $html = "inspectionedit";
    }else{
        $searchid = sprintf("%s",$_REQUEST[ 'searchid' ]);
        $searchname = sprintf("%s",$_REQUEST[ 'searchname' ]);
        $searchkana = sprintf("%s",$_REQUEST[ 'searchkana' ]);
        $searchfrom = sprintf("%s",$_REQUEST[ 'searchfrom' ]);
        $searchto = sprintf("%s",$_REQUEST[ 'searchto' ]);
        $where = [];
        $where[ 'partner_id' ] = $_SESSION[pid];
        $where[ 'customer_id' ] = $id;
        $where[ 'searchid' ] = $searchid;
        $where[ 'searchname' ] = $searchname;
        $where[ 'searchkana' ] = $searchkana;
        $where[ 'searchfrom' ] = $searchfrom;
        $where[ 'searchto' ] = $searchto;
        $row = $obj->getUserData($where);
        $limit = 100;
        $offset = sprintf("%d",$limit * filter_input(INPUT_GET,"p"));
        $ceil = sprintf("%d",ceil($row/$limit));
        $where[ 'offset' ] = $offset;
        $where[ 'limit' ] = $limit;
        $data = $obj->getUserData($where);
    }
    
    
    //csvダウンロード
    if($sec == "csvdownload"){
        
        

        $filename = 'test.csv';
        $csv = "'ID,受検区分（新卒・中途）,採用年度,検査名,ID,氏名,ふりがな,生年月日（受検日年齢）,性別,受検日,メモ１,メモ２,面接評価,採用合否,入社日,退職日,退職理由";
        $csv .= "\n";
        foreach ($data as $key => $value) {
            $id = $value[ 'id' ];
            $inspection = strReplace($value[ 'inspection' ]);
            $exam_year = $value[ 'exam_year' ];
            $testname = $value[ 'testname' ];
            $exam_id = $value[ 'exam_id' ];
            $name = strReplace($value[ 'name' ]);
            $kana = strReplace($value[ 'kana' ]);
            $birth = $value[ '"birth' ];
            $sex = $a_gender[$value[ 'sex' ]];
            $exam_date = $value[ 'exam_date' ];
            $memo1 = strReplace($value[ 'memo1' ]);
            $memo2 = strReplace($value[ 'memo2' ]);
            $evaluation = $value[ 'evaluation' ];
            $adopt = $value[ 'adopt' ];
            $enterdate = $value[ 'enterdate' ];
            $retiredate = $value[ 'retiredate' ];
            $retirereason = strReplace(str_replace("\r\n"," ",$value[ 'retirereason' ]));
            
            $csv .=  $id.",";
            $csv .=  $inspection.",";
            $csv .= $exam_year.",";
            $csv .= $testname.",";
            $csv .= $exam_id.",";
            $csv .= $name.",";
            $csv .= $kana.",";
            $csv .= $birth.",";
            $csv .= $sex.",";
            $csv .= $exam_date.",";
            $csv .= $memo1.",";
            $csv .= $memo2.",";
            $csv .= $evaluation.",";
            $csv .= $adopt.",";
            $csv .= $enterdate.",";
            $csv .= $retiredate.",";
            $csv .= $retirereason.",";
            
            $csv .=  "\n"; 
        }

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=$filename");
        echo mb_convert_encoding($csv,"SJIS", "UTF-8");

        exit();
    }
    function strReplace($str){
        $str = str_replace(',', '","', $str);
        $str = str_replace("\n", chr(10), $str);
        return $str;
    }
   
?>