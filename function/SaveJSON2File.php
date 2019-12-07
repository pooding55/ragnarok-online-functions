<?php
// Saves USERCONFIG, CHARCONFIG and other JSON data to a file
function SaveJSON2File ($base_dir, $WorldName, $AID, $json_data) {
	// create dir for game world
	if (!is_dir($base_dir .$WorldName)) {
		mkdir($base_dir .$WorldName, 0777, true);
	}


    // We must insert in JSON "Type": 1, for a successful request
    $json_data = substr($json_data,0,1).'"Type":1,'.substr($json_data,1,strlen($json_data));

	// create or rewrite file
	$file = $base_dir . $WorldName . '/' . $AID . '.txt';
    $fp = fopen($file, "wa+");
    fwrite($fp, $json_data);
    fclose($fp);
    
    if (file_exists($file)) {
    	return '{"Type":1}';
    } else {
    	return '{"Type":3}';
    }
}