{include file="header.tpl" title=foo}  

W&auml;hlen sie einen Studiengang aus. zu dem die Studien- und Pr&uuml;fungsordnung editiert werden soll.

<br><br>
<table>

<tr>

<th>Studiengang-ID</th>
<th>Name</th>
<th>Status</th>
<th>Dekan</th>

</tr>
{foreach from=$SG item=var}
    <tr style="text-align: center;">
    <td>{$var.sg_id}</td>
    <td style="text-align: left;">{$var.sg_name}</td>
    <td>{$var.sg_status}</td>
    <td>{$var.sg_dekan}</td>
    <td>
    {if $var.sg.sg_po}
    <b>Studiums und Pr&uuml;fungsordnung vorhanden.</b>
    {/if}   
    </td>
    </tr>
{/foreach}

</table>

{include file="footer.tpl" title=foo}  