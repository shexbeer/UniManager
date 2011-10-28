<html>
<head>
<link rel='stylesheet' type='text/css' href='{$rootDir}{$css_datei}'>
<script type='text/javascript' src='{$rootDir}js/lib.js'></script>
</head>
	<body>
<table>
<tr>
	<td width="200">		
		<img src="{$rootDir}img/logo.gif" width="100%">
	</td>
	<td id="ueberschrift_zelle">
		<div id="ueberschrift_seite">{$seite}</div>
	</td>
</table>
<hr width='800' align='left'>
<table>
<tr> 
	<td rowspan="2" width="200">
		<center>
		{include file="navigation_right.tpl" title="navigation"}
		</center>
	</td>
	<td>
		{$datum_zeit}
		{if $admin}
		 | <a href='{$rootDir}admin.php'>Admin</a>
		{/if}
		 | Herzlich Willkommen <b>{$user_vorname} {$user_nachname}</b>,
		<br>
	</td>
<tr>
	<td style="vertical-align:top;">
		