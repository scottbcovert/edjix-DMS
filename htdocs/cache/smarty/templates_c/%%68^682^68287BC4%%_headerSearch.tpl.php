<?php /* Smarty version 2.6.11, created on 2013-07-09 13:29:44
         compiled from themes/SugarStrap/tpls/_headerSearch.tpl */ ?>
<?php if ($this->_tpl_vars['AUTHENTICATED']): ?>
<form name='UnifiedSearch' action='index.php' onsubmit='return SUGAR.unifiedSearchAdvanced.checkUsaAdvanced()' class="search pull-right">
    <input type="hidden" name="action" value="UnifiedSearch">
    <input type="hidden" name="module" value="Home">
    <input type="hidden" name="search_form" value="false">
    <input type="hidden" name="advanced" value="false">
    <input type="text" name="query_string" id="query_string" value="<?php echo $this->_tpl_vars['SEARCH']; ?>
" class="search-query">
    <input type="submit" class="btn" value="<?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
">
</form>
<div id="unified_search_advanced_div"></div>
<?php endif; ?>