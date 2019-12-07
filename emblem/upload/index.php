<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once $cfg_function_path . 'CheckAuth.php';

$base_dir = $cfg_emblem_path . 'download/';
$response = $cfg_err_response;


if (array_key_exists('AID', $_POST)) $AID = intval($_POST['AID']);
if (array_key_exists('AuthToken', $_POST)) $AuthToken = $_POST['AuthToken'];
if (array_key_exists('WorldName', $_POST)) $WorldName = $_POST['WorldName'];
if (array_key_exists('GDID', $_POST)) $GDID = intval($_POST['GDID']);
if (array_key_exists('ImgType', $_POST)) $ImgType = $_POST['ImgType'];

if (array_key_exists('Img', $_FILES)) {
	if(filesize($_FILES['Img']['tmp_name']) < 50*1024) {
		if (in_array($WorldName, $cfg_world_list)) {
			if(CheckAuth($AID, $GDID, $AuthToken)) {
				$file_patch = $base_dir . $WorldName . '/';
				$emblem_version = SaveEmblem($WorldName, $GDID, $base_dir, $file_patch, $ImgType);
				$response = '{"Type":1,"version": ' . $emblem_version . '}';
			}
		}
	} 

}

echo $response; 

// Creates an image and gives its version
function SaveEmblem($WorldName, $GDID, $base_dir, $file_patch, $ImgType) {
	if (!is_dir($base_dir . $WorldName)) {
		mkdir($base_dir . $WorldName, 0777, true);
	}

	// Emblem version file
	$file = $file_patch . $GDID . '.txt';
	if (!file_exists($file)) {
	    $fp = fopen($file, "w");
	    fwrite($fp, '0');
	    fclose($fp);
	    $version = 0;
	} else {
		$prev_version = file_get_contents($file);
		$version = (int)$prev_version + 1;
		file_put_contents($file, $version);
	}

	if ($ImgType == 'GIF' && file_exists($file_patch . $GDID . '.BMP')) {
		unlink($file_patch . $GDID . '.BMP');
	} elseif ($ImgType == 'BMP' && file_exists($file_patch . $GDID . '.GIF')) {
		unlink($file_patch . $GDID . '.GIF');
	}

	move_uploaded_file($_FILES['Img']['tmp_name'], $file_patch . $GDID . '.' . $ImgType);
	return $version;
}

