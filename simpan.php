<?php
include "auth.php";
include "koneksi.php";

$judul = trim($_POST['judul'] ?? '');
$penulis = trim($_POST['penulis'] ?? '');
$penerbit = trim($_POST['penerbit'] ?? '');
$tahun_terbit = (int) ($_POST['tahun_terbit'] ?? 0);
$stok = (int) ($_POST['stok'] ?? 0);

if ($judul == "" || $penulis == "" || $penerbit == "" || $tahun_terbit <= 0 || $stok < 0) {
    die("Data yang diinput tidak valid.");
}

$stmt = $conn->prepare("INSERT INTO books (judul, penulis, penerbit, tahun_terbit, stok) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssii", $judul, $penulis, $penerbit, $tahun_terbit, $stok);
$stmt->execute();

header("Location: index.php");
exit;
?>