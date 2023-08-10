<?php 
session_start();
if(isset($_GET['id'])&&isset($_GET['image_name'])){
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    $user_id=$_SESSION['user_id'];
    include "../../database/database.php";
    if(file_exists("../../upload/$image_name")){
    $sql="DELETE from `products` where `id`='$id' and `user_id`='$user_id' ";
    if(mysqli_query($conn,$sql)){
        unlink("../../upload/$image_name");
        $_SESSION['success']=['deleted'];

        
    }else{
        $_SESSION['errors']=['not deleted'];
    }
}else{
    $sql="DELETE from `products` where `id`='$id' and `user_id`='$user_id' ";
    if(mysqli_query($conn,$sql)){
        
        $_SESSION['success']=['deleted'];

        
    }else{
        $_SESSION['errors']=['not deleted'];
    }

}
    header("location:../../index-product.php");

    
}