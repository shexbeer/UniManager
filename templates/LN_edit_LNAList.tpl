{include file="header.tpl" title=foo}

Die Liste zeigt alle existierender Leistungsnachweise durch Modulnamen, Personen-IDs und Datum
<br><br>

<table>
<tr>
<th>Matrikelnummer</th>
<th>Anmeldedatum</th>
<th>Note</th>
<th></th>
</tr>

{foreach from=$LNAList item=var}
<tr>
<td>{$var.Matrikelnummer}</td>
<td>{$var.Anmeldedatum}</td>
<td>{$var.Note}</td>
</tr>
{/foreach}
</table>

{include file="footer.tpl" title=foo}