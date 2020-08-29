<?php
include "includes/header.php";
?>
<!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    
    <?php 
            if(isset($_GET['register'])){
                
             $firstname=mysqli_real_escape_string($connection,$_POST['firstname']);
             $lastname=mysqli_real_escape_string($connection,$_POST['lastname']);
             $username=mysqli_real_escape_string($connection,$_POST['username']);
             $email=mysqli_real_escape_string($connection,$_POST['email']);
             $password=mysqli_real_escape_string($connection,$_POST['password']);
             
            if(empty($username) && empty($email) && empty($password)){
                echo "<script>alert('fields cant be empty')</script>";
                header("LOCATION: registration.php");
            }else{
                $password= password_hash($password,PASSWORD_DEFAULT, array('cost'=>12));
            $query="INSERT INTO users (user_firstname, user_lastname, username, user_email, user_password, user_role) ";
            $query.="VALUES ('{$firstname}','{$lastname}','{$username}' ,'{$email}', '{$password}', 'Suscriber')";
            $insert_query=mysqli_query($connection,$query);
            if(!$insert_query){
                die("QUERRY FAILED".mysqli_error($connection));
            }
        // $query2="SELECT * FROM users WHERE username={$username}";
        // $bring_user_id=mysqli_query($connection,$query2);
        // while($row=mysqli_fetch_assoc($bring_user_id)){
        //     $user_id=$row['user_id'];
        // }
                // $_SESSION['user_id']=$user_id;
                $_SESSION['username']=$username;
                $_SESSION['firstname']=$firstname;
                $_SESSION['lastname']=$lastname;
                $_SESSION['user_role']='Suscriber';
                header("LOCATION: index_timeline.php");

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
    ?>
    
<?php 
if(isset($_SESSION['user_role'])){
    
?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
               
                
                <?php 
                $find_count_query="SELECT * FROM posts";
                $find_count=mysqli_query($connection,$find_count_query);
                if(!$find_count){
                    die("QUERY FAILED".mysqli_error($connection));
                }
                $count=mysqli_num_rows($find_count);
                $count=ceil($count/5);
                
                    if(!isset($_GET['page'])){
                        $lower_lim=0;
                         $higher_lim=5;
                    }
                    elseif(isset($_GET['page']))
                    {
                        $page=$_GET['page'];
                            
                            $lower_lim=($page-1)*5;
                            $higher_lim=5;
                        }
                    
                 $lower_lim;
                 $higher_lim;
                
    $querry="SELECT * FROM posts WHERE post_status='published' ORDER BY post_id DESC LIMIT $lower_lim, $higher_lim";
    $select_all_posts_querry=mysqli_query($connection,$querry);

    while($row=mysqli_fetch_assoc($select_all_posts_querry)){
        $post_id=$row['post_id'];
        $post_title=$row['post_title'];
        $post_author=$row['post_author'];
        $post_date=$row['post_date'];
        $post_image=$row['post_image'];
        // $post_video=$row['post_video'];
        $post_content=substr($row['post_content'],0,200);
        $post_status=$row['post_status'];
        if($post_status !== 'published'){
            echo "<h1 >NO POSTS</h1>";
        }
        else
        {
        ?>
                <!-- First Blog Post -->
                <!-- <div class='card' style='width:10rem;'>
                <img class="card-img-top" src="images/<?php echo $post_image; ?>" alt="Card image cap">
                <div class='card-body'>

                </div>
                </div> -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?p_id=<?php echo $post_id ?>&author=<?php echo $post_author ?>"><?php echo $post_author ?></a>
                </p>
                <p class="small-icon"><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?>
                </p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                <img class="img-responsive" style="border-radius:2%;" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">More <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                <hr>

        <?php    
        }
            }

        ?>


            </div>
            <!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>
            </div>
            <ul class="pager">
<?php 
for($i=1;$i<=$count;$i++)
{

     echo "<li><a href='index_timeline.php?page=$i'> $i</a></li>";   
            }
?>
</ul>
        <!-- /.row -->
             <hr>
<?php include "includes/footer.php"; ?>
        <!-- Footer -->
        
       <?php
}
?>