<?php
    $conn = new mysqli('localhost', 'root', '', 'dbms');

    if ($conn->connect_error) {
        die("zalupa" . $conn->connect_error);
      }
      echo "norm";
?>