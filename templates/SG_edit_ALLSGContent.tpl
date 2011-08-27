{include file="header.tpl" title=foo}

 
<br><br>

<table>
<tr>
<th colspan=9> Details den ausgewälten Studiengänge
</th>
</tr>
<tr>
<th>Studiengangname</th>
<th>Studiengang_ID</th>
<th>Name des Dekans</th>
<th>Vorname des Dekans</th>
<th>Pruefungsordnung</th>
<th>Studiensordnung</th>
<th>Erstellungsdatum</th>
<th>Modulhandbuch</th>
<th>Status des Studiengangs</th>

<th></th>
</tr>

{foreach from=$sgdetail item=var}
<tr>
<td>{$var.sg_name}</td>
<td>{$var.sg_id}</td>
<td>{$var.dekanname}</td>
<td>{$var.dekanvorname}</td>
<td>{$var.sg_po}</td>
<td>{$var.sg_so}</td>
<td>{$var.sg_createdate}</td>
<td>{$var.sg_modulhandbuch}</td>
<td>{$var.sg_status}</td>
</tr>
{/foreach}


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
{/if}

</table>

{include file="footer.tpl" title=foo}