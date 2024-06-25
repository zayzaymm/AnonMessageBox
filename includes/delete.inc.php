<?php 
$sql = "select * from data";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
       $id = $row["id"];
       $expire_date = $row["expired_date"];
       if (time() > $expire_date) {
          $sql = "delete from data where id='$id'";
          $result = $conn->query($sql);
       }
   }
}
?>