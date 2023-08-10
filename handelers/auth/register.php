<?php
session_start();
$errors=[];
if(isset($_POST["submit"])&&$_SERVER['REQUEST_METHOD']=="POST"){
    //get data
    $email=trim(htmlspecialchars($_POST['email']));

    $passward=trim(htmlspecialchars($_POST['passward']));
    
    

include "../../validation/validation.php";  
if(empty($passward)){
    $errors[]="type passward";
}elseif(!minlen($passward,6)){
    $errors[]="passward >6";

}
elseif(!maxlen($passward,20)){
    $errors[]="passward <20";
}



//email
if(empty($email)){
    $errors[]=  "your email is empty";
}
elseif(checkemail( $email)){
    $errors[]= "your email is not vailde";
}
include "../../database/database.php";
$qld="SELECT `email` from `users` where `email`='$email'";
$resut=mysqli_query($conn,$qld);
$row=mysqli_fetch_assoc($resut);
if($row['email']!=null){
    $errors[]="email exist";
    
}

//
if(empty($errors)){
    $new_passward=sha1($passward,);
    include "../../database/database.php";
    $sql= "INSERT INTO `users`(`email`,`passward`) VALUE ( '$email',' $new_passward')";
   
    if(mysqli_query($conn,$sql) ){
        $_SESSION['success']=['added'];
      
    }
    else{
        $_SESSION[$errors]=['not added'];
    }
    header("location:../../register.php");

}
else{
    $_SESSION['errors']=$errors;
    header("location:../../register.php");
}




}