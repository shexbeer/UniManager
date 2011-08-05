<?php /* Smarty version Smarty-3.0.8, created on 2011-08-05 10:36:04
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/Error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14507175984e3bc794560495-12491102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53f1f5cef92f680d2d77fc31f40fd5b4c42a6451' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/Error.tpl',
      1 => 1309476042,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14507175984e3bc794560495-12491102',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('showHeaders')->value!=false){?>
	<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }else{ ?>
	<link rel='stylesheet' type='text/css' href='/UniManager/css/style1.css'>
<?php }?>
<h1>Es ist folgender Fehler aufgetreten:</h1>
<li><b>Error-Code:</b> <?php echo $_smarty_tpl->getVariable('error_code')->value;?>
</li>
<li><b>Error-Message:</b> <?php echo $_smarty_tpl->getVariable('error_msg')->value;?>
</li>
<?php if ($_smarty_tpl->getVariable('extra_info')->value){?>
	<li><?php echo $_smarty_tpl->getVariable('extra_info')->value;?>
</li>
<?php }?>
<?php if ($_smarty_tpl->getVariable('showFooters')->value!=false){?>
	<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }?>