{include file="header.tpl" title=foo}
<form action="MA_edit.php?createMA=yes" method="POST">
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
		<select name="ma_semester" size="1" onChange="MA_changeSemester('{$sg_id}','{$current_semester}','{$next_semester}')">
			<option value="1" {if $mark_semester==1}selected{/if}>Dieses Semster: {$current_semester}</option>
			<option value="2" {if $mark_semester==2}selected{/if}>N&auml;chstes Semster: {$next_semester}</option>
		</select>
	</td>
</tr>
</table>

<br><br>
<h4>Dem Studiengang zugewiesene Module (Modulname + Plansemester),<br>
die in dem Zeitraum hinzugef&uuml;gt werden k&ouml;nnen</h4>
<table>
<!--<th colspan="4">  </th>-->
{$counter = 1}
<tr>
{foreach $modullist as $var}
	<td>
		{$var.modul_name} 
		<b>
			{if $mark == odd}
				{if $var.mauf_plansemester is odd}
					<span name="MA_rightSem" id="MA_rightSem">{$var.mauf_plansemester}</span>
				{else} 
					<span name="MA_wrongSem" id="MA_wrongSem">{$var.mauf_plansemester}</span>
				{/if}
			{else}
				{if $var.mauf_plansemester is even}
					<span name="MA_rightSem" id="MA_rightSem">{$var.mauf_plansemester}</span>
				{else} 
					<span name="MA_wrongSem" id="MA_wrongSem">{$var.mauf_plansemester}</span>
				{/if}
			{/if}
			
		</b> 
		<input type="button" value="+" onClick="MA_AddButton({$var.modul_id })">
	</td>
{if $counter%4==0}
</tr>
<tr>
{/if}
{$counter = $counter+1}
{/foreach}
</tr>
</table>
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
<br><br>
<a href="MA_create.php">Zur&uuml;ck</a><input type="submit" value="Erstellen">
</form>

{include file="footer.tpl" title=foo}