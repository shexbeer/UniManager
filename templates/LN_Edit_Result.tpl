{include file="header.tpl" title=foo}

<b><u>Resultat</u></b><br><br>
{if $error==true}
Es ist leider ein Fehler aufgetreten bei Ihrer Aenderung zum Note.<br>
Note wurden <b>nicht</b> geaendert.<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Die Note wurden erfolgreich geandert!
{/if}

{include file="footer.tpl" title=foo}