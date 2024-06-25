<?php
$hostname = "127.0.0.1";
$username = "root";
$passsword = "";
$database = "anonmessagebox";
$conn = new mysqli($hostname,$username,$passsword,$database);
if ($conn->connect_error) {
   echo "Can't connect to the database";
}
?>