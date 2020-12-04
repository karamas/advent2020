<?php
$day = 3;
$test = false;
//$test = true;
if($test){
    $filename = "input".$day."-test.txt";
}else{
    $filename = "input".$day.".txt";
}
$myfile = fopen($filename, "r") or die("Unable to open file!");
$array = explode("\n", fread($myfile, filesize($filename)));
fclose($myfile);
$arrlen = count($array);
$trees = 0;
$mapArr;

foreach($array as $index => $item){
    $mapArr[$index] = str_split($item);
}
$steps = $arrlen-1;
$mapRep = count($mapArr[$index]);
$start = microtime(true);
$treesArr = [0,0,0,0,0];
$treesArr[0] = runSlope(1,1);
$treesArr[1] = runSlope(3,1);
$treesArr[2] = runSlope(5,1);
$treesArr[3] = runSlope(7,1);
$treesArr[4] = runSlope(1,2);
$res = 1;
print_r($treesArr);
foreach($treesArr as $num){
    $res = $res * $num;
}

print $res."<br>";
print(microtime(true) - $start);

function runSlope($right, $down){
    global $mapRep, $mapArr, $steps;
    $stepsF = $steps;
    if($down > 1){
        $stepsF = $steps / $down;
    }
    $trees = 0;
    $curpos = [0,0];
    for($i = 0; $i < $stepsF; $i++){
        $curpos[0] = $curpos[0] + $right;
        if($curpos[0] >= $mapRep){
            $curpos[0] = $curpos[0] - $mapRep;
        }
        $curpos[1] = $curpos[1] + $down;
        if($mapArr[$curpos[1]][$curpos[0]] == "#"){
            $trees++;
        }
    }
    return $trees;
}
?>