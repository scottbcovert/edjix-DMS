<?php /* Smarty version 2.6.11, created on 2013-07-14 23:20:10
         compiled from cache/modules/AOW_WorkFlow/AdministrationEditViewvalue.tpl */ ?>

<?php if (empty ( $this->_tpl_vars['fields']['value']['value'] )):  $this->assign('value', $this->_tpl_vars['fields']['value']['default_value']);  else:  $this->assign('value', $this->_tpl_vars['fields']['value']['value']);  endif; ?>  




<textarea  id='<?php echo $this->_tpl_vars['fields']['value']['name']; ?>
' name='<?php echo $this->_tpl_vars['fields']['value']['name']; ?>
'
rows="2" 
cols="32" 
title='' tabindex="1" 
 ><?php echo $this->_tpl_vars['value']; ?>
</textarea>

