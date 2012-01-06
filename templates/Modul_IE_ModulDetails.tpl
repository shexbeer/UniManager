{include file="header.tpl" title=foo}
Die Details zum selektierten Modul werden angezeigt.
<br><br>
{$status=$mod.modul_status}
{if $status=='Genehmigt'}                                                                      
             <span style="font-weight: bold; color: red;">Modul kann nicht geändert werden!!</span>
{/if}
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
            {if $status!='Genehmigt'}
            {$counter = 1}
            {foreach from=$lehrendelist item=var}
                {if $mod.modul_person_id == $var.lehrende_personenid}
                    <input checked="checked" type="radio" name="lehrende" value="{$var.lehrende_personenid}"> {$var.person_vorname} {$var.person_name}
                    {else}
                        <input type="radio" name="lehrende" value="{$var.lehrende_personenid}"> {$var.person_vorname} {$var.person_name}
                {/if}
                {if $counter % 4 == 0}
                    <br>
                {/if}
                {$counter = $counter + 1}
            {/foreach}
            {else}
            {$counter = 1}
            {foreach from=$lehrendelist item=var}
                {if $mod.modul_person_id == $var.lehrende_personenid}
                    <input checked="checked" type="radio" name="lehrende" value="{$var.lehrende_personenid}" disabled="true"> {$var.person_vorname} {$var.person_name}
                    {else}
                        <input type="radio" name="lehrende" value="{$var.lehrende_personenid}" disabled="true"> {$var.person_vorname} {$var.person_name}
                {/if}
                {if $counter % 4 == 0}
                    <br>
                {/if}
                {$counter = $counter + 1}
            {/foreach}
            {/if}
            </td>
        </tr>
        <tr> 
            <td align="right">
                Modulstatus:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <select name="modul_status" size="1">
                    <option {if $mod.modul_status == "Erstellt"} selected{/if} disabled="true">Erstellt </option>
                    <option {if $mod.modul_status == "Bearbeitung"}selected{/if} disabled="true">Bearbeitung</option>
                    <option {if $mod.modul_status == "Genehmigt"} selected{/if} disabled="true">Genehmigt</option>
                </select>
            {else}
                    <select name="modul_status" size="1" disabled="true">
                    <option {if $mod.modul_status == "Erstellt"} selected{/if} disabled="true">Erstellt </option> 
                    <option {if $mod.modul_status == "Bearbeitung"}selected{/if} disabled="true">Bearbeitung</option>
                    <option {if $mod.modul_status == "Genehmigt"} selected{/if} disabled="true">Genehmigt</option>
                </select>
            {/if}        
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
          {if $status!='Genehmigt'}      
                <input name="modul_institut" type="text" value="{$mod.modul_institut}" size="30" maxlength="45">
          {else}
              <input name="modul_institut" type="text" value="{$mod.modul_institut}" size="30" maxlength="45" disabled="true">
          {/if}             
          </td>
        </tr>
        <tr>
            <td align="right">
                Dauer:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <input name="modul_duration" type="text" value="{$mod.modul_duration}" size="1" maxlength="1">
            {else}
                 <input name="modul_duration" type="text" value="{$mod.modul_duration}" size="1" maxlength="1" disabled="true">    
            {/if} 
        </tr>
        <tr>
            <td align="right">
                Qualifikationsziel:
            </td>
            <td>
            {if $status!='Genehmigt'} 
                <textarea cols="40" rows="5" name="modul_qualifytarget">{$mod.modul_qualifytarget}</textarea>
            {else}
                <textarea cols="40" rows="5" name="modul_qualifytarget" disabled="true">{$mod.modul_qualifytarget}</textarea>
            {/if}
            </td>
        </tr>
        <tr>
            <td align="right">
                Inhalt:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <textarea cols="80" rows="8" name="modul_content" >{$mod.modul_content}</textarea>
            {else}
                <textarea cols="80" rows="8" name="modul_content" disabled="true">{$mod.modul_content}</textarea>
            {/if} 
            </td>
        </tr>
        <tr>
            <td align="right">
                Fachliteratur:
            </td>
            <td>
            {if $status!='Genehmigt'} 
                <textarea cols="40" rows="5" name="modul_literature">{$mod.modul_literature}</textarea>
            {else}
                 <textarea cols="40" rows="5" name="modul_literature" disabled="true">{$mod.modul_literature}</textarea>                                                                                             {/if}
            </td>
        </tr>
        <tr>
            <td align="right">
                Lehrformen:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <textarea cols="30" rows="4" name="modul_teachform">{$mod.modul_teachform}</textarea>
            {else}
                  <textarea cols="30" rows="4" name="modul_teachform" disabled="true">{$mod.modul_teachform}</textarea>
            {/if}
            </td>
        </tr>
        <tr>
            <td align="right">
                Vorraussetzungen:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <textarea cols="40" rows="5" name="modul_required">{$mod.modul_required}</textarea>
            {else}
                 <textarea cols="40" rows="5" name="modul_required" disabled="true">{$mod.modul_required}</textarea>
            {/if}
            </td>
        </tr>
        <tr>
            <td align="right">
                H&aumlufigkeit:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <select name="modul_frequency" size="1">
                    <option {if $mod.modul_frequency == "im Wintersemester"}selected{/if}>im Wintersemester</option>
                    <option {if $mod.modul_frequency == "im Sommersemester"} selected{/if}>im Sommersemester</option>
                    <option {if $mod.modul_frequency == "jedes Semester"} selected{/if}>jedes Semester</option>
                </select>
            {else}
                 <select name="modul_frequency" size="1" disabled="true">
                    <option {if $mod.modul_frequency == "im Wintersemester"}selected{/if}>im Wintersemester</option>
                    <option {if $mod.modul_frequency == "im Sommersemester"} selected{/if}>im Sommersemester</option>
                    <option {if $mod.modul_frequency == "jedes Semester"} selected{/if}>jedes Semester</option>
                </select>
            {/if}
            </td>
        </tr>
        <tr>
            <td align="right">
                Verwendbarkeit:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <input name="modul_usability" type="text" value="{$mod.modul_usability}" size="30" maxlength="200">
            {else}
                <input name="modul_usability" type="text" value="{$mod.modul_usability}" size="30" maxlength="200" disabled="true"> 
            {/if}
            </td>
        </tr>
        <tr>
            <td align="right">
                Leistungspunkte:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <input name="modul_lp" type="text" value="{$mod.modul_lp}" size="2" maxlength="2">
            {else}
                 <input name="modul_lp" type="text" value="{$mod.modul_lp}" size="2" maxlength="2" disabled="true">
            {/if}
            </td>
        </tr>
        <tr>
            <td align="right">
                Vorraussetzung f&uuml;r Leistungsnachweis:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <textarea cols="30" rows="3" name="modul_conditionforln">{$mod.modul_conditionforln}</textarea>
            {else}
                <textarea cols="30" rows="3" name="modul_conditionforln" disabled="true">{$mod.modul_conditionforln}</textarea>
            {/if}
            </td>
        </tr>
        <tr>
            <td align="right">
                Arbeitsaufwand:
            </td>
            <td>
            {if $status!='Genehmigt'}
                <textarea cols="50" rows="5" name="modul_effort">{$mod.modul_effort}</textarea>
            {else}
                 <textarea cols="50" rows="5" name="modul_effort" disabled="true">{$mod.modul_effort}</textarea>
            {/if} 
            </td>
        </tr>  
    </table>
    <table>
    <tr>
    <td align=left>
    {if $status!='Genehmigt'}
        <input type="reset" value=" Änderungen verwerfen">
        <input type="submit" value="Moduleintrag ändern" name="submit">
        </form>
    {else}
        <input type="reset" value=" Änderungen verwerfen" disabled="true">
        <input type="submit" value="Änderungseintrag erstellen" name="submit" disabled="true">
    {/if}
    </td>
</tr>
    </table>
    <br>
    Bestehende Änderungseinträge werden beim Erstellen überschrieben!!
</form>
{include file="footer.tpl" title=foo}



