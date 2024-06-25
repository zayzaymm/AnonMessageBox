<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
     <meta name="theme-color" content="#002333">
     <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
     <title>Anon Message Box - Message</title>
     <?php include_once("includes/head.inc.php"); ?>
</head>
<body>
<?php 
include_once("conn.php");
include_once("includes/functions.inc.php");
$link = isset($_GET["m"]) ? mysqli_real_escape_string($conn,$_GET["m"]) : exit();
$sql = "select * from data where link='$link'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
   $row = mysqli_fetch_assoc($result);
   $title = htmlspecialchars($row["title"]);
   $message = json_decode($row["message"]);
   $count = count($message);
   $limit = $row["max_count"];
   $expired_time = $row["expired_time"];
   if (time() > $expired_time) {
      template("expired.png","The link you provided is already expired");
      exit();
   }
   if ($count == $limit) {
      template("restricted.png","Sorry, Maximum allowed messages reached !");
      exit();
   }
} else {
   template("unchained.png","Sorry, you provided incorrect or broken link!");
   exit();
}
if (isset($_POST["send"])) {
   $content = substr($_POST["content"],0,300);
   if ($count < $limit) {
      array_push($message,$content);
      $message = json_encode($message);
      $sql = "update data set message='$message' where link='$link'";
      $result = $conn->query($sql);
      alert("Your anonymous message is sent !","success");
   }
}
?>
<div class="min-vh-100">
   <?php include_once("includes/header.inc.php"); ?>
   <div class="description-box rounded shadow-sm text-center p-3">
      <h2 style="font-size:16px;"> Q - <?php echo $title; ?></h2>
      <form class="mt-5" action="" method="POST">
          <span id="counter">0/300</span>
          <textarea id="textarea" style="height:200px;max-width:400px;max-height:200px;" class="form-control d-block mx-auto" name="content" placeholder="Write your anonymous Message"></textarea>
          <input class="btn btn-outline-info mt-2" type="submit" name="send" value="Message">
      </form>
   </div>
</div>
<script>
var wordCount = document.querySelector("#counter");
var textarea = document.querySelector("#textarea");
var max = 300;
textarea.addEventListener("input", function() {
  var text = textarea.value;
  var textLength = text.length;
  if (textLength >= max) {
     textarea.value = text.slice(0,max);
  }
  wordCount.innerHTML = textarea.value.length + "/" + "300";
});
</script>

<?php include_once("includes/footer.inc.php"); ?>
</body>
</html>