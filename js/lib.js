var isIE = (window.navigator.userAgent.indexOf("MSIE") > 0);

if (! isIE) {
HTMLElement.prototype.__defineGetter__("innerText", 
function () { return(this.textContent); });
HTMLElement.prototype.__defineSetter__("innerText", 
function (txt) { this.textContent = txt; });
}

function Modul_Checkbox(id, sems) {
	var chkbox = document.getElementById("modul_chkbox_" + id);
	
	var ps = document.getElementById("modul_ps_" + id);
	var row = document.getElementById("modul_row_" + id);
	//alert("hallo");
	if(chkbox.checked) {
		ps.style.visibility = "visible";
		row.style.color = "black";
	} else {
		ps.style.visibility = "hidden";
		row.style.color = "gray";
	}
	SGcheckModulaufstellung();
}

function MAcreate_AddButton(id, name, plansemester) {
	
	var newName = document.getElementById("compareRight_name_"+id);
	var newId = document.getElementById("compareRight_idField_"+id);
	var newPs = document.getElementById("compareRight_ps_"+id);
	var newButton = document.getElementById("compareRight_bt_"+id);
	var oldButton = document.getElementById("compareLeft_bt_"+id);
	//var compareControl = document.getElementById("compareControl_"+id);
	
	var oldName = document.getElementById("compareLeft_name_"+id);
	//var oldId = document.getElementById("compareLeft_idField_"+id);
	var oldPs = document.getElementById("compareLeft_ps_"+id);	
	var oldButton = document.getElementById("compareLeft_bt_"+id);

	newName.innerText = name;
	newId.value=id;
	newPs.innerText = plansemester
	newButton.style.visibility = "visible";
	
	oldName.innerText = '';
	oldPs.innerText = '';
	oldButton.style.visibility = "hidden";
	//compareControl.style.backgroundColor = "green";
	
	// Enable Submit Button
	if(MA_create_RB_checker())
		document.getElementById("ma_submit").disabled = false;
}

function MAcreate_DelButton(id, name, plansemester) {

	var newName = document.getElementById("compareLeft_name_"+id);
	//var newId = document.getElementById("compareLeft_idField_"+id);
	var newPs = document.getElementById("compareLeft_ps_"+id);
	var newButton = document.getElementById("compareLeft_bt_"+id);
	//var newFrequency = document.getElementById("compareLeft_frequency_"+id);
	//var newRow = document.getElementById("compareList_Row_"+id);
	
	var oldName = document.getElementById("compareRight_name_"+id);
	var oldId = document.getElementById("compareRight_idField_"+id);
	var oldPs = document.getElementById("compareRight_ps_"+id);	
	var oldButton = document.getElementById("compareRight_bt_"+id);
	
	//var compareControl = document.getElementById("compareControl_"+id);

	newName.innerText = name;
	newPs.innerText = plansemester
	newButton.disabled = "";
	newButton.style.visibility = "visible";
	//newFrequency.innerText = frequency
	
	oldName.innerText = "";
	oldId.value = "";
	oldPs.innerText = "";
	oldButton.style.visibility = "hidden";
	
	MAcheckModulangebot();
}

function MAedit_AddButton(id, name, plansemester) {
	
	var newName = document.getElementById("compareRight_name_"+id);
	var newId = document.getElementById("compareRight_idField_"+id);
	var newPs = document.getElementById("compareRight_ps_"+id);
	var newButton = document.getElementById("compareRight_bt_"+id);
	var oldButton = document.getElementById("compareLeft_bt_"+id);
	//var compareControl = document.getElementById("compareControl_"+id);
	
	var oldName = document.getElementById("compareLeft_name_"+id);
	//var oldId = document.getElementById("compareLeft_idField_"+id);
	var oldPs = document.getElementById("compareLeft_ps_"+id);	
	var oldButton = document.getElementById("compareLeft_bt_"+id);

	newName.innerText = name;
	newId.value=id;
	newPs.innerText = plansemester
	newButton.style.visibility = "visible";
	
	oldName.innerText = '';
	oldPs.innerText = '';
	oldButton.style.visibility = "hidden";
	//compareControl.style.backgroundColor = "green";
	
	// Enable Submit Button
	if(MA_create_RB_checker())
		document.getElementById("ma_submit").disabled = false;
}

function MAedit_DelButton(id, name, plansemester) {
	
	var newName = document.getElementById("compareLeft_name_"+id);
	//var newId = document.getElementById("compareLeft_idField_"+id);
	var newPs = document.getElementById("compareLeft_ps_"+id);
	var newButton = document.getElementById("compareLeft_bt_"+id);
	//var newFrequency = document.getElementById("compareLeft_frequency_"+id);
	//var newRow = document.getElementById("compareList_Row_"+id);
	
	var oldName = document.getElementById("compareRight_name_"+id);
	var oldId = document.getElementById("compareRight_idField_"+id);
	var oldPs = document.getElementById("compareRight_ps_"+id);	
	var oldButton = document.getElementById("compareRight_bt_"+id);
	
	//var compareControl = document.getElementById("compareControl_"+id);

	newName.innerText = name;
	newPs.innerText = plansemester
	newButton.disabled = "";
	newButton.style.visibility = "visible";
	//newFrequency.innerText = frequency
	
	oldName.innerText = "";
	oldId.value = "";
	oldPs.innerText = "";
	oldButton.style.visibility = "hidden";
	
	MAcheckModulangebot();
}


