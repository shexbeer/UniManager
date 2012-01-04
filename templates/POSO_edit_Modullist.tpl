{include file="header.tpl" title=foo} 
<form action="{$rootDir}POSO_edit.php?editModulaufstellung=yes" method="POST">
<input type="hidden" value="{$sg.sg_name}" name="sg_name">
<input type="hidden" value="{$sg.sg_id}" name="sg_id">
<input type="hidden" value="{$sg.sg_typ}" name="sg_typ">
<table>
<tr>
	<td width=150 id="form_caption">
		Studiengang Typ
	
	</td>
	<td width=250 align=left>
		{$sg.sg_typ}
	</td>
</tr>
<tr>
	<td width=150 id="form_caption">
		Studiengangname
	</td>
	<td width=350 align=left>
		{$sg.sg_name}
	</td>
</tr>
</table>
{if $sg.sg_typ==Bachelor}
	{$sems = 6}
{else if $sg.sg_typ==Master}
	{$sems = 4}
{else if $sg.sg_typ == Diplom}
	{$sems = 10}
{/if}
<br>
Hier k&ouml;nnen Sie die Modulaufstellung kontrollieren und ggf. &auml;ndern.<br>
Nach dem Klick auf Speichern wird ein aktulisiertes Modulhandbuch erstellt.<br><br>
<table width="800" style="border-collapse: collapse;">
<tr style="font-size: 9px; font-weight: bold;">
	<td width="5%" class="SGedit_modul_table"></td>
	<td width="30%" class="SGedit_modul_table">Modulname</td>
	<td width="20%" class="SGedit_modul_table">Angebot Modul</td>
	<td width="5%" class="SGedit_modul_table">PS</td>
	<td width="40%" class="SGedit_modul_table">Verwendbarkeit</td>
</tr>
{foreach $modullist item=var key=keyValue}
<tr {if !$var.in_SG}style="color:gray;"{/if} id="modul_row_{$var.modul_id}">
	<td width="5%" >
		<input id="modul_chkbox_{$var.modul_id}" onClick="Modul_Checkbox({$var.modul_id},{$sems})" {if $var.in_SG}checked="checked"{/if} type="checkbox" name="modulaufstellung[]" value="{$var.modul_id}">
	</td>
	<td width="30%">{$var.modul_name}</td>
	<td width="20%">{$var.modul_frequency}</td>
	<td width="5%">
		<select id="modul_ps_{$var.modul_id}" name="modul_ps[{$var.modul_id}]" size="1" {if !$var.in_SG}style="visibility: hidden;"{/if}>
				{if $sg.sg_typ==Master}
					<option {if {$var.mauf_plansemester==1}}selected{/if}>1</option>
					<option {if {$var.mauf_plansemester==2}}selected{/if}>2</option>
					<option {if {$var.mauf_plansemester==3}}selected{/if}>3</option>
					<option {if {$var.mauf_plansemester==4}}selected{/if}>4</option>
				{/if}
				{if $sg.sg_typ==Bachelor}
					<option {if {$var.mauf_plansemester==1}}selected{/if}>1</option>
					<option {if {$var.mauf_plansemester==2}}selected{/if}>2</option>
					<option {if {$var.mauf_plansemester==3}}selected{/if}>3</option>
					<option {if {$var.mauf_plansemester==4}}selected{/if}>4</option>
					<option {if {$var.mauf_plansemester==5}}selected{/if}>5</option>
					<option {if {$var.mauf_plansemester==6}}selected{/if}>6</option>
				{/if}
				{if $sg.sg_typ==Diplom}
					<option {if {$var.mauf_plansemester==1}}selected{/if}>1</option>
					<option {if {$var.mauf_plansemester==2}}selected{/if}>2</option>
					<option {if {$var.mauf_plansemester==3}}selected{/if}>3</option>
					<option {if {$var.mauf_plansemester==4}}selected{/if}>4</option>
					<option {if {$var.mauf_plansemester==5}}selected{/if}>5</option>
					<option {if {$var.mauf_plansemester==6}}selected{/if}>6</option>
					<option {if {$var.mauf_plansemester==7}}selected{/if}>7</option>
					<option {if {$var.mauf_plansemester==8}}selected{/if}>8</option>
					<option {if {$var.mauf_plansemester==9}}selected{/if}>9</option>
					<option {if {$var.mauf_plansemester==10}}selected{/if}>10</option>
				{/if}
			</select>
	</td>
	<td widht="40%">
		{$var.modul_usability}
	</td>
</tr>
<tr>
	<td colspan="5" style="border-bottom: 1px black solid;">
	</td>
</tr>
{/foreach}
</table>
<br><br>
<table width="800">
<tr>
	<td style="text-align: left;">
		<input type="button" value="Zur&uuml;ck" onClick="window.location='{$rootDir}POSO_edit.php'">
	</td>
	<td  style="text-align: right;">
		<input type="submit" id="sg_submit" value="Speichern">
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
	<td align="center"><b>Angebot Modul</b></td>
	<td>Wann wird dieses Modul generell angeboten</td>
</tr>
<tr>
	<td align="center"><b>Verwendbarkeit</b></td>
	<td>Angaben zur Verwendbarkeit des Moduls aus der Modulbeschreibung</td>
</tr>
</table>
{include file="footer.tpl" title=foo} 