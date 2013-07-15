
{if empty($fields.value.value)}
{assign var="value" value=$fields.value.default_value }
{else}
{assign var="value" value=$fields.value.value }
{/if}  




<textarea  id='{$fields.value.name}' name='{$fields.value.name}'
rows="2" 
cols="32" 
title='' tabindex="1" 
 >{$value}</textarea>


