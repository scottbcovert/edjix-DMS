<?php
/**
 * actionSendEmail.php
 * @author SalesAgility <support@salesagility.com>
 * Date: 17/04/13
 */

require_once('modules/AOW_Actions/actions/actionBase.php');
class actionSendEmail extends actionBase {

    private $emailableModules = array("Accounts","Contacts","Leads","Users");

    function actionSendEmail(){
        parent::actionBase();
    }
    function loadJS(){
        return array('modules/AOW_Actions/actions/actionSendEmail.js');
    }
    function edit_display($line,SugarBean $bean = null, $params = array()){
        global $mod_strings;
        $email_templates_arr = get_bean_select_array(true, 'EmailTemplate','name');

        $targetOptions = "";
        foreach($bean->get_related_fields() as $field){
            if(!in_array($field['module'],$this->emailableModules) || isset($field['dbType']) && $field['dbType'] == "id"){
                continue;
            }
            $selected = "";

            $targetOptions .= "<option $selected value='".$field['name']."'>".$field['module'].": ".trim(translate($field['vname'],$bean->module_name),":")."</option>";
        }

        $targetTypeOptions = "";
        $targetTypes = array('LBL_SPECIFY_EMAIL' => 'Email Address',
                            'LBL_SPECIFY_USER' => 'Specify User',
                            'LBL_SPECIFY_RELATED_FIELD' => 'Related Field');
        if(!array_key_exists('email_target_type',(array)$params)){
            $params['email_target_type'] = 'Email Address';
        }

        $emailTargetType = $params['email_target_type'];
        foreach($targetTypes as $displayKey => $value){
            $selected = $params['email_target_type'] == $value ? "selected='true'" : '';
            $targetTypeOptions .= "<option ".$selected." value='".$value."'>".$mod_strings[$displayKey]."</option>";
        }


        /*$recordTypeOptions = "";
        foreach($this->emailableModules as $module){
            $recordTypeOptions .= "<option value='".$module."'>".$mod_strings['LBL_'.$module]."</option>";
        }*/


        $html = "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
        $html .= "<tr>";
        $html .= '<td id="name_label" scope="row" valign="top" width="12.5%">Email:<span class="required">*</span></td>';
        $html .= '<td valign="top" width="37.5%">';

        $html .= "\n<select onchange='targetTypeChanged(".$line.")' id='aow_actions_param_email_target_type".$line."' name='aow_actions_param[".$line."][email_target_type]'>".$targetTypeOptions."</select>";


        //Related field inputs
        $hideRelated = $emailTargetType != "Related Field" ? "style='display: none;'" : '';
        $html .= "\n<select $hideRelated name='aow_actions_param[".$line."][email_target]' id='aow_actions_param_email_target".$line."' >".$targetOptions."</select>";


        //User Input
        $emailUserId = array_key_exists('email_user_id',$params) ? $params['email_user_id'] : '';
        $emailUserName = array_key_exists('email_user_name',$params) ? $params['email_user_name'] : '';

        $hideUser = $emailTargetType != "Specify User" ? "style='display: none;'" : '';
        $html .= <<<EOS

        <span $hideUser id="aow_actions_email_user_span$line">
<input type="text"
        name="aow_actions_param[$line][email_user_name]" class="sqsEnabled" tabindex="1"
        id="aow_actions_param[$line][email_user_name]" size="" value="$emailUserName" title='' autocomplete="off"  	 >
<input type="hidden" name="aow_actions_param[$line][email_user_id]"
	id="aow_actions_param[$line][email_user_id]"
	value="$emailUserId">
<span class="id-ff multiple">
<button type="button"
    name="btn_aow_actions_param[$line][email_user_name]"
    id="btn_aow_actions_param[$line][email_user_name]" tabindex="1"
    title="Select User" class="button firstChild" value="Select User"
onclick="open_popup(
    'Users',
	600,
	400,
	'',
	true,
	false,
	{'call_back_function':'set_return',
	    'form_name':'EditView',
	    'field_to_name_array':{
	                'id':'aow_actions_param[$line][email_user_id]',
	                'user_name':'aow_actions_param[$line][email_user_name]'}},
	'single',
	true
);" ><img src="themes/default/images/id-ff-select.png?v=lSCqV0_gGHDPkVH62imIiQ"></button>
<button type="button"
    name="btn_clr_aow_actions_param[$line][email_user_name]"
    id="btn_clr_aow_actions_param[$line][email_user_name]" tabindex="1" title="Clear User"  class="button lastChild"
onclick="SUGAR.clearRelateField(this.form, 'aow_actions_param[$line][email_user_name]', 'aow_actions_param[$line][email_user_id]');"  value="Clear User" ><img src="themes/default/images/id-ff-clear.png?v=lSCqV0_gGHDPkVH62imIiQ"></button>
</span>
<script type="text/javascript">
SUGAR.util.doWhen(
		"typeof(sqs_objects) != 'undefined' && typeof(sqs_objects['EditView_aow_actions_param[$line]['email_user_name']']) != 'undefined'",
		enableQS
);
</script>
</span>

EOS;

        if(!isset($params['email'])) $params['email'] = '';
        if(!isset($params['email_template'])) $params['email_template'] = '';

        $hidden = "style='visibility: hidden;'";
        if($params['email_template'] != '') $hidden = "";

