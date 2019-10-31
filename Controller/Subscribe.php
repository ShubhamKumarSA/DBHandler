<?php
//Starting Session
session_start();
$_SESSION["feedback"];
$gourl_OK= "../index.php?cnf=ok#subsmsg"; 
$gourl_NO= "../index.php?cnf=no#subsmsg"; 	

$email=$_POST['subs_email'];

if($email<>"")
{
	$_SESSION["feedback"]="okay";
	$message_body=  "Subscriber Email Address: ".$email;
	mail( "support@example.com", "Mail Subscription Request", $message_body, 'From: '.$email );	
	header( "Location: $gourl_OK" );
}
else
{
	$_SESSION["feedback"]="no";
	header( "Location: $gourl_NO" );
}
//session_unset(); 
//session_destroy();
?>