{include file="header.tpl" title=foo}

Die Liste aller Module zu denen &Auml;nderungen vorgenommen werden k&ouml;nnen
<br>
<input type="button" onclick="window.location='{$rootDir}Modul_IE.php?new=true'" value="Modul erstellen" style="color: green;"></a>
<br>

<table border="1" cellpadding="1" rules="cols">
<tr>
<th> Modulname </th>
<th> Verantwortlicher </th>
<th> Status </th>
<th> Modul modifizieren </th>
<th> Genehmigen </th>
<th></th>

</tr>

{foreach from=$modDetails item=var}
<tr>
<td style="text-align: center;">{$var.modul_name}</td>
<td style="text-align: center;">{$var.verantwortlicher}</td>
<td style="text-align: center;">{$var.modul_status}</td>
{if $var.modul_status=="Genehmigt"}
<td style="text-align: left;"><input type="button" onclick="window.location ='{$rootDir}Modul_IE.php?forid={$var.modul_id}'" value="Modul anzeigen" style="width: 100;"></a>
{else}
<td style="text-align: left;"><input type="button" onclick="window.location ='{$rootDir}Modul_IE.php?forid={$var.modul_id}'" value="Modul öffnen" style="width: 100;"></a>
{/if}
{foreach from=$a_list item=vari}
        {if $vari.aenderung_mid==$var.modul_id}
              <input type="button" onclick="window.location ='{$rootDir}Modul_IE.php?change=true&forid={$vari.aenderung_id}'" value="Änderung bearbeiten"></a>
        {/if}
{/foreach}
</td>
{$check=false}
{foreach from=$a_list item=vari}
        
        {if $vari.aenderung_mid==$var.modul_id}
            {$check=true}  
        {/if}
{/foreach}
<td style="text-align: right;">
   {if $check==true}
        {foreach from=$a_list item=vari}
            {if $vari.aenderung_mid==$var.modul_id}
                <input type="button" onclick="window.location ='{$rootDir}Modul_IE.php?apply=true&modul=false&forid={$vari.aenderung_id}'" value="Änderung"></a>
            {/if}
        {/foreach}
   {/if}
   {if $var.modul_status=="Bearbeitung"}
        <input type="button" onclick="window.location ='{$rootDir}Modul_IE.php?apply=true&modul=true&forid={$var.modul_id}'" value="Modul"></a>
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
Beim genehmigen eines Moduls werden nichtgenehmigte Änderungen automatisch gelöscht. <br>
Bereits genehmigte Module können nur angezeigt und nicht mehr verändert werden .<br>
{include file="footer.tpl" title=foo}


