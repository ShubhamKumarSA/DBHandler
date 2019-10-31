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
		
		$name=$_POST['txtName'];
		$email=$_POST['txtEmail'];
		$phone=$_POST['txtPhone'];
		$dob=$_POST['txtDOB'];
		$username=$_POST['txtUsername'];
		$password=$_POST['txtPassword'];
		
		$sql = "SELECT  *FROM user_details where username='".$username."'";
		$result = $link->query($sql);
		if ($result->num_rows > 0) {
				$_SESSION['name']=$name;
				$_SESSION['email']=$email;
				$_SESSION['phone']=$phone;
				$_SESSION['dob']=$dob;				
				$_SESSION['uname']=$username;
    			$AuthResponse='Username already exist. Try choosing different username.';
		} else {
			
			date_default_timezone_set('Asia/Kolkata');
			$currdate=date("Y-m-d");
			
			$sql="INSERT INTO user_details(name, email, phone, username, password, dob, reg_date) VALUES('".$name."','".$email."','".$phone."','".$username."','".$password."','".$dob."','".$currdate."')";
			if ($link->query($sql) === TRUE) {
				mysqli_close($link);
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
							<strong>Thank you!</strong> You're now registered for DBAccess.
							<br />
							<span style='color: blue; font-size: 14px;'>Please use your username and password to login on next screen.<br />Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
							<br /><br />
							<input type='button' onClick='Login();' class='gBox cNew' name='btnRegister' value='Login Here'>
						</div>
						</body>
						</html>
					";
				die();
			} else {
				$AuthResponse="We've have some issue while processing your request. Try again.";
			}
		}
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
                <div id="Title">DBAccess By DBHandler</div>
                <div id="Menus"><a href="../" title="DBHandler Home">Home</a>&nbsp;<a href="../about.php" title="About DBHandler">About</a>&nbsp;<a href="../contacts.php" title="Contact Us">Contacts</a></div>
            <hr>
            <br />
            <div id="Data">
				<form action='' method='post' enctype='multipart/form-data'>
                <table>
                	<tr>
                    	<td class="RespArea">Register to Use DBAccess</td>
                    </tr>
                    <tr>
                    	<td class="InnResp"><?php echo $AuthResponse; ?></td>
                    </tr>
                	<tr>
                    	<td>
                        	<span class='cBSpan'>Provide Complete Name</span><br />
							<input onFocus='RFocusON(0)' onBlur='RFocusOFF(0)' type='text' name='txtName' class='txtBox Care' title='Provide your complete name.' maxlength=200 value="<?php if(isset($_SESSION['name'])) { echo $_SESSION['name'];unset($_SESSION['name']);} ?>" required />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<span class='cBSpan'>Provide Email</span><br />
							<input onFocus='RFocusON(1)' onBlur='RFocusOFF(1)' type='email' name='txtEmail' class='txtBox Care' title='Provide your valid Email.' maxlength=500 value="<?php if(isset($_SESSION['ename'])) { echo $_SESSION['email'];unset($_SESSION['email']);} ?>" required />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<span class='cBSpan'>Provide Phone Number</span><br />
							<input onFocus='RFocusON(2)' onBlur='RFocusOFF(2)' type='text' name='txtPhone' class='txtBox Care' title='Provide your valid phone number.' maxlength=15 value="<?php if(isset($_SESSION['phone'])) { echo $_SESSION['phone'];unset($_SESSION['phone']);} ?>" required />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<span class='cBSpan'>Provide Date of Birth</span><br />
							<input onFocus='RFocusON(3)' onBlur='RFocusOFF(3)' type='date' name='txtDOB' class='txtBox Care' title='Provide your date of birth.' maxlength=20 value="<?php if(isset($_SESSION['dob'])) { echo $_SESSION['dob'];unset($_SESSION['dob']);} ?>" required />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<span class='cBSpan'>Provide Username</span><br />
							<input onFocus='RFocusON(4)' onBlur='RFocusOFF(4)' type='text' name='txtUsername' class='txtBox Care' title='Provide your desired username.' maxlength=20 value="<?php if(isset($_SESSION['uname'])) { echo $_SESSION['uname'];unset($_SESSION['uname']);} ?>" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<span class='cBSpan'>Provide Password</span><br />
							<input onFocus='RFocusON(5)' onBlur='RFocusOFF(5)' type='password' name='txtPassword' class='txtBox Care' title='Provide your desired password.' maxlength=20  required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        	<span class='cBSpan'>Confirm Password</span><br />
							<input onFocus='RFocusON(6)' onBlur='RFocusOFF(6); Match();' type='password' name='txtCPassword' class='txtBox Care' title='Provide your desired password.' maxlength=20 required />
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
                        	<input type='button' onClick="window.location='Login.php'" class='gBox cNew' name='btnLogin' value='Have a account, Login here'>
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