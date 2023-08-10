<?php
session_start();
$errors=[];
if (isset($_POST["submit"])&&$_SERVER['REQUEST_METHOD']=="POST"){

    $name=trim(htmlspecialchars($_POST['name']));
    $price=trim(htmlspecialchars($_POST['price']));
   
    $category_id=trim(htmlspecialchars($_POST['category_id']));
    $image=$_FILES['image'];
  

    include "../../validation/validation.php";  
    
     if(empty($name)){
        $errors[]="type name";
     }elseif(!minlen($name,3)){
         $errors[]="name >3";
     }
     elseif(!maxlen($name,20)){
         $errors[]="name <20";
     }

     if(empty($price)){
        $errors[]="type name";
     }elseif(!minlen($price,1)){
         $errors[]="price >1";
     }
     elseif(!maxlen($price,3)){
         $errors[]="price <3";
     }
     if(empty($category_id)){
        $errors[]="type category";
     }
     if(empty($image)){
        $errors[]="type image";
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
        include "../../uploadfile/uploadfile.php";
        uploadfile("../../upload/",$image,$errors);
        if(isset($_SESSION['image_name'])){
            $image_name=$_SESSION['image_name'];
            $sql="INSERT INTO `products`(`name`,`price`,`image`,`user_id`,`category_id`) value ('$name','$price','$image_name','$user_id','$category_id')";
            if(mysqli_query($conn,$sql)){
                $_SESSION['success']=['added'];

            }
            else{
                $_SESSION['errors']=['not added'];
            }
        }
        header("location:../../create-product.php");     
    }
    else{
        $_SESSION['errors']=$errors;
        header("location:../../create-product.php");

    }
  
  

}