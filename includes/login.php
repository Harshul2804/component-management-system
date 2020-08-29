<?php
ob_start();
include "db.php";
include "../admin/functions.php";
// echo "users_online()";
session_start();
if(isset($_POST['login'])){
     $username=mysqli_real_escape_string($connection,$_POST['username']);
     $password=mysqli_real_escape_string($connection,$_POST['password']);
    //$password=password_hash($password,PASSWORD_DEFAULT,array('cost'=>12));
    $query="SELECT * FROM users WHERE username='{$username}'";
    $select_user_query=mysqli_query($connection,$query);
    
    while($row=mysqli_fetch_assoc($select_user_query)){
         $db_user_id=$row['user_id'];
         $db_username=$row['username'];
         $db_user_password=$row['user_password'];
         $db_user_firstname=$row['user_firstname'];
         $db_user_lastname=$row['user_lastname'];
         $db_user_role=$row['user_role'];
        //$password=crypt($password,$db_user_password);

    }
    
    //if($username === $db_username && $password === $db_user_password){
    if(password_verify($password, $db_user_password)){
        $_SESSION['user_id']=$db_user_id;
        $_SESSION['username']=$db_username;
        $_SESSION['firstname']=$db_user_firstname;
        $_SESSION['lastname']=$db_user_lastname;
        $_SESSION['user_role']=$db_user_role;
        if($_SESSION['user_role']=='Admin'){
        header("LOCATION: ../admin/index.php");
        }
        else{
            header("LOCATION: ../index_timeline.php"); 
                    global $connection;
                    $session= session_id();
                    $time= time();
                    $time_out= 300;
                    $present_time_out= $time - $time_out;
                    $username= $_SESSION['username'];

                    $query="SELECT * FROM users_online WHERE session='$session'";
                    $send_query=mysqli_query($connection,$query);
                    $count=mysqli_num_rows($send_query);

                    if($count==null){
                    $querry="INSERT INTO users_online(session, time, username) VALUES('$session', '$time', '$username')";
                    mysqli_query($connection ,$querry);
                    }
                    else{
                    mysqli_query($connection,"UPDATE users_online SET time='$time' WHERE session='$session'");
                    }
                    $count_users_online = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$present_time_out'");
                    $count_users = mysqli_num_rows($count_users_online);
                    echo $count_users;
        }
    }
    else{
        header("LOCATION: ../index.php");
    }
    
}

?>