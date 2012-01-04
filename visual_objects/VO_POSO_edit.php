<?php
  class VO_POSO_edit{
      
      function VO_POSO_edit($UM)
      {
          $this->UM=$UM;
      }
      
      
      function showResult($result, $extra_message)
      {
      		$this->UM->tpl->assign("result", $result);
            $this->UM->tpl->assign("extra_msg", $extra_message);
            $this->UM->showfooter();
            $this->UM->showheader($this->UM->seite);
            $this->UM->tpl->display("POSO_edit_Result.tpl", session_id());
            
      }
      
       /**
      * zeigt eine Liste aller Studiengaenge an und ermoeglicht dem Nutzer die Auswahl
      */
      
      function showSGList($SG, $posotemplates)
      {
          $this->UM->showfooter();
          $this->UM->showheader($this->UM->seite);
          $this->UM->tpl->assign("SG",$SG);
          $this->UM->tpl->assign("posot",$posotemplates);
          $this->UM->tpl->display("POSO_edit_sglist.tpl", session_id());
          
      }
      
      /**
      * Zeigtdem Nutzer die Studienordnung oder das Modulhandbuch an
      * @param mixed $vorlage array mit den Feldern po und so (wahrscheinlich beides pdf- dateien)
      */
      
      function showPOSOTemplate($sg_id, $vorlage, $descriptions)
      {
          $this->UM->showfooter();
          $this->UM->showheader($this->UM->seite);
          $this->UM->tpl->assign("vorlage",$vorlage);
          $this->UM->tpl->assign("descriptions",$descriptions);
          $this->UM->tpl->assign("sgid",$sg_id);
          $this->UM->tpl->display("POSO_edit_POSOTemplate.tpl", session_id());
      }
      
      /**
      * Zeigt einen Editor, in dem der Nutzer Module auswaehlen, hinzufuegen oder entfernen kann
      * @param bool $result liefert das Ergebnis der vorangegangenen Aenderung der PO und SO
      * @param mixed $modullist Array eine Liste aller existierender Module
      */
      function showModullistEditor($sg,$modullist)
      {
           $this->UM->showfooter();
          $this->UM->showheader($this->UM->seite);
          $this->UM->tpl->assign("modullist",$modullist);
          $this->UM->tpl->assign("sg",$sg);
          $this->UM->tpl->display("POSO_edit_Modullist.tpl", session_id());
      }
      function showEditTemplate($type,$content)
      {
          $this->UM->showfooter();
          $this->UM->showheader($this->UM->seite);
          $this->UM->tpl->assign("content",$content);
          $this->UM->tpl->assign("type",$type);
          $this->UM->tpl->display("POSO_edit_editTemplate.tpl", session_id());      	
      }
      function showModullistResult($result, $sgdetail, $extra_message) 
      {
      	  $this->UM->showfooter();
          $this->UM->showheader($this->UM->seite);
          $this->UM->tpl->assign("sg",$sgdetail);
          $this->UM->tpl->assign("result",$result);
          $this->UM->tpl->assign("extra_msg",$extra_message);
          $this->UM->tpl->display("POSO_edit_ModullistResult.tpl", session_id());      	
      }
      function showTemplateResult($result, $extra_message)
      {
      		$this->UM->tpl->assign("result", $result);
            $this->UM->tpl->assign("extra_msg", $extra_message);
            $this->UM->showfooter();
            $this->UM->showheader($this->UM->seite);
            $this->UM->tpl->display("POSO_edit_templateResult.tpl", session_id());
            
      }
  }
?>
