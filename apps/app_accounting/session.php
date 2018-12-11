<?php
session_start();
if(!($_SESSION['level']=="ACCOUNTING")) {
	header('location:../../login/');
}
?>