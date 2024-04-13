<?PHP
		//３要素を用いるストレス共生力算出画像判定
		$nthree = "off";
		$nthreeChk = "";
		
		if($detail[$key][ 'stress_flg' ]){
			$nthree = "on";
			$nthreeChk = "CHECKED";
		}
		if($_REQUEST[ 'stress' ][$key]){
			$nthree = "on";
			$nthreeChk = "CHECKED";
		}
		
		
		$nweight = "off";
		$chkWeight = "";
		$onWtbl = "onWtbl";
		if($detail[$key][ 'weight' ] == "0"){
			$nweight = "on";
			$chkWeight = "CHECKED";
			$onWtbl = "";
		}
		
		//重み付け
		if($_REQUEST[ 'weightchecked' ][$key]){
			$nweight = "on";
			$chkWeight = "CHECKED";
			$onWtbl = "";
		}

?>

<?PHP
	if($basetype == 1){
?>
	<div class="openBox">
		<div class="indent">
			<input type="checkbox" value="on" name="stress[<?=$key?>]" id="stress_<?=$key?>"  <?=$nthreeChk?>  >
		</div>
		<div style="float:left;margin-right:5px;">
			<img src="/images/checkbox_<?=$nthree?>.jpg" id="threeImg_<?=$key?>" class="onChkThreeImg">
		</div>
		<div style="float:left;" id="tImg_<?=$key?>" class="onChkThreeImg" >
			３要素を用いるストレス共生力算出
		</div>
		<br clear=all />

	</div>
<?PHP
	}
?>

<?PHP
//受検数・未受検数が同じ時のみ
//重みの変更をする
if(!$tCount){
	$class = "class='onChkWeightImg'";
	$read  = "";
}else
if($tCount[ 'jyuken' ] == $tCount[ 'mijyuken' ]){
	$class = "class='onChkWeightImg'";
	$read  = "";

}else{
	$class = "";
	$read  = "readonly";

}

?>
<script type="text/javascript">
$(function(){
   //初期思見つけデータを保存
   var _basewt = [];
   for(var _i=1;_i<=14;_i++){
       _basewt.push($("#wtw"+_i).val());
   }
   $(".masters").change(function(){
       var _val = $(this).val();
       var _id = $(this).attr("id").split("_");
       var _kcode = _id[1];
       var _url = "../<?=$first?>/<?=$sec?>";
       var _data = {
           type:'master'
           ,id:_val
       };
       $.ajax({
           url:_url
           ,data:_data
           ,type:'POST'
           ,success:function(_r){
                console.log(_r);
                var _obj = $.parseJSON(_r);
                
                if(_obj.length == 0){
                    $("#wtw1_"+_kcode).val(_basewt[1]);
                    $("#wtw2_"+_kcode).val(_basewt[1]);
                    $("#wtw3_"+_kcode).val(_basewt[2]);
                    $("#wtw4_"+_kcode).val(_basewt[3]);
                    $("#wtw5_"+_kcode).val(_basewt[4]);
                    $("#wtw6_"+_kcode).val(_basewt[5]);
                    $("#wtw7_"+_kcode).val(_basewt[6]);
                    $("#wtw8_"+_kcode).val(_basewt[7]);
                    $("#wtw9_"+_kcode).val(_basewt[8]);
                    $("#wtw10_"+_kcode).val(_basewt[9]);
                    $("#wtw11_"+_kcode).val(_basewt[10]);
                    $("#wtw12_"+_kcode).val(_basewt[11]);
                    $("#wtw13_"+_kcode).val(_basewt[12]);
                    $("#wtw14_"+_kcode).val(_basewt[13]);
                }else{
                    for(var _i=1;_i<=14;_i++){
                         var _ks = "w"+_i;
                       //  console.log("#wtw"+_i+"_"+_kcode);
                        $("#wtw"+_i+"_"+_kcode).val(_obj[_ks]);
                    }
                }
            }
       });
   }) ;
   
});


</script>

<?PHP

