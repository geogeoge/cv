<?php
include "koneksi/koneksi.php";
$maintenance = "0";
if($maintenance=="1"){
	include "maintenance.php";
} else {
	$level = $_SESSION['level'];
	if($level=="ACCOUNTING") {
		header('location:apps/app_accounting/');
	} else
	if($level=="ACCOUNTING_ADMIN") {
		header('location:apps/app_admin_accounting/');
	} else
	if($level=="KAS_KECIL") {
	  header('location:apps/app_kas/');
	}else {
		header('location:login');
	}
}
?>