<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Taman Bingkat</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>✏️ EDIT DATA BUKU</h1>
            <p>Taman Bingkat</p>
        </div>

        <div class="nav">
            <a href="index.php">Beranda</a>
            <a href="tambah_buku.php">Tambah Buku</a>
        </div>

        <div class="content">
            <?php
            include 'koneksi.php';

            // Ambil ID dari URL
            $id = $_GET['id'];

            // Ambil data buku
            $query = "SELECT * FROM tb_buku WHERE id_buku = '$id'";
            $result = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result);

            if (!$data) {
                echo "<div class='alert-error'>Data tidak ditemukan!</div>";
                echo "<a href='index.php'>Kembali ke Beranda</a>";
                exit;
            }

            // Proses update data
            if (isset($_POST['update'])) {
                $judul = mysqli_real_escape_string($conn, $_POST['judul']);
                $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
                $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
                $tahun = $_POST['tahun'];
                $kategori = $_POST['kategori'];
                $stok = $_POST['stok'];
                $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

                $query_update = "UPDATE tb_buku SET 
                                judul='$judul', 
                                pengarang='$pengarang', 
                                penerbit='$penerbit', 
                                tahun_terbit='$tahun', 
                                kategori='$kategori', 
                                stok='$stok', 
                                deskripsi='$deskripsi' 
                                WHERE id_buku='$id'";

                if (mysqli_query($conn, $query_update)) {
                    echo "<div class='alert-success'>Data buku berhasil diupdate!</div>";
                    // Refresh data
                    $result = mysqli_query($conn, $query);
                    $data = mysqli_fetch_assoc($result);
                } else {
                    echo "<div class='alert-error'>Error: " . mysqli_error($conn) . "</div>";
                }
            }
            ?>

            <form method="POST" action="" class="buku-form">
                <div class="form-group">
                    <label>Judul Buku <span class="required">*</span></label>
                    <input type="text" name="judul" required value="<?php echo $data['judul']; ?>">
                </div>

                <div class="form-group">
                    <label>Pengarang <span class="required">*</span></label>
                    <input type="text" name="pengarang" required value="<?php echo $data['pengarang']; ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Penerbit <span class="required">*</span></label>
                        <input type="text" name="penerbit" required value="<?php echo $data['penerbit']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Tahun Terbit <span class="required">*</span></label>
                        <select name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            <?php
                            for ($tahun = date('Y'); $tahun >= 1980; $tahun--) {
                                $selected = ($tahun == $data['tahun_terbit']) ? "selected" : "";
                                echo "<option value='$tahun' $selected>$tahun</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori <span class="required">*</span></label>
                        <select name="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php
                            $kategori_list = ['Fiksi', 'Non-Fiksi', 'Pendidikan', 'Anak-anak', 'Referensi', 'Komik', 'Lainnya'];
                            foreach ($kategori_list as $kat) {
                                $selected = ($kat == $data['kategori']) ? "selected" : "";
                                echo "<option value='$kat' $selected>$kat</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Stok <span class="required">*</span></label>
                        <input type="number" name="stok" min="1" value="<?php echo $data['stok']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="4"><?php echo $data['deskripsi']; ?></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn-simpan">Update Buku</button>
                    <a href="index.php" class="btn-batal">Kembali</a>
                </div>
            </form>
        </div>

        <div class="footer">
            <p>Sistem Informasi Katalog Buku - Taman Bingkat</p>
        </div>
    </div>
</body>

</html>
<?php mysqli_close($conn); ?>