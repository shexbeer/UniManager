{include file="header.tpl" title=foo}

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist leider ein Fehler bei der Löschung ihres Moduls aufgetreten.<br>
Modul wurde <b>nicht</b> gelöscht<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Das Modul wurde erfolgreich gelöscht!
{/if}

{include file="footer.tpl" title=foo}