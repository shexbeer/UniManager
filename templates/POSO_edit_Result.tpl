{include file="header.tpl" title=foo} 

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist ein Fehler bei der Erstellung der PO/SO aufgetreten.<br>
Es wurde keine PO/SO erstellt!<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Studien-/Pr�fungsordnung wurde erfolgreich erstellt.<br>
<input type="button" value="Zur&uuml;ck" onClick="window.location='{$rootDir}POSO_edit.php'">
<input type="button" value="Hier die PDF ansehen" onClick="window.location='{$rootDir}{$extra_msg}'">
{/if}

{include file="footer.tpl" title=foo}

