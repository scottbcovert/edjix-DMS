<?php /* Smarty version 2.6.11, created on 2013-07-09 13:29:44
         compiled from themes/SugarStrap/tpls/header.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "themes/SugarStrap/tpls/_head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body onMouseOut="closeMenus();">
<a name="top"></a>
<?php echo $this->_tpl_vars['SUGAR_DCJS']; ?>

<div class="container">
    <header>
        <div class="row">
            <div class="span6">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "themes/SugarStrap/tpls/_companyLogo.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            <div class="span6 hidden-phone">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "themes/SugarStrap/tpls/_headerSearch.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
        </div>
        <div class="row">
            <div class="span12">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "themes/SugarStrap/tpls/_headerModuleList.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
        </div>
    </header>

    <?php echo '
    <iframe id=\'ajaxUI-history-iframe\' src=\'index.php?entryPoint=getImage&imageName=blank.png\'  title=\'empty\' style=\'display:none\'></iframe>
    <input id=\'ajaxUI-history-field\' type=\'hidden\'>
    <script type=\'text/javascript\'>
    if (SUGAR.ajaxUI && !SUGAR.ajaxUI.hist_loaded)
    {
        YAHOO.util.History.register(\'ajaxUILoc\', "", SUGAR.ajaxUI.go);
        ';  if ($_REQUEST['module'] != 'ModuleBuilder'): ?>        YAHOO.util.History.initialize("ajaxUI-history-field", "ajaxUI-history-iframe");
        <?php endif;  echo '
    }
    </script>
    '; ?>


    <section id="main" role="main">
        <div class="row">
            <div class="span12">
                <div id="content">