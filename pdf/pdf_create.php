<?php
require_once("../main.class.php");
require('fpdf.php');

$UM = new UniManager();

define("font", "Arial");
define("size", 12);

class PDF_MC_Table extends FPDF
{
	var $widths;
	var $aligns;
	
	function setBold() 
	{
		$this->setFont(font, 'B', size);
	}
	function setNormal() 
	{
		$this->setFont(font, '', size);
	}
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
	
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
	
	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h=5*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x, $y, $w, $h);
			//Print the text
			if($i != 0) 
			{
				$this->MultiCell($w, 5, $data[$i], 0, $a);
			} else {
				$this->setBold();
				$this->MultiCell($w, 5, $data[$i], 0, $a);
				$this->setNormal();
			}
			//Put the position to the right of the cell
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}
	
	function NbLines($w, $txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r", '', $txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
}

class PDFCreator
{
	function PDFCreator($UniManagerReference) 
	{
		$this->UM = $UniManagerReference;
	}
	function Modulhandbuch($id, $display="true")
	{
		$sg_id = $id;
		
		$MM = new Modul_Management();
		$PM = new Person_Management();
		$Modullist_unchecked = $MM->getModuldetails(true,"sg",$sg_id);
		$ml = $this->UM->checkManagerResults($Modullist_unchecked,"modul_id","Modulliste+Details");
		$pdf = new PDF_MC_Table();
		
		$pdf->setWidths(array(50,130));
		
		$pdf->SetFont(font,'',size);
		if($ml) {
			foreach($ml as $var) {
				$pdf->AddPage();
				$pdf->setBold();
				$pdf->Cell(50,7,"Code/Daten",1);
				$pdf->setNormal();
				$pdf->Cell(40,7,"ID: ".$var["modul_id"],1);
				$pdf->Cell(45,7,"Stand: ".$var["modul_last_cha"],1);
				$pdf->Cell(45,7," ",1);
				$pdf->Ln();
				
				$pdf->setBold();
				$pdf->Cell(50,7,"Modulname",1);
				$pdf->setNormal();
				$pdf->Cell(130,7,utf8_decode($var["modul_name"]),1);
				$pdf->Ln();
				
				$name = $PM->getNameForID($var["modul_person_id"]);
				
				$pdf->setBold();
				$pdf->Cell(50,7,"Verantwortlicher",1);
				$pdf->Cell(130,7,$name["vorname"]." ".$name["name"],1);
				$pdf->Ln();
				$pdf->setNormal();
				
				$pdf->setBold();
				$pdf->Cell(50,7,"Institut",1);
				$pdf->setNormal();
				$pdf->Cell(130,7,$var["modul_institut"],"LTR");
				$pdf->Ln();
				
				$pdf->Row(array("Dauer Modul", utf8_decode($var["modul_duration"]." Semester")));
				
				$pdf->Row(array("Qualifikationsziele/ Kompetenzen", $var["modul_qualifytarget"]));
				$pdf->Row(array("Inhalte", $var["modul_content"]));
				$pdf->Row(array("Typische Fachliteratur", $var["modul_literature"]));
				$pdf->Row(array("Lehrformen", $var["modul_teachform"]));
				$pdf->Row(array(utf8_decode("Vorraussetzungen für die Teilnahme"), $var["modul_required"]));
				$pdf->Row(array("Verwendbarkeit des Moduls", $var["modul_usability"]));
				
				$pdf->setBold();
				$pdf->Cell(50,7,utf8_decode("Häufigkeit"),1);
				$pdf->setNormal();
				$pdf->Cell(130,7, $var["modul_frequency"],"LTR");
				$pdf->Ln();
				
				$pdf->Row(array(utf8_decode("Voraussetzung für Vergabe von Leistungspunkte"), $var["modul_conditionforln"]));
				$pdf->Row(array("Leistungspunkte", $var["modul_lp"]));
				$pdf->Row(array("Leistungspunkte und Noten", $var["modul_note"]));
				$pdf->Row(array("Arbeitsaufwand", $var["modul_effort"]));
				
			}
		} else {
			$pdf->AddPage();
			$pdf->setBold();
			$pdf->Write(50, "Keine Module im Studiengang!");
		}
		if($display == true) {
			$pdf->Output();
		} else {
			$name = "Modul_".$sg_id.".pdf";
			$dest = "../".PDF_Modulhandbuch_DIR;
		
			
			$pdf->Output($dest.$name, "F");
			header("Location: " . $UM->cwd["rootDir"] . $dest . $name . "?time=".time());
		}
	}
}

if($_GET["type"]=="POSO") // Erstelle PDF für eine Studien & Prüfungsordnung
{
}

if($_GET["type"]=="Modulhb" && $_GET["forid"]) // Erstelle eine Modulhandbuch PDF
{
	$pdfc = new PDFCreator($UM);
	
	if($_GET["toFile"]) {
		$pdfc->Modulhandbuch($_GET["forid"], false);
	} else {
		$pdfc->Modulhandbuch($_GET["forid"]);
	}
}

//print("I Create a PDF for YOU :) sometimes ...");
?>