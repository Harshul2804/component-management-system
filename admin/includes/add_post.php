<?php
//include "./functions.php";
if(isset($_POST['create_post'])){
    $post_title=$_POST['post_title'];
    $post_category_id=$_POST['post_category_id'];
    $post_author=$_POST['post_author'];
    $post_status=$_POST['post_status'];
    
    $post_image=$_FILES['image']['name'];
    $post_image_temp=$_FILES['image']['tmp_name'];
    
    // $post_video=$_FILES['file']['name'];
    // $post_video_temp=$_FILES['file']['tmp_name'];
    
    $post_content=mysqli_real_escape_string($connection,$_POST['post_content']);
    
    $post_date= date('d-m-y');
    $post_tags=$_POST['post_tags'];
    $post_comment_count=0;
    
    move_uploaded_file($post_image_temp ,"../images/".$post_image);
    // move_uploaded_file($post_video_temp,"../".$post_video);
    
    $query="INSERT INTO posts (post_title, post_category_id, post_author, post_status, post_content, post_date, post_image, post_tags, post_comment_count) VALUES('{$post_title}',{$post_category_id},'{$post_author}','{$post_status}','{$post_content}',now(),'{$post_image}','{$post_tags}', '{$post_comment_count}')";
    $create_post_query=mysqli_query($connection,$query);
    if(!$create_post_query){
        die("QUEERY FAILERD".mysqli_error($connection));
    }
   
}
?>
  <form action="" method="post" enctype="multipart/form-data">
   <div class="form-group">
       <label for="title">Post Title</label>
       <input type="text" name="post_title" class="form-control">
   </div>
      <hr>

<div class="form-group">
<label for="post_category_id">post category</label>
 <select name="post_category_id" id=''>
  <?php
      $query="SELECT * FROM categories";
      $select_categories=mysqli_query($connection,$query);
      while($row=mysqli_fetch_assoc($select_categories)){
          $category_id=$row['category_id'];
          $category_title=$row['category_title'];
          echo "<option value={$category_id}>$category_title</option>";
      }
      ?>
   </select>
   </div>
      <hr>
   <div class="form-group">
    <label for="post_author">Post User</label>
     <select name="post_author">
     <option value="<?php echo $_SESSION['username']; ?>">Select Options</option>
      <option value="<?php echo $_SESSION['username']; ?>" >
          <?php echo $_SESSION['username']; ?>
          </option>
           </select>
   </div>
      <hr>

 <label for="post_status">Post status</label>
  <select name="post_status">
     <option value="draft">Select options</option>
      <option value="published">publish</option>
      <option value="draft">draft</option>
  </select>
   <hr>
   <div class="form-group">
       <label for="post-tags">Post Tags</label>
       <input type="text" name="post_tags" class="form-control">
   </div>

   <div class="form-group">
       <label for="post_image">Post Image</label>
       <input type="file" name="image" class="form-control">
   </div>

  <!-- <div class="form-group">
       <label for="post_image">Post video</label>
       <input type="file" name="file" class="form-control">
   </div> -->
   
   <div class="form-group">
       <label for="post_content">Post Content</label>
       <textarea  name="post_content" id="body" cols="30" rows="10" class="form-control">
       </textarea>
   </div>
   
   <div class="form-control">
       <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
   </div>   
</form>