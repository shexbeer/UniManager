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
$sql = "SELECT person_loginname, person_id, person_kennwort, person_vorname, person_name, person_zugriffsrecht FROM person WHERE person_loginname='$user'";
$res = mysql_query($sql);
$row = mysql_fetch_object($res);

// Falls es User nicht gibt, ausloggen!
if(!$row->person_loginname)
{
	$UM->trigger_error("2", NULL, false, false);
	session_destroy();
	exit;
}

// Falls auch Passwort jetzt stimmt, werden Sessionveriablen gesetzt und weitergeleitet!
if(md5($HTTP_POST_VARS['password']) != $row->person_kennwort)
{
	$UM->trigger_error("2", NULL, false, false);
	session_destroy();
	exit;
}
else // Wenn dann alles richtig war ...
{
	$_SESSION['user_loginname'] = $HTTP_POST_VARS['user'];
	$_SESSION['user_id'] = $row->person_id;
	$_SESSION['user_vorname'] = $row->person_vorname;
	$_SESSION['user_nachname'] = $row->person_name;
	$_SESSION["user_accesslvl"] = $row->person_zugriffsrecht;
	
	//fakultaetsrat, lehrbeauftragter, lehrende, rektorat, studiendekan, student
	if($row->person_zugriffsrecht != "100") {
		$_SESSION["user_roles"]["student"] = $UM->checkUserRole($row->person_id,"student");
		$_SESSION["user_roles"]["fakultaetsrat"] = $UM->checkUserRole($row->person_id,"fakultaetsrat");
		$_SESSION["user_roles"]["lehrbeauftragter"] = $UM->checkUserRole($row->person_id,"lehrbeauftragter");
		$_SESSION["user_roles"]["lehrende"] = $UM->checkUserRole($row->person_id,"lehrende");
		$_SESSION["user_roles"]["rektorat"] = $UM->checkUserRole($row->person_id,"rektorat");
		$_SESSION["user_roles"]["studiendekan"] = $UM->checkUserRole($row->person_id,"studiendekan");
	} else { // Adminrechte, alles sehen und verŠndern ;)
		$_SESSION["user_roles"]["student"] = true;
		$_SESSION["user_roles"]["fakultaetsrat"] = true;
		$_SESSION["user_roles"]["lehrbeauftragter"] = true;
		$_SESSION["user_roles"]["lehrende"] = true;
		$_SESSION["user_roles"]["rektorat"] = true;
		$_SESSION["user_roles"]["studiendekan"] = true;
	}
	
	// ##
	// Aktuellen Timestamp in DB eintragen wegen Status ....
	// ##
	//$sql = "UPDATE user SET user_lastlogin = '" . time() . "' WHERE user_id = '" . $_SESSION["user_id"] . "'";
	//$res = mysql_query($sql);
	
	header("Location: " . $UM->cwd["rootDir"] . "main.php");
	exit;
}
