<?php

// $name = $_POST['name'];
// $email = $_POST['email'];
extract($_POST);

 if(!$connect = mysql_connect("localhost","root",""))
 die(mysql_error());

if (!mysql_select_db("TWT09Q1",$connect)){
  $query = "CREATE DATABASE TWT09Q1";
  mysql_query($query) or die(mysql_error());
  mysql_select_db("TWT09Q1",$connect);
  $query = "CREATE TABLE complaints(
            name varchar(50),
            email varchar(50),
            tel varchar(50),
            complaint varchar(255)
            );";

  mysql_query($query) or die(mysql_error());
}

$query = "INSERT INTO `complaints` (`name`,`email`,`tel`,`complaint`) VALUES ('$name','$email','$tel','$complaint')";
mysql_query($query) or die(mysql_error());



 ?>
