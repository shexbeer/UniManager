{include file="header.tpl" title=foo}

W&auml;hlen sie einen Studiengang aus, zu dem ein Modulangebot erstellt werden soll.
<br><br>
{$semester}

<br><br>
<table>
<tr>
	<th>Studiengang-Typ</th>
	<th>Name</th>
	<th>Dekan</td>
	<th>Status</th>
	<th></th>
</tr>

{foreach from=$sglist item=var}
<tr style="text-align: center;">
	<td>{$var.sg_typ}</td>
	<td>{$var.sg_name}</td>
	<td>{$var.sg_dekan}</td>
	<td>{$var.sg_status}</td>
	<td><a href="{$rootDir}MA_create.php?forid={$var.sg_id}">ausw&auml;hlen</a></td>
</tr>
{/foreach}
</table>
{include file="footer.tpl" title=foo}