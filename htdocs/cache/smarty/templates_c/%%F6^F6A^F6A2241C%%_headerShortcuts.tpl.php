<?php /* Smarty version 2.6.11, created on 2013-07-11 21:21:33
         compiled from themes/ModernAqua/tpls/_headerShortcuts.tpl */ ?>
<?php if (count ( $this->_tpl_vars['SHORTCUT_MENU'] ) > 0): ?>
<div id="shortcuts" class="headerList">
<span><?php echo $this->_tpl_vars['APP']['LBL_LINK_ACTIONS']; ?>
</span>
<ul>
<?php $_from = $this->_tpl_vars['SHORTCUT_MENU']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
	<?php if ($this->_tpl_vars['item']['URL'] == "-"): ?>
          <a></a><span>&nbsp;</span>
        <?php else: ?>
	  <li><a href="<?php echo $this->_tpl_vars['item']['URL']; ?>
"><?php echo $this->_tpl_vars['item']['IMAGE']; ?>
&nbsp;<span><?php echo $this->_tpl_vars['item']['LABEL']; ?>
</span></a></li>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php endif; ?>