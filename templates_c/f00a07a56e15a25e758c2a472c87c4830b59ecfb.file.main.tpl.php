<?php /* Smarty version Smarty-3.0.8, created on 2011-08-08 14:21:37
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20125407234e3ff0f1748e56-66284491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f00a07a56e15a25e758c2a472c87c4830b59ecfb' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/main.tpl',
      1 => 1309476042,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20125407234e3ff0f1748e56-66284491',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','foo'); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<table width="400" border="0" cellspacing="1" cellpadding="3">
<tr>

<td valign="top" width="50%">
Inhalt
</td>

<td valign="top">
sehr guter Inhalt
</td>


</tr>
</table>
<br>

<table width="400" border="0" cellspacing="1" cellpadding="3">
<tr>
<td bgcolor="#F0F0F0">
<b>-----</b>
</td>
</tr>
</table>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','foo'); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>