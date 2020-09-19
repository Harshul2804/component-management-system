<?php  include "includes/header.php"; ?>
    <!-- Navigation -->
 <?php  include "includes/navigation.php"; ?>
<div class="container bg-dark">
    <div class="col-xs-6 col-xs-offset-3">
    <h1 style="background:rgba(255,255,255, 0.5); border-radius:2%" >CONTACT</h1>
    
    <div class="form-wrap" style="background:rgba(255,255,255, 0.5); border-radius:2%;">
            <form role="form" action="" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="enter your subject">
                        </div>
                        <div class='form-group'>
                            <textarea name="body" class="form-control" id="body"></textarea>
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary" value="Submit">
                    </form>
                </div>
            </div> <!-- /.col-xs-12 -->
            
        <hr>
</div>
<?php include "includes/footer.php";?>

<?php
if(isset($_POST['submit'])){
    $to='harshul2804@gmail.com';
    $subject=$_POST['subject'];
    $body=$_POST['body'];
    $header=$_POST['email'];
    
    mail($to, $subject, $body, $header);
}
?>
