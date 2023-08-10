<?php
session_start();
if(isset($_SESSION['login'])){
    unset($_SESSION['login']);
    session_destroy();
    session_unset();
}
header("location:../../login.php");