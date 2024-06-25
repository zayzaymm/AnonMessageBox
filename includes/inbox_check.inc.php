<?php 
if (isset($_COOKIE["uid"]) and $_COOKIE["uid"] != "expired") {
   $uid = mysqli_real_escape_string($conn,$_COOKIE["uid"]);
   if (isset($_GET["delete"])) {
     $sql = "delete from data where uid='$uid'";
     $result = $conn->query($sql);
   }
   $sql = "select * from data where uid='$uid'";
   $result = $conn->query($sql);
   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $title = htmlspecialchars($row["title"]);
      $message = json_decode($row["message"]);
      $count = count($message);
      $link = $row["link"];
      $expired_time = $row["expired_time"];
      $expired_date = $row["expired_date"];
      $limit = $row["max_count"];
      $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https://" : "http://";
      $share_url = $protocol.$_SERVER["HTTP_HOST"]."/message.php?m=$link";
      //7 days expire
      if (time() > $expired_date) {
         setcookie("uid","expired");
         inbox_template("expired.png","The provided link is already expired!");
         exit();
      }
   } else {
      echo "<script>window.location.href = 'index.php';</script>";
      exit();
   }
} else {
   inbox_template("expired.png","The provided link is already expired!");
   exit();
}
?>