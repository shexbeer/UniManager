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
	
	var spanDown = document.getElementById("modulangebot");
	var spanTop = document.getElementById("modulliste");
	var addSpan = document.getElementById("ma_modlist_"+id);
	//var spanTop = document.getElementById("ma_add_span_"+id);
	
	// Span
	var newSpan = document.createElement("span");
	var newSpan_id = document.createAttribute("id");
	newSpan.setAttributeNode(newSpan_id);
	newSpan.id = "ma_modangebot_"+id;
	
	//newSpan.id = ;
	
	// Name Span
	var nameSpan = document.createElement("span");
	var nameSpan_text = document.createAttribute("innerText");
	nameSpan.setAttributeNode(nameSpan_text);
	nameSpan.innerText = name;
	
	//newSpan.id = ;
	
	// hidden Box
	var newHBox = document.createElement("input");
	var newHBox_type = document.createAttribute("type");
	var newHBox_name = document.createAttribute("name");
	var newHBox_value = document.createAttribute("value");

	newHBox.setAttributeNode(newHBox_type);
	newHBox.setAttributeNode(newHBox_name);
	newHBox.setAttributeNode(newHBox_value);
	newHBox.type = "hidden";
	newHBox.name = "modulaufstellung[]";
	newHBox.value = id;
	
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
	bt.setAttribute("onClick","MAedit_DelButton('"+id+"','"+name+"','"+plansemester+"')");
	
	var brtag = document.createElement("br");
	newSpan.appendChild(nameSpan);
	newSpan.appendChild(newHBox);
	newSpan.appendChild(planSpan);
	newSpan.appendChild(bt);
	
	spanDown.appendChild(newSpan);
	
	newSpan.appendChild(brtag);
	
	spanTop.removeChild(addSpan);
	
	if(spanDown.childNodes.length % 4 == 0) {
		
		//spanDown.appendChild(brtag);
		//spanDown.removeChild(br);
		//alert("hui");
	}
	
	// Enable Submit Button
	if(MA_create_RB_checker())
		document.getElementById("ma_submit").disabled = false;
}

function MAedit_DelButton(id, name, plansemester) {
	
	var spanDown = document.getElementById("modulangebot");
	var spanTop = document.getElementById("modulliste");
	var delSpan = document.getElementById("ma_modangebot_"+id);
	//var spanTop = document.getElementById("ma_add_span_"+id);
	
	// Span
	var newSpan = document.createElement("span");
	var newSpan_id = document.createAttribute("id");
	newSpan_id.nodeValue = "ma_modlist_"+id;
	newSpan.setAttributeNode(newSpan_id);
	//newSpan.id = ;
	
	// Name Span
	var nameSpan = document.createElement("span");
	var nameSpan_text = document.createAttribute("innerText");
	nameSpan.setAttributeNode(nameSpan_text);
	nameSpan.innerText = name;
	
	//newSpan.id = ;
	
	// hidden Box
	var newHBox = document.createElement("input");
	var newHBox_type = document.createAttribute("type");
	var newHBox_name = document.createAttribute("name");
	var newHBox_value = document.createAttribute("value");

	newHBox.setAttributeNode(newHBox_type);
	newHBox.setAttributeNode(newHBox_name);
	newHBox.setAttributeNode(newHBox_value);
	newHBox.type = "hidden";
	newHBox.name = "modulaufstellung[]";
	newHBox.value = id;
	
	// Plansemester Anzeige
	var planSpan = document.createElement("span");
	var att_name = document.createAttribute("id");
	att_name.nodeValue = "MA_rightSem";
	var att_innerText = document.createAttribute("innerText");
	planSpan.setAttributeNode(att_name);
	planSpan.setAttributeNode(att_innerText);
	planSpan.innerText = " "+plansemester+" ";
	
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
	bt.setAttribute("onClick","MAedit_AddButton('"+id+"','"+name+"','"+plansemester+"')");

	var brtag = document.createElement("br");
	
	newSpan.appendChild(nameSpan);
	newSpan.appendChild(newHBox);
	newSpan.appendChild(planSpan);
	newSpan.appendChild(bt);
	
	spanTop.appendChild(newSpan);	
	newSpan.appendChild(brtag);
	
	spanDown.removeChild(delSpan);
	
	if(spanDown.childNodes.length == 2) {
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