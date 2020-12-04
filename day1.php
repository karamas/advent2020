<?php
$day = 1;
$filename = "input".$day.".txt";
$myfile = fopen($filename, "r") or die("Unable to open file!");
$array = array_map('intval', explode("\n", fread($myfile, filesize($filename))));
fclose($myfile);
asort($array);
$arrlen = count($array);
$numloops = 0;
$start = microtime(true);
foreach($array as $index => $key){
    for($i = $index; $i<$arrlen; $i++){
        $numloops++;
        if($key + $array[$i] < 2020){
            //$time_elapsed_secs = microtime(true) - $start;
            //print($time_elapsed_secs."<br>");
            for($j = $i; $j < $arrlen; $j++){
                if($key + $array[$i] + $array[$j] == 2020){
                    //print($key * $array[$i] * $array[$j]);
                    $time_elapsed_secs = microtime(true) - $start;
                    print($time_elapsed_secs);
                }
            }
        }
    }
}
?>