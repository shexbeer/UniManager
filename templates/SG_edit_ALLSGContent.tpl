{include file="header.tpl" title=foo}

<form action="SG_edit.php" method="POST">
Details des ausgew&auml;lten Studiengangs
<br><br>
<table width=500>
<tr>
	<td width=150>
		Studiengang_ID
	</td>
	<td width=250 align=left>
		<input type="text" name="sg_name" value="{$sg.sg_id}" disabled=true>
	</td>
</tr>
<tr>
	<td width=150>
		Studiengangname
	</td>
	<td width=350 align=left>
		<input type="text" name="sg_name" value="{$sg.sg_name}" size="30">
	</td>
</tr>
<tr>
	<td width=150>
		Vorname und Nachname des Dekans
	</td>
	<td width=250 align=left>
		<input type="text" name="sg_name" value="{$sg.dekanvorname} {$sg.dekanname}">
	</td>
</tr>
<tr>
	<td width=150>
		Pruefungs und Studiumsordnung
	</td>
	{if $sg.sg_po}
	<td width=250 align=left>
		<object data="{$pdf_poso_dir}{$sg.sg_po}" type="application/pdf" width="800" height="300">
 
		  <p>It appears you don't have a PDF plugin for this browser.
 			 No biggie... you can <a href="{$pdf_poso_dir}{$sg.sg_po}">click here to
 			 download the PDF file.</a></p>
		</object>
	</td>
	{else}
	<td width=250 align=left>
		zur Zeit kein PDF zum Anzeigen
	</td>
	{/if}
</tr>
<!--
<tr>
	<td width=150>
		Studiensordnung
	</td>
	<td width=250 align=left>
		<input type="text" name="sg_name" value="{$sg.sg_so}">
	</td>
</tr>
-->
<tr>
	<td width=150>
		Erstellungsdatum
	</td>
	<td width=250 align=left>
		<input type="text" name="sg_name" disabled=true value="{$sg.sg_createdate}">
	</td>
</tr>
<tr>
	{if $sg.sg_modulhandbuch}
	<td width=150>
		Modulhandbuch
	</td>
	<td width=250 align=left>
		<object data="{$pdf_modulhandbuch_dir}{$sg.sg_modulhandbuch}" type="application/pdf" width="800" height="300">
 
		  <p>It appears you don't have a PDF plugin for this browser.
 			 No biggie... you can <a href="{$pdf_modulhandbuch_dir}{$sg.sg_modulhandbuch}">click here to
 			 download the PDF file.</a></p>
		</object>
	</td>
	{else}
	<td width=150>
		Modulhandbuch
	</td>
	<td width=250 align=left>
		zur Zeit kein PDF zum Anzeigen
	</td>
	{/if}
</tr>
<tr>
	<td width=150>
		Status des Studiengangs
	</td>
	<td width=250 align=left>
		<input type="radio" name="sg_status" value="kreiert"{if $sg.sg_status==kreiert} checked="checked"{/if}> kreiert<br>
		<input type="radio" name="sg_status" value="konstruiert"{if $sg.sg_status==konstruiert} checked="checked"{/if}> konstruiert<br>
		<input type="radio" name="sg_status" value="beschlossen"{if $sg.sg_status==beschlossen} checked="checked"{/if}> beschlossen<br>
		<input type="radio" name="sg_status" value="abgestimmt"{if $sg.sg_status==abgestimmt} checked="checked"{/if}> abgestimmt<br>
		<input type="radio" name="sg_status" value="bestaetigt"{if $sg.sg_status==bestaetigt} checked="checked"{/if}> best&auml;tigt
	</td>
</tr>
</table>

{if $modullist==true}
<tr>
<th colspan=9> Liste aller Module dieses SG inklusive Details 
</th>
</tr>

<tr>
<th>Modulname</th>
<th>Modul-ID</th>
<th>Name von Verantwortlicher</th>
<th>Vorname von Verantwortlicher</th>
<th>Modulstatus</th>
<th>letzte Aederung</th>
<th>Institut</th>
<th>Dauer</th>
<th>Qualifikationsziel</th>

<th></th>
</tr>

{foreach from=$modullist item=var}
<tr>
<td>{$var.modul_name}</td>
<td>{$var.modul_id}</td>
<td>{$var.verantw_name}</td>
<td>{$var.verantw_vorname}</td>
<td>{$var.modul_status}</td>
<td>{$var.modul_last_cha}</td>
<td>{$var.modul_institut}</td>
<td>{$var.modul_duration}</td>
<td>{$var.modul_qualifytarget}</td>
</tr>
{/foreach}

<tr>
<th>Inhalt</th>
<th>Fachliteratur</th>
<th>Lehrformen</th>
<th>Vorraussetzungen</th>
<th>Hauefigkeit</th>
<th>Verwendbarkeit</th>
<th>Leistungspunkte</th>
<th>Vorraussetzung fuer Leistungsnachweis</th>
<th>Arbeitsaufwand</th>
</tr>

{foreach from=$modullist item=var}
<tr>
<td>{$var.modul_content}</td>
<td>{$var.modul_literature}</td>
<td>{$var.modul_teachform}</td>
<td>{$var.modul_required}</td>
<td>{$var.modul_frequency}</td>
<td>{$var.modul_usability}</td>
<td>{$var.modul_lp}</td>
<td>{$var.modul_conditionforln}</td>
<td>{$var.modul_effort}</td>
</tr>
{/foreach}


<tr>
<th colspan=9> Liste aller Module inklusive Details
</th>
</tr>

<tr>
<th>Modulname</th>
<th>Modul-ID</th>
<th>Name von Verantwortlicher</th>
<th>Vorname von Verantwortlicher</th>
<th>Modulstatus</th>
<th>letzte Aederung</th>
<th>Institut</th>
<th>Dauer</th>
<th>Qualifikationsziel</th>

<th></th>
</tr>

{foreach from=$list_all_moduls item=var}
<tr>
<td>{$var.modul_name}</td>
<td>{$var.modul_id}</td>
<td>{$var.verantw_name}</td>
<td>{$var.verantw_vorname}</td>
<td>{$var.modul_status}</td>
<td>{$var.modul_last_cha}</td>
<td>{$var.modul_institut}</td>
<td>{$var.modul_duration}</td>
<td>{$var.modul_qualifytarget}</td>
</tr>
{/foreach}

<tr>
<th>Inhalt</th>
<th>Fachliteratur</th>
<th>Lehrformen</th>
<th>Vorraussetzungen</th>
<th>Hauefigkeit</th>
<th>Verwendbarkeit</th>
<th>Leistungspunkte</th>
<th>Vorraussetzung fuer Leistungsnachweis</th>
<th>Arbeitsaufwand</th>
</tr>

{foreach from=$list_all_moduls item=var}
<tr>
<td>{$var.modul_content}</td>
<td>{$var.modul_literature}</td>
<td>{$var.modul_teachform}</td>
<td>{$var.modul_required}</td>
<td>{$var.modul_frequency}</td>
<td>{$var.modul_usability}</td>
<td>{$var.modul_lp}</td>
<td>{$var.modul_conditionforln}</td>
<td>{$var.modul_effort}</td>
</tr>
{/foreach}
</table>
{/if}

<table width=500>
<tr>
	<td width=200 align=left>
	</td>
	<td width=300 align=right>
		<input type="submit" value="Senden" name="submit">
	</td>
</tr>
</table>
</form>
{include file="footer.tpl" title=foo}