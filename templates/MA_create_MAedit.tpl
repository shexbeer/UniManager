{include file="header.tpl" title=foo}
<form name="ma_create" action="MA_create.php?createMA=yes&forid={$sg_id}" method="POST">
<table>
<tr>
	<td id="form_caption">
	Modulhandbuch
	</td>
	<td>
		<a href="{$pdf_modulhandbuch_dir}{$modulhb}?time={$timestamp}"> Link </a>
	</td>
</tr>
<tr>
	<td id="form_caption">
		Pr&uuml;fungs & Studienordnung
	</td>
	<td>
		<a href="{$pdf_poso_dir}{$po}?time={$timestamp}"> Link </a>
	</td>
</tr>
<tr>
	<td id="form_caption">
		Erstelle Modulaufstellung f&uuml;r Semester
	</td>
	<td>
		<select name="ma_semester" size="1" onChange="MA_changeSemester('{$sg_id}','{$current_semester}','{$next_semester}','{$mas.0}','{$mas.1}')">
			<option value="1" {if $mark_semester==1}selected{/if}>Dieses Semester: {$current_semester}</option>
			<option value="2" {if $mark_semester==2}selected{/if}>N&auml;chstes Semester: {$next_semester}</option>
		</select>
	</td>
</tr>
<tr>
	<td id="form_caption">
		Verantwortlicher Lehrbeauftragter
	</td>
	<td>
		{$counter = 1}
		{foreach from=$lehrbeauflist item=var}
			<input type="radio" onChange="MA_create_checkIfSelected()" name="lb" onChange="" value="{$var.lehrbeauftr_id}"> {$var.person_vorname} {$var.person_name}
			{if $counter % 4 == 0}
				<br>
			{/if}
			{$counter = $counter + 1}
		{/foreach}
		
	</td>
</tr>
</table>
{if ($mark_semester == 1 && $mas.0 == 1) || ($mark_semester == 2 && $mas.1 == 1)}
	{if $mas.0==1} {$editSem=1} {else if $mas.1==1} {$editSem=2} {/if}
	<h4 id="warning">
		Achtung! F&uuml;r das gew&auml;hlte Semester existiert bereits eine Modulaufstellung.<br>
		Wenn Sie fortfahren wird die existierende Modulaufstellung &uuml;berschrieben.<br>
		Verwenden Sie zum Editieren diese <a href="{$rootDir}MA_edit.php?editMA=yes&forid={$sg_id}&sem={$editSem}">Funktion</a>
	</h4>
{/if}
<br>
<h4>Modulaufstellung des Studiengangs (Modulname + Plansemester),<br>
die in diesem Zeitraum hinzugef&uuml;gt werden k&ouml;nnen</h4>
<table>
<!--<th colspan="4">  </th>-->
{$counter = 1}
<tr>
{foreach $modullist as $var}
	<td id="ma_add_{$var.modul_id}">
		<span id="ma_add_span_{$var.modul_id}">
		{$var.modul_name} 
		<b>
			<span name="MA_rightSem" id="MA_rightSem">{$var.mauf_plansemester}</span>	
		</b> 
		<input type="button" value="+" onClick="MA_AddButton('{$var.modul_id }','{$var.modul_name}','{$var.mauf_plansemester}')">
		</span>
	</td>
{if $counter%4==0}
</tr>
<tr>
{/if}
{$counter = $counter+1}
{/foreach}
</tr>
</table>
<hr>
<h4>Ausgew&auml;hlte Module f&uuml;r das Modulangebot</h4>
<span id="modulangebot">

</span
<br><br>
<table width="600">
<tr>
	<td style="text-align: left;">
		<input type="button" value="Zur&uuml;ck" onClick="window.location='{$rootDir}MA_create.php'">
		<!--<a href="MA_create.php">Zur&uuml;ck</a>-->
	</td>
	<td  style="text-align: right;">
		<input type="submit" id="ma_submit" disabled value="Erstellen">
	</td>
</tr>
</table>
</form>



<!--
<table>
<tr>
	<td id="form_caption">Geplante Uhrzeit</td>
	<td>
		<select name="planed_hour" size="1">
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			<option>11</option>
			<option>12</option>
			<option>13</option>
			<option>14</option>
			<option>15</option>
			<option>16</option>
			<option>17</option>
			<option>18</option>
			<option>19</option>
			<option>20</option>
		</select>:
		<select name="planed_minute" size="1">
			<option>00</option>
			<option>15</option>
			<option>30</option>
			<option>45</option>
		</select>
	</td>
</tr>
<tr>
	<td id="form_caption">geplante Woche</td>
	<td>
		<select name="planed_week" size="1">
			<option>jede</option>
			<option>gerade</option>
			<option>ungerade</option>
		</select>
	</td>
</tr>
</table>

<table border="1">
<tr>
	<th>Montag <input type="radio" name="weekday" value="1" checked="checked"></th>
	<th>Dienstag <input type="radio" name="weekday" value="2"></th>
	<th>Mittwoch <input type="radio" name="weekday" value="3"></th>
	<th>Donnerstag <input type="radio" name="weekday" value="4"></th>
	<th>Freitag <input type="radio" name="weekday" value="5"></th>
	<th>Samstag <input type="radio" name="weekday" value="6"></th>
	<th>Sonntag <input type="radio" name="weekday" value="7"></th>
</tr>
<tr>
	<td id="weekday_1"></td>
	<td id="weekday_2"></td>
	<td id="weekday_3"></td>
	<td id="weekday_4"></td>
	<td id="weekday_5"></td>
	<td id="weekday_6"></td>
	<td id="weekday_7"></td>
</tr>
</table>
-->
{include file="footer.tpl" title=foo}