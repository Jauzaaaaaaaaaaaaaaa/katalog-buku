<?php
include "auth.php";
include "koneksi.php";

$id = (int) ($_POST['id'] ?? 0);
$judul = trim($_POST['judul'] ?? '');
$penulis = trim($_POST['penulis'] ?? '');
$penerbit = trim($_POST['penerbit'] ?? '');
$tahun_terbit = (int) ($_POST['tahun_terbit'] ?? 0);
$stok = (int) ($_POST['stok'] ?? 0);

if ($id <= 0 || $judul == "" || $penulis == "" || $penerbit == "" || $tahun_terbit <= 0 || $stok < 0) {
    die("Data tidak valid.");
}

$stmt = $conn->prepare("UPDATE books SET judul = ?, penulis = ?, penerbit = ?, tahun_terbit = ?, stok = ? WHERE id = ?");
$stmt->bind_param("sssiii", $judul, $penulis, $penerbit, $tahun_terbit, $stok, $id);
$stmt->execute();

header("Location: index.php");
exit;
?>