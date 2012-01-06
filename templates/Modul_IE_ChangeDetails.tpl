{include file="header.tpl" title=foo} 
Die Details zur selektierten &Aumlnderung werden angezeigt<br>
<form action="Modul_IE.php?changechange=true&forid={$list.aenderung_mid}" enctype="multipart/form-data" method="POST">
    <h1> Änderungsinhalt </h1>
    <table border="0" cellpadding="0" cellspacing="4">
        <tr>
            <td align="right">
                Änderungs-ID:
            </td>
            <td>
                <input name="aenderung_id" type="text" value="{$list.aenderung_id}" size="3" maxlength="3" disabled="true">
            </td>
        </tr>
        <tr>
            <td align="right">
                Modulname:
            </td>
            <td>
                <input name="aenderung_name" type="text" value="{$list.aenderung_mname}" size="30" maxlength="30" disabled="true" >
            </td>
        </tr>
        <tr>
            <td align="right">
                Modul-ID:
            </td>
            <td>
                <input name="aenderung_id" type="text" value="{$list.aenderung_mid}" size="3" maxlength="3" disabled="true">
            </td>
        </tr>
        <tr>
            <td align="right">
                Verantwortlicher:
            </td>
            <td>
            {$counter = 1}
            {foreach from=$lehrendelist item=var}
                {if $list.aenderung_pid == $var.lehrende_personenid}
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
                <select name="aenderung_status" size="1" disabled="true">
                    <option {if $list.aenderung_status == "Bearbeitung"}selected{/if}>Bearbeitung</option>
                    <option {if $list.aenderung_status == "Genehmigt"} selected{/if}>Genehmigt</option>
                </select>
            </td>
           
        </tr>
        <tr>
            <td align="right">
                Letzte &Aumlnderungen:
            </td>
            <td>
                <input name="aenderung_last_cha" type="text" value="{$list.aenderung_last_cha}" size="10" maxlength="25" disabled="true">
            </td>
        </tr>  
        <tr>
            <td align="right">
                Institut:
            </td>
            <td>
                <input name="aenderung_institut" type="text" value="{$list.aenderung_institut}" size="30" maxlength="45">
          </td>
        </tr>
        <tr>
            <td align="right">
                Dauer:
            </td>
            <td>
                <input name="aenderung_duration" type="text" value="{$list.aenderung_duration}" size="1" maxlength="1">
        </tr>
        <tr>
            <td align="right">
                Qualifikationsziel:
            </td>
            <td>
                <textarea cols="40" rows="5" name="aenderung_qualifytarget">{$list.aenderung_qualifytarget}</textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Inhalt:
            </td>
            <td>
                <textarea cols="80" rows="8" name="aenderung_content" >{$list.aenderung_content}</textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Fachliteratur:
            </td>
            <td>
                <textarea cols="40" rows="5" name="aenderung_literature">{$list.aenderung_literature}</textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Lehrformen:
            </td>
            <td>
                <textarea cols="30" rows="4" name="aenderung_teachform">{$list.aenderung_teachform}</textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Vorraussetzungen:
            </td>
            <td>
                <textarea cols="40" rows="5" name="aenderung_required">{$list.aenderung_required}</textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                H&aumlufigkeit:
            </td>
            <td>
                <select name="aenderung_frequency" size="1">
                    <option {if $list.aenderung_frequency == "im Wintersemester"}selected{/if}>im Wintersemester</option>
                    <option {if $list.aenderung_frequency == "im Sommersemester"} selected{/if}>im Sommersemester</option>
                    <option {if $list.aenderung_frequency == "jedes Semester"} selected{/if}>jedes Semester</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">
                Verwendbarkeit:
            </td>
            <td>
                <input name="aenderung_usability" type="text" value="{$list.aenderung_usability}" size="30" maxlength="200">
            </td>
        </tr>
        <tr>
            <td align="right">
                Leistungspunkte:
            </td>
            <td>
                <input name="aenderung_lp" type="text" value="{$list.aenderung_lp}" size="2" maxlength="2">
            </td>
        </tr>
        <tr>
            <td align="right">
                Vorraussetzung f&uuml;r Leistungsnachweis:
            </td>
            <td>
                <textarea cols="30" rows="3" name="aenderung_conditionforln">{$list.aenderung_conditionforln}</textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Arbeitsaufwand:
            </td>
            <td>
                <textarea cols="50" rows="5" name="aenderung_effort">{$list.aenderung_effort}</textarea>
            </td>
        </tr>  
    </table>
    <table>
    <tr>
    <td align=left>
        <input type="reset" value=" Änderungen verwerfen">
        <input type="submit" value="Moduleintrag ändern" name="submit">
        </form>
    </td>
</tr>
    </table>
    <br>
</form>
{include file="footer.tpl" title=foo}




















