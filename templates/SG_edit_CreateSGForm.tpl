{include file="header.tpl" title=foo}
<form action="SG_edit.php?createnew=yes" method="POST">
Hier k&ouml;nnen sie eine neuen Studiengang kreieren
<br><br>
<table width=500><table cellspacing="20">

<tr>
	<td width=150><font size="2" >
		Studiengang Ident
	</font>
	</td>
	<td width=250 align=left>
		(wird automatisch vergeben)
	</td>

</tr>

<tr>
	<td width=150><font size="2" >
		Studiengangname
	</font>
	</td>
	<td width=250 align=left>
		<input type="text" name="sg_name" size="50" >
	</td>

</tr>

<tr>
	<td width=150><font size="2" >
		Dekan ausw&auml;hlen
	</font>
	</td>
	<td width=250 align=left>
		{foreach from=$dekanlist item=var}
			<input type="radio" name="dekan" value="{$var.studiendekan_id}"> {$var.person_vorname} {$var.person_name}<br>
		{/foreach}
	</td>
</tr>
<!-- 
<tr>
	<td width=150><font size="2" >
		Studiensordnung & Pr&uuml;fungsordnung
	</font>
	</td>
	<td width=250 align=left>
		<input type="hidden" name="max_file_size" value="10000">
		<input name="SO_File" type="file"> 
	</td>
</tr>
-->
<tr>
	<td width=150><font size="2" >
		Modulhandbuch
	</font>
	</td>
	<td width=250 align=left>
		(wird automatisch aus den ausgew&auml;hlten Modulen erstellt)
	</td>

</tr>


<tr>
	<td width=150><font size="2" >
		Status des Studiengangs
	</font>
	</td>
	<td width=250 align=left>
		(wird nach Erstellen auf "kreiert" gesetzt, da weitere Zustimmungen notwendig sind)
	</td>

</tr>
</table>
<input type="submit" value="Studiengang erstellen">
</form>

{include file="footer.tpl" title=foo}