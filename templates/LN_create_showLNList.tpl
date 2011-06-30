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
	<td>{$var.modul_name}</td>
	<td>{$var.ln_datum}</td>
	<td>{$var.ln_pruefer}</td>
	<td style="text-align: center;">{$var.ln_vorraussetzungen}</td>
	<td><a href="{$rootDir}LN_create.php?forid={$var.ln_id}">anmelden</a></td>
</tr>
{/foreach}
</table>

{include file="footer.tpl" title=foo}