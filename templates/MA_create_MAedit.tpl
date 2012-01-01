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
	<h4 class="warning">
		Achtung! F&uuml;r das gew&auml;hlte Semester existiert bereits eine Modulaufstellung.<br>
		Wenn Sie fortfahren wird die existierende Modulaufstellung &uuml;berschrieben.<br>
		Verwenden Sie zum Editieren die Funktion Modulangebot editieren <input type="button" onClick="window.location = '{$rootDir}MA_edit.php?editMA=yes&forid={$sg_id}&sem={$editSem}'" value="Zur Funktion springen">
	</h4>
{/if}
<br>
<h4>Modulaufstellung des Studiengangs und das derzeitige Modulangebot.</h4>
<table width="800" style="border-collapse: collapse;">
<tr>
	<th class="MAcreate_table" style="background-color:white;">Modulaufstellung</th>
	<th class="MAcreate_table" style="background-color:white;">Modulangebot</th>
</tr>
<tr>
	<td width="400" style="border-collapse: collapse; border-right: 1px black dotted;">
		<table class="MAcreate_table" width="100%" style="font-size: 9px; font-weight: bold;">
		<tr>
			<td width="65%">Modulname</td>
			<td width="10%">PS</td>
			<td width="35%"></td>
		</tr>
		</table>
	</td>
	<td width="400" style="border-collapse: collapse;">
		<table class="MAcreate_table" width="100%" style="font-size: 9px; font-weight: bold;">
		<tr>
			<td width="65%">Modulname</td>
			<td width="10%">PS</td>
			<td width="35%"></td>
		</tr>
		</table>
	</td>
</tr>
{foreach from=$modullist item=var key=keyVal}
<tr id="compareList_Row_{$keyVal}">
	<td width="400" style="border-right: 1px black dotted; border-collapse: collapse;">
		<table class="MAcreate_table" id="modullist_{$var.keyVal}" width="100%">
		<tr>
			<td width="65%" id="compareLeft_name_{$keyVal}">{$var.modul_name}</td>
			<td width="10%" id="compareLeft_ps_{$keyVal}" class={if $var.plansemester_Mark=='true'}"MA_rightSem"{else}"MA_wrongSem"{/if}>{$var.mauf_plansemester}</td>
			<td width="35%">
				{if $var.modul_name != ""}
				<input type="button" id="compareLeft_bt_{$keyVal}" onClick="MAcreate_AddButton('{$keyVal}','{$var.modul_name}','{$var.mauf_plansemester}')" value="hinzuf&uuml;gen" {if $var.modul_name==$var.modulangebot.modul_name}disabled="true"{/if}>
				{else}
				<input type="button" id="compareLeft_bt_{$keyVal}" onClick="MAcreate_AddButton('{$keyVal}','{$var.modulangebot.modul_name}','{$var.modulangebot.mauf_plansemester}')" value="hinzuf&uuml;gen" style="visibility:hidden;" {if $var.modul_name==$var.modulangebot.modul_name}disabled="true"{/if}>
				{/if}
			</td>
		</tr>
		</table>
	</td>
		<!-- Trennung -->
	<td width="400">
		<table class="MAcreate_table"  id="angebot_{$var.keyVal}" width="100%">
		<tr>
			<td width="65%" id="compareRight_name_{$keyVal}">
				{$var.modulangebot.modul_name}
			</td>
			<td width="10%" id="compareRight_ps_{$keyVal}" class={if $var.plansemester_Mark=='true'}"MA_rightSem"{else}"MA_wrongSem"{/if}>{$var.modulangebot.mauf_plansemester}</td>
			<!-- <td width="30%">{$modulangebot.$keyVal.modul_frequency}</td>-->
			<td width="25%">
			{if $var.modulangebot.modul_name != ""}
					<input type="button" onClick="MAcreate_DelButton('{$keyVal}','{$var.modulangebot.modul_name}','{$var.modulangebot.mauf_plansemester}')" id="compareRight_bt_{$keyVal}" value="entfernen">

			{else}
				<input type="button" onClick="MAcreate_DelButton('{$keyVal}','{$var.modul_name}','{$var.mauf_plansemester}')" id="compareRight_bt_{$keyVal}" value="entfernen" style="visibility:hidden;">
			{/if}
			</td>
			<input type="hidden" name="modulangebot[]" id="compareRight_idField_{$keyVal}" {if $var.modulangebot.modul_name != ""}value="{$keyVal}"{/if}>
			<!--	<td width="20%"><pre> </pre></td> -->
			
		</tr>
		</table>
	</td>
<tr>
{/foreach}
</table>
<br><br>
<table width="800">
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


<br>
<b>Legende:</b><br>
<table>
<tr>
	<td width="120" align="center"><span style="color:black; font-weight:bold;">PS</span></td>
	<td>Plansemester</td>
</tr>
<tr>
	<td align="center"><div style="color:green; font-weight:bold;">4</span</td>
	<td>Plansemester stimmt mit aktuellen Semester &uuml;berein f&uuml;r dass das Modulangebot erstellt wird.</td>
</tr>
<tr>
	<td align="center"><div style="color:gray; font-weight:bold;">3</span</td>
	<td>Modul normalerweise in anderen Semesterturnus geplant</td>
</tr>
</table>

<h4 class="hinweis">
	Im Studiengangmanagement k&ouml;nnen Sie &Auml;nderungen an den Modulen der Modulaufstellung vornehmen. <input type="button" value="Zur Funktion Springen" onClick="window.location='{$rootDir}SG_edit.php?showEdit=yes&forid={$sg_id}'">
</h4>

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