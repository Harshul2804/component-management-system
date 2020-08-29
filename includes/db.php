<?php
// $db['db_host']='localhost';
// $db['db_user']='root';
// $db['db_pass']='';
// $db['db_name']='cms';

$db = array("db_host"=>"localhost", "db_user"=>"root", "db_pass"=>"", "db_name"=>"cms");

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