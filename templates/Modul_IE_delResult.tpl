{include file="header.tpl" title=foo}

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist leider ein Fehler bei der L�schung ihres Moduls aufgetreten.<br>
Modul wurde <b>nicht</b> gel�scht<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Das Modul wurde erfolgreich gel�scht!
{/if}

{include file="footer.tpl" title=foo}