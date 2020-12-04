<?php
$day = substr(__FILE__, -5, 1);
$test = $_GET["test"];
$filename = $test ? "input".$day."-test.txt" : "input".$day.".txt";
$myfile = fopen($filename, "r") or die("Unable to open file!");
$array = explode("\n", fread($myfile, filesize($filename)));
$array[] = "";
fclose($myfile);
$arrlen = count($array);
$passport = [];
$res = 0;
$checkarr = ['byr'=>1,'iyr'=>1,'eyr'=>1,'hgt'=>1,'hcl'=>1,'ecl'=>1,'pid'=>1,'cid'=>0];
$eyeColors = ['amb'=>1,'blu'=>1,'brn'=>1,'gry'=>1,'grn'=>1,'hzl'=>1,'oth'=>1];
foreach($array as $line){ 
    if(!trim($line) == ""){
        $passport = array_merge($passport, preg_split('/ +/', $line));              
    }else{
        $res = $res + processPassport($passport);
        $passport = [];
    }
}
print($res);

function processPassport($passport){
    $numPresent = 0;
    global $checkarr;
    foreach($passport as $field){
        $keyVal = explode(":", $field);
        $numPresent = $numPresent + (checkValid($keyVal[0], $keyVal[1]) * $checkarr[$keyVal[0]]);
    }
    if($numPresent == 7){
        return 1;
    }else{
        return 0;
    }
    
}

function checkValid($type, $value){
    $res = 0;
    global $eyeColors;
    $value = trim($value);
    switch($type) {
        case "byr":
            if(intval($value)  >= 1920 && intval($value) <= 2002){
                $res = 1;
            }
            break;
        case "iyr":
            if(intval($value)  >= 2010 && intval($value) <= 2020){
                $res = 1;
            }
            break;
        case "eyr":
            if(intval($value)  >= 2020 && intval($value) <= 2030){
                $res = 1;
            }
            break;
        case "hgt":
            $height = intval(substr($value,0, -2));
            if(substr($value, -2) == "cm"){
                if($height >= 150 && $height <= 193){
                    $res = 1;
                }
            }elseif(substr($value, -2) == "in"){
                if($height >= 59 && $height <= 76){
                    $res = 1;
                }
            }
            break;
        case "hcl":   
            if(preg_match('/^#[a-f0-9]{6}$/i', $value)){
                $res = 1;
            }
            break;
        case "ecl":
            $res = $eyeColors[$value] ?? 0;
            break;
        case "pid":
            if(preg_match('/^[0-9]{9}$/', $value)){
                $res = 1;
            }
            break;   
        default:
            break; 
    }
    return $res;
}
?>