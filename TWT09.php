<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style type=text/css>
      .bold {font-weight: bold}
    </style>

    <?php

       $buttonComplain = "<button name=\"button1\">Complain</button>";
       $buttonJob = "<button name=\"button2\">Job</button>";
       $viewComplaint = "<button name=\"button3\">View Complaints</button>";
       $viewApplication= "<button name=\"button4\">View Applications</button>";


       $menu = $buttonComplain.$buttonJob.$viewComplaint.$viewApplication;
       if (isset($_POST['button1'])){
         $body = '<table>
                  <tr><td class="bold">Name:</td><td><input type=text name=name></td></tr>
                  <tr><td class="bold">Email:</td><td><input type=text name=email></td></tr>
                  <tr><td class="bold">Tel No:</td><td><input type=text name=tel></td></tr>
                  <tr><td class="bold" valign=top>Complaint:</td><td>
                  <textarea name=complaint wrap=soft cols=35 rows=10>Write your complaint here...
                  </textarea>
                  </td></tr>
                  <tr><td></td><td><input name="submitComplain" type=submit value="Submit!">&nbsp;&nbsp;<input type=reset value=Clear></td></tr>
                  </table>
                  ';
       }
       else if (isset($_POST['button2'])){
         $body = '<table>
                  <tr><td width=20% class="bold">Name:</td><td><input type=text name=name></td></tr>
                  <tr><td class="bold">Tel. No:</td><td><input type=text name=tel></td></tr>
                  <tr><td class="bold">Email:</td><td><input type=text name=email></td></tr>
                  <tr valign=top><td class="bold">Type of Position Preferred:</td><td>
                  <select name=position>
                  <option value=Management>Management</a>
                  <option value=Technical>Technical</a>
                  <option value=Financial>Financial</a>
                  <option value=Clerical>Clerical</a>
                  </select>
                  </td></tr>
                  <tr valign=top><td class="bold">The Country You Would Like to Work:</td><td>
                  <input type=radio name=country value=Malaysia>Malaysia<br>
                  <input type=radio name=country value=Singapore>Singapore<br>
                  <input type=radio name=country value=Thailand>Thailand
                  </td></tr>
                  <tr><td class="bold">Submit Your Text Resume:</td><td><input name="userfile" type="file"></td></tr>
                  <tr><td></td><td><input name="submitJob"  type=submit value="Submit Application">&nbsp;&nbsp;<input type=reset value=Clear></td></tr>
                  </table>
                  ';
       }
       else if(isset($_POST['submitComplain'])){

         if (!$connect = mysql_connect("localhost", "root", "")) {
           die(mysql_error());
         }

         if (!mysql_select_db("TWT_09_01", $connect)){
           $query = "CREATE DATABASE TWT_09_01;";
           mysql_query($query) or die(mysql_error());
           mysql_select_db("TWT_09_01", $connect);
           $query = "CREATE TABLE complaints(
                    name varchar(50),
                    email varchar(50),
                    tel varchar(50),
                    complaint varchar(255)
                    );";
          mysql_query($query) or die(mysql_error());
         }

         $query = "INSERT INTO `complaints` (`name`, `email`, `tel`, `complaint`) VALUES ('{$_POST['name']}', '{$_POST['email']}', '{$_POST['tel']}', '{$_POST['complaint']}');";
         mysql_query($query) or die(mysql_error());

         $body = "complaint submited!<br> $viewComplaint";

       }
       else if (isset($_POST['button3'])){
         if (!$connect = mysql_connect("localhost", "root", ""))
           die(mysql_error());

         if (!mysql_select_db("TWT_09_01", $connect))
          die(mysql_error());

        $query = "SELECT * FROM complaints;";
        $result = mysql_query($query) or die(mysql_error());

        $body = '';
        while ($row = mysql_fetch_row($result)){
          $body = $body . "<table>
                          <tr><td class=\"bold\">Name:</td><td>$row[0]</td></tr>
                          <tr><td class=\"bold\">Email:</td><td><a href=mailto:$row[1]>$row[1]</a></td></tr>
                      		<tr><td class=\"bold\">Tel:</td><td>$row[2]</td></tr>
                      		<tr><td class=\"bold\">Complaint:</td><td>$row[3]</td></tr>
                          <table><hr>";
        }
       }
       else if (isset($_POST['submitJob'])){
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

         $body = "Job application submited!";
       }
       else if (isset($_POST['button4'])){
         if (!$connect = mysql_connect("localhost", "root", "")) {
           die(mysql_error());
         }

         if (!mysql_select_db("TWT_09_02", $connect))
          die(mysql_error());

         $query = "SELECT * FROM `application`;";
         $result = mysql_query($query) or die(mysql_error());
         $body = '';
         while ($row = mysql_fetch_row($result)) {
           $body = $body . "<table>
                         		<tr><td class=\"bold\">Name:</td><td>$row[0]</td></tr>
                         		<tr><td class=\"bold\">Tel:</td><td>$row[1]</td></tr>
                         		<tr><td class=\"bold\">Email:</td><td><a href=mailto:$row[2]>$row[2]</a></td></tr>
                         		<tr><td class=\"bold\">Position Preferred:</td><td>$row[3]</td></tr>
                         		<tr><td class=\"bold\">Prefer Work in:</td><td>$row[4]</td></tr>
                         		<tr><td class=\"bold\">Resume:</td><td><a href=resume/$row[5]>$row[5]</a></td></tr>
                         		</table><hr>";
         }

       }
       else {
         $body = "Nothing selected";
       }
     ?>
  </head>
  <body>
    <form ENCTYPE=multipart/form-data action="TWT09.php" method="POST">
    <table>
      <tr>
        <td>
          <?php
            print($menu);
           ?>
        </td>
      </tr>
      <tr>
        <td>
          <?php
            print($body);
           ?>
        </td>
      </tr>
    </table>
    </form>
  </body>
</html>
