               <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                    </form>  <!--searchform-->
                </div>
                
                <!-- Blog Search Well -->
                <div class="well">
                           
                               <button class="well"><a href="admin/posts.php?source=add_post">ADD POST</a></button>
                               
                               <button class="well"><a href="admin/categories.php">ADD CATEGORY</a></button>
                               
                               <button class="well"><a href="admin/profile.php">EDIT PROFILE</a></button>
                          
<!--
<h4>LOGIN</h4>
<form action="includes/login.php" method="post">
<div class="input-group">
<label for="username">
<input placeholder="username" name="username" type="text" class="form-control">
</label>
<label for="password">
<input  placeholder="password" name="password" type="password" class="form-control">
</label>
<span class="input-group-btn">
<button name="login" class="btn btn-primary" type="submit">
login
</button>
</span>
</div>
-->

<!-- /.input-group -->
<!--</form>  -->
                           
                    
                    
                    
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                   <?php
                    $querry="SELECT * FROM categories";
                    $select_categories_sidebar=mysqli_query($connection,$querry);
                    ?>
                   
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
        <?php 
        while($row=mysqli_fetch_assoc($select_categories_sidebar))
        {
            $category_id=$row['category_id'];
        $category_title=$row['category_title'];
    
        echo "<li ><a href='./categories.php?category_id={$category_id}'>$category_title</a></li>";
        
        }
        ?>
                            </ul>
                        </div>
                        
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "widget.php"; ?>

</div>