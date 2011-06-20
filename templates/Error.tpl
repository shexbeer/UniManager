{if $showHeaders!=false}
	{include file="header.tpl"}
{else}
	<link rel='stylesheet' type='text/css' href='/UniManager/css/style1.css'>
{/if}
<h1>Es ist folgender Fehler aufgetreten:</h1>
<li><b>Error-Code:</b> {$error_code}</li>
<li><b>Error-Message:</b> {$error_msg}</li>
{if $extra_info}
	<li>{$extra_info}</li>
{/if}
{if $showFooters!=false}
	{include file="footer.tpl"}
{/if}