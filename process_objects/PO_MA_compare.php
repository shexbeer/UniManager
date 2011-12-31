<?php
  class PO_MA_compare {
      function PO_MA_compare ($UM)
      {
          $this->UM= $UM;
      }
      function initform()
      {
          $this->UM->VisualObject->showModulList($result);          
      }
      function getSG($sg_id)
      {
          $this->UM->VisualObject->showLNAList($result);
      }
      function changeSGModulA()
      {
        $this->UM->VisualObject->showResult($failure, "Bitte melden Sie sich bei der Software Hotline: Code 9999");    
      }
      function checkWholeModulA()
      {
      
      }
  }
?>
