
<?php

if (!$connect = mysql_connect("localhost", "root", "")) {
  die(mysql_error());
}

if (!mysql_select_db("TWT_09_02", $connect)){
  $query = "CREATE DATABASE TWT_09_02;";
  mysql_query($query) or die(mysql_error());
  mysql_select_db("TWT_09_02", $connect);
  $query = "create table application (
           name varchar (50),
           tel varchar (50),
           email varchar (50),
           position varchar (50),
           country varchar (50),
           resume varchar (50)
           );";
 mysql_query($query) or die(mysql_error());
}

$query = "SELECT COUNT(*) FROM application";
$result = mysql_query($query) or die(mysql_error());
$row = mysql_fetch_row($result);
$count = $row[0];

$extension = pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION);
$resume = "$count".".$extension";

extract($_POST);
$query = "INSERT INTO `application` (`name`, `tel`, `email`, `position`, `country`, `resume`) VALUES ('$name', '$tel', '$email', '$position', '$country', '$resume');";
mysql_query($query) or die(mysql_error());
mysql_close($connect);

copy($_FILES["userfile"]["tmp_name"], "./resume/$resume") or die("Error in copying file");


 ?>
