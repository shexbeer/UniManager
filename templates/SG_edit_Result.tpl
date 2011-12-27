{include file="header.tpl" title=foo}

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist leider ein Fehler aufgetreten bei Ihrer Aenderung/Erstellung des Studiengangs.<br>
Studiengang wurd <b>nicht</b> geaendert/erstellt.<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Studiengang wurde erfolgreich ge&auml;ndert!
{/if}
<br><br>
<a href="SG_edit.php">Zur&uuml;ck zur Hauptseite</a>

{include file="footer.tpl" title=foo}