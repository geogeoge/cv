<?php
include "../../koneksi/koneksi.php";
$query_in=mysqli_query($koneksi,"SELECT * FROM `data_temp` WHERE `in_out`='i' AND `status`='belum'");
$jumlah_data_in=mysqli_num_rows($query_in);

$query_out=mysqli_query($koneksi,"SELECT * FROM `data_temp` WHERE `in_out`='o' AND `status`='belum'");
$jumlah_data_out=mysqli_num_rows($query_out);
?>
<section class="sidebar">
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header" align="center"><font color="white">Menu Posting</font></li>
    <li>
        <a href="?page=page_posting_kas_masuk">
            <i class="fa fa-download"></i>
            <span>Posting Kas Masuk</span>
            <?php
            if($jumlah_data_in>=1){
                ?>
                    <span class="pull-right-container">
                      <small class="label pull-right bg-red"><?php echo $jumlah_data_in; ?></small>
                    </span>
                <?php
            }
            ?>
        </a>
    </li>
    <li>
        <a href="?page=page_posting_kas_keluar">
            <i class="fa fa-upload"></i>
            <span>Posting Kas Keluar</span>
            <?php
            if($jumlah_data_out>=1){
                ?>
                    <span class="pull-right-container">
                      <small class="label pull-right bg-red"><?php echo $jumlah_data_out; ?></small>
                    </span>
                <?php
            }
            ?>
        </a>
    </li>
    <li><a href="?page=page_posting_jurnal_umum"><i class="fa fa-file"></i> <span>Posting Jurnal Umum</span></a></li>
    <li class="header" align="center"><font color="white">Menu Laporan</font></li>
    <li><a href="?page=page_jurnal_umum"><i class="fa fa-book"></i> <span>Jurnal Umum</span></a></li>
    <li><a href="?page=page_buku_besar"><i class="fa fa-book"></i> <span>Buku Besar</span></a></li>
    <li><a href="?page=page_laba_rugi"><i class="fa fa-book"></i> <span>Laba/Rugi</span></a></li>
    <li><a href="?page=page_perubahan_modal"><i class="fa fa-book"></i> <span>Perubahan Modal</span></a></li>
    <li><a href="?page=page_neraca"><i class="fa fa-book"></i> <span>Neraca</span></a></li>
    <li class="header" align="center"><font color="white">Menu Lain-Lain</font></li>
    <li><a href="../../logout.php"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
  </ul>
</section>