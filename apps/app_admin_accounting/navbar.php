<?php
include "../../koneksi/koneksi.php";
$sql="SELECT * FROM sale_register WHERE status_mon='BARU'";
    $query=mysqli_query($koneksi,$sql);  
    $data=mysqli_num_rows($query);
?>
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header" align="center"><font color="white">Menu Utama</font></li>
    <li><a href="?page=page_jenis_account"><i class="fa fa-file"></i> <span>Data Jenis Account</span></a></li>
    <li><a href="?page=page_account"><i class="fa fa-file"></i> <span>Data Account</span></a></li>
    <li><a href="../../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
  </ul>
</section>