<?php
session_start();

  $qCommand=substr($_SERVER['QUERY_STRING'],0,1); 
  $qValue=substr($_SERVER['QUERY_STRING'],2); 
  $head="";
  $subhead="";
  $QueryHTML="";
  if($qValue=='select' && $qCommand=='q')
  {
	  $_SESSION['QueryType']='sel_query';
	  $head="SELECT QUERY GENERATOR";
	  $subhead="Please provide us some basic information so that we can generate <strong>SELECT</strong> query for you.";
	  $QueryHTML="
	  			<div id='QuickSelect'>
                    	<form action='QueryResult.php' method='post' enctype='multipart/form-data'>
							<table>
								<tr>
									<td><strong>Provide Table Name </strong><br /><input type='text' name='txtTabName' class='txtBox' title='Provide table name of database.' maxlength=100 required /></td>
								</tr>
								<tr>
									<td><strong>Provide Column Names </strong><br /><input type='text' name='txtColumnName' class='txtBox' title='Provide all column names of the table. Use comma to seperate names.' maxlength=250 required /><span class='tdMsg'> (Use comma to seperate names, write * to select all columns)</span></td>
								</tr>
								<tr>
									<td><strong>Select Query Type </strong><br />
                                    <select class='ddBox'  name='ddQType' id='selQOpt' onChange='genQuery();' required>
                                        	<option value='1' selected>Generic Query</option>
                                            <option value='2'>Specific Query [WHERE]</option>
                                    </select></td>
								</tr>
                                <tr id='selAddField'>
                                	<td><strong>Provide Condition Details </strong><br />
                                    	<input type='text' name='txtWColName' class='txtBox' placeholder='Column Name' />
                                        <select class='ddBox' name='ddWhereOpt'>
                                        	<option value='1' selected>=    [Equals To]</option>
                                            <option value='2'>>    [Greater Than]</option>
                                            <option value='3'>>    [Less Than]</option>
											<option value='4'>>=   [Greater Than Equals To]</option>
                                            <option value='5'>>=   [Less Than Equals To]</option>
                                            <option value='6'>LIKE [Matching Phrase]</option>
                                    	</select>
                                        <input type='text' class='txtBox' name='txtData' placeholder='Data or Phrase' />
                                    </td>
                                </tr>
                                <tr>
                                	<td><input type='submit' name='btnGenQuery' class='btnNew' value='Generate Query' /></td>
                                </tr>
							</table>
                            </form>
						</div>	
	  ";
	  
  }
  else if($qValue=='insert' && $qCommand=='q')
  {
	  $_SESSION['QueryType']='ins_query';
	  $head="INSERT QUERY GENERATOR";
	  $subhead="Please provide us some basic information so that we can generate <strong>INSERT</strong> query for you.";
	  $QueryHTML="
	  			<div id='QuickInsert'>
                    	<form action='QueryResult.php' method='post' enctype='multipart/form-data'>
							<table>
								<tr>
									<td><strong>Provide Table Name </strong><br /><input type='text' name='txtTabName' class='txtBox' title='Provide table name of database.' maxlength=100 required /></td>
								</tr>
								<tr>
									<td><strong>Provide Total Column Number </strong><br /><input type='text' name='txtColNumber' id='txtColNum' class='txtBox' title='Provide total column number of table.' onBlur='insShowTB();' maxlength=2 required /><span class='tdMsg'> Maximum 20 columns are supported currently.</span></td>
								</tr>
								<tr id='1' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn1Name' class='txtBox' title='Provide column names of the table.' maxlength=250 /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn1Value' class='txtBox' title='Provide column value of the table.' maxlength=250 /><span class='tdMsg'></span></td>
								</tr>
								<tr id='2' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn2Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn2Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='3' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn3Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn3Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='4' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn4Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn4Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='5' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn5Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn5Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='6' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn6Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn6Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='7' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn7Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn7Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='8' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn8Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn8Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='9' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn9Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn9Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='10' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn10Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn10Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='11' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn11Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn11Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='12' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn12Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn12Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='13' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn13Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn13Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='14' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn14Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn14Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='15' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn15Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn15Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='16' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn16Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn16Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='17' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn17Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn17Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='18' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn18Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn18Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='19' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn19Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn19Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='20' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn20Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn20Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
                                <tr>
                                	<td><input type='submit' name='btnGenQuery' class='btnNew' value='Generate Query' /></td>
                                </tr>
							</table>
                            </form>
						</div>	
	  ";
	  
  }
  else if($qValue=='delete' && $qCommand=='q')
  {
	  $_SESSION['QueryType']='del_query'; 
	  $head="DELETE QUERY GENERATOR";
	  $subhead="Please provide us some basic information so that we can generate <strong>DELETE</strong> query for you.";
	  $QueryHTML="
	  			<div id='QuickDelete'>
                    	<form action='QueryResult.php' method='post' enctype='multipart/form-data'>
							<table>
								<tr>
									<td><strong>Provide Table Name </strong><br /><input type='text' name='txtTabName' class='txtBox' title='Provide table name of database.' maxlength=100 required /></td>
								</tr>
								<tr>
									<td><strong>Select Query Type </strong><br />
                                    <select class='ddBox'  name='ddQType' id='selQOpt' onChange='genQuery();' required>
                                        	<option value='1' selected>Generic Query</option>
                                            <option value='2'>Specific Query [WHERE]</option>
                                    </select></td>
								</tr>
                                <tr id='selAddField'>
                                	<td><strong>Provide Condition Details </strong><br />
                                    	<input type='text' name='txtWColName' class='txtBox' placeholder='Column Name' />
                                        <select class='ddBox' name='ddWhereOpt'>
                                        	<option value='1' selected>=    [Equals To]</option>
                                            <option value='2'>>    [Greater Than]</option>
                                            <option value='3'>>    [Less Than]</option>
											<option value='4'>>=   [Greater Than Equals To]</option>
                                            <option value='5'>>=   [Less Than Equals To]</option>
                                            <option value='6'>LIKE [Matching Phrase]</option>
                                    	</select>
                                        <input type='text' class='txtBox' name='txtData' placeholder='Data or Phrase' />
                                    </td>
                                </tr>
                                <tr>
                                	<td><input type='submit' name='btnGenQuery' class='btnNew' value='Generate Query' /></td>
                                </tr>
							</table>
                            </form>
						</div>	
	  ";
	  
  }
  else if($qValue=='update' && $qCommand=='q')
  {
	  $_SESSION['QueryType']='upd_query';
	  $head="UPDATE QUERY GENERATOR";
	  $subhead="Please provide us some basic information so that we can generate <strong>UPDATE</strong> query for you.";
  	  $QueryHTML="
	  			<div id='QuickUpdate'>
                    	<form action='QueryResult.php' method='post' enctype='multipart/form-data'>
							<table>
								<tr>
									<td><strong>Provide Table Name </strong><br /><input type='text' name='txtTabName' class='txtBox' title='Provide table name of database.' maxlength=100 required /></td>
								</tr>
								<tr>
									<td><strong>Provide Total Column Number </strong><br /><input type='text' name='txtColNumber' id='txtColNum' class='txtBox' title='Provide total column number of table.' onBlur='insShowTB();' maxlength=2 required /><span class='tdMsg'> Maximum 20 columns are supported currently.</span></td>
								</tr>
								<tr id='1' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn1Name' class='txtBox' title='Provide column names of the table.' maxlength=250 /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn1Value' class='txtBox' title='Provide column value of the table.' maxlength=250 /><span class='tdMsg'></span></td>
								</tr>
								<tr id='2' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn2Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn2Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='3' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn3Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn3Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='4' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn4Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn4Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='5' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn5Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn5Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='6' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn6Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn6Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='7' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn7Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn7Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='8' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn8Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn8Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='9' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn9Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn9Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='10' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn10Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn10Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='11' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn11Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn11Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='12' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn12Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn12Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='13' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn13Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn13Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='14' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn14Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn14Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='15' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn15Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn15Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='16' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn16Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn16Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='17' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn17Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn17Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr id='18' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn18Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn18Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
								<tr id='19' style='display:none;'>
									<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn19Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn19Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
								</tr>
                                <tr id='20' style='display:none;'>
                                	<td><strong>Provide Column Name </strong><br /><input type='text' name='txtColumn20Name' class='txtBox' title='Provide column names of the table.' maxlength=250  /><span class='tdMsg'></span></td>
									<td><strong>Provide Column Value </strong><br /><input type='text' name='txtColumn20Value' class='txtBox' title='Provide column value of the table.' maxlength=250  /><span class='tdMsg'></span></td>
                                </tr>
								<tr>
									<td><strong>Select Query Type </strong><br />
                                    <select class='ddBox'  name='ddQType' id='selQOpt' onChange='genQuery();' required>
                                        	<option value='1' selected>Generic Query</option>
                                            <option value='2'>Specific Query [WHERE]</option>
                                    </select></td>
								</tr>
                                <tr id='selAddField'>
                                	<td><strong>Provide Condition Details </strong><br />
                                    	<input type='text' name='txtWColName' class='txtBox' placeholder='Column Name' />
                                        <select class='ddBox' name='ddWhereOpt'>
                                        	<option value='1' selected>=    [Equals To]</option>
                                            <option value='2'>>    [Greater Than]</option>
                                            <option value='3'>>    [Less Than]</option>
											<option value='4'>>=   [Greater Than Equals To]</option>
                                            <option value='5'>>=   [Less Than Equals To]</option>
                                            <option value='6'>LIKE [Matching Phrase]</option>
                                    	</select>
                                        <input type='text' class='txtBox' name='txtData' placeholder='Data or Phrase' />
                                    </td>
                                </tr>
                                <tr>
                                	<td><input type='submit' name='btnGenQuery' class='btnNew' value='Generate Query' /></td>
                                </tr>
							</table>
                            </form>
						</div>	
	  ";
	  
  }
  else
  {
	  header( "Location: index.php" );
  }
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Query Generator | DBHandler</title>
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
        	<div id="q_typeHead"><?php echo $head ?></div>
          	<div id="q_typeSubHead"><?php echo $subhead ?></div>
            <br />
            <div id="QuickQueryPane">
				<?php
					echo $QueryHTML;
				?>
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