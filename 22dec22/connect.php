<?php

 $sname= "localhost";
 $uname= "root";
 $password = ""; 
 $db_name = "interns22"; 
 
 $conn = mysqli_connect($sname, $uname, $password, $db_name); 
 if (!$conn) 
 {	
     echo mysqli_connect_error();
  }
  