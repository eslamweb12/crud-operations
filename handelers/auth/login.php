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
$qld="SELECT * from `users` where `email`='$email'";
$resut=mysqli_query($conn,$qld);
$row=mysqli_fetch_assoc($resut);
if($row['email']!=$email){
    $errors[]="email is not exist";
    
}
if(password_verify($passward,$row['passward'])){
    $errors[]="this password is not exist";
}

//
if(empty($errors)){
    $_SESSION['success']=['successfuly'];
    $_SESSION['login']=true;
    $_SESSION['user_id']=$row['id'];

    
    header("location:../../login.php");

}
else{
    $_SESSION['errors']=$errors;
    header("location:../../login.php");
}




}