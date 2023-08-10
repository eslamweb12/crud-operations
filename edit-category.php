

<?php include "layout/header.php"?>
<?php 
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $user_id=$_SESSION['user_id'];
        include "database/database.php";
        $sql="SELECT `name` from `categories` where `id`='$id' and `user_id`='$user_id'";
        $result=mysqli_query($conn,$sql);
       
        $row=mysqli_fetch_assoc($result);


        
        
    }
?>
<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
            <a href="<?php echo URL?>index-category.php"class="btn btn-primary mb-2 ">view categories</a>
            <?php include "layout/message.php"?>



           




            <form action="handelers/categories/update.php?id=<?php echo $id; ?>" method="post" class="border p-4">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">name</label>
                    <input type="text" name="name"value="<?php if(isset($row['name'])): echo $row['name']; endif;?>" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">

                </div>
                

                <button type="submit" name="submit" class="btn btn-primary">update category</button>
            </form>
        </div>
    </div>
</div>
<?php include "layout/footer.php"; ?>