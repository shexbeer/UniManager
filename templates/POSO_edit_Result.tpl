{include file="header.tpl" title=foo} 

<b><u>Resultat</u></b><br><br>
{if $result==false}
Es ist ein Fehler bei der Editierung der Studien-/Pr�fungsordnung aufgetreten.<br>
Studien-/Pr�fungsordnung wurde nicht ge�ndert!<br>
Fehlermeldung des Systems: <span id="systemfehler">{$extra_msg}</span>
{else}
Studien-/Pr�fungsordnung wurde erfolgreich ge�ndert.
{/if}

{include file="footer.tpl" title=foo}

