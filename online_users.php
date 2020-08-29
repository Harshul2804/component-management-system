<?php include "includes/header.php"; ?>
<?php include "includes/db.php"; ?>
<div id="wrapper">
<?php
global $connection;
$query="SELECT * FROM users_online";
$send_query=mysqli_query($connection,$query);
if(!$send_query){
  die("QUERRY FAILED".mysqli_error($connection));
}
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">sn</th>
      <th scope="col">ID</th>
      <th scope="col">Session</th>
      <th scope="col">Username</th>
      <th scope="col">Time</th>

    </tr>
  </thead>
  <tbody>
  <?php 
  while($row=mysqli_fetch_assoc($send_query)){
    $id=$row['id'];
    $session=$row['session'];
    $time=$row['time'];
    $username=$row['username'];

    echo "<tr>";
      echo "<td>$id</td>";
      echo "<td>$session</td>";
      echo "<td>$time</td>";
      echo "<td>@$username</td>";
    echo "</tr>";
  }
  ?>
    
  </tbody>
</table>
</div>
<?php include "includes/footer.php"; ?>