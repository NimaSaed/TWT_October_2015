<?php

  $num = 1234;

  $sum = 0;

  for ($i = 0 ; $i< strlen($num) ; $i++){

    $sum = $sum + substr($num,$i,1);
  }

  echo "$sum";

 ?>
