<?php

$file = "index.html";
$time = 60 * 10 - (time() - filemtime($file));

if ($time > 0) {
    die("Data was already updated in the 10 minutes. Please wait another " . ($time) . " seconds.");
}

ob_start();
require "index_fresh.php";
$data = ob_get_contents();

$fp = fopen($file, "w");
fwrite($fp, $data);
fclose($fp);

header("Location: /");
