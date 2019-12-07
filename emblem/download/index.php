<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

if (array_key_exists('WorldName', $_POST)) $WorldName = $_POST['WorldName'];
if (array_key_exists('GDID', $_POST)) $GDID = intval($_POST['GDID']);
if (array_key_exists('Version', $_POST)) $Version = intval($_POST['Version']);

if (in_array($WorldName, $cfg_world_list)) {
	$emblemname = $cfg_emblem_path . 'download/' . $WorldName . '/' . $GDID . '.BMP';
	$version_file = $cfg_emblem_path . 'download/' . $WorldName . '/' . $GDID . '.txt';
	if (!file_exists($emblemname)) {
		$emblemname = $cfg_emblem_path . 'download/' . $WorldName . '/' . $GDID . '.GIF';
	}

	if (file_exists($emblemname)) {
		header('Content-Type: application/octet-stream');
		if (file_exists($version_file)) {
		    $f_version = file_get_contents($version_file);
		    if ($Version < $f_version) {
				readfile($emblemname);
			} else {
				// Should respond with "use existing", but kRO doesn't support that correctly yet?
				readfile($emblemname);
			}
		}
		exit; 
	}
} else {
	http_response_code(500);
	header('Content-Type: text/plain');
	echo '{"Type":4}';
	exit;
}
exit;

