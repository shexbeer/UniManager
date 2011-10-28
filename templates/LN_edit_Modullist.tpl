{include file="header.tpl" title=foo}

Die Liste zeigt alle existierenden Leistungsnachweise, welche bearbeitet werden können.
<br><br>

<table>
<tr>
	<th>Modulname</th>
	<th>Verantwortlicher</th>
	<th>Datum des Leistungsnachweises</th>
	<th></th>
</tr>

{foreach from=$modList item=var}
<tr>
	<td>{$var.Name}</td>
	<td align=center>{$var.Verantwortlicher}</td>
	<td align=center>{$var.Datum}</td>
	<td><a href="{$rootDir}LN_edit.php?forid={$var.ModulID}">ausw&auml;hlen</a></td>
</tr>
{/foreach}
</table>

{include file="footer.tpl" title=foo}