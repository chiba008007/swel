<?PHP
$css1 = "Bill";
$title = "AMS:請求書ダウンロード画面";
$js = array("billmake");

include_once("include_header.php");

?>

<div id="main">
	<div id="contents">
		<h3>請求書発行画面</h3>
		<p id="billTitle">請求書</p>
		<form action="/index/billpdf/" method="POST" >
		<div class="leftbox">
			〒<input type="text" name="cus_post1" value="<?=$main[0][ 'post1' ]?>" id="pt1" >-
			<input type="text" name="cus_post2" value="<?=$main[0][ 'post2' ]?>" id="pt2" >
			<br />
			<input type="text" name="cus_address" value="<?=$main[0][ 'prefecture' ]?><?=$main[0][ 'address1' ]?>" id="address" class="w350"><br />
			<input type="text" name="cus_address2" value="<?=$main[0][ 'address2' ]?>" id="address2" class="w350"><br />

			<input type="text" name="cus_name" value="<?=$main[0][ 'name' ]?>" id="name" class="w300"><br />
			<input type="text" name="cus_busyo" value="<?=$main[0][ 'busyo' ]?>" id="busyo" placeholder="部署を入力してください"><br />
			<input type="text" name="post" value="<?=$main[0][ 'post' ]?>" id="post" placeholder="役職名を入力してください">
			<input type="text" name="cus_tanto" value="<?=$main[0][ 'rep_name' ]?>" id="tanto" >様
			<table id="tantotbl">
				<tr>
					<td colspan=2>
					<p>下記の通りご請求申し上げます。</p>
					</td>
				</tr>
				<tr>
					<th>請求金額</th>
					<td>\<input type="text" name="money" value="<?=$main[0][ 'money_total' ]?>" id="money" >消費税込</td>
				</tr>
				<tr>
					<th>件名</th>
					<td><input type="text" name="billtitle" value="<?=$test[ 'name' ]?>" id="title" ></td>
				</tr>
				<tr>
					<th>御支払日</th>
					<td>
						<input type="text" name="pay_year" value="<?=$pay[0]?>"  id="pay_year" >年　
						<input type="text" name="pay_month" value="<?=$pay[1]?>"  id="pay_month">月　
						<input type="text" name="pay_day" value="<?=$pay[2]?>"  id="pay_day"  >日
					</td>
				</tr>
				<tr>
					<th>御振込先</th>
					<td><input type="text" name="bank" value="<?=$company[ '6' ]?>" id="bank">
						　口座番号<input type="text" name="bank_no" value="<?=$company[ '7' ]?>" id="bank_no">
					</td>
				</tr>
				<tr>
					<th>口座名義</th>
					<td><input type="text" name="kouza" value="<?=$company[ '0' ]?>" id="kouza" >
					</td>
				</tr>
			</table>
		</div>
		<div class="rightbox">
			<p id="billnumber">
				請求No.<input type="text" name="billnumber" value="<?=$number?>" readonly >
			</p>
			<p id="billdate">
			平成<input type="text" name="year"  value="<?=$date['y']?>" id="year"  >年　
				<input type="text" name="month" value="<?=$date['m']?>" id="month" >月　
				<input type="text" name="day"   value="<?=$date['d']?>" id="day"   >日
			<p>

<?PHP
			if( $main[0][ 'syahan_sts' ] == "on"){
				$disp = "block";
				$syahan_chk = "CHECKED";
			}else{
				$disp = "none";
				$syahan_chk = "";
			}
	
?>
			<div id="syahan" style="display:<?=$disp?>" ><img src="/images/innovation.gif"></div>
			<p id="billaddress">
			〒<input type="text" name="post1" value="<?=$company['1']?>"  maxlength=3 id="company_post1" >-
				<input type="text" name="post2" value="<?=$company[ '2' ]?>"  maxlength=4 id="company_post2" ><br />
				<input type="text" name="address" value="<?=$company[ '3' ]?>" id="company_address" ><br />
				<input type="text" name="address2" value="<?=$company[ '4' ]?>" style="width:250px;" ><br />
				<input type="text" name="company" value="<?=$company[ '0' ]?>" id="company_name" ><br />
				<input type="text" name="telnumber" value="<?=$company[ '8' ]?>" id="telnumber" >
			</p>

			<table align="right" id="tantohanko">
			<tr>
				<td>担当者</td>
			</tr>
			<tr>
<?PHP
				if( $main[0][ 'tantohan_sts' ] == "on"){
					$disp = "block";
					$tantohan_chk = "CHECKED";
				}else{
					$disp = "none";
					$tantohan_chk = "";
				}
?>
				<td id="point"><div id="tanto_han" style="display:<?=$disp?>" ><img src="/images/sasaki.gif" width=40 ></div></td>
			</tr>
			</table>
			<div id="hankochk">
				<label><input type="checkbox" name="syahan" value="on" id="syahan_chk"  <?=$syahan_chk?> >社判あり</label><br />
				<label><input type="checkbox" name="tantohan" value="on" id="tanto_chk" <?=$tantohan_chk?> >担当判あり</label>
			</div>
		</div>
		<br clear=all />
		<p>※振込手数料は、貴社負担にてお願い申し上げます。</p>

		<table id="table">
			<tbody>

			<tr>
				<th>No</th>
				<th>品名</th>
				<th>銘柄</th>
				<th>規格</th>
				<th>数量</th>
				<th>単位</th>
				<th>単価</th>
				<th>金額</th>
			</tr>
<?PHP
			$i=1;
			if(count($detail)){
			foreach($detail as $key=>$val){
?>
			<tr>
				<td class="center"><?=$i?></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][article]" value="<?=$val[ 'typename' ]?>" class="w300"  ></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][brand]" value="<?=$val[ 'brand' ]?>"             ></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][standard]" value="<?=$val[ 'kikaku' ]?>"           ></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][number]" value="<?=$val[ 'cnt' ]?>" class="w30 c" id="cnt_<?=$i?>"></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][unit]" value="<?=$val[ 'unit' ]?>"   class="w30"   ></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][unitprice]" value="<?=$val[ 'money' ]?>" class="w40 m" id="mny_<?=$i?>"></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][price]" value="<?=$val[ 'price' ]?>" class="w80 p" id="pri_<?=$i?>" readonly></td>

			</tr>
<?PHP
			$i++;
			}
			}
?>
			</tbody>
		</table>
		<p id="pbutton">
			<input type="button" value="行追加" id="add">
			<input type="button" value="行削除" id="del">
		</p>
	<br clear=all />
	※備考<br />
	<textarea id="other" name="other"><?=$main[0]['other']?></textarea>
	</div>
	<p id="center">
	<input type="button" name="close" value="閉じる" class="button3" id="close">
	<input type="submit" name="output" value="PDF登録"  class="button3"  id="output" >
	</p>
	<input type="hidden" name="bill_id" value="<?=$sec?>">



	</form>
<?PHP
include_once("include_footer_name.php");
?>
</div>
<?PHP
include_once("include_footer.php");
?>
