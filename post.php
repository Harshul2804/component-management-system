<?php
include "includes/header.php";
require "admin/functions.php"
?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

<div class="row">

<!-- Blog Entries Column -->
<div class="col-md-8">
<?php 
    if(isset($_GET['p_id'])){
    $post_id=$_GET['p_id'];

            $view_query="UPDATE posts SET post_views=post_views+1 WHERE post_id=$post_id";
            $send_view_query=mysqli_query($connection,$view_query);
            $querry="SELECT * FROM posts WHERE post_id={$post_id}";
            $select_all_posts_querry=mysqli_query($connection,$querry);

        while($row=mysqli_fetch_assoc($select_all_posts_querry)){
            $post_title=$row['post_title'];
            $post_author=$row['post_author'];
            $post_date=$row['post_date'];
            $post_image=$row['post_image'];
            $post_content=$row['post_content'];

?>
<!--
            <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>
-->
        <!-- First Blog Post -->
    <h2>
    <a href="#"><?php echo $post_title ?></a>
    </h2>
    <p class="lead">
    by <a href="index.php"><?php echo $post_author ?></a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
    <hr>
    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
    <hr>
    <p><?php echo $post_content ?></p>
    <hr>
<?php    
}
}
?>
<?php 
        if(isset($_POST['create_comment'])){
                $post_id=mysqli_real_escape_string($connection,$_GET['p_id']);
                $comment_content=mysqli_real_escape_string($connection,$_POST['comment_content']);    
        if(!empty($comment_content)){
                $query="INSERT INTO comments(comment_post_id, comment_author, comment_content, comment_status, comment_date) VALUES ($post_id,'{$_SESSION['username']}','{$comment_content}','Unapproved',now())";
                $comment_query=mysqli_query($connection,$query);
if(!$comment_query){
    die("QUERRY FAILED".mysqli_error($connection));
}
                $comment_count_query="SELECT * FROM comments WHERE comment_post_id=$post_id";
                $send_query=mysqli_query($connection,$comment_count_query);
                $comment_count=mysqli_num_rows($send_query);

                $update_query="UPDATE posts SET post_comment_count=$comment_count WHERE post_id=$post_id";
                $send_update_query=mysqli_query($connection,$update_query);
                }
        else{
            
                echo"<script>alert('fields cant be left empty')</script>";
            }
                }
                ?>

    <div class="well">
    <h4>Leave a Comment:</h4>
    <form role="form" action="" method="post">
    <div class="form-group">
    <label for="comment">Comment</label>
    <textarea name="comment_content" class="form-control" rows="3"></textarea>
    </div>
    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
    </form>
    </div>

        <!-- Posted Comments -->

        <!-- Comment -->
<?php
                $query="SELECT * FROM comments WHERE comment_post_id={$post_id} ";
                $query.="AND comment_status='Approved' ";
                $query.="ORDER BY comment_id DESC";
                $select_comment_query=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_comment_query)){
            
                $comment_content=$row['comment_content'];
                $comment_author=$row['comment_author'];
                $comment_date=$row['comment_date'];
                    
?>  
    <div class="media">
    <a class="pull-left" href="#">
    <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">

    <h4 class="media-heading"><?php echo $comment_author ?>
    <small><?php echo $comment_date ?></small>
    </h4>
<?php echo $comment_content; ?>
    </div>
    </div>
<?php              
}
?>
    </div>

<!-- Blog Sidebar Widgets Column -->
<?php include "includes/sidebar.php"; ?>
<hr>
</div>
</div>
<!-- /.row -->
<hr>
<?php include "includes/footer.php"; ?>
<!-- Footer -->
