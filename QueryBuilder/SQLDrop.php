<?php

			//Head Creation
			date_default_timezone_set('Asia/Kolkata');
			$head='<strong>'.'Update'.'</strong>'.' Query Result';
			$subhead="This query has been genrated on <mark>". date("Y-m-d h:i:sa")."</mark>";
			
			//Data Fetching
			$TableName=$_POST['txtTabName'];
			$TotCol=$_POST['txtColNumber'];
			$postSETVAL='';
			//$postColVal='';
			for($i=1;$i<=$TotCol;$i++)
			{
				$tempColName="txtColumn".$i."Name";
				$tempColVal="txtColumn".$i."Value";
				if($i==1)
				{
					$postSETVAL=$postSETVAL.'SET '.$_POST[$tempColName]."='".$_POST[$tempColVal]."', ";
					//$postColVal=$postColVal."'".$_POST[$tempColVal]."'";
				}
				else
				{
					$postSETVAL=$postSETVAL.$_POST[$tempColName]."='".$_POST[$tempColVal]."', ";
					//$postColVal=$postColVal.", '".$_POST[$tempColVal]."'";
				}
			}
			$ddQueryType=$_POST['ddQType'];
			if($ddQueryType=="1")
			{
				$QueryHTML='UPDATE '.$TableName.' '.substr($postSETVAL, 0, -2).';';
			}
			else
			{
				$WhereColName=$_POST['txtWColName'];
				$WhereType=$_POST['ddWhereOpt'];
				$WhereData=$_POST['txtData'];
				if($WhereType=="1") {
					$QueryHTML='UPDATE '.$TableName.' '.substr($postSETVAL, 0, -2)." WHERE ".$WhereColName." = '".$WhereData."';";
				}
				else if($WhereType=="2") {
					$QueryHTML='UPDATE '.$TableName.' '.substr($postSETVAL, 0, -2)." WHERE ".$WhereColName." > '".$WhereData."';";					
				}
				else if($WhereType=="3") {
					$QueryHTML='UPDATE '.$TableName.' '.substr($postSETVAL, 0, -2)." WHERE ".$WhereColName." < '".$WhereData."';";
				}
				else if($WhereType=="4") {
					$QueryHTML='UPDATE '.$TableName.' '.substr($postSETVAL, 0, -2)." WHERE ".$WhereColName." >= '".$WhereData."';";
				}
				else if($WhereType=="5") {
					$QueryHTML='UPDATE '.$TableName.' '.substr($postSETVAL, 0, -2)." WHERE ".$WhereColName." <= '".$WhereData."';";
				}
				else if($WhereType=="6") {
					$QueryHTML='UPDATE '.$TableName.' '.substr($postSETVAL, 0, -2)." WHERE ".$WhereColName." LIKE '%".$WhereData."%';";
				}
			}
			$ReturnBtn="<a style='text-decoration:none;' href='GenQuery.php?q=update' title='Generate Another Update Query'><input type='button' class='btnNew' value='Generate Another Query' /></a>";
			$QLearn="<p class='InformInfo'>Would you like to learn more about <strong>update</strong> query, <a href='../TutorialsHub/Sql_UpdateQuery.php' title='Learn Update Query'>click here</a></p>";
	
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>SQL Drop Query Generator | DBHandler</title>
    <link rel="icon" href="../Images/DB_Bucket.png"> 
	<link rel="stylesheet" type="text/css" href="../Stylesheets/MainStyles.css">
    <link rel="stylesheet" type="text/css" href="../Stylesheets/query_gen.css">
    <script src="../Scripts/query_gen.js" language="javascript"></script>
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
                	<a href="../About.php?src=qbuilder" title="About DBHandler">About</a>
                    &nbsp;&nbsp;&nbsp;
                	<a href="../Contacts.php?src=qbuilder" title="Contact Us">Contacts</a>
            </div>
        </div>
        <div id="Content">
        	<div id="q_typeHead">DROP QUERY GENERATOR</div>
          	<div id="q_typeSubHead">Please provide us some basic information so that we can generate <strong>SQL Drop</strong> query for you.</div>
            <br />
            <div id="QuickQueryPane">
                	<form action='' method='post' enctype='multipart/form-data'>
								<tr>
									<td>
                                    	<strong>Provide Table Name </strong>
                                    </td>
                                    <td>
                                        <input type='text' name='txtTabName' class='txtBox' title='Provide table name of database.' maxlength=100 required />
                                    </td>
								</tr>
                                <tr>
                                	<td>
                                    	<input type='submit' name='btnGenQuery' class='btnNew' value='Generate Query' />
                                    </td>
                                </tr>
                	</form>
			</div>
            <br /><br />
                <div id="QuickQueryPane">
                    <textarea id="QueryArea" readonly>
                    	<?php echo $QueryHTML; ?>
                    </textarea>
                    <br />
                    <input type="button" class='btnNew' id="Switch" value="Make Query Editable" onClick="SwitchER();">
                    &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                    	<?php echo $ReturnBtn; ?>
                    <br />
                    <p class="WarningInfo">Please do not refresh this page, generated query will be lost.</p>
                    	<?php echo $QLearn; ?>
            </div>
            </div>
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