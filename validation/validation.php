<?php



function minlen($input,$len){
    if(strlen($input)<$len){
        return false;
    }
    return true;
}

function maxlen($input,$len){
    if(strlen($input)>$len){
        return false;
    }
    return true;
}


function checkemail($input){
    if(filter_var($input,FILTER_VALIDATE_EMAIL)){
        return false;
    }
    return true; 
    
}