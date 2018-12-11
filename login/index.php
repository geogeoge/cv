<?php
include "../koneksi/koneksi.php";
include "function.php";

$level = $_SESSION['level'];
if($level=="BILLING") {
  header('location:../apps/app_billing');
} else
if($level=="MARKETING") {
  header('location:../apps/app_marketing');
} else
if($level=="LABELING_ADMIN") {
  header('location:../apps/app_labeling/admin');
} else
if($level=="LABELING_TEKNISI") {
  header('location:../apps/app_labeling/teknisi');
} else
if($level=="ACCOUNTING") {
  header('location:../apps/app_accounting/accounting');
} else
if($level=="ACCOUNTING_ADMIN") {
  header('location:../apps/app_accounting/admin');
} else
if($level=="TOKO") {
  header('location:../apps/app_toko');
}  else
if($level=="ACCOUNTING_KASIR") {
  header('location:../apps/app_accounting/kasir');
} else
if($level=="ADMIN_MARKETING") {
  header('location:../apps/app_admin_marketing');
} else
if($level=="CHRISTELLA") {
  header('location:../apps/app_christella');
} else
if($level=="PENJADWALAN") {
  header('location:../apps/app_penjadwalan');
} else
if($level=="MONITORING") {
  header('location:../apps/app_mon_teknisi');
} else
if($level=="MANAGEMEN") {
  header('location:../apps/app_manager');
} else
if($level=="DEVELOPMENT") {
  header('location:../apps/app_development');
} 


$login = new login;

if(isset($_POST['tombol_login'])) {
    $login->proses_login();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Marketing">
    <link rel="icon" href="asset/img/favicon.ico">

    <title>SoloNet | Apps</title>

    <!-- Bootstrap core CSS -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="asset/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="asset/js/ie-emulation-modes-warning.js"></script>
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/bootstrap.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body background="asset/img/page-background.png">

    <div class="container">

      <form class="form-signin" method="post">
        <center><h2 class="form-signin-heading"><span class="glyphicon glyphicon-th-large"></span> Log In Apps </h2></center>
        <div class="input-group">
         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
         <input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" autofocus="on" required>
         </div>
        <div class="input-group" style="margin-top: 5px;">
         <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
         <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
         </div>
        <br />
        <button type="submit" name="tombol_login" class="btn btn-lg btn-success btn-block">Log In</button>
      </form>

    </div> <!-- /container -->
    
    <center><h5 class="form-signin">Copyright &copy; <a href="http://www.solonet.net.id" data-toggle="modal" target="blank">SoloNet</a> 2018</h5></center> 
    
     <!-- Modal Dialog Contact -->
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Contact Us</h4>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end dialog modal -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="asset/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