if($basetype == 1 && $download_excel[$id] &&  count($download_excel[$id] )){ ?>
	<div class="openBox">
 <select name="download_excel[<?=$key?>]" style="width:300px;">
 <option value="">エクセルの追加列の選択</option>
 <?php foreach($download_excel[$id] as $dkey=>$dval):?>
 <?php
    $sel = "";
    
    if($_REQUEST[ 'download_excel' ][$key] == $dkey){ $sel = "SELECTED"; 
    }else
    if($detail[$key][ 'download_excel' ] == $dkey) {
        $sel = "SELECTED";
    }
    
 
 ?>
 <option value="<?=$dkey?>" <?=$sel?>><?=$sitename?>(<?=$dval?>)<?=$download_excel_date[$id][ $dkey ]?></option>
 <?php endforeach; ?>
 </select>
		<br clear=all />
	</div>
<?PHP } ?>
<?php if($basetype == 2 && $first == "reg" && ($key == 72 || $key == 91)):?>
	<div style="margin-left:10px;">
		<table style="border-bottom:1px dashed #ccc; width:100%;">
			<tr>
					<th style="width:200px;">受検者ダウンロード設定</th>
					<td style="position:relative">
						<input type="checkbox" name="exam_download" value="1" id="exam_download"  style="width:20px;height:22px;margin-left:20px;" >
							<div style="position:absolute;top:0;left:40px;width:200px;">設定する</div>
					</td>
				</tr>
		</table>
		<input type="hidden" name="pdf[37]" value="on"  >
	</div>
	<?php endif; ?>
	<div class="openBox">
		<div class="__indent">
			<input type="checkbox" value="on" class="wtCheck" name="weightchecked[<?=$key?>]" id="weight_<?=$key?>"  <?=$chkWeight?> style="float:left;">
		</div>
            <!--
		<div style="float:left;margin-right:5px;">
			<img src="/images/checkbox_<?=$nweight?>.jpg" id="weightImg_<?=$key?>" <?=$class?> > 
		</div>
            -->
		<div style="float:left;"  id="wimg_<?=$key?>" >
			重付け【<?=$val?>】
		</div>
		<br clear=all />
                <span class="regMsg" id="weightSpan_<?=$key?>" >
                    重み付けを設定する場合は、各々数値を入力してください。入力する場合は、半角数字で入力してください。
                    <br />既存の重み付けマスタ、csvファイルから取得することも可能です。
                    <br />また、重み取得後、編集も可能です。
                </span>
                <br clear="all" />
                    <p>重みマスタからデータ取得</p>
                    <select class="masters" id="masters_<?=$key?>" name="masters">
                        <option value="">-</option>
                        <?PHP foreach($weight as $key2=>$val){ ?>
                        <option value="<?=$val[ 'id' ]?>"><?=$val[ 'master_name' ]?></option>
                        <?PHP } ?>
                    </select>
                    <p>CSVファイルからデータ取得</p>
                    <input type="file" name="csv" class="csv" id="csv_<?=$key?>">
                    <input class="hoge" type="hidden" value="hoge">
	</div>
	<?PHP
        $nn = "block";
        if($chkWeight){
            $nn = "block";
        }
        ?>
	<table class="wtable" id="weight_tbl_<?=$key?>" style="display:<?=$nn?>">
		<tr>
			<th><?=$a_element[ 'w1' ]?></th>
			<th><?=$a_element[ 'w2' ]?></th>
			<th><?=$a_element[ 'w3' ]?></th>
			<th><?=$a_element[ 'w4' ]?></th>
			<th><?=$a_element[ 'w5' ]?></th>
			<th><?=$a_element[ 'w6' ]?></th>
			<th><?=$a_element[ 'w7' ]?></th>
		</tr>
		<tr>
