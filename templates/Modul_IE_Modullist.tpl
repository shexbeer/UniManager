{include file="header.tpl" title=foo}

Die Liste aller Module zu denen &Auml;nderungen vorgenommen werden k&ouml;nnen
<br>
<a href="{$rootDir}Modul_IE.php?new=true"}>Neues Modul erstellen</a>
<br>

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


{$check=false}
{foreach from=$a_list item=vari}
        
        {if $vari.aenderung_mid==$var.modul_id}
            {$check=true}  
        {/if}
{/foreach}
<td>
   {if $check==true}
   {foreach from=$a_list item=vari}
        {if $vari.aenderung_mid==$var.modul_id}
        <a href="{$rootDir}Modul_IE.php?apply=true&modul=false&forid={$vari.aenderung_id}">&Aumlnderung genehmigen</a>
        {/if}
{/foreach}
   {/if} 
</td>
<td>
{if $check==true}
<a href="{$rootDir}Modul_IE.php?delete=true&forid={$var.modul_id}&extended=true" style="color: red;font-weight: bold;">X</a>
{else}
        <a href="{$rootDir}Modul_IE.php?delete=true&forid={$var.modul_id}&extended=false" style="color: red;font-weight: bold;">X</a>
{/if}
</td>
</tr>
{/foreach}
</table>
<br><br>
Bereits genehmigte Module können nur angezeigt werden.
{include file="footer.tpl" title=foo}


