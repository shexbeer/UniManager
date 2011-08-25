{include file="header.tpl" title=foo}

Die Liste zeigt Detail des Studiengangs
<br><br>

<table>
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

{foreach from=$SGDetails item=var}
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
</table>

{include file="footer.tpl" title=foo}