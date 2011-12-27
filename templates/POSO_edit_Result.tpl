{include file="header.tpl" title=foo} 

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist ein Fehler bei der Editierung der Studien-/Prüfungsordnung aufgetreten.<br>
Studien-/Prüfungsordnung wurde nicht geändert!<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Studien-/Prüfungsordnung wurde erfolgreich geändert.
{/if}

{include file="footer.tpl" title=foo}

