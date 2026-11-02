<?php
include "auth.php";
include "koneksi.php";

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    die("ID tidak valid.");
}

$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data buku tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
<link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&family=Libre+Caslon+Text:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="atelier/atelier.css">
<link rel="stylesheet" href="atelier/theme.css">
<script src="atelier/theme.js"></script>
<script src="atelier/atelier.js"></script>
</head>
<body>
    <h2>Edit Buku</h2>

    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <p>
            <label>Judul</label><br>
            <input type="text" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required>
        </p>

        <p>
            <label>Penulis</label><br>
            <input type="text" name="penulis" value="<?php echo htmlspecialchars($data['penulis']); ?>" required>
        </p>

        <p>
            <label>Penerbit</label><br>
            <input type="text" name="penerbit" value="<?php echo htmlspecialchars($data['penerbit']); ?>" required>
        </p>

        <p>
            <label>Tahun Terbit</label><br>
            <input type="number" name="tahun_terbit" value="<?php echo htmlspecialchars($data['tahun_terbit']); ?>" min="1900" max="2100" required>
        </p>

        <p>
            <label>Stok</label><br>
            <input type="number" name="stok" value="<?php echo htmlspecialchars($data['stok']); ?>" min="0" required>
        </p>

        <button type="submit">Update</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>