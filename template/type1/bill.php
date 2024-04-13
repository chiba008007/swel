<?PHP
$css1 = "bill";
$title = "AMS:請求書発行画面";
$js[1] = "billmake";

include_once("include_header.php");
?>
<div id="main">
	<div id="contents">
		<h3>請求書発行画面</h3>
		<p id="billTitle">請求書</p>
		<form action="/index/bill/" method="POST" >
		<div class="leftbox">
			〒<input type="text" name="cus_post1" value="<?=$post1?>" id="pt1" >-
			<input type="text" name="cus_post2" value="<?=$post2?>" id="pt2" >
			<br />
			<input type="text" name="cus_address" value="<?=$address1?>" id="address" class="w350"><br />
			<input type="text" name="cus_address2" value="<?=$address2?>" id="address2" class="w350"><br />
			<input type="text" name="cus_name" value="<?=$name?>" id="name" class="w300"><br />
			<input type="text" name="cus_busyo" value="<?=$busyo?>" id="busyo" placeholder="部署を入力してください"><br />
			<input type="text" name="post" value="<?=$post?>" id="post" placeholder="役職名を入力してください">
			<input type="text" name="cus_tanto" value="<?=$tanto?>" id="tanto" >様
			<table id="tantotbl">
				<tr>
					<td colspan=2>
					<p>下記の通りご請求申し上げます。</p>
					</td>
				</tr>
				<tr>
					<th>請求金額</th>
					<td>\<input type="text" name="money" value="<?=$money?>" id="money" >消費税込</td>
				</tr>
				<tr>
					<th>件名</th>
					<td><input type="text" name="billtitle" value="" id="title" ></td>
				</tr>
				<tr>
					<th>御支払日</th>
					<td>
						<input type="text" name="pay_year" value="<?=$pay_year?>"  id="pay_year" >年　
						<input type="text" name="pay_month" value="<?=$pay_month?>"  id="pay_month">月　
						<input type="text" name="pay_day" value="<?=$pay_day?>"  id="pay_day"  >日
					</td>
				</tr>
				<tr>
					<th>御振込先</th>
					<td><input type="text" name="bank" value="<?=$pay_bank?>" id="bank">
						　口座番号<input type="text" name="bank_no" value="<?=$pay_num?>" id="bank_no">
					</td>
				</tr>
				<tr>
					<th>口座名義</th>
					<td><input type="text" name="kouza" value="<?=$pay_name?>" id="kouza" >
					</td>
				</tr>
			</table>
		</div>
		<div class="rightbox">
			<p id="billnumber">
				請求No.<input type="text" name="billnumber" value="<?=$billnumber?>" readonly >
			</p>
			<p id="billdate">
			<input type="text" name="year"  value="<?=$year?>" id="year" >年　
				<input type="text" name="month" value="<?=$month?>" id="month" >月　
				<input type="text" name="day"   value="<?=$day?>" id="day" >日
			<p>
			<div id="syahan"  ><img src="/images/innovation.gif"></div>
			<p id="billaddress">
			〒<input type="text" name="post1" value="<?=$company_post1?>"  maxlength=3 id="company_post1" >-
				<input type="text" name="post2" value="<?=$company_post2?>"  maxlength=4 id="company_post2" ><br />
				<input type="text" name="address" value="<?=$company_address?>" id="company_address" ><br />
				<input type="text" name="address2" value="<?=$company_address2?>" id="company_address" ><br />
				<input type="text" name="company" value="<?=$company_name?>" id="company_name" ><br />
				<input type="text" name="telnumber" value="<?=$telnumber?>" id="telnumber" >
			</p>

			<table align="right" id="tantohanko">
			<tr>
				<td>担当者</td>
			</tr>
			<tr>
				<td id="point"><div id="tanto_han" ><img src="/images/sasaki.gif" width=40 ></div></td>
			</tr>
			</table>
			<div id="hankochk">
				<label><input type="checkbox" name="syahan" value="on" id="syahan_chk"  >社判あり</label><br />
				<label><input type="checkbox" name="tantohan" value="on" id="tanto_chk" >担当判あり</label>
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
			foreach($paylist as $key=>$val){
?>
			<tr>
				<td class="center"><?=$i?></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][article]" value="<?=$val[ 'bill_name' ]?>" class="w300"  ></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][brand]" value="<?=$val[ 'bill_brand' ]?>"             ></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][standard]" value="<?=$val[ 'bill_kikaku' ]?>"           ></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][number]" value="<?=$val[ 'bill_count' ]?>" class="w30 c" id="cnt_<?=$i?>"></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][unit]" value="<?=$val[ 'bill_unit' ]?>"   class="w30"   ></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][unitprice]" value="<?=$val[ 'bill_money' ]?>" class="w40 m" id="mny_<?=$i?>"></td>
				<td class="center"><input type="text" name="bill[<?=$i?>][price]" value="<?=$val[ 'bill_price' ]?>" class="w80 p" id="pri_<?=$i?>" readonly></td>

			</tr>
<?PHP
			$i++;
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
	<textarea id="other" name="other"><?=$other?></textarea>
	</div>
	
	<br clear=all />

	<p id="center">
	<input type="button" name="close" value="閉じる" class="button3" id="close">
	<input type="submit" name="output" value="請求書作成"  class="button3"  id="output" >
	</p>
	<input type="hidden" name="pid" value="<?=$_REQUEST[ 'uid' ]?>">
	</form>
<?PHP
include_once("include_footer_name.php");
?>
</div>

<?PHP
include_once("include_footer.php");
?>
