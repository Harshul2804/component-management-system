<?php
include "db.php";
session_start();
$session=session_id();
$query="DELETE FROM users_online WHERE session = '$session'";
$send_query=mysqli_query($connection,$query);
if(!$send_query){
    die("QUERRY FAILED".mysqli_error($connection));
}
        $_SESSION['username']=null;
        $_SESSION['firstname']=null;
        $_SESSION['lastname']=null;
        $_SESSION['user_role']=null;
        $_SESSION['user_id']=null;

header("LOCATION: ../index.php");
?>