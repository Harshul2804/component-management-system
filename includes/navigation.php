<?php include "db.php" ;?>
<?php include "./admin/functions.php"; ?> 
        <?php
        session_start();
        if(isset($_SESSION['user_role'])){
            ?>
            <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">

            <ul class="nav navbar-nav">
            <div class="navbar-header">
            <a class="navbar-brand" href="./index_timeline.php">CMS Front</a>
            </div>
            <li><a href="registration.php">Registration</a></li>
            <li><a href="includes/logout.php">Log-out</a></li>
            <li><a href="admin/profile.php">Profile</a></li>
            <?php
            if($_SESSION['user_role']=='Admin'){
                ?>
            <li><a href="./online_users.php">Users Online: <?php echo users_online() ?></a></li>
            <?php
            }
            ?>
            <?php
            if($_SESSION['user_role']=='Admin'){ 
                ?>
        <li><a href="admin/index.php">Admin</a></li>
               <li><a href="admin/profile.php">Profile</a></li>
                <?php
            if(isset($_GET['p_id'])){
                $id=$_GET['p_id'];
                echo "<li><a href='admin/posts.php?source=edit_post&edit=$id'>Edit Post</a></li>";
            }
            }
                
        }
        ?>
    </ul>
  </div>
</nav>

  