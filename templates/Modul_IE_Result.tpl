{include file="header.tpl" title=foo}

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist leider ein Fehler aufgetreten bei Ihrer Aenderung zum Modul.<br>
Modul wurd <b>nicht</b> geaendert.<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Modul wurd erfolgreich geandert!
{/if}

{include file="footer.tpl" title=foo}