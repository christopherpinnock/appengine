<?php
header('Content-type: text/plain');
$response='';	
if(isset($_POST[name])&&isset($_POST[email])&&isset($_POST[subject])&&isset($_POST[message])){
	$name=$_POST[name];
	$email=$_POST[email];
	$subject=$_POST[subject];
	$message=$_POST[message];
	if($email=='someone@example.com'||!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i",$email)){
        $response="Invalid email address\n";
    }
	if(!preg_match('/[a-zA-Z]/', $name)){
		$response.="Name must have letters\n";
	}
	if(strtolower($name)=='john doe'){
		$response.="You must include a name\n";
	}
	if(!preg_match('/[a-zA-Z]/', $subject)){
		$response.="Name must have letters\n";
	}
	if(strtolower($subject)=='i need your help...'){
		$response.="You must include a subject\n";
	}
	if(!preg_match('/[a-zA-Z]/', $message)){
		$response.="Message must include letters\n";
	}
	if(strtolower($message)=='You must include a message'){
		$response.="You must include a message\n";
	}
	if(strlen($message)<50){
		$response.="Message must have 50 characters or more";
	}
	if(isset($_POST[phone])){
		$phone=$_POST[phone];
		if(!(preg_match('/^[0-9]{3}[0-9]{3}[0-9]{4}$/', $phone)||preg_match('/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/', $phone))){
			$response."\nAcceptable phone number type: 000-000-000";
		}
	    
	}
	if(!$response){
		$subject=fix_string($subject);
		$name=fix_string($name);
		$mail='<table style="color:#000000;font-size:14px;font-family:arial,sans-serif;border:0px;border-collapse:collapse;border-spacing:0px;width:100%;padding:0px;table-layout:fixed;" cellspacing="0px" cellpadding="0px" border="0px"><tr><td>';
		$mail.='From: </td><td>'.$name;
		$mail.='</td></tr><tr>Email: </td><td>'.$email;
		if($phone){
			$mail.='</td></tr><tr>Phone: </td><td>'.fix_string($phone);
		}
		$mail.='</td></tr><tr>Subject: </td><td>'.$subject;
		$mail.='</td></tr><tr>Message: </td><td>'.fix_string($message);
		$mail.='</td></tr></table>';
		if(mail('business@example.com', $subject, $mail,"Content-type:text/html\r\n From:$name<$email>")){
			$response='sent';
		}else{
			$response='Fail to send message';
		}
		
	}
}else{
	$response='Contact form was not completed';
}
function fix_string($string){
	if(get_magic_quotes_gpc()){
		$string=stripslashes($string);
    }
    return htmlentities($string, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
echo $response;
?>