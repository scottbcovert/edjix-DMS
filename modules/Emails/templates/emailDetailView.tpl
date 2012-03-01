<!--
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2012 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

/*********************************************************************************

 ********************************************************************************/
-->
<!-- BEGIN: main -->
{$emailTitle}

<P/>

<script type="text/javascript" src="{sugar_getjspath file="modules/Emails/javascript/Email.js"}"></script>
<script type="text/javascript" language="Javascript">
{$JS_VARS}
</script>
<form action="index.php" method="POST" name="DetailView" id="emailDetailView">
    <input type="hidden" name="inbound_email_id" value="{$ID}">
    <input type="hidden" name="type" value="out">
    <input type="hidden" name="email_name" value="{$EMAIL_NAME}">
    <input type="hidden" name="to_email_addrs" value="{$FROM}">
    <input type="hidden" name="module" value="Emails">
    <input type="hidden" name="record" value="{$ID}">
    <input type="hidden" name="isDuplicate" value=false>
    <input type="hidden" name="action">
    <input type="hidden" name="contact_id" value="{$CONTACT_ID}">
    <input type="hidden" name="user_id" value="{$USER_ID}">
    <input type="hidden" name="return_module">
    <input type="hidden" name="return_action">
    <input type="hidden" name="return_id">
    <input type="hidden" name="assigned_user_id">
    <input type="hidden" name="parent_id" value="{$PARENT_ID}">
    <input type="hidden" name="parent_type" value="{$PARENT_TYPE}">
    <input type="hidden" name="parent_name" value="{$PARENT_NAME}">
</form>

<table width="100%" border="0" cellspacing="{$GRIDLINE}" cellpadding="0" class="detail view">
	<tr>
		<td width="15%" valign="top" scope="row"><slot>{$APP.LBL_ASSIGNED_TO}</slot></td>
		<td width="35%" valign="top"><slot>{$ASSIGNED_TO}</slot></td>
		<td width="15%" scope="row"><slot>{$MOD.LBL_DATE_SENT}</slot></td>
		<td width="35%" colspan="3"><slot>{$DATE_START} {$TIME_START}</slot></td>
	</tr>
	<tr>
		<td scope="row"><slot>&nbsp;</slot></td>
		<td><slot>&nbsp;</slot></td>
		<td scope="row"><slot>{$PARENT_TYPE}</slot></td>
		<td><slot>{$PARENT_NAME}</slot></td>
	</tr>
	<tr>
		<td scope="row"><slot>{$MOD.LBL_FROM}</slot></td>
		<td colspan=3><slot>{$FROM}</slot></td>
	</tr>
	<tr>
		<td scope="row"><slot>{$MOD.LBL_TO}</slot></td>
		<td colspan='3'><slot>{$TO}</slot></td>
	</tr>
	<tr>
		<td scope="row"><slot>{$MOD.LBL_CC}</slot></td>
		<td colspan='3'><slot>{$CC}</slot></td>
	</tr>
	<tr>
		<td scope="row"><slot>{$MOD.LBL_BCC}</slot></td>
		<td colspan='3'><slot>{$BCC}</slot></td>
	</tr>
	<tr>
		<td scope="row"><slot>{$MOD.LBL_SUBJECT}</slot></td>
		<td colspan='3'><slot>{$NAME}</slot></td>
	</tr>
	<tr>
		<td valign="top" valign="top" scope="row"><slot>{$MOD.LBL_BODY}</slot></td>
		<td colspan="3"  style="background-color: #ffffff; color: #000000" ><slot>
			<div id="html_div" style="background-color: #ffffff;padding: 5px">{$DESCRIPTION_HTML}</div>
			<input id='toggle_textarea_elem' onclick="toggle_textarea();" type="checkbox" name="toggle_html"/> <label for='toggle_textarea_elem'>{$MOD.LBL_SHOW_ALT_TEXT}</label><br>
			<div id="text_div" style="display: none;background-color: #ffffff;padding: 5px">{$DESCRIPTION}</div>
			<script type="text/javascript" language="Javascript">
				var plainOnly = {$SHOW_PLAINTEXT};
				{literal}
				if(plainOnly == true) {
					document.getElementById("toggle_textarea_elem").checked = true;
					toggle_textarea();
				}
				{/literal}
			</script>
		</td>
	</tr>
	<tr>
		<td valign="top" scope="row"><slot>{$MOD.LBL_ATTACHMENTS}</td>
		<td colspan="3"><slot>{$ATTACHMENTS}</slot></td>
	</tr>
</table>

{$SUBPANEL}
<!-- END: main -->
