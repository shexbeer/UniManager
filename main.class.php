<?php 
// V. 0.1
// Config Vars
define('stylesheet', "css/style1.css");
define('PO_dir', "process_objects/");
define('VO_dir', "visible_objects/");
define('prefix_PO', "PO_");
define('prefix_VO', "VO_");
define('template_dir', "templates");
// end Config Vars sadasdasdsad
session_start();

class UniManager
{
	function UniManager($site = '', $sub = '')
	{
		require_once("db.mysql.php");
		
		// $this->start_time = time() . substr(microtime(), 1, 9);
		// um Parsing Time fŸr eine Seite zu berechnen, wird hier Startzeit gesetzt
		$this->start_time = substr(microtime(), 0, 6);
		
		// Pfade setzen
		$this->get_cwd(); 
		
		// Template 			
		include_once("lib_smarty/Smarty.class.php");

		$this->tpl = new Smarty;

		$this->tpl->debugging = false;
		$this->tpl->caching = false;
		$this->tpl->compile_check = false;
		$this->tpl->force_compile = true;
		$this->tpl->cache_dir = $this->cwd["Path"] . "template_cache/";
		$this->tpl->template_dir = $this->cwd["Path"] . "templates";
		$this->tpl->compile_dir = $this->cwd["Path"] . "templates_c"; 


		// Deprecated Nachrichten unterdrŸcken FIXME:
		//error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
		
		// Experimenteller Cache
		/**
		 * if($site && !$sub)
		 * {
		 * $template = $site . ".tpl";
		 * }
		 * else
		 * {
		 * $template = $sub . ".tpl";
		 * }
		 * 
		 * if($this->tpl->is_cached($template,session_id()))
		 * {
		 * echo "Gecachte Seite:";
		 * $this->tpl->display($template,session_id());
		 * die();
		 * }
		 */
		 
		// Prozessobjekt der Seite laden
		if(is_file($this->cwd["Path"] . PO_dir . prefix_PO . $site . ".php"))
		{
			require_once($this->cwd["Path"] . PO_dir . prefix_PO . $site . ".php");
			$tmp_require_once_name = prefix_PO . $site;
			$this->ProcessObject = new $tmp_require_once_name();
		}

	}
	function get_cwd()
	{ 
		// define('SMARTY_DIR', dirname(__FILE__) . DIRECTORY_SEPARATOR);
		$cwd = $_SERVER["PHP_SELF"];
		$this->cwd["scriptDir"] = substr($cwd, 0, strrpos($cwd, "/") + 1);
		$this->cwd["rootDir"] = substr($cwd, 0, strpos($cwd, "UniManager") + 11);
		$this->cwd["scriptName"] = substr($cwd, strpos($cwd, "UniManager") + 11, strlen($cwd));
		$this->cwd["Path"] = substr($_SERVER['SCRIPT_FILENAME'], 0, strpos($_SERVER['SCRIPT_FILENAME'], "UniManager") + 11);
	}
	function trigger_error($code, $extra_infos = '', $showHeaders = true, $showFooters = true)
	{
		$error_codes = array("0" => "Sie sind nicht/nicht mehr eingeloggt!",
			"1" => "Unvollstaendige GET/POST Uebergabe",
			"2" => "Falscher Benutzername oder Passwort");

		$this->showHeader("Error! Code: " . $code);
		$this->tpl->assign("showHeaders", $showHeaders);
		$this->tpl->assign("showFooters", $showFooters);
		$this->tpl->assign("error_code", $code);
		$this->tpl->assign("error_msg", $error_codes[$code]);
		$this->tpl->assign("extra_info", $extra_infos);
		$this->showFooter();
		$this->tpl->display("Error.tpl", session_id());
		die();
	}
	function SessionEnd()
	{
		$this->trigger_error("0", "<a href='index.php'>Hier</a> koennen sie sich neu einloggen.", false, false);
		session_destroy();
		die();
	}
	function showheader($seite)
	{
		$timestamp = time();
		$datum = date("d.m.Y", $timestamp);
		$zeit = date("H:i:s", $timestamp);
		$this->tpl->assign("datum_zeit", $datum . " " . $zeit);
		$this->tpl->assign("rootDir", $this->cwd["rootDir"]);
		$this->tpl->assign("css_datei", stylesheet);
		$this->tpl->assign("seite", $seite);
	
		$this->tpl->assign("user_loginname", $_SESSION["user_loginname"]);
		$this->tpl->assign("user_vorname", $_SESSION["user_vorname"]);
		$this->tpl->assign("user_nachname", $_SESSION["user_nachname"]);
		
		//$admin = $this->checkAccesslvl("admin.php");
		//$this->tpl->assign("admin", $admin);
	}
	function showfooter()
	{
		$this->tpl->assign("rootDir", $this->cwd["rootDir"]); 
		// $this->tpl->assign("parse_dauer", substr((time() . substr(microtime(), 1, 9)) - $this->start_time, 0, 6));
		$this->tpl->assign("parse_dauer", substr(microtime(), 0, 6) - $this->start_time);
	}
	function getUserID($name)
	{
		$sql = "SELECT id FROM user WHERE user='" . $name . "'";
		$res = mysql_query($sql);
		if(mysql_affected_rows() == 0)
		{
			$this->trigger_error("9");
		}
		$_id = mysql_fetch_object($res);

		return $_id->id;
	}
	function checkAccesslvl($site)
	{
		$sql = "SELECT * FROM restricted WHERE linkurl = '" . $site . "'";
		$res = mysql_query($sql);
		if(mysql_affected_rows() == 0)
		{
			$lvl = 1;
		}
		else
		{
			$restricted = mysql_fetch_object($res);
			if($restricted->accesslvl <= $_SESSION["accesslvl"])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}
