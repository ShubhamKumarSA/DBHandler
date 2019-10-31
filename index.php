<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to DBHandler</title>
    <link rel="icon" href="Images/DB_Bucket.png"> 
    <link rel="stylesheet" type="text/css" href="Stylesheets/MainStyles.css">
    <script src="Scripts/main_script.js"></script>
</head>
<body>
    <div id="Page">
        <div id="Head">
            <div id="HeadIcon">DBHandler <img src="Images/DB_Bucket.png" width="20px" height="20px" class="blink" /></div>
            <div id="HeadMenu">
                    <a href="index.php" title="DBHandler Home">Home</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="about.php" title="About DBHandler">About</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="contacts.php" title="Contact Us">Contacts</a>
            </div>
        </div>
        <div id="Content">
        	<div id="WelcomePane">
                <div id="ContTitle">Welcome Back!</div>
                <div id="ContSubTitle">
                    <p>We've various things, which can help you in many ways</p>
                    <br />
                    <input onClick="window.location = 'QueryBuilder/'" type="button" class="gBox" value="Query Builder">
                    &nbsp;&nbsp;&nbsp;
                    <input onClick="window.location = 'TutorialsHub/'" type="button" class="gBox" value="Tutorial Hub">
                    &nbsp;&nbsp;&nbsp;
                    <input onClick="window.location = 'DBAccess/'" type="button" class="gBox" value="Database Handler">
                </div>
            </div>
            <div id="DataPane">
                <br />
            	<p id="pDP"><input onClick="window.location = 'Care/'" type="button" class="gBox CNew" value="Ask Us Anything"></p>
                <p id="p1DP">We at <strong>DBHandler</strong> provides academic services for students as well as advance services for database administrators<sup>Beta</sup>.</p>
                <p id="p2DP">Top Services and Features Offered<p>
                <ul id="ulDP">
                    <ul><b>Basic Features [Academics Related]</b>
                    <li>Sql query builder with advanced UI.</li>
                    <li>Precise and the best tutorials on various topics.</li>
                    <li>Q&amp;A support for learning and query builder module.</li>
                    </ul>
                    <br />
                    <ul><b>Advance Features</b>
                    <li>Web-database remote handling.</li>
                    <li>Support options for creating database, tables, views etc.</li>
                    <li>Advance support option for database handling issues.</li>
                    </ul>
                </ul>
            </div>
            <br />
        </div>
        <div id="Foot">
            <div id="SubsBar">
                <form method="post" action="Controller/Subscribe.php" runat="server">
                <input type="email" onFocus="doOpacityOn();" onBlur="doOpacityOff();" class="txtBox" name="subs_email" value="" required /><input type="submit" class="btnBox" name="subs_butt" value="Subscribe" />
                </form>
            </div>        	
            <div id="CopyNote">&copy; 2018, DBHandler Team<br>All Right Reserved</div>
        </div>
    </div>
    <?php
	session_start();
    if(isset($_SESSION["feedback"]))
    {
		if($_SESSION["feedback"]=="okay")
		{
			echo("<p id='subsmsg' align='center' style='color:white;height: 12px;'>Thank you for subscribing to our newsfeed.</b>&nbsp;&nbsp;<a href='index.php' title='Close' style='color:RED; text-decoration: none;'>Close</a></p>");
		}
		else if($_SESSION["feedback"]=="no")
		{
			echo("<p id='subsmsg' align='center' style='color:white;height: 12px;'>You've entered an invalid email address.</b>&nbsp;&nbsp;<a href='index.php' title='Close' style='color:red; text-decoration: none;'>Close</a></p>");			
		}
       /*
	   $qCommand=substr($_SERVER['QUERY_STRING'],0,3); 
       $qValue=substr($_SERVER['QUERY_STRING'],4); 
       if($qValue=='ok' && $qCommand=='cnf')
       {
           echo("<p id='subsmsg' align='center' style='color:green;height: 12px;'>Thank you for subscribing to our newsfeed.</b>&nbsp;&nbsp;<a href='index.php' title='Close' style='color:RED; text-decoration: none;'>Close</a></p>");
       }
       else if($qValue=='no' && $qCommand=='cnf')
       {
           echo("<p id='subsmsg' align='center' style='color:red;height: 12px;'>You've entered an invalid email address.</b>&nbsp;&nbsp;<a href='index.php' title='Close' style='color:RED; text-decoration: none;'>Close</a></p>");
       }
	   */
    }
	unset($_SESSION['feedback']);
?>
</body>
</html>