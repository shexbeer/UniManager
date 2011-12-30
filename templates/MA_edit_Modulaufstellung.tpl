{include file="header.tpl" title=foo}
<form name="ma_edit" action="MA_edit.php?editMA=yes&forid={$sg_id}" method="POST">
<table>
<tr>
	<td id="form_caption">
		Modulaufstellung f&uuml;r Semester
	</td>
	<td>
		<b>
			{$forSemester}
		</b>
	</td>
</tr>
<tr>
	<td id="form_caption" width="250">
		Studiengang-Typ
	</td>
	<td>
		{$sg_typ}	
	</td>
</tr>
<tr>
	<td id="form_caption">
		Studiengang
	</td>
	<td>
		{$sg_name}	
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
		Modulhandbuch
	</td>
	<td>
		<a href="{$pdf_modulhandbuch_dir}{$modulhb}?time={$timestamp}"> Link </a>
	</td>
</tr>
<tr>
	<td id="form_caption">
		Verantwortlicher Lehrbeauftragter
	</td>
	<td>
		{$counter = 1}
		{foreach from=$lehrbeauflist item=var}
			<input type="radio" name="lb" value="{$var.lehrbeauftr_id}" {if $var.lehrbeauftr_id==$lbForMA.ma_lb}checked=true{/if}}> {$var.person_vorname} {$var.person_name}
			{if $counter % 4 == 0}
				<br>
			{/if}
			{$counter = $counter + 1}
		{/foreach}
		
	</td>
</tr>
<tr>
	<td id="form_caption">
		Status des Modulangebots
	</td>
	<td>
		<select name="sg_typ" size="1">
      		<option {if $sg.sg_typ == "Bachelor"}selected{/if}>erstellt</option>
      		<option {if $sg.sg_typ == "Master"} selected{/if}>gepr&uuml;ft</option>
      		<option {if $sg.sg_typ == "Diplom"} selected{/if}>g&uuml;ltig</option>
    	</select>
	</td>
</tr>
</table>
{if ($mark_semester == 1 && $mas.0 == 1) || ($mark_semester == 2 && $mas.1 == 1)}
	<h4 id="warning">
		Achtung! F&uuml;r das gew&auml;hlte Semester existiert bereits eine Modulaufstellung.<br>
		Wenn Sie fortfahren wird die existierende Modulaufstellung &uuml;berschrieben.<br>
		Verwenden Sie zum Editieren diese <a href="{$rootDir}MA_edit.php?forid={$sg_id}">Funktion</a>
	</h4>
{/if}
<br>
<hr>
<h4>Dem Studiengang zugewiesene Module (Modulname + Plansemester),<br>
die in dem Zeitraum hinzugef&uuml;gt werden k&ouml;nnen</h4>
<span id="modulliste" width="200">
{foreach $modullist as $var}
	<span id="ma_modlist_{$var.modul_id}">
		<span>{$var.modul_name}</span>
		<span name="MA_rightSem" id="MA_rightSem">{$var.mauf_plansemester}</span>	
		<input type="button" value="+" onClick="MAedit_AddButton('{$var.modul_id }','{$var.modul_name}','{$var.mauf_plansemester}')">
		<br>
	</span>
{/foreach}
</span>
<hr>
<h4>Ausgew&auml;hlte Module f&uuml;r das Modulangebot</h4>
<span id="modulangebot" width="200">
{foreach $modulangebot as $var}
	<span id="ma_modangebot_{$var.modul_id}">
		<span>{$var.modul_name}</span>
		<input type="hidden" name="modulaufstellung[]" value="{$var.modul_id}">
		<span name="MA_rightSem" id="MA_rightSem">{$var.mauf_plansemester}</span>	
		<input type="button" value="-" onClick="MAedit_DelButton('{$var.modul_id }','{$var.modul_name}','{$var.mauf_plansemester}')">
		<br>
	</span>
{/foreach}
</span>
<p></p>
<table width="600">
<tr>
	<td style="text-align: left;">
		<input type="button" value="Zur&uuml;ck" onClick="window.location='{$rootDir}MA_edit.php'">
		<!--<a href="MA_create.php">Zur&uuml;ck</a>-->
	</td>
	<td  style="text-align: right;">
		<input type="submit" id="ma_submit" value="Ver&auml;ndern">
	</td>
</tr>
</table>
</form>


{include file="footer.tpl" title=foo}