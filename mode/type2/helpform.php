<?PHP

if($_REQUEST[ 'send' ]){
	
	mb_language("Japanese");
	mb_internal_encoding("UTF-8");
	
	$to = D_FROM_MAIL;
	$subject = $sitename.'様からの問い合わせです';
	$message = $sitename.'様よりお問合せが届いております。

企業名:'.$sitename.'
ID:'.$id.'

▼お問合せ内容
'.$_REQUEST[ 'note' ].'

'.$invgfoot;

	$headers = 'From: '.D_FROM_MAIL. "\r\n";

	mb_send_mail($to, $subject, $message, $headers);
	
	
	$message1 =  "下記内容でお問合せいたしました。\n".$message;
	
	$to = $_SESSION[ 'rep_email' ];
	mb_send_mail($to, $subject, $message1, $headers);
	
	
	$message2 =  "下記内容でお問合せいたしました。\n".$message;
	$to = $_SESSION[ 'rep_email2' ];
	mb_send_mail($to, $subject, $message2, $headers);
	
	$_SESSION[ 'alert' ] = "問い合わせ内容メールの配信を行いました。";
	header("Location:/index/helpform/");
	exit();
}
?>
