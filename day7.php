<?php
include 'header.php';
$bagColors = [];
$res = 0;
foreach($array as $line){    
    $cLine = str_replace(".", "", $line);
    $rules = explode("contain", $cLine);
    $rules[0] = substr(trim($rules[0]), 0, -1);
    $rulesFor = explode(",", $rules[1]);
    $containsGold = 0;
    $finishedRules = [];
    foreach($rulesFor as $rule){
        $rule = trim($rule);
        $numRule = explode(" ", $rule, 2);
        if(intval($numRule[0]) > 1){
            $numRule[1] = substr($numRule[1], 0, -1);
        }
        if($numRule[0] == "no"){
            $finishedRules[] = [0,"no other bags"];
        }elseif($numRule[1] == "shiny gold bag"){
            $containsGold = 1;
            $finishedRules[] = $numRule;
        }else{
            $finishedRules[] = $numRule;
        }
    }
    $bagColors[$rules[0]] = [$containsGold,$finishedRules];
}
foreach($bagColors as $key=>$bag){
    $res = $res + checkBag($bag);
}

print(addBags("shiny gold bag"));
print("<br>");
print($res);

function addBags($bagColor){
    global $bagColors;
    $sum = 0;
    foreach($bagColors[$bagColor][1] as $bags){
        if($bags[1] != "no other bags"){
            $sum = $sum + $bags[0] + ($bags[0] * addBags($bags[1]));           
        }else{
            return 0;
        }
    }
    return $sum;
}

function checkBag($bag){
    global $bagColors;
    if($bag[0] == 1){
        return 1;
    }
    if($bag[1] == "no other bags"){
        return 0;
    }
    foreach($bag[1] as $innerBag){
        if($innerBag[1] == "no other bags"){
            return 0;
        }
        if(checkBag($bagColors[$innerBag[1]])==1){
            $bag[0] = 1;
            return 1;
        }
    }
    return 0;
}
?>