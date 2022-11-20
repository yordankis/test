<?php
require_once('functions.php');
$filename = readline('enter filename:');
$filecontent = get_file_content($filename);
if ($filecontent) {
    process($filecontent);
}
?>