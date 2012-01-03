{include file="header.tpl" title=foo} 

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist ein Fehler bei der speicherung des PO/SO Template aufgetreten.<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
PO/SO Template erfolgreich gespeichert.<br>
<input type="button" value="Zur&uuml;ck" onClick="window.location='{$rootDir}POSO_edit.php'">
{/if}

{include file="footer.tpl" title=foo}

