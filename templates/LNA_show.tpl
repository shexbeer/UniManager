{include file="header.tpl" title=foo}

Angemeldete Pr&uuml;fungen und Noten wenn eingetragen<br><br>

<table width="500">
<tr>
	<th>Modulname</th>
	<th>Datum</th>
	<th>Note</th>
</tr>

{foreach from=$data item=var}
<tr>
	<td>{$var.lna_modul_name}</td>
	<td>{$var.lna_registrationdate}</td>
	{if $var.lna_mark}
		<td style="text-align: center;">{$var.lna_mark}</td>	
	{else}
		<td style="text-align: center;">-</td>
	{/if}

</tr>
{/foreach}

</table>


{include file="footer.tpl" title=foo}