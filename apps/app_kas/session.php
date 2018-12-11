<?php
session_start();
if(!($_SESSION['level']=="KAS_KECIL")) {
	header('location:../../login/');
}
?>