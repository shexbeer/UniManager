<?php /* Smarty version Smarty-3.0.8, created on 2011-08-05 10:36:11
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77454064e3bc79b4b4df5-44397781%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c584d8d3ae285e04cc3808c4ec0c35f9c8ab3014' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/header.tpl',
      1 => 1309479284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77454064e3bc79b4b4df5-44397781',
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
<table>
<tr>
	<td width="200">		
		<img src="<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
img/logo.gif" width="100%">
	</td>
	<td id="ueberschrift_zelle">
		<div id="ueberschrift_seite"><?php echo $_smarty_tpl->getVariable('seite')->value;?>
</div>
	</td>
</table>
<hr width='800' align='left'>
<table>
<tr> 
	<td rowspan="2" width="200">
		<center>
		<?php $_template = new Smarty_Internal_Template("navigation_right.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title',"navigation"); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
		</center>
	</td>
	<td>
		<?php echo $_smarty_tpl->getVariable('datum_zeit')->value;?>

		<?php if ($_smarty_tpl->getVariable('admin')->value){?>
		 | <a href='<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
admin.php'>Admin</a>
		<?php }?>
		 | Herzlich Willkommen <b><?php echo $_smarty_tpl->getVariable('user_vorname')->value;?>
 <?php echo $_smarty_tpl->getVariable('user_nachname')->value;?>
</b>,
		<br>
	</td>
<tr>
	<td>
		