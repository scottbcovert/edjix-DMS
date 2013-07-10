<?php /* Smarty version 2.6.11, created on 2013-07-09 06:26:01
         compiled from modules/Campaigns/Subscriptions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'sugar_getjspath', 'modules/Campaigns/Subscriptions.tpl', 39, false),array('function', 'sugar_action_menu', 'modules/Campaigns/Subscriptions.tpl', 62, false),array('function', 'sugar_help', 'modules/Campaigns/Subscriptions.tpl', 68, false),)), $this); ?>

<link rel="stylesheet" type="text/css" href="<?php echo smarty_function_sugar_getjspath(array('file' => 'modules/Connectors/tpls/tabs.css'), $this);?>
"/>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan='100'><h2><?php echo $this->_tpl_vars['title']; ?>
</h2></td></tr>
<tr><td colspan='100'>
<?php echo $this->_tpl_vars['description']; ?>

</td></tr><tr><td><br></td></tr><tr><td colspan='100'>

<form name="ConfigureSubs" method="POST"  method="POST" action="index.php">

    <form enctype="multipart/form-data" id="SubsForm" name="SubsForm" method="POST" action="index.php">
    <input type="hidden" name="module" value="Campaigns">
    <input type="hidden" name="action" value="Subscriptions">
    <input type="hidden" name="enabled_subs" value="">
    <input type="hidden" name="disabled_subs" value="">
    <input type="hidden" name="return_module" value="<?php echo $this->_tpl_vars['RETURN_MODULE']; ?>
">
    <input type="hidden" name="return_action" value="<?php echo $this->_tpl_vars['RETURN_ACTION']; ?>
">
    <input type="hidden" name="module_tab" value="<?php echo $_REQUEST['module_tab']; ?>
">
    <input type="hidden" name="orig_disabled_values" id="orig_disabled_values" value="<?php echo $this->_tpl_vars['disabled_subs_string']; ?>
">
    <input type="hidden" name="orig_enabled_values" id="orig_enabled_values" value="<?php echo $this->_tpl_vars['enabled_subs_string']; ?>
">
    <input type="hidden" name="record" value="<?php echo $this->_tpl_vars['RECORD']; ?>
">
    <input type="hidden" name="subs_action" value="process">

    <?php echo smarty_function_sugar_action_menu(array('buttons' => $this->_tpl_vars['BUTTONS']), $this);?>


    <div class='add_table' style='margin-bottom:5px'>
        <table id="ConfigureSubs" class="themeSettings edit view" style='margin-bottom:0px;' border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td><span><b><?php echo $this->_tpl_vars['MOD']['LBL_ALREADY_SUBSCRIBED_HEADER']; ?>
</b></span></td>
                <td><span><b><?php echo $this->_tpl_vars['MOD']['LBL_UNSUBSCRIBED_HEADER']; ?>
</b><?php echo smarty_function_sugar_help(array('text' => $this->_tpl_vars['MOD']['LBL_UNSUBSCRIBED_HEADER_EXPL']), $this);?>

                </span></td>
            </tr>
            <tr>
                <td width='1%'>
                    <div id="enabled_div" class="enabled_tab_workarea">
                        <ul id="enabled_ul" class="module_draglist">
                            <?php $_from = $this->_tpl_vars['enabled_subs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dirname'] => $this->_tpl_vars['name']):
?>
                            <li id="<?php echo $this->_tpl_vars['dirname']; ?>
" class="noBullet2"><?php echo $this->_tpl_vars['name']; ?>
</li>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </div>
                </td>
                <td>
                    <div id="disabled_div" class="disabled_tab_workarea">
                        <ul id="disabled_ul" class="module_draglist">
                            <?php $_from = $this->_tpl_vars['disabled_subs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['dirname'] => $this->_tpl_vars['name']):
?>
                            <li id="<?php echo $this->_tpl_vars['dirname']; ?>
" class="noBullet2"><?php echo $this->_tpl_vars['name']; ?>
</li>
                            <?php endforeach; endif; unset($_from); ?>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <?php echo smarty_function_sugar_action_menu(array('buttons' => $this->_tpl_vars['BUTTONS']), $this);?>

</form>


<script type="text/javascript">
<?php echo '

var Dom = YAHOO.util.Dom;
var Event = YAHOO.util.Event;
var DDM = YAHOO.util.DragDropMgr;

function save() {
    var enabled_display_vals = \'\';
    var disabled_display_vals = \'\';

    //Get the enabled div elements
    var elements = document.getElementById(\'enabled_div\');
    //Get the li elements
 	var enabled_list = YAHOO.util.Dom.getElementsByClassName(\'noBullet2\', \'li\', elements);
    for(var li in enabled_list) {
        if(typeof enabled_list[li] != \'function\') {
            enabled_display_vals += \',\' + enabled_list[li].getAttribute(\'id\');
        }
    }
    document.ConfigureSubs.enabled_subs.value = enabled_display_vals != \'\' ? enabled_display_vals.substr(1,enabled_display_vals.length) : \'\';

    var elements = document.getElementById(\'disabled_div\');
    //Get the li elements
    var disabled_list = YAHOO.util.Dom.getElementsByClassName(\'noBullet2\', \'li\', elements);
    for(var li in disabled_list) {
        if(typeof disabled_list[li] != \'function\') {
            disabled_display_vals += \',\' + disabled_list[li].getAttribute(\'id\');
        }
    }

    document.ConfigureSubs.disabled_subs.value = disabled_display_vals != \'\' ? disabled_display_vals.substr(1,disabled_display_vals.length) : \'\';
}


(function() {

YAHOO.example.DDApp = {
init: function() {
'; ?>

    new YAHOO.util.DDTarget("enabled_ul");
    new YAHOO.util.DDTarget("disabled_ul");

    <?php $_from = $this->_tpl_vars['enabled_subs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module'] => $this->_tpl_vars['moduleDisplay']):
?>
    <?php if ($this->_tpl_vars['module'] != $this->_tpl_vars['currentTheme']): ?>new YAHOO.example.DDList("<?php echo $this->_tpl_vars['module']; ?>
");<?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>

    <?php $_from = $this->_tpl_vars['disabled_subs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module'] => $this->_tpl_vars['moduleDisplay']):
?>
         new YAHOO.example.DDList("<?php echo $this->_tpl_vars['module']; ?>
");
    <?php endforeach; endif; unset($_from);  echo '
}
};

YAHOO.example.DDList = function(id, sGroup, config) {
    YAHOO.example.DDList.superclass.constructor.call(this, id, sGroup, config);
    var el = this.getDragEl();
    Dom.setStyle(el, "opacity", 0.67);
    this.goingUp = false;
    this.lastY = 0;
};


YAHOO.extend(YAHOO.example.DDList, YAHOO.util.DDProxy, {

    startDrag: function(x, y) {

        // make the proxy look like the source element
        var dragEl = this.getDragEl();
        var clickEl = this.getEl();
        Dom.setStyle(clickEl, "visibility", "hidden");

        dragEl.innerHTML = clickEl.innerHTML;

        Dom.setStyle(dragEl, "color", Dom.getStyle(clickEl, "color"));
        Dom.setStyle(dragEl, "backgroundColor", Dom.getStyle(clickEl, "backgroundColor"));
        Dom.setStyle(dragEl, "border", "2px solid gray");
    },

    endDrag: function(e) {

        var srcEl = this.getEl();
        var proxy = this.getDragEl();

        // Show the proxy element and animate it to the src element\'s location
        Dom.setStyle(proxy, "visibility", "");
        var a = new YAHOO.util.Motion(
            proxy, {
                points: {
                    to: Dom.getXY(srcEl)
                }
            },
            0.2,
            YAHOO.util.Easing.easeOut
        )
        var proxyid = proxy.id;
        var thisid = this.id;

        // Hide the proxy and show the source element when finished with the animation
        a.onComplete.subscribe(function() {
                Dom.setStyle(proxyid, "visibility", "hidden");
                Dom.setStyle(thisid, "visibility", "");
            });
        a.animate();
    },

    onDragDrop: function(e, id) {

        // If there is one drop interaction, the li was dropped either on the list,
        // or it was dropped on the current location of the source element.
        if (DDM.interactionInfo.drop.length === 1) {

            // The position of the cursor at the time of the drop (YAHOO.util.Point)
            var pt = DDM.interactionInfo.point;

            // The region occupied by the source element at the time of the drop
            var region = DDM.interactionInfo.sourceRegion;

            // Check to see if we are over the source element\'s location.  We will
            // append to the bottom of the list once we are sure it was a drop in
            // the negative space (the area of the list without any list items)
            if (!region.intersect(pt)) {
                var destEl = Dom.get(id);
                var destDD = DDM.getDDById(id);
                destEl.appendChild(this.getEl());
                destDD.isEmpty = false;
                DDM.refreshCache();
            }

        }
    },

    onDrag: function(e) {

        // Keep track of the direction of the drag for use during onDragOver
        var y = Event.getPageY(e);

        if (y < this.lastY) {
            this.goingUp = true;
        } else if (y > this.lastY) {
            this.goingUp = false;
        }

        this.lastY = y;
    },

    onDragOver: function(e, id) {

        var srcEl = this.getEl();
        var destEl = Dom.get(id);

        // We are only concerned with list items, we ignore the dragover
        // notifications for the list.
        if (destEl.nodeName.toLowerCase() == "li") {
            var orig_p = srcEl.parentNode;
            var p = destEl.parentNode;

            if (this.goingUp) {
                p.insertBefore(srcEl, destEl); // insert above
            } else {
                p.insertBefore(srcEl, destEl.nextSibling); // insert below
            }

            DDM.refreshCache();
        }
    }
});

Event.onDOMReady(YAHOO.example.DDApp.init, YAHOO.example.DDApp, true);

})();
'; ?>

</script>