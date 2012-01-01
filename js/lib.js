var isIE = (window.navigator.userAgent.indexOf("MSIE") > 0);

if (! isIE) {
HTMLElement.prototype.__defineGetter__("innerText", 
function () { return(this.textContent); });
HTMLElement.prototype.__defineSetter__("innerText", 
function (txt) { this.textContent = txt; });
}

function Modul_Checkbox(id, sems) {
	var span = document.getElementById("span_" + id);
	var chkbox = document.getElementById("chkbox_" + id);
	if(chkbox.checked) {
		var newSelect = document.createElement("select");
		var select_id = document.createAttribute("id");
		var select_size = document.createAttribute("size");
		var select_name = document.createAttribute("name");
		newSelect.setAttributeNode(select_id);
		newSelect.setAttributeNode(select_size);
		newSelect.setAttributeNode(select_name);
		newSelect.name = "modul_semester[" + id + "]";
		newSelect.id = "modul_semester[" + id + "]";
		newSelect.size = 1;
	   
		for (var i = 1; i <= sems; i++) {
			var NeuerEintrag = new Option(i);
			newSelect.options[newSelect.length] = NeuerEintrag;
		}
		
		span.appendChild(newSelect);
	} else {
		span.removeChild(document.getElementById("modul_semester["+id+"]"));
	}
}

function MA_AddButton(id, name, plansemester) {
	
	var spanDown = document.getElementById("modulangebot");
	var tdTop = document.getElementById("ma_add_"+id);
	var spanTop = document.getElementById("ma_add_span_"+id);
	
	// Span
	var newSpan = document.createElement("span");
	var newSpan_id = document.createAttribute("id");
	newSpan_id.nodeValue = "ma_del_"+id;
	newSpan.setAttributeNode(newSpan_id);
	//newSpan.id = ;
	
	// Textbox
	var newTextBox = document.createElement("input");
	var newTextBox_id = document.createAttribute("id");
	var newTextBox_type = document.createAttribute("type");
	var newTextBox_name = document.createAttribute("name");
	var newTextBox_value = document.createAttribute("value");
	var newTextBox_size = document.createAttribute("size");
	var newTextBox_class = document.createAttribute("class");
	var newTextBox_disabled = document.createAttribute("readonly");
	
	newTextBox.setAttributeNode(newTextBox_id);
	newTextBox.setAttributeNode(newTextBox_type);
	newTextBox.setAttributeNode(newTextBox_name);
	newTextBox.setAttributeNode(newTextBox_value);
	newTextBox.setAttributeNode(newTextBox_size)
	newTextBox.setAttributeNode(newTextBox_class);
	newTextBox.setAttributeNode(newTextBox_disabled);
	newTextBox.id = "ma_"+id;
	newTextBox.type = "text";
	newTextBox.name = "ma_text[]";
	newTextBox.size = name.length + 0;
	newTextBox.value = name+" (ID:"+id+")";
	//newTextBox.class = "MA_inputText";
	newTextBox.setAttribute("class","MA_inputText");
	//newTextBox.setAttribute("onClick","tes()");
	
	// Plansemester Anzeige
	var planSpan = document.createElement("span");
	var att_name = document.createAttribute("id");
	att_name.nodeValue = "MA_rightSem";
	var att_innerText = document.createAttribute("innerText");
	planSpan.setAttributeNode(att_name);
	planSpan.setAttributeNode(att_innerText);
	planSpan.innerText = " "+plansemester+" ";
	
	// Del Button
	var bt = document.createElement("input");
	var bt_value = document.createAttribute("value");
	var bt_onClick = document.createAttribute("onClick");
	var bt_type = document.createAttribute("type");
	bt.setAttributeNode(bt_value);
	bt.setAttributeNode(bt_onClick);
	bt.setAttributeNode(bt_type);
	bt.value = "-";
	bt.type = "button";
	//alert(bt.onClick);
	bt.setAttribute("onClick","MA_DelButton('"+id+"','"+name+"','"+plansemester+"')");
	
	newSpan.appendChild(newTextBox);
	newSpan.appendChild(planSpan);
	newSpan.appendChild(bt);
	spanDown.appendChild(newSpan);	
	
	tdTop.removeChild(spanTop);
	
	if(spanDown.childNodes.length % 4 == 0) {
		var br = document.createElement("br");
		spanDown.appendChild(br);
	}
	
	// Enable Submit Button
	if(MA_create_RB_checker())
		document.getElementById("ma_submit").disabled = false;
}

function MA_DelButton(id, name, plansemester) {

	var spanDown = document.getElementById("modulangebot");
	var spanDelSpan = document.getElementById("ma_del_"+id);
	var tdTop = document.getElementById("ma_add_"+id);
	
	
	// Span
	var newSpan = document.createElement("span");
	var newSpan_id = document.createAttribute("id");
	newSpan_id.nodeValue = "ma_add_span_"+id;
	newSpan.setAttributeNode(newSpan_id);
	//newSpan.id = ;
	
	// Name des Moduls
	var nameSpan = document.createElement("span");
	//var att_name = document.createAttribute("id");
	//att_name.nodeValue = "MA_rightSem";
	var att_innerText = document.createAttribute("innerText");
	nameSpan.setAttributeNode(att_innerText);
	nameSpan.innerText = name+" ";
	
	
	// Plansemester Anzeige
	var planSpan = document.createElement("span");
	var att_name = document.createAttribute("id");
	att_name.nodeValue = "MA_rightSem";
	var att_innerText = document.createAttribute("innerText");
	planSpan.setAttributeNode(att_name);
	planSpan.setAttributeNode(att_innerText);
	planSpan.innerText = plansemester+" ";
	
	// Add Button
	var bt = document.createElement("input");
	var bt_value = document.createAttribute("value");
	var bt_onClick = document.createAttribute("onClick");
	var bt_type = document.createAttribute("type");
	bt.setAttributeNode(bt_value);
	bt.setAttributeNode(bt_onClick);
	bt.setAttributeNode(bt_type);
	bt.value = "+";
	bt.type = "button";
	//alert(bt.onClick);
	bt.setAttribute("onClick","MA_AddButton('"+id+"','"+name+"','"+plansemester+"')");
	
	newSpan.appendChild(nameSpan);
	newSpan.appendChild(planSpan);
	newSpan.appendChild(bt);
	tdTop.appendChild(newSpan);	
	
	spanDown.removeChild(spanDelSpan);
	
	if(spanDown.childNodes.length == 1) {
		document.getElementById("ma_submit").disabled = "disabled";
	}
	
	// alert(spanDown.childNodes.length);
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
	
	//compareControl.style.backgroundColor = "red";
	var mods = document.getElementsByName("modulangebot[]");
	var rows = mods.length;
	var count = 0;
	for(var i=0; i<rows; i++) {
		if(mods[i].value != "")
			count++
	}
	if(count == 0) {
		document.getElementById("ma_submit").disabled = "disabled";
	}
	
	// alert(spanDown.childNodes.length);
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
	if(MA_create_RB_checker() && document.getElementById("modulangebot").childNodes.length > 1)
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
		document.getElementById("ma_submit").disabled = "disabled";
	}
}