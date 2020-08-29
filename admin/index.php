   <?php include "includes/admin_header.php"; ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

    <?php
if(isset($_SESSION['user_role'])){
if($_SESSION['user_role']=='Admin'){
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to <?php echo $_SESSION['user_role'] ?>
                            
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>

                    </div>
                </div>
                <!-- /.row -->

           <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                  <div class='huge'>
                      <?php 
                        $query="SELECT * FROM posts";
                        $send_query=mysqli_query($connection,$query);
                        $post_count=mysqli_num_rows($send_query);
                                echo $post_count;
                                
                        ?>
                  </div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                     <div class='huge'>
                         <?php 
                        $query="SELECT * FROM comments";
                        $send_query=mysqli_query($connection,$query);
                        $comment_count=mysqli_num_rows($send_query);
                                echo $comment_count;
                                
                        ?>
                     </div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <div class='huge'>
                        <?php 
                        $query="SELECT * FROM users";
                        $send_query=mysqli_query($connection,$query);
                        $users_count=mysqli_num_rows($send_query);
                                echo $users_count;
                                
                        ?>
                    </div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class='huge'>
                            <?php 
                        $query="SELECT * FROM categories";
                        $send_query=mysqli_query($connection,$query);
                        $categories_count=mysqli_num_rows($send_query);
                                echo $categories_count;
                                
                        ?>
                        </div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
            <div class="row">
               <?php
                $query="SELECT * FROM posts WHERE post_status='draft'";
                $draft_query=mysqli_query($connection,$query);
                $draft_count=mysqli_num_rows($draft_query);
                
                $query="SELECT * FROM comments WHERE comment_status='Unapproved'";
                $pending_comments_query=mysqli_query($connection,$query);
                $pending_comments=mysqli_num_rows($pending_comments_query);
                
                $query="SELECT * FROM users WHERE user_role='Suscriber'";
                $user_role_query=mysqli_query($connection,$query);
                $suscriber_count=mysqli_num_rows($user_role_query);
                
                 $query="SELECT * FROM posts WHERE post_status='published'";
                $post_published_query=mysqli_query($connection,$query);
                $published_posts=mysqli_num_rows($post_published_query);
                
                ?>
    
     <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          <?php 
            $text_row=['All posts', 'Active posts','Draft posts', 'Active Comments', 'Pending Comments','Users', 'Suscriber','Categories'];
            $count_row=[$post_count, $published_posts, $draft_count, $comment_count, $pending_comments, $users_count, $suscriber_count, $categories_count];
            for($i = 0; $i < 8; $i++){
                echo "['{$text_row[$i]}'".","."'{$count_row[$i]}'],";
            }
            ?>
        ]);

        var options = {
          width: 1200,
          legend: { position: 'none' },
          chart: {
            title: 'STATISTICS',
            subtitle: 'for Admin' },
          axes: {
            x: {
              0: { side: 'top', label: 'stats'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      };
    </script>
     
           <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
             
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   <?php include "includes/admin_footer.php"; ?>
   <?php
}else{
    echo "<h1>ACCESS DENIED</h1>";
}   
}
        else{
            echo "<h1>TRY LOGGING_IN OR RE_REGISTERING</h1>";
        }
?>
   
  