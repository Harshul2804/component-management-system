<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>User-Id</th>
            <th>Username</th>
            <th>User-FirstName</th>
            <th>User-LastName</th>
            <th>User-Password</th>
            <th>User-Email</th>
            <th>User-role</th>
            <th></th>
            <th></th>
            <th></th>
            
            
        </tr>
    </thead>
    <tbody>
        <?php
            global $connection;
            $query="SELECT * FROM users";
            $select_posts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($select_posts )){
                  $user_id=$row['user_id'];
                  $username=$row['username'];
                  $user_firstname=$row['user_firstname'];
                  $user_lastname=$row['user_lastname'];
                  $user_password=$row['user_password'];
                  $user_email=$row['user_email'];
                  $user_role=$row['user_role'];  
                
                echo"<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_password</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
                echo "<td><a href='./users.php?change_to_admin=$user_id'>Admin</a></td>";
                echo "<td><a href='./users.php?change_to_suscriber=$user_id'>Suscriber</a></td>";
                echo"<td><a href='./users.php?source=edit_user&edit=$user_id'>Edit</a></td>";
                echo"<td><a href='./users.php?delete=$user_id'>Delete</a></td>";
                
            }
            
            if(isset($_GET['delete'])){
                if(isset($_SESSION['user_role'])){
                    if($_SESSION['user_role'] == 'Admin')
                    {
                $delete_id=mysqli_real_escape_string($connection, $_GET['delete']);
                $query="DELETE FROM users WHERE user_id=$delete_id";
                $delete_query=mysqli_query($connection,$query);
                header("LOCATION: users.php");
                    }
            }}
        
            if(isset($_GET['change_to_suscriber'])){
                $change_sus=$_GET['change_to_suscriber'];
                $query="UPDATE users SET user_role='Suscriber' WHERE user_id=$change_sus";
                $change_sus_query=mysqli_query($connection,$query);
                header("LOCATION: users.php");
                
            }
          if(isset($_GET['change_to_admin'])){
                $change_admin=$_GET['change_to_admin'];
                $query="UPDATE users SET user_role='Admin' WHERE user_id=$change_admin";
                $change_sus_query=mysqli_query($connection,$query);
                header("LOCATION: users.php");
                
            }
        
     ?>
       
    </tbody>
</table>