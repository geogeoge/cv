<?php
$host_lama = 'localhost'; 
$user_lama = 'root';     // ini berlaku di xampp
$pass_lama = 'root';         // ini berlaku di xampp
$db_lama = 'coba_connectis_2016_2017';

$koneksi_lama = new mysqli($host_lama,$user_lama,$pass_lama,$db_lama) or die ('Koneksi Lama Bermasalah');

// Ini koneksi untuk maintenance
$host_baru = 'localhost'; 
$user_baru = 'root';     // ini berlaku di xampp
$pass_baru = 'root';         // ini berlaku di xampp
$db_baru = 'baru_connectis_2016_2017';
 
// melakukan koneksi ke database
$koneksi_baru = new mysqli($host_baru,$user_baru,$pass_baru,$db_baru) or die ('Koneksi Baru Bermasalah');
;

?>
