{include file="header.tpl" title=foo} 
<form action="{$rootDir}POSO_edit.php?editTemplate=yes" method="POST">
<input type="hidden" value="{$type}" name="type">
<textarea rows=40 cols=100 name="content">{$content}</textarea>

<br><br>
<table width="600">
<tr>
	<td style="text-align: left;">
		<input type="button" value="Zur&uuml;ck" onClick="window.location='{$rootDir}POSO_edit.php'">
		<!--<a href="MA_create.php">Zur&uuml;ck</a>-->
	</td>
	<td  style="text-align: right;">
		<input type="submit" id="poso_submit" value="Erstellen">
	</td>
</tr>
</table>
</form>

{include file="footer.tpl" title=foo} 