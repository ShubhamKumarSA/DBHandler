<?php
ini_set('display_errors', 0);	//php Error Info Off
session_start();

$link = mysqli_connect("localhost", "dbhandler", "", "dbhandler");
if (!$link) {
	$_SESSION['status']='conerr';
	header( "Location: ../Care/");
    die();
}
if(isset($_SESSION["cPage"]))
{
	if($_SESSION["cPage"]=='support') {
		/**********Support Logic[Feedback]**********/
			
			if($_POST['btnSubmit']) {
				$name=str_replace("'","''",$_POST['txtName']);
				$email=str_replace("'","''",$_POST['txtEmail']);
				$phone=str_replace("'","''",$_POST['txtPhone']);
				$message=str_replace("'","''",$_POST['txtMessage']);
	
				$sql = "INSERT INTO feed_support (name, email, phone, message) VALUES ('".$name."', '".$email."','".$phone."','".$message."')";
				if ($link->query($sql) === TRUE) {
					mysqli_close($link);
 					$_SESSION['status']='supportokay';
					header( "Location: ../Care/");
					die();
				} else {
					mysqli_close($link);
					$_SESSION['status']='supporterr';
					header( "Location: ../Care/");
				}
			}
			
		/*******************************************/
	}
	else if($_SESSION["cPage"]=='qa') {
		/************Q/A Logic[Feedback]************/	
				
			if($_POST['btnSubmit_q']) {
				$question=str_replace("'","''",$_POST['txtQuestion']);
				
				$sql = "INSERT INTO question_answer(question) VALUES ('".$question."')";
				if ($link->query($sql) === TRUE) {
						mysqli_close($link);
						$_SESSION['status']='qokay';
						header( "Location: ../Care/?res=qaforum");
						die();
				} else {
						mysqli_close($link);
						$_SESSION['status']='qerr';
						header( "Location: ../Care/?res=qaforum");
				}
			}
			else if($_POST['btnSubmit_a']) {
				$qno=$_POST['txtQNo'];
				$answer=str_replace("'","''",$_POST['txtAnswer']);
				
				$sql = "UPDATE question_answer set answer='".$answer."' WHERE serial=".$qno;
				if ($link->query($sql) === TRUE) {
					if(mysqli_affected_rows($link)){
						mysqli_close($link);
						$_SESSION['status']='aokay';
						header( "Location: ../Care/?res=qaforum");
					}
					else {
						mysqli_close($link);
						$_SESSION['status']='aerr_no';
						header( "Location: ../Care/?res=qaforum");
						die();
					}
				} else {
						mysqli_close($link);
						$_SESSION['status']='aerr';
						header( "Location: ../Care/?res=qaforum");
				}
			}
		/*******************************************/
	}
	else
	{
		header( "Location: ../Care/" );
	}
}
else {
	header( "Location: ../Care/" );
}
mysqli_close($link);
unset($_SESSION['cPage']);
?>