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

function MA_AddButton($id) {
	confirm("test "+$id);
}

function isEven(someNumber){
    return (someNumber%2 == 0) ? true : false;
};

function MA_changeSemester(sgid, cur, next) {
	// 1 -> $mark 2-> !$mark
	var select = document.getElementsByName("ma_semester");
	var value;
	select = select[0];
	
	for (i = 0; i < select.length; ++i)
    if (select.options[i].selected == true)
      value=select.options[i].value;
      
    if(value == 1) {
    	window.location = "MA_create.php?forid="+sgid+"&forSem="+cur;
    } else {
    	window.location = "MA_create.php?forid="+sgid+"&forSem="+next;
    }
	
}