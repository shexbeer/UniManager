{include file="header.tpl" title=foo}  

W&auml;hlen sie einen Studiengang aus. zu dem die Studien- und Pr&uuml;fungsordnung editiert werden soll.

<br><br>
<table>

<tr>

<th>Studiengang-Typ</th>
<th>Name</th>
<th>Status</th>
<th>Dekan</th>
<th></th>
<th></th>
</tr>
{foreach from=$SG item=var}
<tr style="text-align: center;">
    <td>{$var.sg_typ}</td>
    <td style="text-align: left;">{$var.sg_name}</td>
    <td>{$var.sg_status}</td>
    <td>{$var.sg_dekan}</td>
    <td>
    	{if $var.sg_typ=="Bachelor"}
	    	<input type="button" value="PO/SO editieren">
	    {else}
	    	<b>Nur Bachelor Studiengang Templates zurzeit</b>
	    {/if}
    </td>
</tr>
{/foreach}

</table>
<br>

<input type="button" value="Bachelor PO/SO Template bearbeiten">

{include file="footer.tpl" title=foo}  