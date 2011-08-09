{include file="header.tpl" title=foo}

W&auml;hlen sie einen Studiengang aus, zu dem ein Modulangebot erstellt werden soll.

<br><br>
<table>
<tr>
	<th>Studiengang-ID</th>
	<th>Name des Studiengangs</th>
	<th></th>
</tr>

{foreach from=$SG item=var}
<tr>
	<td>{$var.id}</td>
	<td style="text-align: center;">{$var.name}</td>
	<td><a href="{$rootDir}MA_create.php?forid={$var.id}">ausw&auml;hlen</a></td>
</tr>
{/foreach}
</table>
{include file="footer.tpl" title=foo}