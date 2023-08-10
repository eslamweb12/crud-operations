<?php include "layout/header.php"?>
<?php
if(isset($_SESSION['user_id'])){
    
 
   
        $user_id=$_SESSION['user_id'];    
        include "database/database.php";
        $sql = "SELECT * from `categories` where `user_id`='$user_id' ";
        $resultt=mysqli_query($conn,$sql);
     
        
    
}
?>
<div class="container pt-5">
    <div class="row">
        <div class="col-8 mx-auto">
            <a href="<?php  echo URL?>index-category.php" class="btn btn-primary mb-2 ">view categories</a>
            <?php include "layout/message.php"?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1;if(isset($resultt)):foreach($resultt as $value):?>
                    <tr>
                        <th scope="row"><?php echo $i++;?></th>
                        <td><?php echo $value['name'];?></td>
                        <td>
                                <div class="d-flex">
                                    <a href="<?php echo URL?>edit-category.php?id=<?php echo $value['id'];?>"class="btn btn-primary ms-2">edit</a>
                                    <a href="<?php echo URL?>handelers/categories/delete.php?id=<?php echo $value['id'];?>"class="btn btn-danger ms-2">delete</a>
                                </div>
                        </td>
                        
                    </tr>
                    <?php endforeach; endif?>               
                </tbody>
            </table>







        </div>
    </div>
</div>
<?php include "layout/footer.php"; ?>