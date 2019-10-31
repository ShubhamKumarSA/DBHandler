function DAFocusON(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='#FF7F50';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='bold';
	if(arg===0) {
		document.getElementsByName('txtHostName').item(0).style.borderColor='blue';
	}
	else if(arg===1){
		document.getElementsByName('txtDBUser').item(0).style.borderColor='blue';
	}
	else if(arg===2){
		document.getElementsByName('txtDBPass').item(0).style.borderColor='blue';
	}
	else if(arg===3){
		document.getElementsByName('txtDBName').item(0).style.borderColor='blue';
	}
}
function DAFocusOff(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='';
	if(arg===0) {
		document.getElementsByName('txtHostName').item(0).style.borderColor='';
	}
	else if(arg===1){
		document.getElementsByName('txtDBUser').item(0).style.borderColor='';
	}
	else if(arg===2){
		document.getElementsByName('txtDBPass').item(0).style.borderColor='';
	}
	else if(arg===3){
		document.getElementsByName('txtDBName').item(0).style.borderColor='';
	}
}

function SayInfo() {
	"use strict";
	var SelVal;
	SelVal=document.getElementById('seldbP').value;
	if(SelVal!==1) {
		document.getElementById('seldbP').value=1;
		alert('Only MySQL database is currently supported.');
	}
}

function goQueryBuilder() {
	"use strict";
	window.open('../QueryBuilder/');
}

function AddSampleC() {
	"use strict";
	document.getElementsByName('txtQuery').item(0).value="CREATE TABLE Employee ( serial INT, emp_name VARCHAR(150), PRIMARY KEY(serial) )";
}

function AddSampleA() {
	"use strict";
	document.getElementsByName('txtQuery').item(0).value="ALTER TABLE Employee ADD salary INT";
}

function AddSampleS() {
	"use strict";
	document.getElementsByName('txtQuery').item(0).value="SELECT * FROM Employee";
}

function AddSampleI() {
	"use strict";
	document.getElementsByName('txtQuery').item(0).value="INSERT INTO Employee(eid, efullname, elocation) VALUES('EMP_00001','Shubham Kumar')";
}

function AddSampleD() {
	"use strict";
	document.getElementsByName('txtQuery').item(0).value="DELETE FROM Employee";
}

function AddSampleU() {
	"use strict";
	document.getElementsByName('txtQuery').item(0).value="UPDATE Employee SET efullname='Shubham Kumar' WHERE eid='EMP_00001' ";
}

function showVisuals(arg1,arg2) {
	"use strict";
	if(arg2===11) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="List all your tables in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	} else if(arg2===22) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="Create tables in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	} else if(arg2===33) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="Drop tables in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	} else if(arg2===44) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="Alter tables in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	} else if(arg2===55) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="Count records of table in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	} else if(arg2===66) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="Select data from table in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	} else if(arg2===77) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="Insert data from table in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	} else if(arg2===88) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="Delete data from table in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	} else if(arg2===99) {
		if(arg1===0) {
			document.getElementById('Visuals').innerHTML="Update data from table in the database.";
		} else if(arg1===1) {
			document.getElementById('Visuals').innerHTML="&#x263A; We're working to upgrade or add more tools for you. &#x263A;";
		}
	}
}
