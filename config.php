<?php
//////////////////////////////////////////////////////////////////////////////
// All configuration variables have the "cfg_" prefix for code readability  //
//////////////////////////////////////////////////////////////////////////////

// DB configs
$cfg_db_ip = '';
$cfg_db_name = '';
$cfg_db_user = '';
$cfg_db_pass = '';

// Game configs
$cfg_world_list = array('testworld', 'worldtest'); // Required for data verification - if(in_array($_POST['WorldName'], $cfg_world_list))
$cfg_err_response = '{"Type":3}';


// Path configs
$cfg_function_path = $_SERVER['DOCUMENT_ROOT'] . '/function/';
$cfg_emblem_path = $_SERVER['DOCUMENT_ROOT'] . '/emblem/';
$cfg_userconfig_path = $_SERVER['DOCUMENT_ROOT'] . '/userconfig/';
$cfg_charconfig_path = $_SERVER['DOCUMENT_ROOT'] . '/charconfig/';

