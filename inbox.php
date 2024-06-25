<?php 
include_once("conn.php");
include_once("includes/functions.inc.php");
include_once("includes/inbox_check.inc.php");
?> 
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
     <meta name="theme-color" content="#002333">
     <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
     <title>Anon Message Box - Inbox</title>
     <?php include_once("includes/head.inc.php"); ?>
</head>
<body>
<div class="min-vh-100">
<?php 
include_once("includes/header.inc.php");
?>
   <div class="message-box rounded shadow-sm p-3">
      <div class="d-flex align-items-center justify-content-between">
          <button style="font-size:12px;" type="button" class="btn btn-primary position-relative">Messages
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo "<span id='message_counter'>".$count."</span> / ".$limit; ?>
            <span class="visually-hidden">unread messages</span>
            </span>
          </button>
          <div id="expire_date_counter" class="d-flex align-items-center justify-content-center">
       
          </div>
          <i onclick="delete_link();" class="fa-solid fa-trash"></i>
       </div>
       <div class="">
          <div class="m-0 p-0 mt-3">
             <h2 style="font-size:16px" class="text-center">Q - <?php echo $title; ?></h2>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-3">
             <input id="link" style="max-width:400px;" class="form-control" type="text" value="<?php echo $share_url; ?>">
             <input id="btn" type="button" class="btn btn-outline-info ms-1" value="Copy Link">
          </div>
        </div>
        <div class="text-center m-0 p-0">
           <h2 class="mt-2" style="font-size:18px;"><span class="badge bg-danger">Inbox</span></h2>
           <div id="expire_time_counter" class="d-flex align-items-center justify-content-center mb-2">
       
           </div>
        </div>
        <div class="shadow-sm" style="border-radius:10px;overflow:hidden;">
           <table style="margin:0;" class="table table-responsive table-bordered">
              <thead class="table-dark">
                <tr class="text-center">
                   <th style='width:10px;'>ID</th>
                   <th>Message</th>
                </tr>
              </thead>
              <tbody id="data">
                
              </tbody>
           </table>
        </div>
   </div>
</div>
<script>
function messageCounter() {
  $.get("includes/message_counter.inc.php?uid=<?php echo $_COOKIE['uid']; ?>",function(data,status){
    document.querySelector("#message_counter").innerHTML = data;
  });
setTimeout(messageCounter,1000);
}
messageCounter();
function fetchData() {
  $.get("includes/data_update.inc.php?uid=<?php echo $_COOKIE['uid']; ?>",function(data,status){
    document.querySelector("#data").innerHTML = data;
  });
setTimeout(fetchData,1000);
}
fetchData();
var btn = document.querySelector("#btn");
btn.addEventListener("click", function() {
  const link = document.querySelector("#link");
  link.select();
  link.setSelectionRange(0,99999);
  document.execCommand("copy");
  btn.value = "Copied";
});
function delete_link() {
swal({
  text: 'Delete link including all messages ?',
  icon: 'warning',
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
     window.location.href = 'inbox.php?delete=<?php echo $uid; ?>';
  }
})  
}
function timeUpdate(selector,timestamp) {
  var expire_time_counter = document.querySelector(selector);
  var exipred_time = timestamp;
  var now = Date.now() / 1000;
  var remainingTime = exipred_time - now;
  if (remainingTime <= 0) {
     expire_time_counter.innerHTML = "<i class='fa-solid fa-hourglass-end'></i><span class='badge bg-danger ms-2'>Expired</span>"
  } else {
     var days = Math.floor(remainingTime / (3600 * 24));
     remainingTime %= (3600 * 24);
     var hours = Math.floor(remainingTime / (60 * 60));
     remainingTime %= (60 * 60);
     var mins = Math.floor(remainingTime / 60);
     remainingTime %= 60;
     var sec = Math.floor(remainingTime);
     var time_counter = days + " D : " + hours + " hr : " + mins + " min : " + sec + " sec";
     expire_time_counter.innerHTML = `<i class='fa-solid fa-hourglass-half'></i><span class='badge bg-info ms-2'>${time_counter}</span>`;
  }
  setTimeout(function () {
    timeUpdate(selector,timestamp);
  },1000);
}
timeUpdate("#expire_date_counter",<?php echo $expired_date; ?>);
timeUpdate("#expire_time_counter",<?php echo $expired_time; ?>);
</script>

<?php include_once("includes/footer.inc.php"); ?>
</body>
</html>