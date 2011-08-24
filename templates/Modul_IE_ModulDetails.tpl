{include file="header.tpl" title=foo}
Das Ergebnis der Aenderung vom Modul wurd gezeigt
<br><br>

<table border>

<tr>
<th>Modulname</th>
<th>Modul-ID</th>
<th>Verantwortlicher</th>
<th>Modulstatus</th>
<th>letzte Aederung</th>
<th>Institut</th>
<th>Dauer</th>
<th>Qualifikationsziel</th>
<th>Inhalt</th>
<th></th>
</tr>

{foreach from=$modDetails item=var}
<tr>
<td>{$var.modul_name}</td>
<td>{$var.modul_id}</td>
<td style="text-align: center;">{$var.modul_person_id}</td>
<td>{$var.modul_status}</td>
<td>{$var.modul_last_cha}</td>
<td>{$var.modul_institut}</td>
<td>{$var.modul_duration}</td>
<td>{$var.modul_qualifytarget}</td>
<td>{$var.modul_content}</td>
</tr>
{/foreach}

<tr>
<th>Fachliteratur</th>
<th>Lehrformen</th>
<th>Vorraussetzungen</th>
<th>Hauefigkeit</th>
<th>Verwendbarkeit</th>
<th>Leistungspunkte</th>
<th>Vorraussetzung fuer Leistungsnachweis</th>
<th>Arbeitsaufwand</th>
</tr>

{foreach from=$modDetails item=var}
<tr>
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

{include file="footer.tpl" title=foo}