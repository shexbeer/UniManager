{include file="header.tpl" title=foo}
Die Moduldetails zum selektierten Modul werden angezeigt.
<br><br>

<form action="Modul_IE.php?changemodul=true&forid={$mod.modul_id}" enctype="multipart/form-data" method="POST">
    <h1> Modulinhalt </h1>
    <table border="0" cellpadding="0" cellspacing="4">
        <tr>
            <td align="right">
                Modulname:
            </td>
            <td>
                <input name="modul_name" type="text" value="{$mod.modul_name}" size="30" maxlength="30" disabled="true" >
            </td>
        </tr>
        <tr>
            <td align="right">
                Modul-ID:
            </td>
            <td>
                <input name="modul_id" type="text" value="{$mod.modul_id}" size="3" maxlength="3" disabled="true">
            </td>
        </tr>
        <tr>
            <td align="right">
                Verantwortlicher:
            </td>
            <td>
            {$counter = 1}
            {foreach from=$lehrendelist item=var}
                {if $mod.modul_person_id == $var.lehrende_personenid}
                    <input checked="checked" type="radio" name="lehrende" value="{$var.lehrende_id}"> {$var.person_vorname} {$var.person_name}
                    {else}
                        <input type="radio" name="lehrende" value="{$var.lehrende_id}"> {$var.person_vorname} {$var.person_name}
                {/if}
                {if $counter % 4 == 0}
                    <br>
                {/if}
                {$counter = $counter + 1}
            {/foreach}
            </td>
        </tr>
        <tr> 
            <td align="right">
                Modulstatus:
            </td>
            <td>
                <select name="modul_status" size="1">
                    <option {if $mod.modul_status == "Bearbeitung"}selected{/if}>Bearbeitung</option>
                    <option {if $mod.modul_status == "Genehmigt"} selected{/if}>Genehmigt</option>
                </select>
                 Nach der Bearbeitung wird der Status automatisch auf "Bearbeitung" gesetzt, es sei den "Genehmigt" wird ausgew�hlt!
            </td>
           
        </tr>
        <tr>
            <td align="right">
                Letzte &Aumlnderungen:
            </td>
            <td>
                <input name="modul_last_cha" type="text" value="{$mod.modul_last_cha}" size="10" maxlength="25" disabled="true">
            </td>
        </tr>  
        <tr>
            <td align="right">
                Institut:
            </td>
            <td>
                <input name="modul_institut" type="text" value="{$mod.modul_institut}" size="30" maxlength="45">
            </td>
        </tr>
        <tr>
            <td align="right">
                Dauer:
            </td>
            <td>
                <input name="modul_duration" type="text" value="{$mod.modul_duration}" size="1" maxlength="1">
            </td>
        </tr>
        <tr>
            <td align="right">
                Qualifikationsziel:
            </td>
            <td> 
                <textarea cols="40" rows="5" name="modul_qualifytarget">
               		 {$mod.modul_qualifytarget}
                </textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Inhalt:
            </td>
            <td>
                <textarea cols="80" rows="8" name="modul_content" >
                	{$mod.modul_content}
                </textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Fachliteratur:
            </td>
            <td>
                <textarea cols="40" rows="5" name="modul_literature">
                	{$mod.modul_literature}
                </textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Lehrformen:
            </td>
            <td>
                <textarea cols="30" rows="4" name="modul_teachform">
                	{$mod.modul_teachform}
                </textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Vorraussetzungen:
            </td>
            <td>
                <textarea cols="40" rows="5" name="modul_required">
	                {$mod.modul_required}
                </textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                H&aumlufigkeit:
            </td>
            <td>
                <input name="modul_frequency" type="text" value="{$mod.modul_frequency}" size="30" maxlength="50">
            </td>
        </tr>
        <tr>
            <td align="right">
                Verwendbarkeit:
            </td>
            <td>
                <input name="modul_usability" type="text" value="{$mod.modul_usability}" size="30" maxlength="100">
            </td>
        </tr>
        <tr>
            <td align="right">
                Leistungspunkte:
            </td>
            <td>
                <input name="modul_lp" type="text" value="{$mod.modul_lp}" size="2" maxlength="2">
            </td>
        </tr>
        <tr>
            <td align="right">
                Vorraussetzung f&uuml;r Leistungsnachweis:
            </td>
            <td>
                <textarea cols="30" rows="3" name="modul_conditionforln">
                	{$mod.modul_conditionforln}
                </textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Arbeitsaufwand:
            </td>
            <td>
                <textarea cols="50" rows="5" name="modul_effort">
                	{$mod.modul_effort}
                </textarea>
            </td>
        </tr>  
    </table>
    <table>
    <tr>
    <td align=left>
        <input type="reset" value=" �nderungen verwerfen">
        <input type="submit" value="Moduleintrag �ndern" name="submit">
    </td>
</tr>
    </table>
</form>
{include file="footer.tpl" title=foo}



