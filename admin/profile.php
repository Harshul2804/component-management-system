<?php include "includes/admin_header.php"; ?>
<?php 
if(isset($_SESSION['user_id'])){
    $userid=$_SESSION['user_id'];
    $query="SELECT * FROM users WHERE user_id={$userid}";
    $profile_query=mysqli_query($connection,$query);
    if(!$profile_query){
        die("QUERRY FAILED".mysqli_error($connection));
    }
    else{
        while($row=mysqli_fetch_assoc($profile_query)){
            $db_user_image=$row['user_image'];
            $db_user_id=$row['user_id'];
            $db_user_firstname=$row['user_firstname'];
            $db_user_lastname=$row['user_lastname'];
            $db_user_role=$row['user_role'];
            $db_username=$row['username'];
            $db_user_email=$row['user_email'];
            $db_user_password=$row['user_password'];
        }
    }
    
}

if(isset($_POST['update_profile'])){
        $user_firstname=mysqli_real_escape_string($connection,$_POST['user_firstname']);
        $user_lastname=mysqli_real_escape_string($connection,$_POST['user_lastname']);
        $user_role=mysqli_real_escape_string($connection,$_POST['user_role']);
        $username=mysqli_real_escape_string($connection,$_POST['username']);
        $user_email=mysqli_real_escape_string($connection,$_POST['user_email']);
        $user_password=mysqli_real_escape_string($connection,$_POST['user_password']);
        
        $post_image=$_FILES['image']['name'];
        $post_image_temp=$_FILES['image']['tmp_name'];
        //$upload_folder="./displayPictures/";
    move_uploaded_file($post_image_temp ,"./".$post_image);
        
$query="UPDATE users SET username = '{$username}', ";
$query.="user_firstname = '{$user_firstname}', ";
$query.="user_lastname = '{$user_lastname}', ";
$query.="user_role = '{$user_role}', ";
$query.="user_email = '{$user_email}', ";
$query.="user_password = '{$user_password}', ";
    $query.="user_image = '{$post_image}' ";
$query.="WHERE user_id={$db_user_id}";
$post_query=mysqli_query($connection,$query);
    if($_SESSION['user_role']=='Admin'){
        header("LOCATION: index.php");
    }
    else{
        header("LOCATION: ../index_timeline.php");
    }
}
?>
    
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome <?php echo $_SESSION['username']; ?> 
                        </h1>
                        
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <label for="image">Display picture</label>
    <input id="imagename" type="file" name="image" class="form-control">
    <img class="small-icon" id="image" src="./<?php echo $db_user_image ?>">
    </div>
                           
   <div class="form-group">
       <label for="user_firstname">Firstname</label>
       <input value="<?php echo $db_user_firstname ?>" type="text" name="user_firstname" class="form-control">
   </div>
   
   <div class="form-group">
       <label for="user_lastname">Lastname</label>
       <input value="<?php echo $db_user_lastname ?>" type="text" name="user_lastname" class="form-control">
    
   </div>  
    
   <select name="user_role" id="">
    <?php 
    if($db_user_role === 'Admin'){
       echo "<option value='Admin'>Admin</option>";
        echo "<option value='Suscriber'>Suscriber</option>";
    }
              else{
                 echo "<option value='Suscriber'>Suscriber</option>"; 
                 echo "<option value='Admin'>Admin</option>";
              }
       ?>
   </select>
   <div class="form-group">
       <label for="username">Username</label>
       <input value="<?php echo $db_username ?>" type="text" name="username" class="form-control">
   </div>
   
   <div class="form-group">
       <label for="user_email">Email</label>
       <input value="<?php echo $db_user_email ?>" type="text" name="user_email" class="form-control">
   </div>
   
    <div class="form-group">
       <label for="user_password">Password</label>
       <input value="<?php echo $db_user_password ?>" name="user_password" type="password" class="form-control">
   </div>
   <div class="form-control">
       <input type="submit" class="btn btn-primary" name="update_profile" value="Update-user-Profile">
   </div>   
</form>  
                        
</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
</div>
   <?php include "includes/admin_footer.php" ?>