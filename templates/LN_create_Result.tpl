{include file="header.tpl" title=foo}

<b><u>Resultat</u></b><br><br>
{if $error==true}
	Es ist leider ein Fehler aufgetreten bei Ihrer Anmeldung zum Leistungsnachweis.<br>
	Sie wurden <b>nicht</b> angemeldet.<br>
	Fehlermeldung des Systems:	<span id="systemfehler">{$extra_msg}</span>
{else}
	Sie wurden erfolgreich zum Leistungsnachweis angemeldet!
{/if}

{include file="footer.tpl" title=foo}