<?php
  class VO_POSO_edit{
      
      function VO_POSO_edit($UM)
      {
          $this->UM=$UM;
      }
      
      
      function showResult($error_occurred, $extra_message)
      {
      $this->UM->tpl->assign("error", $error_occurred);
            $this->UM->tpl->assign("extra_msg", $extra_message);
            $this->UM->showfooter();
            $this->UM->showheader($this->UM->seite);
            $this->UM->tpl->display("LN_Edit_Result.tpl", session_id());
            
      }
      
       /**
      * zeigt eine Liste aller Studiengaenge an und ermoeglicht dem Nutzer die Auswahl
      */
      
      function showSGList($SG)
      {
          $this->UM->showfooter();
          $this->UM->showheader($this->UM->seite);
          $this->UM->tpl->assign("SG",$SG);
          $this->UM->tpl->display("POSO_edit_sglist.tpl", session_id());
          
      }
      
      /**
      * Zeigt die Vorlage f�r die SO und PO dem Nutzer an und erm�glicht sie zu Bearbeiten/Ersetzen
      * @param mixed $vorlage array mit den Feldern po und so (wahrscheinlich beides pdf- dateien)
      */
      
      function showPOSOTemplate($vorlage)
      {
      }
      
      /**
      * Zeigt einen Editor, in dem der Nutzer Module auswaehlen, hinzufuegen oder entfernen kann
      * @param bool $result liefert das Ergebnis der vorangegangenen Aenderung der PO und SO
      * @param mixed $modullist Array eine Liste aller existierender Module
      */
      function showModullistEditor($result,$modullist)
      {
          
      }
      
      
      
      
  }
?>
