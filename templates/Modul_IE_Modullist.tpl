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
<td><a href="{$rootDir}Modul_IE.php?forid={$var.modul_id}">&Aumlnderung erstellen</a>
{foreach from=$a_list item=vari}
        {if $vari.aenderung_mid==$var.modul_id}
              <a href="{$rootDir}Modul_IE.php?change=true&forid={$vari.aenderung_id}">&Aumlnderung bearbeiten</a></td>
        {/if}
{/foreach}
</tr>
{/foreach}
</table>
<br><br>
Bereits genehmigte Module k�nnen nur angezeigt werden.

{include file="footer.tpl" title=foo}