<?php /* Smarty version 2.6.11, created on 2013-07-14 23:20:25
         compiled from cache/modules/AOW_WorkFlow/BugsEditViewid.tpl */ ?>

<?php if (strlen ( $this->_tpl_vars['fields']['id']['value'] ) <= 0):  $this->assign('value', $this->_tpl_vars['fields']['id']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['id']['value']);  endif; ?>  
<input type='text' name='<?php echo $this->_tpl_vars['fields']['id']['name']; ?>
' 
    id='<?php echo $this->_tpl_vars['fields']['id']['name']; ?>
' size='30' 
     
    value='<?php echo $this->_tpl_vars['value']; ?>
' title=''  tabindex='1'      >