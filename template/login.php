<?PHP
$css1 = "login";
if($_COOKIE[ 'lang' ] == "ch" ){
	$title = "登录画面";
	$str1 = "推荐操作系统・推荐浏览器";
	$str2 = "为了安全舒适地使用，推荐使用下列操作系统及下列版本的浏览器。<br />如果使用推荐以外的因特网浏览器，或即使使用推荐的因特网浏览器也可能因客户设定的原因，不能使用或不能准确表示。";
	$str3 = "使用Windows时";
	$str4 = "推荐操作系统：Windows７以上";
	$str5 = "Microsoft Edge 最新版Microsoft Edge 最新版";
	$str6 = "Mozilla FireFox 最新版";
	$str7 = "Google Chrome最新版";
	$str8 = "Safari最新版";
	$str9 = "Javascript・cookie的设定";
	$str10 = "浏览器设定时让Javascript的设定有效。";
	$str11 = "Javascript的设定无效时，有可能不能正确工作或不能正确表示。";
	$str12 = "另外，有一部分使用cookie的内容。请和Javascript一样设定有效。";
	
}else{
	$title = "AMSログイン";
	$str1 = "推奨OS・推奨ブラウザ";
	$str2 = "安全で快適にご利用いただくために、下記OSと下記バージョンのブラウザのご利用をお勧めいたします。<br />推奨ウェブブラウザ以外でのご利用や、推奨ウェブブラウザでもお客さまの設定によっては、ご利用できない場合や正しく表示されない場合があります。";
	$str3 = "Windowsをお使いの場合";
	$str4 = "推奨OS：<br />　Windows10以上";
	$str5 = "推奨ブラウザ：<br />　Microsoft Edge 最新版";
	$str6 = "　Mozilla FireFox 最新版";
	$str7 = "　Google Chrome最新版";
	$str8 = "　<b class='mt20'>Macをお使いの場合</b>";
	$str9 = "Javascript・cookieの設定";
	$str10 = "ブラウザ設定でJavascriptの設定を有効にしてください。";
	$str11 = "Javascriptの設定を無効にされている場合、正しく機能しない、もしくは正しく表示されないことがあります。";
	$str12 = "また、一部cookieを利用したコンテンツがございます。Javascript同様設定を有効にしてください。";
}
$ver = getIEVersion();
include_once("include_header.php");
switch($_COOKIE[ 'lang' ]){
	case "jp":
		$check_jp = "CHECKED";
	break;
	case "ch":
		$check_ch = "CHECKED";
	break;
	default:
		$check_jp = "CHECKED";
	break;
}
if($_COOKIE[ 'lang' ]){
	$lang = $_COOKIE[ 'lang' ];
}else{
	$lang = "jp";
}
?>
<style type="text/css">
<!--
.f14{
	font-size:14px;
}
div.recommend{
	border:1px solid #ccc;
	padding:15px;
	margin:10px;
}
div.recommend p.red{
	color:red;
	border-bottom:1px solid #ccc;
}
div.recommend ul{
	list-style-type:none; 
	padding:0px 5px;
	margin:0;
}

div#brauz{
	border:1px solid #ff4500;
	padding:10px;
	background-color:#ffc0cb;
	color:#ff0000;
}
div.language{
	float:right;
	margin-bottom:10px;
}
.language input{
	display: none;
}
.language label{
	display: block;
	float: left;
	cursor: pointer;
	width: 80px;
	margin: 0;
	padding: 5px;
	border-right: 1px solid #abb2b7;
	background: #bdc3c7;
	color: #555e64;
	font-size: 11px;
	text-align: center;
	line-height: 1;
	transition: .2s;
}
.language label:first-of-type{
/*	border-radius: 3px 0 0 3px;*/
}
.language label:last-of-type{
	border-right: 0px;
	/*border-radius: 0 3px 3px 0;*/
}
.language input[type="radio"]:checked + label {
	background-color: #696969;
	color: #fff;
}

//-->
</style>
<script type="text/javascript" >
<!--
$(function() {
	if( !$.cookie("lang") ){
		$.cookie("lang", "jp", { expires: 365 });
	}
	$(".radio").click(function(){
		var _val = $(this).val();
		$.cookie("lang", _val, { expires: 365 });
		$("#langForm").submit();

	});

});
//-->
</script>

