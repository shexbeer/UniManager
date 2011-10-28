{include file="header.tpl" title=foo}

Alle Anmeldungen zum ausgewaehlten Leistungsnachweis
<br><br>
<form action="LN_edit.php" method="POST">

<table>
<tr>
<th>Matrikelnummer</th>
<th>Anmeldedatum</th>
<th>Note</th>
<th></th>
</tr>

{foreach from=$LNAList item=var}
<tr>
<td>{$var.Matrikelnummer}</td>
<td>{$var.Anmeldedatum}</td>
	<td>
		<input type="text" name="{$var.lna_id}" value="{$var.Note}" size="3">
	</td>
</tr>
{/foreach}
</table>

<input type="submit" value="Speichern">
</form>

{include file="footer.tpl" title=foo}