<?php
include 'config.php';


if (isset($_POST['simpan'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];

    if ($id == "") {
        $query = "INSERT INTO data_mahasiswa (nim, nama, jenis_kelamin, jurusan) VALUES ('$nim', '$nama', '$jenis_kelamin', '$jurusan')";
    } else {
        $query = "UPDATE data_mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan' WHERE nim='$id'";
    }

    mysqli_query($conn, $query);
    header("Location: index.php");
    exit();
}


if (isset($_GET['hapus'])) {
    $nim = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM data_mahasiswa WHERE nim='$nim'");
    header("Location: index.php");
    exit();
}


$result = mysqli_query($conn, "SELECT * FROM data_mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">CRUD Mahasiswa</h2>

        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="id" value="<?= isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim" required value="<?= isset($_GET['edit']) ? $_GET['nim'] : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required value="<?= isset($_GET['edit']) ? $_GET['nama'] : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div>
                            <input type="radio" id="laki" name="jenis_kelamin" value="Laki-laki" required 
                            <?= isset($_GET['edit']) && $_GET['jenis_kelamin'] == "Laki-laki" ? 'checked' : ''; ?>>
                            <label for="laki">Laki-laki</label>

                            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" required 
                            <?= isset($_GET['edit']) && $_GET['jenis_kelamin'] == "Perempuan" ? 'checked' : ''; ?>>
                            <label for="perempuan">Perempuan</label>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" name="jurusan" required value="<?= isset($_GET['edit']) ? $_GET['jurusan'] : ''; ?>">
                    </div>

                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>

        <h3 class="mt-4">Daftar Mahasiswa</h3>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['jenis_kelamin']; ?></td>
                    <td><?= $row['jurusan']; ?></td>
                    <td>
                        <a href="?edit=<?= $row['nim']; ?>&nim=<?= $row['nim']; ?>&nama=<?= $row['nama']; ?>&jenis_kelamin=<?= $row['jenis_kelamin']; ?>&jurusan=<?= $row['jurusan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?hapus=<?= $row['nim']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
