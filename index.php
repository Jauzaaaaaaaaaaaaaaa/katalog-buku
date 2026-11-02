<?php
include "auth.php";
include "koneksi.php";

$result = $conn->query("SELECT * FROM books ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
<link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&family=Libre+Caslon+Text:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="atelier/atelier.css">
<link rel="stylesheet" href="atelier/theme.css">
<script src="atelier/theme.js"></script>
<script src="atelier/atelier.js"></script>
</head>
<body>
    <h2>Data Buku</h2>

    <p>
        Selamat datang, <b><?php echo htmlspecialchars($_SESSION['user_name']); ?></b>
        | <a href="logout.php">Logout</a>
    </p>

    <p>
        <a href="tambah.php">+ Tambah Buku</a>
    </p>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>
            <?php $no = 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['judul']); ?></td>
                    <td><?php echo htmlspecialchars($row['penulis']); ?></td>
                    <td><?php echo htmlspecialchars($row['penerbit']); ?></td>
                    <td><?php echo htmlspecialchars($row['tahun_terbit']); ?></td>
                    <td><?php echo htmlspecialchars($row['stok']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <form action="hapus.php" method="POST" class="del-form" onsubmit="return confirm('Yakin ingin menghapus data ini?')"><?php echo csrf_field(); ?><input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>"><button type="submit">Hapus</button></form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Data buku belum ada.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>