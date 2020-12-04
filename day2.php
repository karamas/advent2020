<?php
$day = 2;
$test = false;
if($test){
    $filename = "input".$day."-test.txt";
}else{
    $filename = "input".$day.".txt";
}
$myfile = fopen($filename, "r") or die("Unable to open file!");
$array = explode("\n", fread($myfile, filesize($filename)));
fclose($myfile);
$arrlen = count($array);
$valid = 0;
$start = microtime(true);
foreach($array as $index => $item){
    $polItem = explode(": ", $item);
    $pol = explode(" ", $polItem[0]);
    $range = explode("-", $pol[0]);
    $itemArr = str_split($polItem[1]);
    //print($itemArr[$range[0]-1] ."::". $itemArr[$range[1]-1]."<br>");
    if($itemArr[$range[0]-1] == $pol[1] xor $itemArr[$range[1]-1] == $pol[1]){
        $valid++;
    }
}
print $valid;
?>