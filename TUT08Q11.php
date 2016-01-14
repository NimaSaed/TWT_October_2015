<?php
  function revNum($num){
    $reNum = "";
    for ($i = 1 ; $i <= strlen($num) ; $i++){
      $reNum = $reNum . substr($num,-$i,1);
    }
    return $reNum;
  }

  $number = 13221;

  $reVers = revNum($number);

  if ($reVers == $number)
  echo "Yes";
  else
  echo "No";

 ?>
