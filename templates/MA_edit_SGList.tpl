{include file="header.tpl" title=foo}

W&auml;hlen sie einen Studiengang aus, zu dem ein Modulangebot erstellt werden soll.
<br><br>
Derzeitiges Semster: <b>{$current_semester}</b><br>
N&auml;chstes Semester: <b>{$next_semester}</b><br>
<br>
<table>
<tr>
	<th>Studiengang-Typ</th>
	<th>Name</th>
	<th>Dekan</td>
	<!-- <th>Status</th> -->
	<th>{$current_semester}</th>
	<th></th>
	<th>{$next_semester}</th>
	<th></th>
</tr>

{foreach from=$sglist item=var}
<tr style="text-align: center;">
	<td>{$var.sg_typ}</td>
	<td>{$var.sg_name}</td>
	<td>{$var.sg_dekan}</td>
	<!-- <td>{$var.sg_status}</td> -->
	<td><span style="color:{if $var.MA_curr}green{else}red{/if}"}><b>X</b></span></td>
	<td>
		<input type="button" {if !$var.MA_curr}disabled{/if} value="ver&auml;ndern" onClick="window.location = '{$rootDir}MA_edit.php?editMA=yes&forid={$var.sg_id}&sem=1'">
	</td>
	<td><span style="color:{if $var.MA_next}green{else}red{/if}"}><b>X</b></span></td>
	<td>
		<input type="button" {if !$var.MA_next}disabled{/if} value="ver&auml;ndern" onClick="window.location = '{$rootDir}MA_edit.php?editMA=yes&forid={$var.sg_id}&sem=2'">
	</td>
	
</tr>
{/foreach}
</table>
<br>
<b>Legende:</b><br>
<table>
<tr>
	<td><span style="color:green; font-weight:bold;">X</span></td>
	<td>Ein Modulangebot f&uuml;r dieses Semester existiert bereits.</td>
</tr>
<tr>
	<td><span style="color:red; font-weight:bold;">X</span></td>
	<td>F&uuml;r dieses Semester existiert kein Modulangebot</td>
</tr>
</table>
{include file="footer.tpl" title=foo}