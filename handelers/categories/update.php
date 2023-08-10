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
    if(isset($_SESSION['user_id'])&&isset($_GET['id'])){
        $user_id=$_SESSION['user_id'];
        $id=$_GET['id'];

    }
    include "../../database/database.php";
    $sql="SELECT `name` from `categories` where `user_id`='$user_id' and `name`='$name'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    if($row!=null){
        $errors[]="name exists";
    }

    

    
    if(empty($errors)){
        if(isset($_SESSION['user_id'])){
            $user_id=$_SESSION['user_id'];
            include "../../database/database.php";
            $sql="UPDATE `categories` set  `name`= '$name'where `id`='$id' ";
            if(mysqli_query($conn,$sql)){
                $_SESSION['success']=['updated'];
    
    
            }
            else{
                $_SESSION['errors']=['not updated'];
            }
        }else{
            $sql="UPDATE `categories` set  `name`= '$name'where `id`='$id' ";
            if(mysqli_query($conn,$sql)){
                $_SESSION['success']=['updated'];
    
    
            }
            else{
                $_SESSION['errors']=['not updated'];
            }

        }
       
        header("location:../../edit-category.php?id=$id");     


       

    }
    else{
        $_SESSION['errors']=$errors;
        header("location:../../edit-category.php?id=$id");

    }
  
  

}