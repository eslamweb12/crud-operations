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
        include "../../uploadfile/uploadfile.php";
        var_dump($image);
        if($image!=null){
            $sqlimage="SELECT `image` from `products` where `user_id`='$user_id' and `id`='$id'";
            $resultimage=mysqli_query($conn,$sqlimage);
            $rowimage=mysqli_fetch_assoc($resultimage);
            $checkImage=$rowimage['image'];
            if(isset($rowimage['image'])&&file_exists("../../upload/$checkImage")){
                unlink("../../upload/$checkImage");
            }
            uploadfile("../../upload/",$image,$errors);
            if(isset($_SESSION['image_name'])){
                $image_name=$_SESSION['image_name'];
                $sql="UPDATE  `products` set `name`='$name', `price`='$price', `image`='$image_name', `user_id`='$user_id', `category_id`='$category_id' where `id`='$id'";
                if(mysqli_query($conn,$sql)){
                    $_SESSION['success']=['updated'];
    
                }
                else{
                    $_SESSION['errors']=['not updated'];
                }
            }

        }
  
     
        header("location:../../edit-product.php?id=$id");     
    }
    else{
        $_SESSION['errors']=$errors;
        header("location:../../edit-product.php?id=$id");

    }
  
  

}