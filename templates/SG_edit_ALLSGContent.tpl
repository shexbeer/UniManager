{include file="header.tpl" title=foo}

<form action="SG_edit.php?editSG=yes&forid={$sg.sg_id}" enctype="multipart/form-data" method="POST">
Details des ausgew&auml;lten Studiengangs
<br><br>
<table>
<tr>
	<td width=150 id="form_caption">
		Studiengang Ident
	
	</td>
	<td width=250 align=left>
		<input type="text" name="sg_id" value="{$sg.sg_id}" disabled=true>
	</td>
</tr>
<tr>
	<td width=150 id="form_caption">
		Studiengang Typ
	
	</td>
	<td width=250 align=left>
		<!--<input type="text" name="sg_typ" value="{$sg.sg_typ}" disabled=true>-->
		<select name="sg_typ" size="1">
      		<option {if $sg.sg_typ == "Bachelor"}selected{/if}>Bachelor</option>
      		<option {if $sg.sg_typ == "Master"} selected{/if}>Master</option>
      		<option {if $sg.sg_typ == "Diplom"} selected{/if}>Diplom</option>
    	</select>
	</td>
</tr>
<tr>
	<td width=150 id="form_caption">
		Studiengangname
	</td>
	<td width=350 align=left>
		<input type="text" name="sg_name" onChange="SGcheckName(this, this.value)" value="{$sg.sg_name}" size="30">
	</td>
</tr>
<tr>
	<td width=150 id="form_caption">
		Studiendekan
	
	</td>
	<td width=250 align=left>
		<!--
		<input type="text" name="sg_name" value="{$sg.dekanvorname} {$sg.dekanname}">
		-->
		{$counter = 0}
		{foreach from=$dekanlist item=var}
			{if $sg.sg_dekan == $var.studiendekan_id}
				<input checked="checked" type="radio" name="dekan" value="{$var.studiendekan_id}"> {$var.person_vorname} {$var.person_name}
			{else}
				<input type="radio" name="dekan" value="{$var.studiendekan_id}"> {$var.person_vorname} {$var.person_name}
			{/if}
			{if $counter % 4 == 0}
				<br>
			{/if}
			{$counter = $counter + 1}
		{/foreach}
	</td>
</tr>
<tr>
	<td width=150 id="form_caption">
		Pr&uuml;fungs und Studiumsordnung
	
	</td>
	<td width=250 align=left>
		<!--
		<object data="{$pdf_poso_dir}{$sg.sg_po}" type="application/pdf" width="800" height="300">
 
		  <p>It appears you don't have a PDF plugin for this browser.
 			 No biggie... you can <a href="{$pdf_poso_dir}{$sg.sg_po}">click here to
 			 download the PDF file.</a></p>
		</object>
		-->
		{if $sg.sg_po}
		
		<b>Studiums und Pr&uuml;fungsordnung vorhanden.</b> <a href="{$pdf_poso_dir}{$sg.sg_po}?time={$timestamp}"> Hier </a>klicken um es anzuzeigen.<br>
		{else}
			<b>Keine Studiums und Pr&uuml;fungsordnung vorhanden.</b><br>
		{/if}
		Wollen Sie eine neue hochladen?<br>
		<input type="hidden" name="max_file_size" value="10000000">
		<input name="poso_file" type="file">
	</td>
</tr>

<tr>
	<td width=150 id="form_caption">
		Modulhandbuch
	
	</td>
	<td width=250 align=left>
		<!--
		<object data="{$pdf_modulhandbuch_dir}{$sg.sg_modulhandbuch}" type="application/pdf" width="800" height="300">
 
		  <p>It appears you don't have a PDF plugin for this browser.
 			 No biggie... you can <a href="{$pdf_modulhandbuch_dir}{$sg.sg_modulhandbuch}">click here to
 			 download the PDF file.</a></p>
		</object>
		-->
		{if $sg.sg_modulhandbuch}
			<b>Modulhandbuch vorhanden.</b> <a href="{$pdf_modulhandbuch_dir}{$sg.sg_modulhandbuch}?time={$timestamp}"> Hier </a>klicken um es anzuzeigen.<br>
		{else}
			<b>Kein Modulhandbuch vorhanden.</b><br>
		{/if}
		Wollen Sie ein neues Modulhandbuch 
		<a href="pdf/pdf_create.php?type=Modulhb&forid={$sg.sg_id}&toFile=yes">generieren</a>? <br>
	</td>
</tr>
<tr>
	<td width=150 id="form_caption">
		Status des Studiengangs
	</td>
	<td width=250 align=left>
		<input type="radio" name="sg_status" value="kreiert"{if $sg.sg_status==kreiert} checked="checked"{/if}> kreiert<br>
		<input type="radio" name="sg_status" value="konstruiert"{if $sg.sg_status==konstruiert} checked="checked"{/if}> konstruiert<br>
		<input type="radio" name="sg_status" value="beschlossen"{if $sg.sg_status==beschlossen} checked="checked"{/if}> beschlossen<br>
		<input type="radio" name="sg_status" value="abgestimmt"{if $sg.sg_status==abgestimmt} checked="checked"{/if}> abgestimmt<br>
		<input type="radio" name="sg_status" value="bestaetigt"{if $sg.sg_status==bestaetigt} checked="checked"{/if}> best&auml;tigt
	</td>
</tr>
<tr>
	<td width=150 id="form_caption">
		Erstellungsdatum
	
	</td>
	<td width=250 align=left>
		<input type="text" name="sg_name" disabled=true value="{$sg.sg_createdate}">
	</td>
</tr>

<tr>
	<td width=150 id="form_caption"  style="vertical-align:top;">
		Modulaufstellung<br>
	</td>
	<td width=800 align=left>
		<!--
		<input type="text" name="sg_name" value="{$sg.dekanvorname} {$sg.dekanname}">
		-->
		{if $sg.sg_typ==Bachelor}
			{$sems = 6}
		{else if $sg.sg_typ==Master}
			{$sems = 4}
		{else if $sg.sg_typ == Diplom}
			{$sems = 10}
		{/if}
		<table width="650" style="border-collapse: collapse;">
		<tr style="font-size: 9px; font-weight: bold;">
			<td width="5%" class="SGedit_modul_table"></td>
			<td width="40%" class="SGedit_modul_table">Modulname</td>
			<td width="20%" class="SGedit_modul_table">Angebot Modul</td>
			<td width="5%" class="SGedit_modul_table">PS</td>
			<td width="30%" class="SGedit_modul_table">Verwendbarkeit</td>
		</tr>
		{foreach $modullist item=var key=keyValue}
		<tr {if !$var.in_SG}style="color:gray;"{/if} id="modul_row_{$var.modul_id}">
			<td width="5%" >
				<input id="modul_chkbox_{$var.modul_id}" onClick="Modul_Checkbox({$var.modul_id},{$sems})" {if $var.in_SG}checked="checked"{/if} type="checkbox" name="modulaufstellung[]" value="{$var.modul_id}">
			</td>
			<td width="40%">{$var.modul_name}</td>
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
			<td widht="30%">
				{$var.modul_usability}
			</td>
		</tr>
		<tr>
			<td colspan="5" style="border-bottom: 1px black solid;">
			</td>
		</tr>
		{/foreach}
		</table>
	</td>
</tr>
</table>

<br><br>
<table width="800">
<tr>
	<td style="text-align: left;">
		<input type="button" value="Zur&uuml;ck" onClick="window.location='{$rootDir}SG_edit.php'">
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