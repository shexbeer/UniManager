<?php
#ini_set("session.gc_probability", "1000");
#ini_set("session.gc_maxlifetime", "900");
#ini_set("session.cookie_lifetime", "10");
#ini_set("session.use_only_cookies","0");
#ini_set("session.use_trans_sid","1");


require_once("main.class.php");

$UM = new UniManager();
// ##
// Falls irgendwas nicht übergeben wurde, sofort ausloggen!
// ##
if(!$HTTP_POST_VARS['user'] || !$HTTP_POST_VARS['password'] || !$HTTP_POST_VARS['submit'])
{
	$UM->trigger_error("1", NULL, false, false);
	exit;
}

$user = $HTTP_POST_VARS['user'];
$sql = "SELECT user_id, user_loginname, user_passwort, user_vorname, user_nachname, user_lastlogin, user_accesslvl FROM user WHERE user_loginname='$user'";
$res = mysql_query($sql);
$row = mysql_fetch_object($res);

// Falls es User nicht gibt, ausloggen!
if(!$row->user_loginname)
{
	$UM->trigger_error("2", NULL, false, false);
	session_destroy();
	exit;
}

// Falls auch Passwort jetzt stimmt, werden Sessionveriablen gesetzt und weitergeleitet!
if(md5($HTTP_POST_VARS['password']) != $row->user_passwort)
{
	$UM->trigger_error("2", NULL, false, false);
	session_destroy();
	exit;
}
else // Wenn dann alles richtig war ...
{
	$_SESSION['user_loginname'] = $HTTP_POST_VARS['user'];
	$_SESSION['user_id'] = $row->user_id;
	$_SESSION['user_vorname'] = $row->user_vorname;
	$_SESSION['user_nachname'] = $row->user_nachname;
	$_SESSION["user_accesslvl"] = $user->user_accesslvl;	
	
	// ##
	// Aktuellen Timestamp in DB eintragen wegen Status ....
	// ##
	$sql = "UPDATE user SET user_lastlogin = '" . time() . "' WHERE user_id = '" . $_SESSION["user_id"] . "'";
	$res = mysql_query($sql);
	
	header("Location: " . $UM->cwd["rootDir"] . "main.php");
	exit;
}
