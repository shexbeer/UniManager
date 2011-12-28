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
<td align="center" valign="top">{$var.modul_name}</td>
<td align="center" valign="top">{$var.modul_id}</td>
<td align="center" valign="top">{$var.modul_person_id}</td>
<td align="center" valign="top">{$var.modul_status}</td>
<td align="center" valign="top">{$var.modul_last_cha}</td>
<td valign="top">{$var.modul_institut}</td>
<td align="center" valign="top">{$var.modul_duration}</td>
<td valign="top">{$var.modul_qualifytarget}</td>
<td "valign="top">
    <div style="width:100%; height:80%; overflow:scroll;">
        {$var.modul_content}</td>
    </div>
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
<td valign="top">{$var.modul_literature}</td>
<td valign="top">{$var.modul_teachform}</td>
<td valign="top">{$var.modul_required}</td>
<td align="center" valign="top">{$var.modul_frequency}</td>
<td valign=top>{$var.modul_usability}</td>
<td align="center" valign="top">{$var.modul_lp}</td>
<td valign="top">{$var.modul_conditionforln}</td>
<td valign="top">{$var.modul_effort}</td>
</tr>
{/foreach}

</table>

{include file="footer.tpl" title=foo}