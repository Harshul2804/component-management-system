<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Status</th>
            <th>Date</th>
            <th>In response to</th>
            <th>Approve</th>
            <th>UnApprove</th>
            <th>Delete</th>
<!--            <th>Edit</th>-->
        </tr>
    </thead>
    <tbody>
        <?php
            global $connection;
            $query="SELECT * FROM comments";
            $select_posts=mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($select_posts )){
                  $comment_id=$row['comment_id'];
                  $comment_post_id=$row['comment_post_id'];
                  $comment_author=$row['comment_author'];
                  $comment_content=$row['comment_content'];
                  $comment_status=$row['comment_status'];
                  $comment_date=$row['comment_date'];  
                
                echo"<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_status</td>";
                echo "<td>$comment_date</td>";
                
                
                $query="SELECT * FROM posts WHERE post_id=$comment_post_id";
                $select_title=mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($select_title)){
                    $post_title=$row['post_title'];
                    $post_id=$row['post_id'];
                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }
                
                echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
                echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
                echo"</tr>";
            }
            
            if(isset($_GET['delete'])){
                $delete_id=$_GET['delete'];
                $query="DELETE FROM comments WHERE comment_id=$delete_id";
                $delete_query=mysqli_query($connection,$query);
                if(!$delete_query){
                    die("QUERY FAILED".mysqli_error($connection));
                    
                } 
                header("LOCATION: comments.php");
            }
        
            if(isset($_GET['unapprove'])){
                $unapprove_id=$_GET['unapprove'];
                $query="UPDATE comments SET comment_status='Unapproved' WHERE comment_id=$unapprove_id";
                $unapprove_query=mysqli_query($connection,$query);
                header("LOCATION: comments.php");
                
            }
          if(isset($_GET['approve'])){
                $unapprove_id=$_GET['approve'];
                $query="UPDATE comments SET comment_status='Approved' WHERE comment_id=$unapprove_id";
                $unapprove_query=mysqli_query($connection,$query);
                header("LOCATION: comments.php");
                
            }
        
     ?>
       
    </tbody>
</table>