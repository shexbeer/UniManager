<?php
  class VO_POSO_edit{
      
      function VO_POSO_edit($UM)
      {
          $this->UM=$UM;
      }
      
      /**
      * zeigt eine Liste aller Studiengaenge an und ermoeglicht dem Nutzer die Auswahl
      */
      function showSGList()
      {
          
      }
      
      /**
      * Zeigt die Vorlage für die SO und PO dem Nutzer an und ermöglicht sie zu Bearbeiten/Ersetzen
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