        //Email input
        $hideEmail = $emailTargetType != "Email Address" ? "style='display: none;'" : '';
        $html .= '<input '.$hideEmail.' name="aow_actions_param['.$line.'][email]" id="aow_actions_param_email'.$line.'" size="30" maxlength="255" value="'.$params['email'].'" type="text">';

        $html .= '</td>';

        $html .= '<td id="name_label" scope="row" valign="top" width="12.5%">Email Template:<span class="required">*</span></td>';
        $html .= "<td valign='top' width='37.5%'>";
        $html .= "<select name='aow_actions_param[".$line."][email_template]' id='aow_actions_param_email_template".$line."' onchange='show_edit_template_link(this,".$line.");' >".get_select_options_with_id($email_templates_arr, $params['email_template'])."</select>";

        $html .= "&nbsp;<a href='javascript:open_email_template_form(".$line.")' >{$mod_strings['LBL_CREATE_EMAIL_TEMPLATE']}</a>";
        $html .= "&nbsp;<span name='edit_template' id='aow_actions_edit_template_link".$line."' $hidden><A href='javascript:edit_email_template_form(".$line.")' >{$mod_strings['LBL_EDIT_EMAIL_TEMPLATE']}</A></span>";
        $html .= "</td>";
        $html .= "</tr>";
        $html .= "</table>";

        return $html;

    }

    private function getEmailFromParams(SugarBean $bean, $params){
        if(!array_key_exists('email_target_type',$params)){
            return '';
        }

        switch($params['email_target_type']){
            case 'Email Address':
                return array_key_exists('email', $params) ? $params['email'] : '';
            case 'Specify User':
                $user = new User();
                $user->retrieve($params['email_user_id']);
                return $user->emailAddress->getPrimaryAddress($user);
                break;
            case 'Related Field':
                $emailTarget = $params['email_target'];
                $relatedFields = $bean->get_related_fields();
                $field = $relatedFields[$emailTarget];
                $linkedBeans = $bean->get_linked_beans($field['link'],$field['module']);
                if($linkedBeans){
                    $linkedBean = $linkedBeans[0];
                    return $linkedBean->emailAddress->getPrimaryAddress($linkedBean);
                }
                break;
            default:
                return '';
        }
        return "";
    }

    function run_action(SugarBean $bean, $params = array()){
        global $sugar_config;

        include_once('modules/EmailTemplates/EmailTemplate.php');
        $emailTemp = new EmailTemplate();
        $emailTemp->retrieve($params['email_template']);

        $object_arr[$bean->module_dir] = $bean->id;

        $parsedSiteUrl = parse_url($sugar_config['site_url']);
        $host = $parsedSiteUrl['host'];
        if(!isset($parsedSiteUrl['port'])) {
            $parsedSiteUrl['port'] = 80;
        }

        $port		= ($parsedSiteUrl['port'] != 80) ? ":".$parsedSiteUrl['port'] : '';
        $path		= !empty($parsedSiteUrl['path']) ? $parsedSiteUrl['path'] : "";
        $cleanUrl	= "{$parsedSiteUrl['scheme']}://{$host}{$port}{$path}";

        $url =  $cleanUrl."/index.php?module={$bean->module_dir}&action=DetailView&record={$bean->id}";

        $subject = $emailTemp->parse_template($emailTemp->subject, $object_arr);
        $body_html = $emailTemp->parse_template($emailTemp->body_html, $object_arr);
        $body_html = str_replace("\$url",$url,$body_html);
        $body_plain = $emailTemp->parse_template($emailTemp->body, $object_arr);
        $body_plain = str_replace("\$url",$url,$body_plain);
        $email = $this->getEmailFromParams($bean,$params);
        return $this->sendEmail($email, $subject, $body_html, $body_plain, $bean);

    }

    function sendEmail($emailTo, $emailSubject, $emailBody, $altemailBody, SugarBean $relatedBean = null, $attachments = array())
    {
        require_once('modules/Emails/Email.php');
        require_once('include/SugarPHPMailer.php');

        $emailObj = new Email();
        $defaults = $emailObj->getSystemDefaultEmail();
        $mail = new SugarPHPMailer();
        $mail->setMailerForSystem();
        $mail->From = $defaults['email'];
        $mail->FromName = $defaults['name'];
        $mail->ClearAllRecipients();
        $mail->ClearReplyTos();
        $mail->Subject=from_html($emailSubject);
        $mail->Body=$emailBody;
        $mail->AltBody = $altemailBody;
        $mail->handleAttachments($attachments);
        $mail->prepForOutbound();
        $mail->AddAddress($emailTo);

        //now create email
        if (@$mail->Send()) {
            $emailObj->to_addrs= $emailTo;
            $emailObj->type= 'archived';
            $emailObj->deleted = '0';
            $emailObj->name = $mail->Subject;
            $emailObj->description = $mail->AltBody;
            $emailObj->description_html = $mail->Body;
            $emailObj->from_addr = $mail->From;
            if ( $relatedBean instanceOf SugarBean && !empty($relatedBean->id) ) {
                $emailObj->parent_type = $relatedBean->module_dir;
                $emailObj->parent_id = $relatedBean->id;
            }
            $emailObj->date_sent = TimeDate::getInstance()->nowDb();
            $emailObj->modified_user_id = '1';
            $emailObj->created_by = '1';
            $emailObj->status = 'sent';
            $emailObj->save();

            return true;
        }
        return false;
    }

}