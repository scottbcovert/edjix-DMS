<?php /* Smarty version 2.6.11, created on 2013-07-11 21:21:33
         compiled from themes/ModernAqua/tpls/_welcome.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimagepath', 'themes/ModernAqua/tpls/_welcome.tpl', 41, false),)), $this); ?>
<?php if ($this->_tpl_vars['AUTHENTICATED']): ?>
<div id="sitemapLink">
    <span id="sitemapLinkSpan">
        <?php echo $this->_tpl_vars['APP']['LBL_SITEMAP']; ?>

        <img src="<?php echo smarty_function_sugar_getimagepath(array('file' => 'MoreDetail.png'), $this);?>
">
    </span>
</div>
<span id='sm_holder'></span>
<div id="welcome">
    <?php echo $this->_tpl_vars['APP']['NTC_WELCOME']; ?>
, <strong><a id="welcome_link" href='index.php?module=Users&action=EditView&record=<?php echo $this->_tpl_vars['CURRENT_USER_ID']; ?>
'><?php echo $this->_tpl_vars['CURRENT_USER']; ?>
</a></strong> [ <a id="welcome_link" href='<?php echo $this->_tpl_vars['LOGOUT_LINK']; ?>
' class='utilsLink'><?php echo $this->_tpl_vars['LOGOUT_LABEL']; ?>
</a> ]
</div>
<?php endif; ?>