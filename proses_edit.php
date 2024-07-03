<?php
include 'koneksi.php';

$nim_lama = $_POST['nim_lama'];
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$alamat = $_POST['alamat'];

$foto = $_FILES['foto']['name'];
$target = "uploads/" . basename($foto);

if ($foto) {
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
        $sql = "UPDATE siswa SET nim='$nim', nama='$nama', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', alamat='$alamat', foto='$foto' WHERE nim='$nim_lama'";
    } else {
        echo "Error uploading file.";
        exit;
    }
} else {
    $sql = "UPDATE siswa SET nim='$nim', nama='$nama', tanggal_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', alamat='$alamat' WHERE nim='$nim_lama'";
}

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
