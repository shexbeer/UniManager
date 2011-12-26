{include file="header.tpl" title=foo}

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist leider ein Fehler aufgetreten bei Ihrer Aenderung/Erstellung des Studiengangs.<br>
Studiengang wurd <b>nicht</b> geaendert/erstellt.<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Studeingang wurd erfolgreich geandert!
{/if}

{include file="footer.tpl" title=foo}