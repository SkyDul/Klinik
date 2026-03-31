<?php
require 'config.php';

// Proses Tambah Data
if (isset($_POST['tambah'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $umur = mysqli_real_escape_string($conn, $_POST['umur']);
    $diagnosa = mysqli_real_escape_string($conn, $_POST['diagnosa']);

    $query = "INSERT INTO pasien (nama, umur, diagnosa) VALUES ('$nama', '$umur', '$diagnosa')";
    if (mysqli_query($conn, $query)) {
        header("Location: pasien.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Proses UPDATE Data
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $umur = mysqli_real_escape_string($conn, $_POST['umur']);
    $diagnosa = mysqli_real_escape_string($conn, $_POST['diagnosa']);

    $query = "UPDATE pasien SET nama='$nama', umur='$umur', diagnosa='$diagnosa' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: pasien.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $id = mysqli_real_escape_string($conn, $_GET['hapus']);
    $query = "DELETE FROM pasien WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: pasien.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>