<?php include "layout/header.php"?>
<?php 
if(isset($_SESSION['user_id'])){
    $user_id=$_SESSION['user_id'];
    include "database/database.php";
    $sqll = "SELECT * from `categories` where `user_id`='$user_id' ";
    $result=mysqli_query($conn,$sqll);
 
    
}



?>


<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
            <a href="<?php echo URL?>index-product.php" class="btn btn-primary mb-2 ">view products</a>
            <?php include "layout/message.php"?>








            <form action="handelers/products/create.php" method="post" class="border p-4" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label class="form-label">price</label>
                    <input type="text" name="price" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label class="form-label">image</label>
                    <input type="file" name="image" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label class="form-label">category</label>
                    <select class="form-select" name="category_id"aria-label="Default select example">
                       <?php if(isset($result)) :foreach($result as $value):?>
                        <option value="<?php echo $value['id'];?>   "><?php echo $value['name'];?></option>
                        <?php endforeach;endif;?>    
                       </select>

                </div>


                <button type="submit" name="submit" class="btn btn-primary">add product</button>
            </form>
        </div>
    </div>
</div>
<?php include "layout/footer.php"; ?>