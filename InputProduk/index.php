<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container mt-4">
        <h2 class="text-center">Tambah Data Barang</h2>
        <form action="" method="POST" class="border p-4 rounded shadow-sm">
            <div class="mb-3 d-flex">
                <label class="col-form-label me-2" style="width: 100px;">Nama Merek</label>
                <input type="text" name="nama_merek" class="form-control" required>
            </div>
            <div class="mb-3 d-flex">
                <label class="col-form-label me-2" style="width: 100px;">Warna</label>
                <input type="text" name="warna" class="form-control" required>
            </div>
            <div class="mb-3 d-flex">
                <label class="col-form-label me-2" style="width: 100px;">Jumlah</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="d-flex">
                <button type="submit" name="simpan" class="btn btn-primary me-2">Simpan</button>
                <button type="reset" class="btn btn-warning me-2">Ulangi</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

        <?php
        if (isset($_POST['simpan'])) {
            $nama_merek = $_POST['nama_merek'];
            $warna = $_POST['warna'];
            $jumlah = $_POST['jumlah'];

            $sql = "INSERT INTO printer (nama_merek, warna, jumlah) VALUES ('$nama_merek', '$warna', '$jumlah')";
            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-3'>Data berhasil disimpan.</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . mysqli_error($conn) . "</div>";
            }
        }
        ?>
    </div>
</body>
</html>
