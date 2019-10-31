// JavaScript Document

function genQuery() {
	"use strict";
	var val=document.getElementById("selQOpt").selectedIndex;
	if(val===1)
	{
		document.getElementById("selAddField").style.display="block";	
	}
	else
	{
		document.getElementById("selAddField").style.display="none";	
	}
}

function SwitchER(){
	"use strict";
	//alert(document.getElementById('QueryArea').readOnly);
	if(document.getElementById('QueryArea').readOnly===true){
		document.getElementById('QueryArea').readOnly=false;
		document.getElementById('Switch').value="Make Query ReadOnly";
		alert('Query Editing Mode: Editable');
	}
	else {
		document.getElementById('QueryArea').readOnly=true;
		document.getElementById('Switch').value="Make Query Editable";
		alert('Query Editing Mode: ReadOnly');	
	}
}

function insShowTB() {
	"use strict";
	var i;
	var MAX=20;
	var numVal=document.getElementById('txtColNum').value;
	if(numVal>20 || numVal<1) {
		if(numVal>20) {
		document.getElementById('txtColNum').value=20;
		insShowTB();
		}
		if(numVal<1) {
			document.getElementById('txtColNum').value=1;
			insShowTB();
		}
		alert('Maximum supported total columns are 20.\nMinimum supported total columns are 1');
	}
	else {
		for(i=1;i<=numVal;i++) {
			document.getElementById(i).style.display='block';
			document.getElementsByName('txtColumn'+i+'Name').item(0).required=true;
     		document.getElementsByName('txtColumn'+i+'Value').item(0).required=true;
			//document.getElementsByName("txtColumn"+i+"Name").it
		}
		for(i=parseInt(numVal)+1;i<=MAX;i++) {
			document.getElementById(i).style.display='none';
			document.getElementsByName('txtColumn'+i+'Name').item(0).required=false;
     		document.getElementsByName('txtColumn'+i+'Value').item(0).required=false;
		}
	}
}

