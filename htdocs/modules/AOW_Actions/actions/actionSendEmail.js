
var currentln;

function show_edit_template_link(field, ln) {
    console.log("Show edit called");
    console.log('aow_actions_edit_template_link' + ln);
    var field1 = document.getElementById('aow_actions_edit_template_link' + ln);

    if (field.selectedIndex == 0) {
        field1.style.visibility = "hidden";
    } else {
        field1.style.visibility = "visible";
    }
}

function refresh_email_template_list(template_id, template_name) {
    refresh_template_list(template_id, template_name,currentln);
}

function refresh_template_list(template_id, template_name, ln) {
    var field = document.getElementById('aow_actions_param_email_template' + ln);
    var bfound = 0;
    for (var i = 0; i < field.options.length; i++) {
        if (field.options[i].value == template_id) {
            if (field.options[i].selected == false) {
                field.options[i].selected = true;
            }
            field.options[i].text = template_name;
            bfound = 1;
        }
    }
    //add item to selection list.
    if (bfound == 0) {
        var newElement = document.createElement('option');
        newElement.text = template_name;
        newElement.value = template_id;
        field.options.add(newElement);
        newElement.selected = true;
    }

    //enable the edit button.
    var field1 = document.getElementById('aow_actions_edit_template_link' + ln);
    field1.style.visibility = "visible";
}

function open_email_template_form(ln) {
    currentln = ln;
    URL = "index.php?module=EmailTemplates&action=EditView&inboundEmail=1&return_module=AOW_WorkFlow&base_module=AOW_WorkFlow";
    URL += "&show_js=1";

    windowName = 'email_template';
    windowFeatures = 'width=800' + ',height=600' + ',resizable=1,scrollbars=1';

    win = window.open(URL, windowName, windowFeatures);
    if (window.focus) {
        // put the focus on the popup if the browser supports the focus() method
        win.focus();
    }
}

function edit_email_template_form(ln) {
    currentln = ln;
    var field = document.getElementById('aow_actions_param_email_template' + ln);
    URL = "index.php?module=EmailTemplates&action=EditView&inboundEmail=1&return_module=AOW_WorkFlow&base_module=AOW_WorkFlow";
    if (field.options[field.selectedIndex].value != 'undefined') {
        URL += "&record=" + field.options[field.selectedIndex].value;
    }
    URL += "&show_js=1";

    windowName = 'email_template';
    windowFeatures = 'width=800' + ',height=600' + ',resizable=1,scrollbars=1';

    win = window.open(URL, windowName, windowFeatures);
    if (window.focus) {
        // put the focus on the popup if the browser supports the focus() method
        win.focus();
    }
}

function hideElem(id){
    document.getElementById(id).style.display = "none";
    document.getElementById(id).value = "";
}

function showElem(id){
    document.getElementById(id).style.display = "";
}

function targetTypeChanged(ln){
    var elem = document.getElementById("aow_actions_param_email_target_type"+ln);
    if(elem.value === 'Email Address'){
        showElem("aow_actions_param_email"+ln);
        hideElem("aow_actions_param_email_target"+ln);
        hideElem("aow_actions_email_user_span"+ln);
    }else if(elem.value === 'Specify User'){
        hideElem("aow_actions_param_email"+ln);
        hideElem("aow_actions_param_email_target"+ln);
        showElem("aow_actions_email_user_span"+ln);
    }else if(elem.value === 'Related Field'){
        hideElem("aow_actions_param_email"+ln);
        showElem("aow_actions_param_email_target"+ln);
        hideElem("aow_actions_email_user_span"+ln);
    }
}
