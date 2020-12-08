<?php
include 'header.php';
$bagColors = [];
$res = 0;
$instructions = [];
foreach($array as $line){    
    $exploded = explode(" ", $line);
    $exploded[1] = intval($exploded[1]); 
    $instructions[] = $exploded;
}
$run = true;
$accumulator = 0;
$position = 0;
$visited = [];
//Part 1;
while($run){

    if(in_array($position, $visited)){
        $run = false;
        print("Part 1: ".$accumulator."<br>");
    }
    $visited[] = $position;
    switch($instructions[$position][0]){
        case "nop":
            $position++;
            break;
        case "acc":
            $accumulator = $accumulator + $instructions[$position][1];
            $position++;
            break;
        case "jmp":
            $position = $position + $instructions[$position][1];
            break;
    }
    
}
$accumulator = 0;
$position = 0;
$visited = [];
$maxPosition = count($instructions);
$endless = false;
foreach($instructions as $key=>$instruction){
    if($instructions[$key][0] == "nop"){
        $instructions[$key][0] = "jmp";
    }elseif($instructions[$key][0] == "jmp"){
        $instructions[$key][0] = "nop";
    }else{
        continue;
    }
    while($position < $maxPosition){
        if(in_array($position, $visited)){
            $visited = [];
            $position = 0;
            $accumulator = 0;
            $endless = true;
            break;
        }
        $visited[] = $position;
        switch($instructions[$position][0]){
            case "nop":
                $position++;
                break;
            case "acc":
                $accumulator = $accumulator + $instructions[$position][1];
                $position++;
                break;
            case "jmp":
                $position = $position + $instructions[$position][1];
                break;
        }
    }
    if($endless){
        $endless = false;
        if($instructions[$key][0] == "nop"){
            $instructions[$key][0] = "jmp";
        }elseif($instructions[$key][0] == "jmp"){
            $instructions[$key][0] = "nop";
        }
        continue;
    }else{
        break;
    }
}
print("Part 2: ".$accumulator."<br>");
?>