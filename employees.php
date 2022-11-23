<?php
require_once('functions.php');
$filename = readline('enter filename:');
$filecontent = get_file_content($filename);
if ($filecontent) {
    $results = process($filecontent);
    print_result($results);
} else echo 'error: missing filename ' . $filename;
?>