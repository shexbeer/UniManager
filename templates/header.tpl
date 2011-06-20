<html>
<head>
<link rel='stylesheet' type='text/css' href='{$rootDir}{$css_datei}'>
<script type='text/javascript' src='{$rootDir}js/lib.js'></script>
</head>
	<body>
<h1>{$seite}</h1>
<hr width='400' align='left'>
{$datum_zeit}
 | <a href='{$rootDir}#'>Menu1</a>
 | <a href='{$rootDir}#'>Menu2</a>
 | <a href='#'>Hilfe</a>
{if $admin}
 | <a href='{$rootDir}admin.php'>Admin</a>
{/if}
 | <a href='{$rootDir}logout.php'>Logout</a><br>

Herzlich Willkommen <b>{$user_vorname}</b>,
<br>