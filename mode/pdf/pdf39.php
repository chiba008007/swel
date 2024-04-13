<?php
include("./lib/pChart/pData.class");
include("./lib/pChart/pChart.class");


include("./lib/pChart/pData2.class.php");
include("./lib/pChart/pDraw.class.php");
include("./lib/pChart/pRadar.class.php");
include("./lib/pChart/pImage.class.php");


$gimg1 = "./images/pdf/graf".$id.".png";
    


$kodo_array = [
      $mhqdata[ 'result3' ],
      $mhqdata[ 'result4' ],
      $mhqdata[ 'result5' ],
      $mhqdata[ 'result6' ],
      $mhqdata[ 'result7' ],
      $mhqdata[ 'result9' ],
      $mhqdata[ 'result10' ],
      $mhqdata[ 'result12' ],
      $mhqdata[ 'result13' ],
      $mhqdata[ 'result15' ],
      $mhqdata[ 'result16' ],
      $mhqdata[ 'result17' ],
      $mhqdata[ 'result18' ],
      $mhqdata[ 'result19' ],
      $mhqdata[ 'result20' ],
      $mhqdata[ 'result22' ],
      $mhqdata[ 'result25' ],
      $mhqdata[ 'result26' ],
      $mhqdata[ 'result27' ],
      $mhqdata[ 'result29' ],
      $mhqdata[ 'result30' ],
      $mhqdata[ 'result32' ],
      $mhqdata[ 'result33' ],
    ];
  
  foreach($kodo_array as $k => $value){
    if($value > 80 ){
      $value = 80;
    }
    if($value <= 20 ){
      $value = 20;
    }

    $kodo_array[$k] = round($value/10,1)-2;
    $kodo_pt[$k] = round($value,1);
  }

$avg = array_sum($kodo_array)/count($kodo_array);
$avgs = [];
for($i=0;$i<count($kodo_array);$i++){
  //$avgs[] = $avg;
  $avgs[] = 3;
}
$kodo_array2 = $avgs;
     
$MyData = new pData2(); 

// スコアのデータセット 
$MyData->addPoints($kodo_array2,"ScoreB"); 
$MyData->setPalette("ScoreB",array("R"=>225,"G"=>10,"B"=>0, "Alpha"=>40)); 

$MyData->addPoints($kodo_array,"ScoreA"); 
$MyData->setSerieDescription("ScoreA","Application A"); 
$MyData->setPalette("ScoreA",array("R"=>65,"G"=>105,"B"=>225)); 




// チャートの項目 

// $MyData->addPoints([
//   "負荷",
//   "コントロール",
//   "ソーシャルサポート",
//   "ワークエンゲージメント",
//   "満足感",
//   "完ぺき主義",
//   "高自己期待",
//   "反すう傾向",
//   "反すう影響",
//   "情動対応行動",
//   "情動対応思考",
//   "問題回避行動",
//   "問題回避思考",
//   "問題対応行動",
//   "問題対応思考",
//   "抑うつ気分",
//   "コミュニケーション",
//   "社会的スキル",
//   "想像力",
//   "細部への注意",
//   "注意の切り替え",
//   "注意力自体",
//   "注意力影響",
// ],"Point"); 

$title = [
  "負荷",
  "コントロール",
  "ソーシャルサポート",
  "ワークエンゲージメント",
  "満足感",
  "完ぺき主義",
  "高自己期待",
  "反すう傾向",
  "反すう影響",
  "情動対応行動",
  "情動対応思考",
  "問題回避行動",
  "問題回避思考",
  "問題対応行動",
  "問題対応思考",
  "抑うつ気分",
  "コミュニケーション",
  "社会的スキル",
  "想像力",
  "細部への注意",
  "注意の切り替え",
  "注意力自体",
  "注意力影響",
];

//$MyData->setAbscissa("Point"); 

// グラフのサイズとデータセットを引数に渡してpChartオブジェクトを生成 
$myPicture = new pImage(580,480,$MyData); 

// フォンとサイズ、色のを切り替え 
$myPicture->setFontProperties(array("FontName"=>"/init/Fonts/TakaoGothic.ttf","FontSize"=>0,"R"=>255,"G"=>255,"B"=>255)); 

// レーダーチャート作成用オブジェクトを生成 
$SplitChart = new pRadar(); 

// レーダーチャートを書くX軸、Y軸、幅、高さ 
$myPicture->setGraphArea(30,30,580,460); 
// レーダーチャートのオプション 
$Options = array(
  "FixedMax"=>6, // データセットの最大値
  "WriteValues"=>FALSE, // データセットの値を表示 
  "DrawPoly"=>false, // データセットをつないだ領域を塗りつぶす 
  "Display"=>false,
  "AxisRotation"=>-90, // グラフの回転角度 
  "Layout"=>RADAR_LAYOUT_STAR, 
  "LabelPos"=>RADAR_LABELS_HORIZONTAL, // ラベルの表示形式(水平) 
  "BackgroundGradient"=> // レーダーチャート内のグラデーション 
      array( 
        "StartR"=>255,"StartG"=>255,"StartB"=>255, 
        "StartAlpha"=>100, 
        "EndR"=>255,"EndG"=>255,"EndB"=>255,"EndAlpha"=>50
      )
  
  );
  
// レーダーチャートを描く 
$SplitChart->drawRadar($myPicture,$MyData,$Options); 

// 描いたグラフの保存 
$myPicture->render($gimg1); 


function get_age($birth,$regdate){
  $reg1 = explode(" ",$regdate);
  $reg = explode("-",$reg1[0]);

  $ty = $reg[0];
  $tm = $reg[1];
  $td = $reg[2];
  list($by, $bm, $bd) = explode('-', $birth);
  $age = $ty - $by;
  if($tm * 100 + $td <= $bm * 100 + $bd) $age--;
  
  return $age;
}

function get_detail_array($point){
// ０：高
// １：中
// ２：低
// ２：理想化可能性あり
// １：理想化可能性ややあり
// ０以下：理想化可能性なし
  $point = abs($point);
  if($point == 2){
    $array['type'] = "低";
    $array['text'] = "理想化可能性あり";
  }else
  if($point == 1){
    $array['type'] = "中";
    $array['text'] = "理想化可能性ややあり";
  }else{
    $array['type'] = "高";
    $array['text'] = "理想化可能性なし";
  }
  return $array;
}