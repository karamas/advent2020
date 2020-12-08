<?php
include 'header.php';
$group = "";
$res = 0;
$array[] = "";
$memCount = 0;
foreach($array as $line){    
    if(!trim($line) == ""){
        $memCount++;
        $group = $group.trim($line);              
    }else{
        $countArray = array_count_values(count_chars($group, 1));
        $res = $res + (array_key_exists($memCount, $countArray) ? $countArray[$memCount] : 0);       
        $group = "";
        $memCount = 0;
    }
}
print($res);
?>