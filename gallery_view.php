<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<?php session_start(); ?>
<div class="container">
<div id="wrapper">
<?php 
global $connection;
$query="SELECT * FROM posts where post_author='{$_SESSION['username']}'";
$send_query=mysqli_query($connection,$query);
$count=mysqli_num_rows($send_query);
if($count>=3){
  $count=count/3;
  $count=ceil($count);
  for($i=0;i<$count;i++){
    
  }
}
while($row=mysqli_fetch_assoc($send_query)){
        $post_id=$row['post_id'];
        $post_title=$row['post_title'];
        $post_author=$row['post_author'];
        $post_date=$row['post_date'];
        $post_image=$row['post_image'];
        $post_content=substr($row['post_content'],0,200);
        $post_status=$row['post_status'];
?>
        <div class="row">
        <div class="col">
        <div class="card card-bordered">
    <img class="card-img-top" src="images/<?php echo $post_image; ?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><?php echo $post_title ?></h5>
      <p class="card-text"><?php echo $post_content ?></p>
      <p class="card-text"><small class="text-muted"><?php echo $post_author ?></small></p>
    </div>
    </div>
    </div>
</div>

<?php
}
if(!$send_query){
  die("QUERY FAILED".mysqli_error($connection));
}
?>



</div>
<?php include "includes/footer.php"; ?>