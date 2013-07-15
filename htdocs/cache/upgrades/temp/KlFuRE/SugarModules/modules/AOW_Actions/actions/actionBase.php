<?php
/**
 * actionBase.php
 * @author SalesAgility <support@salesagility.com>
 * Date: 17/04/13
 */

class actionBase {


    function actionBase(){

    }

    function loadJS(){

        return array();
    }

    function edit_display($line,SugarBean $bean = null, $params = array()){

        return '';

    }

    function run_action(SugarBean $bean, $params = array()){

        return true;

    }

}