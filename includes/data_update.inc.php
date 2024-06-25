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
         foreach($message as $key => $value) {
            $key = $key + 1;
            $value = htmlspecialchars($value);
             echo "<tr>
                <td class='text-center' style='width:10px;'>$key</td>
                <td>$value</td>
               </tr>";
         }
      }
   }
}
?>