<?php
/**
 * actions.php
 * @author SalesAgility <support@salesagility.com>
 * Date: 16/04/13
 */

    $aow_actions_list[]='CreateRecord';
    $aow_actions_list[]='ModifyRecord';
    $aow_actions_list[]='SendEmail';


if (file_exists('custom/modules/AOW_Actions/actions.php')) {
    require('custom/modules/AOW_Actions/actions.php');
}
