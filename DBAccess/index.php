<?php
session_start();
ini_set('display_errors', 0);	//php Error Info Off
if($_SERVER['HTTP_REFERER'])
{
	if($_REQUEST['q']=='logout') {
		echo "
				<!doctype html>
				<html lang='en'>
				<head>
					<meta charset='UTF-8'>
					<title>Logout | DBAccess </title>
					<link rel='icon' href='../Images/DB_Bucket.png'> 
					<link rel='stylesheet' type='text/css' href='../Stylesheets/DBAStyle.css'>
					<script src='../Scripts/main_script.js'></script>
				</head>
				<body>
				<div id='Content'>
					<br /><br />
					Logout successful.
					<br />
					<span style='color: blue; font-size: 14px;'>You've been successfully logged-out from DBAccess by DBHandler.<br />Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
					<br /><br />
					<input type='button' onClick='Login();' class='gBox cNew' name='btnRegister' value='Login Here'>
				</div>
				</body>
				</html>
			";
		unset($_SESSION['dbaccess']);
		unset($_SESSION['DALogin']);
		die();
	} else if($_REQUEST['q']=='pnpNotes') {
		echo "
				<!doctype html>
				<html lang='en'>
				<head>
					<meta charset='UTF-8'>
					<title>Privacy and Policy | DBAccess </title>
					<link rel='icon' href='../Images/DB_Bucket.png'> 
					<link rel='stylesheet' type='text/css' href='../Stylesheets/DBAStyle.css'>
					<script src='../Scripts/main_script.js'></script>
				</head>
				<body>
				<div id='Content'>
					<br /><br />
					Terms and Conditions
					<br />
					<span style='color: blue; font-size: 14px;'>By continuing to use this service you must agree with our several policies and terms of use.<br />Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
					<br /><br />
					<p align='left' style='color: black; padding-left: 20px; font-size: 15px;'>&bull; You can use this web-portal to easily manage your databases.<br />&bull; For users privacy point of view, we do not store sensitive informations like usernames and passwords.<br />&bull; All services provided 'as is' basis and does not contain any guarantee for data and database protection.<br />&bull; All data and database handling are part of user-risk basis, any claim on data loss will not be entertained.</p>
					<br /><br />
					<input type='button' onClick='GoBack();' class='gBox cNew' name='btnGoBack' value='Go Back'>
				</div>
				</body>
				</html>
			";
			die();
	} else if($_REQUEST['q']=='history') {
		if(isset($_SESSION["dbaccess"])) {
				if($_SESSION["dbaccess"]=='login_ok') {
					$history_log='';
					$loop=1;
					/****************DB History View*************/
						$link = mysqli_connect("localhost", "dbhandler", "", "dbhandler");
						$sql="SELECT *FROM dbaccess_log WHERE web_user='".$_SESSION["tokenUID"]."'";
						$result = $link->query($sql);
						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
								$history_log=$history_log.$loop."). <span style='color: green'>Host Name: </span>".$row['hostname']." <span style='color: green'>Database: </span>".$row['dbname']." <span style='color: green'>Access Time: </span>".$row['accesstime']."<br />";
								$loop++;
							}
						}
						else  {
							
						}
					/********************************************/
					echo "
						<!doctype html>
						<html lang='en'>
						<head>
							<meta charset='UTF-8'>
							<title>History | DBAccess </title>
							<link rel='icon' href='../Images/DB_Bucket.png'> 
							<link rel='stylesheet' type='text/css' href='../Stylesheets/DBAStyle.css'>
							<script src='../Scripts/main_script.js'></script>
						</head>
						<body>
						<div id='Content'>
							<br /><br />
							DBAccess History Log
							<br />
							<span style='color: blue; font-size: 14px;'>Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
							<br /><br />
							<p align='left' style='color: black; padding-left: 20px; font-size: 15px;'>
							".$history_log."
							</p>
							<br /><br />
							<input type='button' onClick='GoBack();' class='gBox cNew' name='btnGoBack' value='Go Back'>
						</div>
						</body>
						</html>
					";
					die();
				} else {
					header( "Location: ../DBAccess/");
				}
		} else  {
			header( "Location: ../DBAccess/");
		}
	}
}
if(isset($_SESSION["dbaccess"]))
{
	if($_SESSION["dbaccess"]=='login_ok') {
		$now=time();
		if($_SESSION['expire']<$now) {
			unset($_SESSION['dbaccess']);
			unset($_SESSION['DALogin']);
			echo "
				<!doctype html>
				<html lang='en'>
				<head>
					<meta charset='UTF-8'>
					<title>Session Expired | DBAccess </title>
					<link rel='icon' href='../Images/DB_Bucket.png'> 
					<link rel='stylesheet' type='text/css' href='../Stylesheets/DBAStyle.css'>
					<script src='../Scripts/main_script.js'></script>
				</head>
				<body>
				<div id='Content'>
					<br /><br />
					Session Expired.
					<br />
					<span style='color: red; font-size: 14px;'>Your session has been expired please login again to use DBAccess by DBHandler.<br />Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
					<br /><br />
					<input type='button' onClick='Login();' class='gBox cNew' name='btnRegister' value='Login Here'>
				</div>
				</body>
				</html>
			";
			die();
		} else {
			if(isset($_SESSION["tokenUID"]) && isset($_SESSION["tokenPWD"])) {
				$NameOfUser=$_SESSION['tokenName'];
				/*********************SERVICE PROVIDING PANEL************************/
				if(isset($_SESSION['DALogin'])) {
					if($_SESSION['DALogin']=='dalokay') {
						header( "Location: DBOperation.php");
						die();
					}
				}
				$DAResponse='';
					if($_POST['btnAuth']) {
						
						$link = mysqli_connect("localhost", "dbhandler", "", "dbhandler");
						//$dbprovider=$_POST['seldbP'];
						$hostname=$_POST['txtHostName'];
						$dbname=$_POST['txtDBName'];
						$dbuser=$_POST['txtDBUser'];
						$dbpwd=$_POST['txtDBPassw'];
						date_default_timezone_set('Asia/Kolkata');
						$datetime=date("Y-m-d h:i:sa");
						
						$sql="INSERT INTO dbaccess_log(web_user, hostname, dbname, accesstime) VALUES('".$_SESSION['tokenUID']."','".$hostname."','".$dbname."','".$datetime."')";
						if ($link->query($sql) === TRUE) {
								mysqli_close($link);
								/************Authenticating Database Access Request**************/
									//if($dbprovider==1) {}
									$conn=mysqli_connect($hostname, $dbuser, $dbpwd, $dbname);
									if(!$conn) {
										$DAResponse="Oops! We're unable to establish connection with your host. Try again in few moments.";
										//$DAResponse="Oops! Your host is not responding at this moment. ";
									} else {
										$_SESSION['DALogin']='dalokay';
										$_SESSION['logintime']=$datetime;
										/******Session Stroring**********/
										$_SESSION['db_host']=$hostname;
										$_SESSION['db_user']=$dbuser;
										$_SESSION['db_pass']=$dbpwd;
										$_SESSION['db_name']=$dbname;
										/********************************/
										header( "Location: DBOperation.php");
										die();
									}
								/****************************************************************/
						} else {
							$DAResponse="We're sorry, your request cannot be processed right now.";
						}
					}
				/********************************************************************/
			}
			else {
				session_unset();
				header( "Location: Login.php");
				die();
			}
		}
	} else {
		header( "Location: Login.php");
		die();
	}
}
else
{
	header( "Location: Login.php");
	die();
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DBAccess | DBHandler</title>
    <link rel="icon" href="../Images/DB_Bucket.png"> 
    <link rel="stylesheet" type="text/css" href="../Stylesheets/MainStyles.css">
    <script src="../Scripts/main_script.js"></script>
    <script src="../Scripts/dba_script.js"></script>
</head>
<body>
	<div id="Page">
    	<div id="Head">
        	<div id="HeadIcon">DBHandler <img src="../Images/DB_Bucket.png" width="20px" height="20px" class="blink" /></div>
            <div id="User"><?php  echo("Welcome, ".$NameOfUser);?></div>
            <div id="HeadMenu">
                	<a href="../" title="DBHandler Home">Home</a>
                    &nbsp;&nbsp;&nbsp;
					<a href="index.php" title="DBAccess Home">DBAccess Home</a>
                    &nbsp;&nbsp;&nbsp;
                	<a href="../about.php" title="About DBHandler">About</a>
                    &nbsp;&nbsp;&nbsp;
                	<a href="../contacts.php" title="Contact Us">Contacts</a>
            </div>
        </div>
        <div id="Content" class="DBAPage">
        	<div id="ULOPanel"><img class="LogOut" onClick="window.location='ChangePassword.php'" src="../Images/Password.png" width="30px" height="25px" title="Change Password"><img class="LogOut" onClick="window.location='?q=history'" src="../Images/history.png" width="30px" height="25px" title="View History"><img class="LogOut" onClick="window.location='?q=logout'" src="../Images/Logout.png" width="25px" height="25px" title="Logout"></div>
            <div id="DAPane">
            	<div id="DATitle">DBAccess</div>
            	<div id="DASubTitle">Please note that this service only for authorised database administrators.<br><span class="ppAlert">By continuing to use this service you agree to accept our <a href="?q=pnpNotes" title="Click here to read our privacy and policy.">privacy and policy</a> for using this service.</span></div>
                <hr /><br />
                <div id="DAContent">
                	<form action='' method='post' enctype='multipart/form-data'>
									<table class='daTable'>
										<tr>
											<td class='daTabHead'>Provide few basic details to continue.</td>
										</tr>
                                        <tr>
                                        	<td><?php echo $DAResponse; ?></td>
                                        </tr>
										<tr>
											<td>
												Choose Database Provider<br />
												<select class='ddBox da'  name='seldbP' id='seldbP' onChange='SayInfo();' required>
													<option value='1' selected>MySQL</option>
													<option value='2'>Oracle DB</option>
													<option value='3'>Microsoft SQL Server</option>
													<option value='4'>Other</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<span class='cBSpan'>Provide Database Host Name</span><br />
												<input onFocus='DAFocusON(0);' onBlur='DAFocusOff(0);' type='text' name='txtHostName' class='txtBox da' title='Provide database host name.' required />
											</td>
										</tr>
										<tr>
											<td>
												<span class='cBSpan'>Provide Database Username</span><br />
												<input  onFocus='DAFocusON(1);' onBlur='DAFocusOff(1);' type='text' name='txtDBUser' class='txtBox da' title='Provide your database username.' required /><br /><span class='tdMsg'> (We do not store username.)</span>
											</td>
										</tr>
										<tr>
											<td>
												<span class='cBSpan'>Provide Database Password</span><br />
												<input  onFocus='DAFocusON(2);' onBlur='DAFocusOff(2);' type='password' name='txtDBPass' class='txtBox da' title='Provide your database password.' /><br />
												<span class='tdMsg'> (We do not store password.)</span>
											</td>
										</tr>
										<tr>
											<td>
												<span class='cBSpan'>Provide Database Name</span><br />
												<input  onFocus='DAFocusON(3);' onBlur='DAFocusOff(3);' type='text' name='txtDBName' class='txtBox da' title='Provide your database name.' required />
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>
												<input type='submit' class='gBox' name='btnAuth' value='Continue'>
											</td>
										</tr>
									</table>
								</form>
                </div>
           	</div>
        </div>
        <div id="Foot">     	
        	<div id="CopyNote">&copy; 2018, DBHandler Team<br>All Right Reserved</div>
        </div>
    </div>
</body>
</html>