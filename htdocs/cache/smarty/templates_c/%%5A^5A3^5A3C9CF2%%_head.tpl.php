<?php /* Smarty version 2.6.11, created on 2013-07-09 13:29:44
         compiled from themes/SugarStrap/tpls/_head.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getimagepath', 'themes/SugarStrap/tpls/_head.tpl', 61, false),array('function', 'sugar_getjspath', 'themes/SugarStrap/tpls/_head.tpl', 71, false),)), $this); ?>
<!DOCTYPE html>
<html <?php echo $this->_tpl_vars['langHeader']; ?>
>
<head>
	<meta charset="utf-8">
	<title><?php echo $this->_tpl_vars['APP']['LBL_BROWSER_TITLE']; ?>
</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<?php echo $this->_tpl_vars['SUGAR_CSS']; ?>

	<link rel="stylesheet" type="text/css" href="/themes/SugarStrap/css/bootstrap-responsive.css" />

	<!-- Le scripts -->
	<?php echo $this->_tpl_vars['SUGAR_JS']; ?>

	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
	<script src="/themes/SugarStrap/js/bootstrap.js"></script>

	<?php echo '
	<script type="text/javascript">
	<!--
	SUGAR.themes.theme_name      = \'';  echo $this->_tpl_vars['THEME'];  echo '\';
	SUGAR.themes.theme_ie6compat = ';  echo $this->_tpl_vars['THEME_IE6COMPAT'];  echo ';
	SUGAR.themes.hide_image      = \'';  echo smarty_function_sugar_getimagepath(array('file' => "hide.gif"), $this); echo '\';
	SUGAR.themes.show_image      = \'';  echo smarty_function_sugar_getimagepath(array('file' => "show.gif"), $this); echo '\';
	SUGAR.themes.loading_image      = \'';  echo smarty_function_sugar_getimagepath(array('file' => "img_loading.gif"), $this); echo '\';
	SUGAR.themes.allThemes       = eval(';  echo $this->_tpl_vars['allThemes'];  echo ');
	if ( YAHOO.env.ua )
	    UA = YAHOO.env.ua;
	-->
	</script>
	'; ?>

	
	<script type="text/javascript" src='<?php echo smarty_function_sugar_getjspath(array('file' => "cache/include/javascript/sugar_field_grp.js"), $this);?>
'></script>
</head>