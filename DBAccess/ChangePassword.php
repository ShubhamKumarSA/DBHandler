<?php
session_start();
ini_set('display_errors', 0);	//php Error Info Off

if(isset($_SESSION["dbaccess"]))
{
	if($_SESSION["dbaccess"]=='login_ok') {
			if($_POST['btnSubmit']){
				$link = mysqli_connect("localhost", "dbhandler", "", "dbhandler");
				if (!$link) {
					$AuthResponse='Server not responding.';
				} else {
					$username=$_POST['txtUsername'];
					$currpassword=$_POST['txtCurrPassword'];
					$password=$_POST['txtPassword'];
					
					$sql = "UPDATE user_details SET password='".$password."' where username='".$username."' and password='".$currpassword."'";
					$link->query($sql);
					if (mysqli_affected_rows($link)) {
						echo "
								<!doctype html>
								<html lang='en'>
								<head>
								<meta charset='UTF-8'>
								<title>Register | DBAccess </title>
								<link rel='icon' href='../Images/DB_Bucket.png'> 
								<link rel='stylesheet' type='text/css' href='../Stylesheets/DBAStyle.css'>
								<script src='../Scripts/main_script.js'></script>
								</head>
								<body>
								<div id='Content'>
									<br /><br />
									<strong>Thank you!</strong> Your password has been changed.
									<br />
									<span style='color: blue; font-size: 14px;'>Please use your new password to login next time.<br />Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
									<br /><br />
									<input type='button' onClick='GoBack();' class='gBox cNew' name='btnGoBack' value='Back to DBAccess'>
								</div>
								</body>
								</html>
						";
						die();
					} else {
						$AuthResponse="Oops! You've entered an invalid username or current password, try again.";
					}
				}
			}
	} else {
		header( "Location: ../DBAccess/Login.php");
		exit();
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register | DBAccess</title>
<link rel="icon" href="../Images/DB_Bucket.png"> 
<link rel="stylesheet" type="text/css" href="../Stylesheets/DBAStyle.css">
<script src="../Scripts/main_script.js"></script>
</head>

<body>
<div id="Page">
        <div id="Content" class="RContent">
        	<div id="Menus">Welcome, <strong style="color:green"><?php echo $_SESSION['tokenName'] ?></strong></div>
            <br />
            <div id="Data">
				<form action='' method='post' enctype='multipart/form-data'>
                <table>
                	<tr>
                    	<td class="RespArea">Change DBAccess Password</td>
                    </tr>
                    <tr>
                    	<td class="InnResp"><?php echo $AuthResponse; ?></td>
                    </tr>
                    <tr>
                    	<td>
                        	<span class='cBSpan'>Provide Username</span><br />
							<input onFocus='CPFocusON(0)' onBlur='CPFocusOFF(0)' type='text' name='txtUsername' class='txtBox Care' title='Provide your desired username.' maxlength=20 required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<span class='cBSpan'>Provide Current Password</span><br />
							<input onFocus='CPFocusON(1)' onBlur='CPFocusOFF(1)' type='password' name='txtCurrPassword' class='txtBox Care' title='Provide your desired password.' maxlength=20  required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<span class='cBSpan'>Provide New Password</span><br />
							<input onFocus='CPFocusON(2)' onBlur='CPFocusOFF(2);' type='password' name='txtPassword' class='txtBox Care' title='Provide your desired password.' maxlength=20 required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<span class='cBSpan'>Confirm New Password</span><br />
							<input onFocus='CPFocusON(3)' onBlur='CPFocusOFF(3); Match();' type='password' name='txtCPassword' class='txtBox Care' title='Provide your desired password.' maxlength=20 required />
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
                        	<input type='button' onClick="window.location='../DBAccess/'" class='gBox cNew' name='btnBack' value='Back to DBAccess'>
                        </td>
                    <tr>
                </table>
                </form>
            </div>
            <div id="CopyRegister"><hr>&copy; 2018, DBHandler Team<br>All Right Reserved</div>
        </div>
</div>
</body>
</html>