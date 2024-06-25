<?php 
if (isset($_POST["create"])) {
   $uid = "amb_".uniqid();
   $link = base64_encode(time());
   $link = str_replace("="," ",$link);
   $title = mysqli_real_escape_string($conn,$_POST["content"]);
   $message = json_encode(array());
   $expired_time = time() + $_POST["expired_date"];
   $expired_date = time() + (86400 * 7);
   $limit = $_POST["limit"];
   setcookie("uid",$uid,time() + (86400 * 7),"/");
   $sql = "insert into data(uid,link,title,message,expired_time,expired_date,max_count) values('$uid','$link','$title','$message',$expired_time,$expired_date,$limit)";
   $result = $conn->query($sql);
   if ($result === TRUE) {
      echo "<script>window.location.href ='inbox.php';</script>";
   } else {
      echo "<script>alert('Failed to create the link');</script>";
   }
}
?>