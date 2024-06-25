<?php 
if (isset($_COOKIE["uid"])) {
   $uid = mysqli_real_escape_string($conn,$_COOKIE["uid"]);
   $sql = "select expired_date from data where uid='$uid'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      echo "<script>window.location.href = 'inbox.php';</script>";
      exit();
   }
}
?>