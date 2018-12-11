<?php
class login {
	function proses_login() {
		include "../koneksi/koneksi.php";

		$username=$_POST['username'];
	    $password=$_POST['password'];

	    //untuk mencegah MySQL injection
	    $username= stripcslashes($username);
	    $password= stripcslashes($password);
	    
	    $query = mysqli_query($koneksi,"SELECT * FROM master_login WHERE username = '$username' AND password = '$password'") or die(mysql_error());
	    $menampilkan_query = mysqli_fetch_array($query);
	    $menghitung_query = mysqli_num_rows($query);
	    if ($menghitung_query > 0)
	    {		
        	$_SESSION['id_user']=$menampilkan_query['id_user'];
        	$_SESSION['nama_user']=$menampilkan_query['nama_user'];
        	$_SESSION['username']=$menampilkan_query['username'];
        	$_SESSION['level']=$menampilkan_query['level'];
	     	header('location:../');
	    } else {
	        echo " <br><center><font color= 'red' size='3'>Username atau Password yang anda masukan SALAH !</center></font>";
	    } 	
	}
}
?>