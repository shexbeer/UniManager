<?php /* Smarty version Smarty-3.0.8, created on 2011-06-21 13:10:52
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10480775964e00985c5ea437-31976843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c584d8d3ae285e04cc3808c4ec0c35f9c8ab3014' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/header.tpl',
      1 => 1308592914,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10480775964e00985c5ea437-31976843',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<html>
<head>
<link rel='stylesheet' type='text/css' href='<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
<?php echo $_smarty_tpl->getVariable('css_datei')->value;?>
'>
<script type='text/javascript' src='<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
js/lib.js'></script>
</head>
	<body>
<h1><?php echo $_smarty_tpl->getVariable('seite')->value;?>
</h1>
<hr width='400' align='left'>
<?php echo $_smarty_tpl->getVariable('datum_zeit')->value;?>

 | <a href='<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
#'>Menu1</a>
 | <a href='<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
#'>Menu2</a>
 | <a href='#'>Hilfe</a>
<?php if ($_smarty_tpl->getVariable('admin')->value){?>
 | <a href='<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
admin.php'>Admin</a>
<?php }?>
 | <a href='<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
logout.php'>Logout</a><br>

Herzlich Willkommen <b><?php echo $_smarty_tpl->getVariable('user_vorname')->value;?>
</b>,
<br>