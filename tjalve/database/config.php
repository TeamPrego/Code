<?php  
  $dbhost = "localhost";
  $dbuser = "root";
  //$dbpass="";
  $dbpass = "root";
  $dbname = "submission";
  
  $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>