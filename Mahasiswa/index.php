<?php
include 'config.php';

if (isset($_POST['simpan'])) {
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? mysqli_real_escape_string($conn, $_POST['jenis_kelamin']) : '';
    $jurusan = mysqli_real_escape_string($conn, $_POST['jurusan']);

    if (empty($_POST['id'])) {
        $query = "INSERT INTO data_mahasiswa (nim, nama, jenis_kelamin, jurusan) VALUES ('$nim', '$nama', '$jenis_kelamin', '$jurusan')";
    } else {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $query = "UPDATE data_mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan' WHERE nim='$id'";
    }

    mysqli_query($conn, $query);
    header("Location: index.php");
    exit();
}

if (isset($_GET['hapus'])) {
    $nim = mysqli_real_escape_string($conn, $_GET['hapus']);
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h2 class="text-center">Data Mahasiswa</h2>

<form method="POST" class="mb-4">
    <input type="hidden" name="id" id="id">
    <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" class="form-control" name="nim" id="nim" required>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" name="nama" id="nama" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Gender</label><br>
        <input type="radio" name="jenis_kelamin" value="Laki-laki" id="laki"> <label for="laki">Laki-laki</label>
        <input type="radio" name="jenis_kelamin" value="Perempuan" id="perempuan"> <label for="perempuan">Perempuan</label>
    </div>
    <div class="mb-3">
        <label for="jurusan" class="form-label">Jurusan</label>
        <input type="text" class="form-control" name="jurusan" id="jurusan" required>
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    <button type="reset" class="btn btn-secondary">Ulangi</button>
</form>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Jurusan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($row['nim']); ?></td>
            <td><?= htmlspecialchars($row['nama']); ?></td>
            <td><?= htmlspecialchars($row['jenis_kelamin']); ?></td>
            <td><?= htmlspecialchars($row['jurusan']); ?></td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="editData('<?= htmlspecialchars($row['nim']); ?>', '<?= htmlspecialchars($row['nama']); ?>', '<?= htmlspecialchars($row['jenis_kelamin']); ?>', '<?= htmlspecialchars($row['jurusan']); ?>')">Edit</button>
                <a href="?hapus=<?= htmlspecialchars($row['nim']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
    function editData(nim, nama, jenis_kelamin, jurusan) {
        document.getElementById('id').value = nim;
        document.getElementById('nim').value = nim;
        document.getElementById('nama').value = nama;
        document.getElementById('jurusan').value = jurusan;
        document.getElementById('laki').checked = jenis_kelamin === "Laki-laki";
        document.getElementById('perempuan').checked = jenis_kelamin === "Perempuan";
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
