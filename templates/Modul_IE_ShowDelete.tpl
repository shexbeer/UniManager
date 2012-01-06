{include file="header.tpl" title=foo}

<form action="Modul_IE.php?delete=true&forid={$id}" enctype="multipart/form-data" method="POST">
<table border="0" cellpadding="0" cellspacing="4">
<h1 style="color: red;font-weight: bolder;">Modul löschen...</h1>
<tr>
            <td align="right">
                Modul-ID:
            </td>
            <td>
                <input name="modul_id" type="text" value="{$id}" size="3" maxlength="3" disabled="true" style="azimuth: left;">
            </td>
            </tr>
            <tr>
            <td align="right">
                Modulname: 
            </td>
            <td>
                <input name="modul_name" type="text"  size="30" maxlength="30" value="{$name}" disabled="true" style="azimuth: left;">
            </td>
            </tr>
            {if $aid}
            <td></td>
            <td>
            Die mit diesem Modul verknüpften &Aumlndernungen werden automatisch mitgelöscht!!!
            </td>
            <tr>
            <td align="right">
                &Aumlnderungs-ID: 
            </td>
            <td>   
                <input name="a_id" type="text" size="30" maxlength="30" value="{$aid}" disabled="true" style="azimuth: left;">
                <input name="a_id" type="hidden" value="{$aid}">
            </td>
            </tr>
            {/if}
            
                

</table>
Wollen Sie das Modul wirklich löschen? Sie müssen vorher alle Leistungsnachweise aus diesem Modul entfernt haben und dieses Modul aus allen Modulangeboten und -aufstellungen entfernen.<br>
<input type="submit" value="Modul löschen" name="submit" style="color: red;">
</form> 
{include file="footer.tpl" title=foo}