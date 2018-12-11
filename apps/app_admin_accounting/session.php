<?php
session_start();
if(!($_SESSION['level']=="ACCOUNTING_ADMIN")) {
	header('location:../../login/');
}
?>