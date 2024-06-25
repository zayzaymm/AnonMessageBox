<?php
function inbox_template($img,$text) {
echo "
<!DOCTYPE html>
<html lang='en'>
<head>
     <meta charset='utf-8'>
     <meta name='theme-color' content=''>
     <meta name='viewport' content='width=device-width,initial-scale=1,user-scalable=no'>
     <title>Anon Message Box - Message</title>";
     include_once('includes/head.inc.php'); 
echo "</head>
<body>
<div class='min-vh-100'>";
include_once('includes/header.inc.php');
echo "<div class='description-box rounded shadow-sm p-3 text-center'>
      <img class='d-block mx-auto' src='assets/icons/$img'>
      <p class='mt-2' style='font-size:16px;'>$text</p>
      <a class='text-decoration-none btn btn-outline-primary' href='index.php'>Create Link</a>
   </div>
</div>";
include_once('includes/footer.inc.php');
echo "</body>
</html>";
}
function template($img,$text) {
echo "
<div class='min-vh-100'>";
include_once('includes/header.inc.php');
echo "<div class='description-box rounded shadow-sm p-3 text-center'>
      <img class='d-block mx-auto' src='assets/icons/$img'>
      <p class='mt-2' style='font-size:16px;'>$text</p>
      <a class='text-decoration-none btn btn-outline-primary' href='index.php'>Create Link</a>
   </div>
</div>";  
include_once('includes/footer.inc.php');
}
function alert($text,$icon) {
echo "<script>
swal({
  text: '$text',
  icon: '$icon',
  });
</script>";
}
function alert_redirect($text,$icon,$link) {
echo "
<script>
swal({
   text: '$text',
   icon: '$icon',
   }).then(function(){
    window.location = '$link';
});
</script>";
}
function alert_confirm_redirect($text,$icon,$link) {
echo "
swal({
  text: '$text',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
     window.location.href = '$link';
  }
})";
}
?>