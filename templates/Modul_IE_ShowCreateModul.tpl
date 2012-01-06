{include file="header.tpl" title=foo}

<form action="Modul_IE.php?new=true" enctype="multipart/form-data" method="POST">   
<h1>Neues Modul erstellen</h1>
<table border="0" cellpadding="0" cellspacing="4">
        {if $error}
        {foreach from=$error item=var}
            <span style="font-weight: bold; color: red;">{$var}<br></span>
        {/foreach}
        {/if}
        <tr>
            <td align="left">
                Modulname: <input name="modul_name" type="text" size="30" maxlength="30">
            </td>
                
        </tr>
        <tr>
            <td>
            {$counter = 1}
            {foreach from=$list item=var}
                        <input type="radio" name="lehrende" value="{$var.lehrende_personenid}"> {$var.person_vorname} {$var.person_name}
                {if $counter % 4 == 0}
                    <br>
                {/if}
                {$counter = $counter + 1}
            {/foreach}
            </td>
        </tr>
</table>
<input type="hidden" name="required_fields" value="modul_name,lehrende">
    <input type="reset" value=" Änderungen verwerfen">
    <input type="submit" value="Moduleintrag ändern" name="submit">
</form>
{include file="footer.tpl" title=foo}
   