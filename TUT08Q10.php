<?php

  function CalRaise($sal,$Ras){
      $result = $sal + $sal*$Ras/100;
    return $result;
  }


  $salary = 2000;
  $raise = 10;

  $total = CalRaise($salary,$raise);
  echo "$total";
 ?>
