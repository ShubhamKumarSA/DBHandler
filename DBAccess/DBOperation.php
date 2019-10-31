<?php
session_start();
ini_set('display_errors', 0);	//php Error Info Off

$username='';
$showAction='';
$Response='';
date_default_timezone_set('Asia/Kolkata'); 
if(isset($_SESSION['DALogin'])) {
	if($_SESSION['DALogin']=='dalokay') {

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
					<span style='color: red; font-size: 14px;'>Your session has been expired please login again to use DBAccess+ by DBHandler.<br />Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
					<br /><br />
					<input type='button' onClick='Login();' class='gBox cNew' name='btnRegister' value='Login Here'>
				</div>
				</body>
				</html>
			";
			die();	
		}
		//Session Expiry Setup
			$_SESSION['start']=time();
			$_SESSION['expire']=$_SESSION['start'] + (10 * 60);
		//////////////////////
		//echo $_SESSION['db_host'];
		//echo $_SESSION['db_user'];
		//echo $_SESSION['db_pass'];
		//echo $_SESSION['db_name'];
		$username=$_SESSION['db_user'];
		$logintime=$_SESSION['logintime'];
		if($_SERVER['HTTP_REFERER']) {
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
			} else if($_REQUEST['doAction']=='ViewTables') {
				/**********Table Name Accessing********/
					$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
					$sql="SHOW TABLES";
					$result = $link->query($sql);
					$showAction="<span style='color: blue; background-color: white; text-decoration: underline; font-weight: bold'>Total Table In Database</span><br />";
					$loop=1;
					while($table = mysqli_fetch_array($result)) {
						  $showAction=$showAction.$loop.". ".$table[0] . "<br />";
						  $loop++;
					}
				/**************************************/
			} else if($_REQUEST['doAction']=='CreateTable') {
				if($_POST['btnCreateTable']) {
					$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
					$sql=$_POST['txtQuery'];
					$result = $link->query($sql);
					if($result) {
						$Response="<b style='color: #3DD1D8'>Table Created Successfully.</td>";
						goto goAfterErrorC;
					}
					else {
						$Response="Table cannot be created, please verify the table name, meta-data and syntax or try again.";
						goto goAfterErrorC;
					}
				} else {
					goAfterErrorC:
					$showAction="
						<form action='' method='post' enctype='multipart/form-data'>
							<table class='daTable'>
								<tr>
									<td><span class='headNote'>Write Create Table Query Below</span></td>
								</tr>
								<tr>
									<td><span class='QAlert'>".$Response."</span></td>
								</tr>
								<tr>
									<td>
										<img class='LogOut' onClick='AddSampleC();' src='../Images/add_example.png' width='15px' height='15px' title='Create Sample Code'>
										<textarea placeholder='e.g. CREATE TABLE <table name>( <Column Name> INT, <Column Name> VARCHAR, PRIMARY KEY ( <column name> ) );' name='txtQuery' class='msgArea' title='Write your query here.' required></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' name='btnCreateTable' value='Create Table' class='gBox cNew' />
									</td>
								</tr>
								<tr>
									<td>
										<input type='button' onClick='goQueryBuilder();' value='Visit Our Learning Portal QueryBuilder' class='gBox Link' />
									</td>
								</tr>
							</table>
						</form>
					";
				}
			} else if($_REQUEST['doAction']=='DropTable') {
				if($_POST['btnDropTable']) {
					if($_POST['btnCheck']=="Accept") {
						$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
						$sql="DROP TABLE ".$_POST['txtDTName'];
						$result = $link->query($sql);
						if($result) {
							$Response="<b style='color: #3DD1D8'>Table Dropped Successfully.</b>";
							goto goAfterErrorD;
						}
						else {
							$Response="Table cannot be dropped, please verify the table name or try again.";
							goto goAfterErrorD;
						}
					} else {
						$Response="Please accept the terms below to drop the table.";
						goto goAfterErrorD;
					}
				} else {
					goAfterErrorD:
					$showAction="
						<form action='' method='post' enctype='multipart/form-data'>
							<table class='daTable'>
								<tr>
									<td><span class='headNote'>Write Table Name Below To Drop</span></td>
								</tr>
								<tr>
									<td><span class='QAlert'>".$Response."</span></td>
								</tr>
								<tr>
									<td>
										<input type='text' class='txtBox' name='txtDTName' title='Write table name.' required></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<span class='accept'>This action can be undone, all your data will be lost.</span><br />
										<input type='checkbox' name='btnCheck' value='Accept'>Accept
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' name='btnDropTable' value='Drop Table' class='gBox cNew' />
									</td>
								</tr>
								<tr>
									<td>
										<input type='button' onClick='goQueryBuilder();' value='Visit Our Learning Portal QueryBuilder' class='gBox Link' />
									</td>
								</tr>
							</table>
						</form>
					";
				}
			} else if($_REQUEST['doAction']=='AlterTable') {
				if($_POST['btnAlterTable']) {
					$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
					$sql=$_POST['txtQuery'];
					$result = $link->query($sql);
					if($result) {
						$Response="<b style='color: #3DD1D8'>Table Altered Successfully.</td>";
						goto goAfterErrorA;
					}
					else {
						$Response="Table cannot be altered, please verify the table name, meta-data and syntax or try again.";
						goto goAfterErrorA;
					}
				} else {
					goAfterErrorA:
					$showAction="
						<form action='' method='post' enctype='multipart/form-data'>
							<table class='daTable'>
								<tr>
									<td><span class='headNote'>Write Alter Table Query Below</span></td>
								</tr>
								<tr>
									<td><span class='QAlert'>".$Response."</span></td>
								</tr>
								<tr>
									<td>
										<img class='LogOut' onClick='AddSampleA();' src='../Images/add_example.png' width='15px' height='15px' title='Create Sample Code'>
										<textarea placeholder='e.g. ALTER TABLE <table name> ADD <column name> <datatype>;' name='txtQuery' class='msgArea' title='Write your query here.' required></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' name='btnAlterTable' value='Alter Table' class='gBox cNew' />
									</td>
								</tr>
								<tr>
									<td>
										<input type='button' onClick='goQueryBuilder();' value='Visit Our Learning Portal QueryBuilder' class='gBox Link' />
									</td>
								</tr>
							</table>
						</form>
					";
				}
			} else if($_REQUEST['doAction']=='CountRecords') {
				if($_POST['btnCountRec']) {
					$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
					$sql="SELECT COUNT(*) AS 'CNT' FROM ".$_POST['txtCRName'];
					$result = $link->query($sql);
					if($result) {
						$row = $result->fetch_assoc();
						$totrec=$row['CNT'];
						$Response="<b style='color: #3DD1D8'>Total Records in [ ".$_POST['txtCRName']." ] : ".$totrec."</td>";
						goto goAfterErrorTR;
					}
					else {
						$Response="Records from table cannot be fetched, please verify the table name or try again.";
						goto goAfterErrorTR;
					}
				} else {
					goAfterErrorTR:
					$showAction="
						<form action='' method='post' enctype='multipart/form-data'>
							<table class='daTable'>
								<tr>
									<td><span class='headNote'>Write Table Name Below</span></td>
								</tr>
								<tr>
									<td><span class='QAlert'>".$Response."</span></td>
								</tr>
								<tr>
									<td>
										<input type='text' class='txtBox' name='txtCRName' title='Write table name.' required></textarea>
									</td>
								</tr>	
								<tr>
									<td>
										<input type='submit' name='btnCountRec' value='Count Records' class='gBox cNew' />
									</td>
								</tr>
								<tr>
									<td>
										<input type='button' onClick='goQueryBuilder();' value='Visit Our Learning Portal QueryBuilder' class='gBox Link' />
									</td>
								</tr>
							</table>
						</form>
					";
				}
			} else if($_REQUEST['doAction']=='tabINSERT') {
				if($_POST['btnINSERT']) {
					$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
					$sql=$_POST['txtQuery'];
					$result = $link->query($sql);
					if($result) {
						$Response="<b style='color: #3DD1D8'>Data Inserted Successfully.</td>";
						goto goAfterErrorI;
					}
					else {
						$Response="Data cannot be inserted, please verify the table name, values and syntax or try again.";
						goto goAfterErrorI;
					}
				} else {
					goAfterErrorI:
					$showAction="
						<form action='' method='post' enctype='multipart/form-data'>
							<table class='daTable'>
								<tr>
									<td><span class='headNote'>Write Insert Query Below</span></td>
								</tr>
								<tr>
									<td><span class='QAlert'>".$Response."</span></td>
								</tr>
								<tr>
									<td>
										<img class='LogOut' onClick='AddSampleI();' src='../Images/add_example.png' width='15px' height='15px' title='Create Sample Code'>
										<textarea placeholder='e.g. INSERT INTO <table name>(<column name>) VALUES(<values>);' name='txtQuery' class='msgArea' title='Write your query here.' required></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' name='btnINSERT' value='Insert Table' class='gBox cNew' />
									</td>
								</tr>
								<tr>
									<td>
										<input type='button' onClick='goQueryBuilder();' value='Visit Our Learning Portal QueryBuilder' class='gBox Link' />
									</td>
								</tr>
							</table>
						</form>
					";
				}
			} else if($_REQUEST['doAction']=='tabUPDATE') {
				if($_POST['btnUPDATE']) {
					$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
					$sql=$_POST['txtQuery'];
					$result = $link->query($sql);
					if($result) {
						$Response="<b style='color: #3DD1D8'>Data Updated Successfully.</td>";
						goto goAfterErrorU;
					}
					else {
						$Response="Data cannot be updated, please verify the table name, values and syntax or try again.";
						goto goAfterErrorU;
					}
				} else {
					goAfterErrorU:
					$showAction="
						<form action='' method='post' enctype='multipart/form-data'>
							<table class='daTable'>
								<tr>
									<td><span class='headNote'>Write Update Query Below</span></td>
								</tr>
								<tr>
									<td><span class='QAlert'>".$Response."</span></td>
								</tr>
								<tr>
									<td>
										<img class='LogOut' onClick='AddSampleU();' src='../Images/add_example.png' width='15px' height='15px' title='Create Sample Code'>
										<textarea placeholder='e.g. UPDATE <table name> SET <column name>=<value>;' name='txtQuery' class='msgArea' title='Write your query here.' required></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' name='btnUPDATE' value='Update Data' class='gBox cNew' />
									</td>
								</tr>
								<tr>
									<td>
										<input type='button' onClick='goQueryBuilder();' value='Visit Our Learning Portal QueryBuilder' class='gBox Link' />
									</td>
								</tr>
							</table>
						</form>
					";
				}
			} else if($_REQUEST['doAction']=='tabDELETE') {
				if($_POST['btnDELETE']) {
					$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
					$sql=$_POST['txtQuery'];
					$result = $link->query($sql);
					if($result) {
						$Response="<b style='color: #3DD1D8'>Data Deleted Successfully.</td>";
						goto goAfterErrorDel;
					}
					else {
						$Response="Data cannot be deleted, please verify the table name, values and syntax or try again.";
						goto goAfterErrorDel;
					}
				} else {
					goAfterErrorDel:
					$showAction="
						<form action='' method='post' enctype='multipart/form-data'>
							<table class='daTable'>
								<tr>
									<td><span class='headNote'>Write Delete Query Below</span></td>
								</tr>
								<tr>
									<td><span class='QAlert'>".$Response."</span></td>
								</tr>
								<tr>
									<td>
										<img class='LogOut' onClick='AddSampleD();' src='../Images/add_example.png' width='15px' height='15px' title='Create Sample Code'>
										<textarea placeholder='e.g. DELETE FROM <table name>;' name='txtQuery' class='msgArea' title='Write your query here.' required></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' name='btnDELETE' value='Delete Data' class='gBox cNew' />
									</td>
								</tr>
								<tr>
									<td>
										<input type='button' onClick='goQueryBuilder();' value='Visit Our Learning Portal QueryBuilder' class='gBox Link' />
									</td>
								</tr>
							</table>
						</form>
					";
				}
			} else if($_REQUEST['doAction']=='tabSELECT') {
				if($_POST['btnSELECT']) {
					$link = mysqli_connect($_SESSION['db_host'], $_SESSION['db_user'], $_SESSION['db_pass'], $_SESSION['db_name']);
					$sql=$_POST['txtQuery'];
					$result = $link->query($sql);
					if ($result->num_rows > 0) {
						$loop=1;
    					while($row=mysqli_fetch_row($result)){
							$Response=$Response.$loop.". ".$row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]." ".$row[5]." ".$row[6]." ".$row[7]." ".$row[8]." ".$row[9]." ".$row[10]." ".$row[11]." ".$row[12]." ".$row[13]." ".$row[14]." ".$row[15]." ".$row[16]." ".$row[17]." ".$row[18]." ".$row[19]." ".$row[20]."<br />";
							$loop++;
						}
						//$Response="<b style='color: #3DD1D8'>Data Fetching Successful.</td>";
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
								Select Query Result
								<br />
								<span style='color: green; font-size: 14px;'>Data fields are organised in chronological meta-data order.<br />Share your valuable feedback <a href='../Care/?res=support'>here</a><span>
								<br /><br />
								<p align='left' style='color: black; padding-left: 20px; font-size: 15px;'>".$Response."</p>
								<br /><br />
								<input type='button' onClick='DBOLogin();' class='gBox cNew' name='btnGoBack' value='Go Back'>
							</div>
							</body>
							</html>
						";
						exit();
					}
					else {
						$Response="No data found or cannot be fetched, please verify the table name, values and syntax or try again.";
						goto goAfterErrorS;
					}
				} else {
					goAfterErrorS:
					$showAction="
						<form action='' method='post' enctype='multipart/form-data'>
							<table class='daTable'>
								<tr>
									<td><span class='headNote'>Write Select Query Below</span></td>
								</tr>
								<tr>
									<td><span class='QAlert'>".$Response."</span></td>
								</tr>
								<tr>
									<td>
										<img class='LogOut' onClick='AddSampleS();' src='../Images/add_example.png' width='15px' height='15px' title='Create Sample Code'>
										<textarea placeholder='e.g. SELECT * FROM <table name>;' name='txtQuery' class='msgArea' title='Write your query here.' required></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<input type='submit' name='btnSELECT' value='Show Data' class='gBox cNew' />
									</td>
								</tr>
								<tr>
									<td>
										<input type='button' onClick='goQueryBuilder();' value='Visit Our Learning Portal QueryBuilder' class='gBox Link' />
									</td>
								</tr>
							</table>
						</form>
					";
				}
			}
		}
	} else {
		header( "Location: ../DBAccess/" );
	}
} else {
	header( "Location: ../DBAccess/" );
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>DBOperation | DBHandler</title>
    <link rel="icon" href="../Images/DB_Bucket.png"> 
    <link rel="stylesheet" type="text/css" href="../Stylesheets/DBOperation.css">
    <script src="../Scripts/dba_script.js"></script>
</head>
<body>

	<div id="Page">
        <div id="Head">
            <div id="HeadIcon">DBAccess By DBHandler <img src="../Images/DB_Bucket.png" width="20px" height="20px" class="blink" /></div>
        </div>
        <div id="Content">
        	<div class="TopMessage">Please do not press 'Back' or 'Refresh' button of your browser. Session will be expired on 10 minutes of inactivity.</div>
            <img class="LogOut" onClick="window.location='?q=logout'" src="../Images/Logout.png" width="30px" height="30px" title="Logout">
        	<div id="DBOLTime">Current login at: <span class="timeStamp"><mark><?php echo $logintime;?></mark></span></div>
        	<div id="DBOUInfo">Logged-in as: <span class="userStamp"><mark><?php echo $username;?></mark></span></div>
            <div id="Operations">
            	<div id="QuickOperation">
                	<span class="uLineHead">Try our quick operation tools</span><br />
                    <img onMouseOver="showVisuals(0,11);" onMouseOut="showVisuals(1,11);" onClick="window.location='?doAction=ViewTables';" class="quicktool" src="../Images/DBInfo.png" title="View List of Table in Database." alt="Show Tables" width="40px" height="40px" >
            		<img onMouseOver="showVisuals(0,22);" onMouseOut="showVisuals(1,22);" onClick="window.location='?doAction=CreateTable';" class="quicktool" src="../Images/Create.png" title="Create Table" alt="Create Table" width="40px" height="40px" >
                    <img onMouseOver="showVisuals(0,33);" onMouseOut="showVisuals(1,33);" onClick="window.location='?doAction=DropTable';" class="quicktool" src="../Images/Delete.png" title="Drop Table" alt="Drop Table" width="40px" height="40px" >
                    <img onMouseOver="showVisuals(0,44);" onMouseOut="showVisuals(1,44);" onClick="window.location='?doAction=AlterTable';" class="quicktool" src="../Images/Alter.jpg" title="Alter Table" alt="Alter Table" width="40px" height="40px" >
                    <img onMouseOver="showVisuals(0,55);" onMouseOut="showVisuals(1,55);" onClick="window.location='?doAction=CountRecords';" class="quicktool" src="../Images/Count.png" title="Count Records in Table" alt="Count Records" width="40px" height="40px" >
                    <br />
                    <img onMouseOver="showVisuals(0,66);" onMouseOut="showVisuals(1,66);" onClick="window.location='?doAction=tabSELECT';" class="quicktool" src="../Images/Select.png" title="Select Table Data" alt="Select Query" width="40px" height="40px" >
                    <img onMouseOver="showVisuals(0,77);" onMouseOut="showVisuals(1,77);" onClick="window.location='?doAction=tabINSERT';" class="quicktool" src="../Images/Insert.png" title="Insert Table Data" alt="Insert Query" width="40px" height="40px" >
            		<img onMouseOver="showVisuals(0,88);" onMouseOut="showVisuals(1,88);" onClick="window.location='?doAction=tabDELETE';" class="quicktool" src="../Images/Delete.png" title="Delete Table Data" alt="Delete Query" width="40px" height="40px" >
                    <img onMouseOver="showVisuals(0,99);" onMouseOut="showVisuals(1,99);" onClick="window.location='?doAction=tabUPDATE';" class="quicktool" src="../Images/Update.png" title="Update Table Data" alt="Update Query" width="40px" height="40px" >
                    <p id="Visuals">Please hover on the above icons to know more.</p>
                </div>
            </div>
            <br />
            <hr />
            <br />
        	<div id="Action">
				<?php 
                	echo $showAction;
                ?>
            </div>
        </div>
        <div id="Foot">       	
            <div id="CopyNote">&copy; 2018, DBHandler Team<br>All Right Reserved</div>
        </div>
    </div>

</body>
</html>