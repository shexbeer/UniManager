{include file="header.tpl" title=foo} 
<form action="{$rootDir}POSO_edit.php?editPOSO=yes" method="POST">
Hier k&ouml;nnen Sie die Felder des Templates ausf&uuml;llen.<br>
<br>
{foreach from=$descriptions item=var key=keyVal}
<input type="hidden" value="{$sgid}" name="sgid">
<div id="form_caption" style="font-size: 14px; background-color: black; color: white;">{$keyVal}</div>
<table style="position: relative; left: 100px;">
{foreach from=$var item=text key=desc}
<tr>
	{if !is_array($text)}
		<td id="form_caption" width="150" style="vertical-align:top;">{$desc}</td>
		<td><input type="text" value="{$text}" size="50" name="{$keyVal}[{$desc}]"></td>
	{else}
		<td id="form_caption" width="150" style="vertical-align:top;">{$desc}</td>
		<td><textarea cols="51" rows="10" name="{$keyVal}[{$desc}]"> {$text.value}</textarea></td>
	{/if}
</tr>
{/foreach}
</table>
{/foreach}

<br><br>
<table width="800">
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