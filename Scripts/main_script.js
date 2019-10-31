// JavaScript Document
function doOpacityOn() {
	"use strict";
	document.getElementById("Content").style.opacity=0.5;
}
function doOpacityOff() {
	"use strict";
	document.getElementById("Content").style.opacity=1;
}
function OpenLink1() {
	"use strict";
	window.location='?res=qaforum';	
}
function OpenLink2() {
	"use strict";
	window.location='?res=support';
}
function FocusON(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='#FF7F50';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='bold';
	if(arg===0) {
		document.getElementsByName('txtName').item(0).style.borderColor='blue';
	}
	else if(arg===1){
		document.getElementsByName('txtEmail').item(0).style.borderColor='blue';
	}
	else if(arg===2){
		document.getElementsByName('txtPhone').item(0).style.borderColor='blue';
	}
	else if(arg===3){
		document.getElementsByName('txtMessage').item(0).style.borderColor='blue';
	}
}
function FocusOff(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='';
	if(arg===0) {
		document.getElementsByName('txtName').item(0).style.borderColor='';
	}
	else if(arg===1){
		document.getElementsByName('txtEmail').item(0).style.borderColor='';
	}
	else if(arg===2){
		document.getElementsByName('txtPhone').item(0).style.borderColor='';
	}
	else if(arg===3){
		document.getElementsByName('txtMessage').item(0).style.borderColor='';
	}
}

function cInfoClose() {
	"use strict";
	document.getElementsByClassName('response').item(0).style.display='none';
}

function LFocusON(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='#FF7F50';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='bold';
	if(arg===0){
		document.getElementsByName('txtUsername').item(0).style.borderColor='blue';
	}
	else if(arg===1) {
		document.getElementsByName('txtPassword').item(0).style.borderColor='blue';
	}
}

function LFocusOFF(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='';
	if(arg===0){
		document.getElementsByName('txtUsername').item(0).style.borderColor='';
	}
	else if(arg===1) {
		document.getElementsByName('txtPassword').item(0).style.borderColor='';
	}
}

function PRFocusON(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='#FF7F50';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='bold';
	if(arg===0){
		document.getElementsByName('txtUsername').item(0).style.borderColor='blue';
	}
	else if(arg===1) {
		document.getElementsByName('txtEmail').item(0).style.borderColor='blue';
	}
	else if(arg===2) {
		document.getElementsByName('txtDOB').item(0).style.borderColor='blue';
	}
}

function PRFocusOFF(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='';
	if(arg===0){
		document.getElementsByName('txtUsername').item(0).style.borderColor='';
	}
	else if(arg===1) {
		document.getElementsByName('txtEmail').item(0).style.borderColor='';
	}
	else if(arg===2) {
		document.getElementsByName('txtDOB').item(0).style.borderColor='';
	}
}

function RFocusON(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='#FF7F50';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='bold';
	if(arg===0){
		document.getElementsByName('txtName').item(0).style.borderColor='blue';
	}
	else if(arg===1) {
		document.getElementsByName('txtEmail').item(0).style.borderColor='blue';
	}
	else if(arg===2) {
		document.getElementsByName('txtPhone').item(0).style.borderColor='blue';
	}
	else if(arg===3) {
		document.getElementsByName('txtDOB').item(0).style.borderColor='blue';
	}
	else if(arg===4) {
		document.getElementsByName('txtUsername').item(0).style.borderColor='blue';
	}
	else if(arg===5) {
		document.getElementsByName('txtPassword').item(0).style.borderColor='blue';
	}
	else if(arg===6) {
		document.getElementsByName('txtCPassword').item(0).style.borderColor='blue';
	}
}

function RFocusOFF(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='';
	if(arg===0){
		document.getElementsByName('txtName').item(0).style.borderColor='';
	}
	else if(arg===1) {
		document.getElementsByName('txtEmail').item(0).style.borderColor='';
	}
	else if(arg===2) {
		document.getElementsByName('txtPhone').item(0).style.borderColor='';
	}
	else if(arg===3) {
		document.getElementsByName('txtDOB').item(0).style.borderColor='';
	}
	else if(arg===4) {
		document.getElementsByName('txtUsername').item(0).style.borderColor='';
	}
	else if(arg===5) {
		document.getElementsByName('txtPassword').item(0).style.borderColor='';
	}
	else if(arg===6) {
		document.getElementsByName('txtCPassword').item(0).style.borderColor='';
	}
}

function CPFocusON(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='#FF7F50';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='10px';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='bold';
	if(arg===0) {
		document.getElementsByName('txtUsername').item(0).style.borderColor='blue';
	}
	else if(arg===1) {
		document.getElementsByName('txtCurrPassword').item(0).style.borderColor='blue';
	}
	else if(arg===2) {
		document.getElementsByName('txtPassword').item(0).style.borderColor='blue';
	}
	else if(arg===3) {
		document.getElementsByName('txtCPassword').item(0).style.borderColor='blue';
	}
}

function CPFocusOFF(arg) {
	"use strict";
	document.getElementsByClassName('cBSpan').item(arg).style.backgroundColor='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopLeftRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.borderTopRightRadius='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingLeft='';
	document.getElementsByClassName('cBSpan').item(arg).style.paddingRight='';
	document.getElementsByClassName('cBSpan').item(arg).style.fontWeight='';
	if(arg===0) {
		document.getElementsByName('txtUsername').item(0).style.borderColor='';
	}
	else if(arg===1) {
		document.getElementsByName('txtCurrPassword').item(0).style.borderColor='';
	}
	else if(arg===2) {
		document.getElementsByName('txtPassword').item(0).style.borderColor='';
	}
	else if(arg===3) {
		document.getElementsByName('txtCPassword').item(0).style.borderColor='';
	}
}


function Match() {
	"use strict";
	var PWD_1, PWD_2;
	PWD_1=document.getElementsByName('txtPassword').item(0).value;
	PWD_2=document.getElementsByName('txtCPassword').item(0).value;
	if(PWD_1===PWD_2) {
		
	} else {
		document.getElementsByName('txtCPassword').item(0).value="";
		alert('Both passwords are different.');
	}
}

/*function MatchCP() {
	"use strict";
	var PWD_1, PWD_2;
	PWD_1=document.getElementsByName('txtPassword').item(0).value;
	PWD_2=document.getElementsByName('txtCPassword').item(0).value;
	if(PWD_1===PWD_2) {
		
	} else {
		document.getElementsByName('txtCPassword').item(0).value="";
		alert('Both passwords are different.');
	}
}*/

function Login() {
	"use strict";
	window.location='../DBAccess/Login.php';
}

function GoBack() {
	"use strict";
	window.location='../DBAccess/';
}

function DBOLogin() {
	"use strict";
	window.location='../DBAccess/DBOperation.php?doAction=tabSELECT';
}