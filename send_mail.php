<?php

$email_to = "info@hws.org.in";


$contact_page = "contact.html";
$thanks_page = "thankyou.html";


$username = $_REQUEST['username'] ;
$email_address = $_REQUEST['email_address'] ;
$message = $_REQUEST['message'] ;

$msg = 
"Name: " . $username . "\r\n" . 
"Email: " . $email_address . "\r\n" . 
"message': " . $message ;


function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}


if (!isset($_REQUEST['email_address'])) {
header( "Location: $contact_page" );
}


elseif (empty($username) || empty($email_address)) {
header( "Location: $contact_page" );
}


elseif ( isInjected($email_address) || isInjected($username)  || isInjected($message) ) {
header( "Location: $contact_page" );

}


else {

	mail( "$email_to", "Contact Form Results", $msg );
	header("Location: $thanks_page");
		
}
    
?>