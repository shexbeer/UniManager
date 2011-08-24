{include file="header.tpl" title=foo}

Die Liste zeigt alle existierender Leistungsnachweise durch Modulnamen, Personen-IDs und Datum
<br><br>

<table>
<tr>
<th>Modulname</th>
<th>Verantwortlicher</th>
<th>Datum</th>
<th></th>
</tr>

{foreach from=$modList item=var}
<tr>
<td>{$var.Modulname}</td>
<td>{$var.Verantwortlicher}</td>
<td>{$var.Datum}</td>
<td><a href="{$rootDir}LN_edit.php?forid={$var.ModulID}">ausw&auml;hlen</a></td>
</tr>
{/foreach}
</table>

{include file="footer.tpl" title=foo}