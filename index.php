<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Data Siswa</h1>
        <a href="tambah.php" class="btn btn-primary mb-3">Tambah Siswa</a>
        <a href="report.php" target="_blank" class="btn btn-success mb-3">Cetak PDF</a> <!-- Tambahkan tombol Cetak PDF -->
        <form action="index.php" method="GET" class="form-inline mb-3">
            <input type="text" name="cari" class="form-control mr-2" placeholder="Cari NIM atau Nama">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
        
        <?php
        include 'koneksi.php';
        $sql = "SELECT * FROM siswa";
        if (isset($_GET['cari'])) {
            $cari = $_GET['cari'];
            $sql = "SELECT * FROM siswa WHERE nim LIKE '%$cari%' OR nama LIKE '%$cari%'";
        }
        $result = $conn->query($sql);
        ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['nim']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['tanggal_lahir']; ?></td>
                    <td><?php echo $row['jenis_kelamin']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><img src="uploads/<?php echo $row['foto']; ?>" width="100"></td>
                    <td>
                        <a href="edit.php?nim=<?php echo $row['nim']; ?>" class="btn btn-warning">Edit</a>
                        <a href="hapus.php?nim=<?php echo $row['nim']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
