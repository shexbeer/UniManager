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