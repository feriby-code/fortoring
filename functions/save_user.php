<?php
require '../connection.php';

$name = addslashes($_POST['name']);

if (isset($_POST['admBtn'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    mysqli_query($conn, "INSERT INTO `account` (`id_account`, `nama`, `username`, `password`, `status`) VALUES (NULL, '$name', '$username', '$password', '1');;");
} elseif (isset($_POST['collStdBtn'])) {
    $nim = $_POST['nim'];
    $no_telepone = $_POST['no_telepone'];
    $email = $_POST['email'];
    $prodi = $_POST['prodi'];
    $fakultas = $_POST['fakultas'];
    $angkatan = $_POST['angkatan'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn, "INSERT INTO `college_student` (`nim_colstd`, `nama_colstd`, `no_telp_colstd`, `email_colstd`, `prodi_colstd`, `fakultas_colstd`, `angkatan_colstd`, `alamat_colstd`, `status_colstd`) VALUES ('$nim', '$name', '$no_telepone', '$email', '$prodi', '$fakultas', '$angkatan', '$alamat', '1')");
} elseif (isset($_POST['mgtBtn'])) {
    $nim = $_POST['nim'];
    $no_telepone = $_POST['no_telepone'];
    $angkatan = $_POST['angkatan'];
    $posisi = $_POST['posisi'];

    mysqli_query($conn, "INSERT INTO `management` (`nim_mgt`, `nama_mgt`, `no_telp_mgt`, `angkatan_mgt`, `posisi_mgt`, `status_mgt`) VALUES ('$nim', '$name', '$no_telepone', '$angkatan', '$posisi', '1');");
}

header("location: ../?pagination=add%users");
?>