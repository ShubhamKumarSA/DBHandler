<?php
ini_set('display_errors', 0);	//php Error Info Off
session_start();
$ConSubTitle='';
$Data='';
$ServerResult='';
	if($_REQUEST['res']=='support')
	{
		$_SESSION["cPage"]='support';
		$ConSubTitle='Welcome to Support Forum';
		$DataPane="
					<form action='../Controller/CareSupport.php' method='post' enctype='multipart/form-data'>
						<table id='cTable'>
							<tr>
								<td>
								<span class='cBSpan'>Provide Complete Name</span><br />
								<input onFocus='FocusON(0);' onBlur='FocusOff(0);' type='text' name='txtName' class='txtBox Care' title='Provide your complete name.' maxlength=100 required />
								</td>
							</tr>
							<tr>
								<td>
								<span class='cBSpan'>Provide Email</span><br />
								<input onFocus='FocusON(1);' onBlur='FocusOff(1);' type='email' name='txtEmail' class='txtBox Care' title='Provide your valid email.' maxlength=250 required />
								</td>
							</tr>
							<tr>
								<td>
								<span class='cBSpan'>Provide Phone Number</span><br />
								<input onFocus='FocusON(2);' onBlur='FocusOff(2);' type='tel' name='txtPhone' class='txtBox Care' title='Provide your valid phone number.' maxlength=15 required />
								</td>
								<tr>
								<td>
								<span class='cBSpan'>Provide Message</span><br />
								<textarea required onFocus='FocusON(3);' onBlur='FocusOff(3);' name='txtMessage' class='msgArea' title='Write your query here.'>
								</textarea>
								</td>
							</tr>
								<td>
								<input type='submit' class='gBox cNew' name='btnSubmit' value='Submit'>
								&nbsp;&nbsp;
								<input type='reset' class='gBox cNew' value='Reset'>
								</td>
							</tr>
						</table>
					</form>
		";
	}
	else if($_REQUEST['res']=='qaforum')
	{
		$qResponse='Have any question in your mind, Ask here below';
		$aResponse='Have any answer in your mind for any question above, Share it below';
		if(isset($_SESSION["status"])) {
			if($_SESSION['status']=='qokay') {
				$qResponse="We've added your question to our forum.";
				unset($_SESSION['status']);
			}
			else if($_SESSION['status']=='qerr') {
				$qResponse="Oops! We're unable to add your question to our forum.";
				unset($_SESSION['status']);
			}
			else if($_SESSION['status']=='aokay') {
				$aResponse="We've added your answer to our forum.";
				unset($_SESSION['status']);
			}
			else if($_SESSION['status']=='aerr') {
				$aResponse="Oops! We're unable to add your answer to our forum.";
				unset($_SESSION['status']);
			}
			else if($_SESSION['status']=='aerr_no') {
				$aResponse="Oops! You may have entered wrong question number.";
				unset($_SESSION['status']);
			}
		}
		session_start();
		$_SESSION["cPage"]='qa';
		$QAResult='';
		/******************Q&A Retrieval*********************/
			$link = mysqli_connect("localhost", "dbhandler", "", "dbhandler");
			if (!$link) {
				$_SESSION['status']='conerr';
				header( "Location: ../Care/");
				die();
			}
			$sql = "SELECT serial, question, answer FROM question_answer";
			$result = $link->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					$QAResult=$QAResult."<span class='rQ'>Question [". $row["serial"]."]&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;" . $row["question"]."</span><br /><span class='rA'>Answer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[".$row["serial"]."]&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;".$row["answer"]."</span><br />";
				}
			} else {
				$QAResult='No questions or answer found.';
			}
		/****************************************************/
		$ConSubTitle='Welcome to Q&amp;A Forum';
		$DataPane="
				
						<table id='cTable'>
							<tr>
								<p class='tncFAQ'>Please post only relevant question or answer, any unrelevant content may be removed.</p>
							</tr>
							<tr>
								<p class='response'>". $qResponse ."</p>
							</tr>
							<form action='../Controller/CareSupport.php' method='post' enctype='multipart/form-data'>
							<tr>
								<td>
								<input type='text' name='txtQuestion' class='txtBox Care' title='Provide a valid question.' maxlength=1000 required />
								<br /><br />
								<input type='submit' class='gBox cNew' name='btnSubmit_q' value='Submit Question'>
								<hr>
								<br />
								<p class='QAHeader'>List of asked question and their answers:</p>
								<p class='QAResult'>". $QAResult ."</p>
								<br />
								</td>
							</tr>
							</form>
							<tr>
								<td><hr></td>
							</tr>
							<form action='../Controller/CareSupport.php' method='post' enctype='multipart/form-data'>
							<tr>
								<td>
									<p class='response'>". $aResponse ."</p>
								</td>
							</tr>
							<tr>
								<br />
								<td>
								<span class='cBSpan'>Provide Question Number</span><br />
								<input onFocus='FocusON(0);' onBlur='FocusOff(0);' type='text' name='txtQNo' class='txtBox Care' title='Provide a valid question number.' maxlength=5 required />
								</td>
							</tr>
							<tr>
								<td>
								<span class='cBSpan'>Provide Answer</span><br />
								<input onFocus='FocusON(1);' onBlur='FocusOff(1);' type='text' name='txtAnswer' class='txtBox Care' title='Provide a valid answer for repective question.' maxlength=1000 required />
								</td>
							</tr>
							<tr>
								<td><input type='submit' class='gBox cNew' name='btnSubmit_a' value='Submit Answer'></td>
							</tr>
							</form>
						</table>
		";
	}
	else if($_REQUEST['res']=='generic')
	{
		$ConSubTitle='Thank you for your interest in DBHandler';
		$DataPane="
			<div id='CareOption'>
				<input onClick='OpenLink1();' type='button' class='gBox cNew' value='Q&amp;A Forum'>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input onClick='OpenLink2();' type='button' class='gBox cNew' value='Support'>	
			</div>
		";
	}
	else
	{
		$ConSubTitle='Thank you for your interest in DBHandler';
		$DataPane="
					<div id='CareOption'>
						<input onClick='OpenLink1();' type='button' class='gBox cNew' value='Q&amp;A Forum'>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input onClick='OpenLink2();' type='button' class='gBox cNew' value='Support'>	
					</div>
		";
		if(isset($_SESSION["status"])) {
			if($_SESSION['status']=='conerr') {
				$ServerResult="<p class='response'>Oops! We're unable to communicate with our server, try again after in few seconds. <span class='btnX' OnClick='cInfoClose();'>X</span></p>";
				unset($_SESSION['status']);
			}
			else if($_SESSION['status']=='supportokay') {
				$ServerResult="<p class='response'>Thank you, We've recieved your support request. <span class='btnX' OnClick='cInfoClose();'>X</span></p>";
				unset($_SESSION['status']);
			}
			else if($_SESSION['status']=='supporterr') {
				$ServerResult="<p class='response'>Oops! We're unable to process your details, try again after in few seconds. <span class='btnX' OnClick='cInfoClose();'>X</span></p>";
				unset($_SESSION['status']);
			}
			else {
				unset($_SESSION['status']);
				header( "Location: ?res=generic" );
			}
		} else {
			unset($_SESSION['cPage']);
			header( "Location: ?res=generic" );	
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Care | DBHandler</title>
<link rel="icon" href="../Images/DB_Bucket.png"> 
<link rel="stylesheet" type="text/css" href="../Stylesheets/MainStyles.css">
<script src="../Scripts/main_script.js"></script>
</head>

<body>
<body>
    <div id="Page">
        <div id="Head">
            <div id="HeadIcon">DBHandler <img src="../Images/DB_Bucket.png" width="20px" height="20px" class="blink" /></div>
            <div id="HeadMenu">
                    <a href="../" title="DBHandler Home">Home</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="../about.php" title="About DBHandler">About</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="../contacts.php" title="Contact Us">Contacts</a>
            </div>
        </div>
        <div id="Content">
        	<div id="imgPane">
                <div id="ContTitle">Welcome Back To Care<strong> @ </strong>DBHandler</div>
                <div id="ContSubTitle"><?php echo $ConSubTitle; ?></div>
            </div>
            <div id="DataPane">
					<?php echo $DataPane; ?> 
            </div>
            <?php echo $ServerResult; ?>
         </div>
         <div id="Foot">       	
         <div id="CopyNote">&copy; 2018, DBHandler Team<br>All Right Reserved</div>
         </div>
	</div>
</body>
</html>