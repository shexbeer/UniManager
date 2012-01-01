{include file="header.tpl" title=foo}

<form action="MA_compare.php?setMA=yes" method="POST" name="compare_Form">

<table>
<tr>
	<td id="form_caption">
		Vergleich f&uuml;r Semester
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
		{$sg.typ}	
	</td>
</tr>
<tr>
	<td id="form_caption">
		Studiengang
	</td>
	<td>
		{$sg.name}
		<input type="hidden" name="forid" value="{$sg.id}">
	</td>
</tr>
<tr>
	<td id="form_caption">
		Verantwortlicher Lehrbeauftragter
	</td>
	<td>
		{$counter = 1}
		{foreach from=$lehrbeaufList item=var}
			<input type="radio" name="lb" onChange="" value="{$var.lehrbeauftr_id}" {if $lb.ma_lb == $var.lehrbeauftr_id}checked="true"{/if}}>{$var.person_vorname} {$var.person_name}
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
      		<option {if $sg.ma_status == "erstellt"}selected{/if}>erstellt</option>
      		<option {if $sg.ma_status == "geprüft"}selected{/if}>gepr&uuml;ft</option>
      		<option {if $sg.ma_status == "gültig"}selected{/if}>g&uuml;ltig</option>
    	</select>
	</td>
</tr>
</table>

<table width="730" style="border-collapse: collapse;">
<tr>
	<th class="MAcompare_table" style="background-color:white;">Bedarf</th>
	<th></th>
	<th class="MAcompare_table" style="background-color:white;">Modulangebot</th>
</tr>
<tr>
	<td width="400" style="border-collapse: collapse;">
		<table class="MAcompare_table" width="100%" style="font-size: 9px; font-weight: bold;">
		<tr>
			<td width="38%">Modulname</td>
			<td width="10%">PS</td>
			<td width="30%">Angebot Modul</td>
			<td width="22%"></td>
		</tr>
		</table>
	</td>
	<td width="30" style="border-right: 1px black dotted; border-collapse: collapse; border-left: 1px black dotted;"></td>
	<td width="300" style="border-collapse: collapse;">
		<table class="MAcompare_table" width="100%" style="font-size: 9px; font-weight: bold;">
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
		<table class="MAcompare_table" id="bedarf_{$var.keyVal}" width="100%">
		<tr>
			<td width="38%" id="compareLeft_name_{$keyVal}">{$var.bedarf.modul_name}</td>
			<td width="10%" id="compareLeft_ps_{$keyVal}" class="MA_rightSem">{$var.bedarf.mauf_plansemester}</td>
			<td width="30%" id="compareLeft_frequency_{$keyVal}">{$var.bedarf.modul_frequency}</td>
			<td width="22%">
				{if $var.bedarf.modul_name != ""}
				<input type="button" id="compareLeft_bt_{$keyVal}" onClick="MAcompare_AddButton('{$keyVal}','{$var.bedarf.modul_name}','{$var.bedarf.mauf_plansemester}','{$var.bedarf.modul_frequency}','false')" value="hinzuf&uuml;gen" {if $var.bedarf.modul_name==$var.modulangebot.modul_name}disabled="true"{/if}>
				{else}
				<input type="button" id="compareLeft_bt_{$keyVal}" onClick="MAcompare_AddButton('{$keyVal}','{$var.modulangebot.modul_name}','{$var.modulangebot.mauf_plansemester}','{$var.modulangebot.modul_frequency}','false')" value="hinzuf&uuml;gen" style="visibility:hidden;" {if $var.bedarf.modul_name==$var.modulangebot.modul_name}disabled="true"{/if}>
				{/if}
			</td>
		</tr>
		</table>
	</td>
	
	<td width="30" style="border-right: 1px black dotted; border-collapse: collapse;">
		<div width="80%" align="center" id="compareControl_{$keyVal}" 
			{if $var.bedarf.modul_name==$var.modulangebot.modul_name}
				style='background-color:green'
			{else}
				style='background-color:red'
			{/if}
		><pre> </pre></div>
	</td>
		<!-- Trennung -->
	<td width="300">
		<table class="MAcompare_table"  id="angebot_{$var.keyVal}" width="100%">
		<tr>
			<td width="65%" id="compareRight_name_{$keyVal}">
				{$var.modulangebot.modul_name}
			</td>
			<td width="10%" id="compareRight_ps_{$keyVal}">{$var.modulangebot.mauf_plansemester}</td>
			<!-- <td width="30%">{$modulangebot.$keyVal.modul_frequency}</td>-->
			<td width="25%">
			{if $var.modulangebot.modul_name != ""}
				{if $var.modulangebot.onlyInMA == "true"}
					<input type="button" onClick="MAcompare_DelButton('{$keyVal}','{$var.modulangebot.modul_name}','{$var.modulangebot.mauf_plansemester}','{$var.modulangebot.modul_frequency}','true')" id="compareRight_bt_{$keyVal}" value="entfernen">
				{else}
					<input type="button" onClick="MAcompare_DelButton('{$keyVal}','{$var.modulangebot.modul_name}','{$var.modulangebot.mauf_plansemester}','{$var.modulangebot.modul_frequency}','false')" id="compareRight_bt_{$keyVal}" value="entfernen">
				{/if}

			{else}
				<input type="button" onClick="MAcompare_DelButton('{$keyVal}','{$var.bedarf.modul_name}','{$var.bedarf.mauf_plansemester}','{$var.bedarf.modul_frequency}','false')" id="compareRight_bt_{$keyVal}" value="entfernen" style="visibility:hidden;">
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
<table width="730">
<tr>
	<td style="text-align: left;">
		<input type="button" value="Zur&uuml;ck" onClick="window.location='{$rootDir}MA_compare.php'">
		<!--<a href="MA_create.php">Zur&uuml;ck</a>-->
	</td>
	<td  style="text-align: right;">
		<input type="submit" id="ma_submit" value="Speichern">
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
	<td align="center"><div style="background-color:green; width:30%;" align="center"><pre> </pre></span></td>
	<td>&Uuml;bereinstimmung von Bedarf und Angebot</td>
</tr>
<tr>
	<td align="center"><div style="background-color:red; width:30%;"><pre> </pre></span</td>
	<td>KEINE &Uuml;bereinstimmung von Bedarf und Angebot</td>
</tr>
</table>

{include file="footer.tpl" title=foo}