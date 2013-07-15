<?php /* Smarty version 2.6.11, created on 2013-07-11 21:21:33
         compiled from themes/ModernAqua/tpls/_headerSearch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimagepath', 'themes/ModernAqua/tpls/_headerSearch.tpl', 44, false),)), $this); ?>
<?php if ($this->_tpl_vars['AUTHENTICATED']): ?>
<div id="search">
    <form name='UnifiedSearch' action='index.php' onsubmit='return SUGAR.unifiedSearchAdvanced.checkUsaAdvanced()'>
        <input type="hidden" name="action" value="UnifiedSearch">
        <input type="hidden" name="module" value="Home">
        <input type="hidden" name="search_form" value="false">
        <input type="hidden" name="advanced" value="false">
        <img id="unified_search_advanced_img" src="<?php echo smarty_function_sugar_getimagepath(array('file' => 'searchMore.gif'), $this);?>
" border="0" alt="<?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
">&nbsp;
        <input type="text" name="query_string" id="query_string" size="20" value="<?php echo $this->_tpl_vars['SEARCH']; ?>
">
        <input type="submit" class="button" value="<?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
">
    </form><br />
    <div id="unified_search_advanced_div"> </div>
</div>
<span id='sm_holder'></span>
<?php endif; ?>