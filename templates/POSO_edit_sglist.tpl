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
    	{if ($var.sg_typ=="Bachelor" && $posot.0 == true) || ($var.sg_typ=="Master" && $posot.1 == true) || ($var.sg_typ=="Diplom" && $posot.2 == true)}
	    	<input type="button" value="PO/SO editieren">
	    {else}
	    	<b>f&uuml;r diesen SG Typ gibt es kein Template</b>
	    {/if}
    </td>
</tr>
{/foreach}

</table>
<br>
{if ($posot.0 == true)}
	<input type="button" value="Bachelor PO/SO Template bearbeiten">
{/if}
{if ($posot.1 == true)}
	<input type="button" value="Master PO/SO Template bearbeiten">
{/if}
{if ($posot.2 == true)}
	<input type="button" value="Diplom PO/SO Template bearbeiten">
{/if}
{include file="footer.tpl" title=foo}  