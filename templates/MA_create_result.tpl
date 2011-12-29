{include file="header.tpl" title=foo}

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist leider ein Fehler aufgetreten bei Ihrer Erstellung des Modulangebots.<br>
Modulangebot wurd <b>nicht</b> erstellt.<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Modulangebot wurde erfolgreich erstellt!
{/if}
<br><br>
<a href="MA_create.php">Zur&uuml;ck zur Hauptseite</a>

{include file="footer.tpl" title=foo}