<?PHP
	if($_REQUEST[ 'weight' ][$key]['w1']){
		$w1 = $_REQUEST[ 'weight' ][$key]['w1'];
	}else{
		$w1 = $detail[ $key ][ 'w1' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w2']){
		$w2 = $_REQUEST[ 'weight' ][$key]['w2'];
	}else{
		$w2 = $detail[ $key ][ 'w2' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w3']){
		$w3 = $_REQUEST[ 'weight' ][$key]['w3'];
	}else{
		$w3 = $detail[ $key ][ 'w3' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w4']){
		$w4 = $_REQUEST[ 'weight' ][$key]['w4'];
	}else{
		$w4 = $detail[ $key ][ 'w4' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w5']){
		$w5 = $_REQUEST[ 'weight' ][$key]['w5'];
	}else{
		$w5 = $detail[ $key ][ 'w5' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w6']){
		$w6 = $_REQUEST[ 'weight' ][$key]['w6'];
	}else{
		$w6 = $detail[ $key ][ 'w6' ];
	}
	if($_REQUEST[ 'weight' ][$key]['w7']){
		$w7 = $_REQUEST[ 'weight' ][$key]['w7'];
	}else{
		$w7 = $detail[ $key ][ 'w7' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w8']){
		$w8 = $_REQUEST[ 'weight' ][$key]['w8'];
	}else{
		$w8 = $detail[ $key ][ 'w8' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w9']){
		$w9 = $_REQUEST[ 'weight' ][$key]['w9'];
	}else{
		$w9 = $detail[ $key ][ 'w9' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w10']){
		$w10 = $_REQUEST[ 'weight' ][$key]['w10'];
	}else{
		$w10 = $detail[ $key ][ 'w10' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w11']){
		$w11 = $_REQUEST[ 'weight' ][$key]['w11'];
	}else{
		$w11 = $detail[ $key ][ 'w11' ];
	}

	if($_REQUEST[ 'weight' ][$key]['w12']){
		$w12 = $_REQUEST[ 'weight' ][$key]['w12'];
	}else{
		$w12 = $detail[ $key ][ 'w12' ];
	}



	if($_REQUEST[ 'weight' ][$key]['ave']){
		$ave = $_REQUEST[ 'weight' ][$key]['ave'];
	}else{
		$ave = $detail[ $key ][ 'ave' ];
	}

	if($_REQUEST[ 'weight' ][$key]['sd']){
		$sd = $_REQUEST[ 'weight' ][$key]['sd'];
	}else{
		$sd = $detail[ $key ][ 'sd' ];
	}


?>
			<td><input type="text" name="weight[<?=$key?>][w1]" value="<?=$w1?>" <?=$read?> id="wtw1_<?=$key?>" ></td>
			<td><input type="text" name="weight[<?=$key?>][w2]" value="<?=$w2?>" <?=$read?> id="wtw2_<?=$key?>"></td>
			<td><input type="text" name="weight[<?=$key?>][w3]" value="<?=$w3?>" <?=$read?> id="wtw3_<?=$key?>"></td>
			<td><input type="text" name="weight[<?=$key?>][w4]" value="<?=$w4?>" <?=$read?> id="wtw4_<?=$key?>"></td>
			<td><input type="text" name="weight[<?=$key?>][w5]" value="<?=$w5?>" <?=$read?> id="wtw5_<?=$key?>"></td>
			<td><input type="text" name="weight[<?=$key?>][w6]" value="<?=$w6?>" <?=$read?> id="wtw6_<?=$key?>"></td>
			<td><input type="text" name="weight[<?=$key?>][w7]" value="<?=$w7?>" <?=$read?> id="wtw7_<?=$key?>"></td>
		</tr>
		<tr>
			<th><?=$a_element[ 'w8'  ]?></th>
			<th><?=$a_element[ 'w9'  ]?></th>
			<th><?=$a_element[ 'w10' ]?></th>
			<th><?=$a_element[ 'w11' ]?></th>
			<th><?=$a_element[ 'w12' ]?></th>
			<th>平均点</th>
			<th>標準偏差値</th>
		</tr>
		<tr>
			<td><input type="text" name="weight[<?=$key?>][w8]"  value="<?=$w8?>"  <?=$read?> id="wtw8_<?=$key?>" ></td>
			<td><input type="text" name="weight[<?=$key?>][w9]"  value="<?=$w9?>"  <?=$read?> id="wtw9_<?=$key?>" ></td>
			<td><input type="text" name="weight[<?=$key?>][w10]" value="<?=$w10?>" <?=$read?> id="wtw10_<?=$key?>"></td>
			<td><input type="text" name="weight[<?=$key?>][w11]" value="<?=$w11?>" <?=$read?> id="wtw11_<?=$key?>" ></td>
			<td><input type="text" name="weight[<?=$key?>][w12]" value="<?=$w12?>" <?=$read?> id="wtw12_<?=$key?>" ></td>
			<td><input type="text" name="weight[<?=$key?>][ave]" value="<?=$ave?>" <?=$read?> id="wtw13_<?=$key?>" ></td>
			<td><input type="text" name="weight[<?=$key?>][sd]"  value="<?=$sd?>"  <?=$read?> id="wtw14_<?=$key?>" ></td>
		</tr>
	</table>
	