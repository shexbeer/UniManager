{include file="header.tpl" title=foo}

Die Liste zeigt alle existierender Studiengaenge.
Einen ausw&auml;hlen um ihn zu editieren bzw zu l&ouml;schen oder hier einen neuen anlegen:<br><br>
	<a href="SG_edit.php?createnew=yes">Neuen Studiengang anlegen</a>
<br><br>

<table>
<tr>
	<th>Studeingangnamen</th>
	<!-- <th>Studiengang_ID</th> -->
	<th>Name des Dekans</th>
	<th>Status</th>
	<th></th>
</tr>

{foreach from=$SGList item=var}
<tr>
	<td>{$var.sg_name}</td>
	<!-- <td>{$var.sg_id}</td> -->
	<td align=center>{$var.sg_dekan}</td>
	<td>{$var.sg_status}</td>
	<td><a href="SG_edit.php?forid={$var.sg_id}">ausw&auml;hlen</a></td>
</tr>
{/foreach}
</table>

{include file="footer.tpl" title=foo}