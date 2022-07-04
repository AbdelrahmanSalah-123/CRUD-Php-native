<?php
function required($value){
    if(empty($value)){
        return true;
    }
    return false;
}
function minVal($value,$len){
    $size=strlen($value);
    if($size<$len){
        return false;
    }
    return true;
}
function maxVal($value,$len){
    $size=strlen($value);
    if($size>$len){
        return false;
    }
    return true;
}
function emailVal($value){
    if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
        return false;
    }
    return true;
}

