<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $cfg_function_path . 'CheckAuth.php';
require_once $cfg_function_path . 'SaveJSON2File.php';

$base_dir = $cfg_userconfig_path . 'load/';

$response = $cfg_err_response;

if (array_key_exists('AID', $_POST)) $AID = intval($_POST['AID']);
if (array_key_exists('AuthToken', $_POST)) $AuthToken = $_POST['AuthToken'];
if (array_key_exists('WorldName', $_POST)) $WorldName = $_POST['WorldName'];

if (array_key_exists('data', $_POST)) {
	if (in_array($WorldName, $cfg_world_list)) {
		$json_data = $_POST['data'];
		if(CheckAuth($AID, null, $AuthToken)) {
			$response = SaveJSON2File($base_dir, $WorldName, $AID, $json_data);
		}
	}
}

echo $response; 