function MA_create_RB_checker()
{
	// set var radio_choice to false
	var radio_choice = false;
	var radio = document.getElementsByName("lb");
	// Loop from zero to the one minus the number of radio button selections
	for (counter = 0; counter < radio.length; counter++)
	{
		// If a radio button has been selected it will return true
		// (If not it will return false)
		if (radio[counter].checked)
			radio_choice = true; 
	}
	
		if (!radio_choice)
		{
			// If there were no selections made display an alert box 
			//alert("Please select a letter.")
			return (false);
		}
	return (true);
}
function MA_create_checkIfSelected() {
	if(MA_create_RB_checker() && MAcheckModulangebot())
		document.getElementById("ma_submit").disabled = false;
}

function isEven(someNumber){
    return (someNumber%2 == 0) ? true : false;
}

function MA_changeSemester(sgid, cur, next, MAcurr, MAnext) {
	// 1 -> $mark 2-> !$mark
	var select = document.getElementsByName("ma_semester");
	var value;
	select = select[0];
	
	for (i = 0; i < select.length; ++i)
    if (select.options[i].selected == true)
      value=select.options[i].value;
      
    if(value == 1) {
    	window.location = "MA_create.php?forid="+sgid+"&forSem="+cur+"&curr="+MAcurr+"&next="+MAnext;
    } else {
    	window.location = "MA_create.php?forid="+sgid+"&forSem="+next+"&curr="+MAcurr+"&next="+MAnext;
    }	
}

function MAcreate_buildLink(rootDir, sgid, MAcurr, MAnext) {
	window.location = rootDir+"MA_create.php?forid="+sgid+"&curr="+MAcurr+"&next="+MAnext;
}
function MAcompare_AddButton(id, name, plansemester, frequency) {
	var newName = document.getElementById("compareRight_name_"+id);
	var newId = document.getElementById("compareRight_idField_"+id);
	var newPs = document.getElementById("compareRight_ps_"+id);
	var newButton = document.getElementById("compareRight_bt_"+id);
	var oldButton = document.getElementById("compareLeft_bt_"+id);
	var compareControl = document.getElementById("compareControl_"+id);

	newName.innerText = name;
	newId.value=id;
	newPs.innerText = plansemester
	newButton.style.visibility = "visible";
	
	oldButton.disabled = "true";
	compareControl.style.backgroundColor = "green";
	
	document.getElementById("ma_submit").disabled = false;
}
function MAcompare_DelButton(id, name, plansemester, frequency, realDelete) {
	if(realDelete == "false") {
		var newName = document.getElementById("compareLeft_name_"+id);
		//var newId = document.getElementById("compareLeft_idField_"+id);
		var newPs = document.getElementById("compareLeft_ps_"+id);
		var newButton = document.getElementById("compareLeft_bt_"+id);
		var newFrequency = document.getElementById("compareLeft_frequency_"+id);
		var newRow = document.getElementById("compareList_Row_"+id);
		
		var oldName = document.getElementById("compareRight_name_"+id);
		var oldId = document.getElementById("compareRight_idField_"+id);
		var oldPs = document.getElementById("compareRight_ps_"+id);	
		var oldButton = document.getElementById("compareRight_bt_"+id);
		
		var compareControl = document.getElementById("compareControl_"+id);
	
		newName.innerText = name;
		newPs.innerText = plansemester
		newButton.disabled = "";
		newButton.style.visibility = "visible";
		newFrequency.innerText = frequency
		
		oldName.innerText = "";
		oldId.value = "";
		oldPs.innerText = "";
		oldButton.style.visibility = "hidden";
		
		compareControl.style.backgroundColor = "red";
		MAcheckModulangebot();
	} else {
		if(confirm("Wollen Sie dieses Modul wirklich aus dem Modulangebot loeschen?")) {
			var newRow = document.getElementById("compareList_Row_"+id);
			newRow.parentNode.removeChild(newRow);
			MAcheckModulangebot();
		}
	}
}

function MAcheckModulangebot() {
	var mods = document.getElementsByName("modulangebot[]");
	var rows = mods.length;
	var count = 0;
	for(var i=0; i<rows; i++) {
		if(mods[i].value != "")
			count++
	}
	if(count == 0) {
		document.getElementById("ma_submit").disabled = true;
		return false;
	}
	return true;
}

function SGcheckModulaufstellung () {
	var mods = document.getElementsByName("modulaufstellung[]");
	var rows = mods.length;
	var lastChecked = true;
	var textbox = document.getElementsByName("sg_name")[0];
	for(var i=0; i<rows; i++) {
		if(mods[i].checked == true)
			lastChecked = false;
	}
	
	if(lastChecked == false && textbox.value!="") {
		document.getElementById("sg_submit").disabled = false;
		return true;
	} else {
		document.getElementById("sg_submit").disabled = true;
		return false;
	}
}
function SGcheckName(textbox) {
	//alert(value);
	if(textbox.value=="") {
		document.getElementById("sg_submit").disabled = true;
		return false;
	} else {
		document.getElementById("sg_submit").disabled = false;
		return true;
	}
}