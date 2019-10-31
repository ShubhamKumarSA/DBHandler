<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>QueryBuilder | DBHandler</title>
    <link rel="icon" href="../Images/DB_Bucket.png"> 
	<link rel="stylesheet" type="text/css" href="../Stylesheets/MainStyles.css">
</head>
<body>
	<div id="Page">
    	<div id="Head">
        	<div id="HeadIcon">DBHandler <img src="../Images/DB_Bucket.png" width="20px" height="20px" class="blink" /></div>
            <div id="HeadMenu">
                	<a href="../" title="DBHandler Home">Home</a>
                    &nbsp;&nbsp;&nbsp;
					<a href="index.php" title="QueryBuilder Home">QueryBuilder Home</a>
                    &nbsp;&nbsp;&nbsp;
                	<a href="../about.php?src=qbuilder" title="About DBHandler">About</a>
                    &nbsp;&nbsp;&nbsp;
                	<a href="../contacts.php?src=qbuilder" title="Contact Us">Contacts</a>
            </div>
        </div>
        <div id="Content">
        	<div id="ContTitle">QueryBuider</div>
            <div id="ContSubTitle">Welcome to QueryBuilder at DBHandler</div>
            <div id="DataPane">
            	<div id="lnkDP">
                	<input onClick="window.location = 'GenQuery.php?q=select'" type="button" title="Generate sql select query." class="gBox" value="Select Query" />
					&nbsp;&nbsp;&nbsp;
               		<input onClick="window.location='GenQuery.php?q=insert'" type="button" title="Generate sql insert query." class="gBox" value="Insert Query">
                    &nbsp;&nbsp;&nbsp;
               		<input onClick="window.location = 'GenQuery.php?q=delete'" type="button" title="Generate sql update query." class="gBox" value="Delete Query">
					&nbsp;&nbsp;&nbsp;
               		<input onClick="window.location = 'GenQuery.php?q=update'" type="button" title="Generate sql delete query." class="gBox" value="Update Query">
                </div>
                <br />
            	<hr />
				<div id="lnkDP_NA">
                	<span class="lnkDPtitle">ADVANCE SQL QUERIES</span>
                	<p>&darr; Some feature is not avalable currently. &darr;</p>
                	<input onClick="alert('This feature may available shortly.');" type="button" title="Create for advanced Select queries." class="gBox disable" value="Advance Select" />
					&nbsp;&nbsp;&nbsp;
               		<input onClick="alert('This feature may available shortly.');" type="button" title="Generate query for Create." class="gBox disable" value="Create Query">
                    &nbsp;&nbsp;&nbsp;
               		<input onClick="alert('This feature may available shortly.');" type="button" title="Generate query for Drop." class="gBox disable" value="Drop Query">
					&nbsp;&nbsp;&nbsp;
               		<input onClick="alert('This feature may available shortly.');"" type="button" title="Generate query for Alter." class="gBox disable" value="Alter Query">
                </div>
            </div>
            <br />
        </div>
        <div id="Foot">
        	<div id="FootLink">
            	<span class="linkspan">Quick Links:</span>
                &nbsp;
            	<a href="GenQuery.php?q=select" title="Generate sql select query.">Select Query</a>&nbsp;&nbsp;&nbsp;
                <a href="GenQuery.php?q=insert" title="Generate sql insert query.">Insert Query</a>&nbsp;&nbsp;&nbsp;
				<a href="GenQuery.php?q=update" title="Generate sql update query.">Update Query</a>&nbsp;&nbsp;&nbsp;
                <a href="GenQuery.php?q=delete" title="Generate sql delete query.">Delete Query</a>&nbsp;&nbsp;&nbsp;
            </div> 
        	<div id="CopyNote">&copy; 2018, DBHandler Team<br>All Right Reserved</div>
        </div>
    </div>
</body>
</html>