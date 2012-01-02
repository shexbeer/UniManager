<a href='{$rootDir}main.php'>Startseite</a> <br>
<hr noshade size="1">

{if $user_roles.student==true}
	<a href='{$rootDir}LN_create.php'>Leistungsnachweis anmelden</a> <br>
	<a href='{$rootDir}LNA_show.php'>Noten einsehen</a> <br>
{/if}
{if $user_roles.lehrende}
	<a href='{$rootDir}LN_edit.php'>Leistungsnachweis benoten</a> <br>
{/if}

<hr noshade size="1">

{if $user_roles.fakultaetsrat || $user_roles.studiendekan || $user_roles.rektorat}
	<a href='{$rootDir}SG_edit.php'>Studiengangmanagement</a> <br>
{/if}
{if $user_roles.fakultaetsrat || $user_roles.studiendekan || $user_roles.lehrende}
	<a href='{$rootDir}Modul_IE.php' style="color: red;">Modulinhalte erstellen (Sebastian)</a> <br>
{/if}
{if $user_roles.studiendekan}
	<a href='{$rootDir}POSO_edit.php' style="color: red;">PO/SO edit(Fei)</a> <br>
{/if}

<hr noshade size="1">

{if $user_roles.lehrbeauftragter}
	<a href='{$rootDir}MA_create.php'>Modulangebot erstellen</a> <br>
{/if}
{if $user_roles.fakultaetsrat || $user_roles.studiendekan}
	<a href='{$rootDir}MA_edit.php'>Modulangebot ver&auml;ndern</a> <br>
{/if}
{if $user_roles.studiendekan}
	<a href='{$rootDir}MA_compare.php'>Modulangebot vergleichen</a> <br>
{/if}
<hr noshade size="1">
<a href='{$rootDir}logout.php'>Logout</a><br>