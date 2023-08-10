<?php 
if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    include "database/database.php";
    $sqll = "SELECT * from `categories` where `user_id`='$user_id' ";
    $result=mysqli_query($conn,$sqll);
 
    
}

?>

<?php include "layout/header.php"?>
<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
        <?php include "layout/message.php"?>


           




            <form action="handelers/auth/login.php" method="post" class="border p-4">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="passward" class="form-control" id="exampleInputPassword1">
                </div>

                <button type="submit" name="submit" class="btn btn-primary">login</button>
            </form>
        </div>
    </div>
</div>
<?php include "layout/footer.php"; ?>