<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Taman Bingkat</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>➕ TAMBAH BUKU BARU</h1>
            <p>Taman Bingkat</p>
        </div>

        <div class="nav">
            <a href="index.php">Beranda</a>
            <a href="tambah_buku.php" class="active">Tambah Buku</a>
        </div>

        <div class="content">
            <?php
            include 'koneksi.php';

            // Proses tambah data
            if (isset($_POST['simpan'])) {
                $judul = mysqli_real_escape_string($conn, $_POST['judul']);
                $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
                $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
                $tahun = $_POST['tahun'];
                $kategori = $_POST['kategori'];
                $stok = $_POST['stok'];
                $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

                $query = "INSERT INTO tb_buku (judul, pengarang, penerbit, tahun_terbit, kategori, stok, deskripsi) 
                          VALUES ('$judul', '$pengarang', '$penerbit', '$tahun', '$kategori', '$stok', '$deskripsi')";

                if (mysqli_query($conn, $query)) {
                    echo "<div class='alert-success'>Buku berhasil ditambahkan!</div>";
                } else {
                    echo "<div class='alert-error'>Error: " . mysqli_error($conn) . "</div>";
                }
            }
            ?>

            <form method="POST" action="" class="buku-form">
                <div class="form-group">
                    <label>Judul Buku <span class="required">*</span></label>
                    <input type="text" name="judul" required placeholder="Masukkan judul buku">
                </div>

                <div class="form-group">
                    <label>Pengarang <span class="required">*</span></label>
                    <input type="text" name="pengarang" required placeholder="Nama pengarang">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Penerbit <span class="required">*</span></label>
                        <input type="text" name="penerbit" required placeholder="Nama penerbit">
                    </div>

                    <div class="form-group">
                        <label>Tahun Terbit <span class="required">*</span></label>
                        <select name="tahun" required>
                            <option value="">Pilih Tahun</option>
                            <?php
                            for ($tahun = date('Y'); $tahun >= 1980; $tahun--) {
                                echo "<option value='$tahun'>$tahun</option>";
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
                            <option value="Fiksi">Fiksi</option>
                            <option value="Non-Fiksi">Non-Fiksi</option>
                            <option value="Pendidikan">Pendidikan</option>
                            <option value="Anak-anak">Anak-anak</option>
                            <option value="Referensi">Referensi</option>
                            <option value="Komik">Komik</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Stok <span class="required">*</span></label>
                        <input type="number" name="stok" min="1" value="1" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi singkat buku"></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn-simpan">Simpan Buku</button>
                    <a href="index.php" class="btn-batal">Batal</a>
                </div>
            </form>
        </div>

        <div class="footer">
            <p>Sistem Informasi Katalog Buku - Taman Bingkat</p>
        </div>
    </div>
</body>

</html>
<?php if (isset($conn))
    mysqli_close($conn); ?>