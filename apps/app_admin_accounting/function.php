<?php
class select {
  function select_master_jenis_account() {    
  	include "../../koneksi/koneksi.php";

  	$query=mysqli_query($koneksi,"SELECT * FROM master_jenis_account ORDER BY `master_jenis_account`.`master_jenis_account` ASC");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_jenis_account($data_cari) {    
  	include "../../koneksi/koneksi.php";

  	$query=mysqli_query($koneksi,"SELECT * FROM jenis_account LEFT JOIN master_jenis_account ON jenis_account.id_master_jenis_account=master_jenis_account.id_master_jenis_account WHERE jenis_account.jenis_account LIKE '%$data_cari%' ORDER BY `jenis_account`.`id_master_jenis_account` ASC");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_jenis_account_left_join_master_jenis_account_where($data) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM jenis_account LEFT JOIN master_jenis_account ON jenis_account.id_master_jenis_account=master_jenis_account.id_master_jenis_account WHERE jenis_account.jenis_account LIKE '%$data%'");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_account() {    
  	include "../../koneksi/koneksi.php";

  	$query=mysqli_query($koneksi,"SELECT * FROM account ORDER BY id_account");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }

  function select_account_left_join_jenis_account($id_jenis_account) {    
    include "../../koneksi/koneksi.php";

    $query=mysqli_query($koneksi,"SELECT * FROM account LEFT JOIN jenis_account ON account.id_jenis_account=jenis_account.id_jenis_account WHERE account.id_jenis_account='$id_jenis_account' ORDER BY account.id_account");
    while($tampil=mysqli_fetch_array($query))
    $data[]=$tampil;
    return $data;
  }
}

class insert {
  function insert_jenis_account() {
    include "../../koneksi/koneksi.php";

    $jenis_account = $_POST['jenis_account'];
    $id_master_jenis_account = $_POST['id_master_jenis_account'];
    mysqli_query($koneksi,"INSERT INTO `jenis_account`(`jenis_account`, `id_master_jenis_account`) VALUES ('$jenis_account', '$id_master_jenis_account')");
  }

  function insert_account() {
    include "../../koneksi/koneksi.php";

    $nama_account = $_POST['nama_account'];
    $id_jenis_account = $_POST['id_jenis_account'];
    mysqli_query($koneksi,"INSERT INTO `account`(`nama_account`, `id_jenis_account`) VALUES ('$nama_account', '$id_jenis_account')");
  }
}

class edit {
  function edit_jenis_account() {
    include "../../koneksi/koneksi.php";

    $id_jenis_account = $_POST['id_jenis_account'];
    $jenis_account = $_POST['jenis_account'];
    $id_master_jenis_account = $_POST['id_master_jenis_account'];
    mysqli_query($koneksi,"UPDATE `jenis_account` SET `jenis_account`='$jenis_account',`id_master_jenis_account`='$id_master_jenis_account' WHERE`id_jenis_account`='$id_jenis_account'");
  }

  function edit_account() {
    include "../../koneksi/koneksi.php";

    $id_account = $_POST['id_account'];
    $nama_account = $_POST['nama_account'];
    $id_jenis_account = $_POST['id_jenis_account'];
    mysqli_query($koneksi,"UPDATE `account` SET `nama_account`='$nama_account',`id_jenis_account`='$id_jenis_account' WHERE `id_account`='$id_account'");
  }
}

class delete {
  function delete_jenis_account() {
    include "../../koneksi/koneksi.php";

    $id_jenis_account = $_POST['id_jenis_account'];
    mysqli_query($koneksi,"DELETE FROM `jenis_account` WHERE`id_jenis_account`='$id_jenis_account'");
  }

  function delete_account() {
    include "../../koneksi/koneksi.php";

    $id_account = $_POST['id_account'];
    mysqli_query($koneksi,"DELETE FROM `account` WHERE`id_account`='$id_account'");
  }
}

$select = new select;
$insert = new insert;
$edit = new edit;
$delete = new delete;
?>