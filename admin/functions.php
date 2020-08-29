<?php
// function escape($string){
//     global $connection;
//     return mysqli_real_escape_string($connection, trim($string));
// }
function insert_categories(){
    global $connection;
    if(isset($_POST['submit']))
                    {
                    $category_title=$_POST['category_title'];
                        if($category_title =="" || empty($category_title))
                           {
                            echo "This field shouldn't be left empty.";
                            }
                            else
                            {
                            $query="INSERT INTO categories(category_title)";
                            $query.="VALUE('{$category_title}')";
                            $create_category_query=mysqli_query($connection,$query);
                                if(!$create_category_query)
                                {
                                    die('QUERY FAILED'.mysqli_error($connection));
                                } 
                            }   
                        }
}

function find_all_categories(){
    global $connection;
    
    $querry="SELECT * FROM categories";
    $select_categories=mysqli_query($connection,$querry);
    while($row=mysqli_fetch_assoc($select_categories)){
    $category_id=$row['category_id'];
    $category_title=$row['category_title'];

    echo "<tr>";
    echo "<td>{$category_title}</td>";
    echo "<td>{$category_id}</td>";
    echo "<td><a href='categories.php?delete={$category_id}'>DELETE</a></td>";
    echo "<td><a href='categories.php?edit={$category_id}'>EDIT</a></td>";
    echo "</tr>";
    }
}

function delete_categories(){
    global $connection;
    if(isset($_GET['delete'])){
    $category_id=$_GET['delete'];
    $query="DELETE from categories WHERE category_id={$category_id}";
    $delete_query=mysqli_query($connection,$query);
    header("LOCATION:categories.php");
    }
    
function confirm_querry($result){
    global $connection;
     if(!$result){
        die("QUERRY FAILED".mysqli_error($connection));
    }   
    }
}

function users_online(){
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
?>