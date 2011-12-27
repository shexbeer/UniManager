{include file="header.tpl" title=foo}
<form action="SG_edit.php?createnew=yes" method="POST">
Hier k&ouml;nnen sie eine neuen Studiengang kreieren
<br><br>
<table width=500><table cellspacing="20">

<tr>
	<td width=150 id="form_caption">
		Studiengang Ident
	
	</td>
	<td width=250 align=left>
		(wird automatisch vergeben)
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
	<td width=250 align=left>
		<input type="text" name="sg_name" size="50" >
	</td>

</tr>

<tr>
	<td width=150 id="form_caption">
		Dekan ausw&auml;hlen
	
	</td>
	<td width=250 align=left>
		{foreach from=$dekanlist item=var}
			<input type="radio" name="dekan" value="{$var.studiendekan_id}"> {$var.person_vorname} {$var.person_name}<br>
		{/foreach}
	</td>
</tr>
<!-- 
<tr>
	<td width=150>
		Studiensordnung & Pr&uuml;fungsordnung
	
	</td>
	<td width=250 align=left>
		<input type="hidden" name="max_file_size" value="10000">
		<input name="SO_File" type="file"> 
	</td>
</tr>
-->
<tr>
	<td width=150 id="form_caption">
		Modulhandbuch
	
	</td>
	<td width=250 align=left>
		(wird automatisch aus den ausgew&auml;hlten Modulen erstellt)
	</td>

</tr>


<tr>
	<td width=150 id="form_caption">
		Status des Studiengangs
	
	</td>
	<td width=250 align=left>
		(wird nach Erstellen auf "kreiert" gesetzt, da weitere Zustimmungen notwendig sind)
	</td>

</tr>
</table>
<input type="submit" value="Studiengang erstellen">
</form>

{include file="footer.tpl" title=foo}