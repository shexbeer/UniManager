{include file="header.tpl" title=foo}
<form name="ma_edit" action="MA_edit.php?setMA=yes" method="POST">
<table>
<tr>
	<td id="form_caption">
		Modulaufstellung f&uuml;r Semester
	</td>
	<td>
		<b>
			{$forSemester}
			<input type="hidden" name="forSemester" value="{$forSemester}">
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
		<input type="hidden" name="forid" value="{$sg_id}">
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
		<select name="ma_status" size="1">
      		<option {if $ma_status == "erstellt"}selected{/if}>erstellt</option>
      		<option {if $ma_status == "geprüft"}selected{/if}>gepr&uuml;ft</option>
      		<option {if $ma_status == "gültig"}selected{/if}>g&uuml;ltig</option>
    	</select>
	</td>
</tr>
</table>
{if ($mark_semester == 1 && $mas.0 == 1) || ($mark_semester == 2 && $mas.1 == 1)}
	<h4 class="warning">
		Achtung! F&uuml;r das gew&auml;hlte Semester existiert bereits eine Modulaufstellung.<br>
		Wenn Sie fortfahren wird die existierende Modulaufstellung &uuml;berschrieben.<br>
		Verwenden Sie zum Editieren diese <a href="{$rootDir}MA_edit.php?forid={$sg_id}">Funktion</a>
	</h4>
{/if}
<br>
<h4>Modulaufstellung des Studiengangs und das derzeitige Modulangebot.</h4>
<table width="800" style="border-collapse: collapse;">
<tr>
	<th class="MAedit_table" style="background-color:white;">Modulaufstellung</th>
	<th class="MAedit_table" style="background-color:white;">Modulangebot</th>
</tr>
<tr>
	<td width="400" style="border-collapse: collapse; border-right: 1px black dotted;">
		<table class="MAedit_table" width="100%" style="font-size: 9px; font-weight: bold;">
		<tr>
			<td width="65%">Modulname</td>
			<td width="10%">PS</td>
			<td width="35%"></td>
		</tr>
		</table>
	</td>
	<td width="400" style="border-collapse: collapse;">
		<table class="MAedit_table" width="100%" style="font-size: 9px; font-weight: bold;">
		<tr>
			<td width="65%">Modulname</td>
			<td width="10%">PS</td>
			<td width="35%"></td>
		</tr>
		</table>
	</td>
</tr>
{foreach from=$compareList item=var key=keyVal}
<tr id="compareList_Row_{$keyVal}">
	<td width="400" style="border-right: 1px black dotted; border-collapse: collapse;">
		<table class="MAedit_table" id="modullist_{$var.keyVal}" width="100%">
		<tr>
			<td width="65%" id="compareLeft_name_{$keyVal}">{$var.modullist.modul_name}</td>
			<td width="10%" id="compareLeft_ps_{$keyVal}" class={if $var.modullist.plansemester_Mark=='true'}"MA_rightSem"{else}"MA_wrongSem"{/if}>{$var.modullist.mauf_plansemester}</td>
			<td width="35%">
				{if $var.modullist.modul_name != ""}
				<input type="button" id="compareLeft_bt_{$keyVal}" onClick="MAedit_AddButton('{$keyVal}','{$var.modullist.modul_name}','{$var.modullist.mauf_plansemester}')" value="hinzuf&uuml;gen" {if $var.modullist.modul_name==$var.modulangebot.modul_name}disabled="true"{/if}>
				{else}
				<input type="button" id="compareLeft_bt_{$keyVal}" onClick="MAedit_AddButton('{$keyVal}','{$var.modulangebot.modul_name}','{$var.modulangebot.mauf_plansemester}')" value="hinzuf&uuml;gen" style="visibility:hidden;" {if $var.modullist.modul_name==$var.modulangebot.modul_name}disabled="true"{/if}>
				{/if}
			</td>
		</tr>
		</table>
	</td>
		<!-- Trennung -->
	<td width="400">
		<table class="MAedit_table"  id="angebot_{$var.keyVal}" width="100%">
		<tr>
			<td width="65%" id="compareRight_name_{$keyVal}">
				{$var.modulangebot.modul_name}
			</td>
			<td width="10%" id="compareRight_ps_{$keyVal}" class={if $var.modullist.plansemester_Mark=='true'}"MA_rightSem"{else}"MA_wrongSem"{/if}>{$var.modulangebot.mauf_plansemester}</td>
			<!-- <td width="30%">{$modulangebot.$keyVal.modul_frequency}</td>-->
			<td width="25%">
			{if $var.modulangebot.modul_name != ""}
					<input type="button" onClick="MAedit_DelButton('{$keyVal}','{$var.modulangebot.modul_name}','{$var.modulangebot.mauf_plansemester}')" id="compareRight_bt_{$keyVal}" value="entfernen">

			{else}
				<input type="button" onClick="MAedit_DelButton('{$keyVal}','{$var.modullist.modul_name}','{$var.modullist.mauf_plansemester}')" id="compareRight_bt_{$keyVal}" value="entfernen" style="visibility:hidden;">
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
	
<p></p>
<table width="800">
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


<br>
<b>Legende:</b><br>
<table>
<tr>
	<td width="120" align="center"><span style="color:black; font-weight:bold;">PS</span></td>
	<td>Plansemester</td>
</tr>
<tr>
	<td align="center"><div style="color:green; font-weight:bold;">4</span</td>
	<td>Plansemester stimmt mit aktuellen Semester &uuml;berein, f&uuml;r dass das Modulangebot erstellt wird.</td>
</tr>
<tr>
	<td align="center"><div style="color:gray; font-weight:bold;">3</span</td>
	<td>Modul normalerweise in anderen Semesterturnus geplant</td>
</tr>
</table>

<h4 class="hinweis">
	Im Studiengangmanagement k&ouml;nnen Sie &Auml;nderungen an den Modulen der Modulaufstellung vornehmen. <input type="button" value="Zur Funktion Springen" onClick="window.location='{$rootDir}SG_edit.php?showEdit=yes&forid={$sg_id}'">
</h4>

{include file="footer.tpl" title=foo}