{include file="header.tpl" title=foo}

Die Liste aller Module zu denen &Auml;nderungen vorgenommen werden k&ouml;nnen
<br>
<a href="{$rootDir}Modul_IE.php?new=true"}>Neues Modul erstellen</a>
<br>

<table border="1" cellpadding="0" cellspacing="4">
<tr>
<th>Modulname</th>
<th>Verantwortlicher</th>
<th>Modulstatus</th>
<th>Modul modifizieren</th>
<th>Bestätigungsaktionen</th>
<th>Modul löschen</th>

</tr>

{foreach from=$modDetails item=var}
<tr>
<td style="text-align: center;">{$var.modul_name}</td>
<td style="text-align: center;">{$var.verantwortlicher}</td>
<td style="text-align: center;">{$var.modul_status}</td>
{if $var.modul_status=="Genehmigt"}
<td style="text-align: center;"><a href="{$rootDir}Modul_IE.php?forid={$var.modul_id}">Modul anzeigen</a>
{else}
<td style="text-align: center;"><a href="{$rootDir}Modul_IE.php?forid={$var.modul_id}">&Aumlnderung erstellen</a>
{/if}
{foreach from=$a_list item=vari}
        {if $vari.aenderung_mid==$var.modul_id}
              <a href="{$rootDir}Modul_IE.php?change=true&forid={$vari.aenderung_id}">&Aumlnderung bearbeiten</a>
        {/if}
{/foreach}
</td>
{$check=false}
{foreach from=$a_list item=vari}
        
        {if $vari.aenderung_mid==$var.modul_id}
            {$check=true}  
        {/if}
{/foreach}
<td style="text-align: center;">
   {if $check==true}
        {foreach from=$a_list item=vari}
            {if $vari.aenderung_mid==$var.modul_id}
                <a href="{$rootDir}Modul_IE.php?apply=true&modul=false&forid={$vari.aenderung_id}">&Aumlnderung genehmigen</a>
            {/if}
        {/foreach}
   {/if}
   {if $var.modul_status=="Bearbeitung"}
        <a href="{$rootDir}Modul_IE.php?apply=true&modul=true&forid={$var.modul_id}">Modul genehmigen</a>
   {/if}
</td>
<td style="text-align: center;">
{if $check==true}
<a href="{$rootDir}Modul_IE.php?delete=true&forid={$var.modul_id}&extended=true" style="color: red;font-weight: bold; text-align: center;">X</a>
{else}
        <a href="{$rootDir}Modul_IE.php?delete=true&forid={$var.modul_id}&extended=false" style="color: red;font-weight: bold; text-align: center;">X</a>
{/if}
</td>
</tr>
{/foreach}
</table>
<br><br>
Genehmigte Änderungen werden automatisch in das zugehörige Modul kopiert.<br>
Beim genehmigen eines Moduls werden nichtgenehmigte Änderungen automatisch gelöscht. >br>
Bereits genehmigte Module können nur angezeigt und nicht mehr verändert werden .<br>
{include file="footer.tpl" title=foo}


