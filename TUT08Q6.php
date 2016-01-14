<?php
  $server_name = $_SERVER['SERVER_NAME'];
  $IP_address = $_SERVER['REMOTE_ADDR'];
  $Port_number = $_SERVER['SERVER_PORT'];
  $file_name = $_SERVER['PHP_SELF'];

  echo "Server name: $server_name<br>
        IP address: $IP_address <br>
        Port number: $Port_number <br>
        File name: $file_name
  ";
 ?>
