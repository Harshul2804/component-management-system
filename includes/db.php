<?php
// $db['db_host']='localhost';
// $db['db_user']='root';
// $db['db_pass']='';
// $db['db_name']='cms';
//mysql://b87e69e77c65ed:2645acde@us-cdbr-east-02.cleardb.com/heroku_2ebed0234ea56fd?reconnect=true
//$db = array("db_host"=>"localhost", "db_user"=>"root", "db_pass"=>"", "db_name"=>"cms");
$db = array("db_host"=>"us-cdbr-east-02.cleardb.com", "db_user"=>"b87e69e77c65ed", "db_pass"=>"2645acde", "db_name"=>"heroku_2ebed0234ea56fd");

foreach($db as $key => $value){
    define(strtoupper($key),$value);
}
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if($connection){
   // echo 'we are connected.<br>';
}
//echo $_SERVER['SERVER_NAME'];
//echo "<br>";
//echo $_SERVER['HTTP_HOST'];
//echo"<br>";
//echo $_SERVER['HTTP_REFERER'];
//echo "<br>";
//echo $_SERVER['HTTP_USER_AGENT'];
//echo "<br>";
//echo $_SERVER['SCRIPT_NAME'];
?>