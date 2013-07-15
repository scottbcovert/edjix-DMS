/**
 * actionCreateRecord.js
 * @author SalesAgility <support@salesagility.com>
 * Date: 25/04/13
 */
var cr_fields = new Array();
var cr_module = new Array();
var crln = new Array();

function show_crModuleFields(ln){

    clear_crLines(ln);
    cr_module[ln] = document.getElementById('aow_actions_param_record_type'+ln).value;

    if(cr_module[ln] != ''){

        var callback = {
            success: function(result) {

                cr_fields[ln] = result.responseText;

                //add_crLine(ln);
                document.getElementById('addcrline'+ln).style.display = '';

                //document.getElementById('aow_action_div'+ln).innerHTML ="<select tabindex='116' name='service_vat[]' id='service_vat'>" + cr_fields[ln] + "</select>";
            }
        }

        var connectionObject = YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleFields&aow_module="+cr_module[ln],callback);

    }

}

function show_crModuleField(ln, cln, value, type_value){
    if (typeof value === 'undefined') { value = ''; }
    if (typeof type_value === 'undefined') { type_value = ''; }

    var callback = {
        success: function(result) {
            document.getElementById('crLine'+ln+'_fieldType'+cln).innerHTML = result.responseText;
            SUGAR.util.evalScript(result.responseText);
            enableQS(false);
            document.getElementById('crLine'+ln+'_fieldType'+cln).onchange = function(){show_crModuleFieldType(ln, cln);};
        },
        failure: function(result) {
            document.getElementById('crLine'+ln+'_fieldType'+cln).innerHTML = '';
        }
    }
    var callback2 = {
        success: function(result) {
            document.getElementById('crLine'+ln+'_field'+cln).innerHTML = result.responseText;
            SUGAR.util.evalScript(result.responseText);
            enableQS(false);
        },
        failure: function(result) {
            document.getElementById('crLine'+ln+'_field'+cln).innerHTML = '';
        }
    }

    flow_module = document.getElementById('flow_module').value;
    var aow_field = document.getElementById('aow_actions_param'+ln+'_field'+cln).value;
    var aow_field_name = "aow_actions_param["+ln+"][value]["+cln+"]";
    var aow_field_type_name = "aow_actions_param["+ln+"][value_type]["+cln+"]";

    YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getFieldTypeOptions&aow_module="+cr_module[ln]+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_type_name+"&aow_value="+type_value,callback);
    YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleFieldTypeSet&aow_module="+cr_module[ln]+"&alt_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_name+"&aow_value="+value+"&aow_type="+type_value,callback2);

}

function show_crModuleFieldType(ln, cln, value){
    if (typeof value === 'undefined') { value = ''; }

    var callback = {
        success: function(result) {
            document.getElementById('crLine'+ln+'_field'+cln).innerHTML = result.responseText;
            SUGAR.util.evalScript(result.responseText);
            enableQS(false);
        },
        failure: function(result) {
            document.getElementById('crLine'+ln+'_field'+cln).innerHTML = '';
        }
    }

    flow_module = document.getElementById('flow_module').value;
    var aow_field = document.getElementById('aow_actions_param'+ln+'_field'+cln).value;
    var type_value = document.getElementById("aow_actions_param["+ln+"][value_type]["+cln+"]").value;
    var aow_field_name = "aow_actions_param["+ln+"][value]["+cln+"]";

    YAHOO.util.Connect.asyncRequest ("GET", "index.php?module=AOW_WorkFlow&action=getModuleFieldTypeSet&aow_module="+cr_module[ln]+"&alt_module="+flow_module+"&aow_fieldname="+aow_field+"&aow_newfieldname="+aow_field_name+"&aow_value="+value+"&aow_type="+type_value,callback);

}

function load_crline(ln, field, value, value_type){
    document.getElementById('addcrline'+ln).style.display = '';
    cln = add_crLine(ln);
    document.getElementById("aow_actions_param"+ln+"_field"+cln).value = field;
    show_crModuleField(ln, cln, value, value_type);
}

function add_crLine(ln){

    if(crln[ln] == null){crln[ln] = 0}

    /*if (document.getElementById(tableid + '_head') != null) {
        document.getElementById(tableid + '_head').style.display = "";
    }*/

    tablebody = document.createElement("tbody");
    tablebody.id = 'crLine'+ln+'_body' + crln[ln];
    document.getElementById('crLine'+ln+'_table').appendChild(tablebody);

    var x = tablebody.insertRow(-1);
    x.id = 'crLine'+ln+'_line' + crln[ln];

    var a = x.insertCell(0);
    a.innerHTML = "<button type='button' id='crLine"+ln+"_delete" + crln[ln]+"' class='button' value='Remove Line' tabindex='116' onclick='clear_crLine(" + ln + ",this);'><img src='themes/default/images/id-ff-remove-nobg.png' alt='Remove Line'></button>";

    var b = x.insertCell(1);
    b.innerHTML = "<select tabindex='116' name='aow_actions_param["+ln+"][field]["+crln[ln]+"]' id='aow_actions_param"+ln+"_field"+crln[ln]+"' onchange='show_crModuleField(" + ln + "," + crln[ln] + ");'>" + cr_fields[ln] + "</select>";

    var c = x.insertCell(2);
    c.id = 'crLine'+ln+'_fieldType' + crln[ln];

    var d = x.insertCell(3);
    d.id = 'crLine'+ln+'_field' + crln[ln];

    crln[ln]++;

    return crln[ln] -1;

}

function clear_crLine(ln, cln){

    document.getElementById('crLine'+ln+'_table').deleteRow(cln.parentNode.parentNode.rowIndex);
}

function clear_crLines(ln){

    var cr_rows = document.getElementById('crLine'+ln+'_table').getElementsByTagName('tr');
    var cr_row_length = cr_rows.length;
    var i;
    for (i=0; i < cr_row_length; i++) {
        document.getElementById('crLine'+ln+'_table').deleteRow(cr_rows[i]);
    }

    document.getElementById('addcrline'+ln).style.display = 'none';
}