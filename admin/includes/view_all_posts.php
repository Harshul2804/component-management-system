<?php
if(isset($_GET['reset'])){
if($_GET['reset']){
    $id=mysqli_real_escape_string($connection,$_GET['reset']);
    echo $id;
    $query="UPDATE posts SET post_views = 0 WHERE post_id=$id";
    $update_view=mysqli_query($connection,$query);
    header("LOCATION: posts.php");
}
}
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $xyz){
        $bulk_options=$_POST['bulk_options'];

        switch($bulk_options){
            case 'publish':
                $query="UPDATE posts SET post_status='published' WHERE post_id=$xyz";
                $update_query=mysqli_query($connection,$query);
                break;
                
            case 'draft':
                $query="UPDATE posts SET post_status='draft' WHERE post_id=$xyz";
                $draft_query=mysqli_query($connection,$query);
                break;
                
            case 'delete':
                $query="DELETE FROM posts WHERE post_id=$xyz";
                $update_query=mysqli_query($connection,$query);
                break;
            
            case 'clone':
                $query_ini="SELECT * FROM posts WHERE post_id=$xyz";
                $get_query=mysqli_query($connection,$query_ini);
                if(!$get_query){
                    die("QUERRY FAILED".mysqli_error($connection));
                }
                while($row=mysqli_fetch_assoc($get_query)){
                    $post_author=$row['post_author'];
                    $post_title=$row['post_title'];
                    $post_category_id=$row['post_category_id'];
                    $post_status=$row['post_status'];
                    $post_image=$row['post_image'];
                    $post_tags=$row['post_tags'];
                    $post_comment_count=$row['post_comment_count'];
                    $post_content=$row['post_content'];
                }
                    $query="INSERT INTO posts (post_author, post_title, post_category_id, post_status, post_image, post_tags, post_comment_count, post_date, post_content) VALUES ('{$post_author}','{$post_title}',{$post_category_id},'{$post_status}','{$post_image}','{$post_tags}',{$post_comment_count}, now(), '{$post_content}' )";
                    $set_query=mysqli_query($connection,$query);
                    if(!$set_query){
                        die("QUERRY FAILED".mysqli_error($connection));
                    }
                break;
                    
                }
                
                
        }
}
?>
   <form action="" method="post">
    <table class="table table-bordered table-hover">
      <div id="bulkOptionContainer" class="col-xs-4">
       <select class="form-control" name="bulk_options" id="">
           <option value="">Select options</option>
           <option value="publish">publish</option>
           <option value="draft"> draft</option>
           <option value="delete">delete</option>
           <option value="clone">clone</option>
       </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" class="btn btn-success" name="submit" value="Apply">
        <a class="btn btn-primary" href="./posts.php?source=add_post">Add New</a>
    </div>
    
    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comment_count</th>
            <th>Date</th>
            <th>View Post</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query="SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($select_posts )){
                  $post_id=$row['post_id'];
                  $post_author=$row['post_author'];
                  $post_title=$row['post_title'];
                  $post_category_id=$row['post_category_id'];
                  $post_status=$row['post_status'];
                  $post_image=$row['post_image'];
                  $post_tags=$row['post_tags'];
                  $post_comment_count=$row['post_comment_count'];
                  $post_date=$row['post_date'];  
                  $post_view_count=$row['post_views'];
                
                echo"<tr>";
                ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
                <?php 
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";
                
                $query="SELECT * FROM categories WHERE category_id={$post_category_id}";
                $select_category=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($select_category)){
                    $category_id=$row['category_id'];
                    $category_title=$row['category_title'];
                }
                echo "<td>{$category_title}</td>";
                
                echo "<td>$post_status</td>";
                echo "<td><img width='25' src='../images/$post_image'alt='image'></td>";
                echo "<td>$post_tags</td>";
                if($post_comment_count == 0){
                    echo "<td>$post_comment_count</td>";
                }
                else{
                     echo "<td><a href='post_comments.php?id=$post_id'>$post_comment_count</a></td>";
                }
                echo "<td>$post_date</td>";
                echo "<td><a href='../post.php?p_id=$post_id'>View Post</a></td>";
                echo "<td><a href='posts.php?reset=$post_id'>$post_view_count</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
                echo "<td><a href='posts.php?source=edit_post&edit={$post_id}'>edit</a></td>";
               
                    echo"</tr>";
                
               
            }
            
            if(isset($_GET['delete'])){
                $delete_id=mysqli_real_escape_string($connection,$_GET['delete']);
                $query="DELETE FROM posts WHERE post_id={$delete_id}";
                $delete_query=mysqli_query($connection,$query);
                if($delete_query){
                    $query_comm="DELETE FROM comments WHERE comment_post_id=$delete_id";
                    $delete_comment_id=mysqli_query($connection,$query_comm);
                    if(!$delete_comment_id){
                        die("query failed".mysqli_error($delete_comment_id));
                    }
                }
                header("LOCATION: posts.php");

                
            }
            
        
     ?>
       
    </tbody>
</table>
</form>