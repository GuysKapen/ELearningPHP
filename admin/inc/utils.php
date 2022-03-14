<?php 

function unique_file_name($ext) {
	$file_name = date("Y-m-d") . '-' . uniqid() . '.' . $ext;
    return $file_name;
}

?>  