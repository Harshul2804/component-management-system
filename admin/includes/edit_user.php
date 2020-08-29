<?php
        if(isset($_GET['edit'])){
        $user_id=$_GET['edit'];
        $query="SELECT * FROM users WHERE user_id=$user_id";
            $show_query=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($show_query)){
                $user_firstname=$row['user_firstname'];
                $user_lastname=$row['user_lastname'];
                $username=$row['username']; 
                $user_email=$row['user_email'];
                $user_password=$row['user_password'];
    }
            if(isset($_POST['update_user'])){
        $user_firstname=$_POST['user_firstname'];
        $user_lastname=$_POST['user_lastname'];
        $username=$_POST['username'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        $user_role=$_POST['user_role'];
                $query="SELECT user_password FROM users WHERE user_id=$user_id";
                $send_query=mysqli_query($connection,$query);
                $row=mysqli_fetch_assoc($send_query);
                $db_user_password=$row['user_password'];
                
                if(!empty($user_password) && $user_password !== $db_user_password){
                    $user_password= password_hash($user_password, PASSWORD_DEFAULT, array('cost'=>12));
         $query="UPDATE users SET user_firstname = '{$user_firstname}', ";
         $query.="user_lastname = '{$user_lastname}', ";
         $query.="username = '{$username}', ";
         $query.="user_email = '{$user_email}', ";
         $query.="user_password = '{$user_password}', ";
         $query.="user_role = '{$user_role}' ";
         $query.="WHERE user_id = {$user_id}";
        $update_query=mysqli_query($connection,$query);
            }
}
}
        ?>
  <form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
       <label for="user_firstname">Firstname</label>
       <input value="<?php echo $user_firstname ?>" type="text" name="user_firstname" class="form-control">
   </div>
   <div class="form-group">
       <label for="user_lastname">Lastname</label>
       <input value="<?php echo $user_lastname ?>" type="text" name="user_lastname" class="form-control">
   </div>  
   <select name="user_role" id="">
   <?php 
    $query="SELECT user_role FROM users WHERE user_id=$user_id";
    $send_query=mysqli_query($connection,$query);
              if(!$send_query){
                  die("QUERY FAILED".mysqli_error($connection));
              }
              $row=mysqli_fetch_assoc($send_query);
              $user_role=$row['user_role'];
       ?>
    <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
    <?php if($user_role == 'Admin'){
    echo "<option value='Suscriber'>Suscriber</option>";
    }
    else{
    echo "<option value='Admin'>Admin</option>";
        }
       ?>
   </select>
   <div class="form-group">
       <label for="username">Username</label>
       <input value="<?php echo $username ?>" type="text" name="username" class="form-control">
   </div>
   <div class="form-group">
       <label for="user_email">Email</label>
       <input value="<?php echo $user_email ?>" type="text" name="user_email" class="form-control">
   </div>
    <div class="form-group">
       <label for="user_password">Password</label>
       <input autocomplete="off" value="" name="user_password" type="text" class="form-control">
   </div>
   <div class="form-control">
       <input type="submit" class="btn btn-primary" name="update_user" value="Update user">
   </div>   
</form>
