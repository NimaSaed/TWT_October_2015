<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $Names = array('Emir', 'Umair', 'Wong', 'Lim', 'Jane','Kavita');
      $count = count($Names);
      echo "There are $count names:<br>";
      for ($i = 0 ; $i < $count ; $i++){
        echo "$Names[$i]<br>";
      }
      sort($Names);
      echo "There are $count names in order:<br>";
      for ($i = 0 ; $i < $count ; $i++){
        echo "$Names[$i]<br>";
      }
     ?>
  </body>
</html>
