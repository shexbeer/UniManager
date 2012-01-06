<?php
if ($_GET){
    if ($_GET['page'] == 'about')
    {
	    echo "<h1>Impressum</h1>";
	    echo "Christian Seidel<br>";
	    echo "Daniel Rzehak<br>";
	    echo "Sebastian Gasch<br>";
	    echo "Fei Wang";
	    die();
    }
}

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
</head>
<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td align="center" valign="middle">
         <img src="img/logo.gif" border="0">
         <br>
         <table width="500" border="0" cellspacing="15" cellpadding="5">
		<tr>
		<form action="login.php" method="POST">
                 <td bgcolor="#F0F0F0" width="50%" valign="top">
                		<h1>Anmeldung</h1>
                 	Nutzername:<br><input type="text" name="user"><br>
                 	Passwort:<br><input type="password" name="password"><br>
                 	<input type="submit" name="submit" value="anmelden">
		</td>
                 </form>
                 <td bgcolor="#F0F0F0" width="50%" valign="top">
                         <h1>Allgemein</h1>
                         <a href="#">>> registrieren</a><br>
                         <a href="#">>> Passwort vergessen?</a>
                 </td>
                 </tr>
                 <tr>
                 <td colspan="2" align="right">
                 	<a href="#" onClick="window.open('index.php?page=about','','toolbar=no,width=200,height=200')"><font color="#CCCCCC">Impressum</font></a>
                         | <a href="#" onClick="window.open('#','','toolbar=no,width=400,height=440')"><font color="#CCCCCC">AGB</font></a>
                         | <a href="#" onClick="window.open('#','','toolbar=no, scrollbars=yes,width=450,height=400')"><font color="#CCCCCC">Hilfe</font></a>
                 </td>
                 </tr>
         <tr><td colspan=2>
         <b>(Javascript muss aktiviert sein f&uuml;r diese Seite)</b></td></tr>
         </table>
         </td>
</tr>
<tr>
<td>

</td>
</tr>
</table>
<br><br>
</body>
</html>