<?php 
include_once("conn.php");
include_once("includes/delete.inc.php");
include_once("includes/index_check.inc.php");
include_once("includes/create_link.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
     <meta name="theme-color" content="#002333">
     <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
     <title>Anon Message Box</title>
     <?php include_once("includes/head.inc.php"); ?>
</head>
<body>
<div class="min-vh-100">
   <?php include_once("includes/header.inc.php"); ?>
   <!-- description box -->
   <div class="description-box rounded shadow-sm p-3">
      <img class="d-block mx-auto" style="width:64px;height:64px;" src="assets/icons/mail-box.png">
      <p class="mt-3">Anon Message Box lets you send and receive anonymous messages via unique links. To ensure a positive experience, please follow these rules:</p>
      <ul>
         <li>Be respectful and kind</li>
         <li>Protect privacy; avoid sharing sensitive info</li>
         <li>No spam or ads</li>
         <li>Comply with laws</li>
      </ul>
      <p><span class="badge bg-danger">Disclaimer</span> We do not moderate messages. Users are responsible for their content. Enjoy anonymous communication responsibly!</p>
      <form class="text-center" action="" method="POST">
          <textarea style='height:100px;' class="form-control" name="content" placeholder="Create Your Content" required=""></textarea><br/>
          <div class="d-flex align-items-center justify-content-center mt-2">
             <span class="badge bg-primary rounded-pill me-2">Expire in</span>
             <select class="form-select form-select-sm" name="expired_date">
                   <option value="86400">1 days</option>
                   <option value="172800">2 day</option>
                   <option value="259200">3 days</option>
             </select>
             <span class="badge bg-primary rounded-pill ms-2 me-2">Limit</span>
             <select class="form-select form-select-sm" name="limit">
                   <option value="10">10</option>
                   <option value="20">20</option>
                   <option value="30">30</option>
                   <option value="50">50</option>
                   <option value="100">100</option>
              </select>
         </div>
         <input class="btn btn-outline-primary mt-3 rounded-pill" type="submit" name="create" value="Create Link">
       </form>
   </div>
</div>
<?php include_once("includes/footer.inc.php"); ?>
</body>
</html>