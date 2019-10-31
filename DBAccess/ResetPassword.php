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
		$email=$_POST['txtEmail'];
		$dob=$_POST['txtDOB'];
		$sql = "SELECT password FROM user_details where username='".$username."' and email='".$email."'and dob='".$dob."'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
    		$row = $result->fetch_assoc();
			$password=$row['password'];
				echo "
						<!doctype html>
						<html lang='en'>
						<head>
							<meta charset='UTF-8'>
							<title>Reset Password | DBAccess </title>
							<link rel='icon' href='../Images/DB_Bucket.png'> 
							<link rel='stylesheet' type='text/css' href='../Stylesheets/DBAStyle.css'>
							<script src='../Scripts/main_script.js'></script>
						</head>
						<body>
						<div id='Content'>
							<br /><br />
							Your Password is: <strong style='color: RED;'>".$password."<strong>
							<br />
							<span style='color: blue; font-size: 14px;'>Please use this password to login on next screen.<br />Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
							<br /><br />
							<input type='button' onClick='Login();' class='gBox cNew' name='btnRegister' value='Login Here'>
						</div>
						</body>
						</html>
					";
				die();
		} else {
			$AuthResponse='Invalid credentials.';
		}
	}
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password | DBAccess</title>
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
                    	<td class="RespArea">Reset Password</td>
                    </tr>
                    <tr>
                    	<td class="InnResp"><?php echo $AuthResponse; ?></td>
                    </tr>
                    <tr>
                    	<td>&nbsp;</td>
                    </tr>
                	<tr>
                    	<td><span class='cBSpan'>Enter Username</span><br />
							<input onFocus='PRFocusON(0)' onBlur='PRFocusOFF(0)' type='text' name='txtUsername' class='txtBox Care' title='Provide your Username.' maxlength=20 required />
                        </td>
                    </tr>
                    <tr>
                    	<td><span class='cBSpan'>Enter Email</span><br />
							<input onFocus='PRFocusON(1)' onBlur='PRFocusOFF(1)' type='email' name='txtEmail' class='txtBox Care' title='Provide your email.' maxlength=500 required />
                        </td>
                    </tr>
                    <tr>
                    	<td><span class='cBSpan'>Enter Date of Birth</span><br />
							<input onFocus='PRFocusON(2)' onBlur='PRFocusOFF(2)' type='date' name='txtDOB' class='txtBox Care' title='Provide your date of birth.' maxlength=15required />
                        </td>
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
                </table>
                </form>
            </div>
            <div id="Copy"><hr>&copy; 2018, DBHandler Team<br>All Right Reserved</div>
        </div>
</div>
</body>
</html>