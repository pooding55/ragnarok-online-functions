<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $cfg_function_path . 'CheckAuth.php';
require_once $cfg_function_path . 'GetJSONFile.php';

$base_dir = $cfg_charconfig_path . 'load/';

if (array_key_exists('AID', $_POST)) $AID = intval($_POST['AID']);
if (array_key_exists('AuthToken', $_POST)) $AuthToken = $_POST['AuthToken'];
if (array_key_exists('WorldName', $_POST)) $WorldName = $_POST['WorldName'];

if (in_array($WorldName, $cfg_world_list)) {
	if(CheckAuth($AID, null, $AuthToken)) {
		$response = GetJSONFile($base_dir, $WorldName, $AID);
	} else {
		$response = $cfg_err_response;
	}
}


echo $response;    