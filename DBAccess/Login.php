<?php
session_start();
ini_set('display_errors', 0);	//php Error Info Off

if(isset($_SESSION["dbaccess"]))
{
	if($_SESSION["dbaccess"]=='login_ok') {
		header( "Location: ../DBAccess/");
		exit();
	}
}

$AuthResponse;
if($_POST['btnSubmit']){
	$link = mysqli_connect("localhost", "dbhandler", "", "dbhandler");
	if (!$link) {
		$AuthResponse='Server not responding.';
	} else {
		$username=$_POST['txtUsername'];
		$password=$_POST['txtPassword'];
		$sql = "SELECT password, name FROM user_details where username='".$username."'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
    		$row = $result->fetch_assoc();
			if($row["password"]==$password){
				//Session Expiry Setup
				$_SESSION['start']=time();
				$_SESSION['expire']=$_SESSION['start'] + (5 * 60);
				//////////////////////
				$_SESSION["dbaccess"]='login_ok';
				$_SESSION['tokenUID']=$username;
				$_SESSION['tokenPWD']=$password;
				$_SESSION['tokenName']=$row["name"];
				header( "Location: ../DBAccess/");
				die();
			} else {
				$AuthResponse='Invalid password. Try again with valid credentials.';
			}
		} else {
			$AuthResponse='Invalid username. Try again with valid credentials.';
		}
	}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login | DBAccess</title>
<link rel="icon" href="../Images/DB_Bucket.png"> 
<link rel="stylesheet" type="text/css" href="../Stylesheets/DBAStyle.css">
<script src="../Scripts/main_script.js"></script>
</head>

<body>
<div id="Page">
        <div id="Content">
        	<div id="Title">DBAccess By DBHandler</div>
            <div id="Menus"><a href="../" title="DBHandler Home">Home</a>&nbsp;<a href="../about.php" title="About DBHandler">About</a>&nbsp;<a href="../contacts.php" title="Contact Us">Contacts</a></div>
            <hr>
            <br />
            <div id="Data">
				<form action='' method='post' enctype='multipart/form-data'>
                <table>
                	<tr>
                    	<td class="RespArea">Login To Access DBAccess</td>
                    </tr>
                    <tr>
                    	<td class="InnResp"><?php echo $AuthResponse; ?></td>
                    </tr>
                	<tr>
                    	<td><span class='cBSpan'>Enter Username</span><br />
							<input onFocus='LFocusON(0)' onBlur='LFocusOFF(0)' type='text' name='txtUsername' class='txtBox Care' title='Provide your Username.' maxlength=20 required />
                        </td>
                    </tr>
                    <tr>
                    	<td><span class='cBSpan'>Enter Password</span><br />
							<input onFocus='LFocusON(1)' onBlur='LFocusOFF(1)' type='password' name='txtPassword' class='txtBox Care' title='Provide your Password.' maxlength=20 required />
                        </td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td>
                        	<input type='submit' class='gBox' name='btnSubmit' value='Submit'>
							&nbsp;&nbsp;
							<input type='reset' class='gBox' value='Reset'>
                        </td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td>
                        	<input type='button' onClick="window.location='ResetPassword.php'" class='gBox cNew Reset' name='btnRPassword' value='Reset Your Password Here'>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<input type='button' onClick="window.location='Register.php'" class='gBox cNew' name='btnRegister' value='New User, Register Here'>
                        </td>
                    <tr>
                </table>
                </form>
            </div>
            <div id="Copy"><hr>&copy; 2018, DBHandler Team<br>All Right Reserved</div>
        </div>
</div>
</body>
</html>