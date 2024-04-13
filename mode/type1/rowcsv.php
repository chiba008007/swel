<?php

//-------------------------------------------
//ROWデータcsv表示
//
//
//
//
//
//-------------------------------------------
require_once("./lib/include_row.php");
$orow = new rowMethod($id);


$f = sprintf("%04d%02d%02d", date("Y"), date("m"), date("d"));
$type = mb_convert_encoding($a_test_type[$sec], "Shift-JIS", "UTF-8");
$file = $type."_row".$f;

header("Content-Type: application/octet-stream");
header("Content-type: application/x-csv; charset=UTF-8");
header("Content-Disposition: attachment; filename=".$file.".csv");

$where[ 'type' ] = $sec;
if (isset($_REQUEST[ 'date' ]) && $_REQUEST[ 'date' ]) {
    $where[ 'date' ] = $_REQUEST['date'];
}


switch($sec) {
    case "70":
        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";

        $columns = array(
                'number' => '番号',
                'exam_id' => '受検者ID',
                'name' => '受検者名',
                'kana' => '受検者名カナ',
                'birth' => '生年月日',
                'age' => '年齢',
                'sex' => '性別',
                'pass' => '合否',
                'memo1' => 'メモ1',
                'memo2' => 'メモ2',
                'exam_date' => '受検日',
                'start_time' => '受検開始時間',
                'exam_time' => '受検時間',
        );
        $data = $orow->getBAGData($where);
        foreach ($columns as $key=>$val) {
            echo mb_convert_encoding($val, 'Shift-JIS', 'UTF-8').",";
        }
        for ($i=1;$i<=106;$i++) {
            echo mb_convert_encoding("設問".$i, 'Shift-JIS', 'UTF-8').",";
        }
        echo "\n";

        foreach ($data as $key=>$val) {
            echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'number'           ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
            if ($val[ 'sex' ] == 1) {
                echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
            } elseif ($val[ 'sex' ] == 2) {
                echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
            } else {
                echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
            }
            echo mb_convert_encoding($val[ 'pass'             ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
            echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";
            for ($i=1;$i<=106;$i++) {
                $sec = "sec".$i;
                echo $val[$sec].",";
            }
            echo "\n";
        }


        break;
    case "1":
    case "2":
    case "3":
    case "12":
    case "73":
    case "72":

        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";

        $columns = array(
            'number' => '番号',
            'exam_id' => '受検者ID',
            'name' => '受検者名',
            'kana' => '受検者名カナ',
            'birth' => '生年月日',
            'age' => '年齢',
            'sex' => '性別',
            'pass' => '合否',
            'memo1' => 'メモ1',
            'memo2' => 'メモ2',
            'exam_date' => '受検日',
            'start_time' => '受検開始時間',
            'exam_time' => '受検時間',
            'q1' => '回答1',
            'q2' => '回答2',
            'q3' => '回答3',
            'q4' => '回答4',
            'q5' => '回答5',
            'q6' => '回答6',
            'q7' => '回答7',
            'q8' => '回答8',
            'q9' => '回答9',
            'q10' => '回答10',
            'q11' => '回答11',
            'q12' => '回答12',
            'q13' => '回答13',
            'q14' => '回答14',
            'q15' => '回答15',
            'q16' => '回答16',
            'q17' => '回答17',
            'q18' => '回答18',
            'q19' => '回答19',
            'q20' => '回答20',
            'q21' => '回答21',
            'q22' => '回答22',
            'q23' => '回答23',
            'q24' => '回答24',
            'q25' => '回答25',
            'q26' => '回答26',
            'q27' => '回答27',
            'q28' => '回答28',
            'q29' => '回答29',
            'q30' => '回答30',
            'q31' => '回答31',
            'q32' => '回答32',
            'q33' => '回答33',
            'q34' => '回答34',
            'q35' => '回答35',
            'q36' => '回答36',
            'st_level' => 'ストレス共生レベル',
            'st_score' => 'ストレス共生スコア',
            'level' => '適合度レベル',
            'score' => '適合度スコア',
            'dev1' => '自己感情モニタリング力',
            'dev2' => '客観的自己評価力',
            'dev3' => '自己肯定力',
            'dev4' => 'コントロール＆アチーブメント力',
            'dev5' => 'ビジョン創出力',
            'dev6' => 'ポジティブ思考力',
            'dev7' => '対人共感力',
            'dev8' => '状況察知力',
            'dev9' => 'ホスピタリティ発揮力',
            'dev10' => 'リーダーシップ発揮力',
            'dev11' => 'アサーション発揮力',
            'dev12' => '集団適応力',
            'soyo' => '最大偏差値の要素名'
        );

        if ($sec == 72) {
            $array72 = array(
                'sogo' =>"総合",
                'personal' =>"対人共感リスク",
                'state' =>"状況察知リスク",
                'job' =>"業務分担リスク",
                'image' =>"感情コントロールリスク",
                'positive' =>"ポジティブ思考リスク",
                'self' =>"自己肯定リスク",

            );
            $columns = array_merge($columns, $array72);
        }
        foreach ($columns as $key=>$val) {
            echo mb_convert_encoding($val, 'Shift-JIS', 'UTF-8').",";
        }
        echo "\n";
        $data = $orow->getRowData($where);

        if (count($data)) {
            foreach ($data as $key=>$val) {
                //ストレス共生レベル/スコアの取得
                if ($val['dev1'] && $val['dev2']) {
                    if ($stressflg[$val[ 'test_id' ]]) {
                        list($st_level, $st_score) = $db->getStress2($val['dev1'], $val['dev2'], $val[ 'dev6' ]);
                    } else {
                        list($st_level, $st_score) = $db->getStress($val['dev1'], $val['dev2']);
                    }
                } else {
                    $st_level = '';
                    $st_score = '';
                }
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'number'           ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'pass'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q1'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q2'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q3'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q4'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q5'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q6'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q7'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q8'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q9'               ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q10'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q11'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q12'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q13'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q14'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q15'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q16'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q17'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q18'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q19'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q20'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q21'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q22'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q23'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q24'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q25'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q26'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q27'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q28'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q29'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q30'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q31'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q32'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q33'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q34'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q35'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q36'              ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($st_level, 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($st_score, 'Shift-JIS', 'UTF-8').",";

                echo mb_convert_encoding($val[ 'level'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'score'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev1'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev2'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev3'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev4'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev5'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev6'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev7'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev8'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev9'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev10'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev11'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'dev12'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($soyo_name[$val[ 'soyo' ]], 'Shift-JIS', 'UTF-8').",";

                if ($sec == 72) {
                    echo mb_convert_encoding($val[ 'pfs_sougo'           ], 'Shift-JIS', 'UTF-8').",";
                    echo mb_convert_encoding($val[ 'pfs_personal'        ], 'Shift-JIS', 'UTF-8').",";
                    echo mb_convert_encoding($val[ 'pfs_state'           ], 'Shift-JIS', 'UTF-8').",";
                    echo mb_convert_encoding($val[ 'pfs_job'             ], 'Shift-JIS', 'UTF-8').",";
                    echo mb_convert_encoding($val[ 'pfs_image'           ], 'Shift-JIS', 'UTF-8').",";
                    echo mb_convert_encoding($val[ 'pfs_positive'        ], 'Shift-JIS', 'UTF-8').",";
                    echo mb_convert_encoding($val[ 'pfs_self'            ], 'Shift-JIS', 'UTF-8').",";
                }

                echo "\n";
            }
        }

        break;
    case "83":
        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding("番号", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("受検者ID", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("受検者名", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("受検者名かな", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("生年月日", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("年齢", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("性別", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("合否", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("メモ１", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("メモ２", "SJIS", "UTF-8").",";

        echo mb_convert_encoding("AMPC", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("受検日", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("受検開始時間", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("受検時間", "SJIS", "UTF-8").",";
        for ($i=1;$i<=42;$i++) {
            echo mb_convert_encoding("設問", "SJIS", "UTF-8").$i.",";
        }

        echo mb_convert_encoding("役職", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("社員数", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("業種", "SJIS", "UTF-8").",";
        echo mb_convert_encoding("業界", "SJIS", "UTF-8").",";

        echo "\n";

        $data = $orow->getAMPRowData($where);

        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'number'           ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'pass'             ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";

                echo mb_convert_encoding($val[ 'ampdate' ], 'sjis', 'UTF-8').",";

                if ($val[ 'exam_state' ] == 2) {
                    echo mb_convert_encoding($val[ 'exam_date'  ], 'sjis', 'UTF-8').",";
                } elseif ($val[ 'exam_state' ] == 1) {
                    echo mb_convert_encoding("受検中", "SJIS", "UTF-8").",";
                } else {
                    echo mb_convert_encoding("未受検", "SJIS", "UTF-8").",";
                }

                if ($val[ 'exam_date' ] && $val[ 'exam_state' ] == 2) {
                    echo mb_convert_encoding($val[ 'start_time' ], 'sjis', 'UTF-8').",";
                } else {
                    echo " ,";
                }
                if ($val[ 'exam_time' ] && $val[ 'exam_state' ] == 2) {
                    echo mb_convert_encoding($val[ 'exam_time'  ], 'sjis', 'UTF-8').",";
                } else {
                    echo " ,";
                }

                for ($k=5;$k<=46;$k++) {
                    $q = "q".$k;
                    if ($val[$q]) {
                        echo $val[ $q  ].",";
                    } else {
                        echo " ,";
                    }
                }

                echo mb_convert_encoding($val[ 'q1' ], 'sjis', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q2' ], 'sjis', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'q3' ], 'sjis', 'UTF-8').",";
                // echo mb_convert_encoding(preg_replace("/,/"," ",$val[ 'q2' ]),'sjis','UTF-8').",";
                // echo mb_convert_encoding(preg_replace("/,/"," ",$val[ 'q3' ]),'sjis','UTF-8').",";
                echo mb_convert_encoding($val[ 'q4' ], 'sjis', 'UTF-8').",";


                echo "\n";
            }
        }


        break;
    case "4":
        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ふりがな', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ１', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ２', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";
        for ($i=1;$i<=66;$i++) {
            $vf = "回答".$i;
            echo mb_convert_encoding($vf, 'Shift-JIS', 'UTF-8').",";
        }
        echo mb_convert_encoding('自己感情モニタリング力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('客観的自己評価力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('自己肯定力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ｺﾝﾄﾛｰﾙ&ｱﾁｰﾌﾞﾒﾝﾄ力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ビジョン創出力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ポジティブ思考力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('対人共感力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('状況察知力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ホスピタリティ発揮力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('リーダーシップ発揮力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('アサーション発揮力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('集団適応力', 'Shift-JIS', 'UTF-8').",";

        echo "\n";
        $where = array();
        $where[ 'eir_id' ] = $id;
        $data = $orow->getRowDataVF($where);


        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";
                for ($i=1;$i<=66;$i++) {
                    $vf = "vf".$i;
                    echo mb_convert_encoding($val[ 'weight' ][ $vf   ], 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'weight' ][ 'w1'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w2'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w3'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w4'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w5'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w6'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w7'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w8'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w9'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w10'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w11'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w12'   ], 'Shift-JIS', 'UTF-8').",";
                echo "\n";
            }
        }




        break;
    case "5":
        $data = $orow->getRowDpElCsvData();

        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ふりがな', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ１', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ２', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";

        for ($i=1;$i<=6;$i++) {
            switch($i) {
                case "3":
                case "4":
                case "5":
                case "6":
                    for ($j=1;$j<=7;$j++) {
                        echo mb_convert_encoding('セクションA'.$i.'_'.$j.'', 'Shift-JIS', 'UTF-8').",";
                    }
                    break;
                default:
                    echo mb_convert_encoding('セクションA'.$i.'', 'Shift-JIS', 'UTF-8').",";
                    break;
            }
        }

        for ($i=1;$i<=10;$i++) {
            for ($j=1;$j<=3;$j++) {
                echo mb_convert_encoding('セクションB'.$i.'_'.$j.'', 'Shift-JIS', 'UTF-8').",";
            }
        }

        for ($i=1;$i<=22;$i++) {
            echo mb_convert_encoding('セクションC'.$i.'', 'Shift-JIS', 'UTF-8').",";
        }
        for ($i=1;$i<=8;$i++) {
            switch($i) {
                case "6":
                case "7":
                case "8":
                    for ($j=1;$j<=5;$j++) {
                        echo mb_convert_encoding('セクションD'.$i.'_'.$j.'', 'Shift-JIS', 'UTF-8').",";
                    }

                    break;
                default:
                    for ($j=1;$j<=4;$j++) {
                        echo mb_convert_encoding('セクションD'.$i.'_'.$j.'', 'Shift-JIS', 'UTF-8').",";
                    }
                    break;
            }
        }
        for ($i=1;$i<=12;$i++) {
            for ($j=1;$j<=6;$j++) {
                echo mb_convert_encoding('セクションE'.$i.'_'.$j.'', 'Shift-JIS', 'UTF-8').",";
            }
        }
        for ($i=1;$i<=5;$i++) {
            for ($j=1;$j<=3;$j++) {
                echo mb_convert_encoding('セクションF'.$i.'_'.$j.'', 'Shift-JIS', 'UTF-8').",";
            }
        }
        for ($i=1;$i<=19;$i++) {
            echo mb_convert_encoding('セクションG'.$i.'', 'Shift-JIS', 'UTF-8').",";
        }
        for ($i=1;$i<=8;$i++) {
            switch($i) {
                case "1":
                case "2":
                case "3":
                case "4":
                    for ($j=1;$j<=3;$j++) {
                        echo mb_convert_encoding('セクションH'.$i.'_'.$j.'', 'Shift-JIS', 'UTF-8').",";
                    }
                    break;
                case "5":
                case "6":
                case "7":
                    for ($j=1;$j<=5;$j++) {
                        echo mb_convert_encoding('セクションH'.$i.'_'.$j.'', 'Shift-JIS', 'UTF-8').",";
                    }
                    break;
                default:
                    echo mb_convert_encoding('セクションH'.$i.'', 'Shift-JIS', 'UTF-8').",";
                    break;
            }
        }


        echo "\n";
        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'ans' ][ 'sec1'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'ans' ][ 'sec2'    ], 'Shift-JIS', 'UTF-8').",";
                for ($i=3;$i<=6;$i++) {
                    $Akey = "sec".$i;
                    $ex = explode(":", $val[ 'ans' ][ $Akey ]);
                    foreach ($ex as $k=>$v) {
                        echo mb_convert_encoding($v, 'Shift-JIS', 'UTF-8').",";
                    }
                }

                for ($i=1;$i<=10;$i++) {
                    $Bkey = "secB".$i;
                    $ex = explode(":", $val[ 'ans' ][ $Bkey ]);
                    foreach ($ex as $k=>$v) {
                        echo mb_convert_encoding($v, 'Shift-JIS', 'UTF-8').",";
                    }
                }
                for ($i=1;$i<=22;$i++) {
                    $Ckey = "secC".$i;
                    echo mb_convert_encoding($val[ 'ans' ][ $Ckey ], 'Shift-JIS', 'UTF-8').",";
                }

                for ($i=1;$i<=8;$i++) {
                    $Dkey = "secD".$i;
                    $ex = explode(":", $val[ 'ans' ][ $Dkey ]);
                    foreach ($ex as $k=>$v) {
                        echo mb_convert_encoding($v, 'Shift-JIS', 'UTF-8').",";
                    }
                }

                for ($i=1;$i<=12;$i++) {
                    $Ekey = "secE".$i;
                    $ex = explode(":", $val[ 'ans' ][ $Ekey ]);
                    foreach ($ex as $k=>$v) {
                        echo mb_convert_encoding($v, 'Shift-JIS', 'UTF-8').",";
                    }
                }

                for ($i=1;$i<=5;$i++) {
                    $Fkey = "secF".$i;
                    $ex = explode(":", $val[ 'ans' ][ $Fkey ]);
                    foreach ($ex as $k=>$v) {
                        echo mb_convert_encoding($v, 'Shift-JIS', 'UTF-8').",";
                    }
                }

                for ($i=1;$i<=19;$i++) {
                    $Gkey = "secG".$i;
                    echo mb_convert_encoding($val[ 'ans' ][ $Gkey ], 'Shift-JIS', 'UTF-8').",";
                }

                for ($i=1;$i<=8;$i++) {
                    $Hkey = "secH".$i;
                    $ex = explode(":", $val[ 'ans' ][ $Hkey ]);
                    foreach ($ex as $k=>$v) {
                        echo mb_convert_encoding($v, 'Shift-JIS', 'UTF-8').",";
                    }
                }

                echo "\n";
            }
        }
        break;
    case "6":
        $data = $orow->getRowMVData();

        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ふりがな', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ１', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ２', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";
        for ($i=1;$i<=170;$i++) {
            $keys = "設問".$i;
            echo mb_convert_encoding($keys, 'Shift-JIS', 'UTF-8').",";
        }

        echo "\n";

        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";
                for ($i=1;$i<=170;$i++) {
                    $ansK = "ans".$i;
                    echo mb_convert_encoding($val[ 'ans' ][ $ansK ], 'Shift-JIS', 'UTF-8').",";
                }
                echo "\n";
            }
        }
        break;
    case "7":
    case "74":
    case "47":
        $data = $orow->getRowRSData($sec);


        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ふりがな', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ１', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ２', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";

        if ($sec == 74 || $sec == 47) {
            for ($i=1;$i<=143;$i++) {
                $keys = "設問".$i;
                echo mb_convert_encoding($keys, 'Shift-JIS', 'UTF-8').",";
            }
        } else {
            for ($i=1;$i<=151;$i++) {
                $keys = "設問".$i;
                echo mb_convert_encoding($keys, 'Shift-JIS', 'UTF-8').",";
            }
        }
        echo "\n";


        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";

                if ($sec == 74 || $sec == 47) {
                    for ($i=1;$i<=143;$i++) {
                        $ans = "ans".$i;
                        echo $val[ 'ans' ][ $ans ].",";
                    }
                } else {
                    echo $val[ 'ans' ][ 'secA1' ].",";

                    echo $val[ 'ans' ][ 'secA2a' ].",";
                    echo $val[ 'ans' ][ 'secA2b' ].",";
                    echo $val[ 'ans' ][ 'secA2c' ].",";
                    echo $val[ 'ans' ][ 'secA2d' ].",";
                    echo $val[ 'ans' ][ 'secA2e' ].",";
                    echo $val[ 'ans' ][ 'secA2f' ].",";
                    echo $val[ 'ans' ][ 'secA2g' ].",";

                    echo $val[ 'ans' ][ 'secA3a' ].",";
                    echo $val[ 'ans' ][ 'secA3b' ].",";
                    echo $val[ 'ans' ][ 'secA3c' ].",";
                    echo $val[ 'ans' ][ 'secA3d' ].",";
                    echo $val[ 'ans' ][ 'secA3e' ].",";
                    echo $val[ 'ans' ][ 'secA3f' ].",";
                    echo $val[ 'ans' ][ 'secA3g' ].",";

                    for ($i=1;$i<=6;$i++) {
                        echo $val[ 'ans' ][ 'secB'.$i.'a' ].",";
                        echo $val[ 'ans' ][ 'secB'.$i.'b' ].",";
                        echo $val[ 'ans' ][ 'secB'.$i.'c' ].",";
                    }
                    for ($i=1;$i<=15;$i++) {
                        echo $val[ 'ans' ][ 'secC'.$i ].",";
                    }
                    echo $val[ 'ans' ][ 'secD1_1' ].",";
                    echo $val[ 'ans' ][ 'secD1_2' ].",";
                    echo $val[ 'ans' ][ 'secD2_1' ].",";
                    echo $val[ 'ans' ][ 'secD2_2' ].",";
                    echo $val[ 'ans' ][ 'secD3_1' ].",";
                    echo $val[ 'ans' ][ 'secD3_2' ].",";
                    echo $val[ 'ans' ][ 'secD4_1' ].",";
                    echo $val[ 'ans' ][ 'secD4_2' ].",";
                    echo $val[ 'ans' ][ 'secD4_3' ].",";
                    echo $val[ 'ans' ][ 'secD5_1' ].",";
                    echo $val[ 'ans' ][ 'secD5_2' ].",";
                    echo $val[ 'ans' ][ 'secD5_3' ].",";
                    echo $val[ 'ans' ][ 'secD5_4' ].",";
                    echo $val[ 'ans' ][ 'secD6_1' ].",";
                    echo $val[ 'ans' ][ 'secD6_2' ].",";

                    for ($i=1;$i<=7;$i++) {
                        echo $val[ 'ans' ][ 'secH'.$i.'A'].",";
                        echo $val[ 'ans' ][ 'secH'.$i.'B'].",";
                        echo $val[ 'ans' ][ 'secH'.$i.'C'].",";
                    }

                    for ($i=1;$i<=5;$i++) {
                        echo $val[ 'ans' ][ 'secG'.$i.'a'].",";
                        echo $val[ 'ans' ][ 'secG'.$i.'b'].",";
                        echo $val[ 'ans' ][ 'secG'.$i.'c'].",";
                    }

                    for ($i=1;$i<=14;$i++) {
                        echo $val[ 'ans' ][ 'secF'.$i ].",";
                    }

                    echo $val[ 'ans' ][ 'secE1_1' ].",";
                    echo $val[ 'ans' ][ 'secE1_2' ].",";
                    echo $val[ 'ans' ][ 'secE2_1' ].",";
                    echo $val[ 'ans' ][ 'secE2_2' ].",";
                    echo $val[ 'ans' ][ 'secE3_1' ].",";
                    echo $val[ 'ans' ][ 'secE3_2' ].",";
                    echo $val[ 'ans' ][ 'secE4_1' ].",";
                    echo $val[ 'ans' ][ 'secE4_2' ].",";
                    echo $val[ 'ans' ][ 'secE4_3' ].",";
                    echo $val[ 'ans' ][ 'secE5_1' ].",";
                    echo $val[ 'ans' ][ 'secE5_2' ].",";
                    echo $val[ 'ans' ][ 'secE5_3' ].",";
                    echo $val[ 'ans' ][ 'secE6_1' ].",";
                    echo $val[ 'ans' ][ 'secE6_2' ].",";
                    echo $val[ 'ans' ][ 'secE6_3' ].",";


                    echo $val[ 'ans' ][ 'secI1_1' ].",";
                    echo $val[ 'ans' ][ 'secI1_2' ].",";
                    echo $val[ 'ans' ][ 'secI1_3' ].",";
                    echo $val[ 'ans' ][ 'secI1_4' ].",";
                    echo $val[ 'ans' ][ 'secI1_5' ].",";

                    echo $val[ 'ans' ][ 'secI2_1' ].",";
                    echo $val[ 'ans' ][ 'secI2_2' ].",";
                    echo $val[ 'ans' ][ 'secI2_3' ].",";
                    echo $val[ 'ans' ][ 'secI2_4' ].",";
                    echo $val[ 'ans' ][ 'secI2_5' ].",";

                    echo $val[ 'ans' ][ 'secI3_1' ].",";
                    echo $val[ 'ans' ][ 'secI3_2' ].",";
                    echo $val[ 'ans' ][ 'secI3_3' ].",";
                    echo $val[ 'ans' ][ 'secI3_4' ].",";
                    echo $val[ 'ans' ][ 'secI3_5' ].",";

                    echo $val[ 'ans' ][ 'secI4_1' ].",";
                    echo $val[ 'ans' ][ 'secI4_2' ].",";
                    echo $val[ 'ans' ][ 'secI4_3' ].",";
                    echo $val[ 'ans' ][ 'secI4_4' ].",";
                    echo $val[ 'ans' ][ 'secI4_5' ].",";

                    echo $val[ 'ans' ][ 'secI5_1' ].",";
                    echo $val[ 'ans' ][ 'secI5_2' ].",";
                    echo $val[ 'ans' ][ 'secI5_3' ].",";
                }


                echo "\n";
            }
        }


        break;
    case "10":
        $data = $orow->tamenRowDataCsv();

        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('検査型', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('被評価者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('被評価者部署', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('評価者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('評価者部署', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('関係性', 'Shift-JIS', 'UTF-8').",";
        for ($i=1;$i<=78;$i++) {
            $ans = "回答".$i;
            echo mb_convert_encoding($ans, 'Shift-JIS', 'UTF-8').",";
        }
        echo "\n";

        if (count($data)) {
            foreach ($data as $key=>$val) {
                if (count($val[ 'result' ])) {
                    foreach ($val[ 'result' ] as $k=>$v) {
                        echo mb_convert_encoding("多面評価検査", "Shift-JIS", "UTF-8").",";
                        echo mb_convert_encoding($val[ 'partner_name' ], "Shift-JIS", "UTF-8").",";
                        echo $val[ 'birth' ].",";
                        echo $val[ 'age' ].",";
                        echo $val[ 'exam_date' ].",";
                        echo $val[ 'start_time' ].",";
                        echo mb_convert_encoding($array_tamen_type[$v[ 'tamen_type' ]], "Shift-JIS", "UTF-8").",";
                        echo mb_convert_encoding($val[ 'hv_name' ], "sjis-win", "UTF-8").",";
                        echo mb_convert_encoding($val[ 'hv_busyo' ], "Shift-JIS", "UTF-8").",";
                        echo mb_convert_encoding($val[ 'ev_name' ], "sjis-win", "UTF-8").",";
                        echo mb_convert_encoding($val[ 'ev_busyo' ], "Shift-JIS", "UTF-8").",";
                        echo mb_convert_encoding($val[ 'relation' ], "Shift-JIS", "UTF-8").",";
                        for ($i=1;$i<=78;$i++) {
                            $ans = "ans".$i;
                            if ($v[ $ans ]) {
                                echo $v[$ans].",";
                            } else {
                                echo " ,";
                            }
                        }
                        echo "\n";
                    }
                }
            }
        }

        break;
    case "11":
        $data = $orow->getRowIQCsv();


        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";
        for ($i=1;$i<=56;$i++) {
            $ans = "回答".$i;
            echo mb_convert_encoding($ans, 'Shift-JIS', 'UTF-8').",";
        }
        echo "\n";


        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding("IQ検査", "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'partner_name' ], "Shift-JIS", "UTF-8").",";
                echo $val[ 'birth' ].",";
                echo $val[ 'age' ].",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo $val[ 'exam_id' ].",";
                echo $val[ 'exam_date' ].",";
                echo $val[ 'start_time' ].",";
                echo $val[ 'exam_time' ].",";

                for ($i=1;$i<=56;$i++) {
                    $ans = "ans".$i;
                    if (strlen($val[ $ans ]) > 0) {
                        echo $val[$ans].",";
                    } else {
                        echo " ,";
                    }
                }
                echo "\n";
            }
        }



        break;
    case "13":

        $data = $orow->getMathRowDataList();

        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名かな', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('合否', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ１', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ２', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";
        for ($i=1;$i<=30;$i++) {
            $kaito = "回答".$i;
            echo mb_convert_encoding($kaito, 'Shift-JIS', 'UTF-8').",";
        }
        echo mb_convert_encoding('把握力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('分析力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('選択力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('予測力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('表現力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('合計素点', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('合計スコア', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('合計レベル', 'Shift-JIS', 'UTF-8')."";

        echo "\n";

        $tbl = "t_user";

        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'testname' ], "Shift-JIS", "UTF-8").",";

                $pt[ 'id' ] = $val[ 'partner_id' ];
                $pname = $orow->getUserDataParts($tbl, $pt, "name");
                echo mb_convert_encoding($pname[0][ 'name' ], "sjis-win", "UTF-8").",";

                $cus[ 'id' ] = $val[ 'customer_id' ];
                $cname = $orow->getUserDataParts($tbl, $cus, "name");
                echo mb_convert_encoding($cname[0][ 'name' ], "sjis-win", "UTF-8").",";

                echo mb_convert_encoding($val[ 'exam_id' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'name' ], "sjis-win", "UTF-8").",";
                echo mb_convert_encoding($val[ 'kana' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'birth' ], "Shift-JIS", "UTF-8").",";
                $age = $orow->get_age($val[ 'birth' ]);
                echo mb_convert_encoding($age, "Shift-JIS", "UTF-8").",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'pass' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'memo1' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'memo2' ], "Shift-JIS", "UTF-8").",";

                echo mb_convert_encoding($val[ 'exam_date' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'start_time' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'exam_time' ], "Shift-JIS", "UTF-8").",";

                for ($i=1;$i<=30;$i++) {
                    $ans = "ans".$i;
                    echo mb_convert_encoding($val[$ans], 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'haku_yoso' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'bunseki_yoso' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'sentaku_yoso' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'yosoku_yoso' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'hyogen_yoso' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'sogo_yoso' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'sogo_score' ], "Shift-JIS", "UTF-8").",";
                echo mb_convert_encoding($val[ 'level' ], "Shift-JIS", "UTF-8").",";


                echo "\n";
            }
        }

        break;
    case "36":
        $data = $orow->getRowNL2Data();

        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ふりがな', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ１', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ２', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";
        for ($i=1;$i<=90;$i++) {
            $keys = "設問".$i;
            echo mb_convert_encoding($keys, 'Shift-JIS', 'UTF-8').",";
        }

        echo "\n";

        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";
                for ($i=1;$i<=90;$i++) {
                    $ansK = "ans".$i;
                    echo mb_convert_encoding($val[ 'ans' ][ $ansK ], 'Shift-JIS', 'UTF-8').",";
                }
                echo "\n";
            }
        }


        break;
    case "37":
        $data = $orow->getRowMV2Data();

        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ふりがな', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ１', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ２', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";
        for ($i=1;$i<=165;$i++) {
            $keys = "設問".$i;
            echo mb_convert_encoding($keys, 'Shift-JIS', 'UTF-8').",";
        }

        echo "\n";

        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";
                for ($i=1;$i<=170;$i++) {
                    $ansK = "ans".$i;
                    echo mb_convert_encoding($val[ 'ans' ][ $ansK ], 'Shift-JIS', 'UTF-8').",";
                }
                echo "\n";
            }
        }
        break;


    case "33":
        echo mb_convert_encoding('検査名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('パートナー企業', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('顧客名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者ID', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検者名', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ふりがな', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('生年月日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('年齢', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('性別', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ１', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('メモ２', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検日', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検開始時間', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('受検時間', 'Shift-JIS', 'UTF-8').",";
        for ($i=1;$i<=66;$i++) {
            $vf = "回答".$i;
            echo mb_convert_encoding($vf, 'Shift-JIS', 'UTF-8').",";
        }
        echo mb_convert_encoding('自己感情モニタリング力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('客観的自己評価力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('自己肯定力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ｺﾝﾄﾛｰﾙ&ｱﾁｰﾌﾞﾒﾝﾄ力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ビジョン創出力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ポジティブ思考力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('対人共感力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('状況察知力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('ホスピタリティ発揮力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('リーダーシップ発揮力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('アサーション発揮力', 'Shift-JIS', 'UTF-8').",";
        echo mb_convert_encoding('集団適応力', 'Shift-JIS', 'UTF-8').",";

        echo "\n";
        $where = array();
        $where[ 'eir_id' ] = $id;
        $data = $orow->getRowDataVF2($where);


        if (count($data)) {
            foreach ($data as $key=>$val) {
                echo mb_convert_encoding($val[ 'test_name'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'partner_name'     ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'customer_name'    ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_id'          ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'name'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'kana'             ], 'sjis-win', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'birth'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'age'              ], 'Shift-JIS', 'UTF-8').",";
                if ($val[ 'sex' ] == 1) {
                    echo mb_convert_encoding('男', 'Shift-JIS', 'UTF-8').",";
                } elseif ($val[ 'sex' ] == 2) {
                    echo mb_convert_encoding('女', 'Shift-JIS', 'UTF-8').",";
                } else {
                    echo mb_convert_encoding('', 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'memo1'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'memo2'            ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_date'        ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'start_time'       ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'exam_time'        ], 'Shift-JIS', 'UTF-8').",";
                for ($i=1;$i<=66;$i++) {
                    $vf = "vf".$i;
                    echo mb_convert_encoding($val[ 'weight' ][ $vf   ], 'Shift-JIS', 'UTF-8').",";
                }
                echo mb_convert_encoding($val[ 'weight' ][ 'w1'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w2'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w3'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w4'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w5'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w6'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w7'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w8'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w9'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w10'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w11'   ], 'Shift-JIS', 'UTF-8').",";
                echo mb_convert_encoding($val[ 'weight' ][ 'w12'   ], 'Shift-JIS', 'UTF-8').",";
                echo "\n";
            }
        }




        break;


    default:

        break;
}



exit();



$html = "";
