<?php
include "auth.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Buku</title>
<link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&family=Libre+Caslon+Text:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="atelier/atelier.css">
<link rel="stylesheet" href="atelier/theme.css">
<script src="atelier/theme.js"></script>
<script src="atelier/atelier.js"></script>
</head>
<body>
    <h2>Tambah Buku</h2>

    <form action="simpan.php" method="POST">
        <p>
            <label>Judul</label><br>
            <input type="text" name="judul" required>
        </p>

        <p>
            <label>Penulis</label><br>
            <input type="text" name="penulis" required>
        </p>

        <p>
            <label>Penerbit</label><br>
            <input type="text" name="penerbit" required>
        </p>

        <p>
            <label>Tahun Terbit</label><br>
            <input type="number" name="tahun_terbit" min="1900" max="2100" required>
        </p>

        <p>
            <label>Stok</label><br>
            <input type="number" name="stok" min="0" required>
        </p>

        <button type="submit">Simpan</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>