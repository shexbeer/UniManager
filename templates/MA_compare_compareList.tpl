{include file="header.tpl" title=foo}

<form action="MA_compare.php?editMA=yes" method="POST" name="compare_Form">

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
	<td width="30"></td>
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
		<table class="MAcompare_table" id="bedarf_{$var.modul_id}" width="100%">
		<tr>
			<td width="38%">{$var.bedarf.modul_name}</td>
			<td width="10%" id="MA_rightSem">{$var.bedarf.mauf_plansemester}</td>
			<td width="30%">{$var.bedarf.modul_frequency}</td>
			<td width="22%">
				{if $var.bedarf.modul_name != ""}
				<input type="button" value="hinzuf&uuml;gen" {if $var.bedarf.modul_name==$var.modulangebot.modul_name}disabled="true"{/if}>
				{else}
					<br>
				{/if}
			</td>
		</tr>
		</table>
	</td>
	
	<td width="30" style="border-right: 1px black dotted; border-collapse: collapse;">
		<div width="80%" align="center" id="compareControl_{$var.modul_id}" 
			{if $var.bedarf.modul_name==$var.modulangebot.modul_name}
				style='background-color:green'
			{else}
				style='background-color:red'
			{/if}
		><pre> </pre></div>
	</td>
		<!-- Trennung -->
	<td width="300">
		<table class="MAcompare_table"  id="angebot_{$var.modul_id}" width="100%">
		<tr>
			<td width="65%">{$var.modulangebot.modul_name}</td>
			<td width="10%">{$var.modulangebot.mauf_plansemester}</td>
			<!-- <td width="30%">{$modulangebot.$keyVal.modul_frequency}</td>-->
			<td width="25%">
			{if $var.modulangebot.modul_name != ""}
				<input type="button" value="entfernen">
			{else}
				<br>
			{/if}
			</td>
			<!--	<td width="20%"><pre> </pre></td> -->
			
		</tr>
		</table>
	</td>
<tr>
{/foreach}

</table>

</form>
<br>
<b>Legende:</b><br>
<table>
<tr>
	<td width="80"><span style="color:black; font-weight:bold;">PS</span></td>
	<td>Plansemester</td>
</tr>
<!--
<tr>
	<td><span style="color:red; font-weight:bold;">X</span></td>
	<td>F&uuml;r dieses Semester existiert kein Modulangebot</td>
</tr>
-->
</table>

{include file="footer.tpl" title=foo}