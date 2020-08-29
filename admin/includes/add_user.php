<?php
if(isset($_POST['create_user'])){
    $user_firstname=$_POST['user_firstname'];
    $user_lastname=$_POST['user_lastname'];
    $username=$_POST['username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $user_role=$_POST['user_role'];

                    //$rand_salt_query="SELECT rand_salt FROM users";
                    //$send_query=mysqli_query($connection,$rand_salt_query);
                    //    if(!$send_query){
                    //        die("QUERRY FAILED".mysqli_error($connection));
                    //    }
                    //    $fetch_salt=mysqli_fetch_assoc($send_query);
                    // $rand_salt=$fetch_salt['rand_salt'];
                    //$user_password=crypt($user_password,$rand_salt);
    $user_password=password_hash($user_password, PASSWORD_DEFAULT, array('cost'=>12));
    $query="INSERT INTO users (user_firstname, user_lastname, username, user_email, user_password, user_role) VALUES('{$user_firstname}','{$user_lastname}','{$username}','{$user_email}','{$user_password}','{$user_role}')";
    
    $create_user_query=mysqli_query($connection,$query);
    if(!$create_user_query){
        die("QUEERY FAILERD".mysqli_error($connection));
    }
    echo "New User created:"."<a href='users.php'>View users</a>";
}

?>
  <form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
       <label for="user_firstname">Firstname</label>
       <input type="text" name="user_firstname" class="form-control">
   </div>
   
   <div class="form-group">
       <label for="user_lastname">Lastname</label>
       <input type="text" name="user_lastname" class="form-control">
   </div>
   
   
       <select name="user_role" id="">
        <option value="suscriber">Select Options</option> 
        <option value="admin">Admin</option>
        <option value="suscriber">Suscriber</option>   
       </select>
   
   
   <div class="form-group">
       <label for="username">Username</label>
       <input type="text" name="username" class="form-control">
   </div>
   
   <div class="form-group">
       <label for="user_email">Email</label>
       <input type="text" name="user_email" class="form-control">
   </div>

   <div class="form-group">
       <label for="user_password">Password</label>
       <input type="password" name="user_password" class="form-control">
   </div>
   <div class="form-control">
       <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
   </div>   
</form>