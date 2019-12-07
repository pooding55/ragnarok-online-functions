<?php
// Return USERCONFIG, CHARCONFIG and other JSON data from a file
function GetJSONFile($base_dir, $WorldName, $AID)
{
	// get file content
	$file = $base_dir . $WorldName . '/' . $AID . '.txt';
	$content = '{"Type":1}';
	if (file_exists($file)) {
		$content = file_get_contents($file);
	}
    return $content;
}

