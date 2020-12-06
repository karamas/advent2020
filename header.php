<?php
$day = substr($_SERVER["SCRIPT_NAME"], -5, 1);
$test = $_GET["test"];
$filename = $test ? "input".$day."-test.txt" : "input".$day.".txt";
$myfile = fopen($filename, "r") or die("Unable to open file!");
$array = explode("\n", fread($myfile, filesize($filename)));
fclose($myfile);
$arrlen = count($array);
?>