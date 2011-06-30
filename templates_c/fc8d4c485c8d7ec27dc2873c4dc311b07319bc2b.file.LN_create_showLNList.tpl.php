<?php /* Smarty version Smarty-3.0.8, created on 2011-06-30 23:06:03
         compiled from "/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/LN_create_showLNList.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13628165244e0d015b5f09c0-62460318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc8d4c485c8d7ec27dc2873c4dc311b07319bc2b' => 
    array (
      0 => '/Applications/XAMPP/xamppfiles/htdocs/UniManager/templates/LN_create_showLNList.tpl',
      1 => 1309475161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13628165244e0d015b5f09c0-62460318',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','foo'); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

Es werden hier alle Leistungsnachweise angezeigt, zu denen sie sich anmelden k&ouml;nnen.
<br><br>
<table>
<tr>
	<th>Modulname</th>
	<th>Datum</th>
	<th>Pruefer</th>
	<th>Vorraussetzungen</th>
	<th></th>
</tr>

<?php  $_smarty_tpl->tpl_vars['var'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('LN')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['var']->key => $_smarty_tpl->tpl_vars['var']->value){
?>
<tr>
	<td><?php echo $_smarty_tpl->tpl_vars['var']->value['modul_name'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['var']->value['ln_datum'];?>
</td>
	<td><?php echo $_smarty_tpl->tpl_vars['var']->value['ln_pruefer'];?>
</td>
	<td style="text-align: center;"><?php echo $_smarty_tpl->tpl_vars['var']->value['ln_vorraussetzungen'];?>
</td>
	<td><a href="<?php echo $_smarty_tpl->getVariable('rootDir')->value;?>
LN_create.php?forid=<?php echo $_smarty_tpl->tpl_vars['var']->value['ln_id'];?>
">anmelden</a></td>
</tr>
<?php }} ?>
</table>

<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('title','foo'); echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>