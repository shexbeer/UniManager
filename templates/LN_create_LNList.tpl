{include file="header.tpl" title=foo}

Es werden hier alle Leistungsnachweise angezeigt, zu denen sie sich anmelden k&ouml;nnen.
<br><br>
<table>
<tr>
	<th>Modulname</th>
	<th>Datum</th>
	<th>Pruefer</th>
	<th>Vorraussetzungen</th>
	<th></th>
</tr>

{foreach from=$LN item=var}
<tr>
	<td>{$var.ln_modul_name}</td>
	<td>{$var.ln_date}</td>
	<td>{$var.ln_examiner}</td>
	<td style="text-align: center;">{$var.ln_requirement}</td>
	{if $var.angemeldet == true}
		<td style="color: red; font-weight: bold;">X</td>
	{else}
		<td><a href="{$rootDir}LN_create.php?forid={$var.ln_id}">anmelden</a></td>
	{/if}
	
</tr>
{/foreach}
</table>

{include file="footer.tpl" title=foo}