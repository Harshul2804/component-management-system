 <?php  include "includes/header.php"; ?>
    <!-- Navigation -->
 <?php  include "includes/navigation.php"; ?>
    <!-- Page Content -->
        <!-- <video autoplay muted loop id="myVideo" style="height:100%; width:100%; bottom-margin=20%">
        <source src="joker.mp4" type="video/mp4">
        </video> -->
        
<div class="container bg-dark">
    <div class="col-xs-6 col-xs-offset-3">
    <h1 style="background:rgba(255,255,255, 0.5); border-radius:2%" >Register</h1>
    
    <div class="form-wrap" style="background:rgba(255,255,255, 0.5); border-radius:2%;">
            <form role="form" action="index_timeline.php?register" method="post" id="login-form" autocomplete="off">
                       <div class="form-group">
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter firstname">
                        </div>
                        <div class="form-group">
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter lastname">
                        </div>
                        <div class="form-group">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary" value="Register">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
            
        <hr>


    <div class="col-xs-6 col-xs-offset-3">
       <h1 style="background:rgba(255,255,255,0.5); border-radius:2%">LOGIN</h1>
        <div class="form-wrap" style="background:rgba(255,255,255, 0.5); border-radius:2%;">
                    <form action="includes/login.php" method="post">
                    <div class="input-group">
                        <input placeholder="username" name="username" type="text" class="form-control">
                        <input  placeholder="password" name="password" type="password" class="form-control">
                        <span class="input-group-btn">
                            <button name="login" class="btn btn-primary" type="submit">
                             login
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                    </form>  <!--searchform-->
              </div>
            </div> <!-- /.col-xs-12 -->
</div>
<?php include "includes/footer.php";?>
