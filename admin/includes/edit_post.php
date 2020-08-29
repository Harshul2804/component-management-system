<?php
if(isset($_GET['edit'])){
            $edit_id=mysqli_real_escape_string($connection,$_GET['edit']);
            $query="SELECT * FROM posts WHERE post_id={$edit_id}";
            $edit_query=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($edit_query)){
                $post_id=$row['post_id'];
                  $post_author=$row['post_author'];
                  $post_title=$row['post_title'];
                  $post_category_id=$row['post_category_id'];
                  $post_status=$row['post_status'];
                  $post_image=$row['post_image'];
                  $post_tags=$row['post_tags'];
                  $post_comment_count=$row['post_comment_count'];
                  $post_date=$row['post_date']; 
                  $post_content=$row['post_content'];
            } 
        }

if(isset($_POST['update_post'])){
    $post_title=mysqli_real_escape_string($connection,$_POST['post_title']);
    $post_category_id=mysqli_real_escape_string($connection,$_POST['post_category_id']);
    $post_author=mysqli_real_escape_string($connection,$_POST['post_author']);
    $post_status=mysqli_real_escape_string($connection,$_POST['post_status']);
    $post_tags=mysqli_real_escape_string($connection,$_POST['post_tags']);
    $post_image=mysqli_real_escape_string($connection,$_FILES['image']['name']);
    $post_image_temp=mysqli_real_escape_string($connection,$_FILES['image']['tmp_name']);
    $post_content=mysqli_real_escape_string($connection,$_POST['post_content']);
    
    move_uploaded_file($post_image_temp,"../images/$post_image");
    if(empty($post_image)){
        $query="SELECT * FROM posts WHERE post_id={$edit_id}";
        $select_image=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($select_image)){
            $post_image=$row['post_image'];
        }
    }
    $query="UPDATE posts SET ";
    $query.="post_title='{$post_title}', ";
    $query.="post_category_id='{$post_category_id}', ";
    $query.="post_author='{$post_author}', ";
    $query.="post_status='{$post_status}', ";
    $query.="post_tags='{$post_tags}', ";
    $query.="post_image='{$post_image}', ";
    $query.="post_content='{$post_content}', ";
    $query.="post_date=now() ";
    $query.="WHERE post_id='{$edit_id}'";
    $update_query=mysqli_query($connection,$query);
    //header("LOCATION: posts.php");
     echo "Post updated.";
     echo "<a href='../post.php?p_id=$edit_id'><h5 class='bg-success'>View post</h5>
    </a>";
    if(!$update_query){
        die("QUERY FAILED".mysqli_error($connection));
    }
}
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="title">Post Title</label>
<input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
</div>
<hr> 
  
<div class="form-group">
<label for="post_category_id">Post Category</label>
<select name="post_category_id" id="post_category">
      <?php 
    if(isset($post_category_id)){
        $query="SELECT * FROM categories WHERE category_id=$post_category_id";
        $send_query=mysqli_query($connection,$query);
        $fet=mysqli_fetch_assoc($send_query);
        $post_category=$fet['category_title'];
        echo "<option value=$post_category_id>$post_category</option>";
    }
           $query="SELECT * FROM categories";
           $select_category_query=mysqli_query($connection,$query);
           while($row=mysqli_fetch_assoc($select_category_query)){
               $category_title=$row['category_title'];
               $category_id=$row['category_id'];
               echo "<option value='{$category_id}'>{$category_title}</option>";
           }
       ?>
</select>
</div>
   
<hr>
<div class="form-group">
    <label for="post_author">Post Author</label>
    <select name="post_author">
       <?php 
        $get_post_author_query="SELECT * FROM users";
        $send_query=mysqli_query($connection,$get_post_author_query);
        while($get=mysqli_fetch_assoc($send_query)){
            $username=$get['username'];
           echo "<option value=$username>$username</option>";
        }
        ?>
    </select>
</div>
<hr>

<div class="form-group">
  <label for="post_status">Post Status</label>
   <select name="post_status">
       <?php 
       if($post_status == 'published'){
           echo "<option value='published'>published</option>";
           echo "<option value='draft'>draft</option>";
       }
       else{
           echo "<option value='draft'>draft</option>";
           echo "<option value='published'>published</option>";
       }
       ?>
   </select>
    
</div>
<hr>
<div class="form-group">
<label for="post-tags">Post Tags</label>
<input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>">
</div>

<div class="form-group">
<label for="image">Post Image</label>
<input type="file" name="image" class="form-control">
<img src="../images/<?php echo $post_image; ?>" width="200">
</div>


<div class="form-group">
<label for="post_content">Post Content</label>
<textarea  name="post_content" id="" cols="30" rows="10" class="form-control">
<?php echo $post_content; ?>
</textarea>
</div>

<div class="form-control">
<input type="submit" class="btn btn-primary" name="update_post" value="Update post">
</div>   
</form>