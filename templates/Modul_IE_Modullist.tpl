{include file="header.tpl" title=foo}

Die Liste aller Module zu denen &Auml;nderungen vorgenommen werden k&ouml;nnen
<br><br>

<table>
<tr>
<th>Modulname</th>
<th>Verantwortlicher</th>
<th>Modulstatus</th>
<th></th>
</tr>

{foreach from=$modDetails item=var}
<tr>
<td>{$var.modul_name}</td>
<td style="text-align: center;">{$var.verantwortlicher}</td>
<td>{$var.modul_status}</td>
<td><a href="{$rootDir}Modul_IE.php?forid={$var.modul_id}">&Aumlnderung erstellen</a></td>
</tr>
{/foreach}
</table>
<br><br>
Bereits genehmigte Module können nur angezeigt werden.

{include file="footer.tpl" title=foo}