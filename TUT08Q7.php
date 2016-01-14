<?php

  $old_file_name = "try.html";

  $new_file_name = preg_replace("/.html/", ".php" , $old_file_name);
  $changed = rename($old_file_name, $new_file_name);

  if ($changed) echo "SUC";
  else echo "Failed";
 ?>
