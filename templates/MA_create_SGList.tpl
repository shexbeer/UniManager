{include file="header.tpl" title=foo}

W&auml;hlen sie einen Studiengang aus, zu dem ein Modulangebot erstellt werden soll.

<br><br>
<table>
<tr>
	<th>Studiengang-ID</th>
	<th>Name</th>
	<th>Status</th>
	<th></th>
</tr>

{foreach from=$SG item=var}
<tr style="text-align: center;">
	<td>{$var.sg_id}</td>
	<td>{$var.sg_name}</td>
	<td>{$var.sg_status}</td>
	<td><a href="{$rootDir}MA_create.php?forid={$var.sg_id}">ausw&auml;hlen</a></td>
</tr>
{/foreach}
</table>
{include file="footer.tpl" title=foo}