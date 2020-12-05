<?php
$day = substr(__FILE__, -5, 1);
$test = $_GET["test"];
$filename = $test ? "input".$day."-test.txt" : "input".$day.".txt";
$myfile = fopen($filename, "r") or die("Unable to open file!");
$array = explode("\n", fread($myfile, filesize($filename)));
fclose($myfile);
$arrlen = count($array);

$seatId = [];
foreach($array as $pass){
    $maxRow = 127;
    $minRow = 0;
    $maxCol = 7;
    $minCol = 0;
    $binary = str_split($pass, 7);
    //print_r($binary);
    foreach(str_split($binary[0],1) as $decision){
        if($decision == "F"){
            $maxRow = $maxRow - intval(($maxRow -$minRow)/  2) - 1;
            //print($minRow . " : ". $maxRow ."<br>");
        }
        if($decision == "B"){
            $minRow = intval(($maxRow -$minRow) / 2) + $minRow + 1;
            //print($minRow . " : ". $maxRow ."<br>");
        }
    }
    $row = $minRow;
    foreach(str_split($binary[1],1) as $decision){
        if($decision == "L"){
            $maxCol = $maxCol - intval(($maxCol -$minCol)/  2) - 1;
            //print($minCol . " : ". $maxCol ."<br>");
        }
        if($decision == "R"){
            $minCol = intval(($maxCol -$minCol) / 2) + $minCol + 1;
            //print($minCol . " : ". $maxCol ."<br>");
        }
    }
    $col = $minCol;
    $seatId[] = $row*8+$col;
    
}
rsort($seatId);
for($i = 1; $i < count($seatId);$i++){
    if($seatId[$i] - $seatId[$i-1] == -2){
        print($seatId[$i] +1);
    }
}
//print($seatId[0]);

?>