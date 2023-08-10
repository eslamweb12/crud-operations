<?php
session_start();
$errors=[];
if (isset($_POST["submit"])&&$_SERVER['REQUEST_METHOD']=="POST"){

    $name=trim(htmlspecialchars($_POST['name']));
    include "../../validation/validation.php";  
    
    if(empty($name)){
        $errors[]="type name";
    }elseif(!minlen($name,3)){
        $errors[]="name >6";
    
    }
    elseif(!maxlen($name,20)){
        $errors[]="name <20";
    }
    if(isset($_SESSION['user_id'])){
        $user_id=$_SESSION['user_id'];

    }
    include "../../database/database.php";
    $sql1="SELECT `name` from `categories` where `user_id`='$user_id' and `name`='$name'";
    $result=mysqli_query($conn,$sql1);
    $row=mysqli_fetch_assoc($result);
    if($row!=null){
        $errors[]="name exists";
    }

    

    
    if(empty($errors)){
        if(isset($_SESSION['user_id'])){
            $user_id=$_SESSION['user_id'];
            include "../../database/database.php";
            $sql="INSERT INTO `categories` (`name`,`user_id`)  VALUE ('$name','$user_id')";
            if(mysqli_query($conn,$sql)){
                $_SESSION['success']=['added'];
    
    
            }
            else{
                $_SESSION['errors']=['not added'];
            }
        }
       
        header("location:../../create-category.php");     


       

    }
    else{
        $_SESSION['errors']=$errors;
        header("location:../../create-category.php");

    }
  
  

}