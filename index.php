<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Taman Bingkat</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📚 PERANCANGAN SISTEM INFORMASI KATALOG BUKU</h1>
            <h2>Taman Bingkat</h2>
            <p>Jl. Contoh No. 123, Kota Contoh</p>
        </div>

        <!-- Navigasi -->
        <div class="nav">
            <a href="index.php" class="active">Beranda</a>
            <a href="tambah_buku.php">Tambah Buku</a>
        </div>

        <!-- Konten Utama -->
        <div class="content">
            <h3>Daftar Koleksi Buku</h3>

            <?php
            include 'koneksi.php';

            // Ambil semua data buku
            $query = "SELECT * FROM tb_buku ORDER BY id_buku DESC";
            $result = mysqli_query($conn, $query);

            // Cek apakah ada data
            if (mysqli_num_rows($result) > 0) {
                ?>

                <table class="buku-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $no++; ?>
                                </td>
                                <td><strong>
                                        <?php echo $row['judul']; ?>
                                    </strong></td>
                                <td>
                                    <?php echo $row['pengarang']; ?>
                                </td>
                                <td>
                                    <?php echo $row['penerbit']; ?>
                                </td>
                                <td>
                                    <?php echo $row['tahun_terbit']; ?>
                                </td>
                                <td>
                                    <?php echo $row['kategori']; ?>
                                </td>
                                <td class="stok">
                                    <?php echo $row['stok']; ?>
                                </td>
                                <td class="aksi">
                                    <a href="edit_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn-edit">Edit</a>
                                    <a href="hapus_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn-hapus"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php if (!empty($row['deskripsi'])) { ?>
                                <tr>
                                    <td colspan="8" class="deskripsi">
                                        <small><em>Deskripsi:
                                                <?php echo $row['deskripsi']; ?>
                                            </em></small>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>

                <?php
            } else {
                echo "<p class='info'>Belum ada data buku. Silakan tambah buku baru.</p>";
            }
            ?>

            <div class="info-total">
                <?php
                $query_count = "SELECT COUNT(*) as total FROM tb_buku";
                $result_count = mysqli_query($conn, $query_count);
                $total = mysqli_fetch_assoc($result_count);
                echo "Total koleksi: <strong>" . $total['total'] . "</strong> judul buku";
                ?>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2026 Perancangan Sistem Informasi Katalog Buku Berbasis Web di Taman Bingkat</p>
            <p>Dibuat untuk keperluan Magang</p>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($conn); ?>