{include file="header.tpl" title=foo}
Hier k&ouml;nnen Sie das Modulangebot eines Studienganges vergleichen, mit dem Bedarf.<br>
<!-- oder Sie können das Modulangebot eines ganzen Semesters vergleichen -->
<br>
<table>
<tr>
	<td>Derzeitiges Semster:</td>
	<td><b>{$currentSemester}</b></td>
</tr>
<tr>
	<td>N&auml;chstes Semester:</td>
	<td><b>{$nextSemester}</b></td>
</tr>
</table>
<h4>W&auml;hlen Sie einen Studiengang aus</h4>
<table>
<tr>
	<th>Studiengang-Typ</th>
	<th>Name</th>
	<th>Dekan</td>
	<!-- <th>Status</th> -->
	<th>{$currentSemester}</th>
	<th></th>
	<th>{$nextSemester}</th>
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
		<input type="button" {if !$var.MA_curr}disabled{/if} value="vergleichen" onClick="window.location = '{$rootDir}MA_compare.php?compareMA=yes&forid={$var.sg_id}&sem=1'">
	</td>
	<td><span style="color:{if $var.MA_next}green{else}red{/if}"}><b>X</b></span></td>
	<td>
		<input type="button" {if !$var.MA_next}disabled{/if} value="vergleichen" onClick="window.location = '{$rootDir}MA_compare.php?compareMA=yes&forid={$var.sg_id}&sem=2'">
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