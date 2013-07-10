<?php /* Smarty version 2.6.11, created on 2013-07-09 13:29:44
         compiled from themes/SugarStrap/tpls/_headerModuleList.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_link', 'themes/SugarStrap/tpls/_headerModuleList.tpl', 78, false),)), $this); ?>
<?php if ($this->_tpl_vars['USE_GROUP_TABS']): ?>
<div class="navbar navbar-fixed-top navbar-inverse" id="moduleList">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php $this->assign('groupSelected', false); ?>
                    <?php $_from = $this->_tpl_vars['groupTabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['groupList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['groupList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['group'] => $this->_tpl_vars['modules']):
        $this->_foreach['groupList']['iteration']++;
?>
                    <?php ob_start(); ?>parentTab=<?php echo $this->_tpl_vars['group'];  $this->_smarty_vars['capture']['extraparams'] = ob_get_contents();  $this->assign('extraparams', ob_get_contents());ob_end_clean(); ?>
                    <?php if (( ( $_REQUEST['parentTab'] == $this->_tpl_vars['group'] || ( ! $_REQUEST['parentTab'] && in_array ( $this->_tpl_vars['MODULE_TAB'] , $this->_tpl_vars['modules']['modules'] ) ) ) && ! $this->_tpl_vars['groupSelected'] ) || ( ($this->_foreach['groupList']['iteration']-1) == 0 && $this->_tpl_vars['defaultFirst'] )): ?>
                    <li class="active">
                        <a href="#" rel="moduleLink_<?php echo ($this->_foreach['groupList']['iteration']-1); ?>
"><?php echo $this->_tpl_vars['group']; ?>
</a>
                        <?php $this->assign('groupSelected', true); ?>
                    <?php else: ?>
                    <li>
                        <a href="#" rel="moduleLink_<?php echo ($this->_foreach['groupList']['iteration']-1); ?>
"><?php echo $this->_tpl_vars['group']; ?>
</a>
                    <?php endif; ?>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "themes/SugarStrap/tpls/_welcome.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
        </div>
    </div>
</div>

<div class="hidden-phone">
    <div class="navbar submenu">
        <div class="navbar-inner">
            <?php $this->assign('groupSelected', false); ?>
            <?php $_from = $this->_tpl_vars['groupTabs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['moduleList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['moduleList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['group'] => $this->_tpl_vars['modules']):
        $this->_foreach['moduleList']['iteration']++;
?>
            <?php ob_start(); ?>parentTab=<?php echo $this->_tpl_vars['group'];  $this->_smarty_vars['capture']['extraparams'] = ob_get_contents();  $this->assign('extraparams', ob_get_contents());ob_end_clean(); ?>
        	<ul class="nav<?php if (( ( $_REQUEST['parentTab'] == $this->_tpl_vars['group'] || ( ! $_REQUEST['parentTab'] && in_array ( $this->_tpl_vars['MODULE_TAB'] , $this->_tpl_vars['modules']['modules'] ) ) ) && ! $this->_tpl_vars['groupSelected'] ) || ( ($this->_foreach['moduleList']['iteration']-1) == 0 && $this->_tpl_vars['defaultFirst'] )): ?> selected<?php endif; ?>" id="moduleLink_<?php echo ($this->_foreach['moduleList']['iteration']-1); ?>
" <?php if (( ( $_REQUEST['parentTab'] == $this->_tpl_vars['group'] || ( ! $_REQUEST['parentTab'] && in_array ( $this->_tpl_vars['MODULE_TAB'] , $this->_tpl_vars['modules']['modules'] ) ) ) && ! $this->_tpl_vars['groupSelected'] ) || ( ($this->_foreach['moduleList']['iteration']-1) == 0 && $this->_tpl_vars['defaultFirst'] )): ?>class="selected" <?php $this->assign('groupSelected', true);  endif; ?>>
    	        <?php $_from = $this->_tpl_vars['modules']['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['modulekey'] => $this->_tpl_vars['module']):
?>
    	        <li>
    	        	<?php ob_start(); ?>moduleTab_<?php echo ($this->_foreach['moduleList']['iteration']-1); ?>
_<?php echo $this->_tpl_vars['module'];  $this->_smarty_vars['capture']['moduleTabId'] = ob_get_contents();  $this->assign('moduleTabId', ob_get_contents());ob_end_clean(); ?>
    	        	<?php echo smarty_function_sugar_link(array('id' => $this->_tpl_vars['moduleTabId'],'module' => $this->_tpl_vars['modulekey'],'data' => $this->_tpl_vars['module'],'extraparams' => $this->_tpl_vars['extraparams']), $this);?>

    	        </li>
    	        <?php endforeach; endif; unset($_from); ?>
    	        <?php if (! empty ( $this->_tpl_vars['modules']['extra'] )): ?>
    	        <li class="dropdown">
    	        	<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
    		        <ul class="dropdown-menu" aria-labelledby="drop1">
    		        <?php $_from = $this->_tpl_vars['modules']['extra']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['submodule'] => $this->_tpl_vars['submodulename']):
?>
    					<li>
    						<a href="<?php echo smarty_function_sugar_link(array('module' => $this->_tpl_vars['submodule'],'link_only' => 1,'extraparams' => $this->_tpl_vars['extraparams']), $this);?>
"><?php echo $this->_tpl_vars['submodulename']; ?>

    						</a>
    					</li>
    		        <?php endforeach; endif; unset($_from); ?>
    		        </ul> 
    	        </li>
    	        <?php endif; ?>
            </ul>
            <?php endforeach; endif; unset($_from); ?>
            <ul class="nav extra pull-right">
                <li class="dropdown">
                    <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">Links <b class="caret"></b></a>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "themes/SugarStrap/tpls/_globalLinks.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="visible-phone">
    <select class="nav<?php if (( ( $_REQUEST['parentTab'] == $this->_tpl_vars['group'] || ( ! $_REQUEST['parentTab'] && in_array ( $this->_tpl_vars['MODULE_TAB'] , $this->_tpl_vars['modules']['modules'] ) ) ) && ! $this->_tpl_vars['groupSelected'] ) || ( ($this->_foreach['moduleList']['iteration']-1) == 0 && $this->_tpl_vars['defaultFirst'] )): ?> selected<?php endif; ?>" id="moduleLink_<?php echo ($this->_foreach['moduleList']['iteration']-1); ?>
" <?php if (( ( $_REQUEST['parentTab'] == $this->_tpl_vars['group'] || ( ! $_REQUEST['parentTab'] && in_array ( $this->_tpl_vars['MODULE_TAB'] , $this->_tpl_vars['modules']['modules'] ) ) ) && ! $this->_tpl_vars['groupSelected'] ) || ( ($this->_foreach['moduleList']['iteration']-1) == 0 && $this->_tpl_vars['defaultFirst'] )): ?>class="selected" <?php $this->assign('groupSelected', true);  endif; ?>>
        <?php $_from = $this->_tpl_vars['modules']['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['modulekey'] => $this->_tpl_vars['module']):
?>
        <option value="<?php echo smarty_function_sugar_link(array('module' => $this->_tpl_vars['submodule'],'link_only' => 1,'extraparams' => $this->_tpl_vars['extraparams']), $this);?>
"><?php echo smarty_function_sugar_link(array('id' => $this->_tpl_vars['moduleTabId'],'module' => $this->_tpl_vars['modulekey'],'data' => $this->_tpl_vars['module'],'extraparams' => $this->_tpl_vars['extraparams']), $this);?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
</div>
<?php else: ?>
<div class="navbar navbar-fixed-top navbar-inverse" id="moduleList">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php $_from = $this->_tpl_vars['moduleTopMenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['moduleList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['moduleList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['module']):
        $this->_foreach['moduleList']['iteration']++;
?>
                    <?php if ($this->_tpl_vars['name'] == $this->_tpl_vars['MODULE_TAB']): ?>
                    <li class="active"><?php echo smarty_function_sugar_link(array('id' => "moduleTab_".($this->_tpl_vars['name']),'module' => $this->_tpl_vars['name']), $this);?>

                    <?php else: ?>
                    <li><?php echo smarty_function_sugar_link(array('id' => "moduleTab_".($this->_tpl_vars['name']),'module' => $this->_tpl_vars['name'],'data' => $this->_tpl_vars['module']), $this);?>

                    <?php endif; ?>
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                    <?php if (count ( $this->_tpl_vars['moduleExtraMenu'] ) > 0): ?>
                    <li id="dropdown">
                        <a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                        <ul class="dropdown-menu" aria-labelledby="drop2">
                            <?php $_from = $this->_tpl_vars['moduleExtraMenu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['moduleList'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['moduleList']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['module']):
        $this->_foreach['moduleList']['iteration']++;
?>
                            <li><?php echo smarty_function_sugar_link(array('id' => "moduleTab_".($this->_tpl_vars['name']),'module' => $this->_tpl_vars['name'],'data' => $this->_tpl_vars['module']), $this);?>

                            <?php endforeach; endif; unset($_from); ?>
                        </ul>        
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>