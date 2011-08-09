<?php

class LNA_Management {
    
    
    /*
    #vom Daniel, soweit ichs verstanden hab aber universell oder
    function buildResult($res){
		if(!$res)$rows['result']=false;//Fehlererkennung
		else{
			$rows['result']=true;
			$rnum=mysql_num_rows($res);# 0 wenn kein Treffer gefunden wurde
			$fnum = mysql_num_fields($res);
			for($i=0;$i<$rnum;$i++){
					$mod_id = mysql_result($res,$i,"modul_id");
					for($j=0;$j<$fnum;$j++) $rows[$mod_id][mysql_field_name($res,$j)]=mysql_result($res,$i,$j);
			}
		}
		return $rows;
	}
    */
    
	#Abrufen einer LNA mit allen Details
    #parameter EINE lna_id
    #Wiedergabe 1dim: lna_id, ln_registrationdate, ...  
	function getLNAdetail(){
        $lna_id = func_get_arg(0);
		$sql = "SELECT * FROM leistungsnachweisanmeldung WHERE lna_id=".$lna_id;
		return mysql_query($sql);
   }
    
    #Liste einer Liste von lna_ids zu einem Studenten
    #parameter EINE student_id
    #Wiedergabe 1dim: lna_id[0], ... 
    function getLNAlistforStudent(){
        $stu_id = func_get_arg(0);
        $sql = "SELECT lna_id FROM leistungsnachweis WHERE lna_student_id=".$stu_id." ORDER BY lna_id";
        return mysql_query($sql);
    }

    #Liste einer Liste von lna_ids zu einem LN
    #parameter EINE ln_id
    #Wiedergabe 1dim: lna_id[0], ... 
    function getLNAlistforLN(){
        $ln_id = func_get_arg(0);
        $sql = "SELECT lna_id FROM leistungsnachweis WHERE lna_ln_id=".$ln_id." ORDER BY lna_id";
        return mysql_query($sql);
    }    
    
    
    #getLNAlistforModul? ->zur Modulnotenberechnung und ob bestanden oder nicht bestanden


    function getLNA(){
                
    }
    
    
    #Noten eintragen
    function setLNA(){
        
    }
    
    
    #zur Pruefung anmelden
    function createLNA(){
        
    }
}


?>