<div id="loginform">

	<div class="language">
		<form action="./" method="POST" id="langForm" >
		    <input name="language" id="select1" type="radio" class="radio" value="jp" <?=$check_jp?> >
		    <label for="select1">日本語</label>
		    <input name="language" id="select2" type="radio" class="radio" value="ch" <?=$check_ch?> >
		    <label for="select2">中国語</label>
		</form>
	</div>
	<br clear=all />
	<form method='post' action='./' >
			
			<div id="loginbox">
			<?php if($miss > 0 ):?>
			<table id="logtbl" align=center >
				<tr>
					<th><img src="/images/id.gif" /></th>
					<td><input type="text" name="username" class="logintext" maxlength=15 ></td>
				</tr>
				<tr>
					<th><img src="/images/password.gif" /></th>
					<td><input type="password" name="password" class="logintext" maxlength=15 ></td>
				</tr>
				<tr>
					<td colspan=2 ><div class="errmsg" style="color:red;"><?=$errmsg?></div></td>
				</tr>
				<tr>
					
					<td colspan=2 align=center><input type="submit" name="login" value="ログイン" id="loginbtn" /></td>
				</tr>
			</table>
			<?php else: ?>
				<div style="border:1px solid #000;padding:10px;">
					<p style="color:red;">
					IDまたはPASSWORDが異なります。<br />
					５分間ログインすることができません。<br />
					ID・PSAAWORDがご不明な場合は担当者にご確認ください。
				</p>
				</div>
			<?php endif; ?>


			</div>
	</form>
<div align=right>
<script language="JavaScript" TYPE="text/javascript" src="https://trusted-web-seal.cybertrust.ne.jp/seal/getScript?host_name=e-wel.com&type=21"></script>
</div>

	<div class="recommend" style="width:600px;">

					<p class="red f14">推奨OS・推奨ブラウザ</p>
					<p class="f14" >安全で快適にご利用いただくために、下記OSと下記バージョンのブラウザのご利用をお勧めいたします。<br />
					推奨ウェブブラウザ以外でのご利用や、推奨ウェブブラウザでもお客さまの設定によっては、ご利用できない場合や正しく表示されない場合があります。
					</p>
					<b class="mt20">Windowsをお使いの場合</b>
          <ul>
            <li>推奨OS:<br />　Windows10以上</li>
            <li>推奨ブラウザ:<br />　Microsoft Edge 最新版</li>
            <li>　Mozilla FireFox 最新版</li>
            <li>　Google Chrome最新版</li>
          </ul>
          <b class="mt20">Macをお使いの場合</b>
          <ul>
            <li>推奨OS：<br />　最新版</li>
            <li>推奨ブラウザ:<br />　Safari最新版</li>
          </ul>

					<p class="red f14">Javascript・cookieの設定</p>
					<p class="f14" >
						ブラウザ設定でJavascriptの設定を有効にしてください。<br />
						Javascriptの設定を無効にされている場合、正しく機能しない、もしくは正しく表示されないことがあります。<br />
						また、一部cookieを利用したコンテンツがございます。Javascript同様設定を有効にしてください。
					</p>

	</div>

</div>



<?PHP
include_once("include_footer.php");
function getIEVersion()
{
	$ua = $_SERVER["HTTP_USER_AGENT"];
	$results["browser"] = "";
	$results["version"] = "";
	if (preg_match("/Trident\/(\d{1,}(.\d{1,}){1,}?)/i", $ua, $mtcs)) {
	  $results["browser"] = "msie";
	  if ((float)$mtcs[1] >= 7) {
	    if (preg_match("/rv:(\d{1,}(.\d{1,}){1,}?)/i", $ua, $mtcs)) {
	      $results["version"] = (float)$mtcs[1];
	    } else {
	      $results["version"] = 11.0;
	    }
	  } elseif ((float)$mtcs[1] >= 6) {
	    $results["version"] = 10.0;
	  } elseif ((float)$mtcs[1] >= 5) {
	    $results["version"] = 9.0;
	  } elseif ((float)$mtcs[1] >= 4) {
	    $results["version"] = 8.0;
	  }
	}
	if (empty($results["browser"])) {
	  if (preg_match("/MSIE\s(\d{1,}(.\d{1,}){1,}?);/i", $ua, $mtcs)) {
	    $results["browser"] = "msie";
	    $results["version"] = (float)$mtcs[1];
	  }
	}
	return $results;
}
?>
