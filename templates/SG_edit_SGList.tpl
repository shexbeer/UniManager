{include file="header.tpl" title=foo}

Die Liste zeigt alle existierender Studiengaenge durch Studiengangnamen, Studiengang_ID und Dekanname
<br><br>

<table>
<tr>
<th>Studeingangnamen</th>
<th>Studiengang_ID</th>
<th>Name des Dekans</th>
<th></th>
</tr>

{foreach from=$SGList item=var}
<tr>
<td>{$var.sg_name}</td>
<td>{$var.sg_id}</td>
<td>{$var.sg_dekan}</td>
</tr>
{/foreach}
</table>

{include file="footer.tpl" title=foo}