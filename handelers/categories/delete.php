<?php 
session_start();
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $user_id=$_SESSION['user_id'];
    include "../../database/database.php";
    $sqll="DELETE from `categories` where `id` = '$id' and `user_id` = '$user_id' ";
    if(mysqli_query($conn,$sqll)){
        $_SESSION['success']=['deleted'];

        
    }else{
        $_SESSION['errors']=['not deleted'];
    }
    header("location:../../index-category.php");
    
}