<?php 
include_once("../conn.php");
if (isset($_GET["uid"]) and $_GET["uid"] != "expired") {
   $uid = mysqli_real_escape_string($conn,$_GET["uid"]);
   $sql = "select * from data where uid='$uid'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $message = json_decode($row["message"]);
      $expired_date = $row["expired_date"];
      if ($expired_date > time()) {
         echo count($message);
      }
   }
}
?>